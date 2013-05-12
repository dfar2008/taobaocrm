<?php
require_once('include/CRMSmarty.php');
require_once("data/Tracker.php");
require_once('modules/Qunfas/Qunfas.php');
require_once('themes/'.$theme.'/layout_utils.php');
require_once('include/logging.php');
require_once('include/ListView/ListView.php');
require_once('include/utils/utils.php');
require_once('modules/Qunfas/ModuleConfig.php');
require_once('include/DatabaseUtil.php');
require_once('modules/Fenzu/Fenzu.php');

global $app_strings,$mod_strings,$list_max_entries_per_page;

$log = LoggerManager::getLogger('qunfa_list');

global $currentModule,$image_path,$theme;
$focus = new Qunfas();
$smarty = new CRMSmarty();

if($_REQUEST['parenttab'] != '')
{
	$category = $_REQUEST['parenttab'];
}
else
{
	$category = getParentTab();
}


//<<<<cutomview>>>>>>>
$oFenzu = new Fenzu("Qunfas");
$viewid =$_REQUEST['viewname']; 
$customviewcombo_html = $oFenzu->getFenzuCombo($viewid);
//$viewnamedesc = $oFenzu->getCustomViewByCvid($viewid);
//<<<<<customview>>>>>

global $current_user;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
$smarty->assign("CUSTOMVIEW_OPTION",$customviewcombo_html);
$smarty->assign("VIEWID", $viewid);
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("MODULE",$currentModule);
$smarty->assign("SINGLE_MOD",'Qunfa');
$smarty->assign("BUTTONS",$other_text);
$smarty->assign("CATEGORY",$category);

$smarty->assign("CHANGE_OWNER",getUserslist());




$qunfatmps = $focus->getQunfatmpsInfo();

$smarty->assign("QUNFATMPS",$qunfatmps);



//Retreive the List View Table Header
if($viewid !='')
$url_string .="&viewname=".$viewid;


if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display("Qunfas/ListViewEntries.tpl");
else
	$smarty->display("Qunfas/ListView.tpl");
?>
