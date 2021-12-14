<?php

class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

	
	function edit_unique($value, $params)
	{
		$CI =& get_instance();
		$CI->load->database();
	
		$CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
	
		list($table, $field, $current_id, $auto_table_id) = explode(".", $params);
	
		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();
	
		if ($query->row() && $query->row()->$auto_table_id != $current_id)//here autoincrement id set aus_id == auto increment id
		{
			return FALSE;
		}
	}
	
}

?>