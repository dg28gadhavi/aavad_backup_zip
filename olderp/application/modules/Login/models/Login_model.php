<?php 

class Login_model extends CI_Model {
	
	public function check_login($data)
	{
						$this->db->select('au_id,au_adt_id,au_status,au_rights_id,au_email,au_fname,au_lname,au_vf_id,au_photo,au_dep_id,au_birth_date,au_colorcode');
		$this->db->from('tbl_admin_users');
		//$this->db->join('tbl_department','tbl_admin_users.au_dep_id = tbl_department.dep_id');
		$this->db->where('au_email',$data['email']);
		$this->db->where('au_password',md5($data['password']));
		$this->db->where('au_status',1);
		$query = $this->db->get();
		$result = array();
		//echo "<pre>"; print_r($query->result_array()); die;
		if($query->num_rows() == 1)
		{
			$result['status'] = true;
			$result['data'] = $query->row_array();
			$log_array = array(
				'login_datetime' => date('Y-m-d H:i:s'),
				'login_adid' => $result['data']['au_id'],
				'login_adtype' => $result['data']['au_adt_id'],
				'login_ip' => $this->input->ip_address(),
				'login_userdetails' => $_SERVER['HTTP_USER_AGENT'],
				'login_edate' => date('Y-m-d H:i:s', strtotime('4 hour'))
				);
			//.'-'.json_encode(get_browser())
			$this->db->insert('tbl_loginlogs', $log_array);
			$result['data']['loginsessid'] = $this->db->insert_id();
//echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
			$log = array(
					'adlog_name' => $result['data']['au_email'],
					'adlog_adtype' => $result['data']['au_adt_id'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Login',
					'adlog_login' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT'],
				);
			$this->db->insert('tbl_adminlogs',$log);

		}else{
			$result['status'] = false;
			$result['data'] = array();
		}
		return $result;
	}

	public function get_all_right()
	{
		$this->db->select('*');
		$this->db->from('tbl_rights');
		$this->db->where('rights_is_delete', '0');
		$this->db->order_by('rights_id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_child_ids($au_id,$level,$adminids)
	{
		$this->db->select('au_id');
		$this->db->from('tbl_admin_users');
		if(isset($au_id) && is_array($au_id) && !empty($au_id))
		{
			$this->db->where_in('au_parent_id', $au_id);
		}else{
			$this->db->where('au_parent_id', $au_id);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		if(isset($result) && is_array($result) && !empty($result))
		{
			$fresult = array_column($result, 'au_id');
			array_push($adminids,implode(",",$fresult));
			$level++;
			$fadminids = $this->get_all_child_ids($fresult,$level,$adminids);
			//echo '<pre>';print_r($fadminids);die;
			//return $fadminids;
		}else{
			//echo '<pre>';print_r($adminids);die;
			$this->session->set_userdata('temp_adminids', $adminids);
			return $adminids;
		}
	}

	/* public function get_all_sub_child_ids($au_id,$level,$adminids)
	{

		$this->db->select('au_id');
		$this->db->from('tbl_admin_users');
		if(isset($au_id) && is_array($au_id) && !empty($au_id))
		{
			$this->db->where_in('au_parent_id', $au_id);
		}else{
			$this->db->where('au_parent_id', $au_id);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		if(isset($result) && is_array($result) && !empty($result))
		{
			//echo '<pre>';print_r($result);die;
			//echo 'hiiiiiiiiiii';die;
			$fresult = array_column($result, 'au_id');
			//echo '<pre>';print_r($fresult);die;
			array_push($adminids,implode(",",$fresult));
			
			$level++;
			$this->get_all_sub_child_ids($fresult,$level,$adminids);
		}else{
			// if($level == 2)
			// {
			// 	echo '<pre>';print_r($adminids);die;
			// }
			echo '<pre>';print_r($adminids);//die;
			return $adminids;
		}
	} */

	public function get_all_group_ids($au_id,$adminids)
	{
		$this->db->select('agi_ag_id');
		$this->db->from('tbl_admin_group_ids');
		$this->db->where('agi_adminid', $au_id);
		$query = $this->db->get();
		$result = $query->result_array();
		if(isset($result) && is_array($result) && !empty($result))
		{
			$ag_ids = array_column($result, 'agi_ag_id');
			if(isset($ag_ids) && is_array($ag_ids) && !empty($ag_ids))
			{
				$this->db->select('agi_adminid');
				$this->db->from('tbl_admin_group_ids');
				$this->db->where_in('agi_ag_id', $ag_ids);
				$query = $this->db->get();
				$result = $query->result_array();
				$adminids = array_column($result, 'agi_adminid');
			}
		}
		return $adminids;
	}
}
?>