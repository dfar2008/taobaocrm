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
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
global $adb;

$cvid = $_REQUEST["record"];
$module = $_REQUEST["dmodule"];
$smodule = $REQUEST["smodule"];
$parenttab = $_REQUEST["parenttab"];

if(isset($cvid) && $cvid != '')
{
	$deletesql = "delete from ec_fenzu where cvid =".$cvid;
	$deleteresult = $adb->query($deletesql);
	$_SESSION['lvs'][$module]["viewname"] = '';
}
if(isset($smodule) && $smodule != '')
{
	$smodule_url = "&smodule=".$smodule;
}
clear_cache_files();
header("Location: index.php?action=ListView&parenttab=$parenttab&module=$module".$smodule_url);
?>
