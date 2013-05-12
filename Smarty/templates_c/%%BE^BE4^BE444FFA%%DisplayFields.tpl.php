<?php /* Smarty version 2.6.18, created on 2012-12-21 11:33:34
         compiled from DisplayFields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'DisplayFields.tpl', 76, false),)), $this); ?>

<!-- Added this file to display the fields in Create Entity page based on ui types  -->
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['subdata']):
?>
	<?php if ($this->_tpl_vars['header'] == 'Product Details'): ?>
		<tr>
	<?php else: ?>
		<tr style="height:25px">
	<?php endif; ?>
	<?php $_from = $this->_tpl_vars['subdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mainlabel'] => $this->_tpl_vars['maindata']):
?>
		<?php $this->assign('uitype', ($this->_tpl_vars['maindata'][0][0])); ?>
		<?php $this->assign('fldlabel', ($this->_tpl_vars['maindata'][1][0])); ?>
		<?php $this->assign('fldlabel_sel', ($this->_tpl_vars['maindata'][1][1])); ?>
		<?php $this->assign('fldlabel_combo', ($this->_tpl_vars['maindata'][1][2])); ?>
		<?php $this->assign('fldname', ($this->_tpl_vars['maindata'][2][0])); ?>
		<?php $this->assign('fldvalue', ($this->_tpl_vars['maindata'][3][0])); ?>
		<?php $this->assign('secondvalue', ($this->_tpl_vars['maindata'][3][1])); ?>
		<?php $this->assign('thirdvalue', ($this->_tpl_vars['maindata'][3][2])); ?>
		<?php $this->assign('fourthvalue', ($this->_tpl_vars['maindata'][3][3])); ?>
		<?php $this->assign('vt_tab', ($this->_tpl_vars['maindata'][4][0])); ?>
		<?php $this->assign('readonly', ($this->_tpl_vars['maindata'][0][1])); ?>
		<?php $this->assign('mandatory', ($this->_tpl_vars['maindata'][0][2])); ?>
		<?php if ($this->_tpl_vars['readonly'] == '0'): ?>
		        <?php $this->assign('disable', ' disabled '); ?>
		<?php else: ?>
		        <?php $this->assign('disable', ' '); ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['mandatory'] == '1'): ?>
		        <?php $this->assign('required', " <font color='red'>*</font> "); ?>
		<?php else: ?>
		        <?php $this->assign('required', ' '); ?>
		<?php endif; ?>
		
		

		<?php if ($this->_tpl_vars['uitype'] == 2): ?>
			<td width=20% class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width=30% align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" id="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'">
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 11 || $this->_tpl_vars['uitype'] == 1 || $this->_tpl_vars['uitype'] == 13 || $this->_tpl_vars['uitype'] == 7 || $this->_tpl_vars['uitype'] == 9): ?>
			<td width=20% class="dvtCellLabel" align=right><?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>
</td>
			<td width=30% align=left class="dvtCellInfo"><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" name="<?php echo $this->_tpl_vars['fldname']; ?>
" id ="<?php echo $this->_tpl_vars['fldname']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'"></td>
		<?php elseif ($this->_tpl_vars['uitype'] == 10): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 readonly name="<?php echo $this->_tpl_vars['thirdvalue']; ?>
" type="text" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick="return openUITenPopup('<?php echo $this->_tpl_vars['fourthvalue']; ?>
');" align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.<?php echo $this->_tpl_vars['thirdvalue']; ?>
.value=''; document.EditView.<?php echo $this->_tpl_vars['fldname']; ?>
.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 19 || $this->_tpl_vars['uitype'] == 20): ?>
			<!-- In Add Comment are we should not display anything -->
			<?php if ($this->_tpl_vars['fldlabel'] == $this->_tpl_vars['MOD']['LBL_ADD_COMMENT']): ?>
				<?php $this->assign('fldvalue', ""); ?>
			<?php endif; ?>
			<td width=20% class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>

				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td colspan=3>
            <?php if ($this->_tpl_vars['MODULE'] == 'Maillisttmps' || $this->_tpl_vars['MODULE'] == 'Qunfatmps'): ?>
				<textarea<?php echo $this->_tpl_vars['disable']; ?>
 class="detailedViewTextBox" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" onFocus="this.className='detailedViewTextBoxOn'" name="<?php echo $this->_tpl_vars['fldname']; ?>
"  onBlur="this.className='detailedViewTextBox'" cols="90" style="height:200px;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['fldvalue'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                <?php else: ?>
                <textarea<?php echo $this->_tpl_vars['disable']; ?>
 class="detailedViewTextBox" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" onFocus="this.className='detailedViewTextBoxOn'" name="<?php echo $this->_tpl_vars['fldname']; ?>
"  onBlur="this.className='detailedViewTextBox'" cols="90" rows="8"><?php echo ((is_array($_tmp=$this->_tpl_vars['fldvalue'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                <?php endif; ?>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 21 || $this->_tpl_vars['uitype'] == 24): ?>
			<td width=20% class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>

				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width=30% align=left class="dvtCellInfo">
				<textarea<?php echo $this->_tpl_vars['disable']; ?>
 value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" rows=2><?php echo ((is_array($_tmp=$this->_tpl_vars['fldvalue'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 15 || $this->_tpl_vars['uitype'] == 16 || $this->_tpl_vars['uitype'] == 111): ?> <!-- uitype 111 added for noneditable existing picklist values - ahmed -->
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>

				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			   <select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['arr']):
?>
					<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['sel_value']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
>                                                
                                                        <?php echo $this->_tpl_vars['sel_value']; ?>

                                                </option>
					<?php endforeach; endif; unset($_from); ?>
				<?php endforeach; endif; unset($_from); ?>
			   </select>
			</td>
        <?php elseif ($this->_tpl_vars['uitype'] == 155): ?> <!-- uitype 111 added for noneditable existing picklist values - ahmed -->
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>

				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			   <select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['arr']):
?>
						<option value="<?php echo $this->_tpl_vars['arr']['0']['0']; ?>
" <?php echo $this->_tpl_vars['arr']['1']; ?>
>                                                
                                                        <?php echo $this->_tpl_vars['arr']['0']['1']; ?>

                                                </option>
				<?php endforeach; endif; unset($_from); ?>
			   </select>
			</td>
        <?php elseif ($this->_tpl_vars['uitype'] == 1021 || $this->_tpl_vars['uitype'] == 1022 || $this->_tpl_vars['uitype'] == 1023): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>

				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			   <select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" id="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small" onchange="multifieldSelectChange('<?php echo $this->_tpl_vars['uitype']; ?>
','<?php echo $this->_tpl_vars['secondvalue']; ?>
','<?php echo $this->_tpl_vars['MODULE']; ?>
',this);">
				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>

						<option value="<?php echo $this->_tpl_vars['value'][1]; ?>
" relvalue="<?php echo $this->_tpl_vars['value'][0]; ?>
" <?php echo $this->_tpl_vars['value'][2]; ?>
>
                                                        <?php echo $this->_tpl_vars['value'][1]; ?>


				<?php endforeach; endif; unset($_from); ?>
			   </select>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 33): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			   <select<?php echo $this->_tpl_vars['disable']; ?>
 MULTIPLE name="<?php echo $this->_tpl_vars['fldname']; ?>
[]" size="4" style="width:160px;" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
                                                                                        <?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_one'] => $this->_tpl_vars['arr']):
?>
				                    					<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
                    										<option value="<?php echo $this->_tpl_vars['sel_value']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>		
                    									<?php endforeach; endif; unset($_from); ?>
											<?php endforeach; endif; unset($_from); ?>
			   </select>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 53): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">	
				<select<?php echo $this->_tpl_vars['disable']; ?>
 name="assigned_user_id" class="small">
					<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_one'] => $this->_tpl_vars['arr']):
?>
						<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['key_one']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>				
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 54): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">				
				<select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_one'] => $this->_tpl_vars['arr']):
?>
					<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['sel_value']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 52 || $this->_tpl_vars['uitype'] == 77): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<?php if ($this->_tpl_vars['uitype'] == 52): ?>
					<select<?php echo $this->_tpl_vars['disable']; ?>
 name="assigned_user_id" class="small">
				<?php elseif ($this->_tpl_vars['uitype'] == 77): ?>
					<select<?php echo $this->_tpl_vars['disable']; ?>
 name="assigned_user_id" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
				<?php else: ?>
					<select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
				<?php endif; ?>

				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_one'] => $this->_tpl_vars['arr']):
?>
					<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['key_one']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1004): ?>
		        <td  class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td  align=left class="dvtCellInfo">
				<?php echo $this->_tpl_vars['fldvalue']; ?>

			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 51): ?>
			<?php if ($this->_tpl_vars['MODULE'] == 'Accounts'): ?>
				<?php $this->assign('popuptype', 'specific_account_address'); ?>
			<?php else: ?>
				<?php $this->assign('popuptype', 'specific_contact_account_address'); ?>
			<?php endif; ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 readonly name="account_name" class="detailedViewTextBox"  type="text" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">
                <br>①直接查客户: <input style='border: 1px solid rgb(186, 186, 186);' id='account_search_val' name='account_search_val' type="text">&nbsp;<input type='button' value='查' onclick='SearchAccountVal();'>
                <br>②浏览选客户: <img tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Accounts&action=Popup&popuptype=<?php echo $this->_tpl_vars['popuptype']; ?>
&form=TasksEditView&form_submit=false","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.account_id.value=''; document.EditView.account_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 50): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 readonly name="account_name" class="detailedViewTextBox"  type="text" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">
                <br>①直接查客户: <input style='border: 1px solid rgb(186, 186, 186);' id='account_search_val' name='account_search_val' type="text">&nbsp;<input type='button' value='查' onclick='SearchAccountVal();'>
                <br>②浏览选客户: <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Accounts&action=Popup&popuptype=specific&form=TasksEditView&form_submit=false","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 73): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 readonly class="detailedViewTextBox" name="account_name" type="text" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;
                <br>①直接查客户:<input style='border: 1px solid rgb(186, 186, 186);' id='account_search_val' name='account_search_val' type="text">&nbsp;<input type='button' value='查' onclick='SearchAccountVal();'>
                <br>②浏览选客户:<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Accounts&action=Popup&popuptype=specific_account_address&form=TasksEditView&form_submit=false","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 75 || $this->_tpl_vars['uitype'] == 81): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php if ($this->_tpl_vars['uitype'] == 81): ?>
					<?php echo $this->_tpl_vars['required']; ?>

					<?php $this->assign('pop_type', 'specific_vendor_address'); ?>
					<?php else: ?><?php $this->assign('pop_type', 'specific'); ?>
				<?php endif; ?>
				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="vendor_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Vendors&action=Popup&html=Popup_picker&popuptype=<?php echo $this->_tpl_vars['pop_type']; ?>
&form=EditView","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>
				<?php if ($this->_tpl_vars['uitype'] == 75): ?>
					&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.vendor_id.value='';document.EditView.vendor_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
				<?php endif; ?>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 57): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			
				<td width="30%" align=left class="dvtCellInfo">
                    <!--
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="contact_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return openContactPopup()' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.contact_id.value=''; document.EditView.contact_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
				-->
                  <select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
"  id="<?php echo $this->_tpl_vars['fldname']; ?>
">
                      <?php echo $this->_tpl_vars['fldvalue']; ?>

                  </select>
                </td>
		<?php elseif ($this->_tpl_vars['uitype'] == 154): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			
				<td width="30%" align=left class="dvtCellInfo">
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="cangkuname2" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Cangkus&action=Popup&html=Popup_picker&popuptype=specific_cangku&form=EditView","test","width=700,height=602,resizable=1,scrollbars=1") ' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.cangkusid2.value=''; document.EditView.cangkuname2.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
				</td>	
		
		<?php elseif ($this->_tpl_vars['uitype'] == 58): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="campaignname" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Campaigns&action=Popup&html=Popup_picker&popuptype=specific_campaign&form=EditView","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.campaignid.value=''; document.EditView.campaignname.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 80): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="salesorder_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return openSOPopup()' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.salesorder_id.value=''; document.EditView.salesorder_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1010): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="invoice_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return openInvoicePopup()' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.invoiceid.value=''; document.EditView.invoice_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 79): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="purchaseorder_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=PurchaseOrder&action=Popup&html=Popup_picker&popuptype=specific&form=EditView","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.purchaseorder_id.value=''; document.EditView.purchaseorder_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 78): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="quote_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Quotes&action=Popup&html=Popup_picker&popuptype=specific&form=EditView","test","width=700,height=602,resizable=1,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.quote_id.value=''; document.EditView.quote_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 76): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="potential_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return openPotentialPopup();' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.potential_id.value=''; document.EditView.potential_name.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 17): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				&nbsp;&nbsp;http://&nbsp;
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" name="<?php echo $this->_tpl_vars['fldname']; ?>
" style="border:1px solid #bababa;" size="27" onFocus="this.className='detailedViewTextBoxOn'"onBlur="this.className='detailedViewTextBox'" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 85): ?>
                        <td width="20%" class="dvtCellLabel" align=right>
                                <?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

                        </td>
                        <td width="30%" align=left class="dvtCellInfo">
                                <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
skype.gif" align="absmiddle"></img><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" name="<?php echo $this->_tpl_vars['fldname']; ?>
" style="border:1px solid #bababa;" size="27" onFocus="this.className='detailedViewTextBoxOn'"onBlur="this.className='detailedViewTextBox'" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
                        </td>
		<?php elseif ($this->_tpl_vars['uitype'] == 86): ?>
                        <td width="20%" class="dvtCellLabel" align=right>
                                <?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

                        </td>
                        <td width="30%" align=left class="dvtCellInfo">
                                <img border="0" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
qq.gif"  align="absmiddle"><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" style="border:1px solid #bababa;" size="27" onFocus="this.className='detailedViewTextBoxOn'"onBlur="this.className='detailedViewTextBox'" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
                        </td>
		<?php elseif ($this->_tpl_vars['uitype'] == 87): ?>
                        <td width="20%" class="dvtCellLabel" align=right>
                                <?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

                        </td>
                        <td width="30%" align=left class="dvtCellInfo">
                                <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
msn.jpg" align="absmiddle"></img><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" style="border:1px solid #bababa;" size="27" onFocus="this.className='detailedViewTextBoxOn'"onBlur="this.className='detailedViewTextBox'" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
                        </td>
		<?php elseif ($this->_tpl_vars['uitype'] == 88): ?>
                        <td width="20%" class="dvtCellLabel" align=right>
                                <?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

                        </td>
                        <td width="30%" align=left class="dvtCellInfo">
                                <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
trade.jpg" align="absmiddle"><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" style="border:1px solid #bababa;" size="27" onFocus="this.className='detailedViewTextBoxOn'"onBlur="this.className='detailedViewTextBox'" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
                        </td>
		<?php elseif ($this->_tpl_vars['uitype'] == 89): ?>
                        <td width="20%" class="dvtCellLabel" align=right>
                                <?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

                        </td>
                        <td width="30%" align=left class="dvtCellInfo">
                                <img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
yahoo.gif" align="absmiddle"><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" style="border:1px solid #bababa;" size="27" onFocus="this.className='detailedViewTextBoxOn'"onBlur="this.className='detailedViewTextBox'" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
                        </td>

		<?php elseif ($this->_tpl_vars['uitype'] == 71 || $this->_tpl_vars['uitype'] == 72): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="text" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'"  value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 56): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<?php if ($this->_tpl_vars['fldname'] == 'notime' && $this->_tpl_vars['ACTIVITY_MODE'] == 'Events'): ?>
				<?php if ($this->_tpl_vars['fldvalue'] == 1): ?>
					<td width="30%" align=left class="dvtCellInfo">
						<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="checkbox" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" onclick="toggleTime()" checked>
					</td>
				<?php else: ?>
					<td width="30%" align=left class="dvtCellInfo">
						<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="checkbox" onclick="toggleTime()" >
					</td>
				<?php endif; ?>
			<?php else: ?>
				<?php if ($this->_tpl_vars['fldvalue'] == 1): ?>
					<td width="30%" align=left class="dvtCellInfo">
						<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="checkbox" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" checked>
					</td>
				<?php else: ?>
					<td width="30%" align=left class="dvtCellInfo">
						<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="checkbox">
					</td>
				<?php endif; ?>
			<?php endif; ?>
		<?php elseif ($this->_tpl_vars['uitype'] == 23 || $this->_tpl_vars['uitype'] == 5 || $this->_tpl_vars['uitype'] == 6): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date_value'] => $this->_tpl_vars['time_value']):
?>
					<?php $this->assign('date_val', ($this->_tpl_vars['date_value'])); ?>
					<?php $this->assign('time_val', ($this->_tpl_vars['time_value'])); ?>
				<?php endforeach; endif; unset($_from); ?>

				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" id="jscal_field_<?php echo $this->_tpl_vars['fldname']; ?>
" type="text" style="border:1px solid #bababa;" size="11" maxlength="10" value="<?php echo $this->_tpl_vars['date_val']; ?>
">
				<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
calendar.gif" id="jscal_trigger_<?php echo $this->_tpl_vars['fldname']; ?>
">

				<?php if ($this->_tpl_vars['uitype'] == 6): ?>
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="time_start" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" style="border:1px solid #bababa;" size="5" maxlength="5" type="text" value="<?php echo $this->_tpl_vars['time_val']; ?>
">
				<?php endif; ?>
				<?php if ($this->_tpl_vars['uitype'] == 23): ?>
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="time_end" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" style="border:1px solid #bababa;" size="5" maxlength="5" type="text" value="<?php echo $this->_tpl_vars['time_val']; ?>
">
				<?php endif; ?>

				<?php $_from = $this->_tpl_vars['secondvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date_format'] => $this->_tpl_vars['date_str']):
?>
					<?php $this->assign('dateFormat', ($this->_tpl_vars['date_format'])); ?>
					<?php $this->assign('dateStr', ($this->_tpl_vars['date_str'])); ?>
				<?php endforeach; endif; unset($_from); ?>
				<script type="text/javascript">
					Calendar.setup ({
						inputField : "jscal_field_<?php echo $this->_tpl_vars['fldname']; ?>
", ifFormat : "<?php echo $this->_tpl_vars['dateFormat']; ?>
", showsTime : false, button : "jscal_trigger_<?php echo $this->_tpl_vars['fldname']; ?>
", singleClick : true, step : 1
					})
				</script>


			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 63): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="text" size="2" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" >&nbsp;
				<select<?php echo $this->_tpl_vars['disable']; ?>
 name="duration_minutes" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
					<?php $_from = $this->_tpl_vars['secondvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['labelval'] => $this->_tpl_vars['selectval']):
?>
						<option value="<?php echo $this->_tpl_vars['labelval']; ?>
" <?php echo $this->_tpl_vars['selectval']; ?>
><?php echo $this->_tpl_vars['labelval']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>

		<?php elseif ($this->_tpl_vars['uitype'] == 68 || $this->_tpl_vars['uitype'] == 66 || $this->_tpl_vars['uitype'] == 62): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<select<?php echo $this->_tpl_vars['disable']; ?>
 class="small" name="parent_type" onChange='document.EditView.parent_name.value=""; document.EditView.parent_id.value=""'>
					<?php unset($this->_sections['combo']);
$this->_sections['combo']['name'] = 'combo';
$this->_sections['combo']['loop'] = is_array($_loop=$this->_tpl_vars['fldlabel']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['combo']['show'] = true;
$this->_sections['combo']['max'] = $this->_sections['combo']['loop'];
$this->_sections['combo']['step'] = 1;
$this->_sections['combo']['start'] = $this->_sections['combo']['step'] > 0 ? 0 : $this->_sections['combo']['loop']-1;
if ($this->_sections['combo']['show']) {
    $this->_sections['combo']['total'] = $this->_sections['combo']['loop'];
    if ($this->_sections['combo']['total'] == 0)
        $this->_sections['combo']['show'] = false;
} else
    $this->_sections['combo']['total'] = 0;
if ($this->_sections['combo']['show']):

            for ($this->_sections['combo']['index'] = $this->_sections['combo']['start'], $this->_sections['combo']['iteration'] = 1;
                 $this->_sections['combo']['iteration'] <= $this->_sections['combo']['total'];
                 $this->_sections['combo']['index'] += $this->_sections['combo']['step'], $this->_sections['combo']['iteration']++):
$this->_sections['combo']['rownum'] = $this->_sections['combo']['iteration'];
$this->_sections['combo']['index_prev'] = $this->_sections['combo']['index'] - $this->_sections['combo']['step'];
$this->_sections['combo']['index_next'] = $this->_sections['combo']['index'] + $this->_sections['combo']['step'];
$this->_sections['combo']['first']      = ($this->_sections['combo']['iteration'] == 1);
$this->_sections['combo']['last']       = ($this->_sections['combo']['iteration'] == $this->_sections['combo']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['fldlabel_combo'][$this->_sections['combo']['index']]; ?>
" <?php echo $this->_tpl_vars['fldlabel_sel'][$this->_sections['combo']['index']]; ?>
><?php echo $this->_tpl_vars['fldlabel'][$this->_sections['combo']['index']]; ?>
</option>
					<?php endfor; endif; ?>
				</select>
			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="parent_name" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">
				&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module="+ document.EditView.parent_type.value +"&action=Popup&html=Popup_picker&form=HelpDeskEditView","test","width=700,height=602,resizable=1,scrollbars=1,top=150,left=200");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.parent_id.value=''; document.EditView.parent_name.value=''; return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 357): ?>
			<td width="20%" class="dvtCellLabel" align=right>To:&nbsp;</td>
			<td width="90%" colspan="3">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">
				<textarea<?php echo $this->_tpl_vars['disable']; ?>
 readonly name="parent_name" cols="70" rows="2"><?php echo $this->_tpl_vars['fldvalue']; ?>
</textarea>&nbsp;
				<select<?php echo $this->_tpl_vars['disable']; ?>
 name="parent_type" class="small">
					<?php $_from = $this->_tpl_vars['fldlabel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['labelval'] => $this->_tpl_vars['selectval']):
?>
						<option value="<?php echo $this->_tpl_vars['labelval']; ?>
" <?php echo $this->_tpl_vars['selectval']; ?>
><?php echo $this->_tpl_vars['labelval']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				&nbsp;<img tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module="+ document.EditView.parent_type.value +"&action=Popup&html=Popup_picker&form=HelpDeskEditView","test","width=700,height=602,resizable=1,scrollbars=1,top=150,left=200");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.parent_id.value=''; document.EditView.parent_name.value=''; return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		   <tr style="height:25px">
			<td width="20%" class="dvtCellLabel" align=right>CC:&nbsp;</td>	
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="ccmail" type="text" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'"  value="">
			</td>
			<td width="20%" class="dvtCellLabel" align=right>BCC:&nbsp;</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="bccmail" type="text" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'"  value="">
			</td>
		   </tr>

		<?php elseif ($this->_tpl_vars['uitype'] == 59): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="product_name" readonly type="text" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
">&nbsp;<img tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Products&action=Popup&html=Popup_picker&form=HelpDeskEditView&popuptype=specific","test","width=700,height=602,resizable=1,scrollbars=1,top=150,left=200");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.product_id.value=''; document.EditView.product_name.value=''; return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 55): ?> 
			<td width="20%" class="dvtCellLabel" align=right><?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>
</td>
			<td width="30%" align=left class="dvtCellInfo">
				<select<?php echo $this->_tpl_vars['disable']; ?>
 name="salutationtype" class="small">
					<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['arr']):
?>
						<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['sel_value']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" value= "<?php echo $this->_tpl_vars['secondvalue']; ?>
">
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 22): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<textarea<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" cols="30" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" rows="2"><?php echo $this->_tpl_vars['fldvalue']; ?>
</textarea>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 69): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td colspan="3" width="30%" align=left class="dvtCellInfo">
				<?php if ($this->_tpl_vars['MODULE'] == 'Products'): ?>
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="del_file_list" type="hidden" value="">
					<div id="files_list" style="border: 1px solid grey; width: 500px; padding: 5px; background: rgb(255, 255, 255) none repeat scroll 0%; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-size: x-small">Files Maximum 6
						<input<?php echo $this->_tpl_vars['disable']; ?>
 id="my_file_element" type="file" name="file_1" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" >
						<?php $this->assign('image_count', 0); ?>
						<?php if ($this->_tpl_vars['maindata'][3]['0']['name'] != ''): ?>
						   <?php $_from = $this->_tpl_vars['maindata'][3]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['image_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['image_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['image_details']):
        $this->_foreach['image_loop']['iteration']++;
?>
							<div align="center">
								<img src="<?php echo $this->_tpl_vars['image_details']['path']; ?>
<?php echo $this->_tpl_vars['image_details']['encode_name']; ?>
" height="50">&nbsp;&nbsp;[<?php echo $this->_tpl_vars['image_details']['name']; ?>
]<input<?php echo $this->_tpl_vars['disable']; ?>
 id="file_<?php echo $this->_tpl_vars['num']; ?>
" value="Delete" type="button" class="crmbutton small delete" onclick='this.parentNode.parentNode.removeChild(this.parentNode);delRowEmt("<?php echo $this->_tpl_vars['image_details']['name']; ?>
")'>
							</div>
					   	   <?php $this->assign('image_count', $this->_foreach['image_loop']['iteration']); ?>
					   	   <?php endforeach; endif; unset($_from); ?>
						<?php endif; ?>
					</div>

					<script>
												var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 6 );
						multi_selector.count = <?php echo $this->_tpl_vars['image_count']; ?>

												multi_selector.addElement( document.getElementById( 'my_file_element' ) );
					</script>
				<?php else: ?>
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
"  type="file" value="<?php echo $this->_tpl_vars['maindata'][3]['0']['name']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" />
					<input<?php echo $this->_tpl_vars['disable']; ?>
 type="hidden" name="id" value=""/>
					<?php if ($this->_tpl_vars['maindata'][3]['0']['name'] != ""): ?>
						
				<div id="replaceimage">[<?php echo $this->_tpl_vars['maindata'][3]['0']['name']; ?>
] <a href="javascript:;" onClick="delimage(<?php echo $this->_tpl_vars['ID']; ?>
)">Del</a></div>
					<?php endif; ?>
					
				<?php endif; ?>
			</td>

		<?php elseif ($this->_tpl_vars['uitype'] == 61): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td colspan="3" width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
"  type="file" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" />
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="hidden" name="id" value=""/><?php echo $this->_tpl_vars['fldvalue']; ?>

			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 156): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
				<?php if ($this->_tpl_vars['fldvalue'] == 'on'): ?>
					<td width="30%" align=left class="dvtCellInfo">
						<?php if (( $this->_tpl_vars['secondvalue'] == 1 && $this->_tpl_vars['CURRENT_USERID'] != $_REQUEST['record'] ) || ( $this->_tpl_vars['MODE'] == 'create' )): ?>
							<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="checkbox" checked>
						<?php else: ?>
							<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="on">
							<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" disabled tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="checkbox" checked>
						<?php endif; ?>	
					</td>
				<?php else: ?>
					<td width="30%" align=left class="dvtCellInfo">
						<?php if (( $this->_tpl_vars['secondvalue'] == 1 && $this->_tpl_vars['CURRENT_USERID'] != $_REQUEST['record'] ) || ( $this->_tpl_vars['MODE'] == 'create' )): ?>
							<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="checkbox">
						<?php else: ?>
							<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" disabled tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" type="checkbox">
						<?php endif; ?>	
					</td>
				<?php endif; ?>
		<?php elseif ($this->_tpl_vars['uitype'] == 98): ?><!-- Role Selection Popup -->		
			<td width="20%" class="dvtCellLabel" align=right>
			        <?php echo $this->_tpl_vars['required']; ?>

				<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			<?php if ($this->_tpl_vars['thirdvalue'] == 1): ?>
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="role_name" id="role_name" readonly class="txtBox" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
" type="text">&nbsp;
				<a href="javascript:openPopup();"><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" align="absmiddle" border="0"></a>
			<?php else: ?>	
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="role_name" id="role_name" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="txtBox" readonly value="<?php echo $this->_tpl_vars['secondvalue']; ?>
" type="text">&nbsp;
			<?php endif; ?>	
			<input<?php echo $this->_tpl_vars['disable']; ?>
 name="user_role" id="user_role" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" type="hidden">
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 104): ?><!-- Mandatory Email Fields -->			
			 <td width=20% class="dvtCellLabel" align=right>
			 <?php echo $this->_tpl_vars['required']; ?>

			 <?php echo $this->_tpl_vars['fldlabel']; ?>

			 </td>
    	     <td width=30% align=left class="dvtCellInfo"><input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" id ="<?php echo $this->_tpl_vars['fldname']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'"></td>
			<?php elseif ($this->_tpl_vars['uitype'] == 115): ?><!-- for Status field Disabled for nonadmin -->
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			   <?php if ($this->_tpl_vars['secondvalue'] == 1): ?>
			   	<select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
			   <?php else: ?>
			   	<select<?php echo $this->_tpl_vars['disable']; ?>
 disabled name="<?php echo $this->_tpl_vars['fldname']; ?>
" class="small">
			   <?php endif; ?> 
				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['arr']):
?>
					<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['sel_value']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				<?php endforeach; endif; unset($_from); ?>
			   </select>
			</td>
			<?php elseif ($this->_tpl_vars['uitype'] == 105): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
					<input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
"  type="file" value="<?php echo $this->_tpl_vars['maindata'][3]['0']['name']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" />
					<input<?php echo $this->_tpl_vars['disable']; ?>
 type="hidden" name="id" value=""/>
					<?php echo $this->_tpl_vars['maindata'][3]['0']['name']; ?>

			</td>
			<?php elseif ($this->_tpl_vars['uitype'] == 103): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" colspan="3" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'">
			</td>	
			<?php elseif ($this->_tpl_vars['uitype'] == 101): ?><!-- for reportsto field USERS POPUP -->
				<td width="20%" class="dvtCellLabel" align=right>
			       <?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

	            </td>
				<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 readonly name='reports_to_name' class="small" type="text" value='<?php echo $this->_tpl_vars['fldvalue']; ?>
' tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" ><input<?php echo $this->_tpl_vars['disable']; ?>
 name='reports_to_id' type="hidden" value='<?php echo $this->_tpl_vars['secondvalue']; ?>
'>&nbsp;<input<?php echo $this->_tpl_vars['disable']; ?>
 title="Change [Alt+C]" accessKey="C" type="button" class="small" value='<?php echo $this->_tpl_vars['UMOD']['LBL_CHANGE']; ?>
' name=btn1 LANGUAGE=javascript onclick='return window.open("index.php?module=Users&action=Popup&form=UsersEditView&form_submit=false","test","width=640,height=522,resizable=0,scrollbars=0");'>
	            </td>
			<?php elseif ($this->_tpl_vars['uitype'] == 116): ?><!-- for currency in users details-->	
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
			   <?php if ($this->_tpl_vars['secondvalue'] == 1): ?>
			   	<select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
			   <?php else: ?>
			   	<select<?php echo $this->_tpl_vars['disable']; ?>
 disabled name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class="small">
			   <?php endif; ?> 

				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['uivalueid'] => $this->_tpl_vars['arr']):
?>
					<?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel_value'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['uivalueid']; ?>
" <?php echo $this->_tpl_vars['value']; ?>
><?php echo $this->_tpl_vars['sel_value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				<?php endforeach; endif; unset($_from); ?>
			   </select>
			</td>
			<?php elseif ($this->_tpl_vars['uitype'] == 106): ?>
			<td width=20% class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width=30% align=left class="dvtCellInfo">
				<?php if ($this->_tpl_vars['MODE'] == 'edit'): ?>
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" readonly name="<?php echo $this->_tpl_vars['fldname']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'">
				<?php else: ?>
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" name="<?php echo $this->_tpl_vars['fldname']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'">
				<?php endif; ?>
			</td>
			<?php elseif ($this->_tpl_vars['uitype'] == 99): ?>
				<?php if ($this->_tpl_vars['MODE'] == 'create'): ?>
				<td width=20% class="dvtCellLabel" align=right>
					<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

				</td>
				<td width=30% align=left class="dvtCellInfo">
					<input<?php echo $this->_tpl_vars['disable']; ?>
 type="password" name="<?php echo $this->_tpl_vars['fldname']; ?>
" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
" class=detailedViewTextBox onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'">
				</td>
				<?php endif; ?>
		<?php elseif ($this->_tpl_vars['uitype'] == 30): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td colspan="3" width="30%" align=left class="dvtCellInfo">
				<?php $this->assign('check', $this->_tpl_vars['secondvalue'][0]); ?>
				<?php $this->assign('yes_val', $this->_tpl_vars['secondvalue'][1]); ?>
				<?php $this->assign('no_val', $this->_tpl_vars['secondvalue'][2]); ?>

				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="radio" name="set_reminder" tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" value="Yes" <?php echo $this->_tpl_vars['check']; ?>
>&nbsp;<?php echo $this->_tpl_vars['yes_val']; ?>
&nbsp;
				<input<?php echo $this->_tpl_vars['disable']; ?>
 type="radio" name="set_reminder" value="No">&nbsp;<?php echo $this->_tpl_vars['no_val']; ?>
&nbsp;

				<?php $_from = $this->_tpl_vars['fldvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val_arr']):
?>
					<?php $this->assign('start', ($this->_tpl_vars['val_arr'][0])); ?>
					<?php $this->assign('end', ($this->_tpl_vars['val_arr'][1])); ?>
					<?php $this->assign('sendname', ($this->_tpl_vars['val_arr'][2])); ?>
					<?php $this->assign('disp_text', ($this->_tpl_vars['val_arr'][3])); ?>
					<?php $this->assign('sel_val', ($this->_tpl_vars['val_arr'][4])); ?>
					<select<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['sendname']; ?>
" class="small">
						<?php unset($this->_sections['reminder']);
$this->_sections['reminder']['name'] = 'reminder';
$this->_sections['reminder']['start'] = (int)$this->_tpl_vars['start'];
$this->_sections['reminder']['max'] = (int)$this->_tpl_vars['end'];
$this->_sections['reminder']['loop'] = is_array($_loop=$this->_tpl_vars['end']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['reminder']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['reminder']['show'] = true;
if ($this->_sections['reminder']['max'] < 0)
    $this->_sections['reminder']['max'] = $this->_sections['reminder']['loop'];
if ($this->_sections['reminder']['start'] < 0)
    $this->_sections['reminder']['start'] = max($this->_sections['reminder']['step'] > 0 ? 0 : -1, $this->_sections['reminder']['loop'] + $this->_sections['reminder']['start']);
else
    $this->_sections['reminder']['start'] = min($this->_sections['reminder']['start'], $this->_sections['reminder']['step'] > 0 ? $this->_sections['reminder']['loop'] : $this->_sections['reminder']['loop']-1);
if ($this->_sections['reminder']['show']) {
    $this->_sections['reminder']['total'] = min(ceil(($this->_sections['reminder']['step'] > 0 ? $this->_sections['reminder']['loop'] - $this->_sections['reminder']['start'] : $this->_sections['reminder']['start']+1)/abs($this->_sections['reminder']['step'])), $this->_sections['reminder']['max']);
    if ($this->_sections['reminder']['total'] == 0)
        $this->_sections['reminder']['show'] = false;
} else
    $this->_sections['reminder']['total'] = 0;
if ($this->_sections['reminder']['show']):

            for ($this->_sections['reminder']['index'] = $this->_sections['reminder']['start'], $this->_sections['reminder']['iteration'] = 1;
                 $this->_sections['reminder']['iteration'] <= $this->_sections['reminder']['total'];
                 $this->_sections['reminder']['index'] += $this->_sections['reminder']['step'], $this->_sections['reminder']['iteration']++):
$this->_sections['reminder']['rownum'] = $this->_sections['reminder']['iteration'];
$this->_sections['reminder']['index_prev'] = $this->_sections['reminder']['index'] - $this->_sections['reminder']['step'];
$this->_sections['reminder']['index_next'] = $this->_sections['reminder']['index'] + $this->_sections['reminder']['step'];
$this->_sections['reminder']['first']      = ($this->_sections['reminder']['iteration'] == 1);
$this->_sections['reminder']['last']       = ($this->_sections['reminder']['iteration'] == $this->_sections['reminder']['total']);
?>
							<?php if ($this->_sections['reminder']['index'] == $this->_tpl_vars['sel_val']): ?>
								<?php $this->assign('sel_value', 'SELECTED'); ?>
							<?php else: ?>
								<?php $this->assign('sel_value', ""); ?>
							<?php endif; ?>
							<OPTION VALUE="<?php echo $this->_sections['reminder']['index']; ?>
" "<?php echo $this->_tpl_vars['sel_value']; ?>
"><?php echo $this->_sections['reminder']['index']; ?>
</OPTION>
						<?php endfor; endif; ?>
					</select>
					&nbsp;<?php echo $this->_tpl_vars['disp_text']; ?>

				<?php endforeach; endif; unset($_from); ?>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 83): ?> <!-- Handle the Tax in Inventory -->
			<?php $_from = $this->_tpl_vars['TAX_DETAILS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['count'] => $this->_tpl_vars['tax']):
?>
				<?php if ($this->_tpl_vars['tax']['check_value'] == 1): ?>
					<?php $this->assign('check_value', 'checked'); ?>
					<?php $this->assign('show_value', 'visible'); ?>
				<?php else: ?>
					<?php $this->assign('check_value', ""); ?>
					<?php $this->assign('show_value', 'hidden'); ?>
				<?php endif; ?>
				<td align="right" class="dvtCellLabel" style="border:0px solid red;">
					<?php echo $this->_tpl_vars['tax']['taxlabel']; ?>
 <?php echo $this->_tpl_vars['APP']['COVERED_PERCENTAGE']; ?>

					<input<?php echo $this->_tpl_vars['disable']; ?>
 type="checkbox" name="<?php echo $this->_tpl_vars['tax']['check_name']; ?>
" id="<?php echo $this->_tpl_vars['tax']['check_name']; ?>
" class="small" onclick="fnshowHide(this,'<?php echo $this->_tpl_vars['tax']['taxname']; ?>
')" <?php echo $this->_tpl_vars['check_value']; ?>
>
				</td>
				<td class="dvtCellInfo" align="left" style="border:0px solid red;">
					<input<?php echo $this->_tpl_vars['disable']; ?>
 type="text" class="detailedViewTextBox" name="<?php echo $this->_tpl_vars['tax']['taxname']; ?>
" id="<?php echo $this->_tpl_vars['tax']['taxname']; ?>
" value="<?php echo $this->_tpl_vars['tax']['percentage']; ?>
" style="visibility:<?php echo $this->_tpl_vars['show_value']; ?>
;" onBlur="fntaxValidation('<?php echo $this->_tpl_vars['tax']['taxname']; ?>
')">
				</td>
			   </tr>
			<?php endforeach; endif; unset($_from); ?>

			<td colspan="2" class="dvtCellInfo">&nbsp;</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1006): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="catalogname" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Products&action=PopupForCatalog&parenttab=Product","test_catalog","width=660,height=420,resizable=0,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.catalogid.value=''; document.EditView.catalogname.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1009): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="vcontactname" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return openVContactPopup();' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.vcontactsid.value=''; document.EditView.vcontactname.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1012): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="projectname" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Projects&action=Popup","test_project","width=660,height=420,resizable=0,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.projectsid.value=''; document.EditView.projectname.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1013): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="faqcategoryname" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Faq&action=PopupForCategory&parenttab=Support","test_faqcategory","width=660,height=420,resizable=0,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.faqcategoryid.value=''; document.EditView.faqcategoryname.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		<?php elseif ($this->_tpl_vars['uitype'] == 1011): ?>
			<td width="20%" class="dvtCellLabel" align=right>
				<?php echo $this->_tpl_vars['required']; ?>
<?php echo $this->_tpl_vars['fldlabel']; ?>

			</td>
			<td width="30%" align=left class="dvtCellInfo">
				<input<?php echo $this->_tpl_vars['disable']; ?>
 name="projecttemplatename" readonly type="text" style="border:1px solid #bababa;" value="<?php echo $this->_tpl_vars['fldvalue']; ?>
"><input<?php echo $this->_tpl_vars['disable']; ?>
 name="<?php echo $this->_tpl_vars['fldname']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['secondvalue']; ?>
">&nbsp;<img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
select.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Projecttemplates&action=Popup","test_projecttemplate","width=660,height=420,resizable=0,scrollbars=1");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;<img<?php echo $this->_tpl_vars['disable']; ?>
  tabindex="<?php echo $this->_tpl_vars['vt_tab']; ?>
" src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
clear_field.gif" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onClick="document.EditView.projecttemplatesid.value=''; document.EditView.projecttemplatename.value='';return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
			</td>
		
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
   </tr>
<?php endforeach; endif; unset($_from); ?>