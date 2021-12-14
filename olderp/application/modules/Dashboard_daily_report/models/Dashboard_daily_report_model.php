<?php 

class Dashboard_daily_report_model extends CI_Model {
	
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
	
	public function get_inq_data()
    {
        $value = array();
        $this->db->select('COUNT(inq_id) as count');
        $this->db->from('tbl_inquiry');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['totalinq'] = $query->row_array();

        $this->db->select('COUNT(vf_id) as count');
        $this->db->from('tbl_visa_file');
        $this->db->where('tbl_visa_file.vf_isdelete', '0');
                if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
                {
                        $this->db->where('tbl_visa_file.vf_sd_fl_exe', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
        $query = $this->db->get();
        $value['totalvisa'] = $query->row_array();
 		
       /***********************************************************/
		/******************Executive Stastics**********************/
		/***********************************************************/
		
        $this->db->select('*');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_is_delete','0');
        $this->db->where('au_adt_id!=',5);
        $this->db->order_by('au_fname', 'ASC');
		// if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		// {
		// 	$this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		// }
        $query = $this->db->get();
        $value['auser'] = $query->result_array();
		
		//echo "<pre>"; print_r($value['auser']); die;
        return $value;
    }

    public function add_new($id)
    {
    	$item = array(
					'dexe_exe_id' => $id,
					'dexe_date' => date('Y-m-d'),
					'dexe_cdate' => date('Y-m-d'),
					'dexe_ip' => $this->input->ip_address()	
				);
				$this->db->insert('tbl_daily_executive_report',$item);
				return $this->db->insert_id();
    }

    public function edit($data,$id)
	{
		$item = array(
					'dexe_sms' => $data['sms'],
					'dexe_exe_name' => $data['exec_name'],
					'dexe_foll_up' => $data['follow_up'],
					'dexe_up_inc_inq' => $data['inc_inq'],
					'dexe_up_walk' => $data['walkin'],
					'dexe_up_visit' => $data['visit'],
					'dexe_cold_call' => $data['cold_call'],
					'dexe_remark' => $data['remark'],
					'dexe_udate' => date('Y-m-d'),
					'dexe_ip' => $this->input->ip_address()
			);
			$this->db->where('dexe_id', $id);
			$this->db->where('dexe_date',date('Y-m-d'));
			$this->db->update('tbl_daily_executive_report', $item);
			
		return $id;
	}

	public function get_month_data($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_daily_executive_report');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_daily_executive_report.dexe_exe_id');
		$this->db->where('dexe_id',$id);
		$this->db->where('dexe_date',date('Y-m-d'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_daily_executive_report');
		$this->db->where('dexe_id',$id);
		$this->db->where('dexe_date',date('Y-m-d'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_daily_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_daily_executive_report');
		$this->db->order_by('dexe_id','desc');
		$this->db->limit(31);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_daily_executive_report.dexe_exe_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
}
?>