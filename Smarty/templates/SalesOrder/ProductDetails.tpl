<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>
<script>  
function displayCoords(currObj,obj,mode,curr_row) 
{ldelim}
	document.getElementById("discount_div_title_final").innerHTML = '<b>' + alert_arr.Set_Discount_for + '</b>';
	document.getElementById(obj).style.display = "block";
{rdelim}
  
function doNothing(){ldelim}
{rdelim}

function fnHidePopDiv(obj){ldelim}
	document.getElementById(obj).style.display = 'none';
{rdelim}
</script>

<!-- Added this file to display and hanld the Product Details in Inventory module  -->

   <tr>
	<td colspan="4" align="left">



<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable" id="proTab">
   <tr>
	<td colspan="20" class="dvInnerHeader">
		<b>{$APP.LBL_PRODUCT_DETAILS}</b>
	</td>
   </tr>


   <!-- Header for the Product Details -->
   <tr valign="top">
	<td width=5% valign="top" class="lvtCol" align="right"><b>{$APP.LBL_TOOLS}</b></td>
	{foreach key=row_no item=data from=$PRODUCTLABELLIST}
	<td width="{$data.LABEL_WIDTH}" class="lvtCol"><b>{$data.LABEL}</b></td>
	{/foreach}
	<td width=8% class="lvtCol" align="left"><b>{$APP.LBL_QTY}</b></td>
	<td width=12% class="lvtCol" align="left"><b>{$APP.LBL_LIST_PRICE}</b></td>
	<td width=15% valign="top" class="lvtCol" align="left"><b>{$APP.LBL_COMMENT}</b></td>
	<td width=10% nowrap class="lvtCol" align="right"><b>{$APP.LBL_PRODUCT_TOTAL}</b></td>
   </tr>
</table>
<!-- Upto this has been added for form the first row. Based on these above we should form additional rows using script -->

<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable">
   <!-- Add Product Button -->
   <tr>
	<td colspan="3">	
	<input type="button" name="Button" class="crmbutton small create" value="{$APP.LBL_ADD_PRODUCT}" onclick="selectProductRows(this.form);" />
	</td>
   </tr>
</table>
<div style="display:none;">

<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable">
   <!-- Product Details Final Total Discount, Tax and Shipping&Hanling  - Starts -->
   {if $MODULE neq ''}{*<!-- changed by dingjianting on 2007-2-25 for gloso project and quote-->*}
   <!--	changed by dingjianting on 2006-12-28 for gloso project -->
   <tr valign="top">
	<td width="88%" colspan="2" style="display:none" class="crmTableRow small lineOnTop" align="right"><b>{$APP.LBL_NET_TOTAL}</b></td>
	<td width="12%" id="netTotal" style="display:none" class="crmTableRow small lineOnTop" align="right">0.00</td>
   </tr>
   <!-- -->

   <tr valign="top">
	<td class="crmTableRow small lineOnTop" width="75%" style="border-right:1px #dadada;" align="right">&nbsp;
	<!-- Popup Discount DIV -->
		<div class="discountUI" id="discount_div_final">
			<input type="hidden" id="discount_type_final" name="discount_type_final" value="">
			<table width="100%" border="0" cellpadding="5" cellspacing="0" class="small">
			   <tr style="cursor:move;">
				<td id="discount_div_title_final" nowrap align="left" ></td>
				<td align="right"><img src="{$IMAGE_PATH}close.gif" border="0" onClick="fnHidePopDiv('discount_div_final')" style="cursor:pointer;"></td>
			   </tr>
			   <tr>
				<td align="left" class="lineOnTop"><input type="radio" name="discount_final" checked onclick="setDiscount(this,'_final'); ">&nbsp; {$APP.LBL_ZERO_DISCOUNT}</td>
				<td class="lineOnTop">&nbsp;</td>
			   </tr>
			   <tr>
				<td align="left"><input type="radio" name="discount_final" onclick="setDiscount(this,'_final'); ">&nbsp; % {$APP.LBL_OF_PRICE}</td>
				<td align="right"><input type="text" class="small" size="2" id="discount_percentage_final" name="discount_percentage_final" value="0" style="visibility:hidden" onBlur="setDiscount(this,'_final'); ">&nbsp;%</td>
			   </tr>
			   <tr>
				<td align="left" nowrap><input type="radio" name="discount_final" onclick="setDiscount(this,'_final'); ">&nbsp;{$APP.LBL_DIRECT_PRICE_REDUCTION}</td>
				<td align="right"><input type="text" id="discount_amount_final" name="discount_amount_final" size="5" value="0" style="visibility:hidden" onBlur="setDiscount(this,'_final'); "></td>
			   </tr>
			</table>
		</div>
		<script>
		//changed by dingjianting on 2007-1-4 for gloso project and drag layer
		var theEventHandle = document.getElementById("discount_div_title_final");
		var theEventRoot   = document.getElementById("discount_div_final");
		Drag.init(theEventHandle, theEventRoot);
		</script>
		<!-- End Div -->
	</td>
	<td class="crmTableRow small lineOnTop" align="right">
		(-)&nbsp;<b><a href="javascript:doNothing();" onClick="displayCoords(this,'discount_div_final','discount_final','1')">{$APP.LBL_DISCOUNT}</a>
		
	</td>
	<td id="discountTotal_final" class="crmTableRow small lineOnTop" align="right">0.00</td>
   </tr>

   <tr valign="top">
	<td class="crmTableRow small" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small" align="right">
		(+)&nbsp;<b>{$APP.LBL_SHIPPING_AND_HANDLING_CHARGES} </b>
	</td>
	<td class="crmTableRow small" align="right">
		<input id="shipping_handling_charge" name="shipping_handling_charge" type="text" class="small" style="width:40px" align="right" value="0.00" onBlur="calcTotal();">%
	</td>
   </tr>
   <tr valign="top">
	<td class="crmTableRow small" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small" align="right">
		{$APP.LBL_ADJUSTMENT}
		<select id="adjustmentType" name="adjustmentType" class=small onchange="calcTotal();">
			<option value="+">{$APP.LBL_ADD}</option>
			<option value="-">{$APP.LBL_DEDUCT}</option>
		</select>
	</td>
	<td class="crmTableRow small" align="right">
		<input id="adjustment" name="adjustment" type="text" class="small" style="width:40px" align="right" value="0.00" onBlur="calcTotal();">
	</td>
   </tr>
{/if}
</table>
</div>
<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable">
  <tr valign="top">
	<td class="crmTableRow big lineOnTop" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow big lineOnTop" align="right"><b>{$APP.LBL_GRAND_TOTAL}</b></td>
	<td id="grandTotal" name="grandTotal" class="crmTableRow big lineOnTop" align="right">&nbsp;<b></b></td>
   </tr>
</table>
        <input type="hidden" value="{$PRE_CURRENCY_NAME}" id="prev_selected_currency_name" name="prev_selected_currency_name" />
		<input type="hidden" name="totalProductCount" id="totalProductCount" value="">
		<input type="hidden" name="subtotal" id="subtotal" value="">
		<input type="hidden" name="total" id="total" value="">




	</td>
   </tr>

<script language="javascript">
if(document.EditView.currency != undefined) {ldelim}
	document.EditView.currency.onchange = function() {ldelim}
		updatePrices();
	{rdelim};
{rdelim}
</script>