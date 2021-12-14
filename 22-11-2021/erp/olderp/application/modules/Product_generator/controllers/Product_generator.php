<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_generator extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('Product_generator_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		// $this->session->set_flashdata('success', 'Add Product');
		// redirect(base_url('Product_generator/add'), 'refresh');
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Product_generator VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Product_generator_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Product_generator_model->get_Product_generator();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['pg_id']);
		//$this->encrypt->encode($user[$i]['Product_generator_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Product_generator/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Product_generator/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$records["data"][] = array(
			  $id,
			  ''.$user[$i]['ph_name'],
			  ''.$user[$i]['pg_ph_code'],
			  ''.$user[$i]['cat_name'],
			  ''.$user[$i]['pg_cat_code'],
			  ''.$user[$i]['pg_final_code'],
			  ''.date("m-d-Y", strtotime($user[$i]['pg_udate'])),
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Product_generator Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				//echo '<pre>';print_r($this->input->post());die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				
				$response = $this->Product_generator_model->add($value);
				// $this->session->set_flashdata('success', 'Product_generator added successfully.');
				// redirect(base_url('Product_generator/add'), 'refresh');
				if(isset($response) && isset($response['status']) && ($response['status'] == TRUE))
				{
					$this->session->set_flashdata('success', 'Product added successfully in master Item. - Part Code : '.$value['final_code']);
					redirect(base_url('Product_generator/add'), 'refresh');
				}else{
					if(isset($response) && isset($response['msg']))
					{
						$this->session->set_flashdata('error', $response['msg']);
						redirect(base_url('Product_generator'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Product_generator not added successfully!!');
						redirect(base_url('Product_generator'), 'refresh');
					}
				}
			 	redirect(base_url('Product_generator/add'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function ajaxapi()
	{
		if($this->input->post()){
			$value = array();
			$value = $this->input->post(NULL,FALSE);
			$value = $this->security->xss_clean($value);
			$response = $this->Product_generator_model->add($value);
			echo json_encode($response);
		}else{
			echo json_encode(array());
		}
	}

	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Product_generator Edit functionality");
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
					//$value['Product_generator_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->Product_generator_model->edit($value,$idencr);
					if($lid)
					{	
						$this->session->set_flashdata('success', 'Product_generator edited successfully.');
						redirect(base_url('Product_generator'), 'refresh');
					}else{
					
						$this->session->set_flashdata('error', 'Product_generator not edited successfully!!');
					}
				 	redirect(base_url('Product_generator'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Product_generator_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['masters'] = $this->Product_generator_model->get_masters();
						$this->data['action'] = "Product_generator/edit/".$enid;
						$this->data['main_content'] = 'Product_generator_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Product_generator not Available!!');
						 redirect(base_url('Product_generator'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Product_generator not Available!!');
					redirect(base_url('Product_generator'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Product_generator'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('product_head', 'Product_generator name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('product_head', 'Product_generator name', 'trim|required');  
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
		$this->data['masters'] = $this->Product_generator_model->get_masters();
		$this->data['main_content'] = 'Product_generator_form_view';
		$this->data['action'] = "Product_generator/add";
		$this->load->view('includes/template',$this->data);
	}
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 45,$type);
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

	public function setbit_Product_generator()
	{
		$this->Product_generator_model->setbit_Product_generator();
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

	public function product_to_other_details()
	{
		if($this->input->post() && $this->input->post('id') && $this->input->post('id') != '')
		{
			$postdata = $this->input->post();
			$result = $this->Product_generator_model->product_to_other_details($postdata);
			echo json_encode($result);
		}
	}

	public function attribute_to_code()
	{
		if($this->input->post() && $this->input->post('attribute_id') && $this->input->post('attribute_id') != '' && $this->input->post('attribute_value') && $this->input->post('attribute_value') != '')
		{
			$postdata = $this->input->post();
			$result = $this->Product_generator_model->attribute_to_code($postdata);
			echo json_encode($result);
		}else{
			$result = array();
			$result['code'] = '00';
			$result['count'] = 1;
			echo json_encode($result);
		}
	}

	public function search_attribute_value()
	{
		$value = $this->input->get();
		if(isset($value['attribute_value']) && isset($value['search_val']))
		{
			$this->Product_generator_model->search_attribute_value($value['attribute_value'],$value['search_val']);
		}
	}
	
	
}?>