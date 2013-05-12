
<input type="hidden" name="at" value="email"/><font color="#3366FF"><b>发邮件</b></font>
{if $ROW.actauto_email =='1' }
<input type="radio" name="actauto_email" value="1" checked="checked"/>自动  
<input type="radio"  value="0" name="actauto_email"/>手动<br/>
{else}
<input type="radio" name="actauto_email" value="1"/>自动  
<input type="radio" checked="checked" value="0" name="actauto_email"/>手动<br/>
{/if}
<font color="808080">抄　　送：</font>
<input type="checkbox" value="{$ROW.autoact_email_cc}" {$AUTOACT_EMAIL_CC_CHECKED} name="autoact_email_cc"/>抄送自己<br/>
<font color="808080">发 件 人：</font>
{if $ROW.autoact_email_rt =='0'}
	<input type="radio" checked="checked" name="autoact_email_rt" value="0"/>
    企业统一邮件地址    
    <input type="radio" name="autoact_email_rt" value="1"/>
    执行人邮件地址<br/>
{else}
	<input type="radio" name="autoact_email_rt" value="0"/>
    企业统一邮件地址    
    <input type="radio" checked="checked" name="autoact_email_rt" value="1"/>
    执行人邮件地址<br/>
{/if}

<font color="808080">邮件标题：</font>
<input type="edit" value="{$ROW.autoact_email_bt}" size="50" name="autoact_email_bt"/><br/>　　　　
　<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);">支持通配符 </span><br/>
<font color="808080"><span style="vertical-align: top;">邮件内容：</span></font>
<textarea cols="60" name="autoact_email_sm" rows="5" style="width:100%"/>{$ROW.autoact_email_sm}</textarea>
<font color="999999"><br/>　　　　　
<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:会员名称$membername$</span></font>