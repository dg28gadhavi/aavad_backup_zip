<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class education extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
		$this->load->model('education_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect('admin/login','refresh');
		}
	}
	 
	public function index()
	{
		$this->data['main_content'] = 'Education_grid_view';
		$this->load->view('includes/template',$this->data);
		
	}

	public function ajax()
	{
		$user = $this->education_model->get_education();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['edu_id']);//$this->encrypt->encode($user[$i]['edu_is_delete']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			  '<input type="checkbox" name="delid[]" value="'.$user[$i]['edu_id'].'">',
			  $id,
			  ''.$user[$i]['edu_name'],
			  //''.$user[$i]['education_roe'],
			  ''.date("m-d-Y", strtotime($user[$i]['edu_cdate'])),
			  ''.date("m-d-Y", strtotime($user[$i]['edu_udate'])),
			  '<a href="'.base_url().'Education/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>
			  <a href="'.base_url().'Education/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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
				$value['edu_cdate'] = date('Y-m-d H:i:s');
				$value['edu_udate'] = date('Y-m-d H:i:s');
				$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				$lid = $this->education_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Education added successfully.');
					redirect(base_url('Education'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Education  not added successfully!!');
					redirect(base_url('Education/add'), 'refresh');
				}
			 	redirect(base_url('Education'), 'refresh');
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
					$value['edu_udate'] = date('Y-m-d H:i:s');
					$value['edu_adid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
   				$value['edu_atype'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->education_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Education  edited successfully.');
						redirect(base_url('Education'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Education  not edited successfully!!');
					}
				 	redirect(base_url('Education'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->education_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Education/edit/".$enid;
						$this->data['main_content'] = 'Education_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/education/Education_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Education not Available!!');
						 redirect(base_url('Education'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Education  not Available!!');
					redirect(base_url('Education'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Education'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('edu_name', 'edu_name', 'trim|required');  
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
		$this->data['main_content'] = 'Education_form_view';
		$this->data['action'] = "Education/add";
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
				$this->data['list'] = $this->education_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->education_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Education  deleted successfully.');
						redirect('education', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Education  not deleted successfully!!.');
							redirect('education', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Education not Available!!');
			  		redirect('education', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Education  not Available!!');
					redirect('education', 'refresh'); 
			}
			redirect('education', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Education'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		//echo '<pre>';print_r($this->input->get('delid'));die;
		if($this->input->get('delid') && is_array($this->input->get('delid')) && !empty($this->input->get('delid')))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->education_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->education_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Education  deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Education  not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Education not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Education not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Education'), 'refresh');

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