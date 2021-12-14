<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_management extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
		$this->load->model('role_management_model');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		
	}
	 
	public function index()
	{
		//$tablename = 'tbl_master_item';
		//$output = $this->crud($tablename);
		$this->data['main_content'] = 'Role_management_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	
	public function add()
	{

		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				//echo "<pre>"; print_r($this->input->post()); die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['rights_cdate'] = date('Y-m-d H:i:s');
				$value['rights_udate'] = date('Y-m-d H:i:s');
				$value['rights_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
				$value['rights_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				$lid = $this->role_management_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Role_management added successfully.');
					redirect(base_url('Role_management'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Role_management not added successfully!!');
					redirect(base_url('Role_management/add'), 'refresh');
				}
			 	redirect(base_url('Role_management'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function ajax()
	{
		$user = $this->role_management_model->get_all_right();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['rights_id']);
		$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$id.'">',
			  ''.$user[$i]['rights_name'],
			  '<a href="'.base_url().'Role_management/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>
			  <a href="'.base_url().'Role_management/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>',
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

	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('rolename', 'role management name', 'trim|required');  
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
		$this->data['datas'] = $this->role_management_model->get_module();
		$this->data['main_content'] = 'Role_management_form_view';
		$this->data['action'] = "Role_management/add";
		$this->load->view('includes/template',$this->data);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
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
					//echo "<pre>"; print_r($this->input->post()); die;
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					//echo "<pre>"; print_r($value); die;
					$value = $this->security->xss_clean($value);
					$value['rights_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$value['rights_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
					$value['rights_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
					$lid = $this->role_management_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Role management edited successfully.');
						redirect(base_url('Role_management'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Role management not edited successfully!!');
					}
				 	redirect(base_url('Role_management'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->role_management_model->get_right($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						$this->data['datas'] = $this->role_management_model->get_module($idencr);
						$this->data['action'] = "Role_management/edit/".$enid;
						$this->data['main_content'] = 'Role_management_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Role management not Available!!');
						 redirect(base_url('Role_management'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Role management not Available!!');
					redirect(base_url('Role_management'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Role_management'), 'refresh'); 
		}
	}

	public function delete($id=false)
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->role_management_model->get_all_right($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->role_management_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Role_management deleted successfully.');
						redirect('Role_management', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Role_management not deleted successfully!!.');
							redirect('Role_management', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Role_management not Available!!');
			  		redirect('Role_management', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Role_management not Available!!');
					redirect('Role_management', 'refresh'); 
			}
			redirect('Role_management', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Role_management'), 'refresh'); 
		}
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
}?>