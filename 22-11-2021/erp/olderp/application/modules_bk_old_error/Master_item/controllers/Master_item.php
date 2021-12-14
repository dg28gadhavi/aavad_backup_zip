<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_item extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('master_item_model');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->helper('text');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_item VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Master_item_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	/*public function get_supplier()
	{
		//echo "hii"; die;
		$this->master_item_model->get_supplier();

	}*/

	public function ajax()
	{
		$count = $this->master_item_model->get_master_items_count();
		$iTotalRecords = $count;
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
		$user = $this->master_item_model->get_master_items($iDisplayStart,$iDisplayLength);
		foreach($user as $i => $vals){
		$status = $status_list[rand(0, 2)];
		$id = ($i + 1);
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['master_item_id']);
		//$this->encrypt->encode($user[$i]['master_item_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a href="'.base_url().'Master_item/edit/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$deletestr = '<a href="'.base_url().'Master_item/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
		}
		$coupy_str = '<a class="btn btn-sm btn-outline green" href="'.base_url().'Master_item/copy_item/'.$idenc.'" onclick="return confirm('."'Are you sure you want to Copy this record?'".')"><i class="fa fa-plus"></i></a>';
		$records["data"][] = array(
			''.'',
			''.$user[$i]['master_item_name'],
			''.$user[$i]['master_item_modal_code'],
			''.$user[$i]['master_item_keyword'],
			''.$user[$i]['master_item_part_no'],
			''.$user[$i]['master_item_description'],
			''.$user[$i]['hsn_hcode'],
			''.$user[$i]['master_item_make_name'],
			''.$user[$i]['master_item_unit_name'],
			''.$user[$i]['master_item_img'],
			''.$user[$i]['master_item_rate'],
			''.($user[$i]['tcreditpoints']-$user[$i]['tdebitpoints']),
			''.$user[$i]['master_item_weight'],
			''.$user[$i]['master_item_tax'],
			// ''.($user[$i]['hold_stock']-($user[$i]['tcreditpoints']-$user[$i]['tdebitpoints'])),
			//''.date("d-m-Y", strtotime($user[$i]['master_item_updated_date'])),
			''.$editstr.''.$deletestr.''.$coupy_str,
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
		require 'Zebra_Image.php';
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_item Add functionality");
			redirect(base_url());
		}
		$success = $this->validation();
		
		if($success == TRUE)
		{
			if($this->input->post(NULL,FALSE))
			{	//echo '<pre>';print_r($this->input->post(NULL,FALSE));die;
				$value = array();
				$value = $this->input->post(NULL,FALSE);
				//$value = $this->security->xss_clean($value);
				$value['master_item_created_date'] = date('Y-m-d H:i:s');
				$value['master_item_updated_date'] = date('Y-m-d H:i:s');

				if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$folder_name = "master_item_img";
					$file_type = "master_item_img";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['master_item_img'] = $image['upload_data']['file_name'];
				}
				
				$lid = $this->master_item_model->add($value);
				if($lid)
				{
					$this->session->set_flashdata('success', 'Master_item added successfully.');
					redirect(base_url('Master_item'), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Master_item not added successfully!!');
					redirect(base_url('Master_item/add'), 'refresh');
				}
			 	redirect(base_url('Master_item'), 'refresh');
			}
		}
		if($success == FALSE)
		{
			$this->get_form();
		}
	}

	public function copy_item($id = FALSE)
	{
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
		$status = $this->master_item_model->copy_item($idencr);
		if(isset($status) && isset($status['status']) && $status['status'] == TRUE){
			$this->session->set_flashdata('success', 'copy successfully.');
			redirect(base_url()."Master_item/edit/".$this->encrypt_decrypt('encrypt', $status['id']));
		}else{
			$this->session->set_flashdata('error', 'SOmething went wrong.');
		}
	}

	public function edit($id = FALSE)
	{
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_item Edit functionality");
			redirect(base_url());
		}
		require 'Zebra_Image.php';
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
					//$value = $this->security->xss_clean($value);
					$value['master_item_updated_date'] = date('Y-m-d H:i:s');
					$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
					if(isset($_FILES['master_item_img']['name']) && ($_FILES['master_item_img']['name'] != '')){
					$folder_name = "master_item_img";
					$file_type = "master_item_img";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['master_item_img'] = $image['upload_data']['file_name'];
					}
					$lid = $this->master_item_model->edit($value,$idencr);
					if($lid)
					{
						$this->session->set_flashdata('success', 'Master_item edited successfully.');
						redirect(base_url('Master_item'), 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Master_item not edited successfully!!');
					}
				 	redirect(base_url('Master_item'), 'refresh');
				
			}
			}
			if($success == FALSE)
			{
				if(isset($idencr) && $idencr != ''){
					$this->data['list'] = $this->master_item_model->get($idencr);
					//echo "<pre>"; print_r($this->data['list']); die;
					if(!empty($this->data['list']))
					{
						//echo "hi"; die;
						$this->data['brands'] = $this->master_item_model->get_salesbrand();
						$this->data['hsn'] = $this->master_item_model->get_hsn();
						$this->data['item_heads'] = $this->master_item_model->get_item_heads();
						$this->data['vendors'] = $this->master_item_model->get_item_makes();
						$this->data['taxes'] = $this->master_item_model->item_txs();
						$this->data['units'] = $this->master_item_model->get_units();
						$this->data['item_txs'] = $this->master_item_model->item_txs();
						$this->data['tax_datas'] = $this->master_item_model->get_tax_datas();
						$this->data['taxcats'] = $this->master_item_model->get_tax_datas();
						$this->data['action'] = "Master_item/edit/".$enid;
						$this->data['main_content'] = 'Master_item_form_view';
						$this->load->view('includes/template',$this->data);
						//parent::load_view('admin/master/master_item/Master_item_form_view',$this->data);
					}
					else
					{
						 $this->session->set_flashdata('error', 'Master_item not Available!!');
						 redirect(base_url('Master_item'), 'refresh'); 
					}
				}
				else{
					$this->session->set_flashdata('error', 'Master_item not Available!!');
					redirect(base_url('Master_item'), 'refresh'); 
				}
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Master_item'), 'refresh'); 
		}
	}

	public function itm_stock_insert()
	{
		$this->master_item_model->itm_stock_insert();
	}

	public function itm_tblmitmr_insert()
	{
		$this->master_item_model->itm_tblmitmr_insert();
	}
	
	public function validation() 
	{
		if($this->input->post(NULL,TRUE))
		{
			$this->load->library('form_validation');
			if($this->uri->segment(2) == 'add'){
				$this->form_validation->set_rules('master_item_name', 'master_item name', 'trim|required');  
			}else if($this->uri->segment(2) == 'edit'){
				$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
				$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
				$this->form_validation->set_rules('master_item_name', 'master_item name', 'trim|required');  
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
		$this->data['party_code'] = $this->master_item_model->sa_no_get();
		$this->data['brands'] = $this->master_item_model->get_salesbrand();
		$this->data['hsn'] = $this->master_item_model->get_hsn();
		$this->data['item_heads'] = $this->master_item_model->get_item_heads();
		$this->data['vendors'] = $this->master_item_model->get_item_makes();
		$this->data['taxes'] = $this->master_item_model->item_txs();
		$this->data['units'] = $this->master_item_model->get_units();
		$this->data['item_txs'] = $this->master_item_model->item_txs();
		$this->data['tax_datas'] = $this->master_item_model->get_tax_datas();
		$this->data['taxcats'] = $this->master_item_model->get_tax_datas();
		$this->data['main_content'] = 'Master_item_form_view';
		$this->data['action'] = "Master_item/add";
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
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_item Delete functionality");
			redirect(base_url());
		}
		$enid = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		if($enid && ($enid != ''))
		{
			$idencr = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $enid) : '';
			if(isset($id) && $id!= ''){
				$this->data['list'] = $this->master_item_model->get($idencr);
				if(!empty($this->data['list'])){
					$lid = $this->master_item_model->delete($idencr);
						if ($lid) {
						$this->session->set_flashdata('success', 'Master_item deleted successfully.');
						redirect('Master_item', 'refresh');
						} else {
							$this->session->set_flashdata('error', 'Master_item not deleted successfully!!.');
							redirect('Master_item', 'refresh'); 
						}						
				}else{
					$this->session->set_flashdata('error', 'Master_item not Available!!');
			  		redirect('Master_item', 'refresh'); 
			  	}
			}
			else{
					$this->session->set_flashdata('error', 'Master_item not Available!!');
					redirect('Master_item', 'refresh'); 
			}
			redirect('Master_item', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			redirect(base_url('Master_item'), 'refresh'); 
		}
	}
	
	public function delete_all()
	{
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Master_item Delete functionality");
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
						$this->data['list'] = $this->master_item_model->get($idencr);//die;
						if(!empty($this->data['list'])){
							$lid = $this->master_item_model->delete($idencr);
								if ($lid) {
								$this->session->set_flashdata('success', 'Master_item deleted successfully.');
								} else {
									$this->session->set_flashdata('error', 'Master_item not deleted successfully!!.');
								}						
						}else{
							$this->session->set_flashdata('error', 'Master_item not Available!!');
						}
					}
					else{
							$this->session->set_flashdata('error', 'Master_item not Available!!');
					}
				}else{
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		}
		redirect(base_url('Master_item'), 'refresh');

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
				$this->data['action'] = "master_item/importcsv";
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
							if(isset($row['ITEM NAME']) && (isset($row['MODEL CODE'])))
							{
								$this->master_item_model->importcsv($row);
							}
						}
						$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						redirect(base_url('Master_item'), 'refresh');	
					}
				} else {
					$data['error'] = 'No CSV';
					$this->data['action'] = "Master_item/importcsv";
					$this->data['main_content'] = 'importcsv_view';
					$this->load->view('includes/template',$this->data);
				}
			}
		}else{
			$this->data['action'] = "Master_item/importcsv";
			$this->data['main_content'] = 'importcsv_view';
			$this->load->view('includes/template',$this->data);
		}

    }
	
	public function csvimport()
	{
		//echo "hi";die;
		$this->data['action'] = "Master_item/importcsv";
		$this->data['main_content'] = 'importcsv_view';
		$this->load->view('includes/template',$this->data);
	}

	// public function get_tax()
	// {
	// 	if($this->input->post() && $this->input->post('master_item_id'))
	// 	{
	// 		$id = $this->input->post('master_item_id');
	// 		$array = $this->master_item_model->get_tax($id);
	// 		//$array = $this->booking_order_model->get_ajaxItmtotax($id);
	// 		//$this->item_tax_content($array);
	// 		//echo "<pre>"; print_r($array); die;
	// 		echo json_encode($array);
	// 	}else{
	// 		$array = array();
	// 		echo json_encode($array);
	// 	}
		
	// }

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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 7,$type);
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

	public function setbit_master_item()
	{
		$this->master_item_model->setbit_master_item();
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

	public function get_tax()
	{
		$id = $this->input->post('hsn_id');
		if(isset($id) && ($id != ''))
		{
			$value = $this->master_item_model->get_cust($id);
			echo json_encode($value);
		}
	}
	
	
	
}?>