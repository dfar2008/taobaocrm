<?php
require_once("config.php");
require_once("include/utils/utils.php");
require_once('include/database/PearDatabase.php');
global $mod_strings;
global $app_strings;
global $adb;
global $current_user;

if($_REQUEST['startdate'] && !empty($_REQUEST['startdate'])){
	$startdate = $_REQUEST['startdate'];
}
if($startdate && !empty($startdate)){
	$where .= "and ec_salesorder.trade_created > '{$startdate} 00:00:00' ";
}
if($_REQUEST['enddate'] && !empty($_REQUEST['enddate'])){
	$enddate = $_REQUEST['enddate'];		
}
if($enddate && !empty($enddate)){
	$where .= "and ec_salesorder.trade_created < '{$enddate} 23:59:59' ";
}
//统计类型
$reporttyp = "salestotal";
if(isset($_REQUEST["reporttyp"]) && $_REQUEST["reporttyp"] != "") {
	$reporttyp = $_REQUEST["reporttyp"];
	$findurlstr .= "&reporttyp=".$_REQUEST["reporttyp"];
}
$reporttypsqlarr = array(
	"salestotal"=>"sum(ec_salesorder.payment) as groupnum",
	"salesnum"=>"count(ec_salesorder.salesorderid) as groupnum",
	"salesacc"=>"count(ec_salesorder.accountid) as groupnum",
	"salesprod"=>"sum(ec_inventoryproductrel.quantity) as groupnum",
	"salesprice"=>"sum(ec_salesorder.payment) as totalsum,count(ec_salesorder.accountid) as acctnum"
);
$reporttypsql = $reporttypsqlarr[$reporttyp];
$order = "ec_salesorder.trade_created";$desc = 'asc';
$grouptype = 'day';
if($_REQUEST['grouptype'] && !empty($_REQUEST['grouptype'])){
	$grouptype = $_REQUEST['grouptype'];
	$findurlstr .= "&grouptype=".$_REQUEST["grouptype"];
}
//$startarr = split("-",$startdate);
//$groupdatearr = array(
//	"day"=>"".db_convert("ec_salesorder.modifiedtime",'date_format',array("'%Y-%m-%d'"),array("'{$startarr[0]}'-'{$startarr[1]}'-DD"))."",
//	"week"=>"DATE_FORMAT(ec_salesorder.modifiedtime, '%x %v')",
//	"month"=>"".db_convert('ec_salesorder.modifiedtime','date_format',array("'%Y-%m'"),array("'{$startarr[0]}-MM'"))."",
//	"year"=>"".db_convert("ec_salesorder.modifiedtime",'date_format',array("'%Y'"),array("'{$startarr[0]}'")).""
//);
////统计类型
//$grouptype = 'day';
//if($_REQUEST['grouptype'] && !empty($_REQUEST['grouptype'])){
//	$grouptype = $_REQUEST['grouptype'];
//}
//$groupsql = $groupdatearr[$grouptype];
$groupsql = "DATE_FORMAT(ec_salesorder.modifiedtime,'%H')";
$query = "select {$groupsql} as groupdate,{$reporttypsql} 
				from ec_salesorder ";
if($reporttyp == 'salesprod'){
	$query .= "inner join ec_inventoryproductrel
					on ec_inventoryproductrel.id = ec_salesorder.salesorderid ";	
}
$query .= "where ec_salesorder.deleted = 0 ";
if($where && !empty($where)){
	$query .= $where;	
}
$query .= "group by {$groupsql} ";
$query .= "order by {$order} {$desc} ";

$result = $adb->query($query);
$num_rows = $adb->num_rows($result);
$reportData .= "\"序号\"";
$reportData .= ",\"统计时间\"";
$reportData .= ",\"统计结果\"";
$reportData .= "\r\n";
if($num_rows && $num_rows > 0){
	$for_i = 1;
	while($row = $adb->fetch_array($result)){
		$reportData .= "\"".$for_i."\"";
		$reportData .= ",\"".$row['groupdate']."\"";
		if($reporttyp == 'salesprice'){
			$totalsum = $row['totalsum'];$acctnum = $row['acctnum'];
			$salesrate = sprintf("%.2f",($totalsum/$acctnum));			
		}else{
			$salesrate = $row['groupnum'];
		}
		$reportData .= ",\"".$salesrate."\"";
		$reportData .= "\r\n";
		$sumtotalcols += $row['groupnum'];
		$for_i ++;
	}
}

$reportData .= "\"\",\"小计\"";
$reportData .= ",\"".$sumtotalcols."\"";
$reportData .= "\r\n";

ob_clean();
header("Pragma: cache");
header("Content-type: application/octet-stream; charset=GBK");
header("Content-Disposition: attachment; filename={$_REQUEST['module']}.csv");
header("Content-transfer-encoding: binary");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header("Cache-Control: post-check=0, pre-check=0", false );
header("Content-Length: ".strlen($reportData));
$reportData = iconv_ec("UTF-8","GBK",$reportData);
print $reportData;

exit;
	
?>