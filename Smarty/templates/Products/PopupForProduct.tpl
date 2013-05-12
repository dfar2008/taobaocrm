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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>


<style type="text/css">@import url("{$THEME}style.css");</style>
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
<script type="text/javascript" src="include/js/general.js"></script>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<LINK href="themes/images/dtree.css" type="text/css" rel=stylesheet>
<table width="640" border="0" cellspacing="0" cellpadding="0" class="mailClient mailClientBg">
	<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="moduleName" width="80%" style="padding-left:10px;"><!--{$MOD.LBL_ASSIGN_CATALOG}-->{$MOD.PRODUCT_CATALOG}</td>
					<td  width=30% nowrap class="componentName" align=right>{$APP.VTIGER}</td>
				</tr>
			</table>
			</td>
  </tr>
    </tr>
   <tr>
	    <td style="padding:10px;" valign="top" class="hdrNameBg small">
			<table cellspacing="0" cellpadding="0" style="width:100%;" class="small">
          <tr>
            <td valign="top" align="left">
                <div id="catalog_popup" style="display:block; padding-left:15px; padding-top:10px;">	
                <img src="themes/softed/images/vtbusy.gif" title="正在初始化，请稍后..."/>					
				</div>
           
                <!-- END OF TREE MENU -->
            </td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td align="center" style="padding:10px;" class="reportCreateBottom" >&nbsp;</td>
  </tr>
</table>
<script language="javascript" type="text/javascript" src="modules/Products/Product.js"></script>
<script>
this.catalogPopup_Bind("catalog_popup","2");

function showhide(argg,imgId)
{ldelim}
	var harray = argg.split(",");
	var harrlen = harray.length;
	var i;
	for(i=0; i<harrlen; i++)
	{ldelim}
		var x = document.getElementById(harray[i]).style;
		if (x.display=="none")
		{ldelim}
			x.display = "block";
			document.getElementById(imgId).src = "{$IMAGE_PATH}minus.gif";
		{rdelim}
		else
		{ldelim}
			x.display = "none";
			document.getElementById(imgId).src = "{$IMAGE_PATH}plus.gif";
		{rdelim}
	{rdelim}
{rdelim}

function loadValue(currObj,catalogid,parentcatalog,name)
{ldelim}
		window.opener.document.EditView.catalogname.value = name;
		window.opener.document.EditView.catalogid.value = catalogid;
		window.close();
{rdelim}

</script>
</body>
</html>