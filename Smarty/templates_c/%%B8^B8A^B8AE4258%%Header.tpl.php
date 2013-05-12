<?php /* Smarty version 2.6.18, created on 2012-12-21 10:58:21
         compiled from Header.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['CURRENT_USER']; ?>
 - <?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['CATEGORY']]; ?>
 - <?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE_NAME']]; ?>
 - <?php echo $this->_tpl_vars['APP']['LBL_BROWSER_TITLE']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['APP']['LBL_CHARSET']; ?>
">
<style type="text/css">@import url("themes/<?php echo $this->_tpl_vars['THEME']; ?>
/style.css");</style>
<style type="text/css">@import url("jscalendar/calendar-win2k-cold-1.css");</style>
<script language="JavaScript" type="text/javascript" src="include/js/zh_cn.lang.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/general.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/json.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/scriptaculous.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/Calendar/script.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/dom-drag.js"></script>	
<script type="text/javascript" src="include/windows/window.js"> </script>
<script type="text/javascript" src="include/windows/window_effects.js"> </script>
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-zh.js"></script>
<link href="include/windows/themes/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<link href="include/windows/themes/default.css" rel="stylesheet" type="text/css"></link>
<script language="javascript">
   var javaCalendarFirstDayOfWeek = 1;
   var userDateFormat = "yyyy-mm-dd";
</script>
</head>
<body leftmargin=0 topmargin=0 marginheight=0 marginwidth=0 class=small >
<div id="status" style="position:absolute;display:none;left:930px;top:95px;height:27px;white-space:nowrap;"><img src="<?php echo $this->_tpl_vars['IMAGEPATH']; ?>
status.gif"></div>
<div id="SelCustomer_popview" class="layerPopup" style="position: absolute; z-index: 60; "></div>