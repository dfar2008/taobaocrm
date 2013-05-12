 <script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
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
		<input type="hidden" name="action" value="SaveEvent">
		<input type="hidden" name="parenttab" value="sfa">
		<input type="hidden" name="return_module" value="{$RETURN_MODULE}">
		<input type="hidden" name="sfasettingsid" value="{$sfasettingsid}">
		<input type="hidden" name="return_action" value="{$RETURN_ACTION}">

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
										<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="return checkForm();" type="button" name="savebutton" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >
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
                                  <input type="text" size="12"  value="" id="jscal_field_tp11" name="tp11" readonly="readonly"/>  
                                  <img id="jscal_trigger_tp11" src="themes/softed/images/calendar.gif">
									<script type="text/javascript">
                                    Calendar.setup ({ldelim}
                                    inputField : "jscal_field_tp11", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_tp11", singleClick : true, step : 1
                                    {rdelim})
                                    </script>
                                  
                                  </font>结束日期 <font color="#CC6699">
                                  <input type="text" size="12" value="" id="jscal_field_tp21" name="tp21" readonly="readonly"/>
                                  <img id="jscal_trigger_tp21" src="themes/softed/images/calendar.gif">
									<script type="text/javascript">
                                    Calendar.setup ({ldelim}
                                    inputField : "jscal_field_tp21", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_tp21", singleClick : true, step : 1
                                    {rdelim})
                                    </script>
                                   <br/>            
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
                                   <td class="dvtCellLabel" align="right"  colspan="3" rowspan="3">
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
                                     <font color="808080">发送时间：</font>开始日期当天的
                                     <select size="1" name="autoact_sms_tt">
                                  	 	 {$autoact_sms_tt_html_1}
                                     </select><br/>　　　　
                                     　<font color="808080">(发送时间仅在自动执行时生效，且于执行日凌晨即自动发送定时短信)</font><br/>
                                     <font color="808080"><span style="vertical-align: top;">短信内容：</span></font>
                                     <textarea cols="60" name="autoact_sms_sm" rows="5" style="width:60%"/></textarea><br/>　　　　　
                                     <span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:会员名称$membername$; </span>
                                    
                                   <tr>
                                    <td class="dvtCellInfo" align="left" width="10%" >
                                    <input type="radio" name="at" value="email"/><font color="#3366FF"><b>发邮件</b></font>
                                    </td>
                                   <td class="dvtCellInfo" align="left"  colspan="2" >
                                    <input type="radio" name="actauto_email" value="1"/>自动  
                                    <input type="radio" checked="" value="0" name="actauto_email"/>手动<br/>
                                    <font color="808080">抄　　送：</font>
                                    <input type="checkbox" value="0" name="autoact_email_cc"/>抄送自己<br/>
                                    <font color="808080">发 件 人：</font>
                                    <input type="radio" checked="" name="autoact_email_rt" value="0"/>
                                    企业统一邮件地址    
                                    <input type="radio" name="autoact_email_rt" value="1"/>
                                    执行人邮件地址<br/>
                                    <font color="808080">邮件标题：</font>
                                    <input type="edit" value="" size="50" name="autoact_email_bt"/><br/>　　　　
                                  　<span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);">支持通配符 </span><br/>
                                  <font color="808080"><span style="vertical-align: top;">邮件内容：</span></font>
                                  <textarea cols="60" name="autoact_email_sm" rows="5" style="width:60%"/></textarea>
                                  <font color="999999"><br/>　　　　　
                                  <span style="background-color: rgb(102, 170, 255); color: rgb(255, 255, 255);"> 通配符:会员名称$membername$;</span></font>
                                  
                                  
                                    
                                    <tr>
                                    <td colspan="6">
									   <div align="center">
										<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="return checkForm();" type="button" name="savebutton" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >
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
		
		
{literal}
function checkForm(){
	var sfasettingsid = document.EditView.sfasettingsid.value;
	//事件名称
	var sj = document.EditView.sj.value;
	if(sj==''){
		alert("事件名称不能为空");
		document.EditView.sj.focus();
		return false;
	}
	var sj_length = countCharacters(sj);
	if(sj_length > 16){
		alert("事件名称不能超过8个字");
		document.EditView.sj.focus();
		return false;
	}
	
	
	//执行日期
	var tt =  getCheckedValue("tt");
	if(tt == 1){
		var tp11 = document.EditView.tp11.value;
		var tp21 = document.EditView.tp21.value;
		if(tp11 ==''){
			alert("【绝对日期】开始日期不能为空");
			return false;
		}
		if(tp21 ==''){
			alert("【绝对日期】结束日期不能为空");
			return false;
		}
		if(tp21 < tp11){
			alert("【绝对日期】结束日期不能小于开始日期");
			return false;
		}
	}
	
	if(tt == 2){
		var tp22 = document.EditView.tp22.value;
		if(tp22 =='' || tp22 <1){
			alert("【相对日期】持续时间不能为空且最小为1天(即当天结束)");
			return false;
		}
	}
	if(tt == 3){
		var tp13 = document.EditView.tp13.value;
		if(tp13 =='' || tp13 <1){
			alert("【循　　环】间隔时间不能为空且最小为1天");
			return false;
		}
		var tp23 = document.EditView.tp23.value;
		if(tp23 >48){
			alert("【循　　环】最多循环次数为48次");
			return false;
		}
		var tp43 = document.EditView.tp43.value;
		if(tp43 =='' || tp43 <1){
			alert("【循　　环】持续时间不能为空且最小为1天(即当天结束)");
			return false;
		}
	}
	
	//执行动作
	var at =  getCheckedValue("at");
	if(at =='manual'){
		var autoact_manual_sm = document.EditView.autoact_manual_sm.value;
		if(autoact_manual_sm ==''){
			alert("事物明细不能为空");
			document.EditView.autoact_manual_sm.focus();
			return false;
		}
	}
	if(at =='sms'){
		var autoact_sms_sm = document.EditView.autoact_sms_sm.value;
		if(autoact_sms_sm ==''){
			alert("短信内容不能为空");
			document.EditView.autoact_sms_sm.focus();
			return false;
		}
	}
	if(at =='email'){
		var autoact_email_cc_checkbox   = document.getElementsByName("autoact_email_cc");
		if(autoact_email_cc_checkbox[0].checked){
			autoact_email_cc_checkbox[0].value = "1";
		}
		var autoact_email_bt = document.EditView.autoact_email_bt.value;
		if(autoact_email_bt ==''){
			alert("邮件标题不能为空");
			document.EditView.autoact_email_bt.focus();
			return false;
		}
		var autoact_email_sm = document.EditView.autoact_email_sm.value;
		if(autoact_email_sm ==''){
			alert("邮件内容不能为空");
			document.EditView.autoact_email_sm.focus();
			return false;
		}
	}
	
	new Ajax.Request(
			'index.php',
			{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:"module=Sfasettings&action=SfasettingsAjax&file=SaveEvent&ajax=true&sj="+sj+"&sfasettingsid="+sfasettingsid,
			onComplete: function(response) {
			result = response.responseText; 
					if(result.indexOf('FAILED') != '-1') {
						alert("事件名称重复");
						return false;	
					}else if(result.indexOf('SUCCESS') != '-1'){
						document.EditView.submit();
					}
				}
			}
		)	
	
}

//计算包含英文与汉字的字符串长度
function countCharacters(str){
    var totalCount = 0; 
    for (var i=0; i<str.length; i++) { 
        var c = str.charCodeAt(i); 
        if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) { 
             totalCount++; 
         }else {     
             totalCount+=2; 
         } 
     }
    // alert(totalCount);
    return totalCount;
}
//
function getCheckedValue(name){
	var checkboxs=document.getElementsByName(name);
	for (var i=0;i<checkboxs.length;i++)
	{
		if(checkboxs[i].checked == true){
			return 	checkboxs[i].value;
		}
	}
}
{/literal}		
</script>