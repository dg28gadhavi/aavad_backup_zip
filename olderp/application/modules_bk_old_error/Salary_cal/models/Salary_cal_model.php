<?php 

class Salary_cal_model extends CI_Model {
	
	public function add($data,$name)
	{   
		//echo "<pre>"; print_r($name); die;
		$this->db->select('*');
		$this->db->from('tbl_salary_month');
		$this->db->where('sal_month_name', $name);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		$rows=$query->num_rows(); 
		if($rows==0){
			
			$item = array(
					'sal_month_name' => $name,
					'sal_month_firstdate' => date("Y-m-d", strtotime($data['sal_month_name'])),
					'sal_month_udate' => date("Y-m-d h:i:s")
					);	
					$this->db->insert('tbl_salary_month',$item);
					$month_id = $this->db->insert_id();	

					$this->db->select('*');
					$this->db->from('tbl_admin_users');	
					$this->db->where('au_status', '1');
					$this->db->where('au_eligible_sal', '1');
					$query = $this->db->get();
					$admin_users=$query->result_array();
					foreach ($admin_users as $key => $admin_user) {
					
					$insert_sal = array(
					'sal_month_id' => $month_id,
					'sal_cal_auid' => $admin_user['au_id'],
					'sal_cal_work_days' => '30',
					'sal_cal_total_leave' => '0',
					'sal_cal_py_without' => '0',
					'sal_cal_py_with' => '0',
					'sal_cal_extra_day' => '0',
					'sal_cal_late_hrs' => '0',
					'sal_cal_latehrs_hrs' => '0',
					'sal_cal_basic_sal' => $admin_user['au_basic_sal'],
					'sal_cal_pay_sal' => $admin_user['au_basic_sal'],
					'sal_cal_prof_tax' => $admin_user['au_sal_proffesional_tax'],
					'sal_cal_esic' => $admin_user['au_sal_esic'],
					'sal_cal_pf' => $admin_user['au_sal_pf'],
					'sal_cal_net_sal' => ($admin_user['au_basic_sal']-($admin_user['au_sal_proffesional_tax']+$admin_user['au_sal_esic']+$admin_user['au_sal_pf'])),					
					);	
					$this->db->insert('tbl_salary_calculation',$insert_sal);					
					}


		}else if($rows==1){
			$rowdata = $query->row_array();
			//echo '<pre>';print_r($rowdata);die;
			$this->db->select('*');
			$this->db->from('tbl_admin_users');	
			$this->db->where('au_status', '1');
			$this->db->where('au_eligible_sal', '1');
			$query = $this->db->get();
			$admin_users=$query->result_array();
			//echo '<pre>';print_r($admin_users);die;
			foreach ($admin_users as $key => $admin_user) {
				
				$this->db->select('*');
				$this->db->from('tbl_salary_calculation');	
				$this->db->where('sal_month_id', $rowdata['sal_month_id']);
				$this->db->where('sal_cal_auid', $admin_user['au_id']);
				$query = $this->db->get();
				if($query->num_rows() == 0){
					$insert_sal = array(
						'sal_month_id' => $rowdata['sal_month_id'],
						'sal_cal_auid' => $admin_user['au_id'],
						'sal_cal_work_days' => '30',
						'sal_cal_total_leave' => '0',
						'sal_cal_py_without' => '0',
						'sal_cal_py_with' => '0',
						'sal_cal_extra_day' => '0',
						'sal_cal_late_hrs' => '0',
						'sal_cal_latehrs_hrs' => '0',
						'sal_cal_basic_sal' => $admin_user['au_basic_sal'],
						'sal_cal_pay_sal' => $admin_user['au_basic_sal'],
						'sal_cal_prof_tax' => $admin_user['au_sal_proffesional_tax'],
						'sal_cal_esic' => $admin_user['au_sal_esic'],
						'sal_cal_pf' => $admin_user['au_sal_pf'],
						'sal_cal_net_sal' => ($admin_user['au_basic_sal']-($admin_user['au_sal_proffesional_tax']+$admin_user['au_sal_esic']+$admin_user['au_sal_pf'])),					
					);	
					$this->db->insert('tbl_salary_calculation',$insert_sal);
				}
			}
		}
			
	}	
	public function sal_calculation($data)
	{
		
		foreach ($data['sal_cal_work_days'] as $key => $cal_data) 
		{
			//echo "<pre>"; print_r($data['sal_cal_total_leave'][$key]);die;
			$item = array(
			'sal_cal_work_days' => $cal_data,
			'sal_cal_total_leave' => $data['sal_cal_total_leave'][$key],
			'sal_cal_py_without' => $data['sal_cal_py_without'][$key],
			'sal_cal_py_with' => $data['sal_cal_py_with'][$key],
			'sal_cal_extra_day' => $data['sal_cal_extra_day'][$key],
			'sal_cal_late_hrs' => $data['sal_cal_late_hrs'][$key],
			'sal_cal_latehrs_hrs' => $data['sal_cal_latehrs_hrs'][$key],
			'sal_cal_basic_sal' => $data['sal_cal_basic_sal'][$key],
			'sal_cal_pay_sal' => $data['sal_cal_pay_sal'][$key],
			'sal_cal_prof_tax' => $data['sal_cal_prof_tax'][$key],
			'sal_cal_esic' => $data['sal_cal_esic'][$key],
			'sal_cal_pf' => $data['sal_cal_pf'][$key],
			'sal_cal_net_sal' => $data['sal_cal_net_sal'][$key],
			'sal_cal_remark' => $data['sal_cal_remark'][$key]
			);
		//	echo '<pre>'; print_r($item);die;
			$this->db->where('sal_cal_id', $key);
			$this->db->update('tbl_salary_calculation', $item); 
		}
		//echo "<pre>";print_r($this->input->get('sal_month_name'));die;
		$this->db->set('sal_month_cal_done','1');
		$value['sal_month_name'] = $this->input->get('sal_month_name');
		$month =date("m-Y", strtotime($value['sal_month_name']));
		$this->db->where('sal_month_name',$month);
		$this->db->update('tbl_salary_month');

	}

	public function confirm_calculation()
	{
		$value['sal_month_name'] = $this->input->get('sal_month_name');
		$month =date("m-Y", strtotime($value['sal_month_name']));
		$this->db->set('sal_month_confirm','1');
		$this->db->where('sal_month_name',$month);
		$this->db->update('tbl_salary_month');
	}
	public function salar_paid()
	{
		$sal_calid = $this->input->get('sal_cal_id');
		$this->db->set('sal_cal_pay','1');
		$this->db->set('sal_cal_pay_date',date("Y-m-d h:i:s"));
		$this->db->where('sal_cal_id',$this->encrypt_decrypt('decrypt',$sal_calid));
		$this->db->update('tbl_salary_calculation');
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

	public function get_Salary_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_salary_calculation');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_salary_calculation.sal_cal_auid');
		$this->db->join('tbl_salary_month','tbl_salary_month.sal_month_id = tbl_salary_calculation.sal_month_id');
		$this->db->where('sal_month_confirm', '1');		
		$this->db->where('tbl_admin_users.au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Salary_data_for_admin()
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_salary_month');
		$this->db->where('sal_month_confirm', '1');		
		$this->db->order_by('sal_month_id','DESC');
		$query = $this->db->get();
		$value = $query->result_array();
		//echo "<pre>";print_r($value);die;
		foreach ($value as $key => $month_data) {
			//echo "<pre>";print_r($month_data['sal_month_id']);die;
			$this->db->select('*');
			$this->db->from('tbl_salary_calculation');
			$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_salary_calculation.sal_cal_auid');
			$this->db->join('tbl_salary_month','tbl_salary_month.sal_month_id = tbl_salary_calculation.sal_month_id');
			$this->db->where('sal_month_confirm', '1');		
			$this->db->where('tbl_salary_month.sal_month_id', $month_data['sal_month_id']);
			$query = $this->db->get();
			$value[$key]['salary_datas'] = $query->result_array();
		}
		//echo "<pre>";print_r($value);die;
		return $value;		
	}

	public function get_Salary_calculation($value)
	{
		//echo $value; die;
		$this->db->select('*');
		$this->db->from('tbl_salary_calculation');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_salary_calculation.sal_cal_auid');
		$this->db->join('tbl_salary_month','tbl_salary_month.sal_month_id = tbl_salary_calculation.sal_month_id');
		$this->db->where('sal_month_name', $value);	
		$this->db->order_by('sal_cal_basic_sal','DESC');	
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_maildata()
	{
		$value['sal_month_name'] = $this->input->get('sal_month_name');
		$month =date("m-Y", strtotime($value['sal_month_name']));
		//echo "<pre>"; print_r($this->input->get('sal_month_name'));die;
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_salary_calculation');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_salary_calculation.sal_cal_auid');
		$this->db->join('tbl_salary_month','tbl_salary_month.sal_month_id = tbl_salary_calculation.sal_month_id');
		$this->db->where('sal_month_name', $month);		
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		$value['data'] = $query->result_array();
		return $value;

	}
	public function get_mailer_detail($id)
	{
		//echo "<pre>"; print_r($data); die;
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
}
?>