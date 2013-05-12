<?php
include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');
require_once('modules/Qunfatmps/ModuleConfig.php');

// Note is used to store customer information.
class Qunfatmps extends CRMEntity {
	var $log;
	var $db;

	var $tab_name = Array('ec_crmentity','ec_qunfatmps');
	var $tab_name_index = Array('ec_crmentity'=>'crmid','ec_qunfatmps'=>'qunfatmpsid');
	var $entity_table = "ec_qunfatmps";

	var $column_fields = Array();

	var $sortby_fields = Array('qunfatmpname');

	// This is the list of ec_fields that are in the lists.
	/* Format: Field Label => Array(tablename, columnname) */
	// tablename should not have prefix 'ec_'
	var $list_fields = Array(
				'Qunfatmp Name'=>Array('qunfatmps'=>'qunfatmpname'),
		        'Assigned To'=>Array('crmentity'=>'smownerid')
				);
	/* Format: Field Label => fieldname */
	var $list_fields_name = Array(
					'Qunfatmp Name'=>'qunfatmpname',
		            'Assigned To'=>'assigned_user_id'
				     );
	var $required_fields =  array("qunfatmpname"=>1);
	var $list_link_field= 'qunfatmpname';
    /* Format: Field Label => Array(tablename, columnname) */
	// tablename should not have prefix 'ec_'
	var $search_fields = Array(
					'Qunfatmp Name'=>Array('qunfatmps'=>'qunfatmpname'),
					'Assigned To'=>Array('crmentity'=>'smownerid')
		);
	/* Format: Field Label => fieldname */
	var $search_fields_name = Array(
					'Qunfatmp Name'=>'qunfatmpname',
		            'Assigned To'=>'assigned_user_id'
		);
	//added for import and export function
	var $special_functions =  array("create_user","add_create_account");
	var $importable_fields = Array();

	//Added these variables which are used as default order by and sortorder in ListView
	var $default_order_by = 'modifiedtime';
	var $default_sort_order = 'DESC';
	var $is_custom_module = true;

	function Qunfatmps() {
		$this->log = LoggerManager::getLogger('qunfatmps');
		$this->log->debug("Entering Qunfatmps() method ...");
		$this->db = & getSingleDBInstance();
		$this->column_fields = getColumnFields('Qunfatmps');
		$this->log->debug("Exiting Qunfatmps method ...");
	}

	function save_module($module)
	{
		global $module_enable_product;
		if(isset($module_enable_product) && $module_enable_product && $_REQUEST['action'] != 'QunfatmpsAjax' && $_REQUEST['ajxaction'] != 'DETAILVIEW')
		{
			//$this->saveProductDetails(true); update product qty
			$this->saveProductDetails();

		}
	}


	/**
	 *      This function is used to add the ec_attachments. This will call the function uploadAndSaveFile which will upload the attachment into the server and save that attachment information in the database.
	 *      @param int $id  - entity id to which the ec_files to be uploaded
	 *      @param string $module  - the current module name
	*/
	function insertIntoAttachment($id,$module)
	{
		global $log;
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
	* Returns Export Qunfatmps Query.
	*/
	function create_export_query(&$order_by, &$where)
	{
		global $log;
		$log->debug("Entering create_export_query(".$order_by.",". $where.") method ...");

		include("include/utils/ExportUtils.php");

		//To get the Permitted fields query and the permitted fields list
		$module = "Qunfatmps";
		$sql = getPermittedFieldsQuery($module, "detail_view");
		global $mod_strings;
		global $current_language;
		if(empty($mod_strings)) {
			$mod_strings = return_module_language($current_language,"Qunfatmps");
		}
		$fields_list = $this->getFieldsListFromQuery($sql,$mod_strings);

		$query = "SELECT $fields_list FROM ec_qunfatmps
				LEFT JOIN ec_users
					ON ec_qunfatmps.smownerid = ec_users.id
				LEFT JOIN ec_users as ua
					ON ec_qunfatmps.approvedby = ua.id
				LEFT JOIN ec_users as ucreator
					ON ec_qunfatmps.smcreatorid = ucreator.id
				LEFT JOIN ec_approvestatus ON ec_qunfatmps.approved = ec_approvestatus.statusid ";
		$query .= " left join ec_account ON ec_qunfatmps.accountid=ec_account.accountid  ";
		$query .= " left join ec_contactdetails ON ec_qunfatmps.contact_id=ec_contactdetails.contactid  ";
		$query .= " left join ec_potential ON ec_qunfatmps.potentialid=ec_potential.potentialid  ";
		$query .= " left join ec_salesorder ON ec_qunfatmps.salesorderid=ec_salesorder.salesorderid  ";
		$query .= " left join ec_vendor ON ec_vendor.vendorid=ec_qunfatmps.vendorid  ";
		$query .= " left join ec_purchaseorder ON ec_purchaseorder.purchaseorderid=ec_qunfatmps.purchaseorderid  ";
		$query_rel = "SELECT ec_entityname.* FROM ec_crmentityrel inner join ec_entityname on ec_entityname.modulename=ec_crmentityrel.relmodule WHERE ec_crmentityrel.module='".$module."'";
		$fldmod_result = $this->db->query($query_rel);
		$rownum = $this->db->num_rows($fldmod_result);
		for($i=0;$i<$rownum;$i++) {
			$rel_modulename = $this->db->query_result($fldmod_result,$i,'modulename');
			$rel_tablename = $this->db->query_result($fldmod_result,$i,'tablename');
			$rel_entityname = $this->db->query_result($fldmod_result,$i,'fieldname');
			$rel_entityid = $this->db->query_result($fldmod_result,$i,'entityidfield');
			$query .= " left join ".$rel_tablename." ON ec_qunfatmps.".$rel_entityid."=".$rel_tablename.".".$rel_entityid;
		}
		$where_auto = " ec_qunfatmps.deleted = 0 ";

		if($where != "")
			$query .= " WHERE ($where) AND ".$where_auto;
		else
			$query .= " WHERE ".$where_auto;
		$tab_id = getTabid($module);
		if(($is_admin==false && $profileGlobalPermission[1] == 1 && $profileGlobalPermission[2] == 1 && $defaultOrgSharingPermission[$tab_id] == 3) || isset($_REQUEST['viewscope']) || isset($_SESSION[$module.'_viewscope']))
		{
			$sec_parameter=getListViewSecurityParameter($module,$isSearchAll);
			$query .= $sec_parameter;
		}

		$log->debug("Exiting create_export_query method ...");
		return $query;
	}

	/**	function used to get the list of fields from the input query as a comma seperated string
	 *	@param string $query - field table query which contains the list of fields
	 *	@return string $fields - list of fields as a comma seperated string
	 */
	function getFieldsListFromQuery($query,$export_mod_strings='')
	{
		global $log,$app_strings;
		$log->debug("Entering into the function getFieldsListFromQuery()");

		$result = $this->db->query($query);
		$num_rows = $this->db->num_rows($result);

		for($i=0; $i < $num_rows;$i++)
		{
			$columnName = $this->db->query_result($result,$i,"columnname");
			$fieldlabel = $this->db->query_result($result,$i,"fieldlabel");
			$tablename = $this->db->query_result($result,$i,"tablename");
			if(!empty($export_mod_strings) && isset($export_mod_strings[$fieldlabel]))
			{
				$fieldlabel = $export_mod_strings[$fieldlabel];
			}
			elseif(isset($app_strings[$fieldlabel]))
			{
				$fieldlabel = $app_strings[$fieldlabel];
			}
			if($columnName == 'smownerid')//for all assigned to user name
			{
				$fields .= "ec_users.user_name as '".$fieldlabel."', ";
			}
			elseif($columnName == 'accountid')//Account Name
			{
				$fields .= "ec_account.accountname as '".$fieldlabel."', ";
			}
			elseif($columnName == 'campaignid')//Campaign Source
			{
				$fields .= "ec_campaign.campaignname as '".$fieldlabel."',";
			}
			elseif($columnName == 'vendor_id')//Vendor Name
			{
				$fields .= "ec_vendor.vendorname as '".$fieldlabel."',";
			}
			elseif($columnName == 'vendorid')//Vendor Name
			{
				$fields .= "ec_vendor.vendorname as '".$fieldlabel."',";
			}
			elseif($columnName == 'potentialid')//Vendor Name
			{
				$fields .= "ec_potential.potentialname as '".$fieldlabel."',";
			}
			elseif($columnName == 'salesorderid')//Vendor Name
			{
				$fields .= "ec_salesorder.subject as '".$fieldlabel."',";
			}
			elseif($columnName == 'purchaseorderid')//Vendor Name
			{
				$fields .= "ec_purchaseorder.subject as '".$fieldlabel."',";
			}
			elseif($columnName == 'catalogid')//Catalog Name
			{
				$fields .= "ec_catalog.catalogname as '".$fieldlabel."',";
			}
			elseif($columnName == 'contact_id')//contact_id
			{
				$fields .= " ec_contactdetails.lastname as '".$fieldlabel."',";
			}
			elseif($columnName == 'smcreatorid')
			{
				$fields .= "ucreator.user_name as '".$fieldlabel."',";
			}
			elseif($columnName == 'approvedby')
			{
				$fields .= "ua.user_name as '".$fieldlabel."',";
			}
			elseif($columnName == 'approved')
			{
				$fields .= "ec_approvestatus.approvestatus as '".$fieldlabel."',";
			}
			else
			{
				$query_rel = "SELECT ec_entityname.* FROM ec_entityname WHERE ec_entityname.tabid>30 and ec_entityname.entityidfield='".$columnName."'";
				$fldmod_result = $this->db->query($query_rel);
				$rownum = $this->db->num_rows($fldmod_result);
				if($rownum > 0) {
					$rel_tablename = $this->db->query_result($fldmod_result,0,'tablename');
					$rel_entityname = $this->db->query_result($fldmod_result,0,'fieldname');
					$fields .= " ".$rel_tablename.".".$rel_entityname." as '".$fieldlabel."',";
				} else {
					$fields .= $tablename.".".$columnName. " '" .$fieldlabel."',";
				}
			}
		}
		$fields = trim($fields,",");

		$log->debug("Exit from the function getFieldsListFromQuery()");
		return $fields;
	}

	function getListQuery($where,$isSearchAll=false){
		global $current_user;
		$query = "SELECT ec_qunfatmps.qunfatmpsid as crmid,ec_users.user_name,
		ec_qunfatmps.* FROM ec_qunfatmps
		LEFT JOIN ec_users
			ON ec_users.id = ec_qunfatmps.smownerid ";

		$query .= " WHERE ec_qunfatmps.deleted = 0 and ec_users.id = '".$current_user->id."'";

		$query .= $where;		
		
		return $query;
	}

	/**
	* Function to get Qunfatmp related Accounts
	* @param  integer   $id      - qunfatmpsid
	* returns related accounts record in array format
	*/
	function get_accounts($id)
	{
		global $log, $singlepane_view;
        $log->debug("Entering get_accounts(".$id.") method ...");
		require_once('modules/Accounts/Accounts.php');
		global $app_strings;

		$focus = new Accounts();

		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Qunfatmps&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Qunfatmps&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_account.*,ec_account.accountid as crmid,ec_users.user_name
			FROM ec_account
			INNER JOIN ec_qunfatmps
				ON ec_qunfatmps.qunfatmpsid = ec_account.qunfatmpsid
			WHERE ec_qunfatmps.qunfatmpsid = ".$id."
			AND ec_account.deleted = 0";
		$log->debug("Exiting get_accounts method ...");
		return GetRelatedList('Qunfatmps','Accounts',$focus,$query,$button,$returnset);
	}

	//get next salesorder id
	function get_next_id() {
		//$query = "select count(*) as num from ec_qunfatmps";
		//$result = $this->db->query($query);
		//$num = $this->db->query_result($result,0,'num') + 1;
		$num = $this->db->getUniqueID("ec_qunfatmps");
		if($num > 99) return $num;
		elseif($num > 9) return "0".$num;
		else return "00".$num;
	}

	function getReportQuery($is_account=false,$is_contact=false) {
		 $query = "from ec_qunfatmps ";
		 $query .= " left join ec_account as ec_accountQunfatmps on ec_qunfatmps.accountid = ec_accountQunfatmps.accountid ";
		 $query .= " left join ec_contactdetails as ec_contactdetailsQunfatmps on ec_contactdetailsQunfatmps.contactid = ec_qunfatmps.contact_id  ";
		 $query .= " left join ec_potential as ec_potentialRel ON ec_potentialRel.potentialid=ec_qunfatmps.potentialid  ";
		 $query .= " left join ec_salesorder as ec_salesorderQunfatmps ON ec_salesorderQunfatmps.salesorderid=ec_qunfatmps.salesorderid  ";
		 $query .= " left join ec_vendor ec_vendorRel ON ec_vendorRel.vendorid=ec_qunfatmps.vendorid  ";
		 $query .= " left join ec_purchaseorder ec_purchaseorderQunfatmps ON ec_purchaseorderQunfatmps.purchaseorderid=ec_qunfatmps.purchaseorderid  ";
		 $query .= " left join ec_users as ec_usersApprove on ec_usersApprove.id = ec_qunfatmps.approvedby ";
		 $query .= " left join ec_users as ec_usersCreator on ec_usersCreator.id = ec_qunfatmps.smcreatorid ";
		 $query .= " left join ec_approvestatus as ec_approvestatus on ec_approvestatus.statusid = ec_crmentityQunfatmps.approved ";
		 $module = "Qunfatmps";
		 $query_rel = "SELECT ec_entityname.* FROM ec_crmentityrel inner join ec_entityname on ec_entityname.modulename=ec_crmentityrel.relmodule WHERE ec_crmentityrel.module='".$module."'";
		 $fldmod_result = $this->db->query($query_rel);
		 $rownum = $this->db->num_rows($fldmod_result);
		 for($i=0;$i<$rownum;$i++) {
			 $rel_modulename = $this->db->query_result($fldmod_result,$i,'modulename');
			 $rel_tablename = $this->db->query_result($fldmod_result,$i,'tablename');
			 $rel_entityname = $this->db->query_result($fldmod_result,$i,'fieldname');
			 $rel_entityid = $this->db->query_result($fldmod_result,$i,'entityidfield');
			 $query .= " left join ".$rel_tablename." as ".$rel_tablename."Qunfatmps on ec_qunfatmps.".$rel_entityid."=".$rel_tablename."Qunfatmps.".$rel_entityid;
		 }
		 $query .= " left join ec_users as ec_usersQunfatmps on ec_usersQunfatmps.id = ec_qunfatmps.smownerid where ec_qunfatmps.deleted=0 ";
		 return $query;
	}
	function getWorkflowQuery($is_account=false,$is_contact=false) {
		 $query = "select ec_qunfatmps.qunfatmpsid from ec_qunfatmps";
		 $query .= " left join ec_account as ec_accountQunfatmps on ec_qunfatmps.accountid = ec_accountQunfatmps.accountid ";
		 $query .= " left join ec_contactdetails as ec_contactdetailsQunfatmps on ec_contactdetailsQunfatmps.contactid = ec_qunfatmps.contact_id  ";
		 $query .= " left join ec_potential as ec_potentialRel ON ec_potentialRel.potentialid=ec_qunfatmps.potentialid  ";
		 $query .= " left join ec_salesorder as ec_salesorderQunfatmps ON ec_salesorderQunfatmps.salesorderid=ec_qunfatmps.salesorderid  ";
		 $query .= " left join ec_vendor ec_vendorRel ON ec_vendorRel.vendorid=ec_qunfatmps.vendorid  ";
		 $query .= " left join ec_purchaseorder ec_purchaseorderQunfatmps ON ec_purchaseorderQunfatmps.purchaseorderid=ec_qunfatmps.purchaseorderid  ";
		 $module = "Qunfatmps";
		 $query_rel = "SELECT ec_entityname.* FROM ec_crmentityrel inner join ec_entityname on ec_entityname.modulename=ec_crmentityrel.relmodule WHERE ec_crmentityrel.module='".$module."'";
		 $fldmod_result = $this->db->query($query_rel);
		 $rownum = $this->db->num_rows($fldmod_result);
		 for($i=0;$i<$rownum;$i++) {
			 $rel_modulename = $this->db->query_result($fldmod_result,$i,'modulename');
			 $rel_tablename = $this->db->query_result($fldmod_result,$i,'tablename');
			 $rel_entityname = $this->db->query_result($fldmod_result,$i,'fieldname');
			 $rel_entityid = $this->db->query_result($fldmod_result,$i,'entityidfield');
			 $query .= " left join ".$rel_tablename." as ".$rel_tablename."Qunfatmps on ec_qunfatmps.".$rel_entityid."=".$rel_tablename."Qunfatmps.".$rel_entityid;
		 }
		 $query .= " left join ec_users as ec_usersQunfatmps on ec_usersQunfatmps.id = ec_qunfatmps.smownerid where ec_qunfatmps.deleted=0 ";
		 return $query;
	}

	/**	Function used to get the sort order for Qunfatmps listview
	 *	@return string	$sorder	- first check the $_REQUEST['sorder'] if request value is empty then check in the $_SESSION['QUNFATMPS_SORT_ORDER'] if this session value is empty then default sort order will be returned.
	 */
	function getSortOrder()
	{
		global $log;
        $log->debug("Entering getSortOrder() method ...");
		if(isset($_REQUEST['sorder']))
			$sorder = $_REQUEST['sorder'];
		else
			$sorder = (isset($_SESSION['QUNFATMPS_SORT_ORDER'])?($_SESSION['QUNFATMPS_SORT_ORDER']):($this->default_sort_order));
		$log->debug("Exiting getSortOrder() method ...");
		return $sorder;
	}

	/**	Function used to get the order by value for QUNFATMPS listview
	 *	@return string	$order_by  - first check the $_REQUEST['order_by'] if request value is empty then check in the $_SESSION['QUNFATMPS_ORDER_BY'] if this session value is empty then default order by will be returned.
	 */
	function getOrderBy()
	{
		global $log;
        $log->debug("Entering getOrderBy() method ...");
		if (isset($_REQUEST['order_by']))
			$order_by = $_REQUEST['order_by'];
		else
			$order_by = (isset($_SESSION['QUNFATMPS_ORDER_BY'])?($_SESSION['QUNFATMPS_ORDER_BY']):($this->default_order_by));
		$log->debug("Exiting getOrderBy method ...");
		return $order_by;
	}

	/**
	function used to set the importable fields
    */
	function initImport()
	{
		foreach($this->column_fields as $key=>$value)
			$this->importable_fields[$key]=1;
	}

	/**
	function used to set the assigned_user_id value in the column_fields when we map the username during import
    */
	function assign_user()
	{
		global $current_user;
		$ass_user = $this->column_fields["assigned_user_id"];
		if( $ass_user != $current_user->id)
		{
			$result = $this->db->query("select id from ec_users where user_name = '".$ass_user."'");
			if($this->db->num_rows($result) != 1)
			{
				$this->column_fields["assigned_user_id"] = $current_user->id;
			}
			else
			{

				$row = $this->db->fetchByAssoc($result, -1, false);
				if (isset($row['id']) && $row['id'] != -1)
        	    {
					$this->column_fields["assigned_user_id"] = $row['id'];
				}
				else
				{
					$this->column_fields["assigned_user_id"] = $current_user->id;
				}
			}
		}
	}

	/**
	function used to set the assigned_user_id value in the column_fields when we map the username during import
    */
	function create_user()
	{
		global $current_user;
		$ass_user = $this->column_fields["smcreatorid"];
		if( $ass_user != $current_user->id)
		{
			$result = $this->db->query("select id from ec_users where user_name = '".$ass_user."'");
			if($this->db->num_rows($result) != 1)
			{
				$this->column_fields["smcreatorid"] = $current_user->id;
			}
			else
			{

				$row = $this->db->fetchByAssoc($result, -1, false);
				if (isset($row['id']) && $row['id'] != -1)
        	    {
					$this->column_fields["smcreatorid"] = $row['id'];
				}
				else
				{
					$this->column_fields["smcreatorid"] = $current_user->id;
				}
			}
		}
	}

	/**
	function used to create or map with existing account if the contact has mapped with an account during import
	 */
	function add_create_account()
    {
		global $imported_ids;
        global $current_user;
		require_once('modules/Accounts/Accounts.php');
		$acc_name = trim($this->column_fields['account_id']);
		if ((! isset($acc_name) || $acc_name == '') )
		{
			return;
		}
        $arr = array();
        $focus = new Accounts();
		$query = '';
		$acc_name = trim(addslashes($acc_name));
		$query = "select  ec_account.* from ec_account WHERE accountname like '%{$acc_name}%' and deleted=0";
		$result = $this->db->query($query);
		$row = $this->db->fetchByAssoc($result, -1, false);
		if (isset($row['accountid']) && $row['accountid'] != -1)
		{
			$focus->id = $row['accountid'];
		}
		if (! isset($focus->id) || $focus->id == '')
		{
			$focus->column_fields['accountname'] = $acc_name;
			$focus->column_fields['assigned_user_id'] = $current_user->id;
			$focus->column_fields['modified_user_id'] = $current_user->id;

			$focus->save("Accounts");
			$acc_id = $focus->id;
			// avoid duplicate mappings:
			if (!isset( $imported_ids[$acc_id]) )
			{
				$imported_ids[$acc_id] = 1;
			}
		}
		// now just link the ec_account
        $this->column_fields["account_id"] = $focus->id;

    }
    /**
	check whether record exists during import,
	the function default as disabled
	*/
	function isExist()
	{
		/*
		$where_clause = "and ec_qunfatmps.qunfatmpname like '%".trim($this->column_fields['qunfatmpname'])."%'";
		$query = "SELECT * FROM ec_qunfatmps  where deleted=0 $where_clause";
		$result = $this->db->query($query, false, "Retrieving record $where_clause");
		if ($this->db->getRowCount($result) > 0) {
			return true;
		}
		*/
		return false;
	}

	/**	Function used to save the Inventory product details for the passed entity
	 *	@param object reference $focus - object reference to which we want to save the product details from REQUEST values where as the entity will be out,in
	 *	@param string $module - module name
	 *	@param $update_prod_stock - true or false (default), if true we have to update the stock for PO only
	 *	@return void
	 */
	function saveProductDetails($update_prod_stock=false)
	{
		global $log;
		$log->debug("Entering into function saveProductDetails().");
		global $app_strings;
		$approveProcess = getApproveStatus($this->id);
		if($approveProcess == $app_strings['CONSTANTS_APPIN']) {
			return ;
		}
		if($this->mode == 'edit')
		{
			$query = "delete from ec_inventoryproductrel where id='".$this->id."'";
			$this->db->query($query);
		}
		$tot_no_prod = $_REQUEST['totalProductCount'];
		$prod_seq=1;
		for($i=1; $i<=$tot_no_prod; $i++)
		{
			$prod_id = $_REQUEST['hdnProductId'.$i];
			$qty = $_REQUEST['qty'.$i];
			$listprice = $_REQUEST['listPrice'.$i];
			$comment = addslashes($_REQUEST['comment'.$i]);
			//if the product is deleted then we should avoid saving the deleted products
			if(isset($_REQUEST["deleted".$i]) && $_REQUEST["deleted".$i] == 1)
				continue;
			$query ="insert into ec_inventoryproductrel(id, productid, sequence_no, quantity,listprice,comment) values($this->id, $prod_id , $prod_seq, $qty,$listprice,'$comment')";
			$prod_seq ++;
			$this->db->query($query);
			if($update_prod_stock) {
				$qtyinstock = getPrdQtyInStck($prod_id);
				$lates_qty = $qtyinstock+$qty;
				updateProductQty($prod_id,$lates_qty);
			}
		}
		$query ="update ec_qunfatmps set total='".$_REQUEST['total']."' where qunfatmpsid='".$this->id."'";
		$this->db->query($query);
		$log->debug("Exit from function saveProductDetails().");
	}

	/**	Function used to save the Inventory product details for the passed entity
	 *	@param object reference $focus - object reference to which we want to save the product details from REQUEST values where as the entity will be out,in
	 *	@param string $module - module name
	 *	@param $update_prod_stock - true or false (default), if true we have to update the stock for PO only
	 *	@return void
	 */
	function updateQtyInStock()
	{
		global $log;
		$log->debug("Entering into function updateQtyInStock().");
		$query = "select productid, quantity from ec_inventoryproductrel where id='".$this->id."'";
		$result = $this->db->query($query);
		while($row = $this->db->fetch_array($result)) {
			$productid = $row['productid'];
			$quantity = $row['quantity'];
			$qtyinstock = getPrdQtyInStck($productid);
			$lates_qty = $qtyinstock+$quantity;
			updateProductQty($productid,$lates_qty);
		}
		$log->debug("Exit from function updateQtyInStock().");
	}

	function getAssociatedProducts()
	{
		global $log;
		$log->debug("Entering getAssociatedProducts() method ...");
		$product_Detail = Array();
		$query="select ec_products.*,ec_inventoryproductrel.*,ec_products.productid as crmid,ec_catalog.catalogname,ec_vendor.vendorname from ec_inventoryproductrel inner join ec_products on ec_products.productid=ec_inventoryproductrel.productid left join ec_catalog on ec_catalog.catalogid=ec_products.catalogid left join ec_vendor on ec_vendor.vendorid=ec_products.vendor_id where ec_inventoryproductrel.id=".$this->id." ORDER BY sequence_no";
		$fieldlist = getProductFieldList("Qunfatmps");

		$result = $this->db->query($query);
		$num_rows = $this->db->num_rows($result);
		for($i=1;$i<=$num_rows;$i++)
		{
			$productid = $this->db->query_result($result,$i-1,'crmid');
			$product_Detail[$i]['delRow'.$i]="Del";
			$product_Detail[$i]['hdnProductId'.$i] = $productid;
			foreach($fieldlist as $fieldname) {
				if($fieldname != "imagename") {
					$fieldvalue = $this->db->query_result($result,$i-1,$fieldname);
					if(strpos($fieldname,"price")) {
						$fieldvalue = convertFromDollar($fieldvalue,1);
					}

				} else {
					$image_query = 'select ec_attachments.path, ec_attachments.attachmentsid, ec_attachments.name from ec_products left join ec_seattachmentsrel on ec_seattachmentsrel.crmid=ec_products.productid inner join ec_attachments on ec_attachments.attachmentsid=ec_seattachmentsrel.attachmentsid where productid='.$productid;
					$result_image = $this->db->query($image_query);
					$nums = $this->db->num_rows($result_image);
					if($nums > 0) {
						$image_id = $this->db->query_result($result_image,0,'attachmentsid');
						$image_name = $this->db->query_result($result_image,0,'name');
						$image_path = $this->db->query_result($result_image,0,'path');
						$imagename = $image_path.$image_id."_".base64_encode_filename($image_name);
					} else {
						$imagename = "";
					}
				}
				$product_Detail[$i][$fieldname.$i] = $fieldvalue;
			}
			$comment=$this->db->query_result($result,$i-1,'comment');
			$qty=$this->db->query_result($result,$i-1,'quantity');
			$listprice=$this->db->query_result($result,$i-1,'listprice');
			$discountPercent= $this->db->query_result($result,$i-1,'discount_percent');
			$discountAmount=$this->db->query_result($result,$i-1,'discount_amount');
			if(is_numeric ($discountPercent))
				$discountPercent=$discountPercent*100;
			//calculate productTotal
			if(is_numeric ($discountAmount)){
				$productTotal =$qty*$discountAmount;
			}else{
				$productTotal = $qty*$listprice;
			}
			$listprice = getConvertedPriceFromDollar($listprice);
			$productTotal = getConvertedPriceFromDollar($productTotal);
			$qty = convertFromDollar($qty,1);
			$product_Detail[$i]['qty'.$i]=$qty;
			$product_Detail[$i]['listPrice'.$i]=$listprice;
			$product_Detail[$i]['comment'.$i]= $comment;
			$product_Detail[$i]['productTotal'.$i]=$productTotal;
			$product_Detail[$i]['netPrice'.$i] = $productTotal;
		}

		$log->debug("Exiting getAssociatedProducts method ...");

		return $product_Detail;

	}

	function getDetailAssociatedProducts()
	{
		global $log;
		$log->debug("Entering getDetailAssociatedProducts() method ...");
		global $theme;
		global $log;
		global $app_strings,$current_user;
		$theme_path="themes/".$theme."/";
		$image_path=$theme_path."images/";
		$fieldlabellist = getProductFieldLabelList("Qunfatmps");
		$fieldnamelist = getProductFieldList("Qunfatmps");
        $output = "";
		$output .= '<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable" id="proTab">
		   <tr valign="top">
			<td colspan="50" class="dvInnerHeader"><b>'.$app_strings['LBL_PRODUCT_DETAILS'].'</b></td>
		   </tr>
		   <tr valign="top">';
		foreach($fieldlabellist as $field) {
			$output .= '<td width="'.$field["LABEL_WIDTH"].'" class="lvtCol"><b>'.$field["LABEL"].'</b></td>';
		}
		$output .= '
			<td width=10% class="lvtCol"><b>'.$app_strings['LBL_QTY'].'</b></td>
			<td width=10% class="lvtCol" align="left"><b>'.$app_strings['LBL_LIST_PRICE'].'</b></td>
			<td width=15% wrap class="lvtCol" align="left"><b>'.$app_strings['LBL_COMMENT'].'</b></td>';
		$output .= '<td width=15% nowrap class="lvtCol" align="right"><b>'.$app_strings['LBL_PRODUCT_TOTAL'].'</b></td>';
		$output .= '</tr>';
		$query="select ec_products.*,ec_inventoryproductrel.*,ec_products.productid as crmid,ec_catalog.catalogname,ec_vendor.vendorname from ec_inventoryproductrel inner join ec_products on ec_products.productid=ec_inventoryproductrel.productid   left join ec_catalog on ec_catalog.catalogid=ec_products.catalogid left join ec_vendor on ec_vendor.vendorid=ec_products.vendor_id where ec_inventoryproductrel.id=".$this->id." ORDER BY sequence_no";

		$result = $this->db->query($query);
		$num_rows=$this->db->num_rows($result);
		for($i=1;$i<=$num_rows;$i++)
		{
			$productid=$this->db->query_result($result,$i-1,'crmid');
			$comment=$this->db->query_result($result,$i-1,'comment');
			if(empty($comment)) $comment = "&nbsp;";
			$qty=$this->db->query_result($result,$i-1,'quantity');
			$listprice=$this->db->query_result($result,$i-1,'listprice');
			$total = $qty*$listprice;
			$qty = convertFromDollar($qty,1);
			$listprice = convertFromDollar($listprice,1);
			$total = convertFromDollar($total,1);
			$output .= '<tr valign="top">';
			foreach($fieldnamelist as $fieldname) {
				$fieldvalue = $this->db->query_result($result,$i-1,$fieldname);
				if($fieldname == "productname") {
					$output .= '<td class="crmTableRow small lineOnTop" nowrap>&nbsp;<a href="index.php?action=DetailView&module=Products&record='.$productid.'" target="_blank">'.$fieldvalue.'</a></td>';
				} elseif(strpos($fieldname,"price")) {
					$fieldvalue = convertFromDollar($fieldvalue,1);
					$output .= '<td class="crmTableRow small lineOnTop" nowrap>&nbsp;'.$fieldvalue.'</td>';
				} else {
					$output .= '<td class="crmTableRow small lineOnTop" nowrap>&nbsp;'.$fieldvalue.'</td>';
				}
			}
			$output .= '<td class="crmTableRow small lineOnTop">&nbsp;'.$qty.'</td>';
			$output .= '<td class="crmTableRow small lineOnTop">&nbsp;'.$listprice.'</td>';
			$output .= '<td class="crmTableRow small lineOnTop" valign="bottom" align="left">&nbsp;'.$comment.'</td>';
			$output .= '<td class="crmTableRow small lineOnTop" align="right">&nbsp;'.$total.'</td>';
			$output .= '</tr>';
		}

		$output .= '</table>';

		$output .= '<table width="100%" border="0" cellspacing="0" cellpadding="5" class="crmTable">';
		$grandTotal = ($this->column_fields['total'] != '')?$this->column_fields['total']:'0.00';
		$grandTotal = convertFromDollar($grandTotal,1);
		$output .= '<tr>';
		$output .= '<td class="crmTableRow big lineOnTop" width="80%" style="border-right:1px #dadada;">&nbsp;</td>';
		$output .= '<td align="right" class="crmTableRow small lineOnTop"><b>'.$app_strings['LBL_GRAND_TOTAL'].'</b></td>';
		$output .= '<td align="right" class="crmTableRow small lineOnTop">'.$grandTotal.'</td>';
		$output .= '</tr>';
		$output .= '</table>';

		$log->debug("Exiting getDetailAssociatedProducts method ...");
		return $output;

	}

	/**
	 * Function to get related Contacts
	 * @param  integer   $id      - qunfatmpsid
	 * returns related Contacts record in array format
	 */
	function get_contacts($id)
	{
		global $log, $singlepane_view;
		$log->debug("Entering get_contacts(".$id.") method ...");
		global $mod_strings;
		include_once("modules/Contacts/Contacts.php");
		$focus = new Contacts();
		$button = '';

		if($singlepane_view == 'true')
			$returnset = '&return_module=Qunfatmps&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Qunfatmps&return_action=CallRelatedList&return_id='.$id;

		$query = "select ec_account.accountname,ec_users.user_name, ec_contactdetails.*, ec_contactdetails.contactid as crmid from ec_contactdetails inner join ec_moduleentityrel on ec_moduleentityrel.relcrmid = ec_contactdetails.contactid left join ec_account on ec_account.accountid=ec_contactdetails.accountid left join ec_users on ec_contactdetails.smownerid=ec_users.id where ec_moduleentityrel.crmid = ".$id." and ec_contactdetails.deleted=0";

		$log->debug("Exiting get_contacts method ...");
		return GetRelatedList('Qunfatmps','Contacts',$focus,$query,$button,$returnset);
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
				ec_".$related_bean."s.".$related_bean."sid as crmid,ec_users.user_name
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

}
?>
