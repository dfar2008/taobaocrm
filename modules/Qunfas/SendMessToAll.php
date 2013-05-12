<?php

require_once('include/utils/utils.php');
require_once('modules/Qunfas/Qunfas.php');
require_once('modules/Fenzu/Fenzu.php');
require_once('modules/Accounts/Accounts.php');
require_once('Sms/SmsLib.php');
global $adb,$current_user;
global $currentModule;


$focus = new Qunfas();
$oFenzu = new Fenzu("Qunfas");
$focus_acc = new Accounts();

$nowdate = date("Y-m-d");

$nowdatetime = date("Y-m-d H:i:s");

$message = $_REQUEST["message"];

if(preg_match("/[^\$a-zA-Z0-9\$]{1}/",$message)){
	$msflag = 0;
	$messinfos = explode('$',$message);

}else{
	$msflag=1;
}

$accountidstr = $_REQUEST["accountidstr"];
if(preg_match("/\,/",$accountidstr)){
	$accountidstr = substr($accountidstr, 0, -1);
}


$accountidarr = explode(',',$accountidstr);

foreach($accountidarr as $accountinfostr){
  	$accountinfo = explode('(',$accountinfostr);
  	$accountinfo[1] =substr($accountinfo[1], 0, -1);
	$accounts[] = $accountinfo;
}


$i=1;
foreach($accounts as $account){
	$membername = $account[1];
	/*if(!preg_match("/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u",$membername)){
		echo "客户\"".$membername."\"的名称不合法";die;
	}*/
	$phone = $account[0];
	if($phone && $phone !=''){
		$is_true = preg_match("/^1[3|4|5|8][0-9]\d{4,8}$/",$phone);
		if($is_true){
			$sendresult[$i] = array($phone,$membername);
		 }else{
			echo "客户\"".$membername."\"的电话不正确或不是手机号码.";die;
		 }
	}else{
			echo  "客户\"".$membername."\"的电话为空!";die;
	}
	$i++;
}
$j=1;
foreach($sendresult as $rst){
	if($msflag == '1'){
		$msg = sendSMS($message,$rst[0],$current_user->id);
	}else{
		if(is_array($messinfos)){
			$messstr = '';
			foreach($messinfos as $mess){
				if($mess =='membername'){
					$messstr .= $rst[1];
				}else{
					$messstr .= $mess;
				}
			}
		}
		$msg = sendSMS($messstr,$rst[0],$current_user->id);
	}

	if($msg['error'] == '1'){
		$sendrst[$j] = 1;
		$rstmsg[$j] ="客户\"".$rst[1]."\:".$msg['message'];
	}else{
		$sendrst[$j] = 0;
	}
	$j++;
}
$failaccount = '';
foreach($sendrst as $key=>$st){
	if($st =='1'){
		$failaccount .=$rstmsg[$key].",\n";
	}
}
if($failaccount !=''){
	print_r($failaccount);die;
}else{
	
	//删除多余
	$adb->query("delete from ec_qunfas where deleted=1");
	//生成事件id
	$qunfasid = $adb->getUniqueID("ec_crmentity");
	$qunfaname = "qfdx".date("Y-m-d").$focus->get_next_id();
	$sql = "insert into ec_qunfas(qunfasid,qunfaname,deleted,smcreatorid,smownerid,createdtime,modifiedtime) values(".$qunfasid.",'".$qunfaname."',1,".$current_user->id.",".$current_user->id.",'".$nowdatetime."','".$nowdatetime."')";
	$adb->query($sql);
	$adb->query("insert into ec_crmentity (crmid,setype,smcreatorid,smownerid,createdtime,modifiedtime) values('".$qunfasid."','Qunfas',".$current_user->id.",".$current_user->id.",'".$nowdatetime."','".$nowdatetime."')");
	$accountidstr = ""; 
	foreach($accounts as $account){
		$membername = $account[1];
		$accountid = getAccountIdInfo($membername);
		$messstr = '';
		if($accountid && $accountid !=''){		
			$accountidstr .=",".$accountid;				
			$updateacc_sql = "update ec_account set lastsendmessdate='".$nowdatetime."' where accountid=$accountid";
			$adb->query($updateacc_sql);
		}
		
	}
	$accountidstr .= ","; 
	
	$updatesql = "update ec_qunfas set accountid='".$accountidstr."',msg='".$message."',deleted=0 where qunfasid= {$qunfasid}";
	$adb->query($updatesql);
	
	require_once ('getSendMessNums.php');
	echo "SUCCESS";die;
}

exit();
function getAccountIdInfo($membername){
	global $adb;
	$query = "select * from ec_account where membername = '".$membername."' limit 0,1";
	$result = $adb->query($query);
	$num_rows = $adb->num_rows($result);
	if($num_rows > 0){
		for($i=0;$i<$num_rows;$i++) {
			$accountid = $adb->query_result($result,$i,'accountid');
		}
	}else{
		$accountid = '';
	}
	return $accountid;
}

?>
