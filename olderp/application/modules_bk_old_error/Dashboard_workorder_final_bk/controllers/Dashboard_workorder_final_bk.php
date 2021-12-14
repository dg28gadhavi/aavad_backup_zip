<?php

class Dashboard_workorder_final extends CI_Controller {

	 function __construct() {
            parent::__construct();
            $this->load->model('Dashboard_workorder_final_model');
            $loggedin = $this->is_loggedin(); 
			if($loggedin == false)
			{
				redirect(base_url().'login');
			}
    	}
	public function index()
	{
		$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
		$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
		//echo $type_id;die;
		if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1)
		{
			$data['work_orders'] = $this->Dashboard_workorder_final_model->get_all_confirm_work_order();
			$data['work_orders_count'] = $this->Dashboard_workorder_final_model->get_all_work_orders_count();
			//echo '<pre>';print_r($data['work_orders']);die;
			$data['main_content'] = 'Dashboard_workorder_final_view';
			$this->load->view('includes/template', $data);
		}else if($dep_id == 9)
		{
			$data['work_orders'] = $this->Dashboard_workorder_final_model->get_production_work_order();
			//echo '<pre>';print_r($data['work_orders']);die;
			$data['main_content'] = 'Production_view';
			$this->load->view('includes/template', $data);
		}else if($dep_id == 5)
		{
			$data['work_orders'] = $this->Dashboard_workorder_final_model->get_store_work_order();
			//echo '<pre>';print_r($data['work_orders']);die;
			$data['main_content'] = 'Store_view';
			$this->load->view('includes/template', $data);
		}else if($dep_id == 2)
		{

			$data['work_orders'] = $this->Dashboard_workorder_final_model->get_account_work_order();
			//echo '<pre>';print_r($data['work_orders']);die;
			if($data['work_orders']['outward_lists'] == NULL)
			{
				$data['error_msg'] = 'No Data.';
			}
			$data['main_content'] = 'Account_view';
			$this->load->view('includes/template', $data);
		}
	}
	public function is_loggedin()
	{
		if(isset($this->session->userdata['miconlogin']))
		{
			if(isset($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && isset($this->session->userdata['miconlogin']['rightsid']) && isset($this->session->userdata['miconlogin']['status']) && ($this->session->userdata['miconlogin']['status'] == 1) && isset($this->session->userdata['miconlogin']['loginsessid'])&& isset($this->session->userdata['miconlogin']['userid']))
			{
				$logar = array(
					'typeid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']),
					'userid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])
				);
				$loginstatus = true;
			}else{
				$loginstatus = false;
			}
		}else{
			$loginstatus = false;
		}
		return $loginstatus; 
	}
	
	public function encrypt_decrypt($action, $string)
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

	public function check_qty()
	{
		$value = array();
		$value = $this->input->get();
		$idstr = "#wonoids".$this->input->get('wo_id');
		$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
		if($type_id == 3)
		{
			$this->Dashboard_workorder_final_model->approve_qty_for_super_admin($value);
		}else{
			$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
			if($dep_id == 10)
			{
				$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
				// $stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
				// $qty = $data['items']['woi_qty'];
				// if($qty > 0 && $stock >= $qty)
				// {
					$this->Dashboard_workorder_final_model->approve_qty_for_manager($value);
				//}
			}else if($dep_id == 11){
				$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
				$stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
				$qty = $data['items']['woi_qty'];
				if($qty > 0 && $stock >= $qty)
				{
					$this->Dashboard_workorder_final_model->approve_qty_for_pro_manager($value);
				}
			}else if($dep_id == 9)
			{
					$this->Dashboard_workorder_final_model->approve_qty_for_production($value);
					$otwid = $this->Dashboard_workorder_final_model->get_otwdata($value);
					//echo '<pre>';print_r($otwid);die;
					if($otwid != null)
					{
						$otw_id = $this->encrypt_decrypt('encrypt',$otwid['otwi_owt_id']);
						redirect(base_url()."Outward/serial_details/".$otw_id."?itemid=".$otwid['otwi_id']."&acttype=serial&pathfrom=wofinal");
					}

			}else if($dep_id == 5){
				$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
				$stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
				$qty = $data['items']['woi_qty'];
				if($qty > 0 && $stock >= $qty)
				{
					$itmid = $this->Dashboard_workorder_final_model->approve_qty_for_store($value);
					//echo '<pre>';print_r($itmid);die;
					$otw_id = $this->encrypt_decrypt('encrypt',$itmid['otwid']);
					redirect(base_url()."Outward/serial_details/".$otw_id."?itemid=".$itmid['itmid']."&acttype=serial&pathfrom=wofinal");
				}
				
			}
		}
		redirect(base_url()."Dashboard_workorder_final".$idstr);
	}

	public function change_desciption()
	{
		$value = array();
		$value = $this->input->get();
		$idstr = "#wonoids".$this->input->get('wo_id');
		if($this->input->post(NULL,FALSE) && $this->input->post('item_desc') && $this->input->post('remark') && $this->input->post('comment'))
		{
			$postdata = array();
			$postdata = $this->input->post();
			$this->Dashboard_workorder_final_model->change_desciption($value,$postdata);
			redirect(base_url()."Dashboard_workorder_final".$idstr);
		}else{
			$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
			$data['action'] = base_url().'Dashboard_workorder_final/change_desciption?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
			$data['main_content'] = 'change_desciption_view';
			$this->load->view('includes/template', $data);
		}
	}

	public function delete_itm()
	{
		$value = array();
		$value = $this->input->get();
		$this->Dashboard_workorder_final_model->delete_wo_items($value);
		redirect(base_url()."Dashboard_workorder_final");
	}

	public function edit_qty()
	{
		$idstr = '';
		if($this->input->post(NULL,FALSE))
		{
			$value = array();
			$value = $this->input->get();
			$idstr = "#wonoids".$this->input->get('wo_id');
			//echo '<pre>';print_r($value);die;
			$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
			$postvalue = array();
			$postvalue = $this->input->post();
			if(isset($postvalue) && !empty($postvalue) && isset($postvalue['approve_qty']) && ($postvalue['approve_qty'] > 0) && ($postvalue['approve_qty'] < $data['items']['woi_qty'])){

				$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				if($type_id == 3)
				{
					$postvalue['open_qty'] = $data['items']['woi_qty'] - $postvalue['approve_qty'];
					$this->Dashboard_workorder_final_model->update_wo_items($postvalue,$value);
					redirect(base_url()."Dashboard_workorder_final");
				}else{
					$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
					if($dep_id == 10)
					{
						$stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
						$qty = $postvalue['approve_qty'];
						if($qty > 0 && $stock >= $qty)
						{
							$postvalue['open_qty'] = $data['items']['woi_qty'] - $postvalue['approve_qty'];
							$this->Dashboard_workorder_final_model->update_wo_items_manager($postvalue,$value);
							redirect(base_url()."Dashboard_workorder_final".$idstr);
						}else{
							$data['error_msg'] = 'Stock Not Available.';
							$data['action'] = base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
							$data['main_content'] = 'Edit_qty_final_view';
							$this->load->view('includes/template', $data);
						}
					}else if($dep_id == 11){
						$stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
						$qty = $postvalue['approve_qty'];
						if($qty > 0 && $stock >= $qty)
						{
							$postvalue['open_qty'] = $data['items']['woi_qty'] - $postvalue['approve_qty'];
							$this->Dashboard_workorder_final_model->update_wo_items_promanager($postvalue,$value);
							redirect(base_url()."Dashboard_workorder_final".$idstr);
						}else{
							$data['error_msg'] = 'Stock Not Available.';
							$data['action'] = base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
							$data['main_content'] = 'Edit_qty_final_view';
							$this->load->view('includes/template', $data);
						}
					}else if($dep_id == 9){
						$stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
						$qty = $postvalue['approve_qty'];
						if($qty > 0 && $stock >= $qty)
						{
							$postvalue['open_qty'] = $data['items']['woi_qty'] - $postvalue['approve_qty'];
							$this->Dashboard_workorder_final_model->update_wo_items_production($postvalue,$value);
							redirect(base_url()."Dashboard_workorder_final".$idstr);
						}else{
							$data['error_msg'] = 'Stock Not Available.';
							$data['action'] = base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
							$data['main_content'] = 'Edit_qty_final_view';
							$this->load->view('includes/template', $data);
						}
					}else if($dep_id == 5){
						$stock = $data['items']['tcreditpoints'] - $data['items']['tdebitpoints'];
						$qty = $postvalue['approve_qty'];
						if($qty > 0 && $stock >= $qty)
						{
							$postvalue['open_qty'] = $data['items']['woi_qty'] - $postvalue['approve_qty'];
							$itmid = $this->Dashboard_workorder_final_model->update_wo_items_store($postvalue,$value);
							//echo '<pre>';print_r($itmid);die;
							$otw_id = $this->encrypt_decrypt('encrypt',$itmid['otwid']);
							redirect(base_url()."Outward/serial_details/".$otw_id."?itemid=".$itmid['itmid']."&acttype=serial&pathfrom=wofinal");
							//redirect(base_url()."Dashboard_workorder_final");
						}else{
							$data['error_msg'] = 'Stock Not Available.';
							$data['action'] = base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
							$data['main_content'] = 'Edit_qty_final_view';
							$this->load->view('includes/template', $data);
						}
					}
				}
			}else{
				$data['error_msg'] = 'Pl. select proper value.';
				$data['action'] = base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
				$data['main_content'] = 'Edit_qty_final_view';
				$this->load->view('includes/template', $data);
			}
		}else{
			$value = array();
			$value = $this->input->get();
			//echo '<pre>';print_r($value);die;
			$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
			$data['action'] = base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
			$data['main_content'] = 'Edit_qty_final_view';
			$this->load->view('includes/template', $data);
		}
	}

	public function assign_user()
	{
		$idstr = '';
		if($this->input->post(NULL,FALSE))
		{
			$value = array();
			$value = $this->input->get();
			$idstr = "#wonoids".$this->input->get('wo_id');
			//echo '<pre>';print_r($value);die;
			$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
			$postvalue = array();
			$postvalue = $this->input->post();
			if(isset($postvalue) && !empty($postvalue) && isset($postvalue['select_admin']) && ($postvalue['select_admin'] != '')){

				$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
				$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
				if($dep_id == 11)
				{
					$this->Dashboard_workorder_final_model->update_production_user($postvalue,$value);
					redirect(base_url()."Dashboard_workorder_final");
				}else{
					$data['error_msg'] = 'Only Production Manager can assign production user.';
					$data['action'] = base_url().'Dashboard_workorder_final/assign_user?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
					$data['main_content'] = 'Approve_production_user_view';
					$this->load->view('includes/template', $data);
				}
			}else{
				$data['error_msg'] = 'Pl. select proper value.';
				$data['action'] = base_url().'Dashboard_workorder_final/assign_user?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
				$data['main_content'] = 'Approve_production_user_view';
				$this->load->view('includes/template', $data);
			}
		}else{
			$value = array();
			$value = $this->input->get();
			//echo '<pre>';print_r($value);die;
			$data['items'] = $this->Dashboard_workorder_final_model->get_wo_item_details($value);
			$data['admin_users'] = $this->Dashboard_workorder_final_model->get_admin_user($value);
			$data['action'] = base_url().'Dashboard_workorder_final/assign_user?wo_itemid='.$value['wo_itemid'].'&itemid='.$value['itemid'].'&wo_id='.$value['wo_id'].'';
			$data['main_content'] = 'Approve_production_user_view';
			//echo '<pre>';print_r($data);die;
			$this->load->view('includes/template', $data);
		}
	}
	public function outward_confirm()
	{
		require 'Zebra_Image.php';
		$value = $this->input->get();
		if($this->input->post())
		{
			if(isset($value) && !empty($value) && isset($value['otw_id']) && ($value['otw_id'] != '') && ($value['otw_id'] != 0))
			{
				$this->Dashboard_workorder_final_model->outward_confirm($value);			
				//$this->Dashboard_workorder_final_model->outward_confirm($value);
			}
			$postvalue = array();
			$postvalue = $this->input->post();
			//echo '<pre>';print_r($_FILES['wo_payment_img']);die;

			if(isset($_FILES['wo_payment_img']['name']) && ($_FILES['wo_payment_img']['name'] != '')){
					$folder_name = "wo_payment_img";
					$file_type = "wo_payment_img";
					$image = $this->do_upload_image($folder_name,$file_type,$width=150,$height=150);
					$value['wo_payment_img'] = $image['upload_data']['file_name'];
				}


			$this->Dashboard_workorder_final_model->insert_productiondata($postvalue);
			//echo '<pre>';print_r($postvalue);die;
			redirect(base_url()."Dashboard_workorder_final");
		}else{
			$data['error_msg'] = 'Only Production Manager can Edit.';
			$data['action'] = base_url().'Dashboard_workorder_final/outward_confirm?otw_id='.$value['otw_id'].'&wo_id='.$value['wo_id'].'';
			$data['main_content'] = 'Production_weight_view';
			$this->load->view('includes/template', $data);
		}



		//redirect(base_url()."Dashboard_workorder_final");
	}
	public function account_edit_otw()
	{
		$value = $this->input->get();
		if(isset($value) && !empty($value) && isset($value['otw_id']) && ($value['otw_id'] != '') && ($value['otw_id'] != 0))
		{
			//die;
			$data['error_msg'] = 'Only Account Manager can Edit.';
			$data['action'] = base_url().'Dashboard_workorder_final/account_edit_otw';
			$data['main_content'] = 'Account_edit_view';
			$this->load->view('includes/template', $data);
		}
		if($this->input->post())
		{
			//echo '<pre>';print_r($postvalue);die;
			$postvalue = array();
			$postvalue = $this->input->post();
			//echo '<pre>';print_r($postvalue);die;
			$this->Dashboard_workorder_final_model->insert_invoicedata($postvalue);
			//echo '<pre>';print_r($postvalue);die;
			redirect(base_url()."Dashboard_workorder_final");
		}
		
	}
	public function change_viewwo()
	{
		//echo "hiii";die;
		$this->abc['woid'] = $this->input->post('id');
		$this->Dashboard_workorder_final_model->check_wono_view($this->abc);
		//echo json_encode($this->data);
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
	public function view_wo_sticker()
	{
		$data['work_orders'] = $this->Dashboard_workorder_final_model->get_sticker_work_order();
		$data['main_content'] = 'workorder_sticker_view';
		$this->load->view('includes/template', $data);
	}
	public function view_coverwo_sticker()
	{
		$data['work_orders'] = $this->Dashboard_workorder_final_model->get_sticker_work_order();
		$data['main_content'] = 'workorder_sticker_view_portrait';
		$this->load->view('includes/template', $data);
	}
}
