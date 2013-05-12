<?php
require_once('modules/Products/Products.php');
global $adb;
global $app_strings;
global $current_user;
//$adb->startTransaction();
$productname = $_REQUEST['productname'];
//$productcode = $_REQUEST['productcode'];
$price = $_REQUEST['price'];
//$catalogname = $_REQUEST['catalogname'];
//$catalogid = $_REQUEST['catalogid'];
$num = $_REQUEST['num'];

$focus = new Products();
$focus->column_fields["productname"] = $productname;
require_once('user_privileges/seqprefix_config.php');
$focus->column_fields['productcode'] = $product_seqprefix.$focus->get_next_id();
//$focus->column_fields["productcode"] = $productcode;
$focus->column_fields["price"] = $price;
$focus->column_fields["num"] = $num;
$focus->id = "";
$focus->mode = "";
$focus->save("Products");
$return_id = $focus->id;
echo $return_id;
die;
?>
