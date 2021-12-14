<?php 

class Dashboard_model extends CI_Model {
	
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
        $this->db->select('COUNT(inq_id) as count');
        $this->db->from('tbl_inquiry');
        if(empty($this->input->get('executive')))
        {
            //echo "111111111111111"; die;
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                //echo $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']); die;
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            //echo "222222222222"; die;
            //echo $this->encrypt_decrypt('decrypt',$this->input->get('executive')); die;
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }

		
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['totalinq'] = $query->row_array();

        $this->db->select('COUNT(vf_id) as count');
        $this->db->from('tbl_visa_file');
        $this->db->where('tbl_visa_file.vf_isdelete', '0');
        if(empty($this->input->get('executive')))
        {
            //echo "111111111111111"; die;
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                //echo $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']); die;
                $this->db->where('tbl_visa_file.vf_sd_fl_exe', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            //echo "222222222222"; die;
            //echo $this->encrypt_decrypt('decrypt',$this->input->get('executive')); die;
            $this->db->where('tbl_visa_file.vf_sd_fl_exe', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }

        
        $query = $this->db->get();
        $value['totalvisa'] = $query->row_array();
 		/****************************************************************/
 			/***********************************************************/
		/************************Product Type Stastics*****************/
		/***********************************************************/
        $this->db->select('DISTINCT(tbl_uproduct_details.prod_type_id) as typeid,count((tbl_uproduct_details.prod_type_id)) as count, tbl_product_type.prot_name as name,tbl_product_type.prot_id as pro_id');
        $this->db->from('tbl_uproduct_details');
        $this->db->join('tbl_inquiry', 'tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id');
        $this->db->join('tbl_product_type', 'tbl_product_type.prot_id = tbl_uproduct_details.prod_type_id');
        $this->db->where('tbl_uproduct_details.prod_type_id !=', 0);
        //$this->db->where('tbl_uproduct_details.prod_type_id', 0);
        if(empty($this->input->get('executive')))
        {
            //echo "111111111111111"; die;
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                //echo $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']); die;
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            //echo "222222222222"; die;
            //echo $this->encrypt_decrypt('decrypt',$this->input->get('executive')); die;
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $this->db->group_by('tbl_uproduct_details.prod_type_id');
        $this->db->order_by('tbl_product_type.prot_name', 'ASC');
        $query = $this->db->get();
        $value['type'] = $query->result_array();
        //********************************************************
		
        $this->db->select('COUNT(tbl_uproduct_details.prod_type_id) as count');
        $this->db->from('tbl_uproduct_details');
        $this->db->join('tbl_inquiry', 'tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id');
        $this->db->where('tbl_uproduct_details.prod_type_id', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['type_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('DISTINCT(tbl_inquiry.inq_id),COUNT(tbl_uproduct_details.prod_type_id) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_uproduct_details', 'tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id','left');
        $this->db->where('tbl_uproduct_details.prod_type_id !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_uproduct_details.prod_type_id !=',0);
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['type_all'] = $query->row_array();
      
        /****************************************************************/
 			/***********************************************************/
		/************************Product Category Stastics*****************/
		/***********************************************************/

         $this->db->select('DISTINCT(tbl_uproduct_details.prod_cat_id) as typeid,count((tbl_uproduct_details.prod_cat_id)) as count, tbl_product_category.procat_name  as name, tbl_product_category.procat_id  as procat_id');
        $this->db->from('tbl_uproduct_details');
        $this->db->join('tbl_inquiry', 'tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id');
        $this->db->join('tbl_product_category', 'tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id');
        $this->db->where('tbl_uproduct_details.prod_cat_id !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $this->db->group_by('tbl_uproduct_details.prod_cat_id');
        $this->db->order_by('tbl_product_category.procat_name', 'ASC');
        $query = $this->db->get();
        $value['category'] = $query->result_array();
		
		$this->db->select('COUNT(tbl_uproduct_details.prod_cat_id) as count');
        $this->db->from('tbl_uproduct_details');
        $this->db->join('tbl_inquiry', 'tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id');
        //$this->db->join('tbl_product_category', 'tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id');
        $this->db->where('tbl_uproduct_details.prod_cat_id', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        //$this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['category_zero'] = $query->row_array();
		//echo "<pre>"; print_r($value['category_zero']); die;
		$this->db->select('COUNT(tbl_uproduct_details.prod_cat_id) as count');
        $this->db->from('tbl_uproduct_details');
        $this->db->join('tbl_inquiry', 'tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id');
        $this->db->join('tbl_product_category', 'tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id');
        $this->db->where('tbl_uproduct_details.prod_cat_id !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['category_one'] = $query->row_array();
		//echo "<pre>"; print_r($value['category_one']); die;
		 /****************************************************************/
 			/***********************************************************/
		/************************Inq. Status Stastics *****************/
		/***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('DISTINCT(tbl_inquiry.inq_inqstatus) as typeid,count((tbl_inquiry.inq_inqstatus)) as count, tbl_inquiry_status.inquiry_status_name  as name,tbl_inquiry_status.inquiry_status_id  as status_id');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('tbl_inquiry.inq_inqstatus !=', 0);
        $this->db->group_by('tbl_inquiry.inq_inqstatus');
        $this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['inq_status'] = $query->result_array();
		
		/**********************************************************/
		$this->db->select('COUNT(tbl_inquiry.inq_inqstatus) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('tbl_inquiry.inq_inqstatus', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['inq_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('COUNT(tbl_inquiry.inq_inqstatus) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('tbl_inquiry.inq_inqstatus !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['inq_status_one'] = $query->row_array();
		
		/***********************************************************/
		/************************Inq Type Stastics*****************/
		/***********************************************************/
		
        $this->db->select('DISTINCT(tbl_inquiry.inq_type) as typeid,count((tbl_inquiry.inq_type)) as count, tbl_inquiry_type.inquiry_type_name  as name,tbl_inquiry_type.inquiry_type_id  as type_id');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_inquiry_type', 'tbl_inquiry_type.inquiry_type_id = tbl_inquiry.inq_type');
        $this->db->where('tbl_inquiry.inq_type !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $this->db->group_by('tbl_inquiry.inq_type');
        $this->db->order_by('tbl_inquiry_type.inquiry_type_name', 'ASC');
        $query = $this->db->get();
        $value['inq_type'] = $query->result_array();
		
		$this->db->select('COUNT(tbl_inquiry.inq_type) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_inquiry_type', 'tbl_inquiry_type.inquiry_type_id = tbl_inquiry.inq_type');
        $this->db->where('tbl_inquiry.inq_type', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['inq_type_zero'] = $query->row_array();
		
		$this->db->select('COUNT(tbl_inquiry.inq_type) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_inquiry_type', 'tbl_inquiry_type.inquiry_type_id = tbl_inquiry.inq_type');
        $this->db->where('tbl_inquiry.inq_type !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['inq_type_one'] = $query->row_array();
		
		/***********************************************************/
		/************************Source Stastics*************/
		/***********************************************************/
		
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('DISTINCT(tbl_inquiry.inq_source) as typeid,count((tbl_inquiry.inq_source)) as count, tbl_source_cat.source_cat_name  as name,tbl_source_cat.source_cat_id  as sorce_id');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_source');
        $this->db->where('tbl_inquiry.inq_source !=', 0);
        $this->db->where('tbl_source_cat.source_main_cat', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $this->db->group_by('tbl_inquiry.inq_source');
        $this->db->order_by('tbl_source_cat.source_cat_name', 'ASC');
        $query = $this->db->get();
        $value['source'] = $query->result_array();
		
		 $this->db->select('COUNT(tbl_inquiry.inq_source) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_source');
        $this->db->where('tbl_inquiry.inq_source', 0);
        $this->db->where('tbl_source_cat.source_main_cat', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['source_zero'] = $query->row_array();
		
		$this->db->select('COUNT(tbl_inquiry.inq_source) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_source');
        $this->db->where('tbl_inquiry.inq_source !=', 0);
        $this->db->where('tbl_source_cat.source_main_cat', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['source_one'] = $query->row_array();
		
		/***********************************************************/
		/******************Sub Source Stastics**********************/
		/***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
         $this->db->select('DISTINCT(tbl_inquiry.inq_subsource) as typeid,count((tbl_inquiry.inq_subsource)) as count, tbl_source_cat.source_cat_name  as name,tbl_source_cat.source_cat_id  as sub_id');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_subsource');
        $this->db->where('tbl_inquiry.inq_subsource !=', 0);
        $this->db->where('tbl_source_cat.source_main_cat !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $this->db->group_by('tbl_inquiry.inq_subsource');
        $this->db->order_by('tbl_source_cat.source_cat_name', 'ASC');
        $query = $this->db->get();
        $value['subsource'] = $query->result_array();
		
		$this->db->select('COUNT(tbl_inquiry.inq_subsource) as count');
        $this->db->from('tbl_inquiry');
        //$this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_subsource');
        $this->db->where('tbl_inquiry.inq_subsource', 0);
        //$this->db->where('tbl_source_cat.source_main_cat', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        
        $value['subsource_zero'] = $query->row_array();
        //echo "<pre>"; print_r($value['subsource_zero']); die;
		
		$this->db->select('COUNT(tbl_inquiry.inq_subsource) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_subsource');
        $this->db->where('tbl_inquiry.inq_subsource !=', 0);
        $this->db->where('tbl_source_cat.source_main_cat !=', 0);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['subsource_one'] = $query->row_array();

       /***********************************************************/
		/******************Executive Stastics**********************/
		/***********************************************************/
		
         $this->db->select('DISTINCT(tbl_inquiry.inq_au_id) as typeid,count((tbl_inquiry.inq_au_id)) as count, tbl_admin_users.au_fname  as name,tbl_admin_users.au_id  as aus_id');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_inquiry.inq_au_id');
        $this->db->where('tbl_inquiry.inq_au_id !=', 0);
        $this->db->group_by('tbl_inquiry.inq_au_id');
        $this->db->order_by('tbl_admin_users.au_fname', 'ASC');
		if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['auser'] = $query->result_array();
		
		$this->db->select('COUNT(tbl_inquiry.inq_au_id) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_inquiry.inq_au_id');
        $this->db->where('tbl_inquiry.inq_au_id', 0);
		if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['auser_zero'] = $query->row_array();
		
		$this->db->select('COUNT(tbl_inquiry.inq_au_id) as count');
        $this->db->from('tbl_inquiry');
        $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_inquiry.inq_au_id');
        $this->db->where('tbl_inquiry.inq_au_id !=', 0);
		if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();
        $value['auser_one'] = $query->row_array();
        
		  /***********************************************************/
		/******************List Of Source***************************/
		/***********************************************************/
		
		$this->db->select('DISTINCT(tbl_inquiry.inq_subsource) as typeid,count((tbl_inquiry.inq_subsource)) as count, tbl_source_cat.source_cat_name  as name');
        $this->db->from('tbl_inquiry');
		 $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_inquiry.inq_subsource');
       	$this->db->where('tbl_inquiry.inq_source', 46);
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $this->db->group_by('tbl_inquiry.inq_subsource');
        $this->db->order_by('tbl_source_cat.source_cat_name', 'ASC');
        $query = $this->db->get();       
		$value['source_list'] = $query->result_array();
         /***********************************************************/
        /******************List Of Followup***************************/
        /***********************************************************/
        
        $this->db->select('tbl_inquiry.inq_id as id,tbl_inquiry.inq_date as inq_dt,tbl_ufollowup.fu_followdate as followdate,tbl_inquiry.inq_no as no,tbl_ubasic_details.bd_fname as name,tbl_ucontact_nos.con_no_mnos as mno,tbl_inquiry_status.inquiry_status_name as stname,tbl_admin_users.au_fname as executive,tbl_product_category.procat_name as category');
        $this->db->from('tbl_inquiry');
         $this->db->join('tbl_ufollowup', 'tbl_ufollowup.fu_inq_id = tbl_inquiry.inq_id','left');
         $this->db->join('tbl_ubasic_details', 'tbl_ubasic_details.bd_inq_id = tbl_inquiry.inq_id','left');
         $this->db->join('tbl_ucontact_nos', 'tbl_ucontact_nos.con_no_inq_id = tbl_inquiry.inq_id','left');
         $this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus','left');
         $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_inquiry.inq_au_id','left');
         $this->db->join('tbl_uproduct_details', 'tbl_uproduct_details.prod_inq_id = tbl_inquiry.inq_id','left');
         $this->db->join('tbl_product_category', 'tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id','left');
         //$this->db->limit('tbl_ufollowup.fu_id',20);
         $this->db->where('tbl_ufollowup.fu_followdate<=',date('Y-m-d'));
        //$this->db->or_where('tbl_ufollowup.fu_followupst',4);
         $this->db->where('tbl_ubasic_details.bd_bit',1);
         $this->db->order_by('tbl_ufollowup.fu_followdate','desc');
         
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }
        $this->db->where('tbl_inquiry.inq_isdelete','0');
        $query = $this->db->get();       
        $value['followup_list'] = $query->result_array();
        /***********************************************************/
        /******************List Of Task Assigned By Admin***************************/
        /***********************************************************/
        $this->db->select('to.au_fname as to,tbl_task_assign.*');
        $this->db->from('tbl_task_assign');
         $this->db->join('tbl_admin_users as to', 'to.au_id = tbl_task_assign.task_fassign','left');
         if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_task_assign.task_fassign', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_task_assign.task_fassign', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }

        $this->db->where('tbl_task_assign.status','2');
        $this->db->where('tbl_task_assign.task_is_deleted !=','2');
        $this->db->order_by('tbl_task_assign.task_date','desc');
        $this->db->where('tbl_task_assign.task_is_deleted','0');
        $query = $this->db->get();       
        $value['bytask_list'] = $query->result_array();
        /***********************************************************/
        /******************List Of Task Assigned To Admin***************************/
        /***********************************************************/
        $this->db->select('to.au_fname as to,tbl_task_assign.*');
        $this->db->from('tbl_task_assign');
         $this->db->join('tbl_admin_users as to', 'to.au_id = tbl_task_assign.task_sassign','left');
        if(empty($this->input->get('executive')))
        {
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_task_assign.task_sassign', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(!empty($this->input->get('executive')))
        {
            $this->db->where('tbl_task_assign.task_sassign', $this->encrypt_decrypt('decrypt',$this->input->get('executive')));
        }

        $this->db->where('tbl_task_assign.status','2');
        $this->db->where('tbl_task_assign.task_is_deleted !=','2');
        $this->db->order_by('tbl_task_assign.task_date','desc');
        $this->db->where('tbl_task_assign.task_is_deleted','0');
        $query = $this->db->get();       
        $value['totask_list'] = $query->result_array();
		//echo "<pre>"; print_r($value['followup_list']); die;
        /***********************************************************/
        /******************List Of Task Assigned By Super Admin***************************/
        /***********************************************************/
        $this->db->select('to.au_fname as to,to.au_adt_id as type_id,tbl_task_assign.*');
        $this->db->from('tbl_task_assign');
         $this->db->join('tbl_admin_users as to', 'to.au_id = tbl_task_assign.task_sassign','left');
        //  if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        // {
            
        // }
        $this->db->where('tbl_task_assign.task_sassign', 21);
        //$this->db->where('to.au_adt_id',3);
        $this->db->where('tbl_task_assign.status','2');
        $this->db->order_by('tbl_task_assign.task_date','desc');
        $this->db->where('tbl_task_assign.task_is_deleted','0');
        $query = $this->db->get();       
        //echo "<pre>"; print_r($query->result_array()); die;
        $value['sadmin_task_list'] = $query->result_array();
        return $value;
    }


    public function get_executives_data()
    {   
        $value = array();
        $this->db->select('*');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_is_delete','0');
        $query = $this->db->get();
        $value['lists'] = $query->result_array();

        $this->db->select('COUNT(au_id) as total');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_is_delete','0');
        $query = $this->db->get();

        $value['total_data'] = $query->row_array();
        return $value;
    }
	
}
?>