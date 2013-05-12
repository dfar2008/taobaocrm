<?php
require_once('include/CRMSmarty.php');
require_once("data/Tracker.php");
require_once('modules/Maillists/Maillists.php');
require_once('themes/'.$theme.'/layout_utils.php');
require_once('include/logging.php');
require_once('include/ListView/ListView.php');
require_once('include/utils/utils.php');
require_once('modules/Maillists/ModuleConfig.php');
require_once('modules/CustomView/CustomView.php');
require_once('include/DatabaseUtil.php');
require_once('modules/Fenzu/Fenzu.php');
global $app_strings,$mod_strings,$list_max_entries_per_page;

$log = LoggerManager::getLogger('maillist_list');

global $currentModule,$image_path,$theme;

$focus = new Maillists();
$smarty = new CRMSmarty();

if($_REQUEST['parenttab'] != '')
{
	$category = $_REQUEST['parenttab'];
}
else
{
	$category = getParentTab();
}
$nowdatetime = date("Y-m-d H:i:s");

//<<<<cutomview>>>>>>>
$oFenzu = new Fenzu("Maillists");
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

//$sjid = rand(10000000,99999999);
//删除多余
$adb->query("delete from ec_maillists where deleted=1");
//生成事件id
$sjid = $adb->getUniqueID("ec_crmentity");
$sql = "insert into ec_maillists(maillistsid,deleted) values(".$sjid.",1)";
$adb->query($sql);
$smarty->assign("sjid",$sjid);
$adb->query("insert into ec_crmentity (crmid,setype,smcreatorid,smownerid,createdtime,modifiedtime) values('".$sjid."','Maillists',".$current_user->id.",".$current_user->id.",'".$nowdatetime."','".$nowdatetime."')");


$res = $adb->query("select * from ec_systems where smownerid='".$current_user->id."'");
$from_name = $adb->query_result($res,0,'from_name');
$from_email = $adb->query_result($res,0,'from_email');
$smarty->assign("from_name",$from_name);
$smarty->assign("from_email",$from_email);


//Retreive the List View Table Header
if($viewid !='')
$url_string .="&viewname=".$viewid;


if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display("Maillists/ListViewEntries.tpl");
else
	$smarty->display("Maillists/ListView.tpl");
?>
