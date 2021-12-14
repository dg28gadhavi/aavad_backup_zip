<?php 

class work_order_dashboard_model extends CI_Model {
	
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
	
	public function get_inq_data()
    {
        //echo $this->input->get('executive'); die;
        $value = array();
        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_isdeleted',0);
        $this->db->limit(10);
        $this->db->order_by('wo_id','desc');
        $query = $this->db->get();
        $value['sales_inq'] = $query->result_array();

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_isdeleted',0);
        $this->db->where('wo_director_ar_id',1);
        $this->db->order_by('wo_id','desc');
        $query = $this->db->get();
        $value['wo_director_list'] = $query->result_array();

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_isdeleted',0);
        $this->db->where('wo_pro_man_ar_id',1);
        $this->db->order_by('wo_id','desc');
        $query = $this->db->get();
        $value['wo_pro_manager_list'] = $query->result_array();

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_isdeleted',0);
        $this->db->where('wo_store_ar_id',1);
        $this->db->order_by('wo_id','desc');
        $query = $this->db->get();
        $value['wo_store_list'] = $query->result_array();

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_isdeleted',0);
        $this->db->where('wo_account_ar_id',1);
        $this->db->order_by('wo_id','desc');
        $query = $this->db->get();
        $value['wo_account_list'] = $query->result_array();

        $this->db->select('COUNT(wo_id) as count');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_isdeleted','0');
        $query = $this->db->get();
        $value['totalinq'] = $query->row_array();


        
        /****************************************************************/
            /***********************************************************/
        /************************ Work Order Approved By Record *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('wo_approved_by as status,count((wo_approved_by)) as count,dep_name as name');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_department', 'tbl_department.dep_id = tbl_work_order.wo_approved_by');
        $this->db->where('wo_isdeleted', 0);
        $this->db->group_by('wo_approved_by');
        $this->db->order_by('tbl_department.dep_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_status'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('wo_approved_by as status,count((wo_approved_by)) as count');
        $this->db->from('tbl_work_order');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('wo_isdeleted', 0);
        //$this->db->group_by('wo_approved_by');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('wo_approved_by as status,count((wo_approved_by)) as count');
        $this->db->from('tbl_work_order');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('wo_isdeleted', 0);
        //$this->db->group_by('wo_approved_by');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_status_one'] = $query->row_array();
        /****************************************************************/
            /***********************************************************/
        /************************ Work Order Prepared By *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('wo_prepared_by as status,count((wo_prepared_by)) as count');
        $this->db->from('tbl_work_order');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('wo_isdeleted',0);
        //$this->db->where('wo_prepared_by !=', 0);
        $this->db->group_by('wo_prepared_by');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
       // echo "<pre>"; print_r($query->result_array()); die;
        $value['wo_prepared'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sa_inq_st as status,count((sa_inq_st)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        $this->db->where('sa_inq_st', 0);
        //$this->db->group_by('sa_inq_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_quote_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sa_inq_st as status,count((sa_inq_st)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        //$this->db->group_by('sa_inq_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_quote_status_one'] = $query->row_array();

        /****************************************************************/
            /***********************************************************/
        /************************ Work Order Handled By Record *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('wo_handled_by as status,count((wo_handled_by)) as count,au_fname as name');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_work_order.wo_handled_by');
        $this->db->where('wo_isdeleted', 0);
        $this->db->group_by('wo_handled_by');
        $this->db->order_by('tbl_admin_users.au_fname', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['wo_handled'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('wo_approved_by as status,count((wo_approved_by)) as count');
        $this->db->from('tbl_work_order');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('wo_isdeleted', 0);
        //$this->db->group_by('wo_approved_by');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('wo_approved_by as status,count((wo_approved_by)) as count');
        $this->db->from('tbl_work_order');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('wo_isdeleted', 0);
        //$this->db->group_by('wo_approved_by');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $query = $this->db->get();
        $value['inq_status_one'] = $query->row_array();
        
        return $value;
    }
	
}
?>