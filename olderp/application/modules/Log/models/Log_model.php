<?php 

class Log_model extends CI_Model {
	
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
	public function get_log()
	{   
	   	$this->db->select('*');
		$this->db->from('tbl_adminlogs');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
		$this->db->where('tbl_adminlogs.adlog_adid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$this->db->order_by('adlog_id', 'desc');
		if($this->input->post('email') && $this->input->post('email') != ''){
			$this->db->where('adlog_name', $this->input->post('email'));
		}
		if($this->input->post('date') && $this->input->post('date') != ''){
			$this->db->where('adlog_datetime', $this->input->post('date'));
		}
		if($this->input->post('login') && $this->input->post('login') != ''){
			$this->db->where('adlog_login', $this->input->post('login'));
		}
		if($this->input->post('module') && $this->input->post('module') != ''){
			$this->db->where('adlog_module', $this->input->post('module'));
		}

		if($this->input->post('add') && $this->input->post('add') != '' && $this->input->post('add') == 'yes'){
			$this->db->where('adlog_add', 1);
		}
		if($this->input->post('edit') && $this->input->post('edit') != '' && $this->input->post('edit') == 'yes'){
			$this->db->where('adlog_edit', 1);
		}
		if($this->input->post('delete') && $this->input->post('delete') != '' && $this->input->post('delete') == 'yes'){
			$this->db->where('adlog_delete', 1);
		}
		$query=$this->db->get();
		return $query->result_array();
	}

	public function clearall()
	{
		$this->db->truncate('tbl_adminlogs'); 

	}
}
?>