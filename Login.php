<?php

$theme_path="themes/softed/";
$image_path="include/images/";
//require_once($theme_path.'layout_utils.php');
//require_once('include/utils/utils.php');

//we don't want the parent module's string file, but rather the string file specifc to this subpanel
$current_language = "zh_cn";
$default_language = "zh_cn";
$default_theme = "softed";
$default_user_name = "";
$default_password = "";
$default_company_name = "";
//$current_module_strings = return_module_language($current_language, 'Users');
//$app_language = return_application_language($current_language, 'Users');

?> 
<HTML><HEAD><TITLE>易客CRM淘宝版-客户关系管理系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=UTF-8">
<META content="客户关系管理系统" name=title>
<META content="基于电子商务的客户管理系统" name=description>
<META content="客户关系管理系统" name=keywords>
<STYLE type=text/css>
.word_10p {
	FONT-WEIGHT: bold; FONT-SIZE: 10pt; COLOR: #000000; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"
}
.font_9p {
	FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 18px; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"
}
.title {
	FONT-WEIGHT: bold; FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 20px; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"
}
.inputbg1 {
 background-image:url(include/images/inputbg1.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
.inputbg2 {
 background-image:url(include/images/inputbg2.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
.inputbg3 {
 background-image:url(include/images/inputbg3.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
.inputbg {
 background-image:url(include/images/inputbg.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
</STYLE>

<META content="MSHTML 6.00.2800.1561" name=GENERATOR>

</HEAD>
<BODY onLoad="logining_load()">
<DIV id=main>
<DIV id=msgbox>

</DIV>
<DIV id=loginbox align="center">
<form action="index.php" method="post" name="loginform" id="loginform">
<input type="hidden" name="module" value="Users">
<input type="hidden" name="action" value="Authenticate">
<input type="hidden" name="return_module" value="Users">
<input type="hidden" name="return_action" value="Login">
<TABLE cellSpacing=0 cellPadding=0 width=720 border=0>
<INPUT 	type=hidden name=returnURL> 
  <TBODY>
  <TR><td colspan="4"><a href="http://www.crmone.cn" border="0" target="_blank"><img src="include/images/logo.gif" border="0"></a><br><br><br></td></TR>
  <TR>
    <TD width=30><IMG height=258 src="include/images/login_img01.gif" 
width=30></TD>
    <TD width=364 background="include/images/login_bg01.gif">
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
         
        <TR>
          <TD vAlign=top width=330>
            <TABLE class=font_9p cellSpacing=2 cellPadding=2 width=350 
            align=center border=0>
              <TBODY>              
              <TR>
                <TD>&nbsp;</TD>
                <TD> 
                <a href="http://container.open.taobao.com/container?appkey=12385869">进入系统</a><br>
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    <TD vAlign=top background="include/images/login_bg02.gif">
      <P><BR><BR></P> 
      <TABLE class=font_9p cellSpacing=2 cellPadding=2 width=240 align=right 
      border=0>
        <TBODY>
        <TR vAlign=top>
          <TD class=word_10p height=20><FONT color=#ffffff>易客CRM淘宝版，</FONT></TD></TR>
        <TR>
          <TD class=word_10p height=20><FONT 
        color=#ffffff>为您提供简单、易用的客户关系管理系统，让您更专注于您的专业领域！</FONT></TD></TR>
        <TR>
          <TD>&nbsp;</TD></TR>
        <TR vAlign=top>
          <TD   height=18><FONT color=#ffffff>E-mail: sales@c3crm.cn</FONT></TD></TR>         
        </TBODY></TABLE></TD>
    <TD width=30><IMG height=258 src="include/images/login_img02.gif" 
  width=30></TD></TR> </TABLE></FORM></DIV>
</BODY></HTML>
<script type="text/javascript" src="http://toptrace.taobao.com/assets/getAppKey.js" topappkey="12385869" defer="defer"></script>