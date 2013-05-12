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
 * Contributor(s): ______________________________________..
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/modules/Notes/Notes.php,v 1.15 2005/03/15 10:01:08 shaw Exp $
 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');


// Note is used to store customer information.
class Notes extends CRMEntity {
	var $log;
	var $db;

	var $default_note_name_dom = array('Meeting ec_notes', 'notes');

	var $tab_name = Array('ec_crmentity','ec_notes');
	var $tab_name_index = Array('ec_crmentity'=>'crmid','ec_notes'=>'notesid');
	var $entity_table = "ec_notes";

	var $column_fields = Array();

    //var $sortby_fields = Array('notes_title','modifiedtime','contact_id','filename','smownerid');
	var $sortby_fields = Array('notes_title','contact_date','accountid','contact_id','notetype');

	// This is used to retrieve related ec_fields from form posts.
	var $additional_column_fields = Array('', '', '', '');

	// This is the list of ec_fields that are in the lists.
	var $list_fields = Array(
				'Note Title'=>Array('notes'=>'title'),
		        'Account Name' => Array('account'=>'accountname'),
		        'Contact Date'=>Array('notes'=>'contact_date'),
				'Note Type'=>Array('notes'=>'notetype'),
		       // 'Assigned To'=>Array('crmentity'=>'smownerid'),
				'Note'=>Array('notes'=>'notecontent')
				);
	var $list_fields_name = Array(
					'Note Title'=>'notes_title',
					'Account Name'=>'account_id',
		            'Note Type'=>'notetype',
		            'Contact Date'=>'contact_date',
		           // 'Assigned To'=>'assigned_user_id',
		            'Note'=>'notecontent'
				     );
	var $search_fields = Array(
				'Note Title'=>Array('notes'=>'notes_title'),
		        'Account Name' => Array('account'=>'accountname'),
		        'Contact Date'=>Array('notes'=>'contact_date'),
				'Note Type'=>Array('notes'=>'notetype'),
		       // 'Assigned To'=>Array('crmentity'=>'smownerid'),
		        'Note'=>Array('notes'=>'notecontent')
				);
	var $search_fields_name = Array(
					'Note Title'=>'notes_title',
					'Account Name'=>'accountid',
		            'Note Type'=>'notetype',
		            'Contact Date'=>'contact_date',
		           // 'Assigned To'=>'assigned_user_id',
		            'Note'=>'notecontent'
				     );
	var $required_fields =  array("title"=>1);
	var $list_link_field= 'title';

	//Added these variables which are used as default order by and sortorder in ListView
	var $default_order_by = 'contact_date';
	var $default_sort_order = 'DESC';

	function Notes() {
		$this->log = LoggerManager::getLogger('notes');
		$this->log->debug("Entering Notes() method ...");
		$this->db = & getSingleDBInstance();
		$this->column_fields = getColumnFields('Notes');
		$this->log->debug("Exiting Note method ...");
	}

	function save_module($module)
	{

		if($this->column_fields['account_id'] != '' && $this->column_fields['contact_date'] != '')
		{
			$date_var = date('YmdHis');
			$contact_date = $this->column_fields['contact_date'];
			$query = "update ec_account set contacttimes=contacttimes+1,contact_date='".$contact_date."',modifiedtime=".$this->db->formatString("ec_account","modifiedtime",$date_var)." where accountid='".$this->column_fields['account_id']."' and (contact_date is NULL or contact_date<'".$contact_date."')";
			$this->db->query($query);
		}


		//Inserting into attachments table
		$this->insertIntoAttachment($this->id,'Notes');

	}


	/**
	 *      This function is used to add the ec_attachments. This will call the function uploadAndSaveFile which will upload the attachment into the server and save that attachment information in the database.
	 *      @param int $id  - entity id to which the ec_files to be uploaded
	 *      @param string $module  - the current module name
	*/
	function insertIntoAttachment($id,$module)
	{
		global $log, $adb;
		$log->debug("Entering into insertIntoAttachment($id,$module) method.");

		$file_saved = false;

		foreach($_FILES as $fileindex => $files)
		{
			if($files['name'] != '' && $files['size'] > 0)
			{
				$file_saved = $this->uploadAndSaveFile($id,$module,$files);
			}
		}

		$log->debug("Exiting from insertIntoAttachment($id,$module) method.");
	}


	/** Function to export the notes in CSV Format
	* @param reference variable - order by is passed when the query is executed
	* @param reference variable - where condition is passed when the query is executed
	* Returns Export Notes Query.
	*/
	function create_export_query(&$order_by, &$where)
	{
		global $log;
		$log->debug("Entering create_export_query(".$order_by.",". $where.") method ...");

		include("include/utils/ExportUtils.php");

		//To get the Permitted fields query and the permitted fields list
		$sql = getPermittedFieldsQuery("Notes", "detail_view");
		global $mod_strings;
		global $current_language;
		if(empty($mod_strings)) {
			$mod_strings = return_module_language($current_language,"Notes");
		}
		$fields_list = getFieldsListFromQuery($sql,$mod_strings);

		$query = "SELECT $fields_list FROM ec_notes
				LEFT JOIN ec_contactdetails
					ON ec_notes.contact_id=ec_contactdetails.contactid
				LEFT JOIN ec_account
					ON ec_notes.accountid=ec_account.accountid
				LEFT JOIN ec_users
					ON ec_notes.smownerid = ec_users.id
				LEFT JOIN ec_users as ucreator
					ON ec_notes.smcreatorid = ucreator.id
				WHERE ec_notes.deleted=0 ".$where;

		$log->debug("Exiting create_export_query method ...");
                return $query;
        }

        /**	Function used to get the sort order for Sales Order listview
	 *	@return string	$sorder	- first check the $_REQUEST['sorder'] if request value is empty then check in the $_SESSION['SALESORDER_SORT_ORDER'] if this session value is empty then default sort order will be returned.
	 */
	function getSortOrder()
	{
		global $log;
                $log->debug("Entering getSortOrder() method ...");
		if(isset($_REQUEST['sorder']))
			$sorder = $_REQUEST['sorder'];
		else
			$sorder = (isset($_SESSION['NOTES_SORT_ORDER'])?($_SESSION['NOTES_SORT_ORDER']):($this->default_sort_order));
		$log->debug("Exiting getSortOrder() method ...");
		return $sorder;
	}

    /**	Function used to get the order by value for Sales Order listview
	 *	@return string	$order_by  - first check the $_REQUEST['order_by'] if request value is empty then check in the $_SESSION['SALESORDER_ORDER_BY'] if this session value is empty then default order by will be returned.
	 */
	function getOrderBy()
	{
		global $log;
                $log->debug("Entering getOrderBy() method ...");
		if (isset($_REQUEST['order_by']))
			$order_by = $_REQUEST['order_by'];
		else
			$order_by = (isset($_SESSION['NOTES_ORDER_BY'])?($_SESSION['NOTES_ORDER_BY']):($this->default_order_by));
		$log->debug("Exiting getOrderBy method ...");
		return $order_by;
	}

	 /** Function to add lead group relation
		  * @param $leadid -- Lead Id:: Type integer
		  * @param $groupname -- Group Name:: Type varchar
		  *
		 */
		function insert2NotesGroupRelation($notesid,$groupname)
		{
			global $log;
			$log->debug("Entering insert2NotesGroupRelation(".$notesid.",".$groupname.") method ...");
			global $adb;
			$sql = "insert into ec_notesgrouprelation values (" .$notesid .",'".$groupname."')";
			$adb->query($sql);
			$log->debug("Exiting insert2NotesGroupRelation method ...");
		}

		/** Function to update lead group relation
		  * @param $leadid -- Lead Id:: Type integer
		  * @param $groupname -- Group Name:: Type varchar
		  *
		 */
		function updateNotesGroupRelation($notesid,$groupname)
		{
			global $log;
			$log->debug("Entering updateNotesGroupRelation(".$notesid.",".$groupname.") method ...");
			global $adb;
			$sqldelete = "delete from ec_notesgrouprelation where notesid=".$notesid;
			$adb->query($sqldelete);
			if(!empty($groupname)) {
				$sql = "insert into ec_notesgrouprelation values (".$notesid .",'" .$groupname ."')";
				$adb->query($sql);
			}
			$log->debug("Exiting updateNotesGroupRelation method ...");
		}

		function getReportQuery() {
			$query = "from ec_notes
			left join ec_account as ec_accountNotes on ec_notes.accountid = ec_accountNotes.accountid
			left join ec_contactdetails as ec_contactdetailsNotes on ec_contactdetailsNotes.contactid = ec_notes.contact_id
			left join ec_potential as ec_potentialRel on ec_potentialRel.potentialid = ec_notes.potentialid
			left join ec_users as ec_usersNotes on ec_usersNotes.id = ec_notes.smownerid where ec_notes.deleted=0 ";
			return $query;
		}
		function getWorkflowQuery() {
			$query = "select ec_notes.notesid from ec_notes
			left join ec_account as ec_accountNotes on ec_notes.accountid = ec_accountNotes.accountid
			left join ec_contactdetails as ec_contactdetailsNotes on ec_contactdetailsNotes.contactid = ec_notes.contact_id
			left join ec_potential as ec_potentialRel on ec_potentialRel.potentialid = ec_notes.potentialid
			left join ec_users as ec_usersNotes on ec_usersNotes.id = ec_notes.smownerid where ec_notes.deleted=0 ";
			return $query;
		}
}
?>
