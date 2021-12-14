<?php

class Login extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library('form_validation');
		 $this->load->helper('captcha');
	}

	function index()
	{
		if($this->input->post())
		{
			$this->form_validation();
			//echo $this->form_validation->run();die;
			if($this->form_validation->run() == TRUE)
			{
				//echo 'success';die;
				if(!isset($_SESSION['start_date']))
				{
					$_SESSION['start_date']=date('d-m-Y',strtotime('-1 Sunday'));
				}
				if(!isset($_SESSION['end_date']))
				{
					$_SESSION['end_date']=date('d-m-Y');
				}
				if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 2) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
				{
					redirect('dashboard?start_date='.$_SESSION['start_date'].'&end_date='.$_SESSION['end_date']);
				}else if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 4) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
				{
					redirect('Dashboard_workorder_final');
				}else{
					if(isset($this->session->userdata['miconlogin']['dep_id']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 2) || ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 11))
					{
						redirect('Dashboard_workorder_final');
					}else{
						redirect('dashboard?start_date='.$_SESSION['start_date'].'&end_date='.$_SESSION['end_date']);
					}
				}
			}
			else
			{
				$this->login_form();
			}	
		}else{
			$this->login_form();
		}
	}
	
	function login_form()
	{
		$this->captcha();
		$this->data['action'] = 'login';
		$this->data['main_content'] = 'Login_view';
		$this->load->view('includes/login_template',$this->data);
	}

	public function form_validation()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|callback_check_database');
	}

	public function check_database($result,$type)
	{
		$value = array();
		$value = $this->input->post(NULL,FALSE);
		$value = $this->security->xss_clean($value);
		$login_result = $this->Login_model->check_login($value);
		
		if(isset($login_result) && isset($login_result['status']) && ($login_result['status'] == 1) && isset($login_result['data']) && !empty($login_result['data']))
		{
			$this->Login_model->get_all_child_ids($login_result['data']['au_id'],$level=0,$adminids = array());
			//echo '<pre>';print_r($all_child_admin_ids);die;
			$all_child_admin_ids = isset($this->session->userdata['temp_adminids']) ? $this->session->userdata['temp_adminids'] : array();
			$this->session->unset_userdata('temp_adminids');
			//echo '<pre>gggggg';print_r($this->session->userdata['temp_adminids']);die;

			$all_group_admin_ids = $this->Login_model->get_all_group_ids($login_result['data']['au_id'],$adminids = array());
			if(isset($all_group_admin_ids) && is_array($all_group_admin_ids) && !empty($all_group_admin_ids) && isset($all_child_admin_ids) && is_array($all_child_admin_ids) && !empty($all_child_admin_ids))
			{
				$final_admin_ids = array_unique(array_merge($all_child_admin_ids,$all_group_admin_ids), SORT_REGULAR);
			}else if(isset($all_group_admin_ids) && is_array($all_group_admin_ids) && empty($all_group_admin_ids) && isset($all_child_admin_ids) && is_array($all_child_admin_ids) && !empty($all_child_admin_ids))
			{
				$final_admin_ids = $all_child_admin_ids;
			}else if(isset($all_child_admin_ids) && is_array($all_child_admin_ids) && empty($all_child_admin_ids) && isset($all_group_admin_ids) && is_array($all_group_admin_ids) && !empty($all_group_admin_ids))
			{
				$final_admin_ids = $all_group_admin_ids;
			}else{
				$final_admin_ids = array();
			}
			array_push($final_admin_ids,$login_result['data']['au_id']);
			$final_admin_ids = array_unique($final_admin_ids);
			//echo 'hhhhhhhhhhhh<pre>';print_r($final_admin_ids);die;
			$loginsession = array();
			$loginsession['status'] = $login_result['data']['au_status'];
			$loginsession['typeid'] = $this->encrypt_decrypt('encrypt',$login_result['data']['au_adt_id']);
			$loginsession['userid'] = $this->encrypt_decrypt('encrypt',$login_result['data']['au_id']);
			$loginsession['all_users'] = $final_admin_ids;
			//echo '<pre>'; print_r($loginsession['all_users']); die;
			$loginsession['session_users'] = $final_admin_ids;
			$loginsession['rightsid'] = $this->encrypt_decrypt('encrypt',$login_result['data']['au_rights_id']);
			$loginsession['email'] = $login_result['data']['au_email'];
			$loginsession['colorcode'] = $login_result['data']['au_colorcode'];
			// $loginsession['gmailemail'] = $login_result['data']['au_gmail_email'];
			// $loginsession['gmailpass'] = $login_result['data']['au_gmail_password'];
			$loginsession['dob'] = $login_result['data']['au_birth_date'];
			$loginsession['fname'] = $login_result['data']['au_fname'].' '.$login_result['data']['au_lname'];
			$loginsession['image'] = $login_result['data']['au_photo'];
			$loginsession['dep_id'] = $this->encrypt_decrypt('encrypt',$login_result['data']['au_dep_id']);
			$loginsession['loginsessid'] = $this->encrypt_decrypt('encrypt',$login_result['data']['loginsessid']);
			$loginsession['loginufid'] = $this->encrypt_decrypt('encrypt',$login_result['data']['au_vf_id']);
			$this->session->set_userdata('miconlogin',$loginsession);
			//echo '<pre>';print_r($this->session->userdata('miconlogin'));die;
			$this->session->set_userdata(array('authorized' => true));
			// if($login_result['data']['au_adt_id'] == 5)
			// {
			// 	$vfid = $this->encrypt_decrypt('encrypt',$login_result['data']['au_vf_id']);
			// 	redirect('User/edit/'."$vfid",'refresh');
			// }
			return TRUE;
		}else{
			$this->session->set_flashdata('result', 'Invalid username or password');
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return FALSE;
		}
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid,$type);
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

	public function logout()
	{
		$this->session->sess_destroy();
		$this->captcha();
		$this->data['action'] = 'Login';
		$this->load->view('Login_view',$this->data);
		//redirect('admin/login', 'refresh');
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

	public function captcha()
	{
		$abc = array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
			$word = "";
			$n = 0;
			while($n > 10)
			{
				$word .= $abc(mt_rand(0,35));
			}
			$this->load->helper('captcha');
			$vals = array(
				'word' => $word,
				'img_path'     => './captcha/login/',
				'img_url'     => base_url().'captcha/login/',
				'font_path' => './skin/font/arialbd.ttf',
				 'img_width'     => '100',
				 'img_height' => 30,
				 'font_size'	=> 100,
				//'border' => 10,

				 'colors' => array(
			    'background' => array(0,0,0),
			    'border' => array(0, 0, 0),
			    'text' => array(255, 255,255),
			    'grid' => array(255, 40, 40)
				  )
				);

				$cap = create_captcha($vals);
				$this->data['image'] = $cap['image'];
				$this->data['word'] = $cap['word'];
				
	}


}?>