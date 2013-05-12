<?php

require_once('include/utils/utils.php');
require_once('modules/Qunfas/Qunfas.php');
require_once('modules/Fenzu/Fenzu.php');
require_once('modules/Accounts/Accounts.php');
global $adb,$current_user;
global $currentModule;


$focus = new Qunfas();
$oFenzu = new Fenzu("Qunfas");
$focus_acc = new Accounts();


$viewid = $_REQUEST["viewname"];

if(!$viewid || $viewid == ''){
	echo '';die;
}

$listquery = "SELECT ec_account.accountid as crmid,ec_users.user_name,ec_account.*
			  FROM ec_account
			  LEFT JOIN ec_users
				   ON ec_users.id = ec_account.smownerid
			  WHERE ec_account.deleted = 0 and ec_users.id='".$current_user->id."' and ec_account.email !=''
			  and (ec_account.oneweeksendmail = 0 and ec_account.onemonthsendmail < 5) "; 
$query = $oFenzu->getModifiedCvListQuery($viewid,$listquery,"Accounts");
$result = $adb->query($query);
$num_rows = $adb->num_rows($result);
$infohtml = '';
if($num_rows > 0){
	while($row = $adb->fetch_array($result)){
		$accountname = $row['membername'];
		$email = $row['email'];
		$infohtml .=$email."(".$accountname."),\n";
	}
}

echo $infohtml;
exit();

?>