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
{if $smarty.request.ajax neq ''}
&#&#&#{$ERROR}&#&#&#
{/if}
				<!-- List View Master Holder starts -->
				<table border=0 cellspacing=1 cellpadding=0 width=100% class="lvtBg">
                
<form name="massdelete" method="POST" action="index.php">
     <input name='search_url' id="search_url" type='hidden' value='{$SEARCH_URL}'>
     <input name="idlist" id="idlist" type="hidden">
     <input name="action" id="action" type="hidden">
     <input name="module" id="module" type="hidden">
     <input id="viewname" name="viewname" type="hidden" value="{$VIEWID}">
     <input name="change_owner" type="hidden">
     <input name="change_status" type="hidden">
     <input name="allids" type="hidden" value="{$ALLIDS}">

                <tbody>
				<tr>
				<td>
				<!-- List View's Buttons and Filters starts -->
		        <table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
			    <tr>
				<!-- Buttons -->
				<td style="padding-right:20px" align="left" nowrap>
				 <input class="crmbutton small delete" type="button" value=" {$APP.LBL_DELETE_BUTTON} " onclick="return massDelete('{$MODULE}')"/>
                </td>
				<td nowrap width="100%" align="right" valign="middle">
					<table border=0 cellspacing=0 cellpadding=0 class="small">
					     <tr><td style="padding-right:5px">{$RECORD_COUNTS}&nbsp;&nbsp;&nbsp;&nbsp;{$NAVIGATION}</td></tr>
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
				 {foreach name="listviewforeach" item=header from=$LISTHEADER}
 			<td class="lvtCol">{$header}</td>
				{/foreach}
			</tr>
			<!-- Table Contents -->
			{foreach item=entity key=entity_id from=$LISTENTITY}
			<tr bgcolor=white class="lvtColData changehand" id="row_{$entity_id}">
			<td width="2%"><input type="checkbox" NAME="selected_id" value= '{$entity_id}' onClick=toggleSelectAll(this.name,"selectall")></td>
			{foreach item=data from=$entity}	
			<td onClick="getTabViewNew('{$entity_id}',this);" >{$data}</td>
	        {/foreach}
			</tr>
			{foreachelse}
			<tr><td style="background-color:#efefef;height:340px" align="center" colspan="{$smarty.foreach.listviewforeach.iteration+1}">
			<div style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 45%; position: relative; z-index: 10000000;">
				{assign var=vowel_conf value='LBL_A'}
				{if $MODULE eq 'Accounts' || $MODULE eq 'Invoice'}
				{assign var=vowel_conf value='LBL_AN'}
				{/if}
				{assign var=MODULE_CREATE value=$SINGLE_MOD}
				{if $MODULE eq 'HelpDesk'}
				{assign var=MODULE_CREATE value='Ticket'}
				{/if}

				{if $CHECK.Create eq 'yes' && $MODULE neq 'Emails' && $MODULE neq 'Webmails'}
							
				<table border="0" cellpadding="5" cellspacing="0" width="98%">
				<tr>
					<td rowspan="2" width="25%"><img src="{$IMAGE_PATH}empty.jpg" height="60" width="61"></td>
					<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
					{if $MODULE_CREATE eq 'SalesOrder' || $MODULE_CREATE eq 'PurchaseOrder' || $MODULE_CREATE eq 'Invoice' || $MODULE_CREATE eq 'Quotes'}
						{$APP.$MODULE_CREATE}&nbsp;{$APP.LBL_FOUND}!
					{else}
						{$APP.$MODULE_CREATE}&nbsp;{$APP.LBL_FOUND}!
					{/if}
					</span></td>
				</tr>
				<tr>
					<td class="small" nowrap="nowrap">
					{if $MODULE neq 'Calendar'}	
		  			<a href="index.php?module={$MODULE}&action=EditView&return_action=DetailView&parenttab={$CATEGORY}">
					{if $MODULE_CREATE eq 'SalesOrder' || $MODULE_CREATE eq 'PurchaseOrder' || $MODULE_CREATE eq 'Invoice' || $MODULE_CREATE eq 'Quotes'}
					       {$APP.LBL_CREATE}&nbsp;{$MOD.$MODULE_CREATE}
					{else}
					       {$APP.LBL_CREATE}&nbsp;{$APP.$MODULE_CREATE}
					{/if}
					</a><br>
					{else}
					<a href="index.php?module={$MODULE}&amp;action=EditView&amp;return_module=Calendar&amp;activity_mode=Events&amp;return_action=DetailView&amp;parenttab={$CATEGORY}">{$APP.LBL_CREATE}{$APP.Event}</a><br>
					
					{/if}
					</td>
				</tr>
				</table> 
					{else}
				<table border="0" cellpadding="5" cellspacing="0" width="98%">
				<tr>
				<td rowspan="2" width="25%"><img src="{$IMAGE_PATH}empty.jpg"></td>
				<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
				{if $MODULE_CREATE eq 'SalesOrder' || $MODULE_CREATE eq 'PurchaseOrder' || $MODULE_CREATE eq 'Invoice' || $MODULE_CREATE eq 'Quotes'}
					{$APP.$MODULE_CREATE}&nbsp;{$APP.LBL_FOUND}!</span></td>
				{else}
					{$APP.$MODULE_CREATE}&nbsp;{$APP.LBL_FOUND}!</span></td>
				{/if}
				</tr>
				
				</table>
				{/if}
				</div>					
				</td></tr>	
			     {/foreach}
			 </table>
			 </div>
			 
			
		       </td>
		   </tr>
           </tbody>
              </form>	
	    </table>


<div id="basicsearchcolumns" style="display:none;"><select name="search_field" id="bas_searchfield" class="txtBox" style="width:150px">{html_options  options=$SEARCHLISTHEADER}</select></div>
