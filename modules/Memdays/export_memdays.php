<?php
include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');
require_once('include/utils/utils.php');
global $adb;
$query = "select tabid from ec_tab where name='Memdays'";
$result = $adb->query($query);
$noofrows = $adb->num_rows($result);
$tab_id = 0;
if($noofrows > 0) {
	$tab_id = $adb->query_result($result,0,"tabid");
} else {
	echo "Memday module does not exist£¡<br>";
	exit();
}
$buffer_string = array();
$buffer_schema = array();
$dropdown_field = array();
$buffer_schema[] = '<?xml version="1.0"?>';
$buffer_schema[] = '<schema version="0.2">';
$buffer_schema[] = '<table name="ec_memdays">';
$buffer_schema[] = '<field name="memdaysid" type="I" size="19">';
$buffer_schema[] = '			<key />';
$buffer_schema[] = '			<default value="0" />';
$buffer_schema[] = '</field>';
$buffer_string[] = "<?php";
$query = "select * from ec_blocks where tabid='".$tab_id."'";
//echo $query."<br>";
$result = $adb->query($query);
$noofrows = $adb->num_rows($result);
if($noofrows > 0) {
	while($row = $adb->fetch_array($result)) {
		$blockid = $row["blockid"];
		$blocklabel = $row["blocklabel"];
		$sequence = $row["sequence"];
		$buffer_string[] = "\$next_blockid=\$this->get_next_blockid();";
		$buffer_string[] =  "\$this->db->query(\"insert into ec_blocks values (\".\$next_blockid.\",\".\$tab_id.\",'".$blocklabel."',".$sequence.",0,0,0,0,0)\");";
		$query_field = "select * from ec_field where tabid='".$tab_id."' and block='".$blockid."'";
		//echo $query_field."<br>";
		$result_field = $adb->query($query_field);
		while($row_field = $adb->fetch_array($result_field)) {
			$columnname = $row_field['columnname'];
			$columnname_src = $columnname;
			$columnname = str_replace("cf_","memday",$columnname);
			$tablename = $row_field['tablename'];
			$tablename = str_replace("memdayscf","memdays",$tablename);
			$uitype = $row_field['uitype'];
			$fieldname = $row_field['fieldname'];
			$fieldname = str_replace("cf_","memday",$fieldname);
			$fieldlabel = $row_field['fieldlabel'];
			$maximumlength = $row_field['maximumlength'];
			$sequence = $row_field['sequence'];
			$displaytype = $row_field['displaytype'];
			$typeofdata = $row_field['typeofdata'];
			$buffer_string[] = "\$this->db->query(\"insert into ec_field values (\".\$tab_id.\",\".\$this->db->getUniqueID(\"ec_field\").\",'".$columnname."','".$tablename."',1,'".$uitype."','".$fieldname."','".$fieldlabel."',1,0,0,".$maximumlength.",".$sequence.",\".\$next_blockid.\",".$displaytype.",'".$typeofdata."',0,1,'BAS')\");";
			if($uitype == 2)
			{
				//text
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="250" />';
			}
			elseif($uitype == 10)
			{
				//relatedmodule_id
				$buffer_schema[] = '<field name="'.$columnname.'" type="I" size="19" />';
			}
			elseif($uitype == 51)
			{
				//account_id
				$buffer_schema[] = '<field name="accountid" type="I" size="19" />';
			}
			elseif($uitype == 57)
			{
				//contact_id
				$buffer_schema[] = '<field name="contact_id" type="I" size="19" />';
			}
			elseif($uitype == 57)
			{
				//contact_id
				$buffer_schema[] = '<field name="contact_id" type="I" size="19" />';
			}
			elseif($uitype == 80)
			{
				//salesorderid
				$buffer_schema[] = '<field name="'.$columnname.'" type="I" size="19" />';
			}
			elseif($uitype == 76)
			{
				//potentialid
				$buffer_schema[] = '<field name="'.$columnname.'" type="I" size="19" />';
			}
			elseif($uitype == 81)
			{
				//vendorid
				$buffer_schema[] = '<field name="'.$columnname.'" type="I" size="19" />';
			}
			elseif($uitype == 79)
			{
				//purchaseorderid
				$buffer_schema[] = '<field name="'.$columnname.'" type="I" size="19" />';
			}
			elseif($uitype == 1)
			{
				//text
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="250" />';
			}
			elseif($uitype == 7)
			{
				//number
				$buffer_schema[] = '<field name="'.$columnname.'" type="N" size="11.2" />';
			}
			elseif($uitype == 9)
			{
				//$fldType == 'Percent'
				$buffer_schema[] = '<field name="'.$columnname.'" type="N" size="5.2" />';
			}
			elseif($uitype == 71)
			{
				//$fldType == 'Currency'
				$buffer_schema[] = '<field name="'.$columnname.'" type="N" size="10.2" />';
			}
			elseif($uitype == 5)
			{
				$uichekdata='D~O';
				//$fldType == 'Date'
				$buffer_schema[] = '<field name="'.$columnname.'" type="D" />';
				
			}
			elseif($uitype == 13)
			{
				//$fldType == 'Email'
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="50" />';
			}
			elseif($uitype == 11)
			{
				//$fldType == 'Phone'
				//$type = "C(30)"; //adodb type
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="30" />';
			}
			elseif($uitype == 15)
			{
				//$fldType == 'Picklist'
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="255" />';
			}
			elseif($uitype == 17)
			{				
				//$fldType == 'URL'
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="255" />';
			}
			elseif($uitype ==56)	 
			{	 
				 //$fldType == 'Checkbox'
				 $buffer_schema[] = '<field name="'.$columnname.'" type="C" size="3" />';
			}
			elseif( $uitype == 21  || $uitype == 19)	 
			{	 
				//text area	
				$buffer_schema[] = '<field name="'.$columnname.'" type="X" />';
			}
			elseif($uitype == 33)
			{
				 //$fldType == 'MultiSelectCombo'
				 $buffer_schema[] = '<field name="'.$columnname.'" type="X" />';
			}
			elseif($uitype == 85)
			{
				//$fldType == 'Skype'
				$buffer_schema[] = '<field name="'.$columnname.'" type="C" size="255" />';
			}
			if($uitype == 15 || $uitype == 33) {
				$dropdown_field[] = $columnname;
				$query_dropdown = "select * from ec_picklist where colname='".$columnname_src."' order by sequence";
				//echo $query_dropdown."<br>";
				$result_dropdown = $adb->query($query_dropdown);
				$combo_array = array();
				while($row_dropdown = $adb->fetch_array($result_dropdown)) {
					$combo_array[] = $row_dropdown["colvalue"];					
				}
				$buffer_string[] = "\$combo_strings['".$columnname."'] = Array('".implode("','",$combo_array)."');";
			}
		}
	}
	$buffer_schema[] = '<field name="smcreatorid" type="I" size="19"><default value="0" /></field>';
	$buffer_schema[] = '<field name="smownerid" type="I" size="19"><default value="0" /></field>';
	$buffer_schema[] = '<field name="modifiedby" type="I" size="19"><default value="0" /></field>';
	$buffer_schema[] = '<field name="groupid" type="I" size="19"><default value="0" /></field>';
	$buffer_schema[] = '<field name="description" type="X" />';
	$buffer_schema[] = '<field name="createdtime" type="T"></field>';
	$buffer_schema[] = '<field name="modifiedtime" type="T"></field>';
	$buffer_schema[] = '<field name="deleted" type="I" size="1"><default value="0" /></field>';
	$buffer_schema[] = '<field name="approved" type="I" size="1"><default value="0" /></field>';
	$buffer_schema[] = '<field name="approvedby" type="I" size="19"><default value="0" /></field>';
	$buffer_string[] = "?>";
	//default field
	$buffer_schema[] = '<index name="memdays_memdayname_idx">';
	$buffer_schema[] = '		<col>memdayname</col>';
	$buffer_schema[] = '	</index>';
	$buffer_schema[] = '	<opt platform="mysql">Type=InnoDB</opt>';
	$buffer_schema[] = '</table>';
	$buffer_schema[] = '<table name="ec_memdays" alter="true">';
	$buffer_schema[] = '	<constraint>ADD CONSTRAINT fk_1_ec_memdays FOREIGN KEY (memdaysid) REFERENCES ec_crmentity(crmid) ON DELETE CASCADE</constraint>';
	$buffer_schema[] = '	<opt>Type=InnoDB</opt>';
	$buffer_schema[] = '	<data>';
	$buffer_schema[] = '	</data>';
	$buffer_schema[] = '</table>';	
	$buffer_schema[] = '</schema>';
	//write contents into define_fields.php
	define('LF', "\n");
	$filename = "modules/Memdays/define_fields.php";
    $fd = fopen($filename,'w');    
	foreach($buffer_string as $string) {
		//echo $string."<br>";
		fputs($fd,$string.LF);
	}
	fclose($fd);
	//write contents into Schema.xml
	$filename = "modules/Memdays/Schema.xml";
	$fd = fopen($filename,'w');
	foreach($buffer_schema as $string) {
		//echo $string;
		fputs($fd,$string.LF);
	}
	fclose($fd);
	echo "Memday module is exported successfully!";

	
} else {
	echo "No Memday Blcok£¡<br>";
	exit();
}
?>