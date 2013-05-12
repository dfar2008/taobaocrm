<?php /* Smarty version 2.6.18, created on 2012-12-21 10:59:26
         compiled from Relsettings/EmailConfig.tpl */ ?>
<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/menu.js"></script>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
	<?php if ($this->_tpl_vars['EMAILCONFIG_MODE'] != 'edit'): ?>	
	<form action="index.php" method="post" name="MailServer" id="form">
	<input type="hidden" name="emailconfig_mode">
	<?php else: ?>
	<form action="index.php" method="post" name="MailServer" id="form" onsubmit="return validate_mail_server(MailServer);">
	<input type="hidden" name="server_type" value="email">
	<?php endif; ?>
	<input type="hidden" name="module" value="Relsettings">
	<input type="hidden" name="action">
	<input type="hidden" name="parenttab" value="Settings">
	<input type="hidden" name="return_module" value="Relsettings">
	<input type="hidden" name="return_action" value="EmailConfig">
	<div align=center>
			

				<!-- DISPLAY -->
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="settingsSelUITopLine">
				<tr>
					<td width=50 rowspan=2 valign=top><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
ogmailserver.gif" alt="Users" width="48" height="48" border=0 title="Users"></td>
					<td class=heading2 valign=bottom><b><a href="index.php?module=Relsettings&action=index&parenttab=Settings"><?php echo $this->_tpl_vars['MOD']['LBL_RELSETTINGS']; ?>
</a> > <?php echo $this->_tpl_vars['MOD']['LBL_MAIL_SERVER_SETTINGS']; ?>
 </b></td>
				</tr>
				<tr>
					<td valign=top class="small"><?php echo $this->_tpl_vars['MOD']['LBL_MAIL_SERVER_DESC']; ?>
 </td>
				</tr>
				</table>
				
				<br>
				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
				
					<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
					<tr>
						<td class="big"><strong><?php echo $this->_tpl_vars['MOD']['LBL_MAIL_SERVER_SMTP']; ?>
</strong>&nbsp;<br><?php echo $this->_tpl_vars['ERROR_MSG']; ?>
</td>
						<?php if ($this->_tpl_vars['EMAILCONFIG_MODE'] != 'edit'): ?>	
						<td class="small" align=right>
							<input class="crmButton small edit" title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" onclick="this.form.action.value='EmailConfig';this.form.emailconfig_mode.value='edit'" type="submit" name="Edit" value="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
">
						</td>
						<?php else: ?>
						<td class="small" align=right>
							<input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="crmButton small save" onclick="this.form.action.value='Save';" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" >&nbsp;&nbsp;
    							<input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
>" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="crmButton small cancel" onclick="window.history.back()" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
">
						</td>
						<?php endif; ?>
					</tr>
					</table>
					
					<?php if ($this->_tpl_vars['EMAILCONFIG_MODE'] != 'edit'): ?>	
					<table border=0 cellspacing=0 cellpadding=0 width=100% class="listRow">
					<tr>
					<td class="small" valign=top ><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                          <tr>
                            <td width="20%" nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_OUTGOING_MAIL_SERVER']; ?>
</strong></td>
                            <td width="80%" class="small cellText"><strong><?php echo $this->_tpl_vars['MAILSERVER']; ?>
&nbsp;</strong></td>
                          </tr>
			   <tr>
                            <td width="20%" nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_OUTGOING_MAIL_SERVER_PORT']; ?>
</strong></td>
                            <td width="80%" class="small cellText"><strong><?php echo $this->_tpl_vars['MAILSERVER_PORT']; ?>
&nbsp;</strong></td>
                          </tr>
                          <tr valign="top">
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_USERNAME']; ?>
</strong></td>
                            <td class="small cellText"><?php echo $this->_tpl_vars['USERNAME']; ?>
&nbsp;</td>
                          </tr>
                          <tr>
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_PASWRD']; ?>
</strong></td>
                            <td class="small cellText">
				<?php if ($this->_tpl_vars['PASSWORD'] != ''): ?>
				******
				<?php endif; ?>&nbsp;
			     </td>
                          </tr>
                          <tr> 
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_REQUIRES_AUTHENT']; ?>
</strong></td>
                            <td class="small cellText">
				<?php if ($this->_tpl_vars['SMTP_AUTH'] == 'checked'): ?>
					<?php echo $this->_tpl_vars['MOD']['LBL_YES']; ?>

				<?php else: ?>
					<?php echo $this->_tpl_vars['MOD']['LBL_NO']; ?>

				<?php endif; ?>
			    </td>
                          </tr>
                          <tr valign="top">
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_MAILSENDPERSON']; ?>
</strong></td>
                            <td class="small cellText"><?php echo $this->_tpl_vars['FROMNAME']; ?>
&nbsp;</td>
                          </tr>
                            <tr valign="top">
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_MAILSENDMAIL']; ?>
</strong></td>
                            <td class="small cellText"><?php echo $this->_tpl_vars['FROMEMAIL']; ?>
&nbsp;</td>
                          </tr>
                        </table>
			  <?php else: ?>
					
			<table border=0 cellspacing=0 cellpadding=0 width=100% class="listRow">
			<tr>
			<td class="small" valign=top ><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td width="20%" nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_OUTGOING_MAIL_SERVER']; ?>
</strong></td>
                            <td width="80%" class="small cellText">
				<input type="text" class="detailedViewTextBox small" value="<?php echo $this->_tpl_vars['MAILSERVER']; ?>
" name="server">
			    </td>
                          </tr>
			  <tr>
                            <td width="20%" nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_OUTGOING_MAIL_SERVER_PORT']; ?>
</strong></td>
                            <td width="80%" class="small cellText">
				<input type="text" class="detailedViewTextBox small" value="<?php echo $this->_tpl_vars['MAILSERVER_PORT']; ?>
" name="port">
			    </td>
                          </tr>
                          <tr valign="top">
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_USERNAME']; ?>
</strong></td>
                            <td class="small cellText">
				<input type="text" class="detailedViewTextBox small" value="<?php echo $this->_tpl_vars['USERNAME']; ?>
" name="server_username">
			    </td>
                          </tr>
                          <tr>
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_PASWRD']; ?>
</strong></td>
                            <td class="small cellText">
				<input type="password" class="detailedViewTextBox small" value="<?php echo $this->_tpl_vars['PASSWORD']; ?>
" name="server_password">
			    </td>
                          </tr>
                          <tr> 
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_REQUIRES_AUTHENT']; ?>
</strong></td>
                            <td class="small cellText">
                              	<input type="checkbox" name="smtp_auth" <?php echo $this->_tpl_vars['SMTP_AUTH']; ?>
/>
			    </td>
                          </tr>
                          <tr>
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_MAILSENDPERSON']; ?>
</strong></td>
                            <td class="small cellText">
				<input type="text" class="detailedViewTextBox small" value="<?php echo $this->_tpl_vars['FROMNAME']; ?>
" name="from_name">
			    </td>
                          </tr>
                          <tr>
                            <td nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_MAILSENDMAIL']; ?>
</strong></td>
                            <td class="small cellText">
				<input type="text" class="detailedViewTextBox small" value="<?php echo $this->_tpl_vars['FROMEMAIL']; ?>
" name="from_email">
			    </td>
                          </tr>
                        </table>
				
			<?php endif; ?>
						
						</td>
					  </tr>
					</table>
					
				</td>
				</tr>
				</table>
			
			
			
			</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
		
	</div>
	</form>
	
</td>
   </tr>
</tbody>
</table>
<?php echo '
<script>
function validate_mail_server(form)
{
	if(form.server.value ==\'\')
	{
		alert("服务器名称不能为空")
		return false;
	}
	if(form.server_username.value !=\'\')
	{
		return patternValidate("server_username","Email","Email");
	}
	
	return true;
}
</script>
'; ?>
