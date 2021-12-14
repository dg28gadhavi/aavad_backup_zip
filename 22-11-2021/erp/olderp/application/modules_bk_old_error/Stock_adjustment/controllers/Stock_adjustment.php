<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_adjustment extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
			redirect(base_url().'login');
			}
		$this->load->model('Stock_adjustment_model');
		$this->load->library('encrypt');
		$this->load->library('csvimport');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Stock_adjustment VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Stock_adjustment_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Stock_adjustment_model->get_Stock_adjustment();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['Stock_adjustment_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Stock_adjustment/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Stock_adjustment/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$id.'">',
			  $id,
			  ''.$user[$i]['Stock_adjustment_name'],
			  ''.$user[$i]['state_name'],
			  ''.$user[$i]['country_name'],
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Stock_adjustment Add functionality");
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
				$value['Stock_adjustment_cdate'] = date('Y-m-d H:i:s');
				$value['Stock_adjustment_udate'] = date('Y-m-d H:i:s');
				$lid = $this->Stock_adjustment_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Stock added successfully.');
					redirect(base_url('Stock_adjustment/add'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Stock_adjustment not added successfully!!');
					redirect(base_url('Stock_adjustment/add'), 'refresh');
				}
			 	redirect(base_url('Stock_adjustment/add'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Stock_adjustment Edit functionality");
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
					$value['state_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->Stock_adjustment_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Stock_adjustment edited successfully.');
						redirect(base_url('Stock_adjustment'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Stock_adjustment not edited successfully!!');
					}
				 	redirect(base_url('Stock_adjustment'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Stock_adjustment_model->get($idencr);
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						//echo "<pre>"; print_r($this->data['list']); die;
						$this->data['states'] = $this->Stock_adjustment_model->get_state($this->data['list'][0]['Stock_adjustment_country']);
						$this->data['country'] = $this->Stock_adjustment_model->get_country();
						$this->data['action'] = "Stock_adjustment/edit/".$enid;
						$this->data['main_content'] = 'Stock_adjustment_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Stock_adjustment not Available!!');
						 redirect(base_url('Stock_adjustment'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Stock_adjustment not Available!!');
					redirect(base_url('Stock_adjustment'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Stock_adjustment'), 'refresh'); 
		}
	}

	public function outward()
	{
		
				$value = array();
				$value['Stock_adjustment_cdate'] = date('Y-m-d H:i:s');
				$value['Stock_adjustment_udate'] = date('Y-m-d H:i:s');
				$lid = $this->Stock_adjustment_model->outward($value);
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('sqi_itm_pno', 'Stock_adjustment name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('Stock_adjustment_name', 'Stock_adjustment name', 'trim|required|edit_unique[tbl_master_Stock_adjustment.Stock_adjustment_name.'.$idencr.'.Stock_adjustment_id]');  
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
		//$this->data['getStock_adjustment'] = $this->Stock_adjustment_model->addtStock_adjustment();
		$this->data['main_content'] = 'Stock_adjustment_form_view';
		$this->data['action'] = "Stock_adjustment/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Stock_adjustment Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Stock_adjustment_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Stock_adjustment_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Stock_adjustment deleted successfully.');
						redirect('Stock_adjustment', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Stock_adjustment not deleted successfully!!.');
							redirect('Stock_adjustment', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Stock_adjustment not Available!!');
			  		redirect('Stock_adjustment', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Stock_adjustment not Available!!');
					redirect('Stock_adjustment', 'refresh'); 
			}
			redirect('Stock_adjustment', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Stock_adjustment'), 'refresh'); 
		}
		//$this->country_model->delete();
		//redirect(base_url('admin/country'), 'refresh');
	}

	public function get_country_from_country()
	{
		$value = $this->Stock_adjustment_model->get_country_from_country();
		echo(json_encode($value));
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

	public function importcsv() 
	{
       $this->Stock_adjustment_model->insert_csv();  
    } 

	public function csvimport()
	{
		$this->data['action'] = "Stock_adjustment/importcsv";
		//parent::load_view('Stock_adjustment/importcsv_view', $this->data);
		$this->data['main_content'] = 'importcsv_view';
		$this->load->view('includes/template',$this->data);
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