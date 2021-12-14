<?php

class Dashboard_qoutation extends CI_Controller {

	 function __construct() {
            parent::__construct();
            $this->load->model('Dashboard_qoutation_model');
            $loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
    	}
	public function index()
	{
		if($this->input->get('start_date'))
		{
				$_SESSION['start_date']=$this->input->get('start_date');
		}
		if($this->input->get('end_date'))
		{
				$_SESSION['end_date']=$this->input->get('end_date');
		}
		$data['action_ds'] = "Dashboard_qoutation/".$this->uri->segment(3);
			$data['inq_stats'] = $this->Dashboard_qoutation_model->get_inq_data();
	    $data['main_content'] = 'Dashboard_qoutation_view';
	    $this->load->view('includes/template', $data);
	}
	
	public function is_loggedin()
	{
		
		if(isset($this->session->userdata['miconlogin']))
		{
			if(isset($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && isset($this->session->userdata['miconlogin']['rightsid']) && isset($this->session->userdata['miconlogin']['status']) && ($this->session->userdata['miconlogin']['status'] == 1) && isset($this->session->userdata['miconlogin']['loginsessid'])&& isset($this->session->userdata['miconlogin']['userid']))
			{
				$logar = array(
					'typeid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']),
					'userid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])
				);
				$loginstatus = true;
			}else{
				$loginstatus = false;
			}
		}else{
			$loginstatus = false;
		}
		return $loginstatus; 
	}
	
	public function encrypt_decrypt($action, $string)
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
}
