<?php /* Smarty version 2.6.18, created on 2012-12-21 14:47:21
         compiled from CustomView.tpl */ ?>
<!--*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
-->
<script type="text/javascript" src="modules/CustomView/CustomView.js"></script>
<script language="javascript" type="text/javascript">
var typeofdata = new Array();
typeofdata['V'] = ['e','n','s','c','k'];
typeofdata['N'] = ['e','n','l','g','m','h'];
typeofdata['T'] = ['e','n','l','g','m','h'];
typeofdata['I'] = ['e','n','l','g','m','h'];
typeofdata['C'] = ['e','n'];
typeofdata['DT'] = ['e','n'];
typeofdata['D'] = ['e','n'];
var fLabels = new Array();
fLabels['e'] = alert_arr.EQUALS;
fLabels['n'] = alert_arr.NOT_EQUALS_TO;
fLabels['s'] = alert_arr.STARTS_WITH;
fLabels['c'] = alert_arr.CONTAINS;
fLabels['k'] = alert_arr.DOES_NOT_CONTAINS;
fLabels['l'] = alert_arr.LESS_THAN;
fLabels['g'] = alert_arr.GREATER_THAN;
fLabels['m'] = alert_arr.LESS_OR_EQUALS;
fLabels['h'] = alert_arr.GREATER_OR_EQUALS;
var noneLabel;
function goto_CustomAction(module)
{
        document.location.href = "index.php?module="+module+"&action=CustomAction&record=<?php echo $this->_tpl_vars['CUSTOMVIEWID']; ?>
";
}

function mandatoryCheck()
{

        var mandatorycheck = false;
        var i,j;
        var manCheck = new Array(<?php echo $this->_tpl_vars['MANDATORYCHECK']; ?>
);
        var showvalues = "<?php echo $this->_tpl_vars['SHOWVALUES']; ?>
";
        if(manCheck)
        {
                var isError = false;
                var errorMessage = "";
                if (trim(document.CustomView.viewName.value) == "") {
                        isError = true;
                        errorMessage += "\n<?php echo $this->_tpl_vars['MOD']['LBL_VIEW_NAME']; ?>
";
                }
                // Here we decide whether to submit the form.
                if (isError == true) {
                        alert("<?php echo $this->_tpl_vars['MOD']['Missing_required_fields']; ?>
:" + errorMessage);
                        return false;
                }
		
		for(i=1;i<=9;i++)
                {
                        var columnvalue = document.getElementById("column"+i).value;
                        if(columnvalue != null)
                        {
                                for(j=0;j<manCheck.length;j++)
                                {
                                        if(columnvalue == manCheck[j])
                                        {
                                                mandatorycheck = true;
                                        }
                                }
                                if(mandatorycheck == true)
                                {
                                        return true;
                                }else
                                {
                                        mandatorycheck = false;
                                }
                        }
                }
        }
        if(mandatorycheck == false)
        {
                alert(alert_arr.SELECT_REQUIRED_FIELD + "\n"+showvalues);
        }
        
        return false;
}
</script>
<form enctype="multipart/form-data" name="CustomView" method="POST" action="index.php" onsubmit="return mandatoryCheck();">
<input type="hidden" name="module" value="CustomView">
<input type="hidden" name="action" value="Save">
<input type="hidden" name="parenttab" value="<?php echo $this->_tpl_vars['CATEGORY']; ?>
">
<input type="hidden" name="cvmodule" value="<?php echo $this->_tpl_vars['CVMODULE']; ?>
">
<input type="hidden" name="return_module" value="<?php echo $this->_tpl_vars['RETURN_MODULE']; ?>
">
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['CUSTOMVIEWID']; ?>
">
<input type="hidden" name="return_action" value="<?php echo $this->_tpl_vars['RETURN_ACTION']; ?>
">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%" >
 <tbody><tr>
  <td class="showPanelBg" valign="top" width="100%">
  <div class="small" style="padding: 5px;">
<span class="lvtHeaderText"><a class="hdrLink" href="index.php?action=ListView&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
"><?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE']]; ?>
</a> &gt; <?php if ($this->_tpl_vars['CUSTOMVIEWID'] == ''): ?><?php echo $this->_tpl_vars['MOD']['New_Custom_View']; ?>
<?php else: ?>编辑视图<?php endif; ?></span> <br>
<hr noshade="noshade" size="1">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="dvtContentSpace">
             <tbody><tr>
              <td align="left" valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
<tr>
		 <td colspan="4" class="detailedViewHeader"><strong><?php echo $this->_tpl_vars['MOD']['Details']; ?>
</strong></td>
		</tr>
		<tr>
		<td colspan="4">
                <table width="100%"  border="0" cellspacing="0" cellpadding="5">
		<tr>
		 <td class="dvtCellInfo" align="right" width="10%"><span class="style1">*</span><?php echo $this->_tpl_vars['MOD']['LBL_VIEW_NAME']; ?>
 </td>
		 <td class="dvtCellInfo" width="25%" >
		  <input class="detailedViewTextBox" type="text" name='viewName' value="<?php echo $this->_tpl_vars['VIEWNAME']; ?>
" onfocus="this.className='detailedViewTextBoxOn'" onblur="this.className='detailedViewTextBox'"/>
		 </td>
		 <td class="dvtCellInfo" width="75%">
		  <?php if ($this->_tpl_vars['CHECKED'] == 'checked'): ?>
		      <input type="hidden" name="setDefault" value="1" >
		  <?php else: ?>
		     <input type="hidden" name="setDefault" value="0" >
		  <?php endif; ?>
		 </td>
		 
		</tr>
		</table>
		</td></tr>
        
		<tr>
		 <td colspan="4" class="detailedViewHeader">
		  <b><?php echo $this->_tpl_vars['MOD']['LBL_STEP_2_TITLE']; ?>
 </b>
		 </td>
		</tr>
		<tr class="dvtCellLabel" colspan="4">
        <table class="dvtCellLabel" width="100%" style="padding-top:10px;padding-bottom:20px;">
         <tbody>
           <tr>
                <td><select name="column1" id="column1" onChange="checkDuplicate();">
	                <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			<?php $_from = $this->_tpl_vars['CHOOSECOLUMN1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
				<optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
					<?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
		   		         <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
			<?php endforeach; endif; unset($_from); ?>
          	        <?php echo $this->_tpl_vars['CHOOSECOLUMN1']; ?>

	              </select>
                  </td>
		   <td>
		   <select name="column2" id="column2" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN2']; ?>

                      </select></td>
		   <td><select name="column3" id="column3" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN3']; ?>

                      </select>
                      </td>
		   <td>
                      <select name="column4" id="column4" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN4']; ?>

                      </select></td>
           	
		   <td><select name="column5" id="column5" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN5']; ?>

                      </select>
                      </td>
              </tr>
              <tr>
		   <td>
                      <select name="column6" id="column6" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN6']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN6']; ?>

                      </select></td>
                   <td><select name="column7" id="column7" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN7']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN7']; ?>

                      </select>
                      </td>
		   <td><select name="column8" id="column8" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN8']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN8']; ?>

			</select></td>
		   <td><select name="column9" id="column9" onChange="checkDuplicate();">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLUMN9']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLUMN9']; ?>

                        </select></td>
           </tr>
         </tbody>
        </table>
		  
		</tr>	
		          <tr>
        <td >&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
		<tr>
		 <td colspan="4" class="detailedViewHeader">
		  <b>选择列表中汇总字段</b><br />		  
		 </td>
		</tr>
		<tr class="dvtCellInfo" style="height:40px;">
		   <td colspan=4>
		        
		        <select name="collectcolumn" id="collectcolumn" onChange="">
                        <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
                        <?php $_from = $this->_tpl_vars['CHOOSECOLLECTCOLUMN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
                                <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
                                <?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
                                     <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php echo $this->_tpl_vars['CHOOSECOLLECTCOLUMN']; ?>

                      </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;( 列表中将根据所选汇总字段进行自动汇总 )    
                      </td>
		</tr>
        <tr>
        <td >&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
		<tr>
		 <td colspan="4" class="detailedViewHeader">
		  <b>设置过滤条件</b>
		 </td>
		</tr>
		<tr><td colspan="4">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="95%">
		<tbody><tr>
		 <td>
		  <table class="small" border="0" cellpadding="3" cellspacing="0" width="100%">
		   <tbody><tr>
		    <td class="dvtTabCache" style="width: 10px;" nowrap>&nbsp;</td>
		    <td style="width: 100px;" nowrap class="dvtSelectedCell" id="pi" onclick="fnLoadCvValues('pi','mi','mnuTab','mnuTab2')">
		     <b><?php echo $this->_tpl_vars['MOD']['LBL_STEP_3_TITLE']; ?>
</b>
		    </td>
		    <td class="dvtUnSelectedCell" style="width: 100px;" align="center" nowrap id="mi" onclick="fnLoadCvValues('mi','pi','mnuTab2','mnuTab')">
		     <b><?php echo $this->_tpl_vars['MOD']['LBL_STEP_4_TITLE']; ?>
</b>
		    </td>
		    <td class="dvtTabCache" nowrap style="width:55%;">&nbsp;</td>
		   </tr>
		   </tbody>
	          </table>
		 </td>
	        </tr>
		<tr>
		 <td align="left" valign="top">
		  <div id="mnuTab">
		     <table width="100%" cellspacing="0" cellpadding="5" class="dvtContentSpace">
		     <tr><td class="dvtCellInfo"><?php echo $this->_tpl_vars['MOD']['LBL_AF_HDR1']; ?>
<br />
			1)当时间段为自定义时，开始日期和结束日期将为指定的日期，例如2010-10-10。<br />
			2)当时间段为非自定义时，开始日期和结束日期将为动态的日期，例如选择本周时，开始日期和结束日期将分别为本周的周一和周末，而不是固定的日期。
		       </td></tr>
                      <tr><td>
			<table width="75%" border="0" cellpadding="5" cellspacing="0" align="left">
			  <tr><td colspan="2" class="detailedViewHeader"><b><?php echo $this->_tpl_vars['MOD']['Simple_Time_Filter']; ?>
</b></td></tr>
			  <tr>
			     <td width="50%" align="right" class="dvtCellLabel"><?php echo $this->_tpl_vars['MOD']['LBL_Select_a_Column']; ?>
 :</td>
			     <td width="50%" class="dvtCellInfo">
				<select name="stdDateFilterField" class="select">
				<?php $_from = $this->_tpl_vars['STDFILTERCOLUMNS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stdfilter']):
?>
					<option <?php echo $this->_tpl_vars['stdfilter']['selected']; ?>
 value=<?php echo $this->_tpl_vars['stdfilter']['value']; ?>
><?php echo $this->_tpl_vars['stdfilter']['text']; ?>
</option>	
				<?php endforeach; endif; unset($_from); ?>
                                </select>
			  </tr>
			  <tr>
			     <td align="right" class="dvtCellLabel"><?php echo $this->_tpl_vars['MOD']['Select_Duration']; ?>
 :</td>
			     <td class="dvtCellInfo">
			        <select name="stdDateFilter" class="select" onchange='showDateRange(this.options[this.selectedIndex].value )'>
				<?php $_from = $this->_tpl_vars['STDFILTERCRITERIA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['duration']):
?>
					<option <?php echo $this->_tpl_vars['duration']['selected']; ?>
 value=<?php echo $this->_tpl_vars['duration']['value']; ?>
><?php echo $this->_tpl_vars['duration']['text']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			     </td>
			  </tr>
			  <tr>
			     <td align="right" class="dvtCellLabel"><?php echo $this->_tpl_vars['MOD']['Start_Date']; ?>
 :</td>
			     <td width="25%" align=left class="dvtCellInfo">
			     <input name="startdate" id="jscal_field_date_start" type="text" size="10" class="textField" value="<?php echo $this->_tpl_vars['STARTDATE']; ?>
">
			     <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
calendar.gif" id="jscal_trigger_date_start">
			     <script type="text/javascript">
			  		Calendar.setup ({
			 		inputField : "jscal_field_date_start", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_date_start", singleClick : true, step : 1
					})
			     </script></td>
	            	  </tr>
			  <tr>
			     <td align="right" class="dvtCellLabel"><?php echo $this->_tpl_vars['MOD']['End_Date']; ?>
 :</td> 
  			     <td width="25%" align=left class="dvtCellInfo">
			     <input name="enddate" id="jscal_field_date_end" type="text" size="10" class="textField" value="<?php echo $this->_tpl_vars['ENDDATE']; ?>
">
			     <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
calendar.gif" id="jscal_trigger_date_end">
			     <script type="text/javascript">
					Calendar.setup ({
					inputField : "jscal_field_date_end", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_date_end", singleClick : true, step : 1
					})
			     </script></td>
			  </tr>
			</table>
		      </td></tr>
		      <tr><td>&nbsp;</td></tr>
	            </table>
		   </div>
		   <div id="mnuTab2">
		      <table width="100%" cellspacing="0" cellpadding="5" class="dvtContentSpace">
		       <tr><td class="dvtCellInfo"><?php echo $this->_tpl_vars['MOD']['LBL_AF_HDR1']; ?>
<br />
			1)<?php echo $this->_tpl_vars['MOD']['LBL_AF_HDR2']; ?>
<br />
			2)<?php echo $this->_tpl_vars['MOD']['LBL_AF_HDR3']; ?>

		       </td></tr>
		       <tr><td>
			<table width="75%" border="0" cellpadding="5" cellspacing="0" align="left">
			  <tr><td class="detailedViewHeader"><b><?php echo $this->_tpl_vars['MOD']['LBL_RULE']; ?>
</b></td></tr>
			  
			  <tr class="dvtCellLabel">
			  <td><select name="fcol1" id="fcol1" onchange="updatefOptions(this, 'fop1');">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['BLOCK1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
				<optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
				<?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
				  <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			      <?php endforeach; endif; unset($_from); ?>
			      </select> &nbsp; <select name="fop1" id="fop1">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['FOPTION1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['criteria']):
?>
				<option <?php echo $this->_tpl_vars['criteria']['selected']; ?>
 value=<?php echo $this->_tpl_vars['criteria']['value']; ?>
><?php echo $this->_tpl_vars['criteria']['text']; ?>
</option>
			      <?php endforeach; endif; unset($_from); ?>
			      </select>&nbsp; <input name="fval1" id="fval1" type="text" size=30 maxlength=80 value="<?php echo $this->_tpl_vars['VALUE1']; ?>
">
			    &nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_AND']; ?>
</td>
			</tr>
			<tr class="dvtCellInfo">
			  <td><select name="fcol2" id="fcol2" onchange="updatefOptions(this, 'fop2');">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['BLOCK2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
				<optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
				<?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
				  <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			      <?php endforeach; endif; unset($_from); ?>
			      </select> &nbsp; <select name="fop2" id="fop2">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['FOPTION2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['criteria']):
?>
				<option <?php echo $this->_tpl_vars['criteria']['selected']; ?>
 value=<?php echo $this->_tpl_vars['criteria']['value']; ?>
><?php echo $this->_tpl_vars['criteria']['text']; ?>
</option>
			      <?php endforeach; endif; unset($_from); ?>
			      </select>&nbsp; <input name="fval2" id="fval2" type="text" size=30 maxlength=80 value="<?php echo $this->_tpl_vars['VALUE2']; ?>
">
			    &nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_AND']; ?>
</td>
			</tr>
			<tr class="dvtCellLabel">
			  <td><select name="fcol3" id="fcol3" onchange="updatefOptions(this, 'fop3');">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['BLOCK3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
				<optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
				<?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
				  <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			      <?php endforeach; endif; unset($_from); ?>
			      </select> &nbsp; <select name="fop3" id="fop3">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['FOPTION3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['criteria']):
?>
				<option <?php echo $this->_tpl_vars['criteria']['selected']; ?>
 value=<?php echo $this->_tpl_vars['criteria']['value']; ?>
><?php echo $this->_tpl_vars['criteria']['text']; ?>
</option>
			      <?php endforeach; endif; unset($_from); ?>
			      </select>&nbsp; <input name="fval3" id="fval3" type="text" size=30 maxlength=80 value="<?php echo $this->_tpl_vars['VALUE3']; ?>
">
			    &nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_AND']; ?>
</td>
			</tr>
			<tr class="dvtCellInfo">
			  <td><select name="fcol4" id="fcol4" onchange="updatefOptions(this, 'fop4');">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['BLOCK4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
				<optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
				<?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
				  <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			      <?php endforeach; endif; unset($_from); ?>
			      </select> &nbsp; <select name="fop4" id="fop4">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['FOPTION4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['criteria']):
?>
				<option <?php echo $this->_tpl_vars['criteria']['selected']; ?>
 value=<?php echo $this->_tpl_vars['criteria']['value']; ?>
><?php echo $this->_tpl_vars['criteria']['text']; ?>
</option>
			      <?php endforeach; endif; unset($_from); ?>
			      </select>&nbsp; <input name="fval4" id="fval4" type="text" size=30 maxlength=80 value="<?php echo $this->_tpl_vars['VALUE4']; ?>
">
			    &nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_AND']; ?>
</td>
			</tr>
			<tr class="dvtCellLabel">
			  <td><select name="fcol5" id="fcol5" onchange="updatefOptions(this, 'fop5');">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['BLOCK5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['filteroption']):
?>
				<optgroup label="<?php echo $this->_tpl_vars['label']; ?>
" class=\"select\" style=\"border:none\">
				<?php $_from = $this->_tpl_vars['filteroption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
?>
				  <option <?php echo $this->_tpl_vars['text']['selected']; ?>
 value=<?php echo $this->_tpl_vars['text']['value']; ?>
><?php echo $this->_tpl_vars['text']['text']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			      <?php endforeach; endif; unset($_from); ?>
			      </select> &nbsp; <select name="fop5" id="fop5">
			      <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</option>
			      <?php $_from = $this->_tpl_vars['FOPTION5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['criteria']):
?>
				<option <?php echo $this->_tpl_vars['criteria']['selected']; ?>
 value=<?php echo $this->_tpl_vars['criteria']['value']; ?>
><?php echo $this->_tpl_vars['criteria']['text']; ?>
</option>
			      <?php endforeach; endif; unset($_from); ?>
			      </select>&nbsp; <input name="fval5" id="fval5" type="text" size=30 maxlength=80 value="<?php echo $this->_tpl_vars['VALUE5']; ?>
">
			    &nbsp;</td>
			</tr>

			  			  </table>
	  </td></tr></table></div></td></tr></table>
	  </td></tr>
	  <tr><td colspan="4" style="padding: 5px;">
		<div align="center">
		  <input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
 [Alt+S]" accesskey="S" class="crmbutton small save"  name="button2" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" style="width: 70px;" type="submit" onClick="return checkDuplicate();"/>
		  <input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
 [Alt+X]" accesskey="X" class="crmbutton small cancel" name="button2" onclick='window.history.back()' value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" style="width: 70px;" type="button" />
		</div>
	  </td></tr>
	  <tr><td colspan="4">&nbsp;</td></tr>
	  </table>
	 </td></tr>
       <tr><td>&nbsp;</td></tr>
     </table>
   </div>
  </td>
  </tr>
  </table>
</form>
<?php echo $this->_tpl_vars['STDFILTER_JAVASCRIPT']; ?>

<?php echo $this->_tpl_vars['JAVASCRIPT']; ?>

<!-- to show the mandatory fields while creating new customview -->
<script language="javascript" type="text/javascript">
var k;
var colOpts;
var manCheck = new Array(<?php echo $this->_tpl_vars['MANDATORYCHECK']; ?>
);
<?php echo '
if(document.CustomView.record.value == \'\')
{
  for(k=0;k<manCheck.length;k++)
  {
      selname = "column"+(k+1);
      colOpts = document.getElementById(selname).options;
      for (l=0;l<colOpts.length;l++)
      {
        if(colOpts[l].value == manCheck[k])
        {
          colOpts[l].selected = true;
        }
      }
  }
}
function checkDuplicate()
{
	var cvselect_array = new Array(\'column1\',\'column2\',\'column3\',\'column4\',\'column5\',\'column6\',\'column7\',\'column8\',\'column9\')
		for(var loop=0;loop < cvselect_array.length-1;loop++)
		{
			selected_cv_columnvalue = $(cvselect_array[loop]).options[$(cvselect_array[loop]).selectedIndex].value;
			if(selected_cv_columnvalue != \'\')
			{	
				for(var iloop=0;iloop < cvselect_array.length;iloop++)
				{
					if(iloop == loop)
						iloop++;
					selected_cv_icolumnvalue = $(cvselect_array[iloop]).options[$(cvselect_array[iloop]).selectedIndex].value;	
					if(selected_cv_columnvalue == selected_cv_icolumnvalue)
					{
						alert(alert_arr.FIELD_REPEATED);
						$(cvselect_array[iloop]).selectedIndex = 0;
						return false;
					}

				}
			}
		}
		return true;
}
//checkDuplicate();
'; ?>

</script>