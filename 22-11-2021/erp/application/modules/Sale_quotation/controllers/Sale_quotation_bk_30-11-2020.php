<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale_quotation extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('sale_quotation_model');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->helper('text');
		$this->load->library('email');
		$this->load->library('image_lib');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sale_quotation VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Sale_quotation_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->sale_quotation_model->get_sale_quotation();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['sa_id']);
		//$this->encrypt->encode($user[$i]['sa_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Sale_quotation/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Sale_quotation/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a href="'.base_url().'pdf/quot/quot'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-search"></i> View PDF</a>';
		}

		if($user[$i]['sa_priority'] == 1)
			{
	         	 $sst = '<span>High</span>';
			}else if($user[$i]['sa_priority'] == 2)
				{
					 $sst = '<span>Low</span>';
				}
				else if($user[$i]['sa_priority'] == 3)
				{
					 $sst = '<span>Medium</span>';
				}else{
					 $sst = '';
				}
		if($user[$i]['sa_inq_st'] == 1) 	 
		{
			 $sstt = '<span>Active</span>';
		}else if($user[$i]['sa_inq_st'] == 2)
			{
				 $sstt = '<span>Pending</span>';
			}
			else if($user[$i]['sa_inq_st'] == 3)
			{
				 $sstt = '<span>Completed</span>';
			}else{
				$sstt = '';
			}
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['sa_id'].'">',
			  $id,
				''.$user[$i]['sa_no'],
				''.$user[$i]['vendor'],
				//''.date("d-m-Y", strtotime($user[$i]['sa_enq_date'])),
			//''.$user[$i]['mode_inquiry_name'],
			''.$sstt,
			''.$sst,
			''.$user[$i]['sa_remarks'],
			''.$user[$i]['sa_mobile'],
				''.date("d-m-Y", strtotime($user[$i]['sa_enq_date'])),
				''.$user[$i]['sa_referred_by'],
				 ''.date("d-m-Y", strtotime($user[$i]['sa_udate'])),
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

	public function sales_qoute_report()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_enq VIew functionality");
			redirect(base_url());
		}
		$this->data['status'] = $this->sale_quotation_model->get_status();
		$this->data['admins'] = $this->sale_quotation_model->get_admin();
		//$this->data['sources'] = $this->sale_quotation_model->get_sourcecat();
		//$this->data['subsources'] = $this->sale_quotation_model->get_sourcesub_category();
		//$this->data['brands'] = $this->sale_quotation_model->get_salesbrand();
		//$this->data['vendors'] = $this->sale_quotation_model->get_masterparty();
		//$this->data['sales_enq'] = $this->sale_quotation_model->get_sale_quotation();
		// $this->data['countries'] = $this->sale_quotation_model->get_country();
		// $this->data['states'] = $this->sale_quotation_model->get_state();
		// $this->data['cities'] = $this->sale_quotation_model->get_city();
		$this->data['main_content'] = 'Sales_enq_report';
		$this->load->view('includes/template',$this->data);
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
		$this->data['total'] = $this->sale_quotation_model->count();
		$this->data['listfolloup'] = $this->sale_quotation_model->get_listofollow();
		$this->data['main_content'] = 'Followup_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax_followup()
	{
		$user = $this->sale_quotation_model->get_followup();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['id']);
		$fuidenc = $this->encrypt_decrypt('encrypt',$user[$i]['fuid']);
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Sale_quotation/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Sale_quotation/delete_fup_sec/'.$fuidenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}

			$actstr = '';
		if($user[$i]['folst'] == 6){
			$actstr = '<a href="'.base_url().'Sale_quotation/status_act/'.$fuidenc.'"onclick="return confirm('."'Are you sure you want to Active this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Active</a>';
		}
		if($user[$i]['folst'] == 5){
		$actstr = '<a href="'.base_url().'Sale_quotation/status_deact/'.$fuidenc.'"onclick="return confirm('."'Are you sure you want to Deactive this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Deactivate</a>';
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
	
	public function ajax_salesqoute_report()
	{
		$user = $this->sale_quotation_model->sales_qoute_report();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['sa_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Sale_quotation/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}

		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$oastr = '';
		}else{
			$oastr = '<a title=" Create OA" href="'.base_url().'Sale_quotation/create_oa/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create OA?'".')" class="btn btn-sm btn-outline green"><i class="fa fa-plus-circle"></i></a>';
		}

		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a title="Delete" href="'.base_url().'Sale_quotation/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}

		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$send_sms = '';
		}else{
			$send_sms = '<a title="Send sms" href="'.base_url().'Sale_quotation/send_sms/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Send SMS?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-envelope-square"></i></a>';
		}

		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'Sale_quotation/load_pdf/'.$idenc.'" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}

		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$emailsend = '';
		}else{
			
			$emailsend = '<a title="Email Send" href="'.base_url().'Sale_quotation/mail/'.$idenc.'" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-envelope-square"></i></a>';
		}
		
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$quotestr = '';
		}else{
			if($user[$i]['sa_wo_completed'] == 0)
			{
					$quotestr = '<a title="Create WOrk Order" href="'.base_url().'Sale_quotation/create_work_order/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create Work Order?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i> WO</a>';
			}
			else{
				$quotestr = '';
			}
			
		}
		$coupy_str = '<a class="btn btn-sm btn-outline green" href="'.base_url().'Sale_quotation/copy_quot/'.$idenc.'" onclick="return confirm('."'Are you sure you want to Copy this record?'".')"><i class="fa fa-plus"></i></a>';

		if($user[$i]['sa_priority'] == 1)
			{
	         	 $sst = '<span class="label label-success">High</span>';
			}else if($user[$i]['sa_priority'] == 2)
				{
					 $sst = '<span class="label label-warning">Low</span>';
				}
				else if($user[$i]['sa_priority'] == 3)
				{
					 $sst = '<span class="label label-primary">Medium</span>';
				}else{
				$sst = '<span></span>';
			}
		if($user[$i]['sa_inq_st'] == 1)
		{
			 $sstt = '<span class="label label-primary">Active</span>';
		}else if($user[$i]['sa_inq_st'] == 2)
			{
				 $sstt = '<span class="label label-warning">Pending</span>';
			}
			else if($user[$i]['sa_inq_st'] == 3)
			{
				 $sstt = '<span class="label label-success">Completed</span>';
			}else{
				$sstt = '<span></span>';
			}
		$records["data"][] = array(
			   //'<input type="checkbox" name="id[]" value="'.$user[$i]['sa_id'].'">',
			  // $id,
				''.$user[$i]['sa_no'],
				''.date("d-m-Y", strtotime($user[$i]['sa_enq_date'])),
				''.$user[$i]['vendor'],
				''.$user[$i]['sa_con_person'],
				''.$user[$i]['sa_mobile'],
				''.$user[$i]['state_name'],
				''.$user[$i]['city_name'],
				''.$user[$i]['sa_grd_ttl'],
				''.$user[$i]['au_fname'],
				// ''.$user[$i]['sai_itm'],
				// ''.$user[$i]['sai_itm_qty'],
				// ''.$user[$i]['sai_itm_price'],
				''.$user[$i]['qs_name'],
				''.$sst,
				''.$user[$i]['sa_remarks'],
				//''.date("d-m-Y", strtotime($user[$i]['sq_enq_date'])),
				//''.$user[$i]['mode_inquiry_name'],	
				//''.$user[$i]['mode_inquiry_name'],
				//''.$user[$i]['sa_grd_ttl'],
				// ''.$user[$i]['country_name'],
				// ''.$user[$i]['sa_referred_by'],
				//  ''.date("d-m-Y", strtotime($user[$i]['sa_udate'])),
			  ''.$editstr.''.$oastr.''.$deletestr.''.$viewpdfstr.''.$coupy_str.''.$emailsend.''.''.$quotestr.''.''.$send_sms.'',
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
	public function send_sms($id)
	{
	    //die;
		$lid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $id) : '';
		$pdfdata = $this->sale_quotation_model->get_pdfdata($lid);
		$msg = "We AAVAD Instrument send you email quotation no.".$pdfdata['inv']['sa_no']." on your registered I'd as per y'r inquiry. Awaiting for y'r valuable purchase order ASAP. Pl.call 9727722823";
		$msg = str_replace(' ', '%20', $msg);
		$url = "http://ui.netsms.co.in/API/SendSMS.aspx?APIkey=pHzTOovNIyyqMUpoatJowtUyhI&SenderID=AAAVAD&SMSType=1&Mobile=".$pdfdata['inv']['sa_mobile']."&MsgText=".$msg."";
		//$url = "http://ui.netsms.co.in/API/SendSMS.aspx?APIkey=pHzTOovNIyyqMUpoatJowtUyhI&SenderID=AAAVAD&SMSType=1&Mobile=".$pdfdata['inv']['sa_mobile']."&MsgText=hiii";
		//echo '<pre>';print_r($url);die;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		curl_close($ch);
		//echo '<pre>';print_r($curl_scraped_page);die;
		$this->session->set_flashdata('success', 'sms successfully.');
		redirect(base_url('Sale_quotation/sales_qoute_report'), 'refresh');
	}
	public function copy_quot($id = FALSE)
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
		$status = $this->sale_quotation_model->copy_quot($idencr);
		if(isset($status) && isset($status['status']) && $status['status'] == TRUE)
		{
			$this->session->set_flashdata('success', 'copy successfully.');
			//redirect(base_url()."Sale_quotation/edit/".$this->encrypt_decrypt('encrypt', $status['id']));
			redirect(base_url('Sale_quotation/quatation_tab'."/".$this->encrypt_decrypt('encrypt',$status['id'])), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'SOmething went wrong.');
		}
	}

	
	public function add()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sale_quotation Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post());die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['sa_cdate'] = date('Y-m-d H:i:s');
				$value['sa_udate'] = date('Y-m-d H:i:s');
				
				$lid = $this->sale_quotation_model->add($value);

				//***********PDF File Code Start********************
				/* $pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F'); */
				//***********PDF File Code End ********************		
				if($lid)
				{
					$this->session->set_userdata('qtabno',1);
					$this->session->set_flashdata('success', 'Sale_quotation added successfully.');
					redirect(base_url('Sale_quotation/quatation_tab'."/".$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Sale_quotation not added successfully!!');
					redirect(base_url('Sale_quotation/add'), 'refresh');
				}
			 	redirect(base_url('Sale_quotation'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function send_mail()
	{
		require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sale_quotation Add functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post());die;

				$this->load_pdf(false);
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$lists = $this->sale_quotation_model->get($idencr);
				//echo '<pre>';print_r($lists);die;
				$success = $this->validation();
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				//$value = $this->security->xss_clean($value);
				$value['sa_cdate'] = date('Y-m-d H:i:s');
				$value['sa_udate'] = date('Y-m-d H:i:s');
				//$this->session->set_userdata('qtabno',1);
				$enid =$this->uri->segment(3) ? $this->uri->segment(3) : '';
				// if(isset($_FILES['sqm_attch']['name']) && ($_FILES['sqm_attch']['name'] != '')){
				// 	$folder_name = "qoute_mail";
				// 	$file_type = "sqm_attch";
				// 	$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
				// 	$value['sqm_attch'] = $image['upload_data']['file_name'];
				// 	}
				$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
				;
				$mailerdata = $this->sale_quotation_model->get_mailer_detail($uid);
				$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
				//echo "<pre>";print_r($path);die;
				//$this->email->clear();
				$config = array();
				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = $mailerdata['au_gmail_email'];
				$config['smtp_pass']    = $mailerdata['au_gmail_password'];
					$config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $config['newline'] = "\r\n";
				//$config['wordwrap'] = TRUE;
				$config['validation'] = TRUE; // bool whether to validate email or not
				$imagenames = $this->multiple_image_upload();
				$value['files'] = $imagenames;
				$message = '';
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				//$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
               //$this->email->set_header('Content-type', 'text/html');
				$value['sqm_from'] = $mailerdata['au_gmail_email'];
				$this->email->from($mailerdata['au_gmail_email']); // change it to yours
				$this->email->to($value['sqm_to']);// change it to yours
				if(isset($value['sqm_to_cc']) && ($value['sqm_to_cc'] != ''))
				{
					$this->email->cc($value['sqm_to_cc'].''. $mailerdata['au_pre_cc']);// change it to yours
				}
				$this->email->subject($value['sqm_sub']);
				$this->email->message($value['sqm_body']);
				foreach($imagenames as $imagename)
				{	
					$this->email->attach($path."uploads/qoute_mail/".$imagename);
				}
				// $this->email->attach($path."pdf/quot/quote".$this->uri->segment(3).".pdf", 'attachment', 'Quatation-'.url_title(convert_accented_characters($lists[0]['vendor']), 'dash', TRUE).''.date("d-m-Y H:i:s").'.pdf');

				

				$str = $lists[0]['sa_id'].'-'.substr($lists[0]['au_fname'], 0, 1).substr($lists[0]['au_lname'], 0, 1).'-'.$lists[0]['vendor'];
				//echo "<pre>";print_r($str);die;
				$this->email->attach($path."pdf/quot/quote".$this->uri->segment(3).".pdf", 'attachment',''.$str.'.pdf');
				$this->email->set_mailtype("html");
				      //$this->email->attach($attach);
				      if($this->email->send())
				     {
				      echo 'Email sent.';
				      echo '<script>alert("Email sent.");window.location="'.base_url().'Sale_quotation/quatation_tab/'.$enid.'";</script>';
                    exit();
				     }
				     else
				    {
				     show_error($this->email->print_debugger());
				    }
				    $lid = $this->sale_quotation_model->send_mail($value);
					if($lid)
					{
						$files = glob(FCPATH.'uploads/qoute_mail/*'); //get all file names
						foreach($files as $file)
						{
						    if(is_file($file))
						    unlink($file); //delete file
						}
						//echo "$lid";die();
						$this->session->set_flashdata('success', 'Mail sent successfully.');
						redirect(base_url('Sale_quotation/quatation_tab/'.$enid), 'refresh');
					}else
					{
						$files = glob(FCPATH.'uploads/qoute_mail/*'); //get all file names
						foreach($files as $file)
						{
						    if(is_file($file))
						    unlink($file); //delete file
						}
						$this->session->set_flashdata('error', 'Mail not sent successfully!!');
						//redirect(base_url('Sale_quotation/add'), 'refresh');
						redirect(base_url('Sale_quotation/quatation_tab/'.$enid), 'refresh');
					}
				 	//redirect(base_url('Sale_quotation'), 'refresh');
				 	redirect(base_url('Sale_quotation/quatation_tab/'.$enid), 'refresh');
			}
		else
		{
			$this->mail();
		}
	}

	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sale_quotation Edit functionality");
			redirect(base_url());
		}
		//require 'Zebra_Image.php';
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$success = $this->validation();
			
			if($success == TRUE)
			{
				if($this->input->post(NULL,FALSE))
				{
					//echo "<pre>"; print_r($this->input->post()); die;
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['sa_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->sale_quotation_model->edit($value,$idencr);

					//***********PDF File Code Start********************
						/* $pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
						//echo '<pre>';print_r($pdfdata);die;
						$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
						//$html=$this->data['result_view'];
						$header='';
						$footer='';
						$pdfFilePath = FCPATH.'/pdf/quot/quot'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
						$data['page_title'] = 'Hello world';
						ini_set('memory_limit','32222222222222222222222222M');
						$this->load->library('pdf');
						$pdf = $this->pdf->load();
						$pdf->SetAutoPageBreak(TRUE, 15);
						$pdf->WriteHTML($html); // write the HTML into the PDF
						$pdf->Output($pdfFilePath, 'F'); */
						//die;
				//***********PDF File Code End ********************	
					if($lid)
					{
						$this->session->set_flashdata('success', 'Sales Quotation edited successfully.');
						redirect(base_url('Sale_quotation'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Sales Quotationnot edited successfully!!');
					}
				 	redirect(base_url('Sale_quotation'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->sale_quotation_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['countries'] = $this->sale_quotation_model->get_country();
						$this->data['states'] = $this->sale_quotation_model->get_state();
						$this->data['cities'] = $this->sale_quotation_model->get_city();
						$this->data['brands'] = $this->sale_quotation_model->get_salesbrand();
						$this->data['vendors'] = $this->sale_quotation_model->get_masterparty();
						$this->data['modeinquries'] = $this->sale_quotation_model->get_modeinquiry();
						$this->data['sources'] = $this->sale_quotation_model->get_sourcecat();
						$this->data['subsources'] = $this->sale_quotation_model->get_sourcesub_category();
						$this->data['action'] = "Sale_quotation/edit/".$enid;
						$this->data['main_content'] = 'Sale_quotation_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/Sale_quotation/Sale_quotation_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
						 redirect(base_url('Sale_quotation'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
					redirect(base_url('Sale_quotation'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Sale_quotation'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');  
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
		//$this->data['getSale_quotation'] = $this->sale_quotation_model->addtSale_quotation();
		$this->data['countries'] = $this->sale_quotation_model->get_country();
		$this->data['sa_code'] = $this->sale_quotation_model->sa_no_get();
		$this->data['states'] = array();//$this->sale_quotation_model->get_state();
		$this->data['cities'] = array();//$this->sale_quotation_model->get_city();
		$this->data['brands'] = $this->sale_quotation_model->get_salesbrand();
		$this->data['vendors'] = $this->sale_quotation_model->get_masterparty();
		$this->data['modeinquries'] = $this->sale_quotation_model->get_modeinquiry();
		$this->data['sources'] = $this->sale_quotation_model->get_sourcecat();
		$this->data['follow_exe'] = $this->sale_quotation_model->get_follow_exe();
		$this->data['subsources'] = $this->sale_quotation_model->get_sourcesub_category();
		$this->data['status'] = $this->sale_quotation_model->get_status();
		$this->data['main_content'] = 'Sale_quotation_form_view';
		$this->data['action'] = "Sale_quotation/add";
		$this->load->view('includes/template',$this->data);
	}
	public function quatation_tab()
	{
		$this->session->set_userdata('qtabno',1);
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['getSale_quotation'] = $this->sale_quotation_model->addtSale_quotation();
		$this->data['custometyps'] = $this->sale_quotation_model->get_customertype();
		$this->data['list'] = $this->sale_quotation_model->get($idencr);
		$this->data['items'] = $this->sale_quotation_model->get_items($idencr);
		//echo "<pre>"; print_r($this->data['list']); die;
		if($this->input->get('acttype') && $this->input->get('itemid') && ($this->input->get('acttype') == 'edit'))
		{
			$this->session->set_userdata('qtabno',2);
			$eitemid = $this->input->get('itemid');
			$this->data['edit_items'] = $this->sale_quotation_model->get_edit_inqitems($idencr,$eitemid);
			//echo '<pre>';print_r($this->data['edit_items']);die;
			$this->data['action_item'] = "Sale_quotation/item_edit/".$this->uri->segment(3).'?acttype=edit&itemid='.$eitemid;
		}else{
			$this->data['action_item'] = "Sale_quotation/item_details/".$this->uri->segment(3);
		}
		$this->data['folups'] = $this->sale_quotation_model->get_folup_details($idencr);
		$this->data['countries'] = $this->sale_quotation_model->get_country();
		$this->data['sa_code'] = $this->sale_quotation_model->sa_no_get();
		$this->data['states'] = $this->sale_quotation_model->get_state($this->data['list'][0]['sa_country']);
		$this->data['cities'] = $this->sale_quotation_model->get_city($this->data['list'][0]['sa_state']);
		$this->data['brands'] = $this->sale_quotation_model->get_salesbrand();
		$this->data['follow_status'] = $this->sale_quotation_model->get_follow_status();
		$this->data['follow_method'] = $this->sale_quotation_model->get_follow_method();
		$this->data['follow_exe'] = $this->sale_quotation_model->get_follow_exe();
		$this->data['vendors'] = $this->sale_quotation_model->get_masterparty();
		$this->data['modeinquries'] = $this->sale_quotation_model->get_modeinquiry();
		$this->data['sources'] = $this->sale_quotation_model->get_sourcecat();
		$this->data['all_hsns'] = $this->sale_quotation_model->get_all_hsns();
		$this->data['subsources'] = $this->sale_quotation_model->get_sourcesub_category();
		$this->data['status'] = $this->sale_quotation_model->get_status();
		$this->data['main_content'] = 'Quotation_form_view';
		$this->data['action_bd'] = "Sale_quotation/basic_details/".$this->uri->segment(3);
		//$this->data['action_item'] = "Sale_quotation/item_details/".$this->uri->segment(3);
		$this->data['action_other'] = "Sale_quotation/other_details/".$this->uri->segment(3);
		$this->data['action_follow'] = "Sale_quotation/follow_details/".$this->uri->segment(3);
		$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$this->data['item_data'] = $this->sale_quotation_model->get_item_data($enid);
		$this->load->view('includes/template',$this->data);
	}
	public function item_edit()
	{
		ini_set('memory_limit', '-1');
			require 'Zebra_Image.php';
			$right_status = $this->check_rights('edit');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_qua Edit functionality");
				redirect(base_url());
			}
			//echo "<pre>"; print_r($_FILES); die;
			
		
			if($_FILES && $this->input->get('acttype') && ($this->input->get('acttype') == 'edit') && $this->input->get('itemid'))
			{	
				//echo "<pre>"; print_r($this->input->post()); die;
			//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				//$value = $this->security->xss_clean($value);
				$value['sa_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',2);
					if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->sale_quotation_model->item_img($value);
					//if(count($result) > 0)
					//{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					//}
				}
				$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
				$lid = $this->sale_quotation_model->item_edit($value,$sqiitemid);
				//echo '<pre>';print_r($lid);die;
				//***********PDF File Code Start********************
				/* $pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F'); */
				//***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Sale_quotation/quatation_tab'), 'refresh');
				}
			 	redirect(base_url('Sale_quotation'), 'refresh');
			}else{
			$this->quatation_tab();
		}
	}

	public function other_details()
	{
			//require 'Zebra_Image.php';
			$right_status = $this->check_rights('add');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_enq Add functionality");
				redirect(base_url());
			}

			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				//$value = $this->security->xss_clean($value);
				
				$value['sa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',4);
				$lid = $this->sale_quotation_model->other_add($value,$enid);
				//***********PDF File Code Start********************
				/* $pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F'); */
				//***********PDF File Code End ********************	
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Other Details added successfully.');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Other Details not added successfully!!');
					//redirect(base_url('Sale_quotation/add'), 'refresh');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Sale_quotation'), 'refresh');
			 	redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
	}

	public function basic_details()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_enq Add functionality");
			redirect(base_url());
		}

			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				
				$value['sa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',1);
				$lid = $this->sale_quotation_model->add($value,$enid);
				//***********PDF File Code Start********************
				/*$pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$footer='<div style="width:100%; z-index:1;"><img width="800" height="300" src="'.base_url().'assets/custom/images/aavad_footer.jpg" /></div>';
				$header='<div style="width:100%; position:absolute; top:0; z-index:1; border:1px solid #FFF;"><img src="'.base_url().'assets/custom/images/miconindia-header-new.jpg" /></div>';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->SetHeader($header);
				$pdf->SetFooter($footer);
				$pdf->setAutoBottomMargin = 'stretch';
				$pdf->AddPage('', // L - landscape, P - portrait 
				        '', '', '', '',
				        0, // margin_left
				        0, // margin right
				       30, // margin top
				       0, // margin bottom
				        0, // margin header
				        42); // margin footer
				$pdf->defaultheaderline = 0;
				$pdf->defaultfooterline = 0;
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F'); */
				//***********PDF File Code End ********************	
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Basic Details added successfully.');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Basic Details not added successfully!!');
					//redirect(base_url('Sale_quotation/add'), 'refresh');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Sale_quotation'), 'refresh');
			 	redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
	}

	public function item_details()
	{
		require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_enq Add functionality");
			redirect(base_url());
		}

			if($_FILES)
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				//$value = $this->security->xss_clean($value);
				$value['sa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',2);
				if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->sale_quotation_model->item_img($value);
					if(count($result) > 0)
					{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					}
				}
				$lid = $this->sale_quotation_model->item_add($value,$enid);
				//***********PDF File Code Start********************
				/* $pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F'); */
				//***********PDF File Code End********************
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Item Details added successfully.');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Item Details not added successfully!!');
					//redirect(base_url('Sale_quotation/add'), 'refresh');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Sale_quotation'), 'refresh');
			 	redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
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
					$lid = $this->sale_quotation_model->delete_fup($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('qoutation-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('qoutation-followup', 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('qoutation-followup', 'refresh'); 
			}
			redirect('qoutation-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('qoutation-followup', 'refresh'); 
		}
	}
	
	public function delete_items($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sale_quotation Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$itemid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo $itemid; die;
		if($itemid && ($itemid != ''))

		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $itemid) : '';

			if(isset($itemid) && $itemid!= '')
			{


					$lid = $this->sale_quotation_model->delete_select_item($itemid,$enid);
					
						if ($enid) 
						{
							//echo $enid; die;
						$this->session->set_flashdata('success', 'item deleted successfully.');

						redirect(base_url('Sale_quotation/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

						} else {

							$this->session->set_flashdata('error', 'item not deleted successfully!!.');

							redirect(base_url('Sale_quotation/add'), 'refresh'); 
						}						
			}
			else{

					$this->session->set_flashdata('error', 'item not Available!!');

					redirect(base_url('Sale_quotation/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

			}

			redirect(base_url('Sale_quotation/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

		}else{

			$this->session->set_flashdata('error', 'Something went wrong');

			redirect('Start_production', 'refresh'); 

		}

	}
	public function follow_details()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales_enq Add functionality");
			redirect(base_url());
		}

			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				
				$value['sa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',3);
				$lid = $this->sale_quotation_model->follow_add($value,$enid);
				//***********PDF File Code Start********************
				
				//***********PDF File Code End********************
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Followup Details added successfully.');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Followup Details not added successfully!!');
					redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
					//redirect(base_url('Sale_quotation/add'), 'refresh');
				}
			 	//redirect(base_url('Sale_quotation'), 'refresh');
			 	redirect(base_url('Sale_quotation/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales QuotationDelete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo "$enid";die;
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->sale_quotation_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->sale_quotation_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Sales Quotation deleted successfully.');
						redirect('Sale_quotation/sales_qoute_report', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Sales Quotation not deleted successfully!!.');
							redirect('Sale_quotation/sales_qoute_report', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
			  		redirect('Sale_quotation/sales_qoute_report', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
					redirect('Sale_quotation/sales_qoute_report', 'refresh'); 
			}
			redirect('Sale_quotation/sales_qoute_report', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Sale_quotation/sales_qoute_report'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sale_quotation Delete functionality");
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
						$this->data['list'] = $this->sale_quotation_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->sale_quotation_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Sales Quotationdeleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Sales Quotationnot deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Sale_quotation'), 'refresh');

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
				$this->data['action'] = "Sale_quotation/importcsv";
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
							if(isset($row['Sale_quotation']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['Sale_quotationCode'])))
							{
								$this->sale_quotation_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Sale_quotation'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Sale_quotation/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Sale_quotation/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Sale_quotation/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 26,$type);
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

	public function setbit_Sale_quotation()
	{
		$this->sale_quotation_model->setbit_Sale_quotation();
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
		$this->data['sub_catlists'] = $this->sale_quotation_model->get_subsource($this->abc);
		echo json_encode($this->data);
	}
	
	public function item_description()
	{
		$id = (int)$this->input->post('id');
		$array = $this->sales_enq_model->get_item_description($id);
		echo json_encode($array);
	}
	
	public function delete_folup($id=false)
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
				$this->session->set_userdata('qtabno',3);
					$lid = $this->sale_quotation_model->delete_fup($idencr);
					
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function delete_itms($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales inquiry Delete functionality");
			redirect(base_url());
		}
		$said = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$sa_id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $said) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',2);
					$lid = $this->sale_quotation_model->delete_itms($idencr,$sa_id);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
			}
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function create_work_order()
	{
	    //die;
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$lid = $this->sale_quotation_model->create_work_order($id);
		$qlid = $this->encrypt_decrypt('encrypt', $lid);
		//redirect(base_url().'Sale_quotation/quatation_tab/'.$qlid);
		$this->session->set_userdata('tabno',1);
		//***********PDF File Code Start********************
		$pdfdata = $this->sale_quotation_model->get_work_orderpdfdata($lid,'Work_order');
		//echo '<pre>';print_r($pdfdata);die;
		$html = $this->load->view('Work_order/Work_order_pdf_view',$pdfdata,TRUE);
		//$html=$this->data['result_view'];
		$header='';
		$footer='';
		$pdfFilePath = FCPATH.'/pdf/wo/wo'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
		$data['page_title'] = 'Hello world';
		ini_set('memory_limit','32222222222222222222222222M');
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output($pdfFilePath, 'F');
		//***********PDF File Code End********************
		//echo $lid; die;
		if($lid)
		{
			//die;
			$this->session->set_userdata('tabno',1);
			$this->session->set_flashdata('success', 'Work_order added successfully.');
			redirect(base_url('Work_order/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Work_order not added successfully!!');
			redirect(base_url('Work_order/add'), 'refresh');
		}
	 	redirect(base_url('Work_order'), 'refresh');
	}

	public function create_oa()
	{
		
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//echo "<pre>"; print_r($id); die;
		//$id = $this->input->get('id');
		$lid = $this->sale_quotation_model->create_oa($id);
		//echo "hii";die;
		$encid = $this->encrypt_decrypt('encrypt', $lid);

		$this->load->model('Oa_model');

		//***********PDF File Code Start********************
		$pdfdata = $this->Oa_model->get_pdfdata($lid,'Oa');
		//echo '<pre>';print_r($pdfdata);die;
		$html = $this->load->view('Oa/Oa_pdf_view',$pdfdata,TRUE);
		//$html=$this->data['result_view'];
		$header='';
		$footer='';
		$pdfFilePath = FCPATH.'/pdf/oa/oa'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
		$data['page_title'] = 'Hello world';
		ini_set('memory_limit','32222222222222222222222222M');
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output($pdfFilePath, 'F');
		//***********PDF File Code End ********************		
		redirect(base_url('Oa/quatation_tab/'.$encid), 'refresh');
	}

	public function mail()
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
		$this->data['lists'] = $this->sale_quotation_model->get($idencr);
		//$this->data['getSale_quotation'] = $this->sale_quotation_model->addtSale_quotation();
		$this->data['main_content'] = 'sale_qoutation_mail_view';
		$this->data['action_mail'] = "Sale_quotation/send_mail/".$this->uri->segment(3);
		$this->load->view('includes/template',$this->data);
	}

	public function store_excel()
	{

        ini_set('memory_limit','3222222222222222222222222222222222222222M');

		$this->load->helper('download');



		$this->load->library('excel');



		$this->excel->setActiveSheetIndex(0);



        //name the worksheet



        $this->excel->getActiveSheet()->setTitle('MiconFile');



        $finalar = $this->sale_quotation_model->get_excel_certificate();
        //echo "<pre>"; print_r($finalar); die;
        //echo $this->db->last_query(); die;
        $fhead = array('Sr. No','Qoute. Date','Comapany name','client name','contact no','email id','city','Item Name','Item Desc','qty','product price','grand total','inq status','source','remark');
        $i=0;
 		foreach ($finalar as $fkey => $fvalue) { $i++;
 			if($finalar[$fkey]['sa_id'])
 			{
 				$finalar[$fkey]['sa_id'] = $i;
 			}
 			
 			if($finalar[$fkey]['sa_inq_st'] == 1)
 			{
 				$finalar[$fkey]['sa_inq_st'] = 'Active';
 			}else if($finalar[$fkey]['sa_inq_st'] == 2){
 				$finalar[$fkey]['sa_inq_st'] = 'Pending';
 			}else if($finalar[$fkey]['sa_inq_st'] == 3){
 				$finalar[$fkey]['sa_inq_st'] = 'Completed';
 			}else{
 				$finalar[$fkey]['sa_inq_st'] = '';
 			}
		

 			
 		} 

 		$datas = array_unshift($finalar, $fhead);

//echo '<pre>';print_r($finalar);die;

 		$this->excel->getActiveSheet()->fromArray($finalar);

        $filename='micon.xls'; //save our workbook as this file name

 		if (ob_get_length()) ob_end_clean();

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache


        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 


        //force user to download the Excel file without writing it to server's HD



        $objWriter->save('php://output');

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
					$lid = $this->sale_quotation_model->change_fstatus_toact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup Detail Not Available!!');
					redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
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
					$lid = $this->sale_quotation_model->change_fstatus_todeact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Sale_quotation/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function status_act($id=false)
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
					$lid = $this->sale_quotation_model->change_fstatus_toact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('qoutation-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('qoutation-followup', 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('qoutation-followup', 'refresh'); 
			}
			redirect('qoutation-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('qoutation-followup', 'refresh'); 
		}
	}

	public function status_deact($id=false)
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
					$lid = $this->sale_quotation_model->change_fstatus_todeact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('qoutation-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('qoutation-followup', 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('qoutation-followup', 'refresh'); 
			}
			redirect('qoutation-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('qoutation-followup', 'refresh'); 
		}
	}

	public function load_pdf($id = FALSE)
	{
		ini_set('memory_limit', '-1');
		$files = glob(FCPATH.'pdf/quot/*.pdf'); //get all file names
		foreach($files as $file)
		{
		    if(is_file($file))
		    unlink($file); //delete file
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			    $lid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//***********PDF File Code Start********************
				$pdfdata = $this->sale_quotation_model->get_pdfdata($lid,'sale_quotation');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$footer='<div style="width:100%; z-index:1; background-color:#FFF; height:100%;"><img width="800" height="300" src="'.base_url().'assets/custom/images/aavad_footer.png" /></div>';
				$header='<div style="width:100%; position:absolute; top:0; z-index:1; background-color:#FFF;"><img src="'.base_url().'assets/custom/images/miconindia-header-new.jpg" /></div>';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->SetHeader($header);
				$pdf->SetFooter($footer);
				$pdf->setAutoBottomMargin = 'stretch';
				$pdf->AddPage('', // L - landscape, P - portrait 
				        '', '', '', '',
				        0, // margin_left
				        0, // margin right
				       25, // margin top
				       0, // margin bottom
				        0, // margin header
				        41); // margin footer
				$pdf->defaultheaderline = 0;
				$pdf->defaultfooterline = 0;
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
				if($id == false)
				{

				}else{
					redirect(base_url().'pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf');
				}
				
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
		$config['allowed_types'] = 'gif|jpg|png|pdf';
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

	public function multiple_image_upload()
	{
		$valid_formats = array("jpg","JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "bmp", "BMP","pdf");
		$max_file_size = 1024*100000000; //100 kb
		//echo $path = base_url()."/uploads/product_images/"; // Upload directory
		//echo $path = $_SERVER['DOCUMENT_ROOT'];exit;
		//$path = $_SERVER['DOCUMENT_ROOT']."/miconindia.com/uploads/product_images/";
		$path = 'uploads/qoute_mail/'; 
		$count = 0;
		 //echo "gsdgsg";  print_r($_FILES['files']['error']);die;
   		 $imagearray = array();
		 $imagearray = $_FILES['files']['name'];
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ //echo '<pre>'; print_r($_FILES['files']['name']); //die;
			// Loop $_FILES to exeicute all files
			foreach ($imagearray as $f => $name) {   
				 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomString = '';
				for ($i = 0; $i < 7; $i++) 
				{
					$randomString .= $characters[rand(0, strlen($characters) - 1)];
				}      
				if ($_FILES['files']['error'][$f] == 0) {	           
					if ($_FILES['files']['size'][$f] > $max_file_size) {
						$message[] = "$name is too large!.";
						continue; // Skip large files
					}
					elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
						$message[] = "$name is not a valid format";
						continue; // Skip invalid file formats
					}
					else{ // No error found! Move uploaded files 
						if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$randomString.$name))
						$imagearray[$f] = $randomString.$name;
						//$this->imageResize($imagearray[$f],$wid = 244,$hei = 210,$file_folder = '244x210/');
						//$this->imageResize($imagearray[$f],$wid = 220,$hei = 220,$file_folder = '220x220/');
						//$this->imageResize($imagearray[$f],$wid = 95,$hei = 95,$file_folder = '95x95/');
						//$this->imageResize($imagearray[$f],$wid = 112,$hei = 72,$file_folder = '112x72/');
						//$this->image_upload($imagearray[$f],$wid = 1200,$hei = 600,$file_folder = '1200x600/');
						$count++; // Number of successfully uploaded file
					}
				}
				if ($_FILES['files']['error'][$f] == 4) {
					//continue; // Skip file if any error found
					//$this->get_form();
					unset($imagearray);
					$imagearray = array();
					//$imagearray = array_map('nullify', $imagearray);
				}	
			}
		}
		return $imagearray;
	}



	
	
}?>