function set_return(product_id, product_name) {
        window.opener.document.EditView.parent_name.value = product_name;
        window.opener.document.EditView.parent_id.value = product_id;
}
function set_return_specific(product_id, product_name, mode) {

        //getOpenerObj used for DetailView 
        var fldName = getOpenerObj("salesorder_name");
        var fldId = getOpenerObj("salesorder_id");
        fldName.value = product_name;
        fldId.value = product_id;
	if(mode != 'DetailView' && window.opener.document.EditView.convertmode != undefined)
	{
		    window.opener.document.EditView.action.value = 'EditView';
        	window.opener.document.EditView.convertmode.value = 'update_so_val';
        	window.opener.document.EditView.submit();
	}
}
function set_return_formname_specific(formname, product_id, product_name) {
        window.opener.document.EditView1.purchaseorder_name.value = product_name;
        window.opener.document.EditView1.purchaseorder_id.value = product_id;
}

//Function used to add a new product row in PO, SO, Quotes and Invoice
var gatherRowCnt = 0;
function fnAddGatherRow(image_path,amount,plandate){
	gatherRowCnt ++;
	var tableName = document.getElementById('gatherTab');
	var prev = tableName.rows.length;
	var count = eval(prev)-1;//As the table has two headers, we should reduce the count
	//alert(count);
	if(amount == 0) {
		var temp1 = 0.0;
		for(var i=0;i<count;i++) {
			if(document.getElementById("gatheramount"+i).value != '') {
				amount_i = document.getElementById("gatheramount"+i).value;
				temp1 += parseFloat(amount_i);
			}
		}
		amount = roundValue(eval(parseFloat(document.CreateGathers.total.value)-temp1));
		if(amount <= 0) {
			alert(alert_arr.COLLECTION_TOTAL_EQUAL_SALESORDER_TOTAL);
			return "";
		}
	}
	var gathertimes = 0;
	for(var i=0;i<count;i++) {
			if(document.getElementById("gatheramount"+i).value != '') {
				gathertimes ++;
			}
	}
	gathertimes ++;
	var row = tableName.insertRow(prev);
	row.id = "row"+count;
	row.style.verticalAlign = "top";
	
	var colone = row.insertCell(0);
	//colone.width = "15%";
	var coltwo = row.insertCell(1);
	//coltwo.width = "15%";
	var colthree = row.insertCell(2);
	//coltwo.width = "35%";
	var colfour = row.insertCell(3);
	//coltwo.width = "35%";
	

	
	//Delete link
	colone.className = "crmTableRow small";
	colone.innerHTML='<img src="'+image_path+'delete.gif" border="0" onclick="deleteGatherRow('+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';

	coltwo.className = "crmTableRow small"
	coltwo.innerHTML= '<input id="gathertimes'+count+'" size=5 name="gathertimes'+count+'" value="'+gathertimes+'" type="text">';

	colthree.className = "crmTableRow small"
	colthree.innerHTML= '<input id="gatheramount'+count+'" size=10 name="gatheramount'+count+'" value="'+amount+'" type="text">';	

	colfour.className = "crmTableRow small"
	colfour.innerHTML= '<input id="jscal_field_gatherdate'+count+'" size=10 name="gatherdate'+count+'" value="'+plandate+'" type="text"><img src="'+image_path+'calendar.gif" id="jscal_trigger_gatherdate'+count+'"><font size=1><em old="(yyyy-mm-dd)">(yyyy-mm-dd)</em></font><script id="gather'+count+'">getCalendarPopup("jscal_trigger_gatherdate'+count+'","jscal_field_gatherdate'+count+'","%Y-%m-%d");</script>';

	eval($("gather"+count).innerHTML);
	document.CreateGathers.gatherplancount.value = count;
	//alert(document.CreateGathers.gatherplancount.value);
}

function deleteGatherRow(i)
{
	gatherRowCnt--;
	var tableName = document.getElementById('gatherTab');
	var prev = tableName.rows.length;
//	document.getElementById('proTab').deleteRow(i);
	document.getElementById("row"+i).style.display = 'none';
	document.getElementById("gathertimes"+i).value = "";
	document.getElementById("gatheramount"+i).value = "";
	document.getElementById("jscal_field_gatherdate"+i).value = "";
	
}

function verify_data(form) {
	//var tableName = document.getElementById('gatherTab');
	//var prev = tableName.rows.length;
	//alert(prev);
	var gathercount = document.CreateGathers.gatherplancount.value;
	//var gathercount = gatherRowCnt;
	
	var temp = 0.0;
	/*
	for (i=0;i<document.CreateGathers.elements.length;i++){
		curname = document.CreateGathers.elements[i].name;
		if(curname.indexOf("gatheramount") > -1) {
			alert(curname);
			alert($(curname).value );
		}
		
	}
	*/
	for(var i=0;i<=gathercount;i++) {
		//alert($("gatheramount"+i).value);
		if(document.getElementById("row"+i).style.display == 'none') continue;
		if($("gatheramount"+i).value == "" || $("gatheramount"+i).value == 0) {
			alert(alert_arr.COLLECTION_IS_NULL);
			return false;
		}
		if($("gathertimes"+i).value == "" || $("gathertimes"+i).value == 0) {
			alert(alert_arr.COLLECTION_TIMES_IS_NULL);
			return false;
		}
		if($("jscal_field_gatherdate"+i).value == "") {
			alert(alert_arr.COLLECTION_DATE_IS_NULL);
			return false;
		}
		var x = dateValidate("jscal_field_gatherdate"+i,alert_arr.COLLECTION_DATE,"GECD");
		if(!x) return x;
		x = numValidate("gatheramount"+i,alert_arr.COLLECTION,"any");
		if(!x) return x;
		x = numValidate("gathertimes"+i,alert_arr.COLLECTION_TIMES,"any");
		if(!x) return x;
		temp = eval(temp*1+ parseFloat($("gatheramount"+i).value));
	}
	/*
	var flag = true;
	for(var i=0;i<=gathercount;i++) {

		for(var j=i+1;j<=gathercount;j++) {
			alert($("gathertimes"+i).value);
			alert($("gathertimes"+j).value);
			if($("gathertimes"+i).value >= $("gathertimes"+j).value) {
				alert("请填写正确的期次！");
				//$("gathertimes"+j).focus();
				return false;
			}
			if($("jscal_field_gatherdate"+i).value > $("jscal_field_gatherdate"+j).value) {
			//if(dateComparison("jscal_field_gatherdate"+i,"前面的日期","jscal_field_gatherdate"+j,"后面的日期","LE")) {
				alert("请填写正确的日期！");
				$("jscal_field_gatherdate"+j).focus();
				return false;
			}			
		}
	}
	*/
	var total = parseFloat($("total").value);
	//alert(total);
	//alert(temp);
	if(temp < total) {
		alert(alert_arr.COLLECTION_TOTAL_NOT_EQUAL_SALESORDER_TOTAL);
		return false;
	}

	if(temp > total) {
		alert(alert_arr.COLLECTION_TOTAL_NOT_EQUAL_SALESORDER_TOTAL);
		return false;
	}
	return true;	
}

function selectProductRows(form)
{
	window.open("index.php?module=Products&action=PopupForSO&html=Popup_picker&popuptype=inventory_prods&select=enable","productWin","width=740,height=565,resizable=1,scrollbars=1,status=1,top=150,left=200");	
}

function UpdateIDString()
{
	x = document.selectall.selected_id.length;
	var y=0;	
	var idstring = document.selectall.idlist.value;
	namestr = ""; 
	if ( x == undefined)
	{
		if(document.selectall.selected_id != undefined) {
		        //单条记录
		        if(document.selectall.selected_id.checked) {
				var idvalue = document.selectall.selected_id.value;				
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
					}
				}
				
			} else {
				var idvalue = document.selectall.selected_id.value+";";
				idstring = idstring.replace(idvalue,"");
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
					}
				}
				
			} else {
				var idvalue = document.selectall.selected_id[i].value+";";
				idstring = idstring.replace(idvalue,"");
			}
			y=y+1;
		}
	}
	if (y != 0)
	{
		document.selectall.idlist.value = idstring;
	}
	else
	{
		alert(alert_arr.SELECT);
		return false;
	}
	//alert(idstring);

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
function addMultiProductRow(module) 
{   
	UpdateIDString(); 
	var idlist = document.selectall.idlist.value;
	
	new Ajax.Request(
		  'index.php',
		  {queue: {position: 'end', scope: 'command'},
					method: 'post',
					postBody:"module=Products&action=ProductsAjax&file=getProductsByModule&ajax=true&idlist="+ encodeURIComponent(idlist)+"&basemodule="+encodeURIComponent(module),
					onComplete: function(response) {
							result = response.responseText; 
							productarr = JSON.parse(result);
							for (var j = eval(productarr.length-1); j > -1; j--) {
								addProductRow(productarr[j]);
							}
							window.close();
							
					}
			 }
    );
}
function addProductRow(productrow) 
{
	var fieldlist = productrow["fieldlist"];
	var module = window.opener.document.EditView.module.value;
	var tableName = window.opener.document.getElementById('proTab');
	var prev = tableName.rows.length;
	var count = eval(prev)-1;
	var row = tableName.insertRow(prev);
	row.id = "row"+count;
	row.style.verticalAlign = "top";
	var colone = row.insertCell(0);
	colone.className = "crmTableRow small";
	colone.innerHTML='<img src="themes/softed/images/delete.gif" border="0" onclick="deleteRow(\''+module+'\','+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';
	var coli;
	for (var i=0;i<fieldlist.length;i++) {
		rowvalue = productrow[fieldlist[i]];
		if(rowvalue == null) rowvalue = "";
		coli = row.insertCell(i+1);		
		if(fieldlist[i] == "productname") {
			coli.className = "crmTableRow small";
			coli.innerHTML= '<input id="productName'+count+'" name="productName'+count+'" class="small" value="' + rowvalue + '" readonly="readonly" type="text"><input id="hdnProductId'+count+'" name="hdnProductId'+count+'" value="'+ productrow["productid"] +'" type="hidden">';
		} else {
			coli.className = "crmTableRow small tdnowrap";
			coli.innerHTML= '&nbsp;' + rowvalue;
		}		
	}
	i = i + 1;
	coli = row.insertCell(i);		
	coli.className = "crmTableRow small";
	coli.innerHTML='<input id="qty'+count+'" name="qty'+count+'" type="text" class="small " style="width:50px" onfocus="this.className=\'detailedViewTextBoxOn\'" onBlur="FindDuplicate(); settotalnoofrows();calcTotal();" value=""/>';
	i = i + 1;
    coli = row.insertCell(i);
	//listprice
	coli.className = "crmTableRow small";
	coli.innerHTML= '<input id="listPrice'+count+'" name="listPrice'+count+'" type="text" class="small " style="width:70px" onfocus="this.className=\'detailedViewTextBoxOn\'" onBlur="FindDuplicate(); settotalnoofrows();calcTotal();" value="'+ productrow["listprice"] +'"/>&nbsp;';	

	//comments
	i = i + 1;
    coli = row.insertCell(i);
	coli.className = "crmTableRow small";
	coli.innerHTML='<input id="comment'+count+'" name="comment'+count+'" class=small style="width:150px">';

    i = i + 1;
    coli = row.insertCell(i);
	coli.className = "crmTableRow small";
	temp = '<table width="100%" cellpadding="0" cellpadding="5"><tr><td style="padding:5px;" id="productTotal'+count+'" align="right">0.00</td></tr>';
	temp += '</table>';
	temp += '<span style="display:none;font-size:12px;" id="netPrice'+count+'" ><b>&nbsp;</b></span>';
	coli.innerHTML = temp;
}


//This function is used to validate the Inventory modules 
function validateInventory(module) 
{
	if(!formValidate())
		return false

	var max_row_count = document.getElementById('proTab').rows.length;
	var row_count = 0;
	max_row_count = eval(max_row_count)-2;//As the table has two header rows, we will reduce two from table row length
	if(max_row_count == 0)
	{
		alert(alert_arr.NO_PRODUCT_SELECTED);
		return false;
	}

	if(!FindDuplicate())
		return false;
	settotalnoofrows();
	calcGrandTotal();

	for (var i=1;i<=max_row_count;i++) 
	{
		//if the row is deleted then avoid validate that row values
		if(document.getElementById("deleted"+i).value == 1)
			continue;

		if (!emptyCheck("productName"+i,alert_arr.LBL_PRODUCT,"text")) return false;
		if (!emptyCheck("qty"+i,alert_arr.LBL_QTY,"text")) return false;
		if (!numValidate("qty"+i,alert_arr.LBL_QTY,"any")) return false;
		if (!numConstComp("qty"+i,alert_arr.LBL_QTY,"G","0")) return false;
		if (!emptyCheck("listPrice"+i,alert_arr.LBL_LISTPRICE,"text")) return false;
		if (!numValidate("listPrice"+i,alert_arr.LBL_LISTPRICE,"any")) return false; 
		
		row_count ++;
	}

	if(row_count == 0)
	{
		alert(alert_arr.NO_PRODUCT_SELECTED);
		return false;
	}

	//Product - Discount validation - not allow negative values
	//if(!validateProductDiscounts())
	//	return false;

	//Final Discount validation - not allow negative values
	discount_checks = document.getElementsByName("discount_final");

	//Percentage selected, so validate the percentage
	if(discount_checks[1].checked == true)
	{
		temp = /^(0|[1-9]{1}\d{0,})(\.(\d{1}\d{0,}))?$/.test(document.getElementById("discount_percentage_final").value);
		if(!temp)
		{
			alert(alert_arr.VALID_FINAL_PERCENT);
			return false;
		}
	}
	if(discount_checks[2].checked == true)
	{
		temp = /^(0|[1-9]{1}\d{0,})(\.(\d{1}\d{0,}))?$/.test(document.getElementById("discount_amount_final").value);
		if(!temp)
		{
			alert(alert_arr.VALID_FINAL_AMOUNT);
			return false;
		}
	}

	//Shipping & Handling validation - not allow negative values
	temp = /^(0|[1-9]{1}\d{0,})(\.(\d{1}\d{0,}))?$/.test(document.getElementById("shipping_handling_charge").value);
	if(!temp)
	{
		alert(alert_arr.VALID_SHIPPING_CHARGE);
		return false;
	}

	//Adjustment validation - allow negative values
	temp = /^-?(0|[1-9]{1}\d{0,})(\.(\d{1}\d{0,}))?$/.test(document.getElementById("adjustment").value)
	if(!temp)
	{
		alert(alert_arr.VALID_ADJUSTMENT);
		return false;
	}
	var buttonsave = $$('.save');
	var count = buttonsave.length;
	for(var i=0;i<count;i++){
		buttonsave[i].disabled = "disabled";
	}
	document.EditView.submit();
	return true;    
}

function FindDuplicate()
{
	var max_row_count = document.getElementById('proTab').rows.length;
        max_row_count = eval(max_row_count)-2;//As the table has two header rows, we will reduce two from row length

	var duplicate = false, iposition = '', positions = '', duplicate_products = '';

	var product_id = new Array(max_row_count-1);
	var product_name = new Array(max_row_count-1);
	product_id[1] = getObj("hdnProductId"+1).value;
	product_name[1] = getObj("productName"+1).value;
	for (var i=1;i<=max_row_count;i++)
	{
		iposition = ""+i;
		for(var j=i+1;j<=max_row_count;j++)
		{
			if(i == 1)
			{
				product_id[j] = getObj("hdnProductId"+j).value;
			}
			if(product_id[i] == product_id[j] && product_id[i] != '')
			{
				if(!duplicate) positions = iposition;
				duplicate = true;
				if(positions.search(j) == -1) positions = positions+" & "+j;

				if(duplicate_products.search(getObj("productName"+j).value) == -1)
					duplicate_products = duplicate_products+getObj("productName"+j).value+" \n";
			}
		}
	}
	if(duplicate)
	{
		//alert("You have selected < "+duplicate_products+" > more than once in line items  "+positions+".\n It is advisable to select the product just once but change the Qty. Thank You");
		if(!confirm(alert_arr.SELECTED_MORE_THAN_ONCE+"\n"+duplicate_products+"\n "+alert_arr.WANT_TO_CONTINUE))
			return false;
	}
        return true;
}

function fnshow_Hide(Lay){
    var tagName = document.getElementById(Lay);
   	if(tagName.style.display == 'none')
   		tagName.style.display = 'block';
	else
		tagName.style.display = 'none';
}

function deleteRow(module,i)
{
	rowCnt--;
	var tableName = document.getElementById('proTab');
	var prev = tableName.rows.length;
//	document.getElementById('proTab').deleteRow(i);
	document.getElementById("row"+i).style.display = 'none';
	document.getElementById("hdnProductId"+i).value = "";
	//document.getElementById("productName"+i).value = "";
	document.getElementById('deleted'+i).value = 1;
    if(module != ""){//changed by dingjianting on 2007-2-25 for gloso project and quote
		calcTotal();
	}
}
/*  End */



function calcTotal() {

	var max_row_count = document.getElementById('proTab').rows.length;
	max_row_count = eval(max_row_count)-2;//Because the table has two header rows. so we will reduce two from row length
	var netprice = 0.00;
	for(var i=1;i<=max_row_count;i++)
	{
		rowId = i;
		
		if(document.getElementById('deleted'+rowId).value == 0)
		{
			
			var total=eval(getObj("qty"+rowId).value*getObj("listPrice"+rowId).value);
			getObj("productTotal"+rowId).innerHTML=roundValue(total.toString());			
			getObj("netPrice"+rowId).innerHTML=roundValue(total.toString())

		}
	}
	calcGrandTotal()
}

function calcGrandTotal() {
	var netTotal = 0.0, grandTotal = 0.0;
	var discountTotal_final = 0.0, finalTax = 0.0, sh_amount = 0.0, sh_tax = 0.0, adjustment = 0.0;

	//var taxtype = document.getElementById("taxtype").value;

	var max_row_count = document.getElementById('proTab').rows.length;
	max_row_count = eval(max_row_count)-2;//Because the table has two header rows. so we will reduce two from row length

	for (var i=1;i<=max_row_count;i++) 
	{
		if(document.getElementById('deleted'+i).value == 0)
		{
			
			if (document.getElementById("netPrice"+i).innerHTML=="") 
				document.getElementById("netPrice"+i).innerHTML = 0.0
			if (!isNaN(document.getElementById("netPrice"+i).innerHTML))
				netTotal += parseFloat(document.getElementById("netPrice"+i).innerHTML)
		}
	}
//	alert(netTotal);
	document.getElementById("netTotal").innerHTML = netTotal;
	document.getElementById("subtotal").value = netTotal;

	discountTotal_final = document.getElementById("discountTotal_final").innerHTML;
	if(discountTotal_final != "") {
		netTotal = eval(netTotal - discountTotal_final);
	}


	sh_amount = eval(netTotal*getObj("shipping_handling_charge").value/100);
	sh_amount = roundValue(sh_amount.toString());

	adjustment = getObj("adjustment").value

	//Add or substract the adjustment based on selection
	adj_type = document.getElementById("adjustmentType").value;
	if(adj_type == '+')
		//grandTotal = eval(netTotal)-eval(discountTotal_final)+eval(finalTax)+eval(sh_amount)+eval(sh_tax)+eval(adjustment)
	    grandTotal = eval(netTotal)+eval(sh_amount)+eval(adjustment)
	else
		//grandTotal = eval(netTotal)-eval(discountTotal_final)+eval(finalTax)+eval(sh_amount)+eval(sh_tax)-eval(adjustment)
		grandTotal = eval(netTotal)+eval(sh_amount)-eval(adjustment)

	document.getElementById("grandTotal").innerHTML = roundValue(grandTotal.toString())
	document.getElementById("total").value = roundValue(grandTotal.toString())
}

//Method changed as per advice by jon http://forums.vtiger.com/viewtopic.php?t=4162
function roundValue(val) {
   val = parseFloat(val);
   val = Math.round(val*100)/100;
   val = val.toString();
   
   if (val.indexOf(".")<0) {
      //val+=".00"
   } else {
      var dec=val.substring(val.indexOf(".")+1,val.length)
      if (dec.length>2)
         val=val.substring(0,val.indexOf("."))+"."+dec.substring(0,2)
      else if (dec.length==1)
         val=val+"0"
   }
   
   
   return val;
} 

function settotalnoofrows() {
	var max_row_count = document.getElementById('proTab').rows.length;
        max_row_count = eval(max_row_count)-2;

	//set the total number of products
	document.EditView.totalProductCount.value = max_row_count;	
}

function setDiscount(currObj,curr_row)
{
	var discount_checks = new Array();

	discount_checks = document.getElementsByName("discount"+curr_row);

	if(discount_checks[0].checked == true)
	{
		document.getElementById("discount_type"+curr_row).value = 'zero';
		document.getElementById("discount_percentage"+curr_row).style.visibility = 'hidden';
		document.getElementById("discount_amount"+curr_row).style.visibility = 'hidden';
		document.getElementById("discountTotal"+curr_row).innerHTML = 0.00;
	}
	if(discount_checks[1].checked == true)
	{
		document.getElementById("discount_type"+curr_row).value = 'percentage';
		document.getElementById("discount_percentage"+curr_row).style.visibility = 'visible';
		document.getElementById("discount_amount"+curr_row).style.visibility = 'hidden';

		var discount_amount = 0.00;
		//This is to calculate the final discount
		if(curr_row == '_final')
		{
			discount_amount = eval(document.getElementById("netTotal").innerHTML)*eval(document.getElementById("discount_percentage"+curr_row).value)/eval(100);
		}
		else//This is to calculate the product discount
		{
			discount_amount = eval(document.getElementById("productTotal"+curr_row).innerHTML)*eval(document.getElementById("discount_percentage"+curr_row).value)/eval(100);
		}

		document.getElementById("discountTotal"+curr_row).innerHTML = discount_amount;
	}
	if(discount_checks[2].checked == true)
	{
		document.getElementById("discount_type"+curr_row).value = 'amount';
		document.getElementById("discount_percentage"+curr_row).style.visibility = 'hidden';
		document.getElementById("discount_amount"+curr_row).style.visibility = 'visible';
		document.getElementById("discountTotal"+curr_row).innerHTML = document.getElementById("discount_amount"+curr_row).value;
	}

	calcTotal();
}

function validateProductDiscounts()
{
	var max_row_count = document.getElementById('proTab').rows.length;
	max_row_count = eval(max_row_count)-2;//As the table has two header rows, we will reduce two from table row length

	for(var i=1;i<=max_row_count;i++)
	{
		//if the row is deleted then avoid validate that row values
		if(document.getElementById("deleted"+i).value == 1)
			continue;

		discount_checks = document.getElementsByName("discount"+i);

		//Percentage selected, so validate the percentage
		if(discount_checks[1].checked == true)
		{
			temp = /^(0|[1-9]{1}\d{0,})(\.(\d{1}\d{0,}))?$/.test(document.getElementById("discount_percentage"+i).value);
			if(!temp)
			{
				alert(alert_arr.VALID_DISCOUNT_PERCENT);
				return false;
			}
		}
		if(discount_checks[2].checked == true)
		{
			temp = /^(0|[1-9]{1}\d{0,})(\.(\d{1}\d{0,}))?$/.test(document.getElementById("discount_amount"+i).value);
			if(!temp)
			{
				alert(alert_arr.VALID_DISCOUNT_AMOUNT);
				return false;
			}
		}
	}
	return true;
}

// Function to Get the price for all the products of an Inventory based on the Currency choosen by the User
function updatePrices() {
	
	var prev_cur = document.getElementById('prev_selected_currency_name');
	var inventory_currency = document.EditView.currency;
	if(confirm(alert_arr.MSG_CHANGE_CURRENCY_REVISE_UNIT_PRICE)) {	
		var current_currency = "";
		var prev_currency = "";
		if (prev_cur != null && inventory_currency != null) {
			current_currency = inventory_currency.value;
			prev_currency = prev_cur.value;
			prev_cur.value = inventory_currency.value;
			//Retrieve all the prices for all the products in currently selected currency
			new Ajax.Request(
				'index.php',
				{queue: {position: 'end', scope: 'command'},
					method: 'post',
					postBody: 'module=Products&action=ProductsAjax&file=InventoryPriceAjax&current_currency='+current_currency+'&prev_currency='+prev_currency,
					onComplete: function(response)
						{
							//alert(response.responseText);
							if(trim(response.responseText).indexOf('SUCCESS') == 0) {
								var res = trim(response.responseText).split("$");
								updatePriceValues(res[1]);							
							} else {
								alert(alert_arr.ERROR);
							}			
						}
				}
			);
		}
	} else {
		if (prev_cur != null && inventory_currency != null)
			inventory_currency.value = prev_cur.value;
	}
}

// Function to Update the price for the products in the Inventory Edit View based on the Currency choosen by the User.
function updatePriceValues(rate) {
	
	if (rate == null || rate == '') return;	
	var productsListElem = document.getElementById('proTab');
	if (productsListElem == null) return;
	
	var max_row_count = productsListElem.rows.length;
	max_row_count = eval(max_row_count)-2;//Because the table has two header rows. so we will reduce two from row length

    var products_list = "";
	for(var i=1;i<=max_row_count;i++)
	{
		var list_price_elem = document.getElementById("listPrice"+i);
		list_price_elem.value = roundValue(eval(list_price_elem.value*rate));
	}
    calcTotal();
}

function combine(){
    var select_options  =  document.getElementsByName('selected_id');
    var x = select_options.length;
    var viewid =getviewId();
    idstring = "";
    var ids=[];
    xx = 0;
    for(i = 0; i < x ; i++)
    {
            if(select_options[i].checked)
            {
                ids.push(select_options[i].value);
                xx++
            }
    }
    if (xx != 0)
    {
        idstring="("+ids.join(",")+")";
    }
    else
    {
            alert(alert_arr.SELECT);
            return false;
    }

    new Ajax.Request(
                      'index.php',
                        {queue: {position: 'end', scope: 'command'},
                                method: 'post',
                                postBody:"action=PurchaseOrderAjax&file=CombineFromSalesOrder&module=PurchaseOrder&parenttab=Buy&idstring="+encodeURIComponent(idstring),
                                onComplete: function(response) {
                                          //alert(response.responseText);
                                          eval(response.responseText);
                                }
                         }
        );
}

function priceBookPickList(currObj, row_no) {
	var trObj=currObj.parentNode.parentNode
	var rowId=row_no;//parseInt(trObj.id.substr(trObj.id.indexOf("w")+1,trObj.id.length))
	window.open("index.php?module=PriceBooks&action=Popup&html=Popup_picker&form=EditView&popuptype=inventory_pb&fldname=listPrice"+rowId+"&productid="+getObj("hdnProductId"+rowId).value,"priceBookWin","width=640,height=565,resizable=0,scrollbars=0,top=150,left=200");
}