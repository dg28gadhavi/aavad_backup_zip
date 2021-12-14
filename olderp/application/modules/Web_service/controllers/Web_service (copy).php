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

	public function getalluser_type_post()
	{
		if($this->input->post() && $this->input->post('userid') != '' && $this->input->post('al_password') != '')
		{
			//$email = $this->input->post('al_email');
			$userid = $this->input->post('userid');
			//echo $userid; die;
			$pass = md5($this->input->post('al_password'));
			$data = $this->Web_service_model->get_type_user($userid,$pass);
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

	public function dealer_login_post()
	{
		if($this->input->post() && $this->input->post('userid') != '' && $this->input->post('al_password') != '')
		{
			//$email = $this->input->post('al_email');
			$userid = $this->input->post('userid');
			//echo $userid; die;
			$pass = md5($this->input->post('al_password'));
			$data = $this->Web_service_model->dealer_login($userid,$pass);
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

	public function agency_login_post()
	{
		if($this->input->post() && $this->input->post('userid') != '' && $this->input->post('al_password') != '')
		{
			//$email = $this->input->post('al_email');
			$userid = $this->input->post('userid');
			//echo $userid; die;
			$pass = md5($this->input->post('al_password'));
			$data = $this->Web_service_model->agency_login($userid,$pass);
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

	public function staff_login_post()
	{
		if($this->input->post() && $this->input->post('userid') != '' && $this->input->post('al_password') != '')
		{
			//$email = $this->input->post('al_email');
			$userid = $this->input->post('userid');
			//echo $userid; die;
			$pass = md5($this->input->post('al_password'));
			$data = $this->Web_service_model->staff_login($userid,$pass);
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

	public function stockiest_login_post()
	{
		if($this->input->post() && $this->input->post('userid') != '' && $this->input->post('al_password') != '')
		{
			//$email = $this->input->post('al_email');
			$userid = $this->input->post('userid');
			//echo $userid; die;
			$pass = md5($this->input->post('al_password'));
			$data = $this->Web_service_model->stockiest_login($userid,$pass);
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

	public function product_post()
	{
		if($this->input->post() && $this->input->post('user_id') != '')
		{
			$data = $this->Web_service_model->get_product();
			$result['status'] = TRUE;
			$result['msg'] = 'Successfull';
			$result['data'] = $data;
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Value error';
			$result['data'] = array();
		}
		echo json_encode($result);
	}
	public function login_post()
	{
		
		if($this->input->post() && $this->input->post('userid') != '' &&  $this->input->post('password') != '')
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			$values = $this->input->post();
			$userid = $this->input->post('userid');
			//echo $userid; die;
			$pass = md5($this->input->post('password'));
			$data = $this->Web_service_model->login($userid,$pass);
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
	public function stats_post()
	{
		
		if($this->input->post() && $this->input->post('userid') != '')
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			
			$userid = $this->input->post('userid');
			$data = $this->Web_service_model->statslist($userid);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['data'] = $data;
			}else{
				$result['status'] = TRUE;
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
	public function mod_oper_post()
	{
		
		if($this->input->post() && $this->input->post('userid') != '')
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			
			$userid = $this->input->post('userid');
			$data = $this->Web_service_model->deviceget($userid);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['sms'] ='msg send successfully';
				$result['data'] = $data;
			}else{
				$result['status'] = TRUE;
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
	public function schecule_mode_post()
	{
		
		if($this->input->post() && $this->input->post('userid') != '' && $this->input->post('datetime') != '')
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			
			$userid = $this->input->post('userid');
			$datetime = $this->input->post('datetime');
			$data = $this->Web_service_model->schecule_set($userid,$datetime);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				$result['sms'] ='Schedule set successfully';
				$result['data'] = $data;
			}else{
				$result['status'] = TRUE;
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
	public function maintenance_mode_post()
	{
		
		if($this->input->post() && $this->input->post('userid') != '')
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			
			$userid = $this->input->post('userid');
			$data = $this->Web_service_model->robot_list($userid);
			if(isset($data) && !empty($data) && ($data == true))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				//$result['is_imei_available'] = TRUE;
				//$result['is_otp_verified'] = $otpdta;
				//$result['is_verson_code'] = $is_verson_code;
				//$result['sms'] ='msg send successfully';
				$result['data'] = $data;
			}else{
				$result['status'] = TRUE;
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
	public function images_post()
	{

		if($this->input->post() && $this->input->post('user_id') != '')
		{
			$data = $this->Web_service_model->get_images();
			$result['status'] = TRUE;
			$result['msg'] = 'Success';
			$result['img_basepath'] = base_url().'uploads/adv_image_file/';
			$result['data'] = $data;
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Value error';
			$result['data'] = array();
		}
		echo json_encode($result);
	}

	public function videos_post()
	{

		if($this->input->post() && $this->input->post('user_id') != '')
		{
			$data = $this->Web_service_model->get_videos();
			$result['status'] = TRUE;
			$result['msg'] = 'Success';
			$result['data'] = $data;
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Value error';
			$result['data'] = array();
		}
		echo json_encode($result);
	}
	
	public function register_order_post()
	{
		//Api parameters : ordname, ordate, ordtotal, ordsubtotal, ordmarket , ordrate, ordiscount, ordbag, ordbagqty, ordother, ordnote, ordfinaltotal, orduserid, qty[10]
		//echo '<pre>';print_r($this->input->post());die;
		if($this->input->post() && $this->input->post('ordname') && $this->input->post('ordname') != '' && $this->input->post('orduserid') && $this->input->post('orduserid') != '' )
		{
			//echo '<pre>';print_r($this->input->post());die;
			$value = $this->input->post();
			$data = $this->Web_service_model->register_order($value);
			//var_dump($data);
			$pdfdata = $this->Web_service_model->get_pdfdata($data);
			//echo '<pre>'; print_r($pdfdata); die;
			$html = $this->load->view('order_pdf_view',$pdfdata,TRUE);
			//$html=$this->data['result_view'];
			$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/order/order'.$data.'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','322222222M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				//$pdf->SetFooter($footer);
				//$pdf->SetHTMLHeader($header);
				//$pdf->SetMargins(15, 15, 15);
				//$pdf->SetHeaderMargin(15);
				//$pdf->SetFooterMargin(15);
				$pdf->SetAutoPageBreak(TRUE, 15);
				//echo $html; die;
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
			
			$result['status'] = TRUE;
			$result['msg'] = 'Order add successfully.';
			$result['data'] = $data;
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Value error';
			$result['data'] = array();
		}
		echo json_encode($result);
	}
	
	
	public function get_country_post()
	{
		$result = array();
		$reoutput = $this->Web_service_model->get_country();
		$result = $reoutput;
		
		echo json_encode($result);
	}
	
	public function get_state_post()
	{
		//api name: con_id
		$result = array();
		if($this->input->post() && $this->input->post('country') && $this->input->post('country') != '')
		{
			
			$value = $this->input->post('country');
			$reoutput = $this->Web_service_model->get_state($value);
			//$result = $reoutput;
			if(isset($reoutput) && !empty($reoutput))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_state_availble'] = TRUE;
				$result['data'] = $reoutput;
			}else{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_state_availble'] = FALSE;
				$result['data'] = array();
			}			
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Data error';
			$result['is_state_availble'] = FALSE;
			$result['data'] = array();
		}
		
		echo json_encode($result);
	}

	public function get_district_post()
	{
		//api name: con_id
		$result = array();
		if($this->input->post() && $this->input->post('country') != '' && $this->input->post('state') != '')
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			$state = $this->input->post('state');
			$contry = $this->input->post('country');
			$reoutput = $this->Web_service_model->get_district($contry,$state);
			//$result = $reoutput;
			if(isset($reoutput) && !empty($reoutput))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_district_availble'] = TRUE;
				$result['data'] = $reoutput;
			}else{
				$result['status'] = TRUE;
				$result['msg'] = 'Something Went Wrong';
				$result['is_district_availble'] = FALSE;
				$result['data'] = array();
			}			
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Data error';
			$result['is_district_availble'] = FALSE;
			$result['data'] = array();
		}
		
		echo json_encode($result);
	}
	public function get_taluka_post()
	{
		//api name: con_id
		$result = array();
		if($this->input->post() && $this->input->post('country') != '' && $this->input->post('state') != '' && $this->input->post('district') != '')
		{
			$state = $this->input->post('state');
			$contry = $this->input->post('country');
			$district = $this->input->post('district');
			$reoutput = $this->Web_service_model->get_taluka($contry,$state,$district);
			//$result = $reoutput;
			if(isset($reoutput) && !empty($reoutput))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_taluka_availble'] = TRUE;
				$result['data'] = $reoutput;
			}else{
				$result['status'] = TRUE;
				$result['msg'] = 'Something Went wrong';
				$result['is_taluka_availble'] = FALSE;
				$result['data'] = array();
			}			
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Data error';
			$result['is_taluka_availble'] = FALSE;
			$result['data'] = array();
		}
		
		echo json_encode($result);
	}
	
	public function get_city_post()
	{
		//api name: con_id,state_id
		$result = array();
		if($this->input->post() && $this->input->post('country') && $this->input->post('state') != ''  && $this->input->post('district') && $this->input->post('taluka') != '')
		{
			$taluka = $this->input->post('taluka');
			$state = $this->input->post('state');
			$country = $this->input->post('country');
			$district = $this->input->post('district');
			$reoutput = $this->Web_service_model->get_city($taluka,$state,$country,$district);
			//$result = $reoutput;
			if(isset($reoutput) && !empty($reoutput))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_city_availble'] = TRUE;
				$result['data'] = $reoutput;
			}else{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_city_availble'] = FALSE;
				$result['data'] = array();
			}
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Data error';
			$result['is_city_availble'] = FALSE;
			$result['data'] = array();
		}
		echo json_encode($result);
	}

	public function get_area_post()
	{
		//api name: con_id,state_id,city_id
		$result = array();
		if($this->input->post() && $this->input->post('country') && $this->input->post('state') != ''  && $this->input->post('district') && $this->input->post('taluka') != '' && $this->input->post('city'))
		{
			//echo "<pre>"; print_r($this->input->post()); die;
			$city = $this->input->post('city');
			$taluka = $this->input->post('taluka');
			$state = $this->input->post('state');
			$country = $this->input->post('country');
			$district = $this->input->post('district');
			$reoutput = $this->Web_service_model->get_area($city,$taluka,$state,$country,$district);
			//$result = $reoutput;
			if(isset($reoutput) && !empty($reoutput))
			{
				$result['status'] = TRUE;
				$result['msg'] = 'Success';
				$result['is_area_availble'] = TRUE;
				$result['data'] = $reoutput;
			}else{
				$result['status'] = TRUE;
				$result['msg'] = 'Something Went Wrong';
				$result['is_area_availble'] = FALSE;
				$result['data'] = array();
			}			
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Post Data error';
			$result['is_area_availble'] = FALSE;
			$result['data'] = array();
		}
		
		echo json_encode($result);
	}

	public function product_order_post()
	{
		/*$testar = array(
			'1' => array(
					'0' => array(
							'ord_date' => '02-05-2017',
							'option_id' => 1,
							'weight_id' => 2,
							'qty_id' => 3,
							'rate' => 10,
							'total' => 100
							),
					'1' => array(
							'ord_date' => '12-05-2017',
							'option_id' => 3,
							'weight_id' => 5,
							'qty_id' => 6,
							'rate' => 10,
							'total' => 100
							)
						),
			'2' => array(
						'0' => array(
							'ord_date' => '02-06-2017',
							'option_id' => 6,
							'weight_id' => 5,
							'qty_id' => 1,
							'rate' => 10,
							'total' => 1000
							),
						'1' => array(
							'ord_date' => 1,
							'option_id' => 1,
							'weight_id' => 1,
							'qty_id' => 10,
							'rate' => 10,
							'total' => 100,
							)
						),
			);
		echo json_encode($testar);die;  */
		//echo $order = $this->input->post('orderdetails');
		//echo '<pre>';print_r(json_decode($order));die;
		if($this->input->post() && $this->input->post('user_id') != '')
		{
			$value = array();
			$value = $this->input->post();
			$data = $this->Web_service_model->product_orders($value);
			echo $data; die;
			$result['status'] =  TRUE;
			$result['msg'] = 'Successfull';
			$result['is_value_inserted'] = 'TRUE';
			//die;
		}else{
			$result['status'] =  TRUE;
			$result['msg'] = 'User Does not exist';
			$result['is_value_inserted'] = 'FALSE';
		}
		echo json_encode($result);
	}

	


	
}?>