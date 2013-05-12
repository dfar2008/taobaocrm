<?php


require_once('include/utils/utils.php');
require_once('modules/Maillists/Maillists.php');
require_once('modules/Fenzu/Fenzu.php');
require_once('modules/Accounts/Accounts.php');
require_once("modules/Webmails/inc/class.smtp.php");

global $adb,$current_user;
global $currentModule;


$focus = new Maillists();
$oFenzu = new Fenzu("Maillists");
$focus_acc = new Accounts();
$nowdate = date("Y-m-d");
$nowdatetime = date("Y-m-d H:i:s");


$sjid = $_REQUEST["sjid"];
$subject = $_REQUEST["subject"];
$mailcontent = $_REQUEST["mailcontent"]; 
$from_name = $_REQUEST['from_name'];
$from_email = $_REQUEST['from_email'];

if(preg_match("/[\$a-zA-Z0-9\$]{1}/",$mailcontent)){
	$msflag = 0;
	$messinfos = explode('$',$mailcontent);
}else{
	$msflag=1;
}

$accountidstr = $_REQUEST["accountidstr"];
if(preg_match("/\,/",$accountidstr)){
	$accountidstr = substr($accountidstr, 0, -1);
}

$accountidarr = explode(',',$accountidstr);

foreach($accountidarr as $accountinfostr){
  	$accountinfo = explode('(',$accountinfostr);
  	for($i=0;$i<count($accountinfo);$i++){
		$accountinfo[$i] = preg_replace("/\)$/", '', $accountinfo[$i]);
  	}
	$accounts[] = $accountinfo;
}

$i=1;
foreach($accounts as $account){
	$membername = $account[1];
	$email = $account[0];
	if($email && $email !=''){
		$is_true = preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$email);
		if($is_true){
			$sendresult[$i] = array($email,$membername);
		 }else{
			echo "客户\"".$membername."\"的Email格式不正确.";die;
		 }
	}else{
			echo  "客户\"".$membername."\"的Email为空!";die;
	}
	$i++;
}
$j=1;
foreach($sendresult as $rst){
	if($msflag == '1'){
		$msg = send_webmail($rst[0],"","",$subject,$mailcontent,$sjid);
	}else{
		if(is_array($messinfos)){
			$messstr = '';
			foreach($messinfos as $mess){
				if($mess =='membername'){
					$messstr .= $rst[1];
				}else{
					$messstr .= $mess;
				}
			}
		}
		$msg = send_webmail($rst[0],"","",$subject,$messstr,$sjid);
	}

	if($msg['error'] == '1'){
		$sendrst[$j] = 1;
		$rstmsg[$j] ="客户\"".$rst[1]."\:".$msg['message'];
	}else{
		$sendrst[$j] = 0;
	}
	$j++;
}
$failaccount = '';
foreach($sendrst as $key=>$st){
	if($st =='1'){
		$failaccount .=$rstmsg[$key].",\n";
	}
}
if($failaccount !=''){
	print_r($failaccount);die;
}else{
	$accountidstr = ""; 
	$maillistname = "qfyj".date("Y-m-d").$focus->get_next_id();
	foreach($accounts as $account){
		$membername = $account[1];
		$accountid = getAccountIdInfo($membername);
		$messstr = '';
		if($accountid && $accountid !=''){
			$accountidstr .=",".$accountid;
			$updateacc_sql = "update ec_account set lastsendmaildate='".$nowdatetime."' where accountid=$accountid";
			$adb->query($updateacc_sql);
		}
	}
	
	$accountidstr .=",";
	
	$updatesql = "update ec_maillists set maillistname='".$maillistname."',accountid='".$accountidstr."',smcreatorid=".$current_user->id.",smownerid=".$current_user->id.",createdtime='".$nowdatetime."'" .
					",modifiedtime='".$nowdatetime."',from_name='".$from_name."',from_email='".$from_email."',subject='".$subject."',mailcontent='".$mailcontent."',deleted=0 where  maillistsid= ".$sjid." ";  
	$adb->query($updatesql);
			
	
	require_once ('getSendMailNums.php');
	echo "SUCCESS";die;
}

exit();

function send_webmail($to_email,$from_name,$from_email,$subject,$contents,$sjid='')
{
	ini_set('date.timezone','Asia/Shanghai');
	global $adb, $log;
	global $current_user;
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
	//$from_name = iconv_ec("UTF-8","GBK",$from_name);
	//$from_email = "";
	$smtphandle->subject = $subject;
	$smtphandle->body = $contents;
	$res = $adb->query("select * from ec_systems where server_type='email' and smownerid='".$current_user->id."'");
	$rownum = $adb->num_rows($res);
	if($rownum == 0) {
		return "No Smtp Server!";
	}
	$server = $adb->query_result($res,0,'server');
    $username = $adb->query_result($res,0,'server_username');
    $password = $adb->query_result($res,0,'server_password');
	$smtp_auth = $adb->query_result($res,0,'smtp_auth');
	$server_port = $adb->query_result($res,0,'server_port');
	$from_email = $adb->query_result($res,0,'from_email');
	$from_name = $adb->query_result($res,0,'from_name');
	
	$from_name = iconv_ec("UTF-8","GBK",$from_name);
	$from_email = iconv_ec("UTF-8","GBK",$from_email);
	
	$smtphandle->SetHost($server, $server_port);
	$smtphandle->UseAuthLogin($username, $password);
	$smtphandle->SetFrom($from_email, $from_name);
	$smtphandle->AddReplyTo($from_email, $from_name);
	if($to_email != '')
	{
		$smtphandle->AddTo($to_email);
	}

	if($sjid != "") {
		$query = "select ec_attachments.* from ec_attachments " .
		" inner join ec_attachmentsjrel on ec_attachmentsjrel.attachmentsid = ec_attachments.attachmentsid " .
		"where ec_attachmentsjrel.sjid=$sjid and ec_attachments.deleted=0 order by ec_attachments.attachmentsid asc";

		$result = $adb->query($query);
		$rownum = $adb->num_rows($result);
		if($rownum > 0) {
			while($row = $adb->fetch_array($result)){
				$attachmentsid = $row['attachmentsid'];
				$filename = $row['name'];
				$filename = iconv_ec("UTF-8","GBK",$filename);
				$encode_filename = base64_encode_filename($row['name']);
				$filepath = $row['path'];
				$filetype = $row['type'];

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

function getAccountIdInfo($membername){
	global $adb;
	$query = "select * from ec_account where membername = '".$membername."' limit 0,1";
	$result = $adb->query($query);
	$num_rows = $adb->num_rows($result);
	if($num_rows > 0){
		for($i=0;$i<$num_rows;$i++) {
			$accountid = $adb->query_result($result,$i,'accountid');
		}
	}else{
		$accountid = '';
	}
	return $accountid;
}
?>