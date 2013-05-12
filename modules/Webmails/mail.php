<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *
 ********************************************************************************/


require_once("modules/Webmails/inc/class.smtp.php");

/**   Function used to send email 
  *   $module 		-- current module 
  *   $to_email 	-- to email address 
  *   $from_name	-- currently loggedin user name
  *   $from_email	-- currently loggedin ec_users's email id. you can give as '' if you are not in HelpDesk module
  *   $subject		-- subject of the email you want to send
  *   $contents		-- body of the email you want to send
  *   $cc		-- add email ids with comma seperated. - optional 
  *   $bcc		-- add email ids with comma seperated. - optional.
  *   $attachment	-- whether we want to attach the currently selected file or all ec_files.[values = current,all] - optional
  *   $emailid		-- id of the email object which will be used to get the ec_attachments
  */
function send_webmail($module,$to_email,$from_name,$from_email,$subject,$contents,$cc='',$bcc='',$attachment='',$emailid='')
{	

	global $adb, $log; 
	$log->debug("Entering send_webmail() method ...");
	$smtphandle = new SMTPMailer;
	if(!isset($_SESSION["MAILLIST_PLAINTEXT"])) {
		$smtphandle->UseHTML(1);		// set email format to HTML
		$headertag = "<HEAD><META http-equiv=\"Content-Type\" content=\"text/html; charset=GBK\"></HEAD>";
		$contents = from_html($contents);
		$contents = eregi_replace('<BODY', $headertag.'<BODY', $contents);
	}
	$smtphandle->charset = 'GBK';
	//convert UTF-8 to GBK
	$subject = iconv_ec("UTF-8","GBK",$subject);
	$contents = iconv_ec("UTF-8","GBK",$contents);
	$emailid = iconv_ec("UTF-8","GBK",$emailid);
	//$from_email = "";
	$smtphandle->subject = $subject;
	$smtphandle->body = $contents;
	$res = $adb->query("select * from ec_systems where server_type='email'");
	$rownum = $adb->num_rows($res);
	if($rownum == 0) {
		return "No Smtp Server!";
	}
	$server = $adb->query_result($res,0,'server');
    $username = $adb->query_result($res,0,'server_username');
    $password = $adb->query_result($res,0,'server_password');
	$smtp_auth = $adb->query_result($res,0,'smtp_auth');
	$server_port = $adb->query_result($res,0,'server_port');
	
	if($from_email == ''){
		$from_email = $adb->query_result($res,0,'from_email');
	}
	if($from_name == ''){
		$from_name = $adb->query_result($res,0,'from_name');
	}
	
	$from_name = iconv_ec("UTF-8","GBK",$from_name);
	$from_email = iconv_ec("UTF-8","GBK",$from_email);
	
	
	$smtphandle->SetHost($server, $server_port);
	$smtphandle->UseAuthLogin($username, $password);
	$smtphandle->SetFrom($from_email, $from_name);
	$smtphandle->AddReplyTo($from_email, $from_name);
	if($to_email != '')
	{
		if(is_array($to_email)) {
			for($j=0,$num=count($to_email);$j<$num;$j++) {
				$smtphandle->AddTo($to_email[$j]);
			}
		} else {
			$_tmp = explode(",",$to_email);
			for($j=0,$num=count($_tmp);$j<$num;$j++) {
				$smtphandle->AddTo($_tmp[$j]);
			}
		}
	}
	if($cc != '')
	{
		if(is_array($cc)) {
			for($j=0,$num=count($cc);$j<$num;$j++) {
				$smtphandle->AddCc($cc[$j]);
			}
		} else {
			$_tmp = explode(",",$cc);
			for($j=0,$num=count($_tmp);$j<$num;$j++) {
				$smtphandle->AddCc($_tmp[$j]);
			}
		}
	}
	if($bcc != '')
	{
		if(is_array($bcc)) {
			for($j=0,$num=count($bcc);$j<$num;$j++) {
				$smtphandle->AddBcc($bcc[$j]);
			}
		} else {
			$_tmp = explode(",",$bcc);
			for($j=0,$num=count($_tmp);$j<$num;$j++) {
				$smtphandle->AddBcc($_tmp[$j]);
			}
		}
	}
	
	if($attachment != "") {
		$query = "select * from ec_attachments where attachmentsid='".$attachment."'";
		$result = $adb->query($query);
		$rownum = $adb->num_rows($result);
		if($rownum > 0) {
			$attachmentsid = $adb->query_result($result,0,'attachmentsid');
			$filename = $adb->query_result($result,0,'name');
			$filename = iconv_ec("UTF-8","GBK",$filename);
			$encode_filename = base64_encode_filename($adb->query_result($result,0,'name'));
			$filepath = $adb->query_result($result,0,'path');
			$filetype = $adb->query_result($result,0,'type');
			
			global $root_directory;
			$fullpath = $root_directory.$filepath.$attachmentsid."_".$encode_filename;
			$log->info("send_webmail :: fullpath:".$fullpath);
			if(file_exists($fullpath)) {				
				$attachment_status = $smtphandle->AddAttachment($fullpath, $filename, $filetype);
				if(!$attachment_status) {
					$log->info("send_webmail :: errormsg:".$smtphandle->errormsg);
				}
			}
			
		}
		
	}
	$errMsg = "";
	$sentmsg = $smtphandle->Send();
	if ($sentmsg === false) {
		$errMsg = $smtphandle->errormsg.'<br>';
		$log->info("send_webmail :: errormsg:".$smtphandle->errormsg);
	}
	$log->debug("Exit send_webmail() method ...");
	return $errMsg;
}

function send_webmail_byses($module,$to_email,$from_name,$from_email,$subject,$contents,$cc='',$bcc='',$attachment='',$emailid='')
{

	global $log,$access_key,$secret_key;
	$log->debug("Entering send_webmail_byses() method ...");
	require_once('include/ses.php');
	$errMsg = "";
	if($access_key != "" && $secret_key != "") {
		$ses = new SimpleEmailService($access_key, $secret_key);
		if(!isset($_SESSION["MAILLIST_PLAINTEXT"])) {
			$headertag = "<HEAD><META http-equiv=\"Content-Type\" content=\"text/html; charset=GBK\"></HEAD>";
			$contents = from_html($contents);
			$contents = eregi_replace('<BODY', $headertag.'<BODY', $contents);
		}
		$m = new SimpleEmailServiceMessage();
		$m->addTo($to_email);
		$m->setFrom($from_email);
		$m->setSubject($subject);
		$m->setMessageFromString($contents);
		$m->setSubjectCharset('GBK');
		$m->setMessageCharset('GBK');
		$errMsg = $ses->sendEmail($m);
		$log->debug("send_webmail_byses sendEmail result:".$errMsg);
	}
	
    
	$log->debug("Exit send_webmail_byses() method ...");
	return $errMsg;
}
?>
