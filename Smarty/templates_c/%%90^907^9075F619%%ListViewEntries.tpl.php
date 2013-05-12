<?php /* Smarty version 2.6.18, created on 2012-12-21 11:18:51
         compiled from Maillisttmps/ListViewEntries.tpl */ ?>
<?php if ($_REQUEST['ajax'] != ''): ?>
&#&#&#<?php echo $this->_tpl_vars['ERROR']; ?>
&#&#&#
<?php endif; ?>

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
				<!-- List View Master Holder starts -->
				<table border=0 cellspacing=1 cellpadding=0 width=100% class="lvtBg">
				<tr>
				<td>
				<!-- List View's Buttons and Filters starts -->
		        <table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
			    <tr>
				<!-- Buttons -->
				<td style="padding-right:20px" align="left" nowrap>
							
				<?php $_from = $this->_tpl_vars['BUTTONS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['button_check'] => $this->_tpl_vars['button_label']):
?>
				        <?php if ($this->_tpl_vars['button_check'] == 'quick_edit'): ?>
					    <input class="crmbutton small cancel" type="button" value="<?php echo $this->_tpl_vars['APP']['LBL_QUICKEDIT_BUTTON_LABEL']; ?>
" onclick="return quick_edit(this, 'quickedit', '<?php echo $this->_tpl_vars['MODULE']; ?>
')"/>
                                        <?php elseif ($this->_tpl_vars['button_check'] == 'del'): ?>
                                            <input class="crmbutton small delete" type="button" value=" <?php echo $this->_tpl_vars['button_label']; ?>
 " onclick="return massDelete('<?php echo $this->_tpl_vars['MODULE']; ?>
')"/>
					    
					<?php elseif ($this->_tpl_vars['button_check'] == 'c_owner'): ?>
				             
                                        <?php endif; ?>
                                 <?php endforeach; endif; unset($_from); ?>
				 
                </td>
				<!-- Page Navigation -->
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
			
			<div  >
			<table border=0 cellspacing=1 cellpadding=3 width=100% class="lvt small">
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
			<tr bgcolor=white onMouseOver="this.className='lvtColDataHover'" onMouseOut="this.className='lvtColData'" id="row_<?php echo $this->_tpl_vars['entity_id']; ?>
">
			<td width="2%"><input type="checkbox" NAME="selected_id" value= '<?php echo $this->_tpl_vars['entity_id']; ?>
' onClick=toggleSelectAll(this.name,"selectall")></td>
			<?php $_from = $this->_tpl_vars['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>	
			<td><?php echo $this->_tpl_vars['data']; ?>
</td>
	        <?php endforeach; endif; unset($_from); ?>
			</tr>
			<?php endforeach; else: ?>
			<tr><td style="background-color:#efefef;height:340px" align="center" colspan="<?php echo $this->_foreach['listviewforeach']['iteration']+1; ?>
">
			<div style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 45%; position: relative; z-index: 10000000;">
										
				<table border="0" cellpadding="5" cellspacing="0" width="98%">
				<tr>
					<td rowspan="2" width="25%"><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
empty.jpg" height="60" width="61"></td>
					<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
					<?php echo $this->_tpl_vars['APP']['LBL_FOUND']; ?>

					</span></td>
				</tr>
				
				</table> 
					
				</div>					
				</td></tr>	
			<?php endif; unset($_from); ?>
                
			 </table>
		       </td>
		   </tr>
	    </table>
        
			 </div>
   </form>	