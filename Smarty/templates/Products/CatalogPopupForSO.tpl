<style type="text/css">
	a.x {ldelim}
		color:black;
		text-align:center;
		text-decoration:none;
		padding:5px;
		font-weight:bold;
	{rdelim}
	
	a.x:hover {ldelim}
		color:#333333;
		text-decoration:underline;
		font-weight:bold;
	{rdelim}

	li {ldelim}
		background:transparent;
		padding:0px;
		margin:0px 0px 0px 0px;
	{rdelim}

	ul li{ldelim}
		margin-top:5px;
		margin-left:5px;
	{rdelim}

	ul {ldelim}color:black;{rdelim}	 

</style>
<LINK href="themes/images/dtree.css" type="text/css" rel=stylesheet>
<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
   <tr>
	<td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>
	<td id="catalog_tab" class="dvtSelectedCell" align=center nowrap><a href="javascript:showProductCatalog()">{$MOD.PRODUCT_CATALOG}</a></td>
	<td class="dvtTabCache" style="width:100%">&nbsp;</td>
   </tr>
</table>
<div id="catalog_popup" style="display:block; padding:15px;">
<img src="themes/softed/images/vtbusy.gif" title="正在初始化，请稍后..."/>
<!--{$CATALOGTREE}-->
</div>
<script language="javascript" type="text/javascript" src="modules/Products/Product.js"></script>
<script>
this.catalogPopup_Bind("catalog_popup","2");

function showProductCatalog() {ldelim}
	if(getObj('catalog_popup').style.display == 'none')
	{ldelim}
		getObj('catalog_popup').style.display = 'block';
		getObj('catalog_tab').className = 'dvtSelectedCell';
		getObj('product_vendor').style.display = 'none';
		getObj('vendor_tab').className = 'dvtUnSelectedCell';		
	{rdelim}
{rdelim}
function showhide(argg,imgId)
{ldelim}
	var harray=argg.split(",");
	var harrlen = harray.length;
	var i;
	for(i=0; i<harrlen; i++)
	{ldelim}
        	var x=document.getElementById(harray[i]).style;
        	if (x.display=="none")
        	{ldelim}
            		x.display="block";
					document.getElementById(imgId).src = "{$IMAGE_PATH}minus.gif";
        	{rdelim}
        	else
			{ldelim}
            			x.display="none";
						document.getElementById(imgId).src = "{$IMAGE_PATH}plus.gif";
            {rdelim}
	{rdelim}
{rdelim}


function loadValue(currObj,catalogid,parentcatalog)
{ldelim}
        $("status").style.display="inline";
        var urlstring = '';
        urlstring = 'query=true&search_field=catalogid&searchtype=BasicSearch&search_text='+parentcatalog+'&';
	popuptype = $('popup_type').value;
	urlstring += 'popuptype='+popuptype;
	urlstring = urlstring +'&query=true&file=PopupForSO&module=Products&action=ProductsAjax&ajax=true';
	urlstring += gethiddenelements();

	new Ajax.Request(
		'index.php',
		{ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
			method: 'post',
			postBody:urlstring,
			onComplete: function(response) {ldelim}
				$("status").style.display="none";
                                $("ListViewContents").innerHTML= response.responseText;
				setSelectedProductRow();
			{rdelim}
	       {rdelim}
        );

{rdelim}
function loadProductValue(vendorid)
{ldelim}
        $("status").style.display="inline";
	var urlstring = '';
        urlstring = 'query=true&search_field=vendor_id&searchtype=BasicSearch&search_text='+vendorid+'&';
	popuptype = $('popup_type').value;
	urlstring += 'popuptype='+popuptype;
	urlstring = urlstring +'&query=true&file=PopupForSO&module=Products&action=ProductsAjax&ajax=true';
	urlstring += gethiddenelements();
		new Ajax.Request(
			'index.php',
			{ldelim}queue: {ldelim}position: 'end', scope: 'command'{rdelim},
				method: 'post',
				postBody:urlstring,
				onComplete: function(response) {ldelim}
					$("status").style.display="none";
	                                $("ListViewContents").innerHTML= response.responseText;
					setSelectedProductRow();
				{rdelim}
		       {rdelim}
	        );

{rdelim}

</script>