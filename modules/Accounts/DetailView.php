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
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/modules/Accounts/DetailView.php,v 1.37 2005/04/18 10:37:49 samk Exp $
 * Description:  TODO To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('include/CRMSmarty.php');
require_once('data/Tracker.php');
require_once('modules/Accounts/Accounts.php');
require_once('include/CustomFieldUtil.php');
require_once('include/database/PearDatabase.php');
require_once('include/utils/utils.php');
require_once('user_privileges/default_module_view.php');
//require_once('modules/Pools/PoolUtils.php');
global $mod_strings;
global $app_strings;
global $app_list_strings;
global $log, $currentModule, $singlepane_view;
global $current_user;

$focus = new Accounts();
if(isset($_REQUEST['record']) && isset($_REQUEST['record'])) {
    $focus->retrieve_entity_info($_REQUEST['record'],"Accounts");
    $focus->id = $_REQUEST['record'];
    $focus->name=$focus->column_fields['accountname'];
$log->debug("id is  ".$focus->id);
$log->debug("name is ".$focus->name);
}

if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}

global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$log->info("Account detail view");
$smarty = new CRMSmarty();
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);

$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);

if (isset($focus->name)) $smarty->assign("NAME", $focus->name);
else $smarty->assign("NAME", "");
$smarty->assign("BLOCKS", getBlocks("Accounts","detail_view",'',$focus->column_fields));
$smarty->assign("UPDATEINFO",updateInfo($focus->id));

//$smarty->assign("CUSTOMFIELD", $cust_fld);
$smarty->assign("ID", $_REQUEST['record']);
$smarty->assign("SINGLE_MOD",'Account');
$category = getParentTab();
$smarty->assign("CATEGORY",$category);
$description = $focus->column_fields['description'];
$smarty->assign("DESCRIPTION",$description);
$smarty->assign("LBL_HINT",$mod_strings['LBL_HINT']);

//if(useInternalMailer() == 1)
//        $smarty->assign("INT_MAILER","true");
$email_url = getSearchMailUrl($focus->column_fields['email1']);
$smarty->assign("EMAILACCOUNT",$email_url);

if(isPermitted($module,"EditView",$_REQUEST['record']) == 'yes') {
	$smarty->assign("EDIT","permitted");
	$smarty->assign("EDIT_PERMISSION","yes");
} else {
	$smarty->assign("EDIT_PERMISSION","no");
}
if(isPermitted($module,"Create",$_REQUEST['record']) == 'yes')
	$smarty->assign("EDIT_DUPLICATE","permitted");
if(isPermitted($module,"Delete",$_REQUEST['record']) == 'yes')
	$smarty->assign("DELETE","permitted");
$tabid = getTabid("Accounts");
$data = getSplitDBValidationData($focus->tab_name,$tabid);

$smarty->assign("VALIDATION_DATA_FIELDNAME",$data['fieldname']);
$smarty->assign("VALIDATION_DATA_FIELDDATATYPE",$data['datatype']);
$smarty->assign("VALIDATION_DATA_FIELDLABEL",$data['fieldlabel']);




$query = "select * from ec_sfasettings where sfastatus='已启用' and deleted=0 and smownerid='".$current_user->id."' ";
$result = $adb->query($query);
$num_rows = $adb->num_rows($result);
if($num_rows > 0){
		for($i=0;$i<$num_rows;$i++){
			$id = $adb->query_result($result,$i,"sfasettingsid");
			$name = $adb->query_result($result,$i,"sfasettingname");
			$sfa_entries[$id] = $name;			
		}
}
$sfasettingshtml = '';
if(!empty($sfa_entries)){
	foreach($sfa_entries  as $sfa_id => $sfa_name){
		$sfasettingshtml .='<option value="'.$sfa_id.'">'.$sfa_name.'</option>';
	}
}
$smarty->assign("sfasettingshtml", $sfasettingshtml);

$dzsmarr = array("manual"=>"具体事务","sms"=>"发短信","email"=>"发邮件");
$zxztarr = array("成功"=>"s31.png","跳过"=>"s32.png","再次执行"=>"me.png","执行失败"=>"s33.png","未执行"=>"me.png","自动执行中"=>"s34.png",);
$bjztarr = array("正在执行期内"=>"jinxing","过期未执行的"=>"guoqi","正常的"=>"zhengchang");

$query = "select * from ec_sfalists where accountid=".$focus->id." and deleted=0 and smownerid='".$current_user->id."'";
$result = $adb->query($query);
$num_rows = $adb->num_rows($result);
if($num_rows > 0){
	$Sfalists_now = array();
	$Sfalists_over = array();
	while($row = $adb->fetch_array($result)){
		$zxzt = $row['zxzt'];
		$sfalistsid = $row['sfalistsid'];
		$sfasettingsid = $row['sfasettingsid'];
		$sfasettingname = getSfasettingName($sfasettingsid);
		if($zxzt =='中止' || $zxzt =='结束'){
			$Sfalists_over[$sfalistsid] = " <img src=\"themes/softed/images/s1.png\" border=0/> <a href=\"index.php?module=Sfalists&action=DetailView&record=".$sfalistsid."\">".$row['sfalistname']."</a>  (<font color=\"#666666\">".$sfasettingname."</font>)";
		}else{
			$tools = '<a href="#" onclick="openEdit('.$sfalistsid.');return false;"><img src="themes/softed/images/sfaeedit.png" border=0/ >编辑</a>';
			if($zxzt == '未执行'){
				$tools .='  |  <a href="#" onclick="openDel('.$sfalistsid.');return false;"><img src="themes/softed/images/sfaedel.png" border=0 />删除</a>';
			}
			$tools .='   |   <a href="#" onclick="openZhongzhi('.$sfalistsid.');return false;"><img src="themes/softed/images/sfastop.png" border=0 />中止</a>';
			
			$Sfalists_now[$sfalistsid] = " <img src=\"themes/softed/images/s1.png\" border=0/> <a href=\"index.php?module=Sfalists&action=DetailView&record=".$sfalistsid."\">".$row['sfalistname']."</a>  (<font color=\"#666666\">".$sfasettingname."</font>)"."  &nbsp;&nbsp;&nbsp;".$tools;
			
			$Sfalists_now_events = getSfalistEvent($sfalistsid);
			
			foreach($Sfalists_now_events[$sfalistsid] as $id=>$val){
				$ms = $val['sj']."  ".$val['datestart']."  ".$val['dateend']."  ".$dzsmarr[$val['at']];
				
				$today = date("Y-m-d");
				if($today >= $val['datestart'] && $today <= $val['dateend']){
					$bjzt = "正在执行期内";
				}else if($today > $val['dateend'] && ($val['zt'] =='未执行' || $val['zt'] =='再次执行') && $val['dateend'] !='0000-00-00'){
					$bjzt = "过期未执行的";
				}else{
					$bjzt = "正常的";
				}
				
				$sfalist_now_events_list[$sfalistsid][$id] = "<div class=\"".$bjztarr[$bjzt]."\"><li class=\"sfasn\">&nbsp;&nbsp;<a href=\"#\" title=\"".$ms."\" onclick=\"openRunEvent(".$id.");return false;\"><span>".$val['sj']."".$val['sjbz']."[<img src=\"themes/softed/images/".$zxztarr[$val['zt']]."\" border=0/>]</span></a>&nbsp;&nbsp;</li></div>";
			}
			
			
		}
	}
}
//repeat-x scroll 0 -21px transparent;
// url("/images/sfa/sfa_blue.png") no-repeat scroll right -42px transparent;

$smarty->assign("Sfalists_now", $Sfalists_now);
$smarty->assign("Sfalists_now_events", $Sfalists_now_events);
$smarty->assign("sfalist_now_events_list", $sfalist_now_events_list);
$smarty->assign("Sfalists_over", $Sfalists_over);


$query = "select * from ec_sfalogs where logstatus !='未执行' and accountid=".$focus->id." and smownerid='".$current_user->id."' and sfalisteventsid !=0  and (modifiedtime >= '".date("Y-m-d")." 00:00:00' && modifiedtime <= '".date("Y-m-d")." 59:59:59') order by modifiedtime desc";
$result = $adb->query($query);
$num_rows = $adb->num_rows($result);
if($num_rows > 0){
	while($row = $adb->fetch_array($result)){
		$sfalogsid = $row['sfalogsid'];
		$sfalogs[$sfalogsid] = "<img src=\"themes/softed/images/s1.png\" border=0/> &nbsp;&nbsp;[".$row['logstatus']."] &nbsp;&nbsp;<a href=\"#\" onclick=\"openRunEvent(".$row['sfalisteventsid'].");return false;\">".$row['sj']."</a> &nbsp;&nbsp; (执行时间: <font color=\"#666666\">".$row['modifiedtime']."</font>)";
	}
}

$smarty->assign("Sfalogs", $sfalogs);

$check_button = Button_Check($module);
$smarty->assign("CHECK", $check_button);
$smarty->assign("MODULE",$currentModule);

//$dateFilterJs = getNextDateFilterJs();
//$smarty->assign("DATE_FILTER_JS",$dateFilterJs);

if($singlepane_view == 'true')
{
	$related_array = getRelatedLists($currentModule,$focus); 
	$relcount =  count($related_array); 
	$smarty->assign("relcount", $relcount);
	$smarty->assign("RELATEDLISTS", $related_array);
}
$smarty->assign("SinglePane_View", $singlepane_view);

$smarty->display("Accounts/DetailView.tpl");

function getSfasettingName($sfasettingsid){
	global $adb;
	$query = "select sfasettingname from ec_sfasettings where sfasettingsid='".$sfasettingsid."' and deleted=0";
	$result = $adb->query($query);
	$num_rows = $adb->num_rows($result);
	if($num_rows > 0){
		$sfasettingname = $adb->query_result($result,0,"sfasettingname");
	}
	return $sfasettingname;
}

function getSfalistEvent($sfalistsid){
	global $adb;
	$query = "select * from ec_sfalistevents where sfalistsid='".$sfalistsid."' order by datestart ";
	$result = $adb->query($query);
	$num_rows = $adb->num_rows($result);
	$arr = array();
	$arr2 = array();
	$arr3 = array();
	if($num_rows > 0){
		for($i=0;$i<$num_rows;$i++){
			$id = $adb->query_result($result,$i,"id");
			$sj = $adb->query_result($result,$i,"sj");
			$sjbz = $adb->query_result($result,$i,"sjbz");
			$datestart = $adb->query_result($result,$i,"datestart");
			$dateend = $adb->query_result($result,$i,"dateend");
			$at = $adb->query_result($result,$i,"at");
			$zt = $adb->query_result($result,$i,"zt");
			
			$arr['sj'] = $sj;
			$arr['sjbz'] = $sjbz;
			$arr['datestart'] = $datestart;
			$arr['dateend'] = $dateend;
			$arr['at'] = $at;
			$arr['zt'] = $zt;
			$arr2[$id] = $arr;
		}
		$arr3[$sfalistsid]  = $arr2;
	}
	return $arr3;	
}
?>
