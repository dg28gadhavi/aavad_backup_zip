<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('report_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
	}
	 
	public function index()
	{
		//echo '<pre>';print_r($this->session->userdata('miconlogin'));die;
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Report VIew functionality");
			redirect(base_url());
		}
		$this->data['admins'] = $this->report_model->get_admin();
		$this->data['items'] = $this->report_model->get_items();
		$this->data['main_content'] = 'Report_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->report_model->get_report();
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
		//$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['tnc_id']);
		//$this->encrypt->encode($user[$i]['tran_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		/*if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Report/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a>';
		}*/
		/*$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Report/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>';
		}*/
		if($user[$i]['tran_cr_or_dr'] == 1)
			{
	         	 $sst = '<span>Credit</span>';
			}else if($user[$i]['tran_cr_or_dr'] == 2)
				{
					 $sst = '<span>Debit</span>';
				}
				else{
				$sst = '<span></span>';
		}
		if($user[$i]['tran_add_or_edit'] == 1)
			{
	         	 $add = '<span>Add</span>';
			}else if($user[$i]['tran_add_or_edit'] == 2)
				{
					 $add = '<span>Edit</span>';
				}
				else{
				$add = '<span></span>';
		}
		$records["data"][] = array(
			  ''.$user[$i]['master_item_name'],
			  ''.$user[$i]['tran_itm_qty'],
			  //  ''.$user[$i]['tran_inw_id'],
			  // ''.$user[$i]['tran_otw_id'],
			  $sst,
			  $add,
			  ''.$user[$i]['au_fname'],
			  ''.date("d-m-Y H:i:s", strtotime($user[$i]['tran_cdate'])),
			  //''.$editstr.''.$deletestr.'',
			  ''
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
	
	
	
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
	}

	public function delete($id=false)
	{
		
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->report_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->report_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Report deleted successfully.');
						redirect('Report', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Report not deleted successfully!!.');
							redirect('Report', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Report not Available!!');
			  		redirect('Report', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Report not Available!!');
					redirect('Report', 'refresh'); 
			}
			redirect('Report', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Report'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		
		//echo '<pre>';print_r($this->input->get('delid'));die;
		if($this->input->get('delid') && is_array($this->input->get('delid')) && !empty($this->input->get('delid')))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->report_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->report_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Report deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Report not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Report not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Report not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Report'), 'refresh');

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
			if (!$this->upload->do_upload()) {
			
				$data['error'] = $this->upload->display_errors();
				echo"<pre>";print_r($data);die;
				$this->data['action'] = "country/importcsv";
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
							//echo "<pre>";print_r($row['Contact1']);die;
							if(isset($row['Report']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['countryCode'])))
							{
								$this->report_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Report'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Report/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Report/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Report/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 38,$type);
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

	public function setbit_country()
	{
		$this->report_model->setbit_country();
	}

	function is_loggedin()
	{
		//echo '<pre>';print_r($this->session->userdata('miconlogin'));die;
		if(isset($this->session->userdata['miconlogin']))
		{
			if(isset($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['userid']))
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
	// public function copy_data()
	// {
	// 	//echo "hiiii";die;
	// 	$data = $this->report_model->item_stock();

	// } 
	
	
}?>