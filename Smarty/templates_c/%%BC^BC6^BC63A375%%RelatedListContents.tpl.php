<?php /* Smarty version 2.6.18, created on 2012-12-21 17:01:01
         compiled from RelatedListContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'RelatedListContents.tpl', 33, false),)), $this); ?>
<link href="include/ajaxtabs/ajaxtabs.css" type="text/css" rel="stylesheet"/>
<?php echo '
<style>
 .newtaba li a{
	padding-top:5px; 
	padding-bottom:5px; 
 }
 .newtaba li a.selected{
	padding-top:5px; 
	padding-bottom:5px; 
 }
</style>
'; ?>

<?php if ($this->_tpl_vars['SinglePane_View'] == 'true'): ?>
	<?php $this->assign('return_modname', 'DetailView'); ?>
<?php else: ?>
	<?php $this->assign('return_modname', 'CallRelatedList'); ?>
<?php endif; ?>

<?php if (count($this->_tpl_vars['RELATEDLISTS']) != 1): ?>
<ul id="countrytabs" class="shadetabs newtaba" style=" white-space:nowrap; border-bottom:1px solid #999999;padding-bottom:6px;">
<?php $_from = $this->_tpl_vars['RELATEDLISTS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['detail']):
        $this->_foreach['foo']['iteration']++;
?>
  <?php if (($this->_foreach['foo']['iteration']-1) == 0): ?>
   <li><a href="javascript:;" onClick="getTabViewForRelated('<?php echo $this->_tpl_vars['header']; ?>
');return false;" id="<?php echo $this->_tpl_vars['header']; ?>
" rel="#default" class="tablink selected">
   <input type="hidden" id="typeid" value="<?php echo $this->_tpl_vars['header']; ?>
"/>
  <?php else: ?>
   <li><a href="javascript:;" onClick="getTabViewForRelated('<?php echo $this->_tpl_vars['header']; ?>
');return false;" id="<?php echo $this->_tpl_vars['header']; ?>
" rel="#default" class="tablink">
  <?php endif; ?>

 <?php if ($this->_tpl_vars['APP'][$this->_tpl_vars['header']] != ''): ?>
    <?php if ($this->_tpl_vars['APP'][$this->_tpl_vars['header']] == '产品'): ?>
    <b>&nbsp;购买过的产品</b>
    <?php else: ?>
    <b>&nbsp;<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['header']]; ?>
</b>
    <?php endif; ?>
<?php else: ?> 
    <?php if ($this->_tpl_vars['header'] == '产品'): ?>
    <b>&nbsp;购买过的产品</b>
    <?php else: ?>
    <b>&nbsp;<?php echo $this->_tpl_vars['header']; ?>
</b>
    <?php endif; ?>
<?php endif; ?>
</li></a>
<?php if (($this->_foreach['foo']['iteration']-1) != 0 && ($this->_foreach['foo']['iteration']-1) % 9 == 0): ?>
</ul>
<ul id="countrytabs" class="shadetabs newtaba" style=" white-space:nowrap;border-bottom:1px solid #999999;padding-top:5px;padding-bottom:6px;">
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['RELATEDLISTS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['detail']):
        $this->_foreach['foo']['iteration']++;
?>
<?php if (($this->_foreach['foo']['iteration']-1) == 0): ?>
<div id="<?php echo $this->_tpl_vars['header']; ?>
1"  style="display:;">
<?php else: ?>
<div id="<?php echo $this->_tpl_vars['header']; ?>
1" style="display:none;">
<?php endif; ?>

<table border=0 cellspacing=0 cellpadding=0 width=100% class="small" style="border-bottom:1px solid #999999;padding:5px;">
        <tr >
                <td  valign=bottom >
                <!--
                <?php if ($this->_tpl_vars['APP'][$this->_tpl_vars['header']] != ''): ?>
                    <?php if ($this->_tpl_vars['APP'][$this->_tpl_vars['header']] == '产品'): ?>
                    <b>&nbsp;购买过的产品</b>
                    <?php else: ?>
                    <b>&nbsp;<?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['header']]; ?>
</b>
                    <?php endif; ?>
                <?php else: ?> 
                    <?php if ($this->_tpl_vars['header'] == '产品'): ?>
                    <b>&nbsp;购买过的产品</b>
                    <?php else: ?>
                    <b>&nbsp;<?php echo $this->_tpl_vars['header']; ?>
</b>
                    <?php endif; ?>
                <?php endif; ?>
                -->
                </td>
                
                <?php if ($this->_tpl_vars['detail'] != ''): ?>
                <td align=center><?php echo $this->_tpl_vars['detail']['navigation']['0']; ?>
</td>
                <?php echo $this->_tpl_vars['detail']['navigation']['1']; ?>

                <?php endif; ?>
                <td align=right>
			<?php if ($this->_tpl_vars['header'] == 'Potentials'): ?>
			        <?php if ($this->_tpl_vars['MODULE'] == 'Campaigns'): ?>
				<input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Potential']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Potentials&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button">
				<?php endif; ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Potential']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Potentials'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Potential']; ?>
">                               
                </td>
                        <?php elseif ($this->_tpl_vars['header'] == 'PriceBooks'): ?>
                                <?php if ($this->_tpl_vars['MODULE'] == 'Products'): ?> 
                                <input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_TO']; ?>
 <?php echo $this->_tpl_vars['APP']['PriceBook']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_TO']; ?>
 <?php echo $this->_tpl_vars['APP']['PriceBook']; ?>
" LANGUAGE=javascript onclick="this.form.action.value='AddProductToPriceBooks';this.form.module.value='Products'"  type="submit" name="button">
                                <?php endif; ?>
                        <?php elseif ($this->_tpl_vars['header'] == 'Products'): ?>
                                <?php if ($this->_tpl_vars['MODULE'] == 'PriceBooks'): ?>
	                                <input title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_PRODUCT_BUTTON_LABEL']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_PRODUCT_BUTTON_LABEL']; ?>
" LANGUAGE=javascript onclick="this.form.action.value='AddProductsToPriceBook';this.form.module.value='Products';this.form.return_module.value='Products';this.form.return_action.value='PriceBookDetailView'"  type="submit" name="button"></td>
				<?php elseif ($this->_tpl_vars['MODULE'] == 'Potentials'): ?>
					<input title="Change" accessKey="" class="crmbutton small save" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Products&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button">&nbsp;
				<?php elseif ($this->_tpl_vars['MODULE'] == 'Accounts'): ?>
					
                    <!-- <input title="Change" accessKey="" class="crmbutton small save" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Products&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=0,scrollbars=0");' type="button"  name="button">&nbsp; -->

				<?php elseif ($this->_tpl_vars['MODULE'] == 'Vendors'): ?>
					<input title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
" accessyKey="F" class="crmbutton small create" LANGUAGE=javascript onclick='return window.open("index.php?module=Products&return_module=Products&action=Popup&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&popuptype=detailview&form=DetailView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
">
					<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Products';this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
';this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'; this.form.parent_id.value='';" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
"></td>
                                <?php else: ?>
					<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Products';this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
';this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Product']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Leads'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Campaigns'): ?>
				<?php echo $this->_tpl_vars['LEADCVCOMBO']; ?>
 <span id="lead_list_button"><input title="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" type="button"  name="button"></span>
				<input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Lead']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Leads&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button">
				<?php endif; ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Lead']; ?>
" accessyKey="F" class="crmbutton small edit" onclick="this.form.action.value='EditView';this.form.module.value='Leads'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Lead']; ?>
"></td>
			<?php elseif ($this->_tpl_vars['header'] == 'Accounts'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Campaigns'): ?>
				<?php echo $this->_tpl_vars['ACCOUNTCVCOMBO']; ?>
 <span id="account_list_button"><input title="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" type="button"  name="button"></span>
				<input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Account']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Accounts&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button">
				<?php endif; ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Products'): ?>
				<input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Account']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Accounts&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button">
				<?php else: ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Account']; ?>
" accessyKey="F" class="crmbutton small edit" onclick="this.form.action.value='EditView';this.form.module.value='Accounts'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Account']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Contacts'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Calendar' || $this->_tpl_vars['MODULE'] == 'Potentials' || $this->_tpl_vars['MODULE'] == 'Vendors'): ?>
				<input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Contacts&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button"></td>
				<?php elseif ($this->_tpl_vars['MODULE'] == 'Campaigns'): ?>
				<?php echo $this->_tpl_vars['CONTCVCOMBO']; ?>
  <span id="contact_list_button"><input title="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" type="button"  name="button"></span>
				<input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Contacts&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button">
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Contacts'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
"></td>
				<?php else: ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Contacts'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Activities'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE'] == 'Invoice' || $this->_tpl_vars['MODULE'] == 'SalesOrder' || $this->_tpl_vars['MODULE'] == 'Quotes' || $this->_tpl_vars['MODULE'] == 'Campaigns'): ?>
				<input type="hidden" name="activity_mode">
				<!--
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Todo']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'; this.form.module.value='Calendar'; this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; this.form.activity_mode.value='Task'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Todo']; ?>
"></td>
				-->
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Event']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'; this.form.module.value='Calendar'; this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; this.form.activity_mode.value='Events'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Event']; ?>
"></td>
				<?php else: ?>
				<input type="hidden" name="activity_mode">
				<!--
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Todo']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'; this.form.module.value='Calendar'; this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; this.form.activity_mode.value='Task'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Todo']; ?>
">&nbsp;
				-->
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Event']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'; this.form.module.value='Calendar'; this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; this.form.activity_mode.value='Events'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Event']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'HelpDesk'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Ticket']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='HelpDesk'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Ticket']; ?>
"></td>
			<?php elseif ($this->_tpl_vars['header'] == 'Campaigns'): ?>
                                <input title="Change" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Campaign']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Campaigns&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=602,resizable=1,scrollbars=1");' type="button"  name="button"></td>
			<?php elseif ($this->_tpl_vars['header'] == 'Attachments'): ?>
             <?php if ($this->_tpl_vars['MODULE'] != 'Maillists'): ?>
				<input type="hidden" name="fileid">				
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_ATTACHMENT']; ?>
" accessyKey="F" class="crmbutton small create" onclick="window.open('upload.php?return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_id=<?php echo $this->_tpl_vars['ID']; ?>
','Attachments','width=500,height=300,resizable=1,scrollbars=1');" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_ATTACHMENT']; ?>
">
                <?php endif; ?>
				</td>
			<?php elseif ($this->_tpl_vars['header'] == 'Notes'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Note']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'; this.form.module.value='Notes'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Note']; ?>
">&nbsp;
				<input type="hidden" name="fileid">
				</td>
			<?php elseif ($this->_tpl_vars['header'] == 'Quotes'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Products'): ?>
				&nbsp;
				<?php else: ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Quote']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Quotes'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Quote']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Invoice'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'SalesOrder'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
" accessyKey="F" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Invoice&action=EditView&return_module=SalesOrder&return_action=DetailView&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&convertmode=sotoinvoice';" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
"></td>
				<?php elseif ($this->_tpl_vars['MODULE'] == 'Products'): ?>
				&nbsp;
				<?php else: ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Invoice'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Sales Order'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Quotes'): ?>
				<input type="hidden">
				<?php elseif ($this->_tpl_vars['MODULE'] == 'Products'): ?>
				&nbsp;
				<?php else: ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['SalesOrder']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='SalesOrder'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['SalesOrder']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Purchase Order'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Products'): ?>
				&nbsp;
				<?php else: ?>
                                <input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
" accessyKey="O" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.module.value='PurchaseOrder'; this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'PurchaseOrder'): ?>
			       <?php if ($this->_tpl_vars['MODULE'] == 'SalesOrder'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
" accessyKey="F" class="crmbutton small create" onclick="javascript:location.href='index.php?module=PurchaseOrder&action=EditView&return_module=SalesOrder&return_action=DetailView&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&convertmode=sotopurchaseorder';" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
"></td>
				<?php elseif ($this->_tpl_vars['MODULE'] == 'Products'): ?>
				&nbsp;
				<?php else: ?>
                                <input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
" accessyKey="O" class="crmbutton small create" onclick="this.form.action.value='EditView'; this.form.module.value='PurchaseOrder'; this.form.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; this.form.return_action.value='<?php echo $this->_tpl_vars['return_modname']; ?>
'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Deliverys'): ?>
			       <?php if ($this->_tpl_vars['MODULE'] == 'Invoice'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Deliverys']; ?>
" accessyKey="F" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Deliverys&action=EditView&return_module=Invoice&return_action=DetailView&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&convertmode=invoicetodelivery';" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Deliverys']; ?>
"></td>				
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Warehouses'): ?>
			       <?php if ($this->_tpl_vars['MODULE'] == 'PurchaseOrder'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Warehouses']; ?>
" accessyKey="F" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Warehouses&action=EditView&return_module=PurchaseOrder&return_action=DetailView&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&convertmode=potowarehouse';" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Warehouses']; ?>
"></td>				
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'Vcontacts'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Vcontact']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Vcontacts'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Vcontact']; ?>
"></td>
			<?php elseif ($this->_tpl_vars['header'] == 'Cares'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Cares']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Cares'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Cares']; ?>
"></td>
			<?php elseif ($this->_tpl_vars['header'] == 'Vnotes'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Vnotes']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Vnotes'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Vnotes']; ?>
"></td>
                        <?php elseif ($this->_tpl_vars['header'] == 'Emails'): ?>
                                <input type="hidden" name="email_directing_module">
                                <input type="hidden" name="record">
                                </td>
			<?php elseif ($this->_tpl_vars['header'] == 'Users'): ?>
                                <?php if ($this->_tpl_vars['MODULE'] == 'Calendar'): ?>
				<input title="Change" accessKey="" tabindex="2" type="button" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_USER_BUTTON_LABEL']; ?>
" name="button" LANGUAGE=javascript onclick='return window.open("index.php?module=Users&return_module=Calendar&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&activity_mode=Events&action=Popup&popuptype=detailview&form=EditView&form_submit=true&select=enable&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=525,resizable=1,scrollbars=1")';>
                          
                                <input title="Change" accesskey="" tabindex="2" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_USER_BUTTON_LABEL']; ?>
" name="Button" language="javascript" onclick='return window.open("index.php?module=Users&return_module=Emails&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=true&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=520,resizable=1,scrollbars=1");' type="button">&nbsp;</td>
                                <?php endif; ?>
			<?php elseif ($this->_tpl_vars['header'] == 'ModuleComments'): ?>
				<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['ModuleComments']; ?>
" accessyKey="F" class="crmbutton small create" onclick="window.open('addComments.php?return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&crmid=<?php echo $this->_tpl_vars['ID']; ?>
','Comments','width=500,height=300');" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['ModuleComments']; ?>
"></td>
            <?php elseif ($this->_tpl_vars['header'] == 'Memdays'): ?>
            	<?php if ($this->_tpl_vars['MODULE'] == 'Accounts'): ?>
                	<input type="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Memdays']; ?>
" class="crmbutton small create"
					onclick="location.href='index.php?module=<?php echo $this->_tpl_vars['header']; ?>
&action=EditView&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=DetailView&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&convertmode=invoicetodelivery';"/>
                <?php endif; ?>
            <?php elseif ($this->_tpl_vars['header'] == 'Activity History'): ?>
            	&nbsp;</td>
            <?php endif; ?>
        </tr>
</table>
<?php if ($this->_tpl_vars['detail'] != ''): ?>
	<?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['detail']):
?>
		<?php if ($this->_tpl_vars['header'] == 'header'): ?>
			<table border=0 cellspacing=1 cellpadding=3 width=100% style="background-color:#eaeaea;" class="small">
				<tr style="height:25px;background:#DFEBEF" >
				<?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['headerfields']):
?>
					<td class="lvtCol"><?php echo $this->_tpl_vars['headerfields']; ?>
</td>
				<?php endforeach; endif; unset($_from); ?>
                                </tr>
		<?php elseif ($this->_tpl_vars['header'] == 'entries'): ?>
			<?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['detail']):
?>
				<tr bgcolor=white>
				<?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['listfields']):
?>
	                                 <td><?php echo $this->_tpl_vars['listfields']; ?>
</td>
				<?php endforeach; endif; unset($_from); ?>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</table>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
	<table style="background-color:#eaeaea;color:eeeeee" border="0" cellpadding="3" cellspacing="1" width="100%" class="small">
		<tr style="height: 25px;" bgcolor="white">
			<td><i><?php echo $this->_tpl_vars['APP']['LBL_NONE_INCLUDED']; ?>
</i></td>
		</tr>
	</table>
<?php endif; ?>
<br><br>
</div>
<?php endforeach; endif; unset($_from); ?>