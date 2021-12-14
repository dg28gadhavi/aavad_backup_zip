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
	public function get_reminder_task()
    {
        $this->db->select('tbl_task.*,tbl_task.task_id as auto_id,tbl_task.task_subject as subject,task_location as location,tr_ticket_no as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,task_expense as expence,alloted_to_user.au_fname as allot_first_name,alloted_to_user.au_lname as allot_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", alloted_to_user.au_photo) as alloted_to_photo,given_by_to_user.au_fname as given_by_first_name,given_by_to_user.au_lname as given_by_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", given_by_to_user.au_photo) as given_by_photo,tr_remind_date as due_date,tr_complete_date as completed_date,tbl_task_remainders.tr_id as reminder_auto_id,tr_details as reminder_details,tr_complete_date as complete_date,tr_complete_remark as complete_remark,tr_expense as expense,tr_is_completed as is_completed,tr_start_time as start_time,task_createdby,tbl_task_remainders.tr_expense as expense,task_vendor as customer_name,task_contactperson as conact_person,task_email as customer_email,task_mobile as customer_mobile,type_of_work_name');
        $this->db->from('tbl_task');
        $this->db->join('tbl_type_of_work','tbl_type_of_work.type_of_work_id = tbl_task.task_worktype','left');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        $this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby','left');
        $this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby','left');
        $this->db->where('task_status',1);
        $this->db->where('tr_is_completed !=',2);
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //echo "<pre>";print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));die;
                $this->db->where('(task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
                $this->db->or_where('task_createdby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).')',false);
            }else{
                $this->db->where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->order_by('tr_remind_date','ASC');
        
        $query = $this->db->get();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query->result_array();

    }
    public function get_task_done()
    {
        $this->db->select('tbl_task.*,tbl_task.task_id as auto_id,tbl_task.task_subject as subject,task_location as location,tr_ticket_no as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,task_expense as expence,alloted_to_user.au_fname as allot_first_name,alloted_to_user.au_lname as allot_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", alloted_to_user.au_photo) as alloted_to_photo,given_by_to_user.au_fname as given_by_first_name,given_by_to_user.au_lname as given_by_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", given_by_to_user.au_photo) as given_by_photo,tr_remind_date as due_date,tr_complete_date as completed_date,tbl_task_remainders.tr_id as reminder_auto_id,tr_details as reminder_details,tr_complete_date as complete_date,tr_complete_remark as complete_remark,tr_expense as expense,tr_is_completed as is_completed,tr_start_time as start_time,task_createdby,tbl_task_remainders.tr_expense as expense,task_vendor as customer_name,task_contactperson as conact_person,task_email as customer_email,task_mobile as customer_mobile,type_of_work_name');
        $this->db->from('tbl_task');
         $this->db->join('tbl_type_of_work','tbl_type_of_work.type_of_work_id = tbl_task.task_worktype','left');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        $this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby','left');
        $this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby','left');
        $this->db->order_by('task_id','DESC');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
        {
            $this->db->where('task_attendedby', $this->input->get('sq_attendto'));
        }

        //$this->db->where('task_status',2);
        $this->db->where('tr_is_completed',2);
        //$this->db->where('task_due_date <=',date('Y-m-d', strtotime("+7 days")));
        $this->db->order_by('tr_complete_date','DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        //echo "<pre>";print_r($query->result_array());die;
        return $query->result_array();

    }
    public function get_inq_data()
    {
    	 $value = array();

    	$this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('task_status',1);
        $this->db->where('tr_is_completed !=',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['today_taskpending'] = $query->row_array();

        $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('tr_is_completed',2);
        $this->db->where('task_completed_date',date("Y-m-d"));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['today_task'] = $query->row_array();

         $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('task_completed_date',date('Y-m-d',strtotime("-1 days")));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['yesterday_task'] = $query->row_array();

        $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
       // $this->db->where('task_completed_date',date('Y-m-d',strtotime("-7 days")));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['weekly_task'] = $query->row_array();

        $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('task_completed_date',date('Y-m-d',strtotime("-30 days")));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['monthly_task'] = $query->row_array();
        return $value;
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
	    if(isset($data['add_new']) && $data['add_new'] == 1)
	    {
		    	$item = array(
					'master_party_com_name' => $data['vendor'],
					'master_party_contact' => isset($data['task_contactperson'][0]) ? $data['task_contactperson'][0] : '',
					'master_party_cust_type' => $data['task_customer_type'],
					'master_party_location' => $data['task_location'],
					'master_party_email_address' => isset($data['task_email'][0]) ? $data['task_email'][0] : '',
					'master_party_mobile_no' => isset($data['task_mobile'][0]) ? $data['task_mobile'][0] : '',
					'master_party_office_address' => $data['task_address'],
					'master_party_billing_address' => $data['task_address'],
					'master_party_shipping_address' => $data['task_address'],
					'master_party_co_ai'=> isset($data['task_co_aavad_ins']) ? $data['task_co_aavad_ins'] : '',
					'master_party_remark'=> isset($data['task_pastcomment']) ? $data['task_pastcomment'] : '',
					'master_party_cdate' =>date("Y-m-d"),
					'master_party_udate' => date("Y-m-d")
					);
				//echo '<pre>';print_r($item);die;
				$this->db->insert('tbl_master_party',$item);
				$partyid = $this->db->insert_id();
				$data['vendor_id'] = $partyid;
				foreach ($data['task_contactperson'] as $key => $value) {
					if(isset($value) && ($value != ''))
					{
						$item = array(
							'contact_master_id' => $partyid,
							'contact_pname' => $value,
							'contact_designation' => $data['task_designation'][$key],
							'contact_mobile' => $data['task_mobile'][$key],
							'contact_email' => $data['task_email'][$key],
							'contact_address' => $data['task_address'],
							'contact_location' => $data['task_location'],
							'contact_cdate' =>date("Y-m-d"),
							'contact_udate' => date("Y-m-d")
							);
						//echo '<pre>';print_r($item);die;
						$this->db->insert('tbl_master_contactperson',$item);
					}
				}
	    }
        else{
                foreach ($data['task_contactperson'] as $key => $value) 
                {
                    if(isset($value) && ($value != ''))
                    {
                        $this->db->select('*');
                        $this->db->from('tbl_master_contactperson');
                        $this->db->where('contact_master_id',$data['vendor_id']);
                        $this->db->like('contact_pname',$value);
                        //$this->db->like('contact_pname',$value);
                        $query = $this->db->get();
                        if($query->num_rows() == 0)
                        {
                            $item = array(
                            'contact_master_id' => $data['vendor_id'],
                            'contact_pname' => $value,
                            'contact_designation' => $data['task_designation'][$key],
                            'contact_mobile' => $data['task_mobile'][$key],
                            'contact_email' => $data['task_email'][$key],
                            'contact_address' => $data['task_address'],
                            'contact_location' => $data['task_location'],
                            'contact_cdate' =>date("Y-m-d"),
                            'contact_udate' => date("Y-m-d")
                            );
                            //echo '<pre>';print_r($item);die;
                            $this->db->insert('tbl_master_contactperson',$item);
                        }
                        
                    }
                }
        }
	    foreach ($data['task_contactperson'] as $key => $value)
	    {
	    	if(isset($data['task_iscompleted']) && $data['task_iscompleted'] == 1)
	    	{
	    		$is_completed = 2;
	    	}else{
	    		$is_completed = 1;
	    	}

	    	$insert = array(
				'task_subject' => $data['task_subject'],
				'task_vendor' => $data['vendor'],
				'task_vendor_id' => $data['vendor_id'],
				'task_location' => $data['task_location'],
				'task_worktype' => $data['task_worktype'],
				'task_contactperson' => $value,
				'task_customer_type' => $data['task_customer_type'],
				'task_email' => $data['task_email'][$key],
				'task_mobile' => $data['task_mobile'][$key],
				'task_address' => $data['task_address'],
				'task_co_aavad_ins' => $data['task_co_aavad_ins'],
				'task_pastcomment' => $data['task_pastcomment'],

				'task_ticketno' => $data['task_ticketno'],
				'task_tackenby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
				'task_details' => $data['task_details'],
				'task_attendedby' => $data['task_attendedby'],
				'task_status' => $is_completed,
				'task_createdby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
				'task_due_date' => date("Y-m-d", strtotime($data['task_due_date'])),
				'task_type' => $data['task_type'],
				'task_recur_month' => isset($data['task_recur_month']) ? $data['task_recur_month'] : 1,
				'task_cdate' => date("Y-m-d H:i:s"),
				'task_udate' => date("Y-m-d H:i:s")
				);
			$this->db->insert('tbl_task',$insert);
			$lid = $this->db->insert_id();

			$this->db->select('tbl_task.task_id as auto_id,tbl_task.task_subject as subject,task_location as location,task_ticketno as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,task_expense as expence');
			$this->db->from('tbl_task');
			$this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby');
			$this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby');
			$this->db->where('task_id',$lid);
			$this->db->order_by('task_id','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			$last_task = $query->row_array();

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

			$last_task['auto_id'] = isset($last_task['auto_id']) ? $last_task['auto_id'] : '';
			$ticket_no = 'T-'.$year_string.'-'.($last_task['auto_id']+1);

			$this->db->where('task_id',$lid);
			$this->db->update('tbl_task',array('task_ticketno' => $ticket_no));

			$this->db->select('*');
			$this->db->from('tbl_task_remainders');
			$this->db->where('tr_task_id',$lid);
			$this->db->order_by('tr_task_id','DESC');
			$query = $this->db->get();
			$task_remainder_no = $query->num_rows();
			$task_remainder_no = $task_remainder_no + 1;
			$insert = array(
				'tr_task_id' => $lid,
				'tr_ticket_no' => $ticket_no.'-'.$task_remainder_no,
				'tr_given_by' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
				'tr_alloted_to' => $data['task_attendedby'],
				'tr_remind_date' => date("Y-m-d", strtotime($data['task_due_date'])),
				'tr_details' => $data['task_rdetails'],
				'tr_is_completed' => isset($is_completed) && ($is_completed == 2) ? $is_completed : 0,
				'tr_udate' => date("Y-m-d H:i:s"),
				'tr_ip' => $this->input->ip_address()
				);
			$this->db->insert('tbl_task_remainders',$insert);
			return $lid;
	    }		
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
			'task_contactperson' => $data['task_contactperson'],
			'task_customer_type' => $data['task_customer_type'],
			'task_email' => $data['task_email'],
			'task_mobile' => $data['task_mobile'],
			'task_address' => $data['task_address'],
			'task_co_aavad_ins' => $data['task_co_aavad_ins'],
			'task_pastcomment' => $data['task_pastcomment'],
			'task_ticketno' => $data['task_ticketno'],
			'task_tackenby' => $data['task_tackenby'],
			'task_details' => $data['task_details'],
			'task_attendedby' => $data['task_attendedby'],
			'task_status' => 2,
			'task_worktype' => $data['task_worktype'],
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
			'task_contactperson' => $data['task_contactperson'],
			'task_customer_type' => $data['task_customer_type'],
			'task_email' => $data['task_email'],
			'task_mobile' => $data['task_mobile'],
			'task_address' => $data['task_address'],
			'task_co_aavad_ins' => $data['task_co_aavad_ins'],
			'task_pastcomment' => $data['task_pastcomment'],
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

	public function set_as_complete_task($data)
	{
		//echo "<pre>";print_r($data);die;
		$task_id = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$reminder_id = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$this->db->select('*');
		$this->db->from('tbl_task');
		$this->db->where('task_id',$task_id);
		$this->db->order_by('task_id','DESC');
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$last_task = $query->row_array();

			$this->db->select('*');
			$this->db->from('tbl_task_remainders');
			$this->db->where('tr_id',$reminder_id);
			$this->db->order_by('tr_task_id','DESC');
			$query = $this->db->get();
			if($query->num_rows() == 1)
			{

				$update = array(
					'tr_complete_date' => date("Y-m-d", strtotime($data['tr_complete_date'])),
					'tr_complete_remark' => $data['tr_complete_remark'],
					'tr_expense' => $data['tr_expense'],
					'tr_is_completed' => 2,
					'tr_udate' => date("Y-m-d H:i:s"),
					'tr_ip' => $this->input->ip_address()
					);
				$this->db->where('tr_id',$reminder_id);
				$this->db->update('tbl_task_remainders',$update);
				if(isset($last_task['task_type']) && ($last_task['task_type'] == 2))
				{
					//$next_reminder_date = $data['comeplete_date'];
					$next_reminder_date = date('Y-m-d', strtotime("+".$last_task['task_recur_month']." months", strtotime($data['tr_complete_date'])));

					$this->db->select('*');
					$this->db->from('tbl_task_remainders');
					$this->db->where('tr_task_id',$task_id);
					$this->db->order_by('tr_task_id','DESC');
					$query = $this->db->get();
					$task_remainder_no = $query->num_rows();
					$task_remainder_no = $task_remainder_no + 1;

					$insert = array(
						'tr_task_id' => $task_id,
						'tr_ticket_no' => $last_task['task_ticketno'].'-'.$task_remainder_no,
						'tr_given_by' => $last_task['task_tackenby'],
						//'tr_alloted_to' => $data['alloted_to'],
						//'tr_details' => $data['details'],
						'tr_remind_date' => date("Y-m-d", strtotime($next_reminder_date)),
						'tr_details' => $data['remind_details'],
						// 'tr_complete_date' => $data['comeplete_date'],
						// 'tr_complete_remark' => $data['compelete_remark'],
						'tr_udate' => date("Y-m-d H:i:s"),
						'tr_ip' => $this->input->ip_address()
						);
					$this->db->insert('tbl_task_remainders',$insert);

				}
				else
				{

							if(isset($data['remind_date']) && ($data['remind_date'] != ''))
							{
								$this->db->select('*');
								$this->db->from('tbl_task_remainders');
								$this->db->where('tr_task_id',$task_id);
								$this->db->order_by('tr_task_id','DESC');
								$query = $this->db->get();
								$task_remainder_no = $query->num_rows();
								$task_remainder_no = $task_remainder_no + 1;

								$insert = array(
									'tr_task_id' => $task_id,
									'tr_ticket_no' => $last_task['task_ticketno'].'-'.$task_remainder_no,
									'tr_given_by' => $last_task['task_tackenby'],
									'tr_remind_date' => date("Y-m-d", strtotime($data['remind_date'])),
									'tr_details' => $data['remind_details'],
									'tr_udate' => date("Y-m-d H:i:s"),
									'tr_ip' => $this->input->ip_address()
									);
								$this->db->insert('tbl_task_remainders',$insert);
							}else{
								$update = array(
									'task_status' => 2,
									'task_udate' => date("Y-m-d H:i:s")
									);
								$this->db->where('task_id',$task_id);
								$this->db->update('tbl_task',$update);
							}
				}
				//die;
				return TRUE;
			}
		}else{
			return FALSE;
		}

	}

	public function task_start($id,$rid)
    {
        $this->db->select('*');
        $this->db->from('tbl_task');
        $this->db->where('task_id',$id);
        $this->db->order_by('task_id','DESC');
        $query = $this->db->get();
        //echo "<pre>hiii";print_r($id);die;
        if($query->num_rows() == 1)
        {
            $last_task = $query->row_array();

            $this->db->select('*');
            $this->db->from('tbl_task_remainders');
            $this->db->where('tr_id',$rid);
            $this->db->order_by('tr_task_id','DESC');
            $query = $this->db->get();
            if($query->num_rows() == 1)
            {
            	//echo "hiii";die;
                $update = array(
                    'tr_is_completed' => 1,
                    'tr_start_time' => date("Y-m-d H:i:s"),
                    'tr_udate' => date("Y-m-d H:i:s"),
                    'tr_ip' => $this->input->ip_address()
                    );
                $this->db->where('tr_id',$rid);
                $this->db->update('tbl_task_remainders',$update);

                return TRUE;
            }
        }else
        {
            return FALSE;
        }
    }
	
	public function get($id)
	{
		$this->db->select('tbl_task.task_id as task_id,tbl_task.task_subject as subject,task_location as location,task_ticketno as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,alloted_to_user.au_fname as allot_first_name,alloted_to_user.au_lname as allot_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", alloted_to_user.au_photo) as alloted_to_photo,given_by_to_user.au_fname as given_by_first_name,given_by_to_user.au_lname as given_by_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", given_by_to_user.au_photo) as given_by_photo,task_vendor,tbl_master_party.master_party_name,tbl_task.*,tbl_customer_type.*,tbl_type_of_work.*');
		$this->db->from('tbl_task');
		$this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby','left');
		$this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby','left');
		$this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_task.task_vendor_id','left');
		$this->db->join('tbl_type_of_work','tbl_type_of_work.type_of_work_id = tbl_task.task_worktype','left');
		$this->db->join('tbl_customer_type','tbl_customer_type.ctype_id = tbl_task.task_customer_type','left');
		$this->db->where('task_id',$id);
		$this->db->order_by('task_id','DESC');
		//$this->db->limit(10);
		$query = $this->db->get();
		
		if($query->num_rows() == 1)
		{
			$task_data = $query->row_array();

			$this->db->select('tbl_task_remainders.tr_id as reminder_auto_id,tr_ticket_no as ticketno,tr_expense as expence,tr_remind_date as remind_date,tr_complete_date as completed_date,tr_details as reminder_details,tr_complete_remark as complete_remark,tr_is_completed as is_completed,tr_start_time as start_time');
			$this->db->from('tbl_task');
			$this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id');
			$this->db->where('task_id',$id);
			//$this->db->where('tr_is_completed',1);
			$this->db->order_by('tr_id','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() >= 1){
				$starttaskdata = $query->row_array();
				if(isset($starttaskdata) && isset($starttaskdata['is_completed'])){
					$task_data['reminder_is_completed'] = $starttaskdata['is_completed'];
					$task_data['reminder_auto_id'] = $starttaskdata['reminder_auto_id'];
				}else{
					$task_data['reminder_is_completed'] = 2;
					$task_data['reminder_auto_id'] = 0;
				}
			}else{
				$task_data['reminder_is_completed'] = 2;
				$task_data['reminder_auto_id'] = 0;
			}

			$this->db->select('tbl_task_remainders.tr_id as reminder_auto_id,tr_ticket_no as ticketno,tr_expense as expence,tr_remind_date as remind_date,tr_complete_date as completed_date,tr_details as reminder_details,tr_complete_remark as complete_remark,tr_is_completed as is_completed,tr_start_time as start_time');
			$this->db->from('tbl_task');
			$this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id');
			$this->db->where('task_id',$id);
			$this->db->order_by('tr_id','DESC');
			//$this->db->limit(10);
			$query = $this->db->get();
			$task_data['reminder_datas'] = $query->result_array();
		}else{
			$task_data = array();
			$task_data['reminder_datas'] = array();
		}
		return $task_data;
		//return $query->result_array();
	}

	public function get_Task()
	{
		 $this->db->select('tbl_task.*,tbl_task.task_id as auto_id,tbl_task.task_subject as subject,task_location as location,tr_ticket_no as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,task_expense as expence,alloted_to_user.au_fname as allot_first_name,alloted_to_user.au_lname as allot_last_name,CONCAT("'.base_url().'uploads/vehicle_image/","'.'", alloted_to_user.au_photo) as alloted_to_photo,given_by_to_user.au_fname as given_by_first_name,given_by_to_user.au_lname as given_by_last_name,CONCAT("'.base_url().'uploads/vehicle_image/","'.'", given_by_to_user.au_photo) as given_by_photo,tr_remind_date as due_date,tr_complete_date as completed_date,tbl_task_remainders.tr_id as reminder_auto_id,tr_details as reminder_details,tr_complete_date as complete_date,tr_complete_remark as complete_remark,tr_expense as expense,tr_is_completed as is_completed,tr_start_time as start_time,task_createdby,type_of_work_name');
        $this->db->from('tbl_task');
        $this->db->join('tbl_type_of_work','tbl_type_of_work.type_of_work_id = tbl_task.task_worktype','left');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        $this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby','left');
        $this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby','left');
        //$this->db->where('task_status',1);
        //$this->db->where('tr_is_completed !=',2);
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
			$this->db->where('tr_remind_date >=',$stdate);
		}

		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('tr_remind_date <=',$stdate);
		}
		if($this->input->get('complete_start_date') && ($this->input->get('complete_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('complete_start_date')));
			$this->db->where('tr_complete_date >=',$stdate);
		}

		if($this->input->get('complete_end_date') && ($this->input->get('complete_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('complete_end_date')));
			$this->db->where('tr_complete_date <=',$stdate);
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
        if($this->input->get('task_worktype') && ($this->input->get('task_worktype') != ''))
        {
           $this->db->where('type_of_work_id', $this->input->get('task_worktype'));   
        }
        if($this->input->post('task_location') && ($this->input->post('task_location') != ''))
        {
           $this->db->like('tbl_task.task_location', $this->input->post('task_location'));   
        }
        if($this->input->post('task_worktype') && ($this->input->post('task_worktype') != ''))
        {
           $this->db->like('type_of_work_name', $this->input->post('task_worktype'));   
        }
        if($this->input->post('task_vendor') && ($this->input->post('task_vendor') != ''))
        {
           $this->db->like('tbl_task.task_vendor', $this->input->post('task_vendor'));   
        }
        if($this->input->post('task_contactperson') && ($this->input->post('task_contactperson') != ''))
        {
           $this->db->like('tbl_task.task_contactperson', $this->input->post('task_contactperson'));   
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

	public function get_customer_information($q)
	{
		$sql = "SELECT * from tbl_master_party WHERE UPPER(master_party_com_name) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%'  AND master_party_isdelete = 0";
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['master_party_com_name']));
				$new_row['value']=htmlentities(stripslashes($row['master_party_com_name']));
				$new_row['vendor_id']=htmlentities(stripslashes($row['master_party_id']));
				$new_row['address']=htmlentities(stripslashes($row['master_party_office_address']));
				$new_row['ctype']=htmlentities(stripslashes($row['master_party_cust_type']));
				$new_row['cno']=htmlentities(stripslashes($row['master_party_mobile_no']));
				$new_row['phone']=htmlentities(stripslashes($row['master_party_office_no']));
				$new_row['email']=htmlentities(stripslashes($row['master_party_email_address']));
				$new_row['comments']=htmlentities(stripslashes($row['master_party_pastcomment']));
				$new_row['contact_person']=htmlentities(stripslashes($row['master_party_contact']));
				$new_row['aavad_co']=htmlentities(stripslashes($row['master_party_co_ai']));
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		}
		else
		{
			$row_set = array();
			echo json_encode($row_set);
		}
	}

	public function get_customertype()
	{
		$this->db->select('*');
		$this->db->from('tbl_customer_type');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('ctype_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
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

    public function get_tasks()
    {
    	$this->db->select('*');
		$this->db->from('tbl_type_of_work');
		$this->db->where('type_of_work_isdelete', 0);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
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