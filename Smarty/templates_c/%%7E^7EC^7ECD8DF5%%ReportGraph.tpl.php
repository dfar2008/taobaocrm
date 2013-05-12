<?php /* Smarty version 2.6.18, created on 2012-12-21 15:35:43
         compiled from ListViewReport/ReportGraph.tpl */ ?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<TITLE><?php echo $this->_tpl_vars['TITLE']; ?>
</TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="include/phpreports/sales.css">
<link href="themes/images/style_cn.css" rel="stylesheet" type="text/css">
<link href="themes/images/report.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="themes/images/tabpane.js"></script>
<link href="themes/images/tab.css" rel="stylesheet" type="text/css">

</HEAD>
<body BGCOLOR="#FFFFFF" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" style="text-align:center;" align="center">
<div class="mtitle">
<div class="mtitle-row">&nbsp;</div>
<?php echo $this->_tpl_vars['TITLE']; ?>

</div>

<div  style="position: relative;height: 20px;margin-bottom: 20px">
    <table border="0" align="left" width="100%">
        <form method="post" action="index.php">
            <?php echo $this->_tpl_vars['HIDDENFIELDHTML']; ?>

            <tbody>
                <tr>
                    <td align="center">
                       显示类型: <select name="graphtype">
                            <?php echo $this->_tpl_vars['GRAPHTYPEOPTS']; ?>

                        </select>
                       &nbsp; &nbsp;统计项目: <select name="grouptype">
                            <?php echo $this->_tpl_vars['COLLECTCOLUMNOPTS']; ?>

                        </select>
                       <input type="submit" value="确定" name="submit" class="small button save">
                    </td>
                </tr>
            </tbody>
        </form>
    </table>
</div>

<div class="tab-pane" id="tabPane1">
	<div align="left" class="tab-page" id="tabPage1">
	<h2 class="tab">报表图形</h2>
	<br>
	<?php echo $this->_tpl_vars['REPORT_FLASH']; ?>

	</div>
	<div class="tab-page" id="tabPage2">
		<h2 class="tab">报表数据</h2>
		
		
			<div id="report">
				<div class="reportTitle"><?php echo $this->_tpl_vars['TITLE']; ?>
</div>
				<?php echo $this->_tpl_vars['REPORT_DATA']; ?>

			</div>
	</div>
</div>
</body>
</html>