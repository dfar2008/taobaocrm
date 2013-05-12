<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
{include file='Buttons_List1.tpl'}

{*<!-- Contents -->*}
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
   <tr>


	<td class="showPanelBg" valign=top width=100%>
	     {*<!-- PUBLIC CONTENTS STARTS-->*}
	     <div class="small" style="padding-left:20px;padding-right:20px">

		<form name="EditView" method="POST" action="index.php" >
		<input type="hidden" name="module" value="{$MODULE}">
		<input type="hidden" name="record" value="{$ID}">
		<input type="hidden" name="mode" value="{$MODE}">
		<input type="hidden" name="action">
		<input type="hidden" name="parenttab" value="{$CATEGORY}">
		<input type="hidden" name="return_module" value="{$RETURN_MODULE}">
		<input type="hidden" name="return_id" value="{$RETURN_ID}">
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
							<!-- General details -->
							       
								<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
								  
								  
									   <tr>									
										<td colspan=2 class="detailedViewHeader">
											<b>基本信息</b>									
										</td>
									   </tr>
                                        <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         客户
                                         </td>
                                        <td class="dvtCellInfo" align="left" width="30%">
                                       &nbsp;{$account_name}
                                        <input type="hidden" value="{$account_id}" id="account_id" name="account_id"/>
                                        </td>
                                    </tr>
                                     <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         启动SFA方案
                                         </td>
                                        <td class="dvtCellInfo" align="left" width="30%">
                                       &nbsp; {$sfasettingname}
                                        <input type="hidden" value="{$sfasettingsid}" id="sfasettingsid" name="sfasettingsid"/>
                                        </td>
                                    </tr>
									 <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                            <font color="red">*</font>
                                            标题
                                         </td>
                                        <td class="dvtCellInfo" align="left" width="30%">
                                           <input id="sfalistname"  type="text"  value="" size="25" style="color:#999" tabindex="1" name="sfalistname">*(为空时,自动生成序列编号)
                                        </td>
                                    </tr>
                                   	 <tr>
                                         <td class="dvtCellLabel" align="right" width="20%">
                                         基准日期
                                         </td>
                                        <td class="dvtCellInfo" align="left" width="30%">
                                      <input type="text" size="12"  value="{$fsdate}" id="jscal_field_fsdate" name="fsdate" readonly="readonly"/>  
                                  <img id="jscal_trigger_fsdate" src="themes/softed/images/calendar.gif">
									<script type="text/javascript">
                                    Calendar.setup ({ldelim}
                                    inputField : "jscal_field_fsdate", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_fsdate", singleClick : true, step : 1
                                    {rdelim})
                                    </script>
                                        </td>
                                    </tr>
                                    
                                   
								  
								   <tr>
									<td  colspan=2 style="padding:5px">
									   <div align="center">
										<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="crmbutton small save" onclick="this.form.action.value='Save'; return checkChongfu();" type="button" name="savebutton" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " style="width:70px" >
                                                     
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
function checkChongfu(){
	var sfalistsid = document.EditView.record.value; 
	var sfalistname = document.getElementById("sfalistname").value;
	new Ajax.Request(
			'index.php',
			{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:"module=Sfalists&action=SfalistsAjax&file=Save&ajax=true&sfalistsid="+sfalistsid+"&sfalistname="+sfalistname,
			onComplete: function(response) {
			result = response.responseText; 
					if(result == 'FAILED') {
						alert("标题重复");
						return false;	
					}else if(result == 'SUCCESS'){
						document.EditView.submit();
					}
				}
			}
		)		
}
{/literal}
</script>