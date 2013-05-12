<?php /* Smarty version 2.6.18, created on 2012-12-21 11:18:41
         compiled from SalesOrder/ListView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'SalesOrder/ListView.tpl', 121, false),)), $this); ?>

<link href="include/ajaxtabs/ajaxtabs.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/search.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/<?php echo $this->_tpl_vars['MODULE']; ?>
/<?php echo $this->_tpl_vars['SINGLE_MOD']; ?>
.js"></script>
<script language="javascript">
function callSearch(searchtype)
{
        $("status").style.display="inline";
	    getTabViewNewClear();
    	gPopupAlphaSearchUrl = '';
	search_fld_val= $('bas_searchfield').options[$('bas_searchfield').selectedIndex].value;
        search_txt_val=document.basicSearch.search_text.value;
        var urlstring = '';
        if(searchtype == 'Basic')
        {
                urlstring = 'search_field='+search_fld_val+'&searchtype=BasicSearch&search_text='+search_txt_val+'&';
        }
        else if(searchtype == 'Advanced')
        {
                var no_rows = document.basicSearch.search_cnt.value;
                for(jj = 0 ; jj < no_rows; jj++)
                {
                        var sfld_name = getObj("Fields"+jj);
                        var scndn_name= getObj("Condition"+jj);
                        var srchvalue_name = getObj("Srch_value"+jj);
                        urlstring = urlstring+'Fields'+jj+'='+sfld_name[sfld_name.selectedIndex].value+'&';
                        urlstring = urlstring+'Condition'+jj+'='+scndn_name[scndn_name.selectedIndex].value+'&';
                        urlstring = urlstring+'Srch_value'+jj+'='+srchvalue_name.value+'&';
                }
                for (i=0;i<getObj("matchtype").length;i++){
                        if (getObj("matchtype")[i].checked==true)
                                urlstring += 'matchtype='+getObj("matchtype")[i].value+'&';
                }
                urlstring += 'search_cnt='+no_rows+'&';
                urlstring += 'searchtype=advance&'
        }
	
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:urlstring +'query=true&file=index&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['MODULE']; ?>
Ajax&ajax=true',
			onComplete: function(response) {
				$("status").style.display="none";
                                result = response.responseText.split('&#&#&#');
                                $("ListViewContents").innerHTML= result[2];
                                result[2].evalScripts();
                                if(result[1] != '')
                                        alert(result[1]);
			}
	       }
        );

}
function alphabetic(module,url,dataid)
{
      
        getObj(dataid).className = 'searchAlphselected';
	$("status").style.display="inline";
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody: 'module='+module+'&action='+module+'Ajax&file=index&ajax=true&'+url,
			onComplete: function(response) {
				$("status").style.display="none";
				result = response.responseText.split('&#&#&#');
				$("ListViewContents").innerHTML= result[2];
                result[2].evalScripts();
				if(result[1] != '')
			                alert(result[1]);
			}
		}
	);
}

</script>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </td>
                </tr>
                </table>
        </td>
</tr>
</table>
   <table border="0" cellpadding="0" cellspacing="0"  width="100%" >
<form name="basicSearch" action="index.php" onsubmit="return false;">
<tbody>
<tr width="27">
<td>
    <table border="0" cellpadding="0" cellspacing="0" class="table1234"  width="100%" >
    
      <tbody>
        <tr>
              <td style="padding-left:5px;">
                 <input title="<?php echo $this->_tpl_vars['APP']['LNK_NEW_SO']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_NEW_SO']; ?>
" class="crmbutton small create" onclick="javascript:location.href='index.php?module=SalesOrder&action=EditView'" type="button" name="Create" value="<?php echo $this->_tpl_vars['APP']['LNK_NEW_SO']; ?>
">&nbsp;
               </td> 
                <td class="small" nowrap width="40%">
                   <table border="0" cellpadding="0" cellspacing="0" class="table12345"  width="100%" >
                     <tbody>
                      <tr>
                      <td  nowrap="nowrap"><span style="font-size:12px;">搜索:</span></td>
                        <td>
                        <div id="basicsearchcolumns_real">
                        <select name="search_field" id="bas_searchfield" class="txtBox" style="width:130px">
                         <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['SEARCHLISTHEADER'],'selected' => $this->_tpl_vars['BASICSEARCHFIELD']), $this);?>

                        </select>
                        </div>
                        <input type="hidden" name="searchtype" value="BasicSearch">
                        <input type="hidden" name="module" value="<?php echo $this->_tpl_vars['MODULE']; ?>
">
                        <input type="hidden" name="parenttab" value="<?php echo $this->_tpl_vars['CATEGORY']; ?>
">
                        <input type="hidden" name="action" value="index">
                        <input type="hidden" name="query" value="true">
                        <input type="hidden" name="search_cnt">
                      </td>
                      <td class="small"><input type="text"  class="txtBox" style="width:150px" value="<?php echo $this->_tpl_vars['BASICSEARCHVALUE']; ?>
" name="search_text" onkeydown="javascript:if(event.keyCode==13) callSearch('Basic')"></td>
                      <td class="small" nowrap width=40% >
                          <input name="submit" type="button" class="crmbutton small create" onClick="callSearch('Basic');" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_NOW_BUTTON']; ?>
 ">&nbsp;
                          <input name="submit" type="button" class="crmbutton small edit" onClick="clearSearchResult('<?php echo $this->_tpl_vars['MODULE']; ?>
');" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_CLEAR']; ?>
 ">&nbsp;
                       </td>
                      <td nowrap="nowrap"><span class="small"><a href="#" onClick="fntogger('advSearch');document.basicSearch.searchtype.value='advance';"> <?php echo $this->_tpl_vars['APP']['LNK_ADVANCED_SEARCH']; ?>
</a></span></td>      
                      </tr>
                      </tbody>
                      </table>               
                </td>
         </tr> 
        </tbody>
     </table>
 </td>
 </tr>
 <tr>
 <td>
 <div id="advSearch" style="display:none;">
		<table  cellspacing=0 cellpadding=5 width=80% class="searchUIAdv1 small" align="center" border=0>
			<tr>
					<td class="searchUIName small" nowrap align="left"><span class="moduleName"><?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
</span></td>
					<?php if ($this->_tpl_vars['SEARCHMATCHTYPE'] == 'all'): ?>
					<td nowrap class="small"><b><input name="matchtype" type="radio" value="all" checked>&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_MSG_ALL']; ?>
</b></td>
					<td nowrap width=60% class="small" ><b><input name="matchtype" type="radio" value="any" >&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_MSG_ANY']; ?>
</b></td>
					<?php else: ?>
					<td nowrap class="small"><b><input name="matchtype" type="radio" value="all">&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_MSG_ALL']; ?>
</b></td>
					<td nowrap width=60% class="small" ><b><input name="matchtype" type="radio" value="any" checked>&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_MSG_ANY']; ?>
</b></td>
					<?php endif; ?>
					<td class="small" valign="top"><span class="small"><a href="#" onClick="fnhide('advSearch');document.basicSearch.searchtype.value='basic';">关闭</a></span></td>
			</tr>
		</table>
		<table cellpadding="2" cellspacing="0" width="80%" align="center" class="searchUIAdv2 small" border=0>
			<tr>
				<td align="center" class="small" width=90%>
				<div id="fixed" style="position:relative;width:95%;height:80px;padding:0px; overflow:auto;border:1px solid #CCCCCC;background-color:#ffffff" class="small">
					<table border=0 width=95%>
					<tr>
					<td align=left>
						<table width="100%"  border="0" cellpadding="2" cellspacing="0" id="adSrc" align="left">
						
							<?php if ($this->_tpl_vars['SEARCHCONSHTML']): ?>
							   <?php $_from = $this->_tpl_vars['SEARCHCONSHTML']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cons']):
        $this->_foreach['foo']['iteration']++;
?>
							     <tr  >
								<td width="31%">
								<select name="Fields<?php echo ($this->_foreach['foo']['iteration']-1); ?>
" class="detailedViewTextBox">
								<?php echo $this->_tpl_vars['cons']['0']; ?>

								</select>
								</td>
								<td width="32%">
								<select name="Condition<?php echo ($this->_foreach['foo']['iteration']-1); ?>
" class="detailedViewTextBox">
									<?php echo $this->_tpl_vars['cons']['1']; ?>

								</select>
								</td>
								<td width="32%">
								<input type="text" name="Srch_value<?php echo ($this->_foreach['foo']['iteration']-1); ?>
" value="<?php echo $this->_tpl_vars['cons']['2']; ?>
" class="detailedViewTextBox">
								</td>
							        </tr>
							     <?php endforeach; endif; unset($_from); ?>
							<?php else: ?>
							     <tr  >
								<td width="31%">
								<select name="Fields0" class="detailedViewTextBox">
								<?php echo $this->_tpl_vars['FIELDNAMES']; ?>

								</select>
								</td>
								<td width="32%">
								<select name="Condition0" class="detailedViewTextBox">
									<?php echo $this->_tpl_vars['CRITERIA']; ?>

								</select>
								</td>
								<td width="32%">
								<input type="text" name="Srch_value0" class="detailedViewTextBox">
								</td>
							     </tr>
							<?php endif; ?>
						
						</table>
					</td>
					</tr>
				</table>
				</div>	
				</td>
			</tr>
		</table>
			
		<table border=0 cellspacing=0 cellpadding=5 width=80% class="searchUIAdv3 small" align="center">
		<tr>
			<td align=left width=40%>
						<input type="button" name="more" value=" <?php echo $this->_tpl_vars['APP']['LBL_MORE_BUTTON']; ?>
 " onClick="fnAddSrch('<?php echo $this->_tpl_vars['FIELDNAMES']; ?>
','<?php echo $this->_tpl_vars['CRITERIA']; ?>
')" class="crmbuttom small edit" >
						<input name="button" type="button" value=" <?php echo $this->_tpl_vars['APP']['LBL_FEWER_BUTTON']; ?>
 " onclick="delRow()" class="crmbuttom small edit" >
			</td>
			<td align=left class="small">
			 <input type="button" class="crmbutton small create" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_NOW_BUTTON']; ?>
 " onClick="totalnoofrows();callSearch('Advanced');">
			 <input type="button" class="crmbutton small edit" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_CLEAR']; ?>
 " onClick="clearSearchResult('<?php echo $this->_tpl_vars['MODULE']; ?>
');">
			</td>
            
		</tr>
	</table>
</div>	
</td>
</tr>
</tbody>
</form>
</table>

<table class="list_table" style="margin-top:2px;" border="0" cellpadding="3" cellspacing="1" width="100%">
        <tbody>
        <tr >
        
          <td>
	  <table border="0" cellpadding="0" cellspacing="0" style="padding-right:5px;padding-top:2px;padding-bottom:2px;">

	  <tr>
	  <td><img src="themes/images/filter.png" border=0></td>
	  <td><?php echo $this->_tpl_vars['APP']['LBL_VIEW']; ?>

	  <?php $_from = $this->_tpl_vars['CUSTOMVIEW_OPTION']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listviewforeach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listviewforeach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['viewname']):
        $this->_foreach['listviewforeach']['iteration']++;
?>

			<?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['VIEWID']): ?> 
			<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">
			&nbsp;&nbsp;<a class="cus_markbai tablink" href="javascript:;" onclick="javascript:getTabView('<?php echo $this->_tpl_vars['MODULE']; ?>
','viewname=<?php echo $this->_tpl_vars['id']; ?>
',this,<?php echo $this->_tpl_vars['id']; ?>
);"><?php echo $this->_tpl_vars['viewname']; ?>
</a>&nbsp;&nbsp;
			</span>
			<?php else: ?>
			<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">
			&nbsp;&nbsp;<a class="cus_markhui tablink" href="javascript:;" onclick="javascript:getTabView('<?php echo $this->_tpl_vars['MODULE']; ?>
','viewname=<?php echo $this->_tpl_vars['id']; ?>
',this,<?php echo $this->_tpl_vars['id']; ?>
);"><?php echo $this->_tpl_vars['viewname']; ?>
</a>&nbsp;&nbsp;
			</span>
			<?php endif; ?>		
			
	  <?php endforeach; endif; unset($_from); ?>
	  
	
		        
			<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">&nbsp;<a href="index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=CustomView&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
"><?php echo $this->_tpl_vars['APP']['LNK_CV_CREATEVIEW']; ?>
</a> | 
						
						<a href="javascript:editView('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['CATEGORY']; ?>
')"><?php echo $this->_tpl_vars['APP']['LNK_CV_EDIT']; ?>
</a> |
						
						<a href="javascript:deleteView('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['CATEGORY']; ?>
')"><?php echo $this->_tpl_vars['APP']['LNK_CV_DELETE']; ?>
</a></span>&nbsp;

		</td>
		</tr>
            </tbody></table>
	</td>
        </tr>
	<tr>
          <td  colspan=3 bgcolor="#ffffff" valign="top">


<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>

     <tr>

     <tr>
        

	<td class="lvt" valign="top" width=100% style="padding:2px;">
	 <!-- SIMPLE SEARCH -->

	 
	   <!-- PUBLIC CONTENTS STARTS-->
	  <div id="ListViewContents" class="small" style="width:100%;position:relative;">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "SalesOrder/ListViewEntries.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  </div>

     </td>
   </tr>
</table>
<!-- New List -->
</td></tr></tbody></table>

<!-- QuickEdit Feature -->

<div id="quickedit" class="layerPopup" style="display:none;width:450px;">
<form name="quickedit_form" id="quickedit_form" action="javascript:void(0);">
<!-- Hidden Fields -->
<input type="hidden" name="quickedit_recordids">
<input type="hidden" name="quickedit_module">
<table width="100%" border="0" cellpadding="3" cellspacing="0" class="layerHeadingULine">
<tr>
	<td class="layerPopupHeading" align="left" width="60%"><?php echo $this->_tpl_vars['APP']['LBL_QUICKEDIT_FORM_HEADER']; ?>
</td>
	<td>&nbsp;</td>
	<td align="right" width="40%"><img onClick="fninvsh('quickedit');" title="<?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
" style="cursor:pointer;" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
close.gif" align="absmiddle" border="0"></td>
</tr>
</table>
<div id="quickedit_form_div"></div>
<table border=0 cellspacing=0 cellpadding=5 width=100% class="layerPopupTransport">
	<tr>
		<td align="center">
				<input type="button" name="button" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_LABEL']; ?>
" onClick="ajax_quick_edit()">
				<input type="button" name="button" class="crmbutton small cancel" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" onClick="fninvsh('quickedit')">
		</td>
	</tr>
</table>
</form>
</div>
<!-- END -->


<div id="changeowner" class="layerPopup" style="display:none;width:325px;">
<table width="100%" border="0" cellpadding="3" cellspacing="0" class="layerHeadingULine">
<tr>
	<td class="layerPopupHeading" align="left" width="60%"><?php echo $this->_tpl_vars['APP']['LBL_CHANGE_OWNER']; ?>
</td>
	<td>&nbsp;</td>
	<td align="right" width="40%"><img onClick="fninvsh('changeowner');" title="<?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
" style="cursor:pointer;" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
close.gif" align="absmiddle" border="0"></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=5 width=95% align=center> 
	<tr>
		<td class=small >
		
			<!-- popup specific content fill in starts -->
			<form name="change_ownerform_name">
			<table border=0 celspacing=0 cellpadding=5 width=100% align=center bgcolor=white>
				<tr>
					<td width="50%" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_TRANSFER_OWNERSHIP']; ?>
:</b></td>
					
					<td width="50%">		
					<select name="lead_owner" id="lead_owner" class="detailedViewTextBox">
					<?php echo $this->_tpl_vars['CHANGE_OWNER']; ?>

					</select>					
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
<table border=0 cellspacing=0 cellpadding=5 width=100% class="layerPopupTransport">
	<tr>
		<td align="center">
				<input type="button" name="button" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_UPDATE_OWNER']; ?>
" onClick="ajaxChangeStatus('owner')">
				<input type="button" name="button" class="crmbutton small cancel" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" onClick="fninvsh('changeowner')">
		</td>
	</tr>
</table>
</div>

<div id="sharerecorddiv" class="layerPopup" style="display:none;width:250px;">
<form name="sharerecord_form">
<table width="100%" border="0" cellpadding="3" cellspacing="0" class="layerHeadingULine">
<tr>
	<td width="99%" style="cursor:move;" id="sharerecord_div_title" class="layerPopupHeading" align="left"><?php echo $this->_tpl_vars['APP']['LBL_SHARE_BUTTON_LABEL']; ?>
</td>
	<td align="right" width="40%"><img onClick="fninvsh('sharerecorddiv');" title="<?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
" style="cursor:pointer;" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
close.gif" align="absmiddle" border="0"></td>
</tr>
</table>

         <?php $_from = $this->_tpl_vars['SHARE_USERS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupname'] => $this->_tpl_vars['user_array']):
?>
	        <table width=100%><tr class="lvtColDataHover"><td width="200"><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
minus.gif" id="img_<?php echo $this->_tpl_vars['groupname']; ?>
" onclick="showhide_dept('dept_<?php echo $this->_tpl_vars['groupname']; ?>
','img_<?php echo $this->_tpl_vars['groupname']; ?>
')" style="cursor: pointer;" align="absmiddle" border="0">&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['groupname']; ?>
</b></td><td align="left" width="50"><input type="checkbox" onclick='toggleSelect(this.checked,"DetailView_<?php echo $this->_tpl_vars['groupname']; ?>
")' name=shareselectall class="detailedViewTextBox"></td></tr></table>
		<table width=100% id="dept_<?php echo $this->_tpl_vars['groupname']; ?>
" style="display:block;">
		<?php $_from = $this->_tpl_vars['user_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userid'] => $this->_tpl_vars['user_name']):
?>
		<tr class="lvtColData" onmouseover="this.className='lvtColDataHover'" onmouseout="this.className='lvtColData'" id="row_2" bgcolor="white">
			<td width="200" height="25"><?php echo $this->_tpl_vars['user_name']; ?>
</td>
			<td width="50" height="25"><input type="checkbox" name="DetailView_<?php echo $this->_tpl_vars['groupname']; ?>
" value="<?php echo $this->_tpl_vars['userid']; ?>
" class="detailedViewTextBox"></td>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endforeach; endif; unset($_from); ?>
<table border=0 cellspacing=0 cellpadding=5 width=100% class="layerPopupTransport">
	<tr>
		<td align="center">
		<input type="button" name="button" class="crmbutton save small" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" onClick="ajaxShareRecord('<?php echo $this->_tpl_vars['MODULE']; ?>
')">
		<input type="button" name="button" class="crmbutton small cancel" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" onClick="fninvsh('sharerecorddiv')">
		</td>
	</tr>
</table>
</form>
</div>

<ul id="countrytabs" class="shadetabs" style=" white-space:nowrap; ">
	<li><a href="javascript:;" onClick="getTabViewForList('ProductsInfo',this);" id="ProductsInfo" rel="#default" class="tablink selected">产品信息</a></li>
</ul>

<div id="tabviewContent" class="small" style="overflow:auto;">

<table class="dvtContentSpace" style="border-top: 1px solid rgb(222, 222, 222);" width="100%" border="0">

<tbody><tr><td style="padding:5px;">

	<table style="background-color: rgb(234, 234, 234);" class="small" width="100%" border="0" cellpadding="3" cellspacing="1">


      <tr style="height: 20px;">

       <td class="lvtCol2"  nowrap>产品编号</td>

        <td class="lvtCol2" nowrap>产品名称</td>

		<td class="lvtCol2" nowrap>产品类别</td>

        <td class="lvtCol2" nowrap>购买数量</td>

        <td class="lvtCol2" nowrap>产品单价</td>
			
         <td class="lvtCol2" nowrap>成本价</td>

        <td class="lvtCol2" nowrap>产品规格</td>

		 <td class="lvtCol2" nowrap>产品描述</td>
        
      </tr>
      
    </table>

</td></tr></tbody>

</table>

</div>
<input type="hidden" id="tabview"  value="ProductsInfo" />
<input type="hidden" id="recordid"  value="" />
<input type="hidden" id="modulename"  value="SalesOrder" />
<script>


function showhide_dept(deptId,imgId)
{
	var x=document.getElementById(deptId).style;
	if (x.display=="none")
	{
		x.display="block";
		document.getElementById(imgId).src = "<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
minus.gif";
	}
	else
	{
		x.display="none";
		document.getElementById(imgId).src = "<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
plus.gif";
	}
}

<?php echo '
Drag.init(document.getElementById("sharerecord_div_title"), document.getElementById("sharerecorddiv"));
function ajaxChangeStatus(statusname)
{
	$("status").style.display="inline";
	//var viewid = document.getElementById(\'viewname\').options[document.getElementById(\'viewname\').options.selectedIndex].value;
	var viewid = document.getElementById(\'viewname\').value;
	var idstring = document.getElementById(\'idlist\').value;
	if(statusname == \'status\')
	{
		fninvsh(\'changestatus\');
		var url=\'&leadval=\'+document.getElementById(\'lead_status\').options[document.getElementById(\'lead_status\').options.selectedIndex].value;
		var urlstring ="module=Users&action=updateLeadDBStatus&return_module=Leads"+url+"&viewname="+viewid+"&idlist="+idstring;
	}
	else if(statusname == \'owner\')
	{
	    fninvsh(\'changeowner\');
	    var url=\'&user_id=\'+document.getElementById(\'lead_owner\').options[document.getElementById(\'lead_owner\').options.selectedIndex].value;
	    '; ?>

	    var urlstring ="module=Users&action=updateLeadDBStatus&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
"+url+"&viewname="+viewid+"&idlist="+idstring;
	    <?php echo '
		
	}
	new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: urlstring,
                        onComplete: function(response) {
                                $("status").style.display="none";
                                result = response.responseText.split(\'&#&#&#\');
                                $("ListViewContents").innerHTML= result[2];
                                if(result[1] != \'\')
                                        alert(result[1]);
                        }
                }
        );
	
}


function ajaxShareRecord(module)
{
	$("status").style.display="inline";
	var idstring = document.getElementById(\'idlist\').value;	
        fninvsh(\'sharerecorddiv\');
	var shareuserids = "";
	for(var i=0;i<document.sharerecord_form.elements.length;i++) {
	    if(document.sharerecord_form.elements[i].type == \'checkbox\' && document.sharerecord_form.elements[i].checked) {
		shareuserids = shareuserids + document.sharerecord_form.elements[i].value + ",";
	    }
	}

	var urlstring = "module="+ module + "&action=SaveShares&shareuserids="+shareuserids+"&idlist="+idstring;
     
	new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: urlstring,
                        onComplete: function(response) {
                                $("status").style.display="none";
                                result = response.responseText;
                        }
                }
        );
	
	
}

function clearSearchResult(module){
	 getTabViewNewClear();
    $("status").style.display="inline";
    new Ajax.Request(
		\'index.php\',
		{queue: {position: \'end\', scope: \'command\'},
			method: \'post\',
			postBody:\'clearquery=true&file=index&module=\'+module+\'&action=\'+module+\'Ajax&ajax=true\',
			onComplete: function(response) {
				$("status").style.display="none";
                                result = response.responseText.split(\'&#&#&#\');
                                $("ListViewContents").innerHTML= result[2];
                                result[2].evalScripts();
                                if(result[1] != \'\')
                                        alert(result[1]);
								fnhide(\'advSearch\');
								document.basicSearch.searchtype.value=\'basic\';
			}
	       }
        );

}
</script>
'; ?>



