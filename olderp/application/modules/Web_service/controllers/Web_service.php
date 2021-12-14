<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
class Web_service extends REST_Controller {	 
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Web_service_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
		
	}
	 
	public function index()
	{
		if($this->input->post() && $this->input->post('al_email') != '' && $this->input->post('al_password') != '')
		{
			//$email = $this->input->post('al_email');
			$userid = $this->input->post('al_email');
			//echo $userid; die;
			$pass = md5($this->input->post('al_password'));
			$data = $this->Web_service_model->get($userid,$pass);
			if(isset($data) && !empty($data))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['data'] = $data;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'Wrong User Id or Password';
				$result['data'] = array();
			}
			
		}else{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			$result['data'] = array();
		}
		echo json_encode($result);
	}

	public function login_post()
	{
		
		if($this->input->post() && $this->input->post('email') != '' &&  $this->input->post('password') != '')
		{
			//echo "hiii";die;
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = $this->input->post();
			$emai = $this->input->post('email');
			//echo $userid; die;
			$pass = md5($this->input->post('password'));
			$data = $this->Web_service_model->login($emai,$pass);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'useridr or Password wrong';
				//$result['is_imei_available'] = FALSE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['data'] = array();
			}
			
		}else{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			//$result['is_imei_available'] = FALSE;
			//$result['is_otp_verified'] = FALSE;
			//$result['is_verson_code'] = $is_verson_code;
			//$result['data'] = array();
		}
	
		echo json_encode($result);
	}
	public function dashboard_post()
	{
		
		if($this->input->post() && $this->input->post('userid') && $this->input->post('typeid') != '')
		{
			//echo "hiii";die;
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = $this->input->post();
			$uid = $this->input->post('userid');
			$tid = $this->input->post('typeid');
			$data = $this->Web_service_model->dashboard($uid,$tid);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'useridr or Password wrong';
				//$result['is_imei_available'] = FALSE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['data'] = array();
			}
			
		}else{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			//$result['is_imei_available'] = FALSE;
			//$result['is_otp_verified'] = FALSE;
			//$result['is_verson_code'] = $is_verson_code;
			//$result['data'] = array();
		}
	
		echo json_encode($result);
	}
	public function inq_list_post()
	{
		if($this->input->post() && $this->input->post('userid') && $this->input->post('typeid') != '')
		{
			//echo "hiii";die;
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = array();
			$uid = $this->input->post('userid');
			$tid = $this->input->post('typeid');
			$values['pageno'] = $this->input->post('pageno') ? $this->input->post('pageno') : 0;
			$values['limit'] = $this->input->post('limit') ? $this->input->post('limit') : 8;
			$values['totalrows'] = $this->Web_service_model->inq_totalrows($uid,$tid);
			$values['totalpages'] = ceil($values['totalrows'] / $values['limit']);
			$values['start'] = $values['limit'] * $values['pageno'];
			//echo "<pre>";print_r($values);die;
			$data = $this->Web_service_model->inq_list($uid,$tid,$values);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
				$result['pagination'] = $values;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'useridr or Password wrong';
				//$result['is_imei_available'] = FALSE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['data'] = array();
			}
		}
		else
		{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			//$result['is_imei_available'] = FALSE;
			//$result['is_otp_verified'] = FALSE;
			//$result['is_verson_code'] = $is_verson_code;
			//$result['data'] = array();
		}
		echo json_encode($result);
	}
	public function quo_list_post()
	{
		if($this->input->post() && $this->input->post('userid') && $this->input->post('typeid') != '')
		{
			//echo "hiii";die;
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = array();
			$uid = $this->input->post('userid');
			$tid = $this->input->post('typeid');
			$values['pageno'] = $this->input->post('pageno') ? $this->input->post('pageno') : 0;
			$values['limit'] = $this->input->post('limit') ? $this->input->post('limit') : 8;
			$values['totalrows'] = $this->Web_service_model->quo_totalrows($uid,$tid);
			$values['totalpages'] = ceil($values['totalrows'] / $values['limit']);
			$values['start'] = $values['limit'] * $values['pageno'];
			$data = $this->Web_service_model->quo_list($uid,$tid,$values);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
				$result['pagination'] = $values;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'useridr or Password wrong';
				//$result['is_imei_available'] = FALSE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['data'] = array();
			}
		}
		else
		{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			//$result['is_imei_available'] = FALSE;
			//$result['is_otp_verified'] = FALSE;
			//$result['is_verson_code'] = $is_verson_code;
			//$result['data'] = array();
		}
		echo json_encode($result);
	}
	public function oa_list_post()
	{
		if($this->input->post() && $this->input->post('userid') && $this->input->post('typeid') != '')
		{
			//echo "hiii";die;
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = array();
			$uid = $this->input->post('userid');
			$tid = $this->input->post('typeid');
			$values['pageno'] = $this->input->post('pageno') ? $this->input->post('pageno') : 0;
			$values['limit'] = $this->input->post('limit') ? $this->input->post('limit') : 8;
			$values['totalrows'] = $this->Web_service_model->oa_totalrows($uid,$tid);
			$values['totalpages'] = ceil($values['totalrows'] / $values['limit']);
			$values['start'] = $values['limit'] * $values['pageno'];
			$data = $this->Web_service_model->oa_list($uid,$tid,$values);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
				$result['pagination'] = $values;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'useridr or Password wrong';
				//$result['is_imei_available'] = FALSE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['data'] = array();
			}
		}
		else
		{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			//$result['is_imei_available'] = FALSE;
			//$result['is_otp_verified'] = FALSE;
			//$result['is_verson_code'] = $is_verson_code;
			//$result['data'] = array();
		}
		echo json_encode($result);
	}
	public function pi_list_post()
	{
		if($this->input->post() && $this->input->post('userid') && $this->input->post('typeid') != '')
		{
			//echo "hiii";die;
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = array();
			$uid = $this->input->post('userid');
			$tid = $this->input->post('typeid');
			$values['pageno'] = $this->input->post('pageno') ? $this->input->post('pageno') : 0;
			$values['limit'] = $this->input->post('limit') ? $this->input->post('limit') : 8;
			$values['totalrows'] = $this->Web_service_model->oa_totalrows($uid,$tid);
			$values['totalpages'] = ceil($values['totalrows'] / $values['limit']);
			$values['start'] = $values['limit'] * $values['pageno'];
			$data = $this->Web_service_model->pi_list($uid,$tid,$values);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
				$result['pagination'] = $values;
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'useridr or Password wrong';
				//$result['is_imei_available'] = FALSE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['data'] = array();
			}
		}
		else
		{
			$result['status'] =  FALSE;
			$result['msg'] = 'Post Value error';
			//$result['is_imei_available'] = FALSE;
			//$result['is_otp_verified'] = FALSE;
			//$result['is_verson_code'] = $is_verson_code;
			//$result['data'] = array();
		}
		echo json_encode($result);
	}
	
}?>