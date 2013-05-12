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


require_once('include/utils/UserInfoUtil.php');
require_once("include/utils/utils.php");
require_once("include/ListView/ListViewSession.php");

/** Function to get related list entries in detailed array format
  * @param $module -- modulename:: Type string
  * @param $relatedmodule -- relatedmodule:: Type string
  * @param $focus -- focus:: Type object
  * @param $query -- query:: Type string
  * @param $button -- buttons:: Type string
  * @param $returnset -- returnset:: Type string
  * @param $id -- id:: Type string
  * @param $edit_val -- edit value:: Type string
  * @param $del_val -- delete value:: Type string
  * @returns $related_entries -- related entires:: Type string array
  *
  */

function GetRelatedList($module,$relatedmodule,$focus,$query,$button,$returnset,$id='',$edit_val='',$del_val='')
{   
	global $log;
	//changed by dingjianting on 2007-11-05 for php5.2.x
	$log->debug("Entering GetRelatedList() method ...");
	require_once('include/CRMSmarty.php');
	require_once('include/DatabaseUtil.php');

	global $adb;
	global $app_strings;
	global $current_language;
	$current_module_strings = return_module_language($current_language, $module);
	global $list_max_entries_per_page;
	global $urlPrefix;
	global $currentModule;
	global $theme;
	global $theme_path;
	global $mod_strings;
	// focus_list is the means of passing data to a ListView.
	global $focus_list;
	$smarty = new CRMSmarty();
	if (!isset($where)) $where = "";
	$theme_path="themes/".$theme."/";
	$image_path=$theme_path."images/";
	$smarty->assign("MOD", $mod_strings);
	$smarty->assign("APP", $app_strings);
	$smarty->assign("IMAGE_PATH",$image_path);
	$smarty->assign("MODULE",$relatedmodule);
	if(isset($where) && $where != '')
	{
		$query .= ' and '.$where;
	}
	/*
	if(!isset($_SESSION['rlvs'][$module][$relatedmodule]) || !$_SESSION['rlvs'][$module][$relatedmodule])
	{
		$modObj = new ListViewSession();
		$modObj->sortby = $focus->default_order_by;
		$modObj->sorder = $focus->default_sort_order;
		$_SESSION['rlvs'][$module][$relatedmodule] = get_object_vars($modObj);
	}
	*/
	
	if(empty($order_by))
	{
		$order_by = $focus->default_order_by;		
	}
	if(empty($sorder))
	{
		$sorder = $focus->default_sort_order;
	}
	$url_qry = "&order_by=".$order_by;	
	
	$count_query = mkCountQuery($query);
	
	$count_result = $adb->query($count_query);
	$noofrows = $adb->query_result($count_result,0,"count");
	
	//Setting Listview session object while sorting/pagination
	if(isset($_REQUEST['relmodule']) && $_REQUEST['relmodule']!='' && $_REQUEST['relmodule'] == $relatedmodule)
	{
		if(isset($_REQUEST['start']) && $_REQUEST['start'] != '')
		{
			$start = $_REQUEST['start'];
		} else {
			$start = 1;
		}
	} else {
		$start = 1;
	}
	
	$navigation_array = getNavigationValues($start, $noofrows, $list_max_entries_per_page);
	$start_rec = $navigation_array['start'];
	$end_rec = $navigation_array['end_val'];


	//limiting the query
	if ($start_rec <= 0) 
		$limit_start_rec = 0;
	else
		$limit_start_rec = $start_rec -1;
	
	$list_result = $adb->limitQuery2($query,$limit_start_rec,$list_max_entries_per_page,$order_by,$sorder);

	//Retreive the List View Table Header
	if($noofrows == 0)
	{
		$smarty->assign('NOENTRIES',$app_strings['LBL_NONE_SCHEDULED']);
	}
	else
	{

		setRelmodFieldList($relatedmodule,$focus);//set more module field
		$id = $_REQUEST['record'];
		$listview_header = getListViewHeader($focus,$relatedmodule,'',$sorder,$order_by,$id,'',$module);//"Accounts"); 
		
		if ($noofrows > 15)
		{
			$smarty->assign('SCROLLSTART','<div style="overflow:auto;height:315px;width:100%;">');
			$smarty->assign('SCROLLSTOP','</div>');
		}
		$smarty->assign("LISTHEADER", $listview_header);
				
		if($module == 'PriceBook' && $relatedmodule == 'Products')
		{
			$listview_entries = getListViewEntries($focus,$relatedmodule,$list_result,$navigation_array,'relatedlist',$returnset,$edit_val,$del_val);
		}
		if($module == 'Products' && $relatedmodule == 'PriceBook')
		{
			$listview_entries = getListViewEntries($focus,$relatedmodule,$list_result,$navigation_array,'relatedlist',$returnset,'EditListPrice','DeletePriceBookProductRel');
		}
		elseif($relatedmodule == 'SalesOrder')
		{
			$listview_entries = getListViewEntries($focus,$relatedmodule,$list_result,$navigation_array,'relatedlist',$returnset,'SalesOrderEditView','DeleteSalesOrder');
		}else
		{   
			$listview_entries = getListViewEntries($focus,$relatedmodule,$list_result,$navigation_array,'relatedlist',$returnset);
			
			
		}

		$navigationOutput = Array();
		$navigationOutput[] = $app_strings['LBL_SHOWING']." " .$start_rec." - ".$end_rec." " .$app_strings['LBL_LIST_OF'] ." ".$noofrows;
		$module_rel = $module.'&relmodule='.$relatedmodule.'&record='.$id;
		$navigationOutput[] = getRelatedTableHeaderNavigation($navigation_array, $url_qry,$module_rel);
		$related_entries = array('header'=>$listview_header,'entries'=>$listview_entries,'navigation'=>$navigationOutput);
		$log->debug("Exiting GetRelatedList method ...");
		return $related_entries;
	}
}


/** Function to get related list entries in detailed array format
  * @param $parentmodule -- parentmodulename:: Type string
  * @param $query -- query:: Type string
  * @param $id -- id:: Type string
  * @returns $entries_list -- entries list:: Type string array
  * ALTER TABLE `ec_attachments` ADD `setype` VARCHAR( 50 ) NOT NULL ,
ADD `smcreatorid` INT( 10 ) NOT NULL ,
ADD `createdtime` DATETIME NOT NULL ,
ADD `deleted` INT( 1 ) NULL DEFAULT '0';
  */

function getAttachments($parentmodule,$query,$id,$sid='')
{	
	global $log;
	global $app_strings;
	$log->debug("Entering getAttachments() method ...");
	global $theme;
	$entries_list = array();
	$return_data = array();

	$theme_path="themes/".$theme."/";
	$image_path=$theme_path."images/";
	require_once ($theme_path."layout_utils.php");

	global $adb;
	global $mod_strings;
	global $app_strings;
	global $current_user;

	$result=$adb->query($query);
	$noofrows = $adb->num_rows($result);

	$header[] = $app_strings['LBL_CREATED_TIME'];
	$header[] = $app_strings['LBL_ATTACHMENTS'];
	$header[] = $app_strings['LBL_DESCRIPTION'];
	$header[] = $app_strings['Assigned To'];
	

	while($row = $adb->fetch_array($result))
	{
		$entries = Array();
		
		$module = 'uploads';
		$editaction = 'upload';
		$deleteaction = 'deleteattachments';
		
		if(isValidDate($row['createdtime'],'0000-00-00'))
		{
			$created_arr = explode(" ",$row['createdtime']);
			$created_date = $created_arr[0];
			$created_time = substr($created_arr[1],0,5);
		}
		else
		{
			$created_date = '';
			$created_time = '';
		}

		$entries[] = $created_date;
		
		//$attachmentname = ltrim($row['filename'],$row['attachmentsid'].'_');//explode('_',$row['filename'],2);
		//changed by dingjianting on 2008-09-16 for attachment with number name posted by pushi
		$attachmentname = trim($row['name']);//explode('_',$row['filename'],2);

		$entries[] = '<a href="index.php?module=uploads&action=downloadfile&entityid='.$id.'&fileid='.$row['attachmentsid'].'">'.$attachmentname.'</a>';
		/*
		if(strlen($row['description']) > 40)
		{
			$row['description'] = substr($row['description'],0,40).'...';
		}
		*/
		$entries[] = nl2br($row['description']); 
		$entries[] = $row['user_name']; 
		$setype = $row['setype']; 
	    
		

	    if($current_user->column_fields['user_name'] == $row['user_name'] || is_admin($current_user)) {
			$del_param = 'index.php?module='.$module.'&action='.$deleteaction.'&return_module='.$setype.'&return_action='.$_REQUEST['action'].'&record='.$row["attachmentsid"].'&return_id='.$_REQUEST["record"];			
			if($setype == 'Maillists'){
				$entries[] = '';
			    $header[]  = '';
			}else{
				$header[] = $app_strings['LBL_ACTION'];	
				$entries[] = '<a href=\'javascript:confirmdelete("'.$del_param.'")\'>'.$app_strings['LNK_DELETE'].'</a>';
			}
		} else {
			$entries[] = '&nbsp;';
		}
		$entries_list[] = $entries;
	}
	
	if($entries_list != '')
		$return_data = array('header'=>$header,'entries'=>$entries_list);
	$log->debug("Exiting getAttachments method ...");
	return $return_data;

}

/**	Function to display the Products which are related to the PriceBook
 *	@param string $query - query to get the list of products which are related to the current PriceBook
 *	@param object $focus - PriceBook object which contains all the information of the current PriceBook
 *	@param string $returnset - return_module, return_action and return_id which are sequenced with & to pass to the URL which is optional
 *	return array $return_data which will be formed like array('header'=>$header,'entries'=>$entries_list) where as $header contains all the header columns and $entries_list will contain all the Product entries
 */
function getPriceBookRelatedProducts($query,$focus,$returnset='',$startnum=0,$orderby,$sorder)
{
	global $log;
	//changed by dingjianting on 2007-11-05 for php5.2.x
	$log->debug("Entering getPriceBookRelatedProducts() method ...");

	global $adb;
	global $app_strings;
	global $mod_strings;
	global $current_language;
	$current_module_strings = return_module_language($current_language, 'PriceBook');

	global $list_max_entries_per_page;
	global $urlPrefix;

	global $theme;
	$pricebook_id = $_REQUEST['record'];
	$theme_path="themes/".$theme."/";
	$image_path=$theme_path."images/";
	require_once($theme_path.'layout_utils.php');

	//Retreive the list from Database
	$list_result = $adb->query($query);
	$list_result = $adb->limitQuery2($query,$startnum,$list_max_entries_per_page,$orderby,$sorder);

	$num_rows = $adb->num_rows($list_result);

	$header=array();
	$header[]=$mod_strings['LBL_LIST_PRODUCT_NAME'];
	$header[]=$mod_strings['LBL_PRODUCT_CODE'];
	$header[]=$mod_strings['LBL_PRODUCT_SERIALNO'];
	$header[]=$mod_strings['LBL_PRODUCT_UNIT_PRICE'];
	$header[]=$mod_strings['LBL_PB_LIST_PRICE'];
	$header[]=$mod_strings['LBL_ACTION'];
	$isEdit = isPermitted("PriceBooks","EditView");
	$isDel = isPermitted("PriceBooks","Delete");

	for($i=0; $i<$num_rows; $i++)
	{
		$entity_id = $adb->query_result($list_result,$i,"crmid");

		$unit_price = 	$adb->query_result($list_result,$i,"unit_price");
		$listprice = $adb->query_result($list_result,$i,"listprice");
		$field_name=$entity_id."_listprice";
		
		$entries = Array();
		$productname = $adb->query_result($list_result,$i,"productname");

		$entries[] = '<a href="index.php?module=Products&action=DetailView&record='.$entity_id.'">'.$productname.'</a>';
		$entries[] = $adb->query_result($list_result,$i,"productcode");
		$entries[] = $adb->query_result($list_result,$i,"serialno");
		$entries[] = $unit_price;
		$entries[] = $listprice;
		//changed by dingjianting on 2006-12-2 for chinese
		if($isEdit == "yes") {
			$edit_link = '<img style="cursor:pointer;" src="'.$image_path.'editfield.gif" border="0" onClick="fnvshobj(this,\'editlistprice\'),editProductListPrice(\''.$entity_id.'\',\''.$pricebook_id.'\',\''.$listprice.'\')" alt="'.$app_strings["LBL_EDIT_BUTTON"].'" title="'.$app_strings["LBL_EDIT_BUTTON"].'"/>&nbsp;';
		} else {
			$edit_link = '';
		}
		//<!--a href="index.php?module=Products&action=EditListPrice&record='.$entity_id.'&pricebook_id='.$pricebook_id.'&listprice='.$listprice.'">edit</a-->
		if($isDel == "yes") {
			$del_link = '|&nbsp;<img src="'.$image_path.'delete.gif" onclick="if(confirm(\''.$app_strings["Are you sure?"].'\')) deletePriceBookProductRel('.$entity_id.','.$pricebook_id.');" alt="'.$app_strings["LBL_DELETE"].'" title="'.$app_strings["LBL_DELETE"].'" style="cursor:pointer;" border="0">';
		} else {
			$del_link = '';
		}
		$entries[] = $edit_link.$del_link;

		$entries_list[] = $entries;
	}
	if($num_rows>0)
	{
		$return_data = array('header'=>$header,'entries'=>$entries_list);

		$log->debug("Exiting getPriceBookRelatedProducts method ...");
		return $return_data; 
	}
}

//Added for PHP version less than 5
if (!function_exists("stripos"))
{
	function stripos($query,$needle)
	{
		return strpos(strtolower($query),strtolower($needle));
	}
}

?>
