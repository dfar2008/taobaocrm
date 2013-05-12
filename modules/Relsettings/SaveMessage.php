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

require_once("include/database/PearDatabase.php");
require_once("Sms/SmsLib.php");
global $current_user;
global $adb;
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$sql="delete from ec_messageaccount where smownerid='".$current_user->id."'";
//echo "sql1:".$sql."<br>";
$adb->query($sql);
$id = $adb->getUniqueID("ec_messageaccount");
$sql="insert into ec_messageaccount values($id,'".$username."','".$password."','".$current_user->id."')";

$adb->query($sql);
$result = logout($current_user->id);
//print_r($result);
$result = loginSMS($current_user->id);
//print_r($result);
//echo "sql2:".$sql."<br>";
redirect("index.php?module=Relsettings&parenttab=Settings&action=MessageConfig");
?>