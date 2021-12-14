<?php 

class Production_manager_model extends CI_Model {
	
	function encrypt_decrypt($action, $string)
	{
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}
	
	public function Production_manager_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_work_order_item');
		$this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_work_order_item.woi_item_id','left');
		$this->db->where('woi_manager_qty >',0);
		$this->db->where('wo_confirm_or_not',1);
		$this->db->where('wo_production_mng_confirm_or_not',0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function store_approve($id)
	{
		$this->db->set('otwi_otw_status','2');
		$this->db->set('otwi_prod_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->set('otwi_prod_cdate',date('Y-m-d H:i:s'));
		$this->db->where('otwi_id',$id);
		$this->db->update('tbl_outward_item');
	}
	public function get_admin_users()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function assign_production($data,$woid)
	{
		//echo "<pre>";print_r($data['uname']);die;
		$this->db->select('*');
		$this->db->from('tbl_work_order_item');
		$this->db->where('woi_id',$woid);
		$query = $this->db->get();
		$woidata=$query->row_array();
		//echo "<pre>";print_r($woidata);die;

		$item = array(
			'wom_woid' => $woidata['woi_wo_id'],
			'wom_woi_id' => $woidata['woi_id'],
			'wom_itm_id' => $woidata['woi_item_id'],
			'wom_partno' => $woidata['woi_part_no'],
			'wom_qty' => $woidata['woi_manager_qty'],
			'wom_assign_id' =>$data['uname'],
			'wom_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'wom_status' => '1',
			'wom_ip' => $_SERVER['REMOTE_ADDR'],
			'wom_cdate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_workorder_management',$item);
 	    $lid = $this->db->insert_id();
 	    
		$this->db->set('wo_production_mng_confirm_or_not','1');
		$this->db->where('wo_id',$woidata['woi_wo_id']);
		$this->db->update('tbl_work_order');
		
	}
}
?>