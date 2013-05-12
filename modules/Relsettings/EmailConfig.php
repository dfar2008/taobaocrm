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
require_once('include/CRMSmarty.php');
global $mod_strings;
global $app_strings;
global $app_list_strings;
global $current_user;

//Display the mail send status
$smarty = new CRMSmarty();
if($_REQUEST['mail_error'] != '')
{
    $error_msg = strip_tags($_REQUEST['mail_error']);
	$smarty->assign("ERROR_MSG",'<b><font color="red">'.$mod_strings['Test_Mail_status'].' : '.$error_msg.'</font></b>');
}

global $adb;
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$sql="select * from ec_systems where server_type = 'email' and smownerid='".$current_user->id."'";
$result = $adb->query($sql);
$mail_server = $adb->query_result($result,0,'server');
$mail_server_port = $adb->query_result($result,0,'server_port');
$mail_server_username = $adb->query_result($result,0,'server_username');
$mail_server_password = $adb->query_result($result,0,'server_password');
$smtp_auth = $adb->query_result($result,0,'smtp_auth');
$from_name = $adb->query_result($result,0,'from_name');
$from_email = $adb->query_result($result,0,'from_email');

if (isset($mail_server))
	$smarty->assign("MAILSERVER",$mail_server);
if (isset($mail_server_port))
	$smarty->assign("MAILSERVER_PORT",$mail_server_port);
else 
    $smarty->assign("MAILSERVER_PORT","25");
if (isset($mail_server_username))
	$smarty->assign("USERNAME",$mail_server_username);
if (isset($mail_server_password))
	$smarty->assign("PASSWORD",$mail_server_password);
if (isset($smtp_auth))
{
	if($smtp_auth == 'true')
		$smarty->assign("SMTP_AUTH",'checked');
	else
		$smarty->assign("SMTP_AUTH",'');
}

if(isset($from_name)){
	$smarty->assign("FROMNAME",$from_name);
}
if(isset($from_email)){
	$smarty->assign("FROMEMAIL",$from_email);
}
if(isset($_REQUEST['emailconfig_mode']) && $_REQUEST['emailconfig_mode'] != '')
	$smarty->assign("EMAILCONFIG_MODE",$_REQUEST['emailconfig_mode']);
else
	$smarty->assign("EMAILCONFIG_MODE",'view');

$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("APP", $app_strings);
$smarty->assign("CMOD", $mod_strings);
$smarty->display("Relsettings/EmailConfig.tpl");
?>
