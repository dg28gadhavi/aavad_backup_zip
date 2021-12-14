<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_vendor extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		//$this->load->model('menu_model');
		$this->load->model('Master_vendor_model');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->helper('text');
		$this->load->library('image_lib');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master Vendor View functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Master_vendor_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Master_vendor_model->get_master_vendor_report();
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['master_vendor_id']);
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Master_vendor/quatation_tab/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Master_vendor/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-trash"></i></a>';
		}
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a href="'.base_url().'pdf/quot/quot'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-search"></i> View PDF</a>';
		}

		$records["data"][] = array(
			  		''.$id,
				''.$user[$i]['master_vendor_com_name'],
				''.$user[$i]['master_vendor_office_address'],
				''.$user[$i]['master_vendor_email_address'],
				''.$user[$i]['master_vendor_office_no'],
				''.$user[$i]['master_vendor_mobile_no'],
				''.date("d-m-Y", strtotime($user[$i]['master_vendor_cdate'])),
				''.$editstr.''.$deletestr.'',
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
		//require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master Vendor Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post());die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['master_vendor_cdate'] = date('Y-m-d H:i:s');
				$value['master_vendor_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('qtabno',2);
				$lid = $this->Master_vendor_model->add($value);
				$this->session->set_userdata('qtabno',1);
				/*//***********PDF File Code Start********************
				$pdfdata = $this->Master_vendor_model->get_pdfdata($lid,'Master_vendor');
				//echo '<pre>';print_r($pdfdata);die;
				$html = $this->load->view('Master_vendor/Master_vendor_pdf_view',$pdfdata,TRUE);
				//$html=$this->data['result_view'];
				$header='';
				$footer='';
				$pdfFilePath = FCPATH.'/pdf/quot/quote'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
				$data['page_title'] = 'Hello world';
				ini_set('memory_limit','32M');
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetAutoPageBreak(TRUE, 15);
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($pdfFilePath, 'F');
				//***********PDF File Code End ********************		*/
				if($lid)
				{
					$this->session->set_flashdata('success', 'Master Vendor added successfully.');
					redirect(base_url('Master_vendor/quatation_tab'."/".$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Master Vendor not added successfully!!');
					redirect(base_url('Master_vendor/add'), 'refresh');
				}
			 	redirect(base_url('Master_vendor'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master Vendor Edit functionality");
			redirect(base_url());
		}
		//require 'Zebra_Image.php';
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$success = $this->validation();
			
			if($success == TRUE)
			{
				if($this->input->post(NULL,FALSE))
				{
					//echo "<pre>"; print_r($this->input->post()); die;
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['master_vendor_udate'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->Master_vendor_model->edit($value,$idencr);

					//***********PDF File Code Start********************
						$pdfdata = $this->Master_vendor_model->get_pdfdata($lid,'Master_vendor');
						//echo '<pre>';print_r($pdfdata);die;
						$html = $this->load->view('Master_vendor/Master_vendor_pdf_view',$pdfdata,TRUE);
						//$html=$this->data['result_view'];
						$header='';
						$footer='';
						$pdfFilePath = FCPATH.'/pdf/quot/quot'.$this->encrypt_decrypt('encrypt',$lid).'.pdf';
						$data['page_title'] = 'Hello world';
						ini_set('memory_limit','32M');
						$this->load->library('pdf');
						$pdf = $this->pdf->load();
						$pdf->SetAutoPageBreak(TRUE, 15);
						$pdf->WriteHTML($html); // write the HTML into the PDF
						$pdf->Output($pdfFilePath, 'F');
						//die;
				//***********PDF File Code End ********************	
					if($lid)
					{
						$this->session->set_flashdata('success', 'Sales Quotation edited successfully.');
						redirect(base_url('Master_vendor'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Sales Quotationnot edited successfully!!');
					}
				 	redirect(base_url('Master_vendor'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->Master_vendor_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['countries'] = $this->Master_vendor_model->get_country();
						$this->data['states'] = $this->Master_vendor_model->get_state();
						$this->data['cities'] = $this->Master_vendor_model->get_city();
						$this->data['brands'] = $this->Master_vendor_model->get_salesbrand();
						$this->data['Master_vendor_com_names'] = $this->Master_vendor_model->get_masterparty();
						$this->data['modeinquries'] = $this->Master_vendor_model->get_modeinquiry();
						$this->data['sources'] = $this->Master_vendor_model->get_sourcecat();
						$this->data['subsources'] = $this->Master_vendor_model->get_sourcesub_category();
						$this->data['action'] = "Master_vendor/edit/".$enid;
						$this->data['main_content'] = 'Master_vendor_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/Master_vendor/Master_vendor_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Sales Quotation not Available!!');
						 redirect(base_url('Master_vendor'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Sales Quotation not Available!!');
					redirect(base_url('Master_vendor'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Master_vendor'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('master_vendor_com_name', 'master_vendor_com_name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('master_vendor_com_name', 'master_vendor_com_name', 'trim|required');  
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
		//$this->data['getMaster_vendor'] = $this->Master_vendor_model->addtMaster_vendor();
		$this->data['custometyps'] = $this->Master_vendor_model->get_customertype();
		$this->data['currencys'] = $this->Master_vendor_model->get_currency();
		$this->data['party_code'] = $this->Master_vendor_model->sa_no_get();
		$this->data['admins'] = $this->Master_vendor_model->get_admin();
		$this->data['countries'] = $this->Master_vendor_model->get_country();
		$this->data['states'] = $this->Master_vendor_model->get_state_data();
		$this->data['citys'] = $this->Master_vendor_model->get_city_data();
		$this->data['tax_cats'] = $this->Master_vendor_model->get_taxs_data();
		$this->data['main_content'] = 'Master_vendor_form_view';
		$this->data['action'] = "Master_vendor/add";
		$this->load->view('includes/template',$this->data);
	}
	public function quatation_tab()
	{
		//echo "hiii";die;
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['getMaster_vendor'] = $this->Master_vendor_model->addtMaster_vendor();
		//$this->data['custometyps'] = $this->Master_vendor_model->get_customertype();
		$this->data['countries'] = $this->Master_vendor_model->get_country();
		$this->data['list'] = $this->Master_vendor_model->get($idencr);
		$this->data['items'] = $this->Master_vendor_model->get_items($idencr);
		//echo "<pre>"; print_r($this->data['items']); die;
		if($this->input->get('acttype') && $this->input->get('itemid') && ($this->input->get('acttype') == 'edit'))
		{
			$eitemid = $this->input->get('itemid');
			$this->data['edit_items'] = $this->Master_vendor_model->get_edit_inqitems($idencr,$eitemid);
			//echo '<pre>';print_r($this->data['edit_items']);die;
			$this->data['action_item'] = "Master_vendor/item_edit/".$this->uri->segment(3).'?acttype=edit&itemid='.$eitemid;
		}else{
			$this->data['action_item'] = "Master_vendor/item_details/".$this->uri->segment(3);
		}

		$this->data['custometyps'] = $this->Master_vendor_model->get_customertype();
		$this->data['currencys'] = $this->Master_vendor_model->get_currency();
		$this->data['party_code'] = $this->Master_vendor_model->sa_no_get();
		$this->data['admins'] = $this->Master_vendor_model->get_admin();
		$this->data['countries'] = $this->Master_vendor_model->get_country();
		$this->data['states'] = $this->Master_vendor_model->get_state_data();
		$this->data['citys'] = $this->Master_vendor_model->get_city_data();
		$this->data['tax_cats'] = $this->Master_vendor_model->get_taxs_data();
		$this->data['main_content'] = 'Master_vendor_tab_form_view';
		$this->data['action_bd'] = "Master_vendor/add/".$this->uri->segment(3);
		// $this->data['action_item'] = "Master_vendor/item_details/".$this->uri->segment(3);
		//$this->data['action_other'] = "Master_vendor/other_details/".$this->uri->segment(3);
		//$this->data['action_follow'] = "Master_vendor/follow_details/".$this->uri->segment(3);
		//$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		//$this->data['item_data'] = $this->Master_vendor_model->get_item_data($enid);
		$this->load->view('includes/template',$this->data);
	}
	public function item_edit()
	{
		ini_set('memory_limit', '-1');
			require 'Zebra_Image.php';
			$right_status = $this->check_rights('edit');
			if($right_status == false)
			{
				$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales Qua Edit functionality");
				redirect(base_url());
			}
			//echo "<pre>"; print_r($_FILES); die;
			
		
			if($this->input->get('acttype') && ($this->input->get('acttype') == 'edit') && $this->input->get('itemid'))
			{	
				//echo "<pre>"; print_r($this->input->post()); die;
			//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['master_vendor_udate'] = date('Y-m-d H:i:s');
				$this->session->set_userdata('tabno',2);
					if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$result = $this->Master_vendor_model->item_img($value);
					//if(count($result) > 0)
					//{
						$folder_name = "master_item_img";
						$file_type = "master_item_img";
						$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
						$value['master_item_img'] = $image['upload_data']['file_name'];
					//}
				}
				$sqiitemid = $this->input->get('itemid') ? $this->input->get('itemid') : 0;
				$lid = $this->Master_vendor_model->item_edit($value,$sqiitemid);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Details of item Edited successfully.');
					redirect(base_url('Master_vendor/quatation_tab/'.$this->uri->segment(3).'?acttype=edit&itemid='.$sqiitemid), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Details of item not Edited successfully!!');
					redirect(base_url('Master_vendor/quatation_tab'), 'refresh');
				}
			 	redirect(base_url('Master_vendor'), 'refresh');
			}else{
			$this->quatation_tab();
		}
	}

	public function item_details()
	{
		require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales Enq Add functionality");
			redirect(base_url());
		}

				//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				
				//$value['master_vendor_udate'] = date('Y-m-d H:i:s');
				$enid =$this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
				//echo "$enid";die();
				$this->session->set_userdata('qtabno',2);
				
				$lid = $this->Master_vendor_model->item_add($value,$enid);
				if($lid)
				{
					//echo "$lid";die();
					$this->session->set_flashdata('success', 'Item Details added successfully.');
					redirect(base_url('Master_vendor/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}else
				{
					$this->session->set_flashdata('error', 'Item Details not added successfully!!');
					//redirect(base_url('Master_vendor/add'), 'refresh');
					redirect(base_url('Master_vendor/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
				}
			 	//redirect(base_url('Master_vendor'), 'refresh');
			 	redirect(base_url('Master_vendor/quatation_tab/'.$this->encrypt_decrypt('encrypt',$lid)), 'refresh');
			
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
					$lid = $this->Master_vendor_model->delete_fup($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('qoutation-followup', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('qoutation-followup', 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('qoutation-followup', 'refresh'); 
			}
			redirect('qoutation-followup', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('qoutation-followup', 'refresh'); 
		}
	}
	
	public function delete_items($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master Vendor Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$itemid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo $itemid; die;
		if($itemid && ($itemid != ''))

		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $itemid) : '';

			if(isset($itemid) && $itemid!= '')
			{


					$lid = $this->Master_vendor_model->delete_select_item($itemid,$enid);
					
						if ($enid) 
						{
							//echo $enid; die;
						$this->session->set_flashdata('success', 'item deleted successfully.');

						redirect(base_url('Master_vendor/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

						} else {

							$this->session->set_flashdata('error', 'item not deleted successfully!!.');

							redirect(base_url('Master_vendor/add'), 'refresh'); 
						}						
			}
			else{

					$this->session->set_flashdata('error', 'item not Available!!');

					redirect(base_url('Master_vendor/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

			}

			redirect(base_url('Master_vendor/item_details/'.$this->encrypt_decrypt('encrypt',$enid)), 'refresh');

		}else{

			$this->session->set_flashdata('error', 'Something went wrong');

			redirect('Start_production', 'refresh'); 

		}

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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales Quotation Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo "$enid";die;
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->Master_vendor_model->get($idencr);
				if(!empty($this->data['list']))
				{
					$lid = $this->Master_vendor_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Master Vendor Deleted successfully.');
						redirect('Master_vendor', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Master Vendor not Deleted successfully!!.');
							redirect('Master_vendor', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Master Vendor not Available!!');
			  		redirect('Master_vendor', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Master Vendor not Available!!');
					redirect('Master_vendor', 'refresh'); 
			}
			redirect('Master_vendor', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Master_vendor'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master Vendor Delete functionality");
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
						$this->data['list'] = $this->Master_vendor_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->Master_vendor_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Sales Quotationdeleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Sales Quotationnot deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Sales Quotationnot Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Master_vendor'), 'refresh');

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
		if($this->input->post() && isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != ''))
		{
			$data['error'] = '';    //initialize image upload error array to empty
			$config['upload_path'] = './uploads/csv/';
			$config['allowed_types'] = 'csv';
			$config['overwrite'] = TRUE;
			$config['max_size'] = '1000000000000000000000000000000000000000000000000000000000000000000';
			$this->load->library('upload', $config);
			
			// If upload failed, display error
			if (!$this->upload->do_upload()) 
			{
				$data['error'] = $this->upload->display_errors();
				echo"<pre>";print_r($data);die;
				$this->data['action'] = "Master_vendor/importcsv";
				$this->data['main_content'] = 'importcsv_view';
				$this->load->view('includes/template',$this->data);
			}else 
			{
				$file_data = $this->upload->data();
				$file_path =  './uploads/csv/'.$file_data['file_name'];
				if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					//echo"<pre>";print_r($csv_array);die;
					if(is_array($csv_array) && !empty($csv_array))
					{
						foreach ($csv_array as $row)
						{
							//echo "<pre>";print_r($row);die;
							if(isset($row['COMPANY NAME']))
							{
								$this->Master_vendor_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Master_vendor'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Master_vendor/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Master_vendor/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Master_vendor/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 6,$type);
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

	public function setbit_Master_vendor()
	{
		$this->Master_vendor_model->setbit_Master_vendor();
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
		$this->data['sub_catlists'] = $this->Master_vendor_model->get_subsource($this->abc);
		echo json_encode($this->data);
	}
	
	public function item_description()
	{
		$id = (int)$this->input->post('id');
		$array = $this->sales_enq_model->get_item_description($id);
		echo json_encode($array);
	}
	
	public function delete_folup($id=false)
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
				$this->session->set_userdata('qtabno',3);
					$lid = $this->Master_vendor_model->delete_fup($idencr);
					
						if ($lid) {
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
			}
			redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}

	public function delete_itms($id=false)
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Sales inquiry Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(4) ? $this->uri->segment(4) : '';
		$ca_id = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			$ca_id = $this->uri->segment(4) ? $this->encrypt_decrypt('decrypt', $ca_id) : '';
			if(isset($id) && $id!= '')
			{
				$this->session->set_userdata('qtabno',2);
					$lid = $this->Master_vendor_model->delete_itms($idencr,$ca_id);
					//***********PDF File Code Start********************
					$autoid = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(4)) : '';
						if ($lid) 
						{
						$this->session->set_flashdata('success', 'Followup detail deleted successfully.');
						redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh');
						} else
						 {
							$this->session->set_flashdata('error', 'Followup detail not deleted successfully!!.');
							redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
						}						
				
			}
			else{
					$this->session->set_flashdata('error', 'Followup detail not Available!!');
					redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh');
			}
			redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect('Master_vendor/quatation_tab/'.$this->uri->segment(4), 'refresh'); 
		}
	}
	public function mail()
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
		$this->data['lists'] = $this->Master_vendor_model->get($idencr);
		//$this->data['getMaster_vendor'] = $this->Master_vendor_model->addtMaster_vendor();
		$this->data['main_content'] = 'sale_qoutation_mail_view';
		$this->data['action_mail'] = "Master_vendor/send_mail/".$this->uri->segment(3);
		$this->load->view('includes/template',$this->data);
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
		$config['allowed_types'] = 'gif|jpg|png|pdf';
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

	public function multiple_image_upload()
	{
		$valid_formats = array("jpg","JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "bmp", "BMP","pdf");
		$max_file_size = 1024*100000000; //100 kb
		//echo $path = base_url()."/uploads/product_images/"; // Upload directory
		//echo $path = $_SERVER['DOCUMENT_ROOT'];exit;
		//$path = $_SERVER['DOCUMENT_ROOT']."/miconindia.com/uploads/product_images/";
		$path = 'uploads/qoute_mail/'; 
		$count = 0;
		 //echo "gsdgsg";  print_r($_FILES['files']['error']);die;
   		 $imagearray = array();
		 $imagearray = $_FILES['files']['name'];
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ //echo '<pre>'; print_r($_FILES['files']['name']); //die;
			// Loop $_FILES to exeicute all files
			foreach ($imagearray as $f => $name) {   
				 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomString = '';
				for ($i = 0; $i < 7; $i++) 
				{
					$randomString .= $characters[rand(0, strlen($characters) - 1)];
				}      
				if ($_FILES['files']['error'][$f] == 0) {	           
					if ($_FILES['files']['size'][$f] > $max_file_size) {
						$message[] = "$name is too large!.";
						continue; // Skip large files
					}
					elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
						$message[] = "$name is not a valid format";
						continue; // Skip invalid file formats
					}
					else{ // No error found! Move uploaded files 
						if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$randomString.$name))
						$imagearray[$f] = $randomString.$name;
						//$this->imageResize($imagearray[$f],$wid = 244,$hei = 210,$file_folder = '244x210/');
						//$this->imageResize($imagearray[$f],$wid = 220,$hei = 220,$file_folder = '220x220/');
						//$this->imageResize($imagearray[$f],$wid = 95,$hei = 95,$file_folder = '95x95/');
						//$this->imageResize($imagearray[$f],$wid = 112,$hei = 72,$file_folder = '112x72/');
						//$this->image_upload($imagearray[$f],$wid = 1200,$hei = 600,$file_folder = '1200x600/');
						$count++; // Number of successfully uploaded file
					}
				}
				if ($_FILES['files']['error'][$f] == 4) {
					//continue; // Skip file if any error found
					//$this->get_form();
					unset($imagearray);
					$imagearray = array();
					//$imagearray = array_map('nullify', $imagearray);
				}	
			}
		}
		return $imagearray;
	}
}?>