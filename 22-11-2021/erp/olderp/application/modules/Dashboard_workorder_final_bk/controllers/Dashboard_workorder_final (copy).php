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
		$data['action_ds'] = base_url().'Dashboard_workorder_final';
		$data['executive'] = $this->Dashboard_workorder_final_model->get_Executive();
		//echo '<pre>';print_r($data);die;
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
			$data['work_orders_count'] = $this->Dashboard_workorder_final_model->get_all_work_orders_count();
			$data['work_orders'] = $this->Dashboard_workorder_final_model->get_account_work_order();
			//echo '<pre>';print_r($data['work_orders']);die;
			//$data['inv_no'] = $this->Dashboard_workorder_final_model->get_inv_no();
			if($data['work_orders']['outward_lists'] == NULL)
			{
				$data['error_msg'] = 'No Data.';
			}
			$data['main_content'] = 'Account_view';
			$this->load->view('includes/template', $data);
		}
	}

	public function wo_report()
	{
		$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
		$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
		//echo $type_id;die;
		$data['action_ds'] = base_url().'Dashboard_workorder_final';
		$data['executive'] = $this->Dashboard_workorder_final_model->get_Executive();
		//echo '<pre>';print_r($data);die;
		$page_no = $this->uri->segment(3) ? $this->uri->segment(3)-1 : 0;
		$limit = 10;
		if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1 || $dep_id == 2 || $dep_id == 9 || $dep_id == 5)
		{
			$data['total_record'] = $this->Dashboard_workorder_final_model->get_all_report_work_order_count();
			$data['total_pages'] = ceil($data['total_record']/$limit);
			$start = $page_no*$limit;
			$data['work_orders'] = $this->Dashboard_workorder_final_model->get_all_report_work_order($start,$limit);

			$this->load->library('pagination');

			$config['base_url'] = base_url().'Dashboard_workorder_final/wo_report/';
			$config['total_rows'] = $data['total_record'];
			$config['per_page'] = $limit;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
			$config['full_tag_close'] = '</ul>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
			$config['cur_tag_close'] = '</a></li>';
			//$config['use_global_url_suffix'] = FALSE;
			$this->pagination->initialize($config);
			$data['pagi_links'] = $this->pagination->create_links();
			//$data['work_orders_count'] = $this->Dashboard_workorder_final_model->get_all_work_orders_count();
			//echo '<pre>';print_r($data['work_orders']);die;
			$data['main_content'] = 'Dashboard_workorder_report_view';
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
	public function account_approve_report()
	{
		$data['main_content'] = 'Account_approve_report';
		$this->load->view('includes/template', $data);
	}
	public function ajax_account_approve_report()
	{
		$user = $this->Dashboard_workorder_final_model->wo_report();
		//echo '<pre>';print_r($user);die;
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
		$idenc = $this->encrypt_decrypt('encrypt',$user[$i]['wo_id']);
		//$this->encrypt->encode($user[$i]['sq_id']);
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$right_status = $this->check_rights('edit');
		if($right_status == false)
		{
			$editstr = '';
		}else{
			$editstr = '<a title="Edit" href="'.base_url().'Work_order_item_list/other_details/'.$idenc.'" class="btn btn-sm btn-outline green"><i class="fa fa-pencil"></i></a>';
		}
		$right_status = $this->check_rights('delete');
		if($right_status == false)
		{
			$deletestr = '';
		}else{
			$type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
			$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
			if($type_id == 3 || $dep_id == 10)
			{
				$deletestr = '<a title="delete" href="'.base_url().'Work_order_item_list/delete/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Delete this record?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-times"></i></a>';
			}	
			else{
				$deletestr = '';
			}
		}
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$quotestr = '';
		}else{
			$quotestr = '<a title="Create Quotation" href="'.base_url().'Work_order_item_list/create_quote/'.$idenc.'"onclick="return confirm('."'Are you sure you want to Create Quotation?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i></a>';
		}
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$viewpdfstr = '';
		}else{
			$viewpdfstr = '<a title="View PDF" href="'.base_url().'pdf/wo/wo'.$idenc.'.pdf" class="btn btn-sm btn-outline blue" target="_blank"><i class="fa fa-eye"></i></a>';
		}
		$linkstr = '';
		//echo $type_id;die;
		if($type_id == 3)
		{
			if($user[$i]['woi_admin_approve'] == '0' && $this->input->get('adminapproved')){
				$linkstr = '<a href="'.base_url().'Dashboard_workorder_final/check_qty?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'" class="btn btn-success"><i class="fa fa-check"></i></a>
											  <a href="'.base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
											  <a href="'.base_url().'Dashboard_workorder_final/delete_itm?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'"  onclick="return confirm('."'Are you sure you want to delete this records?'".')" class="btn btn-success"><i class="fa fa-close"></i></a>';
			}
		}else{
			$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
			if($dep_id == 10)
			{
				if($user[$i]['woi_manager_approve'] == '0' && $this->input->get('smapproved')){
				$linkstr = '<a href="'.base_url().'Dashboard_workorder_final/check_qty?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'" class="btn btn-success"><i class="fa fa-check"></i></a>
											  <a href="'.base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
											  <a href="'.base_url().'Dashboard_workorder_final/delete_itm?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'"  onclick="return confirm('."'Are you sure you want to delete this records?'".')" class="btn btn-success"><i class="fa fa-close"></i></a>';
											}
			}else if($dep_id == 11){
				if($user[$i]['woi_promanager_approve'] == '0' && $this->input->get('pmapproved')){
				$linkstr = '<a href="'.base_url().'Dashboard_workorder_final/check_qty?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'" class="btn btn-success"><i class="fa fa-check"></i></a>
											  <a href="'.base_url().'Dashboard_workorder_final/edit_qty?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
											  <a href="'.base_url().'Dashboard_workorder_final/delete_itm?wo_itemid='.$user[$i]['woi_id'].'&itemid='.$user[$i]['woi_item_id'].'&wo_id='.$user[$i]['woi_wo_id'].'"  onclick="return confirm('."'Are you sure you want to delete this records?'".')" class="btn btn-success"><i class="fa fa-close"></i></a>';
											}
			}
		}

		$user[$i]['wo_preparedby'] = $user[$i]['au_fname'].' '. $user[$i]['au_lname'];
		$records["data"][] = array(
				''.$user[$i]['wo_wo_no'],
				''.$user[$i]['wo_wo_date'],
				''.$user[$i]['wo_customer_name'],
				''.$user[$i]['wo_preparedby'],
				''.$user[$i]['otw_invno'],
				''.$user[$i]['otw_challan_no'],
				''.$user[$i]['otw_invftotal'],
				''.$user[$i]['wo_remark'],
				''.$user[$i]['otw_invdate'],
				//''.$user[$i]['sq_ref_by'],
			    $linkstr
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
				$finalrights = $this->global_model->get_rights($rightsid,$moduleid = 19,$type);
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
		if($this->input->post())
		{
			//echo '<pre>';print_r($postvalue);die;
			$postvalue = array();
			$postvalue = $this->input->post();
			//echo '<pre>';print_r($postvalue);die;
			$this->Dashboard_workorder_final_model->insert_invoicedata($postvalue);
			//echo '<pre>';print_r($postvalue);die;
			redirect(base_url()."Dashboard_workorder_final");
		}else{
			if(isset($value) && !empty($value) && isset($value['otw_id']) && ($value['otw_id'] != '') && ($value['otw_id'] != 0))
			{
				$inv_type = $this->Dashboard_workorder_final_model->check_invoice_type($value['otw_id']);
				//echo '<pre>';print_r($inv_type['otw_invoice_type']);die;
				if($inv_type['invoice_type'] != 0)
				{
					//$data['inv_no'] = $this->Dashboard_workorder_final_model->get_invoiceno($inv_type['otw_invoice_type']);
					//$data['challan_no'] = $this->Dashboard_workorder_final_model->get_challan_no();
					//echo '<pre>';print_r($data['inv_no']);die;
					$data['invoice_details'] = $inv_type;
					$data['error_msg'] = 'Only Account Manager can Edit.';
					$data['action'] = base_url().'Dashboard_workorder_final/account_edit_otw';
					$data['main_content'] = 'Account_edit_view';
					$this->load->view('includes/template', $data);
				}
				else
				{
					$data['error_msg'] = 'Pl. Select Invoice Type';
					redirect(base_url()."Dashboard_workorder_final",$data);
				}
			}
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
	public function invnocheck()
	{
		//echo "hiii";die;
		$this->Dashboard_workorder_final_model->invnocheck();
		redirect(base_url()."Dashboard_workorder_final#outwardinv".$this->input->get('otw_id'));

	}

	public function account_delete_otw()
	{
		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;
			$postvalue = array();
			$postvalue = $this->input->post();
			//echo '<pre>';print_r($postvalue);die;
			$this->Dashboard_workorder_final_model->account_delete_otw($postvalue);
			//echo '<pre>';print_r($postvalue);die;
			redirect(base_url()."Dashboard_workorder_final");
		}
		else
		{
			$value = $this->input->get();
			//echo '<pre>';print_r($value['otw_id']);die;
			$data['outward_details'] = $this->Dashboard_workorder_final_model->get_single_outward_details();
			$data['action'] = base_url().'Dashboard_workorder_final/account_delete_otw';
			$data['main_content'] = 'account_delete_confirmation_view';
			$this->load->view('includes/template', $data);
		}	
	}

	public function view_coverwo_sticker()
	{
		$data['work_orders'] = $this->Dashboard_workorder_final_model->get_sticker_work_order();
		$data['main_content'] = 'workorder_sticker_view_portrait';
		$this->load->view('includes/template', $data);
	}

	public function test_completed()
	{
		$this->Dashboard_workorder_final_model->test_completed();
	}
}
