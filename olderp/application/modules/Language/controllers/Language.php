<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class language extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
		$this->load->model('language_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
		
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Language VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Language_grid_view';
		$this->load->view('includes/template',$this->data);
		
	}

	public function ajax()
	{
		$user = $this->language_model->get_language();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['lang_id']);//$this->encrypt->encode($user[$i]['lang_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Language/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Language/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['lang_id'].'">',
			  $id,
			  ''.$user[$i]['lang_name'],
			  //''.$user[$i]['language_roe'],
			  ''.date("m-d-Y", strtotime($user[$i]['lang_cdate'])),
			  ''.date("m-d-Y", strtotime($user[$i]['lang_udate'])),
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
	
	public function add()
	{
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Language Add functionality");
			redirect(base_url());
		}

		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['lang_cdate'] = date('Y-m-d H:i:s');
				$value['lang_udate'] = date('Y-m-d H:i:s');
				$value['lang_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				$value['lang_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				$lid = $this->language_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'language added successfully.');
					redirect(base_url('Language'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'language  not added successfully!!');
					redirect(base_url('Language/add'), 'refresh');
				}
			 	redirect(base_url('Language'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Language Edit functionality");
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
				{
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['lang_udate'] = date('Y-m-d H:i:s');
					$value['lang_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				$value['lang_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->language_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'language  edited successfully.');
						redirect(base_url('Language'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'language  not edited successfully!!');
					}
				 	redirect(base_url('Language'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->language_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Language/edit/".$enid;
						$this->data['main_content'] = 'Language_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/language/Language_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'language not Available!!');
						 redirect(base_url('Language'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'language  not Available!!');
					redirect(base_url('Language'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Language'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('lang_name', 'lang_name', 'trim|required');  
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
		$this->data['main_content'] = 'Language_form_view';
		$this->data['action'] = "Language/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Language functionality");
			redirect(base_url());
		}
		
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->language_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->language_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'language  deleted successfully.');
						redirect('Language', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'language  not deleted successfully!!.');
							redirect('Language', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'language not Available!!');
			  		redirect('Language', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'language  not Available!!');
					redirect('Language', 'refresh'); 
			}
			redirect('Language', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Language'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Language functionality");
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
						$this->data['list'] = $this->language_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->language_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'language  deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'language  not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'language not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'language not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Language'), 'refresh');

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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 11,$type);
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
	
	
}?>