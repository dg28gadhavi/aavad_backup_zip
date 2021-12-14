<?php 

class Dashboard_qoutation_model extends CI_Model {
	
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
        // $this->db->select('*');
        // $this->db->from('tbl_sales_enq');
        // $this->db->where('sq_isdeleted','0');
        // $this->db->limit(10);
        // $this->db->order_by('sq_id','desc');
        // $query = $this->db->get();
        // $value['sales_inq'] = $query->result_array();

        $this->db->select('COUNT(sq_id) as count');
        $this->db->from('tbl_sales_enq');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
            {
                $start_date=$this->input->get('start_date');
                $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
            }
            if($this->input->get('end_date') && $this->input->get('end_date') != "")
            {
                    $end_date=$this->input->get('end_date');
                $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
            }
        $this->db->where('sq_isdeleted','0');
        $query = $this->db->get();
        $value['totalinq'] = $query->row_array();


        // $this->db->select('*');
        // $this->db->from('tbl_sale_quotation');
        // $this->db->where('sa_isdeleted','0');
        // $this->db->limit(10);
        // $this->db->order_by('sa_id','desc');
        // $query = $this->db->get();
        // $value['sales_quotation'] = $query->result_array();

        $this->db->select('COUNT(sa_id) as count');
        $this->db->from('tbl_sale_quotation');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $this->db->where('sa_inq_st !=', 0);
        $this->db->where('sa_isdeleted','0');
        $query = $this->db->get();
        $value['totalquotation'] = $query->row_array();

        $this->db->select('COUNT(oa_id) as count');
        $this->db->from('tbl_oa');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('oa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
            
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
            {
                $start_date=$this->input->get('start_date');
                $this->db->where("oa_cdate >=",date("Y-m-d", strtotime(($start_date))));
            }
            if($this->input->get('end_date') && $this->input->get('end_date') != "")
            {
                    $end_date=$this->input->get('end_date');
                $this->db->where("oa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
            }
        $this->db->where('oa_isdeleted',0);
        $query = $this->db->get();
        $value['totaloa'] = $query->row_array();
// ahi sudhi kryu 6e **********************
        $this->db->select('SUM(sa_grd_ttl) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_sale_quotation', 'tbl_sale_quotation_item.sai_sale_quotation_id = tbl_sale_quotation.sa_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $this->db->where('sa_isdeleted','0');
       // $this->db->where('sai_isdeleted','0');
        $query = $this->db->get();
        $value['totalamontinq'] = $query->row_array();
        
        /****************************************************************/
            /***********************************************************/
        /************************Inq. Status Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('sq_inq_sts as status,count((sq_inq_sts)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        $this->db->where('sq_inq_sts !=', 0);
        $this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_status'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sq_inq_sts as status,count((sq_inq_sts)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sq_isdeleted', 0);
       $this->db->where('sq_inq_sts', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sq_inq_sts as status,count((sq_inq_sts)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_status_one'] = $query->row_array();
/****************************************************************/
            /***********************************************************/
        /************************brand Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('sab_brand as status,brand_name as name,count((sab_brand)) as count,SUM((sa_grd_ttl)) as total_amt');
        $this->db->from('tbl_sale_quotation');
        $this->db->join('tbl_sale_quotation_brand', 'tbl_sale_quotation_brand.sab_sq_id = tbl_sale_quotation.sa_id');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id = tbl_sale_quotation_brand.sab_brand');
        $this->db->where('sa_isdeleted', '0');
        $this->db->where('sab_brand !=', 0);
        $this->db->group_by('sab_brand');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('tbl_sale_quotation.sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_brand'] = $query->result_array();
        //echo "<pre>"; print_r($value['inq_brand']); die;
        /**********************************************************/
        $this->db->select('sab_brand as status,count((sab_brand)) as count');
        $this->db->from('tbl_sale_quotation');
        $this->db->join('tbl_sale_quotation_brand', 'tbl_sale_quotation_brand.sab_sq_id = tbl_sale_quotation.sa_id');
        $this->db->where('sa_isdeleted', '0');
        $this->db->where('sab_brand', 0);

        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
             if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_brand_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
       $this->db->select('sab_brand as status,count((sab_brand)) as count');
        $this->db->from('tbl_sale_quotation');
        $this->db->join('tbl_sale_quotation_brand', 'tbl_sale_quotation_brand.sab_sq_id = tbl_sale_quotation.sa_id');
        $this->db->where('sa_isdeleted', '0');
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
             if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_brand_one'] = $query->row_array();
/****************************************************************/
            /***********************************************************/
        /************************source Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('source_cat_name as name,sa_source_cat as status,count((sa_source_cat)) as count,SUM((sa_grd_ttl)) as total_amt');
        $this->db->from('tbl_sale_quotation');
       $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_sale_quotation.sa_source_cat');
        $this->db->where('sa_isdeleted', '0');
        $this->db->group_by('sa_source_cat');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
         if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_source'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sa_source_cat as status,count((sa_source_cat)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sa_isdeleted', '0');
       $this->db->where('sa_source_cat', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
         if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_source_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sa_source_cat as status,count((sa_source_cat)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
         if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_source_one'] = $query->row_array();
        /****************************************************************/
            /***********************************************************/
        /************************sub source Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('source_cat_name as name,sa_subsource_cat as status,count((sa_subsource_cat)) as count,SUM((sa_grd_ttl)) as total_amt');
        $this->db->from('tbl_sale_quotation');
       $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_sale_quotation.sa_subsource_cat');
        $this->db->where('sa_isdeleted', '0');
        $this->db->group_by('sa_subsource_cat');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
         if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_subsource'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sa_subsource_cat as status,count((sa_subsource_cat)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sa_isdeleted', '0');
       $this->db->where('sa_subsource_cat', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
             if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_subsource_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sa_subsource_cat as status,count((sa_subsource_cat)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
         if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_subsource_one'] = $query->row_array();

/****************************************************************/
            /***********************************************************/
        /************************Executive Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('au_fname as fname,au_lname as lname,sa_inq_by as  status,count((sa_inq_by)) as count,SUM((sa_grd_ttl)) as total_amt');
        $this->db->from('tbl_sale_quotation');
       $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sale_quotation.sa_inq_by','left');
        $this->db->where('sa_isdeleted', '0');
        $this->db->group_by('sa_inq_by');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_by'] = $query->result_array();
        /**********************************************************/
        $this->db->select('sa_inq_by as status,count((sa_inq_by)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sa_isdeleted', '0');
       $this->db->where('sa_inq_by', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
             if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_by_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sa_inq_by as status,count((sa_inq_by)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
             if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_by_one'] = $query->row_array();
        /****************************************************************/
            /***********************************************************/
        /************************Inq. Quote.Status Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('qs_name as status,count((sa_inq_st)) as count,SUM((sa_grd_ttl)) as total_amt');
        $this->db->from('tbl_sale_quotation');
        $this->db->join('tbl_quatation_status', 'tbl_quatation_status.qs_id = tbl_sale_quotation.sa_inq_st');
        $this->db->where('sa_isdeleted', '0');
        $this->db->where('sa_inq_st !=', 0);
        $this->db->group_by('sa_inq_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
         if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
       // echo "<pre>"; print_r($query->result_array()); die;
        $value['inq_quote_status'] = $query->result_array();
        
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
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
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
             if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_quote_status_one'] = $query->row_array();
        
        $this->db->select('au_fname as fname,au_lname as lname,sa_inq_by as status,count((sa_inq_by)) as count,SUM((sa_grd_ttl)) as total_amt');
        $this->db->from('tbl_sale_quotation');
       $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sale_quotation.sa_inq_by','left');
        $this->db->where('sa_isdeleted', '0');
        $this->db->group_by('sa_inq_by');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_bysts'] = $query->result_array();
        
        foreach ($value['inq_bysts'] as $key => $inq_bysts) 
        {
            //echo "<pre>"; print_r($inq_bysts['status']); die;
            $this->db->select('qs_name as status,count((sa_inq_st)) as count,SUM((sa_grd_ttl)) as total_amt');
            $this->db->from('tbl_sale_quotation');
            $this->db->join('tbl_quatation_status', 'tbl_quatation_status.qs_id = tbl_sale_quotation.sa_inq_st');
            $this->db->where('sa_isdeleted', '0');
            $this->db->where('sa_cid', $inq_bysts['status']);
            $this->db->where('sa_inq_st !=', 0);
            $this->db->group_by('sa_inq_st');
            $query = $this->db->get();
            $value['inq_bysts'][$key]['stsdata'] = $query->result_array();
        }
        return $value;
    }
	
}
?>