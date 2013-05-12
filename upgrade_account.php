<?php
require_once('config.inc.php');
require_once('include/utils/utils.php');
require_once('include/database/PearDatabase.php');
global $adb;

/**




addTableFiles("ec_account","oneweekbuy","int");
insertIntoField("ec_account","oneweekbuy","Accounts",1,"一周购买次数");

addTableFiles("ec_account","onemonthbuy","int");
insertIntoField("ec_account","onemonthbuy","Accounts",1,"一月购买次数");

addTableFiles("ec_account","threemonthbuy","int");
insertIntoField("ec_account","threemonthbuy","Accounts",1,"三月购买次数");

addTableFiles("ec_account","oneweeksendmess","int");
insertIntoField("ec_account","oneweeksendmess","Accounts",1,"一周发送短信次数");

addTableFiles("ec_account","onemonthsendmess","int");
insertIntoField("ec_account","onemonthsendmess","Accounts",1,"一月发送短信次数");

addTableFiles("ec_account","threemonthsendmess","int");
insertIntoField("ec_account","threemonthsendmess","Accounts",1,"三月发送短信次数");

addTableFiles("ec_account","oneweeksendmail","int");
insertIntoField("ec_account","oneweeksendmail","Accounts",1,"一周发送邮件次数");

addTableFiles("ec_account","onemonthsendmail","int");
insertIntoField("ec_account","onemonthsendmail","Accounts",1,"一月发送邮件次数");

addTableFiles("ec_account","threemonthsendmail","int");
insertIntoField("ec_account","threemonthsendmail","Accounts",1,"三月发送邮件次数");

addTableFiles("ec_account","lastsendmessdate","date");
insertIntoField("ec_account","lastsendmessdate","Accounts",5,"最新发送短信日期");


addTableFiles("ec_account","lastsendmaildate","date");
insertIntoField("ec_account","lastsendmaildate","Accounts",5,"最新发送邮件日期");

addTableFiles("ec_account","allsuccessbuy","int");
insertIntoField("ec_account","allsuccessbuy","Accounts",1,"总共成功购买次数");
**/

echo "OK!";
/**
 * 给表添加字段
 * @param $tableName 要添加字段的表名
 * @param $add_filelds 字段名称
 * @param $type 字段类型 默认 int
 * @param $is_null 是否为空 默认 null
 */

function addTableFiles($tableName,$add_filelds,$type = "int",$size="30",$is_null = "null"){
	global $adb;
	if($tableName && $tableName != "" && $add_filelds && $add_filelds != ""){
		if($type == "int"){
			$fileldtype = "INT";
		}else if($type == "string"){
			$fileldtype = "VARCHAR( ".$size." ) CHARACTER SET utf8 COLLATE utf8_general_ci";
		}else if($type == "varchar"){
			$fileldtype = "VARCHAR( ".$size." ) ";
		}else if($type == "price"){
			$fileldtype = "DECIMAL( 19, 2 )";
		}else if($type == "timestamp"){
			$fileldtype = "timestamp";
		}else if($type == "numeric"){
			$fileldtype = "numeric( 18, 4 )";
		}else if($type == "date"){
			$fileldtype = "DATE";
		}else if($type == "time"){
			$fileldtype = "DATETIME";
		}else if($type == "uniqueidentifier"){
			$fileldtype = "uniqueidentifier";
		}else if($type == "text"){
			$fileldtype = "TEXT";
		}else{
			$fileldtype = "INT";
		}
		if($is_null == "null"){
			$is_null = "NULL";
		}else{
			$is_null = "NOT NULL";
		}
		///
		$query = "ALTER TABLE ".$tableName." ADD ".$add_filelds." ".$fileldtype." ".$is_null." ";
		echo $query;
		$adb->query($query);
		return true;
	}
	return false;
	
}
/**
 * 将一个字段插入到关联字段中去
 * @param $tableName 要插入的表名
 * @param $add_filelds 要插入的字段名
 * @param $modues 表相关模块名
 * @param $uitype 字段显示格式
 * @param $labelName 字段描述
 */
function insertIntoField($tableName,$add_filelds,$modues,$uitype,$labelName){
	global $adb;
	$tabid = getTabid($modues);
	$blockid = get_block_id($tabid);
	$fieldid = $adb->getUniqueID("ec_field");
	$query = "insert into ec_field values (".$tabid.",".$fieldid.",'".$add_filelds."','".$tableName."',1,'".$uitype."','".$add_filelds."','".$labelName."',1,0,0,100,5,".$blockid.",1,'V~O',1,'','BAS')";
	echo $query."<br>";
	$adb->query($query);

	insertModuleProfile2field_1($tabid,$fieldid);
}
function insertModuleProfile2field_1($tab_id,$field_id)
{
	global $adb;
	$adb->query("insert into ec_def_org_field values (".$tab_id.",".$field_id.",0,1)");
	$query = "SELECT * FROM ec_profile order by profileid";
	$fld_result = $adb->query($query);
	$num_rows = $adb->num_rows($fld_result);
	for($i=0; $i<$num_rows; $i++)
	{
		 $profileid = $adb->query_result($fld_result,$i,'profileid');
		 $adb->query("insert into ec_profile2field values (".$profileid.",".$tab_id.",".$field_id.",0,1)");
		 //$adb->query("insert into ec_profile2utility values (".$profileid.",".$tab_id.",11,0)");//approve permission
	}
	
}
function get_block_id($tab_id)
{
	global $adb;
	$query = "SELECT blockid FROM ec_blocks where tabid=".$tab_id." order by blockid";
	$fld_result = $adb->query($query);
	$num_rows = $adb->num_rows($fld_result);
	if($num_rows > 0)
	{
		 $blockid = $adb->query_result($fld_result,0,'blockid');
		 return $blockid;		 
	}
	return 0;
}

function get_next_blockid() {
	global $adb;
	$query = "select max(blockid) as blockid from ec_blocks";
	$result = $adb->query($query);
	$block_id = $adb->query_result($result,0,"blockid") + 1;
	return $block_id;
}
?>