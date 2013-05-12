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
 * $Header$
 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
header('Content-Type: text/html; charset=utf-8');
set_time_limit(1200);

require_once('include/CRMSmarty.php');
require_once('modules/Import/ImportAccount.php');
require_once('modules/Import/ImportProduct.php');
require_once('modules/Import/ImportSalesorder.php');
require_once('modules/Accounts/Accounts.php');
require_once('modules/Import/Forms.php');
require_once('modules/Import/parse_utils.php');
require_once('modules/Import/ImportMap.php');
require_once('include/database/PearDatabase.php');
require_once('include/CustomFieldUtil.php');
require_once('include/utils/CommonUtils.php');

@session_unregister('column_position_to_field');
@session_unregister('totalrows');
@session_unregister('recordcount');
@session_unregister('startval');
@session_unregister('return_field_count');
@session_unregister('import_rows_in_excel');
@session_unregister('skipped_rows_in_excel');
$_SESSION['totalrows'] = '';
$_SESSION['recordcount'] = 200;
$_SESSION['startval'] = 0;
$width = 500; 

global $mod_strings;
global $mod_list_strings;
global $app_strings;
global $app_list_strings;
global $current_user;
global $import_file_name;
global $upload_maxsize;
global $root_directory;
global $import_dir;

$focus_impacc = new ImportAccount();
$focus_imppro = new ImportProduct();
$focus_impso = new ImportSalesorder();

$focus = 0;
$delimiter = ',';
$max_lines = 3;

$has_header1 = 1;
$overwrite1 = 1;

$has_header2 = 1;
$overwrite2 = 1;


global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$smarty = new CRMSmarty();

$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("IMP", $import_mod_strings);
$smarty->assign("MODULE", $_REQUEST['module']);

$fliename_tmp = $_REQUEST['filename'];
$filename_arr = explode(",",$fliename_tmp);


$dir_root = $root_directory."cache/upload/";


$filename_1 = $dir_root.$filename_arr[1];
$filename_2 = $dir_root.$filename_arr[2];


$eof1 = false;
$eof2 = false;
$file_arr = array();
if (file_exists($filename_1)) {
    $file_arr['orderlist'] = $filename_1;
	$eof1 = true;;
} 
if (file_exists($filename_2)) {
    $file_arr['orderdetail'] = $filename_2;
	$eof2 = true;
} 

if(!$eof1){
	show_error_import("Order List Csv is Not Exist!");
	exit;
}
if(!$eof2){
	show_error_import("Item List Csv is Not Exist!");
	exit;
}


$tmp_file_name1 = $file_arr['orderlist'];
$tmp_file_name2 = $file_arr['orderdetail'];


// Now parse the file and look for errors
$ret_value = 0;

/*
if ($_REQUEST['source'] == 'act')
{
	$ret_value = parse_import_act($tmp_file_name,$delimiter,$max_lines,$has_header);//act
}
else
{
	$ret_value = parse_import($tmp_file_name,$delimiter,$max_lines,$has_header);//csv
}
*/
$ret_value1 = parse_import_csv_new($tmp_file_name1,$delimiter,$max_lines,$has_header1);//excel
$ret_value2 = parse_import_csv_new($tmp_file_name2,$delimiter,$max_lines,$has_header2);//excel



if ($ret_value1 == -1)
{
	show_error_import( $mod_strings['LBL_CANNOT_OPEN'] );
	exit;
}
else if ($ret_value1 == -2)
{
	show_error_import( $mod_strings['LBL_NOT_SAME_NUMBER'] );
	exit;
}
else if ( $ret_value1 == -3 )
{
	show_error_import( $mod_strings['LBL_NO_LINES'] );
	exit;
}
if ($ret_value2 == -1)
{
	show_error_import( $mod_strings['LBL_CANNOT_OPEN'] );
	exit;
}
else if ($ret_value2 == -2)
{
	show_error_import( $mod_strings['LBL_NOT_SAME_NUMBER'] );
	exit;
}
else if ( $ret_value2 == -3 )
{
	show_error_import( $mod_strings['LBL_NO_LINES'] );
	exit;
}

@session_unregister('import_has_header1');
$_SESSION['import_has_header1'] = $has_header1;

@session_unregister('import_has_header2');
$_SESSION['import_has_header2'] = $has_header2;

@session_unregister('import_overwrite1');
$_SESSION['import_overwrite1'] = $overwrite1;

@session_unregister('import_overwrite2');
$_SESSION['import_overwrite2'] = $overwrite2;


$rows1 = $ret_value1['rows'];
$ret_field_count1 = $ret_value1['field_count'];

$rows2 = $ret_value2['rows'];
$ret_field_count2 = $ret_value2['field_count'];

$list_count  = count($rows1);
$detail_count = count($rows2);


//"店铺名称"=>"belongshop",
$accfieldarr = array("买家会员名"=>"membername","买家支付宝账号"=>"alipay_account",
					 "收货人姓名"=>"accountname","收货地址"=>"bill_street","联系电话"=>"tel","联系手机"=>"phone");
$accfieldkeysarr = array_keys($accfieldarr);

$phonearr = array("联系电话","联系手机");


$sofiedlarr = array("订单编号"=>'oid',"买家会员名"=>"buyer_nick","买家支付宝账号"=>'buyer_alipay_no',"买家应付货款"=>'total',"买家应付邮费"=>'postage',"买家实际支付金额"=>'payment',"订单状态"=>'orderstatus',"买家留言"=>'buyer_message',"收货人姓名"=>'receiver_name',"收货地址"=>'receiver_street',"运送方式"=>'shipping_type',"联系电话"=>'receiver_tel',
"联系手机"=>'receiver_phone',"订单创建时间"=>'createdtime',"订单付款时间"=>'pay_time',"宝贝总数量"=>'num',"物流单号"=>'wl_no',"物流公司"=>'wl_company',"订单备注"=>'description');
$sofiedlkeysarr = array_keys($sofiedlarr);



$focus_impacc->ClearColumnFields();
$focus_impso->ClearColumnFields();

$pix1 = $width / $list_count; 
$progress1 = 0;

header('Content-Type: text/html; charset=utf-8');
flush();

echo "<script language=\"JavaScript\">
function updateProgress(sMsg, iWidth)
{ 
document.getElementById(\"status1\").innerHTML = sMsg;
document.getElementById(\"progress\").style.width = iWidth + \"px\";
document.getElementById(\"percent\").innerHTML = parseInt(iWidth / ". $width ." * 100) + \"%\";
	if(sMsg == \"操作完成!\"){
	document.getElementById(\"listcontent\").style.display =\"none\";
	}
}
</script>";
$width8 =  $width+8;
echo "<div id=\"listcontent\"   style=\"width:527px;padding-left:365px;\">
	<div style=\"margin: 4px; padding: 8px; border: 1px solid gray; background: #EAEAEA; width: ". $width8 .".px\" align=\"left\">
	<div align=\"center\">订单列表导入进度条:</div>
	<div style=\"padding: 0; background-color: white; border: 1px solid navy; width: ". $width ."px\" align=\"left\">
	<div id=\"progress\" style=\"padding: 0; background-color: #FFCC66; border: 0; width: 0px; text-align: center; height: 16px\" ></div>
	</div>
	<div id=\"status1\" >&nbsp;</div>
	<div id=\"percent\" style=\"position: relative; top: -30px; text-align: center; font-weight: bold; font-size: 8pt\" >0%</div>
	</div>
</div>";

$success_account = 0;
$success_salesorder = 0;
foreach($rows1 as $key=>$val){
	if($key > 0){
		foreach($val as $k=>$v){
			$title = trim($titlearr[$k]);
			if(in_array($title,$accfieldkeysarr)){
				if(in_array($title,$phonearr)){
					$focus_impacc->column_fields[$accfieldarr[$title]]=preg_replace('/\'/', '',$v);
				}elseif($title == '收货地址'){
					$address = explode(" ",$v);
					if(is_array($address) && count($address) == 4){
						$streetcodestr ='';
						for($i=0;$i<count($address);$i++){
							if($i==0){
								$focus_impacc->column_fields['bill_state']=$address[$i];
							}elseif($i==1){
								$focus_impacc->column_fields['bill_city']=$address[$i];
							}elseif($i==2){
								$focus_impacc->column_fields['bill_district']=$address[$i];
							}else{
								$streetcodestr .=$address[$i];
							}
						}
						if($streetcodestr !=''){
							$codestr = substr($streetcodestr, -8);
							$codestr = preg_replace("/[\(\)]/",'',$codestr);
							if(preg_match("/^[0-9]{6}$/",$codestr)){
								$focus_impacc->column_fields['bill_code']=$codestr;
								$streetstr = substr($streetcodestr, 0,-8);
								$focus_impacc->column_fields['bill_street']=$streetstr;
							}else{
								$focus_impacc->column_fields['bill_street']=$streetcodestr;
							}
						}
					}else{
						$focus_impacc->column_fields['bill_street']=$v;
					}
				}else{
					$focus_impacc->column_fields[$accfieldarr[$title]]=$v;
				}
			}

			if(in_array($title,$sofiedlkeysarr)){
				if(in_array($title,$phonearr)){
					$focus_impso->column_fields[$sofiedlarr[$title]]=preg_replace('/\'/', '',$v);
				}elseif($title == '收货地址'){
					$address = explode(" ",$v);
					if(is_array($address) && count($address) ==4){
						$streetcodestr ='';
						for($i=0;$i<count($address);$i++){
							if($i==0){
								$focus_impso->column_fields['receiver_state']=$address[$i];
							}elseif($i==1){
								$focus_impso->column_fields['receiver_city']=$address[$i];
							}elseif($i==2){
								$focus_impso->column_fields['receiver_district']=$address[$i];
							}else{
								$streetcodestr .=$address[$i];
							}
						}
						if($streetcodestr !=''){
							$codestr = substr($streetcodestr, -8);
							$codestr = preg_replace("/[\(\)]/",'',$codestr);
							if(preg_match("/^[0-9]{6}$/",$codestr)){
								$focus_impso->column_fields['receiver_code']=$codestr;
								$streetstr = substr($streetcodestr, 0,-8);
								$focus_impso->column_fields['receiver_street']=$streetstr;
							}else{
								$focus_impso->column_fields['receiver_street']=$streetcodestr;
							}
						}
					}else{
						$focus_impacc->column_fields['bill_street']=$v;
					}
				}else{
					$focus_impso->column_fields[$sofiedlarr[$title]]=$v;
				}

			}
		}
		 $eof1 = $focus_impacc->save("Accounts");
		 if($eof1){
			$success_account +=1;
		 }
		 $eof2 = $focus_impso->save("SalesOrder");
		 if($eof2){
			$success_salesorder +=1;
		 }
	}else{
		$titlearr = $val;
	}
	
	$key1 = $key+1;
	echo "<script language=\"JavaScript\">
	updateProgress('当前进度:第".$key1."条', ". min($width, intval($progress1)).");
	</script>";
	
	flush();
	$progress1 += $pix1;
}

echo "<script language=\"JavaScript\">
updateProgress(\"操作完成!\", ".$width.");
</script>";


flush();	

$smarty->assign("success_account", $success_account);
$smarty->assign("success_salesorder", $success_salesorder);
	
$profiedlarr = array("标题"=>'productname',"价格"=>'price',"商家编码"=>'outer_id');
$profiedlkeysarr = array_keys($profiedlarr);

$titlearr =  array();

$focus_imppro->ClearColumnFields();

$pix2 = $width / $detail_count; 
$progress2 = 0;

echo "<script language=\"JavaScript\">
function updateProgress2(sMsg, iWidth)
{ 
document.getElementById(\"status2\").innerHTML = sMsg;
document.getElementById(\"progress2\").style.width = iWidth + \"px\";
document.getElementById(\"percent2\").innerHTML = parseInt(iWidth / ".$width." * 100) + \"%\";
if(sMsg == \"操作完成!\"){
document.getElementById(\"detailcontent\").style.display =\"none\";
}
}
</script>";

echo "<div id=\"detailcontent\"  style=\"width:527px;padding-left:365px;\">
	<div style=\"margin: 4px; padding: 8px; border: 1px solid gray; background: #EAEAEA; width: ". $width8 ."px\" align=\"left\">
	<div align=\"center\">宝贝列表导入进度条:</div>
	<div style=\"padding: 0; background-color: white; border: 1px solid navy; width: ".$width."px\" >
	<div id=\"progress2\" style=\"padding: 0; background-color: #FFCC66; border: 0; width: 0px; text-align: center; height: 16px\"></div>
	</div>
	<div id=\"status2\">&nbsp;</div>
	<div id=\"percent2\" style=\"position: relative; top: -30px; text-align: center; font-weight: bold; font-size: 8pt\">0%</div>
	</div>
</div>";

$success_product = 0;

foreach($rows2 as $key=>$val){
	if($key > 0){
		foreach($val as $k=>$v){
			$title = trim($titlearr[$k]);
			if(in_array($title,$profiedlkeysarr)){
				$focus_imppro->column_fields[$profiedlarr[$title]]=$v;
			}
		}
		$eof3 = $focus_imppro->save("Products");
		if($eof3){
			$success_product  +=1;
		}
	}else{
		$titlearr = $val;
	}
	$key1 = $key+1;
	echo "<script language=\"JavaScript\">
	updateProgress2(\"当前进度:第'".$key1."'条\", ". min($width, intval($progress2)) .");
	</script>";

	flush();
	$progress2 += $pix2;
}

echo "<script language=\"JavaScript\">
updateProgress2(\"操作完成!\", ".$width.");
</script>";

flush();	
$smarty->assign("success_product", $success_product);
$inventprofiedlarr = array("订单编号"=>'oid',"标题"=>'productname',"价格"=>'listprice',"购买数量"=>'quantity',"商品属性"=>'comment',"备注"=>'comment2');
$inventprofiedlkeysarr = array_keys($inventprofiedlarr);

$titlearr =  array();
foreach($rows2 as $key=>$val){
	if($key > 0){
		foreach($val as $k=>$v){
			$title = trim($titlearr[$k]);
			if(in_array($title,$inventprofiedlkeysarr)){
				$focus_imppro->column_fields[$inventprofiedlarr[$title]]=$v;
			}
		}
		$focus_imppro->saveInventPro();
	}else{
		$titlearr = $val;
	}

}
require_once ('getBuyNums.php');

$smarty->display("ImportStepNew2.tpl");

?>

