<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weeklytour extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('weeklytour_model');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect('admin/login','refresh');
		}
	}
	public function index()
	{
		//$tablename = 'tbl_master_item';
		//$output = $this->crud($tablename);
		// $this->data['list'] = $this->weeklytour_model->get_today();
		// parent::load_view('admin/master/weeklytour/weeklytour_grid_view', $this->data);
	}
	public function tour()
	{
		$this->data['list'] = $this->weeklytour_model->get_today();
		$this->data['main_content'] = 'Weeklytour_grid_view';
		$this->load->view('includes/template',$this->data);
	}
	public function ajax()
	{
		$user = $this->weeklytour_model->get_weeklytour();
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
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$id.'">',
			  $id,
			  ''.$user[$i]['weeklytour_name'],
			  ''.$user[$i]['weeklytour_roe'],
			  ''.$user[$i]['weeklytour_cdate'],
			  ''.$user[$i]['weeklytour_udate'],
			  '<a href="'.base_url().'admin/weeklytour/edit?id='.$user[$i]['weeklytour_id'].'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>',
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
	
	public function weekly_tour()
	{
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['weeklytour_cdate'] = date('Y-m-d H:i:s');
				$value['weeklytour_udate'] = date('Y-m-d H:i:s');
				$lid = $this->weeklytour_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'weeklytour added successfully.');
					redirect(base_url('Weeklytour'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'weeklytour not added successfully!!');
					redirect(base_url('Weeklytour'), 'refresh');
				}
			 	redirect(base_url('Weeklytour'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function edit()
	{
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				//echo '<pre>';print_r($this->input->post());die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['weeklytour_udate'] = date('Y-m-d H:i:s');
				$lid = $this->weeklytour_model->edit($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'weeklytour edited successfully.');
					redirect(base_url('admin/weeklytour'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'weeklytour not edited successfully!!');
				}
			 	redirect(base_url('admin/weeklytour'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$id = $this->input->get('id');
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->weeklytour_model->get();
				if(!empty($this->data['list']))
				{
					$this->data['action'] = "admin/weeklytour/edit?id=".$this->input->get('id');
					parent::load_view('admin/master/weeklytour/weeklytour_form_view',$this->data);
				}
				else
				{
					 $this->session->set_flashdata('error', 'weeklytour not Available!!');
					 redirect(base_url('admin/weeklytour'), 'refresh'); 
				}
			}
			else{
				$this->session->set_flashdata('error', 'weeklytour not Available!!');
				redirect(base_url('admin/weeklytour'), 'refresh'); 
			}
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('weeklytour_name', 'weeklytour_name', 'trim|required');  
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
		$this->data['main_content'] = 'Weeklytour_form_view';
		$this->data['action'] = "Weeklytour/weekly_tour";
		$this->load->view('includes/template',$this->data);
	}

	function insert_slot(){
		//echo "<pre>";print_r(var_dump($_POST,$_GET));
		//die;
		
		$time    = $this->input->post('start_dt');
		$time_end    = $this->input->post('end_date');
		//$prac_id = $this->input->post('prac_id');
		//$doc_id  = $this->input->post('doc_id'); 
		//die;

		$date = strtotime($time);
		$hour = date('H', $date);

		$date_end = strtotime($time_end);
		$hour_end = date('H', $date_end);

		if($hour < 12){ 
			$set_hour = 1; 
		} elseif($hour < 17) { 
			$set_hour = 2; 
		} else { 
			$set_hour = 3; 
		}

		if($hour_end < 12){ 
			$set_hour_end = 1; 
		} elseif($hour_end < 17) { 
			$set_hour_end = 2; 
		} else { 
			$set_hour_end = 3; 
		}
		
		$value = array();
		$value = $this->input->post();
		
		//if($check_insert_availability == 0){
			$this->weeklytour_model->insert_appt_slot($value);	
			echo 'success';die;
		//} else {
		//	echo $check_insert_availability;
		//}
	}

	public function get_all_slots()
	{
		$this->weeklytour_model->select_appt_slot();
	}

	public function del_slot(){
		$id   = $this->input->post('appoint_id');
		$this->weeklytour_model->delelte_slot($id);
	}

	public function check_updation(){
		$id   = $this->input->post('edit_id');
		$this->weeklytour_model->check_update_availability($id);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}
	public function get_grid_report()
	{
		//echo 'hiiiiii';die;
		$this->data['grid'] = $this->weeklytour_model->get_grid_report();
		$this->data['tour'] = $this->weeklytour_model->get_cust();
		parent::load_view('admin/master/weeklytour/weeky_tour_grid_report',$this->data);
	}
  //   public function get_filter()
  //   {
  //   	$this->data['filter'] = $this->weeklytour_model->get_filter();
		// parent::load_view('admin/master/weeklytour/weeky_tour_grid_report',$this->data);
  //   }
	public function ajax_weekly_report()
	{
		$user = $this->weeklytour_model->get_grid_report();
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
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			  $id,
			  ''.$user[$i]['wt_district'],
			  ''.$user[$i]['wt_city'],
			  ''.$user[$i]['wt_customer'],
			  ''.$user[$i]['wt_remark'],
			  ''.date("d-m-Y s:i:h", strtotime($user[$i]['wt_startdate'])),
			  ''.date("d-m-Y s:i:h", strtotime($user[$i]['wt_enddate'])),
			  '',
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
}?>