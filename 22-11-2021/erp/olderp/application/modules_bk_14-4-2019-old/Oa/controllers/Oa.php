<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oa extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('Oa_model');
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->helper('text');
	}

	public function send_mail()
	{
		require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Oa Add functionality");
			redirect(base_url());
		}
		
			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post());die;
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$lists = $this->Oa_model->get($idencr);
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
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
				$mailerdata = $this->Oa_model->get_mailer_detail($uid);
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
				//$attach = FCPATH.'/uploads/qoute_mail/'.$value['sqm_attch'];
				$imagenames = $this->multiple_image_upload();
				$value['files'] = $imagenames;
				$message = '';
				$this->load->library('email');
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$value['oam_from'] = $mailerdata['au_gmail_email'];
				$this->email->from($mailerdata['au_gmail_email']); // change it to yours
				$this->email->to($value['oam_to']);// change it to yours
				if(isset($value['oam_to_cc']) && ($value['oam_to_cc'] != ''))
				{
					$this->email->cc($value['oam_to_cc'].''.$mailerdata['au_pre_cc']);// change it to yours
				}
				$this->email->subject($value['oam_sub']);
				$this->email->message($value['oam_body']);
				foreach($imagenames as $imagename)
				{	
					$this->email->attach($path."uploads/oa_mail/".$imagename);
				}
				$this->email->attach($path."pdf/oa/oa".$this->uri->segment(3).".pdf", 'attachment', 'Oa-'.url_title(convert_accented_characters($lists[0]['vendor']), 'dash', TRUE).''.date("d-m-Y H:i:s").'.pdf');
				      //$this->email->attach($attach);
				      if($this->email->send())
				     {
				      echo 'Email sent.';
				     }
				     else
				    {
				     show_error($this->email->print_debugger());
				    }
				    $lid = $this->Oa_model->send_mail($value);
					if($lid)
					{
						//echo "$lid";die();
						$this->session->set_flashdata('success', 'Mail sent successfully.');
						redirect(base_url('Oa/quatation_tab/'.$enid), 'refresh');
					}else
					{
						$this->session->set_flashdata('error', 'Mail not sent successfully!!');
						//redirect(base_url('Sale_quotation/add'), 'refresh');
						redirect(base_url('Oa/quatation_tab/'.$enid), 'refresh');
					}
				 	//redirect(base_url('Sale_quotation'), 'refresh');
				 	redirect(base_url('Oa/quatation_tab/'.$enid), 'refresh');
			}
		else
		{
			$this->mail();
		}
	}

	public function mail()
	{
		//$this->data['getSale_quotation'] = $this->sale_quotation_model->addtSale_quotation();
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
		$this->data['lists'] = $this->Oa_model->get($idencr);
		$this->data['main_content'] = 'Oa_mail_view';
		$this->data['action_mail'] = "Oa/send_mail/".$this->uri->segment(3);
		$this->load->view('includes/template',$this->data);
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Oa VIew functionality");
			redirect(base_url());
		}
		$this->data['vendors'] = $this->Oa_model->get_masterparty();
		$this->data['main_content'] = 'Oa_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Oa_model->get_oa();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['oa_id']);
		//$this->encrypt->encode($user[$i]['oa_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Oa/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$oastr = '';
		}else{
			$oastr = '<a title=" Create PI" href="'.base_url().'Oa/oatopi/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create PI?'".')" class="btn btn-sm btn-outline green"><i class="fa fa-plus-circle"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a title="Delete" href="'.base_url().'Oa/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/oa/oa'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}
		if($right_status == false)
		{
			$emailsend = '';
		}else{
			
			$emailsend = '<a title="Email Send" href="'.base_url().'oa/mail/'.$idenc.'" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-envelope-square"></i></a>';
		}

		if($user[$i]['oa_priority'] == 1)
			{
	         	 $sst = '<span class="label label-success">High</span>';
			}else if($user[$i]['oa_priority'] == 2)
				{
					 $sst = '<span class="label label-success">Low</span>';
				}
				else if($user[$i]['oa_priority'] == 3)
				{
					 $sst = '<span class="label label-success">Medium</span>';
				}else{
					 $sst = '';
				}
		if($user[$i]['oa_inq_st'] == 1) 	 
		{
			 $sstt = '<span class="label label-success">Active</span>';
		}else if($user[$i]['oa_inq_st'] == 2)
			{
				 $sstt = '<span class="label label-success">Pending</span>';
			}
			else if($user[$i]['oa_inq_st'] == 3)
			{
				 $sstt = '<span class="label label-success">Completed</span>';
			}else{
				$sstt = '';
			}
		$records["data"][] = array(
			  //'<input type="checkbox" name="delid[]" value="'.$user[$i]['oai_id'].'">',
			  $id,
				''.$user[$i]['oa_no'],
				''.$user[$i]['vendor'],
				//''.$user[$i]['master_item_name'],
				//''.date("d-m-Y", strtotime($user[$i]['oa_enq_date'])),
			//''.$user[$i]['mode_inquiry_name'],
			''.$sstt,
			''.$sst,
			''.$user[$i]['oa_remarks'],
			''.$user[$i]['oa_mobile'],
			''.$user[$i]['oa_grd_ttl'],
				''.date("d-m-Y", strtotime($user[$i]['oa_enq_date'])),
				''.$user[$i]['oa_ref_by'],
				 ''.date("d-m-Y", strtotime($user[$i]['oa_udate'])),
			  ''.$editstr.''.$oastr.''.$deletestr.''.$viewpdfstr.''.''.$emailsend.'',
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
		$this->data['sales_enq'] = $this->Oa_model->get_Oa();
		$this->data['countries'] = $this->Oa_model->get_country();
		$this->data['states'] = $this->Oa_model->get_state();
		$this->data['cities'] = $this->Oa_model->get_city();
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
		$this->data['total'] = $this->Oa_model->count();
		$this->data['listfolloup'] = $this->Oa_model->get_listofollow();
		$this->data['main_content'] = 'Followup_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax_followup()
	{
		$user = $this->Oa_model->get_followup();
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
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Oa/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Oa/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}
		if(isset($user[$i]['followdate']) && $user[$i]['followdate'] != '')
		 {
		 	$user[$i]['followdate'] = date("d-m-Y", strtotime($user[$i]['followdate']));
		 }else{
		 	$user[$i]['followdate'] = '';
		 }
		 if(isset($user[$i]['stname']) && $user[$i]['stname'] == 1)
		 {
		 	$user[$i]['stname'] = 'Active';
		 }elseif(isset($user[$i]['stname']) && $user[$i]['stname'] == 2){
		 	$user[$i]['stname'] = 'Pending';
		 }elseif(isset($user[$i]['stname']) && $user[$i]['stname'] == 3){
		 	$user[$i]['stname'] = 'Completed';
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
			  ''.$editstr.''.$deletestr
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
		$user = $this->Oa_model->sales_qoute_report();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['oa_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Oa/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a title="Delete" href="'.base_url().'Oa/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/oa/oa'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eveys"></i></a>';
		}

		if($user[$i]['oa_priority'] == 1)
			{
	         	 $sst = '<span>High</span>';
			}else if($user[$i]['oa_priority'] == 2)
				{
					 $sst = '<span>Low</span>';
				}
				else if($user[$i]['oa_priority'] == 3)
				{
					 $sst = '<span>Medium</span>';
				}else{
				$sst = '<span></span>';
			}
		if($user[$i]['oa_inq_st'] == 1)
		{
			 $sstt = '<span>Active</span>';
		}else if($user[$i]['oa_inq_st'] == 2)
			{
				 $sstt = '<span>Pending</span>';
			}
			else if($user[$i]['oa_inq_st'] == 3)
			{
				 $sstt = '<span>Completed</span>';
			}else{
				$sstt = '<span></span>';
			}
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['oa_id'].'">',
			  $id,
				''.$user[$i]['oa_no'],
				''.$user[$i]['vendor'],
				//''.date("d-m-Y", strtotime($user[$i]['sq_enq_date'])),
				//''.$user[$i]['mode_inquiry_name'],	
				//''.$user[$i]['mode_inquiry_name'],
				''.$sstt,
				''.$sst,
				''.$user[$i]['oa_grd_ttl'],
				''.$user[$i]['oa_remarks'],
				''.$user[$i]['oa_mobile'],
				''.$user[$i]['country_name'],
				''.$user[$i]['state_name'],
				''.$user[$i]['city_name'],
				''.date("d-m-Y", strtotime($user[$i]['oa_enq_date'])),
				''.$user[$i]['oa_referred_by'],
				 ''.date("d-m-Y", strtotime($user[$i]['oa_udate'])),
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
	
	public function add()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Oa Add functionality");
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
				$value['oa_cdate'] = date('Y-m-d H:i:s');
				$value['oa_udate'] = date('Y-m-d H:i:s');
				//$this->session->set_userdata('qtabno',1);
				$lid = $this->Oa_model->add($value);

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
				if($lid)
				{
					$this->session->set_flashdata('success', 'Oa added successfully.');
					redirect(base_url('Oa/quatation_tab'."/".$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Oa not added successfully!!');
					redirect(base_url('Oa/add'), 'refresh');
				}
			 	redirect(base_url('Oa'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Oa Edit functionality");
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
					$value['oa_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->Oa_model->edit($value,$idencr);

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
						//die;
				//***********PDF File Code End ********************	
					if($lid)
					{
						$this->session->set_flashdata('success', 'Sales Quotation edited successfully.');
						redirect(base_url('Oa'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Sales Quotationnot edited successfully!!');
					}
				 	redirect(base_url('Oa'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Oa_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['countries'] = $this->Oa_model->get_country();
						$this->data['states'] = $this->Oa_model->get_state();
						$this->data['cities'] = $this->Oa_model->get_city();
						$this->data['brands'] = $this->Oa_model->get_salesbrand();
						$this->data['vendors'] = $this->Oa_model->get_masterparty();
						$this->data['modeinquries'] = $this->Oa_model->get_modeinquiry();
						$this->data['sources'] = $this->Oa_model->get_sourcecat();
						$this->data['subsources'] = $this->Oa_model->get_sourcesub_category();
						$this->data['action'] = "Oa/edit/".$enid;
						$this->data['main_content'] = 'Oa_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/Oa/Oa_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
						 redirect(base_url('Oa'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
					redirect(base_url('Oa'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Oa'), 'refresh'); 
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
		//$this->data['getOa'] = $this->Oa_model->addtOa();
		$this->data['follow_exe'] = $this->Oa_model->get_follow_exe();
		$this->data['countries'] = $this->Oa_model->get_country();
		$this->data['oa_code'] = $this->Oa_model->oa_no_get();
		$this->data['states'] = array();//$this->Oa_model->get_state();
		$this->data['cities'] = array();//$this->Oa_model->get_city();
		$this->data['brands'] = $this->Oa_model->get_salesbrand();
		$this->data['vendors'] = $this->Oa_model->get_masterparty();
		$this->data['modeinquries'] = $this->Oa_model->get_modeinquiry();
		$this->data['sources'] = $this->Oa_model->get_sourcecat();
		$this->data['subsources'] = $this->Oa_model->get_sourcesub_category();
		$this->data['main_content'] = 'Oa_form_view';
		$this->data['action'] = "Oa/add";
		$this->load->view('includes/template',$this->data);
	}
	public function quatation_tab()
	{
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['getSale_quotation'] = $this->Oa_model->addtSale_quotation();
		$this->data['custometyps'] = $this->Oa_model->get_customertype();
		$this->data['list'] = $this->Oa_model->get($idencr);
		$this->data['items'] = $this->Oa_model->get_items($idencr);
		//echo "<pre>"; print_r($this->data['list']); die;
		if($this->input->get('acttype') && $this->input->get('itemid') && ($this->input->get('acttype') == 'edit'))
		{
			$eitemid = $this->input->get('itemid');
			$this->data['edit_items'] = $this->Oa_model->get_edit_inqitems($idencr,$eitemid);
			//echo '<pre>';print_r($this->data['edit_items']);die;
			$this->data['action_item'] = "Oa/item_edit/".$this->uri->segment(3).'?acttype=edit&itemid='.$eitemid;
		}else{
			$this->data['action_item'] = "Oa/item_details/".$this->uri->segment(3);
		}
		//echo "<pre>"; print_r($this->data['list']); die;
		$this->data['all_hsns'] = $this->Oa_model->get_all_hsns();
		$this->data['countries'] = $this->Oa_model->get_country();
		$this->data['follow_exe'] = $this->Oa_model->get_follow_exe();
		$this->data['oa_code'] = $this->Oa_model->oa_no_get();
		$this->data['states'] = $this->Oa_model->get_state($this->data['list'][0]['oa_country']);
		$this->data['cities'] = $this->Oa_model->get_city($this->data['list'][0]['oa_state']);
		$this->data['brands'] = $this->Oa_model->get_salesbrand();
		$this->data['follow_status'] = $this->Oa_model->get_follow_status();
		$this->data['follow_method'] = $this->Oa_model->get_follow_method();
		$this->data['follow_exe'] = $this->Oa_model->get_follow_exe();
		$this->data['vendors'] = $this->Oa_model->get_masterparty();
		$this->data['modeinquries'] = $this->Oa_model->get_modeinquiry();
		$this->data['sources'] = $this->Oa_model->get_sourcecat();
		$this->data['subsources'] = $this->Oa_model->get_sourcesub_category();
		$this->data['main_content'] = 'Quotation_form_view';
		$this->data['action_bd'] = "Oa/basic_details/".$this->uri->segment(3);
		//$this->data['action_item'] = "Oa/item_details/".$this->uri->segment(3);
		$this->data['action_other'] = "Oa/other_details/".$this->uri->segment(3);
		$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$this->data['item_data'] = $this->Oa_model->get_item_data($enid);
		$this->load->view('includes/template',$this->data);
	}
	public function item_edit()
	{
		//echo "hiii";die;
		ini_set('memory_limit', '-1');
			require 'Zebra_Image.php';

			$right_status = $this->check_rights('edit');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access oa Edit functionality");
				redirect(base_url());
			}
			//echo "<pre>"; print_r($_FILES); die;
			
			//echo "hiii";die;
			if($this->input->get('acttype') && ($this->input->get('acttype') == 'edit') && $this->input->get('itemid'))
			{	

				//echo "<pre>"; print_r($this->input->post()); die;
				//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['oa_udate'] = date('Y-m-d H:i:s');
				//echo "dgdgd";die;
				$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
				$lid = $this->Oa_model->item_edit($value,$sqiitemid);
				//echo '<pre>';print_r($lid);die;
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
				//***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Oa/quatation_tab/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Oa/quatation_tab'), 'refresh');
				}
			 	redirect(base_url('Oa'), 'refresh');
			}
			else
			{
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
				$value = $this->security->xss_clean($value);
				
				$value['oa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',4);
				$lid = $this->Oa_model->other_add($value,$enid);
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
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Other Details added successfully.');
					redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Other Details not added successfully!!');
					//redirect(base_url('Oa/add'), 'refresh');
					redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Oa'), 'refresh');
			 	redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
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
				
				$value['oa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',1);
				$lid = $this->Oa_model->add($value,$enid);
				//echo $lid; die;
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
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Basic Details added successfully.');
					redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Basic Details not added successfully!!');
					//redirect(base_url('Oa/add'), 'refresh');
					redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Oa'), 'refresh');
			 	redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
	}

	public function item_details()
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
				
				$value['oa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',2);
				$lid = $this->Oa_model->item_add($value,$enid);
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
				//***********PDF File Code End********************
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Item Details added successfully.');
					redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Item Details not added successfully!!');
					//redirect(base_url('Oa/add'), 'refresh');
					redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Oa'), 'refresh');
			 	redirect(base_url('Oa/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
	}
	public function delete_items($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Oa Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$itemid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		
		if($itemid && ($itemid != ''))

		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $itemid) : '';

			if(isset($itemid) && $itemid!= '')
			{

					$lid = $this->Oa_model->delete_select_item($itemid);
					
						if ($enid) 
						{
							//echo $enid; die;
						$this->session->set_flashdata('success', 'item deleted successfully.');

						redirect(base_url('Oa/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

						} else {

							$this->session->set_flashdata('error', 'item not deleted successfully!!.');

							redirect(base_url('Oa/add'), 'refresh'); 
						}						
			}
			else{

					$this->session->set_flashdata('error', 'item not Available!!');

					redirect(base_url('Oa/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

			}

			redirect(base_url('Oa/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

		}else{

			$this->session->set_flashdata('error', 'Something went wrong');

			redirect('Start_production', 'refresh'); 

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
				$this->data['list'] = $this->Oa_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Oa_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Sales Quotation deleted successfully.');
						redirect('Oa', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Sales Quotation not deleted successfully!!.');
							redirect('Oa', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
			  		redirect('Oa', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
					redirect('Oa', 'refresh'); 
			}
			redirect('Oa', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Oa'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Oa Delete functionality");
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
						$this->data['list'] = $this->Oa_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->Oa_model->delete($idencr);
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
		redirect(base_url('Oa'), 'refresh');

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
				$this->data['action'] = "Oa/importcsv";
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
							if(isset($row['Oa']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['OaCode'])))
							{
								$this->Oa_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Oa'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Oa/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Oa/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Oa/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 30,$type);
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

	public function setbit_Oa()
	{
		$this->Oa_model->setbit_Oa();
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
		$this->data['sub_catlists'] = $this->Oa_model->get_subsource($this->abc);
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
					$lid = $this->Oa_model->delete_fup($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
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
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$oaid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$oa_id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $oaid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',2);

					$lid = $this->Oa_model->delete_itms($idencr,$oa_id);
					//***********PDF File Code Start********************
					$pdfdata = $this->Oa_model->get_pdfdata($this->encrypt_decrypt('decrypt',$this->uri->segment(4)),'Oa');
					//echo "<pre>"; print_r($pdfdata); die;
					$html = $this->load->view('Oa/Oa_pdf_view',$pdfdata,TRUE);
					//$html=$this->data['result_view'];
					$header='';
					$footer='';
					$pdfFilePath = FCPATH.'/pdf/oa/oa'.$this->uri->segment(4).'.pdf';
					$data['page_title'] = 'Hello world';
					ini_set('memory_limit','32222222222222222222222222M');
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetAutoPageBreak(TRUE, 15);
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					//***********PDF File Code End********************
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh');
			}
			redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Oa/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function oatopo()
	{
		echo "<pre>"; print_r($this->input->get()); die;
		$lid = $this->Oa_model->oatopo();
		
		redirect(base_url('Oa/edit?id='.$lid), 'refresh');
	}
	public function oatopi()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$lid = $this->Oa_model->oatopi();
		//die;
		$encid = $this->encrypt_decrypt('encrypt', $lid);
		$this->load->model('Pi_model');
		//***********PDF File Code Start********************
		$pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
		//echo '<pre>';print_r($pdfdata);die;
		$html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
		//$html=$this->data['result_view'];
		$header='';
		$footer='';
		$pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
		$data['page_title'] = 'Hello world';
		ini_set('memory_limit','32222222222222222222222222M');
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output($pdfFilePath, 'F');


		//***********PDF File Code End ********************		
		redirect(base_url('Pi/quatation_tab/'.$encid), 'refresh');
		
	}
	public function oatoworkorder()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$lid = $this->Oa_model->work_order();
		//die;
		$encid = $this->encrypt_decrypt('encrypt', $lid);
		
		//***********PDF File Code End ********************		
	
		redirect(base_url('Work_order/workorder_tab/'.$encid), 'refresh');
		
	}
	public function multiple_image_upload()
	{
		$valid_formats = array("jpg","JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "bmp", "BMP","pdf");
		$max_file_size = 1024*100000000; //100 kb
		//echo $path = base_url()."/uploads/product_images/"; // Upload directory
		//echo $path = $_SERVER['DOCUMENT_ROOT'];exit;
		//$path = $_SERVER['DOCUMENT_ROOT']."/miconindia.com/uploads/product_images/";
		$path = 'uploads/oa_mail/'; 
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