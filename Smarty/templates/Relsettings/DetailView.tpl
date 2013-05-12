<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
<script type="text/javascript" src="include/js/reflection.js"></script>
<script type="text/javascript" src="include/js/dtlviewajax.js"></script>
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
		SaveTagD('txtbox_tagfields','{$ID}','{$MODULE}');	
	else
	{ldelim}
		alert(alert_arr.INPUT_TAG);
		return false;
	{rdelim}
{rdelim}
function SaveTagD(txtBox,crmId,module)
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
<tr><td>{include file='Buttons_List1.tpl'}</td></tr>
<tr><td>
<!-- Contents -->
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
<tr>
	<td valign=top><img src="{$IMAGE_PATH}showPanelTopLeft.gif"></td>
	<td class="showPanelBg" valign=top width=100%>
		<!-- PUBLIC CONTENTS STARTS-->
		<div class="small" style="padding:10px" >
		
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="95%"><tr><td>		
		 <span class="dvHeaderText">[ {$ID} ]{$NAME} -  {$APP[$SINGLE_MOD]} {$APP.LBL_INFORMATION}</span>&nbsp;&nbsp;<span id="vtbusy_info" style="display:none;" valign="bottom"><img src="{$IMAGE_PATH}vtbusy.gif" border="0"></span><span id="vtbusy_info" style="visibility:hidden;" valign="bottom"><img src="{$IMAGE_PATH}vtbusy.gif" border="0"></span></td><td>&nbsp;</td></tr>
		 <tr height=20><td>{$UPDATEINFO}</td></tr>
		 </table>			 
		<br>
		
		<!-- Account details tabs -->
		<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
		<tr>
			<td>
				<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
				<tr>
					<td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>
					
					<td class="dvtSelectedCell" align=center nowrap>{$APP[$SINGLE_MOD]} {$APP.LBL_INFORMATION}</td>	
					<td class="dvtTabCache" style="width:10px">&nbsp;</td>
					{if $SinglePane_View eq 'false'}
						<td class="dvtUnSelectedCell" align=center nowrap><a href="index.php?action=CallRelatedList&module={$MODULE}&record={$ID}&parenttab={$CATEGORY}">{$APP.LBL_RELATED_INFO}</a></td>
					{/if}
						<td class="dvtTabCache" style="width:100%">&nbsp;</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign=top align=left >
                <table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
				<tr>

					<td align=left>
					<!-- content cache -->
					
				<table border=0 cellspacing=0 cellpadding=0 width=100%>
                <tr>
					<td style="padding:5px">
					<!-- Command Buttons -->
				<form action="index.php" method="post" name="DetailView" id="form">
				<input type="hidden" name="parenttab" id="parenttab" value="{$CATEGORY}">
				<input type="hidden" name="module" id="module" value="{$MODULE}">
				<input type="hidden" name="record" id="record" value="{$ID}">
				<input type="hidden" name="isDuplicate" value=false>
				<input type="hidden" name="action" id="action">
				<input type="hidden" name="return_module" id="return_module">
				<input type="hidden" name="return_action" id="return_action">
				<input type="hidden" name="return_id" id="return_id">
				    <table border=0 cellspacing=0 cellpadding=0 width=100%>
					{strip}<tr>
					<td  colspan=4 style="padding:5px">		
					
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						<tr>
						<td>
					
						{if $EDIT eq 'permitted'}
						<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="crmbutton small edit" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$ID}';this.form.module.value='{$MODULE}';this.form.action.value='EditView'" type="submit" name="Edit" value="&nbsp;{$APP.LBL_EDIT_BUTTON_LABEL}&nbsp;">&nbsp;
						{/if}
						{if $APPROVE eq 'permitted'}
						<input {$APPROVE_RECORD_STATUS} class="crmbutton small edit" onclick="javascript:callCreateApproveDiv({$ID});" type="button" name="approve" value="{$APP.LBL_APPROVE_BUTTON_LABEL}">&nbsp;
						<input {$ANTI_RECORD_STATUS} class="crmbutton small edit" onclick="callAntiCreateApproveDiv({$ID})" type="button" name="antiapprove" value="{$APP.LBL_ANTI_APPROVE_BUTTON_LABEL}">&nbsp;
						{/if}
						<input title="{$APP.LBL_LIST_BUTTON_TITLE}" class="crmbutton small edit" onclick="document.location.href='index.php?module={$MODULE}&action=index&parenttab={$CATEGORY}'" type="button" name="ListView" value="&nbsp;{$APP.LBL_LIST_BUTTON_LABEL}&nbsp;">&nbsp;
						
						</td>
						<td align=right>
								{if $EDIT_DUPLICATE eq 'permitted'}
								<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="crmbutton small create" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value='true';this.form.module.value='{$MODULE}'; this.form.action.value='EditView'" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}">&nbsp;
								{/if}
								{if $DELETE eq 'permitted'}
								<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="crmbutton small delete" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='index'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}')" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}">&nbsp;
								{/if}

						</td>
						</tr>
						</table>

							</td>
						     </tr>{/strip}
						     <tr><td>
							{foreach key=header item=detail from=$BLOCKS}
							<!-- Detailed View Code starts here-->
							<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
							<tr>
							<td width="25%" height="1"></td><td height="1" width="25%"></td>
							<td width="25%" height="1"></td><td height="1" width="25%"></td>
							</tr>
							 
						     <tr>{strip}
						     <td colspan=4 class="dvInnerHeader">
							<b>
						        	{$header}
	  			     			</b>
						     </td>{/strip}
					             </tr>
						   {foreach item=detail from=$detail}
						     <tr style="height:25px">
							{foreach key=label item=data from=$detail}
							   {assign var=keyid value=$data.ui}
							   {assign var=keyval value=$data.value}
							   {assign var=keyseclink value=$data.link}
							   {if $label ne ''}
							    <td class="dvtCellLabel" align=right>{$label}</td>								
							    {include file="DetailViewFields.tpl"}
							   {/if}
                                                        {/foreach}
						      </tr>	
						   {/foreach}	
						   </table>
                     	                      </td>
					   </tr>
		<tr><td>
			{/foreach}
                    {*-- End of Blocks--*} 
			</td>
                </tr>
		<tr><td>
			 <!-- Product Details informations -->
			 {$ASSOCIATED_PRODUCTS}
		</td></tr>
	   
			{if $SinglePane_View eq 'false'}
			                  <tr>
					     <td style="padding:10px">
		           <table border=0 cellspacing=0 cellpadding=0 width=100%>
				     {strip}<tr nowrap>
							<td  colspan=4 style="padding:5px">
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						<tr>
						<td>
					
						{if $EDIT eq 'permitted'}
						<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="crmbutton small edit" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$ID}';this.form.module.value='{$MODULE}';this.form.action.value='EditView'" type="submit" name="Edit" value="&nbsp;{$APP.LBL_EDIT_BUTTON_LABEL}&nbsp;">&nbsp;
						{/if}
						{if $APPROVE eq 'permitted'}
						<input {$APPROVE_RECORD_STATUS} class="crmbutton small edit" onclick="javascript:callCreateApproveDiv({$ID});" type="button" name="approve" value="{$APP.LBL_APPROVE_BUTTON_LABEL}">&nbsp;
						<input {$ANTI_RECORD_STATUS} class="crmbutton small edit" onclick="callAntiCreateApproveDiv({$ID})" type="button" name="antiapprove" value="{$APP.LBL_ANTI_APPROVE_BUTTON_LABEL}">&nbsp;
						{/if}
						<input title="{$APP.LBL_LIST_BUTTON_TITLE}" class="crmbutton small edit" onclick="document.location.href='index.php?module={$MODULE}&action=index&parenttab={$CATEGORY}'" type="button" name="ListView" value="&nbsp;{$APP.LBL_LIST_BUTTON_LABEL}&nbsp;">&nbsp;
						</td>
						<td align=right>
								{if $EDIT_DUPLICATE eq 'permitted'}
								<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="crmbutton small create" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value='true';this.form.module.value='{$MODULE}'; this.form.action.value='EditView'" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}">&nbsp;
								{/if}
								{if $DELETE eq 'permitted'}
								<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="crmbutton small delete" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='index'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}')" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}">&nbsp;
								{/if}

						</td>
						</tr>
						</table>

							</td>


						     </tr>{/strip}
				</table>
</td></tr>
{/if}
</form>
			{if $SinglePane_View eq 'true'}
				{include file= 'Relsettings/RelatedListNew.tpl'}
			{/if}
		</table>
		</td>
		<td width=22% valign=top style="border-left:2px dashed #cccccc;padding:13px">
		        <table width="100%" border="0" cellpadding="5" cellspacing="0">
				   <tr>
					<td>&nbsp;</td>
				   </tr>
				   <tr>
					<td align="left" class="genHeaderSmall">{$APP.LBL_ACTIONS}</td>
				   </tr>
				   <!-- Module based actions starts -->
				   {if $SinglePane_View eq 'true'}
					{assign var = return_modname value='DetailView'}
				   {else}
					{assign var = return_modname value='CallRelatedList'}
				   {/if}
				   <tr>
					<td align="left" style="padding-left:10px;">
						<img src="{$IMAGE_PATH}pointer.gif" hspace="5" align="absmiddle"/>
						<a href="index.php?module={$MODULE}&action=CreatePDFPrint&record={$ID}"  target="_blank" class="webMnu">{$APP.LNK_PRINT}</a> 
					</td>
				   </tr>
				   
				   
			</table>
			
			<br>
			<!-- Tag cloud display -->
			<table border=0 cellspacing=0 cellpadding=0 width=100% class="tagCloud">
			<tr>
				<td class="tagCloudTopBg"><img src="{$IMAGE_PATH}tagCloudName.gif" border=0></td>
			</tr>
			<tr>
				<td><div id="tagdiv" style="display:visible;"><input class="textbox"  type="text" id="txtbox_tagfields" name="txtbox_tagfields" value="" style="width:100px;margin-left:5px;"></input>&nbsp;&nbsp;<input name="button_tagfileds" type="button" class="crmbutton small save" value="{$APP.LBL_TAG_IT}" onclick="return tagvalidate()"/></div></td>
			</tr>
			<tr>
				<td class="tagCloudDisplay" valign=top> <span id="tagfields">{$ALL_TAG}</span></td>
			</tr>
			</table>
			</td>
		
		</tr>
		</table>
		
		</div>
		<!-- PUBLIC CONTENTS STOPS-->
	</td>
</tr>
</table>
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
<!-- added for validation -->
<script language="javascript">
  var fieldname = new Array({$VALIDATION_DATA_FIELDNAME});
  var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL});
  var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE});
</script>
</td>
</tr></table>
</td>
	<td align=right valign=top><img src="{$IMAGE_PATH}showPanelTopRight.gif"></td>
</tr></table>

