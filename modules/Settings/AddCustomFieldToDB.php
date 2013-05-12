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
require_once('include/database/PearDatabase.php');

$fldmodule=$_REQUEST['fld_module'];
 $fldlabel=$_REQUEST['fldLabel'];
 $fldType= $_REQUEST['fieldType'];
 $parenttab=$_REQUEST['parenttab'];
 $mode=$_REQUEST['mode'];

$tabid = getTabid($fldmodule);

if(get_magic_quotes_gpc() == 1)
{
	$fldlabel = stripslashes($fldlabel);
}


//checking if the user is trying to create a custom ec_field which already exists  
if($mode != 'edit')
{
	$checkquery="select * from ec_field where tabid='".$tabid."'and fieldlabel='".$fldlabel."'";
	$checkresult=$adb->query($checkquery);
}
else
	$checkresult=0;

if($adb->num_rows($checkresult) != 0)
{
	
	if(isset($_REQUEST['fldLength']))
	{	
		$fldlength=$_REQUEST['fldLength'];
	}
	else
	{
		 $fldlength='';
	}
	if(isset($_REQUEST['fldDecimal']))
	{
		$flddecimal=$_REQUEST['fldDecimal'];
	}
	else
	{
		$flddecimal='';
	}
	if(isset($_REQUEST['fldPickList']))
	{
		$fldPickList=$_REQUEST['fldPickList'];
	}
	else
	{
		$fldPickList='';
	}
	if(isset($_REQUEST['fldMandatory']))
	{
		$fldMandatory=$_REQUEST['fldMandatory'];
	}
	else
	{
		$fldMandatory='';
	}
	
	redirect("index.php?module=Settings&action=CustomFieldList&fld_module=".$fldmodule."&fldType=".$fldType."&fldlabel=".$fldlabel."&fldlength=".$fldlength."&flddecimal=".$flddecimal."&fldPickList=".$fldPickList."&parenttab=".$parenttab."&duplicate=yes");

}
else
{
	if($_REQUEST['fieldid'] == '')
	{
		$max_fieldid = $adb->getUniqueID("ec_field");
		$columnName = 'cf_'.$max_fieldid;
	}
	else
	{
		$max_fieldid = $_REQUEST['column'];
		$columnName = $max_fieldid;
	}
	$fieldName = $columnName;
	$entityArr = getEntityTable($fldmodule);
	$tableName = $entityArr["tablename"];

	//Assigning the uitype
	$fldlength=$_REQUEST['fldLength'];
	$uitype='';
	$fldPickList='';
	if(isset($_REQUEST['fldDecimal']) && $_REQUEST['fldDecimal'] != '')
	{
		$decimal=$_REQUEST['fldDecimal'];
	}
	else
	{
		$decimal=0;
	}
	if(isset($_REQUEST['fldMandatory']))
	{
		$fldMandatory=$_REQUEST['fldMandatory'];
	}
	else
	{
		$fldMandatory='';
	}
	$type='';
	$uichekdata='';
	if($fldType == 'Text')
	{
	$uichekdata='V~O~LE~'.$fldlength;
		$uitype = 1;
		$type = "C(".$fldlength.")"; // adodb type
	}
	elseif($fldType == 'Number')
	{
		$uitype = 7;

		//this may sound ridiculous passing decimal but that is the way adodb wants
		$dbfldlength = $fldlength + $decimal + 1;
 
		$type="N(".$dbfldlength.".".$decimal.")";	// adodb type
	$uichekdata='N~O~'.$fldlength .','.$decimal;
	}
	elseif($fldType == 'Percent')
	{
		$uitype = 9;
		$type="N(5.2)"; //adodb type
		$uichekdata='N~O~2~2';
	}
	elseif($fldType == 'Currency')
	{
		$uitype = 7;
		$dbfldlength = $fldlength + $decimal + 1;
		$type="N(".$dbfldlength.".".$decimal.")"; //adodb type
		$uichekdata='N~O~'.$fldlength .','.$decimal;
	}
	elseif($fldType == 'Date')
	{
	$uichekdata='D~O';
		$uitype = 5;
		$type = "D"; // adodb type
		
	}
	elseif($fldType == 'Email')
	{
		$uitype = 13;
		$type = "C(50)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'Phone')
	{
		$uitype = 11;
		$type = "C(30)"; //adodb type
		
		$uichekdata='V~O';
	}
	elseif($fldType == 'Picklist')
	{
		$uitype = 15;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'URL')
	{
		$uitype = 17;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'Checkbox')	 
        {	 
                 $uitype = 56;	 
                 $type = "C(3) default 0"; //adodb type	 
                 $uichekdata='C~O';	 
        }
	elseif($fldType == 'TextArea')	 
        {	 
                 $uitype = 21;	 
                 $type = "X"; //adodb type	 
                 $uichekdata='V~O';	 
        }
	elseif($fldType == 'MultiSelectCombo')
	{
		 $uitype = 33;
		 $type = "X"; //adodb type
		 $uichekdata='V~O';
	}
	elseif($fldType == 'Skype')
	{
		$uitype = 85;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'QQ')
	{
		$uitype = 86;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'Msn')
	{
		$uitype = 87;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'Trade')
	{
		$uitype = 88;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'Yahoo')
	{
		$uitype = 89;
		$type = "C(255)"; //adodb type
		$uichekdata='V~O';
	}
	elseif($fldType == 'Account')
	{
		$uitype = 51;
		$type = "N(19)"; //adodb type
		$uichekdata='I~O';
		$columnName = "accountid";
		$fieldName = "account_id";
	}
	elseif($fldType == 'Contact')
	{
		$uitype = 57;
		$type = "N(19)"; //adodb type
		$uichekdata='I~O';
		$columnName = "contact_id";
		$fieldName = $columnName;
	}
	// No Decimal Pleaces Handling

        


        

        //1. add the customfield ec_table to the ec_field ec_table as Block4
        //2. fetch the contents of the custom ec_field and show in the UI
        
	//retreiving the sequence
	if($_REQUEST['fieldid'] == '')
	{
		$custfld_fieldid=$adb->getUniqueID("ec_field");
	}
	else
	{
		$custfld_fieldid= $_REQUEST['fieldid'];
	}
	$adb->startTransaction();
	$custfld_sequece=$adb->getUniqueId("ec_customfield_sequence");
    	
	$blockid ='';
        //get the blockid for this custom block
        $blockid = getBlockId($tabid,'LBL_CUSTOM_INFORMATION');
		if($fldMandatory != "" && $fldMandatory == 1)
		{
			$uichekdata = str_replace("~O","~M",$uichekdata);//field mandatory
		}

        if(is_numeric($blockid))
        {
		if($_REQUEST['fieldid'] == '')
		{
			
			$result = $adb->alterTable($tableName, $columnName." ".$type, "Add_Column");
			if($result != 2) {//without error
				redirect("index.php?module=Settings&action=CustomFieldList&fld_module=".$fldmodule."&parenttab=".$parenttab);
				die;
			}
			$query = "insert into ec_field values(".$tabid.",".$custfld_fieldid.",'".$columnName."','".$tableName."',2,".$uitype.",'".$fieldName."','".$fldlabel."',0,0,0,100,".$custfld_sequece.",$blockid,1,'".$uichekdata."',1,0,'BAS')";
			$adb->query($query);
		}
		else
		{
			$query = "update ec_field set fieldlabel='".$fldlabel."',typeofdata='".$uichekdata."' where fieldid=".$_REQUEST['fieldid'];
			$adb->query($query);
		}
		if($_REQUEST['fieldid'] == '')
		{
			//Inserting values into def_org ec_tables
			$sql_def = "insert into ec_def_org_field values(".$tabid.", ".$custfld_fieldid.", 0, 1)";
			$adb->query($sql_def);
		}


		if($fldType == 'Picklist' || $fldType == 'MultiSelectCombo')
		{
			if($_REQUEST['fieldid'] != '' && $mode == 'edit')
			{
				$adb->query("delete from ec_picklist where colname='".$columnName."'");
			}
			$pickArray = Array();
			$fldPickList =  $_REQUEST['fldPickList'];
			$pickArray = explode("\n",$fldPickList);
			$count = count($pickArray);
			for($i = 0; $i < $count; $i++)
			{
				$pickArray[$i] = trim($pickArray[$i]);
				$id = $adb->getUniqueID('ec_picklist');
				if($pickArray[$i] != '')
				{
					$adb->query("insert into ec_picklist(id,colvalue,colname,sequence) values(".$id.",'".$pickArray[$i]."','".$columnName."',".$i.")");
				}
			}
		}
	}
	$adb->completeTransaction();
	redirect("index.php?module=Settings&action=CustomFieldList&fld_module=".$fldmodule."&parenttab=".$parenttab);
}
?>
