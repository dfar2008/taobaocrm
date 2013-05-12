<?php /* Smarty version 2.6.18, created on 2012-12-21 11:18:41
         compiled from SalesOrder/ListViewEntries.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'SalesOrder/ListViewEntries.tpl', 136, false),)), $this); ?>
<?php if ($_REQUEST['ajax'] != ''): ?>
&#&#&#<?php echo $this->_tpl_vars['ERROR']; ?>
&#&#&#
<?php endif; ?>
				<!-- List View Master Holder starts -->
				<table border=0 cellspacing=1 cellpadding=0 width=100% class="lvtBg">
                
<form name="massdelete" method="POST" action="index.php">
     <input name='search_url' id="search_url" type='hidden' value='<?php echo $this->_tpl_vars['SEARCH_URL']; ?>
'>
     <input name="idlist" id="idlist" type="hidden">
     <input name="action" id="action" type="hidden">
     <input name="module" id="module" type="hidden">
     <input id="viewname" name="viewname" type="hidden" value="<?php echo $this->_tpl_vars['VIEWID']; ?>
">
     <input name="change_owner" type="hidden">
     <input name="change_status" type="hidden">
     <input name="allids" type="hidden" value="<?php echo $this->_tpl_vars['ALLIDS']; ?>
">

                <tbody>
				<tr>
				<td>
				<!-- List View's Buttons and Filters starts -->
		        <table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
			    <tr>
				<!-- Buttons -->
				<td style="padding-right:20px" align="left" nowrap>
				 <input class="crmbutton small delete" type="button" value=" <?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON']; ?>
 " onclick="return massDelete('<?php echo $this->_tpl_vars['MODULE']; ?>
')"/>
                </td>
				<td nowrap width="100%" align="right" valign="middle">
					<table border=0 cellspacing=0 cellpadding=0 class="small">
					     <tr><td style="padding-right:5px"><?php echo $this->_tpl_vars['RECORD_COUNTS']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['NAVIGATION']; ?>
</td></tr>
					</table>
				 </td>
			
					
       		    </tr>
			</table>
			<!-- List View's Buttons and Filters ends -->
			<div  style="height:272px;width:100%;overflow:auto;">
			<table border=0 cellspacing=1 cellpadding=3 width=100% class="lvt small">
			<!-- Table Headers -->
			<!-- Table Headers -->
			<tr>
            <td class="lvtCol"><input type="checkbox"  name="selectall" onClick=toggleSelect(this.checked,"selected_id")></td>
				 <?php $_from = $this->_tpl_vars['LISTHEADER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listviewforeach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listviewforeach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['header']):
        $this->_foreach['listviewforeach']['iteration']++;
?>
 			<td class="lvtCol"><?php echo $this->_tpl_vars['header']; ?>
</td>
				<?php endforeach; endif; unset($_from); ?>
			</tr>
			<!-- Table Contents -->
			<?php $_from = $this->_tpl_vars['LISTENTITY']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entity_id'] => $this->_tpl_vars['entity']):
?>
			<tr bgcolor=white class="lvtColData changehand" id="row_<?php echo $this->_tpl_vars['entity_id']; ?>
">
			<td width="2%"><input type="checkbox" NAME="selected_id" value= '<?php echo $this->_tpl_vars['entity_id']; ?>
' onClick=toggleSelectAll(this.name,"selectall")></td>
			<?php $_from = $this->_tpl_vars['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>	
			<td onClick="getTabViewNew('<?php echo $this->_tpl_vars['entity_id']; ?>
',this);" ><?php echo $this->_tpl_vars['data']; ?>
</td>
	        <?php endforeach; endif; unset($_from); ?>
			</tr>
			<?php endforeach; else: ?>
			<tr><td style="background-color:#efefef;height:340px" align="center" colspan="<?php echo $this->_foreach['listviewforeach']['iteration']+1; ?>
">
			<div style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 45%; position: relative; z-index: 10000000;">
				<?php $this->assign('vowel_conf', 'LBL_A'); ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Accounts' || $this->_tpl_vars['MODULE'] == 'Invoice'): ?>
				<?php $this->assign('vowel_conf', 'LBL_AN'); ?>
				<?php endif; ?>
				<?php $this->assign('MODULE_CREATE', $this->_tpl_vars['SINGLE_MOD']); ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'HelpDesk'): ?>
				<?php $this->assign('MODULE_CREATE', 'Ticket'); ?>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['CHECK']['Create'] == 'yes' && $this->_tpl_vars['MODULE'] != 'Emails' && $this->_tpl_vars['MODULE'] != 'Webmails'): ?>
							
				<table border="0" cellpadding="5" cellspacing="0" width="98%">
				<tr>
					<td rowspan="2" width="25%"><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
empty.jpg" height="60" width="61"></td>
					<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
					<?php if ($this->_tpl_vars['MODULE_CREATE'] == 'SalesOrder' || $this->_tpl_vars['MODULE_CREATE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE_CREATE'] == 'Invoice' || $this->_tpl_vars['MODULE_CREATE'] == 'Quotes'): ?>
						<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE_CREATE']]; ?>
&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_FOUND']; ?>
!
					<?php else: ?>
						<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE_CREATE']]; ?>
&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_FOUND']; ?>
!
					<?php endif; ?>
					</span></td>
				</tr>
				<tr>
					<td class="small" nowrap="nowrap">
					<?php if ($this->_tpl_vars['MODULE'] != 'Calendar'): ?>	
		  			<a href="index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=EditView&return_action=DetailView&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
">
					<?php if ($this->_tpl_vars['MODULE_CREATE'] == 'SalesOrder' || $this->_tpl_vars['MODULE_CREATE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE_CREATE'] == 'Invoice' || $this->_tpl_vars['MODULE_CREATE'] == 'Quotes'): ?>
					       <?php echo $this->_tpl_vars['APP']['LBL_CREATE']; ?>
&nbsp;<?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['MODULE_CREATE']]; ?>

					<?php else: ?>
					       <?php echo $this->_tpl_vars['APP']['LBL_CREATE']; ?>
&nbsp;<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE_CREATE']]; ?>

					<?php endif; ?>
					</a><br>
					<?php else: ?>
					<a href="index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&amp;action=EditView&amp;return_module=Calendar&amp;activity_mode=Events&amp;return_action=DetailView&amp;parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
"><?php echo $this->_tpl_vars['APP']['LBL_CREATE']; ?>
<?php echo $this->_tpl_vars['APP']['Event']; ?>
</a><br>
					
					<?php endif; ?>
					</td>
				</tr>
				</table> 
					<?php else: ?>
				<table border="0" cellpadding="5" cellspacing="0" width="98%">
				<tr>
				<td rowspan="2" width="25%"><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
empty.jpg"></td>
				<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
				<?php if ($this->_tpl_vars['MODULE_CREATE'] == 'SalesOrder' || $this->_tpl_vars['MODULE_CREATE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE_CREATE'] == 'Invoice' || $this->_tpl_vars['MODULE_CREATE'] == 'Quotes'): ?>
					<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE_CREATE']]; ?>
&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_FOUND']; ?>
!</span></td>
				<?php else: ?>
					<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['MODULE_CREATE']]; ?>
&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_FOUND']; ?>
!</span></td>
				<?php endif; ?>
				</tr>
				
				</table>
				<?php endif; ?>
				</div>					
				</td></tr>	
			     <?php endif; unset($_from); ?>
			 </table>
			 </div>
			 
			
		       </td>
		   </tr>
           </tbody>
              </form>	
	    </table>


<div id="basicsearchcolumns" style="display:none;"><select name="search_field" id="bas_searchfield" class="txtBox" style="width:150px"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['SEARCHLISTHEADER']), $this);?>
</select></div>