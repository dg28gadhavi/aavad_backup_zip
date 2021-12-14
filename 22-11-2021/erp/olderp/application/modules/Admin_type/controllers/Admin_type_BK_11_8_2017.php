<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_type extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_type_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect('login','refresh');
		}
	}
	 
	public function index()
	{
		//$tablename = 'tbl_master_item';
		//$output = $this->crud($tablename);
		$this->data['main_content'] = 'Admin_type_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->admin_type_model->get_admin_type();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['adt_id']);
		$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$id.'">',
			  ''.$user[$i]['adt_name'],
			  '<a href="'.base_url().'admin_type/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>
			  <a href="'.base_url().'admin_type/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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

		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['adt_cdate'] = date('Y-m-d H:i:s');
				$value['adt_udate'] = date('Y-m-d H:i:s');
				$lid = $this->admin_type_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Admin type added successfully.');
					redirect(base_url('Admin_type'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Admin type not added successfully!!');
					redirect(base_url('Admin_type/add'), 'refresh');
				}
			 	redirect(base_url('Admin_type'), 'refresh');
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
					$value['adt_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->admin_type_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Admin_type edited successfully.');
						redirect(base_url('Admin_type'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Admin_type not edited successfully!!');
					}
				 	redirect(base_url('Admin_type'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->admin_type_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Admin_type/edit/".$enid;
						$this->data['main_content'] = 'Admin_type_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/admin_type/Admin_type_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Admin_type not Available!!');
						 redirect(base_url('Admin_type'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Admin_type not Available!!');
					redirect(base_url('Admin_type'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Admin_type'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('adt_name', 'admin type name', 'trim|required');  
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
		$this->data['main_content'] = 'Admin_type_form_view';
		$this->data['action'] = "Admin_type/add";
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
				$this->data['list'] = $this->admin_type_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->admin_type_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Admin type deleted successfully.');
						redirect('Admin_type', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Admin type not deleted successfully!!.');
							redirect('Admin_type', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Admin type not Available!!');
			  		redirect('Admin_type', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Admin type not Available!!');
					redirect('Admin_type', 'refresh'); 
			}
			redirect('Admin_type', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Admin_type'), 'refresh'); 
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
}?>