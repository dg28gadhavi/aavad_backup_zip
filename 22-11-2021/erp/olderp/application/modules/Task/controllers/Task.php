<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
			redirect(base_url().'login');
			}
		$this->load->model('Task_model');
		$this->load->library('encryption');
		$this->load->library('csvimport');
		$this->load->library('form_validation');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task VIew functionality");
			redirect(base_url());
		}
		$this->data['admins'] = $this->Task_model->get_admin();
		$this->data['work_tasts'] = $this->Task_model->get_tasks();
		$this->data['main_content'] = 'Task_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function get_customer_information()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$value = $this->input->get();
		if(isset($value['term']) && !empty($value['term']))
		{
			$this->Task_model->get_customer_information($value['term']);
		}
		
	}

	public function ajax()
	{
		$user = $this->Task_model->get_Task();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['task_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Task/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Task/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		if($right_status == false)
		{
			$comm = '';
		}else
		{
			$comm = '<a title="Edit" href="'.base_url().'Task/add_communication/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-comments"></i></a>';
		}
		if($user[$i]['is_completed'] == 2)
		{
			$tstatus = '<span class="label label-primary">Completed</span>';
		}else if($user[$i]['is_completed'] == 1){
			$tstatus = '<span class="label label-warning">Start</span>';
		}else{
			$tstatus = '<span class="label label-danger">Pending</span>';
		}
		$records["data"][] = array(
			  ''.$user[$i]['ticketno'],
			  ''.$user[$i]['task_subject'],
			  ''.$user[$i]['task_vendor'],
			  ''.$user[$i]['task_contactperson'],
			  ''.$user[$i]['task_mobile'],
			  ''.$user[$i]['task_email'],
			  ''.$user[$i]['type_of_work_name'],
			  ''.$user[$i]['task_location'],
			  ''.$user[$i]['task_details'],
			  ''.$user[$i]['task_expense'],
		  	  ''.$user[$i]['allot_first_name'].' '.$user[$i]['allot_last_name'],
		  	  ''.$user[$i]['given_by_first_name'].' '.$user[$i]['given_by_last_name'],
		  	  ''.$user[$i]['due_date'],
			  ''.$user[$i]['completed_date'],
			  ''.$tstatus,
			  ''.$deletestr.''/*.$comm.''*/,
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


	public function Task_report()
	{
		ini_set('memory_limit', '-1');
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task VIew functionality");
			redirect(base_url());
		}
		$this->data['admins'] = $this->Task_model->get_admin();
		//$this->data['report_result'] = $this->Task_model->get_totalreport();
		//$this->data['custometyps'] = $this->Task_model->get_customertype();
		//$this->data['work_tasts'] = $this->Task_model->get_tasks();
		$this->data['work_tasts'] = $this->Task_model->get_tasks();
		$this->data['main_content'] = 'Task_grid_view';
		$this->load->view('includes/template',$this->data);
	}
	
	public function add()
	{
		require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{
				//echo "<pre>"; print_r($_FILES); die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				//$value['Task_cdate'] = date('Y-m-d H:i:s');
				$value['task_udate'] = date('Y-m-d H:i:s');
				$value['task_cdate'] = date('Y-m-d');

				if(isset($_FILES['task_fileone']['name']) && ($_FILES['task_fileone']['name'] != '')){
					$folder_name = "task_fileone";
					$file_type = "task_fileone";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['task_fileone'] = $image['upload_data']['file_name'];
				}
				if(isset($_FILES['task_filetwo']['name']) && ($_FILES['task_filetwo']['name'] != '')){
					$folder_name = "task_filetwo";
					$file_type = "task_filetwo";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['task_filetwo'] = $image['upload_data']['file_name'];
				}


				$lid = $this->Task_model->add($value);
				if(isset($value['task_ismailsend']) && $value['task_ismailsend'] == 1){
					foreach ($value['task_email'] as $key => $task_mail) 
					{
								$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
								$mailerdata = $this->Task_model->get_mailer_detail($uid);
								if($mailerdata['au_gmail_email'] == '' || $mailerdata['au_gmail_password'] == '')
								{
									echo "Your Account is not configured. pl. add your email id and password in admin user list.";die;
								}
								//echo '<pre>';print_r($mailerdata);die;
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
								$message = 'Dear Sir,

Great meeting you yesterday. Hope for longtime business relationship with you.

If you have any query you can contact me on my mobile no.

Thank you very much for your time.';
								$this->load->library('email');
								$this->email->initialize($config);
								$this->email->set_newline("\r\n");
								$this->email->from($mailerdata['au_gmail_email']); 
								$this->email->to($task_mail);
								$this->email->subject("Thank you for meeting-Aavad Instruments");
								$this->email->message($message);
						      	if($this->email->send())
						     	{
								      echo 'Email sent.';
								      $this->session->set_flashdata('success', 'Mail sent successfully.');
									 redirect(base_url('Task'), 'refresh');
							     }
							     else
							    {
								     show_error($this->email->print_debugger());
								     $this->session->set_flashdata('error', 'Mail not sent successfully!!');
								     redirect(base_url('Task'), 'refresh');
							    }
					}
				}
				if($lid)
				{
					$this->session->set_flashdata('success', 'Task added successfully.');
					redirect(base_url('Task'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Task not added successfully!!');
					redirect(base_url('Task/add'), 'refresh');
				}
			 	redirect(base_url('Task'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	function do_upload_image($folder_name,$file_type,$width,$height)
	{
	
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < 10; $i++) 
			{
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
		$image_name = $randomString;
		$config['upload_path'] = 'uploads/'.$folder_name.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $image_name;
		$config['overwrite'] = TRUE;
		$config['max_size']	= '0';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($file_type))
		{
			$error = array('error' => $this->upload->display_errors());
			//$this->form_validation->set_rules('userfile', 'Document', 'required');
			echo $error['error'];
		}
		else
		{
			$data['upload']  = array('upload_data' => $this->upload->data());
			$filename = $data['upload']['upload_data']['file_name'];
			//$this->imageResize($filename,$wid = 244,$hei = 210,$file_folder = '244x210/');
			//$this->imageResize($filename,$wid = 205,$hei = 205,$file_folder = '220x220/');
			//$this->imageResize($filename,$wid = 95,$hei = 95,$file_folder = '95x95/');
			$config = '';
			//$fname = $config['upload_path'].$filename;
			$this->image_upload($filename,$wid = $width,$hei = $height,$file_folder = $width.'x'.$height,$upload_path = 'uploads/'.$folder_name.'/');
			//$this->image_upload($filename,$wid = 295,$hei = 295,$file_folder = '295x295' ,$upload_path = 'uploads/'.$folder_name.'/');
			return $data['upload'];
		}
	}

	public function image_upload($filename,$wid,$hei,$file_folder,$upload_path)
	{
			if (!is_dir('uploads') || !is_writable('uploads')):
			else:
			$image = new Zebra_Image();
			$image->source_path = $upload_path.$filename;
				$ext = substr($image->source_path, strrpos($image->source_path, '.') + 1);
				$image->target_path = $upload_path.$file_folder.'/'.$filename;
				if (!$image->resize($wid, $hei, ZEBRA_IMAGE_BOXED, -1)) ;
			endif;
	}

	public function task_complete()
	{
		//echo "<pre>";print_r($this->input->post(NULL,FALSE));die;
		if($this->input->post(NULL,FALSE))
		{
			$postdata = $this->input->post(NULL,FALSE);
			$status = $this->Task_model->set_as_complete_task($postdata);
			if($status  == 1)
			{
				$this->session->set_flashdata('success', 'Task Complete successfully.');
				redirect(base_url('Dashboard'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Task not Complete successfully!!');
				redirect(base_url('Dashboard'), 'refresh');
			}
		}
		
	}

	public function task_start()
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$rid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$rid =  $this->uri->segment(4) ? $this->encrypt_decrypt('decrypt', $rid) : '';
				
			$value = $this->input->get(NULL,FALSE);

			if($this->uri->segment(4))
			{
				$value = $this->input->get(NULL,FALSE);
				//echo "<pre>";print_r($value['task_complet']);die;
				if($value['task_complet'] == 0)
				{
					$idencr = $this->uri->segment(3);
					$rid =  $this->uri->segment(4);
					$lid = $this->Task_model->task_start($idencr,$rid);
					//echo "<pre>hiii";print_r($lid);die;
					if($lid  == 1)
					{
						//echo "<pre>";print_r($this->encrypt_decrypt('encrypt', $this->uri->segment(3)));die;
						$this->session->set_flashdata('success', 'Task Start successfully.');
						//redirect(base_url('Task/task_start'), 'refresh');
						redirect(base_url('Task/task_start/'.$this->encrypt_decrypt('encrypt', $this->uri->segment(3))), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Task not Start successfully!!');
					}
				 	redirect(base_url('Task'), 'refresh');
				}
				if($value['task_complet'] == 1)
				{
					//echo "hiii";die;
					$this->data['action'] = "Task/task_complete/".$this->uri->segment(3)."/".$this->uri->segment(4);
					$this->data['main_content'] = 'Task_complete_form_view';
					$this->load->view('includes/template',$this->data);
				}
				
			}
			else
			{
				if(isset($idencr) && $idencr != '')
				{
					$this->data['list'] = $this->Task_model->get($idencr);
					if(!empty($this->data['list']))
					{
						//echo "<pre>";print_r($this->data['list']);die;
						//echo "hi"; die;
						$this->data['admins'] = $this->Task_model->get_admin();
						$this->data['st_code'] = $this->Task_model->st_no_get();
						$this->data['action'] = "Task/edit/".$enid;
						$this->data['main_content'] = 'Task_start_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Task not Available!!');
						 redirect(base_url('Task'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Task not Available!!');
					redirect(base_url('Task'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task'), 'refresh'); 
		}
	}


	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task Edit functionality");
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
					$value['task_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					$lid = $this->Task_model->edit($value,$idencr);

					/*if($value['st_sendemail'] == 1)
					{

					
							$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$mailerdata = $this->Task_model->get_mailer_detail($uid);
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
							$message .= "<b>Ticket ID : </b>".$value['task_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$value['task_ticketno']."<br>";
							$message .= "<b>Details : </b>".$value['task_details']."<br>";
							$message .= "<b>Department : </b>technical<br>";
							$message .= "<b>Status : </b>Active<br>";
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@miconindia.com.";
							$message .= "<br><br><br><br><small>Design & Develop by Miconinfotech</small>";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
							//$this->email->to($value['st_email']);// change it to yours
							$this->email->cc("parag@miconindia.com");
							$this->email->subject("[#".$value['task_ticketno']."] : ".$value['task_subject']);
							$this->email->message($message);
							
						    if($this->email->send())
						    {
						      echo 'Email sent.';
						    }
						     else
						    {
						     show_error($this->email->print_debugger());
						    }
					}*/

					if($lid)
					{
						$this->session->set_flashdata('success', 'Task edited successfully.');
						redirect(base_url('Task'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Task not edited successfully!!');
					}
				 	redirect(base_url('Task'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Task_model->get($idencr);
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['admins'] = $this->Task_model->get_admin();
						$this->data['st_code'] = $this->Task_model->st_no_get();
						$this->data['action'] = "Task/edit/".$enid;
						$this->data['main_content'] = 'Task_form_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Task not Available!!');
						 redirect(base_url('Task'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Task not Available!!');
					redirect(base_url('Task'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task'), 'refresh'); 
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
					$value['task_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					//echo "<pre>"; print_r($value); die;
					$lid = $this->Task_model->edit_communication($value,$idencr);


					if($value['st_sendemail'] == 1)
					{
							$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$ticketinfo = $this->Task_model->get($idencr);
							//echo "<pre>"; print_r($ticketinfo); die;
							$mailerdata = $this->Task_model->get_mailer_detail($uid);
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
							//$message = "<b>".$ticketinfo[0]['st_coname'].",</b><br><br>";
							$message .= "<br><br>";
							$message .= "<b>Ticket ID : </b>".$ticketinfo[0]['task_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$ticketinfo[0]['task_subject']."<br>";
							$message .= "<b>Details : </b>".$ticketinfo[0]['task_details']."<br>";
							$message .= "<b>Department : </b>Technical<br>";
							if(isset($ticketinfo[0]['task_status']) && ($ticketinfo[0]['task_status'] == 1))
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
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@miconindia.com.";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
						//	$this->email->to($ticketinfo[0]['st_email']);// change it to yours
							$this->email->cc("parag@miconindia.com");
							$this->email->subject("[#".$ticketinfo[0]['task_ticketno']."] : ".$ticketinfo[0]['task_subject']);
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
						redirect(base_url('Task/add_communication/'.$enid), 'refresh');
					}else{
					
						$this->session->set_flashdata('error', 'sales_b2b_inq_report not edited successfully!!');
					}
				 	redirect(base_url('Task/add_communication/'.$enid), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != '')
				{
					$this->data['list'] = $this->Task_model->get($idencr);
					$this->data['chat_list'] = $this->Task_model->get_b2biq_chat($idencr);
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Task/add_communication/".$enid;
						$this->data['main_content'] = 'Task_communication_view';
						$this->load->view('includes/template',$this->data);
					}
					else
					{

						 $this->session->set_flashdata('error', 'Sales_b2b_enq_form_view not Available!!');
						 redirect(base_url('Task/add_communication'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales_b2b_enq_form_view not Available!!');
					redirect(base_url('Task/add_communication'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task/add_communication'), 'refresh'); 
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
				$lid = $this->Task_model->delete_chat($value,$chat_id);
				if($lid)
				{
					$enid = $this->uri->segment(3) ? $this->encrypt_decrypt('encrypt', $idencr) : '';
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Task/add_communication/'.$enid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Task/add_communication/'.$idencr), 'refresh');
				}
			 	redirect(base_url('Task/add_communication/'.$idencr), 'refresh');
	}
	
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('task_ticketno', 'Task name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('task_ticketno', 'Task name', 'trim|required');  
			}
			else{
				$this->form_validation->set_rules('st_solution', 'Task name', 'trim|required'); 
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

	public function task_dashboard()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task VIew functionality");
			redirect(base_url());
		}
		$data['inq_stats'] = $this->Task_model->get_inq_data();
		$data['get_reminder_task'] = $this->Task_model->get_reminder_task();
		$data['get_task_done'] = $this->Task_model->get_task_done();
		$data['main_content'] = 'Dashboard_taskview';
		$data['action'] = "task_dashboard";
		$this->load->view('includes/template', $data);
	}
	
	public function get_form()
	{	
		//$this->data['getTask'] = $this->Task_model->addtTask();
		$this->data['custometyps'] = $this->Task_model->get_customertype();
		$this->data['admins'] = $this->Task_model->get_admin();
		$this->data['tasks'] = $this->Task_model->get_tasks();
		$this->data['st_code'] = $this->Task_model->st_no_get();
		$this->data['main_content'] = 'Task_form_view';
		$this->data['action'] = "Task/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Task Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Task_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Task_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Task deleted successfully.');
						redirect('Task', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Task not deleted successfully!!.');
							redirect('Task', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Task not Available!!');
			  		redirect('Task', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Task not Available!!');
					redirect('Task', 'refresh'); 
			}
			redirect('Task', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task'), 'refresh'); 
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
				$this->data['list'] = $this->Task_model->get($idencr);
				if(!empty($this->data['list']))
				{
					$lid = $this->Task_model->close_sts($idencr);


						$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
							;
							$ticketinfo = $this->Task_model->get($idencr);
							//echo "<pre>"; print_r($ticketinfo); die;
							$mailerdata = $this->Task_model->get_mailer_detail($uid);
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
							//$message = "<b>".$ticketinfo[0]['st_coname'].",</b><br><br>";
							$message .= "This message is regarding your ticket ID #PWC-472-91489. We are changing the status of this ticket to Closed as per our last discussion.<br><br>";
							$message .= "<b>Ticket ID : </b>".$ticketinfo[0]['task_ticketno']."<br>";
							$message .= "<b>Subject : </b>".$ticketinfo[0]['task_subject']."<br>";
							$message .= "<b>Department : </b>Technical<br>";
							$message .= "<b style='color:#F00;'>Status : Close</b><br><br><br>";
							$message .= "<br><br>If you have any suggestion/feedback/complain about our support system than pl. do write to info@miconindia.com.";
							$this->load->library('email');
							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from($mailerdata['au_gmail_email']); // change it to yours
							//$this->email->to($ticketinfo[0]['st_email']);// change it to yours
							$this->email->cc("parag@miconindia.com");
							$this->email->subject("[#".$ticketinfo[0]['task_ticketno']."] : ".$ticketinfo[0]['task_subject']);
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
							$this->session->set_flashdata('success', 'Task Close successfully.');
							redirect('Task', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Task not Close successfully!!.');
							redirect('Task', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Task not Available!!');
			  		redirect('Task', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Task not Available!!');
					redirect('Task', 'refresh'); 
			}
			redirect('Task', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Task'), 'refresh'); 
		}
	}

	public function get_country_from_country()
	{
		$value = $this->Task_model->get_country_from_country();
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
       $this->Task_model->insert_csv();  
    } 

	public function csvimport()
	{
		$this->data['action'] = "Task/importcsv";
		//parent::load_view('Task/importcsv_view', $this->data);
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 35,$type);
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