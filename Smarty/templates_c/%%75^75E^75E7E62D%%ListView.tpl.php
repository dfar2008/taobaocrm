<?php /* Smarty version 2.6.18, created on 2012-12-21 11:18:54
         compiled from Newmemberreports/ListView.tpl */ ?>
<link href="include/ajaxtabs/ajaxtabs.css" type="text/css" rel="stylesheet"/>

<LINK REL="stylesheet" TYPE="text/css" HREF="include/phpreports/sales.css">
<link href="themes/images/style_cn.css" rel="stylesheet" type="text/css">
<link href="themes/images/report.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="themes/images/tabpane.js"></script>
<link href="themes/images/tab.css" rel="stylesheet" type="text/css">
<style type="text/css">
<?php echo '
div.autocomplete {
  position:absolute;
  width:250px;
  background-color:white;
  border:1px solid #888;
  margin:0px;
  padding:0px;
}
div.autocomplete ul {
  list-style-type:none;
  margin:0px;
  padding:0px;
}
div.autocomplete ul li.selected { background-color: #ffb;}
div.autocomplete ul li {
  list-style-type:none;
  display:block;
  margin:0;
  padding:2px;
  height:32px;
  cursor:pointer;
}
'; ?>

</style>
<table style="background-color: rgb(234, 234, 234);" class="small" width="100%" border="0" cellpadding="3" cellspacing="1">
 <tr style="height: 25px;" bgcolor="white">
    <td width="100%" colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" class="detailedViewHeader" style="font-weight:bolder;">
        <?php echo $this->_tpl_vars['title']; ?>
&nbsp;
        <?php if ($this->_tpl_vars['connection'] && $this->_tpl_vars['connection'] != ''): ?>
        	>> <?php echo $this->_tpl_vars['connection']; ?>

        <?php endif; ?>
    </td>
  </tr>
 <tr style="height: 25px;" bgcolor="white" id="searchtr">
   <td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" style="font-weight:bolder;">
		<form action="index.php" method="post">
        	<input type="hidden" value="<?php echo $this->_tpl_vars['MODULE']; ?>
" name="module">
            <input type="hidden" value="ListView" name="action">
            <input type="hidden" value="1" name="start">
        <table class="small" border="0" cellpadding="3" cellspacing="1">
          <tr>
            <td nowrap="nowrap">
            		最新下单时间：
            		<select name="stdDateFilter" style="WIDTH: 150px" class="select" onchange='showDateRange_jscal_field(this.options[this.selectedIndex].value )'>
                    	<?php echo $this->_tpl_vars['dateFilterHtml']; ?>

                    </select>&nbsp;
                    开始时间：
                    <input name="startdate" id="jscal_field_date_start" type="text" 
                    size="12" class="importBox" style="width:80px;" value="<?php echo $this->_tpl_vars['startdate']; ?>
">
                    <img src="themes/softed/images/calendar.gif" id="jscal_trigger_date_start">&nbsp;
                    <script type="text/javascript">
					<?php echo '
					Calendar.setup ({
						inputField : "jscal_field_date_start", ifFormat : "%Y-%m-%d", showsTime : false, 
						button : "jscal_trigger_date_start", singleClick : true, step : 1
									})
					'; ?>

					</script>
                    结束时间：
                    <input name="enddate" id="jscal_field_date_end" type="text" 
                    size="12" class="importBox" style="width:80px;" value="<?php echo $this->_tpl_vars['enddate']; ?>
">
                    <img src="themes/softed/images/calendar.gif" id="jscal_trigger_date_end">
					<script type="text/javascript">
					<?php echo '
					Calendar.setup ({
						inputField : "jscal_field_date_end", ifFormat : "%Y-%m-%d", showsTime : false, 
						button : "jscal_trigger_date_end", singleClick : true, step : 1
									})
					'; ?>

					</script>
            </td>
            <td nowrap="nowrap">
            	时间统计方式：
            	<select name="grouptype" id="grouptype">
                    <?php $_from = $this->_tpl_vars['GROUPTYPEARR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
                    	<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['grouptype']): ?>
							<?php $this->assign('grouptypeed', 'selected'); ?>
                        <?php else: ?>
                        	<?php $this->assign('grouptypeed', ""); ?>
                        <?php endif; ?>
                    	<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php echo $this->_tpl_vars['grouptypeed']; ?>
><?php echo $this->_tpl_vars['val']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
            <td nowrap="nowrap">
            	统计图表类型：
				<select name="flashtype" id="flashtype">
                    <?php $_from = $this->_tpl_vars['FLASHTYPEARR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
                    	<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['flashtype']): ?>
							<?php $this->assign('flashtypeed', 'selected'); ?>
                        <?php else: ?>
                        	<?php $this->assign('flashtypeed', ""); ?>
                        <?php endif; ?>
                    	<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php echo $this->_tpl_vars['flashtypeed']; ?>
><?php echo $this->_tpl_vars['val']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
            <td nowrap="nowrap">
            	<input type="submit" value=" 查看 " class="crmbutton save"/>
            </td>
          </tr>
        </table>
        </form>
   </td>
 </tr>
      <tr style="height: 25px;">
<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" style=" background-color:#fff; padding:0px; margin:0px;">
            <ul id="countrytabs" class="shadetabs">
            <?php $_from = $this->_tpl_vars['SETYPEARR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
                 <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['SETYPE']): ?>
                    <?php $this->assign('selected', 'tablink selected'); ?>
                <?php else: ?>
                    <?php $this->assign('selected', 'tablink'); ?>
                <?php endif; ?>
            	<li><a href="#" id="<?php echo $this->_tpl_vars['key']; ?>
" rel="#default" class="<?php echo $this->_tpl_vars['selected']; ?>
" onclick="getTabView('<?php echo $this->_tpl_vars['key']; ?>
',this);return false;"><?php echo $this->_tpl_vars['val']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
            </ul>
        </td>
    </tr>
  <!-- /视图 -->
<?php if ($this->_tpl_vars['LISTENTRYHTML'] && $this->_tpl_vars['LISTENTRYHTML'] != ''): ?>
    <tr style="height: 25px; display:none;" class='report_part'> 
        <td class="lvtCol" nowrap align='center'>序号</td>
        <td class="lvtCol" nowrap align='center'>统计时间</td>
        <td class="lvtCol" nowrap align='center'>新增客户数量</td>
    </tr>
    </tr>
      <?php echo $this->_tpl_vars['LISTENTRYHTML']; ?>

<tr style="height: 25px;" bgcolor="white" id="flash_tr" class='flash_part'>
    <td width="100%" colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" align="center" nowrap>
  		<?php echo $this->_tpl_vars['RESFLASH']; ?>

    </td>
  </tr>
<?php else: ?>
    <tr bgcolor="white">
        <td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" align="center" nowrap>No Data</td>
    </tr>
<?php endif; ?>
 <tr bgcolor="white">
    <td nowrap colspan="<?php echo $this->_tpl_vars['colspan']; ?>
">
    <div style="float:left;">
    <?php echo $this->_tpl_vars['ACCOUNTSTR']; ?>

    </div>
    <div style="float:right;">
    <?php echo $this->_tpl_vars['RECORD_COUNTS']; ?>
 <?php echo $this->_tpl_vars['NAVIGATION']; ?>

    </div>
    </td>
  </tr>
  </table>
<?php echo $this->_tpl_vars['dateFilterJs']; ?>

<script>
var findurlstr = '<?php echo $this->_tpl_vars['FINDURLSTR']; ?>
';
var modules = '<?php echo $this->_tpl_vars['MODULE']; ?>
';
var actions = '<?php echo $this->_tpl_vars['ACTIONS']; ?>
';
<?php echo '
function getListViewEntries_js(module,pagestr){
	location.href="index.php?module="+module+"&action="+actions+""+findurlstr+"&"+pagestr;
}
function getListViewWithPageSize(module,obj){
	var pagestr = "limitpage="+obj.value;
	getListViewEntries_js(module,pagestr);
}
function exportReport(){
	location.href="index.php?module="+modules+"&action=Popup_expotrreport&"+findurlstr;
}

function getTabView(settype,theelement){		
	if(settype != \'\'){
		var classmethods=$$(\'.tablink\');
		for(var i=0;i<classmethods.length;i++){
		   classmethods[i].removeClassName(\'selected\');
		}
		$(theelement).addClassName(\'selected\');
		var flashels=$$(\'.flash_part\');
		for(var i=0;i<flashels.length;i++){
		   if(settype==\'flash\') flashels[i].show();
		   else flashels[i].hide();
		}
		var reportels=$$(\'.report_part\');
		for(var i=0;i<reportels.length;i++){
		   if(settype==\'report\') reportels[i].show();
		   else reportels[i].hide();
		}	
	}
}
function setsearch_click(){
	var searchtr = document.getElementById(\'searchtr\');
	searchtr.style.display = (searchtr.style.display == \'none\')?\'\':\'none\';
}
'; ?>

</script>