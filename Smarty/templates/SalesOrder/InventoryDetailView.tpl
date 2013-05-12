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
<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
<script type="text/javascript" src="include/js/dtlviewajax.js"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<div id="creategathersdiv" style="display:block;position:absolute;left:225px;top:150px;"></div>
<script>
{literal}
function callCreateGathersDiv(id)
{
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody: 'module=SalesOrder&action=SalesOrderAjax&file=CreateGathers&record='+id,
			onComplete: function(response) {
				$("creategathersdiv").innerHTML=response.responseText;
				eval($("addDefaultPlan").innerHTML);
				Drag.init(document.getElementById("gather_div_title"), document.getElementById("orgLay"));
			}
		}
	);
}
{/literal}
</script>
<div id="createapprove_div" style="display:block;position:absolute;left:225px;top:150px;"></div>
<div id="createapprovehistory_div" class="layerPopup" style="display:none;position:absolute;left:425px;top:150px;cursor:move;"></div>
<div id="createapprovestep_div" class="layerPopup" style="display:none;position:absolute;left:425px;top:150px;cursor:move;"></div>
<span id="crmspanid" style="display:none;position:absolute;"  onmouseover="fnshow('crmspanid');"  onmouseout="fnhide('crmspanid');">
   <a class="link"  align="right" href="javascript:;">{$APP.LBL_EDIT_BUTTON}</a>
</span>
<script>
function tagvalidate()
{ldelim}
	if(document.getElementById('txtbox_tagfields').value != '')
		SaveTagI('txtbox_tagfields','{$ID}','{$MODULE}');	
	else
	{ldelim}
		alert(alert_arr.INPUT_TAG);
		return false;
	{rdelim}
{rdelim}
function SaveTagI(txtBox,crmId,module)
{ldelim}
	var tagValue = document.getElementById(txtBox).value;
	document.getElementById(txtBox).value ='';
	$("vtbusy_info").style.display="inline";
	new Ajax.Request(
		'index.php',
                {ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
                        method: 'post',
                        postBody: "file=TagCloud&module=" + module + "&action=" + module + "Ajax&recordid=" + crmId + "&ajxaction=SAVETAG&tagfields=" +tagValue,
                        onComplete: function(response) {ldelim}
					$("tagfields").innerHTML=response.responseText;
					$("vtbusy_info").style.display="none";
                        {rdelim}
                {rdelim}
        );
    
{rdelim}
function DeleteTag(id)
{ldelim}
	$("vtbusy_info").style.display="inline";
	Effect.Fade('tag_'+id);
	new Ajax.Request(
		'index.php',
                {ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
                        method: 'post',
                        postBody: "file=TagCloud&module={$MODULE}&action={$MODULE}Ajax&ajxaction=DELETETAG&tagid=" +id,
                        onComplete: function(response) {ldelim}
						getTagCloud();
						$("vtbusy_info").style.display="none";
                        {rdelim}
                {rdelim}
        );
{rdelim}

</script>
<table width="100%" cellpadding="2" cellspacing="0" border="0">
   <tr>
	<td>
		{include file='Buttons_List_details.tpl'}

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
					{include file='DetailViewHidden.tpl'}
<table border=0 cellspacing=0 cellpadding=0 width=100%>
   {strip}
   <tr>
	<td  colspan=4 style="padding:5px">
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
                   <tr>
                        <td>
				{if $EDIT eq 'permitted'}
				<input {$ORDER_STATUS} title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="crmbutton small edit" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$ID}';this.form.module.value='{$MODULE}';this.form.action.value='EditView'" type="submit" name="Edit" value="{$APP.LBL_EDIT_BUTTON_LABEL}">&nbsp;
				{/if}
				
				
				<input title="{$APP.LBL_LIST_BUTTON_TITLE}" class="crmbutton small edit" onclick="document.location.href='index.php?module={$MODULE}&action=index&parenttab={$CATEGORY}'" type="button" name="ListView" value="&nbsp;{$APP.LBL_LIST_BUTTON_LABEL}&nbsp;">&nbsp;
			</td>
			<td align=right>
				{if $EDIT_DUPLICATE eq 'permitted'}
				<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="crmbutton small create" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value='true';this.form.module.value='{$MODULE}'; this.form.action.value='EditView'" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}">&nbsp;
				{/if}
				{if ($DELETE eq 'permitted' && $APPROVE_STATUS neq '1') || $IS_ADMIN eq 'true'}
				<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="crmbutton small delete" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='index'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}')" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}">&nbsp;
				{/if}
			</td>
                   </tr>
                </table>
	</td>
   </tr>
   {/strip}
</table>
<!-- Button displayed - finished-->

<!-- Entity information(blocks) display - start -->
{foreach key=header item=detail name=listviewforeach  from=$BLOCKS}
	<table border=0 cellspacing=0 cellpadding=0 width=100% class="small" style="padding-bottom:10px;">
	   <tr>
		<td width="20%" height="1"></td><td height="1" width="30%"></td>
		<td width="20%" height="1"></td><td height="1" width="30%"></td>
	   </tr>
	   <tr>
		{strip}
		<td colspan=4 class="dvInnerHeader" >
			 {if $smarty.foreach.listviewforeach.iteration > 1}
               <a href="###" onclick="ToggleGroupContent('Gsub{$smarty.foreach.listviewforeach.iteration}','Gimg{$smarty.foreach.listviewforeach.iteration}')">
                <img id="Gimg{$smarty.foreach.listviewforeach.iteration}" border="0" src="themes/images/expand.gif">
                <b>
                  {$header}
                </b>
                </a>
           {else}
            <b>
              {$header}
            </b>
           {/if}
		</td>
		{/strip}
	   </tr>
     <tr>
         {if $smarty.foreach.listviewforeach.iteration > 1}
             <tr>
             <td colspan=4>
            <div id="Gsub{$smarty.foreach.listviewforeach.iteration}" style="display:none;">
            <table  border=0 cellspacing=0 cellpadding=0 width=100% class="small">
        {else}
             <tr>
             <td colspan=4>
            <table  border=0 cellspacing=0 cellpadding=0 width=100% class="small">
        {/if} 
        {foreach item=detail from=$detail}
	     <tr style="height:25px">
		{foreach key=label item=data from=$detail}
		   {assign var=keyid value=$data.ui}
		   {assign var=keyval value=$data.value}
		   {assign var=keyseclink value=$data.link}
		   {if $label ne ''}
		    <td class="dvtCellLabel" align=right width="25%">{$label}</td>								
		    {include file="DetailViewFields.tpl"}
		   {/if}
		{/foreach}
	      </tr>	
	   {/foreach}
       {if $smarty.foreach.listviewforeach.iteration > 1}
           </table>
         </div>	
         </td>
       </tr>
      {else}
       </table>
         </td>
       </tr>
      {/if}
	</table>
{/foreach}
{*-- End of Blocks--*} 
<!-- Entity information(blocks) display - ends -->

									<br>

										<!-- Product Details informations -->
										{$ASSOCIATED_PRODUCTS}

									</td>
<!-- The following table is used to display the buttons -->
								<table border=0 cellspacing=0 cellpadding=0 width=100%>
			                			   <tr>
									<td style="padding:10px;" width="80%">
			{if $SinglePane_View eq 'false'}
<table border=0 cellspacing=0 cellpadding=0 width=100%>
   {strip}
   <tr>
	<td  colspan=4 style="padding:5px">
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
                   <tr>
                        <td>
				{if $EDIT eq 'permitted'}
				<input {$ORDER_STATUS} title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="crmbutton small edit" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$ID}';this.form.module.value='{$MODULE}';this.form.action.value='EditView'" type="submit" name="Edit" value="{$APP.LBL_EDIT_BUTTON_LABEL}">&nbsp;
				{/if}
				
			
				<input title="{$APP.LBL_LIST_BUTTON_TITLE}" class="crmbutton small edit" onclick="document.location.href='index.php?module={$MODULE}&action=index&parenttab={$CATEGORY}'" type="button" name="ListView" value="&nbsp;{$APP.LBL_LIST_BUTTON_LABEL}&nbsp;">&nbsp;
			</td>
			<td align=right>
				{if $EDIT_DUPLICATE eq 'permitted'}
				<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="crmbutton small create" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value='true';this.form.module.value='{$MODULE}'; this.form.action.value='EditView'" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}">&nbsp;
				{/if}
				{if ($DELETE eq 'permitted' && $APPROVE_STATUS neq '1') || $IS_ADMIN eq 'true'}
				<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="crmbutton small delete" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='index'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}')" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}">&nbsp;
				{/if}
			</td>
                   </tr>
                </table>

		
	</td>
   </tr>
   {/strip}
</table>
{/if}
</form>
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		  <tr>
			<td style="" width="100%">
			{if $SinglePane_View eq 'true'}
				{include file= 'RelatedListNew.tpl'}
			{/if}
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
{ldelim}
new Ajax.Request(
        'index.php',
        {ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
        method: 'post',
        postBody: 'module={$MODULE}&action={$MODULE}Ajax&file=TagCloud&ajxaction=GETTAGCLOUD&recordid={$ID}',
        onComplete: function(response) {ldelim}
                                $("tagfields").innerHTML=response.responseText;
                                $("txtbox_tagfields").value ='';
                        {rdelim}
        {rdelim}
);
{rdelim}
getTagCloud();
</script>

	</td>
   </tr>
</table>
<script language="javascript">
  var fieldname = new Array({$VALIDATION_DATA_FIELDNAME});
  var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL});
  var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE});
</script>

