<?php
include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');
require_once('include/utils/utils.php');

/** 
 ** Class to populate the module required data during installation  
 */

class DeleteMemdays extends CRMEntity {
		
	function DeleteMemdays() {
		$this->log = LoggerManager::getLogger('DeleteMemdays');
		$this->db = & getSingleDBInstance();
	}

	/** 
	 **Function to populate the default required data during installation  
 	*/
	function delete_defautdata($is_upgrade=false) {
		//$this->db->query( "CREATE SEQUENCE ".$sequence." INCREMENT BY 1 NO MAXVALUE NO MINVALUE CACHE 1;");
		$query = "select tabid from ec_tab where name='Memdays'";
		$result = $this->db->query($query);
		$noofrows = $this->db->num_rows($result);
		$tab_id = 0;
		if($noofrows > 0) {
			$tab_id = $this->db->query_result($result,0,"tabid");
		}
		if($tab_id != 0) {		
			if($this->db->isMySQL()) {
				$this->db->query("SET FOREIGN_KEY_CHECKS=0");
			}
			$this->db->query("delete from ec_blocks where tabid=".$tab_id);
			$this->db->query("delete from ec_field where tabid=".$tab_id);
		$this->db->query("delete from ec_profile2field where tabid=".$tab_id);
			
			$this->db->query("delete from ec_def_org_field where tabid=".$tab_id);			
			$this->db->query("delete from ec_entityname where tabid=".$tab_id);
			$this->db->query("delete from ec_profile2tab where tabid=".$tab_id);
			$this->db->query("delete from ec_profile2standardpermissions where tabid=".$tab_id);
			$this->db->query("delete from ec_profile2utility where tabid=".$tab_id);
			$this->db->query("delete from ec_def_org_share where tabid=".$tab_id);
			$this->db->query("delete from ec_org_share_action2tab where tabid=".$tab_id);
			$this->db->query("delete from ec_moduleowners where tabid=".$tab_id);
			$this->db->query("delete from ec_parenttabrel where tabid=".$tab_id);
			$this->db->query("delete from ec_blocks where tabid=".$tab_id);
			$this->db->query("delete from ec_entityname where tabid=".$tab_id);
			$this->db->query("delete from ec_customview where entitytype='Memdays'");
			$this->db->query("delete from ec_profile2tab where tabid=".$tab_id);
			$this->db->query("delete from ec_profile2standardpermissions where tabid=".$tab_id);
			$this->db->query("delete from ec_profile2utility where tabid=".$tab_id);
			$this->db->query("delete from ec_org_share_action2tab where tabid=".$tab_id);
			$this->db->query("delete from ec_parenttabrel where tabid=".$tab_id);
			$this->db->query("delete from ec_profile2tab where tabid=".$tab_id);
			$this->db->query("delete from ec_tab where tabid=".$tab_id);
			$this->db->query("delete from ec_relatedlists where related_tabid='".$tab_id."' or tabid=".$tab_id);
			$this->db->query("delete from ec_crmentityrel where relmodule='Memdays' or module='Memdays'");
			$this->db->query("delete from ec_moduleentityrel where relmodule='Memdays' or module='Memdays'");
			$this->db->query("delete from ec_crmentity where setype='Memdays'");
			$this->db->query("delete from ec_productfieldlist where module='Memdays'");
			$this->db->query("delete from ec_crmentityrel where module='Memdays'");
			$this->db->query("delete from ec_modulelist where tabid=".$tab_id);
			
			$this->db->query("drop table ec_memdayscf");
			$this->db->query("drop table ec_memdaysgrouprelation");
			$this->db->query("drop table ec_memdays");
			if($this->db->isMySQL()) {
				$this->db->query("SET FOREIGN_KEY_CHECKS=1");
			}
		}
			
	}

	
}
$DeleteMemdays = new DeleteMemdays();
$DeleteMemdays->delete_defautdata();
echo "delete successfully!";
?>