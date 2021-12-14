<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salary_cal extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('Salary_cal_model');
		$this->load->library('encryption');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		//echo "<pre>"; print_r($this->input->post());die;
		if($this->input->post(NULL,TRUE) && $this->input->post('sal_cal_work_days') && $this->input->get() && $this->input->get('sal_month_name'))
		{
			//echo "<pre>"; print_r($this->input->post());die;
			$postdata = $this->input->post(NULL,FALSE);
			$postdata = $this->security->xss_clean($postdata);
			$this->Salary_cal_model->sal_calculation($postdata);
			redirect(base_url("Salary_cal?sal_month_name=".$this->input->get('sal_month_name')));
		}
		else{
			if($this->input->get(NULL,TRUE) && $this->input->get('sal_month_name') && $this->input->get('sal_month_name') != "")
			{
				//echo "<pre>"; print_r($this->input->get());die;
				$value = array();
				$value = $this->input->get(NULL,FALSE);
				$value = $this->security->xss_clean($value);				
				//$value['sal_month_name'] = $this->input->get('sal_month_name');

				//$idenc = $this->encrypt_decrypt('encrypt',$value['sal_month_name']);
				$month =date("m-Y", strtotime($value['sal_month_name']));
				$lid = $this->Salary_cal_model->add($value, $month);
				//$this->data['Sal_cals'] = $this->Salary_cal_model->get_Salary_calculation($month);

				if(isset($value['sal_month_name']) && $value['sal_month_name'] != '')
				{
					$this->data['action'] = "Salary_cal?sal_month_name=".$value['sal_month_name']."";
					$this->data['action_salcal'] = "Salary_cal?sal_month_name=".$value['sal_month_name']."";
					$this->data['Sal_cals'] = $this->Salary_cal_model->get_Salary_calculation($month);
					$this->data['main_content'] = 'Salary_cal_form_view';
					$this->load->view('includes/template',$this->data);
					//echo "<pre>"; print_r($this->data['Sal_cals']);die;
				}

				if($lid)
					{	
						$this->session->set_flashdata('success', 'Salary_cal added successfully.');
						//redirect(base_url('Salary_cal/add?sal_month_name='.$month), 'refresh');
					}else{
					
						$this->session->set_flashdata('error', 'Salary_cal not added successfully!!');
					}
				 	//redirect(base_url('Salary_cal/add?sal_month_name='.$month), 'refresh');

				
			}
			else{

				$value = array();
				$value = $this->input->get(NULL,FALSE);
				$value = $this->security->xss_clean($value);				
				//$value['sal_month_name'] = $this->input->get('sal_month_name');

				//$idenc = $this->encrypt_decrypt('encrypt',$value['sal_month_name']);
				$month =isset($value['sal_month_name']) ? $value['sal_month_name'] : '';

				$this->data['action'] ="Salary_cal";
				$this->data['action_salcal'] = "Salary_cal?sal_month_name=".$month."";
				//$this->data['Sal_cals'] = $this->Salary_cal_model->get_Salary_calculation();
				$this->data['main_content'] = 'Salary_cal_form_view';			
				$this->load->view('includes/template',$this->data);

				$right_status = $this->check_rights('view');
				if($right_status == false)
				{
					$this->session->set_flashdata('rights_error', "You Don't have rights to access Salary_cal VIew functionality");
					redirect(base_url());
				}
			}			
		}
		
	}
	public function confirm_calculation()
	{
		$this->Salary_cal_model->confirm_calculation();
		redirect(base_url("Salary_cal?sal_month_name=".$this->input->get('sal_month_name')));
	}
	public function salar_paid()
	{
		$this->Salary_cal_model->salar_paid();
		redirect(base_url("Salary_cal/View"));
	}
	public function email()
	{
		//die;
		$lists = $this->Salary_cal_model->get_maildata();
		$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
				;
		$mailerdata = $this->Salary_cal_model->get_mailer_detail($uid);
		//echo '<pre>';print_r($lists);die;
		$value = array();
		$value = $this->input->post(NULL,FALSE);
		$value = $this->security->xss_clean($value);
		$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
		$config = array();
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = $mailerdata['au_gmail_email'];
		$config['smtp_pass']    = $mailerdata['au_gmail_password'];
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not
		$message = '';
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($mailerdata['au_gmail_email']); //$mailerdata['au_gmail_email']
		$this->email->to("parag@miconindia.com,hr@miconindia.com");
		$message=$this->load->view('Salary_email_form_view',$lists,true);
		$this->email->subject("Salary Detail");
		$this->email->message($message);
      	if($this->email->send())
     	{
		      echo 'Email sent.';
		      $this->session->set_flashdata('success', 'Mail sent successfully.');
			  redirect(base_url('Salary_cal'));
	     }
	     else
	    {
	     show_error($this->email->print_debugger());
	     $this->session->set_flashdata('error', 'Mail not sent successfully!!');
	     redirect(base_url('Salary_cal'));
	    }
	}
	
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('sal_month_name', 'sal_month_name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('sal_month_name', 'Salary_cal name', 'trim|required');  
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

	public function View()
	{
		$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
		$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
		if($type_id == 3)
		{
			$this->data['Sal_cals'] = $this->Salary_cal_model->get_Salary_data_for_admin();
			$this->data['main_content'] = 'Salary_cal_admin_report_view';
			$this->load->view('includes/template',$this->data);
		}
		else{
			$this->data['Sal_cals'] = $this->Salary_cal_model->get_Salary_data();
			$this->data['main_content'] = 'Salary_cal_report_view';
			$this->load->view('includes/template',$this->data);
		}		
	}
	
	public function get_form()
	{
		//$this->Salary_cal_model->add();	
		$this->data['action'] = "Salary_cal/add".$this->uri->segment(3);
		$this->data['main_content'] = 'Salary_cal_form_view';
		$this->data['sal_month'] = $this->Salary_cal_model->get_Salary_month();		
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