<?php

//时间段
$sjdarr= array("0"=>"今天","1"=>"Part1","2"=>"Part2","3"=>"Part3","4"=>"Part4","5"=>"Part5","6"=>"Part6","7"=>"所有");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd">
<html>
<head>
<title>同步三个月内订单 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body, div input { font-family: Tahoma; font-size: 9pt }
</style>
<style type="text/css">@import url("themes/softed/style.css");</style>
<script language="JavaScript" type="text/javascript" src="include/js/zh_cn.lang.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/general.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/json.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
</head>

<body>

<table style="background-color: rgb(234, 234, 234);margin-top:-16px;" class="small" width="100%" border="0" cellpadding="3" cellspacing="1">
 <tr style="height: 30px;" bgcolor="white" valign="bottom">
    <td width="100%" colspan="2" class="detailedViewHeader" style="font-weight:bolder;">
    	同步三个月内订单 >> <?php echo '<a href="index.php?module=Accounts&action=ListView">返回客户</a>'; ?>
    </td>
  </tr>
  <tr bgcolor="white" style="height: 50px;">
   <td class="dvtCellLabel" align="right" style="width:40%">选择时间段</td>
    <td width="100%"  align="left">
   <select name="banyue" id="banyue">
   <?php 
	foreach($sjdarr as $key=>$sjd){
			echo "<option value='".$key."'>".$sjd."</option>";
	 }
	?>
   </select><font color=red>(*如果数据太多,请通过6次，顺序导入。默认导入：今天)</font>
   </td>
  </tr>
  <tr bgcolor="white" style="height: 40px;">
   <td class="dvtCellLabel" align="right" style="width:40%">&nbsp;</td>
    <td width="100%"  align="left">
   <input type="button" class="crmButton small edit" value=" 开始同步 " id="button"  name="button" onclick="doSubmit();">
   <div id="status" style="position:absolute;display:none;left:630px;top:90px;height:27px;white-space:nowrap;"><img src="themes/softed/images/status.gif"></div>
   </td>
  </tr>
  
</table>
<br>
<div id="show" style="display:none;">
<table style="background-color: rgb(234, 234, 234);margin-top:-16px;" class="small" width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr style="height: 30px;" bgcolor="white" valign="bottom">
    <td class="dvtCellLabel" align="right" style="width:40%">&nbsp;</td>
    <td width="100%"  style="font-weight:bolder;"><br>
    	<div id="ListViewContents">
		&nbsp;
		</div>
    </td>
  </tr>
</table>
</div>

</body>
</html>

<script type="text/javascript">
function doSubmit()
{
	$("status").style.display="inline";
	var banyue = document.getElementById('banyue').value;
	document.getElementById('button').disabled = "disabled";
	new Ajax.Request(
                'index.php',
                {queue: {position: 'end', scope: 'command'},
                        method: 'post',
                        postBody: 'module=Synchronous&action=PopupSynIn&banyue='+banyue,
                        onComplete: function(response) {
                                $("status").style.display="none";
                                result = response.responseText;
								$("ListViewContents").innerHTML= result;
								document.getElementById('show').style.display  = 'block';
								document.getElementById('button').disabled = "";
                                
                        }
                }
        );
	
}
</script>