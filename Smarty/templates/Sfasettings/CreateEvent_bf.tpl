 <table class="small" width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr style="background:#DFEBEF;height:27px;">
            <td class="moduleName" nowrap="" style="padding-left:10px;padding-right:50px">
             SFA &gt;&gt;
              <a class="hdrLink" href="index.php?action=ListView&module=Sfasettings&parenttab=sfa">方案设置</a>
               &gt;&gt;
               新增SFA事件
             </td>
        </tr>
        <tr>
       		 <td style="height:2px"></td>
        </tr>
      </tbody>
    </table>
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
   <tr>


	<td class="showPanelBg" valign=top width=100%>
	     {*<!-- PUBLIC CONTENTS STARTS-->*}
	     <div class="small" style="padding-left:20px;padding-right:20px">

		<form name="EditView" method="POST" action="index.php">
		<input type="hidden" name="module" value="{$MODULE}">
		<input type="hidden" name="record" value="{$ID}">
		<input type="hidden" name="mode" value="{$MODE}">
		<input type="hidden" name="action">
		<input type="hidden" name="parenttab" value="{$CATEGORY}">
		<input type="hidden" name="return_module" value="{$RETURN_MODULE}">
		<input type="hidden" name="return_id" value="{$RETURN_ID}">
		<input type="hidden" name="return_action" value="{$RETURN_ACTION}">
		<input type="hidden" name="return_viewname" value="{$RETURN_VIEWNAME}">

		{*<!-- Account details tabs -->*}
		<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
		   <tr>
			<td>
				<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
				   <tr>
	
	                 <td class="dvtTabCache" style="width:65%">&nbsp;</td>					
				   <tr>
				</table>
			</td>
		   </tr>
		   <tr>
			<td valign=top align=left >

			    <!-- Basic Information Tab Opened -->
			    <div id="basicTab">

				<table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
				   <tr>
					<td align=left>
					<!-- content cache -->
					
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						   <tr>
							<td id ="autocom"></td>
						   </tr>
						   <tr>
							<td style="padding-left:10px;padding-right:10px;padding-bottom:10px">
							
								<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
								  
								   <tr>
									<td  colspan=6 style="padding:5px">
									   <div align="center">
										<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';  return {$validateFunction}()" type="submit" name="button" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >
                                                                 		<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " style="width:70px">
									   </div>
									</td>
								   </tr>

                                   <tr>									
                                    <td colspan=6 class="detailedViewHeader">
                                        <b>SFA事件设计</b>									
                                    </td>
                                   </tr>
                                  <tr>
                                   <td class="dvtCellLabel" align="right"  colspan="3">
                                    <font color="red">*</font>
                                    事件名称
                                    </td>
                                    <td class="dvtCellInfo" align="left" width="80%"  colspan="3">
                                    <input id="sj"   type="text" name="sj" value=""  style="width:200px;" >
									&nbsp;(同一方案内不可以重名、且不得超过8个汉字)</td>
                                  </tr>
                                    
                                 <tr>
                                   <td class="dvtCellLabel" align="right"  colspan="3">
                                    <font color="red">*</font>
                                    执行日期
                                    </td>
                                    <td class="dvtCellInfo" align="left" width="30%"  colspan="3">
                                    <br/>
                                   <input type="radio" checked="" name="tt" value="0"/>
                                   <font color="#CC6699">【无 日 期】</font>不限定日期<br/>
                                  <input type="radio" name="tt" value="1"/>
                                  <font color="#CC6699">【绝对日期】</font>开始日期
                                   <font color="#CC6699">                
                                  <input type="text" size="12" onclick="event.cancelBubble=true;showCalendar('tp11_cal',false,'tp11_cal');" value="" id="tp11_cal" name="tp11"/>  
                                  </font>结束日期 <font color="#CC6699">
                                  <input size="12" onclick="event.cancelBubble=true;showCalendar('tp21_cal',false,'tp21_cal');" value="" id="tp21_cal" name="tp21"/> <br/>            
                                  </font>
                                  <input type="radio" name="tt" value="2"/>
                                  <font color="#CC6699">【相对日期】</font>于基准日期             
                                  <font color="#CC6699"><input value="" size="2" name="tp12"/> </font>天后开始，持续             
                                  <input value="" size="2" name="tp22"/>   天结束 
                                  <br/>
                                  <input type="radio" name="tt" value="3"/>
                                  <font color="#CC6699">【循　　环】</font>于基准日期             
                                  <input value="" size="2" name="tp33"/>  天后，每 <input value="" size="2" name="tp13"/>             
                                  天开始1次，持续 <input value="" size="2" name="tp43"/>          
                                  天结束；循环             
                                  <input value="" size="2" name="tp23"/>次<br/><font color="#808080">
                                  说明：基准日期0天后=基准日期当天；持续1天=当天结束；基准日期(  
                                  )天后，写负值为几天前</font><br><br>
									</td>
                                  </tr>
                                 <tr>
                                   <td class="dvtCellLabel" align="right"  colspan="3" rowspan="4">
                                    <font color="red">*</font>
                                    执行动作
                                    </td>
                                    <td class="dvtCellInfo" align="left" width="10%" >
                                    <input type="radio" name="at" checked="" value="manual"/>
                                    <font color="#3366FF"><b>具体事务</b></font>
                                    </td>
                                   <td class="dvtCellInfo" align="left"  colspan="2" >
                                    <input type="hidden" value="0" name="actauto_manual"/>
                                    <font color="999999">手动执行</font> <br/>
                                    <span style="vertical-align: top;"><font color="999999">事务明细：</font></span>
                                    <textarea cols="60" name="autoact_manual_sm" rows="5" style="width:60%"></textarea>
                                   </td>
                                   </tr>
                                    <tr>
                                    <td class="dvtCellInfo" align="left" width="10%" >
                                    <input type="radio" name="at" value="sms"/>
                                    <font color="#3366FF"><b>发短信</b></font>
                                    </td>
                                   <td class="dvtCellInfo" align="left"  colspan="2" >
                                    <input type="radio" name="actauto_sms" value="1"/>自动  
                                    <input type="radio" checked="" value="0" name="actauto_sms"/>手动<br/>
                                    <font color="808080">短信通道：</font>
                                    <input type="radio" name="autoact_sms_rt" checked="" value="8"/>0591通道
                                     <input type="radio" name="autoact_sms_rt" value="9"/>022通道 <br/>
                                     <font color="808080">发送时间：</font>开始日期当天的
                                     <select size="1" name="autoact_sms_tt">
                                     <option>08:00</option>
                                     <option>08:30</option>
                                     <option>09:00</option>
                                     <option>09:30</option>
                                     <option selected="">10:00</option>
                                     <option>10:30</option>
                                     <option>11:00</option>
                                     <option>11:30</option>
                                     <option>12:00</option>
                                     <option>12:30</option>
                                     <option>13:00</option>
                                     <option>13:30</option>
                                     <option>14:00</option>
                                     <option>14:30</option>
                                     <option>15:00</option>
                                     <option>15:30</option>
                                     <option>16:00</option>
                                     <option>16:30</option>
                                     <option>17:00</option>
                                     <option>17:30</option>
                                     <option>18:00</option>
                                     <option>18:30</option>
                                     <option>19:00</option>
                                     <option>19:30</option>
                                     <option>20:00</option>
                                     </select><br/>　　　　
                                     　<font color="808080">(发送时间仅在自动执行时生效，且于执行日凌晨即自动发送定时短信)</font><br/>
                                     <font color="808080"><span style="vertical-align: top;">短信内容：</span></font>
                                     <textarea cols="60" name="autoact_sms_sm" rows="5" style="width:60%"/></textarea><br/>　　　　　
                                     <span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:联系人姓名$name$;客户名称$comname$; </span>
                                    
                                   <tr>
                                    <td class="dvtCellInfo" align="left" width="10%" >
                                    <input type="radio" name="at" value="email"/><font color="#3366FF"><b>发邮件(免费)</b></font>
                                    </td>
                                   <td class="dvtCellInfo" align="left"  colspan="2" >
                                    <input type="hidden" value="0" name="actauto_email"/>
                                    <font color="999999">手动执行</font><br/>
                                    <font color="808080">抄　　送：</font>
                                    <input type="checkbox" value="1" name="autoact_email_cc"/>抄送自己<br/>
                                    <font color="808080">发 件 人：</font>
                                    <input type="radio" checked="" name="autoact_email_rt" value="0"/>
                                    企业统一邮件地址(<a target="_BLANK" href="/sfatool/setup/setup.xt?func=sfa_email">设置</a>)      
                                    <input type="radio" name="autoact_email_rt" value="1"/>
                                    执行人邮件地址(<a target="_BLANK" href="/usetup/inishow.xt?func=email">设置</a>)<br/>
                                    <font color="808080">邮件标题：</font>
                                    <input type="edit" value="" size="50" name="autoact_email_bt"/><br/>　　　　
                                  　<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 支持通配符 </span><br/>				<font color="808080">信纸模板：</font>
                                  <select name="autoact_email_mb">
                                  <option value="12">SFA空白信纸</option>
                                  <option value="13">SFA简约灰色信纸</option>
                                  <option value="14">SFA简约蓝色信纸</option>
                                  </select><br/>　　　　
                                  　<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 信纸可在SFA系统设置中增加 </span><br/><font color="808080"><span style="vertical-align: top;">邮件内容：</span></font>
                                  <textarea cols="60" name="autoact_email_sm" rows="5" style="width:60%"/></textarea>
                                  <font color="999999"><br/>　　　　　
                                  <span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:客户名称$comname$;联系人姓名$name$;称谓$app$ </span></font>
                                  
                                   <tr>
                                    <td class="dvtCellInfo" align="left" width="10%" >
                                  <input type="radio" name="at" value="bemail"/><font color="#3366FF"><b>发邮件(付费)</b></font>
                                  </td>
                                   <td class="dvtCellInfo" align="left"  colspan="2" >
                                  <input type="radio" name="actauto_bemail" value="1"/>自动  
                                  <input type="radio" checked="" value="0" name="actauto_bemail"/>手动<br/>
                                  <font color="CC6699">每封邮件花费充值点数<b>10</b>点，执行后进入智能发信队列，自动发送(<a href="/help/bmail.html" target="_blank">详细</a>)</font><br/><font color="808080">抄　　送：</font>
                                  <input type="checkbox" value="1" name="autoact_bemail_cc"/>抄送自己<br/>
                                  <font color="808080">发 件 人：</font>
                                  <input type="radio" checked="" name="autoact_bemail_rt" value="0"/>企业统一邮件地址(<a target="_BLANK" href="/sfatool/setup/setup.xt?func=sfa_email">设置</a>)      
                                  <input type="radio" name="autoact_bemail_rt" value="1"/>执行人邮件地址(<a target="_BLANK" href="/usetup/inishow.xt?func=email">设置</a>)<br/>
                                  <font color="808080">邮件标题：</font>
                                  <input type="edit" value="" size="50" name="autoact_bemail_bt"/><br/>　　　　
                                  　<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 支持通配符 </span><br/><font color="808080">信纸模板：</font>
                                  <select name="autoact_bemail_mb">
                                  <option value="12">SFA空白信纸</option>
                                  <option value="13">SFA简约灰色信纸</option>
                                  <option value="14">SFA简约蓝色信纸</option>
                                  </select><br/>　　　　　
                                  <span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 信纸可在SFA系统设置中增加 </span><br/><font color="808080">
                                  <span style="vertical-align: top;">邮件内容：</span></font>
                                  <textarea cols="60" name="autoact_bemail_sm" rows="5" style="width:60%"/></textarea>
                                  <font color="999999"><br/>　　　　
                                  　<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:客户名称$comname$;联系人姓名$name$;称谓$app$ </span></font>
									</td>
                                  </tr>
                                    
                                    <tr>
                                    <td colspan="6">
									   <div align="center">
										<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save';  return {$validateFunction}()" type="submit" name="button" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >
                                                                		<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " style="width:70px">
									   </div>
									</td>
								   </tr>
								</table>
							</td>
						   </tr>
						</table>
					</td>
				   </tr>
				</table>
					
			    </div>
			    <!-- Basic Information Tab Closed -->  

			</td>
		   </tr>
		</table>
	     </div>
	</td>
   </tr>
</table>
</form>

<script>
        var fieldname = new Array({$VALIDATION_DATA_FIELDNAME})
        var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL})
        var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE})
</script>