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

if (substr(phpversion(), 0, 1) == "5") {
        ini_set("zend.ze1_compatibility_mode", "1");
}

require_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('modules/Accounts/Accounts.php');
require_once('modules/Notes/Notes.php');
require_once('modules/Users/Users.php');
require_once('modules/Products/Products.php');
require_once('include/utils/UserInfoUtil.php');
require_once('modules/CustomView/CustomView.php');

global $allow_exports;


/**Function convert line breaks to space in description during export 
 * Pram $str - text
 * retrun type string
*/
function br2nl_vt($str) 
{
	global $log;
	$log->debug("Entering br2nl_vt(".$str.") method ...");
	$str = preg_replace("/(\r\n)/", " ", $str);
	$log->debug("Exiting br2nl_vt method ...");
	return $str;
}

/**This function exports all the data for a given module
 * Param $type - module name
 * Return type text
*/
function export_all($type)
{
	global $log,$list_max_entries_per_page;
	$log->debug("Entering export_all(".$type.") method ...");
	global $adb;

	$focus = 0;
	$content = '';

	if ($type != "")
	{
		//changed by dingjianting on 2009-2-15 for supporting new module
		require_once("modules/$type/$type.php");
		$focus = new $type;
	}

	$log = LoggerManager::getLogger('export_'.$type);
	$where = '';
	/*

	if ( isset($_REQUEST['all']) )
	{
		$where = '';
	}
	else
	{
		$where = $_SESSION['export_where'];
	}
	*/
	if(!isset($_REQUEST['allids']) || $_REQUEST['allids'] == "") {
		$where = "";
	} else {
		$allids = str_replace(";",",",$_REQUEST['allids']);
		$allids =  substr($allids,0,-1);
		$where = $crmid." in (".$allids.")";
	}

	$search_type = $_REQUEST['search_type'];
    $export_data = $_REQUEST['export_data'];
	$viewname = $_REQUEST['viewname'];
	$entityArr = getEntityTable($type);
	$ec_crmentity = $entityArr["tablename"];
	$entityidfield = $entityArr["entityidfield"];
	$crmid = $ec_crmentity.".".$entityidfield;

	$order_by = "";

	$query = $focus->create_export_query($order_by,$where);

	if(isset($_SESSION['export_where']) && $_SESSION['export_where']!='' && $search_type == 'includesearch')
	{
		$where = $_SESSION['export_where'];
		$query .= ' and  ('.$where.') ';
	}

	if(($search_type == 'withoutsearch' || $search_type == 'includesearch') && $export_data == 'selecteddata')
	{
		$idstring = str_replace(";",",",$_REQUEST['idstring']);
		$idstring =  substr($idstring,0,-1);
		if($idstring != "") {
			$query .= ' and '.$crmid.' in ('.$idstring.')';
		}
	}
	if($export_data == 'vieweddata' && $viewname != "" && $viewname != 0)
	{
		$oCustomView = new CustomView($type);
		if($type == "SalesOrder" || $type == "PurchaseOrder") {
			$query = $oCustomView->getExportModifiedCvListQuery($viewname,$query,$type,true);//getModifiedCvListQuery
		} else {
			$query = $oCustomView->getExportModifiedCvListQuery($viewname,$query,$type,false);//getModifiedCvListQuery
		}
	}
	
	

	if(isset($_SESSION['nav_start']) && $_SESSION['nav_start'] != '' && $export_data == 'currentpage')
	{
		$start_rec = $_SESSION['nav_start'];
		$limit_start_rec = ($start_rec == 0) ? 0 : ($start_rec - 1);
		$query_order_by = $crmid;
		$sorder = "desc";
		$result = $adb->limitQuery2($query,$limit_start_rec,$list_max_entries_per_page,$query_order_by,$sorder);
	} else {	
		$query .= " order by ".$crmid." desc";
		$result = $adb->query($query,true,"Error exporting $type: "."<BR>$query");
	}
	$numRows = $adb->num_rows($result);

	$fields_array = $adb->getFieldsArray($result);
	global $current_language;
	$spec_mod_strings = return_specified_module_language($current_language,$type);
	foreach($fields_array as $key=>$fieldlabel) {
		if(isset($spec_mod_strings[$fieldlabel])) {
			$fields_array[$key] = $spec_mod_strings[$fieldlabel];
		}
	}
	

	$header = implode("\",\"",array_values($fields_array));
	$header = "\"" .$header;
	$header .= "\"\r\n";
	$content .= $header;

	$column_list = implode(",",array_values($fields_array));

    while($val = $adb->fetchByAssoc($result, -1, false))
	{
		$new_arr = array();

		foreach ($val as $key => $value)
		{
			if($key=="description")
			{
				$value=br2nl_vt($value);
			}
			array_push($new_arr, preg_replace("/\"/","\"\"",$value));
		}
		$line = implode("\",\"",$new_arr);
		$line = "\"" .$line;
		$line .= "\"\r\n";
		$content .= $line;
	}
	$log->debug("Exiting export_all method ...");
	return $content;
	
}

$content = export_all($_REQUEST['module']);

ob_clean();
header("Pragma: cache");
header("Content-type: application/octet-stream; charset=GBK");
header("Content-Disposition: attachment; filename={$_REQUEST['module']}.csv");
header("Content-transfer-encoding: binary");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header("Cache-Control: post-check=0, pre-check=0", false );
header("Content-Length: ".strlen($content));
$content = iconv_ec("UTF-8","GBK",$content);
print $content;

exit;
?>
