<?php /* Smarty version 2.6.18, created on 2012-12-21 11:03:35
         compiled from Accounts/ListView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'Accounts/ListView.tpl', 141, false),)), $this); ?>

<link href="include/ajaxtabs/ajaxtabs.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/search.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/<?php echo $this->_tpl_vars['MODULE']; ?>
/<?php echo $this->_tpl_vars['SINGLE_MOD']; ?>
.js"></script>
<script language="javascript">
function callSearch(searchtype)
{
         
		getTabViewNewClear();
        $("status").style.display="inline";
	
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
        for(i=1;i<=26;i++)
        {
                var data_td_id = 'alpha_'+ eval(i);
                getObj(data_td_id).className = 'searchAlph';

        }
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
                 <input title="<?php echo $this->_tpl_vars['APP']['LNK_NEW_ACCOUNT']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_NEW_ACCOUNT']; ?>
" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Accounts&action=EditView'" type="button" name="Create" value="<?php echo $this->_tpl_vars['APP']['LNK_NEW_ACCOUNT']; ?>
">&nbsp;
               
               </td> 
               <td align="right">
	       <!--
               <input title="<?php echo $this->_tpl_vars['APP']['LNK_IMPORT_THREE_MONTH_AGO_ACCOUNT']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_IMPORT_THREE_MONTH_AGO_ACCOUNT']; ?>
" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Accounts&action=Import&step=1&return_module=Accounts&return_action=index'" type="button" name="import3" value="<?php echo $this->_tpl_vars['APP']['LNK_IMPORT_THREE_MONTH_AGO_ACCOUNT']; ?>
">&nbsp;
	       -->
               </td>
               <td align="left">
              
               <input title="<?php echo $this->_tpl_vars['APP']['LNK_IMPORT_THREE_MONTH_ACCOUNT']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_IMPORT_THREE_MONTH_ACCOUNT']; ?>
" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Synchronous&action=PopupSynchronous'" type="button" name="synchronous" value="<?php echo $this->_tpl_vars['APP']['LNK_IMPORT_THREE_MONTH_ACCOUNT']; ?>
">&nbsp;
              <a onclick="return selectedRecords('Accounts','Customer')" href="javascript:void(0)" name="export_link">
                <input type="button" value="导出客户" class="crmbutton small edit">
                </a>
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

<table class="list_table" style="margin-top:0px;" border="0" cellpadding="3" cellspacing="1" width="100%">
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

	 
	   <!-- PUBLIC CONTENTS STARTS-->
	  <div id="ListViewContents" class="small" style="width:100%;position:relative;">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Accounts/ListViewEntries.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  </div>

     </td>
   </tr>
</table>
<!-- New List -->
</td></tr></tbody></table>




<ul id="countrytabs" class="shadetabs" style=" white-space:nowrap;">
	<li><a href="javascript:;" onClick="getTabViewForList('DetailsOrders',this);" id="DetailsOrders" rel="#default" class="tablink selected">订单明细</a></li>
	<li><a href="javascript:;" onClick="getTabViewForList('Receiveinfo',this);" id="Receiveinfo" rel="#default" class="tablink">收货信息</a></li>    
    <li><a href="javascript:;" onClick="getTabViewForList('BuyProducts',this);" id="BuyProducts" rel="#default" class="tablink">已购产品</a></li>  
    <li><a href="javascript:;" onClick="getTabViewForList('Noteinfo',this);" id="Noteinfo" rel="#default" class="tablink">联系记录</a></li> 
    <!--<li><a href="javascript:;" onClick="getTabViewForList('Qunfas',this);" id="Qunfas" rel="#default" class="tablink">群发短信记录</a></li>-->
    <li><a href="javascript:;" onClick="getTabViewForList('Maillists',this);" id="Maillists" rel="#default" class="tablink">群发邮件记录</a></li> 
    <li><a href="javascript:;" onClick="getTabViewForList('Memdays',this);" id="Maillists" rel="#default" class="tablink">纪念日</a></li> 
</ul>

<div id="tabviewContent" class="small" style="overflow:auto;width:100%;height:auto;" >
<table class="dvtContentSpace" style="border-top: 1px solid rgb(222, 222, 222);" width="100%" height="auto" border="0">

<tbody><tr><td style="padding:1px;">

	<table style="background-color: rgb(234, 234, 234); " class="small" width="100%" border="0" cellpadding="0" cellspacing="1">


      <tr style="height: 20px;">

        <td class="lvtCol2"  nowrap>订单编号</td>

		<td class="lvtCol2"  nowrap>订单状态</td>

        <td class="lvtCol2"  nowrap>下单时间</td>

        <td class="lvtCol2"  nowrap >商品总数量</td>

        <td class="lvtCol2"  nowrap >订单总额</td>

		<td class="lvtCol2"  nowrap >邮费</td>
		
		<td class="lvtCol2"  nowrap>收货人姓名</td>

		<td class="lvtCol2"  nowrap>联系手机</td>
        
        <td class="lvtCol2"  nowrap>联系电话</td>

	    <td class="lvtCol2"  nowrap>所在国家</td>

        <td class="lvtCol2"  nowrap>所在省份</td>

        <td class="lvtCol2"  nowrap>所在市</td>

        <td class="lvtCol2"  nowrap>详细地址</td>
        
        <td class="lvtCol2"  nowrap>邮编</td>
        
        <td class="lvtCol2"  nowrap>E-mail</td>

		<td class="lvtCol2"  nowrap>配送方式</td>	

		<td class="lvtCol2"  nowrap>支付方式</td>

		<td class="lvtCol2"  nowrap>买家留言</td>

		<td class="lvtCol2"  nowrap>订单备注</td>

		<td class="lvtCol2"  nowrap>支付积分</td>

		<td class="lvtCol2"  nowrap>返点积分</td>

		<td class="lvtCol2"  nowrap>更新时间</td>
 
      </tr>

    </table>

</td></tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;</td>
</tr>
</tbody>
</table>

</div>


<input type="hidden" id="tabview"  value="DetailsOrders" />
<input type="hidden" id="recordid"  value="" />
<input type="hidden" id="modulename"  value="Accounts" />
<?php if ($this->_tpl_vars['LISTENTITY'] && count ( $this->_tpl_vars['LISTENTITY'] ) != 0): ?>
             <?php 
                $urlstr1="";
                foreach($_REQUEST as $key=>$value)
                {
                    if($key!='module'&&$key!='action'&&$key!='file')
                    {
                        $urlstr1.="&$key=$value";
                    }

                }
                $this->assign('COLLECTURLSTR',$urlstr1);
                ?>
             <div id="collectcolumntable">
                <script>getColumnCollectInf('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['COLLECTURLSTR']; ?>
');</script>
            </div>
            <?php endif; ?>
<script>
var record = '<?php echo $this->_tpl_vars['RECORD']; ?>
';
var winsa=null;


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
window.onload = function(){
	if(record !=\'\'){ 
		getTabViewNew(record,\'\');
	}
}

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
    $("status").style.display="inline";
	getTabViewNewClear();
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
										
			}
	       }
        );

}
function showhide()
{
	if(winsa){
            var x = $(winsa.getId()).style;
            if(x.display == "block")
            {
                    x.display = "none";
            }
            else
            {
                    x.display = "block";
            }
        }
}

function winhide(){
    Windows.close(winsa.getId());
    //wins.destroy();
}


function openDialogs(noteid){
//window.open(\'index.php?module=Announcements&action=PopupUser\',\'test\',\'width=700,height=602,resizable=1,scrollbars=1\');
//Dialog.confirm($(\'rec\').innerHTML, {maximizable:false,minimizable:false,className:"mac_os_x",title:"选择接收人",draggable:true,width:400, okLabel: "确认", cancelLabel: "取消", onOk:function(win){ return getReceiver(); }});
if(!winsa){
winsa = new Window({maximizable:false,minimizable:false,className:"mac_os_x", title:"创建联系记录",width:"630px",height:"360px", destroyOnClose: false, recenterAuto:false});
//winsa.getContent().update($(\'rec\').innerHTML.gsub("recform1","recform").gsub("rectable1","rectable"));
}
//console.log($(\'rectable\'))
var options={
              method: \'post\',
              asynchronous:false,
              postBody:"module=Notes&action=NotesAjax&file=NewEditView&return_id="+noteid+"&return_module=Accounts"
            };
    
winsa.setAjaxContent("index.php", options, true, false);
if(!winsa.isMinimized()&&!winsa.isMaximized()){
new PeriodicalExecuter(function(pe) {
var width=630;
var height=360;
if(width!=0&&height!=0){
	if(Prototype.Browser.IE){
		height=height+23;
	}else{
		height=height+10;
	}
	if(width<600) width=600;
	winsa.setSize(width, height);
	pe.stop();
}

}, 0.5);
}
// wins.setSize(width, height);
// console.log([$(\'rectable\').getWidth(), $(\'rectable\').getHeight()])
}

function saveNotes(){
	var inputels=$$(\'.upaccount\');
	var searchobj={}
	searchobj[\'search\']=\'true\';    
	for(var i=0;i<inputels.length;i++){
		var inputel=inputels[i];
		searchobj[inputel.name]=$F(inputel);
	}

	var findstr="&"+$H(searchobj).toQueryString();
	
	$("status").style.display="inline";
		new Ajax.Request(

			\'index.php\',

			  {queue: {position: \'end\', scope: \'command\'},

				method: \'post\',

				postBody: \'module=Notes&action=NotesAjax&file=Save\'+findstr,

				onComplete: function(response) {
						$("status").style.display="none";	
						result = response.responseText; 
						winsa.close();
						getTabViewForList("Noteinfo",\'\');	
				}
			  }
		);
}

</script>
'; ?>




