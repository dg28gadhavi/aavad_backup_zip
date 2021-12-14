<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_mgmt extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('Store_mgmt_model');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->library('image_lib');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Store_mgmt_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Store_mgmt_model->Store_mgmt_report();
		//echo '<pre>';print_r($user[0]['wom_otw_completd']);die;
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
		$admin_users=$this->Store_mgmt_model->get_admin_users();
		
		for($i = $iDisplayStart; $i < $end; $i++) 
		{
			if($user[$i]['wom_otw_completd']==1)
			{
				$admin_select='';
				$admin_select.='<select name="uname" id="uname" class="form-control">';
				foreach ($admin_users as $key => $admin_user) 
				{
					$admin_select.='<option value="'.$admin_user['au_id'].'">'.$admin_user['au_fname'].'</option>';
				}
				$admin_select.='</select>';
			}else{
				$admin_select='';
			}

		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['master_item_id']);
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			if($user[$i]['wom_otw_completd']==1)
			{
			   $editstr = '<button class="btn btn-success" type="submit"> <i class="fa fa-check-square"></i> </button>';
			}
			else{
				$editstr = '';
			}
		}
		$right_status = $this->check_rights('delete');
		$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$user[$i]['master_item_id'].'">',
			     $id,
				''.$user[$i]['master_item_name'],
				''.$user[$i]['master_item_part_no'],
				''.$user[$i]['wom_qty'],
			  '<form action="'.base_url().'Store_mgmt/assign_production/?womid='.$user[$i]['wom_id'].'" method="post">'.$admin_select.''.$editstr.'</form>',
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
	
	public function Store_mgmt_report()
	{
		ini_set('memory_limit', '-1');
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt VIew functionality");
			redirect(base_url());
		}
		$this->data['admins'] = $this->Store_mgmt_model->get_admin();
		//$this->data['custometyps'] = $this->Store_mgmt_model->get_customertype();
		//$this->data['Store_mgmt'] = $this->Store_mgmt_model->get_Store_mgmt();
		$this->data['main_content'] = 'Store_mgmt_report';
		$this->load->view('includes/template',$this->data);
	}
	
	public function assign_production()
	{
		$value=$this->input->post(NULL,TRUE);
		$womid=$this->input->get('womid');
		//echo "<pre>";print_r($value);die;
		$this->Store_mgmt_model->assign_production($value,$womid);
		redirect(base_url('Store_mgmt'), 'refresh');
	}

	public function store_approve()
	{
		$otwiid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo '<pre>';print_r($otwiid);die;
		$this->Store_mgmt_model->store_approve($otwiid);
		redirect(base_url('Store_mgmt'), 'refresh');

	}
	public function validation() 
	{
		//echo "hiii";die;
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add')
			{
				$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				//$this->form_validation->set_rules('sq_email', 'Email', 'trim|required');  
				//$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');   
			}
			else 
			{
				//echo "hiiixsds";die;
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				//$this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
				$this->form_validation->set_rules('b2bu_remark', 'Email', 'trim|required');   
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
		$this->data['custometyps'] = $this->Store_mgmt_model->get_customertype();
		$this->data['cities'] = $this->Store_mgmt_model->get_city();
		$this->data['countries'] = $this->Store_mgmt_model->get_country();
		$this->data['wo_no'] = $this->Store_mgmt_model->wo_no_get();
		$this->data['vendors'] = $this->Store_mgmt_model->get_masterparty();
		$this->data['admins'] = $this->Store_mgmt_model->get_admin();
		$this->data['main_content'] = 'Store_mgmt_form_view';
		$this->data['action'] = "Store_mgmt/add";
		$this->load->view('includes/template',$this->data);
	}

	public function Store_mgmttopo()
	{
		echo "<pre>"; print_r($this->input->get()); die;
		$lid = $this->indend_model->Store_mgmttopo();
		if(isset($lid))
		{
			$this->load->model('master/purchase/purchase_model');
			$pdfdata = $this->purchase_model->get_pdfdata($lid,'purchase');
			//echo '<pre>';print_r($pdfdata);die;
			$html = $this->load->view('admin/master/purchase/purchase_pdf_view',$pdfdata,TRUE);
			//$html=$this->data['result_view'];
			$header='';
			$footer='';
			$pdfFilePath = FCPATH.'/pdf/pur/pur'.$lid.'.pdf';
			$data['page_title'] = 'Hello world';
			ini_set('memory_limit','32M');
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			//$pdf->SetFooter($footer);
			//$pdf->SetHTMLHeader($header);
			//$pdf->SetMargins(15, 15, 15);
			//$pdf->SetHeaderMargin(15);
			//$pdf->SetFooterMargin(15);
			$pdf->SetAutoPageBreak(TRUE, 15);
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F');
		}
		redirect(base_url('admin/purchase_new/booktab?bookid='.$lid), 'refresh');
		//redirect(base_url('admin/purchase/edit?id='.$lid), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Store_mgmt_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->Store_mgmt_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Store_mgmt deleted successfully.');
						redirect('Store_mgmt/Store_mgmt_report', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Store_mgmt not deleted successfully!!.');
							redirect('Store_mgmt/Store_mgmt_report', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Store_mgmt not Available!!');
			  		redirect('Store_mgmt/Store_mgmt_report', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Store_mgmt not Available!!');
					redirect('Store_mgmt/Store_mgmt_report', 'refresh'); 
			}
			redirect('Store_mgmt/Store_mgmt_report', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Store_mgmt/Store_mgmt_report'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt Delete functionality");
			redirect(base_url());
		}
		//echo '<pre>';print_r($this->input->get('delid'));die;
		$myid = $this->input->get('delid');
		if($myid && is_array($myid) && !empty($myid))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->Store_mgmt_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->Store_mgmt_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Store_mgmt inquiry deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Store_mgmt inquiry not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Store_mgmt inquiry not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Store_mgmt inquiry not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Store_mgmt'), 'refresh');

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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 37,$type);
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

	public function setbit_Store_mgmt()
	{
		$this->Store_mgmt_model->setbit_Store_mgmt();
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
	
	public function getsub_category()
	{
		//echo $this->input->post('id');die;
		$this->abc['source_cat_id'] = $this->input->post('id');
		//echo $this->abc['source_cat_id'];die;
		$this->data['sub_catlists'] = $this->Store_mgmt_model->get_subsource($this->abc);
		echo json_encode($this->data);
	}

	public function item_description()
	{
		if($this->input->post() && $this->input->post('master_item_id'))
		{
			$id = $this->input->post('master_item_id');
			$array = $this->Store_mgmt_model->get_item_description($id);
			//$array = $this->booking_order_model->get_ajaxItmtotax($id);
			//$this->item_tax_content($array);
			echo json_encode($array);
		}else{
			$array = array();
			echo json_encode($array);
		}
		
	}

	public function get_customer_information()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$value = $this->input->get();
		if(isset($value['term']) && !empty($value['term']))
		{
			$this->Store_mgmt_model->get_customer_information($value['term']);
		}
		
	}

	public function get_hc()
	{
		$id = $this->input->post('vendor');
		if(isset($id) && ($id != ''))
		{
			$value = $this->Store_mgmt_model->get_hcs($id);
			echo json_encode($value);
		}
	}

	public function delete_Store_mgmt_item($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$said = $this->uri->segment(3) ? $this->uri->segment(4) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$sa_id = $this->uri->segment(4) ? $this->encrypt_decrypt('decrypt', $said) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',2);
					$lid = $this->Store_mgmt_model->delete_Store_mgmt_item($idencr,$sa_id);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					// $pdfdata = $this->Store_mgmt_model->get_pdfdata($autoid,'Store_mgmt');
					// //echo '<pre>';print_r($pdfdata);die;
					// $html = $this->load->view('Store_mgmt/Store_mgmt_pdf_view',$pdfdata,TRUE);
					// //$html=$this->data['result_view'];
					// $header='';
					// $footer='';
					// $pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$autoid).'.pdf';
					// $data['page_title'] = 'Hello world';
					// ini_set('memory_limit','32M');
					// $this->load->library('pdf');
					// $pdf = $this->pdf->load();
					// $pdf->SetAutoPageBreak(TRUE, 15);
					// $pdf->WriteHTML($html); // write the HTML into the PDF
					// $pdf->Output($pdfFilePath, 'F');
					//***********PDF File Code End********************
						if ($lid) {
						$this->session->set_flashdata('success', 'Store_mgmt inquiry deleted successfully.');
						redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Store_mgmt inquiry not deleted successfully!!.');
							redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Store_mgmt inquiry not Available!!');
					redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Store_mgmt/other_details/'.$this->uri->segment(4)), 'refresh'); 
		}
	}

	public function status_act($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Store_mgmt_model->status_act($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('inq-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('inq-followup', 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('inq-followup', 'refresh'); 
			}
			redirect('inq-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('inq-followup', 'refresh'); 
		}
	}

	public function status_deact($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Store_mgmt_model->status_deact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status changed successfully.');
						redirect('inq-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status not changed successfully!!.');
							redirect('inq-followup', 'refresh');
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('inq-followup', 'refresh'); 
			}
			redirect('inq-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('inq-followup', 'refresh'); 
		}
	}

	public function delete_fup($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Store_mgmt inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Store_mgmt_model->delete_fup($idencr);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
					$pdfdata = $this->Store_mgmt_model->get_pdfdata($autoid,'Store_mgmt');
					//echo '<pre>';print_r($pdfdata);die;
					$html = $this->load->view('Store_mgmt/Store_mgmt_pdf_view',$pdfdata,TRUE);
					//$html=$this->data['result_view'];
					$header='';
					$footer='';
					$pdfFilePath = FCPATH.'/pdf/enq/enq'.$this->encrypt_decrypt('encrypt',$autoid).'.pdf';
					$data['page_title'] = 'Hello world';
					ini_set('memory_limit','32M');
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetAutoPageBreak(TRUE, 15);
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					//***********PDF File Code End********************
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Store_mgmt/other_details/'.$this->uri->segment(4)), 'refresh'); 
		}
	}

	public function delete_fup_sec($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('tabno',3);
					$lid = $this->Store_mgmt_model->delete_fup($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('inq-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('inq-followup', 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('inq-followup', 'refresh'); 
			}
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('inq-followup', 'refresh'); 
		}
	}

	public function get_item_details()
	{
		//echo "<pre>"; print_r($this->input->get()); die;
		$value = $this->input->get();
		if(isset($value['term']) && !empty($value['term']))
		{
			$this->Store_mgmt_model->get_item_details($value['term']);
		}
	}

	public function create_quote()
	{
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$lid = $this->Store_mgmt_model->create_qoute($id);
		$qlid = $this->encrypt_decrypt('encrypt', $lid);
		//redirect(base_url().'Sale_quotation/quatation_tab/'.$qlid);
		$this->load->model('Sale_quotation_model');
		$pdfdata = $this->Sale_quotation_model->get_pdfdata($lid,'sale_quotation');
		//echo '<pre>';print_r($pdfdata);die;
		$html = $this->load->view('Sale_quotation/Sale_quotation_pdf_view',$pdfdata,TRUE);
		//$html=$this->data['result_view'];
		$header='';
		$footer='';
		$pdfFilePath = FCPATH.'/pdf/quot/quote'.$qlid.'.pdf';
		$data['page_title'] = 'Hello world';
		ini_set('memory_limit','325445M');
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		//$pdf->SetFooter($footer);
		//$pdf->SetHTMLHeader($header);
		//$pdf->SetMargins(15, 15, 15);
		//$pdf->SetHeaderMargin(15);
		//$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output($pdfFilePath, 'F');
		redirect(base_url().'Sale_quotation/quatation_tab/'.$qlid);
		
	}

	public function change_fstatus_toact($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access this functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',3);
					$lid = $this->Store_mgmt_model->status_act($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status Changed successfully.');
						redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status  not Changed successfully!!.');
							redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function change_fstatus_todeact($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access this functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->session->set_userdata('qtabno',3);
					$lid = $this->Store_mgmt_model->status_deact($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup status Changed successfully.');
						redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup status  not Changed successfully!!.');
							redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Store_mgmt/other_details/'.$this->uri->segment(4), 'refresh'); 
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
		$config['width'] = 200;
        $config['height'] = 62;
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

	public function store_excel()
	{

ini_set('memory_limit','3222222222222222222222222222222222222222M');

		$this->load->helper('download');



		$this->load->library('excel');



		$this->excel->setActiveSheetIndex(0);



        //name the worksheet



        $this->excel->getActiveSheet()->setTitle('MiconFile');



        $finalar = $this->Store_mgmt_model->get_excel_certificate();
        //echo "<pre>"; print_r($finalar); die;
        //echo $this->db->last_query(); die;
        $fhead = array('Sr. No','Inq. Date','Comapany name','client name','contact no','email id','city','Part no','qty','product price','grand total','inq status','source','remark');
        $i=0;
 		foreach ($finalar as $fkey => $fvalue) { $i++;
 			if($finalar[$fkey]['sq_id'])
 			{
 				$finalar[$fkey]['sq_id'] = $i;
 			}
 			
 			if($finalar[$fkey]['sq_end_st'] == 1)
 			{
 				$finalar[$fkey]['sq_end_st'] = 'Active';
 			}else if($finalar[$fkey]['sq_end_st'] == 2){
 				$finalar[$fkey]['sq_end_st'] = 'Pending';
 			}else if($finalar[$fkey]['sq_end_st'] == 3){
 				$finalar[$fkey]['sq_end_st'] = 'Completed';
 			}else{
 				$finalar[$fkey]['sq_end_st'] = '';
 			}
		

 			//echo '<pre>';print_r(explode('-',$fvalue['vf_img_allot_dt']));die;
 			// $datechange = explode('-',$fvalue['sa_enq_date']);

 			// if(isset($datechange[0]))
 			// {
 			// 	$date = str_replace('20','',$datechange[0]);
 			// }else{
 			// 	$data = '00';
 			// }
 			// if(isset($datechange[2]))
 			// {
 			// 	$year = '20'.$datechange[2].'';
 			// }else{
 			// 	$year = '0000';
 			// }
 			// if(!isset($datechange[1]))
 			// {
 			// 	$datechange[1] = '00';
 			// }
 			// $finalar[$fkey]['sa_enq_date'] = $newDate = date("d-m-Y", strtotime($year.'-'.$datechange[1].'-'.$date));
 			// $cdatechange = explode('-',$fvalue['sa_udate']);
 			// if(isset($datechange[0]))
 			// {
 			// 	$cdate = str_replace('20','',$cdatechange[0]);
 			// }else{
 			// 	$cdate = '00';
 			// }
 			// if(isset($cdatechange[2]))
 			// {
 			// 	$cyear = '20'.$cdatechange[2].'';
 			// }else{
 			// 	$cyear = '0000';
 			// }
 			// if(!isset($cdatechange[1]))
 			// {
 			// 	$cdatechange[1] = '00';
 			// }
 			// $finalar[$fkey]['sa_udate'] = $newDate = date("d-m-Y", strtotime($cyear.'-'.$cdatechange[1].'-'.$cdate));
 		} 

 		$datas = array_unshift($finalar, $fhead);

//echo '<pre>';print_r($finalar);die;

 		$this->excel->getActiveSheet()->fromArray($finalar);

        $filename='micon.xls'; //save our workbook as this file name

 		ob_end_clean();

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)



        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 


        //force user to download the Excel file without writing it to server's HD



        $objWriter->save('php://output');

	}

	public function get_country_to_state()
	{
		$countyid = $this->input->post('countryID') ? $this->input->post('countryID') : 0;
		if(isset($countyid) && $countyid != 0)
		{
			$statelists = $this->Store_mgmt_model->get_country_to_state($countyid);
		}else{
			$statelists = array();
		}
		echo json_encode($statelists);die;
	}//

	public function get_state_to_city()
	{
		$stateID = $this->input->post('stateID') ? $this->input->post('stateID') : 0;
		if(isset($stateID) && $stateID != 0)
		{
			$citylists = $this->Store_mgmt_model->get_state_to_city($stateID);
		}else{
			$citylists = array();
		}
		echo json_encode($citylists);die;
	}



}?>