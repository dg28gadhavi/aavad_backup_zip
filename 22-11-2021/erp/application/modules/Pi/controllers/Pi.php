<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pi extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('Pi_model');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Pi VIew functionality");
			redirect(base_url());
		}
		$this->data['vendors'] = $this->Pi_model->get_masterparty();
		$this->data['main_content'] = 'Pi_grid_view';
		$this->load->view('includes/template',$this->data);
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
				$lists = $this->Pi_model->get($idencr);
				//echo '<pre>';print_r($lists);die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value['sa_cdate'] = date('Y-m-d H:i:s');
				$value['sa_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->uri->segment(3) : '';
				$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
				$mailerdata = $this->Pi_model->get_mailer_detail($uid);
				$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
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
				$value['pim_from'] = $mailerdata['au_gmail_email'];
				$this->email->from($mailerdata['au_gmail_email']); // change it to yours
				$this->email->to($value['pim_to']);// change it to yours
				if(isset($value['pim_to_cc']) && ($value['pim_to_cc'] != ''))
				{
					$this->email->cc($value['pim_to_cc'].''. $mailerdata['au_pre_cc']);// change it to yours
				}
				$this->email->subject($value['pim_sub']);
				$this->email->message($value['pim_body']);
				foreach($imagenames as $imagename)
				{	
					$this->email->attach($path."uploads/pi_mail/".$imagename);
				}
				// $this->email->attach($path."pdf/pi/pi".$this->uri->segment(3).".pdf", 'attachment', 'Pi-'.url_title(convert_accented_characters($lists[0]['vendor']), 'dash', TRUE).''.date("d-m-Y H:i:s").'.pdf');
				$this->email->attach($path."pdf/pi/pi".$this->uri->segment(3).".pdf", 'attachment',''.$lists[0]['pi_no'].'.pdf');
				$this->email->set_mailtype("html");
			      //$this->email->attach($attach);
			     if($this->email->send())
			     {
			      echo 'Email sent.';
			      echo '<script>alert("Email sent.");window.location="'.base_url().'Pi/quatation_tab/'.$enid.'";</script>';
                    exit();
			     }
			     else
			    {
			     show_error($this->email->print_debugger());die;
			     
			    }
			    $lid = $this->Pi_model->send_mail($value);
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Mail sent successfully.');
					redirect(base_url('Pi/quatation_tab/'.$enid), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Mail not sent successfully!!');
					//redirect(base_url('Sale_quotation/add'), 'refresh');
					redirect(base_url('Pi/quatation_tab/'.$enid), 'refresh');
				}
			 	//redirect(base_url('Sale_quotation'), 'refresh');
			 	redirect(base_url('Pi/quatation_tab/'.$enid), 'refresh');
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
		$this->data['lists'] = $this->Pi_model->get($idencr);
		$this->data['main_content'] = 'Pi_mail_view';
		$this->data['action_mail'] = "Pi/send_mail/".$this->uri->segment(3);
		$this->load->view('includes/template',$this->data);
	}

	public function multiple_image_upload()
	{
		$valid_formats = array("jpg","JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "bmp", "BMP","pdf");
		$max_file_size = 1024*100000000; //100 kb
		//echo $path = base_url()."/uploads/product_images/"; // Upload directory
		//echo $path = $_SERVER['DOCUMENT_ROOT'];exit;
		//$path = $_SERVER['DOCUMENT_ROOT']."/miconindia.com/uploads/product_images/";
		$path = 'uploads/pi_mail/'; 
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

	public function ajax()
	{
		//echo "hiii";die;
		$user = $this->Pi_model->get_pi();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['pi_id']);
		//$this->encrypt->encode($user[$i]['pi_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Pi/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}

		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a title="Delete" href="'.base_url().'Pi/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'Pi/load_pdf/'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}
		if($right_status == false)
		{
			$emailsend = '';
		}else{
			
			$emailsend = '<a title="Email Send" href="'.base_url().'Pi/mail/'.$idenc.'" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-envelope-square"></i></a>';
		}

		if($user[$i]['pi_priority'] == 1)
			{
	         	 $sst = '<span class="label label-success">High</span>';
			}else if($user[$i]['pi_priority'] == 2)
				{
					 $sst = '<span class="label label-success">Low</span>';
				}
				else if($user[$i]['pi_priority'] == 3)
				{
					 $sst = '<span class="label label-success">Medium</span>';
				}else{
					 $sst = '';
				}
		if($user[$i]['pi_inq_st'] == 1) 	 
		{
			 $sstt = '<span class="label label-success">Active</span>';
		}else if($user[$i]['pi_inq_st'] == 2)
			{
				 $sstt = '<span class="label label-success">Pending</span>';
			}
			else if($user[$i]['pi_inq_st'] == 3)
			{
				 $sstt = '<span class="label label-success">Completed</span>';
			}else{
				$sstt = '';
			}
		$records["data"][] = array(
			  //'<input type="checkbox" name="delid[]" value="'.$user[$i]['pi_id'].'">',
			  $id,
				''.$user[$i]['pi_no'],
				''.$user[$i]['vendor'],
				//''.$user[$i]['master_item_name'],
				//''.date("d-m-Y", strtotime($user[$i]['pi_enq_date'])),
			//''.$user[$i]['mode_inquiry_name'],
			''.$sstt,
			''.$sst,
			''.$user[$i]['pi_remarks'],
			''.$user[$i]['pi_mobile'],
			''.$user[$i]['pi_report_gtotal'],
				''.date("d-m-Y", strtotime($user[$i]['pi_enq_date'])),
				''.$user[$i]['pi_ref_by'],
				 ''.date("d-m-Y", strtotime($user[$i]['pi_cdate'])),
			  ''.$editstr.''.$deletestr.''.$viewpdfstr.''.''.$emailsend.'',
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
		$this->data['sales_enq'] = $this->Pi_model->get_Pi();
		$this->data['countries'] = $this->Pi_model->get_country();
		$this->data['states'] = $this->Pi_model->get_state();
		$this->data['cities'] = $this->Pi_model->get_city();
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
		$this->data['total'] = $this->Pi_model->count();
		$this->data['listfolloup'] = $this->Pi_model->get_listofollow();
		$this->data['main_content'] = 'Followup_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax_followup()
	{
		$user = $this->Pi_model->get_followup();
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
			$editstr = '<a href="'.base_url().'Pi/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Pi/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
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
		$user = $this->Pi_model->sales_qoute_report();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['pi_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Pi/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a title="Delete" href="'.base_url().'Pi/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/pi/pi'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eveys"></i></a>';
		}

		if($user[$i]['pi_priority'] == 1)
			{
	         	 $sst = '<span>High</span>';
			}else if($user[$i]['pi_priority'] == 2)
				{
					 $sst = '<span>Low</span>';
				}
				else if($user[$i]['pi_priority'] == 3)
				{
					 $sst = '<span>Medium</span>';
				}else{
				$sst = '<span></span>';
			}
		if($user[$i]['pi_inq_st'] == 1)
		{
			 $sstt = '<span>Active</span>';
		}else if($user[$i]['pi_inq_st'] == 2)
			{
				 $sstt = '<span>Pending</span>';
			}
			else if($user[$i]['pi_inq_st'] == 3)
			{
				 $sstt = '<span>Completed</span>';
			}else{
				$sstt = '<span></span>';
			}
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['pi_id'].'">',
			  $id,
				''.$user[$i]['pi_no'],
				''.$user[$i]['vendor'],
				//''.date("d-m-Y", strtotime($user[$i]['sq_enq_date'])),
				//''.$user[$i]['mode_inquiry_name'],	
				//''.$user[$i]['mode_inquiry_name'],
				''.$sstt,
				''.$sst,
				''.$user[$i]['pi_grd_ttl'],
				''.$user[$i]['pi_remarks'],
				''.$user[$i]['pi_mobile'],
				''.$user[$i]['country_name'],
				''.$user[$i]['state_name'],
				''.$user[$i]['city_name'],
				''.date("d-m-Y", strtotime($user[$i]['pi_enq_date'])),
				''.$user[$i]['pi_referred_by'],
				 ''.date("d-m-Y", strtotime($user[$i]['pi_udate'])),
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access pi Add functionality");
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
				$value['pi_cdate'] = date('Y-m-d H:i:s');
				$value['pi_udate'] = date('Y-m-d H:i:s');
				$value['pi_hsncode'] = '995840';
				$value['pi_fright_hsncode'] = '996812';
				$value['pi_pfgst'] = 18;
				$value['pi_fright_pfgst'] = 18;
				//$this->session->set_userdata('qtabno',1);
				$lid = $this->Pi_model->add($value);
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End ********************		
				if($lid)
				{
					$this->session->set_flashdata('success', 'pi added successfully.');
					redirect(base_url('Pi/quatation_tab'."/".$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'pi not added successfully!!');
					redirect(base_url('Pi/add'), 'refresh');
				}
			 	redirect(base_url('Pi'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function load_pdf()
	{
		ini_set('memory_limit', '12888888888888888888888888888888888888888888M');
		$files = glob(FCPATH.'pdf/pi/*.pdf'); //get all file names
		foreach($files as $file)
		{
		    if(is_file($file))
		    unlink($file); //delete file
		}
		if($this->uri->segment(3))
		{
			$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
			$pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
			//echo '<pre>';print_r($pdfdata);die;
			$html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
			//$html=$this->data['result_view'];
			$footer='<div style="width:100%; position:relative; top:0;  z-index:1; background-color:#FFF; height:100%;"><img width="800" height="300" src="'.base_url().'assets/custom/images/aavad_footer.png" /></div>';
			$header='<div style="width:100%; position:absolute; top:0; z-index:1; border:1px solid #FFF;"><img src="'.base_url().'assets/custom/images/miconindia-header-new.jpg" /></div>';

			$pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
			$data['page_title'] = 'Hello world';
			//ini_set('memory_limit','32222222222222222222222222M');
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
			       27, // margin top
			       0, // margin bottom
			        0, // margin header
			        40); // margin footer
			$pdf->defaultheaderline = 0;
			$pdf->defaultfooterline = 0;
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F');
			redirect(base_url()."pdf/pi/pi".$this->encrypt_decrypt('encrypt',$lid).'.pdf');
		}
	}

	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access pi Edit functionality");
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
					$value['pi_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->Pi_model->edit($value,$idencr);

				// 	//***********PDF File Code Start********************
				// 		$pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// 		//echo '<pre>';print_r($pdfdata);die;
				// 		$html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// 		//$html=$this->data['result_view'];
				// 		$header='';
				// 		$footer='';
				// 		$pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// 		$data['page_title'] = 'Hello world';
				// 		ini_set('memory_limit','32222222222222222222222222M');
				// 		$this->load->library('pdf');
				// 		$pdf = $this->pdf->load();
				// 		$pdf->SetAutoPageBreak(TRUE, 15);
				// 		$pdf->WriteHTML($html); // write the HTML into the PDF
				// 		$pdf->Output($pdfFilePath, 'F');
				// 		//die;
				// //***********PDF File Code End ********************	
					if($lid)
					{
						$this->session->set_flashdata('success', 'Sales Quotation edited successfully.');
						redirect(base_url('Pi'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Sales Quotationnot edited successfully!!');
					}
				 	redirect(base_url('Pi'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Pi_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['countries'] = $this->Pi_model->get_country();
						$this->data['states'] = $this->Pi_model->get_state();
						$this->data['cities'] = $this->Pi_model->get_city();
						$this->data['brands'] = $this->Pi_model->get_salesbrand();
						$this->data['vendors'] = $this->Pi_model->get_masterparty();
						$this->data['modeinquries'] = $this->Pi_model->get_modeinquiry();
						$this->data['sources'] = $this->Pi_model->get_sourcecat();
						$this->data['subsources'] = $this->Pi_model->get_sourcesub_category();
						$this->data['action'] = "Pi/edit/".$enid;
						$this->data['main_content'] = 'Pi_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/Pi/Oa_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
						 redirect(base_url('Pi'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
					redirect(base_url('Pi'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Pi'), 'refresh'); 
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
		//$this->data['getOa'] = $this->Pi_model->addtOa();
		$this->data['follow_exe'] = $this->Pi_model->get_follow_exe();
		$this->data['countries'] = $this->Pi_model->get_country();
		$this->data['pi_code'] = $this->Pi_model->pi_no_get();
		$this->data['states'] = array();//$this->Pi_model->get_state();
		$this->data['cities'] = array();//$this->Pi_model->get_city();
		$this->data['brands'] = $this->Pi_model->get_salesbrand();
		$this->data['vendors'] = $this->Pi_model->get_masterparty();
		$this->data['modeinquries'] = $this->Pi_model->get_modeinquiry();
		$this->data['sources'] = $this->Pi_model->get_sourcecat();
		$this->data['subsources'] = $this->Pi_model->get_sourcesub_category();
		$this->data['main_content'] = 'Pi_form_view';
		$this->data['action'] = "Pi/add";
		$this->load->view('includes/template',$this->data);
	}
	public function quatation_tab()
	{
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['getSale_quotation'] = $this->sale_quotation_model->addtSale_quotation();
		$this->data['custometyps'] = $this->Pi_model->get_customertype();
		$this->data['list'] = $this->Pi_model->get($idencr);
		$this->data['items'] = $this->Pi_model->get_items($idencr);
		//echo "<pre>"; print_r($this->data['list']); die;
		if($this->input->get('acttype') && $this->input->get('itemid') && ($this->input->get('acttype') == 'edit'))
		{
			$eitemid = $this->input->get('itemid');
			$this->data['edit_items'] = $this->Pi_model->get_edit_inqitems($idencr,$eitemid);
			//echo '<pre>';print_r($this->data['edit_items']);die;
			$this->data['action_item'] = "Pi/item_edit/".$this->uri->segment(3).'?acttype=edit&itemid='.$eitemid;
		}else
		{
			$this->data['action_item'] = "Pi/item_details/".$this->uri->segment(3);
		}
		if($this->input->get('acttype') && $this->input->get('extraid') && ($this->input->get('acttype') == 'edit'))
		{
			$eextraid = $this->input->get('extraid');
			$this->data['edit_extra'] = $this->Pi_model->get_edit_inqextra($idencr,$eextraid);
			//echo '<pre>';print_r($this->data['edit_extra']);die;
			$this->data['action_extra'] = "Pi/extra_edit/".$this->uri->segment(3).'?acttype=edit&extraid='.$eextraid;
			//$this->data['action_item'] = "Pi/item_edit/".$this->uri->segment(3).'?acttype=edit&extraid='.$eitemid;
		}else
		{
			//echo "hiii";die();
			$this->data['action_extra'] = "Pi/extra_details/".$this->uri->segment(3);
		}
		$this->data['all_hsns'] = $this->Pi_model->get_all_hsns();
		$this->data['countries'] = $this->Pi_model->get_country();
		$this->data['pi_code'] = $this->Pi_model->pi_no_get();
		$this->data['states'] = $this->Pi_model->get_state($this->data['list'][0]['pi_country']);
		$this->data['cities'] = $this->Pi_model->get_city($this->data['list'][0]['pi_state']);
		$this->data['brands'] = $this->Pi_model->get_salesbrand();
		$this->data['follow_exe'] = $this->Pi_model->get_follow_exe();
		$this->data['follow_status'] = $this->Pi_model->get_follow_status();
		$this->data['follow_method'] = $this->Pi_model->get_follow_method();
		$this->data['follow_exe'] = $this->Pi_model->get_follow_exe();
		$this->data['vendors'] = $this->Pi_model->get_masterparty();
		$this->data['modeinquries'] = $this->Pi_model->get_modeinquiry();
		$this->data['sources'] = $this->Pi_model->get_sourcecat();
		$this->data['subsources'] = $this->Pi_model->get_sourcesub_category();
		$this->data['main_content'] = 'Quotation_form_view';
		$this->data['action_bd'] = "Pi/basic_details/".$this->uri->segment(3);
		//$this->data['action_item'] = "Pi/item_details/".$this->uri->segment(3);
		$this->data['action_other'] = "Pi/other_details/".$this->uri->segment(3);
		//$this->data['action_extra'] = "Pi/extra_details/".$this->uri->segment(3);
		$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$this->data['item_data'] = $this->Pi_model->get_item_data($enid);
		$this->data['extra_data'] = $this->Pi_model->get_extra_data($enid);
		$this->load->view('includes/template',$this->data);
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
				
				$value['pi_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',4);
				$lid = $this->Pi_model->other_add($value,$enid);
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End ********************	
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Other Details added successfully.');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Other Details not added successfully!!');
					//redirect(base_url('Pi/add'), 'refresh');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Pi'), 'refresh');
			 	redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
	}
	public function extra_details()
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
				
				$value['pi_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',5);
				$lid = $this->Pi_model->extra_add($value,$enid);
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End ********************	
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Extra Details added successfully.');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Extra Details not added successfully!!');
					//redirect(base_url('Pi/add'), 'refresh');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Pi'), 'refresh');
			 	redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
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
				
				$value['pi_udate'] = date('Y-m-d H:i:s');
				$value['pi_hsncode'] = '995840';
				$value['pi_fright_hsncode'] = '996812';
				$value['pi_pfgst'] = 18;
				$value['pi_fright_pfgst'] = 18;
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',1);
				
				$lid = $this->Pi_model->add($value,$enid);
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End ********************	
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Basic Details added successfully.');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Basic Details not added successfully!!');
					//redirect(base_url('Pi/add'), 'refresh');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Pi'), 'refresh');
			 	redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
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
				
				$value['pi_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',2);
				$lid = $this->Pi_model->item_add($value,$enid);
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End********************
				//echo "$lid";die();
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Item Details added successfully.');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Item Details not added successfully!!');
					//redirect(base_url('Pi/add'), 'refresh');
					redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Pi'), 'refresh');
			 	redirect(base_url('Pi/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			}else
			{
			$this->quatation_tab();
		}
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
				$value['pi_udate'] = date('Y-m-d H:i:s');
				//echo "dgdgd";die;
				$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
				$lid = $this->Pi_model->item_edit($value,$sqiitemid);
				//echo '<pre>';print_r($lid);die;
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Pi/quatation_tab/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Pi/quatation_tab'), 'refresh');
				}
			 	redirect(base_url('Pi'), 'refresh');
			}
			else
			{
			$this->quatation_tab();
		}
	}
	public function extra_edit()
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
			if($this->input->get('acttype') && ($this->input->get('acttype') == 'edit') && $this->input->get('extraid'))
			{	

				//echo "<pre>"; print_r($this->input->post()); die;
				//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['pi_udate'] = date('Y-m-d H:i:s');
				//echo "dgdgd";die;
				$e_id = $this->input->get('extraid') ? $this->input->get('extraid') : 0;
				$lid = $this->Pi_model->extra_edit($value,$e_id);
				//echo '<pre>';print_r($lid);die;
				// //***********PDF File Code Start********************
				// $pdfdata = $this->Pi_model->get_pdfdata($lid,'Pi');
				// //echo '<pre>';print_r($pdfdata);die;
				// $html = $this->load->view('Pi/Pi_pdf_view',$pdfdata,TRUE);
				// //$html=$this->data['result_view'];
				// $header='';
				// $footer='';
				// $pdfFilePath = FCPATH.'/pdf/pi/pi'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				// $data['page_title'] = 'Hello world';
				// ini_set('memory_limit','32222222222222222222222222M');
				// $this->load->library('pdf');
				// $pdf = $this->pdf->load();
				// $pdf->SetAutoPageBreak(TRUE, 15);
				// $pdf->WriteHTML($html); // write the HTML into the PDF
				// $pdf->Output($pdfFilePath, 'F');
				// //***********PDF File Code End********************
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Pi/quatation_tab/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Pi/quatation_tab'), 'refresh');
				}
			 	redirect(base_url('Pi'), 'refresh');
			}
			else
			{
			$this->quatation_tab();
		}
	}
	public function delete_items($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Pi Delete functionality");
			redirect(base_url());
		}
		$this->session->set_userdata('qtabno',5);
		$enid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$itemid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo $itemid; die;
		if($itemid && ($itemid != ''))

		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $itemid) : '';

			if(isset($itemid) && $itemid!= '')
			{


					$lid = $this->Pi_model->delete_select_item($itemid);
					
						if ($enid) 
						{
							//echo $enid; die;
						$this->session->set_flashdata('success', 'item deleted successfully.');

						redirect(base_url('Pi/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

						} else {

							$this->session->set_flashdata('error', 'item not deleted successfully!!.');

							redirect(base_url('Pi/add'), 'refresh'); 
						}						
			}
			else{

					$this->session->set_flashdata('error', 'item not Available!!');

					redirect(base_url('Pi/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

			}

			redirect(base_url('Pi/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

		}else{

			$this->session->set_flashdata('error', 'Something went wrong');

			redirect('Start_production', 'refresh'); 

		}

	}
	
	public function delete_extra($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Pi Delete functionality");
			redirect(base_url());
		}
		$this->session->set_userdata('qtabno',5);
		$enid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$itemid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo $itemid; die;
		if($itemid && ($itemid != ''))

		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $itemid) : '';
			$pid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';

			if(isset($itemid) && $itemid!= '')
			{


					$lid = $this->Pi_model->delete_select_extra($idencr,$pid);
					
						if ($enid) 
						{
							//echo $enid; die;
						$this->session->set_flashdata('success', 'Extra item deleted successfully.');

						redirect(base_url('Pi/quatation_tab/'.$enid), 'refresh');

						} else {

							$this->session->set_flashdata('error', 'Extra item not deleted successfully!!.');

							redirect(base_url('Pi/add'), 'refresh'); 
						}						
			}
			else{

					$this->session->set_flashdata('error', 'Extra item not Available!!');

					redirect(base_url('Pi/extra_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

			}

			redirect(base_url('Pi/extra_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

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
				$this->data['list'] = $this->Pi_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Pi_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Sales Quotation deleted successfully.');
						redirect('Pi', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Sales Quotation not deleted successfully!!.');
							redirect('Pi', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
			  		redirect('Pi', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
					redirect('Pi', 'refresh'); 
			}
			redirect('Pi', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Pi'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Pi Delete functionality");
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
						$this->data['list'] = $this->Pi_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->Pi_model->delete($idencr);
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
		redirect(base_url('Pi'), 'refresh');

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
				$this->data['action'] = "Pi/importcsv";
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
							if(isset($row['Pi']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['PiCode'])))
							{
								$this->Pi_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Pi'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Pi/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Pi/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Pi/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 27,$type);
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

	public function setbit_Pi()
	{
		$this->Pi_model->setbit_Pi();
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
		$this->data['sub_catlists'] = $this->Pi_model->get_subsource($this->abc);
		echo json_encode($this->data);
	}

	public function get_gst()
	{
		//echo $this->input->post('id');die;
		$id = $this->input->post('id');
		$result = $this->Pi_model->get_gst($id);
		echo json_encode($result);
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
					$lid = $this->Pi_model->delete_fup($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
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
		$piid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$pi_id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $piid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',2);
					$lid = $this->Pi_model->delete_itms($idencr,$pi_id);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh');
			}
			redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Pi/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	
	
}?>