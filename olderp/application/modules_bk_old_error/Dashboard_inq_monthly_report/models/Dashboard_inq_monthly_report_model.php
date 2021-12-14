<?php 

class Dashboard_inq_monthly_report_model extends CI_Model {
	
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
    	//echo "hiiiiii"; die;
    	$item = array(
					'exec_month_exec_id' => $id,
					'exec_month_date' => date('Y-m-d'),
					'exec_month_cdate' => date('Y-m-d'),
					'exec_month_ip' => $this->input->ip_address()	
				);
				$this->db->insert('tbl_executive_monthly_report',$item);
				return $this->db->insert_id();
    }

    public function edit($data,$id)
	{
		$this->db->select('*');
		$this->db->from('tbl_executive_monthly_report');
		$this->db->where('exec_month_id', $id);
		$this->db->where('exec_month_date',date('Y-m-d'));
		$query = $this->db->get();
		$month_data = $query->result_array();
		//echo '<pre>'; print_r($month_data);die;
		if(isset($month_data) && !empty($month_data))
		{
			$date = explode("-", $month_data[0]['exec_month_date']); 
			$ym = $date[0].'-'.$date[1];
			$fd = isset($ym) ? $ym : '';
			if($fd == date('Y-m'))
			{
				$item = array(
						'exec_month_partner_name' => $data['partner_name'],
						'exec_month_exec_name' => $data['exec_name'],
						'exec_month_inv_commited' => $data['iv_comi_name'],
						'exec_month_inv_actual' => $data['iv_actu_name'],
						'exec_month_im_commited' => $data['im_comi_name'],
						'exec_month_im_actual' => $data['im_actu_name'],
						'exec_month_st_commited' => $data['sv_comi_name'],
						'exec_month_st_actual' => $data['sv_actu_name'],
						//'exec_month_st_free_commited' => $data['svf_comi_name'],
						//'exec_month_st_free_actual' => $data['svf_actu_name'],
						'exec_month_total_commited' => $data['tot_comi_name'],
						'exec_month_total_actual' => $data['tot_actu_name'],
						'exec_month_franchise_commited' => $data['svf_frai_name'],
						'exec_month_franchise_actual' => $data['svf_frau_name'],
						'exec_month_visiter_commited' => $data['svf_visic_name'],
						'exec_month_visiter_actual' => $data['svf_visiu_name'],
						'exec_month_other_commited' => $data['svf_otherc_name'],
						'exec_month_other_actual' => $data['svf_otheru_name'],
						'exec_month_cdate' => date('Y-m-d'),
						'exec_month_ip' => $this->input->ip_address()
				);
				$this->db->where('exec_month_id', $id);
				$this->db->where('exec_month_date',date('Y-m-d'));
				$this->db->update('tbl_executive_monthly_report', $item);
			}
		}
			
		return $id;
	}

	public function get_month_data($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_executive_monthly_report');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_executive_monthly_report.exec_month_exec_id');
		$this->db->where('exec_month_id',$id);
		$this->db->where('exec_month_date',date('Y-m-d'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_monthly_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_executive_monthly_report');
		$this->db->order_by('exec_month_id','desc');
		$this->db->limit(12);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_executive_monthly_report.exec_month_exec_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
}
?>