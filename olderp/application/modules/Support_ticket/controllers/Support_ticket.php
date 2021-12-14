<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support_ticket extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
			redirect(base_url().'login');
			}
		$this->load->model('Support_ticket_model');
		//$this->load->library('encrypt');
		$this->load->library('csvimport');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Support_ticket VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Support_ticket_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Support_ticket_model->get_Support_ticket();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['st_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Support_ticket/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Support_ticket/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		if($right_status == false)
		{
			$comm = '';
		}else
		{
			$comm = '<a title="Edit" href="'.base_url().'Support_ticket/add_communication/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-comments"></i></a>';
		}
		if($user[$i]['st_status'] == 1)
		{
			$tstatus = '<span class="label label-primary">Active</span>';
		}else{
			$tstatus = '<span class="label label-danger">Close</span>';
		}
		$records["data"][] = array(
			  ''.$user[$i]['st_coname'],
			  ''.$user[$i]['st_email'],
			  ''.$user[$i]['st_location'],
			  ''.$user[$i]['st_ticketno'],
			  ''.$user[$i]['support_fname'].' '.$user[$i]['support_lname'],
			  ''.$user[$i]['st_details'],
			  ''.$user[$i]['st_prodetails'],
			  ''.$user[$i]['attand_fname'].' '.$user[$i]['attand_lname'],
			  ''.$tstatus,
			  ''.$user[$i]['creted_fname'].' '.$user[$i]['creted_lname'],
			  ''.date("d-m-Y", strtotime($user[$i]['st_udate'])),
			 ''.$editstr.''.$deletestr.''.$comm.'',
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Support_ticket Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				//$value['Support_ticket_cdate'] = date('Y-m-d H:i:s');
				$value['Support_ticket_udate'] = date('Y-m-d H:i:s');
				$value['Support_ticket_cdate'] = date('Y-m-d H:i:s');
				$lid = $this->Support_ticket_model->add($value);

				if($value['st_sendemail'] == 1)
				{

				
						$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$mailerdata = $this->Support_ticket_model->get_mailer_detail($uid);
							$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
							//echo "<pre>";print_r($path);die;
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
							$message = "<b>".$value['st_coname'].",</b><br>"."Thank you for contacting us. This is an automated response confirming the receipt of your ticket. Our team will get back to you as soon as possible. When replying, please make sure that the ticket ID is kept in the subject so that we can track your replies.<br><br><br><br>";
							$message .= "<b>Ticket ID : </b>".$value['st_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$value['st_subject']."<br>";
							$message .= "<b>Details : </b>".$value['st_details']."<br>";
							$message .= "<b>Department : </b>technical<br>";
							if(isset($value['st_status']) && ($value['st_status'] == 1))
							{
								$message .= "<b style='color:#006400;'>Status : Active</b><br>";
							}else{
								$message .= "<b style='color:#F00;'>Status : Close</b><br>";
							}
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@aavadinstrument.com.<br><br>";
							//$message .= "<br><br><br><br><small>Design & Develop by Miconinfotech</small>";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
							$this->email->to($value['st_email']);// change it to yours
							$this->email->cc("aag@aavadinstrument.com");
							$this->email->subject("[#".$value['st_ticketno']."] : ".$value['st_subject']);
							$this->email->message($message);
							
						    if($this->email->send())
						    {
						      echo 'Email sent.';
						    }
						     else
						    {
						     show_error($this->email->print_debugger());
						    }
				}


				if($lid)
				{
					$this->session->set_flashdata('success', 'Support_ticket added successfully.');
					redirect(base_url('Support_ticket'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Support_ticket not added successfully!!');
					redirect(base_url('Support_ticket/add'), 'refresh');
				}
			 	redirect(base_url('Support_ticket'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Support_ticket Edit functionality");
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
					$value['Support_ticket_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->Support_ticket_model->edit($value,$idencr);

					if($value['st_sendemail'] == 1)
					{

					
							$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$mailerdata = $this->Support_ticket_model->get_mailer_detail($uid);
							$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
							//echo "<pre>";print_r($path);die;
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
							$message = "<b>".$value['st_coname'].",</b><br>"."Thank you for contacting us. This is an automated response confirming the receipt of your ticket. Our team will get back to you as soon as possible. When replying, please make sure that the ticket ID is kept in the subject so that we can track your replies.<br><br><br><br>";
							$message .= "<b>Ticket ID : </b>".$value['st_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$value['st_subject']."<br>";
							$message .= "<b>Details : </b>".$value['st_details']."<br>";
							$message .= "<b>Department : </b>technical<br>";
							$message .= "<b>Status : </b>Active<br>";
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@aavadinstrument.com.<br><br>";
							//$message .= "<br><br><br><br><small>Design & Develop by Miconinfotech</small>";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
							$this->email->to($value['st_email']);// change it to yours
							$this->email->cc("aag@aavadinstrument.com");
							$this->email->subject("[#".$value['st_ticketno']."] : ".$value['st_subject']);
							$this->email->message($message);
							
						    if($this->email->send())
						    {
						      echo 'Email sent.';
						    }
						     else
						    {
						     show_error($this->email->print_debugger());
						    }
					}

					if($lid)
					{
						$this->session->set_flashdata('success', 'Support_ticket edited successfully.');
						redirect(base_url('Support_ticket'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Support_ticket not edited successfully!!');
					}
				 	redirect(base_url('Support_ticket'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Support_ticket_model->get($idencr);
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['admins'] = $this->Support_ticket_model->get_admin();
						$this->data['st_code'] = $this->Support_ticket_model->st_no_get();
						$this->data['action'] = "Support_ticket/edit/".$enid;
						$this->data['main_content'] = 'Support_ticket_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Support_ticket not Available!!');
						 redirect(base_url('Support_ticket'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Support_ticket not Available!!');
					redirect(base_url('Support_ticket'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Support_ticket'), 'refresh'); 
		}
	}

	public function add_communication()
	{
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
					$value['udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					//echo "<pre>"; print_r($value); die;
					$lid = $this->Support_ticket_model->edit_communication($value,$idencr);


					if($value['st_sendemail'] == 1)
					{
							$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$ticketinfo = $this->Support_ticket_model->get($idencr);
							//echo "<pre>"; print_r($ticketinfo); die;
							$mailerdata = $this->Support_ticket_model->get_mailer_detail($uid);
							$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
							//echo "<pre>";print_r($path);die;
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
							$message = "<b>".$ticketinfo[0]['st_coname'].",</b><br><br>";
							$message .= "<br><br>";
							$message .= "<b>Ticket ID : </b>".$ticketinfo[0]['st_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$ticketinfo[0]['st_subject']."<br>";
							$message .= "<b>Details : </b>".$ticketinfo[0]['st_details']."<br>";
							$message .= "<b>Department : </b>Technical<br>";
							if(isset($ticketinfo[0]['st_status']) && ($ticketinfo[0]['st_status'] == 1))
							{
								$message .= "<b style='color:#006400;'>Status : Active</b><br>";
							}else{
								$message .= "<b style='color:#F00;'>Status : Close</b><br>";
							}
							//$message .= "<b>Status : </b>Active<br><br><br>";
							if($value['st_solution'] != '')
							{
								$message .= '<div style="font-size:18px; color:#cc3300;"><b>Solution : </b>'.$value['st_solution'].'<br><br>';
							}
							if($value['st_clientfeedback'] != '')
							{
								$message .= "<b>Client Feedback : </b>".$value['st_clientfeedback']."<br><br></div>";
							}
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@aavadinstrument.com.";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
							$this->email->to($ticketinfo[0]['st_email']);// change it to yours
							$this->email->cc("aag@aavadinstrument.com");
							$this->email->subject("[#".$ticketinfo[0]['st_ticketno']."] : ".$ticketinfo[0]['st_subject']);
							$this->email->message($message);
							
						    if($this->email->send())
						    {
						      echo 'Email sent.';
						    }
						     else
						    {
						     show_error($this->email->print_debugger());die;
						    }
					}
					if($lid)
					{	
						$this->session->set_flashdata('success', 'sales_b2b_inq_report edited successfully.');
						redirect(base_url('Support_ticket/add_communication/'.$enid), 'refresh');
					}else{
					
						$this->session->set_flashdata('error', 'sales_b2b_inq_report not edited successfully!!');
					}
				 	redirect(base_url('Support_ticket/add_communication/'.$enid), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != '')
				{
					$this->data['list'] = $this->Support_ticket_model->get($idencr);
					$this->data['chat_list'] = $this->Support_ticket_model->get_b2biq_chat($idencr);
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Support_ticket/add_communication/".$enid;
						$this->data['main_content'] = 'Support_ticket_communication_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{

						 $this->session->set_flashdata('error', 'Sales_b2b_enq_form_view not Available!!');
						 redirect(base_url('Support_ticket/add_communication'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales_b2b_enq_form_view not Available!!');
					redirect(base_url('Support_ticket/add_communication'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Support_ticket/add_communication'), 'refresh'); 
		}
	}

	public function delete_chat()
	{
				//echo "hiiiii";die;
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//echo "<pre>"; print_r($idencr); die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['b2bu_udate'] = date('Y-m-d H:i:s');
				$chat_id = $this->input->get('chatid') ? $this->input->get('chatid') : 0;
				$lid = $this->Support_ticket_model->delete_chat($value,$chat_id);
				if($lid)
				{
					$enid = $this->uri->segment(3) ? $this->encrypt_decrypt('encrypt', $idencr) : '';
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Support_ticket/add_communication/'.$enid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Support_ticket/add_communication/'.$idencr), 'refresh');
				}
			 	redirect(base_url('Support_ticket/add_communication/'.$idencr), 'refresh');
	}
	
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('st_ticketno', 'Support_ticket name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('st_ticketno', 'Support_ticket name', 'trim|required');  
			}
			else{
				$this->form_validation->set_rules('st_solution', 'Support_ticket name', 'trim|required'); 
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
		//$this->data['getSupport_ticket'] = $this->Support_ticket_model->addtSupport_ticket();
		$this->data['admins'] = $this->Support_ticket_model->get_admin();
		$this->data['st_code'] = $this->Support_ticket_model->st_no_get();
		$this->data['main_content'] = 'Support_ticket_form_view';
		$this->data['action'] = "Support_ticket/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Support_ticket Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Support_ticket_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Support_ticket_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Support_ticket deleted successfully.');
						redirect('Support_ticket', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Support_ticket not deleted successfully!!.');
							redirect('Support_ticket', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Support_ticket not Available!!');
			  		redirect('Support_ticket', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Support_ticket not Available!!');
					redirect('Support_ticket', 'refresh'); 
			}
			redirect('Support_ticket', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Support_ticket'), 'refresh'); 
		}
		//$this->country_model->delete();
		//redirect(base_url('admin/country'), 'refresh');
	}
	public function close_sts($id=false)
	{
		
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Support_ticket_model->get($idencr);
				if(!empty($this->data['list']))
				{
					$lid = $this->Support_ticket_model->close_sts($idencr);


						$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$ticketinfo = $this->Support_ticket_model->get($idencr);
							//echo "<pre>"; print_r($ticketinfo); die;
							$mailerdata = $this->Support_ticket_model->get_mailer_detail($uid);
							$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
							//echo "<pre>";print_r($path);die;
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
							$message = "<b>".$ticketinfo[0]['st_coname'].",</b><br><br>";
							$message .= "This message is regarding your ticket ID #PWC-472-91489. We are changing the status of this ticket to Closed as per our last discussion.<br><br>";
							$message .= "<b>Ticket ID : </b>".$ticketinfo[0]['st_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$ticketinfo[0]['st_subject']."<br>";
							$message .= "<b>Department : </b>Technical<br>";
							$message .= "<b style='color:#F00;'>Status : Close</b><br><br><br>";
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@aavadinstrument.com.";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
							$this->email->to($ticketinfo[0]['st_email']);// change it to yours
							$this->email->cc("aag@aavadinstrument.com");
							$this->email->subject("[#".$ticketinfo[0]['st_ticketno']."] : ".$ticketinfo[0]['st_subject']);
							$this->email->message($message);
							
						    if($this->email->send())
						    {
						      //echo 'Email sent.';
						    }
						     else
						    {
						     show_error($this->email->print_debugger());die;
						    }

						if ($lid) 
						{
							$this->session->set_flashdata('success', 'Support_ticket Close successfully.');
							redirect('Support_ticket', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Support_ticket not Close successfully!!.');
							redirect('Support_ticket', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Support_ticket not Available!!');
			  		redirect('Support_ticket', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Support_ticket not Available!!');
					redirect('Support_ticket', 'refresh'); 
			}
			redirect('Support_ticket', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Support_ticket'), 'refresh'); 
		}
	}

	public function get_country_from_country()
	{
		$value = $this->Support_ticket_model->get_country_from_country();
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
       $this->Support_ticket_model->insert_csv();  
    } 

	public function csvimport()
	{
		$this->data['action'] = "Support_ticket/importcsv";
		//parent::load_view('Support_ticket/importcsv_view', $this->data);
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 36,$type);
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