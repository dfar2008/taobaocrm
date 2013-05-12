<?php
require_once('include/utils/CommonUtils.php');
require_once('include/utils/utils.php');

class Accountsrel{
	private $lastuseridstr;
	function __construct(){

	}



    /**
	 * 获取订单详细信息
	 */
     function getDetailsOrderInfo($accountid) {

         global $log;
		 global $adb;
         $log->debug("Entering getDetailsOrderInfo method ...");
         $query = "select DISTINCT  ec_salesorder.subject,prorel.salesum,ec_account.accountname,ec_salesorder.trade_created,ec_salesorder.trade_modified,ec_salesorder.createdtime,ec_salesorder.modifiedtime,ec_salesorder.orderstatus,ec_salesorder.postage" .
		",ec_salesorder.total,ec_salesorder.salesorderid,ec_salesorder.receiver_name,ec_salesorder.receiver_state,ec_salesorder.receiver_city," .
		"ec_salesorder.receiver_district,ec_salesorder.receiver_street,ec_salesorder.receiver_code,ec_salesorder.receiver_phone ,ec_salesorder.receiver_tel," .
		"ec_salesorder.shipping_type,ec_salesorder.pay_type,ec_salesorder.point_fee,ec_salesorder.buyer_obtain_point_fee
		 from ec_salesorder
		 left join ec_inventoryproductrel on ec_inventoryproductrel.id = ec_salesorder.salesorderid
	     inner join ec_account on ec_account.accountid = ec_salesorder.accountid
		 left join (select ec_inventoryproductrel.id,sum(quantity) as salesum from ec_inventoryproductrel
			       left join ec_salesorder on ec_salesorder.salesorderid = ec_inventoryproductrel.id
			       where ec_salesorder.accountid = ".$accountid."  group by ec_inventoryproductrel.id)
			       as prorel  on prorel.id = ec_salesorder.salesorderid
		 where ec_salesorder.deleted=0 and ec_salesorder.accountid = ".$accountid;
		 $result = $adb->query($query);
		 $arr = array();
		 while($row = $adb->fetch_array($result)){
			$row['subject'] = "<a href='index.php?action=DetailView&module=SalesOrder&record=".$row['salesorderid']."&parenttab=Sales' target='_blank'>".$row['subject']."</a>";
			$arr[] = $row;
		 }

         $log->debug("Exiting getDetailsOrderInfo method ...");
		 return $arr;
     }


      /**
	 * 获取客户的收货信息
	 */
     function getReceiveInfo($accountid) {
         global $log;
		 global $adb;
         $log->debug("Entering getReceiveInfo method ...");
         $query = "select * from ec_account  where accountid = ".$accountid;
		 $result = $adb->query($query);
		 $arr = array();
         while($row = $adb->fetch_array($result)){
            $arr[] = $row;
		 }
         $log->debug("Exiting getReceiveInfo method ...");
		 return $arr;
     }

	  /**
	 * 获取购买产品信息
	 */
     function getBuyProducts($accountid) {
         global $log;
		 global $adb;
         $log->debug("Entering getBuyProducts method ...");
         $query = "select DISTINCT ec_products.productcode,ec_products.productid,
		ec_products.productname,prorel.salesum,ec_products.price,
		ec_products.num,ec_products.detail_url from ec_products
		inner join
		 (select ec_inventoryproductrel.productid,sum(quantity) as salesum from ec_inventoryproductrel
			       left join ec_salesorder on ec_salesorder.salesorderid = ec_inventoryproductrel.id
			       where ec_salesorder.accountid = ".$accountid." and ec_salesorder.deleted=0 group by ec_inventoryproductrel.productid) as prorel
			       on prorel.productid = ec_products.productid"; 
		 $result = $adb->query($query);
		  $arr = array();
         while($row = $adb->fetch_array($result)){
			$row['productname'] = "<a href='index.php?action=DetailView&module=Products&record=".$row['productid']."&parenttab=Product' target='_blank'>".$row['productname']."</a>";
			$row['productcode'] = "<a href='index.php?action=DetailView&module=Products&record=".$row['productid']."&parenttab=Product' target='_blank'>".$row['productcode']."</a>";
			$row['detail_url'] = "<a href='".$row['detail_url']."' target='_blank'>".$row['detail_url']."</a>";
            $arr[] = $row;
		 }
         $log->debug("Exiting getBuyProducts method ...");
		 return $arr;
     }

	//获取客户联系记录
	function getDetailsNoteInfo($accountid){
		 global $log;
		 global $adb;
		 $log->debug("Entering getDetailsNoteInfo method ...");
		 if($accountid !=''){
			 $query = "select * from ec_notes where accountid=$accountid and deleted=0";
			 $result = $adb->query($query);
			 $num_rows = $adb->num_rows($result);
			 if($num_rows > 0){
				while($row = $adb->fetch_array($result)){
					$row['smownerid'] = getUserFullName($row['smownerid']);
					$row['title'] = "<a href='index.php?action=DetailView&module=Notes&record=".$row['notesid']."&parenttab=Customer' target='_blank'>".$row['title']."</a>";
					$arr[] = $row;
				}
			 }
		 }
	 $log->debug("Exiting getDetailsNoteInfo method ...");
	 return $arr;
	}

	//获取客户的群发短信信息
	function getQunfasInfo($accountid){
		global $log;
		global $adb;
		$log->debug("Entering getQunfasInfo method ...");
		if($accountid !=''){
			 $query = "select * from ec_qunfas where accountid like '%,$accountid,%' and deleted=0";
			 $result = $adb->query($query);
			 $num_rows = $adb->num_rows($result);
			 if($num_rows > 0){
				while($row = $adb->fetch_array($result)){
					
					//$row['smcreatorid'] = getUserFullName($row['smcreatorid']);
					$row['qunfaname'] = "<a href='index.php?action=DetailView&module=Qunfas&record=".$row['qunfasid']."' target='_blank'>".$row['qunfaname']."</a>";
					$message = $row['msg']; 
					$membername =  $this->getAccountNameInfo($accountid);
					$str = "\$accountname\$";
					$message  = str_replace($str,$membername,$message);
					$row['msg'] = $message;
					
					$arr[] = $row;
				}
			 }
		 }
		$log->debug("Exiting getQunfasInfo method ...");
		return $arr;
	}

	
	//获取客户的群发邮件信息
	function getMaillistsInfo($accountid){
		global $log;
		global $adb;
		$log->debug("Entering getMaillistsInfo method ...");
		if($accountid !=''){
			 $query = "select * from ec_maillists where accountid  like '%,$accountid,%' and deleted=0";
			 $result = $adb->query($query);
			 $num_rows = $adb->num_rows($result);
			 if($num_rows > 0){
				while($row = $adb->fetch_array($result)){
					//$row['smcreatorid'] = getUserFullName($row['smcreatorid']);
					$row['maillistname'] = "<a href='index.php?action=DetailView&module=Maillists&record=".$row['maillistsid']."' target='_blank'>".$row['maillistname']."</a>";
					$mailcontent = $row['mailcontent']; 
					$membername =  $this->getAccountNameInfo($accountid);
					$str = "\$accountname\$";
					$mailcontent  = str_replace($str,$membername,$mailcontent);
					$row['mailcontent'] = $mailcontent;
					$arr[] = $row;
				}
			 }
		 }
		$log->debug("Exiting getMaillistsInfo method ...");
		return $arr;
	}


		function getAccountNameInfo($id)
		{
			global $adb;
			$query = "select accountname from ec_account where accountid='{$id}' and deleted=0";
			$result = $adb->query($query);
			$num = $adb->num_rows($result);
			if($num > 0){
				$row = $adb->fetch_array($result);
				return $row['accountname'];
			}else{
				return '';
			}	
		}
	function getMemdaysInfo($id){
		global $adb;
		$query = "select ec_memdays.*,ec_users.user_name from ec_memdays 
					inner join ec_users 
						on ec_users.id = ec_memdays.smownerid 
				where ec_memdays.deleted = 0 and accountid = {$id} ";
		$result = $adb->query($query);
		$num_rows = $adb->num_rows($result);
		$infohtml = '';
		if($num_rows && $num_rows > 0){
			while($row = $adb->fetch_array($result)){
				$infohtml .= '<tr bgcolor="white">
								<td nowrap><a href="index.php?action=DetailView&module=Memdays&record='.$row['memdaysid'].'" target="_blank">'.$row['memdayname'].'</a></td>
								<td nowrap>'.$row['memday938'].'</td>
								<td nowrap>'.$row['memday1004'].'</td>
								<td nowrap>'.$row['memday940'].'</td>
								<td nowrap>'.$row['memday946'].'</td>
								<td nowrap>'.$row['user_name'].'</td>
						  	</tr>';
			}
		}
		return $infohtml;
	}
	function __destruct(){

	}
}
?>