<?php
$root_directory = dirname(__FILE__)."/";
require($root_directory.'include/init.php');

if(empty($_SESSION['topsession'])){
	redirect("Login.php"); die;
}

$current_user = new Users();


//$curyear=date('Y');
//$curmonth=date('m');
//$curday=date('d');
//
//$weekdays=array('日','一','二','三','四','五','六');
//$curweekday=$weekdays[date('w')];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD>
        <TITLE></TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">

<SCRIPT src="include/mainresource/js.js" type='text/javascript charset=gb2312'></SCRIPT>
<SCRIPT src="include/js/general.js" type='text/javascript'></SCRIPT>
<LINK href="include/mainresource/style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.6000.17092" name=GENERATOR></HEAD>
<BODY style="MARGIN: 0px">

<DIV id=divTop style="DISPLAY: block">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD class=top_bg1 style="PADDING-LEFT: 0px;font-weight:bolder; font-size:18px; color:#6093BD;" width=200px rowSpan=2 nowrap>
    <!-- <img src="themes/softed/images/ruichencrmtitle.jpg" border="0" height="40px;">-->
    易客CRM淘宝版 v1.0&nbsp;
    </TD>
    <TD class=top_bg2 align=right width="100%" rowSpan=2>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=topb style="PADDING-RIGHT: 12px;" vAlign=center align=right height=40>
		  &nbsp;&nbsp;&nbsp;&nbsp;	
		  你好:<?php echo $_SESSION['nick'];?>  <SPAN class=topa2>|</SPAN>
		  <A class=topb id=help title='首页' href="index.php?module=Accounts&action=index" target="main" style="CURSOR: pointer; TEXT-DECORATION: none">首页</A>
          <SPAN class=topa2>|</SPAN>
          <A class=topb id=help title='意见反馈' href="http://www.c3crm.com/bbs/" target="_blank" style="CURSOR: pointer; TEXT-DECORATION: none">意见反馈</A>
          <SPAN class=topa2>|</SPAN>
		  <A class=topb id=help title=退出 href="index.php?module=Users&action=UsersAjax&file=Logout" target="_top" style="CURSOR: pointer; TEXT-DECORATION: none">退出 </A>

          
		  </TD></TR>
       
		  </TBODY></TABLE>
	</TD></TR>
		  
</TBODY></TABLE>
<TABLE height=2 cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD class=top_bg3 style="PADDING-LEFT: 10px; VERTICAL-ALIGN: bottom"></TD>
    <TD class=top_bg3 
    style="PADDING-RIGHT: 10px; PADDING-BOTTOM: 2px; WIDTH: 88px" vAlign=bottom 
    align=right></TD></TR></TBODY></TABLE></DIV>
<script>
//  function updateCurrentTime(){
//      var curtime=new Date();
//      var hour=curtime.getHours();
//      if(hour<10) hour=""+"0"+hour;
//      var minute=curtime.getMinutes();
//      if(minute<10) minute=""+"0"+minute;
//      var sec=curtime.getSeconds();
//      if(sec<10) sec=""+"0"+sec;
//      document.getElementById('timecn').innerHTML=""+hour+':'+minute+":"+sec;
//  }
//  setInterval(updateCurrentTime,500);
  function openCalendar(){
      ///window.open("index.php?module=Yearcalendars&action=index",'calendar','width=500,height=300,resizable=1,scrollbars=1');
	  window.open("calender.html",'calendar','width=700,height=500,resizable=1,scrollbars=1');
  }
</script>
</BODY></HTML>
