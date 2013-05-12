<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>

<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr><td>{include file='Buttons_List1.tpl'}</td></tr>
<tr><td>
<!-- Contents -->
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
<tr>
	<td class="showPanelBg1" valign=top width=100%>
		<!-- PUBLIC CONTENTS STARTS-->
		<div class="small" style="padding:10px" >
		
		
		<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
		<tr height="1">
			<td>
				<table border=0 cellspacing=0 cellpadding=0 width=100% >
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
						
						<input title="{$APP.LBL_LIST_BUTTON_TITLE}" class="crmbutton small edit" onclick="document.location.href='index.php?module={$MODULE}&action=index&parenttab={$CATEGORY}'" type="button" name="ListView" value="&nbsp;{$APP.LBL_LIST_BUTTON_LABEL}&nbsp;">&nbsp;
                        <input  class="crmbutton small cancel" onclick="history.go(-1);" type="button" name="ruturn" value="&nbsp;后退&nbsp;">&nbsp;
						
						</td>
						<td align=right>
								
                        {if $DELETE eq 'permitted'}
                        <input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="crmbutton small delete" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='index'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}')" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}">&nbsp;
                        {/if}
                        
                        {if $ZHONGZHI eq 'permitted'}
                        <input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="crmbutton small create" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='index'; this.form.action.value='Change'; return confirm('确定中止?')" type="submit" name="Zhongzhi" value=" 中止 ">&nbsp;
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
			 <table  border=0 cellspacing=0 cellpadding=0 width=100% class="small" style="background:#F0F0F0;margin-top:20px;">
             
             <tr style="height:25px">
 			<td class="dvInnerHeader" colspan="7"><b>本序列所有事件</b></td>
			</tr>
             <tr style="height:25px">
				 {foreach name="listviewforeach" item=header from=$EVENTARR}
 			<td class="lvtCol" style=" border-bottom:1px solid #FFFFFF;border-right:1px solid #FFFFFF;">&nbsp;&nbsp;{$header}</td>
				{/foreach}
			</tr>
			<!-- Table Contents -->
			{foreach item=entity key=entity_id from=$LIST_ENTRIES}
			<tr style="height:25px;">
			{foreach item=data from=$entity}	
			<td style=" border-bottom:1px solid #FFFFFF;border-right:1px solid #FFFFFF;">&nbsp;&nbsp;{$data}</td>
	        {/foreach}
			</tr>
            {/foreach}
             </table>
             
		</td></tr>
	   
			
</form>
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
<script language="javascript">
{literal}
function openRunEvent(sfalisteventsid){
	var url = 'index.php?module=Sfalists&action=RunEvent&record='+sfalisteventsid;
	window.open (url,'openRunEvent','height=650,width=750,top=0,left=0,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no')
}
 
{/literal}
</script>
</td>
</tr></table>
</td>
</tr></table>

