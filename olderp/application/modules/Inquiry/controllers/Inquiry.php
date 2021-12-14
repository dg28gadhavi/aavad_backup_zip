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
		//$this->load->model('user_model');
		//$this->load->library('encrypt');
		$this->load->library('Csvimport');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry VIew functionality");
			redirect(base_url());
		}
		$right_status = $this->check_rights('edit');
		$this->data['editrights'] = $right_status;
		$right_status = $this->check_rights('delete');
		$this->data['deleterights'] = $right_status;

		if($this->input->post())
		{
			$inq_forn['inq_start_date'] = $this->input->post('inq_start_date') ? $this->input->post('inq_start_date') : '';
			$inq_forn['inq_end_date'] = $this->input->post('inq_end_date') ? $this->input->post('inq_end_date') : '';
			$inq_forn['inq_type'] = $this->input->post('inq_type') ? $this->input->post('inq_type') : '';
			//$inq_forn['fname'] = $this->input->post('fname') ? $this->input->post('fname') : '';
			//$inq_forn['lname'] = $this->input->post('lname') ? $this->input->post('lname') : '';
			//$inq_forn['clientname'] = $this->input->post('clientname') ? $this->input->post('clientname') : '';
			//$inq_forn['companyname'] = $this->input->post('companyname') ? $this->input->post('companyname') : '';
			$inq_forn['product_type'] = $this->input->post('product_type') ? $this->input->post('product_type') : '';
			$inq_forn['category'] = $this->input->post('category') ? $this->input->post('category') : '';
			$inq_forn['status'] = $this->input->post('status') ? $this->input->post('status') : '';
			$inq_forn['cno'] = $this->input->post('cno') ? $this->input->post('cno') : '';
			$inq_forn['executive'] = $this->input->post('executive') ? $this->input->post('executive') : '';
			//$inq_forn['city'] = $this->input->post('city') ? $this->input->post('city') : '';
			$inq_forn['source'] = $this->input->post('source') ? $this->input->post('source') : '';
			$inq_forn['subsource'] = $this->input->post('subsource') ? $this->input->post('subsource') : '';
			//$inq_forn['age'] = $this->input->post('age') ? $this->input->post('age') : '';
			$inq_forn['remark'] = $this->input->post('remark') ? $this->input->post('remark') : '';
			$this->session->set_userdata('inq_forn',$inq_forn);	
		}
		//echo '<pre>';print_r($this->session->userdata['inq_forn']);die;
		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;

		//***************************************************************************
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/Inquiry";
		$config['total_rows'] = $this->inquiry_model->get_inquiry_count();
		$config['per_page'] = 10; 
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'> <a href='javascript:;'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['uri_segment'] = 2;
		$this->pagination->initialize($config); 
		$this->data['pagi'] = $this->pagination->create_links();
		$this->data['inq_lists'] = $this->inquiry_model->get_inquiry($page,$config['per_page']);
		//***************************************************************************
		$this->data['datass'] = $this->inquiry_model->get_all_masters();
		$this->data['total_rows'] = $config['total_rows'];
		$this->data['action'] = "Inquiry/add";
		$this->data['main_content'] = 'Inquiry_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function inq_status_view()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry VIew functionality");
			redirect(base_url());
		}	
		if($this->input->post())
		{
			$inq_forn['inq_start_date'] = $this->input->post('inq_start_date') ? $this->input->post('inq_start_date') : '';
			$inq_forn['inq_end_date'] = $this->input->post('inq_end_date') ? $this->input->post('inq_end_date') : '';
			$inq_forn['inq_type'] = $this->input->post('inq_type') ? $this->input->post('inq_type') : '';
			$inq_forn['fname'] = $this->input->post('fname') ? $this->input->post('fname') : '';
			$inq_forn['lname'] = $this->input->post('lname') ? $this->input->post('lname') : '';
			$inq_forn['clientname'] = $this->input->post('clientname') ? $this->input->post('clientname') : '';
			$inq_forn['product_type'] = $this->input->post('product_type') ? $this->input->post('product_type') : '';
			$inq_forn['category'] = $this->input->post('category') ? $this->input->post('category') : '';
			$inq_forn['status'] = $this->input->post('status') ? $this->input->post('status') : '';
			$inq_forn['cno'] = $this->input->post('cno') ? $this->input->post('cno') : '';
			$inq_forn['age'] = $this->input->post('age') ? $this->input->post('age') : '';
			$inq_forn['remark'] = $this->input->post('remark') ? $this->input->post('remark') : '';
			$this->session->set_userdata('inq_forn',$inq_forn);	
		}
		//echo '<pre>';print_r($this->session->userdata['inq_forn']);die;
		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;

		//***************************************************************************
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/Inquiry";
		$config['total_rows'] = $this->inquiry_model->get_inquiry_count();
		$config['per_page'] = 10; 
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'> <a href='javascript:;'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['uri_segment'] = 2;
		$this->pagination->initialize($config); 
		$this->data['pagi'] = $this->pagination->create_links();
		$this->data['inq_lists'] = $this->inquiry_model->get_inquiry_status($page,$config['per_page']);
		//***************************************************************************
		$this->data['datass'] = $this->inquiry_model->get_all_masters();
		$this->data['total_rows'] = $config['total_rows'];
		$this->data['set_action'] = "inquiry/setting_save";
		$this->data['main_content'] = 'Inq_status_grid_view';
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
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Inquiry/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Inquiry/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}
		$createstr = '<a href="'.base_url().'Inquiry/create_fisa_file/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Create Visa</a>';
		$records["data"][] = array(
			 // '<input type="checkbox" name="id[]" value="'.$idenc.'">',
			 //$id,
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
			''.$editstr.''.$deletestr.''.$createstr.'',
			  ' <a href="'.base_url().'pdf/inquiry/inq'.$vals['inq_id'].'.pdf" target="_BLANK" class="btn btn-sm btn-outline blue"><i class="fa fa-search"></i> View PDF</a>',
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
		//echo "hii"; die;
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
		 $ststr = '';
		if($vals['inq_inqstatus'] == 8)
		{
			$ststr =  '<span class="label label-success">'.$vals['inquiry_status_name'].'</span>';
		}else if($vals['inq_inqstatus'] == 5)
		{
			$ststr =  '<span class="label label-info">'.$vals['inquiry_status_name'].'</span>';
		}else if($vals['inq_inqstatus'] == 3)
		{
			$ststr =  '<span class="label label-primary">'.$vals['inquiry_status_name'].'</span>';
		}else if($vals['inq_inqstatus'] == 6)
		{
			$ststr =  '<span class="label label-warning">'.$vals['inquiry_status_name'].'</span>';
		}else if($vals['inq_inqstatus'] == 2)
		{
			$ststr =  '<span class="label label-primary">'.$vals['inquiry_status_name'].'</span>';
		}else if($vals['inq_inqstatus'] == 1)
		{
			$ststr =  '<span class="label label-info">'.$vals['inquiry_status_name'].'</span>';
		}else if($vals['inq_inqstatus'] == 4)
		{
			$ststr =  '<span class="label label-warning">'.$vals['inquiry_status_name'].'</span>';
		}else
		{
			$ststr =  '<span class="label label-info">'.$vals['inquiry_status_name'].'</span>';
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
		''.$vals['bd_fullname'],
		''.$vals['bd_company_name'],
		''.$vals['con_no_mnos'],
		''.$vals['prot_name'],
		''.$vals['procat_name'],
		''.$ststr,
		''.$vals['au_fname'],
		//''.$vals['city_name'],
		//''.date("m-d-Y", strtotime($vals['bd_dob'])),
		''.$vals['source_cat_name'],
		''.$ssrcid,
		''.$vals['bd_remark'],
		'<a href="'.base_url().'Inquiry/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>
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

	public function create_visa()
	{
		//echo "hi"; die;
		//$idencr = $this->uri->segment(3) ?  $this->uri->segment(3) : '';
		$iddcr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$lid = $this->inquiry_model->create_visa($iddcr);
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('encrypt', $lid) : '';
		redirect(base_url().'User/edit/'.$idencr);
		
	}

	public function inq_report()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry Report VIew functionality");
			redirect(base_url());
		}
		$this->data['datas'] = $this->inquiry_model->get_all_master();
		//echo "<pre>"; print_r($this->data['datas']); die;
		$this->data['main_content'] = 'Inq_report';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax_order_status()
	{
		$user = $this->inquiry_model->get_inq_order();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['inq_st_o_id']);
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Inquiry/edit_status/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Inquiry/delete_status/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['inq_st_o_id'].'">',
			  $id,
			  ''.$user[$i]['inq_st_o_bill_no'],
			  //''.$user[$i]['country_roe'],
			  ''.date("m-d-Y", strtotime($user[$i]['inq_st_o_bill_dt'])),
			  ''.$user[$i]['inq_st_o_chln_no'],
			  ''.date("m-d-Y", strtotime($user[$i]['inq_st_o_chln_dt'])),
			  ''.$user[$i]['inq_st_o_rcvd_amt'],
			  ''.$editstr.''.$deletestr.'',
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
	public function edit_status($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inq Order Edit functionality");
			redirect(base_url());
		}
		//require 'Zebra_Image.php';
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$success = $this->validation_order_status();
			
			if($success == TRUE)
			{
				if($this->input->post(NULL,FALSE))
				{
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['inq_st_o_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->inquiry_model->edit_status($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Inq Order edited successfully.');
						redirect(base_url('Inquiry/inq_status_list'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Inq Order not edited successfully!!');
					}
				 	redirect(base_url('Inquiry/inq_status_list'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->inquiry_model->get_inq_order($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Inquiry/edit_status/".$enid;
						$this->data['main_content'] = 'Inquiry_status_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/country/Country_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Inquiry Order not Available!!');
						 redirect(base_url('Inquiry/inq_status_list'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Inquiry Order not Available!!');
					redirect(base_url('Inquiry/inq_status_list'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Inquiry/inq_status_list'), 'refresh'); 
		}
	}
	public function delete_status($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry Order functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->inquiry_model->get_inq_order($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->inquiry_model->delete_inq_order($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Inquiry Order Status deleted successfully.');
						redirect('Inquiry/inq_status_list', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Inquiry Order Status  not deleted successfully!!.');
							redirect('Inquiry/inq_status_list', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Inquiry not Available!!');
			  		redirect('Inquiry/inq_status_list', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Inquiry  not Available!!');
					redirect('Inquiry/inq_status_list', 'refresh'); 
			}
			redirect('Inquiry/inq_status_list', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Inquiry/inq_status_list'), 'refresh'); 
		}
	}
	
	public function add()
	{ 
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry Add functionality");
			redirect(base_url());
		}
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

				if($lid)
				{
					$this->session->set_flashdata('success', 'Inquiry added successfully.');
					redirect(base_url('Inquiry/inq_report'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Inquiry  not added successfully!!');
					redirect(base_url('Inquiry/add'), 'refresh');
				}
			 	redirect(base_url('Inquiry/inq_report'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry Add functionality");
			redirect(base_url());
		}
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
						redirect(base_url('Inquiry/edit/'.$enid.''), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Inquiry  not edited successfully!!');
					}
				 	redirect(base_url('Inquiry/inq_report'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				$this->data['userid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
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
	public function inq_status_list()
	{
	$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry Report VIew functionality");
			redirect(base_url());
		}
		//$this->data['datas'] = $this->inquiry_model->get_all_master();
		//echo "<pre>"; print_r($this->data['datas']); die;
		$this->data['main_content'] = 'Inq_order_status_grid_view';
		$this->load->view('includes/template',$this->data);	
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

	public function validation_order_status()
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('edu_name', 'edu_name', 'trim|required');
			$this->form_validation->set_rules('inq_st_o_bill_no','Bill No','trim|required');    
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
	public function validation_status() 
	{
		//echo "<pre>"; print_r($this->input->post());die;
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('edu_name', 'edu_name', 'trim|required');
			$this->form_validation->set_rules('inq_st_o_bill_no','Bill No','trim|required');    
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
		$this->data['userid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
		$this->data['datas'] = $this->inquiry_model->get_all_master();
		$this->data['inq_code'] = $this->inquiry_model->get_auto_inq_no();
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
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry functionality");
			redirect(base_url());
		}
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
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Inquiry functionality");
			redirect(base_url());
		}
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

	public function status()
	{
		
		$success = $this->validation_status();

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
				//$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				//$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
   				$array = $this->input->get();
				$lid = $this->inquiry_model->inq_st_log($value);

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
			$this->data['main_content'] = 'Inquiry_status_view';
			$this->data['action'] = "Inquiry/status";
			$this->load->view('includes/template',$this->data);
		}
		//echo "<pre>"; print_r($array); die;
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

	public function get_prcate()
	{
		$value = $this->inquiry_model->get_prcate();
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
							$this->inquiry_model->importcsv($row);
							//echo "<pre>";print_r($row);die;
							if((isset($row['userid'])) && (isset($row['dateinq'])) && (isset($row['calldate'])) && (isset($row['fudate'])) && (isset($row['compnayname'])) && (isset($row['clientname'])) && (isset($row['contactno'])) && (isset($row['contactno2'])) && (isset($row['country'])) && (isset($row['state'])) && (isset($row['city'])) && (isset($row['areaname'])) && (isset($row['proid'])) && (isset($row['producttype'])) && (isset($row['status'])) && (isset($row['executive'])) && (isset($row['source'])) && (isset($row['email'])) && (isset($row['band'])) && (isset($row['age'])) && (isset($row['education'])) && (isset($row['experience'])) && (isset($row['expfiled'])) && (isset($row['relative_in_foreign'])) && (isset($row['countryeligible'])) && (isset($row['refusal'])) && (isset($row['spouseage'])) && (isset($row['spouseageedu'])) && (isset($row['spouseexp'])) && (isset($row['spouseexpfiled'])) && (isset($row['kids'])) && (isset($row['reference'])) && (isset($row['inqtype'])) && (isset($row['remarks'])))
							{
								//echo 'hiiiiiiiii';die;
								//$this->inquiry_model->importcsv($row);
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
	public function reset_inquiry()
	{
		$this->inquiry_model->get_reset();
		redirect(base_url('Inquiry'), 'refresh');
	}

public function datetest()
{
$this->inquiry_model->datetest(); die;
$originalDate = '09-25-2015';
$dateexp = explode('-',$originalDate);
//echo '<pre>';print_r($dateexp);die;
 $finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
//echo $your_date = date("Y-m-d", strtotime($finalformat));die;
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 19,$type);
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

public function xcountry()
{
	$this->inquiry_model->xcountry();
}

public function xstate()
{
	$this->inquiry_model->xstate();
}

public function xcity()
{
	$this->inquiry_model->xcity();
}

public function country_loop()
{
	$this->inquiry_model->country_loop();
}

public function state_loop()
{
	$this->inquiry_model->state_loop();
}

public function city_loop()
{
	$this->inquiry_model->city_loop();
}

public function vidhi_vidhata_loop()
{
	$this->inquiry_model->vidhi_vidhata_loop();
}

public function inqid_inqno()
{
	$this->inquiry_model->inqid_inqno();
}

public function inqid_toinqno()
{
	$this->inquiry_model->inqid_toinqno();
}

public function visitor_tovisitor_visa()
{
	$this->inquiry_model->visitor_tovisitor_visa();
}

public function cat_visitor_tovisitor_visa()
{
	$this->inquiry_model->cat_visitor_tovisitor_visa();
}

public function inq_toonly()
{
	$this->inquiry_model->inq_toonly();
}
public function move_date()
{
	$this->inquiry_model->move_date();
}
public function delete_childdate()
{
	$this->inquiry_model->delete_childdate();
}
	public function ss_google()
{
	$this->inquiry_model->ss_google();
}

public function reset_vfu_pass()
	{
		$this->inquiry_model->reset_vfu_pass();
	}

	public function chg_vfu_email()
	{
		$this->inquiry_model->chg_vfu_email();
	}

	public function store_excel()
	{
		$this->load->helper('download');
		$this->load->library('PHPReport');
		$data = $this->inquiry_model->get_excel_certificate();
		//echo '<pre>';print_r($data);die;
			$template = 'myexcel.xlsx';
			$templateDir = FCPATH."";
			
			$config = array(
			'template' => $template,
			'templateDir' => $templateDir
			);
			//load template
			$R = new PHPReport($config);
			
			$R->load(array(
			'id' => 'student',
			'repeat' => TRUE,
			'data' => $data  
			)
			);
			
			// define output directoy
			$output_file_dir = FCPATH."/tmp/";
			
			
			$output_file_excel = $output_file_dir  . "myexcel.xlsx";
			//download excel sheet with data in /tmp folder
			$result = $R->render('excel', $output_file_excel);
			
			 $file = FCPATH."/tmp/".""."myexcel.xlsx";
			// check file exists    
			if (file_exists ( $file )) {
			 // get file content
			 $data = file_get_contents ( $file );
			 //force download
			 force_download ( "myexcel.xlsx", $data );
			}
		
	}
}?>