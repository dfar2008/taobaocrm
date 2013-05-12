<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/modules/Accounts/Delete.php,v 1.5 2005/03/10 09:28:34 shaw Exp $
 * Description:  Deletes an Account record and then redirects the browser to the 
 * defined return URL.
 ********************************************************************************/

require_once('modules/Accounts/Accounts.php');
global $mod_strings;
global $current_user;
global $adb;

require_once('include/logging.php');
$log = LoggerManager::getLogger('account_delete');

if(!isset($_REQUEST['record']))
	die($mod_strings['ERR_DELETE_RECORD']);


$adb->startTransaction();
//delete notes
$sql= "update ec_notes set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);

//delete contacts
$sql= "update ec_contactdetails set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);
//delete cares
$sql= "update ec_cares set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);

//delete potential
$sql= "update ec_potential set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);


//delete quote
$sql= "update ec_quotes set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);

//delete salesorder
$sql= "update ec_salesorder set deleted=1 whereaccountid='".$_REQUEST['record']."'";
$adb->query($sql);

//delete invoice
$sql= "update ec_invoice set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);

//delete gathers
$sql= "update ec_gathers set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);

//delete expenses
$sql= "update ec_expenses set deleted=1 where accountid='".$_REQUEST['record']."'";
$adb->query($sql);

$date_var = date('YmdHis');
$sql="update ec_account set deleted=1,modifiedby='".$current_user->id."',modifiedtime=".$adb->formatDate($date_var)." where accountid='" .$_REQUEST['record'] ."'"; 
$adb->query($sql);
$adb->completeTransaction();

if(isset($_REQUEST['parenttab']) && $_REQUEST['parenttab'] != "") $parenttab = $_REQUEST['parenttab'];

redirect("index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']."&parenttab=".$parenttab."&relmodule=".$_REQUEST['module']);
?>
