<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_report extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
			redirect(base_url().'login');
			}
		$this->load->model('Payment_report_model');
		//$this->load->library('encrypt');
		$this->load->library('csvimport');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Payment_report VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Payment_report_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function inv_wise()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Payment_report VIew functionality");
			redirect(base_url());
		}
		if($this->input->get() && $this->input->get()['sq_sendemail'] == 1)
		{
			//echo "<pre>";print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));die;
			$inqdata = array();
			$inqdata['data'] = $this->Payment_report_model->get_inqmaildata();
			$mailerdata = $this->Payment_report_model->get_mailer_detail($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			//$to_mailerdata = $this->Payment_report_model->get_tomailer_detail();
			//echo "<pre>";print_r($inqdata['data']);die;
			$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
			$config = array();
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.gmail.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = 'noreplyaavad@gmail.com';
			$config['smtp_pass']    = 'aavad123';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not
			$message = '';
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($mailerdata['au_gmail_email']); // change it to yours
			$this->email->to($this->input->get()['sq_emailTO']);// change it to yours  bt_exporters@yahoo.co.in
			$message='Dear Sir,
			Please note our following payment is due, kindly release it asap.
			

			<u>Payment Details</u>

			<table border="1" cellspacing="0" style="border-collapse:collapse;"><tr style="background-color:#B2A1C7;"><th> Sr No </th><th> Customer Name </th><th> Invoice No</th><th> Invoice Date</th><th> Amount </th><th> Recived Amount </th><th> PO Number </th><th> PO Date </th><th> Payment Term</th></tr>';
			$id = 0;
			foreach ($inqdata['data'] as $key => $value) { $id++; 


			$message .= '<tr><td>'.$id.'</td><td>'.$value['otw_customer_name'].'</td><td>'.$value['otw_invno'].'</td><td>'.$value['otw_invdate'].'</td><td>'.$value['otw_invftotal_withgst'].'</td><td>'.$value['otw_paymentrecive'].'</td><td>'.$value['wo_po_no'].'</td><td>'.$value['wo_po_date'].'</td><td>'.$value['wo_paymentterms'].'</td></tr>';

			}

			$message.='</table>

			We are awaiting for your quick and prompt positive response.


			Kindly acknowledge receive of mail.

			With Regards,
 
			Ms. Anjali Nansoliya
			Accountant 
			Mobile no: 91-7874022823

			AAVAD INSTRUMENT 
			216-217, Sangath Mall - 1, 
			Opp: Engineering Collage, 
			Sabarmati - Gandhinagar road, 
			Motera. Ahmedabad - 380005 
			Phone : 91- 079 - 40095342
			E -mail : sales@aavadinstrument.com 
			               aavadinstrument@gmail.com 
			Website : www.aavadinstrument.com
			';
		   // echo $message;die;
			$this->email->subject(" PAYMENT REMINDER - AAVAD INSTRUMENT ");
			$this->email->message(nl2br($message));
			if(isset($this->input->get()['sq_emailcc']) && ($this->input->get()['sq_emailcc'] != ''))
			{
				$this->email->cc($this->input->get()['sq_emailcc']);// change it to yours
			}
	      	if($this->email->send())
	     	{
			      //echo 'Email sent.';
			      $this->session->set_flashdata('success', 'Mail sent successfully.');
				  redirect(base_url()."Payment_report/inv_wise");
		     }
		     else
		    {
		     show_error($this->email->print_debugger());
		     $this->session->set_flashdata('error', 'Mail not sent successfully!!');
		     redirect(base_url()."Payment_report/inv_wise");
		    }

		}
		$this->data['main_content'] = 'Payment_inv_wise_grid_view';
		$this->load->view('includes/template',$this->data);
	}
	public function overall_report()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Payment_report VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Payment_overall_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Payment_report_model->get_Payment_report();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['tran_paymentid']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Payment_report/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Payment_report/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$records["data"][] = array(
			  $id,
			  
			  ''.$user[$i]['master_party_com_name'],
			  ''.$user[$i]['tran_paymentitm_amt'],
			  ''.$user[$i]['tcreditpoints'],
			  ''.($user[$i]['tdebitpoints']-$user[$i]['tcreditpoints']),
			 '',
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

	public function ajax_inv_wise()
	{
		$user = $this->Payment_report_model->get_Payment_inv_wise();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['auto_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Payment_report/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Payment_report/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$records["data"][] = array(
			  $id,
			  ''.$user[$i]['otw_customer_name'],
			  ''.$user[$i]['otw_invno'],
			  ''.$user[$i]['otw_invdate'],
			  ''.$user[$i]['otw_invftotal_withgst'],
			  ''.$user[$i]['otw_paymentrecive'],
			  ''.$user[$i]['wo_po_no'],
			  ''.date("d-m-Y", strtotime($user[$i]['wo_po_date'])),
			  ''.$user[$i]['wo_paymentterms'],
			 '',
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

	public function ajax_overall()
	{
		$user = $this->Payment_report_model->get_Payment_overall();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['tran_paymentid']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Payment_report/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Payment_report/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		if($user[$i]['tran_paymentcr_or_dr'] == 1)
		{
			$sst="Credit";
		}else if($user[$i]['tran_paymentcr_or_dr'] == 2){
			$sst="Debit";
		}
		$records["data"][] = array(
			  $id,
			  ''.$user[$i]['master_party_com_name'],
			  ''.$sst,
			  ''.$user[$i]['tran_paymentitm_amt'],
			  ''.$user[$i]['crp_type'],
			  ''.$user[$i]['crp_bankname'],
			  ''.$user[$i]['crp_invno'],
			  ''.$user[$i]['crp_refno'],
			  ''.$user[$i]['crp_paymentdate'],
			  ''.$user[$i]['crp_remark'],
			  
			  ''.date("d-m-Y", strtotime($user[$i]['tran_paymentudate'])),
			 '',
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Payment_report Add functionality");
			//echo $this->session->flashdata('rights_error');die;
			redirect(base_url(),'refresh');
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				//$value['Payment_report_cdate'] = date('Y-m-d H:i:s');
				$value['crp_cdate'] = date('Y-m-d H:i:s');
				$lid = $this->Payment_report_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Payment_report added successfully.');
					redirect(base_url('Payment_report'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Payment_report not added successfully!!');
					redirect(base_url('Payment_report/add'), 'refresh');
				}
			 	redirect(base_url('Payment_report'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Payment_report Edit functionality");
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
					$lid = $this->Payment_report_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Payment_report edited successfully.');
						redirect(base_url('Payment_report'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Payment_report not edited successfully!!');
					}
				 	redirect(base_url('Payment_report'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Payment_report_model->get($idencr);
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						//echo "<pre>"; print_r($this->data['list']); die;
						$this->data['states'] = $this->Payment_report_model->get_state($this->data['list'][0]['Payment_report_country']);
						$this->data['country'] = $this->Payment_report_model->get_country();
						$this->data['action'] = "Payment_report/edit/".$enid;
						$this->data['main_content'] = 'Payment_report_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Payment_report not Available!!');
						 redirect(base_url('Payment_report'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Payment_report not Available!!');
					redirect(base_url('Payment_report'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Payment_report'), 'refresh'); 
		}
	}
	
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('vendor', 'Payment_report name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('vendor', 'Payment_report name', 'trim|required');  
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
		//$this->data['getPayment_report'] = $this->Payment_report_model->addtPayment_report();
		$this->data['inv_no'] = $this->Payment_report_model->get_inv_no();
		$this->data['main_content'] = 'Payment_report_form_view';
		$this->data['action'] = "Payment_report/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Payment_report Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Payment_report_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Payment_report_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Payment_report deleted successfully.');
						redirect('Payment_report', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Payment_report not deleted successfully!!.');
							redirect('Payment_report', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Payment_report not Available!!');
			  		redirect('Payment_report', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Payment_report not Available!!');
					redirect('Payment_report', 'refresh'); 
			}
			redirect('Payment_report', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Payment_report'), 'refresh'); 
		}
		//$this->country_model->delete();
		//redirect(base_url('admin/country'), 'refresh');
	}

	public function get_country_from_country()
	{
		$value = $this->Payment_report_model->get_country_from_country();
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
       $this->Payment_report_model->insert_csv();  
    } 

	public function csvimport()
	{
		$this->data['action'] = "Payment_report/importcsv";
		//parent::load_view('Payment_report/importcsv_view', $this->data);
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 40,$type);
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