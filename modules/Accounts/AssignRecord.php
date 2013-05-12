<?php
require_once('data/Tracker.php');
require_once('include/utils/utils.php');
require_once('include/database/PearDatabase.php');
require_once('modules/Pools/PoolUtils.php');

global $mod_strings,$app_strings,$log,$current_user,$theme;

$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

if(isset($_REQUEST['record']))
{
	$id = $_REQUEST['record'];
}

$module = $_REQUEST['module'];
$category = getParentTab();
$dateFilterHtml = getNextDateFilterHtml();
//$dateFilterJs = getNextDateFilterJs();

//Retreiving the current user id
$AssignRecord = '
    <form name="assignrecordform" method="POST" action="index.php">
	<input type="hidden" name="module" value="'.$module.'">
	<input type="hidden" name="record" value="'.$id.'">
	<input type="hidden" name="action" value="SaveAssign">
	<input type="hidden" name="assignuserids" value="">
	<input type="hidden" name="parenttab" value="'.$category.'">

	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="layerHeadingULine">
		<tr style="cursor:move;">
			<td width="99%" id="assignrecord_div_title" class="layerPopupHeading"  nowrap align="left">'.$app_strings['LBL_ASSIGN_BUTTON_LABEL'].'</td>
			<td align="right"><a href="javascript:fninvsh(\'assignrecorddiv\');"><img src="'.$image_path.'close.gif" align="absmiddle" border="0"></a></td>
		</tr>
		</table>';
$AssignRecord .= '<table border=0 celspacing=0 cellpadding=5 width=100% align=center>
			    <tr>
					<td width="35%" class="dvtCellLabel"><b>选择时间段：</b></td>					
					<td width="65%" class="dvtCellInfo"><select name="stdDateFilter" style="WIDTH: 150px" class="select" onchange=\'showDateRange_jscal_field(this.options[this.selectedIndex].value )\'>'.$dateFilterHtml.'</select></td>
				</tr>
				<tr>
					<td width="35%" class="dvtCellLabel"><b>保护开始日期：</b></td>					
					<td width="65%" class="dvtCellInfo"><input name="startdate" id="jscal_field_date_start" type="text" size="12" class="importBox" style="width:80px;" value=""><img src="themes/softed/images/calendar.gif" id="jscal_trigger_date_start"></td>
				</tr>
				<tr>
					<td width="35%" class="dvtCellLabel"><b>保护结束日期：</b></td>					
					<td width="65%" class="dvtCellInfo"><input name="enddate" id="jscal_field_date_end" type="text" size="12" class="importBox" style="width:80px;" value=""><img src="themes/softed/images/calendar.gif" id="jscal_trigger_date_end"></td>
				</tr>
			</table>';	

				

$AssignRecord .='
	<table border=0 cellspacing=0 cellpadding=5 width=100% class="layerPopupTransport">
	<tr>
			<td align="center">
				<input name="Save" value=" '.$app_strings['LBL_SAVE_BUTTON_LABEL'].' " type="submit"  class="crmbutton save small">&nbsp;&nbsp;
				<input type="button" name=" Cancel " value=" '.$app_strings['LBL_CANCEL_BUTTON_LABEL'].' " onClick="fninvsh(\'assignrecorddiv\')" class="crmbutton cancel small">
			</td>
		</tr>
	</table></form>';
echo $AssignRecord;
//echo $dateFilterJs;

?>
