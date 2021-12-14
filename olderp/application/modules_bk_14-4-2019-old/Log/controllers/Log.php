<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model');
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$ans = $this->is_logged();
		if($ans != 1)
		{
			redirect('login','refresh');
		}
	}
	 
	public function index()
	{
		//$tablename = 'tbl_master_item';
		//$output = $this->crud($tablename);
		$this->data['main_content'] = 'Log_grid_view';
		$this->load->view('includes/template',$this->data);
	}

	public function ajax()
	{
		$user = $this->Log_model->get_Log();
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
		if(isset($user[$i]['adlog_ip']) && $user[$i]['adlog_ip'] != ''){
			$ip = $user[$i]['adlog_ip'];
		}else{
			$ip = '';
		}
		if(isset($user[$i]['adlog_name']) && $user[$i]['adlog_name'] != ''){
			$name = $user[$i]['adlog_name'];
		}else{
			$name = '';
		}

		if(isset($user[$i]['adlog_datetime']) && $user[$i]['adlog_datetime'] != ''){
			$date = $user[$i]['adlog_datetime'];
		}else{
			$date = '';
		}

		if(isset($user[$i]['adlog_login']) && $user[$i]['adlog_login'] != '' && $user[$i]['adlog_login'] == 1){
			$login = 'Yes';
		}else{
			$login = '';
		}

		if(isset($user[$i]['adlog_add']) && $user[$i]['adlog_add'] != '' && $user[$i]['adlog_add'] == 1){
			$add = 'Yes';
		}else{
			$add = '';
		}

		if(isset($user[$i]['adlog_edit']) && $user[$i]['adlog_edit'] != '' && $user[$i]['adlog_edit'] == 1){
			$edit = 'Yes';
		}else{
			$edit = '';
		}

		if(isset($user[$i]['adlog_delete']) && $user[$i]['adlog_delete'] != '' && $user[$i]['adlog_delete'] == 1){
			$delete = 'Yes';
		}else{
			$delete = '';
		}

		if(isset($user[$i]['adlog_module']) && $user[$i]['adlog_module'] != ''){
			$module = $user[$i]['adlog_module'];
		}else{
			$module = '';
		}
		if(isset($user[$i]['adlog_file']) && $user[$i]['adlog_file'] != ''){
			$file = $user[$i]['adlog_file'];
		}else{
			$file = '';
		}
		//$crud->columns('master_item_code','master_item_name','master_item_description','master_item_make','master_item_rating','master_item_part_no','master_item_price','master_item_stock','master_item_created_date','master_item_updated_date');
		$records["data"][] = array(
			   '<input type="checkbox" name="id[]" value="'.$user[$i]['adlog_id'].'">',
			  $id,
			  ''.$ip,
			  ''.$name,
			  ''.$date,
			  ''.$login,
			  ''.$module,
			  ''.$file,
			  ''.$add,
			  ''.$edit,
			  ''.$delete,
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

	public function clearall()
	{
		$this->Log_model->clearall();
		$this->session->set_flashdata('success', 'All Data Deleted successfully!!');
		redirect('Log','refresh');

	}
	
	
	
	public function is_logged()
	{
		return (bool)$this->session->userdata('authorized');
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
}?>