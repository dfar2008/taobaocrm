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

<link rel="stylesheet" type="text/css" href="{$THEME_PATH}style.css">
<script language="JavaScript" type="text/javascript" src="include/js/general.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/{php} echo $_SESSION['authenticated_user_language'];{/php}.lang.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
<body class="small" marginwidth=0 marginheight=0 leftmargin=0 topmargin=0 bottommargin=0 rigthmargin=0>
<div id="createproduct_div" style="display:block;position:absolute;left:225px;top:200px;"></div>
<div id="status" style="position:absolute;display:none;left:100px;top:95px;height:27px;white-space:nowrap;"><img src="{$IMAGE_PATH}status.gif"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			
			<table width="100%" cellpadding="3" cellspacing="0" border="0"  class="homePageMatrixHdr">
				<tr>
					<td style="padding:10px;" >
						<form name="basicSearch" action="index.php" onSubmit="return false;">
						<table width="100%" cellpadding="5" cellspacing="0">
						<tr>
							<td width="20%" class="dvtCellLabel"><img src="{$IMAGE_PATH}basicSearchLens.gif"></td>
							<td width="30%" class="dvtCellLabel">							<select name ="search_field" class="txtBox">
											 {html_options  options=$SEARCHLISTHEADER }
											</select> &nbsp;</td>
							<td width="30%" class="dvtCellLabel">
							        <input type="text" name="search_text" class="txtBox" onKeyDown="javascript:if(event.keyCode==13) callSearch('Basic')">
								<input type="hidden" name="searchtype" value="BasicSearch">
								<input type="hidden" name="module" value="{$MODULE}">
								<input type="hidden" name="action" value="PopupForPandian">
								<input type="hidden" name="query" value="true">
								
								<input type="hidden" name="curr_row" id="curr_row" value="{$CURR_ROW}">
								<input type="hidden" name="fldname_pb" value="{$FIELDNAME}">
								<input type="hidden" name="productid_pb" value="{$PRODUCTID}">
								<input name="popuptype" id="popup_type" type="hidden" value="{$POPUPTYPE}">
								<input name="recordid" id="recordid" type="hidden" value="{$RECORDID}">
								<input name="return_module" id="return_module" type="hidden" value="{$RETURN_MODULE}">
								<input name="from_link" id="from_link" type="hidden" value="{$smarty.request.fromlink.value}">
								<input id="viewname" name="viewname" type="hidden" value="{$VIEWID}">
			
							</td>
							<td width="20%" class="dvtCellLabel">
								<input type="button" name="search" value=" &nbsp;{$APP.LBL_SEARCH_NOW_BUTTON}&nbsp; " onClick="callSearch('Basic');" class="crmbutton small create">
								{if $CREATE_PERMISSION eq "permitted"}
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="button" name="create" value=" &nbsp;{$APP.LNK_NEW_PRODUCT}&nbsp; " onClick="callCreateProductDiv();" class="crmbutton small create">
								{/if}
							</td>
						</tr>
						 <tr>
							<td colspan="4" align="center">
								<table width="100%" class="small">
								<tr>	
									{$ALPHABETICAL}
								</tr>
								</table>
							</td>
						</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" style="padding-right:5px;padding-top:2px;padding-bottom:2px;">
			  <tr>
			  <td><img src="themes/images/filter.png" border=0></td>
			  <td>{$APP.LBL_VIEW}
			  {foreach name="listviewforeach" key=id item=viewname from=$CUSTOMVIEW_OPTION}

					{if $id eq $VIEWID} 
					<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">
					&nbsp;&nbsp;<a class="cus_markbai tablink" href="javascript:;" onclick="javascript:getTabView('{$MODULE}','viewname={$id}',this,{$id});">{$viewname}</a>&nbsp;&nbsp;
					</span>
					{else}
					<span style="padding-right:5px;padding-top:5px;padding-bottom:5px;">
					&nbsp;&nbsp;<a class="cus_markhui tablink" href="javascript:;" onclick="javascript:getTabView('{$MODULE}','viewname={$id}',this,{$id});">{$viewname}</a>&nbsp;&nbsp;
					</span>
					{/if}
			  {/foreach}
			  </td>
			  </tr>
			</table>
		       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="small">
		       <tr><td valign="top" width="15%">
		               {include file="Products/CatalogPopupForPandian.tpl"}
		       </td>
		       <td width=70% align="left" valign=top style="border-left:2px dashed #cccccc;padding:13px">
			<div id="ListViewContents">
				{include file="Products/PopupContentsForPandian.tpl"}
			</div>
			</td>
			</tr>
			</table>
		</td>
	</tr>
	
</table>
</body>
<script>
var gPopupAlphaSearchUrl = '';
function callSearch(searchtype)
{ldelim}
    for(i=1;i<=26;i++)
    {ldelim}
        var data_td_id = 'alpha_'+ eval(i);
        getObj(data_td_id).className = 'searchAlph';
    {rdelim}
    gPopupAlphaSearchUrl = '';
    search_fld_val= document.basicSearch.search_field[document.basicSearch.search_field.selectedIndex].value;
    search_txt_val=document.basicSearch.search_text.value;
    var urlstring = '';
    if(searchtype == 'Basic')
    {ldelim}
	urlstring = 'search_field='+search_fld_val+'&searchtype=BasicSearch&search_text='+search_txt_val;
    {rdelim}
	popuptype = $('popup_type').value;
	urlstring += '&popuptype='+popuptype;
	urlstring = urlstring +'&query=true&file=PopupForPandian&module=Products&action=ProductsAjax&ajax=true';
	urlstring +=gethiddenelements();
	new Ajax.Request(
		'index.php',
		{ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
				method: 'post',
				postBody: urlstring,
				onComplete: function(response) {ldelim}
					$("ListViewContents").innerHTML= response.responseText;
					setSelectedProductRow();
				{rdelim}
			{rdelim}
		);
{rdelim}	
function alphabetic(module,url,dataid)
{ldelim}
    document.basicSearch.search_text.value = '';	
    for(i=1;i<=26;i++)
    {ldelim}
	var data_td_id = 'alpha_'+ eval(i);
	getObj(data_td_id).className = 'searchAlph';
    {rdelim}
    getObj(dataid).className = 'searchAlphselected';
    gPopupAlphaSearchUrl = '&'+url;	
    var urlstring ="module="+module+"&action="+module+"Ajax&file=PopupForPandian&ajax=true&"+url;
    urlstring +=gethiddenelements();
    new Ajax.Request(
                'index.php',
                {ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
                                method: 'post',
                                postBody: urlstring,
                                onComplete: function(response) {ldelim}
                                        $("ListViewContents").innerHTML= response.responseText;
					setSelectedProductRow();
				{rdelim}
			{rdelim}
		);
{rdelim}
function gethiddenelements()
{ldelim}
	var urlstring=''	
	if(getObj('select_enable').value != '')
		urlstring +='&select=enable';	
	if(document.getElementById('curr_row').value != '')
		urlstring +='&curr_row='+document.getElementById('curr_row').value;	
	if(getObj('fldname_pb').value != '')
		urlstring +='&fldname='+getObj('fldname_pb').value;	
	if(getObj('productid_pb').value != '')
		urlstring +='&productid='+getObj('productid_pb').value;	
	if(getObj('recordid').value != '')
		urlstring +='&recordid='+getObj('recordid').value;	
	var return_module = document.getElementById('return_module').value;
	if(return_module != '')
		urlstring += '&return_module='+return_module;
	var idlist = document.selectall.idlist.value;
	var productlist = document.selectall.productlist.value;
	urlstring = urlstring + "&idlist=" + idlist;
	urlstring = urlstring + "&productlist=" + productlist;
	if(getObj('vendor_id').value != '')
		urlstring +='&vendor_id='+getObj('vendor_id').value;

	return urlstring;
{rdelim}
																									
function getListViewEntries_js(module,url)
{ldelim}
	popuptype = document.getElementById('popup_type').value;
        var urlstring ="module="+module+"&action="+module+"Ajax&file=PopupForPandian&ajax=true&"+url;
    	urlstring +=gethiddenelements();
	//search_fld_val= document.basicSearch.search_field[document.basicSearch.search_field.selectedIndex].value;
	search_fld_val= document.selectall.search_field.value;
	//search_txt_val=document.basicSearch.search_text.value;
	search_txt_val=document.selectall.search_text.value;
    	if(search_txt_val != '')
		urlstring += '&query=true&search_field='+search_fld_val+'&searchtype=BasicSearch&search_text='+search_txt_val;
	if(gPopupAlphaSearchUrl != '')
		urlstring += gPopupAlphaSearchUrl;	
	else
		urlstring += '&popuptype='+popuptype;
	new Ajax.Request(
                'index.php',
                {ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
                                method: 'post',
                                postBody: urlstring,
                                onComplete: function(response) {ldelim}
                                        $("ListViewContents").innerHTML= response.responseText;
					setSelectedProductRow();
				{rdelim}
			{rdelim}
		);
{rdelim}

function getListViewWithPageNo(module,pageElement)
{ldelim}
	//var pageno = document.getElementById('listviewpage').value;
	var pageno = pageElement.options[pageElement.options.selectedIndex].value;
	getListViewEntries_js(module,'start='+pageno);
{rdelim}
function getListViewWithPageSize(module,pageElement)
{ldelim}
	//var pageno = document.getElementById('listviewpage').value;
	var pagesize = pageElement.options[pageElement.options.selectedIndex].value;
	getListViewEntries_js(module,'pagesize='+pagesize);
{rdelim}

function getListViewSorted_js(module,url)
{ldelim}
        var urlstring ="module="+module+"&action="+module+"Ajax&file=PopupForPandian&ajax=true"+url;
	new Ajax.Request(
                'index.php',
                {ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
                                method: 'post',
                                postBody: urlstring,
                                onComplete: function(response) {ldelim}
                                        $("ListViewContents").innerHTML= response.responseText;
					setSelectedProductRow();
				{rdelim}
			{rdelim}
		);
{rdelim}

{literal}
function UpdateIDString()
{
	x = document.selectall.selected_id.length;
	var y=0;	
	var idstring = document.selectall.idlist.value;
	var productstring = document.selectall.productlist.value;
	namestr = "";
	if ( x == undefined)
	{
		if(document.selectall.selected_id != undefined) {
		        //单条记录
		        if(document.selectall.selected_id.checked) {
				var idvalue = document.selectall.selected_id.value;
				var qtyinstock = $("qtyinstock_"+idvalue).value;
				/*
				if(alert_arr.IS_ZERO_QTYINSTOCK == "1") {
					if(qtyinstock < 1) {
						alert("库存数量为0，不能下订单！");
						document.selectall.selected_id.checked = false;
						return false;
					}
				}
				*/
				
				var id_arr = idstring.split(';');
				var flag = false;
				for (var j = 0; j < id_arr.length; j++) {
					if(idvalue == id_arr[j])
					{
						flag = true;
						break;
					}								
				}
			        if(!flag) {
				        var repeated = false;
				        var selectedProductsLength = opener.window.document.forms['EditView'].elements.length;
					for(var m=0;m<selectedProductsLength;m++) {
						if(opener.window.document.forms['EditView'].elements[m].name.indexOf('hdnProductId') > -1) {
							tmpProductID = opener.window.document.forms['EditView'].elements[m].name;
							tmpProductIndex = tmpProductID.substring(12);
							
							if(opener.window.document.forms['EditView'].elements["deleted"+tmpProductIndex].value == 0 && opener.window.document.forms['EditView'].elements[m].value == idvalue) {
								alert(alert_arr.PRODUCT_SELECTED);
								document.selectall.selected_id.checked = false;
								repeated = true;
								break;
							}
						}
					}
					if(!repeated) {
						if(idstring != "") {
							idstring = idstring + ";" + idvalue;
						} else {
							idstring = idvalue;
						}
						//format:productid#productname#productcode#listprice#qtyinstock
						var productname = $("productname_"+idvalue).value;
						var productcode = $("productcode_"+idvalue).value;
						var listprice = $("listprice_"+idvalue).value;
						qtyinstock = $("qtyinstock_"+idvalue).value;
						if(productstring != "") {
							productstring = productstring + ";" + idvalue + "##" + productname + "##" + productcode + "##" + listprice + "##" + qtyinstock;
						} else {
							productstring = idvalue + "##" + productname + "##" + productcode + "##" + listprice + "##" + qtyinstock;
						}
					}
				}
				
			} else {
				var idvalue = document.selectall.selected_id.value+";";
				idstring = idstring.replace(idvalue,"");
				idvalue = document.selectall.selected_id.value;
				//format:productid#productname#productcode#listprice#qtyinstock
				var productname = $("productname_"+idvalue).value;
				var productcode = $("productcode_"+idvalue).value;
				var listprice = $("listprice_"+idvalue).value;
				var qtyinstock = $("qtyinstock_"+idvalue).value;
				
				productvalue = idvalue + "##" + productname + "##" + productcode + "##" + listprice + "##" + qtyinstock + ";";
				productstring = productstring.replace(productvalue,"");
			}
			y=y+1;
			
		}
		//return false;
	}
	else
	{
	        //多条记录
		y=0;
		for(i = 0; i < x ; i++)
		{
			if(document.selectall.selected_id[i].checked)
			{
			    var idvalue = document.selectall.selected_id[i].value;
				var qtyinstock = $("qtyinstock_"+idvalue).value;
				/*
				if(alert_arr.IS_ZERO_QTYINSTOCK == "1") {
					if(qtyinstock < 1) {
						alert("库存数量为0，不能下订单！");
						document.selectall.selected_id[i].checked = false;
					}
				}
				*/
				var id_arr = idstring.split(';');
				var flag = false;
				for (var j = 0; j < id_arr.length; j++) {
					if(idvalue == id_arr[j])
					{
						flag = true;
						break;
					}								
				}
			        if(!flag) {
				        var repeated = false;
				        var selectedProductsLength = opener.window.document.forms['EditView'].elements.length;
					for(var m=0;m<selectedProductsLength;m++) {
						if(opener.window.document.forms['EditView'].elements[m].name.indexOf('hdnProductId') > -1) {
							tmpProductID = opener.window.document.forms['EditView'].elements[m].name;
							tmpProductIndex = tmpProductID.substring(12);
							
							if(opener.window.document.forms['EditView'].elements["deleted"+tmpProductIndex].value == 0 && opener.window.document.forms['EditView'].elements[m].value == idvalue) {
								alert(alert_arr.PRODUCT_SELECTED);
								document.selectall.selected_id[i].checked = false;
								repeated = true;
								break;
							}
						}
					}
					if(!repeated) {
					        if(idstring != "") {
							idstring = idstring + ";" + idvalue;
						} else {
							idstring = idvalue;
						}
						//format:productid#productname#productcode#listprice#qtyinstock
						var productname = $("productname_"+idvalue).value;
						var productcode = $("productcode_"+idvalue).value;
						var listprice = $("listprice_"+idvalue).value;
						qtyinstock = $("qtyinstock_"+idvalue).value;						
						if(productstring != "") {
							productstring = productstring + ";" + idvalue + "##" + productname + "##" + productcode + "##" + listprice + "##" + qtyinstock;
						} else {
							productstring = idvalue + "##" + productname + "##" + productcode + "##" + listprice + "##" + qtyinstock;
						}
					}
				}
				
			} else {
				var idvalue = document.selectall.selected_id[i].value+";";
				idstring = idstring.replace(idvalue,"");
				idvalue = document.selectall.selected_id[i].value;
				//format:productid#productname#productcode#listprice#qtyinstock
				var productname = $("productname_"+idvalue).value;
				var productcode = $("productcode_"+idvalue).value;
				var listprice = $("listprice_"+idvalue).value;
				var qtyinstock = $("qtyinstock_"+idvalue).value;
				
				productvalue = idvalue + "##" + productname + "##" + productcode + "##" + listprice + "##" + qtyinstock + ";";
				productstring = productstring.replace(productvalue,"");

			}
			y=y+1;
		}
	}
	if (y != 0)
	{
		document.selectall.idlist.value = idstring;
		document.selectall.productlist.value = productstring;
	}
	else
	{
		alert(alert_arr.SELECT);
		return false;
	}
	//alert(productstring);

}

function setSelectedProductRow()
{
	var idlist = document.selectall.idlist.value;
	var id_arr = idlist.split(';');
	x = document.selectall.selected_id.length;
	if ( x != undefined) {
		for(var i = 0; i < x ; i++)
		{
			for (var j = 0; j < id_arr.length; j++) {
			        
				if(document.selectall.selected_id[i].value == id_arr[j])
				{
					document.selectall.selected_id[i].checked = true;
				}								
			}
			
		}
	} else {
	        if(document.selectall.selected_id != undefined) {
			for (var j = 0; j < id_arr.length; j++) {			        
				if(document.selectall.selected_id.value == id_arr[j])
				{
					document.selectall.selected_id.checked = true;
				}								
			}
		}
	}
}

function addMultiProductRow()
{
	var idlist = document.selectall.idlist.value;
	var productstring = document.selectall.productlist.value;
	var id_arr = idlist.split(';');
	var product_arr = productstring.split(';');
	var module = window.opener.document.EditView.module.value;
	for (var j = 0; j < id_arr.length; j++) {
		if(id_arr[j] != "")
		{
		    var row = product_arr[j];
			var row_arr = row.split('##');
			//format:productid#productname#productcode#listprice#qtyinstock
			productrowid = row_arr[0];
			productname = row_arr[1];
			productcode = row_arr[2];
			listprice = row_arr[3];
			qtyinstock = row_arr[4];
			if(qtyinstock == "") qtyinstock = 0;
			var tableName = window.opener.document.getElementById('proTab');
			var prev = tableName.rows.length;
			var count = eval(prev)-1;
			var row = tableName.insertRow(prev);
			row.id = "row"+count;
			row.style.verticalAlign = "top";
			
			
			var colone = row.insertCell(0);
			var coltwo = row.insertCell(1);
			var colthree = row.insertCell(2);
			
			var colfour = row.insertCell(3);
			var colfive = row.insertCell(4);
			var colsix = row.insertCell(5);
			var colseven = row.insertCell(6);
			
			

			//id
			//colone.className = "crmTableRow small";
			//colone.innerHTML= count;

			//Delete link
			colone.className = "crmTableRow small";
			colone.innerHTML='<img src="themes/softed/images/delete.gif" border="0" onclick="deleteRow(\''+module+'\','+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';

			//Code
			coltwo.className = "crmTableRow small tdnowrap";
			coltwo.innerHTML= '<input id="productcode'+count+'" style="width:70px" name="productcode'+count+'" value="'+ productcode +'" readonly="readonly" type="text">';

			colthree.className = "crmTableRow small"
			colthree.innerHTML= '<input id="productName'+count+'" name="productName'+count+'" class="small" value="' + productname + '" readonly="readonly" type="text"><input id="hdnProductId'+count+'" name="hdnProductId'+count+'" value="'+ productrowid +'" type="hidden">';
			
			
			//qtyinstock
			
			colfour.className = "crmTableRow small";
			//colfour.innerHTML= '<input id="qtyinstock'+count+'" name="qtyinstock'+count+'" style="width:70px" onBlur="FindDuplicate(); settotalnoofrows();" value="'+ qtyinstock +'" type="text" readonly="readonly">';
			colfour.innerHTML= '<input id="qtyinstock'+count+'" name="qtyinstock'+count+'" style="width:70px" onBlur="FindDuplicate(); settotalnoofrows();" value="" type="text" readonly="readonly">';

			

			colfive.className = "crmTableRow small";
			colfive.innerHTML= '<input id="qtyinreal'+count+'" name="qtyinreal'+count+'" style="width:70px" onBlur="FindDuplicate(); settotalnoofrows();" value="" type="text">';

			colsix.className = "crmTableRow small";
			colsix.innerHTML= '<input id="qtyinmol'+count+'" name="qtyinmol'+count+'" style="width:70px" onBlur="FindDuplicate(); settotalnoofrows();" value="" type="text">';

			

			//comments
			colseven.className = "crmTableRow small";
			colseven.innerHTML='<input id="comment'+count+'" name="comment'+count+'" class=small style="width:100px">';

			if(window.opener.setMultiProductInfo){
				window.opener.setMultiProductInfo(productrowid,count);
			}
			

			


		}								
	}
}
{/literal}
</script>
