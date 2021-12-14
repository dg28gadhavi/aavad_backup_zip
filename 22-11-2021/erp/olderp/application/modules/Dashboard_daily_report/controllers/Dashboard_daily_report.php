<?php

class Dashboard_daily_report extends CI_Controller {

	 function __construct() {
            parent::__construct();
            $this->load->model('Dashboard_daily_report_model');
            $loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
			$this->load->library('form_validation');
    	}
	function index(){
			 // $typeid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
 			// if($typeid == 5)
 			// {
 			// 	$vfid = $this->encrypt_decrypt('encrypt',$this->session->userdata['miconlogin']['loginufid']);
				// redirect('User/edit/'."$vfid",'refresh');
 			// }else{
 				
 			// }
				if(isset($this->session->userdata['miconlogin']) && $this->session->userdata['miconlogin']['typeid'] != 5)
				    {
				        $dec_userid = $this->session->userdata['miconlogin']['userid'];
				        $dcid = $this->encrypt_decrypt('decrypt', $dec_userid);
				    }
				$this->db->select('*');
				$this->db->from('tbl_daily_executive_report');
				$this->db->where('dexe_exe_id', $dcid);
				$this->db->where('dexe_date',date('Y-m-d'));
				$query = $this->db->get();
				//echo '<pre>'; print_r($month_data);die;
				if($query->num_rows() == 0)
				{
					
					$id = $this->Dashboard_daily_report_model->add_new($dcid);
					$encid = $this->encrypt_decrypt('encrypt', $id);
					redirect(base_url('Dashboard_daily_report/edit?id='.$encid.''), 'refresh');
				}else{
					$data = $query->row_array();
					$id = $data['dexe_id'];
					$encid = $this->encrypt_decrypt('encrypt', $id);
					redirect(base_url('Dashboard_daily_report/edit?id='.$encid.''), 'refresh');
				}
				// $encid = $this->encrypt_decrypt('encrypt', $id);
				// $this->data['month_datas'] = $this->Dashboard_daily_report_model->get_month_data($id);
 			// 	$this->data['action'] = "Dashboard_daily_report/edit?id=".$encid;
	   //          $this->data['main_content'] = 'Dashboard_daily_report_view';
	   //          $this->load->view('includes/template', $this->data);
	}
	
	function is_loggedin()
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


	public function edit($id = FALSE)
	{
		//echo 'hiiiiiiii';die;
		$enid = $this->input->get('id'); 
		if($enid && ($enid != ''))
		{
			//echo $enid; die;
			$idencr = $enid ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$success = $this->validation();
			
			if($success == TRUE)
			{
				
				if($this->input->post(NULL,FALSE))
				{
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$idencr = $enid ? $this->encrypt_decrypt('decrypt', $enid) : '';
					
					$lid = $this->Dashboard_daily_report_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Daily Report edited successfully.');
						redirect(base_url('Dashboard_daily_report/edit?id='.$enid.''), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Daily Report not edited successfully!!');
					}
				 	redirect(base_url('Dashboard_daily_report/edit?id='.$enid.''));
				}
			}
			if($success == FALSE)
			{
				//echo "hiiiii"; die;
				if(isset($idencr) && $idencr != ''){
					$this->data['month_datas'] = $this->Dashboard_daily_report_model->get_month_data($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['month_datas']))
					{
						//echo "hi"; die;
						//$this->data['dailys'] = $this->Dashboard_daily_report_model->get_daily_data();
						//$this->data['inq_stats'] = $this->Dashboard_daily_report_model->get_inq_data();
						$this->data['action'] = "Dashboard_daily_report/edit?id=".$enid;
						$this->data['main_content'] = 'Dashboard_daily_report_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/country/Country_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Daily Report not Available!!');
						 redirect(base_url('Dashboard_daily_report/edit?id='.$enid.''));
					}
				}
				else{
					$this->session->set_flashdata('error', 'Daily Report not Available!!');
					redirect(base_url('Dashboard_daily_report/edit?id='.$enid.'')); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Dashboard_daily_report/edit?id='.$enid.'')); 
		}
	}

	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'edit'){
				$this->form_validation->set_rules('exec_name', 'Executive Name', 'trim|required');  
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
}
