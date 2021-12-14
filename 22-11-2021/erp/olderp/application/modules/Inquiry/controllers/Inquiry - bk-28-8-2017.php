<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
		$this->load->model('inquiry_model');
		//$this->load->library('encrypt');
		$this->load->library('Csvimport');
		$this->load->library('form_validation');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect('admin/login','refresh');
		}
	}
	 
	public function index()
	{
		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;

		//***************************************************************************
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/Inquiry";
		$config['total_rows'] = $this->inquiry_model->get_inquiry_count();
		$config['per_page'] = 10; 
		$config['full_tag_open'] = "<ul class='pagination pagination-lg'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='actice'>";
		$config['cur_tag_close'] = '</li>';
		$config['next_tag_open'] = "<li class='next-pagi'>";
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = "<li class='prev-pagi'>";
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['uri_segment'] = 2;
		$this->pagination->initialize($config); 
		$this->data['pagi'] = $this->pagination->create_links();
		$this->data['inq_lists'] = $this->inquiry_model->get_inquiry($page,$config['per_page']);
		//***************************************************************************
		$this->data['datass'] = $this->inquiry_model->get_all_masters();
		$this->data['set_action'] = "inquiry/setting_save";
		$this->data['main_content'] = 'Inquiry_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		//$user = $this->inquiry_model->get_inquiry();
		$count = $this->inquiry_model->get_inquiry_count();
		$iTotalRecords = $count;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		$user = $this->inquiry_model->get_inquiry($iDisplayStart,$iDisplayLength);
		//echo count($user);die;
		$status_list = array(
			array("success" => "Pending"),
			array("info" => "Closed"),
			array("danger" => "On Hold"),
			array("warning" => "Fraud")
		);

		foreach($user as $i => $vals){
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		if($vals['inq_date'] == '1970-01-01')
			{
	         	 $sst = '';
			}else if($vals['inq_date'])
				{
					 $sst = date("d-m-Y", strtotime($vals['inq_date']));
				}
		$idenc = $this->encrypt_decrypt('encrypt',$vals['inq_id']);//$this->encrypt->encode($vals['edu_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			 /* '<input type="checkbox" name="delid[]" value="'.$vals['inq_id'].'">',*/
			 // $id,
			''.$sst,
			''.$vals['inquiry_type_name'],
			''.$vals['bd_fname'],
			''.$vals['bd_lname'],
			''.$vals['bd_fullname'],
			''.$vals['prot_name'],
			''.$vals['procat_name'],
			''.$vals['inquiry_status_name'],
			''.$vals['con_no_mnos'],
			//''.date("m-d-Y", strtotime($vals['bd_dob'])),
			''.$vals['bd_age'],
			''.$vals['bd_remark'],
			  '<a href="'.base_url().'Inquiry/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>
			  <a href="'.base_url().'pdf/inquiry/inq'.$vals['inq_id'].'.pdf" target="_BLANK" class="btn btn-sm btn-outline blue"><i class="fa fa-search"></i> View PDF</a>
			  <a href="'.base_url().'Inquiry/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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

	public function ajax_inq_report()
	{
		$count = $this->inquiry_model->get_inquiry_report_count();
		$iTotalRecords = $count;
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		$user = $this->inquiry_model->get_inquiry_report($iDisplayStart,$iDisplayLength);
		$status_list = array(
			array("success" => "Pending"),
			array("info" => "Closed"),
			array("danger" => "On Hold"),
			array("warning" => "Fraud")
		);

		foreach($user as $i => $vals){
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		if($vals['inq_date'] == '1970-01-01')
			{
	         	 $sstt = '';
			}else if($vals['inq_date'])
				{
					 $sstt = date("d-m-Y", strtotime($vals['inq_date']));
				}
		 if(isset($vals['inq_subsource']) && $vals['inq_subsource'] != '')
		 {
		 	$ssrcid = $this->inquiry_model->get_sub_sorce($vals['inq_subsource']);
		 }else{
		 	$ssrcid = '';
		 }
		 //echo '<pre>';print_r($ssrcid);die;
		$idenc = $this->encrypt_decrypt('encrypt',$vals['inq_id']);//$this->encrypt->encode($vals['edu_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
//			  '<input type="checkbox" name="delid[]" value="'.$vals['inq_id'].'">',
//			  $id,
		''.$sstt,
		''.$vals['inquiry_type_name'],
		''.$vals['bd_fname'],
		''.$vals['bd_lname'],
		''.$vals['prot_name'],
		''.$vals['procat_name'],
		''.$vals['inquiry_status_name'],
		''.$vals['au_fname'],
		//''.date("m-d-Y", strtotime($vals['bd_dob'])),
		''.$vals['source_cat_name'],
		''.$ssrcid,
		''.$vals['bd_age'],
		''.$vals['bd_remark'],
			  '<a href="'.base_url().'Inquiry/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>
			  <a href="'.base_url().'pdf/inquiry/inq'.$vals['inq_id'].'.pdf" target="_BLANK" class="btn btn-sm btn-outline blue"><i class="fa fa-search"></i> View PDF</a>
			  <a href="'.base_url().'Inquiry/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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

	public function inq_report()
	{
		$this->data['datas'] = $this->inquiry_model->get_all_master();
		//echo "<pre>"; print_r($this->data['datas']); die;
		$this->data['main_content'] = 'Inq_report';
		$this->load->view('includes/template',$this->data);
	}
	
	public function add()
	{ 
		$success = $this->validation();

		if($success == TRUE)
		{ 
			if($this->input->post(NULL,TRUE))
			{
				//echo "<pre>"; print_r($this->input->post());die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				//$value['edu_cdate'] = date('Y-m-d H:i:s');
				//$value['edu_udate'] = date('Y-m-d H:i:s');
				$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				$lid = $this->inquiry_model->add($value);

				$pdfdata = $this->inquiry_model->get_pdfdata($lid);
				//echo "<pre>"; print_r($pdfdata); die;
				//$html = $this->load->view('admin/master/invoice/invoice_pdf_view',$pdfdata,TRUE);
				if(isset($pdfdata) && isset($pdfdata['inquiry']) && isset($pdfdata['ucountry']) && isset($pdfdata['products']))
				{
					$html = $this->load->view('inquiry/inq_pdf_view',$pdfdata,TRUE);
					//$this->data['main_content'] = 'Inquiry_form_view';
				}
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				// $base_dir = FCPATH.'/pdf/inquiry/';
				// $new_dir = $base_dir.date('/Y/m/d/');
				// if(!file_exists($new_dir) AND is_writable($base_dir)) {
				//     $updated = mkdir($new_dir, 0755, true)
				// } 
				$pdfFilePath = FCPATH.'/pdf/inquiry/inq'.$lid.'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32M');
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
				//die;

				if($lid)
				{
					$this->session->set_flashdata('success', 'Inquiry added successfully.');
					redirect(base_url('Inquiry'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Inquiry  not added successfully!!');
					redirect(base_url('Inquiry/add'), 'refresh');
				}
			 	redirect(base_url('Inquiry'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function edit($id = FALSE)
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$success = $this->validation();
			
			if($success == TRUE)
			{
				if($this->input->post(NULL,FALSE))
				{  //echo "<pre>"; print_r($this->input->post()); die;
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					//$value['edu_udate'] = date('Y-m-d H:i:s');
					//$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   					//$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->inquiry_model->edit($value,$idencr);
					//$pdfdata = $this->inquiry_model->get_pdfdata($lid);
					//echo "<pre>"; print_r($pdfdata); die;
					//$html = $this->load->view('admin/master/invoice/invoice_pdf_view',$pdfdata,TRUE);
					// if(isset($pdfdata) && isset($pdfdata['inquiry']) && isset($pdfdata['ucountry']) && isset($pdfdata['products']))
					// {
					// 	$html = $this->load->view('inquiry/inq_pdf_view',$pdfdata,TRUE);
					// 	//$this->data['main_content'] = 'Inquiry_form_view';
					// }
					//$html=$this->data['result_view'];
					// $header='';
					// $footer='';
					// $base_dir = FCPATH.'/pdf/inquiry/';
					// $new_dir = $base_dir.date('/Y/m/d/');
					// if(!file_exists($new_dir) AND is_writable($base_dir)) {
					//     $updated = mkdir($new_dir, 0755, true)
					// } 
					// $pdfFilePath = FCPATH.'/pdf/inquiry/inq'.$lid.'.pdf';
					// $data['page_title'] = 'Hello world';
					// ini_set('memory_limit','32M');
					// $this->load->library('pdf');
					// $pdf = $this->pdf->load();
					//$pdf->SetFooter($footer);
					//$pdf->SetHTMLHeader($header);
					//$pdf->SetMargins(15, 15, 15);
					//$pdf->SetHeaderMargin(15);
					//$pdf->SetFooterMargin(15);
					// $pdf->SetAutoPageBreak(TRUE, 15);
					// $pdf->WriteHTML($html); // write the HTML into the PDF
					// $pdf->Output($pdfFilePath, 'F');
					if($lid)
					{
						$this->session->set_flashdata('success', 'Inquiry  edited successfully.');
						redirect(base_url('Inquiry'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Inquiry  not edited successfully!!');
					}
				 	redirect(base_url('Inquiry'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->inquiry_model->get($idencr);
				  	
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['datas'] = $this->inquiry_model->get_all_master();
						//echo "<pre>"; print_r($this->data); die;
						$this->data['action'] = "Inquiry/edit/".$enid;
						$this->data['main_content'] = 'Inquiry_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/inquiry/Inquiry_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Inquiry not Available!!');
						 redirect(base_url('Inquiry'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Inquiry  not Available!!');
					redirect(base_url('Inquiry'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Inquiry'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		//echo "<pre>"; print_r($this->input->post());die;
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('edu_name', 'edu_name', 'trim|required');
			$this->form_validation->set_rules('inquiry_details[inq_no]','inq_no','trim|required');    
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
		$this->data['datas'] = $this->inquiry_model->get_all_master();
		//echo "<pre>"; print_r($this->data['datas']); die;
		$this->data['main_content'] = 'Inquiry_form_view';
		$this->data['action'] = "Inquiry/add";
		$this->load->view('includes/template',$this->data);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}

	public function delete($id=false)
	{
		
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->inquiry_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->inquiry_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Inquiry  deleted successfully.');
						redirect('inquiry', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Inquiry  not deleted successfully!!.');
							redirect('inquiry', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Inquiry not Available!!');
			  		redirect('inquiry', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Inquiry  not Available!!');
					redirect('inquiry', 'refresh'); 
			}
			redirect('inquiry', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Inquiry'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		//echo '<pre>';print_r($this->input->get('delid'));die;
		if($this->input->get('delid') && is_array($this->input->get('delid')) && !empty($this->input->get('delid')))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->inquiry_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->inquiry_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Inquiry  deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Inquiry  not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Inquiry not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Inquiry not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Inquiry'), 'refresh');

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

	public function get_ptype()
	{
		$value = $this->inquiry_model->get_ptype();
	  	echo json_encode($value);
	}

	public function get_pcate()
	{
		$value = $this->inquiry_model->get_pcate();
	  	echo json_encode($value);
	}
	
	public function get_srctype()
	{
		$value = $this->inquiry_model->get_srctype();
		//echo "<pre>"; print_r(json_encode($value)); die;
	  	echo json_encode($value);
	}
	
	public function setting_save()
	{
		echo "<pre>"; print_r($this->input->post());die;
	}

	public function importcsv() 
  	{		
		if($this->input->post() && isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != ''))
		{
			ini_set('memory_limit', '2569999999999999999999999999999999999999999999999999M');
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
				$this->data['action'] = "Inquiry/importcsv";
				$this->data['main_content'] = 'Importcsv_view';
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
							//echo "<pre>";print_r($row);die;
							if(isset($row['inqid']) && (isset($row['userid'])) && (isset($row['dateinq'])) && (isset($row['calldate'])) && (isset($row['fudate'])) && (isset($row['compnayname'])) && (isset($row['clientname'])) && (isset($row['contactno'])) && (isset($row['contactno2'])) && (isset($row['country'])) && (isset($row['state'])) && (isset($row['city'])) && (isset($row['areaname'])) && (isset($row['proid'])) && (isset($row['producttype'])) && (isset($row['status'])) && (isset($row['executive'])) && (isset($row['source'])) && (isset($row['email'])) && (isset($row['band'])) && (isset($row['age'])) && (isset($row['education'])) && (isset($row['experience'])) && (isset($row['expfiled'])) && (isset($row['relative_in_foreign'])) && (isset($row['countryeligible'])) && (isset($row['refusal'])) && (isset($row['spouseage'])) && (isset($row['spouseageedu'])) && (isset($row['spouseexp'])) && (isset($row['spouseexpfiled'])) && (isset($row['kids'])) && (isset($row['reference'])) && (isset($row['inqtype'])) && (isset($row['remarks'])))
							{
								//echo 'hiiiiiiiii';die;
								$this->inquiry_model->importcsv($row);
							}else{
								//echo '346346346';die;
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Inquiry'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Inquiry/importcsv";
					$this->data['main_content'] = 'Importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Inquiry/importcsv";
			$this->data['main_content'] = 'Importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }

	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Inquiry/importcsv";
		$this->data['main_content'] = 'Importcsv_view';
		$this->load->view('includes/template',$this->data);
	}

	
}?>