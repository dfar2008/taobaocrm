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
require_once('include/database/PearDatabase.php');
require_once('include/CRMSmarty.php');
require_once('modules/Products/Products.php');
require_once('include/utils/utils.php');
require_once('user_privileges/default_module_view.php');

$focus = new Products();

if(isset($_REQUEST['record']) && isset($_REQUEST['record'])) {
	//Display the error message
	if(isset($_SESSION['image_type_error']) && $_SESSION['image_type_error'] != '')
	{
		echo '<font color="red">'.$_SESSION['image_type_error'].'</font>';
		session_unregister('image_type_error');
	}

	$focus->retrieve_entity_info($_REQUEST['record'],"Products");
	$focus->id = $_REQUEST['record'];
	$focus->name=$focus->column_fields['productname'];
	$focus->column_fields['product_description'] = decode_html($focus->column_fields["product_description"]);//描述
}

if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
        $focus->id = "";
}

global $app_strings,$currentModule,$singlepane_view;
global $mod_strings;

global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$smarty = new CRMSmarty();
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);

if (isset($focus->name)) $smarty->assign("NAME", $focus->name);
else $smarty->assign("NAME", "");
$focus->column_fields['description'] = html_entity_decode($focus->column_fields['description']);

$smarty->assign("BLOCKS", getBlocks($currentModule,"detail_view",'',$focus->column_fields));
$category = getParentTab();
$smarty->assign("CATEGORY",$category);
$smarty->assign("UPDATEINFO",updateInfo($focus->id));


//$smarty->assign("CUSTOMFIELD", $cust_fld);
$smarty->assign("SINGLE_MOD", 'Product');

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

$smarty->assign("IMAGE_PATH", $image_path);
//$smarty->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);
$smarty->assign("ID", $_REQUEST['record']);

/*
//Added to display the Tax informations
$tax_details = getTaxDetailsForProduct($focus->id);

for($i=0;$i<count($tax_details);$i++)
{
	$tax_details[$i]['percentage'] = getProductTaxPercentage($tax_details[$i]['taxname'],$focus->id);
}
$smarty->assign("TAX_DETAILS", $tax_details);
*/

$productcangkunums=array();
$productid=$focus->id;
//$sec_check=getProductCangkuSeccheck();


 $tabid = getTabid("Products");
 $data = getSplitDBValidationData($focus->tab_name,$tabid);
 $smarty->assign("VALIDATION_DATA_FIELDNAME",$data['fieldname']);
 $smarty->assign("VALIDATION_DATA_FIELDDATATYPE",$data['datatype']);
 $smarty->assign("VALIDATION_DATA_FIELDLABEL",$data['fieldlabel']);

//Security check for related list
$smarty->assign("MODULE", $currentModule);


if($singlepane_view == 'true')
{
	$related_array = getRelatedLists($currentModule,$focus);
	$smarty->assign("RELATEDLISTS", $related_array);
}

$smarty->assign("SinglePane_View", $singlepane_view);
$smarty->display("Products/DetailView.tpl");

function getProductCangkuSeccheck(){
    global $adb;
    global $current_user;
    $userid=$current_user->id;

    $sec_check=" and ec_cangkus.cangkusid in (select ec_cangkuserrel.cangkusid from ec_cangkuserrel where ec_cangkuserrel.userid=$userid ) ";
    
    return $sec_check;
}
?>
