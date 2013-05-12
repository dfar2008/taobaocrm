<?php
require_once('modules/Accounts/Accounts.php');
require_once('include/utils/utils.php');
require_once('modules/Accounts/Accountsrel.php');

$rel_focus = new Accountsrel();
$account_focus = new Accounts();
global $adb,$current_user;
global $currentModule;

$type = $_REQUEST["type"];

$record = $_REQUEST["record"];


if(!$type || $type == ''){
	echo '';die;
}

$infohtml = '<table class="dvtContentSpace" width="100%" style="border-top: 1px solid rgb(222, 222, 222);" border="0"><tbody><tr><td style="padding:1px;">';
if($type == 'DetailsOrders'){
	if($record != ''){
	  $infohtml .= '<tr style="height: 20px;"><td><input class="crmbutton small create" type="button" value="新增订单" name="Create" onclick="javascript:location.href=\'index.php?module=SalesOrder&action=EditView&return_module=Accounts&return_id='.$record.'\'" accesskey="新增订单" title="新增订单"></td></tr>';
	 }
	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%" border="0" cellpadding="3" cellspacing="1" >



      <tr style="height: 20px;">
        <td class="lvtCol2"  nowrap>订单编号</td>

		<td class="lvtCol2"  nowrap>订单状态</td>

        <td class="lvtCol2"  nowrap>下单时间</td>

        <td class="lvtCol2"  nowrap >商品总数量</td>

        <td class="lvtCol2"  nowrap >订单总额</td>

		<td class="lvtCol2"  nowrap >邮费</td>

		<td class="lvtCol2"  nowrap>收货人姓名</td>

		<td class="lvtCol2"  nowrap>联系手机</td>

        <td class="lvtCol2"  nowrap>联系电话</td>

        <td class="lvtCol2"  nowrap>所在省份</td>

        <td class="lvtCol2"  nowrap>所在市</td>

        <td class="lvtCol2"  nowrap>所在区</td>

        <td class="lvtCol2"  nowrap>详细地址</td>

        <td class="lvtCol2"  nowrap>邮编</td>

		<td class="lvtCol2"  nowrap>配送方式</td>

		<td class="lvtCol2"  nowrap>支付方式</td>

      </tr>';

  if(!empty($record)){
	  $relorderinfo = $rel_focus->getDetailsOrderInfo($record);

	  if($relorderinfo && $relorderinfo != ''){
		  $i = 1;
		 foreach($relorderinfo as $orderinfo){
				  $infohtml .= '<tr bgcolor="white">
					<td nowrap>'.$orderinfo['subject'].'</td>
				    <td nowrap>'.$orderinfo['orderstatus'].'</td>
					<td nowrap>'.$orderinfo['createdtime'].'</td>
					<td nowrap>'.$orderinfo['salesum'].'</td>
					<td nowrap>'.$orderinfo['total'].'</td>
					<td nowrap>'.$orderinfo['postage'].'</td>
					<td nowrap>'.$orderinfo['receiver_name'].'</td>
					<td nowrap>'.$orderinfo['receiver_phone'].'</td>
					<td nowrap>'.$orderinfo['receiver_tel'].'</td>
					<td nowrap>'.$orderinfo['receiver_state'].'</td>
					<td nowrap>'.$orderinfo['receiver_city'].'</td>
					<td nowrap>'.$orderinfo['receiver_district'].'</td>
					<td nowrap>'.$orderinfo['receiver_street'].'</td>
					<td nowrap>'.$orderinfo['receiver_code'].'</td>
					<td nowrap>'.$orderinfo['shipping_type'].'</td>
					<td nowrap>'.$orderinfo['pay_type'].'</td>
				  </tr>';
				  $i++;
		 }
	  }
  }
    $infohtml .= '</table>';
}else if($type == 'Receiveinfo'){

	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%" border="0" cellpadding="3" cellspacing="1">



      <tr style="height: 20px;">

        <td class="lvtCol2"  nowrap>收货人姓名</td>

        <td class="lvtCol2"  nowrap>所在省份</td>

        <td class="lvtCol2"  nowrap>所在市</td>

        <td class="lvtCol2"  nowrap>所在区</td>

        <td class="lvtCol2"  nowrap>详细地址</td>

        <td class="lvtCol2"  nowrap>邮编</td>

	    <td class="lvtCol2"  nowrap>手机号码</td>

        <td class="lvtCol2"  nowrap>联系电话</td>

        <td class="lvtCol2"  nowrap>E-mail</td>



      </tr>';

	 if(!empty($record)){
		$relreceiveinfo = $rel_focus->getReceiveInfo($record);

		if($relreceiveinfo && $relreceiveinfo != ''){
		  $i = 1;
		    foreach($relreceiveinfo as $receiveinfo){
				  $infohtml .= '<tr bgcolor="white">
								<td nowrap>'.$receiveinfo['accountname'].'</td>
								<td nowrap>'.$receiveinfo['bill_state'].'</td>
								<td nowrap>'.$receiveinfo['bill_city'].'</td>
								<td nowrap>'.$receiveinfo['bill_district'].'</td>
								<td nowrap>'.$receiveinfo['bill_street'].'</td>
								<td nowrap>'.$receiveinfo['bill_code'].'</td>
								<td nowrap>'.$receiveinfo['phone'].'</td>
								<td nowrap>'.$receiveinfo['tel'].'</td>
								<td nowrap>'.$receiveinfo['email'].'</td>
							  </tr>';
					$i++;
		    }
		 }
	 }

	$infohtml .= '</table>';
}else if($type == 'BuyProducts'){

	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%"  border="0" cellpadding="3" cellspacing="1">



      <tr style="height: 20px;">

       <td class="lvtCol2"  nowrap>产品编号</td>

        <td class="lvtCol2" nowrap>产品名称</td>

        <td class="lvtCol2" nowrap>购买数量</td>

        <td class="lvtCol2" nowrap>市场价</td>

		<td class="lvtCol2" nowrap>库存量</td>

        <td class="lvtCol2" nowrap>商品URL</td>


      </tr>';

	 if(!empty($record)){
		$relreceiveinfo = $rel_focus->getBuyProducts($record);

		if($relreceiveinfo && $relreceiveinfo != ''){
		  $i = 1;
		    foreach($relreceiveinfo as $productinfo){
				  $infohtml .= '<tr bgcolor="white">
								<td nowrap>'.$productinfo['productcode'].'</td>
								<td nowrap>'.$productinfo['productname'].'</td>
								<td nowrap>'.$productinfo['salesum'].'</td>
								<td nowrap>'.$productinfo['price'].'</td>
								<td nowrap>'.$productinfo['num'].'</td>
								<td nowrap>'.$productinfo['detail_url'].'</td>

							  </tr>';
					$i++;
		    }
		 }
	 }

	$infohtml .= '</table>';
}else if($type == 'Noteinfo'){
	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%"  border="0" cellpadding="3" cellspacing="1">';

	if($record != ''){
      $infohtml .= '<tr style="height: 20px;"><td><input class="crmbutton small save" type="button" onclick="openDialogs('.$record.');" value="新增联系记录"></td></tr>';
     }

     $infohtml .= ' <tr style="height: 20px;">

        <td class="lvtCol2"  nowrap width="20%">主题 </td>

        <td class="lvtCol2" nowrap>联系类型</td>

        <td class="lvtCol2" nowrap>联系日期</td>

		<td class="lvtCol2" nowrap>内容</td>

      </tr>';

	 if(!empty($record)){
		$relnoteinfos = $rel_focus->getDetailsNoteInfo($record);

		if($relnoteinfos && $relnoteinfos != ''){
		  $i = 1;
		    foreach($relnoteinfos as $relnoteinfo){
				  $infohtml .= '<tr bgcolor="white">
								<td nowrap>'.$relnoteinfo['title'].'</td>
								<td nowrap>'.$relnoteinfo['notetype'].'</td>
								<td nowrap>'.$relnoteinfo['contact_date'].'</td>
								<td nowrap>'.$relnoteinfo['notecontent'].'</td>
							  </tr>';
					$i++;
		    }
		 }
	 }

		$infohtml .= '</table>';
}else if($type == 'Qunfas'){
	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%"  border="0" cellpadding="3" cellspacing="1">';
     $infohtml .= ' <tr style="height: 20px;">

       <td class="lvtCol2"  nowrap width="20%">编号 </td>

        <td class="lvtCol2" nowrap>发送日期</td>

		<td class="lvtCol2" nowrap>短信内容</td>

      </tr>';

	 if(!empty($record)){
		$qunfainfos = $rel_focus->getQunfasInfo($record);

		if($qunfainfos && $qunfainfos != ''){
		  $i = 1;
		    foreach($qunfainfos as $qunfainfo){
				  $infohtml .= '<tr bgcolor="white">
								<td nowrap>'.$qunfainfo['qunfaname'].'</td>
								<td nowrap>'.$qunfainfo['createdtime'].'</td>
								<td nowrap>'.substr($qunfainfo['msg'], 0, 50).'</td>
							  </tr>';
					$i++;
		    }
		 }
	 }

		$infohtml .= '</table>';

}else if($type == 'Maillists'){
	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%"  border="0" cellpadding="3" cellspacing="1">';
     $infohtml .= ' <tr style="height: 20px;">

       <td class="lvtCol2"  nowrap width="20%">编号 </td>
		
		<td class="lvtCol2" nowrap>发件人</td>

        <td class="lvtCol2" nowrap>发送日期</td>

		<td class="lvtCol2" nowrap>邮件主题</td>
		
		<td class="lvtCol2" nowrap>邮件内容</td>
		
      </tr>';

	 if(!empty($record)){
		$maillistinfos = $rel_focus->getMaillistsInfo($record);

		if($maillistinfos && $maillistinfos != ''){
		  $i = 1;
		    foreach($maillistinfos as $maillistinfo){
				  $infohtml .= '<tr bgcolor="white">
								<td nowrap>'.$maillistinfo['maillistname'].'</td>
								<td nowrap>'.$maillistinfo['from_name'].'</td>
								<td nowrap>'.$maillistinfo['createdtime'].'</td>
								<td nowrap>'.$maillistinfo['subject'].'</td>
								<td nowrap>'.substr($maillistinfo['mailcontent'], 0, 50).'</td>
							  </tr>';
					$i++;
		    }
		 }
	 }

		$infohtml .= '</table>';


}else if($type == 'Memdays'){
	if($record != ''){
	  $infohtml .= '<tr style="height: 20px;"><td><input class="crmbutton small create" type="button" value="新增纪念日" name="Create" onclick="javascript:location.href=\'index.php?module=Memdays&action=EditView&return_module=Accounts&return_id='.$record.'\'" accesskey="新增纪念日" title="新增纪念日"></td></tr>';
	 }
	$infohtml .= '<table style="background-color: rgb(234, 234, 234);" class="small" width="100%"  border="0" cellpadding="3" cellspacing="1">';
    $infohtml .= ' <tr style="height: 20px;">
						<td class="lvtCol2"  nowrap width="20%">纪念日主题</td>
						<td class="lvtCol2" nowrap>纪念日类型</td>
						<td class="lvtCol2" nowrap>日历</td>
						<td class="lvtCol2" nowrap>纪念日</td>
						<td class="lvtCol2" nowrap>下次提醒</td>
						<td class="lvtCol2" nowrap>负责人</td></tr>';

	 if(!empty($record)){
		$reshtml = $rel_focus->getMemdaysInfo($record);
		if($reshtml && !empty($reshtml)){
			$infohtml .= $reshtml;
		}
		
	 }

		$infohtml .= '</table>';
}else{
	$infohtml .= '';
}
$infohtml .= '</td></tr><tr><td>&nbsp;&nbsp;&nbsp;</td></tr></tbody></table>';

echo $infohtml;
exit();

?>