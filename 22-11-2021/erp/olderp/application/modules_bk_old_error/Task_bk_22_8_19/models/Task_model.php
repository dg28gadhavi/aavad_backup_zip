<?php 

class Task_model extends CI_Model {
	
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
	public function st_no_get()
	{
		$this->db->select('task_id');
		$this->db->from('tbl_task');
		$this->db->order_by('task_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['task_id'] = isset($autoid['task_id']) ? $autoid['task_id'] : '';

		if(date("m") < 4)
		{
			$last_year = date('y', strtotime('-1 year'));
			$this_year = date('y');
			$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
		}else{
			$next_year = date('y', strtotime('+1 year'));
			$this_year = date('y');
			$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
		}
		return 'T-'.$year_string.'-'.($autoid['task_id']+1);


		//return $code['pre_task'].''.date('dmy').'/'.($autoid['task_id']+1);
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

	 public function get_status()
	{
		//echo "hii"; die;
		$this->db->select('*');
		$this->db->from('tbl_task');
		//$this->db->where('au_id',$id);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
	}



	public function get_b2biq_chat($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_support_communication');
		$this->db->join('tbl_admin_users','tbl_support_communication.stcomm_adid = tbl_admin_users.au_id','left');
		$this->db->where('stcomm_stid',$id);
		$this->db->where('stcomm_isdelete',0);
		$this->db->order_by('stcomm_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function edit_communication($data,$id)
	{
		//echo "<pre>"; print_r($data); die;
		$item = array(
			'stcomm_stid' => $id,
			'stcomm_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'stcomm_solution' => $data['st_solution'],
			'stcomm_feedback' => $data['st_clientfeedback'],
			'stcomm_udate' => $data['udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_support_communication',$item);
		return $id;
	}
	public function delete_chat($data,$id)
	{
		//echo $id;die();
		$this->db->set('stcomm_isdelete',1);
		$this->db->where('stcomm_id', $id);
		$this->db->update('tbl_support_communication');
		return $id;
	}
	public function add($data)
	{
		//echo '<pre>'; print_r($data);die;
		$item = array(
			//'st_coname' => $data['st_coname'],
			//'st_email' => $data['st_email'],
			'task_subject' => $data['task_subject'],
			'task_location' => $data['task_location'],
			'task_ticketno' => $data['task_ticketno'],
			'task_tackenby' => $data['task_tackenby'],
			'task_details' => $data['task_details'],
			'task_attendedby' => $data['task_attendedby'],
			'task_status' => $data['task_status'],
			'task_type' => $data['task_type'],
			'task_recur_month' => $data['task_recur_month'],
			'task_expense' => $data['task_expense'],
			'task_createdby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'task_due_date' => date("Y-m-d", strtotime($data['task_due_date'])),
			'task_cdate' => date('Y-m-d'),
			'task_udate' => $data['task_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_task',$item);
		$lid = $this->db->insert_id();


		if(isset($data['task_fileone']))
		{
			$item = array(
			'task_fileone' => $data['task_fileone']
			);
			$this->db->where('task_id', $lid);
			$this->db->update('tbl_task', $item); 
		}

		if(isset($data['task_filetwo']))
		{
			$item = array(
			'task_filetwo' => $data['task_filetwo']
			);
			$this->db->where('task_id', $lid);
			$this->db->update('tbl_task', $item); 
		}

		return $lid;
	}

	public function close_sts($id)
	{
		$item = array(
			'task_status' => 2
			);
		$this->db->where('task_id', $id);
		//$this->db->where('Task_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_task', $item); 
		return $id;
	}
	
	public function edit($data,$id)
	{ 
		//echo '<pre>'; print_r($data['task_followup_date']);die;
		$item = array(
			//'st_coname' => $data['st_coname'],
			//'task_subject' => $data['task_subject'],
			//'st_email' => $data['st_email'],
			'task_location' => $data['task_location'],
			'task_ticketno' => $data['task_ticketno'],
			'task_tackenby' => $data['task_tackenby'],
			'task_details' => $data['task_details'],
			'task_attendedby' => $data['task_attendedby'],
			'task_status' => 2,
			'task_type' => $data['task_type'],
			'task_expense' => $data['task_expense'],
			'task_recur_month' => $data['task_recur_month'],
			'task_createdby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'task_completed_date' => date("Y-m-d", strtotime($data['task_completed_date'])),
			'task_udate' => $data['task_udate']
			);
		$this->db->where('task_id', $id);
		//$this->db->where('Task_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_task', $item); 

		if($data['task_followup_date'] != " " && $data['task_followup_date'] != NULL)
		{
			// $item = array(
			// 'task_due_date' => date("Y-m-d", strtotime($data['task_followup_date'])),
			// 'task_followup_date' => date("Y-m-d", strtotime($data['task_followup_date'])),
			// 'task_udate' => $data['task_udate']
			// );
			// $this->db->where('task_id', $id);
			// $this->db->update('tbl_task', $item); 

			$item = array(
			'task_subject' => $data['task_subject'],
			'task_location' => $data['task_location'],
			'task_ticketno' => $data['task_ticketno'],
			'task_tackenby' => $data['task_tackenby'],
			'task_details' => $data['task_details'],
			'task_attendedby' => $data['task_attendedby'],
			'task_status' => 1,
			'task_type' => $data['task_type'],
			'task_recur_month' => $data['task_recur_month'],
			'task_createdby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'task_due_date' => date("Y-m-d", strtotime($data['task_followup_date'])),
			'task_cdate' => date('Y-m-d'),
			'task_udate' => $data['task_udate']
			);
			//echo '<pre>'; print_r($item);die;
			$this->db->insert('tbl_task',$item);

			if(isset($data['task_fileone']))
			{
				$item = array(
				'task_fileone' => $data['task_fileone']
				);
				$this->db->where('task_id', $lid);
				$this->db->update('tbl_task', $item); 
			}

			if(isset($data['task_filetwo']))
			{
				$item = array(
				'task_filetwo' => $data['task_filetwo']
				);
				$this->db->where('task_id', $lid);
				$this->db->update('tbl_task', $item); 
			}
		}
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_task');
		$this->db->where('task_id',$id);
		//$this->db->where('Task_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Task()
	{
		$this->db->select('tbl_task.*,attand_admin.au_fname as attand_fname,attand_admin.au_lname as attand_lname,creted_admin.au_fname as creted_fname,creted_admin.au_lname as creted_lname,support_admin.au_fname as support_fname,support_admin.au_lname as support_lname');
		$this->db->from('tbl_task');
		$this->db->join('tbl_admin_users as attand_admin','attand_admin.au_id = tbl_task.task_attendedby	');
		$this->db->join('tbl_admin_users as creted_admin','creted_admin.au_id = tbl_task.task_createdby');
		$this->db->join('tbl_admin_users as support_admin','support_admin.au_id = tbl_task.task_tackenby');
		$this->db->order_by('task_id','DESC');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('(task_attendedby', $this->session->userdata['miconlogin']['all_users'],FALSE);
				$this->db->or_where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).")",false);
				//$this->db->where('tbl_contract.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('(task_attendedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
				$this->db->or_where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).")",false);
			}
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('task_cdate >=',$stdate);
		}

		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('task_cdate <=',$stdate);
		}

		if($this->input->get('task_status') && ($this->input->get('task_status') != ''))
        {
           $this->db->like('task_status', $this->input->get('task_status'));   
        }

        if($this->input->get('task_attendto') && ($this->input->get('task_attendto') != ''))
        {
           $this->db->where('task_attendedby', $this->input->get('task_attendto'));   
        }

        if($this->input->get('task_givenby') && ($this->input->get('task_givenby') != ''))
        {
           $this->db->where('task_tackenby', $this->input->get('task_givenby'));   
        }


        if($this->input->post('task_location') && ($this->input->post('task_location') != ''))
        {
           $this->db->like('tbl_task.task_location', $this->input->post('task_location'));   
        }
        if($this->input->post('task_subject') && ($this->input->post('task_subject') != ''))
        {
           $this->db->like('tbl_task.task_subject', $this->input->post('task_subject'));   
        }
        if($this->input->post('task_ticketno') && ($this->input->post('task_ticketno') != ''))
        {
           $this->db->like('tbl_task.task_ticketno', $this->input->post('task_ticketno'));   
        }
        if($this->input->post('task_tackenby') && ($this->input->post('task_tackenby') != ''))
        {
           $this->db->like('support_admin.au_fname', $this->input->post('task_tackenby'));   
        }
        if($this->input->post('task_details') && ($this->input->post('task_details') != ''))
        {
           $this->db->like('tbl_task.task_details', $this->input->post('task_details'));   
        }
       
        
        
         if($this->input->post('task_attendedby') && ($this->input->post('task_attendedby') != ''))
        {
           $this->db->where('attand_admin.au_fname', $this->input->post('task_attendedby'));   
        }
        
        if($this->input->post('st_startudate') && $this->input->post('st_startudate') != ''){
			$start_date = date("Y-m-d", strtotime($this->input->post('st_startudate')));
			$this->db->where('DATE_FORMAT(tbl_task.task_due_date,"%Y-%m-%d") >=', $start_date);
		}
		if($this->input->post('st_endudate') && $this->input->post('st_endudate') != ''){
			$end_date = date("Y-m-d", strtotime($this->input->post('st_endudate')));
			$this->db->where('DATE_FORMAT(tbl_task.task_due_date,"%Y-%m-%d") <=', $end_date);
		}
        $this->db->order_by('task_id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->where('task_id', $id);
		$this->db->delete('tbl_task');
	}
    
    public function get_country_from_country()
    { 
    	$this->db->select('*');
        $this->db->from('tbl_master_state');
        //$this->db->join('tbl_country','tbl_country.country_id = tbl_master_state.state_country');
        $this->db->order_by('state_id', 'desc');
        //$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_state.state_country');
        $this->db->where('state_country', $this->input->post('state_id'));
        $query = $this->db->get();
        $value = $query->result_array();
        //echo(json_encode($value));
        return $value;
    }

     public function get_state($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_isdelete', 0);
        $this->db->where('state_country', $id);
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_admin()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}

    public function get_country()
    {
        $this->db->select('*');
        $this->db->from('tbl_country');
        $this->db->where('country_isdelete', 0);
        $this->db->order_by('country_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }
	
	/*public function addtTask()
	{
		
		$this->db->select('Task as Task_name');
		$this->db->from('Task');
		$query = $this->db->get();
		foreach ($query->result_array() as $Task) {
			  $this->db->insert('tbl_master_Task',$Task);
		}
	}
	public function get_addressbook() 
	{     
        $query = $this->db->get('tbl_task');
       //echo "<pre>"; print_r($query);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	*/
	 public function insert_csv() 
    {
    	//$data['addressbook'] = $this->csv_model->get_addressbook();
        //echo "string";die;
        $data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 		
        $this->load->library('upload', $config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            $this->data['main_content'] = 'importcsv_view';
		$this->load->view('includes/template',$this->data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
               // echo "<pre>"; print_r($csv_array);die;
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'name'=>$row['Baroda House S.O'],
                        //'Task_cdate'=>date("Y-m-d"),
                        //'Task_udate'=>date("Y-m-d"),
                    );
                    $this->db->insert('tbl_task', $insert_data);
                    //$this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                redirect(base_url('Task'), 'refresh');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
              	 $this->data['main_content'] = 'importcsv_view';
				$this->load->view('includes/template',$this->data,$data);
                //$this->load->view('csvindex', $data);
            }
    }
}
?>