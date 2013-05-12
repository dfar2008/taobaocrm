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

include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');
require_once('include/utils/utils.php');
require_once('include/RelatedListView.php');
require_once('user_privileges/default_module_view.php');

class Products extends CRMEntity {
	var $log;
	var $db;

	var $unit_price;
	var $table_name = "ec_products";
	var $object_name = "Product";
	var $entity_table = "ec_products";
	var $required_fields = Array(
			'productname'=>1
	);
	var $tab_name = Array('ec_crmentity','ec_products');
	var $tab_name_index = Array('ec_crmentity'=>'crmid','ec_products'=>'productid');
	var $column_fields = Array();

	var $sortby_fields = Array('productname','pro_type','price');

        // This is the list of ec_fields that are in the lists.
		//fieldname is field name of table,columnname of ec_field
        var $list_fields = Array(
                                'Product Name'=>Array('products'=>'productname'),
                                'Product Code'=>Array('products'=>'productcode'),
								'Num'=>Array('products'=>'num'),
								'Price'=>Array('products'=>'price'),
								'Detail Url'=>Array('products'=>'detail_url')
                                );
		//fieldname is field name of ec_field
        var $list_fields_name = Array(
								'Product Name'=>'productname',
								'Product Code'=>'productcode',
								'Num'=>'num',
								'Price'=>'price',
								'Detail Url'=>'detail_url'
							 );
        var $list_link_field= 'productname';

    //popup list fields
		var $search_fields = Array(
                               'Product Name'=>Array('products'=>'productname'),
                                'Product Code'=>Array('products'=>'productcode'),
		                        'Num'=>Array('products'=>'num'),
		                        'Price'=>Array('products'=>'price')
								
                                );
        var $search_fields_name = Array(
                                       'Product Name'=>'productname',
                                        'Product Code'=>'productcode',
			                            'Num'=>'num',
										'Price'=>'price'
                                     );

	//Added these variables which are used as default order by and sortorder in ListView
	var $default_order_by = 'modifiedtime';
	var $default_sort_order = 'DESC';

	/**	Constructor which will set the column_fields in this object
	 */
	function Products() {
		$this->log =LoggerManager::getLogger('product');
		$this->log->debug("Entering Products() method ...");
		$this->db = & getSingleDBInstance();
		$this->column_fields = getColumnFields('Products');
		$this->log->debug("Exiting Product method ...");
	}

	function save_module($module)
	{
		//Inserting into ec_seproductsrel table
		if(isset($this->column_fields['parent_id']) && $this->column_fields['parent_id'] != '')
		{
			$this->insertIntoEntityTable('ec_seproductsrel', 'Products');
		}
		elseif(isset($this->column_fields['parent_id']) && $this->column_fields['parent_id'] == '' && $insertion_mode == "edit")
		{
			$this->deleteRelation('ec_seproductsrel');
		}
		//Inserting into product_taxrel table
		/*
		if(isset($_REQUEST['ajxaction']) && $_REQUEST['ajxaction'] != 'DETAILVIEW')
		{
			$this->insertTaxInformation('ec_producttaxrel', 'Products');
		}
		*/

		//Inserting into attachments
		$this->insertIntoAttachment($this->id,'Products');

	}

	/**	function to save the product tax information in producttarel ec_table
	 *	@param string $tablename - ec_tablename to save the product tax relationship (producttaxrel)
	 *	@param string $module	 - current module name
	 *	$return void
	*/
	function insertTaxInformation($tablename, $module)
	{
		global $adb, $log;
		$log->debug("Entering into insertTaxInformation($tablename, $module) method ...");
		$tax_details = getAllTaxes();

		$tax_per = '';
		//Save the Product - tax relationship if corresponding tax check box is enabled
		//Delete the existing tax if any
		if($this->mode == 'edit')
		{
			for($i=0;$i<count($tax_details);$i++)
			{
				$taxid = getTaxId($tax_details[$i]['taxname']);
				$sql = "delete from ec_producttaxrel where productid=$this->id and taxid=$taxid";
				$adb->query($sql);
			}
		}
		for($i=0;$i<count($tax_details);$i++)
		{
			$tax_name = $tax_details[$i]['taxname'];
			$tax_checkname = $tax_details[$i]['taxname']."_check";
			if($_REQUEST[$tax_checkname] == 'on' || $_REQUEST[$tax_checkname] == 1)
			{
				$taxid = getTaxId($tax_name);
				$tax_per = $_REQUEST[$tax_name];
				if($tax_per == '')
				{
					$log->debug("Tax selected but value not given so default value will be saved.");
					$tax_per = getTaxPercentage($tax_name);
				}

				$log->debug("Going to save the Product - $tax_name tax relationship");

				$query = "insert into ec_producttaxrel values($this->id,$taxid,$tax_per)";
				$adb->query($query);
			}
		}

		$log->debug("Exiting from insertTaxInformation($tablename, $module) method ...");
	}


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

		//Remove the deleted ec_attachments from db - Products
		if($module == 'Products' && $_REQUEST['del_file_list'] != '')
		{
			$del_file_list = explode("###",trim($_REQUEST['del_file_list'],"###"));
			foreach($del_file_list as $del_file_name)
			{
				$attach_res = $adb->query("select ec_attachments.attachmentsid from ec_attachments inner join ec_seattachmentsrel on ec_attachments.attachmentsid=ec_seattachmentsrel.attachmentsid where crmid=$id and name=\"$del_file_name\"");
				$attachments_id = $adb->query_result($attach_res,0,'attachmentsid');

				$del_res1 = $adb->query("delete from ec_attachments where attachmentsid=$attachments_id");
				$del_res2 = $adb->query("delete from ec_seattachmentsrel where attachmentsid=$attachments_id");
			}
		}

		$log->debug("Exiting from insertIntoAttachment($id,$module) method.");
	}



	/**	Function used to get the sort order for Product listview
	 *	@return string	$sorder	- first check the $_REQUEST['sorder'] if request value is empty then check in the $_SESSION['PRODUCTS_SORT_ORDER'] if this session value is empty then default sort order will be returned.
	 */
	function getSortOrder()
	{
		global $log;
		$log->debug("Entering getSortOrder() method ...");
		if(isset($_REQUEST['sorder']))
			$sorder = $_REQUEST['sorder'];
		else
			$sorder = (($_SESSION['PRODUCTS_SORT_ORDER'] != '')?($_SESSION['PRODUCTS_SORT_ORDER']):($this->default_sort_order));
		$log->debug("Exiting getSortOrder() method ...");
		return $sorder;
	}

	/**	Function used to get the order by value for Product listview
	 *	@return string	$order_by  - first check the $_REQUEST['order_by'] if request value is empty then check in the $_SESSION['PRODUCTS_ORDER_BY'] if this session value is empty then default order by will be returned.
	 */
	function getOrderBy()
	{
		global $log;
		$log->debug("Entering getOrderBy() method ...");
		if (isset($_REQUEST['order_by']))
			$order_by = $_REQUEST['order_by'];
		else
			$order_by = (($_SESSION['PRODUCTS_ORDER_BY'] != '')?($_SESSION['PRODUCTS_ORDER_BY']):($this->default_order_by));
		$log->debug("Exiting getOrderBy method ...");
		return $order_by;
	}



	/**	function used to get the list of pricebooks which are related to the product
	 *	@param int $id - product id
	 *	@return array - array which will be returned from the function GetRelatedList
	 */
	function get_product_pricebooks($id)
	{
		global $log,$singlepane_view;
		$log->debug("Entering get_product_pricebooks(".$id.") method ...");
		global $mod_strings;
		require_once('modules/PriceBooks/PriceBooks.php');
		$focus = new PriceBooks();
		$button = '';
		if($singlepane_view == 'true')
			$returnset = '&return_module=Products&return_action=DetailView&return_id='.$id;
		else
			$returnset = '&return_module=Products&return_action=CallRelatedList&return_id='.$id;


		$query = "SELECT ec_pricebook.pricebookid as crmid,
			ec_pricebook.*,
			ec_pricebookproductrel.productid as prodid
			FROM ec_pricebook
			INNER JOIN ec_pricebookproductrel
				ON ec_pricebookproductrel.pricebookid = ec_pricebook.pricebookid
			WHERE ec_pricebook.deleted = 0
			AND ec_pricebookproductrel.productid = ".$id;
		$log->debug("Exiting get_product_pricebooks method ...");
		return GetRelatedList('Products','PriceBooks',$focus,$query,$button,$returnset);
	}

	/**	function used to get the number of vendors which are related to the product
	 *	@param int $id - product id
	 *	@return int number of rows - return the number of products which do not have relationship with vendor
	 */
	function product_novendor()
	{
		global $log;
		$log->debug("Entering product_novendor() method ...");
		$query = "SELECT ec_products.productname, ec_products.deleted
			FROM ec_products
			WHERE ec_products.deleted = 0
			AND ec_products.vendor_id is NULL";
		$result=$this->db->query($query);
		$log->debug("Exiting product_novendor method ...");
		return $this->db->num_rows($result);
	}

	/**	function used to get the export query for product
	 *	@param reference &$order_by - reference of the order by variable which will be added with the query
	 *	@param reference &$where - reference of the where variable which will be added with the query
	 *	@return string $query - return the query which will give the list of products to export
	 */
	function create_export_query(&$order_by, &$where)
	{
		global $log;
		$log->debug("Entering create_export_query(".$order_by.",".$where.") method ...");

		include("include/utils/ExportUtils.php");

		//To get the Permitted fields query and the permitted fields list
		$sql = getPermittedFieldsQuery("Products", "detail_view");
		global $mod_strings;
		global $current_language;
		if(empty($mod_strings)) {
			$mod_strings = return_module_language($current_language,"Products");
		}
		$fields_list = getFieldsListFromQuery($sql,$mod_strings);

		$query = "SELECT $fields_list FROM ".$this->table_name ."
			LEFT JOIN ec_seproductsrel
				ON ec_seproductsrel.productid = ec_products.productid

			LEFT JOIN ec_users as ucreator
					ON ec_products.smcreatorid = ucreator.id
			LEFT JOIN ec_vendor
				ON ec_vendor.vendorid = ec_products.vendor_id
			WHERE ec_products.deleted = 0 ";
			//ProductRelatedToLead, Account and Potential tables are added to get the Related to field


		if($where != "")
                        $query .= " AND ($where) ";

                if(!empty($order_by))
                        $query .= " ORDER BY $order_by";

		$log->debug("Exiting create_export_query method ...");
                return $query;

	}

	function isExists($productname,$productid) {
		global $log;
		$query = "select productid from ec_products where productname='".$productname."' and productid!=".$productid;
		$result = $this->db->query($query);
		$num = $this->db->num_rows($result);
		$log->debug("Exiting isExists method ...");
		if($num > 0) return true;
		else return false;
	}

	function get_next_id() {
		$query = "select count(*) as num from ec_products";
		$result = $this->db->query($query);
		$num = $this->db->query_result($result,0,'num') + 1;
		//$num = $this->db->getUniqueID("ec_products");
		if($num > 99) return $num;
		elseif($num > 9) return "0".$num;
		else return "00".$num;
	}

	function getListQuery($where_relquery) {
		$query = "SELECT ec_products.productid as crmid,productid,productname,productcode,serialno,qtyinstock,unit_price,reference_price,cost_price  FROM ec_products WHERE ec_products.deleted = 0  ".$where_relquery;
		return $query;
	}


}
?>
