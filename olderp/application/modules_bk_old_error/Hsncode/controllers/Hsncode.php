<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsncode extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('hsncode_model');
	//	$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Hsncode VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Hsncode_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->hsncode_model->get_hsncode();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['hsn_id']);
		//$this->encrypt->encode($user[$i]['hsn_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Hsncode/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Hsncode/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$records["data"][] = array(
			 // '<input type="checkbox" name="delid[]" value="'.$user[$i]['hsn_id'].'">',
			  $id,
			  ''.$user[$i]['hsn_hcode'],
			  ''.$user[$i]['hsn_tax'],
			  //''.date("m-d-Y", strtotime($user[$i]['hsncode_cdate'])),
			  ''.date("d-m-Y", strtotime($user[$i]['hsn_udate'])),
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
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Hsncode Add functionality");
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
				$value['hsncode_cdate'] = date('Y-m-d H:i:s');
				$value['hsncode_udate'] = date('Y-m-d H:i:s');
				
				$lid = $this->hsncode_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Hsncode added successfully.');
					redirect(base_url('Hsncode'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Hsncode not added successfully!!');
					redirect(base_url('Hsncode/add'), 'refresh');
				}
			 	redirect(base_url('Hsncode'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Hsncode Edit functionality");
			redirect(base_url());
		}
		//require 'Zebra_Image.php';
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
					$value['hsncode_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->hsncode_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Hsncode edited successfully.');
						redirect(base_url('Hsncode'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Hsncode not edited successfully!!');
					}
				 	redirect(base_url('Hsncode'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->hsncode_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Hsncode/edit/".$enid;
						$this->data['main_content'] = 'Hsncode_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/hsncode/Hsncode_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Hsncode not Available!!');
						 redirect(base_url('Hsncode'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Hsncode not Available!!');
					redirect(base_url('Hsncode'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Hsncode'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('hsncode_name', 'hsncode name', 'trim|required|is_unique[tbl_hsn_code.hsn_hcode]');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('hsncode_name', 'hsncode name', 'trim|required|edit_unique[tbl_hsn_code.hsn_code.'.$idencr.'.hsn_id]');  
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
		//$this->data['gethsncode'] = $this->hsncode_model->addthsncode();
		$this->data['main_content'] = 'Hsncode_form_view';
		$this->data['action'] = "Hsncode/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Hsncode Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->hsncode_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->hsncode_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Hsncode deleted successfully.');
						redirect('Hsncode', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Hsncode not deleted successfully!!.');
							redirect('Hsncode', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Hsncode not Available!!');
			  		redirect('Hsncode', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Hsncode not Available!!');
					redirect('Hsncode', 'refresh'); 
			}
			redirect('Hsncode', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Hsncode'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Hsncode Delete functionality");
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
						$this->data['list'] = $this->hsncode_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->hsncode_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Hsncode deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Hsncode not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Hsncode not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Hsncode not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Hsncode'), 'refresh');

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

	public function setbit_hsncode()
	{
		$this->hsncode_model->setbit_hsncode();
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