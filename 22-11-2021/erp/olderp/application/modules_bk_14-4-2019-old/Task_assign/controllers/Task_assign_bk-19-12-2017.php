<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_assign extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('task_assign_model');
		$this->load->library('encrypt');
		$this->load->library('Csvimport');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$this->data['action'] = "Task_assign/add";
		$this->data['main_content'] = 'Task_assign_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->task_assign_model->get_Task_assigns();
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
		
		foreach($user as $i => $vals){
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		
		$idenc = $this->encrypt_decrypt('encrypt',$vals['task_id']);//$this->encrypt->encode($vals['edu_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		if(isset($vals['task_date']) && $vals['task_date'] == '1970-01-01')
		{
			$vals['task_date'] = '';
		}else{
			$vals['task_date'] = date('d-m-Y', strtotime($vals['task_date']));
		}
		if(isset($vals['task_when']) && $vals['task_when'] == '1970-01-01')
		{
			$vals['task_when'] = '';
		}else{
			$vals['task_when'] = date('d-m-Y', strtotime($vals['task_when']));
		}
		if(isset($vals['task_comp_dt']) && $vals['task_comp_dt'] == '1970-01-01')
		{
			$vals['task_comp_dt'] = '';
		}else{
			$vals['task_comp_dt'] = date('d-m-Y', strtotime($vals['task_comp_dt']));
		}
		if(isset($vals['task_cdate']) && ($vals['task_cdate'] == '1970-01-01' || $vals['task_cdate'] == '0000-00-00'))
		{
			$vals['task_cdate'] = '';
		}else{
			$vals['task_cdate'] = date('d-m-Y', strtotime($vals['task_cdate']));
		}
		if(isset($vals['task_udate']) && ($vals['task_udate'] == '1970-01-01' || $vals['task_udate'] == '0000-00-00'))
		{
			$vals['task_udate'] = '';
		}else{
			$vals['task_udate'] = date('d-m-Y', strtotime($vals['task_udate']));
		}
		if(isset($vals['task_priority']) && $vals['task_priority'] == 0)
		{
			$vals['task_priority'] = '';
		}
		$records["data"][] = array(
			 '<input type="checkbox" name="id[]" value="'.$idenc.'">',
			 $id,
			''.$vals['task_desc'],
			''.$vals['by'],
			''.$vals['to'],
			''.$vals['task_date'],
			''.$vals['task_when'],
			''.$vals['task_comp_dt'],
			''.$vals['task_priority'],
			''.$vals['status'],
			''.$vals['task_cdate'],
			''.$vals['task_udate'],
			//''.$vals['pro_des'],
			  '<a href="'.base_url().'Task_assign/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a> <a href="'.base_url().'Task_assign/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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

	public function ajax_report()
	{
		$user = $this->task_assign_model->get_Task_assigns();
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
		
		foreach($user as $i => $vals){
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		
		$idenc = $this->encrypt_decrypt('encrypt',$vals['task_id']);//$this->encrypt->encode($vals['edu_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			 '<input type="checkbox" name="id[]" value="'.$idenc.'">',
			 $id,
			''.$vals['task_desc'],
			//''.$vals['pro_des'],
			  '<a href="'.base_url().'Task_assign/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a> <a href="'.base_url().'Task_assign/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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
	
	public function report()
	{
		$this->data['main_content'] = 'Task_assign_report';
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
				$value['task_cdate'] = date('Y-m-d H:i:s');
				$value['task_udate'] = date('Y-m-d H:i:s');
				$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				if(isset($_FILES['Task_assign_img']['name']) && ($_FILES['Task_assign_img']['name'] != '')){
					$folder_name = "Task_assign_img";
					$file_type = "Task_assign_img";
					$image = $this->do_upload_image($folder_name,$file_type,$width=450,$height=450);
					$value['Task_assign_img'] = $image['upload_data']['file_name'];
					//echo "<pre>"; print_r($value['user_file']); die;
				}
				$lid = $this->task_assign_model->add($value);
 				//echo '<pre>';print_r($lid);die;
				
				if($lid)
				{
					$this->session->set_flashdata('success', 'Task_assign added successfully.');
					redirect(base_url('Task_assign'), 'refresh');
				}else{
					$this->session->set_flashdata('success', 'Task_assign  added successfully!!');
					redirect(base_url('Task_assign'), 'refresh');
				}
			 	redirect(base_url('Task_assign'), 'refresh');
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
				{
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['task_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					if(isset($_FILES['Task_assign_img']['name']) && ($_FILES['Task_assign_img']['name'] != '')){
					$folder_name = "Task_assign_img";
					$file_type = "Task_assign_img";
					$image = $this->do_upload_image($folder_name,$file_type,$width=450,$height=450);
					$value['Task_assign_img'] = $image['upload_data']['file_name'];
					//echo "<pre>"; print_r($value['user_file']); die;
					}
					
					$lid = $this->task_assign_model->edit($value,$idencr);
					
					if($lid)
					{
						$this->session->set_flashdata('success', 'Task_assign edited successfully.');
						redirect(base_url('Task_assign'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Task_assign not edited successfully!!');
					}
				 	redirect(base_url('Task_assign'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->task_assign_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['languages'] = $this->task_assign_model->get_language();
						$this->data['userid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
						$this->data['session'] = $this->task_assign_model->get_session($this->data['userid']);
						$this->data['users'] = $this->task_assign_model->get_admins();	
						$this->data['action'] = "Task_assign/edit/".$enid;
						$this->data['main_content'] = 'Task_assign_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/country/Country_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Task_assign not Available!!');
						 redirect(base_url('Task_assign'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Task_assign not Available!!');
					redirect(base_url('Task_assign'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task_assign'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		//echo "<pre>"; print_r($this->input->post());die;
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('edu_name', 'edu_name', 'trim|required');
			$this->form_validation->set_rules('task_desc','Task Description Name','trim|required');    
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
		//$this->data['countries'] = $this->task_assign_model->get_country();
		$this->data['languages'] = $this->task_assign_model->get_language();
		$this->data['session'] = $this->task_assign_model->get_session($this->data['userid']);
		//echo "<pre>"; print_r($this->data['session']); die;
		$this->data['users'] = $this->task_assign_model->get_admins();
		$this->data['main_content'] = 'Task_assign_form_view';
		$this->data['action'] = "Task_assign/add";
		$this->load->view('includes/template',$this->data);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}

	public function delete($id=false)
	{
		// $right_status = $this->check_rights('delete');
		// if($right_status == false)
		// {
		// 	$this->session->set_flashdata('rights_error', "You Don't have rights to access Task_assign functionality");
		// 	redirect(base_url());
		// }
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->task_assign_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->task_assign_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Task_assign  deleted successfully.');
						redirect('Task_assign', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Task_assign  not deleted successfully!!.');
							redirect('Task_assign', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Task_assign not Available!!');
			  		redirect('Task_assign', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Task_assign  not Available!!');
					redirect('Task_assign', 'refresh'); 
			}
			redirect('Task_assign', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task_assign'), 'refresh'); 
		}
	}


	public function delete_all()
	{
		// $right_status = $this->check_rights('delete');
		// if($right_status == false)
		// {
		// 	$this->session->set_flashdata('rights_error', "You Don't have rights to access Task_assign functionality");
		// 	redirect(base_url());
		// }
		//echo '<pre>';print_r($this->input->get('delid'));die;
		if($this->input->get('delid') && is_array($this->input->get('delid')) && !empty($this->input->get('delid')))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->task_assign_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->task_assign_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Task_assign  deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Task_assign  not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Task_assign not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Task_assign not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Task_assign'), 'refresh');

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
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name'] = $image_name;
		$config['overwrite'] = TRUE;
		$config['max_size']	= '0';
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
	

	
}?>