<?php 

class Attendance_cal_model extends CI_Model {
	
	public function add($data,$name)
	{   
		//echo "<pre>"; print_r($name); die;
		$this->db->select('*');
		$this->db->from('tbl_attend_date');
		$this->db->where('attend_date_name', $name);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		$rows=$query->num_rows(); 
		if($rows==0){
			
			$item = array(
					'attend_date_name' => $name,
					'attend_date_firstdate' => date("Y-m-d", strtotime($data['attend_date_name'])),
					'attend_date_udate' => date("Y-m-d h:i:s")
					);	
					$this->db->insert('tbl_attend_date',$item);
					$month_id = $this->db->insert_id();	
					//echo "<pre>"; print_r($month_id); die;

					$this->db->select('*');
					$this->db->from('tbl_admin_users');	
					$this->db->where('au_status', '1');
					//$this->db->where('au_eligible_sal', '1');
					$query = $this->db->get();
					$admin_users=$query->result_array();
					foreach ($admin_users as $key => $admin_user) {
					
					$insert_sal = array(
					'attend_date_id' => $month_id,
					'attend_auid' => $admin_user['au_id'],
					'attend_pa_id' => '0',
					'attend_intime' =>'0',
					'attend_outtime' => '0'
										
					);	
					$this->db->insert('tbl_attendance',$insert_sal);					
					}


		}else if($rows==1){
			$rowdata = $query->row_array();
			//echo '<pre>';print_r($rowdata);die;
			$this->db->select('*');
			$this->db->from('tbl_admin_users');	
			$this->db->where('au_status', '1');
			//$this->db->where('au_eligible_sal', '1');
			$query = $this->db->get();
			$admin_users=$query->result_array();
			//echo '<pre>';print_r($admin_users);die;
			foreach ($admin_users as $key => $admin_user) {
				
				$this->db->select('*');
				$this->db->from('tbl_attendance');	
				$this->db->where('attend_date_id', $rowdata['attend_date_id']);
				$this->db->where('attend_auid', $admin_user['au_id']);
				$query = $this->db->get();
				if($query->num_rows() == 0){
					$insert_sal = array(
						'attend_date_id' => $rowdata['attend_date_id'],
						'attend_auid' => $admin_user['au_id'],
						'attend_pa_id' => '0',
					'attend_intime' => '0',
					'attend_outtime' => '0'
											
					);	
					$this->db->insert('tbl_attendance',$insert_sal);
				}
			}
		}
			
	}	
	public function sal_calculation($data)
	{
		//echo "<pre>"; print_r($data);die;
		foreach ($data['attend_pa_id'] as $key => $cal_data) 
		{
			
			$item = array(
			'attend_pa_id' => $cal_data,
			'attend_intime' => $data['attend_intime'][$key],
			'attend_outtime' => $data['attend_outtime'][$key]
			
			);
		//	echo '<pre>'; print_r($item);die;
			$this->db->where('attend_id', $key);
			$this->db->update('tbl_attendance', $item); 
		}
		//echo "<pre>";print_r($this->input->get('attend_date_name'));die;
		$this->db->set('attend_date_done','1');
		$value['attend_date_name'] = $this->input->get('attend_date_name');
		$month =date("d-m-Y", strtotime($value['attend_date_name']));
		$this->db->where('attend_date_name',$month);
		$this->db->where('attend_date_confirm',0);
		$this->db->update('tbl_attend_date');

	}

	public function confirm_calculation()
	{
		$value['attend_date_name'] = $this->input->get('attend_date_name');
		$month =date("d-m-Y", strtotime($value['attend_date_name']));
		$this->db->set('attend_date_confirm','1');
		$this->db->where('attend_date_name',$month);
		$this->db->update('tbl_attend_date');
	}
	public function salar_paid()
	{
		$sal_calid = $this->input->get('attend_id');
		$this->db->set('sal_cal_pay','1');
		$this->db->set('attend_date',date("Y-m-d h:i:s"));
		$this->db->where('attend_id',$this->encrypt_decrypt('decrypt',$sal_calid));
		$this->db->update('tbl_attendance');
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
		$this->db->from('tbl_attendance');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_attendance.attend_auid');
		$this->db->join('tbl_attend_date','tbl_attend_date.attend_date_id = tbl_attendance.attend_date_id');
		//$this->db->where('attend_date_confirm', '1');		
		$this->db->where('tbl_admin_users.au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Salary_data_for_admin()
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_attend_date');
		//$this->db->where('attend_date_confirm', '1');		
		$this->db->order_by('attend_date_id','DESC');
		$query = $this->db->get();
		$value = $query->result_array();
		//echo "<pre>";print_r($value);die;
		foreach ($value as $key => $month_data) {
			//echo "<pre>";print_r($month_data['attend_date_id']);die;
			$this->db->select('*');
			$this->db->from('tbl_attendance');
			$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_attendance.attend_auid');
			$this->db->join('tbl_attend_date','tbl_attend_date.attend_date_id = tbl_attendance.attend_date_id');
			//$this->db->where('attend_date_confirm', '1');		
			$this->db->where('tbl_attend_date.attend_date_id', $month_data['attend_date_id']);
			$query = $this->db->get();
			$value[$key]['salary_datas'] = $query->result_array();
		}
		//echo "<pre>";print_r($value);die;
		return $value;		
	}

	public function get_Attendance_calculation($value)
	{
		//echo $value; die;
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_attendance.attend_auid');
		$this->db->join('tbl_attend_date','tbl_attend_date.attend_date_id = tbl_attendance.attend_date_id');
		$this->db->where('attend_date_name', $value);	
	//	$this->db->order_by('sal_cal_basic_sal','DESC');	
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_maildata()
	{
		$value['attend_date_name'] = $this->input->get('attend_date_name');
		$month =date("d-m-Y", strtotime($value['attend_date_name']));
		//echo "<pre>"; print_r($this->input->get('attend_date_name'));die;
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_attendance.attend_auid');
		$this->db->join('tbl_attend_date','tbl_attend_date.attend_date_id = tbl_attendance.attend_date_id');
		$this->db->where('attend_date_name', $month);		
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