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

<link href="swfupload/css/default2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="swfupload/js/swfupload.js"></script>
<script type="text/javascript" src="swfupload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="swfupload/js/fileprogress.js"></script>
<script type="text/javascript" src="swfupload/js/handlers.js"></script>
<script type="text/javascript">

{literal}
var upload1, upload2;

window.onload = function() {
	upload1 = new SWFUpload({
		// Backend Settings
		upload_url: "modules/Import/upload1.php",	// Relative to the SWF file (or you can use absolute paths)
		post_params: {"PHPSESSID" : ""},

		
		// File Upload Settings
		file_size_limit : "2048",	// 2MB
		file_types : "*.csv",
		file_types_description : "All Files",
		file_upload_limit : "1",
		file_queue_limit : "0",

		// Event Handler Settings (all my handlers are in the Handler.js file)
		file_dialog_start_handler : fileDialogStart,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,

		// Button Settings
		button_image_url : "swfupload/images/XPButtonUploadText_61x22.png",
		button_placeholder_id : "spanButtonPlaceholder1",
		button_width: 61,
		button_height: 22,
		
		// Flash Settings
		flash_url : "swfupload/swf/swfupload.swf",
		

		custom_settings : {
			progressTarget : "fsUploadProgress1",
			cancelButtonId : "btnCancel1"
		},
		
		// Debug Settings
		debug: false
	});

	upload2 = new SWFUpload({
		// Backend Settings
		upload_url: "modules/Import/upload2.php",	// Relative to the SWF file (or you can use absolute paths)
		post_params: {"PHPSESSID" : ""},

		// File Upload Settings
		file_size_limit : "2048",	// 30MB
		file_types : "*.csv",
		file_types_description : "All Files",
		file_upload_limit : "1",
		file_queue_limit : "0",

		// Event Handler Settings (all my handlers are in the Handler.js file)
		file_dialog_start_handler : fileDialogStart,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,

		// Button Settings
		button_image_url : "swfupload/images/XPButtonUploadText_61x22.png",
		button_placeholder_id : "spanButtonPlaceholder2",
		button_width: 61,
		button_height: 22,
		
		// Flash Settings
		flash_url : "swfupload/swf/swfupload.swf",

		swfupload_element_id : "flashUI2",		// Setting from graceful degradation plugin
		degraded_element_id : "degradedUI2",	// Setting from graceful degradation plugin

		custom_settings : {
			progressTarget : "fsUploadProgress2",
			cancelButtonId : "btnCancel2"
		},

		// Debug Settings
		debug: false
	});

}

 {/literal}
</script>


<!-- header - level 2 tabs -->
{include file='Buttons_List.tpl'}	

<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%" class="small">
   <tr>
	<td class="showPanelBg" valign="top" width="100%">

		<table  cellpadding="0" cellspacing="0" width="100%" border=0>
		   <tr>
			<td width="75%" valign=top>
				<form enctype="multipart/form-data" name="Import" method="POST" action="index.php">
				<input type="hidden" name="module" value="{$MODULE}">
				<input type="hidden" name="step" value="1">
				<input type="hidden" name="source" value="{$SOURCE}">
				<input type="hidden" name="source_id" value="{$SOURCE_ID}">
				<input type="hidden" name="action" value="Import">
				<input type="hidden" name="return_module" value="{$RETURN_MODULE}">
				<input type="hidden" name="return_id" value="{$RETURN_ID}">
				<input type="hidden" name="return_action" value="{$RETURN_ACTION}">
				<input type="hidden" name="parenttab" value="{$CATEGORY}">
				<input type="hidden" name="filename" id="filename" value="">
                
				<!-- IMPORT LEADS STARTS HERE  -->
				<br />
				<table align="center" cellpadding="5" cellspacing="0" width="95%" class="mailClient importLeadUI small" border="0">
                
				   <tr>
					<td colspan="2" height="50" valign="middle" align="left" class="mailClientBg  genHeaderSmall">{$MOD.LBL_MODULE_NAME}{$APP.$MODULE}</td>
				   </tr>
				  
				  
				   <tr ><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
				   <tr >
					
					<td align="center" valign="top" >
						<!--<input type="file" name="userfile1"  size="40"   class=small/>&nbsp;-->
                       <div>
						<div class="fieldset flash" id="fsUploadProgress1">
							<span class="legend">{$MOD.LBL_FILE_ORDERLIST}(Max:2MB)</span>
						</div>
						<div style="padding-left: 90px;" align="left">
							<span id="spanButtonPlaceholder1"></span>
							<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
							<br />
						</div>
					</div>
					
					<td align="center" valign="top" >
						<!--<input type="file" name="userfile2"  size="40"   class=small/>&nbsp;-->
                		<div>
						<div class="fieldset flash" id="fsUploadProgress2">
							<span class="legend">{$MOD.LBL_FILE_ORDERDETAIL}(Max:2MB)</span>
						</div>
						<div style="padding-left: 90px;" align="left">
                        	
							<span id="spanButtonPlaceholder2"></span>
							<input id="btnCancel2" type="button" value="Cancel Uploads" onclick="cancelQueue(upload2);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
							<br />
						</div>
					</div>
					</td>
				   </tr>
				  
				   <tr ><td colspan="2" height="50"  style="padding-left: 90px; color:#F00" >备注:1.若不能上传文件，请刷新本页面即可。2.文件请尽量保持淘宝下载原样(文件名及内容)，不宜改动，造成编码错误。)</td></tr>
				    <tr >
						<td colspan="2" align="right" style="padding-right:40px;" class="reportCreateBottom">
							<input title="{$MOD.LBL_NEXT}" accessKey="" class="crmButton small save" type="submit" name="button" value="  {$MOD.LBL_NEXT} &rsaquo; "  onclick="this.form.action.value='Import';this.form.step.value='2'; ">
						</td>
				   </tr>				</form>
				 </table>
				<br>
				<!-- IMPORT LEADS ENDS HERE -->
			</td>
		   </tr>
		</table>

	</td>
   </tr>
</table>
<br>
