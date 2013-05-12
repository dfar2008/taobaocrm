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
require_once('Sms/SmsLib.php');
global $mod_strings;
global $app_strings;
global $app_list_strings;
global $current_user;
//Display the mail send status
$smarty = new CRMSmarty();

global $adb;
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$sql="select * from ec_messageaccount where  smownerid='".$current_user->id."'"; 
$result = $adb->query($sql);
$username = $adb->query_result($result,0,'username');
$password = $adb->query_result($result,0,'password');

if (isset($username))
	$smarty->assign("USERNAME",$username);
if (isset($password))
	$smarty->assign("PASSWORD",$password);
if(isset($_REQUEST['messageconfig_mode']) && $_REQUEST['messageconfig_mode'] != '')
	$smarty->assign("MESSAGECONFIG_MODE",$_REQUEST['messageconfig_mode']);
else
	$smarty->assign("MESSAGECONFIG_MODE",'view');
/*
//get sms money
//$host_name = "http://www.c3crm.com/getFee.php?name=$username&pwd=$password";
$host_name = "http://www.china-sms.com/send/getfee.asp?name=$username&pwd=$password";
if (gethostbyname($host_name) == $host_name) {	// network error
    // notify user network baybe has error	
} else {
    $fp=fopen($host_name,"r");
    $ret  = fgetss($fp,255);
    $result_array = explode("&",$ret);
    $i = 0;
    foreach ($result_array as $result) {
	switch ($i) {
		case 0:
			$id = substr($result,strpos($result,"=")+1);
		    break;
		case 1:
			$err = substr($result,strpos($result,"=")+1);
		    break;
		case 2:
			$errid = substr($result,strpos($result,"=")+1);
		    break;
        } 
	$i ++;
    }
    if($id != 0) {
		$smarty->assign("SMS_MONEY", $id/10);
    } else {
		$smarty->assign("SMS_MONEY", iconv_ec("GB2312","UTF-8",$err));
    }
    fclose($fp);
}
*/
//$result = logout();
//echo "logout:".print_r($result,true)."<br>";
//$result = loginSMS();
//echo "login:".print_r($result,true)."<br>";
$info=getBalance($current_user->id);
//$result = logout();
//echo "logout:".print_r($result,true)."<br>";
 if($info["error"]==1){
    $smarty->assign("SMS_MONEY",$info["message"]);
}else{
    $smarty->assign("SMS_MONEY",$info["balance"]*10);
}
$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("APP", $app_strings);

$smarty->assign("CMOD", $mod_strings);
$smarty->display("Relsettings/MessageConfig.tpl");
?>
