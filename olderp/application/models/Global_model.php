<?php 

class Global_model extends CI_Model {

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
	    }else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}
	public function get_rights($rightsid,$moduleid,$type)
	{//echo $rightsid; die;
		$this->db->select('*');
		$this->db->from('tbl_rights');
		$this->db->join('tbl_rights_details','tbl_rights_details.rightsdt_rights_id = tbl_rights.rights_id');
		$this->db->where('rights_is_delete', '0');
		$this->db->where('tbl_rights.rights_id', $rightsid);
		$this->db->where('tbl_rights_details.rightsdt_module_id', $moduleid);
		if($type == 'add')
		{
			$this->db->where('tbl_rights_details.rightsdt_add', '1');
		}
		if($type == 'edit')
		{
			$this->db->where('tbl_rights_details.rightsdt_edit', '1');
		}
		if($type == 'view')
		{
			$this->db->where('tbl_rights_details.rightsdt_view', '1');
		}
		if($type == 'delete')
		{
			$this->db->where('tbl_rights_details.rightsdt_delete', '1');
		}
		if($type == 'print')
		{
			$this->db->where('tbl_rights_details.rightsdt_print', '1');
		}
		if($type == 'download')
		{
			$this->db->where('tbl_rights_details.rightsdt_download', '1');
		}
		if($type == 'mail')
		{
			$this->db->where('tbl_rights_details.rightsdt_mail', '1');
		}
		$this->db->order_by('rights_id', 'desc');
		$query = $this->db->get();
		//echo $query->num_rows(); die;
		return $query->num_rows();
	}

	public function get_notifications()
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_work_order_notification');
		$this->db->join('tbl_wo_noti_assign','tbl_wo_noti_assign.wna_wo_noti_id = tbl_work_order_notification.wo_noti_id');
		$this->db->where('wna_toid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->where('wna_read',0);
		$this->db->order_by('wo_noti_id', 'desc');
		$query = $this->db->get();
		$value['count'] = $query->num_rows();

		$this->db->select('*');
		$this->db->from('tbl_work_order_notification');
		$this->db->join('tbl_wo_noti_assign','tbl_wo_noti_assign.wna_wo_noti_id = tbl_work_order_notification.wo_noti_id');
		$this->db->where('wna_toid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->limit(10);
		$this->db->order_by('wo_noti_id', 'desc');
		$query = $this->db->get();
		
		$value['result'] = $query->result_array();
		return $value;
	}

	public function get_tagline_data()
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_tagline');
		$this->db->where('tagline_status',1);
		$query = $this->db->get();
		$value['tagline_data'] = $query->result_array();
		return $value;
		
	}

	public function get_admin_data()
	{
		$date= date('m-d');
		
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('DATE_FORMAT(au_birth_date,"%m-%d ")=',$date);
		//$this->db->where('DATE_FORMAT(au_anni_date,"%m-%d ")=',$date);
		$query = $this->db->get();	 
		return $query->result_array();
		
	}

	public function get_anniv_data()
	{
		$date= date('m-d');
		
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		//$this->db->where('DATE_FORMAT(au_birth_date,"%m-%d ")=',$date);
		$this->db->where('DATE_FORMAT(au_anni_date,"%m-%d ")=',$date);
		$query = $this->db->get();	 
		return $query->result_array();
		
	}

	public function get_join_data()
	{
		$date= date('m-d');
		
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		//$this->db->where('DATE_FORMAT(au_birth_date,"%m-%d ")=',$date);
		$this->db->where('DATE_FORMAT(au_join_date,"%m-%d ")=',$date);
		$query = $this->db->get();	 
		return $query->result_array();
		
	}
}
?>