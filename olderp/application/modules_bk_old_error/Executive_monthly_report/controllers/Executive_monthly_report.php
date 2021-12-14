<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Executive_monthly_report extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('executive_monthly_report_model');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$decid = $this->input->get('Executive'); 
		$deccid = $this->encrypt_decrypt('deccrypt', $decid);
		$this->data['action'] = "Executive_monthly_report/add?id=".$decid;
		$this->data['main_content'] = 'Executive_monthly_report_form_view';
		$this->load->view('includes/template',$this->data);
	}

	public function add()
	{
		//require 'Zebra_Image.php';
		
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				$value = array();
				 $decid = $this->input->get('id');  
				$deccid = $this->encrypt_decrypt('decrypt', $decid);
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['country_cdate'] = date('Y-m-d H:i:s');
				$value['country_udate'] = date('Y-m-d H:i:s');
				
				$lid = $this->executive_monthly_report_model->add($value,$deccid);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Executive_monthly_report added successfully.');
					redirect(base_url('Executive_monthly_report'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Executive_monthly_report not added successfully!!');
					redirect(base_url('Executive_monthly_report/add'), 'refresh');
				}
			 	redirect(base_url('Executive_monthly_report'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$decid = $this->input->get('Executive');
			redirect(base_url('Executive_monthly_report/add'.$decid.''), 'refresh');
		}
	}

	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('country_name', 'country name', 'trim|required|is_unique[tbl_country.country_name]');  
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
		//$this->data['getcountry'] = $this->executive_monthly_report_model->addtcountry();
		$this->data['main_content'] = 'Executive_monthly_report_form_view';
		$this->data['action'] = "Executive_monthly_report/add";
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