<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_users extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
		$this->load->model('admin_users_model');
		$this->load->library('encryption');
		$this->load->library('csvimport');
		$this->load->library('form_validation');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect('admin/login','refresh');
		}
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Admin View Functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Admin_users_grid_view';
		$this->load->view('includes/template',$this->data);
		
	}

	public function ajax()
	{
		$user = $this->admin_users_model->get_admin_users();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['au_id']);//$this->encrypt->encode($user[$i]['au_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['au_id'].'">',
			  $id,
			  ''.$user[$i]['au_fname'],
			  ''.$user[$i]['au_lname'],
			  ''.$user[$i]['au_address'],
			  ''.$user[$i]['au_mo_no'],
			  ''.$user[$i]['au_email'],
			  ''.$user[$i]['dep_name'],
			 // ''.date("m-d-Y", strtotime($user[$i]['au_cdate'])),
			  ''.date("m-d-Y", strtotime($user[$i]['au_udate'])),
			  '<a href="'.base_url().'Admin_users/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>
			  <a href="'.base_url().'Admin_users/retype_password/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-key"></i></a> 
			  <a href="'.base_url().'Admin_users/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>',
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
	public function admin_seting()
	{
		if($this->input->post() && $this->input->post('group_id'))
		{
			//echo '<pre>';print_r($this->input->post());die;
			$this->session->userdata['miconlogin']['all_users'] = $this->input->post('group_id');
			$this->session->set_flashdata('success', 'Setting Updated successfully.');
			redirect(base_url('Admin_users/admin_seting'), 'refresh');
		}
		else
		{
			if(isset($this->session->userdata['miconlogin']['session_users']) && is_array($this->session->userdata['miconlogin']['session_users']) && !empty($this->session->userdata['miconlogin']['session_users']))
			{
			    //$this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
				$this->data['user_details'] = $this->admin_users_model->setting_user($this->session->userdata['miconlogin']['session_users']);
			}else{
			    $this->data['user_details'] = array();
			}
			$this->data['action'] = base_url()."Admin_users/admin_seting";
			$this->data['main_content'] = 'Admin_users_setings';
			$this->load->view('includes/template',$this->data);
		}
	}	
	
	public function add()
	{
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Admin Add Functionality");
			redirect(base_url());
		}

		require 'Zebra_Image.php';
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				//echo "<pre>"; print_r($this->input->post()); die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['au_cdate'] = date('Y-m-d H:i:s');
				$value['au_udate'] = date('Y-m-d H:i:s');
				//$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				//$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				if(isset($_FILES['au_photo']['name']) && ($_FILES['au_photo']['name'] != '')){
					$folder_name = "au_photo";
					$file_type = "au_photo";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['au_photo'] = $image['upload_data']['file_name'];
				}
				$lid = $this->admin_users_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Admin user added successfully.');
					redirect(base_url('Admin_users'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Admin user  not added successfully!!');
					redirect(base_url('Admin_users/add'), 'refresh');
				}
			 	redirect(base_url('Admin_users'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Admin Edit Functionality");
			redirect(base_url());
		}
		require 'Zebra_Image.php';
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
					$value['au_udate'] = date('Y-m-d H:i:s');
					//$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				   //$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					if(isset($_FILES['au_photo']['name']) && ($_FILES['au_photo']['name'] != '')){
					$folder_name = "au_photo";
					$file_type = "au_photo";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['au_photo'] = $image['upload_data']['file_name'];
					}
					$lid = $this->admin_users_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->userdata['miconlogin']['colorcode'] = $value['aus_color'];
						$this->session->set_flashdata('success', 'Admin user  edited successfully.');
						redirect(base_url('Admin_users/edit/'.$this->uri->segment(3)), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Admin user  not edited successfully!!');
					}
				 	redirect(base_url('Admin_users/edit/'.$this->uri->segment(3)), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->admin_users_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['admin'] = $this->admin_users_model->get_admin_user();
						$this->data['master'] = $this->admin_users_model->get_master();
						$this->data['countries'] = $this->admin_users_model->get_country();
						$this->data['admin_types'] = $this->admin_users_model->get_admin_types();
		                $this->data['cities'] = $this->admin_users_model->get_city();
						$this->data['action'] = "Admin_users/edit/".$enid;
						$this->data['main_content'] = 'Admin_users_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/admin_users/Admin_users_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Admin user not Available!!');
						 redirect(base_url('Admin_users'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Admin user  not Available!!');
					redirect(base_url('Admin_users'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Admin_users'), 'refresh'); 
		}
	}

	public function retype_password()
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
					$value['au_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$validuser = $this->admin_users_model->checkuser($value,$idencr);
					
					if($validuser == TRUE)
					{ 
						$this->admin_users_model->edit_password($value,$idencr);
						$this->session->set_flashdata('success', 'Reset Password Successfully....!');
						redirect(base_url('Admin_users'), 'refresh');	
					}
					if($validuser == FALSE)
					{
						$this->session->set_flashdata('error', 'User Already Exist....!');
						redirect(base_url('Admin_users/retype_password/'.$enid), 'refresh');	
					}
				}
			}
			if($success == FALSE)
			{
				$this->data['list'] = $this->admin_users_model->get($idencr);
				$this->data['main_content'] = 'Admin_retype_form_view';
				$this->data['action'] = "Admin_users/retype_password/".$enid;
				$this->load->view('includes/template',$this->data);
			}
		}
	}
	
	public function retype_user_password()
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
					$value['au_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$validuser = $this->admin_users_model->checkuser($value,$idencr);
					
					if($validuser == TRUE)
					{ 
						$this->admin_users_model->edit_password($value,$idencr);
						$this->session->set_flashdata('success', 'Reset Password Successfully....!');
						redirect(base_url('User'), 'refresh');	
					}
					if($validuser == FALSE)
					{
						$this->session->set_flashdata('error', 'User Already Exist....!');
						redirect(base_url('Admin_users/retype_user_password/'.$enid), 'refresh');	
					}
				}
			}
			if($success == FALSE)
			{
				$this->data['list'] = $this->admin_users_model->get($idencr);
				$this->data['main_content'] = 'Admin_retype_form_view';
				$this->data['action'] = "Admin_users/retype_user_password/".$enid;
				$this->load->view('includes/template',$this->data);
			}
		}
	}
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('au_email', 'Email Id All Ready Used', 'trim|required|is_unique[tbl_admin_users.au_email]');
				$this->form_validation->set_rules('au_fname', 'au_fname', 'trim|required');
				$this->form_validation->set_rules('au_password', 'Password', 'trim|required');
				$this->form_validation->set_rules('confirmpwd', 'Password Confirmation', 'trim|required|matches[confirmpwd]');   
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('au_email', 'User email id', 'trim|required|edit_unique[tbl_admin_users.au_email.'.$idencr.'.au_id]'); 
				//$this->form_validation->set_rules('au_password', 'Password', 'trim|required');
				//$this->form_validation->set_rules('confirmpwd', 'Password Confirmation', 'trim|required|matches[au_password]');     
			}else if($this->uri->segment(2) == 'retype_password'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('au_email', 'au_email', 'trim|required');  
				$this->form_validation->set_rules('au_password', 'Password', 'trim|required|matches[confirmpwd]'); 
				$this->form_validation->set_rules('confirmpwd', 'Retype Password', 'trim|required'); 
			}else if($this->uri->segment(2) == 'retype_user_password'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('au_email', 'au_email', 'trim|required');  
				$this->form_validation->set_rules('au_password', 'Password', 'trim|required|matches[confirmpwd]'); 
				$this->form_validation->set_rules('confirmpwd', 'Retype Password', 'trim|required'); 
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
	// public function retype_validation() 
	// {
	// 	if($this->input->post(NULL,TRUE))
	// 	{ 
	// 		$this->load->library('form_validation');
	// 		if($this->uri->segment(2) == 'retype_password'){
	// 		$reid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
	// 		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $reid) : '';
	// 		$this->form_validation->set_rules('au_email', 'au_email', 'trim|required|xss_clean');  
	// 		$this->form_validation->set_rules('au_password', 'Password', 'trim|required|xss_clean'); 
	// 		$this->form_validation->set_rules('au_repassword', 'Retype Password', 'trim|required|xss_clean'); 
	// 	}
	// 	else{
	// 	}
	// 	   if($this->form_validation->run() == TRUE)
	// 	   {
	// 		 return TRUE;
	// 	   }
	// 	   else
	// 	   {
	// 		 return FALSE;
	// 	   }	
	// 	}
	// }

	
	public function get_form()
	{
		$this->data['master'] = $this->admin_users_model->get_master();
		$this->data['admin_types'] = $this->admin_users_model->get_admin_types();
		//echo "<pre>"; print_r($this->data['master']); die;
		$this->data['countries'] = $this->admin_users_model->get_country();
		$this->data['cities'] = $this->admin_users_model->get_city();
		$this->data['admin'] = $this->admin_users_model->get_admin_user();
		$this->data['main_content'] = 'Admin_users_form_view';
		$this->data['action'] = "Admin_users/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access  Admin Delete functionality");
			redirect(base_url());
		}
		
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->admin_users_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->admin_users_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Admin user  deleted successfully.');
						redirect('Admin_users', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Admin user  not deleted successfully!!.');
							redirect('Admin_users', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Admin user not Available!!');
			  		redirect('Admin_users', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Admin user  not Available!!');
					redirect('Admin_users', 'refresh'); 
			}
			redirect('Admin_users', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Admin_users'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access  Admin Delete functionality");
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
						$this->data['list'] = $this->admin_users_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->admin_users_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Admin user  deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Admin user  not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Admin user not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Admin user not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Admin_users'), 'refresh');

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
		$config['allowed_types'] = 'gif|jpg|png';
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

	public function get_states()
	{
		$id = $this->input->post('country_id');
		$states = $this->admin_users_model->get_states($id);
		echo json_encode($states);
	}
	public function get_cities()
	{
		$id = $this->input->post('state_id');
		$states = $this->admin_users_model->get_cities($id);
		echo json_encode($states);
	}
	public function get_areas()
	{
		$id = $this->input->post('city_id');
		$states = $this->admin_users_model->get_areas($id);
		echo json_encode($states);
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 1,$type);
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

		public function csvimport()
	{
		//echo "hi";die;
		$this->data['main_content'] = 'Importcsv_view';
		$this->data['action'] = "Admin_users/importcsv";
		$this->load->view('includes/template',$this->data);
	}

	public function importcsv() 
  	{		//echo "fhjfkhdsfjk";die;
		if(isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != ''))
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
				//echo"<pre>";print_r($data);die;
				$this->data['main_content'] = 'Importcsv_view';
				$this->data['action'] = "Admin_users/importcsv";
				$this->load->view('includes/template',$this->data);
			}else 
			{
				$file_data = $this->upload->data();
				$file_path =  './uploads/csv/'.$file_data['file_name'];
				//echo "<pre>"; print_r($this->csvimport->get_array($file_path));die;
				if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					if(is_array($csv_array) && !empty($csv_array))
					{
						foreach ($csv_array as $row)
						{
							$this->admin_users_model->importcsv($row);
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Admin_users'), 'refresh');
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['main_content'] = 'importcsv_view';
					$this->data['action'] = "Admin_users/importcsv";
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['main_content'] = 'importcsv_view';
			$this->data['action'] = "Admin_users/importcsv";
			$this->load->view('includes/template',$this->data);
		}

    }

    public function setid_user()
    {
    	$this->admin_users_model->setid_user();
    	echo "done";
    }
	
	
}?>