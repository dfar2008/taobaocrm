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
<link href="include/ajaxtabs/ajaxtabs.css" type="text/css" rel="stylesheet"/>
<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/search.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
<script  language="JavaScript" type="text/javascript" charset="utf-8" src="include/kindeditor/kindeditor.js"></script>
<script>
{literal}	
		KE.show({
			id : 'mailcontent',
			imageUploadJson : 'include/kindeditor/php/upload_json.php',
			fileManagerJson : 'include/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function(id) {
				KE.util.focus(id);
			}
		});
{/literal}	
</script>
		{include file='Buttons_List.tpl'}
                        </td>
                </tr>
                </table>
        </td>
</tr>
</table>

{*<!-- Contents -->*}

<table class="list_table" style="margin-top:2px;" border="0" cellpadding="3" cellspacing="1" width="100%">
        <tbody><tr >
        
          <td>
	  <table border="0" cellpadding="0" cellspacing="0" style="padding-right:5px;padding-top:2px;padding-bottom:2px;">

	  <tr>
	  <td><img src="themes/images/filter.png" border=0></td>
	  <td>{$APP.LBL_FENZU}
	  {foreach name="listviewforeach" key=id item=fenzuname from=$CUSTOMVIEW_OPTION}

			{if $id eq $VIEWID} 
			<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">
			&nbsp;&nbsp;<a class="cus_markbai tablink" href="javascript:;" onclick="javascript:getTableViewForFenzu('{$MODULE}','viewname={$id}',this,{$id});">{$fenzuname}</a>&nbsp;&nbsp;
			</span>
			{else}
			<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">
			&nbsp;&nbsp;<a class="cus_markhui tablink" href="javascript:;" onclick="javascript:getTableViewForFenzu('{$MODULE}','viewname={$id}',this,{$id});">{$fenzuname}</a>&nbsp;&nbsp;
			</span>
			{/if}		
			
	  {/foreach}
	  
	
		        
			<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">&nbsp;<a href="index.php?module={$MODULE}&action=Fenzu&parenttab={$CATEGORY}">{$APP.LNK_CV_CREATEFENZU}</a> | 
						
						<a href="javascript:editFenzu('{$MODULE}','{$CATEGORY}')">{$APP.LNK_CV_EDIT}</a> |
						
						<a href="javascript:deleteFenzu('{$MODULE}','{$CATEGORY}')">{$APP.LNK_CV_DELETE}</a></span>&nbsp;
		</td>
		</tr>
            </tbody></table>
	</td>
        </tr>
	<tr>
<td  colspan=3 bgcolor="#ffffff" valign="top">
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
     <tr>
      <td class="lvt" valign="top" width=100% style="padding:0px;">
	   <!-- PUBLIC CONTENTS STARTS-->
	  <div id="ListViewContents" class="small" style="width:100%;position:relative;">
			{include file="Maillists/ListViewEntries.tpl"}
	  </div>
     </td>
   </tr>
</table>
<!-- New List -->
</td></tr></tbody></table>

<!-- QuickEdit Feature -->

<script language="javascript" type="text/javascript">
{literal}

function uploadAttInfo(sjid){  
	
	 $("status").style.display="inline";
	 alert("添加成功");
	 new Ajax.Request(
                    'index.php',
                    {queue: {position: 'end', scope: 'command'},
                        method: 'post',
                        postBody:"module=Maillists&action=MaillistsAjax&file=updateMaillistAtt&sjid="+sjid,
                        onComplete: function(response) {
                                $("status").style.display="none";
								$("maillistattinfo").update(response.responseText);	
                        }
                 }
            );
}
function DeleteMaillistAtt(sjid,attachmentsid){
	$("status").style.display="inline";
	 alert("删除成功");
	 new Ajax.Request(
                    'index.php',
                    {queue: {position: 'end', scope: 'command'},
                        method: 'post',
                        postBody:"module=Maillists&action=MaillistsAjax&file=deleteMaillistAtt&sjid="+sjid+"&attachmentsid="+attachmentsid,
                        onComplete: function(response) {
                                $("status").style.display="none";
								$("maillistattinfo").update(response.responseText);	
                        }
                 }
            );
}
{/literal}
</script>




