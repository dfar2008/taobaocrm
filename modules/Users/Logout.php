<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/modules/Users/Logout.php,v 1.8 2005/03/21 04:51:21 ray Exp $
 * Description:  TODO: To be written.
 ********************************************************************************/
session_start();
require_once ('modules/Synchronous/Synfunction.php');

//参数数组
$param = array (
	/* API系统级输入参数 Start */
		'timestamp' => date('Y-m-d H:i:s'),
		'app_key' => $_SESSION['appKey'], //Appkey
		'sign_method' => 'md5' //签名方式

);
$paramArr = array_merge($param);

$sign = createSign($paramArr, $_SESSION['appSecret']);

//组织参数
$strParam = createStrParam($paramArr);
$strParam .= 'sign=' . $sign;


$rooturl = "http://container.api.taobao.com/container/logoff?";

//构造Url
$url = $rooturl . $strParam;


unset($_SESSION['sign']); 
unset($_SESSION['nick']); 
unset($_SESSION['authenticated_user_id']); 
unset($_SESSION['app_unique_key']); 
unset($_SESSION['appKey']); 
unset($_SESSION['appSecret']); 
unset($_SESSION['topsession']); 

redirect($url);

?>
