<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller 
{
	public function __construct()
	{

		parent::__construct();
		$this->load->model('Calendar_model');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect(base_url(),'refresh');
		}
	}
	public function index()
	{
		//$tablename = 'tbl_master_item';
		//$output = $this->crud($tablename);
		// $this->data['list'] = $this->Calendar_model->get_today();
		// parent::load_view('admin/master/calendar/calendar_grid_view', $this->data);
	}
	public function tour()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task_type VIew functionality");
			redirect(base_url());
		}
		$this->data['list'] = $this->Calendar_model->get_today();
		$this->data['task_type'] = $this->Calendar_model->get_task();
		$this->data['assign'] = $this->Calendar_model->get_assign();
		$this->data['total_count'] = $this->Calendar_model->get_count();
		$this->data['main_content'] = 'Calendar_grid_view';
		$this->load->view('includes/template',$this->data);
	}
	public function ajax()
	{
		$user = $this->Calendar_model->get_calendar();
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
			  ''.$user[$i]['calendar_name'],
			  ''.$user[$i]['calendar_roe'],
			  ''.$user[$i]['calendar_cdate'],
			  ''.$user[$i]['calendar_udate'],
			  '<a href="'.base_url().'admin/calendar/edit?id='.$user[$i]['calendar_id'].'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>',
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
	public function load_pdf()
	{
		$value=array();
		$value = $this->input->get();
		//***********PDF File Code Start********************
				$pdfdata = $this->Calendar_model->get_pdfdata($value);
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Calendar/Calendar_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'pdf/task/task'.$this->session->userdata['miconlogin']['userid'].'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
			    $pdf->Output($pdfFilePath, 'F');
			   redirect(base_url('/pdf/task/task'.$this->session->userdata['miconlogin']['userid'].'.pdf'), 'refresh');
				//***********PDF File Code End********************
	}
	
	// public function weekly_tour()
	// {

	// 	$success = $this->validation();
		
	// 	if($success == TRUE)
	// 	{
	// 		if($this->input->post(NULL,FALSE))
	// 		{
	// 			$value = array();
	// 			$value = $this->input->post(NULL,FALSE);
	// 			$value = $this->security->xss_clean($value);
	// 			$value['calendar_cdate'] = date('Y-m-d H:i:s');
	// 			$value['calendar_udate'] = date('Y-m-d H:i:s');
	// 			$lid = $this->Calendar_model->add($value);
	// 			if($lid)
	// 			{
	// 				$this->session->set_flashdata('success', 'calendar added successfully.');
	// 				redirect(base_url('admin/calendar'), 'refresh');
	// 			}else{
	// 				$this->session->set_flashdata('error', 'calendar not added successfully!!');
	// 				redirect(base_url('admin/calendar/weekly_tour'), 'refresh');
	// 			}
	// 		 	redirect(base_url('admin/calendar'), 'refresh');
	// 		}
	// 	}
	// 	if($success == FALSE)
	// 	{
	// 		$this->get_form();
	// 	}
	// }

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
				$value['calendar_udate'] = date('Y-m-d H:i:s');
				$lid = $this->Calendar_model->edit($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'calendar edited successfully.');
					redirect(base_url('admin/calendar'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'calendar not edited successfully!!');
				}
			 	redirect(base_url('admin/calendar'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$id = $this->input->get('id');
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Calendar_model->get();
				if(!empty($this->data['list']))
				{
					$this->data['action'] = "admin/calendar/edit?id=".$this->input->get('id');
					parent::load_view('admin/master/calendar/calendar_form_view',$this->data);
				}
				else
				{
					 $this->session->set_flashdata('error', 'calendar not Available!!');
					 redirect(base_url('admin/calendar'), 'refresh'); 
				}
			}
			else{
				$this->session->set_flashdata('error', 'calendar not Available!!');
				redirect(base_url('admin/calendar'), 'refresh'); 
			}
		}
	}
	
	public function validation() 
	{
		//die();
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('calendar_name', 'calendar_name', 'trim|required|xss_clean');  
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
		
		$this->data['main_content'] = 'calendar_form_view';
		$this->data['action'] = "Calendar/weekly_tour";
		$this->load->view('includes/template',$this->data);
	}

	function insert_slot()
	{
		//echo "<pre>";print_r(var_dump($_FILES,$_POST));die;
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
		$imagenames = $this->multiple_image_upload();
		$value['files'] = $imagenames;
		//echo "<pre>";print_r($value);die;
		//if($check_insert_availability == 0){
			$this->Calendar_model->insert_appt_slot($value);	
			echo 'success';die;
		//} else {
		//	echo $check_insert_availability;
		//}
	}

	function get_all_slots(){
		$this->Calendar_model->select_appt_slot();
	}

	function del_slot()
	{
		$id = $this->input->post('appoint_id');
		$this->Calendar_model->delelte_slot($id);
	}

	function del_files()
	{
		$id = $this->input->post('idval');
		$this->Calendar_model->delelte_files($id);
	}

	function check_updation(){
		$id   = $this->input->post('edit_id');
		$this->Calendar_model->check_update_availability($id);
	}

	function change_dates()
	{
		$value = array();
		$value   = $this->input->post();
		$this->Calendar_model->change_dates($value);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}
	public function get_grid_report()
	{
		//echo 'hiiiiii';die;
		$this->data['grid'] = $this->Calendar_model->get_grid_report();
		$this->data['tour'] = $this->Calendar_model->get_cust();
		parent::load_view('admin/master/calendar/weeky_tour_grid_report',$this->data);
	}
  //   public function get_filter()
  //   {
  //   	$this->data['filter'] = $this->Calendar_model->get_filter();
		// parent::load_view('admin/master/calendar/weeky_tour_grid_report',$this->data);
  //   }
	public function ajax_weekly_report()
	{
		$user = $this->Calendar_model->get_grid_report();
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

	public function multiple_image_upload()
	{
		$valid_formats = array("jpg","JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "bmp", "BMP","pdf");
		$max_file_size = 1024*100000000; //100 kb
		//echo $path = base_url()."/uploads/product_images/"; // Upload directory
		//echo $path = $_SERVER['DOCUMENT_ROOT'];exit;
		//$path = $_SERVER['DOCUMENT_ROOT']."/miconindia.com/uploads/product_images/";
		$path = 'uploads/task_file/'; 
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
						if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$randomString.'-Name-'.$name))
						$imagearray[$f] = $randomString.'-Name-'.$name;
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

	public function get_datewise_events()
	{
		$value = array();
		$value   = $this->input->post();
		$result = $this->Calendar_model->get_datewise_events($value);
		echo json_encode($result);
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 33,$type);
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
}?>