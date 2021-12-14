<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_party extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('master_party_model');
		//$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_party VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Master_party_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->master_party_model->get_master_party();
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
		
		foreach($user as $i => $vals){
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$idenc = $this->encrypt_decrypt('encrypt',$vals['master_party_id']);
		//$crud->columns('master_party_code','master_party_name','master_party_address','master_party_contact_person','master_party_contact_no','master_party_fax','master_party_phone','master_party_email_address','master_party_state','master_party_city');
		$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$idenc.'">',
			  $id,
			  ''.$user[$i]['master_party_code'],
			  ''.$user[$i]['master_party_name'],
			  ''.$user[$i]['master_party_address'],
			  ''.$user[$i]['master_party_contact_person'],
			  ''.$user[$i]['master_party_gst'],
			  ''.$user[$i]['master_party_contact_no'],
			  //''.$user[$i]['master_party_fax'],
			  ''.$user[$i]['master_party_phone'],
			  ''.$user[$i]['master_party_email_address'],
			  ''.$user[$i]['state_name'],
			  ''.$user[$i]['master_party_city'],
			  '<a href="'.base_url().'Master_party/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-search"></i> Edit</a><a href="'.base_url().'Master_party/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class=""></i> Delete</a>',
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_party Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{   //echo '<pre>';print_r($this->input->post());die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				$value = $this->security->xss_clean($value);
				$value['master_party_created_date'] = date('Y-m-d H:i:s');
				$value['master_party_updated_date'] = date('Y-m-d H:i:s');
				
				$lid = $this->master_party_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Master_party added successfully.');
					redirect(base_url('Master_party'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Master_party not added successfully!!');
					redirect(base_url('Master_party/add'), 'refresh');
				}
			 	redirect(base_url('Master_party'), 'refresh');
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_party Edit functionality");
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
					$value = array();
					$value = $this->input->post(NULL,FALSE);
					$value = $this->security->xss_clean($value);
					$value['master_party_updated_date'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					
					$lid = $this->master_party_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Master_party edited successfully.');
						redirect(base_url('Master_party'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Master_party not edited successfully!!');
					}
				 	redirect(base_url('Master_party'), 'refresh');
				}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->master_party_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['countries'] = $this->master_party_model->get_counrty_data();
						$this->data['states'] = $this->master_party_model->get_state_data();
						$this->data['citys'] = $this->master_party_model->get_city_data();
						$this->data['tax_cats'] = $this->master_party_model->get_taxs_data();
						$this->data['action'] = "Master_party/edit/".$enid;
						$this->data['main_content'] = 'Master_party_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/master_party/Master_party_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Master_party not Available!!');
						 redirect(base_url('Master_party'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Master_party not Available!!');
					redirect(base_url('Master_party'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Master_party'), 'refresh'); 
		}
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('master_party_name', 'master_party name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('master_party_name', 'master_party name', 'trim|required');  
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
		$this->data['countries'] = $this->master_party_model->get_counrty_data();
		$this->data['states'] = $this->master_party_model->get_state_data();
		$this->data['citys'] = $this->master_party_model->get_city_data();
		$this->data['tax_cats'] = $this->master_party_model->get_taxs_data();
		$this->data['main_content'] = 'Master_party_form_view';
		$this->data['action'] = "Master_party/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_party Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->master_party_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->master_party_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Master_party deleted successfully.');
						redirect('Master_party', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Master_party  deleted successfully!!.');
							redirect('Master_party', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Master_party not Available!!');
			  		redirect('Master_party', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Master_party not Available!!');
					redirect('Master_party', 'refresh'); 
			}
			redirect('Master_party', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Master_party'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_party Delete functionality");
			redirect(base_url());
		}
		//echo '<pre>';print_r($this->input->get('delid'));die;
		if($this->input->get('delid') && is_array($this->input->get('delid')) && !empty($this->input->get('delid')))
		{
			foreach($this->input->get('delid') as $enid)
			{
				if($enid && ($enid != ''))
				{
					$idencr = isset($enid) ? $enid : '';//die;
					if(isset($idencr) && $idencr != ''){
						$this->data['list'] = $this->master_party_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->master_party_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Master_party deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Master_party not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Master_party not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Master_party not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Master_party'), 'refresh');

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
				$this->data['action'] = "master_party/importcsv";
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
							if(isset($row['Master_party']) && ($row['Latitude'] != '') && (isset($row['Longitude'])) && (isset($row['master_partyCode'])))
							{
								$this->master_party_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Master_party'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Master_party/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Master_party/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Master_party/importcsv";
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 3,$type);
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

	public function setbit_master_party()
	{
		$this->master_party_model->setbit_master_party();
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