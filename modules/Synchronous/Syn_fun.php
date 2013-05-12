<?php

//获取SessionKey
function getSessionKey($shopid){
	global $adb;
	$arr = array();
	$query = "select * from ec_shops where is_on=1 and shopid='$shopid' ";
	
	$result= $adb->query($query);
	$num = $adb->num_rows($result);
	if($num ==1){
		$appkey = $adb->query_result($result,0,'appkey');
		$appsecret = $adb->query_result($result,0,'appsecret');
		$sessionkey = $adb->query_result($result,0,'sessionkey');
		$arr[] = $appkey;
		$arr[] = $appsecret;
		$arr[] = $sessionkey;	
	}
	return $arr;
}

function getShopsInfo(){
	global $adb;
	$query = "select * from ec_shops where is_on=1";
	$result= $adb->query($query);
	$num = $adb->num_rows($result);
	$shoparr = array();
	if($num > 0){
		for($i=0;$i<$num;$i++){
			$entries = array();
			$shopid_tmp = $adb->query_result($result,$i,'shopid');
			$shopname = $adb->query_result($result,$i,'shopname');
			$entries[] = $shopid_tmp;
			$entries[] = $shopname;
			$shoparr[] = $entries;
		}
	}
	return $shoparr;
}
//获取订单总数
function getTaobaoOrderCount($rooturl,$session,$appKey,$appSecret,$start_created,$end_created){
	$fields = 'buyer_nick';
	$extra = array();
	
	if(!empty($start_created) && !empty($end_created)){
			$extra = array('start_created'=>$start_created,'end_created'=>$end_created);
	}
	$resultcount = getArrayCount('taobao.trades.sold.get',$rooturl,$session,$appKey,$appSecret,$fields,$extra);
	return $resultcount;
}
//获取淘宝订单信息
function getTaobaoOrderInfo($rooturl,$session,$appKey,$appSecret,$page_no,$page_size,$start_created,$end_created){
	$fields = 'tid';
	$trades = array();
	for($i=1;$i<=$page_no;$i++){ 
		if(!empty($start_created) && !empty($end_created)){
			$extra = array('page_no'=>$i,'page_size'=>$page_size,'start_created'=>$start_created,'end_created'=>$end_created);
		}else{
			$extra = array('page_no'=>$i,'page_size'=>$page_size);
		}
		
		$trades[$i-1] = getArrayResult('taobao.trades.sold.get',$rooturl,$session,$appKey,$appSecret,$fields,'trade','s',$extra);
	}
	return $trades;
	
}//receiver_name,receiver_address,receiver_mobile,receiver_phone,buyer_email,
//获取淘宝订单以外的交易信息
function getTaobaoTradeInfo($rooturl,$session,$appKey,$appSecret,$tid){
	//changed by xiaoyang on 2012-09-20  淘宝改变有些字段没有权限获得了receiver_name,receiver_address,receiver_mobile,receiver_phone,buyer_email,buyer_alipay_no
	//$fields = 'buyer_nick,title,type,created,tid,seller_rate,buyer_rate,status,post_fee,pay_time,consign_time,received_payment,shipping_type,receiver_name,receiver_state,receiver_city,receiver_district,receiver_address,receiver_zip,receiver_mobile,receiver_phone,buyer_email,buyer_alipay_no,trade_memo,orders,buyer_message,buyer_memo,express_agency_fee,invoice_name,seller_name,promotion_details'; 
	$fields = 'buyer_nick,title,type,created,tid,seller_rate,buyer_rate,status,post_fee,pay_time,consign_time,received_payment,shipping_type,receiver_state,receiver_city,receiver_district,receiver_zip,trade_memo,orders,buyer_message,buyer_memo,express_agency_fee,invoice_name,seller_name,promotion_details'; 
	$extra = array('tid'=>$tid);

	$trade = getArrayResult('taobao.trade.fullinfo.get',$rooturl,$session,$appKey,$appSecret,$fields,'trade','',$extra);
	
	if(!empty($trade)){
		$orders = $trade['orders']['order'];
		$orders_0 = $trade['orders']['order'][0];
		if(!is_array($orders_0)){
			unset($trade['orders']['order']);
			$trade['orders']['order'][0] = $orders;
		}
	}
	
	return $trade;
}


//获取交易物流信息
function getLogisticsOrderWlInfo($rooturl,$session,$appKey,$appSecret,$tid){
	$extra = array('tid' => $tid);
	$fields = 'order_code,company_name';
	$trade_amount = getArrayResult('taobao.logistics.orders.detail.get',$rooturl,$session,$appKey,$appSecret,$fields,'shipping','s',$extra);
	
	return $trade_amount;
}
//获取订单客户信息
function getAccountInfo($rooturl,$session,$appKey,$appSecret,$buyer_nick){
	$extra = array('nick' => $buyer_nick);
	$fields = 'user_id,uid,nick,buyer_credit,seller_credit,created,last_visit,type,vip_info';
	$user = getArrayResult('taobao.user.get',$rooturl,$session,$appKey,$appSecret,$fields,'user','',$extra);
	return $user;
}


//获取订单产品信息
function getProductInfo($rooturl,$session,$appKey,$appSecret,$num_iid){
	if($num_iid && $num_iid !=''){
		$fields = 'detail_url,num_iid,title,cid,num,price,modified,created';
		$extra = array('num_iid' => $num_iid);
		$items = getArrayResult('taobao.item.get',$rooturl,$session,$appKey,$appSecret,$fields,'item','',$extra);
		return $items;
	}else{
		return array();
	}
}
//判断交易信息是否已存在
function checkTradeIsExist($tid){
	global $adb;
	global $current_user;
	$return  = true;
	$query = "select tid from ec_salesorder where  deleted=0 and smownerid='".$current_user->id."' and tid='$tid' ";
	$rst = $adb->query($query);
	$num = $adb->num_rows($rst);
	if($num > 0){
		$return = false;
	}
	return $return;
}

//判断订单信息是否已存在
function checkOrderIsExist($oid){
	global $adb;
	global $current_user;
	$return  = true;
	$query = "select oid from ec_salesorder where deleted=0 and smownerid='".$current_user->id."' and  oid='$oid'";
	$rst = $adb->query($query);
	$num = $adb->num_rows($rst);
	if($num > 0){
		$return = false;
	}
	return $return;
}


//根据昵称判断客户是否已存在
function checkAccountIsExist($nick){
	global $adb;
	global $current_user;
	$accountid = '';
	$query = "select accountid from ec_account where deleted=0 and smownerid='".$current_user->id."' and  membername='".$nick."' limit 0,1";
	$rst = $adb->query($query);
	$num = $adb->num_rows($rst);
	if($num > 0){
		$row = $adb->fetch_array($rst);
		$accountid = $row['accountid'];
	}
	return $accountid;
}


//判断产品是否已存在
function checkItemIsExist($num_iid){
	global $current_user;
	global $adb;
	$productid = '';
	if(!empty($num_iid)){
		$query = "select productid from ec_products where deleted=0 and smownerid='".$current_user->id."' and num_iid='$num_iid'";
		$rst = $adb->query($query);
		$num = $adb->num_rows($rst);
		if($num > 0){
			$productid = $adb->query_result($rst,0,'productid');
		}
		return $productid;
	}else{
		return '';
	}
}

//获取信用级别对应的中文
function getHuangGuanInfo($no){
	$return = '';
	if($no == '1'){
		$return = "1心";
	}elseif($no == '2'){
		$return = "2心";
	}elseif($no == '3'){
		$return = "3心";
	}elseif($no == '4'){
		$return = "4心";
	}elseif($no == '5'){
		$return = "5心";
	}elseif($no == '6'){
		$return = "1钻";
	}elseif($no == '7'){
		$return = "2钻";
	}elseif($no == '8'){
		$return = "3钻";
	}elseif($no == '9'){
		$return = "4钻";
	}elseif($no == '10'){
		$return = "5钻";
	}elseif($no == '11'){
		$return = "1蓝冠";
	}elseif($no == '12'){
		$return = "2蓝冠";
	}elseif($no == '13'){
		$return = "3蓝冠";
	}elseif($no == '14'){
		$return = "4蓝冠";
	}elseif($no == '15'){
		$return = "5蓝冠";
	}elseif($no == '16'){
		$return = "1皇冠";
	}elseif($no == '17'){
		$return = "2皇冠";
	}elseif($no == '18'){
		$return = "3皇冠";
	}elseif($no == '19'){
		$return = "4皇冠";
	}elseif($no == '20'){
		$return = "5皇冠";
	}else{
		$return = "无";
	}
	return $return;
}
//获取会员级别对应的中文
function getVipInfo($vipinfo_tmp){
	$vipinfo = '';
	if($vipinfo_tmp =='c' ){
		$vipinfo = "普通会员";
	}elseif($vipinfo_tmp == 'asso_vip'){
		$vipinfo = "荣誉会员";
	}elseif($vipinfo_tmp == 'exp_vip1'){
		$vipinfo = "体验vip会员1级";
	}elseif($vipinfo_tmp =='exp_vip2'){
		$vipinfo = "体验vip会员2级";
	}elseif($vipinfo_tmp =='exp_vip3'){
		$vipinfo = "体验vip会员2级";
	}elseif($vipinfo_tmp =='exp_vip4'){
		$vipinfo = "体验vip会员2级";
	}elseif($vipinfo_tmp =='vip1'){
		$vipinfo = "vip会员1级";
	}elseif($vipinfo_tmp =='vip2'){
		$vipinfo = "vip会员2级";
	}elseif($vipinfo_tmp =='vip3'){
		$vipinfo = "vip会员3级";
	}elseif($vipinfo_tmp =='vip4'){
		$vipinfo = "vip会员4级";
	}else{
		$vipinfo = "普通会员";
	}
	return $vipinfo;
}
//获取订单状态对应的中文
function getOrderStatus($orderstatus_tmp){
	$orderstatus = '';
	if($orderstatus_tmp == 'TRADE_NO_CREATE_PAY'){
		$orderstatus = "未创建支付宝交易";
	}elseif($orderstatus_tmp == 'WAIT_BUYER_PAY'){
		$orderstatus = "等待买家付款";
	}elseif($orderstatus_tmp == 'WAIT_SELLER_SEND_GOODS'){
		$orderstatus = "买家已付款，等待卖家发货";
	}elseif($orderstatus_tmp == 'WAIT_BUYER_CONFIRM_GOODS'){
		$orderstatus = "卖家已发货，等待买家确认";
	}elseif($orderstatus_tmp == 'TRADE_BUYER_SIGNED'){
		$orderstatus = "买家已签收";
	}elseif($orderstatus_tmp == 'TRADE_FINISHED'){
		$orderstatus = "交易成功";
	}elseif($orderstatus_tmp == 'TRADE_CLOSED'){
		$orderstatus = "交易关闭";
	}elseif($orderstatus_tmp == 'TRADE_CLOSED_BY_TAOBAO'){
		$orderstatus = "交易关闭";
	}else{
		$orderstatus ="无";
	}
	return $orderstatus;
}
//获取客户状态对应的中文
function getAccountType($account_type_tmp){ 
	$account_type = '';
	if($account_type_tmp == 'B'){
		$account_type = "B商家";
	}elseif($account_type_tmp == 'C'){
		$account_type = "C商家";
	}elseif($account_type_tmp == 'Other'){
		$account_type = "其它";
	}else{
		$account_type = "无";
	}
	
	return $account_type;
}

//获取配送方式对应的中文
function getShippingType($shipping_type_tmp){
	$shipping_type = '';
	if($shipping_type_tmp == 'ems'){
		$shipping_type = "EMS";
	}elseif($shipping_type_tmp == 'express'){
		$shipping_type = "快递";
	}elseif($shipping_type_tmp == 'post'){
		$shipping_type = "平邮";
	}elseif($shipping_type_tmp == 'free'){
		$shipping_type = "卖家承担运费";
	}elseif($shipping_type_tmp == 'virtual'){
		$shipping_type = "虚拟物品";
	}else{
		$shipping_type = "无";
	}
	return $shipping_type;
}

//获取支付方式对应的中文
function getPayType($pay_type_tmp){
	$pay_type = '';
	if($pay_type_tmp == 'alipay'){
		$pay_type = "支付宝";
	}elseif($pay_type_tmp == 'katong'){
		$pay_type = "支付宝卡通";
	}elseif($pay_type_tmp == 'credit'){
		$pay_type = "信用卡支付";
	}elseif($pay_type_tmp == 'cod'){
		$pay_type = "货到付款";
	}elseif($pay_type_tmp == 'bankcard'){
		$pay_type = "网上银行";
	}else{
		$pay_type = "支付宝";  //默认支付方式是支付宝
	} 
	return $pay_type;
}

//返回 是否存在该TID的订单
function getTidInfo($tid){
	global $adb;
	global $current_user;
	$query = "select tid from ec_salesorder where deleted=0 and smownerid='".$current_user->id."' and  tid='".$tid."'";
	$rst = $adb->query($query);
	$num = $adb->num_rows($rst);
	if($num > 0){
		return false;
	}else{
		return true;
	}
	
}
?>