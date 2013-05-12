<?php
require_once('config.inc.php');
require_once('include/utils/utils.php');
require_once('include/database/PearDatabase.php');
global $adb,$current_user;

$today = date("Y-m-d");

$oneweek = date("Y-m-d",strtotime("-1 week"))." 00:00:00";

$onemonth = date("Y-m-d",strtotime("-1 month"))." 00:00:00";

$threemonth = date("Y-m-d",strtotime("-3 month"))." 00:00:00";


$query = "select accountid from ec_account where deleted=0 and smownerid='".$current_user->id."'";
$result = $adb->query($query);
$nums = $adb->num_rows($result);
if($nums > 0){
	for($i=0;$i<$nums;$i++){
		$accountid = $adb->query_result($result,$i,'accountid');
		
		$query1 = "select count(*) as num from ec_salesorder where accountid=$accountid and createdtime  > '$oneweek'";
		
		$result1 = $adb->query($query1);
		$row1 = $adb->fetch_array($result1);
		$oneweekbuynum = $row1['num'];
		
		$query2 = "select count(*) as num from ec_salesorder where accountid=$accountid and createdtime  > '$onemonth'";
		$result2 = $adb->query($query2);
		$row2 = $adb->fetch_array($result2);
		$onemonthbuynum = $row2['num'];
		
		$query3 = "select count(*) as num from ec_salesorder where accountid=$accountid and createdtime  > '$threemonth'";
		$result3 = $adb->query($query3);
		$row3 = $adb->fetch_array($result3);
		$threemonthbuynum = $row3['num'];
		
		$updatesql = "update ec_account set oneweekbuy=$oneweekbuynum,onemonthbuy=$onemonthbuynum,threemonthbuy=$threemonthbuynum where accountid=$accountid";
		
		$adb->query($updatesql);		
	}
}


?>