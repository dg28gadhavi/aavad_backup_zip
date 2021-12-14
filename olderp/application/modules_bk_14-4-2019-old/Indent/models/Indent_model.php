<?php 

class Indent_model extends CI_Model {
	
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

	public function wo_indent_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_work_order_item');
		//$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_Purchase_order_item.sqi_itm_hsncode','left');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_work_order_item.woi_item_id','left');
		$this->db->where('woi_open_qty !=',0);
		$this->db->where('woi_opnqty_bit',0);
		//$this->db->where('sqi_is_bom !=',1);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();	
	}

	
	public function Indent_report()
	{
		$this->db->select('tbl_master_item.*,IFNULL((IFNULL((select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 2 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'1'".' ),0) - IFNULL((select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 1 AND tdebit.tran_itm_id = tbl_master_item.master_item_id  AND tdebit.tran_is_hold = '."'1'".' ),0)) - (IFNULL((select ROUND(SUM(tcredit_stock.tran_itm_qty),2) FROM tbl_transaction as tcredit_stock WHERE tcredit_stock.tran_cr_or_dr = 1 AND tcredit_stock.tran_itm_id = tbl_master_item.master_item_id AND tcredit_stock.tran_is_hold = '."'0'".' ),0) - IFNULL((select ROUND(SUM(tdebit_stock.tran_itm_qty),2) FROM tbl_transaction as tdebit_stock WHERE tdebit_stock.tran_cr_or_dr = 2 AND tdebit_stock.tran_itm_id = tbl_master_item.master_item_id  AND tdebit_stock.tran_is_hold = '."'0'".' ),0)),0) as finalstock');
		$this->db->from('tbl_master_item');
		//$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_master_item.master_item_hsncode','left');
		//$this->db->where('tbl_master_item.master_item_flag !=',3);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		 // $this->db->order_by('inv_id','desc');
   	   if($this->input->post('item_no') && ($this->input->post('item_no') != ''))
        {
           $this->db->like('master_item_code', $this->input->post('item_no'));   
        }
          if($this->input->post('item_name') && ($this->input->post('item_name') != ''))
        {
           $this->db->like('master_item_name', $this->input->post('item_name'));   
        }
   
    	 // if($this->input->post('hsn_code') && ($this->input->post('hsn_code') != ''))
      //   {
      //      $this->db->like('master_item_hsncode', $this->input->post('hsn_code'));   
      //   }
        if($this->input->post('pno') && ($this->input->post('pno') != ''))
        {
           $this->db->like('master_item_part_no', $this->input->post('pno'));   
        }
        $this->db->where('IFNULL((IFNULL((select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 2 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'1'".' ),0) - IFNULL((select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 1 AND tdebit.tran_itm_id = tbl_master_item.master_item_id  AND tdebit.tran_is_hold = '."'1'".' ),0)) - (IFNULL((select ROUND(SUM(tcredit_stock.tran_itm_qty),2) FROM tbl_transaction as tcredit_stock WHERE tcredit_stock.tran_cr_or_dr = 1 AND tcredit_stock.tran_itm_id = tbl_master_item.master_item_id AND tcredit_stock.tran_is_hold = '."'0'".' ),0) - IFNULL((select ROUND(SUM(tdebit_stock.tran_itm_qty),2) FROM tbl_transaction as tdebit_stock WHERE tdebit_stock.tran_cr_or_dr = 2 AND tdebit_stock.tran_itm_id = tbl_master_item.master_item_id  AND tdebit_stock.tran_is_hold = '."'0'".' ),0)),0) >',0);
        $this->db->order_by('tbl_master_item.master_item_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();	
	}
}
?>