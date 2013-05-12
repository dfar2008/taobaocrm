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

global $current_user;
global $adb;

if(isset($_REQUEST['file']) && ($_REQUEST['file'] !=''))
{
	require_once('modules/Users/'.$_REQUEST['file'].'.php');
}
if(isset($_REQUEST['orgajax']) && ($_REQUEST['orgajax'] !=''))
{
	require_once('modules/Users/CreateSharingRule.php');	
}
elseif(isset($_REQUEST['announce_save']) && ($_REQUEST['announce_save'] != ''))
{
	$date_var = date('YmdHis');
	$announcement = $_REQUEST['announcement'];
	$title = $_REQUEST['title_announcement'];
	$sql="select * from ec_announcement where creatorid=".$current_user->id;
	$is_announce=$adb->query($sql);
	if($adb->num_rows($is_announce) > 0)
		$query="update ec_announcement set announcement=".$adb->formatString("ec_announcement","announcement",$announcement).",time=".$adb->formatString("ec_announcement","time",$date_var).",title='announcement' where creatorid=".$current_user->id;
	else
		$query="insert into ec_announcement values (".$current_user->id.",".$adb->formatString("ec_announcement","announcement",$announcement).",'announcement',".$adb->formatString("ec_announcement","time",$date_var).")";
	$result=$adb->query($query);
	echo $announcement;
}
?>
