{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/menu.js"></script>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
	{if $MESSAGECONFIG_MODE neq 'edit'}	
	<form action="index.php" method="post" name="MessageServer" id="form">
	<input type="hidden" name="messageconfig_mode">
	{else}
	<form action="index.php" method="post" name="MessageServer" id="form" onsubmit="return validate(MessageServer);">
	<input type="hidden" name="server_type" value="message">
	{/if}
	<input type="hidden" name="module" value="Relsettings">
	<input type="hidden" name="action">
	<input type="hidden" name="parenttab" value="Settings">
	<input type="hidden" name="return_module" value="Relsettings">
	<input type="hidden" name="return_action" value="MessageConfig">
	<div align=center>
			

				<!-- DISPLAY -->
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="settingsSelUITopLine">
				<tr>
					<td width=50 rowspan=2 valign=top><img src="{$IMAGE_PATH}ico_mobile.gif" alt="Users" width="48" height="48" border=0 title="Users"></td>
					<td class=heading2 valign=bottom><b><a href="index.php?module=Relsettings&action=index&parenttab=Settings">{$MOD.LBL_RELSETTINGS}</a> > {$MOD.LBL_MESSAGE_SERVER_SETTINGS} </b></td>
				</tr>
				<tr>
					<td valign=top class="small">{$MOD.LBL_MESSAGE_SERVER_DESCRIPTION} </td>
				</tr>
				</table>
				
				<br>
				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
				
					<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
					<tr>
						<td class="big"><strong>{$MOD.LBL_MESSAGE_SERVER_SETTINGS}</strong>&nbsp;<br>{$ERROR_MSG}</td>
						{if $MESSAGECONFIG_MODE neq 'edit'}	
						<td class="small" align=right>
							<input class="crmButton small edit" title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" onclick="this.form.action.value='MessageConfig';this.form.messageconfig_mode.value='edit'" type="submit" name="Edit" value="{$APP.LBL_EDIT_BUTTON_LABEL}">
						</td>
						{else}
						<td class="small" align=right>
							<input title="{$APP.LBL_SAVE_BUTTON_LABEL}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmButton small save" onclick="this.form.action.value='SaveMessage';" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}" >&nbsp;&nbsp;
    							<input title="{$APP.LBL_CANCEL_BUTTON_LABEL}>" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmButton small cancel" onclick="window.history.back()" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
						</td>
						{/if}
					</tr>
					</table>
					
					{if $MESSAGECONFIG_MODE neq 'edit'}	
						<table border=0 cellspacing=0 cellpadding=0 width=100% class="listRow">
						<tr>
						<td class="small" valign=top ><table width="100%"  border="0" cellspacing="0" cellpadding="5">
						  <tr valign="top">
						    <td width="20%" nowrap class="cellLabel"><strong>{$MOD.LBL_SMSUSERNAME}</strong></td>
						    <td width="80%" class="cellText">{$USERNAME}&nbsp;</td>
						  </tr>
						  <tr>
						    <td width="20%" nowrap class="cellLabel"><strong>{$MOD.LBL_PASWRD}</strong></td>
						    <td width="80%" class="cellText">
							{if $PASSWORD neq ''}
							******
							{/if}&nbsp;
						     </td>
						  </tr>	
						  <tr>
						    <td width="20%" nowrap class="cellLabel"><strong>{$MOD.LBL_SMS_MONEY}</strong></td>
						    <td width="80%" class="cellText">
							{$SMS_MONEY}&nbsp;
						    </td>
						  </tr>	
						</table>
				        {else}					
						<table border=0 cellspacing=0 cellpadding=0 width=100% class="listRow">
						<tr>
						<td class="small" valign=top ><table width="100%"  border="0" cellspacing="0" cellpadding="5">
						  <tr valign="top">
						    <td width="20%" nowrap class="cellLabel"><strong>{$MOD.LBL_SMSUSERNAME}</strong></td>
						    <td width="80%" class="cellText">
							<input type="text" class="detailedViewTextBox small" value="{$USERNAME}" name="username">
						    </td>
						  </tr>
						  <tr>
						    <td width="20%" nowrap class="cellLabel"><strong>{$MOD.LBL_PASWRD}</strong></td>
						    <td width="80%" class="cellText">
							<input type="password" class="detailedViewTextBox small" value="{$PASSWORD}" name="password">
						    </td>
						  </tr>
						  
						</table>				
			                {/if}
						
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
{literal}
<script>
function validate(form)
{
	if(form.username.value =='')
	{
		alert("用户名不能为空");
		return false;
	}
	return true;
}
</script>
{/literal}
