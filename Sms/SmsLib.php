<?php
require_once('config.php');
require_once('include/utils/utils.php');
require_once('include/database/PearDatabase.php');
require_once('Sms/Client.php');
global $adb;
global $current_user;
//$uid = 'zrcs2-c000';
//$pwd = '123456';


/**
 * 创建client实例
 */
function & getSingleClient($smownerid){
	global $current_user;
    static $client = false;
	
    if($client===false){
        global $adb;
        $gwUrl = 'http://sdkhttp.eucp.b2m.cn/sdk/SDKService';
        $sql="select * from ec_messageaccount where smownerid='".$smownerid."'";
		$result = $adb->query($sql);
		$serialNumber = trim($adb->query_result($result,0,'username'));
		$password = trim($adb->query_result($result,0,'password'));
		//$password='12345';
        $sessionKey = $password;
        $connectTimeOut = 5;

        /**
         * 远程信息读取超时时间，单位为秒
         */
        $readTimeOut = 10;

        /**
                $proxyhost		可选，代理服务器地址，默认为 false ,则不使用代理服务器
                $proxyport		可选，代理服务器端口，默认为 false
                $proxyusername	可选，代理服务器用户名，默认为 false
                $proxypassword	可选，代理服务器密码，默认为 false
        */
        $proxyhost = false;
        $proxyport = false;
        $proxyusername = false;
        $proxypassword = false;

        $client = new Client($gwUrl,$serialNumber,$password,$sessionKey,$proxyhost,$proxyport,$proxyusername,$proxypassword,$connectTimeOut,$readTimeOut);

        $client->setOutgoingEncoding("UTF-8");
    }
        return $client;
}

/**
 * 登录 用例
 */
function loginSMS($smownerid)
{
	$client=&getSingleClient($smownerid);
	//$client->logout();
	if($client->getError()){
            return array("error"=>1,"message"=>"接口调用出错");
    }
	$statusCode = $client->login();
	if($statusCode!=null && $statusCode=="0"){
            return array("error"=>0);
        }
	return array("error"=>1,"message"=>"序列号或密码错误,statusCode:".$statusCode);

}

/**
 * 注销登录 用例
 */
function logout($smownerid)
{
	$client=&getSingleClient($smownerid);
        if($client->getError()){
            return array("error"=>1,"message"=>"接口调用出错");
        }
	$statusCode = $client->logout();
	if($statusCode!=null && $statusCode=="0"){
            return array("error"=>0);
        }
	return array("error"=>1,"message"=>"序列号或密码错误,statusCode:".$statusCode);
}

function getBalance($smownerid) {
	$client=&getSingleClient($smownerid);
        if($client->getError()){
            return array("error"=>1,"message"=>"接口调用出错");
        }
        $balance = $client->getBalance();
        if($balance!=null && $balance!="12"){
            return array("error"=>0,"balance"=>$balance);
        }
	return array("error"=>1,"message"=>"序列号或密码错误");

}

//异步发送短信
function sendSMS($msg,$phone,$smownerid) {
	$client=&getSingleClient($smownerid);
        if($client->getError()){
            return array("error"=>1,"message"=>"接口调用出错");
        }
        $phones=array($phone);
        $statusCode = $client->sendSMS($phones,$msg);
        if($statusCode!=null && $statusCode=="0"){
            return array("error"=>0);
        }
        return array("error"=>1,"message"=>"发送短信操作失败,statusCode:".$statusCode);

}

//同步发送短信
function sendMultiSMS($msg,$phones,$smownerid) {
        $client=&getSingleClient($smownerid);
        if($client->getError()){
            return array("error"=>1,"message"=>"接口调用出错");
        }

        $statusCode = $client->sendSMS($phones,$msg,$smownerid);
        if($statusCode!=null && $statusCode=="0"){
            return array("error"=>0);
        }
        return array("error"=>1,"message"=>"发送短信操作失败,statusCode:".$statusCode);



}

function recieveSMS($smownerid) {
        $client=&getSingleClient($smownerid);
        if($client->getError()){
            return array("error"=>1,"message"=>"接口调用出错");
        }
        $moResult = $client->getMO();
        if(count($moResult)==0){
            return array("error"=>0,"mo"=>array());
        }
        $mos=array();
	foreach($moResult as $mo){
            $arraymo=array();
            $arraymo["from"]=$mo->getMobileNumber();
            $arraymo["content"]=$mo->getSmsContent();
            $arraymo["receivetime"]=$mo->getSentTime();
            $mos[]=$arraymo;
        }
//        var_dump($mos);
        return array("error"=>0,"mo"=>$mos);
}
?>


