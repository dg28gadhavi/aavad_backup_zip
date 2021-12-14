<?php 

class Account_mgmt_model extends CI_Model {
	
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
	public function get_admin_users()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		// $this->db->where_in('au_dep_id',array(9,8));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function assign_production($data,$womid)
	{
		//echo "<pre>";print_r($data);die;
		$this->db->select('*');
		$this->db->from('tbl_workorder_management');
		$this->db->where('wom_id',$womid);
		$query = $this->db->get();
		$womdata=$query->row_array();
		//echo "<pre>";print_r($womdata);die;

		$item = array(
			'wom_woid' => $womdata['wom_woid'],
			'wom_woi_id' => $womdata['wom_woi_id'],
			'wom_itm_id' => $womdata['wom_itm_id'],
			'wom_partno' => $womdata['wom_partno'],
			'wom_qty' => $womdata['wom_qty'],
			'wom_assign_id' =>$data['uname'],
			'wom_invoice_no' =>$data['acc_invoiceno'],
			'wom_invoice_date' =>$data['acc_invoicedate'],
			'wom_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'wom_status' => '5',
			'wom_ip' => $_SERVER['REMOTE_ADDR'],
			'wom_cdate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_workorder_management',$item);
		$lid = $this->db->insert_id();

		$this->db->set('wom_completed',1);
		$this->db->where('wom_id',$womid);
		$this->db->update('tbl_workorder_management');
	}
	public function Account_mgmt_report()
	{
		// $this->db->select('*');
		// $this->db->from('tbl_outward_item');
		// $this->db->join('tbl_outward','tbl_outward.otw_id = tbl_outward_item.otwi_owt_id');
		// $this->db->join('tbl_master_item','tbl_Outward_item.otwi_itm_name = tbl_master_item.master_item_id','left');
		// $this->db->where('otwi_otw_status','0');
		// $this->db->where('otw_completed','1');
		// $query = $this->db->get();
		// return $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_workorder_management');
		$this->db->join('tbl_master_item','tbl_workorder_management.wom_itm_id = tbl_master_item.master_item_id','left');
		$this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_workorder_management.wom_woid','left');
		$this->db->join('tbl_work_order_item','tbl_work_order_item.woi_id = tbl_workorder_management.wom_woi_id','left');
		$this->db->where('wom_status','4');
		$this->db->where('wom_completed',0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function store_approve($id)
	{
		$this->db->set('otwi_otw_status','1');
		$this->db->set('otwi_store_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->set('otwi_store_cdate',date('Y-m-d H:i:s'));
		$this->db->where('otwi_id',$id);
		$this->db->update('tbl_outward_item');
	}
}
?>