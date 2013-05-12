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
<style>
{literal}
.clear{
	clear:left;		
}
.zhengchang {
	float:left;	
}
.zhengchang li{
	height:21px;
	float:left;
	background: url("themes/softed/images/sfa_blue.png") no-repeat scroll 0 0 transparent;
	list-style: none outside none;
	padding:0px;
}
.zhengchang li a{
	height:21px;
	background: url("themes/softed/images/sfa_blue.png") repeat-x scroll 0 -21px transparent;
	display: inline-block;
    line-height: 21px;
    padding: 0 0 0 5px;
}
.zhengchang li a span{
	height:21px;
	display: inline-block;
    line-height: 21px;
    padding-right: 21px;
	background: url("themes/softed/images/sfa_blue.png") no-repeat scroll right -42px transparent;
}
.guoqi {
	float:left;	
}
.guoqi li{
	height:21px;
	float:left;
	background: url("themes/softed/images/sfa_gray.png") no-repeat scroll 0 0 transparent;
	list-style: none outside none;
	padding:0px;
}
.guoqi li a{
	height:21px;
	background: url("themes/softed/images/sfa_gray.png") repeat-x scroll 0 -21px transparent;
	display: inline-block;
    line-height: 21px;
    padding: 0 0 0 5px;
}
.guoqi li a span{
	height:21px;
	display: inline-block;
    line-height: 21px;
    padding-right: 21px;
	background: url("themes/softed/images/sfa_gray.png") no-repeat scroll right -42px transparent;
}
.jinxing {
	float:left;	
}
.jinxing li{
	height:21px;
	float:left;
	background: url("themes/softed/images/sfa_yello.png") no-repeat scroll 0 0 transparent;
	list-style: none outside none;
	padding:0px;
}
.jinxing li a{
	height:21px;
	background: url("themes/softed/images/sfa_yello.png") repeat-x scroll 0 -21px transparent;
	display: inline-block;
    line-height: 21px;
    padding: 0 0 0 5px;
}
.jinxing li a span{
	height:21px;
	display: inline-block;
    line-height: 21px;
    padding-right: 21px;
	background: url("themes/softed/images/sfa_yello.png") no-repeat scroll right -42px transparent;
}

li.sfasn {
    color: #000000;
    display: inline;
    float: left;
    font-family: 宋体;
    margin-bottom: 3px;
    white-space: nowrap;
}
li {
	line-height:150%;	
}
{/literal}
</style>
<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
<script type="text/javascript" src="include/js/reflection.js"></script>
<script type="text/javascript" src="include/js/dtlviewajax.js"></script>
<span id="crmspanid" style="display:none;position:absolute;"  onmouseover="fnshow('crmspanid');"  onmouseout="fnhide('crmspanid');">
   <a class="link"  align="right" href="javascript:;">{$APP.LBL_EDIT_BUTTON}</a>
</span>

{$DATE_FILTER_JS}


<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr><td>{include file='Buttons_List_details.tpl'}</td></tr>
<tr><td>
<!-- Contents -->
<table border=0 cellspacing=0 cellpadding=0 width=98% align=center  >
<tr >
	
	<td  valign=top width="100%">
		<!-- PUBLIC CONTENTS STARTS-->
		<div class="small" style="padding:0px">
		
		<!-- Account details tabs -->
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
                <table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace" >
				<tr>

					<td align=left>
					<!-- content cache -->
					
				<table border=0 cellspacing=0 cellpadding=0 width=100%>
                <tr>
					<td style="padding:5px">
					<!-- Command Buttons -->
				<form action="index.php" method="post" name="DetailView" id="form">
					{include file='DetailViewHidden.tpl'}
				    <table border=0 cellspacing=0 cellpadding=0 width=100%>
					{strip}<tr>
					<td  colspan=4 style="padding:5px">		
					
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						<tr>
						<td>
					
						{if $EDIT eq 'permitted'}
						<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="crmbutton small edit" onclick="this.form.return_module.value='{$MODULE}'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$ID}';this.form.module.value='{$MODULE}';this.form.action.value='EditView'" type="submit" name="Edit" value="&nbsp;{$APP.LBL_EDIT_BUTTON_LABEL}&nbsp;">&nbsp;
						
						{/if}
						

						{if $EDIT eq 'NOTSUPPORTpermitted'}
							<input title="{$MOD.LBL_ASSIGN_BUTTON_LABEL}" class="crmbutton small edit" onclick="fnvshobj(this,'assignrecorddiv');callAssignrecordDiv({$ID})" type="button" name="Assign" value="&nbsp;{$MOD.LBL_ASSIGN_BUTTON_LABEL}&nbsp;">&nbsp;
						{/if}
						<input title="{$APP.LBL_LIST_BUTTON_TITLE}" class="crmbutton small edit" onclick="document.location.href='index.php?module={$MODULE}&action=index&parenttab={$CATEGORY}'" type="button" name="ListView" value="&nbsp;{$APP.LBL_LIST_BUTTON_LABEL}&nbsp;">&nbsp;
						
						</td>
						<td align=right>
								{if $EDIT_DUPLICATE eq 'permitted'}
								<input title="{$APP.LNK_NEW_ACCOUNT}" accessKey="{$APP.LNK_NEW_ACCOUNT}" class="crmbutton small create" onclick="javascript:location.href='index.php?module=Accounts&action=EditView'" type="button" name="Create" value="{$APP.LNK_NEW_ACCOUNT}">&nbsp;
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
						{foreach key=header item=detail name=listviewforeach from=$BLOCKS}
							<!-- Detailed View Code starts here-->
							<table border=0 cellspacing=0 cellpadding=0 width=100% class="small" style="padding-bottom:10px;">
							<tr>
							<td width="20%" height="1"></td><td height="1" width="30%"></td>
							<td width="20%" height="1"></td><td height="1" width="30%"></td>
							</tr>							
						    <tr style="height:25px;">{strip}
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
						     </td>{/strip}
					        </tr>
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
                                 <tr style="height:25px" >
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
                     	     </td>
					   </tr>
		<tr><td>
			{/foreach}
                    {*-- End of Blocks--*} 
			</td>
                </tr>

</form>
		
		</table>
        <table border=0 cellspacing=1 cellpadding=3 width=100% style="border-bottom:1px solid #999999;border-left:1px solid #999999;border-right:1px solid #999999;border-top:1px solid #999999;"  class="small">
        	<tr>
            <td class="dvInnerHeader" align="center"><font color=red><b>SFA 销售自动化</b></font></td>
            </tr>
            <tr  style="border-bottom:1px solid #999999;">
          	  <td style="background: none repeat scroll 0 0 #E8E8E8;">启动 SFA序列: 
              		<select id="sfasettingsid" name="sfasettingsid">
                    	<option value="0">无</option>
                        	{$sfasettingshtml}
                    </select>
                    
                    <input type="button" name="qidong" value=" 开始 " class="crmbutton small create" onclick="CreateSfaList();"  />
              </td>
            </tr>
            <tr >
            	<td style="background: none repeat scroll 0 0 #F9F9F9;border-bottom:1px solid #999999;height:30px;">
                正在执行的序列：图示【<img border="0" src="{$IMAGE_PATH}s31.png">成功<img border="0" src="{$IMAGE_PATH}s32.png">跳过<img border="0" src="{$IMAGE_PATH}s33.png">执行失败<img border="0" src="{$IMAGE_PATH}me.png">未执行/再次执行】  背景【<img border="0" src="{$IMAGE_PATH}sfa_blue_1.gif">正常的<img border="0" src="{$IMAGE_PATH}sfa_yellow_1.gif">正在执行期内<img border="0" src="{$IMAGE_PATH}sfa_gray_1.gif">过期未执行的】
                </td>
            </tr>
            <tr>
            	<td style="border-bottom:1px solid #999999;">
                {foreach item=now key=key from=$Sfalists_now}
                				<div class="clear"></div>
                	&nbsp;&nbsp;<div style="height:25px;">{$now}</div>
                    	<div style="padding-left:35px;">
                     	 {foreach item=data from=$sfalist_now_events_list.$key}
                			{$data}
               			 {/foreach}
                         </div>
                       <br>
                {/foreach}
                </td>
            </tr>
            <tr >
            	<td style="background: none repeat scroll 0 0 #F9F9F9;border-bottom:1px solid #999999;height:30px;">
                停止执行的序列:
                </td>
            </tr>
            <tr>
            	<td style="border-bottom:1px solid #999999;"> 
                {foreach item=over from=$Sfalists_over}
                	&nbsp;&nbsp;<div style="height:20px;">{$over}</div> 
                {/foreach}
                </td>
            </tr>
            <tr >
            	<td style="background: none repeat scroll 0 0 #F9F9F9;border-bottom:1px solid #999999;height:30px;">
                最近执行的事件:
                </td>
            </tr>
            <tr>
            	<td>
                {foreach item=log from=$Sfalogs}
                	&nbsp;&nbsp;<div style="height:20px;">{$log}</div> 
                {/foreach}
                </td>
            </tr>
        </table>

        
		</td>
       
        <!-- zhuaiyao-->
		 <!--<td width=22% valign=top style="border-left:2px dashed #cccccc;padding:13px">
			<!--  begin-->
             <!--<table border=0 cellspacing=0 cellpadding=0 width=100% class="zhuaiyao">
                <tr>
                    <td colspan=2 class="zhuaiyaoth">摘要</td>
                </tr>
                <tr>
                    <td class="zhuaiyaotrtdl" align="left">&nbsp;</td>
                    <td class="zhuaiyaotrtdr" align="right">&nbsp;</td>
                </tr>
                
			</table>-->
            <!--  end -->
		<!-- </td>-->
		<!--zhuaiyao -->
		</tr>
		</table>
		
		</div>
		<!-- PUBLIC CONTENTS STOPS-->
	</td>
</tr>
<tr>
<td>
	{if $SinglePane_View eq 'true'}
				{include file= 'RelatedListNew.tpl'}
	{/if}
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
  var accountid = '{$ID}';
{literal}
function CreateSfaList(){
	var sfasettingsid = document.getElementById("sfasettingsid").value;
	if(sfasettingsid == 0){
		alert("请先选择方案！");
		return false;
	}
	var url = 'index.php?module=Sfalists&action=EditView&accountid='+accountid+'&sfasettingsid='+sfasettingsid;
	window.open (url,'createsfalist','height=350,width=600,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')
}
function openEdit(sfalistsid){
	var url = 'index.php?module=Sfalists&action=EditView&record='+sfalistsid;
	window.open (url,'openEdit','height=350,width=600,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')
}
function openDel(sfalistsid){
	var url = 'index.php?module=Sfalists&action=Shanchu&record='+sfalistsid;
	window.open (url,'openDel','height=300,width=500,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')
}
function openZhongzhi(sfalistsid){
	var url = 'index.php?module=Sfalists&action=Zhongzhi&record='+sfalistsid;
	window.open (url,'openZhongzhi','height=300,width=500,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')
}

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

