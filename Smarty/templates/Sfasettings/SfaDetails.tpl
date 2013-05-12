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
    <table class="small" width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr style="background:#DFEBEF;height:27px;">
            <td class="moduleName" nowrap="" style="padding-left:10px;padding-right:50px">
             SFA &gt;&gt;
              <a class="hdrLink" href="index.php?action=ListView&module=Sfasettings&parenttab=sfa">方案设置</a>
             </td>
        </tr>
        <tr>
       		 <td style="height:2px"></td>
        </tr>
      </tbody>
    </table>
   <table border=0 cellspacing=0 cellpadding=3 width=98% class="small">
        <tr>
        <td  align="left" nowrap>
         <b> &nbsp;方案名称:<font color="red">{$sfasettingname}</font></b>&nbsp;&nbsp;
    <input class="crmbutton small create" type="button" value="新增SFA事件" name="Create" onclick="javascript:location.href='index.php?module=Sfasettings&action=EditEvent&sfasettingsid={$sfasettingsid}'" accesskey="新增SFA事件" title="新增SFA事件">
     <input class="crmbutton small edit" type="button" value="返回" name="Return" onclick="javascript:location.href='index.php?module=Sfasettings&action=ListView&parenttab=sfa'" accesskey="返回" title="返回">
        </td>
        </tr>
    </table>
   <table border=0 cellspacing=1 cellpadding=3 width=99% align="center" class="lvt small" >
    <tr>
            {foreach name="listviewforeach" item=header from=$LISTHEADER}
        		<td class="lvtCol">{$header}</td>
            {/foreach}
        </tr>
        <!-- Table Contents -->
        {foreach item=entity key=entity_id from=$LISTENTITY}
           <tr bgcolor=white onMouseOver="this.className='lvtColDataHover'" onMouseOut="this.className='lvtColData'" id="row_{$entity_id}">
            {foreach item=data from=$entity}	
            <td>{$data}</td>
            {/foreach}
          </tr>
        {/foreach}
	</table>
   </form>	
   
   
<script>
{literal}
function up_move(id,sfasettingsid){
	new Ajax.Request(
			'index.php',
			{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:"module=Sfasettings&action=SfasettingsAjax&file=SfaMove&point=up&record="+id+"&sfasettingsid="+sfasettingsid,
			onComplete: function(response) {
			result = response.responseText; 
					if(result == 'SUCCESS') {
						 window.location.reload();
					}else{
						alert("不能上移了");
					}
				}
			}
		)	
}
function down_move(id,sfasettingsid){
	new Ajax.Request(
			'index.php',
			{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:"module=Sfasettings&action=SfasettingsAjax&file=SfaMove&point=down&record="+id+"&sfasettingsid="+sfasettingsid,
			onComplete: function(response) {
			result = response.responseText; 
					if(result == 'SUCCESS') {
						 window.location.reload();
					}else{
						alert("不能下移了");
					}
					
				}
			}
		)	
}
{/literal}
</script>