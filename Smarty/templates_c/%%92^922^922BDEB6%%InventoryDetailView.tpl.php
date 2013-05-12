<?php /* Smarty version 2.6.18, created on 2012-12-21 17:01:00
         compiled from SalesOrder/InventoryDetailView.tpl */ ?>
<script type="text/javascript" src="modules/<?php echo $this->_tpl_vars['MODULE']; ?>
/<?php echo $this->_tpl_vars['SINGLE_MOD']; ?>
.js"></script>
<script type="text/javascript" src="include/js/dtlviewajax.js"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<div id="creategathersdiv" style="display:block;position:absolute;left:225px;top:150px;"></div>
<script>
<?php echo '
function callCreateGathersDiv(id)
{
	new Ajax.Request(
		\'index.php\',
		{queue: {position: \'end\', scope: \'command\'},
			method: \'post\',
			postBody: \'module=SalesOrder&action=SalesOrderAjax&file=CreateGathers&record=\'+id,
			onComplete: function(response) {
				$("creategathersdiv").innerHTML=response.responseText;
				eval($("addDefaultPlan").innerHTML);
				Drag.init(document.getElementById("gather_div_title"), document.getElementById("orgLay"));
			}
		}
	);
}
'; ?>

</script>
<div id="createapprove_div" style="display:block;position:absolute;left:225px;top:150px;"></div>
<div id="createapprovehistory_div" class="layerPopup" style="display:none;position:absolute;left:425px;top:150px;cursor:move;"></div>
<div id="createapprovestep_div" class="layerPopup" style="display:none;position:absolute;left:425px;top:150px;cursor:move;"></div>
<span id="crmspanid" style="display:none;position:absolute;"  onmouseover="fnshow('crmspanid');"  onmouseout="fnhide('crmspanid');">
   <a class="link"  align="right" href="javascript:;"><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON']; ?>
</a>
</span>
<script>
function tagvalidate()
{
	if(document.getElementById('txtbox_tagfields').value != '')
		SaveTagI('txtbox_tagfields','<?php echo $this->_tpl_vars['ID']; ?>
','<?php echo $this->_tpl_vars['MODULE']; ?>
');	
	else
	{
		alert(alert_arr.INPUT_TAG);
		return false;
	}
}
function SaveTagI(txtBox,crmId,module)
{
	var tagValue = document.getElementById(txtBox).value;
	document.getElementById(txtBox).value ='';
	$("vtbusy_info").style.display="inline";
	new Ajax.Request(
		'index.php',
                {queue: {position: 'end', scope: 'command'},
                        method: 'post',
                        postBody: "file=TagCloud&module=" + module + "&action=" + module + "Ajax&recordid=" + crmId + "&ajxaction=SAVETAG&tagfields=" +tagValue,
                        onComplete: function(response) {
					$("tagfields").innerHTML=response.responseText;
					$("vtbusy_info").style.display="none";
                        }
                }
        );
    
}
function DeleteTag(id)
{
	$("vtbusy_info").style.display="inline";
	Effect.Fade('tag_'+id);
	new Ajax.Request(
		'index.php',
                {queue: {position: 'end', scope: 'command'},
                        method: 'post',
                        postBody: "file=TagCloud&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['MODULE']; ?>
Ajax&ajxaction=DELETETAG&tagid=" +id,
                        onComplete: function(response) {
						getTagCloud();
						$("vtbusy_info").style.display="none";
                        }
                }
        );
}

</script>
<table width="100%" cellpadding="2" cellspacing="0" border="0">
   <tr>
	<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List_details.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<!-- Contents -->
		<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
		   <tr>
			<td class="showPanelBg" valign=top width=100%>
			<!-- PUBLIC CONTENTS STARTS-->
			   <div class="small" style="padding:0px" >

		
				<!-- Entity and More information tabs -->
				<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
				   <tr>
					<td>
						<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
						   <tr>
							<td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>
						   </tr>
						</table>
					</td>
				   </tr>
				   <tr>
					<td valign=top align=left >
						<table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
						   <tr>

							<td align=left style="padding:0px;">
							<!-- content cache -->
								<!-- Entity informations display - starts -->	
								<table border=0 cellspacing=0 cellpadding=0 width=100%>
			                			   <tr>
									<td style="padding:10px;" width="80%">



<!-- The following table is used to display the buttons -->
   <form action="index.php" method="post" name="DetailView" id="form">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'DetailViewHidden.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
   <?php echo '<tr><td  colspan=4 style="padding:5px"><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td>'; ?><?php if ($this->_tpl_vars['EDIT'] == 'permitted'): ?><?php echo '<input '; ?><?php echo $this->_tpl_vars['ORDER_STATUS']; ?><?php echo ' title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?><?php echo '" accessKey="'; ?><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?><?php echo '" class="crmbutton small edit" onclick="this.form.return_module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\''; ?><?php echo $this->_tpl_vars['ID']; ?><?php echo '\';this.form.module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\';this.form.action.value=\'EditView\'" type="submit" name="Edit" value="'; ?><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?><?php echo '">&nbsp;'; ?><?php endif; ?><?php echo '<input title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_LIST_BUTTON_TITLE']; ?><?php echo '" class="crmbutton small edit" onclick="document.location.href=\'index.php?module='; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '&action=index&parenttab='; ?><?php echo $this->_tpl_vars['CATEGORY']; ?><?php echo '\'" type="button" name="ListView" value="&nbsp;'; ?><?php echo $this->_tpl_vars['APP']['LBL_LIST_BUTTON_LABEL']; ?><?php echo '&nbsp;">&nbsp;</td><td align=right>'; ?><?php if ($this->_tpl_vars['EDIT_DUPLICATE'] == 'permitted'): ?><?php echo '<input title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_TITLE']; ?><?php echo '" accessKey="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_KEY']; ?><?php echo '" class="crmbutton small create" onclick="this.form.return_module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.return_action.value=\'DetailView\'; this.form.isDuplicate.value=\'true\';this.form.module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.action.value=\'EditView\'" type="submit" name="Duplicate" value="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_LABEL']; ?><?php echo '">&nbsp;'; ?><?php endif; ?><?php echo ''; ?><?php if (( $this->_tpl_vars['DELETE'] == 'permitted' && $this->_tpl_vars['APPROVE_STATUS'] != '1' ) || $this->_tpl_vars['IS_ADMIN'] == 'true'): ?><?php echo '<input title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?><?php echo '" accessKey="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?><?php echo '" class="crmbutton small delete" onclick="this.form.return_module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.return_action.value=\'index\'; this.form.action.value=\'Delete\'; return confirm(\''; ?><?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?><?php echo '\')" type="submit" name="Delete" value="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?><?php echo '">&nbsp;'; ?><?php endif; ?><?php echo '</td></tr></table></td></tr>'; ?>

</table>
<!-- Button displayed - finished-->

<!-- Entity information(blocks) display - start -->
<?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listviewforeach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listviewforeach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['detail']):
        $this->_foreach['listviewforeach']['iteration']++;
?>
	<table border=0 cellspacing=0 cellpadding=0 width=100% class="small" style="padding-bottom:10px;">
	   <tr>
		<td width="20%" height="1"></td><td height="1" width="30%"></td>
		<td width="20%" height="1"></td><td height="1" width="30%"></td>
	   </tr>
	   <tr>
		<?php echo '<td colspan=4 class="dvInnerHeader" >'; ?><?php if ($this->_foreach['listviewforeach']['iteration'] > 1): ?><?php echo '<a href="###" onclick="ToggleGroupContent(\'Gsub'; ?><?php echo $this->_foreach['listviewforeach']['iteration']; ?><?php echo '\',\'Gimg'; ?><?php echo $this->_foreach['listviewforeach']['iteration']; ?><?php echo '\')"><img id="Gimg'; ?><?php echo $this->_foreach['listviewforeach']['iteration']; ?><?php echo '" border="0" src="themes/images/expand.gif"><b>'; ?><?php echo $this->_tpl_vars['header']; ?><?php echo '</b></a>'; ?><?php else: ?><?php echo '<b>'; ?><?php echo $this->_tpl_vars['header']; ?><?php echo '</b>'; ?><?php endif; ?><?php echo '</td>'; ?>

	   </tr>
     <tr>
         <?php if ($this->_foreach['listviewforeach']['iteration'] > 1): ?>
             <tr>
             <td colspan=4>
            <div id="Gsub<?php echo $this->_foreach['listviewforeach']['iteration']; ?>
" style="display:none;">
            <table  border=0 cellspacing=0 cellpadding=0 width=100% class="small">
        <?php else: ?>
             <tr>
             <td colspan=4>
            <table  border=0 cellspacing=0 cellpadding=0 width=100% class="small">
        <?php endif; ?> 
        <?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
	     <tr style="height:25px">
		<?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['data']):
?>
		   <?php $this->assign('keyid', $this->_tpl_vars['data']['ui']); ?>
		   <?php $this->assign('keyval', $this->_tpl_vars['data']['value']); ?>
		   <?php $this->assign('keyseclink', $this->_tpl_vars['data']['link']); ?>
		   <?php if ($this->_tpl_vars['label'] != ''): ?>
		    <td class="dvtCellLabel" align=right width="25%"><?php echo $this->_tpl_vars['label']; ?>
</td>								
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DetailViewFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		   <?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	      </tr>	
	   <?php endforeach; endif; unset($_from); ?>
       <?php if ($this->_foreach['listviewforeach']['iteration'] > 1): ?>
           </table>
         </div>	
         </td>
       </tr>
      <?php else: ?>
       </table>
         </td>
       </tr>
      <?php endif; ?>
	</table>
<?php endforeach; endif; unset($_from); ?>
 
<!-- Entity information(blocks) display - ends -->

									<br>

										<!-- Product Details informations -->
										<?php echo $this->_tpl_vars['ASSOCIATED_PRODUCTS']; ?>


									</td>
<!-- The following table is used to display the buttons -->
								<table border=0 cellspacing=0 cellpadding=0 width=100%>
			                			   <tr>
									<td style="padding:10px;" width="80%">
			<?php if ($this->_tpl_vars['SinglePane_View'] == 'false'): ?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
   <?php echo '<tr><td  colspan=4 style="padding:5px"><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td>'; ?><?php if ($this->_tpl_vars['EDIT'] == 'permitted'): ?><?php echo '<input '; ?><?php echo $this->_tpl_vars['ORDER_STATUS']; ?><?php echo ' title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?><?php echo '" accessKey="'; ?><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?><?php echo '" class="crmbutton small edit" onclick="this.form.return_module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\''; ?><?php echo $this->_tpl_vars['ID']; ?><?php echo '\';this.form.module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\';this.form.action.value=\'EditView\'" type="submit" name="Edit" value="'; ?><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?><?php echo '">&nbsp;'; ?><?php endif; ?><?php echo '<input title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_LIST_BUTTON_TITLE']; ?><?php echo '" class="crmbutton small edit" onclick="document.location.href=\'index.php?module='; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '&action=index&parenttab='; ?><?php echo $this->_tpl_vars['CATEGORY']; ?><?php echo '\'" type="button" name="ListView" value="&nbsp;'; ?><?php echo $this->_tpl_vars['APP']['LBL_LIST_BUTTON_LABEL']; ?><?php echo '&nbsp;">&nbsp;</td><td align=right>'; ?><?php if ($this->_tpl_vars['EDIT_DUPLICATE'] == 'permitted'): ?><?php echo '<input title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_TITLE']; ?><?php echo '" accessKey="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_KEY']; ?><?php echo '" class="crmbutton small create" onclick="this.form.return_module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.return_action.value=\'DetailView\'; this.form.isDuplicate.value=\'true\';this.form.module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.action.value=\'EditView\'" type="submit" name="Duplicate" value="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_LABEL']; ?><?php echo '">&nbsp;'; ?><?php endif; ?><?php echo ''; ?><?php if (( $this->_tpl_vars['DELETE'] == 'permitted' && $this->_tpl_vars['APPROVE_STATUS'] != '1' ) || $this->_tpl_vars['IS_ADMIN'] == 'true'): ?><?php echo '<input title="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?><?php echo '" accessKey="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?><?php echo '" class="crmbutton small delete" onclick="this.form.return_module.value=\''; ?><?php echo $this->_tpl_vars['MODULE']; ?><?php echo '\'; this.form.return_action.value=\'index\'; this.form.action.value=\'Delete\'; return confirm(\''; ?><?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?><?php echo '\')" type="submit" name="Delete" value="'; ?><?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?><?php echo '">&nbsp;'; ?><?php endif; ?><?php echo '</td></tr></table></td></tr>'; ?>

</table>
<?php endif; ?>
</form>
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		  <tr>
			<td style="" width="100%">
			<?php if ($this->_tpl_vars['SinglePane_View'] == 'true'): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'RelatedListNew.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</td></tr></table>
</td></tr></table>
<!-- Button displayed - finished-->
									<!-- Inventory Actions - ends -->	
									
								   </tr>
								</table>
							</td>
						   </tr>
						</table>
					<!-- PUBLIC CONTENTS STOPS-->
					</td>
				   </tr>
				</table>
			   </div>
			</td>
		   </tr>
		</table>
		<!-- Contents - end -->

<script>
function getTagCloud()
{
new Ajax.Request(
        'index.php',
        {queue: {position: 'end', scope: 'command'},
        method: 'post',
        postBody: 'module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['MODULE']; ?>
Ajax&file=TagCloud&ajxaction=GETTAGCLOUD&recordid=<?php echo $this->_tpl_vars['ID']; ?>
',
        onComplete: function(response) {
                                $("tagfields").innerHTML=response.responseText;
                                $("txtbox_tagfields").value ='';
                        }
        }
);
}
getTagCloud();
</script>

	</td>
   </tr>
</table>
<script language="javascript">
  var fieldname = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDNAME']; ?>
);
  var fieldlabel = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDLABEL']; ?>
);
  var fielddatatype = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDDATATYPE']; ?>
);
</script>
