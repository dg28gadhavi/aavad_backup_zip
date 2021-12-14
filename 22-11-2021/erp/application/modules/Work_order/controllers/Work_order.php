<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Work_order extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('Work_order_model');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Work_order_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Work_order_model->get_Work_order();
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
			$editstr = '<a href="'.base_url().'Work_order/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Work_order/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
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
	
	public function Work_order_report()
	{
		ini_set('memory_limit', '-1');
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order VIew functionality");
			redirect(base_url());
		}
		$this->data['admins'] = $this->Work_order_model->get_admin();
		//$this->data['custometyps'] = $this->Work_order_model->get_customertype();
		$this->data['executive'] = $this->Work_order_model->get_Executive();
		$this->data['main_content'] = 'Work_order_report';
		$this->load->view('includes/template',$this->data);
	}

	public function pdf_workorder()
	{
		//$alldata = $this->Work_order_model->wo_pdfdata();
		//echo '<pre>';print_r($alldata);die;

	}

	public function confirm_wo()
	{
		$this->Work_order_model->wo_confirm();
		$this->session->set_flashdata('success', 'confirm successfully.');
					redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
	}
	public function ajax_salesinq_report()
	{
		$user = $this->Work_order_model->wo_report();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['wo_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Work_order/other_details/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
			$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
			if($type_id == 3 || $dep_id == 10)
			{
				if($user[$i]['wo_confirm_or_not'] == 0)
				{
					$deletestr = '<a title="delete" href="'.base_url().'Work_order/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
				}else{
					if($type_id == 3)
					{
						$deletestr = '<a title="delete" href="'.base_url().'Work_order/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
					}else{
						$deletestr = '';
					}
				}
			}	
			else{
				$deletestr = '';
			}
		}
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$quotestr = '';
		}else{
			$quotestr = '<a title="Create Quotation" href="'.base_url().'Work_order/create_quote/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create Quotation?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i></a>';
		}
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/wo/wo'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}

		//$user[$i]['wo_preparedby'] = $user[$i]['au_fname'].' '. $user[$i]['au_lname'];
		$records["data"][] = array(
				''.$user[$i]['wo_wo_no'],
				''.$user[$i]['wo_wo_date'],
				''.$user[$i]['wo_customer_name'],
				''.$user[$i]['wo_address'],
				''.$user[$i]['wo_fainaltotal'],
				''.$user[$i]['prepared_by_fname'].' '.$user[$i]['prepared_by_lname'],
				''.$user[$i]['created_by_fname'].' '.$user[$i]['created_by_lname'],
				''.$user[$i]['wo_remark'],
				''.$user[$i]['wo_udate'],
				//''.$user[$i]['sq_ref_by'],
			  ''.$editstr.''.$deletestr.''.$viewpdfstr,
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order Add functionality");
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
				$value['wo_cdate'] = date('Y-m-d H:i:s');
				$value['wo_udate'] = date('Y-m-d H:i:s');
				//$this->session->set_userdata('tabno',2);
				
				if(isset($_FILES['wo_paymnetimg_sales']['name']) && ($_FILES['wo_paymnetimg_sales']['name'] != '')){
					$folder_name = "wo_paymnetimg_sales";
					$file_type = "wo_paymnetimg_sales";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['wo_paymnetimg_sales'] = $image['upload_data']['file_name'];
				}


				$lid = $this->Work_order_model->add($value);
				$this->session->set_userdata('tabno',1);
				//***********PDF File Code Start********************
				$pdfdata = $this->Work_order_model->get_pdfdata($lid,'Work_order');
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
				$this->session->set_userdata('tabno',3);
				$lid = $this->Work_order_model->other_add($value);
				//***********PDF File Code Start********************
				$pdfdata = $this->Work_order_model->get_pdfdata($lid,'Work_order');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Work_order/Work_order_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
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
					$this->session->set_flashdata('success', 'Other Details added successfully.');
					redirect(base_url('Work_order/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Other Details not added successfully!!');
					redirect(base_url('Work_order/add'), 'refresh');
				}
			 	redirect(base_url('Work_order'), 'refresh');
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
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order Add functionality");
				redirect(base_url());
			}
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['woi_cdate'] = date('Y-m-d H:i:s');
				$value['woi_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',2);
					if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->Work_order_model->item_img($value);
					//if(count($result) > 0)
					//{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					//}
				}
				$lid = $this->Work_order_model->item_add($value);
				
				//***********PDF File Code Start********************
				$pdfdata = $this->Work_order_model->get_pdfdata($lid,'Work_order');
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
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item added successfully.');
					if($this->input->get('fromwofinal') && ($this->input->get('fromwofinal') == 1))
					{
						redirect(base_url('Dashboard_workorder_final#wonoids'.$lid), 'refresh');
					}
					redirect(base_url('Work_order/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not added successfully!!');
					redirect(base_url('Work_order/add'), 'refresh');
				}
			 	redirect(base_url('Work_order'), 'refresh');
		}

	public function item_edit()
	{
		ini_set('memory_limit', '-1');
			require 'Zebra_Image.php';
			$right_status = $this->check_rights('edit');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order Edit functionality");
				redirect(base_url());
			}
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['woi_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',2);
					if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->Work_order_model->item_img($value);
					//if(count($result) > 0)
					//{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					//}
				}
				$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
				$lid = $this->Work_order_model->item_edit($value,$sqiitemid);
				//echo '<pre>';print_r($lid);die;
				//***********PDF File Code Start********************
				$pdfdata = $this->Work_order_model->get_pdfdata($lid,'Work_order');
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
				if($lid)
				{
					if($this->input->get('fromwofinal') && ($this->input->get('fromwofinal') == 1))
					{
						redirect(base_url('Dashboard_workorder_final#wonoids'.$lid), 'refresh');
					}
					$this->session->set_flashdata('success', 'Details of item added successfully.');
					redirect(base_url('Work_order/other_details/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not added successfully!!');
					redirect(base_url('Work_order/add'), 'refresh');
				}
			 	redirect(base_url('Work_order'), 'refresh');
			
		
	}

	public function folup_add()
	{
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order Add functionality");
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
				$lid = $this->Work_order_model->folup_add($value);
				//***********PDF File Code Start********************
				$pdfdata = $this->Work_order_model->get_pdfdata($lid,'Work_order');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Work_order/Work_order_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
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
					$this->session->set_flashdata('success', 'Follow up details added successfully.');
					redirect(base_url('Work_order/other_details/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Follow up details not added successfully!!');
					redirect(base_url('Work_order/add'), 'refresh');
				}
			 	redirect(base_url('Work_order'), 'refresh');
			}else{
			$this->other_details();
		}
	}

	public function other_details()
	{
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['autosearch_items'] = $this->Work_order_model->get_customertype();
		// $this->data['custometyps'] = $this->Work_order_model->get_customertype();
		 $this->data['list'] = $this->Work_order_model->get($idencr);
		// //echo '<pre>';print_r($this->data['list']);die;
		 $this->data['items'] = $this->Work_order_model->get_items($idencr);
		 //echo '<pre>';print_r($this->data['items']);die;
		if($this->input->get('acttype') && $this->input->get('itemid') && ($this->input->get('acttype') == 'edit'))
		{
			$eitemid = $this->input->get('itemid');
			$this->data['edit_items'] = $this->Work_order_model->get_edit_inqitems($idencr,$eitemid);
			//echo '<pre>';print_r($this->data['edit_items']);die;
			if($this->input->get('fromwofinal') && ($this->input->get('fromwofinal') == 1))
			{
				$this->data['action_itm'] = "Work_order/item_edit/".$this->uri->segment(3).'?acttype=edit&itemid='.$eitemid."&fromwofinal=1";
			}else{
				$this->data['action_itm'] = "Work_order/item_edit/".$this->uri->segment(3).'?acttype=edit&itemid='.$eitemid;
			}
		}else{
			if($this->input->get('fromwofinal') && ($this->input->get('fromwofinal') == 1))
			{
				$this->data['action_itm'] = "Work_order/item_add/".$this->uri->segment(3)."?fromwofinal=1";
			}else{
				$this->data['action_itm'] = "Work_order/item_add/".$this->uri->segment(3);
			}
		}
		//echo "<pre>"; print_r($this->data['items']); die;
		$this->data['wo_type'] = $this->Work_order_model->get_wo_type();
		$this->data['confirm_or_not'] = $this->Work_order_model->get_confirm_or_not($idencr);
		$this->data['custometyps'] = $this->Work_order_model->get_customertype();
		$this->data['countries'] = $this->Work_order_model->get_country();
		$this->data['wo_no'] = $this->Work_order_model->wo_no_get();
		$this->data['vendors'] = $this->Work_order_model->get_masterparty();
		$this->data['admins'] = $this->Work_order_model->get_admin();
		$this->data['main_content'] = 'Sales_basic_details_tab';
		$this->data['action_bd'] = "Work_order/add/".$this->uri->segment(3);
		$this->data['action_othr'] = "Work_order/other_add/".$this->uri->segment(3);
		//$this->data['action_itm'] = "Work_order/item_add/".$this->uri->segment(3);
		$this->data['action_fup'] = "Work_order/folup_add/".$this->uri->segment(3);
		$this->load->view('includes/template',$this->data);
	}

	public function validation() 
	{
		//echo "hiii";die;
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add')
			{
				$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				$this->form_validation->set_rules('wo_custo_id', 'Customer Name Pls Select', 'trim|required');
				//$this->form_validation->set_rules('sq_email', 'Email', 'trim|required');  
				//$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');   
			}
			else 
			{
				//echo "hiiixsds";die;
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');   
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
		$this->data['custometyps'] = $this->Work_order_model->get_customertype();
		$this->data['wo_type'] = $this->Work_order_model->get_wo_type();
		$this->data['cities'] = $this->Work_order_model->get_city();
		$this->data['countries'] = $this->Work_order_model->get_country();
		$this->data['wo_no'] = $this->Work_order_model->wo_no_get();
		$this->data['vendors'] = $this->Work_order_model->get_masterparty();
		$this->data['admins'] = $this->Work_order_model->get_admin();
		$this->data['main_content'] = 'Work_order_form_view';
		$this->data['action'] = "Work_order/add";
		$this->load->view('includes/template',$this->data);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}
	public function admin_aprove()
	{
		//echo "<pre>";print_r($this->input->post());die;
		$value=$this->input->post();
		if($value['staff_ori_qty'] >= $value['staff_qty'])
		{
			$this->Work_order_model->admin_qty_aprove($value);
			$this->session->set_userdata('tabno',3);
			$this->session->set_flashdata('success', 'successfully.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
		else{
			$this->session->set_flashdata('error', 'Pl.Enter Valid Value.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
	}

	public function manager_aprove()
	{
		//echo "<pre>";print_r($this->input->post());die;
		$value=$this->input->post();
		
			if($value['staff_ori_qty'] >= $value['staff_qty'])
			{
				$response=$this->Work_order_model->manager_qty_aprove($value);
				if($response['status'] == true)
		       {	
					$this->session->set_userdata('tabno',3);
					$this->session->set_flashdata('success', 'successfully.');
					redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
				}
				else{
					$this->session->set_flashdata('error', $response['msg']);
				    redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Pl.Enter Valid Value.');
				redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
			}
		
	}

	public function production_aprove()
	{
		$value=$this->input->post();
		if($value['staff_ori_qty'] >= $value['staff_qty'])
		{
			$response=$this->Work_order_model->production_qty_aprove($value);
			if($response['status'] == true)
			{
				$this->session->set_flashdata('success', 'successfully.');
			   redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Not Enough Stock.');
			    redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Pl.Enter Valid Value.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
	}
	public function store_aprove()
	{
		$value=$this->input->post();
		if($value['staff_ori_qty'] >= $value['staff_qty'])
		{
			$this->Work_order_model->store_qty_aprove($value);
			$this->session->set_flashdata('success', 'successfully.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
		else{
			$this->session->set_flashdata('error', 'Pl.Enter Valid Value.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
	}
	public function account_aprove()
	{
		$value=$this->input->post();
		if($value['staff_ori_qty'] >= $value['staff_qty'])
		{
			$this->Work_order_model->account_qty_aprove($value);
			$this->session->set_flashdata('success', 'successfully.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
		else{
			$this->session->set_flashdata('error', 'Pl.Enter Valid Value.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
	}
	public function dispatch_aprove()
	{
		$value=$this->input->post();
		if($value['staff_ori_qty'] >= $value['staff_qty'])
		{
			$this->Work_order_model->dispatch_qty_aprove($value);
			$this->session->set_flashdata('success', 'successfully.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
		else{
			$this->session->set_flashdata('error', 'Pl.Enter Valid Value.');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(3)), 'refresh');
		}
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
				$this->data['list'] = $this->Work_order_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Work_order_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Work_order deleted successfully.');
						redirect('Work_order/Work_order_report', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Work_order not deleted successfully!!.');
							redirect('Work_order/Work_order_report', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Work_order not Available!!');
			  		redirect('Work_order/Work_order_report', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Work_order not Available!!');
					redirect('Work_order/Work_order_report', 'refresh'); 
			}
			redirect('Work_order/Work_order_report', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Work_order/Work_order_report'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order Delete functionality");
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
						$this->data['list'] = $this->Work_order_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->Work_order_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Work_order inquiry deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Work_order inquiry not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Work_order inquiry not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Work_order inquiry not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Work_order'), 'refresh');

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
				$this->data['action'] = "Work_order/importcsv";
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
							if(isset($row['Work_order']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['Work_orderCode'])))
							{
								$this->Work_order_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Work_order'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Work_order/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Work_order/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Work_order/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 29,$type);
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

	public function setbit_Work_order()
	{
		$this->Work_order_model->setbit_Work_order();
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
		$this->data['sub_catlists'] = $this->Work_order_model->get_subsource($this->abc);
		echo json_encode($this->data);
	}

	public function item_description()
	{
		if($this->input->post() && $this->input->post('master_item_id'))
		{
			$id = $this->input->post('master_item_id');
			$array = $this->Work_order_model->get_item_description($id);
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
			$this->Work_order_model->get_customer_information($value['term']);
		}
		
	}

	public function get_hc()
	{
		$id = $this->input->post('vendor');
		if(isset($id) && ($id != ''))
		{
			$value = $this->Work_order_model->get_hcs($id);
			echo json_encode($value);
		}
	}

	public function delete_Work_order_item($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order inquiry Delete functionality");
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
					$lid = $this->Work_order_model->delete_Work_order_item($idencr,$sa_id);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					//***********PDF File Code Start********************
				$pdfdata = $this->Work_order_model->get_pdfdata($sa_id,'Work_order');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Work_order/Work_order_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/wo/wo'.$this->encrypt_decrypt('encrypt',$sa_id).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32222222222222222222222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End********************
						if ($sa_id) {
						$this->session->set_flashdata('success', 'Work_order inquiry deleted successfully.');
						redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Work_order inquiry not deleted successfully!!.');
							redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Work_order inquiry not Available!!');
					redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(4)), 'refresh'); 
		}
	}

	public function status_act($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Work_order_model->status_act($idencr);
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Work_order_model->status_deact($idencr);
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Work_order inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Work_order_model->delete_fup($idencr);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					$pdfdata = $this->Work_order_model->get_pdfdata($autoid,'Work_order');
					//echo '<pre>';print_r($pdfdata);die;
					$html = $this->load->view('Work_order/Work_order_pdf_view',$pdfdata,TRUE);
					//$html=$this->data['result_view'];
					$header='';
					$footer='';
					$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$autoid).'.pdf';
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
						redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Work_order/other_details/'.$this->uri->segment(4)), 'refresh'); 
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
					$lid = $this->Work_order_model->delete_fup($idencr);
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
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
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
			$this->Work_order_model->get_item_details($value['term']);
		}
	}

	public function create_quote()
	{
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$lid = $this->Work_order_model->create_qoute($id);
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
					$lid = $this->Work_order_model->status_act($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status Changed successfully.');
						redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status  not Changed successfully!!.');
							redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
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
					$lid = $this->Work_order_model->status_deact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status Changed successfully.');
						redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status  not Changed successfully!!.');
							redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Work_order/other_details/'.$this->uri->segment(4), 'refresh'); 
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



        $finalar = $this->Work_order_model->get_excel_certificate();
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
			$statelists = $this->Work_order_model->get_country_to_state($countyid);
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
			$citylists = $this->Work_order_model->get_state_to_city($stateID);
		}else{
			$citylists = array();
		}
		echo json_encode($citylists);die;
	}
	public function store_custoid()
	{
		//die;
		$this->Work_order_model->store_custoid();
	}




}?>