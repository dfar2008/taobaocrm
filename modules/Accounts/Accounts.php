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
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/modules/Accounts/Accounts.php,v 1.53 2005/04/28 08:06:45 rank Exp $
 * Description:  Defines the Account SugarBean Account entity with the necessary
 * methods and variables.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');
require_once('modules/Notes/Notes.php');
require_once('modules/Users/Users.php');
require_once('include/utils/utils.php');
require_once('user_privileges/default_module_view.php');

// Account is used to store ec_account information.
class Accounts extends CRMEntity {
	var $log;
	var $db;

    var $entity_table = "ec_account";
	var $tab_name = Array('ec_crmentity','ec_account');
	var $tab_name_index = Array('ec_crmentity'=>'crmid','ec_account'=>'accountid');


	var $column_fields = Array();

	var $sortby_fields = Array('accountname','city','website','phone','smownerid');


	// This is the list of ec_fields that are in the lists.
	var $list_fields = Array(
			'Account Name'=>Array('ec_account'=>'accountname'),
			'Tao MemberName'=>Array('ec_account'=>'membername'),
			'Phone'=>Array('ec_account'=> 'phone'),
			'Email'=>Array('ec_account'=>'email')
			);

	var $list_fields_name = Array(
			'Account Name'=>'accountname',
			'Tao MemberName'=>'membername',
			'Phone'=>'phone',
			'Email'=>'email'
			);
	var $list_link_field= 'accountname';

	var $search_fields = Array(
			'Account Name'=>Array('ec_account'=>'accountname'),
			'Tao MemberName'=>Array('ec_account'=>'membername'),
		    'Phone'=>Array('ec_account'=> 'phone'),
		    'Email'=>Array('ec_account'=>'email')
			);

	var $search_fields_name = Array(
			'Account Name'=>'accountname',
			'Tao MemberName'=>'membername',
            'Phone'=>'phone',
		    'Email'=>'email'
			);


	//Added these variables which are used as default order by and sortorder in ListView
	var $default_order_by = 'modifiedtime';
	var $default_sort_order = 'DESC';

	function Accounts() {
		$this->log =LoggerManager::getLogger('account');
		$this->db = & getSingleDBInstance();
		$this->column_fields = getColumnFields('Accounts');
	}

	/** Function to handle module specific operations when saving a entity
	*/
	function save_module($module)
	{
		if($this->column_fields['accountname'] != "")
		{
            //ALTER TABLE `ec_account` CHANGE `prefix` `prefix` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
			$prefixa = getEveryWordFirstSpell($this->column_fields['accountname']);
			$query = "update ec_account set prefix='".$prefixa."' where accountid='".$this->id."'";
		    $this->db->query($query);
		}
	}


	// Mike Crowe Mod --------------------------------------------------------Default ordering for us
	/**
	 * Function to get sort order
 	 * return string  $sorder    - sortorder string either 'ASC' or 'DESC'
	 */
	function getSortOrder()
	{
		global $log;
                $log->debug("Entering getSortOrder() method ...");
		if(isset($_REQUEST['sorder']))
			$sorder = $_REQUEST['sorder'];
		else
			$sorder = ((isset($_SESSION['ACCOUNTS_SORT_ORDER']) && $_SESSION['ACCOUNTS_SORT_ORDER'] != '')?($_SESSION['ACCOUNTS_SORT_ORDER']):($this->default_sort_order));
		$log->debug("Exiting getSortOrder() method ...");
		return $sorder;
	}
	/**
	 * Function to get order by
	 * return string  $order_by    - fieldname(eg: 'accountname')
 	 */
	function getOrderBy()
	{
		global $log;
                $log->debug("Entering getOrderBy() method ...");
		if (isset($_REQUEST['order_by']))
			$order_by = $_REQUEST['order_by'];
		else
			$order_by = ((isset($_SESSION['ACCOUNTS_ORDER_BY']) && $_SESSION['ACCOUNTS_ORDER_BY'] != '')?($_SESSION['ACCOUNTS_ORDER_BY']):($this->default_order_by));
		$log->debug("Exiting getOrderBy method ...");
		return $order_by;
	}
	// Mike Crowe Mod --------------------------------------------------------


	/** Returns a list of the associated contacts
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
	 * All Rights Reserved..
	 * Contributor(s): ______________________________________..
	 */


	/** Returns a list of the associated opportunities
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
	 * All Rights Reserved..
	 * Contributor(s): ______________________________________..
	 */
	function get_opportunities($id)
	{
		global $log, $singlepane_view;
                $log->debug("Entering get_opportunities(".$id.") method ...");
		global $mod_strings;

		$focus = new Potentials();
		$button = '';


		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_potential.*,ec_users.user_name,ec_potential.potentialid as crmid FROM ec_potential
			LEFT join ec_moduleentityrel
					ON ec_moduleentityrel.crmid = ec_potential.potentialid
			LEFT JOIN ec_users
				ON ec_potential.smownerid = ec_users.id
			WHERE ec_potential.deleted = 0
			AND (ec_potential.accountid = '".$id."' or ec_moduleentityrel.relcrmid='".$id."')";
		$log->debug("Exiting get_opportunities method ...");

		return GetRelatedList('Accounts','Potentials',$focus,$query,$button,$returnset);
	}

	/** Returns a list of the associated tasks
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
	 * All Rights Reserved..
	 * Contributor(s): ______________________________________..
	 */
	function get_activities($id)
	{
		global $log, $singlepane_view;
                $log->debug("Entering get_activities(".$id.") method ...");
		global $mod_strings;

		$focus = new Activity();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_activity.*,
			ec_seactivityrel.*,ec_users.user_name,ec_recurringevents.recurringtype,ec_activity.activityid as crmid
			FROM ec_activity
			LEFT JOIN ec_seactivityrel
				ON ec_seactivityrel.activityid = ec_activity.activityid
			LEFT JOIN ec_users
				ON ec_users.id = ec_activity.smownerid
			LEFT OUTER JOIN ec_recurringevents
				ON ec_recurringevents.activityid = ec_activity.activityid
			WHERE ec_activity.deleted = 0 AND ec_activity.eventstatus!='' and (ec_seactivityrel.crmid='".$id."' or ec_activity.accountid='".$id."')";
		$log->debug("Exiting get_activities method ...");
		return GetRelatedList('Accounts','Calendar',$focus,$query,$button,$returnset);

	}

	/**
	 * Function to get Account related Attachments
 	 * @param  integer   $id      - accountid
 	 * returns related Attachment record in array format
 	 */
	function get_notes($id)
	{
		global $log,$singlepane_view;
        $log->debug("Entering get_notes(".$id.") method ...");
		require_once('modules/Notes/Notes.php');
		$focus = new Notes();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_notes.*,ec_account.accountname,ec_users.user_name,ec_notes.notesid as crmid
			FROM ec_notes
			LEFT JOIN ec_account
				ON ec_account.accountid = ec_notes.accountid
			LEFT JOIN ec_users
				ON ec_notes.smownerid = ec_users.id
			WHERE ec_account.accountid = ".$id."
			AND ec_notes.deleted = 0 ";

		$log->debug("Exiting get_notes method ...");
		return GetRelatedList('Accounts','Notes',$focus,$query,$button,$returnset);
	}
	/**
	* Function to get Account related Quotes
	* @param  integer   $id      - accountid
	* returns related Quotes record in array format
	*/

	function get_quotes($id)
	{
		global $log, $singlepane_view;
                $log->debug("Entering get_quotes(".$id.") method ...");
		global $app_strings;
		require_once('modules/Quotes/Quotes.php');

		$focus = new Quotes();

		$button = '';

		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_users.user_name,
			ec_quotes.*,
			ec_potential.potentialname,ec_quotes.quoteid as crmid,
			ec_account.accountname
			FROM ec_quotes
			LEFT OUTER JOIN ec_account
				ON ec_account.accountid = ec_quotes.accountid
			LEFT OUTER JOIN ec_potential
				ON ec_potential.potentialid = ec_quotes.potentialid
			LEFT JOIN ec_users
				ON ec_quotes.smownerid = ec_users.id
			WHERE ec_quotes.deleted = 0
			AND ec_account.accountid = ".$id;
		$log->debug("Exiting get_quotes method ...");
		return GetRelatedList('Accounts','Quotes',$focus,$query,$button,$returnset);
	}
	/**
	* Function to get Account related Invoices
	* @param  integer   $id      - accountid
	* returns related Invoices record in array format
	*/
	function get_invoices($id)
	{
		global $log, $singlepane_view;
                $log->debug("Entering get_invoices(".$id.") method ...");
		global $app_strings;
		require_once('modules/Invoice/Invoice.php');

		$focus = new Invoice();

		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_users.user_name,ec_invoice.*,ec_invoice.invoiceid as crmid,ec_account.accountname,ec_salesorder.subject AS salessubject
			FROM ec_invoice
			LEFT OUTER JOIN ec_account
				ON ec_account.accountid = ec_invoice.accountid
			LEFT OUTER JOIN ec_salesorder
				ON ec_salesorder.salesorderid = ec_invoice.salesorderid
			LEFT JOIN ec_users
				ON ec_invoice.smownerid = ec_users.id
			WHERE ec_invoice.deleted = 0 AND ec_account.accountid = ".$id;
		$log->debug("Exiting get_invoices method ...");
		return GetRelatedList('Accounts','Invoice',$focus,$query,$button,$returnset);
	}

	/**
	* Function to get Account related SalesOrder
	* @param  integer   $id      - accountid
	* returns related SalesOrder record in array format
	*/
	function get_salesorder($id)
	{
		global $log, $singlepane_view;
        $log->debug("Entering get_salesorder(".$id.") method ...");
		require_once('modules/SalesOrder/SalesOrder.php');
		global $app_strings;

		$focus = new SalesOrder();

		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_salesorder.*,ec_salesorder.salesorderid as crmid,
			ec_account.accountname,
			ec_users.user_name
			FROM ec_salesorder
			LEFT OUTER JOIN ec_account
				ON ec_account.accountid = ec_salesorder.accountid
			LEFT JOIN ec_users
				ON ec_salesorder.smownerid = ec_users.id
			WHERE ec_salesorder.deleted = 0
			AND ec_salesorder.accountid = ".$id;
		$log->debug("Exiting get_salesorder method ...");
		return GetRelatedList('Accounts','SalesOrder',$focus,$query,$button,$returnset);
	}
	
	/**
	* Function to get Account related Products
	* @param  integer   $id      - accountid
	* returns related Products record in array format
	*/
	function get_products($id)
	{
		global $log, $singlepane_view;
                $log->debug("Entering get_products(".$id.") method ...");
		require_once('modules/Products/Products.php');
		global $app_strings;

		$focus = new Products();

		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

//		$query = "SELECT ec_products.*,ec_products.productid as crmid FROM ec_products
//			INNER JOIN ec_accountproductrel
//				ON ec_products.productid = ec_accountproductrel.productid
//			INNER JOIN ec_account
//				ON ec_account.accountid = ec_accountproductrel.accountid
//			WHERE ec_account.accountid = ".$id."
//			AND ec_products.deleted = 0";
        $query = "select ec_products.*,ec_products.productid as crmid from ec_products
		where productid in
		(select distinct productid  from ec_inventoryproductrel where id in
		(select salesorderid from ec_salesorder where ec_salesorder.accountid=".$id."))";

		$log->debug("Exiting get_products method ...");
		return GetRelatedList('Accounts','Products',$focus,$query,$button,$returnset);
	}

	/**
	* Function to get Account related Products
	* @param  integer   $id      - accountid
	* returns related Products record in array format
	*/
	function get_soproducts($id)
	{
		global $log, $singlepane_view;
                $log->debug("Entering get_products(".$id.") method ...");
		require_once('modules/Products/Products.php');
		global $app_strings;

		$focus = new Products();

		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_products.productid, ec_products.productname,
			ec_products.productcode, ec_products.commissionrate,
			ec_products.qty_per_unit, ec_inventoryproductrel.listprice as unit_price,ec_products.productid as crmid
			FROM ec_products
			INNER JOIN ec_inventoryproductrel
				ON ec_products.productid = ec_inventoryproductrel.productid
			INNER JOIN ec_salesorder on ec_salesorder.salesorderid=ec_inventoryproductrel.id
			INNER JOIN ec_account
				ON ec_account.accountid = ec_salesorder.accountid
			WHERE ec_account.accountid = ".$id."
			AND ec_products.deleted = 0";
		$log->debug("Exiting get_products method ...");
		return GetRelatedList('Accounts','Products',$focus,$query,$button,$returnset);
	}

	/**
	* Function to get Account related Gathers
	* @param  integer   $id      - accountid
	* returns related Gathers record in array format
	*/
	function get_gathers($id)
	{
		global $log, $singlepane_view;
		global $app_strings;
        $log->debug("Entering get_gathers(".$id.") method ...");
		require_once('modules/Gathers/Gathers.php');
		$focus = new Gathers();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_gathers.*,ec_users.user_name, ec_users.id,ec_gathers.gathersid as crmid
			FROM ec_gathers
			INNER JOIN ec_account
				ON ec_account.accountid = ec_gathers.accountid
			LEFT JOIN ec_users
				ON ec_gathers.smownerid = ec_users.id
			WHERE ec_account.accountid = ".$id."
			AND ec_gathers.deleted = 0";
		$log->debug("Exiting get_products method ...");
		return GetRelatedList('Accounts','Gathers',$focus,$query,$button,$returnset);
	}

	/** Function to export the account records in CSV Format
	* @param reference variable - order by is passed when the query is executed
	* @param reference variable - where condition is passed when the query is executed
	* Returns Export Accounts Query.
	*/
	function create_export_query(&$order_by, &$where)
	{
		global $log;
		global $current_user; 
        $log->debug("Entering create_export_query(".$order_by.",".$where.") method ...");

		include("include/utils/ExportUtils.php");

		//To get the Permitted fields query and the permitted fields list
		$sql = getPermittedFieldsQuery("Accounts", "detail_view");
		global $mod_strings;
		global $current_language;
		if(empty($mod_strings)) {
			$mod_strings = return_module_language($current_language,"Accounts");
		}
		$fields_list = getFieldsListFromQuery($sql,$mod_strings);

		$query = "SELECT $fields_list FROM ec_account
				LEFT JOIN ec_users
					ON ec_account.smownerid = ec_users.id
				LEFT JOIN ec_users as ucreator
					ON ec_account.smcreatorid = ucreator.id ";


		$where_auto = " ec_account.deleted = 0 ";

		if($where != "")
			$query .= "WHERE ($where)  AND ".$where_auto;
		else
			$query .= "WHERE ".$where_auto;
		
		$query .= " and ucreator.id=".$_SESSION['authenticated_user_id']." ";	
		
		if(!empty($order_by))
			$query .= " ORDER BY $order_by";

		$log->debug("Exiting create_export_query method ...");
		return $query;
	}


	/**
	* Function to get PurchaseOrder related Tuihuos
	* @param  integer   $id      - purchaseorderid
	* returns related Tuihuos record in array format
	*/
	function get_tuihuos($id)
	{
		global $log, $singlepane_view;
		global $app_strings;
        $log->debug("Entering get_tuihuos(".$id.") method ...");
		require_once('modules/Tuihuos/Tuihuos.php');
		$focus = new Tuihuos();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_tuihuos.*,ec_tuihuos.tuihuosid as crmid,ec_users.user_name FROM ec_tuihuos
			INNER JOIN ec_account
				ON ec_account.accountid = ec_tuihuos.accountid
			LEFT JOIN ec_users
				ON ec_tuihuos.smownerid = ec_users.id
			WHERE ec_tuihuos.accountid = ".$id."
			AND ec_tuihuos.deleted = 0";
		$log->debug("Exiting get_tuihuos method ...");
		return GetRelatedList('Accounts','Tuihuos',$focus,$query,$button,$returnset);
	}

	function get_cares($id)
	{
		global $log, $singlepane_view;
		global $app_strings;
        $log->debug("Entering get_cares(".$id.") method ...");
		require_once('modules/Cares/Cares.php');
		$focus = new Cares();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_cares.*,ec_cares.caresid as crmid,ec_users.user_name FROM ec_cares
			INNER JOIN ec_account
				ON ec_account.accountid = ec_cares.accountid
			LEFT JOIN ec_users
				ON ec_cares.smownerid = ec_users.id
			WHERE ec_cares.accountid = ".$id."
			AND ec_cares.deleted = 0";
		$log->debug("Exiting get_cares method ...");
		return GetRelatedList('Accounts','Cares',$focus,$query,$button,$returnset);
	}
	function get_projects($id)
	{
		global $log, $singlepane_view;
		global $app_strings;
        $log->debug("Entering get_projects(".$id.") method ...");
		require_once('modules/Projects/Projects.php');
		$focus = new Projects();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_projects.*,ec_projects.projectsid as crmid,ec_users.user_name FROM ec_projects
			INNER JOIN ec_account
				ON ec_account.accountid = ec_projects.accountid
			LEFT JOIN ec_users
				ON ec_projects.smownerid = ec_users.id
			WHERE ec_projects.accountid = ".$id."
			AND ec_projects.deleted = 0";
		$log->debug("Exiting get_projects method ...");
		return GetRelatedList('Accounts','Projects',$focus,$query,$button,$returnset);
	}

	function get_assignhistory($id)
	{
		global $log;
		$log->debug("Entering get_assignhistory(".$id.") method ...");

		global $adb;
		global $mod_strings;
		global $app_strings;

		$query = 'select ec_assignhistory.*,ec_users.user_name,ec_users.id from ec_assignhistory inner join ec_users on ec_users.id=ec_assignhistory.userid where accountid = '.$id.' order by assigntime desc';
		$result=$adb->query($query);
		$noofrows = $adb->num_rows($result);

		$header[] = $mod_strings['Assigned To'];
		$header[] = $mod_strings['startdate'];
		$header[] = $mod_strings['enddate'];
		$header[] = $mod_strings['assigntime'];

		while($row = $adb->fetch_array($result))
		{
			$entries = Array();

			$entries[] = $row['user_name'];
			$entries[] = $row['startdate'];
			$entries[] = $row['enddate'];
			$entries[] = getDisplayDate($row['assigntime']);

			$entries_list[] = $entries;
		}

		$return_data = Array('header'=>$header,'entries'=>$entries_list);

	 	$log->debug("Exiting get_assignhistory method ...");

		return $return_data;
	}
	
	function get_webmails($id){
        require_once("modules/Webmails/inc/commonlib.php");
        global $adb,$current_user;
        global $mod_strings;
		global $app_strings;
        $datetime_format = "%Y/%m/%d %H:%M (%a)";
        $emails=array();
        $sql="select email1,email2 from ec_account where accountid='$id' ";
        $result=$adb->query($sql);
        $email1=$adb->query_result($result,0,"email1");
        if(!empty($email1)) $emails[]=$adb->quote($email1);
        $email2=$adb->query_result($result,0,"email2");
        if(!empty($email2)) $emails[]=$adb->quote($email2);

        $header=array();
        $header[] = '主题';
        $header[] = '邮件来源';
        $header[] = '发件邮箱';
		$header[] = '收件邮箱';
		$header[] = '日期';
        $header[] = '大小';
        $header[] = '文件夹';
        $header[] = '是否已读';

        $entries_list=array();
        if(count($emails)>0){
            $emailstr=implode(",",$emails);
            $query="select ec_webmails.*,'收邮件' as webmailtype from ec_webmails
            where ec_webmails.userid={$current_user->id} and ec_webmails.deleted=0 and (from_email in ($emailstr))
            union
            select ec_webmails.*,'发邮件' as webmailtype from ec_webmails
            where ec_webmails.userid={$current_user->id} and ec_webmails.deleted=0 and (to_email in ($emailstr))";
            $result=$adb->query($query);
            $folderarr=Array("INBOX"=>"收件箱", "Draft"=>"草稿箱", "Sent"=>"已发送", "Trash"=>'已删除', "Spam"=>'垃圾箱');
            while($row=$adb->fetch_array($result)){
                $entries = Array();
                $msgid=$row['msgid'];
                $subject=$row['subject'];
                $localname=$row['localname'];
                $folder=$row['folder'];
                $foldername=empty($folderarr[$folder])?$folder:$folderarr[$folder];
                $sentdate=$row['date'];
                $dispdate = @convert(strftime($datetime_format, $sentdate));
                $size = ceil($row["size"]/1024);
                $msg_flags=$row['flags'];
                $read = (eregi("\\SEEN", $msg_flags)) ? "已读" : "未读";
                $entries[]="<a href='index.php?module=Webmails&action=readmsg&folder=".$folder."&localname=".$localname."&msgid=".$msgid."' >$subject</a>";
                $entries[]=$row['webmailtype'];
                $entries[]=$row['from_email'];
                $entries[]=$row['to_email'];
                $entries[]=$dispdate;
                $entries[]=$size."KB";
                $entries[]=$foldername;
                $entries[]=$read;
                $entries_list[] = $entries;

            }

        }

        $return_data = Array('header'=>$header,'entries'=>$entries_list);

		return $return_data;

    }


	function get_next_id() {
		$query = "select count(*) as num from ec_account";
		$result = $this->db->query($query);
		$num = $this->db->query_result($result,0,'num') + 1;
		//$num = $this->db->getUniqueID("ec_account");
		if($num > 99) return $num;
		elseif($num > 9) return "0".$num;
		else return "00".$num;
	}

	function get_generalmodules($id,$related_tabname)
	{
		global $log, $singlepane_view;
        $log->debug("Entering get_generalmodules() method ...");
		require_once("modules/$related_tabname/$related_tabname.php");
		global $app_strings;
		$focus = new $related_tabname();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;
		$key = "generalmodules_account_query_".$related_tabname;
		$related_bean = substr($related_tabname,0,-1);
		$related_bean = strtolower($related_bean);
		$query = getSqlCacheData($key);
		if(!$query) {
			$query = "SELECT ec_".$related_bean."s.*,ec_users.user_name,ec_".$related_bean."s.".$related_bean."sid as crmid
				FROM ec_".$related_bean."s
				INNER JOIN ec_account
					ON ec_account.accountid = ec_".$related_bean."s.accountid
				LEFT JOIN ec_users
					ON ec_".$related_bean."s.smownerid = ec_users.id
				WHERE ec_".$related_bean."s.deleted = 0";
			setSqlCacheData($key,$query);
		}
		$query .= " and ec_".$related_bean."s.accountid = ".$id." ";
		$log->debug("Exiting get_generalmodules method ...");
		return GetRelatedList("Accounts",$related_tabname,$focus,$query,$button,$returnset);
	}

	function get_maillists($id)
	{
		global $log, $singlepane_view;
		global $app_strings;
        $log->debug("Entering get_maillists(".$id.") method ...");
		require_once('modules/Maillists/Maillists.php');
		$focus = new Maillists();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_maillists.*,ec_users.user_name, ec_users.id,ec_maillists.maillistsid as crmid
			FROM ec_maillists	
			LEFT JOIN ec_users
				ON ec_maillists.smownerid = ec_users.id
			WHERE ec_maillists.accountid  like '%,".$id.",%'
			AND ec_maillists.deleted = 0";
		$log->debug("Exiting get_maillists method ...");
		return GetRelatedList('Accounts','Maillists',$focus,$query,$button,$returnset);
	}

	function get_qunfas($id)
	{
		global $log, $singlepane_view;
		global $app_strings;
        $log->debug("Entering get_qunfas(".$id.") method ...");
		require_once('modules/Qunfas/Qunfas.php');
		$focus = new Qunfas();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Accounts&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Accounts&return_action=CallRelatedList&return_id='.$id;

		$query = "SELECT ec_qunfas.*,ec_users.user_name, ec_users.id,ec_qunfas.qunfasid as crmid
			FROM ec_qunfas	
			LEFT JOIN ec_users
				ON ec_qunfas.smownerid = ec_users.id
			WHERE ec_qunfas.accountid  like '%,".$id.",%'
			AND ec_qunfas.deleted = 0";
		$log->debug("Exiting get_qunfas method ...");
		return GetRelatedList('Accounts','Qunfas',$focus,$query,$button,$returnset);
	}

}

?>
