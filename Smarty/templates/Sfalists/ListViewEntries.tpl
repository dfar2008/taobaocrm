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

<form name="massdelete" method="POST" action="index.php">
     <input name="action" id="action" type="hidden" value="ListView">
     <input name="module" id="module" type="hidden" value="Sfalists">
  
				<!-- List View Master Holder starts -->
				<table border=0 cellspacing=1 cellpadding=0 width=100% class="lvtBg">
				<tr>
				<td>
				<!-- List View's Buttons and Filters starts -->
		        <table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
			    <tr>
				<!-- Buttons -->
				<td style="padding-right:20px" align="left" nowrap>
                <font color=red>搜索:</font>
                 标题:<input type="text" name="sfalistname" value="{$sfalistname}" />
                 客户:<input type="text" name="accountname" value="{$accountname}" />
                 方案名:<input type="text" name="sfasettingname" value="{$sfasettingname}" />
                 执行状态: <select name="zxzt">
                 {$fenleihtml}
                 </select>
                 <input type="submit" type="submit" class="crmbutton small edit"  value="    搜索    "/>
                </td>
				<!-- Page Navigation -->
				<td nowrap width="100%" align="right" valign="middle">
					<table border=0 cellspacing=0 cellpadding=0 class="small">
					     <tr><td style="padding-right:5px">{$RECORD_COUNTS}&nbsp;&nbsp;&nbsp;&nbsp;{$NAVIGATION}</td></tr>
					</table>
				</td>
			
					
       		    </tr>
			</table>
			<!-- List View's Buttons and Filters ends -->
			
			<div  >
			<table border=0 cellspacing=1 cellpadding=3 width=100% class="lvt small">
			<!-- Table Headers -->
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
			{foreachelse}
			<tr><td style="background-color:#efefef;height:340px" align="center" colspan="{$smarty.foreach.listviewforeach.iteration+1}">
			<div style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 45%; position: relative; z-index: 10000000;">
										
				<table border="0" cellpadding="5" cellspacing="0" width="98%">
				<tr>
					<td rowspan="2" width="25%"><img src="{$IMAGE_PATH}empty.jpg" height="60" width="61"></td>
					<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
					{$APP.LBL_FOUND}
					</span></td>
				</tr>
				
				</table> 
					
				</div>					
				</td></tr>	
			{/foreach}
                
			 </table>
		       </td>
		   </tr>
	    </table>
        
			 </div>
   </form>	
