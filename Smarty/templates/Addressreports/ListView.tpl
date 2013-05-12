<link href="include/ajaxtabs/ajaxtabs.css" type="text/css" rel="stylesheet"/>

<LINK REL="stylesheet" TYPE="text/css" HREF="include/phpreports/sales.css">
<link href="themes/images/style_cn.css" rel="stylesheet" type="text/css">
<link href="themes/images/report.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="themes/images/tabpane.js"></script>
<link href="themes/images/tab.css" rel="stylesheet" type="text/css">
<style type="text/css">
{literal}
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
  height:32px;
  cursor:pointer;
}
{/literal}
</style>
<table style="background-color: rgb(234, 234, 234);" class="small" width="100%" border="0" cellpadding="3" cellspacing="1">
 <tr style="height: 25px;" bgcolor="white">
    <td width="100%" colspan="{$colspan}" class="detailedViewHeader" style="font-weight:bolder;">
        {$title}&nbsp;
        {if $connection && $connection != ''}
        	>> {$connection}
        {/if}
    </td>
  </tr>
 <tr style="height: 25px;" bgcolor="white" id="searchtr">
   <td colspan="{$colspan}" style="font-weight:bolder;">
		<form action="index.php" method="post">
        	<input type="hidden" value="{$MODULE}" name="module">
            <input type="hidden" value="ListView" name="action">
            <input type="hidden" value="1" name="start">
        <table class="small" border="0" cellpadding="3" cellspacing="1">
          <tr>
            <td nowrap="nowrap">
            		最新订单日期：
            		<select name="stdDateFilter" style="WIDTH: 150px" class="select" onchange='showDateRange_jscal_field(this.options[this.selectedIndex].value )'>
                    	{$dateFilterHtml}
                    </select>&nbsp;
                    开始时间：
                    <input name="startdate" id="jscal_field_date_start" type="text" 
                    size="12" class="importBox" style="width:80px;" value="{$startdate}">
                    <img src="themes/softed/images/calendar.gif" id="jscal_trigger_date_start">&nbsp;
                    <script type="text/javascript">
					{literal}
					Calendar.setup ({
						inputField : "jscal_field_date_start", ifFormat : "%Y-%m-%d", showsTime : false, 
						button : "jscal_trigger_date_start", singleClick : true, step : 1
									})
					{/literal}
					</script>
                    结束时间：
                    <input name="enddate" id="jscal_field_date_end" type="text" 
                    size="12" class="importBox" style="width:80px;" value="{$enddate}">
                    <img src="themes/softed/images/calendar.gif" id="jscal_trigger_date_end">
					<script type="text/javascript">
					{literal}
					Calendar.setup ({
						inputField : "jscal_field_date_end", ifFormat : "%Y-%m-%d", showsTime : false, 
						button : "jscal_trigger_date_end", singleClick : true, step : 1
									})
					{/literal}
					</script>
            </td>
            <td nowrap="nowrap" style="display:none;">
            	时间统计方式：
            	<select name="grouptype" id="grouptype">
                    {foreach from=$GROUPTYPEARR item=val key=key}
                    	{if $key == $grouptype}
							{assign var="grouptypeed" value="selected"}
                        {else}
                        	{assign var="grouptypeed" value=""}
                        {/if}
                    	<option value="{$key}" {$grouptypeed}>{$val}</option>
                    {/foreach}
                </select>
            </td>
            <td nowrap="nowrap">
            	统计图表类型：
				<select name="flashtype" id="flashtype">
                    {foreach from=$FLASHTYPEARR item=val key=key}
                    	{if $key == $flashtype}
							{assign var="flashtypeed" value="selected"}
                        {else}
                        	{assign var="flashtypeed" value=""}
                        {/if}
                    	<option value="{$key}" {$flashtypeed}>{$val}</option>
                    {/foreach}
                </select>
            </td>
            <td nowrap="nowrap">
            	<input type="submit" value=" 查看 " class="crmbutton save"/>
            </td>
          </tr>
        </table>
        </form>
   </td>
 </tr>
      <tr style="height: 25px;">
<td colspan="{$colspan}" style=" background-color:#fff; padding:0px; margin:0px;">
            <ul id="countrytabs" class="shadetabs">
            {foreach from=$SETYPEARR item=val key=key}
                 {if $key == $SETYPE}
                    {assign var=selected value='tablink selected'}
                {else}
                    {assign var=selected value='tablink'}
                {/if}
            	<li><a href="#" id="{$key}" rel="#default" class="{$selected}" onclick="getTabView('{$key}',this);return false;">{$val}</a></li>
            {/foreach}
            </ul>
        </td>
    </tr>
  <!-- /视图 -->
{if $LISTENTRYHTML && $LISTENTRYHTML != ''}
    <tr style="height: 25px; display:none;" class='report_part'> 
        <td class="lvtCol" nowrap align='center'>序号</td>
        <td class="lvtCol" nowrap align='center'>分布地区</td>
        <td class="lvtCol" nowrap align='center'>客户数量</td>
    </tr>
    </tr>
      {$LISTENTRYHTML}
<tr style="height: 25px;" bgcolor="white" id="flash_tr" class='flash_part'>
    <td width="100%" colspan="{$colspan}" align="center" nowrap>
  		{$RESFLASH}
    </td>
  </tr>
{else}
    <tr bgcolor="white">
        <td colspan="{$colspan}" align="center" nowrap>No Data</td>
    </tr>
{/if}
 <tr bgcolor="white">
    <td nowrap colspan="{$colspan}">
    <div style="float:left;">
    {$ACCOUNTSTR}
    </div>
    <div style="float:right;">
    {$RECORD_COUNTS} {$NAVIGATION}
    </div>
    </td>
  </tr>
  </table>
{$dateFilterJs}
<script>
var findurlstr = '{$FINDURLSTR}';
var modules = '{$MODULE}';
var actions = '{$ACTIONS}';
{literal}
function getListViewEntries_js(module,pagestr){
	location.href="index.php?module="+module+"&action="+actions+""+findurlstr+"&"+pagestr;
}
function getListViewWithPageSize(module,obj){
	var pagestr = "limitpage="+obj.value;
	getListViewEntries_js(module,pagestr);
}
function exportReport(){
	location.href="index.php?module="+modules+"&action=Popup_expotrreport&"+findurlstr;
}

function getTabView(settype,theelement){		
	if(settype != ''){
		var classmethods=$$('.tablink');
		for(var i=0;i<classmethods.length;i++){
		   classmethods[i].removeClassName('selected');
		}
		$(theelement).addClassName('selected');
		var flashels=$$('.flash_part');
		for(var i=0;i<flashels.length;i++){
		   if(settype=='flash') flashels[i].show();
		   else flashels[i].hide();
		}
		var reportels=$$('.report_part');
		for(var i=0;i<reportels.length;i++){
		   if(settype=='report') reportels[i].show();
		   else reportels[i].hide();
		}	
	}
}
function setsearch_click(){
	var searchtr = document.getElementById('searchtr');
	searchtr.style.display = (searchtr.style.display == 'none')?'':'none';
}
{/literal}
</script>