<?php

class Dashboard extends CI_Controller {

	 function __construct() {
            parent::__construct();
            $this->load->model('dashboard_model');
            $loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
    	}
	public function index()
	{
		$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
		if($dep_id == 11 || $dep_id == 5 || $dep_id == 9 || $dep_id == 2 || $dep_id == 6)
		{
			$this->load->model('Dashboard_workorder_final_model');
			$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
			$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
			//echo $type_id;die;
			if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1)
			{
				redirect(base_url()."Dashboard_workorder_final");
				$data['work_orders'] = $this->Dashboard_workorder_final_model->get_all_confirm_work_order();
				$data['work_orders_count'] = $this->Dashboard_workorder_final_model->get_all_work_orders_count();
				//echo '<pre>';print_r($data['work_orders']);die;
				$data['main_content'] = 'Dashboard_workorder_final/Dashboard_workorder_final_view';
				$this->load->view('includes/template', $data);
			}else if($dep_id == 9)
			{
				redirect(base_url()."Dashboard_workorder_final");
				$data['work_orders'] = $this->Dashboard_workorder_final_model->get_production_work_order();
				//echo '<pre>';print_r($data['work_orders']);die;
				$data['main_content'] = 'Dashboard_workorder_final/Production_view';
				$this->load->view('includes/template', $data);
			}else if($dep_id == 5)
			{
				redirect(base_url()."Dashboard_workorder_final");
				$data['work_orders'] = $this->Dashboard_workorder_final_model->get_store_work_order();
				//echo '<pre>';print_r($data['work_orders']);die;
				$data['main_content'] = 'Dashboard_workorder_final/Store_view';
				$this->load->view('includes/template', $data);
			}else if($dep_id == 2)
			{
				redirect(base_url()."Dashboard_workorder_final");
				$data['work_orders'] = $this->Dashboard_workorder_final_model->get_account_work_order();
				//echo '<pre>';print_r($data['work_orders']);die;
				if($data['work_orders']['outward_lists'] == NULL)
				{
					$data['error_msg'] = 'No Data.';
				}
				$data['main_content'] = 'Dashboard_workorder_final/Account_view';
				$this->load->view('includes/template', $data);
			}else if($dep_id == 6)
			{
				redirect(base_url()."Doc_inward/Doc_inward_report");
			}
		}else{
			if($this->input->get('start_date'))
			{
					$_SESSION['start_date']=$this->input->get('start_date');
			}
			if($this->input->get('end_date'))
			{
					$_SESSION['end_date']=$this->input->get('end_date');
			}
			$data['action_ds'] = "Dashboard/".$this->uri->segment(3);
			$data['inq_list'] = $this->dashboard_model->sales_inq_report();
			$data['inq_stats'] = $this->dashboard_model->get_inq_data();
			$data['get_reminder_task'] = $this->dashboard_model->get_reminder_task();
			$data['get_task_done'] = $this->dashboard_model->get_task_done();
			$data['main_content'] = 'Dashboard_view';
			$this->load->view('includes/template', $data);
		}
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
	public function change_inqview_to($id=false)
	{
		
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= '')
			{	
				//echo "<pre>";print_r($idencr);die;
					$lid = $this->dashboard_model->change_inqview_to($idencr);
						if ($lid) 
						{
						$this->session->set_flashdata('success', 'Changed successfully.');
						redirect(base_url('Dashboard'), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'not Changed successfully!!.');
							redirect(base_url('Dashboard'), 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'detail not Available!!');
					redirect(base_url('Dashboard'), 'refresh'); 
			}
			redirect(base_url('Dashboard'), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Dashboard'), 'refresh');
		}
	}

	public function work_order_stats()
	{
		$this->load->model('Dashboard_workorder_final_model');
		$data['inq_stats'] = $this->Dashboard_workorder_final_model->dashboard_stats();
		$data['action_ds'] = "Dashboard/work_order_stats".$this->uri->segment(3);
		$data['wo_type'] = $this->Dashboard_workorder_final_model->get_wo_type();
		$data['main_content'] = 'Work_order_stats_view';
		$this->load->view('includes/template', $data);
	}
}
