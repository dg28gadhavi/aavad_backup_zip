<?php 

class Calendar_model extends CI_Model {
	
	
	public function add($data)
	{
		
		$item = array(
			'calendar_name' => $data['calendar_name'],
			'calendar_roe' => $data['calendar_roe'],
			'calendar_cid' => $this->session->userdata['login']['aus_Id'],
			'calendar_cdate' => $data['calendar_cdate'],
			'calendar_udate' => $data['calendar_udate'],
			'wt_adminid' => $adminid,
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_calendar',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data)
	{ 
	  //echo 'we are in model';
		$item = array(
			'calendar_name' => $data['calendar_name'],
			'calendar_roe' => $data['calendar_roe'],
			'calendar_udate' => $data['calendar_udate']
			);
		$this->db->where('calendar_id', $this->input->get('id'));
		$this->db->where('calendar_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_calendar', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	public function get_pdfdata($data)
	{
		$this->db->select('tbl_calendar.*,assignfrom.au_fname as assignfromname,assignto.au_fname as assigntoname');
		$this->db->from('tbl_calendar');
		$this->db->join('tbl_master_task_type','tbl_calendar.wt_task_type=tbl_master_task_type.task_id','left');
		$this->db->join('tbl_admin_users as assignfrom','assignfrom.au_id = tbl_calendar.wt_assignby');
		$this->db->join('tbl_admin_users as assignto','assignto.au_id = tbl_calendar.wt_assignto');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('wt_adminid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
			$start_date = date("Y-m-d", strtotime(date('Y-m-d')));
			$this->db->where('DATE_FORMAT(wt_startdate,"%Y-%m-%d") >=',date('Y-m-d', strtotime($data['start_date'])));
			$this->db->where('DATE_FORMAT(wt_enddate,"%Y-%m-%d") <=',date('Y-m-d', strtotime($data['start_date'])));
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$value =array();
	    $value['datas'] = $query->result_array();
	    return $value;
	}
	
	public function get()
	{
		$this->db->select('*');
		$this->db->from('tbl_calendar');
		$this->db->where('calendar_id',$this->input->get('id'));
		$this->db->where('calendar_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_calendar()
	{
		$this->db->select('*');
		$this->db->from('tbl_calendar');
		$this->db->where('calendar_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata['login']['aus_Id'] && ($this->session->userdata['login']['aus_Id'] != ""))
		{
			$this->db->where('calendar_cid',$this->session->userdata['login']['aus_Id']);
		}
		if($this->session->userdata('subadmin') && $this->session->userdata['subadmin']['aus_Id'] && ($this->session->userdata['subadmin']['aus_Id'] != ""))
		{
			$this->db->where('wt_adminid',$this->session->userdata['subadmin']['aus_Id']);
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	function insert_appt_slot($data)
	{
	    $adminid= $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);

		$admin_type = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);

		$this->db->set('wt_startdate', $data['start_dt']);
		if($data['app_id'] != '' && ($data['app_id'] != null)){
			$this->db->set('wt_enddate', date('Y-m-d H:i:s', strtotime($data['end_date'])));
			$this->db->set('wt_assigndate',date('Y-m-d H:i:s'));
		}else{
			$this->db->set('wt_enddate', date('Y-m-d H:i:s', strtotime('-1 day', strtotime($data['end_date']))));
		}
		
		$this->db->set('wt_assignby',$adminid);
		$this->db->set('wt_assignto',$data['wt_assignto']);
		$this->db->set('wt_priority',$data['wt_priority']);
		$this->db->set('wt_task_type',$data['wt_task_type']);
		$this->db->set('wt_place',$data['wt_place']);
		$this->db->set('wt_acc_date',date('Y-m-d', strtotime($data['wt_acc_date'])));
		$this->db->set('wt_description',$data['wt_description']);
		$this->db->set('wt_customer',$data['wt_customer']);
		$this->db->set('wt_city',$data['wt_city']);
		$this->db->set('wt_remark',$data['wt_remark']);
		$this->db->set('wt_expense',$data['wt_expense']);
		$this->db->set('wt_follow_date',date('Y-m-d', strtotime($data['wt_follow_date'])));
		$this->db->set('wt_completed',$data['wt_completed']);
		$this->db->set('admin_type',$admin_type);
		$this->db->set('wt_adminid', $adminid);
		if($data['app_id'] != '' && ($data['app_id'] != null)){
			$this->db->where('wt_id', $data['app_id']);
			$this->db->update('tbl_calendar'); 
			$lid = $data['app_id'];
		} else {
			$this->db->insert('tbl_calendar'); 
			$lid = $this->db->insert_id();
		}
		if(isset($data['files']) && is_array($data['files']) && !empty($data['files']))
		{
			foreach ($data['files'] as $filenames) {
				$file_insert = array(
					'cf_wt_id' => $lid,
					'cf_filename' => $filenames,
					'cf_ip' => $this->input->ip_address(),
					'cf_udate' => date("Y-m-d H:i:s")
					);
				$this->db->insert('tbl_calendar_files',$file_insert);
			}
		}
	}

	function change_dates($data)
	{
		$this->db->set('wt_startdate', date("Y-m-d H:i:s", strtotime($data['start'])));
		$this->db->set('wt_enddate', date("Y-m-d H:i:s", strtotime($data['end'])));
		$this->db->where('wt_id', $data['id']);
		$this->db->update('tbl_calendar'); 
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
	// function get_prac_details(){
	// 	$query = $this->db->get_where('tbl_doctors_practicedetails', array('dop_docid' => $this->session->userdata['medstar_user']['doc_id']));
	// 	return $query->result_array();
	// }	

	// function get_programme_types()
	// {
	// 	$query = $this->db->get('tbl_master_programme_type');
	// 	return $query->result_array();
	// }

	function select_appt_slot()
	{
		//echo $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);die();
		$this->db->select('tbl_calendar.*,assignfrom.au_fname as assignfromname,assignto.au_fname as assigntoname');
		$this->db->from('tbl_calendar');
		$this->db->join('tbl_admin_users as assignfrom','assignfrom.au_id = tbl_calendar.wt_assignby');
		$this->db->join('tbl_admin_users as assignto','assignto.au_id = tbl_calendar.wt_assignto');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
		$this->db->where('wt_adminid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->or_where('wt_assignto', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}

		if($this->input->get('assignby') && ($this->input->get('assignby') != ''))
		{
		    //echo'hiiiii';die;
			$wt_assignby = $this->input->get('assignby');
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->where('wt_assignby', $wt_assignby);
		}
		if($this->input->get('assignto') && ($this->input->get('assignto') != '')  && ($this->input->get('assignto') != 0))
		{
		    //echo'hiiiii';die;
			$wt_assignto = $this->input->get('assignto');
			//echo'<pre>';print_r($wt_assignto);die;
			$this->db->where('wt_assignto', $wt_assignto);
		}
		if($this->input->get('priority') && ($this->input->get('priority') != ''))
		{
		    //echo'hiiiii';die;
			$priority = $this->input->get('priority');
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->where('wt_priority', $priority);
		}
		if($this->input->get('completed') && ($this->input->get('completed') != ''))
		{
		    //echo'hiiiii';die;
			$completed = $this->input->get('completed');
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->where('wt_completed', $completed);
		}
		if($this->input->get('task_type') && ($this->input->get('task_type') != ''))
		{
		    //echo'hiiiii';die;
			$task_type = $this->input->get('task_type');
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->where('wt_task_type', $task_type);
		}
		if($this->input->get('place') && ($this->input->get('place') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->like('wt_place',$this->input->get('place'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->like('wt_city',$this->input->get('city'));
		}
		// if($this->input->get('place') && ($this->input->get('place') != ''))
		// {
		//     //echo'hiiiii';die;
		// 	//echo'<pre>';print_r($wt_assignby);die;
		// 	$this->db->like('wt_district',$this->input->get('place'));
		// }
		if($this->input->get('customer_name') && ($this->input->get('customer_name') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->like('wt_customer',$this->input->get('customer_name'));
		}
		if($this->input->get('text_desc') && ($this->input->get('text_desc') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->like('wt_description',$this->input->get('text_desc'));
		}
		if($this->input->get('text_desc') && ($this->input->get('text_desc') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->like('wt_description',$this->input->get('text_desc'));
		}
		if($this->input->get('remark') && ($this->input->get('remark') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$this->db->like('wt_remark',$this->input->get('remark'));
		}
		if($this->input->get('follow_date') && ($this->input->get('follow_date') != ''))
		{
		    //echo'hiiiii';die;
			//echo'<pre>';print_r($wt_assignby);die;
			$follow_date = $this->input->get('follow_date');
			$this->db->where('wt_follow_date',date("Y-m-d", strtotime($follow_date)));
		}
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$eventcolor = '';
				if($row['wt_completed'] == '1')
				{
					$eventcolor = '#009900';
				}else{
					$eventcolor = '#e50000';
				}
				$json[]= array(
			    	'id'    => $row['wt_id'],
			    	'start' => $row['wt_startdate'],
			    	'end_dt' => $row['wt_enddate'],
			    	'end' => $row['wt_enddate'],
			    	'title' => '<span class = "badge badge-warning" style="color:black;font-weight:500;height: 12px;text-align:left; float:left;">'.date("g:i a", strtotime($row['wt_startdate'])).'-'.date("g:i a", strtotime($row['wt_enddate'])).'</span>'.'<div class="lblheading" style="float:left;"> '.$row['wt_customer'].'</div>',//.'<br/>From: '.$row['assignfromname'].'<br/>To: '.$row['assigntoname'].'</span>'
			    	'backgroundColor' => $eventcolor

			    );	
			}
		}else{
			$json[]= array();
		}
		//$json[]= array();
		header('Content-Type: application/json');
		echo json_encode( $json );
	}

	function delelte_slot($id)
	{
		$this->db->delete('tbl_calendar',array('wt_id' => $id)); 
	}

	function delelte_files($id)
	{
		$this->db->delete('tbl_calendar_files',array('cf_id' => $id)); 
	}

	function check_update_availability($id)
	{
		$chk_qry = $this->db->get_where('tbl_calendar',array('wt_id' => $id));
		$row = $chk_qry->row_array(); 
		$chk_qry = $this->db->get_where('tbl_calendar_files',array('cf_wt_id' => $id));
		$row['files'] = $chk_qry->result_array();
		echo json_encode($row);
	}
	function check_insert_availability($time){
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
		$this->db->from('tbl_calendar');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_task()
	{
	    $this->db->select('*');
		$this->db->from('tbl_master_task_type');
		$this->db->where('task_isdelete', 0);
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_assign()
	{
	    $this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_is_delete', '0');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_count()
	{
	   $value = array();

        $this->db->select('COUNT(wt_id) as count');
        $this->db->from('tbl_calendar');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('wt_adminid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $this->db->where('wt_completed','1');
        $query = $this->db->get();
        $value['completed'] = $query->row_array();

        $this->db->select('COUNT(wt_id) as count');
        $this->db->from('tbl_calendar');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('wt_adminid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $this->db->where('wt_completed','2');
        $query = $this->db->get();
        $value['pending'] = $query->row_array();
        //echo'<pre>';print_r($value);die;
        return $value;

	}
	public function get_grid_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_calendar');
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
	// 	$this->db->from('tbl_calendar');
	// 	$this->db->where('wt_id', $this->input->get('id'));
	// 	$this->db->order_by('wt_id','DESC');
	// 	$query = $this->db->get();
	// 	echo'<pre>';print_r($query->result_array());die;
	// 	return $query->result_array();
	// }
	public function get_today()
	{
		$this->db->select('*');
		$this->db->from('tbl_calendar');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('wt_adminid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
			if($this->input->get('assignto') && ($this->input->get('assignto') != '')  && ($this->input->get('assignto') != 0))
			{
			    //echo'hiiiii';die;
				$wt_assignto = $this->input->get('assignto');
				//echo'<pre>';print_r($wt_assignto);die;
				$this->db->where('wt_assignto', $wt_assignto);
			}
			if($this->input->get('priority') && ($this->input->get('priority') != ''))
			{
			    //echo'hiiiii';die;
				$priority = $this->input->get('priority');
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->where('wt_priority', $priority);
			}
			if($this->input->get('completed') && ($this->input->get('completed') != ''))
			{
			    //echo'hiiiii';die;
				$completed = $this->input->get('completed');
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->where('wt_completed', $completed);
			}
			if($this->input->get('task_type') && ($this->input->get('task_type') != ''))
			{
			    //echo'hiiiii';die;
				$task_type = $this->input->get('task_type');
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->where('wt_task_type', $task_type);
			}
			if($this->input->get('place') && ($this->input->get('place') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->like('wt_place',$this->input->get('place'));
			}
			if($this->input->get('city') && ($this->input->get('city') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->like('wt_city',$this->input->get('city'));
			}
			// if($this->input->get('place') && ($this->input->get('place') != ''))
			// {
			//     //echo'hiiiii';die;
			// 	//echo'<pre>';print_r($wt_assignby);die;
			// 	$this->db->like('wt_district',$this->input->get('place'));
			// }
			if($this->input->get('customer_name') && ($this->input->get('customer_name') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->like('wt_customer',$this->input->get('customer_name'));
			}
			if($this->input->get('text_desc') && ($this->input->get('text_desc') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->like('wt_description',$this->input->get('text_desc'));
			}
			if($this->input->get('text_desc') && ($this->input->get('text_desc') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->like('wt_description',$this->input->get('text_desc'));
			}
			if($this->input->get('remark') && ($this->input->get('remark') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$this->db->like('wt_remark',$this->input->get('remark'));
			}
			if($this->input->get('follow_date') && ($this->input->get('follow_date') != ''))
			{
			    //echo'hiiiii';die;
				//echo'<pre>';print_r($wt_assignby);die;
				$follow_date = $this->input->get('follow_date');
				$this->db->where('wt_follow_date',date("Y-m-d", strtotime($follow_date)));
			}
			//if(date('Y-m-d'))
		//{
		    //echo'hiiiii';die;
			$start_date = date("Y-m-d", strtotime(date('Y-m-d')));
			$this->db->where('DATE_FORMAT(wt_startdate,"%Y-%m-%d") >=', $start_date);
		//}
		//if(date('Y-m-d'))
		//{
			//echo'hiiiii';die;
			//$end_date = date("Y-m-d", strtotime(date('Y-m-d')));
			$this->db->where('DATE_FORMAT(wt_enddate,"%Y-%m-%d") <=', $start_date);
		//}

		$query = $this->db->get();
		//echo $this->db->last_query();die;
	    return $query->result_array();
	}

	public function get_datewise_events($data)
	{
		$this->db->select('tbl_calendar.*,assignfrom.au_fname as assignfromname,assignto.au_fname as assigntoname');
		$this->db->from('tbl_calendar');
		$this->db->join('tbl_master_task_type','tbl_calendar.wt_task_type=tbl_master_task_type.task_id','left');
		$this->db->join('tbl_admin_users as assignfrom','assignfrom.au_id = tbl_calendar.wt_assignby');
		$this->db->join('tbl_admin_users as assignto','assignto.au_id = tbl_calendar.wt_assignto');
		
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('wt_adminid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			$this->db->or_where('wt_assignto', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}

		$start_date = date("Y-m-d", strtotime(date('Y-m-d')));
		$this->db->where('DATE_FORMAT(wt_startdate,"%Y-%m-%d") >=', $data['start']);
		$this->db->where('DATE_FORMAT(wt_enddate,"%Y-%m-%d") <=', $data['start']);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
	    return $query->result_array();
	}
}
?>