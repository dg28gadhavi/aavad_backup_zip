<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc_inward extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('Doc_inward_model');
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->library('image_lib');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Doc_inward_report';
		$this->load->view('includes/template',$this->data);
	}

	public function Report_email()
	{
		///die;
		if($this->input->get('doc_inward_created_date') && $this->input->get('doc_inward_updated_date')){
			$data['user'] = $this->Doc_inward_model->sales_inq_report();
			$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
			$mailerdata = $this->Doc_inward_model->get_mailer_detail($uid);
			//echo '<pre>'; print_r($user); die;
			$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
			$config = array();
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.gmail.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $mailerdata['au_gmail_email'];
			$config['smtp_pass']    = $mailerdata['au_gmail_password'];
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not
			$message = '';
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($mailerdata['au_gmail_email']);
			$this->email->to("parag@miconindia.com,hr@miconindia.com,niket@miconindia.com");
			$message=$this->load->view('doc_inward_mail_view',$data,true);
			//$this->Pricing_cal_model->save_maildata($idencr);
			$this->email->subject("Document Inward Report From : ".$this->input->get('doc_inward_created_date')." To : ".$this->input->get('doc_inward_updated_date'));
			$this->email->message($message);
	      	if($this->email->send())
	     	{
			      echo 'Email sent.';
			      $this->session->set_flashdata('success', 'Mail sent successfully.');
			      die;
				  //redirect(base_url()."Doc_inward/Doc_inward_report");
		     }
		     else
		    {
		     show_error($this->email->print_debugger());
		     $this->session->set_flashdata('error', 'Mail not sent successfully!!');
		     echo 'error';die;
		     //redirect(base_url()."Doc_inward/Doc_inward_report");
		    }
		}else{
			echo 'Pl. select start date and end date.';
		}
	}

	public function ajax()
	{
		$user = $this->Doc_inward_model->get_Doc_inward();
		$iTotalRecords = count($user);
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		$status_list = array(
			array("success" => "Pending"),
			array("info" => "Closed"),
			array("danger" => "On Hold"),
			array("warning" => "Fraud")
		);
		
		for($i = $iDisplayStart; $i < $end; $i++) {
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['sq_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Doc_inward/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Doc_inward/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a href="'.base_url().'pdf/enq/enq'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-search"></i> View PDF</a>';
		}

		if($user[$i]['sq_inq_priority'] == 1)
			{
	         	 $sst = '<span>High</span>';
			}else if($user[$i]['sq_inq_priority'] == 2)
				{
					 $sst = '<span>Low</span>';
				}
				else if($user[$i]['sq_inq_priority'] == 3)
				{
					 $sst = '<span>Medium</span>';
				}else{
					$sst = '';
				}
		if($user[$i]['sq_inq_sts'] == 1)
		{
			 $sstt = '<span class="label label-primary">Active</span>';
		}else if($user[$i]['sq_inq_sts'] == 2)
			{
				 $sstt = '<span class="label label-warning">Pending</span>';
			}
			else if($user[$i]['sq_inq_sts'] == 3)
			{
				 $sstt = '<span class="label label-success">Completed</span>';
			}
			else if($user[$i]['sq_inq_sts'] == 5)
			{
				 $sstt = '<span class="label label-warning">Drop</span>';
			}
			else{
					$sstt = '';
				}
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['sq_id'].'">',
			  $id,
				''.$user[$i]['sq_no'],
				''.$user[$i]['vendor'],
				//''.date("d-m-Y", strtotime($user[$i]['sq_enq_date'])),
				//''.$user[$i]['mode_inquiry_name'],	
				//''.$user[$i]['mode_inquiry_name'],
				''.$sstt,
				''.$sst,
				''.$user[$i]['sq_remarks'],
				''.$user[$i]['sq_mobile'],
				''.date("d-m-Y", strtotime($user[$i]['sq_enq_date'])),
				''.$user[$i]['sq_ref_by'],
				 ''.date("d-m-Y", strtotime($user[$i]['sq_udate'])),
			  ''.$editstr.''.$deletestr.''.$viewpdfstr.'',
		);
		}

		if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
			$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		echo json_encode($records);
	}
	
	public function Doc_inward_report()
	{
		ini_set('memory_limit', '-1');
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward VIew functionality");
			redirect(base_url());
		}
		//$this->data['admins'] = $this->Doc_inward_model->get_admin();
		$this->data['report_result'] = $this->Doc_inward_model->get_totalreport();
		//$this->data['custometyps'] = $this->Doc_inward_model->get_customertype();
		//$this->data['Doc_inward'] = $this->Doc_inward_model->get_Doc_inward();
		$this->data['main_content'] = 'Doc_inward_report';
		$this->load->view('includes/template',$this->data);
	}
	public function sales_b2b_inq_report()
	{
		ini_set('memory_limit', '-1');
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access B2B Inq VIew functionality");
			redirect(base_url());
		}
		$b2b_info=$this->Doc_inward_model->b2b_type_info();
		//echo '<pre>'; print_r($b2b_info); die;
		$edate_trade=date('Y-m-d');
		$sdate_trade=date('Y-m-d', strtotime(date('Y-m-d'). ' - 5 days'));
		//echo 'https://www.tradeindia.com/utils/my_inquiry.html?userid=1286889&profile_id=1726444&key=28b7ecfa911b789f3472ce6a9fd902fd&from_date=2016-01-01&to_date=2016-12-31&limit=10&page_no=1';die;
		$startdate=date('d-F-Y', strtotime(date('d-F-Y'). ' - 5 days'));
		$enddate=date('d-F-Y');
										$url='https://www.tradeindia.com/utils/my_inquiry.html?userid='.$b2b_info['b2b_trad_uid'].'&profile_id='.$b2b_info['b2b_trad_pid'].'&key='.$b2b_info['b2b_trad_key'].'&from_date='.$sdate_trade."&to_date=".$edate_trade.'';
										   $json = file_get_contents($url);
										   $json_trade = json_decode( $json);
										   //echo "<pre>";print_r($json_trade);die;
									       
								           $inq_trade=$this->Doc_inward_model->insert_trade_btob_inq($json_trade);

								           $ind_url='http://mapi.indiamart.com/wservce/enquiry/listing/GLUSR_MOBILE/'.$b2b_info['b2b_ind_mob_no'].'/GLUSR_MOBILE_KEY/'.$b2b_info['b2b_ind_mob_key'].'/Start_Time/'.$startdate."/End_Time/".$enddate.'/';
		                 //                   $ch = curl_init($ind_url);
								           // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
								           // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								           // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								           //     'Content-Type: application/json')
								           // ); 
								           // $result2 =  curl_exec($ch);
								           // $error = curl_error($ch);
								            $json = file_get_contents($ind_url);
								           $jsonresult = json_decode($json);
								            //echo '<pre>'; print_r($jsonresult); die;
								           $inq_india=$this->Doc_inward_model->insert_india_btob_inq($jsonresult);

								           

		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward VIew functionality");
			redirect(base_url());
		}
		//$this->data['b2b_inq'] = $this->Doc_inward_model->get_b2binq();
		$this->data['main_content'] = 'Sales_b2b_enq_report';
		$this->load->view('includes/template',$this->data);
	}
	public function ajax_b2b_salesinq_report()
	{
		ini_set('memory_limit', '-1');
		$user = $this->Doc_inward_model->get_b2binq();
		//echo '<pre>';print_r($user);die;
		$iTotalRecords = count($user);
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		$status_list = array(
			array("success" => "Pending"),
			array("info" => "Closed"),
			array("danger" => "On Hold"),
			array("warning" => "Fraud")
		);
		
		for($i = $iDisplayStart; $i < $end; $i++) {
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['b2binq_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else
		{
			$editstr = '<a title="Edit" href="'.base_url().'Doc_inward/add_b2b_comments/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-comments"></i></a>';
		}
		//echo "<pre>";print_r($user[$i]['au_id']);die;
		if(isset($user[$i]['au_id']) && $user[$i]['au_id'] != '')
		{
			$assignstr = '';
		}
		else
		{
			$assignstr = '<a title="Assign To Yourself" href="'.base_url().'Doc_inward/assign_b2b_inq/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Assign this Inquiry?'".')" class="btn btn-sm btn-outline green"><i class="fa fa-check-circle"></i></a>';
			
		}
	
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$quotestr = '';
		}else{
			$quotestr = '<a title="Create Quotation" href="'.base_url().'Doc_inward/create_quote/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create Quotation?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i></a>';
		}
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/enq/enq'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}

		if($user[$i]['b2binq_type'] == 1)
		{
			 $type = '<span class="label label-primary">India Mart</span>';
		}else
		{
			$type = '<span class="label label-warning">Trade India</span>';
		}
		if($user[$i]['b2binq_assignby'] != '')
		{
			 $assignname = '<span class="label label-primary">'.$user[$i]['au_fname'].$user[$i]['au_lname'].'</span>';
		}else
		{
			$assignname = '';
		}

			
		$records["data"][] = array(
				''.$user[$i]['b2binq_id'],
				''.$type,
				''.$user[$i]['b2binq_cust_name'].",".$user[$i]['b2binq_companyname'],
				''.$user[$i]['b2binq_cust_email']." ".$user[$i]['b2binq_cust_mno'].",".$user[$i]['b2binq_cust_phone'].",".$user[$i]['b2binq_cust_phone_alt'],
				''.substr($user[$i]['b2binq_massage'],0,40)."..." ,
				''.$user[$i]['b2binq_subject'],
				''.date('d-m-Y H:i:s',strtotime($user[$i]['b2binq_datetime'])),
			''.$user[$i]['b2binq_address'].",".$user[$i]['b2binq_city'].",".$user[$i]['b2binq_state'].",".$user[$i]['b2binq_country'],
				''.$user[$i]['b2binq_product_name'],
				$assignname,//$user[$i]['b2bu_ad_id']
			  $assignstr.' '.$editstr,
		);
		}

		if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
			$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		echo json_encode($records);
	}
	public function add_b2b_comments()
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$success = $this->validation();
			
			if($success == TRUE)
			{
				if($this->input->post(NULL,FALSE))
				{
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					//echo "<pre>"; print_r($idencr); die;
					$lid = $this->Doc_inward_model->edit_b2b($value,$idencr);
					if($lid)
					{	
						$this->session->set_flashdata('success', 'sales_b2b_inq_report edited successfully.');
						redirect(base_url('Doc_inward/add_b2b_comments/'.$enid), 'refresh');
					}else{
					
						$this->session->set_flashdata('error', 'sales_b2b_inq_report not edited successfully!!');
					}
				 	redirect(base_url('Doc_inward/add_b2b_comments/'.$enid), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != '')
				{
					$this->data['list'] = $this->Doc_inward_model->get_b2binq_id($idencr);
					$this->data['chat_list'] = $this->Doc_inward_model->get_b2biq_chat($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Doc_inward/add_b2b_comments/".$enid;
						$this->data['main_content'] = 'Sales_b2b_enq_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{

						 $this->session->set_flashdata('error', 'Sales_b2b_enq_form_view not Available!!');
						 redirect(base_url('Doc_inward/sales_b2b_inq_report'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales_b2b_enq_form_view not Available!!');
					redirect(base_url('Doc_inward/sales_b2b_inq_report'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Doc_inward/sales_b2b_inq_report'), 'refresh'); 
		}
	}
	public function delete_chat()
	{
				//echo "hiiiii";die;
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//echo "<pre>"; print_r($idencr); die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['b2bu_udate'] = date('Y-m-d H:i:s');
				$chat_id = $this->input->get('chatid') ? $this->input->get('chatid') : 0;
				$lid = $this->Doc_inward_model->delete_chat($value,$chat_id);
				if($lid)
				{
					$enid = $this->uri->segment(3) ? $this->encrypt_decrypt('encrypt', $idencr) : '';
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Doc_inward/add_b2b_comments/'.$enid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Doc_inward/add_b2b_comments/'.$idencr), 'refresh');
				}
			 	redirect(base_url('Doc_inward/add_b2b_comments/'.$idencr), 'refresh');
	}
	public function assign_b2b_inq()
	{
		$inq_id = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $inq_id) : '';
		$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['b2bu_udate'] = date('Y-m-d H:i:s');
				$lid = $this->Doc_inward_model->assign_b2b_inq($idencr);
				if($lid)
				{
					$this->session->set_flashdata('success', 'successfully.');
					redirect(base_url('Doc_inward/sales_b2b_inq_report'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'not Edited successfully!!');
					redirect(base_url('Doc_inward/sales_b2b_inq_report'), 'refresh');
				}
			 	redirect(base_url('Doc_inward/sales_b2b_inq_report'), 'refresh');
	}
	public function followup()
	{

		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry Report VIew functionality");
			redirect(base_url());
		}
		//echo "<pre>"; print_r($this->data['datas']); die;
		$this->data['total'] = $this->Doc_inward_model->count();
		$this->data['listfolloup'] = $this->Doc_inward_model->get_listofollow();
		$this->data['main_content'] = 'Followup_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax_followup()
	{
		$user = $this->Doc_inward_model->get_followup();
		//echo "<pre>"; print_r($user); die;
		$iTotalRecords = count($user);
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		$status_list = array(
			array("success" => "Pending"),
			array("info" => "Closed"),
			array("danger" => "On Hold"),
			array("warning" => "Fraud")
		);
		
		for($i = $iDisplayStart; $i < $end; $i++) {
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$fuidenc = $this->encrypt_decrypt('encrypt',$user[$i]['fuid']);
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['id']);
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Doc_inward/other_details/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Doc_inward/delete_fup_sec/'.$fuidenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}
		$actstr = '';
		if($user[$i]['folst'] == 6){
			$actstr = '<a href="'.base_url().'Doc_inward/status_act/'.$fuidenc.'"onclick="return confirm('."'Are you sure you want to Active this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Active</a>';
		}
		if($user[$i]['folst'] == 5){
		$actstr = '<a href="'.base_url().'Doc_inward/status_deact/'.$fuidenc.'"onclick="return confirm('."'Are you sure you want to Deactive this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Deactivate</a>';
		}
		if(isset($user[$i]['followdate']) && $user[$i]['followdate'] != '')
		 {
		 	$user[$i]['followdate'] = date("d-m-Y", strtotime($user[$i]['followdate']));
		 }else{
		 	$user[$i]['followdate'] = '';
		 }
		 if(isset($user[$i]['folst']) && $user[$i]['folst'] == 5)
		 {
		 	$user[$i]['stname'] = 'Active';
		 }else if(isset($user[$i]['folst']) && $user[$i]['folst'] == 6){
		 	$user[$i]['stname'] = 'Deactive';
		 }else{
		 	$user[$i]['stname'] = '';
		 }
		$records["data"][] = array(
			  // '<input type="checkbox" name="delid[]" value="'.$idenc.'">',
			   $id,
			  ''.$user[$i]['name'],
			  ''.isset($user[$i]['mno']) ? $user[$i]['mno'] : '',
			  //'',
			  ''.isset($user[$i]['stname']) ? $user[$i]['stname'] : '',
			  ''.$user[$i]['followdate'],
			  ''.isset($user[$i]['executive']) ? $user[$i]['executive'] : '',
			  ''.isset($user[$i]['fu_remark']) ? $user[$i]['fu_remark'] : '',
			  ''.$editstr.''.$deletestr.''.$actstr
		);
		}

		if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
			$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		echo json_encode($records);
	}

	public function ajax_salesinq_report()
	{
		$user = $this->Doc_inward_model->sales_inq_report();
		//echo '<pre>';print_r($user);die;
		$iTotalRecords = count($user);
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		$status_list = array(
			array("success" => "Pending"),
			array("info" => "Closed"),
			array("danger" => "On Hold"),
			array("warning" => "Fraud")
		);
		
		for($i = $iDisplayStart; $i < $end; $i++) {
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['doc_inward_id']);
		$pdfpath = ''.base_url().'pdf/Doc_inward/Doc_inward'.$idenc.'.pdf';
		$pdfpath = base_url().'Doc_inward/pdf_load?inpdfid='.$idenc;
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Doc_inward/other_details/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a title="delete" href="'.base_url().'Doc_inward/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$quotestr = '';
		}else{
			$quotestr = '<a title="Create Quotation" href="'.base_url().'Doc_inward/create_quote/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create Quotation?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i></a>';
		}
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.$pdfpath.'" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
			//$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/enq/enq'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}
		$user[$i]['doc_inward_partyid']=$user[$i]['master_party_name'];
		
		if($user[$i]['doc_inward_detail']=='1'){

			$user[$i]['doc_inward_detail'] = "Parcel";
		}else{
		$user[$i]['doc_inward_detail'] = "Cover";
	}
		
		$records["data"][] = array(
				''.$user[$i]['doc_inward_code'],
				''.$user[$i]['doc_inward_srno'],
				''.$user[$i]['doc_inward_partyid'],
				''.$user[$i]['doc_inward_docketno'],
				''.$user[$i]['doc_inward_courier_name'],
				''.$user[$i]['doc_inward_detail'],
				''.$user[$i]['doc_inward_desc'],
				''.$user[$i]['doc_inward_remark'],
				''.$user[$i]['doc_inward_created_date'],
			  ''.$editstr.''.$deletestr,
		);
		}

		if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
			$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		echo json_encode($records);
	}

	public function add()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{	
				//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['doc_inward_created_date'] = date('Y-m-d');
				$value['doc_inward_updated_date'] = date('Y-m-d H:i:s');
				//$this->session->set_userdata('tabno',2);
				$lid = $this->Doc_inward_model->add($value);
				$this->session->set_userdata('tabno',1);
				//***********PDF File Code Start********************
				// $pdfdata = $this->Doc_inward_model->get_pdfdata($lid,'Doc_inward');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End********************
				//echo $lid; die;
				if($lid)
				{
					//die;
					$this->session->set_flashdata('success', 'Doc_inward added successfully.');
					redirect(base_url('Doc_inward/Doc_inward_report/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Doc_inward not added successfully!!');
					redirect(base_url('Doc_inward/add'), 'refresh');
				}
			 	redirect(base_url('Doc_inward'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function other_add()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_quo Add functionality");
			redirect(base_url());
		}

			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['sq_cdate'] = date('Y-m-d H:i:s');
				$value['sq_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',4);
				$lid = $this->Doc_inward_model->other_add($value);
				//***********PDF File Code Start********************
				$pdfdata = $this->Doc_inward_model->get_pdfdata($lid,'Doc_inward');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Other Details added successfully.');
					redirect(base_url('Doc_inward/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Other Details not added successfully!!');
					redirect(base_url('Doc_inward/add'), 'refresh');
				}
			 	redirect(base_url('Doc_inward'), 'refresh');
			}else{
			$this->other_details();
		}
	}

	public function item_add()
	{
			ini_set('memory_limit', '-1');
			require 'Zebra_Image.php';
			$right_status = $this->check_rights('add');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward Add functionality");
				redirect(base_url());
			}
			//echo "<pre>"; print_r($_FILES); die;
			
		
			if($_FILES)
			{	
				//echo "<pre>"; print_r($this->input->post()); die;
			//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['inwi_cdate'] = date('Y-m-d H:i:s');
				$value['inwi_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',2);
					if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->Doc_inward_model->item_img($value);
					//if(count($result) > 0)
					//{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					//}
				}
				$lid = $this->Doc_inward_model->item_add($value);
				
				//***********PDF File Code Start********************
				// $pdfdata = $this->Doc_inward_model->get_pdfdata($lid,'Doc_inward');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// //ini_set('memory_limit','32M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item added successfully.');
					redirect(base_url('Doc_inward/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not added successfully!!');
					redirect(base_url('Doc_inward/add'), 'refresh');
				}
			 	redirect(base_url('Doc_inward'), 'refresh');
			}else{
			$this->other_details();
		}
	}

	public function item_edit()
	{
		$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
		$success = $this->validation();
		if($success == TRUE)
		{
		    ini_set('memory_limit', '-1');
			require 'Zebra_Image.php';
			$right_status = $this->check_rights('edit');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward Edit functionality");
				redirect(base_url());
			}
			//echo "<pre>"; print_r($_FILES); die;
			
		
			if($_FILES && $this->input->get('acttype') && ($this->input->get('acttype') == 'edit') && $this->input->get('itemid'))
			{	
				//echo "<pre>"; print_r($this->input->post()); die;
			//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['doc_inward_updated_date'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',2);
					/*if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->Doc_inward_model->item_img($value);
					//if(count($result) > 0)
					//{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					//}
				}*/
				$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
				$response = $this->Doc_inward_model->edit($value,$sqiitemid);
				
				//***********PDF File Code Start********************
				// $pdfdata = $this->Doc_inward_model->get_pdfdata($lid,'Doc_inward');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// //ini_set('memory_limit','32M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End********************
				if(isset($response['status']) && ($response['status'] == true))
				{
					$this->session->set_flashdata('success_item', 'Details of item added successfully.');
					redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error_item', $response['msg']);
					redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}
			 	redirect(base_url('Doc_inward'), 'refresh');
			}else{
			$this->other_details();
		}
		}
		if($success == FALSE)
		{
			$this->session->set_flashdata('error_item', "Pl.Select Item.");
		 redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
		}
	}

	
	public function folup_add()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward Add functionality");
			redirect(base_url());
		}
		
			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['sq_cdate'] = date('Y-m-d H:i:s');
				$value['sq_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',3);
				$lid = $this->Doc_inward_model->folup_add($value);
				//***********PDF File Code Start********************
				$pdfdata = $this->Doc_inward_model->get_pdfdata($lid,'Doc_inward');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Follow up details added successfully.');
					redirect(base_url('Doc_inward/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Follow up details not added successfully!!');
					redirect(base_url('Doc_inward/add'), 'refresh');
				}
			 	redirect(base_url('Doc_inward'), 'refresh');
			}else{
			$this->other_details();
		}
	}

	public function other_details()
	{
		//die;
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['autosearch_items'] = $this->Doc_inward_model->get_customertype();
		 $this->data['custometyps'] = $this->Doc_inward_model->get_customertype();
		 $this->data['list'] = $this->Doc_inward_model->get($idencr);
		 //echo '<pre>';print_r($this->data['po_items']);die;

		//echo "<pre>"; print_r($this->data['items']); die;
		 $this->data['vendors'] = $this->Doc_inward_model->get_masterparty();
		//$this->data['inw_no'] = $this->Doc_inward_model->inw_no_get();
		//$this->data['admins'] = $this->Doc_inward_model->get_admin();
		$this->data['main_content'] = 'Doc_inward_form_view';
		$this->data['action'] = "Doc_inward/add/".$this->uri->segment(3);
		//$this->data['action_othr'] = "Doc_inward/other_add/".$this->uri->segment(3);
		//$this->data['action_itm'] = "Doc_inward/item_add/".$this->uri->segment(3);
		//$this->data['action_fup'] = "Doc_inward/folup_add/".$this->uri->segment(3);
		$this->load->view('includes/template',$this->data);
	}

	public function potoDoc_inward()
	{
		$response=$this->Doc_inward_model->potoDoc_inward();
		if(isset($response['status']) && ($response['status'] == true))
		{
			$this->session->set_userdata('tabno',3);
			$this->session->set_flashdata('success_item', 'Details of item added successfully.');
			redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(3).'?acttype=edit&itemid='.$response['last_insert_id']), 'refresh');
		}else{
			$this->session->set_userdata('tabno',3);
			$this->session->set_flashdata('error_item', $response['msg']);
			//die;
			redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(3)), 'refresh');
		}
	}

	public function validation() 
	{
		//echo "hiii";die;
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add')
			{
				$this->form_validation->set_rules('doc_inward_code', 'doc_inward_code', 'trim|required');
				//$this->form_validation->set_rules('sqi_itm_pno', 'sqi_itm_pno', 'trim|required');  
				//$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');
			}else if($this->input->get('acttype') == 'edit')
			{
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('sqi_itm_pno', 'sqi_itm_pno', 'trim|required');
				//$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');   
			}
			else 
			{
				//echo "hiiixsds";die;
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				//$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');   
			}
			
		   if($this->form_validation->run() == FALSE)
		   {
			 return FALSE;
		   }
		   else
		   {
			 return TRUE;
		   }	
		}
	}
	
	public function get_form()
	{
		//$this->data['custometyps'] = $this->Doc_inward_model->get_customertype();
		//$this->data['inw_no'] = $this->Doc_inward_model->inw_no_get();
		$this->data['vendors'] = $this->Doc_inward_model->get_masterparty();
		//$this->Doc_inward_model->copy_all_master_party();
		$this->data['main_content'] = 'Doc_inward_form_view';
		$this->data['action'] = "Doc_inward/add";
		$this->load->view('includes/template',$this->data);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}

	public function delete($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Doc_inward_model->get($idencr);

				if(!empty($this->data['list'])){
					$lid = $this->Doc_inward_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Doc_inward deleted successfully.');
						redirect('Doc_inward/Doc_inward_report', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Doc_inward not deleted successfully!!.');
							redirect('Doc_inward/Doc_inward_report', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Doc_inward not Available!!');
			  		redirect('Doc_inward/Doc_inward_report', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Doc_inward not Available!!');
					redirect('Doc_inward/Doc_inward_report', 'refresh'); 
			}
			redirect('Doc_inward/Doc_inward_report', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Doc_inward/Doc_inward_report'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward Delete functionality");
			redirect(base_url());
		}
		//echo '<pre>';print_r($this->input->get('delid'));die;
		$myid = $this->input->get('delid');
		if($myid && is_array($myid) && !empty($myid))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->Doc_inward_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->Doc_inward_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Doc_inward inquiry deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Doc_inward inquiry not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Doc_inward inquiry not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Doc_inward inquiry not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Doc_inward'), 'refresh');

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
	
	
	public function importcsv() 
  	{		
		if($this->input->post() && isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != ''))
		{
			$data['error'] = '';    //initialize image upload error array to empty
			$config['upload_path'] = './uploads/csv/';
			$config['allowed_types'] = 'csv';
			$config['overwrite'] = TRUE;
			$config['max_size'] = '1000000000000000000000000000000000000000000000000000000000000000000';
			$this->load->library('upload', $config);
			
			// If upload failed, display error
			if (!$this->upload->do_upload()) {
			
				$data['error'] = $this->upload->display_errors();
				echo"<pre>";print_r($data);die;
				$this->data['action'] = "Doc_inward/importcsv";
				$this->data['main_content'] = 'importcsv_view';
				$this->load->view('includes/template',$this->data);
			}else 
			{
				$file_data = $this->upload->data();
				$file_path =  './uploads/csv/'.$file_data['file_name'];
				if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					//echo"<pre>";print_r($csv_array);die;
					if(is_array($csv_array) && !empty($csv_array))
					{
						foreach ($csv_array as $row)
						{
							//echo "<pre>";print_r($row['Contact1']);die;
							if(isset($row['Doc_inward']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['Doc_inwardCode'])))
							{
								$this->Doc_inward_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Doc_inward'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Doc_inward/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Doc_inward/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Doc_inward/importcsv";
		$this->data['main_content'] = 'importcsv_view';
		$this->load->view('includes/template',$this->data);
	}

	public function check_rights($type)
	{
		$status = false;
		if(isset($this->session->userdata['miconlogin']['rightsid']) && ($this->session->userdata['miconlogin']['rightsid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ($this->session->userdata['miconlogin']['typeid'] != ''))
		{
			$rightsid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['rightsid']);
			$typeid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
			if($typeid != 3)
			{
				$this->load->model('global_model');
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 43,$type);
				if(isset($finalrights) && ($finalrights == 1))
				{
					$status = true;
				}else{
					$status = false;
				}
			}else{
				$status = true;
			}
		}
		return $status;
	}

	public function pdf_load()
		{
				$files = glob(FCPATH.'pdf/Doc_inward/*.pdf'); //get all file names
				foreach($files as $file){
					if(is_file($file))
					unlink($file); //delete file
				}
				$lid = $this->input->get('inpdfid');
				//echo $lid;
				$pdfdata = $this->Doc_inward_model->get_pdfdata($lid);
				$html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
				$redirectpath = base_url().'/pdf/Doc_inward/Doc_inward'.$lid.'.pdf';
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/Doc_inward/Doc_inward'.$lid.'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
				redirect($redirectpath);
	}

	public function setbit_Doc_inward()
	{
		$this->Doc_inward_model->setbit_Doc_inward();
	}

	function is_loggedin()
	{
		if(isset($this->session->userdata['miconlogin']))
		{
			if(isset($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && isset($this->session->userdata['miconlogin']['rightsid']) && isset($this->session->userdata['miconlogin']['status']) && ($this->session->userdata['miconlogin']['status'] == 1))
			{
				$loginstatus = true;
			}else{
				$loginstatus = false;
			}
		}else{
			$loginstatus = false;
		}
		return $loginstatus; 
	}
	
	public function getsub_category()
	{
		//echo $this->input->post('id');die;
		$this->abc['source_cat_id'] = $this->input->post('id');
		//echo $this->abc['source_cat_id'];die;
		$this->data['sub_catlists'] = $this->Doc_inward_model->get_subsource($this->abc);
		echo json_encode($this->data);
	}

	public function item_description()
	{
		if($this->input->post() && $this->input->post('master_item_id'))
		{
			$id = $this->input->post('master_item_id');
			$array = $this->Doc_inward_model->get_item_description($id);
			//$array = $this->booking_order_model->get_ajaxItmtotax($id);
			//$this->item_tax_content($array);
			echo json_encode($array);
		}else{
			$array = array();
			echo json_encode($array);
		}
		
	}

	public function get_customer_information()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$value = $this->input->get();
		if(isset($value['term']) && !empty($value['term']))
		{
			$this->Doc_inward_model->get_customer_information($value['term']);
		}
		
	}

	public function get_hc()
	{
		$id = $this->input->post('vendor');
		if(isset($id) && ($id != ''))
		{
			$value = $this->Doc_inward_model->get_hcs($id);
			echo json_encode($value);
		}
	}

	public function delete_Doc_inward_item($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$said = $this->uri->segment(3) ? $this->uri->segment(4) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$sa_id = $this->uri->segment(4) ? $this->encrypt_decrypt('decrypt', $said) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',2);
					$lid = $this->Doc_inward_model->delete_Doc_inward_item($idencr,$sa_id);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					// $pdfdata = $this->Doc_inward_model->get_pdfdata($autoid,'Doc_inward');
					// //echo '<pre>';print_r($pdfdata);die;
					// $html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
					// //$html=$this->data['result_view'];
					// $header='';
					// $footer='';
					// $pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$autoid).'.pdf';
					// $data['page_title'] = 'Hello world';
					// ini_set('memory_limit','32M');
					// $this->load->library('pdf');
					// $pdf = $this->pdf->load();
					// $pdf->SetAutoPageBreak(TRUE, 15);
					// $pdf->WriteHTML($html); // write the HTML into the PDF
					// $pdf->Output($pdfFilePath, 'F');
					//***********PDF File Code End********************
						if ($lid == true) {
						$this->session->set_flashdata('success', 'Doc_inward inquiry deleted successfully.');
						redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'You can not delete this item not enough stock.');
							redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Doc_inward inquiry not Available!!');
					redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(4)), 'refresh'); 
		}
	}

	public function status_act($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Doc_inward_model->status_act($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('inq-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('inq-followup', 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('inq-followup', 'refresh'); 
			}
			redirect('inq-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('inq-followup', 'refresh'); 
		}
	}

	public function status_deact($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Doc_inward_model->status_deact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('inq-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('inq-followup', 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('inq-followup', 'refresh'); 
			}
			redirect('inq-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('inq-followup', 'refresh'); 
		}
	}

	public function delete_fup($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Doc_inward inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Doc_inward_model->delete_fup($idencr);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					$pdfdata = $this->Doc_inward_model->get_pdfdata($autoid,'Doc_inward');
					//echo '<pre>';print_r($pdfdata);die;
					$html = $this->load->view('Doc_inward/Doc_inward_pdf_view',$pdfdata,TRUE);
					//$html=$this->data['result_view'];
					$header='';
					$footer='';
					$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$autoid).'.pdf';
					$data['page_title'] = 'Hello world';
					ini_set('memory_limit','32M');
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetAutoPageBreak(TRUE, 15);
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					//***********PDF File Code End********************
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Doc_inward/other_details/'.$this->uri->segment(4)), 'refresh'); 
		}
	}

	public function delete_fup_sec($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Doc_inward_model->delete_fup($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('inq-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('inq-followup', 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('inq-followup', 'refresh'); 
			}
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('inq-followup', 'refresh'); 
		}
	}

	public function get_item_details()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$value = $this->input->get();
		if(isset($value['term']) && !empty($value['term']))
		{
			$this->Doc_inward_model->get_item_details($value['term']);
		}
	}

	public function create_quote()
	{
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$lid = $this->Doc_inward_model->create_qoute($id);
		$qlid = $this->encrypt_decrypt('encrypt', $lid);
		//redirect(base_url().'Sale_quotation/quatation_tab/'.$qlid);
		$this->load->model('Sale_quotation_model');
		$pdfdata = $this->Sale_quotation_model->get_pdfdata($lid,'sale_quotation');
		//echo '<pre>';print_r($pdfdata);die;
		$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
		//$html=$this->data['result_view'];
		$header='';
		$footer='';
		$pdfFilePath = FCPATH.'/pdf/quot/quote'.$qlid.'.pdf';
		$data['page_title'] = 'Hello world';
		ini_set('memory_limit','325445M');
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		//$pdf->SetFooter($footer);
		//$pdf->SetHTMLHeader($header);
		//$pdf->SetMargins(15, 15, 15);
		//$pdf->SetHeaderMargin(15);
		//$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output($pdfFilePath, 'F');
		redirect(base_url().'Sale_quotation/quatation_tab/'.$qlid);
		
	}

	public function change_fstatus_toact($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access this functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',3);
					$lid = $this->Doc_inward_model->status_act($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status Changed successfully.');
						redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status  not Changed successfully!!.');
							redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function change_fstatus_todeact($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access this functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',3);
					$lid = $this->Doc_inward_model->status_deact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status Changed successfully.');
						redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status  not Changed successfully!!.');
							redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Doc_inward/other_details/'.$this->uri->segment(4), 'refresh'); 
		}
	}
	function do_upload_image($folder_name,$file_type,$width,$height)
	{
	
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < 10; $i++) 
			{
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
		$image_name = $randomString;
		$config['upload_path'] = 'uploads/'.$folder_name.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $image_name;
		$config['overwrite'] = TRUE;
		$config['max_size']	= '0';
		$config['width'] = 200;
        $config['height'] = 62;
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($file_type))
		{
			$error = array('error' => $this->upload->display_errors());
			//$this->form_validation->set_rules('userfile', 'Document', 'required');
			echo $error['error'];
		}
		else
		{
			$data['upload']  = array('upload_data' => $this->upload->data());
			$filename = $data['upload']['upload_data']['file_name'];
			//$this->imageResize($filename,$wid = 244,$hei = 210,$file_folder = '244x210/');
			//$this->imageResize($filename,$wid = 205,$hei = 205,$file_folder = '220x220/');
			//$this->imageResize($filename,$wid = 95,$hei = 95,$file_folder = '95x95/');
			$config = '';
			//$fname = $config['upload_path'].$filename;
			$this->image_upload($filename,$wid = $width,$hei = $height,$file_folder = $width.'x'.$height,$upload_path = 'uploads/'.$folder_name.'/');
			//$this->image_upload($filename,$wid = 295,$hei = 295,$file_folder = '295x295' ,$upload_path = 'uploads/'.$folder_name.'/');
			return $data['upload'];
		}
	}
	public function image_upload($filename,$wid,$hei,$file_folder,$upload_path)
	{
			if (!is_dir('uploads') || !is_writable('uploads')):
			else:
			$image = new Zebra_Image();
			$image->source_path = $upload_path.$filename;
				$ext = substr($image->source_path, strrpos($image->source_path, '.') + 1);
				$image->target_path = $upload_path.$file_folder.'/'.$filename;
				if (!$image->resize($wid, $hei, ZEBRA_IMAGE_BOXED, -1)) ;
			endif;
	}

	public function store_excel()
	{

ini_set('memory_limit','3222222222222222222222222222222222222222M');

		$this->load->helper('download');



		$this->load->library('excel');



		$this->excel->setActiveSheetIndex(0);



        //name the worksheet



        $this->excel->getActiveSheet()->setTitle('MiconFile');



        $finalar = $this->Doc_inward_model->get_excel_certificate();
        //echo "<pre>"; print_r($finalar); die;
        //echo $this->db->last_query(); die;
        $fhead = array('Sr. No','Inq. Date','Comapany name','client name','contact no','email id','city','Part no','qty','product price','grand total','inq status','source','remark');
        $i=0;
 		foreach ($finalar as $fkey => $fvalue) { $i++;
 			if($finalar[$fkey]['sq_id'])
 			{
 				$finalar[$fkey]['sq_id'] = $i;
 			}
 			
 			if($finalar[$fkey]['sq_end_st'] == 1)
 			{
 				$finalar[$fkey]['sq_end_st'] = 'Active';
 			}else if($finalar[$fkey]['sq_end_st'] == 2){
 				$finalar[$fkey]['sq_end_st'] = 'Pending';
 			}else if($finalar[$fkey]['sq_end_st'] == 3){
 				$finalar[$fkey]['sq_end_st'] = 'Completed';
 			}else{
 				$finalar[$fkey]['sq_end_st'] = '';
 			}
		

 			//echo '<pre>';print_r(explode('-',$fvalue['vf_img_allot_dt']));die;
 			// $datechange = explode('-',$fvalue['sa_enq_date']);

 			// if(isset($datechange[0]))
 			// {
 			// 	$date = str_replace('20','',$datechange[0]);
 			// }else{
 			// 	$data = '00';
 			// }
 			// if(isset($datechange[2]))
 			// {
 			// 	$year = '20'.$datechange[2].'';
 			// }else{
 			// 	$year = '0000';
 			// }
 			// if(!isset($datechange[1]))
 			// {
 			// 	$datechange[1] = '00';
 			// }
 			// $finalar[$fkey]['sa_enq_date'] = $newDate = date("d-m-Y", strtotime($year.'-'.$datechange[1].'-'.$date));
 			// $cdatechange = explode('-',$fvalue['sa_udate']);
 			// if(isset($datechange[0]))
 			// {
 			// 	$cdate = str_replace('20','',$cdatechange[0]);
 			// }else{
 			// 	$cdate = '00';
 			// }
 			// if(isset($cdatechange[2]))
 			// {
 			// 	$cyear = '20'.$cdatechange[2].'';
 			// }else{
 			// 	$cyear = '0000';
 			// }
 			// if(!isset($cdatechange[1]))
 			// {
 			// 	$cdatechange[1] = '00';
 			// }
 			// $finalar[$fkey]['sa_udate'] = $newDate = date("d-m-Y", strtotime($cyear.'-'.$cdatechange[1].'-'.$cdate));
 		} 

 		$datas = array_unshift($finalar, $fhead);

//echo '<pre>';print_r($finalar);die;

 		$this->excel->getActiveSheet()->fromArray($finalar);

        $filename='micon.xls'; //save our workbook as this file name

 		ob_end_clean();

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)



        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 


        //force user to download the Excel file without writing it to server's HD



        $objWriter->save('php://output');

	}

	public function get_country_to_state()
	{
		$countyid = $this->input->post('countryID') ? $this->input->post('countryID') : 0;
		if(isset($countyid) && $countyid != 0)
		{
			$statelists = $this->Doc_inward_model->get_country_to_state($countyid);
		}else{
			$statelists = array();
		}
		echo json_encode($statelists);die;
	}//

	public function get_state_to_city()
	{
		$stateID = $this->input->post('stateID') ? $this->input->post('stateID') : 0;
		if(isset($stateID) && $stateID != 0)
		{
			$citylists = $this->Doc_inward_model->get_state_to_city($stateID);
		}else{
			$citylists = array();
		}
		echo json_encode($citylists);die;
	}



}?>