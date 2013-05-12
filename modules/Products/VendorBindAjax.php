<?php
require_once("include/Zend/Json.php");
global $adb;
$query_vendor = "select vendorid,vendorname from ec_vendor where deleted=0 order by ec_vendor.vdgrade desc ";
$result = $adb->query($query_vendor);
if($adb->num_rows($result)){
	$vendor = array();
	while($rows = $adb->fetch_array($result)){
		$vendor[] = $rows;	
	}
	$json = new Zend_Json();
	$jsonvendor = $json->encode($vendor);
	echo $jsonvendor;
}else{
	echo "error";
}
die;
?>