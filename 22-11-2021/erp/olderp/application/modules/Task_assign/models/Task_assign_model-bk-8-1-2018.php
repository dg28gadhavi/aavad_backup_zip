<?php 

class Task_assign_model extends CI_Model {
	
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
	
	public function add($data)
	{
		//echo "<pre>"; print_r($data); die;
			$inqitem = array(
			'task_fassign' => $data['task_fassign'], 
			'task_sassign' => $data['task_sassign'],
			//'task_sassign' => $data['task_sassign'],
			'task_priority' => isset($data['priority']) ? $data['priority'] : '',
			'task_date' =>  date("Y-m-d", strtotime($data['task_date'])),
			'task_when' => date("Y-m-d", strtotime($data['task_when'])),
			'task_comp_dt' => date("Y-m-d", strtotime($data['task_comp_dt'])),
			'status' => $data['status'],
			'task_desc' => $data['task_desc'], 
			//'task_name' => $data['task_name'],
			'task_cdate' => date("Y-m-d", strtotime($data['task_cdate'])), 
			);
		//echo "<pre>"; print_r($inqitem); die;
		$this->db->insert('tbl_task_assign',$inqitem);
		$inqlid = $this->db->insert_id();
		
		
		//****************************************
		// 	foreach ($data['opi_option'] as $key => $value) {
		// 		if(isset($data['option_delete'][$key]) && ($data['option_delete'][$key] != 'DELETE'))
		// 		{
		// 			$cntitem = array(
		// 				'opi_opinion_id' => $inqlid,
		// 				'opi_op_option' => $value,
		// 				'opi_op_cdate' => date('Y-m-d H:i:s'),
		// 				'opi_op_udate' => date('Y-m-d H:i:s'),
		// 			);
		// 			$this->db->insert('tbl_task_assign_option',$cntitem);
		// 		}
		// 	}
		// return $inqlid;
	}
	
	public function edit($data,$id)
	{ 
		//echo "<pre>"; print_r($data); die; 
		$inqitem = array(
			'task_desc' => $data['task_desc'], 
			//'task_name' => $data['task_name'],
			'task_fassign' => $data['task_fassign'], 
			'task_sassign' => $data['task_sassign'],
			'task_priority' => isset($data['priority']) ? $data['priority'] : '',
			'task_date' => date("Y-m-d", strtotime($data['task_date'])),
			'task_when' => date("Y-m-d", strtotime($data['task_when'])),
			'task_comp_dt' => date("Y-m-d", strtotime($data['task_comp_dt'])),
			'status' => $data['status'],
			'task_udate' => date("Y-m-d", strtotime($data['task_udate'])),  
			);
		//echo "<pre>"; print_r($inqitem); die;
		$this->db->where('task_id', $id);
		//echo "<pre>"; print_r($inqitem); die;
		$this->db->update('tbl_task_assign', $inqitem);
		

		//**************************************
		//$this->db->delete('tbl_task_assign_option',array('opi_opinion_id' => $id));
		// foreach ($data['opi_option'] as $key => $value) {
		// 	if(isset($data['opi_optionid'][$key]) && ($data['opi_optionid'][$key] != ''))
		// 	{
		// 		if(isset($data['option_delete'][$key]) && ($data['option_delete'][$key] != 'DELETE'))
		// 		{
		// 			$cntitem = array(
		// 				'opi_opinion_id' => $id,
		// 				'opi_op_option' => $value,
		// 				'opi_op_cdate' => date('Y-m-d H:i:s'),
		// 				'opi_op_udate' => date('Y-m-d H:i:s'),
		// 			);
		// 			$this->db->where('opi_op_id',$data['opi_optionid'][$key]);
		// 			$this->db->update('tbl_task_assign_option',$cntitem);
		// 		}else{
		// 			//echo "<pre>"; print_r($item); die;
		// 			$this->db->delete('tbl_task_assign_option',array('opi_op_id' => $data['opi_optionid'][$key]));
		// 		}
		// 	}else{
		// 		if(isset($data['option_delete'][$key]) && ($data['option_delete'][$key] != 'DELETE'))
		// 		{
		// 			$cntitem = array(
		// 				'opi_opinion_id' => $id,
		// 				'opi_op_option' => $value,
		// 				'opi_op_cdate' => date('Y-m-d H:i:s'),
		// 				'opi_op_udate' => date('Y-m-d H:i:s'),
		// 			);
		// 			$this->db->insert('tbl_task_assign_option',$cntitem);
		// 		}
		// 	}
		// }
		return $id;
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_task_assign');
		//$this->db->join('tbl_task_assign_option','tbl_task_assign.task_id = tbl_task_assign_option.opi_opinion_id', 'left');
		$this->db->where('task_id', $id);
		$query = $this->db->get();
		// echo '<pre>';print_r($query->result_array());die;
		return $query->result_array();

	}
	public function get_Task_assigns()
	{
		$this->db->select('*,fassign.au_fname as by,sassign.au_fname as to');
		$this->db->from('tbl_task_assign');
		$this->db->join('tbl_admin_users as fassign','tbl_task_assign.task_fassign = fassign.au_id','left');
		$this->db->join('tbl_admin_users as sassign','tbl_task_assign.task_sassign = sassign.au_id','left');
		$this->db->order_by('task_id', 'desc');
		$this->db->where('task_is_deleted', '0');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
    	{
       		$this->db->where('tbl_task_assign.task_fassign', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
    	}
    	
		if($this->input->post('task_desc') && ($this->input->post('task_desc') != ''))
        {
           $this->db->like('task_desc', $this->input->post('task_desc'));   
        }
        if($this->input->post('task_assign') && ($this->input->post('task_assign') != ''))
        {
           $this->db->like('fassign.au_fname', $this->input->post('task_assign'));   
        }
        if($this->input->post('task_to') && ($this->input->post('task_to') != ''))
        {
           $this->db->like('sassign.au_fname', $this->input->post('task_to'));   
        }
        if($this->input->post('task_date') && ($this->input->post('task_date') != ''))
        {
           $this->db->like('task_date', $this->input->post('task_date'));   
        }
        if($this->input->post('when') && ($this->input->post('when') != ''))
        {
           $this->db->like('task_when', $this->input->post('when'));   
        }
        if($this->input->post('complete') && ($this->input->post('complete') != ''))
        {
           $this->db->like('task_comp_dt', $this->input->post('complete'));   
        }
		 if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('task_priority', $this->input->post('priority'));   
        }
		 if($this->input->post('status_pending') && ($this->input->post('status_pending') != ''))
        {
           $this->db->like('status', $this->input->post('status_pending'));   
        }
		if($this->input->get('start_date') && ($this->input->get('start_date') != ''))
        {
          $date = date("Y-m-d", strtotime($this->input->get('start_date')));
           $this->db->where('task_date>=', $date); 
        }
        if($this->input->get('end_date') && ($this->input->get('end_date') != ''))
        {
        	$date = date("Y-m-d", strtotime($this->input->get('end_date')));
           $this->db->where('task_date<=', $date);   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('task_is_deleted', '1');
		$this->db->where('task_id', $id);
		$this->db->update('tbl_task_assign');
		return $id;
	}
	
	public function get_reset()
	{
		$this->session->unset_userdata('inq_forn');
	}
	// public function get_items()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_task_assign_option');
	
	// 	$query = $this->db->get();
	// 	$values['itm'] = $query->result_array();
	// 	//echo '<pre>';print_r($values);die;
	// 	return $values;
	// }

	public function get_session($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_is_delete','0');
        $this->db->where('au_adt_id!=',5);
        $this->db->where('au_fname!=','');
        $this->db->where('au_id',$id);
        $this->db->order_by('au_fname', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->row_array();
    }

	public function get_admins()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_is_delete','0');
        $this->db->where('au_adt_id!=',5);
        $this->db->where('au_fname!=','');
        $this->db->order_by('au_fname', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }

	public function get_country()
    {
        $this->db->select('*');
        $this->db->from('tbl_country');
        $this->db->where('country_isdelete','0');
        $this->db->order_by('country_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }
	public function get_state($country)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_country',$country);
        $this->db->where('state_isdelete','0');
        $this->db->order_by('state_name','ASC');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_district($state)
    {
        $this->db->select('*');
        $this->db->from('tbl_district');
        $this->db->where('district_state',$state);
        $this->db->where('district_isdelete','0');
        $this->db->order_by('district_name','ASC');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_taluka($district)
    {
        $this->db->select('*');
        $this->db->from('tbl_taluka');
        $this->db->where('taluka_district',$district);
        $this->db->where('taluka_isdelete','0');
        $this->db->order_by('taluka_name','ASC');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_city($taluka)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_city');
        $this->db->where('city_taluka',$taluka);
        $this->db->where('city_isdelete','0');
        $this->db->order_by('city_name','ASC');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_area($city)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->where('area_city',$city);
		$this->db->where('area_isdelete','0');
		$this->db->order_by('area_name','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_language()
	{
		$this->db->select('*');
		$this->db->from('tbl_language');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_bytask_data()
	{
		//echo "hiiii"; die;
        //echo $this->input->get('executive'); die;
        /******************List Of Task Assigned By Admin***************************/
        /***********************************************************/
        $this->db->select('to.au_fname as to,tbl_task_assign.*');
        $this->db->from('tbl_task_assign');
         $this->db->join('tbl_admin_users as to', 'to.au_id = tbl_task_assign.task_fassign','left');
         if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_task_assign.task_fassign', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_task_assign.task_fassign', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }

        $this->db->where('tbl_task_assign.status','2');
        $this->db->where('tbl_task_assign.task_is_deleted !=','2');
        $this->db->order_by('tbl_task_assign.task_date','desc');
        $this->db->where('tbl_task_assign.task_is_deleted','0');
        $query = $this->db->get(); 
		return $query->result_array();
		//echo '<pre>';print_r($query->result_array()); die;      
        //$value['bytask_list'] = $query->result_array();
    
	}
	
	public function get_totask_data()
	{
		 /***********************************************************/
        /******************List Of Task Assigned To Admin***************************/
        /***********************************************************/
        $this->db->select('to.au_fname as to,tbl_task_assign.*');
        $this->db->from('tbl_task_assign');
         $this->db->join('tbl_admin_users as to', 'to.au_id = tbl_task_assign.task_sassign','left');
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_task_assign.task_sassign', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_task_assign.task_sassign', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }

        $this->db->where('tbl_task_assign.status','2');
        $this->db->where('tbl_task_assign.task_is_deleted !=','2');
        $this->db->order_by('tbl_task_assign.task_date','desc');
        $this->db->where('tbl_task_assign.task_is_deleted','0');
        $query = $this->db->get();       
        return $query->result_array();
	}
	
	public function get_tosuper_data()
	{
		/***********************************************************/
        /******************List Of Task Assigned By Super Admin***************************/
        /***********************************************************/
        $this->db->select('to.au_fname as to,to.au_adt_id as type_id,tbl_task_assign.*');
        $this->db->from('tbl_task_assign');
         $this->db->join('tbl_admin_users as to', 'to.au_id = tbl_task_assign.task_sassign','left');
        //  if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        // {
            
        // }
        $this->db->where('tbl_task_assign.task_sassign', 21);
        //$this->db->where('to.au_adt_id',3);
        $this->db->where('tbl_task_assign.status','2');
        $this->db->order_by('tbl_task_assign.task_date','desc');
        $this->db->where('tbl_task_assign.task_is_deleted','0');
        $query = $this->db->get();       
        //echo "<pre>"; print_r($query->result_array()); die;
        return $query->result_array();
	}

}
?>