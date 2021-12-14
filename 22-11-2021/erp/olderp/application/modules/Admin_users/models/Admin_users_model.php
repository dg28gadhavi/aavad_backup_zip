<?php 

class Admin_users_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'au_fname' => $data['au_fname'],
			'au_mname' => $data['au_mname'],
			'au_lname' => $data['au_lname'],
			'au_address' => $data['au_address'],
			'au_mo_no' => $data['au_mo_no'],
			'au_extra_no' => $data['au_extra_no'],
			'au_country' => $data['au_country'],
			'au_state' => $data['au_state'],
			'au_city' => $data['au_city'],
			'au_area' => isset($data['au_area']) ? $data['au_area'] : 0,
			'au_dep_id' => $data['au_dep_id'],
			'au_rights_id' => $data['au_rights_id'],
			'au_adt_id' => $data['au_adt_id'],
			'au_remark' => $data['au_remark'],
			'au_email' => $data['au_email'],
			'au_per_mobil_no' => $data['au_per_mobil_no'],
			'au_per_email_id' => $data['au_per_email_id'],
			'au_birth_date' => date("Y-m-d", strtotime($data['au_birth_date'])),
			'au_anni_date' => date("Y-m-d", strtotime($data['au_anni_date'])),
			'au_join_date' => date("Y-m-d", strtotime($data['au_join_date'])),
			'au_basic_sal' => $data['au_basic_sal'],
			'au_sal_brkup_main' => $data['au_sal_brkup_main'],
			'au_sal_basic_percent' => $data['au_sal_basic_percent'],
			'au_sal_basic_res' => $data['au_sal_basic_res'],
			'au_sal_hra_percent' => $data['au_sal_hra_percent'],
			'au_sal_hra_res' => $data['au_sal_hra_res'],
			'au_sal_wash_percent' => $data['au_sal_wash_percent'],
			'au_sal_wash_res' => $data['au_sal_wash_res'],
			'au_sal_bonus_percent' => $data['au_sal_bonus_percent'],
			'au_sal_bonus_res' => $data['au_sal_bonus_res'],
			'au_sal_esic' => $data['au_sal_esic'],
			'au_sal_pf' => $data['au_sal_pf'],
			'au_sal_proffesional_tax' => $data['au_sal_proffesional_tax'],
			'au_sal_add_perform' => $data['au_sal_add_perform'],
			'au_sal_12_leaves' => $data['au_sal_12_leaves'],
			'au_sal_ctc_pm' => $data['au_sal_ctc_pm'],
			'au_sal_ctc_py' => $data['au_sal_ctc_py'],
			//'au_com_slab' => $data['au_com_slab'],
			//'au_total_leave' => $data['au_total_leave'],
			'au_password' => md5($data['au_password']),
			'au_gmail_email' => $data['au_gmail_email'],
			'au_gmail_password' => $data['au_gmail_password'],
			'au_signature' => $data['au_signature'],
			'au_parent_id' => $data['au_parent_id'],
			'au_eligible_sal' => $data['au_eligible_sal'],
			'au_ip' => $this->input->ip_address(),
			'au_cdate' => $data['au_cdate'],
			'au_udate' => $data['au_udate'],
			'au_colorcode' => $data['aus_color']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_admin_users',$item);
		$lid = $this->db->insert_id();
		if(isset($data['au_photo']))
		{
			$item = array(
			'au_photo' => $data['au_photo']
			);
			$this->db->where('au_id', $lid);
			$this->db->update('tbl_admin_users', $item); 
		}
		if(isset($data['spouseachievement']))
		{
			foreach($data['spouseachievement'] as $achievement){
				$item = array(
				'adachi_au_id' => $lid,
				'adachi_achivements' => $achievement
				);
				$this->db->insert('tbl_ad_achivements',$item);
			}
			 
		}
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		//echo '<pre>';print_r($data);die;
		$item = array(
			'au_fname' => $data['au_fname'],
			'au_mname' => $data['au_mname'],
			'au_lname' => $data['au_lname'],
			'au_address' => $data['au_address'],
			'au_mo_no' => $data['au_mo_no'],
			'au_extra_no' => $data['au_extra_no'],
			'au_country' => $data['au_country'],
			'au_state' => $data['au_state'],
			'au_city' => $data['au_city'],
			'au_area' => $data['au_area'],
			'au_dep_id' => $data['au_dep_id'],
			'au_rights_id' => $data['au_rights_id'],
			'au_adt_id' => $data['au_adt_id'],
			'au_remark' => $data['au_remark'],
			'au_email' => $data['au_email'],
			'au_per_mobil_no' => $data['au_per_mobil_no'],
			'au_per_email_id' => $data['au_per_email_id'],
			'au_birth_date' => date("Y-m-d", strtotime($data['au_birth_date'])),
			'au_anni_date' => date("Y-m-d", strtotime($data['au_anni_date'])),
			'au_join_date' => date("Y-m-d", strtotime($data['au_join_date'])),
			'au_basic_sal' => $data['au_basic_sal'],
			'au_sal_brkup_main' => $data['au_sal_brkup_main'],

			'au_sal_basic_percent' => $data['au_sal_basic_percent'],
			'au_sal_basic_res' => $data['au_sal_basic_res'],
			'au_sal_hra_percent' => $data['au_sal_hra_percent'],
			'au_sal_hra_res' => $data['au_sal_hra_res'],
			'au_sal_wash_percent' => $data['au_sal_wash_percent'],
			'au_sal_wash_res' => $data['au_sal_wash_res'],
			'au_sal_bonus_percent' => $data['au_sal_bonus_percent'],
			'au_sal_bonus_res' => $data['au_sal_bonus_res'],
			'au_sal_esic' => $data['au_sal_esic'],
			'au_sal_pf' => $data['au_sal_pf'],
			'au_sal_proffesional_tax' => $data['au_sal_proffesional_tax'],
			'au_sal_add_perform' => $data['au_sal_add_perform'],
			'au_sal_12_leaves' => $data['au_sal_12_leaves'],
			'au_sal_ctc_pm' => $data['au_sal_ctc_pm'],
			'au_sal_ctc_py' => $data['au_sal_ctc_py'],
			//'au_com_slab' => $data['au_com_slab'],
			//'au_total_leave' => $data['au_total_leave'],
			//'au_password' => md5($data['au_password']),
			'au_gmail_email' => $data['au_gmail_email'],
			'au_gmail_password' => $data['au_gmail_password'],
			'au_signature' => $data['au_signature'],
			'au_parent_id' => $data['au_parent_id'],
			'au_eligible_sal' => $data['au_eligible_sal'],
			'au_ip' => $this->input->ip_address(),
			'au_udate' => $data['au_udate'],
			'au_colorcode' => $data['aus_color']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('au_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_admin_users', $item);
		if(isset($data['au_photo']))
		{
			$item = array(
			'au_photo' => $data['au_photo']
			);
			$this->db->where('au_id', $id);
			$this->db->update('tbl_admin_users', $item); 
		}
		$this->db->where('adachi_au_id', $id);
		$this->db->delete('tbl_ad_achivements');
		if(isset($data['spouseachievement']))
		{
			foreach($data['spouseachievement'] as $achievement){
				$item = array(
				'adachi_au_id' => $id,
				'adachi_achivements' => $achievement
				);
				$this->db->insert('tbl_ad_achivements',$item);
			}
			 
		}
		return $id;	
	}
	public function edit_password($data,$idencr)
	{ 
		if($this->uri->segment(2) == 'retype_user_password')
		{
			$admin = array(
			'au_email' => $data['au_email'],
			'au_password' => md5($data['au_password']),
			'au_udate' => $data['au_udate']
			);
			//echo '<pre>';print_r($admin);die;
				$this->db->where('au_vf_id',$idencr);
				$this->db->update('tbl_admin_users', $admin);
		}else{
			$admin = array(
			'au_email' => $data['au_email'],
			'au_password' => md5($data['au_password']),
			'au_udate' => $data['au_udate']
			);
			//echo '<pre>';print_r($admin);die;
				$this->db->where('au_id',$idencr);
				$this->db->update('tbl_admin_users', $admin);
				//$lid = $this->input->get('id');
			//	echo '<pre>';print_r($data);die;
		}
			return $idencr;	
	}
	
	public function get($id)
	{
		//echo $id; die;
		if($this->uri->segment(2) == 'retype_user_password')
		{
			$value = array();
			$this->db->select('*');
			$this->db->from('tbl_admin_users');
			$this->db->where('au_vf_id',$id);
			$query = $this->db->get();
			$value['users'] = $query->result_array();
		}else{
			$value = array();
			$this->db->select('*');
			$this->db->from('tbl_admin_users');
			$this->db->where('au_id',$id);
			$query = $this->db->get();
			$value['users'] = $query->result_array();

			$this->db->select('*');
			$this->db->from('tbl_master_state');
			$this->db->where('state_id',$value['users'][0]['au_state']);
			$query = $this->db->get();
			$value['states'] = $query->result_array();

			$this->db->select('*');
			$this->db->from('tbl_master_city');
			$this->db->where('city_id',$value['users'][0]['au_city']);
			$query = $this->db->get();
			$value['cities'] = $query->result_array();

			$this->db->select('*');
			$this->db->from('tbl_master_area');
			$this->db->where('area_id',$value['users'][0]['au_area']);
			$query = $this->db->get();
			$value['areas'] = $query->result_array();
			//echo "<pre>"; print_r($value); die;
		}
		
		return $value;
		
	}
	public function setting_user($user_ids)
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where_in('au_id',$user_ids);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_admin()
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_id',$this->input->get('id'));
		$query = $this->db->get();
		$value['users'] = $query->result_array();
		return $value;
	}

	public function get_achiev($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_ad_achivements');
		$this->db->where('adachi_au_id',$id);
		$query = $this->db->get();
		return $query->result_array();

	}
	
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
		//echo "hiii"; die;
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->order_by('au_id', 'desc');
		$this->db->join('tbl_department','tbl_admin_users.au_dep_id = tbl_department.dep_id');
		

		
		if($this->input->post('au_fname') && ($this->input->post('au_fname') != ''))
        {
           $this->db->like('au_fname', $this->input->post('au_fname'));   
        }
		if($this->input->post('last_name') && ($this->input->post('last_name') != ''))
        {
           $this->db->like('au_lname', $this->input->post('last_name'));   
        }
		if($this->input->post('address') && ($this->input->post('address') != ''))
        {
           $this->db->like('au_address', $this->input->post('address'));   
        }
		if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('au_mo_no', $this->input->post('mobile_no'));   
        }
		if($this->input->post('department') && ($this->input->post('department') != ''))
        {
           $this->db->like('dep_name', $this->input->post('department'));   
        }
        if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
        {
           $this->db->like('au_email', $this->input->post('email_id'));   
        }
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) != 6) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) != 2)))
		{
			$this->db->where('tbl_admin_users.au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$this->db->where('au_is_delete', '0');
        $query =$this->db->get();
		$value = $query->result_array();
		$dept_id=$value[0]['au_dep_id'];
		//echo '<pre>';print_r($value);die;
		return $value;
	}
	public function checkuser($data,$idencr)
	{
			//echo '<pre>';print_r($idencr);die;
		if($this->uri->segment(2) == 'retype_user_password')
		{
			$this->db->select('*');
			$this->db->from('tbl_admin_users');
			$this->db->where('au_email',$data['au_email']);
			$this->db->where('au_vf_id !=',$idencr);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				return true;
			}
			else
			{   
				return false;
			}
		}else{
			$this->db->select('*');
			$this->db->from('tbl_admin_users');
			$this->db->where('au_id !=',$idencr);
			$this->db->where('au_email',$data['au_email']);
			$this->db->where('au_id !=',$idencr);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				return true;
			}
			else
			{   
				return false;
			}
		}
		
	}
	
	public function get_country()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_city()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_admintype()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_type');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_admin_user()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('au_is_delete', '1');
		$this->db->where('au_id', $id);
		$this->db->update('tbl_admin_users');
		return $id;
	}

	public function get_states($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_country', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_cities($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_state', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_areas($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->where('area_city', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_admin_types()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_type');
		$this->db->where('adt_is_delete','0');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_master()
	{	
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_department');
		$query = $this->db->get();
		$value['departments'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_is_delete','0');
		$query = $this->db->get();
		$value['admin'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_rights');
		$this->db->where('rights_is_delete','0');
		$query = $this->db->get();
		$value['roles'] = $query->result_array();
		return $value;
	}
	public function importcsvv($data) 
    {
        
          //echo '<pre>'; print_r($data);die;
        $item = array(
          'au_fname' => $data['admin'],
          'au_email' => $data['email'],
          'au_password' => md5($data['password']),
          'au_adt_id' => 2,
          'au_cdate' => date("Y-m-d"),
          'au_udate' => date("Y-m-d"),
          );
          //echo '<pre>'; print_r($item);die;
          $this->db->insert('tbl_admin_users',$item);
    }

    public function importcsvvv($data) 
    {
        
          //echo '<pre>'; print_r($data);die;
    	$this->db->select('*');
    	$this->db->from('tbl_admin_users');
		$this->db->where('LOWER(au_fname)', strtolower($data['NB/PARTNER']));
		$query = $this->db->get();
		if($query->num_rows() == 0){
        $item = array(
          'au_fname' => $data['NB/PARTNER'],
          'au_email' => $data['Partner Email ID'],
          'au_password' => md5(md5('admin123')),
          'au_adt_id' => 2,
          'au_cdate' => date("Y-m-d"),
          'au_udate' => date("Y-m-d"),
          );
          //echo '<pre>'; print_r($item);die;
          $this->db->insert('tbl_admin_users',$item);
          $cntryim_id = $this->db->insert_id();
      }else if($query->num_rows() > 0)
		    {
		      $cntryim_data = $query->row_array();
		      $cntryim_id = $cntryim_data['au_id'];
		    }else{
		      $cntryim_id = 0;
		    }
    }

    public function importcsv($data)
    {
    	$item = array(
          'au_fname' => $data['attorney'],
          'au_email' => $data['email'],
          'au_password' => md5('admin123'),
          'au_adt_id' => 4,
          'au_cdate' => date("Y-m-d"),
          'au_udate' => date("Y-m-d"),
          );
          //echo '<pre>'; print_r($item);die;
          $this->db->insert('tbl_admin_users',$item);
    }

    public function setid_user()
    {
    	$this->db->set('au_adt_id',5);
    	$this->db->where('au_adt_id',0);
    	$this->db->update('tbl_admin_users');
    }

    
}
?>