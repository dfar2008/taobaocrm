<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
ini_set (error_reporting,E_ALL & ~E_NOTICE );
if(isset($_REQUEST['service']))
{
	if($_REQUEST['service'] == "outlook")
	{
		include("soap/vtigerolservice.php");
	}
	elseif($_REQUEST['service'] == "customerportal")
	{
		include("soap/customerportal.php");
	}
	elseif($_REQUEST['service'] == "webforms")
	{
		include("soap/webforms.php");
	}
	elseif($_REQUEST['service'] == "firefox")
	{
		include("soap/firefoxtoolbar.php");
	}
	elseif($_REQUEST['service'] == "wordplugin")
	{
		include("soap/wordplugin.php");
	}
	elseif($_REQUEST['service'] == "thunderbird")
	{
		include("soap/thunderbirdplugin.php");
	}
	else
	{
		echo "No Service Configured for $_REQUEST[service]";
	}
}
else
{
	echo "<h1>ecustomerCRM Soap Services</h1>";
	echo "<li>ecustomerCRM Outlook Plugin EndPoint URL -- Click <a href='ecservice.php?service=outlook'>here</a></li>";
	echo "<li>ecustomerCRM Word Plugin EndPoint URL -- Click <a href='ecservice.php?service=wordplugin'>here</a></li>";
	echo "<li>ecustomerCRM ThunderBird Extenstion EndPoint URL -- Click <a href='ecservice.php?service=thunderbird'>here</a></li>";
	echo "<li>ecustomerCRM Customer Portal EndPoint URL -- Click <a href='ecservice.php?service=customerportal'>here</a></li>";
	echo "<li>ecustomerCRM WebForm EndPoint URL -- Click <a href='ecservice.php?service=webforms'>here</a></li>";
	echo "<li>ecustomerCRM FireFox Extension EndPoint URL -- Click <a href='ecservice.php?service=firefox'>here</a></li>";
}


?>
