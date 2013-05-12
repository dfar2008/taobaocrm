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
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/modules/Accounts/EditView.php,v 1.19 2005/03/24 16:18:38 samk Exp $
 * Description:  TODO To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('include/CRMSmarty.php');
require_once('data/Tracker.php');
require_once('modules/Accounts/Accounts.php');
require_once('include/CustomFieldUtil.php');
require_once('include/ComboUtil.php');
require_once('include/utils/utils.php');
require_once('include/FormValidationUtil.php');

global $app_strings,$mod_strings,$currentModule,$theme;
$smarty = new CRMSmarty();

$focus = new Accounts();

if(isset($_REQUEST['record']) && $_REQUEST['record'] != "") 
{
    $focus->id = $_REQUEST['record'];
    $focus->mode = 'edit'; 	
    $focus->retrieve_entity_info($_REQUEST['record'],"Accounts");		
    $focus->name=$focus->column_fields['accountname']; 
}
if(isset($_REQUEST['phone'])) 
{
	$focus->column_fields['phone'] = $_REQUEST['phone'];
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
    $focus->mode = '';
	$focus->column_fields['customernum'] = "";
}
/*
if(empty($focus->column_fields['customernum'])) {
	require_once('user_privileges/seqprefix_config.php');
	$focus->column_fields['customernum'] = $account_seqprefix.date("Ymd")."-".$focus->get_next_id();
}
*/
$disp_view = getView($focus->mode);

if($disp_view == 'edit_view')
	$smarty->assign("BLOCKS",getBlocks("Accounts",$disp_view,$focus->mode,$focus->column_fields));
else	
{
	$smarty->assign("BASBLOCKS",getBlocks("Accounts",$disp_view,$focus->mode,$focus->column_fields));
	//$smarty->assign("ADVBLOCKS",getBlocks("Accounts",$disp_view,$mode,$focus->column_fields,'ADV'));
}

$smarty->assign("OP_MODE",$disp_view);
 

$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
//retreiving the combo values array
//$comboFieldNames = Array('accounttype'=>'account_type_dom'
//                      ,'industry'=>'industry_dom');
//$comboFieldArray = getComboArray($comboFieldNames);


require_once($theme_path.'layout_utils.php');

$log->info("Account detail view");


$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);

if (isset($focus->name)) $smarty->assign("NAME", $focus->name);
else $smarty->assign("NAME", "");
if($focus->mode == 'edit')
{
	$smarty->assign("UPDATEINFO",updateInfo($focus->id));
        $smarty->assign("MODE", $focus->mode);
}

if(isset($_REQUEST['return_module'])) $smarty->assign("RETURN_MODULE", $_REQUEST['return_module']);
else $smarty->assign("RETURN_MODULE","Accounts");
if(isset($_REQUEST['return_action'])) $smarty->assign("RETURN_ACTION", $_REQUEST['return_action']);
if(isset($_REQUEST['return_id'])) $smarty->assign("RETURN_ID", $_REQUEST['return_id']);
if(isset($_REQUEST['return_viewname'])) $smarty->assign("RETURN_VIEWNAME", $_REQUEST['return_viewname']);
$category = getParentTab();
$smarty->assign("CATEGORY",$category);
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);
$smarty->assign("ID", $focus->id);
$smarty->assign("MODULE",$currentModule);
$smarty->assign("SINGLE_MOD",'Account');

$smarty->assign("CALENDAR_LANG", $app_strings['LBL_JSCALENDAR_LANG']);
$smarty->assign("CALENDAR_DATEFORMAT", parse_calendardate($app_strings['NTC_DATE_FORMAT']));

 $tabid = getTabid("Accounts");
 $data = getSplitDBValidationData($focus->tab_name,$tabid);

 $smarty->assign("VALIDATION_DATA_FIELDNAME",$data['fieldname']);
 $smarty->assign("VALIDATION_DATA_FIELDDATATYPE",$data['datatype']);
 $smarty->assign("VALIDATION_DATA_FIELDLABEL",$data['fieldlabel']);


 
if ($focus->mode == 'edit')
$smarty->display('Accounts/EditView.tpl');
else
$smarty->display('Accounts/CreateView.tpl');

?>

