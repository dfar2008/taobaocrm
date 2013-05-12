<div align="left">
<input type="hidden" name="at" value="sms"/>
<font color="#3366FF"><b>发短信</b></font>
{if $ROW.actauto_sms =='1' }
<input type="radio" name="actauto_sms" value="1" checked="checked"/>自动  
<input type="radio"  value="0" name="actauto_sms"/>手动<br/>
{else}
<input type="radio" name="actauto_sms" value="1"/>自动  
<input type="radio" checked="checked" value="0" name="actauto_sms"/>手动<br/>
{/if}
<font color="808080">发送时间：</font>开始日期当天的
 <select size="1" name="autoact_sms_tt">
     {foreach item=time from=$AUTOACT_SMS_TT_ARR}
     	{if $ROW.autoact_sms_tt ==$time}
		<option value="{$time}" selected="selected">{$time}</option>
		{else}
        <option value="{$time}">{$time}</option>
        {/if}
     {/foreach}
 </select><br/>　　　　
<font color="808080">(发送时间仅在自动执行时生效，且于执行日凌晨即自动发送定时短信)</font><br/>
 <font color="808080"><span style="vertical-align: top;">短信内容：</span></font>
 <textarea cols="60" name="autoact_sms_sm" rows="50" style="width:100%"/>{$ROW.autoact_sms_sm}</textarea><br/>　　　　　
 <span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:会员名称$membername$ </span>
</div>