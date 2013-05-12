<table class="small" width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr style="background:#DFEBEF;height:27px;">
            <td class="moduleName" nowrap="" style="padding-left:10px;padding-right:50px">
             SFA &gt;&gt;
             事件操作
             </td>
        </tr>
        <tr>
       		 <td style="height:2px"></td>
        </tr>
      </tbody>
    </table>
{*<!-- Contents -->*}
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
   <tr>


	<td class="showPanelBg" valign=top width=100%>
	     {*<!-- PUBLIC CONTENTS STARTS-->*}
	     <div class="small" style="padding-left:20px;padding-right:20px">

		<form name="EditView" method="POST" action="index.php" onsubmit="return checkForm();">
		<input type="hidden" name="module" value="{$MODULE}">
		<input type="hidden" name="record" value="{$ID}">
		<input type="hidden" name="action">
		<input type="hidden" name="membername" value="{$ACC_ARR.membername}" />
        <input type="hidden" name="acc_phone" value="{$ACC_ARR.phone}" />
        <input type="hidden" name="acc_email" value="{$ACC_ARR.email}" />
        <input type="hidden" name="sfalistsid" value="{$ROW.sfalistsid}" />
        <input type="hidden" name="zt" value="{$ROW.zt}" />
        <input type="hidden" name="accountid" value="{$ROW.accountid}" />
        <input type="hidden" name="sfasettingsid" value="{$ROW.sfasettingsid}" />
        <input type="hidden" name="sj" value="{$ROW.sj}" />

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
							<!-- General details -->
							       
								<table border=0 cellspacing=0 cellpadding=0 width=100% class="small" style="line-height:25px;">
								  
									   <tr>									
										<td colspan=2 class="detailedViewHeader">
											<b>基本信息</b>									
										</td>
									   </tr>
                                        <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         SFA方案
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                       &nbsp;{$ROW.sfasettingname}
                                        </td>
                                       </tr>
                                         <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         SFA序列
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                       &nbsp;{$ROW.sfalistname}
                                        </td>
                                       </tr>
                                       <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         事件
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                       &nbsp;{$ROW.sj}
                                        </td>
                                       </tr>
                                     
                                   	 <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         开始日期
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                        {if $ROW.zt == '未执行' || $ROW.zt == '再次执行'}
                                     <input type="text" size="12"  value="{$ROW.datestart}" id="jscal_field_datestart" name="datestart" readonly="readonly"/>  
                                  <img id="jscal_trigger_datestart" src="themes/softed/images/calendar.gif">
									<script type="text/javascript">
                                    Calendar.setup ({ldelim}
                                    inputField : "jscal_field_datestart", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_datestart", singleClick : true, step : 1
                                    {rdelim})
                                    </script> 
                                 		{else}
                                        	{$ROW.datestart}
                                            <input type="hidden" name="datestart" value="{$ROW.datestart}"/>
                                        {/if}
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         结束日期
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                         {if $ROW.zt == '未执行' ||  $ROW.zt == '再次执行'}
                                     <input type="text" size="12"  value="{$ROW.dateend}" id="jscal_field_dateend" name="dateend" readonly="readonly"/>  
                                  <img id="jscal_trigger_dateend" src="themes/softed/images/calendar.gif">
									<script type="text/javascript">
                                    Calendar.setup ({ldelim}
                                    inputField : "jscal_field_dateend", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_dateend", singleClick : true, step : 1
                                    {rdelim})
                                    </script> 
                               			  {else}
                                        	{$ROW.dateend}
                                            <input type="hidden" name="dateend" value="{$ROW.dateend}"/>
                                        {/if}
                                        </td>
                                    </tr>
                                     <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         执行动作
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                        {if $ZXDZ != '无'}
                                        	&nbsp;{$ZXDZ}
                                        {else}
                                            {if $AT =='manual'}
                                                 {include file="Sfalists/Manual.tpl"}
                                            {elseif $AT =='sms'}
                                                 {include file="Sfalists/Sms.tpl"}
                                            {elseif $AT == 'email'}
                                                 {include file="Sfalists/Email.tpl"}
                                            {/if}
                                        {/if}
                                        <input type="hidden" value="{$ZXDZ}" name="zxdz"/>
                                        </td>
                                       </tr>
                                     <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         执行说明
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                       &nbsp;{$ZXSM}
                                       <input type="hidden" value="{$ZXSM}" name="zxsm"/>
                                        </td>
                                       </tr>
                                        <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         执行结果
                                         </td>
                                        <td class="dvtCellInfo" align="left" >
                                       &nbsp;{$ROW.zxjg}
                                       <input type="hidden" value="{$ROW.zxjg}" name="zxjg"/>
                                        </td>
                                       </tr>
                                     
									  
								  
								  
								   <tr>
									<td  colspan=2 style="padding:5px">
									   <div align="center">
                                       {if $ROW.zt =='未执行' || $ROW.zt =='再次执行'}
                                       
										<input  class="crmbutton small edit" onclick="this.form.action.value='SaveRunEvent'; " type="submit" name="SaveRunEvent" value="  修改事件  " style="width:70px" > &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input class="crmbutton small create" onclick="this.form.action.value='JumpRunEvent'; " type="submit" name="JumpRunEvent" value="  跳过事件  " style="width:70px" > &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input  class="crmbutton small delete" onclick="this.form.action.value='DoRunEvent'; " type="submit" name="DoRunEvent" value="  执行事件  " style="width:70px" > &nbsp; &nbsp; &nbsp; &nbsp;
                                       {/if}
                                       {if $ROW.zt =='执行失败'}
                                        <input class="crmbutton small create" onclick="this.form.action.value='JumpRunEvent'; " type="submit" name="JumpRunEvent" value="  跳过事件  " style="width:70px" > &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input  class="crmbutton small save" onclick="this.form.action.value='DoAgainRunEvent'; " type="submit" name="DoAgainRunEvent" value="  再次执行  " style="width:70px" > &nbsp; &nbsp; &nbsp; &nbsp;
                                       {/if}
                                       {if $ROW.zt =='跳过'}
										<input class="crmbutton small save" onclick="this.form.action.value='DoAgainRunEvent'; " type="submit" name="DoAgainRunEvent" value="  再次执行  " style="width:70px" > &nbsp; &nbsp; &nbsp; &nbsp;
                                       {/if}
                                      
                                      
                                        <input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="crmbutton small cancel" onclick="window.close()" type="button" name="button" value="  关闭  " style="width:70px">
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

<script  type="text/javascript" language="javascript">
{literal}
function checkForm(form){
	var at = document.EditView.at.value;
	if(at =='email'){
		var autoact_email_cc_checkbox   = document.getElementsByName("autoact_email_cc");
		if(autoact_email_cc_checkbox[0].value =='0'){
			if(autoact_email_cc_checkbox[0].checked){
				autoact_email_cc_checkbox[0].value = "1";
			}
		}
	}
	
	
	
	return true;
	
}
{/literal}
</script>
