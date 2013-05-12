<?php
require_once ('include/CRMSmarty.php');
require_once ('data/Tracker.php');
require_once ('include/utils/utils.php');
require_once ('user_privileges/seqprefix_config.php');
require_once ('modules/Synchronous/Synfunction.php');
require_once ('modules/Synchronous/time.php');
require_once ('modules/Synchronous/Syn_fun.php');
require_once ('modules/Synchronous/config.php');
global $adb;
global $current_user;


//执行时间类
$timer = new timer;
$timer->start(); 

$timemessage = '';

$banyue0_begin = date("Y-m-d")." 00:00:00";

$banyue0_end = date("Y-m-d")." 23:59:59";

$banyue1_begin = date("Y-m-d",strtotime("-3 month"))." 00:00:00";

$banyue1_end = date("Y-m-d",strtotime("+15 days",strtotime("-3 month")))." 23:59:59";

$banyue2_begin = date("Y-m-d",strtotime("+16 days",strtotime("-3 month")))." 00:00:00";

$banyue2_end = date("Y-m-d",strtotime("-1 days",strtotime("-2 month")))." 23:59:59";

$banyue3_begin = date("Y-m-d",strtotime("-2 month"))." 00:00:00";

$banyue3_end = date("Y-m-d",strtotime("+15 days",strtotime("-2 month")))." 23:59:59";

$banyue4_begin = date("Y-m-d",strtotime("+16 days",strtotime("-2 month")))." 00:00:00";

$banyue4_end = date("Y-m-d",strtotime("-1 days",strtotime("-1 month")))." 23:59:59";

$banyue5_begin = date("Y-m-d",strtotime("-1 month"))." 00:00:00";

$banyue5_end = date("Y-m-d",strtotime("+15 days",strtotime("-1 month")))." 23:59:59";

$banyue6_begin = date("Y-m-d",strtotime("+16 days",strtotime("-1 month")))." 00:00:00";

$banyue6_end = date("Y-m-d")." 23:59:59";

$banyue7_begin = '';

$banyue7_end = '';

//时间段
$sjdarr= array("0"=>"今天","1"=>"Part1","2"=>"Part2","3"=>"Part3","4"=>"Part4","5"=>"Part5","6"=>"Part6","7"=>"所有");

$banyuekeyarr = array("0"=>array($banyue0_begin,$banyue0_end),
					  "1"=>array($banyue1_begin,$banyue1_end),
					  "2"=>array($banyue2_begin,$banyue2_end),
					  "3"=>array($banyue3_begin,$banyue3_end),
					  "4"=>array($banyue4_begin,$banyue4_end),
					  "5"=>array($banyue5_begin,$banyue5_end),
					  "6"=>array($banyue6_begin,$banyue6_end),
					  "7"=>array($banyue7_begin,$banyue7_end));

//获取半月Part
$banyue = $_REQUEST['banyue']; 
					  
$start_created = $banyuekeyarr[$banyue][0];
$end_created = $banyuekeyarr[$banyue][1];

//进度条总长度
$width = 500; 


$nick = $_SESSION['nick'];
$session = $_SESSION['topsession'];

$appKey = $_SESSION['appKey'] ;
$appSecret = $_SESSION['appSecret'];


if($nick==''){
	header("Location: Login.php");
}

$errormess='';

if($_REQUEST['banyue'] !=''){

//获取淘宝订单总数
$resultcount = getTaobaoOrderCount($rooturl,$session,$appKey,$appSecret,$start_created,$end_created);
$page_size = 40;
$page_no = intval($resultcount / $page_size)+1;

$taobaoorders_page = array();
$taobaoorders = array();

$timer->stop();  
$timemessage .="计算订单个数的时间为 ".$timer->spent()."\r\n";
$timer->start(); 

//获取淘宝订单信息
$taobaoorders_page = getTaobaoOrderInfo($rooturl,$session,$appKey,$appSecret,$page_no,$page_size,$start_created,$end_created);

//总数 > 40 处理数组 array[0][0] to array[0]
if($resultcount > 1){
	foreach($taobaoorders_page as $pageorders){
		if(!empty($pageorders)){
			foreach($pageorders as $pageorder){
				$taobaoorders[] = $pageorder;
			}
		}else{
			$errormess .="获取淘宝订单信息失败。\r\n";
		}
	}
}else{
	if(!empty($taobaoorders_page[0])){
		$taobaoorders = $taobaoorders_page;
	}else{
		$errormess .="获取淘宝订单信息失败2。\r\n";
	}
}

$timer->stop();  
$timemessage .="获取订单数据的时间为 ".$timer->spent()."\r\n";
$timer->start(); 
if (empty($errormess)){ //if 数据不为空
//订单总数
$count_all = count($taobaoorders);
$pix = $width / $count_all; 
$progress = 0;

$successorder = 0;
$order_num = 0;
foreach ($taobaoorders as $key => $taobaoorder) {  //begin {1}
	//taobao.trade.fullinfo.get 
	//获取交易详情
	$tid = $taobaoorder['tid'];
	$errormess .="key: $key \r\n";

	$timer->stop();  
	$timer->start(); 
	
	$trade_is_exist =  checkTradeIsExist($tid); //返回结果：true 不存在 ， false 已存在
	
	/*$timer->stop();  
	$timemessage .="验证交易号是否存在用时: ".$timer->spent()."\r\n";
	$timer->start(); 
	*/
	
	if(!$trade_is_exist){
			$errormess .="交易:'$tid'已存在。\r\n";
			continue;
	}
	//获取单笔交易的详细信息 
	$taobaoothers = getTaobaoTradeInfo($rooturl,$session,$appKey,$appSecret,$tid);
	//加载交易数据 

	//表示订单成功的状态数组
	//有物流的状态情况，此处不甚确定，待考究。
	$success_trade_status = array("卖家已发货，等待买家确认","买家已签收","交易成功"); 
	
	
	//配送方式
	$shipping_type_tmp = $taobaoothers['shipping_type']; 
	$shipping_type = getShippingType($shipping_type_tmp);
	
	
		
	//支付方式  // 淘宝没有这个字段了。
	/* 
	   $pay_type_tmp = $taobaoothers['pay_type']; 
	   $pay_type = getPayType($pay_type_tmp);
	*/
	
	$pay_type = "支付宝";	 
		
	//邮费
	$postage = $taobaoothers['post_fee'];

	//付款时间
	$pay_time = $taobaoothers['pay_time'];

	
	//快递代收款
	$express_agency_fee  = $taobaoothers['express_agency_fee'];  
	
	//发票抬头
	$invoice_name = $taobaoothers['invoice_name']; 

	//买家支付宝账号
	$buyer_alipay_no = $taobaoothers['buyer_alipay_no']; 
	//买家备注
	$buyer_memo = $taobaoothers['buyer_memo']; 
		
		
	//买家昵称
	$buyer_nick = $taobaoothers['buyer_nick'];
	
	//买家留言
	$buyer_message  = $taobaoothers['buyer_message'];
	
	//Email
	$buyer_email_temp =   $taobaoothers['buyer_email'];  
	if(is_array($buyer_email_temp)){ 
		if(empty($buyer_email_temp)){
				$buyer_email='';
		}else{
			foreach($buyer_email_temp as $rel_email){
				$buyer_email .= " ".$rel_email;
			}
		}
	}else{
		$buyer_email = $buyer_email_temp;
	} 
	
	//收货人姓名
	$receiver_name =  $taobaoothers['receiver_name'];
	//收货人省份
	$receiver_state  = $taobaoothers['receiver_state'];
	//收货人城市
	$receiver_city = $taobaoothers['receiver_city'];
	//收货人区域
	$receiver_district = $taobaoothers['receiver_district'];
	//收货人详细地址
	$receiver_street = $taobaoothers['receiver_address'];
	//收货人邮编
	$receiver_code = $taobaoothers['receiver_zip'];
	//收货人手机号码
	$receiver_phone =  $taobaoothers['receiver_mobile'];
	//收货人电话
	$receiver_tel_temp = $taobaoothers['receiver_phone'];
	$receiver_tel = '';
	if(is_array($receiver_tel_temp)){ 
		if(empty($receiver_tel_temp)){
				$receiver_tel='';
		}else{
			foreach($receiver_tel_temp as $rel_tel){
				$receiver_tel .= " ".$rel_tel;
			}
		}
	}else{
		$receiver_tel = $receiver_tel_temp;
	}

	//卖家姓名
	$seller_name =  $taobaoothers['seller_name'];  // Fullget
	
	//卖家发货时间
	$consign_time =  $taobaoothers['consign_time'];
	
	//卖家是否已评价
	$seller_rate =  ($taobaoothers['seller_rate'] =='true') ? "是":"否";
	
	//卖家实际收到的支付宝打款金额
	$received_payment =  $taobaoothers['received_payment'];	
	
	
		
	//优惠详情 array
	$promotion_details = $taobaoothers['promotion_details']; 
	
	$promotion_name ='';
	$gift_item_name='';
	
	if(is_array($promotion_details)){
		//优惠信息的名称
		$promotion_name =  $promotion_details['promotion_name'];  
		
		//商品的名称
		$gift_item_name = $promotion_details['gift_item_name'];		
	}
		
	
	//交易状态
	$trade_status_tmp =  $taobaoothers['status'];
	$trade_status = getOrderStatus($trade_status_tmp);
	
	
	//订单备注
	$description_order =  addslashes($taobaoothers['trade_memo']); 
	
	//创建时间
	$trade_created = $taobaoothers['created']; 
	
	//店铺名
	$trade_title =  $taobaoothers['title']; 
	
	//结束加载
	$orders = $taobaoothers['orders']['order'];
	
	$index =0;
	if(!is_array($orders)){
			continue;
	}
	foreach($orders as $order){  //order details begin
				
		//子订单编号
		$oid = $order['oid'];

		$order_is_exist =  checkOrderIsExist($oid); //返回结果：true 不存在 ， false 已存在
		if(!$order_is_exist){
			$errormess .="订单:'$oid'已存在。\r\n";
			$order_num++;

			$update_order_tid_sql = "update ec_salesorder set tid='".$tid."' where oid='".$oid."'";
			$adb->query($update_order_tid_sql);

			continue;
		}

		// begin insert 

		//订单状态
		$orderstatus_tmp = $order['status']; //临时
		$orderstatus = getOrderStatus($orderstatus_tmp);
		
		//taobao.logistics.orders.detail.get 物流信息
		if(in_array($orderstatus,$success_trade_status)){
			$wlinfo = getLogisticsOrderWlInfo($rooturl,$session,$appKey,$appSecret,$tid); 
			if (!empty($wlinfo)) {
				//物流单号
				$wl_no = $wlinfo['order_code'];
				//物流公司
				$wl_company = $wlinfo['company_name'];
			}else{
				$errormess .="物流信息获取失败。\r\n";
			}
		
		}else{
			//物流单号
			$wl_no = '';
			//物流公司
			$wl_company ='';
		}
	

		//商品个数
		$item_num = $order['num']; //All_num

		//退款状态
		$refund_status = $order['refund_status'];

		//应付金额
		$total = $order['total_fee'];

		//商品价格
		$item_price = $order['price'];

		//实付金额
		if($refund_status == 'SUCCESS'){
			$payment = 0;
		}else{
			$payment = $order['payment'];
		}

		//SKU的值
		$sku_properties_name = $order['sku_properties_name'];

		//套餐描述
		$item_meal_name  =  $order['item_meal_name'];  

		//买家是否已评价
		$buyer_rate = ($order['buyer_rate'] =='true')? "是":"否";

		//卖家手工调整金额
		$adjust_fee =  $order['adjust_fee'];

		//优惠金额
		$discount_fee =  $order['discount_fee'];

		//创建时间
		$createdtime_order = $trade_created;

		//修改时间
		$modifiedtime_order =  $order['modified'];
		if($modifiedtime_order == ''){
			$modifiedtime_order = date("Y-m-d H:i:s");
		}

		$accountid_tmp = checkAccountIsExist($buyer_nick); //判断客户是否已存在

		if(empty($accountid_tmp)){
			//不存在
			$accountid =$adb->getUniqueID("ec_crmentity");

			//同步的客户信息
			$accountinfo = getAccountInfo($rooturl,$session,$appKey,$appSecret,$buyer_nick);
			
			if(empty($accountinfo)){
				$errormess .="买家信息获取失败。\r\n";
			}else{
				$accountname = $receiver_name;
				
				//所属店铺
				$belongshop =  $trade_title;  //等于交易的标题
				
				//用户数字ID
				$tao_user_id =	$accountinfo['user_id'];

				//用户字符串ID
				$tao_uid	 = 	$accountinfo['uid'];

				//会员名
				$membername  =  $accountinfo['nick'];	
				
				//客户买家信用
				if(is_array($accountinfo['buyer_credit'])){
					$account_buyer_credit_tmp = $accountinfo['buyer_credit']['level'];
					$account_buyer_credit = getHuangGuanInfo($account_buyer_credit_tmp);
				}
				
				//客户卖家信用
				if(is_array($accountinfo['seller_credit'])){
					$account_seller_credit_tmp  = $accountinfo['seller_credit']['level'];
					$account_seller_credit = getHuangGuanInfo($account_seller_credit_tmp);
				}
				//客户类型
				$account_type_tmp  =  $accountinfo['type'];
				$account_type = getAccountType($account_type_tmp);
				
				
				//支付宝账号
				$alipay_account =   $buyer_alipay_no;

				
				//VIP信息
				$vipinfo_tmp = $accountinfo['vip_info']; 
				$vipinfo = getVipInfo($vipinfo_tmp);
				
				
				//手机
				$phone = $receiver_phone; 
				//电话
				$tel = $receiver_tel;
			
				//Email
				$email =  $buyer_email;

					
				//客户最新订单时间
				$lastorderdate = $createdtime_order;
				
				//订单金额
				$ordertotal = $total;
				
				//购买商品数
				$buy_pro_num = $item_num;
				
				//最后登录淘宝时间
				$last_logintime =  $accountinfo['last_visit'];
				if(empty($last_logintime)){
					$last_logintime = '0000-00-00';
				}
				
				
				//省
				$bill_state = $receiver_state;
				//城市
				$bill_city = $receiver_city;
				//区域
				$bill_district = $receiver_district;
				//街道
				$bill_street = $receiver_street;
				//邮编
				$bill_code = $receiver_code;
				//描述
				$description_account = '';
				//创建时间
				$createdtime_account =  $accountinfo['created'];
				if($createdtime_account == ''){
					$createdtime_account = date("Y-m-d H:i:s");
				}
				//修改时间
				$modifiedtime_account = date("Y-m-d H:i:s");
				
				$prefixa ='';
				if($accountname !=''){
					$prefixa = getEveryWordFirstSpell($accountname);
				}
				
				$insertaccountsql = "insert into ec_account(accountid,accountname,prefix,belongshop,tao_user_id,tao_uid,membername,account_buyer_credit,account_type,alipay_account,contact_date,contacttimes,vipinfo,lastorderdate,phone,tel,email,ordernum,ordertotal,buy_pro_num,last_logintime,bill_state,bill_city,bill_district,bill_street,bill_code,description,smcreatorid,smownerid,modifiedby,createdtime,modifiedtime,deleted) values(".$accountid.",'".$accountname."','".$prefixa."','".$belongshop."','".$tao_user_id."','".$tao_uid."','".$membername."','".$account_buyer_credit."','".$account_type."','".$alipay_account."','0000-00-00',0,'".$vipinfo."','".$lastorderdate."','".$phone."','".$tel."','".$email."','1','".$ordertotal."','".$buy_pro_num."','".$last_logintime."','".$bill_state."','".$bill_city."','".$bill_district."','".$bill_street."','".$bill_code."','".$description_account."',".$current_user->id.",".$current_user->id.",0,'".$createdtime_account."','".$modifiedtime_account."',0)";
				
				$rs0 = $adb->query($insertaccountsql);
				if(!$rs0){
					$errormess .='客户插入未成功!'.$membername."\r\n";
				}
				//插入ec_crmentity
				$insertcrmentityaccountsql = "insert into ec_crmentity(crmid,smcreatorid,smownerid,setype,description,createdtime,modifiedtime) " .
						"values(".$accountid.",".$current_user->id.",".$current_user->id.",'Accounts','".$description_account."','".$createdtime_account."','".$modifiedtime_account."')";
				
				$rn0 = $adb->query($insertcrmentityaccountsql);
				if(!$rn0){
					$errormess .='客户关联插入未成功!\r\n';
				}
			}
		}else{
			$accountid = $accountid_tmp;
			$updateaccountsql = "update ec_account set lastorderdate='".$createdtime_order."',ordernum=ordernum+1,ordertotal=ordertotal+".$total.",buy_pro_num=buy_pro_num+".$item_num." where accountid= '".$accountid."'";
			$rs1 = $adb->query($updateaccountsql);
		   if(!$rs1){
					$errormess .='客户更新未成功!\r\n';
			}
		}

		$is_add_success = getTidInfo($tid);
	
		//订单ID
		$salesorderid = $adb->getUniqueID("ec_crmentity");
		
		//订单编号
		$subject = $salesorder_seqprefix.date("Ymd")."-".$salesorderid;

		$insertorderssql = "insert into ec_salesorder(salesorderid,tid,oid,subject,accountid,orderstatus,num,shipping_type,pay_type,postage,pay_time,total,payment,sku_properties_name,express_agency_fee,invoice_name,buyer_nick,buyer_alipay_no,buyer_memo,buyer_rate,buyer_credit,buyer_message,receiver_name,receiver_state,receiver_city,receiver_district,receiver_street,receiver_code,receiver_phone,receiver_tel,seller_name,consign_time,seller_rate,adjust_fee,received_payment,item_meal_name,promotion_name,discount_fee,gift_item_name,wl_no,wl_company,description,smcreatorid,smownerid,modifiedby,createdtime,modifiedtime,deleted) values(".$salesorderid.",'".$tid."','".$oid."','".$subject."','".$accountid."','".$orderstatus."','".$item_num."','".$shipping_type."','".$pay_type."','".$postage."','".$pay_time."','".$total."','".$payment."','".$sku_properties_name."','".$express_agency_fee."','".$invoice_name."','".$buyer_nick."','".$buyer_alipay_no."','".$buyer_memo."','".$buyer_rate."','".$account_buyer_credit."','".$buyer_message."','".$receiver_name."','".$receiver_state."','".$receiver_city."','".$receiver_district."','".$receiver_street."','".$receiver_code."','".$receiver_phone."','".$receiver_tel."','".$seller_name."','".$consign_time."','".$seller_rate."','".$adjust_fee."','".$received_payment."','".$item_meal_name."','".$promotion_name."','".$discount_fee."','".$gift_item_name."','".$wl_no."','".$wl_company."','".$description_order."',".$current_user->id.",".$current_user->id.",0,'".$createdtime_order."','".$modifiedtime_order."',0);";
		$rs2 = $adb->query($insertorderssql);
		if(!$rs2){
					$errormess .='订单插入未成功!'.$oid."\r\n";
		}
		
		
		if($orderstatus =='交易成功' && $is_add_success){
			$update_acc_pay_sql = "update ec_account set allsuccessbuy=allsuccessbuy+1 where accountid='".$accountid."'";
			$adb->query($update_acc_pay_sql);
		}
		//插入ec_crmentity
		$insertcrmentityordersql = "insert into ec_crmentity(crmid,smcreatorid,smownerid,setype,description,createdtime,modifiedtime) " .
					"values(".$salesorderid.",".$current_user->id.",".$current_user->id.",'SalesOrder','".$description_order."','".$createdtime_order."','".$modifiedtime_order."')";

		$adb->query($insertcrmentityordersql);
		

		//商品数字id
		$num_iid = $order['num_iid'];
		
		//判断产品是否已存在
		$productid_tmp = checkItemIsExist($num_iid);
		if(empty($productid_tmp) && !empty($num_iid)){
			//获取订单产品信息
			//$ItemInfo =getProductInfo($rooturl,$session,$appKey,$appSecret,$num_iid);
			//if(empty($ItemInfo)){
				//$errormess .="获取订单产品信息失败。\r\n";
			//}else{
				$productid = $adb->getUniqueID("ec_crmentity");
				$productname =  $order['title'];
				$productcode = $product_seqprefix.$productid;
				
				//$cid = $ItemInfo['cid'];
				
				//商品url
				//$detail_url = $ItemInfo['detail_url'];

				//商品数量
				//$pro_num = $ItemInfo['num'];
				//商品价格
				$price =  $order['price'];
				
				$comment = $sku_properties_name;
//				//创建时间
//				$createdtime_pro =  $ItemInfo['created'];
//				if($createdtime_pro == ''){
//					$createdtime_pro = date("Y-m-d H:i:s");
//				}
//				//修改时间
//				$modifiedtime_pro =  $ItemInfo['modified'];
//				if($modifiedtime_pro == ''){
//					$modifiedtime_pro = date("Y-m-d H:i:s");
//				}
				$createdtime_pro = date("Y-m-d H:i:s");
				$modifiedtime_pro = date("Y-m-d H:i:s");
				
				$insertproductsql = "insert into ec_products(productid,productname,productcode,num_iid,price,smcreatorid,smownerid,modifiedby,createdtime,modifiedtime,deleted) values(".$productid.",'".$productname."','".$productcode."','".$num_iid."','".$price."',".$current_user->id.",".$current_user->id.",0,'".$createdtime_pro."','".$modifiedtime_pro."',0)";
				$rs3 = $adb->query($insertproductsql);
				if(!$rs3){
					$errormess .='产品插入未成功!'.$productname."\r\n";
				}
				//插入ec_crmentity
				$insertcrmentityproductsql = "insert into ec_crmentity(crmid,smcreatorid,smownerid,setype,description,createdtime,modifiedtime) " .
						"values(".$productid.",".$current_user->id.",".$current_user->id.",'Products','".$description_pro."','".$createdtime_pro."','".$modifiedtime_pro."')";

				$adb->query($insertcrmentityproductsql);
			//}
		}else{
			$productid = $productid_tmp;
		}

		$insertInventoryProductsql = "insert into ec_inventoryproductrel(id,productid,sequence_no,quantity,listprice,discount_percent,discount_amount,comment,pricebookid) " .
				"values(".$salesorderid.",".$productid.",'1','".$item_num."','".$item_price."','','','".$comment."','')";
		$rs4 = $adb->query($insertInventoryProductsql);
		if(!$rs4){
			$errormess .='产品关联插入未成功!'.$productname."\r\n";
		}
		if($rs2){
			$successorder += 1;
			$index++;
		}else{
			$index--;
		}
		//end insert salesorder
		$order_num++;

	}
	//order details end	
	
	

	if($index == -3){
		$failed += 1;
	}elseif($index == 0){
		//空
	}else{
		$success += 1;
	}
	
} //end  {1}


$timer->stop();  
$timemessage .="数据插入数据库的时间为 ".$timer->spent()."\r\n";
$timer->start(); 

$message = "当前交易总数:<font color=red>".$count_all." ;</font>&nbsp;&nbsp;&nbsp;";
$message .= "当前订单总数:<font color=red>".$order_num." ;</font>&nbsp;&nbsp;&nbsp;";
$message .="已成功导入订单数:<font color=red>".$successorder." ;</font>";
//require_once ('getBuyNums.php');

	
 
}//end 数据不为空

}//banyue

$importresult = "<font color=green>导入完毕</font>";

$timer->stop();  
$timemessage .="更新客户状态时间 ".$timer->spent()."\r\n";


$data_file = "logs/synlogs.txt";
$fp  = fopen($data_file,"w");
if(!empty($errormess)){
	fwrite($fp, $errormess."\r\n".$timemessage."\r\n");
}else{
	fwrite($fp, $timemessage."\r\n");
}


fwrite($fp,"Over!");
fclose($fp);


$return ='';

if(!empty($importresult)){
	$return .= "&nbsp;&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;".$importresult."<br><br>";
} 
if(!empty($message)){
	$return .=  "&nbsp;&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;".$message."&nbsp;&nbsp;&nbsp;&nbsp;<br><br>";
}
$return .=  "&nbsp;&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;<a href=\"logs/synlogs.txt\" target=\"_blank\">查看日志</a>  ";
echo $return;die;
?>
