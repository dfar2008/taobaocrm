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
 * $Header$
 * Description:  TODO To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('include/CRMSmarty.php');
require_once('data/Tracker.php');
require_once('modules/SalesOrder/SalesOrder.php');
require_once('include/CustomFieldUtil.php');
require_once('include/database/PearDatabase.php');
require_once('include/utils/utils.php');
require_once('user_privileges/default_module_view.php');
global $mod_strings,$app_strings,$theme,$currentModule,$singlepane_view;

$focus = new SalesOrder();

if(isset($_REQUEST['record']) && isset($_REQUEST['record'])) {
    $focus->retrieve_entity_info($_REQUEST['record'],"SalesOrder");
    $focus->id = $_REQUEST['record'];
    $focus->name=$focus->column_fields['subject'];
}

if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}

$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$log->info("SalesOrder detail view");

$smarty = new CRMSmarty();

$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);

$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);
//$smarty->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);

if (isset($focus->name))
$smarty->assign("NAME", $focus->name);
else
$smarty->assign("NAME", "");
$smarty->assign("BLOCKS", getBlocks($currentModule,"detail_view",'',$focus->column_fields));
$smarty->assign("UPDATEINFO",updateInfo($focus->id));

$smarty->assign("CUSTOMFIELD", $cust_fld);
$smarty->assign("ID", $_REQUEST['record']);
$smarty->assign("SINGLE_MOD", 'SalesOrder');
$category = getParentTab();
$smarty->assign("CATEGORY",$category);


if(isPermitted($module,"EditView",$_REQUEST['record']) == 'yes') {

 	$smarty->assign("EDIT","permitted");
	$smarty->assign("EDIT_PERMISSION","yes");

} else {
	$smarty->assign("EDIT_PERMISSION","no");
}
$check_button = Button_Check($module);
$smarty->assign("CHECK", $check_button);
if(isPermitted($module,"Create",$_REQUEST['record']) == 'yes')
	$smarty->assign("EDIT_DUPLICATE","permitted");
if(isPermitted($module,"Delete",$_REQUEST['record']) == 'yes')
	$smarty->assign("DELETE","permitted");

$smarty->assign("CREATEPDF","permitted");

$approve_status = $focus->column_fields['approved'];

if(isPermitted("Invoice","Create",$_REQUEST['record']) == 'yes')
	$smarty->assign("CONVERTINVOICE","permitted");
if(!isset($is_disable_approve) || (isset($is_disable_approve) && !$is_disable_approve)) {
	if(isPermitted($module,"Approve") == 'yes') {
           
          	 $smarty->assign("APPROVE","permitted");
            
        }
	$smarty->assign("APPROVE_STATUS",$approve_status);
} else {
	$smarty->assign("APPROVE_STATUS",1);
}

//if($focus->column_fields['sostatus'] == $app_strings["CONSTANTS_SO_CREATED"]) {
if($approve_status == 0) {
	$smarty->assign("CANCEL_ORDER_STATUS","disabled");
	//$smarty->assign("GATHER_ORDER_STATUS","disabled");
	$smarty->assign("ANTI_ORDER_STATUS","disabled");
	//$smarty->assign("APPROVE_ORDER_STATUS","disabled");
/*
} elseif($focus->column_fields['sostatus'] == $app_strings["Approved"]) {
	//$smarty->assign("CANCEL_ORDER_STATUS","disabled");
	//$smarty->assign("GATHER_ORDER_STATUS","disabled");
	//$smarty->assign("ANTI_ORDER_STATUS","disabled");
	$smarty->assign("ORDER_STATUS","disabled");
	$smarty->assign("APPROVE_ORDER_STATUS","disabled");
	if(is_admin($current_user)) {
		$smarty->assign("APPROVE","permitted");
	}
*/
} elseif($approve_status == $app_strings["CONSTANTS_APPOK"]) {
	$smarty->assign("CANCEL_ORDER_STATUS","");
	//$smarty->assign("GATHER_ORDER_STATUS","disabled");
	$smarty->assign("ANTI_ORDER_STATUS","");
	$smarty->assign("ORDER_STATUS","disabled");
	$smarty->assign("APPROVE_ORDER_STATUS","disabled");
	if(is_admin($current_user)) {
		$smarty->assign("APPROVE","permitted");
	}
//} elseif($focus->column_fields['sostatus'] == $app_strings["CONSTANTS_SO_CANCELED"]) {
} elseif($approve_status == $app_strings["CONSTANTS_CANCELED"]) {
	$smarty->assign("CANCEL_ORDER_STATUS","disabled");
	$smarty->assign("GATHER_ORDER_STATUS","disabled");
	$smarty->assign("ANTI_ORDER_STATUS","disabled");
	//$smarty->assign("APPROVE_ORDER_STATUS","");
	//$smarty->assign("ORDER_STATUS","");
}
/*
elseif($focus->column_fields['sostatus'] == $app_strings["CONSTANTS_SO_FINISHED"]) {
	//$smarty->assign("CANCEL_ORDER_STATUS","disabled");
	//$smarty->assign("GATHER_ORDER_STATUS","disabled");
	//$smarty->assign("ANTI_ORDER_STATUS","");
	$smarty->assign("APPROVE_ORDER_STATUS","disabled");
	$smarty->assign("ORDER_STATUS","disabled");
	if(is_admin($current_user)) {
		$smarty->assign("APPROVE","permitted");
	}
}
elseif($focus->column_fields['sostatus'] == $app_strings["CONSTANTS_SO_NOTFINISHED"]) {
	//$smarty->assign("CANCEL_ORDER_STATUS","disabled");
	//$smarty->assign("GATHER_ORDER_STATUS","disabled");
	//$smarty->assign("ANTI_ORDER_STATUS","");
	$smarty->assign("APPROVE_ORDER_STATUS","disabled");
	$smarty->assign("ORDER_STATUS","disabled");
	if(is_admin($current_user)) {
		$smarty->assign("APPROVE","permitted");
	}
}
*/

else {
	$smarty->assign("CANCEL_ORDER_STATUS","disabled");
	$smarty->assign("GATHER_ORDER_STATUS","disabled");
	$smarty->assign("ANTI_ORDER_STATUS","disabled");
	//$smarty->assign("APPROVE_ORDER_STATUS","disabled");
}

if($is_disable_approve) {
	$smarty->assign("GATHER_ORDER_STATUS","");
}
global $current_user;
$smarty->assign("IS_ADMIN",is_admin($current_user));




$smarty->assign("MODULE", $currentModule);
$smarty->assign("CONVERTMODE",'sotoinvoice');
//Get the associated Products and then display above Terms and Conditions
$smarty->assign("ASSOCIATED_PRODUCTS",$focus->getDetailAssociatedProducts());


 $tabid = getTabid("SalesOrder");
 $data = getSplitDBValidationData($focus->tab_name,$tabid);

 $smarty->assign("VALIDATION_DATA_FIELDNAME",$data['fieldname']);
 $smarty->assign("VALIDATION_DATA_FIELDDATATYPE",$data['datatype']);
 $smarty->assign("VALIDATION_DATA_FIELDLABEL",$data['fieldlabel']);



if($singlepane_view == 'true')
{
	$related_array = getRelatedLists($currentModule,$focus);
	$smarty->assign("RELATEDLISTS", $related_array);
}

$smarty->assign("SinglePane_View", $singlepane_view);

$smarty->display("SalesOrder/InventoryDetailView.tpl");

?>
