<?php 

class Weeklytour_model extends CI_Model {
	
	
	public function add($data)
	{
		
		$item = array(
			'weeklytour_name' => $data['weeklytour_name'],
			'weeklytour_roe' => $data['weeklytour_roe'],
			'weeklytour_cdate' => $data['weeklytour_cdate'],
			'weeklytour_udate' => $data['weeklytour_udate'],
			//'wt_adminid' => $adminid,
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_weeklytour',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data)
	{ 
	  echo 'we are in model';
		$item = array(
			'weeklytour_name' => $data['weeklytour_name'],
			'weeklytour_roe' => $data['weeklytour_roe'],
			'weeklytour_udate' => $data['weeklytour_udate']
			);
		$this->db->where('weeklytour_id', $this->input->get('id'));
		$this->db->update('tbl_weeklytour', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get()
	{
		$this->db->select('*');
		$this->db->from('tbl_weeklytour');
		$this->db->where('weeklytour_id',$this->input->get('id'));
		$this->db->where('weeklytour_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_weeklytour()
	{
		$this->db->select('*');
		$this->db->from('tbl_weeklytour');
		$this->db->where('weeklytour_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata['login']['aus_Id'] && ($this->session->userdata['login']['aus_Id'] != ""))
		{
			$this->db->where('weeklytour_cid',$this->session->userdata['login']['aus_Id']);
		}
		if($this->session->userdata('subadmin') && $this->session->userdata['subadmin']['aus_Id'] && ($this->session->userdata['subadmin']['aus_Id'] != ""))
		{
			$this->db->where('wt_adminid',$this->session->userdata['subadmin']['aus_Id']);
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function insert_appt_slot($data)
	{
		$this->db->set('wt_startdate', $data['start_dt']);
		$this->db->set('wt_enddate', $data['end_date']);
		$this->db->set('wt_district', $data['district']);
		$this->db->set('wt_city',$data['city']);
		$this->db->set('wt_customer',$data['customer']);
		$this->db->set('wt_remark',$data['remark']);
		$this->db->set('wt_cid',1);
		$this->db->set('wt_adminid',1);
		if($data['app_id'] != '' && ($data['app_id'] != null)){
			$this->db->where('wt_id', $data['app_id']);
			$this->db->update('tbl_weeklytour'); 
		} else {
			$this->db->insert('tbl_weeklytour'); 
		}
	}
	// function get_prac_details(){
	// 	$query = $this->db->get_where('tbl_doctors_practicedetails', array('dop_docid' => $this->session->userdata['medstar_user']['doc_id']));
	// 	return $query->result_array();
	// }	

	// function get_programme_types()
	// {
	// 	$query = $this->db->get('tbl_master_programme_type');
	// 	return $query->result_array();
	// }

	public function select_appt_slot()
	{
			//$this->db->where('wt_cid',$this->session->userdata['login']['aus_Id']);
			$query = $this->db->get('tbl_weeklytour');
			if($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$json[] = array(
				    	'id' => $row['wt_id'],
				    	'start' => $row['wt_startdate'],
				    	'end_dt' => $row['wt_enddate'],
				    	'title' => $row['wt_customer']
				    );	
				}
			}else{
				$json[]= array();
			}
		//$json[]= array();
		header('Content-Type: application/json');
    	echo json_encode( $json );
	}

	public function delelte_slot($id){
		$this->db->delete('tbl_weeklytour',array('wt_id' => $id)); 
	}
	public function check_update_availability($id){
		$chk_qry = $this->db->get_where('tbl_weeklytour',array('wt_id' => $id));
		$row = $chk_qry->row_array(); 
		echo json_encode($row);
	}
	public function check_insert_availability($time){
		$chk_ins_qry = $this->db->select('*')
					   ->where("DATE_FORMAT(event_start_date,'%Y-%m-%d %H:%i:%S') = '$time'",NULL,FALSE)
					   ->where("event_city_id = ".$this->input->post('master_programme_city_id')."")
					   ->where("event_programme_id = ".$this->input->post('master_schedule_programme')."")
					   ->where('event_group = "'.$this->input->post('group_name').'" ')
					   ->get('tbl_programme_event');
		if ($chk_ins_qry->num_rows() > 0){
			return 1;
		} else {
			return 0;
		}
	}
	public function get_cust()
	{
	    $this->db->select('*');
		$this->db->from('tbl_weeklytour');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_grid_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_weeklytour');
		$this->db->where('wt_isdelete', 0);
		// if($this->session->userdata['login']['aus_Id'] && ($this->session->userdata['login']['aus_Id'] != ""))
		// {
		// 	$this->db->where('wt_cid',$this->session->userdata['login']['aus_Id']);
		// }
		if(($this->session->userdata('subadmin')) && $this->session->userdata['subadmin']['aus_Id'] && ($this->session->userdata['subadmin']['aus_Id'] != ""))
		{
			$this->db->where('wt_adminid',$this->session->userdata['subadmin']['aus_Id']);
		}
		if($this->input->get('startdate') && ($this->input->get('startdate') != ''))
		{
		    //echo'hiiiii';die;
			$start_date = date("Y-m-d", strtotime($this->input->get('startdate')));
			$this->db->where('DATE(wt_startdate) >=', $start_date);
		}
		if($this->input->get('enddate') && ($this->input->get('enddate') != ''))
		{
			//echo'hiiiii';die;
			$start_date = date("Y-m-d", strtotime($this->input->get('enddate')));
			$this->db->where('DATE(wt_enddate) <=', $start_date);
		}
		if($this->input->post('customer_district') && ($this->input->post('customer_district') != ''))
        {
        $this->db->like('wt_district', $this->input->post('customer_district'));
        }
        if($this->input->post('customer_city') && ($this->input->post('customer_city') != ''))
        {
        $this->db->like('wt_city', $this->input->post('customer_city'));
        }
        if($this->input->post('customer_name') && ($this->input->post('customer_name') != ''))
        {
        $this->db->like('wt_customer', $this->input->post('customer_name'));
        }
        if($this->input->post('customer_remark') && ($this->input->post('customer_remark') != ''))
        {
        $this->db->like('wt_remark', $this->input->post('customer_remark'));
        }
        if($this->input->post('customer_sdate') && ($this->input->post('customer_sdate') != ''))
        {
        $this->db->like('wt_startdate', $this->input->post('customer_sdate'));
        }
        if($this->input->post('customer_edate') && ($this->input->post('customer_edate') != ''))
        {
        $this->db->like('wt_enddate', $this->input->post('customer_edate'));
        }
		//$this->db->order_by('wt_id','DESC');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
		
	}
	// public function get_filter()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_weeklytour');
	// 	$this->db->where('wt_id', $this->input->get('id'));
	// 	$this->db->order_by('wt_id','DESC');
	// 	$query = $this->db->get();
	// 	echo'<pre>';print_r($query->result_array());die;
	// 	return $query->result_array();
	// }
	public function get_today()
	{
		$this->db->select('*');
		$this->db->from('tbl_weeklytour');
		$query = $this->db->get();
	    return $query->result_array();
	}
}
?>