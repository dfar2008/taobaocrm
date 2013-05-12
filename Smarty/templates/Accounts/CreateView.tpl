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

{*<!-- module header -->*}
<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
{literal}
<style type="text/css">
div.autocomplete {
  position:absolute;
  width:250px;
  background-color:white;
  border:1px solid #888;
  margin:0px;
  padding:0px;
}
div.autocomplete ul {
  list-style-type:none;
  margin:0px;
  padding:0px;
}
div.autocomplete ul li.selected { background-color: #ffb;}
div.autocomplete ul li {
  list-style-type:none;
  display:block;
  margin:0;
  padding:2px;
  height:20px;
  cursor:pointer;
}

</style>
<script language="javascript">
function init()
{
    //afterUpdateElement: function(element) {element.value+=",";},
    new Ajax.Autocompleter("accountname","choices","index.php?module=Home&action=PopupSuggestAccount",{
    afterUpdateElement: function(element) {;},
    tokens: ',',
    indicator: 'status',
    paramName: "account"
    });
}
</script>
{/literal}


		{include file='Buttons_List_create.tpl'}

{*<!-- Contents -->*}
<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
   <tr>

	<td  valign=top width=100%>
	     {*<!-- PUBLIC CONTENTS STARTS-->*}
	  <div class="small" style="padding:0px">
		<form name="EditView" method="POST" action="index.php">
		<input type="hidden" name="module" value="{$MODULE}">
		<input type="hidden" name="record" value="{$ID}">
		<input type="hidden" name="mode" value="{$MODE}">
		<input type="hidden" name="action">
		<input type="hidden" name="parenttab" value="{$CATEGORY}">
		<input type="hidden" name="return_module" value="{$RETURN_MODULE}">
		<input type="hidden" name="return_id" value="{$RETURN_ID}">
		<input type="hidden" name="return_action" value="{$RETURN_ACTION}">
		<input type="hidden" name="return_viewname" value="{$RETURN_VIEWNAME}">

		{*<!-- Account details tabs -->*}
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
			<td valign=top align=center >

			    <!-- Basic Information Tab Opened -->
			    <div id="basicTab">

				<table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
				   <tr>
					<td align=left>
					<!-- content cache -->
					
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						   <tr>
							<td id ="autocom"></td>
						   </tr>
						   <tr>
							<td style="padding-left:10px;padding-right:10px">
							<!-- General details -->
								<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
								    <tr>
									<td  colspan=4 style="padding:5px">
									   <div align="center">
										
                                                                		<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';check_duplicate()" type="button" name="savebutton" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >&nbsp;&nbsp;&nbsp;&nbsp;
                                                                		<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " style="width:70px">
									   </div>
									</td>
								   </tr>

								   {foreach key=header item=data from=$BASBLOCKS}
                                   <tr><td colspan=4 style="height:10px;"></td></tr>
								   <tr>
						         		<td colspan=4 class="detailedViewHeader">
                                           <b>{$header}</b>
							 		    </td>
		                           </tr>

								   <!-- Here we should include the uitype handlings-->
								   {include file="DisplayFields.tpl"}
								   {/foreach}

								   <tr>
									<td  colspan=4 style="padding:5px">
									   <div align="center">
										
                                                                		<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';check_duplicate()" type="button" name="savebutton" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >&nbsp;&nbsp;&nbsp;&nbsp;
                                                                		<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " style="width:70px">
									   </div>
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
			    <!-- Basic Information Tab Closed -->
			</td>
		   </tr>
		</table>
	     </div>
	</td>
   </tr>
</table>
</form>
{if $MODULE eq 'Accounts'}
<script>
	ScrollEffect.limit = 201;
	ScrollEffect.closelimit= 200;
</script>
{/if}
<script>



        var fieldname = new Array({$VALIDATION_DATA_FIELDNAME})

        var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL})

        var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE})
	if(getObj("customernum") != undefined && getObj("customernum").value == "") {ldelim}
	        getObj("customernum").value = "{$APP.AUTO_GEN_CODE}";
		//getObj("customernum").setAttribute("readOnly","true");
	{rdelim}
	init();//auto completer

</script>



