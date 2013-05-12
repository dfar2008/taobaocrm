<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/ec_crm/vtigercrm/data/CRMEntity.php,v 1.16 2005/04/29 04:21:31 mickie Exp $
 * Description:  Defines the base class for all data entities used throughout the 
 * application.  The base class including its methods and variables is designed to 
 * be overloaded with module-specific methods and variables particular to the 
 * module's base entity class. 
 ********************************************************************************/

include_once('config.php');
require_once('include/logging.php');
require_once('include/utils/utils.php');
require_once('include/utils/UserInfoUtil.php');
require_once('include/RelatedListView.php');
class CRMEntity
{
  /**
   * This method implements a generic insert and update logic for any SugarBean
   * This method only works for subclasses that implement the same variable names.
   * This method uses the presence of an id ec_field that is not null to signify and update.
   * The id ec_field should not be set otherwise.
   * todo - Add support for ec_field type validation and encoding of parameters.
   * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
   * All Rights Reserved.
   * Contributor(s): ______________________________________..
   */
  //var $modifiedtime;
  var $isModuleApprove = false;

	
  function saveentity($module)
  {
	global $current_user;
	$insertion_mode = $this->mode;

	$this->db->println("TRANS saveentity starts $module");
	$this->db->startTransaction();
	
	$key = "approvemodulelist";
	$appmoduleArr = getSqlCacheData($key);
	if(!$appmoduleArr) {
		$appmoduleArr = array();
		$result = $this->db->query("select ec_modulelist.*,ec_tab.name from ec_modulelist inner join ec_tab on ec_tab.tabid=ec_modulelist.tabid where ec_modulelist.type='approve' order by ec_tab.tabid");
		$num_rows = $this->db->num_rows($result);
		for($i=0; $i<$num_rows; $i++)
		{
			$appmodulename = $this->db->query_result($result,$i,'name');
			$appmoduleArr[] = $appmodulename;			 
		}
		setSqlCacheData($key,$appmoduleArr);
	}
	if(in_array($module,$appmoduleArr)) {
		$this->isModuleApprove = true;
	}
	if($this->isModuleApprove && $this->mode == "edit" && $_REQUEST['assigntype'] != 'T' && !empty($this->id)){
        $entityArr = getEntityTable($module);
        $entityidfield = $entityArr["entityidfield"];
        $ec_crmentity = $entityArr["tablename"];
		$ownersql = "select smownerid from $ec_crmentity where $entityidfield='".$this->id."' and deleted=0";
		$ownerid = $this->db->getOne($ownersql);
		$newownerid = $this->column_fields['assigned_user_id'];
		if($ownerid != $newownerid){
			$ownername=getUserName($newownerid);
		}
	}
	if(!$this->isModuleApprove) {
		foreach($this->tab_name as $table_name)
		{				
			if($table_name == "ec_crmentity")
			{
				$this->insertIntoCrmEntity($module);
			}
			else
			{
				$this->insertIntoEntityTable($table_name, $module);			
			}
		}
	} else {
		foreach($this->tab_name as $table_name)
		{				
			if($table_name == "ec_crmentity")
			{
				$this->insertIntoCrmEntity($module);
			}
			else
			{
				$this->insertIntoAppEntityTable($table_name, $module);			
			}
		}
	}

	

	//Calling the Module specific save code
	$this->save_module($module);

	if($this->isModuleApprove && $this->mode != "edit" && substr($_REQUEST['action'], -4) != 'Ajax' && $_REQUEST['ajxaction'] != 'DETAILVIEW') {
		
	}

	$this->db->completeTransaction();
    $this->db->println("TRANS saveentity ends");
	// vtlib customization: Hook provide to enable generic module relation.
	if($_REQUEST['return_action'] == 'CallRelatedList') {
		$for_module = $_REQUEST['return_module'];
		$for_crmid  = $_REQUEST['return_id'];
		if(is_file("modules/$for_module/$for_module.php")) {
			require_once("modules/$for_module/$for_module.php");
			$on_focus = new $for_module();
			// Do conditional check && call only for Custom Module at present
			// TOOD: $on_focus->IsCustomModule is not required if save_related_module function
			// is used for core modules as well.
			if($on_focus->is_custom_module && method_exists($on_focus, 'save_related_module')) {
				$with_module = $module;
				$with_crmid = $this->id;
				$on_focus->save_related_module($for_module, $for_crmid, $with_module, $with_crmid);
			}
		}
	}
  }


	
	
	/**
	 *      This function is used to upload the attachment in the server and save that attachment information in db.
	 *      @param int $id  - entity id to which the file to be uploaded
	 *      @param string $module  - the current module name
	 *      @param array $file_details  - array which contains the file information(name, type, size, tmp_name and error)
	 *      return void
	*/
	function uploadAndSaveFile($id,$module,$file_details)
	{
		global $log;
		$log->debug("Entering into uploadAndSaveFile($id,$module,$file_details) method.");

		global $current_user;
		global $upload_badext;

		$date_var = date('Y-m-d H:i:s');

		//to get the owner id
		$ownerid = isset($this->column_fields['assigned_user_id']) ? $this->column_fields['assigned_user_id'] : '';
		if(!isset($ownerid) || $ownerid=='')
			$ownerid = $current_user->id;

	
		// Arbitrary File Upload Vulnerability fix - Philip
		$binFile = $file_details['name'];
		$ext_pos = strrpos($binFile, ".");

		$ext = substr($binFile, $ext_pos + 1);

		if (in_array($ext, $upload_badext))
		{
			$binFile .= ".txt";
		}
		// Vulnerability fix ends

		$current_id = $this->db->getUniqueID("ec_crmentity");

		$filename = explode_basename($binFile);
		$filetype= $file_details['type'];
		$filesize = $file_details['size'];
		$filetmp_name = $file_details['tmp_name'];

		//get the file path inwhich folder we want to upload the file
		$upload_file_path = decideFilePath();

		//upload the file in server
		if(is_uploaded_file($filetmp_name)) { 
			$encode_file = base64_encode_filename($binFile);
			$upload_status = move_uploaded_file($filetmp_name,$upload_file_path.$current_id."_".$encode_file);
		}

		$save_file = 'true';
		//only images are allowed for these modules
		if($module == 'Contacts' || $module == 'Products')
		{echo "222";
			$save_file = validateImageFile($file_details);
		}

		if($save_file == 'true' && $upload_status == 'true')
		{
			//This is only to update the attached filename in the ec_notes ec_table for the Notes module
			if($module == 'Notes')
			{
				$sql="update ec_notes set filename='".$filename."' where notesid = ".$id;
				$this->db->query($sql);
			}
			else if($module == 'Documents')
			{
				$sql="update ec_documents set filename='".$filename."' where documentsid = ".$id;
				$this->db->query($sql);
			}
			$description = "";
			if(isset($this->column_fields['description'])) {
				$description = $this->column_fields['description'];
			}	
			$sql1 = "insert into ec_crmentity (crmid,setype) values(".$current_id.",'".$module." Attachment')";
			$this->db->query($sql1);

			$sql = "insert into ec_attachments(attachmentsid,name,description,type,setype,path,smcreatorid,createdtime) values(";
			$sql .= $current_id.",'".$filename."','".$description."','".$filetype."','".$module."','".$upload_file_path."','".$ownerid."','".$date_var."')";
			$result = $this->db->query($sql);

			if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'edit')
			{
				if($id != '' && isset($_REQUEST['fileid']) && $_REQUEST['fileid'] != '')
				{
					$delquery = 'delete from ec_seattachmentsrel where crmid = '.$id.' and attachmentsid = '.$_REQUEST['fileid'];
					$this->db->query($delquery);
				}
			}
			if($module == 'Notes' || $module == 'Documents')
			{
				$query = "delete from ec_seattachmentsrel where crmid = ".$id;
				$this->db->query($query);
			}
			$sql3='insert into ec_seattachmentsrel values('.$id.','.$current_id.')';
			$this->db->query($sql3);
        
			return true;
		}
		else
		{
			$log->debug("Skip the save attachment process.");
			return false;
		}
	}

	/** Function to insert values in the ec_crmentity for the specified module
  	  * @param $module -- module:: Type varchar
 	 */	
  function insertIntoCrmEntity($module)
  {
	global $current_user;
	global $log;
    global $adb;
	$log->info("Entering into function insertIntoCrmEntity ".$module);
    $insertion_mode = $this->mode;
    if($this->mode!='edit'){
        $current_id = $this->db->getUniqueID("ec_crmentity");
		$_REQUEST['currentid']=$current_id;
		$sql = "insert into ec_crmentity (crmid,setype) values('".$current_id."','".$module."')";
		$this->db->query($sql);
		$this->id = $current_id;
    }    
	$log->info("Exit function insertIntoCrmEntity ".$module);
  }


	/** Function to insert values in the specifed table for the specified module
  	  * @param $table_name -- table name:: Type varchar
  	  * @param $module -- module:: Type varchar
 	 */
  function insertIntoEntityTable($table_name, $module)
  {
	  global $log;
  	  global $current_user;	  
	  $log->info("function insertIntoEntityTable ".$module.' ec_table name ' .$table_name);
	  $insertion_mode = $this->mode;
	  $date_var = date('YmdHis');
      if(isset($this->column_fields['assigned_user_id']) && $this->column_fields['assigned_user_id'] != '') {
         $ownerid = $this->column_fields['assigned_user_id'];
      } else {
         $ownerid = $current_user->id;
      }
      $this->column_fields['assigned_user_id']=$ownerid;
      if($insertion_mode == 'edit')
	  {
		  $update = '';
		  $tabid= getTabid($module);
		  $sql = "select ec_field.* from ec_field inner join ec_def_org_field on ec_def_org_field.fieldid=ec_field.fieldid";
		  $sql.= " where ec_def_org_field.visible=0 and ec_field.tabid=".$tabid." and ec_field.tablename='".$table_name."' and ec_field.displaytype in (1,3,4) and ec_field.uitype!=1004";
		  
	  } 
	  else
	  {
	  	  $tabid= getTabid($module);	
		  $sql = "select * from ec_field where tabid=".$tabid." and tablename='".$table_name."' and displaytype in (1,3,4) and uitype!=1004"; 
	  }
	  

	  $result = $this->db->query($sql);
	  $noofrows = $this->db->num_rows($result);
      $iCount=0;
	  for($i=0; $i<$noofrows; $i++)
	  {
		  $fieldname=$this->db->query_result($result,$i,"fieldname");
		  $columname=$this->db->query_result($result,$i,"columnname");
		  $uitype=$this->db->query_result($result,$i,"uitype");
		  if(isset($this->column_fields[$fieldname]))
		  {
			  if($uitype == 56)
			  {
				  if($this->column_fields[$fieldname] == 'on' || $this->column_fields[$fieldname] == 1)
				  {
					  $fldvalue = 1;
				  }
				  else
				  {
					  $fldvalue = 0;
				  }

			  }
			  elseif($uitype == 33)
			  {
  				if(is_array($this->column_fields[$fieldname]))
  				{
  					$fldvalue = implode(' |##| ',$this->column_fields[$fieldname]);
  				}
				else
  				{
  					$fldvalue = $this->column_fields[$fieldname];
          		}
			  }
			  else
			  {
				  $fldvalue = $this->column_fields[$fieldname]; 
				  $fldvalue = stripslashes($fldvalue);
			  }
			  $fldvalue = $this->db->formatString($table_name,$columname,$fldvalue);
			  if($insertion_mode == 'edit')
			  {				  
				  if($iCount == 0)
				  {
					  $update = $columname."=".$fldvalue."";
					  $iCount =1;
				  }
				  else
				  {
					  $update .= ', '.$columname."=".$fldvalue."";
				  }
			  }
			  else
			  {
				  if($fldvalue != "NULL" && $fldvalue != "''") {
					  $column .= ", ".$columname;
					  $value .= ", ".$fldvalue."";
				  }
			  }
		  }
	  }

	  if($insertion_mode == 'edit' && trim($update) != '')
	  {

		  $sql1 = "update ".$table_name." set modifiedby='".$current_user->id."',modifiedtime=".$this->db->formatDate($date_var).",".$update." where ".$this->tab_name_index[$table_name]."=".$this->id;
		  $this->db->query($sql1);
	  }
	  else
	  {	
		if(isset($this->column_fields['createdtime']) && $this->column_fields['createdtime'] != "") {
			$createdtime = $this->column_fields['createdtime'];
		} else {
			$createdtime = $date_var;
		}
		if(isset($this->column_fields['modifiedtime']) && $this->column_fields['modifiedtime'] != "") {
			$modifiedtime = $this->column_fields['modifiedtime'];
		} else {
			$modifiedtime = $date_var;
		}
		if(isset($this->column_fields['smcreatorid']) && $this->column_fields['smcreatorid'] != "") {
			$smcreatorid = $this->column_fields['smcreatorid'];
		} else {
			$smcreatorid = $current_user->id;
		}
		//echo "value:".$value."<br>";
		//echo "column:".$column."<br>";
		
	    $sql1 = "insert into ".$table_name." (".$this->tab_name_index[$table_name]."".$column.",smcreatorid,smownerid,createdtime,modifiedtime) values(".$this->id."".$value.",'".$smcreatorid."','".$smcreatorid."',".$this->db->formatDate($createdtime).",".$this->db->formatDate($modifiedtime).")";
	    $this->db->query($sql1);
		if($current_user->id != $ownerid) {
			global $app_strings;
			$to_username = getUserName($ownerid);
			$content = $app_strings["NOW_THERE_ARE"]." <a href=\"index.php?module=".$module."&action=DetailView&record=".$this->id."\" target=\"_blank\">".$app_strings[$module]."</a> ".$app_strings["ASSIGNED_TO_NOTICE"];			
			sendMessage($content,$to_username);
		}
	  }

  }
  /** Function to insert values in the specifed table for the specified module
  	  * @param $table_name -- table name:: Type varchar
  	  * @param $module -- module:: Type varchar
 	 */
  function insertIntoAppEntityTable($table_name, $module)
  {
	  global $log;
  	  global $current_user;	  
	  $log->info("function insertIntoEntityTable ".$module.' ec_table name ' .$table_name);
	  $insertion_mode = $this->mode;
	  $date_var = date('YmdHis');
      if(isset($this->column_fields['assigned_user_id']) && $this->column_fields['assigned_user_id'] != '') {
         $ownerid = $this->column_fields['assigned_user_id'];
      } else {
         $ownerid = $current_user->id;
      }
      $this->column_fields['assigned_user_id']=$ownerid;
	  if($insertion_mode == 'edit')
	  {
		  $update = '';
		  $tabid= getTabid($module);
		  if($is_admin)
		  {

			  $sql = "select ec_field.* from ec_field inner join ec_def_org_field on ec_def_org_field.fieldid=ec_field.fieldid";
			  $sql.= " where ec_def_org_field.visible=0 and ec_field.tabid=".$tabid." and ec_field.tablename='".$table_name."' and ec_field.displaytype in (1,3,4) and ec_field.uitype!=1004";
		  }
		  else
		  {
			  $sql = "select ec_field.* from ec_field inner join ec_def_org_field on ec_def_org_field.fieldid=ec_field.fieldid";
			  $sql.= " where ec_def_org_field.visible=0 and ec_field.tabid=".$tabid." and ec_field.tablename='".$table_name."' and ec_field.displaytype in (1,3,4) and ec_field.uitype!=1004";

			  if($this->isModuleApprove) {
				  $supportmultiapprove=false;
				  $crmid = $this->id;
				 	  
				  if($supportmultiapprove){
						$currentstep = getCurrentStep($crmid);
						$stepid = $currentstep["stepid"];
						$sql = "SELECT ec_field.* FROM ec_field  INNER JOIN ec_def_org_field ON ec_def_org_field.fieldid = ec_field.fieldid inner join ec_step2fields on ec_step2fields.fieldid=ec_def_org_field.fieldid and ec_step2fields.stepid=$stepid WHERE ec_field.tabid = ".$tabid."  AND ec_def_org_field.visible = 0 and ec_field.tablename='".$table_name."' and ec_field.displaytype=1 and ec_step2fields.readonly=1";
				  }
			  }
		  }	    

	  }
	  else
	  {
	  	  $tabid= getTabid($module);	
		  $sql = "select * from ec_field where tabid=".$tabid." and tablename='".$table_name."' and displaytype in (1,3,4) and uitype!=1004"; 
	  }

	  $result = $this->db->query($sql);
	  $noofrows = $this->db->num_rows($result);
      $iCount=0;
	  for($i=0; $i<$noofrows; $i++)
	  {
		  $fieldname=$this->db->query_result($result,$i,"fieldname");
		  $columname=$this->db->query_result($result,$i,"columnname");
		  $uitype=$this->db->query_result($result,$i,"uitype");
		  if(isset($this->column_fields[$fieldname]))
		  {
			  if($uitype == 56)
			  {
				  if($this->column_fields[$fieldname] == 'on' || $this->column_fields[$fieldname] == 1)
				  {
					  $fldvalue = 1;
				  }
				  else
				  {
					  $fldvalue = 0;
				  }

			  }
			  elseif($uitype == 33)
			  {
  				if(is_array($this->column_fields[$fieldname]))
  				{
  					$fldvalue = implode(' |##| ',$this->column_fields[$fieldname]);
  				}
				else
  				{
  					$fldvalue = $this->column_fields[$fieldname];
          		}
			  }
			  else
			  {
				  $fldvalue = $this->column_fields[$fieldname]; 
				  $fldvalue = stripslashes($fldvalue);
			  }
			  $fldvalue = $this->db->formatString($table_name,$columname,$fldvalue);
			  if($insertion_mode == 'edit')
			  {				  
				  if($iCount == 0)
				  {
					  $update = $columname."=".$fldvalue."";
					  $iCount =1;
				  }
				  else
				  {
					  $update .= ', '.$columname."=".$fldvalue."";
				  }
			  }
			  else
			  {
				  if($fldvalue != "NULL" && $fldvalue != "''") {
					  $column .= ", ".$columname;
					  $value .= ", ".$fldvalue."";
				  }
			  }
		  }
	  }

	  if($insertion_mode == 'edit' && trim($update) != '')
	  {

		  $sql1 = "update ".$table_name." set modifiedby='".$current_user->id."',modifiedtime=".$this->db->formatDate($date_var).",".$update." where ".$this->tab_name_index[$table_name]."=".$this->id;
		  $this->db->query($sql1);
	  }
	  else
	  {	
		if(isset($this->column_fields['createdtime']) && $this->column_fields['createdtime'] != "") {
			$createdtime = $this->column_fields['createdtime'];
		} else {
			$createdtime = $date_var;
		}
		if(isset($this->column_fields['modifiedtime']) && $this->column_fields['modifiedtime'] != "") {
			$modifiedtime = $this->column_fields['modifiedtime'];
		} else {
			$modifiedtime = $date_var;
		}
		if(isset($this->column_fields['smcreatorid']) && $this->column_fields['smcreatorid'] != "") {
			$smcreatorid = $this->column_fields['smcreatorid'];
		} else {
			$smcreatorid = $current_user->id;
		}
		//echo "value:".$value."<br>";
		//echo "column:".$column."<br>";
		
	    $sql1 = "insert into ".$table_name." (".$this->tab_name_index[$table_name]."".$column.",smcreatorid,smownerid,createdtime,modifiedtime) values(".$this->id."".$value.",'".$smcreatorid."','".$smcreatorid."',".$this->db->formatDate($createdtime).",".$this->db->formatDate($modifiedtime).")";
	    $this->db->query($sql1);
		if($current_user->id != $ownerid) {
			global $app_strings;
			$to_username = getUserName($ownerid);
			$content = $app_strings["NOW_THERE_ARE"]." <a href=\"index.php?module=".$module."&action=DetailView&record=".$this->id."\" target=\"_blank\">".$app_strings[$module]."</a> ".$app_strings["ASSIGNED_TO_NOTICE"];			
			sendMessage($content,$to_username);
		}
	  }

  }
	/** Function to delete a record in the specifed table 
  	  * @param $table_name -- table name:: Type varchar
	  * The function will delete a record .The id is obtained from the class variable $this->id and the columnname got from $this->tab_name_index[$table_name]
 	 */
function deleteRelation($table_name)
{
         $check_query = "select * from ".$table_name." where ".$this->tab_name_index[$table_name]."=".$this->id;
         $check_result=$this->db->query($check_query);
         $num_rows = $this->db->num_rows($check_result);

         if($num_rows == 1)
         {
                $del_query = "DELETE from ".$table_name." where ".$this->tab_name_index[$table_name]."=".$this->id;
                $this->db->query($del_query);
         }

}
	/** Function to attachment filename of the given entity 
  	  * @param $notesid -- crmid:: Type Integer
	  * The function will get the attachmentsid for the given entityid from ec_seattachmentsrel table and get the attachmentsname from ec_attachments table 
	  * returns the 'filename'
 	 */
function getOldFileName($notesid)
{
	global $log;
	$log->info("in getOldFileName  ".$notesid);
	$attachmentid = "";
	$filename = "";
	$query1 = "select attachmentsid from ec_seattachmentsrel where crmid=".$notesid;
	$result = $this->db->query($query1);
	$noofrows = $this->db->num_rows($result);
	if($noofrows != 0)
		$attachmentid = $this->db->query_result($result,0,'attachmentsid');
	if($attachmentid != '')
	{
		$query2 = "select name from ec_attachments where attachmentsid=".$attachmentid;
		$result = $this->db->query($query2);
		$filename = $this->db->query_result($result,0,'name');
	}
	return "'".$filename."'";
}
	
	
	





// Code included by Jaguar - Ends 

	/** Function to retrive the information of the given recordid ,module 
  	  * @param $record -- Id:: Type Integer
  	  * @param $module -- module:: Type varchar
	  * This function retrives the information from the database and sets the value in the class columnfields array
 	 */
  function retrieve_entity_info($record, $module)
  { 
    global $log,$app_strings;
	$log->info("Entering into function retrieve_entity_info()");
    $result = Array();
	//after deleting accounts with potential , when selecting potentail in quote and order , there are someting wrong with LBL_RECORD_DELETE error info
	//if(isset($_REQUEST['action']) && $_REQUEST['action']=='DetailView') {

	if($record != "") {
		foreach($this->tab_name_index as $table_name=>$index)
		{
			
			$result[$table_name] = $this->db->query("select * from ".$table_name." where ".$index."='".$record."'");
			if($this->db->query_result($result[$table_name],0,"deleted") == 1)
			die("<br><br><center>".$app_strings['LBL_RECORD_DELETE']." <a href='javascript:window.history.back()'>".$app_strings['LBL_GO_BACK'].".</a></center>");
		}

		//}
		
		//$sql1 = "select * from ec_field inner join ec_def_org_field on ec_def_org_field.fieldid=ec_field.fieldid";
		//$sql1.= " where ec_def_org_field.visible=0 and ec_field.tabid=".$tabid;
		//changed by dingjianting on 2007-11-11 for performance
		$key = "module_columnnames_".$module;
		$rows = getSqlCacheData($key);

		if(!$rows) {
			$tabid = getTabid($module);
			$sql1 =  "select columnname,tablename,fieldname from ec_field where tabid=".$tabid;
			$col_result = $this->db->query($sql1);
			$columnname_rows = array();
			while($col_row = $this->db->fetch_array($col_result)) {
				$temp_row = array();
				$temp_row["columnname"] = $col_row["columnname"];
				$temp_row["tablename"] = $col_row["tablename"];
				$temp_row["fieldname"] = $col_row["fieldname"];
				$rows[] = $temp_row;
				//unset($temp_row);
			}
			setSqlCacheData($key,$rows);
		}

		foreach($rows as $row)
		{
			$fieldcolname = $row["columnname"];
			$tablename = $row["tablename"];
			$fieldname = $row["fieldname"];
			//echo "fieldcolname:".$fieldcolname."<br>";
			//echo "tablename:".$tablename."<br>";
			//echo "fieldname:".$fieldname."<br>";
			$fld_value = $this->db->query_result($result[$tablename],0,$fieldcolname);
			$this->column_fields[$fieldname] = $fld_value;				
		}

		if($module == 'Users')
		{
			foreach($rows as $row)
			{
				$fieldcolname = $row["columnname"];
				$tablename = $row["tablename"];
				$fieldname = $row["fieldname"];
				$fld_value = $this->db->query_result($result[$tablename],0,$fieldcolname);
				$this->$fieldname = $fld_value;
			}
		}
			
		$this->column_fields["record_id"] = $record;
		$this->column_fields["record_module"] = $module;
	}
	$log->info("Exiting function retrieve_entity_info()");
  }

	/** Function to saves the values in all the tables mentioned in the class variable $tab_name for the specified module
  	  * @param $module -- module:: Type varchar
 	 */
	function save($module_name) 
	{
		global $log;
		global $app_strings;
	    $log->info("Entering into save method");
		/*
		if($this->mode == 'edit' && !empty($this->id)) {
			$last_modifiedtime = get_modified_time($this->id);
			echo "last_modifiedtime:".$last_modifiedtime."<br>";
			echo "modifiedtime:".$this->modifiedtime."<br>";
			if(isset($this->modifiedtime) && !empty($this->modifiedtime) && !empty($last_modifiedtime) && $last_modifiedtime > $this->modifiedtime) {
				echo "<script language='javascript'> alert('".$app_strings["ALREADY_SAVED"]."');history.back();</script>";
				exit();
			}
		}
		*/
		//GS Save entity being called with the modulename as parameter
		$this->saveentity($module_name);
		$action = "";
		if(isset($_REQUEST["action"])) $action = $_REQUEST["action"];

		$log->info("Exit save method");
		
		
	}

	function processWorkflowAfterSave($module_name) {
		$action = "";
		if(isset($_REQUEST["action"])) $action = $_REQUEST["action"];
		if($action != "Import") {
		$key = "workflowarr_".$module_name;
			$workflowArr = getSqlCacheData($key);
			if(!$workflowArr) {
				$workflowArr = array();
				$query = "select workflowmodulesid,workflowtype from ec_workflowmodules inner join ec_workflow on ec_workflow.workflowid=ec_workflowmodules.workflowmodulesid where primarymodule='".$module_name."'";
				$result =& $this->db->query($query,true,"Error revoke save: ");
				while ($row = $this->db->fetchByAssoc($result)) {								
					$workflowid = $row['workflowmodulesid'];			
					$workflowtype = $row['workflowtype'];
					$workflowArr[$workflowid] = $workflowtype;
				}
				setSqlCacheData($key,$workflowArr);
			}
			foreach($workflowArr as $workflowid=>$workflowtype) {
				if($workflowtype == 'A') {
					if($this->mode == '') {
						require_once("modules/Workflows/Workflows.php");
						require_once('modules/Workflows/WorkflowRun.php');
						$oWorkflowRun = new WorkflowRun($workflowid,$this);
						$oWorkflowRun->runWorkFlow();
					}
				} else {
						require_once("modules/Workflows/Workflows.php");
						require_once('modules/Workflows/WorkflowRun.php');
						$oWorkflowRun = new WorkflowRun($workflowid,$this);
						$oWorkflowRun->runWorkFlow();					
				}
			}
		}
	}
  
	function process_list_query($query, $row_offset, $limit= -1, $max_per_page = -1)
	{
		global $list_max_entries_per_page;
		$this->log->debug("process_list_query: ".$query);
		if(!empty($limit) && $limit != -1){
			$result =& $this->db->limitQuery($query, $row_offset + 0, $limit,true,"Error retrieving $this->object_name list: ");
		}else{
			$result =& $this->db->query($query,true,"Error retrieving $this->object_name list: ");
		}

		$list = Array();
		if($max_per_page == -1){
			$max_per_page 	= $list_max_entries_per_page;
		}
		$rows_found =  $this->db->getRowCount($result);

		$this->log->debug("Found $rows_found ".$this->object_name."s");
                
		$previous_offset = $row_offset - $max_per_page;
		$next_offset = $row_offset + $max_per_page;

		if($rows_found != 0)
		{

			// We have some data.

			for($index = $row_offset , $row = $this->db->fetchByAssoc($result, $index); $row && ($index < $row_offset + $max_per_page || $max_per_page == -99) ;$index++, $row = $this->db->fetchByAssoc($result, $index)){

				
				foreach($this->list_fields as $entry)
				{

					foreach($entry as $key=>$field) // this will be cycled only once
					{						
						if (isset($row[$field])) {
							$this->column_fields[$this->list_fields_names[$key]] = $row[$field];
						
						
							$this->log->debug("$this->object_name({$row['id']}): ".$field." = ".$this->$field);
						}
						else 
						{
							$this->column_fields[$this->list_fields_names[$key]] = "";
						}
					}
				}


				//$this->db->println("here is the bug");
				

				$list[] = clone($this);//added by Richie to support PHP5
			}
		}

		$response = Array();
		$response['list'] = $list;
		$response['row_count'] = $rows_found;
		$response['next_offset'] = $next_offset;
		$response['previous_offset'] = $previous_offset;

		return $response;
	}

	function process_full_list_query($query)
	{
		$this->log->debug("CRMEntity:process_full_list_query");
		$result =& $this->db->query($query, false);
		//changed by dingjianting on 2007-11-05 for php5.2.x
		//$this->log->debug("CRMEntity:process_full_list_query: result is ".$result);


		if($this->db->getRowCount($result) > 0){
		
		//	$this->db->println("process_full mid=".$this->module_id." mname=".$this->module_name);
			// We have some data.
			while ($row = $this->db->fetchByAssoc($result)) {				
				$rowid=$row[$this->module_id];

				if(isset($rowid) && $rowid != "")
			       		$this->retrieve_entity_info($rowid,$this->module_name);
				else
					$this->db->println("rowid not set unable to retrieve");
				 
				 
				
		//clone function added to resolvoe PHP5 compatibility issue in Dashboards
		//If we do not use clone, while using PHP5, the memory address remains fixed but the
	//data gets overridden hence all the rows that come in bear the same value. This in turn
//provides a wrong display of the Dashboard graphs. The data is erroneously shown for a specific month alone
//Added by Richie
				$list[] = clone($this);//added by Richie to support PHP5
			}
		}

		if (isset($list)) return $list;
		else return null;
	}
	
	/** This function should be overridden in each module.  It marks an item as deleted.
	* If it is not overridden, then marking this type of item is not allowed
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
	 * All Rights Reserved..
	 * Contributor(s): ______________________________________..
	*/
	function mark_deleted($id)
	{
        global $log;
        $log->debug("Entering mark_deleted() method ...");
		$entityArr = getEntityTableById($id);
	    $tablename = $entityArr["tablename"];
	    $entityidfield = $entityArr["entityidfield"];
		$query = "UPDATE ".$tablename." set deleted=1 where ".$entityidfield."='$id'";
		$this->db->query($query, true,"Error marking record deleted: ");
        $log->debug("Exiting mark_deleted method ...");

	}


	function retrieve_by_string_fields($fields_array, $encode=true) 
	{ 
		$where_clause = $this->get_where($fields_array);
		
		$query = "SELECT * FROM $this->table_name $where_clause";
		$this->log->debug("Retrieve $this->object_name: ".$query);
		$result =& $this->db->requireSingleResult($query, true, "Retrieving record $where_clause:");
		if( empty($result)) 
		{ 
		 	return null; 
		} 

		 $row = $this->db->fetchByAssoc($result,-1, $encode);

		foreach($this->column_fields as $field) 
		{ 
			if(isset($row[$field])) 
			{ 
				$this->$field = $row[$field];
			}
		} 
		return $this;
	}

	// this method is called during an import before inserting a bean
	// define an associative array called $special_fields
	// the keys are user defined, and don't directly map to the bean's ec_fields
	// the value is the method name within that bean that will do extra
	// processing for that ec_field. example: 'full_name'=>'get_names_from_full_name'

	function process_special_fields() 
	{ 
		foreach ($this->special_functions as $func_name) 
		{ 
			if ( method_exists($this,$func_name) ) 
			{ 
				$this->$func_name(); 
			} 
		} 
	}

	/**
         * Function to check if the custom ec_field ec_table exists
         * return true or false
         */
        function checkIfCustomTableExists($tablename)
        {
                $query = "select * from ".$tablename;
                $result = $this->db->query($query);
                $testrow = $this->db->num_fields($result);
                if($testrow > 1)
                {
                        $exists=true;
                }
                else
                {
                        $exists=false;
                }
                return $exists;
        }
        
		function get_attachments($id)
		{
			global $log;
			$log->debug("Entering get_attachments() method ...");
			$query = "SELECT ec_attachments.*, ec_users.user_name
				FROM ec_attachments			
				INNER JOIN ec_users
					ON ec_attachments.smcreatorid = ec_users.id
				INNER JOIN ec_seattachmentsrel ON ec_seattachmentsrel.attachmentsid = ec_attachments.attachmentsid
				WHERE  ec_attachments.deleted=0 and ec_seattachmentsrel.crmid = ".$id;			

			$log->debug("Exiting get_attachments method ...");
			return getAttachments($this->module_name,$query,$id);
		}

	/**
	 * function to construct the query to fetch the custom ec_fields
	 * return the query to fetch the custom ec_fields
         */
        function constructCustomQueryAddendum($tablename,$module)
        {
		        $tabid=getTabid($module);		
                $sql1 = "select columnname,fieldlabel from ec_field where generatedtype=2 and tabid=".$tabid;
                $result = $this->db->query($sql1);
                $numRows = $this->db->num_rows($result);
                $sql3 = "select ";
                for($i=0; $i < $numRows;$i++)
                {
                        $columnName = $this->db->query_result($result,$i,"columnname");
                        $fieldlable = $this->db->query_result($result,$i,"fieldlabel");
                        //construct query as below
                        if($i == 0)
                        {
                                $sql3 .= $tablename.".".$columnName. " '" .$fieldlable."'";
                        }
                        else
                        {
                                $sql3 .= ", ".$tablename.".".$columnName. " '" .$fieldlable."'";
                        }

                }
                if($numRows>0)
                {
                        $sql3=$sql3.',';
                }
                return $sql3;

        }

	/**
	 * Track the viewing of a detail record.  This leverages get_summary_text() which is object specific
	 * params $user_id - The user that is viewing the record.
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
	 * All Rights Reserved..
	 * Contributor(s): ______________________________________..
	 */
	function track_view($user_id, $current_module,$id='')
	{
		require_once('data/Tracker.php');
		$this->log->debug("About to call ec_tracker (user_id, module_name, item_id)($user_id, $current_module, $id)");
		$tracker = new Tracker();
		$tracker->track_view($user_id, $current_module, $id, '');
	}

	/**
	 * Save the related module record information. Triggered from CRMEntity->saveentity method or updateRelations.php
	 * @param String This module name
	 * @param Integer This module record number
	 * @param String Related module name
	 * @param mixed Integer or Array of related module record number
	 */
	function save_related_module($module, $crmid, $with_module, $with_crmid) {
		if(!is_array($with_crmid)) $with_crmid = Array($with_crmid);
		foreach($with_crmid as $relcrmid) {			
			$checkpresence = $this->db->pquery("SELECT crmid FROM ec_moduleentityrel WHERE 
				crmid = ? AND module = ? AND relcrmid = ? AND relmodule = ?", Array($crmid, $module, $relcrmid, $with_module));
			// Relation already exists? No need to add again
			if($checkpresence && $this->db->num_rows($checkpresence)) continue;
			$this->db->pquery("INSERT INTO ec_moduleentityrel(crmid, module, relcrmid, relmodule) VALUES(?,?,?,?)", 
				Array($crmid, $module, $relcrmid, $with_module));
			
		}
	}

	/**
	 * Delete the related module record information. Triggered from updateRelations.php
	 * @param String This module name
	 * @param Integer This module record number
	 * @param String Related module name
	 * @param mixed Integer or Array of related module record number
	 */
	function delete_related_module($module, $crmid, $with_module, $with_crmid) {
		if(!is_array($with_crmid)) $with_crmid = Array($with_crmid);
		foreach($with_crmid as $relcrmid) {
			$this->db->pquery("DELETE FROM ec_moduleentityrel WHERE crmid=? AND module=? AND relcrmid=? AND relmodule=?",
					Array($crmid, $module, $relcrmid, $with_module));
		}
	}

	/** Function to unlink an entity with given Id from another entity */
	function unlinkRelationship($id, $return_module, $return_id) {
		global $log;
		
		$query = 'DELETE FROM ec_moduleentityrel WHERE (crmid=? AND relmodule=? AND relcrmid=?) OR (relcrmid=? AND module=? AND crmid=?)';
		$params = array($id, $return_module, $return_id, $id, $return_module, $return_id);
		$this->db->pquery($query, $params);
	}

	/**
	 * Function to get related child custom module record (one to many)
	 * @param  integer   $id - currentModule id
	 * returns related child custom module record in array format
	 */
	function get_child_list($id,$related_tabname)
	{
		global $log,$singlepane_view,$currentModule;
        $log->debug("Entering get_child_list() method ...");
		require_once("modules/$related_tabname/$related_tabname.php");
		$focus = new $related_tabname();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module='.$currentModule.'&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module='.$currentModule.'&return_action=CallRelatedList&return_id='.$id;
		$key = "childlist_query_".$related_tabname;
		$query = getSqlCacheData($key);
		if(!$query) {
			$related_bean = substr($related_tabname,0,-1);
			$related_bean = strtolower($related_bean);
			$query = "SELECT ec_".$related_bean."s.*,
				ec_".$related_bean."s.".$related_bean."sid as crmid,ec_users.user_name
				FROM ec_".$related_bean."s 		
				LEFT join ec_moduleentityrel 
					ON ec_moduleentityrel.relcrmid = ec_".$related_bean."s.".$related_bean."sid 
				LEFT JOIN ec_users
					ON ec_".$related_bean."s.smownerid = ec_users.id
				WHERE ec_".$related_bean."s.deleted = 0";
			setSqlCacheData($key,$query);
		}
		$query .= " and ec_moduleentityrel.crmid = ".$id." ";
		$log->debug("Exiting get_child_list method ...");
		return GetRelatedList($currentModule,$related_tabname,$focus,$query,$button,$returnset);
	}

	/**
	 * Function to get related parent custom module record (one to many)
	 * @param  integer   $id - currentModule id
	 * returns related parent custom module record in array format
	 */
	function get_parent_list($id,$related_tabname)
	{
		global $log,$singlepane_view,$currentModule;
        $log->debug("Entering get_parent_list() method ...");
		require_once("modules/$related_tabname/$related_tabname.php");
		$focus = new $related_tabname();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module='.$currentModule.'&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module='.$currentModule.'&return_action=CallRelatedList&return_id='.$id;
		$key = "parentlist_query_".$related_tabname;
		$query = getSqlCacheData($key);
		if(!$query) {
			$related_bean = substr($related_tabname,0,-1);
			$related_bean = strtolower($related_bean);
			$query = "SELECT ec_".$related_bean."s.*,
				ec_".$related_bean."s.".$related_bean."sid as crmid,ec_users.user_name
				FROM ec_".$related_bean."s 
				LEFT JOIN ec_users
					ON ec_".$related_bean."s.smownerid = ec_users.id
				WHERE ec_".$related_bean."s.deleted = 0";
			setSqlCacheData($key,$query);
		}
		$query .= " and ec_moduleentityrel.relcrmid = ".$id." ";
		$log->debug("Exiting get_parent_list method ...");
		return GetRelatedList($currentModule,$related_tabname,$focus,$query,$button,$returnset);
	}

	/**
	* Function to get related custom module records
	* @param  integer   $id  - current tab record id
	* returns related custom module records in array format
	*/
	function get_generalmodules($id,$related_tabname)
	{
		global $log, $singlepane_view,$currentModule;
        $log->debug("Entering get_generalmodules() method ...");
		require_once("modules/$related_tabname/$related_tabname.php");
		$focus = new $related_tabname();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module='.$currentModule.'&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module='.$currentModule.'&return_action=CallRelatedList&return_id='.$id;
		$key = "generalmodules_".$currentModule."_query_".$related_tabname;
		$query = getSqlCacheData($key);
		$related_bean = substr($related_tabname,0,-1);
		$related_bean = strtolower($related_bean);
		$lowerCurrentModule = strtolower($currentModule);
		if(!$query) {		
			$query = "SELECT ec_".$related_bean."s.*,
				ec_".$related_bean."s.".$lowerCurrentModule."id as crmid,ec_users.user_name
				FROM ec_".$related_bean."s
				INNER JOIN ec_".$lowerCurrentModule."
					ON ec_".$lowerCurrentModule.".".$lowerCurrentModule."id = ec_".$related_bean."s.".$lowerCurrentModule."id
				LEFT JOIN ec_users
					ON ec_".$related_bean."s.smownerid = ec_users.id
				WHERE ec_".$related_bean."s.deleted = 0";
				setSqlCacheData($key,$query);
		}
		$query .= " and ec_".$related_bean."s.".$lowerCurrentModule."id = ".$id." ";
		$log->debug("Exiting get_generalmodules method ...");
		return GetRelatedList($currentModule,$related_tabname,$focus,$query,$button,$returnset);
	}

	/**
	 * get approve history for module
	**/
	function get_apprhtry($id) {
		return getApproveHistory($id); //function in include/utils/ApproveUtils.php
	}

	function get_modcomments($id) {
		return getModuleComments($id);
	}
}
?>
