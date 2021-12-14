<?php 

class Sales_enq_model extends CI_Model {
	
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
	public function add($data)
	{   
		//echo '<pre>';print_r($data);die;
		if($data['vendor_id'] == null)
		{
			$sql = "SELECT * from tbl_master_party WHERE UPPER(master_party_name) LIKE '%".$this->db->escape_like_str(strtoupper($data['vendor']))."%'";
			$query = $this->db->query($sql);
			if($query->num_rows() == 0)
			{

				$item = array(
					'master_party_com_name' => $data['vendor'],
					'master_party_contact' => $data['sq_con_person'],
					'master_party_office_address' => $data['sq_address'],
					'master_party_billing_address' => $data['sq_address'],
					'master_party_email_address' => $data['sq_email'],
					'master_party_mobile_no' => $data['sq_phone'],
					'master_party_office_no ' => $data['sq_mobile'],
					'master_party_website' => $data['sq_website'],
					'master_party_cust_type' => $data['sq_cust_type'],
					'master_party_cdate' => $data['sq_cdate'],
					'master_party_udate' => $data['sq_udate']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->insert('tbl_master_party',$item); 
				$lid = $this->db->insert_id();

				$item = array(
						'contact_master_id' => $lid,
						'contact_pname' => isset($data['sq_con_person']) ? $data['sq_con_person'] : '',
						'contact_mobile'=> isset($data['sq_mobile']) ? $data['sq_mobile'] : '',
						'contact_phone'=> isset($data['sq_phone']) ? $data['sq_phone'] : '',
						'contact_email'=> isset($data['sq_email']) ? $data['sq_email'] : '',
						'contact_address' => isset($data['sq_address']) ? $data['sq_address'] : '',
						'contact_location' => isset($data['sq_address']) ? $data['sq_address'] : '',
						'contact_cdate' => date('Y-m-d H:i:s'),
						'contact_udate' => date('Y-m-d H:i:s')
				);
				//echo '<pre>';print_r($item);die;
			$this->db->insert('tbl_master_contactperson',$item);

			}
		}
		if(isset($data['sq_brand']) && $data['sq_brand'] != ''){
			$aus_home = json_encode($data['sq_brand']);
		}
		else{
			$aus_home = '';
		}
		if($this->uri->segment(3))
		{

			$id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
   			$item = array(
			//'sq_no' => $data['sq_no'],
			'sq_enq_date' => date("Y-m-d", strtotime($data['sq_enq_date'])),
			'vendor' => $data['vendor'],
			'vendor_id' => $data['vendor_id'],
			'sq_refno' => $data['sq_refno'],
			'sq_ref_date' => date("Y-m-d", strtotime($data['sq_ref_date'])),
			'sq_address' => $data['sq_address'],
			'sq_country' => isset($data['sq_country']) ? $data['sq_country'] : 0,
			'sq_state' => isset($data['sq_state']) ? $data['sq_state'] : 0,
			'sq_city' => isset($data['sq_city']) ? $data['sq_city'] : 0,
			'sq_brand' => $aus_home,
			'sq_con_person' => $data['sq_con_person'],
			'sq_email' => $data['sq_email'],
			'sq_phone' => $data['sq_phone'],
			'sq_mobile' => $data['sq_mobile'],
			'sq_website' => $data['sq_website'],
			'sq_gstno' => $data['sq_gstno'],
			'sq_cust_type' => isset($data['sq_cust_type']) ? $data['sq_cust_type'] : '',
			
			'sq_source_cat' => $data['sq_source_cat'],
			'sq_subsource_cat' => isset($data['sq_subsource_cat']) ? $data['sq_subsource_cat'] : 0,
			'sq_mode_inq' => $data['sq_mode_inq'],
			'sq_inq_sts' => $data['sq_inq_sts'],
			'sq_inq_priority' => $data['sq_inq_priority'],
			'sq_end_st' => $data['sq_end_st'],
			'sq_admin_src' => $data['sq_admin_src'],
			'sq_allotedto' => $data['sq_allotedto'],
			'sq_prodetails' => $data['sq_prodetails'],
			'sq_ref_by' => $data['sq_ref_by'],
			'sq_cdate' => $data['sq_cdate'],
			'sq_udate' => $data['sq_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('sq_id', $id);
		$this->db->update('tbl_sales_enq',$item); 
		if(isset($data['sq_brand']))
		{
			foreach($data['sq_brand'] as $brand)
			{
				$bitm = array(
				'sqb_bid' => $brand,
				'sqb_udate' => $data['sq_udate']
				);
				//echo '<pre>';print_r($item);die;
				$this->db->where('sqb_sqid', $id);
				$this->db->update('tbl_sale_brand',$bitm); 
			}
		}
		//echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry',
					'adlog_edit' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		
		$lid = $id;
		}else{
			$maininq_no = $this->sq_no_get();
			$item = array(
			'sq_no' => $maininq_no,
			'sq_enq_date' => date("Y-m-d", strtotime($data['sq_enq_date'])),
			'vendor' => $data['vendor'],
			'vendor_id' => $data['vendor_id'],
			'sq_refno' => $data['sq_refno'],
			'sq_ref_date' => $data['sq_ref_date'],
			//'sq_remarks' => $data['sq_remarks'],
			'sq_address' => $data['sq_address'],
			'sq_country' => isset($data['sq_country']) ? $data['sq_country'] : 0,
			'sq_state' => isset($data['sq_state']) ? $data['sq_state'] : 0,
			'sq_city' => isset($data['sq_city']) ? $data['sq_city'] : 0,
			'sq_brand' => $aus_home,
			'sq_con_person' => $data['sq_con_person'],
			'sq_email' => $data['sq_email'],
			'sq_phone' => $data['sq_phone'],
			'sq_mobile' => $data['sq_mobile'],
			'sq_website' => $data['sq_website'],
			'sq_gstno' => $data['sq_gstno'],
			'sq_cust_type' => isset($data['sq_cust_type']) ? $data['sq_cust_type'] : 0,
			
			'sq_source_cat' => $data['sq_source_cat'],
			'sq_subsource_cat' => isset($data['sq_subsource_cat']) ? $data['sq_subsource_cat'] : 0,
			'sq_mode_inq' => $data['sq_mode_inq'],
			'sq_inq_sts' => $data['sq_inq_sts'],
			'sq_inq_priority' => $data['sq_inq_priority'],
			'sq_end_st' => $data['sq_end_st'],
			//'sq_party_tax' => $data['sq_party_tax'],
			//'sq_department' => $data['sq_department'],
			'sq_admin_src' => $data['sq_admin_src'],
			'sq_allotedto' => $data['sq_allotedto'],
			'sq_prodetails' => $data['sq_prodetails'],
			'sq_ref_by' => $data['sq_ref_by'],
			'sq_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'sq_cdate' => $data['sq_cdate'],
			'sq_udate' => $data['sq_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_sales_enq',$item);
		$lid = $this->db->insert_id();
		//echo '<pre>'; print_r($data['medetail_item']); die;
		if(isset($data['sq_brand']))
		{
			foreach($data['sq_brand'] as $brand)
			{
				$bitm = array(
				'sqb_sqid' => $lid,
				'sqb_bid' => $brand,
				'sqb_udate' => $data['sq_udate']
				);
				//echo '<pre>';print_r($item);die;
				$this->db->insert('tbl_sale_brand',$bitm);
			}
		}
		//echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		}
		return $lid;
	}

	public function other_add($data)
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item = array(
			
			'sales_enq_sub' => $data['sales_enq_sub'],
			'sales_enq_desc' => $data['sales_enq_desc'],
			'sales_enq_tc_price' => $data['sales_enq_tc_price'],
			'sales_enq_tc_wrnty' => $data['sales_enq_tc_wrnty'],
			'sales_enq_tc_pf' => $data['sales_enq_tc_pf'],
			'sales_enq_tc_deli' => $data['sales_enq_tc_deli'],
			'sales_enq_tc_paynt' => $data['sales_enq_tc_paynt'],
			'sales_enq_tc_ovali' => $data['sales_enq_tc_ovali'],
			'sales_enq_tc_frght' => $data['sales_enq_tc_frght'],
			'sales_enq_tc_gst' => $data['sales_enq_tc_gst'],
			//'sq_grd_ttl_words' => $data['grdttlinword'],
			'sq_remarks' => $data['sq_remarks'],
			//'sq_cid' => $this->session->userdata['login']['aus_Id'],
			'sq_cdate' => $data['sq_cdate'],
			'sq_udate' => $data['sq_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('sq_id',$lid);
		$this->db->update('tbl_sales_enq',$item);

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry',
					'adlog_edit' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
		//echo '<pre>'; print_r($data['medetail_item']); die;
	}

	public function item_add($data)
	{
		if(isset($data['master_item_img']) && isset($data['master_item_img']) != '')
		{
			$insert = array(
					'master_item_img' => isset($data['master_item_img']) ? $data['master_item_img'] : '',
					'master_item_updated_date' => date('Y-m-d H:i:s')
					
				);
			$this->db->where('master_item_id',$data['sqi_itm_pno_id']);
			$this->db->update('tbl_master_item',$insert);
		}
		//echo "<pre>"; print_r($data); die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item1 = array(
					'sqi_sales_enq_id' => $lid,
					'sqi_itm_pnoname' => $data['sqi_itm_pno'],
					'sqi_itm_pno' => $data['sqi_itm_pno_id'],
					'sqi_itm_title' => $data['sqi_itm_title'],
					'sqi_itm_hsncode'=> isset($data['sqi_itm_hsncode']) ? $data['sqi_itm_hsncode'] : '',
					'sqi_itm_desc'=> $data['sqi_itm_desc'],
					'sqi_itm_qty'=> $data['sqi_itm_qty'],
					'sqi_itm_stock'=> $data['sqi_itm_stock'],
					'sqi_itm_opn_qty'=> $data['sqi_itm_opn_qty'],
					'sqi_itm_price'=> $data['sqi_itm_price'],
					'sqi_itm_discount'=> $data['sqi_itm_discount'],
					'sqi_itm_ftotal'=> $data['sqi_itm_ftotal'],
					'sqi_item_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1); die;
				$this->db->insert('tbl_sales_enq_item',$item1);

				$this->db->select('SUM(sqi_itm_ftotal) as count');
        		$this->db->from('tbl_sales_enq_item');
        		$this->db->where('sqi_item_isdelete','0');
        		$this->db->where('sqi_sales_enq_id',$lid);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'sq_grd_ttl' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('sq_id',$lid);
				$this->db->update('tbl_sales_enq',$item);

				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
		//echo '<pre>'; print_r($data['medetail_item']); die;
	}

	public function item_edit($data,$sqiitemid)
	{
		if(isset($data['master_item_img']) && isset($data['master_item_img']) != '')
		{
			$insert = array(
					'master_item_img' => isset($data['master_item_img']) ? $data['master_item_img'] : '',
					'master_item_updated_date' => date('Y-m-d H:i:s')
					
				);
			$this->db->where('master_item_id',$data['sqi_itm_pno_id']);
			$this->db->update('tbl_master_item',$insert);
		}
		//echo "<pre>"; print_r($data); die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item1 = array(
					'sqi_sales_enq_id' => $lid,
					'sqi_itm_pnoname' => $data['sqi_itm_pno'],
					'sqi_itm_pno' => $data['sqi_itm_pno_id'],
					'sqi_itm_title' => $data['sqi_itm_title'],
					'sqi_itm_hsncode'=> isset($data['sqi_itm_hsncode']) ? $data['sqi_itm_hsncode'] : '',
					'sqi_itm_desc'=> $data['sqi_itm_desc'],
					'sqi_itm_qty'=> $data['sqi_itm_qty'],
					'sqi_itm_stock'=> $data['sqi_itm_stock'],
					'sqi_itm_opn_qty'=> $data['sqi_itm_opn_qty'],
					'sqi_itm_price'=> $data['sqi_itm_price'],
					'sqi_itm_discount'=> $data['sqi_itm_discount'],
					'sqi_itm_ftotal'=> $data['sqi_itm_ftotal'],
					'sqi_item_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1); die;
				$this->db->where('sqi_id',$sqiitemid);
				$this->db->update('tbl_sales_enq_item',$item1);

				$this->db->select('SUM(sqi_itm_ftotal) as count');
        		$this->db->from('tbl_sales_enq_item');
        		$this->db->where('sqi_item_isdelete',0);
        		$this->db->where('sqi_sales_enq_id',$lid);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'sq_grd_ttl' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('sq_id',$lid);
				$this->db->update('tbl_sales_enq',$item);

				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $sqiitemid;
		//echo '<pre>'; print_r($data['medetail_item']); die;
	}

	public function folup_add($data)
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$fu = array(
				'fu_inq_id' => $lid,
				//'urefu_uf_id' =>
				'fu_followdate' => date("Y-m-d", strtotime($data['fu_followdate'])),
				'fu_followmethod' => $data['fu_followmethod'],
				'fu_followexe' => $data['fu_followexe'],
				'fu_followupst' => $data['fu_followupst'],
				'fu_remark' => $data['fu_remark'],
				'fu_udate' => date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_sales_inq_followup',$fu);
				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry Followup',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
		//echo '<pre>'; print_r($data['medetail_item']); die;
	}

	public function item_img($data)
	{
		//echo "<pre>"; print_r($data); die;
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		$this->db->where('master_item_id',$data['sqi_itm_pno_id']);
		$this->db->where('master_item_img','');
		$query = $this->db->get();
		return $query->result_array();
	}
		
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('sq_id',$id);
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_edit_items()
	{
		$id = $this->encrypt_decrypt('encrypt',$this->uri->segment(3));
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('sqi_sales_enq_id ',$id);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_folups($id)
	{
		//$id = $this->encrypt_decrypt('encrypt',$this->uri->segment(3));
		$this->db->select('*');
		$this->db->from('tbl_sales_inq_followup');
		$this->db->join('tbl_admin_users','tbl_sales_inq_followup.fu_followexe = tbl_admin_users.au_id','left');
		$this->db->join('tbl_followup_status','tbl_sales_inq_followup.fu_followupst = tbl_followup_status.inqfus_id','left');
		$this->db->join('tbl_followup_method','tbl_sales_inq_followup.fu_followmethod = tbl_followup_method.fu_method_id','left');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('fu_inq_id ',$id);
		$this->db->where('fu_isdelete ',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	
	public function get_sales_inq_report_count()
	{
		$this->db->select('*');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		//********************************************************************************************
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->where('sq_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('order_customer_name') && ($this->input->post('order_customer_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('order_customer_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('aus_FirstName', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('mode_of_inq') && ($this->input->post('mode_of_inq') != ''))
        {
           $this->db->like('mode_inquiry_name', $this->input->post('mode_of_inq'));   
        }
        //  if($this->input->post('status') && ($this->input->post('status') != ''))
        // {
        //    $this->db->like('sq_email', $this->input->post('status'));   
        // }
         if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('sq_inq_priority', $this->input->post('priority'));   
        }
        if($this->input->post('remark') && ($this->input->post('remark') != ''))
        {
           $this->db->like('sq_remarks', $this->input->post('remark'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->where('sq_mobile', $this->input->post('mobile_no'));   
        }
        if($this->input->post('country') && ($this->input->post('country') != ''))
        {
           $this->db->like('country_name', $this->input->post('country'));   
        }
        if($this->input->post('state') && ($this->input->post('state') != ''))
        {
           $this->db->like('state_name', $this->input->post('state'));   
        }
         if($this->input->post('city') && ($this->input->post('city') != ''))
        {
           $this->db->like('city_name', $this->input->post('city'));   
        }
        if($this->input->post('inquiry_date') && ($this->input->post('inquiry_date') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_date')));
           $this->db->like('sq_enq_date', $stdate);   
        }
         if($this->input->post('reffered_by') && ($this->input->post('reffered_by') != ''))
        {
           $this->db->like('sq_ref_by', $this->input->post('reffered_by'));   
        }
         if($this->input->post('inquiry_cdate') && ($this->input->post('inquiry_cdate') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_cdate')));
           $this->db->like('sq_cdate', $stdate);   
        }
        if($this->input->post('product_name') && ($this->input->post('product_name') != ''))
        {
           $this->db->like('sqi_itm_pnoname', $this->input->post('product_name'));   
        }
        if($this->input->post('product_qty') && ($this->input->post('product_qty') != ''))
        {
           $this->db->where('sqi_itm_qty', $this->input->post('product_qty'));   
        }
        if($this->input->post('product_price') && ($this->input->post('product_price') != ''))
        {
           $this->db->where('sqi_itm_price', $this->input->post('product_price'));   
        }
        if($this->input->post('sq_allotedto') && ($this->input->post('sq_allotedto') != ''))
        {
           $this->db->where('au_fname', $this->input->post('sq_allotedto'));   
        }
        if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('sq_inq_sts', $this->input->post('status'));   
        }

        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('(tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users'],FALSE);
				$this->db->or_where('tbl_sales_enq.sq_allotedto',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).")",false);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('(tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
				$this->db->or_where('tbl_sales_enq.sq_allotedto',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).")",false);
			}
		}

        $posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_grd_ttl','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_grd_ttl','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 5))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('city_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('city_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 4))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('state_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('state_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 3))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_mobile','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_mobile','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.vendor','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.vendor','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_enq_date','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_enq_date','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 0))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_no','DESC');
        	}
        }else{
        	$this->db->order_by('tbl_sales_enq.sq_id','DESC');
        }

		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query->num_rows();
	}

	public function sales_inq_report($Start,$end)
	{
		$this->db->select('*');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		//********************************************************************************************
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('sq_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('order_customer_name') && ($this->input->post('order_customer_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('order_customer_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('aus_FirstName', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('mode_of_inq') && ($this->input->post('mode_of_inq') != ''))
        {
           $this->db->like('mode_inquiry_name', $this->input->post('mode_of_inq'));   
        }
        //  if($this->input->post('status') && ($this->input->post('status') != ''))
        // {
        //    $this->db->like('sq_email', $this->input->post('status'));   
        // }
         if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('sq_inq_priority', $this->input->post('priority'));   
        }
        if($this->input->post('remark') && ($this->input->post('remark') != ''))
        {
           $this->db->like('sq_remarks', $this->input->post('remark'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('sq_mobile', $this->input->post('mobile_no'));   
        }
        if($this->input->post('country') && ($this->input->post('country') != ''))
        {
           $this->db->like('country_name', $this->input->post('country'));   
        }
        if($this->input->post('state') && ($this->input->post('state') != ''))
        {
           $this->db->like('state_name', $this->input->post('state'));   
        }
         if($this->input->post('city') && ($this->input->post('city') != ''))
        {
           $this->db->like('city_name', $this->input->post('city'));   
        }
        if($this->input->post('inquiry_date') && ($this->input->post('inquiry_date') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_date')));
           $this->db->like('sq_enq_date', $stdate);   
        }
         if($this->input->post('reffered_by') && ($this->input->post('reffered_by') != ''))
        {
           $this->db->like('sq_ref_by', $this->input->post('reffered_by'));   
        }
         if($this->input->post('inquiry_cdate') && ($this->input->post('inquiry_cdate') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_cdate')));
           $this->db->like('sq_cdate', $stdate);   
        }
        if($this->input->post('product_name') && ($this->input->post('product_name') != ''))
        {
           $this->db->like('sqi_itm_pnoname', $this->input->post('product_name'));   
        }
        if($this->input->post('product_qty') && ($this->input->post('product_qty') != ''))
        {
           $this->db->where('sqi_itm_qty', $this->input->post('product_qty'));   
        }
        if($this->input->post('product_price') && ($this->input->post('product_price') != ''))
        {
           $this->db->where('sqi_itm_price', $this->input->post('product_price'));   
        }
        if($this->input->post('sq_allotedto') && ($this->input->post('sq_allotedto') != ''))
        {
           $this->db->where('au_fname', $this->input->post('sq_allotedto'));   
        }
        if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('sq_inq_sts', $this->input->post('status'));   
        }

        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('(tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users'],FALSE);
				$this->db->or_where('tbl_sales_enq.sq_allotedto',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).")",false);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('(tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
				$this->db->or_where('tbl_sales_enq.sq_allotedto',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).")",false);
			}
		}

        $posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_grd_ttl','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_grd_ttl','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 5))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('city_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('city_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 4))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('state_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('state_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 3))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_mobile','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_mobile','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.vendor','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.vendor','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_enq_date','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_enq_date','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 0))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sales_enq.sq_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sales_enq.sq_no','DESC');
        	}
        }else{
        	$this->db->order_by('tbl_sales_enq.sq_id','DESC');
        }
        $this->db->limit($end,$Start);
		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query->result_array();
	}

	public function get_all_tax_gst()
	{
		$this->db->select('SUM(tbl_sales_enq_itax.sqit_tax_amount) as total,UPPER(tbl_sales_enq_itax.sqit_tax_name) as tax_name, tbl_sales_enq_itax.*');
		//SUM(IF(itmtax_tax_name = 'CGST', itmtax_tax_amount, 0)) AS 'CGST',
		$this->db->from('tbl_sales_enq_itax');
		//$this->db->join('tbl_invoice_itmtax','tbl_invoice_item.invi_id = tbl_invoice_itmtax.itmtax_invi_id');
		//$this->db->join('tbl_invoice','tbl_invoice.inv_id = tbl_invoice_itmtax.itmtax_invid');
		$this->db->group_by('tax_name');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_sales_enqno_wise()
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		
		if($this->input->get('start_date') && ($this->input->get('start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('end_date') && ($this->input->get('end_date') != ''))
		{
			$end_date = date("Y-m-d", strtotime($this->input->get('end_date')));
			$this->db->where('sq_cdate <=',$end_date);
		}
		if($this->input->get('party') && ($this->input->get('party') != ''))
		{
			$party = $this->input->get('party');
			$this->db->where('vendor',$party);
		}
		$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_pdfdata($id)
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_mode_inquiry.mode_inquiry_id = tbl_sales_enq.sq_mode_inq','left');
		$this->db->join('tbl_source_cat','tbl_source_cat.source_cat_id = tbl_sales_enq.sq_source_cat','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_end_st','left');
		$this->db->join('tbl_master_city','tbl_master_city.city_id = tbl_sales_enq.sq_city','left');
		$this->db->join('tbl_master_state','tbl_master_state.state_id = tbl_sales_enq.sq_state','left');
		//$this->db->join('tbl_source_cat','tbl_source_cat.source_cat_id = tbl_sales_enq.sq_subsource_cat');
		$this->db->where('tbl_sales_enq.sq_id',$id);
		$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		$query = $this->db->get();
		$value['inv'] = $query->row_array();

		$this->db->select('*');
		$this->db->from('tbl_sales_inq_followup');
		$this->db->join('tbl_followup_method','tbl_followup_method.fu_method_id = tbl_sales_inq_followup.fu_followmethod','left');
		$this->db->join('tbl_followup_status','tbl_followup_status.inqfus_id = tbl_sales_inq_followup.fu_followupst','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_inq_followup.fu_followexe','left');
		$this->db->where('tbl_sales_inq_followup.fu_inq_id',$id);
		$this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
		//$this->db->order_by('tbl_sales_enq_item.invi_inv_id','DESC');
		$query = $this->db->get();
		$value['follow'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->join('tbl_master_item','tbl_sales_enq_item.sqi_itm_pno = tbl_master_item.master_item_id','left');
		$this->db->join('tbl_master_item_unit','tbl_master_item_unit.master_item_unit_id = tbl_master_item.master_item_unit','left');
		$this->db->where('tbl_sales_enq_item.sqi_sales_enq_id',$id);
		$this->db->where('tbl_sales_enq_item.sqi_is_bom !=',1);
		$this->db->where('tbl_sales_enq_item.sqi_item_isdelete',0);
		//$this->db->order_by('tbl_sales_enq_item.invi_inv_id','DESC');
		$query = $this->db->get();
		$value['items'] = $query->result_array();
		//***************************************
		
		foreach ($value['items'] as $ikey => $itm) {
			$this->db->select('*');
			$this->db->from('tbl_sales_enq_itax');
			//$this->db->where('sqit_tax_cid',$this->session->userdata['login']['aus_Id']);
			$this->db->where('sqit_pitemid',$itm['master_item_id']);
			$this->db->where('sqit_pid',$id);
			$query = $this->db->get();
			$value['items'][$ikey]['taxar'] = $query->result_array();
		}
		//echo '<pre>';print_r($value);die;
		return $value;
	}

	public function get_vendor_itmlist()
	{
		//echo "<pre>";print_r($this->input->get('itmid'));die;
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->where_in('sqi_id',$this->input->get('itmid'));
		$query = $this->db->get();
		 return $query->result_array();
	}

	public function get_items($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_sales_enq_item.sqi_itm_hsncode','left');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_sales_enq_item.sqi_itm_pno','left');
		$this->db->where('sqi_sales_enq_id',$id);
		$this->db->where('sqi_item_isdelete',0);
		$this->db->where('sqi_is_bom !=',1);
		$query = $this->db->get();
		$values['itm'] = $query->result_array();
		return $values;
	}
	public function get_admin()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_sqoute($id)
	{
        
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		$this->db->where('sq_id',$this->input->get('id'));
		$query = $this->db->get();
		$item['pdetails'] = $query->row_array();
		//echo'<pre>';print_r($item);die;

		$this->db->select('sa_id');
		$this->db->from('tbl_sale_quotation');
		$this->db->order_by('sa_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['sa_id'] = isset($autoid['sa_id']) ? $autoid['sa_id'] : '';
	    $code['pre_quotation'].''.($autoid['sa_id']+1);
		$item = array(
			'sa_no' =>$code['pre_quotation'].''.($autoid['sa_id']+1),
			'sa_enq_date' => date("Y-m-d", strtotime($item['pdetails']['sq_enq_date'])),
			'vendor' => $item['pdetails']['vendor'],
			'sa_address' => $item['pdetails']['sq_address'],
			'sa_remarks' => $item['pdetails']['sq_remarks'],
			'sa_email' => $item['pdetails']['sq_email'],
			'sa_phone' => $item['pdetails']['sq_phone'],
			'sa_mobile' => $item['pdetails']['sq_mobile'],
			'sa_brand' => $item['pdetails']['sq_brand'],
			//'sa_quotation_stu' => $item['pdetails']['remarks'],
			'sa_referred_by' => $item['pdetails']['sq_ref_by'],
			'sa_attach' => $item['pdetails']['sq_attach'],
			'sale_quotation_term' => $item['pdetails']['sales_enq_desc'],
			'sa_sub_ttl' => $item['pdetails']['sq_sub_ttl'],
			'sa_grd_ttl' => $item['pdetails']['sq_grd_ttl'],
			'sa_grd_ttl_words' => $item['pdetails']['sq_grd_ttl_words'],
			'sa_cid' => $this->session->userdata['login']['aus_Id'],
			'sa_cdate' => date('Y-m-d H:i:s'),
			'sa_udate' =>date('Y-m-d H:i:s')
			);//echo'<pre>';print_r($item);die;
		$this->db->insert('tbl_sale_quotation',$item);
		$lid = $this->db->insert_id();
		
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->where('sqi_sales_enq_id',$this->input->get('id'));
		$this->db->where('sqi_is_bom !=',1);
		$query = $this->db->get();
		$item['piitemdetails'] = $query->result_array();
           //echo'<pre>';print_r($item);die;
		foreach ($item['piitemdetails'] as $key => $grnitem) {
			if($grnitem['sqi_itm_name'] != '' && $grnitem['sqi_itm_currency'] != '')
			{
				$item = array(
					'sai_sale_quotation_id' =>$lid,
					'sai_itm_name' => $grnitem['sqi_itm_name'],
					'sai_itm_grade' =>$grnitem['sqi_itm_grade'],
					'sai_itm_desc' =>$grnitem['sqi_itm_desc'],
					'sai_itm_qty' => $grnitem['sqi_itm_qty'],
					'sai_itm_unit' => $grnitem['sqi_itm_unit'],
					'sai_itm_price' => $grnitem['sqi_itm_price'],
					'sai_itm_total' =>$grnitem['sqi_itm_total'],
					'sai_itm_currency' => $grnitem['sqi_itm_currency'],
					'sai_itm_days' => $grnitem['sqi_itm_days'],
					'sai_itm_roe' => $grnitem['sqi_itm_roe'],
					'sai_itm_tax' => $grnitem['sqi_itm_tax'],
					'sai_itm_cid' => $this->session->userdata['login']['aus_Id'],
					'sai_is_bom' => $grnitem['sqi_is_bom'],
					'sai_bomid' => $grnitem['sqi_bomid'],
					'sai_pbomid' => $grnitem['sqi_pbomid'],
					'sai_item_udate' =>date('Y-m-d H:i:s')
					);//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_sale_quotation_item',$item);

				$this->db->select('*');
				$this->db->from('tbl_sales_enq_itax');
				$this->db->where('sqit_pid',$this->input->get('id'));
				$this->db->where('sqit_pitemid',$grnitem['sqi_itm_name']);
				$query = $this->db->get();
				$item['pittaxdetails'] = $query->result_array();
                 //echo'<pre>';print_r($item);die;
				foreach ($item['pittaxdetails'] as $itkey => $grmittax) {
					$tax = array(
						'sait_pid' =>$lid,
						'sait_pitemid' => $grmittax['sqit_pitemid'],
						'sait_tax_name' => $grmittax['sqit_tax_name'],
						'sait_tax_per' => $grmittax['sqit_tax_per'],
						'sait_tax_informat' => $grmittax['sqit_tax_informat'],
						'sait_tax_amount' => $grmittax['sqit_tax_amount'],
						'sait_tax_cid' => $this->session->userdata['login']['aus_Id'],
						'sait_udate' =>date('Y-m-d H:i:s')
						);//echo'<pre>';print_r($tax);die;
					$this->db->insert('tbl_sale_quotation_itax',$tax);
				}

			}
		}
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_bom');
		$this->db->where('sqb_sq_id',$this->input->get('id'));
		$query = $this->db->get();
		$item['pbomdetails'] = $query->result_array();
		//echo'<pre>';print_r($item);die;
		if(isset($item['pbomdetails']) && !empty($item['pbomdetails']))
		{
			foreach ($item['pbomdetails'] as $bkey => $grnbomlist) {
				if($grnbomlist['sqb_bom_id'] != '')
				{
					$item = array(
						'sab_sale_quotation_id' =>$lid,
						'sab_bom_id' =>$grnbomlist['sqb_bom_id'],
						'sab_qty' => $grnbomlist['sqb_qty'],
						'sab_unit' => $grnbomlist['sqb_unit'],
						'sab_price' => $grnbomlist['sqb_price'],
						'sab_total' => $grnbomlist['sqb_total'],
						'sab_currency' => $grnbomlist['sqb_currency'],
						'sab_days' => $grnbomlist['sqb_days'],
						'sab_roe' => $grnbomlist['sqb_roe'],
						'sab_tax' => $grnbomlist['sqb_tax'],
						'sab_cid' => $this->session->userdata['login']['aus_Id'],
						'sab_cdate' => date('Y-m-d H:i:s'),
						'sab_udate' =>date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_sale_quotation_bom',$item);
					//echo'<pre>';print_r($item);die;
					$pbomid = $this->db->insert_id();
					//$data['fbomautoid'][$bkey]
					$this->db->select('*');
					$this->db->from('tbl_sales_enq_item');
					$this->db->where('sqi_sales_enq_id',$this->input->get('id'));
					$this->db->where('sqi_bomid',$grnbomlist['sqb_bom_id']);
					$this->db->where('sqi_is_bom',1);
					$query = $this->db->get();
					$item['pitmbomdetails'] = $query->result_array();
					//echo'<pre>';print_r($item);die;
					if(isset($item['pitmbomdetails']) && !empty($item['pitmbomdetails']))
					{
						foreach ($item['pitmbomdetails'] as $bikey => $grnitem) {
							if($grnitem['sqi_itm_name'] != '')
							{
								$item = array(
									'sai_sale_quotation_id' =>$lid,
									'sai_itm_name' => $grnitem['sqi_itm_name'],
									'sai_itm_grade' =>$grnitem['sqi_itm_grade'],
									'sai_itm_desc' =>$grnitem['sqi_itm_desc'],
									'sai_itm_qty' => $grnitem['sqi_itm_qty'],
									'sai_itm_unit' => $grnitem['sqi_itm_unit'],
									'sai_itm_price' => $grnitem['sqi_itm_price'],
									'sai_itm_total' =>$grnitem['sqi_itm_total'],
									'sai_itm_currency' => $grnitem['sqi_itm_currency'],
									'sai_itm_days' => $grnitem['sqi_itm_days'],
									'sai_itm_roe' => $grnitem['sqi_itm_roe'],
									'sai_itm_tax' => $grnitem['sqi_itm_tax'],
									'sai_itm_cid' => $this->session->userdata['login']['aus_Id'],
									'sai_is_bom' => 1,
									'sai_bomid' => $grnbomlist['sqb_bom_id'],
									'sai_pbomid' => $pbomid,
									'sai_item_udate' =>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_sale_quotation_item',$item);
								//echo'<pre>';print_r($item);die;
								//echo $fbom;die;								
							}
						}
					}
					$this->db->select('*');
					$this->db->from('tbl_sales_enq_btax');
					$this->db->where('sqbt_pid',$this->input->get('id'));
					$this->db->where('sqbt_pbomid',$grnbomlist['sqb_bom_id']);
					$query = $this->db->get();
					$item['pbomtdetails'] = $query->result_array();
					//echo'<pre>';print_r($item);die;
					if(isset($item['pbomtdetails']) && is_array($item['pbomtdetails']) && !empty($item['pbomtdetails']))
					{
						foreach ($item['pbomtdetails'] as $itkey => $grnbttax) {
							$tax = array(
								'sabt_pid' =>$lid,
								'sabt_pbomid' => $pbomid,
								'sabt_tax_name' =>$grnbttax['sqbt_tax_name'],
								'sabt_tax_per' => $grnbttax['sqbt_tax_per'],
								'sabt_tax_informat' => $grnbttax['sqbt_tax_informat'],
								'sabt_tax_amount' =>$grnbttax['sqbt_tax_amount'],
								'sabt_tax_cid' => $this->session->userdata['login']['aus_Id'],
								'sabt_udate' =>date('Y-m-d H:i:s')
								);//echo'<pre>';print_r($tax);die;
							$this->db->insert('tbl_sale_quotation_btax',$tax);
							//echo'<pre>';print_r($tax);die;
						}	
					}
				}
			}
		}

		return $lid;
	}
	public function get_excel_certificate()
	{
		//echo $this->input->get('sq_attendto');die;
		$this->db->select('tbl_sales_enq.sq_id,DATE_FORMAT(tbl_sales_enq.sq_enq_date, "%d-%m-%Y"),tbl_sales_enq.vendor,tbl_sales_enq.sq_con_person,tbl_sales_enq.sq_mobile,tbl_sales_enq.sq_email,tbl_master_city.city_name,tbl_master_item.master_item_part_no,tbl_sales_enq_item.sqi_itm_qty,tbl_sales_enq_item.sqi_itm_price,tbl_sales_enq_item.sqi_itm_total,tbl_sales_enq.sq_end_st,source.source_cat_name as sourcename,tbl_sales_enq.sq_remarks');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_sales_enq_item','tbl_sales_enq_item.sqi_sales_enq_id = tbl_sales_enq.sq_id','left');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_sales_enq_item.sqi_itm_pno','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		//$this->db->join('tbl_sale_quotation_brand','tbl_sales_enq.sa_id = tbl_sale_quotation_brand.sab_sq_id','left');
		$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
		$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
		{
			$this->db->Like('state_name',$this->input->get('sq_state'));
		}
		if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
		{
			$this->db->Like('city_name',$this->input->get('sq_city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			//echo $this->input->get('sq_attendto');die;
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}else{
			//echo $this->input->get('sq_attendto');die;
		}
		//********************************************************************************************
        $this->db->order_by('tbl_sales_enq.sq_id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		//echo "ddddddddd<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_inqmaildata()
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->where('tbl_sales_enq.sq_isdeleted',0);
		//$this->db->where('tbl_sales_enq.sq_inq_sts',1);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
		$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->Like('UPPER(vendor)', strtoupper($str_vendor),'both',false);
		}

		//********************************************************************************************
        $this->db->order_by('tbl_sales_enq.sq_id','ASC');
		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query->result_array();
	}
	public function get_mailer_detail($id)
	{
		//echo "<pre>"; print_r($data); die;
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_tomailer_detail()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_id',$this->input->get()['sq_attendto']);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function sq_no_get()
	{
		$this->db->select('sq_id');
		$this->db->from('tbl_sales_enq');
		$this->db->order_by('sq_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();

		if(date("m") < 4)
		{
			$last_year = date('y', strtotime('-1 year'));
			$this_year = date('y');
			$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
		}else{
			$next_year = date('y', strtotime('+1 year'));
			$this_year = date('y');
			$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
		}

		$autoid['sq_id'] = isset($autoid['sq_id']) ? $autoid['sq_id'] : '';
		return 'INQ-'.$year_string.'-'.($autoid['sq_id']+1);
	}
    public function delete($id)
    {
		$this->db->set('sq_isdeleted',1);
		$this->db->where('sq_id', $id);
		$this->db->update('tbl_sales_enq');
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}

	public function status_act($id)
    {
		$this->db->set('fu_followupst',5);
		$this->db->where('fu_id', $id);
		$this->db->update('tbl_sales_inq_followup'); 
		return $id;
	}

	public function status_deact($id)
    {
		$this->db->set('fu_followupst',6);
		$this->db->where('fu_id', $id);
		$this->db->update('tbl_sales_inq_followup'); 
		return $id;
	}

	public function get_sourcesub_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat !=', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
	}
	
	public function get_subsource($data)
	{
		$sql5 = "SELECT source_cat_id,source_cat_name,source_main_cat from tbl_source_cat where source_main_cat = ".$this->db->escape($data['source_cat_id'])."";
		$query = $this->db->query($sql5);
		return $query->result_array();
	}

	public function get_customer_information($q)
	{
		$sql = "SELECT * from tbl_master_party WHERE UPPER(master_party_com_name) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%' AND master_party_isdelete = 0";
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['master_party_com_name']));
				$new_row['value']=htmlentities(stripslashes($row['master_party_com_name']));
				$new_row['vendor_id']=htmlentities(stripslashes($row['master_party_id']));
				$new_row['address']=htmlentities(stripslashes($row['master_party_billing_address']));
				$new_row['country']=htmlentities(stripslashes($row['master_party_country']));
				$new_row['state_lists']=$this->get_state($new_row['country']);
				$new_row['state']=htmlentities(stripslashes($row['master_party_state']));
				//get_city
				$new_row['city_lists']=$this->get_city($new_row['state']);
				$new_row['city']=htmlentities(stripslashes($row['master_party_city']));
				$new_row['cperson']=htmlentities(stripslashes($row['master_party_name']));
				$new_row['ctype']=htmlentities(stripslashes($row['master_party_cust_type']));
				$new_row['cno']=htmlentities(stripslashes($row['master_party_contact_no']));
				$new_row['phone']=htmlentities(stripslashes($row['master_party_office_no']));
				$new_row['email']=htmlentities(stripslashes($row['master_party_email_address']));
				$new_row['webaddr']=htmlentities(stripslashes($row['master_party_website']));
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		}
		else
		{
			$row_set = array();
			echo json_encode($row_set);
		}
	}

	public function get_contactperson_information($q,$t)
	{
		//$sql = "SELECT * from tbl_master_contactperson WHERE UPPER(contact_master_id) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%'";
		$sql = "SELECT * from tbl_master_contactperson WHERE contact_master_id = ".$q." AND UPPER(contact_pname) LIKE '%".$this->db->escape_like_str(strtoupper($t))."%' AND contact_isdelete = 0";
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['contact_pname']));
				$new_row['value']=htmlentities(stripslashes($row['contact_pname']));
				$new_row['contact_id']=htmlentities(stripslashes($row['contact_id']));
				$new_row['contact_address']=htmlentities(stripslashes($row['contact_address']));
				$new_row['contact_location']=htmlentities(stripslashes($row['contact_location']));
				$new_row['contact_phone']=htmlentities(stripslashes($row['contact_phone']));
				$new_row['contact_email']=htmlentities(stripslashes($row['contact_email']));
				$new_row['contact_mobile']=htmlentities(stripslashes($row['contact_mobile']));
				$new_row['contact_designation']=htmlentities(stripslashes($row['contact_designation']));
				if($this->input->get() && $this->input->get('autohid') && ($this->input->get('autohid') != '')){
					$new_row['autohid']=$this->input->get('autohid');
					$new_row['autohid'] = str_replace('task_contactperson','', $new_row['autohid']);
				}
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		}
		else
		{
			$row_set = array();
			echo json_encode($row_set);
		}
	}

	public function get_hcs($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->where('master_party_name',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_salesbrand()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_masterparty()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_modeinquiry()
	{
		$this->db->select('*');
		$this->db->from('tbl_mode_inquiry');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_sourcecat()
	{
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->where('source_main_cat','0');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_country()
    {
        $this->db->select('*');
        $this->db->from('tbl_country');
       // $this->db->where('country_id',$id);
        $this->db->where('country_isdelete','0');
        $this->db->order_by('country_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }

    public function get_state($country_id = false)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_isdelete','0');
        if(isset($country_id) && $country_id != false)
        {
        	$this->db->where('state_country',$country_id);
        }else{
        	$this->db->where('state_id',0);
        }
        $this->db->order_by('state_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_city($state_id = false)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_city');
        $this->db->where('city_isdelete','0');
        if(isset($state_id) && $state_id != false)
        {
        	$this->db->where('city_state',$state_id);
        }else{
        	$this->db->where('city_id',0);
        }
        $this->db->order_by('city_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }

    public function get_item_description($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		$this->db->where('master_item_id',$id);
		$query = $this->db->get();
		return $query->row_array();
    }

	/*msd code End*/
	public function get_followup()
	{
		$this->db->select('tbl_sales_enq.sq_id as id,tbl_sales_enq.sq_enq_date as inq_dt,tbl_sales_inq_followup.fu_followdate as followdate,tbl_sales_inq_followup.fu_id as fuid,tbl_sales_enq.sq_no as no,tbl_sales_enq.sq_con_person as name,tbl_sales_enq.sq_mobile as mno,tbl_sales_enq.sq_inq_sts as stname,tbl_admin_users.au_fname as executive,tbl_sales_inq_followup.fu_followupst as folst');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_sales_inq_followup', 'tbl_sales_inq_followup.fu_inq_id = tbl_sales_enq.sq_id','left');
		$this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sales_inq_followup.fu_followexe','left');
		//$this->db->where('tbl_sales_inq_followup.fu_followupst',5);
		//$this->db->where('tbl_ubasic_details.bd_bit',1);
		$this->db->order_by('tbl_sales_inq_followup.fu_followdate','desc');
		$this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
		$this->db->where('tbl_sales_enq.sq_isdeleted',0);
		if($this->input->get('status') == 'active')
		{
			$this->db->where('tbl_sales_inq_followup.fu_followupst',5);
		}
		if($this->input->get('status') == 'deactive')
		{
			$this->db->where('tbl_sales_inq_followup.fu_followupst',6);
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		if($this->input->post('date') && $this->input->post('date') != ''){
			$this->db->like('tbl_sales_inq_followup.fu_followdate', date("Y-m-d", strtotime($this->input->post('date'))));
		}
		if($this->input->post('name') && $this->input->post('name') != ''){
			$this->db->like('tbl_sales_enq.sq_con_person', $this->input->post('name'));
		}
		if($this->input->post('cno') && $this->input->post('cno') != ''){
			$this->db->like('tbl_sales_enq.sq_mobile', $this->input->post('cno'));
		}
		if($this->input->post('cat') && $this->input->post('cat') != ''){
			$this->db->like('tbl_product_category.procat_name', $this->input->post('cat'));
		}
		if($this->input->post('status') && $this->input->post('status') != ''){
			$this->db->like('tbl_sales_enq.sq_inq_sts', $this->input->post('status'));
		}
		if($this->input->post('exec') && $this->input->post('exec') != ''){
			$this->db->like('tbl_admin_users.au_fname', $this->input->post('exec'));
		}
		if($this->input->post('remark') && $this->input->post('remark') != ''){
			$this->db->like('tbl_sales_inq_followup.fu_remark', $this->input->post('remark'));
		}
		//inq_au_id
		
		
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
	}

	public function count()
	{
		$value = array();
        $this->db->select('count(tbl_sales_inq_followup.fu_id) as cnt');
        $this->db->from('tbl_sales_enq');
        $this->db->join('tbl_sales_inq_followup','tbl_sales_inq_followup.fu_inq_id = tbl_sales_enq.sq_id','left');
        $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sales_inq_followup.fu_followexe','left');
		if($this->input->get('status') == 'active')
		{
			$this->db->where('tbl_sales_inq_followup.fu_followupst',5);
		}
		if($this->input->get('status') == 'deactive')
		{
			$this->db->where('tbl_sales_inq_followup.fu_followupst',6);
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_sales_enq.sq_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
        $this->db->where('tbl_sales_enq.sq_isdeleted',0);
        $query = $this->db->get();
        $value['task'] = $query->row_array();
        return $value;
	}
	
	public function get_listofollow()
	{
		/***********************************************************/
        /******************List Of Followup***************************/
        /***********************************************************/
        
        $this->db->select('tbl_sales_enq.sq_id as id,tbl_sales_enq.sq_enq_date as inq_dt,tbl_sales_inq_followup.fu_followdate as followdate,tbl_sales_inq_followup.fu_remark as fu_remark,tbl_sales_enq.sq_mobile as mno,tbl_sales_enq.sq_con_person as name,tbl_sales_enq.sq_mobile as no,tbl_sales_enq.sq_inq_sts as stname,tbl_admin_users.au_fname as executive,tbl_sales_inq_followup.fu_id as fuid,tbl_sales_inq_followup.fu_followupst as folst');
        $this->db->from('tbl_sales_enq');
         $this->db->join('tbl_sales_inq_followup', 'tbl_sales_inq_followup.fu_inq_id = tbl_sales_enq.sq_id','left');
         $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sales_inq_followup.fu_followexe','left');
         //$this->db->limit('tbl_ufollowup.fu_id',20);
         //$this->db->where('tbl_ufollowup.fu_followdate<=',date('Y-m-d'));
        //$this->db->or_where('tbl_sales_inq_followup.fu_followupst',5);
         //$this->db->where('tbl_ubasic_details.bd_bit',1);
         $this->db->order_by('tbl_sales_inq_followup.fu_followdate','desc');
         
        if($this->input->get('status') == 'active')
		{
			$this->db->where('tbl_sales_inq_followup.fu_followupst',5);
		}
		if($this->input->get('status') == 'deactive')
		{
			$this->db->where('tbl_sales_inq_followup.fu_followupst',6);
		}
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            $this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        
        $this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
        $this->db->where('tbl_sales_enq.sq_isdeleted',0);
        $query = $this->db->get();       
         return $query->result_array();
	}
	public function get_followup_method()
	{
		$this->db->select('*');
		$this->db->from('tbl_followup_method');
		$this->db->where('fu_method_is_delete','0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_followup_status()
	{
		$this->db->select('*');
		$this->db->from('tbl_followup_status');
		$this->db->where('inqfus_is_delete','0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete_sales_item($id,$sa_id)
    {
    	//echo "<pre>"; print_r($sa_id); die;
		$this->db->set('sqi_item_isdelete',1);
		$this->db->where('sqi_id', $id);
		$this->db->update('tbl_sales_enq_item');

		$this->db->select('SUM(sqi_itm_ftotal) as count');
        		$this->db->from('tbl_sales_enq_item');
        		$this->db->where('sqi_item_isdelete',0);
        		$this->db->where('sqi_sales_enq_id',$sa_id);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'sq_grd_ttl' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('sq_id',$sa_id);
				$this->db->update('tbl_sales_enq',$item);

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id; 
	}

	public function delete_fup($id)
    {
		$this->db->set('fu_isdelete',1);
		$this->db->where('fu_id', $id);
		$this->db->update('tbl_sales_inq_followup'); 
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Inquiry',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}

	function get_item_details($q)
	{
		
		$sql = "SELECT * from tbl_master_item LEFT JOIN tbl_hsn_code ON 'tbl_master_item.master_item_hsncode = tbl_hsn_code.hsn_id' WHERE UPPER(master_item_part_no) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%' OR UPPER(master_item_name) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%'";
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['master_item_name']))." - ".htmlentities(stripslashes($row['master_item_part_no']));
				$new_row['value']=htmlentities(stripslashes($row['master_item_part_no']));
				$new_row['autoid']=htmlentities(stripslashes($row['master_item_id']));
				$new_row['title']=htmlentities(stripslashes($row['master_item_name']));
				$new_row['hsncode']=htmlentities(stripslashes($row['master_item_hsncode']));
								$this->db->select('IFNULL(tcreditpoints,0) as totalstock,IFNULL(tdebitpoints,0) as dispatchstock,(IFNULL(tcreditpoints,0) - IFNULL(tdebitpoints,0)) as finalstock');
						$this->db->from('(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = '.$row['master_item_id'].' AND tcredit.tran_is_hold = '."'0'".') as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = '.$row['master_item_id'].' AND tdebit.tran_is_hold = '."'0'".') as tdebitpoints',FALSE);
						$query = $this->db->get();
						$stock_report = $query->row_array();
						$initial_stock = $stock_report['finalstock'];
				$new_row['stock']=htmlentities(stripslashes($initial_stock));
				$new_row['description']=htmlentities(stripslashes($row['master_item_description']));
				$new_row['rate']=htmlentities(stripslashes($row['master_item_rate']));
				$new_row['image']=base_url().'uploads/master_item_img/'.htmlentities(stripslashes($row['master_item_img']));
				$row_set[] = $new_row; //build an array
			}
			//echo "<pre>"; print_r($row_set); die;
			echo json_encode($row_set); //format the array into json data
		}
		else
		{
			$row_set = array();
			echo json_encode($row_set);
		}
	}
	public function get_customertype()
	{
		$this->db->select('*');
		$this->db->from('tbl_customer_type');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('ctype_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function create_inq($id)
	{
		$enuserid=$this->session->userdata['miconlogin']['userid'];
		$userid= $this->encrypt_decrypt('decrypt', $enuserid);
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_b2b_inqs');
		$this->db->where('b2binq_id',$id);
		$query = $this->db->get();
		$value['salesb2binq'] = $query->row_array();
		
		$maininq_no = $this->sq_no_get();
		$item = array(
			'sq_no' => $maininq_no,
			'sq_enq_date' => date("Y-m-d", strtotime($value['salesb2binq']['b2binq_date'])),
			'vendor' => $value['salesb2binq']['b2binq_companyname'],
			'sq_address' => $value['salesb2binq']['b2binq_address'],
			'sq_con_person' => $value['salesb2binq']['b2binq_cust_name'],
			'sq_email' => $value['salesb2binq']['b2binq_cust_email'],
			'sq_phone' => $value['salesb2binq']['b2binq_cust_phone'],
			'sq_mobile' => $value['salesb2binq']['b2binq_cust_mno'],
			'sq_prodetails' => $value['salesb2binq']['b2binq_product_name'],
			'sq_source_cat' => 1,
			'sq_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'sq_cdate' => date('Y-m-d H:i:s'),
			'sq_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_sales_enq',$item);
		$lid = $this->db->insert_id();

		$this->db->where('b2binq_id',$id);
		$stupdate = array('b2binq_createinq'=>1);
		$this->db->update('tbl_b2b_inqs',$stupdate);


		return $lid;

	}
	public function create_qoute($id)
	{
		//echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
		$enuserid=$this->session->userdata['miconlogin']['userid'];
		$userid= $this->encrypt_decrypt('decrypt', $enuserid);
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		$this->db->where('sq_id',$id);
		$query = $this->db->get();

		$this->db->where('sq_id',$id);
		$stupdate = array('sq_inq_sts'=>4);
		$this->db->update('tbl_sales_enq',$stupdate);
		
		$value['salesinq'] = $query->row_array();
		$this->db->select('sa_id');
		$this->db->from('tbl_sale_quotation');
		$this->db->order_by('sa_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		
	    if(date("m") < 4)
		{
			$last_year = date('y', strtotime('-1 year'));
			$this_year = date('y');
			$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
		}else{
			$next_year = date('y', strtotime('+1 year'));
			$this_year = date('y');
			$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
		}

		$autoid['sa_id'] = isset($autoid['sa_id']) ? $autoid['sa_id'] : '';
		$code['pre_quotation'] = 'QTN-'.$year_string.'-'.($autoid['sa_id']+1);
		$item = array(
			'sa_no' =>$code['pre_quotation'],
			'sa_sq_no' => $value['salesinq']['sq_no'],
			'sa_enq_date' => date("Y-m-d", strtotime($value['salesinq']['sq_enq_date'])),
			'sa_inq_ref_no' => $value['salesinq']['sq_refno'],
			'sa_inq_ref_date' => date("Y-m-d", strtotime($value['salesinq']['sq_ref_date'])),
			'vendor' => $value['salesinq']['vendor'],
			'sa_con_person' => $value['salesinq']['sq_con_person'],
			'sa_cus_type' => $value['salesinq']['sq_cust_type'],
			'sa_address' => $value['salesinq']['sq_address'],
			'sa_remarks' => $value['salesinq']['sq_remarks'],
			'sa_country' => $value['salesinq']['sq_country'],
			'sa_state' => $value['salesinq']['sq_state'],
			'sa_city' => $value['salesinq']['sq_city'],
			'sa_brand' => $value['salesinq']['sq_brand'],
			'sa_cont_per' => $value['salesinq']['sq_con_person'],
			'sa_mobile' => $value['salesinq']['sq_mobile'],
			'sa_phone' => $value['salesinq']['sq_phone'],
			'sa_email' => $value['salesinq']['sq_email'],
			'sa_website' => $value['salesinq']['sq_website'],
			'sa_gstno' => $value['salesinq']['sq_gstno'],
			'sa_source_cat' => $value['salesinq']['sq_source_cat'],
			'sa_subsource_cat' => $value['salesinq']['sq_subsource_cat'],
			'sa_mode_inq' => $value['salesinq']['sq_mode_inq'],
			'sale_quotation_sub' => $value['salesinq']['sales_enq_sub'],
			'sa_priority' => $value['salesinq']['sq_inq_priority'],
			'sa_inq_st' => $value['salesinq']['sq_end_st'],
			'sa_inq_by' =>  $value['salesinq']['sq_end_st'],
			'sa_referred_by' => $value['salesinq']['sq_ref_by'],
			'sa_remarks' => $value['salesinq']['sq_remarks'],
			'sale_quotation_term' => $value['salesinq']['sales_enq_desc'],
			'sa_tc_price' => "Prices Quoted Are Ex – Works, Ahmadabad.",
			'sa_tc_pf' => "Extra @ 3%.",
			'sa_tc_frght' => "Extra At Actual",
			'sa_tc_insu' => "Purchaser To Arrange,",
			'sa_tc_inspection' => "If Required, Material Will Be Offered For Inspection At Our Factory At 
The Cost Of The Buyer. Material Will Be Offered For Visual / Functional Inspection On Sampling Basis.",
			'sa_tc_paynt' => "40 % Advance Along With Order And Balance Against Dispatch Through Bank Or On Cod Basis By Way Of Demand Draft Only ",
			'sa_tc_ovali' => "Our Offer Is Valid For A Period Of 30 Days.",

			'sa_tc_wrnty' => "Instruments Are Guaranteed For A Period Of 12 Months From The Date Of Dispatch.",
			'sa_tc_jurisdiction' => "Competent Court In The City Of Ahmadabad Only.",
			'sa_tc_cfsc' => "Will be provided commissioning and services for technical assistance,    
                    for the following charges will be applicable within India and will have 
       to be separately ordered in the PO/work Order.
Visit Charges of Rs. 5000/-per man day (upto 8 Hours)
To & Fro charges will be claimed at actual based on Economy air fare or II A/C rail fare or Taxi Fare as applicable.
Boarding and Lodging will claimed at actual as applicable",
			'sa_cid' => $userid,
			'sa_isdiscount' => 1,
			'sa_cdate' => date('Y-m-d H:i:s'),
			'sa_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_sale_quotation',$item);
		$lid = $this->db->insert_id();
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->where('sqi_sales_enq_id',$id);
		$this->db->where('sqi_item_isdelete',0);
		$query = $this->db->get();
		$data['inqitm'] = $query->result_array();
		if(isset($data['inqitm']) && !empty($data['inqitm']) && $data['inqitm'] != '')
		{
			foreach($data['inqitm'] as $key => $itm)
			{
			$item = array(
					'sai_item_title' => $itm['sqi_itm_title'],
					'sai_sale_quotation_id' => $lid,
					'sai_itm_name' => $itm['sqi_itm_pno'],
					'sai_itm' => $itm['sqi_itm_pnoname'],
					'sai_itm_qty' => $itm['sqi_itm_qty'],
					'sai_itm_hsncode' => $itm['sqi_itm_hsncode'],
					'sai_itm_desc' => $itm['sqi_itm_desc'],
					'sai_itm_price' => $itm['sqi_itm_price'],
					'sai_itm_discount' => $itm['sqi_itm_discount'],
					'sai_itm_total' => $itm['sqi_itm_ftotal'],
					'sai_isdeleted' => '0',
					'sai_item_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_sale_quotation_item',$item);
				}
		}

		$this->db->select('*');
		$this->db->from('tbl_sales_inq_followup');
		$this->db->where('fu_inq_id',$id);
		$this->db->where('fu_isdelete',0);
		$query = $this->db->get();
		$data['inqitm'] = $query->result_array();
		if(isset($data['inqitm']) && !empty($data['inqitm']) && $data['inqitm'] != '')
		{
			foreach($data['inqitm'] as $key => $itm)
			{
			$item = array(
					'fu_inq_id' => $lid,
					'fu_followdate' => date("Y-m-d", strtotime($itm['fu_followdate'])),
					'fu_followmethod' => $itm['fu_followmethod'],
					'fu_followexe' => $itm['fu_followexe'],
					'fu_followupst' => $itm['fu_followupst'],
					'fu_remark' => $itm['fu_remark'],
					'fu_isdelete' => 0,
					'fu_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_sale_quotation_followup',$item);
				}
		}
		return $lid;
	}
	public function wo_no_get()
	{
		$this->db->select('wo_id');
		$this->db->from('tbl_work_order');
		$this->db->order_by('wo_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$autoid['wo_id'] = isset($autoid['wo_id']) ? $autoid['wo_id'] : '';
		if(date("m") < 4)
		{
			$last_year = date('y', strtotime('-1 year'));
			$this_year = date('y');
			$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
		}else{
			$next_year = date('y', strtotime('+1 year'));
			$this_year = date('y');
			$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
		}
		return 'WO-'.$year_string.'-'.($autoid['wo_id']+1);
	}

	public function create_work_order($id)
	{
		$enuserid=$this->session->userdata['miconlogin']['userid'];
		$userid= $this->encrypt_decrypt('decrypt', $enuserid);
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		$this->db->where('sq_id',$id);
		$query = $this->db->get();
		$value['salesinq'] = $query->row_array();
		$mainwo_no = $this->wo_no_get();
		$item = array(
			'wo_wo_no' => $mainwo_no,
			'wo_inq_id' => $id,
			'wo_wo_date' => date("Y-m-d"),
			'wo_customer_id' => $value['salesinq']['vendor_id'],
			'wo_po_no' => 'fro inq.',
			'wo_po_date' => date("Y-m-d"),
			'wo_customer_name' => $value['salesinq']['vendor'],
			'wo_address' => $value['salesinq']['sq_address'],
			'wo_billing_address' => $value['salesinq']['sq_address'],
			'wo_shipping_address' => $value['salesinq']['sq_address'],
			
			'wo_preparedby' => $value['salesinq']['sq_allotedto'],
			'wo_gstno' => $value['salesinq']['sq_gstno'],
			'wo_testedby' => $value['salesinq']['sq_allotedto'],
			'wo_remark' => $value['salesinq']['sq_remarks'],
			'wo_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'wo_udate' => date("Y-m-d H:i:s")
			);
		$this->db->insert('tbl_work_order',$item);
		$lid = $this->db->insert_id();
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->where('sqi_sales_enq_id',$id);
		$this->db->where('sqi_item_isdelete',0);
		$query = $this->db->get();
		$data['inqitm'] = $query->result_array();
		if(isset($data['inqitm']) && !empty($data['inqitm']) && $data['inqitm'] != '')
		{
			$fprice = 0;
			foreach($data['inqitm'] as $key => $itm)
			{
			$item = array(
					'woi_wo_id' => $lid,
					'woi_item_id' => $itm['sqi_itm_pno'],
					'woi_part_no' => $itm['sqi_itm_pnoname'],
					'woi_itm_title' => $itm['sqi_itm_title'],
					'woi_itm_desc' => $itm['sqi_itm_desc'],
					'woi_stock' => $itm['sqi_itm_stock'],
					'woi_qty'=> isset($itm['sqi_itm_qty']) ? $itm['sqi_itm_qty'] : '',
					'woi_price'=> $itm['sqi_itm_price'],
					'woi_gst'=> 18,
					'woi_total'=> ($itm['sqi_itm_qty']*$itm['sqi_itm_price']),
					'woi_discount'=> $itm['sqi_itm_discount'],
					'woi_final_price'=> (($itm['sqi_itm_qty']*$itm['sqi_itm_price']) - (($itm['sqi_itm_qty']*$itm['sqi_itm_price']) * ($itm['sqi_itm_discount'] / 100))) + ( (($itm['sqi_itm_qty']*$itm['sqi_itm_price']) - (($itm['sqi_itm_qty']*$itm['sqi_itm_price']) * ($itm['sqi_itm_discount'] / 100))) * (18/100) ),
					'woi_udate' => date('Y-m-d H:i:s')
					);
			$fprice = $fprice + $item['woi_final_price'];
				//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_work_order_item',$item);
				}
			if($fprice > 0)
			{
				$updatewo = array('wo_fainaltotal' => $fprice);
				$this->db->where('wo_id',$lid);
				$this->db->update('tbl_work_order',$updatewo);
			}
		}

		$this->db->where('sq_id',$id);
		$stupdate = array('sq_inq_sts'=>6,'sq_wo_id'=>$lid);
		$this->db->update('tbl_sales_enq',$stupdate);
		
		return $lid;
	}

	public function get_work_orderpdfdata($id)
	{
		$value = array();
		$this->db->select('*,testedby.au_fname as testedbyf,testedby.au_lname as testedbyl,preparedby.au_fname as preparedbyf,preparedby.au_lname as preparedbyl');
		$this->db->from('tbl_work_order');
		$this->db->join('tbl_admin_users as testedby','tbl_work_order.wo_testedby = testedby.au_id','left');
		$this->db->join('tbl_admin_users as preparedby','tbl_work_order.wo_preparedby = preparedby.au_id','left');
		$this->db->where('tbl_work_order.wo_id',$id);
		$this->db->order_by('tbl_work_order.wo_id','DESC');
		$query = $this->db->get();
		$value['inv'] = $query->row_array();


		$this->db->select('*');
		$this->db->from('tbl_work_order_item');
		$this->db->join('tbl_master_item','tbl_work_order_item.woi_item_id = tbl_master_item.master_item_id','left');
		$this->db->where('tbl_work_order_item.woi_wo_id',$id);
		$this->db->where('tbl_work_order_item.woi_isdelete',0);
		$query = $this->db->get();
		$value['items'] = $query->result_array();
		return $value;
	}

	public function get_all_hsns()
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$query = $this->db->get();
		$value = $query->result_array();
		return $value;
	}


	public function get_edit_inqitems($id,$itemid)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq_item');
		$this->db->where('sqi_sales_enq_id',$id);
		$this->db->where('sqi_id',$itemid);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_country_to_state($country_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_country',$country_id);
		$this->db->where('state_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}//

	public function get_state_to_city($stateid)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_state',$stateid);
		$this->db->where('city_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function insert_india_btob_inq($data)
	{
		foreach ($data as $key => $value) 
		{
			if(isset($value->QUERY_ID) && ($value->QUERY_ID != ''))
			{
				$this->db->select('*');
				$this->db->from('tbl_b2b_inqs');
				$this->db->where('b2binq_refno',$value->QUERY_ID);
				$this->db->where('b2binq_type',1);
				$query = $this->db->get();
				if($query->num_rows()==0)
				{
					$item = array(
						'b2binq_type' =>1,
						'b2binq_refno' => isset($value->QUERY_ID) ? $value->QUERY_ID : 0,
						'b2binq_cust_name' => isset($value->SENDERNAME) ? $value->SENDERNAME : '',
						'b2binq_cust_email' => isset($value->SENDEREMAIL) ? $value->SENDEREMAIL : '',
						'b2binq_subject' => isset($value->SUBJECT) ? $value->SUBJECT : '',
						'b2binq_datetime' => isset($value->DATE_TIME_RE) ? date("Y-m-d H:i:s", strtotime($value->DATE_TIME_RE)) : 0,
						'b2binq_companyname' => isset($value->GLUSR_USR_COMPANYNAME) ? $value->GLUSR_USR_COMPANYNAME : '',
						'b2binq_read_status' => isset($value->READ_STATUS) ? $value->READ_STATUS : '',
						'b2binq_ref_userid' => isset($value->SENDER_GLUSR_USR_ID) ? $value->SENDER_GLUSR_USR_ID : '',
						'b2binq_cust_mno' => isset($value->MOB) ? $value->MOB : 0,
						'b2binq_cust_phone' => isset($value->PHONE) ? $value->PHONE : '',
						'b2binq_cust_phone_alt' => isset($value->PHONE_ALT) ? $value->PHONE_ALT : '',
						'b2binq_massage' => isset($value->ENQ_MESSAGE) ? $value->ENQ_MESSAGE : '',
						'b2binq_address' => isset($value->ENQ_ADDRESS) ? $value->ENQ_ADDRESS : '',
						'b2binq_city' => isset($value->ENQ_CITY) ? $value->ENQ_CITY : '',
						'b2binq_state' => isset($value->ENQ_STATE) ? $value->ENQ_STATE : '',
						'b2binq_product_name' => isset($value->PRODUCT_NAME) ? $value->PRODUCT_NAME : '',
						'b2binq_country' => isset($value->COUNTRY_ISO) ? $value->COUNTRY_ISO : '',
						'b2binq_date' => date('Y-m-d H:i:s')
						);
					//echo'<pre>';print_r($item);die;
					$this->db->insert('tbl_b2b_inqs',$item);
				}else{
					//break;
				}
			}
		}
	}
	public function insert_trade_btob_inq($data)
	{
		//echo'<pre>';print_r($data);die;
		foreach ($data as $key => $value) 
		{
			$this->db->select('*');
			$this->db->from('tbl_b2b_inqs');
			$this->db->where('b2binq_refno',$value->generated);
			$this->db->where('b2binq_type',2);
			$query = $this->db->get();
			if($query->num_rows()==0)
			{
				$item = array(
					'b2binq_type' =>2,
					'b2binq_refno' => isset($value->generated) ? $value->generated : 0,
					'b2binq_cust_name' => isset($value->sender_name) ? $value->sender_name : '',
					'b2binq_cust_email' => isset($value->sender_email) ? $value->sender_email : '',
					'b2binq_subject' => isset($value->subject) ? $value->subject : '',
					'b2binq_datetime' => isset($value->generated_date) ? date("Y-m-d H:i:s", strtotime($value->generated_date.' '.$value->generated_time)) : 0,
					'b2binq_companyname' => isset($value->sender_co) ? $value->sender_co : '',
					'b2binq_read_status' => isset($value->view_status) ? $value->view_status : '',
					'b2binq_ref_userid' => isset($value->sender_uid) ? $value->sender_uid : '',
					'b2binq_cust_mno' => isset($value->sender_mobile) ? $value->sender_mobile : 0,
					//'b2binq_cust_phone' => isset($value->PHONE) ? $value->PHONE : '',
					//'b2binq_cust_phone_alt' => isset($value->PHONE_ALT) ? $value->PHONE_ALT : '',
					'b2binq_massage' => isset($value->message) ? $value->message : '',
					//'b2binq_address' => isset($value->ENQ_ADDRESS) ? $value->ENQ_ADDRESS : '',
					'b2binq_city' => isset($value->sender_city) ? $value->sender_city : '',
					'b2binq_state' => isset($value->sender_state) ? $value->sender_state : '',
					'b2binq_product_name' => isset($value->product_name) ? $value->product_name : '',
					'b2binq_country' => isset($value->sender_country) ? $value->sender_country : '',
					'b2binq_date' => date('Y-m-d H:i:s')
					);
				//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_b2b_inqs',$item);
			}else{
				break;
			}

		}
	}
	public function get_b2binq()
	{
		$this->db->select('*');
		$this->db->from('tbl_b2b_inqs');
		$this->db->join('tbl_admin_users','tbl_b2b_inqs.b2binq_assignby = tbl_admin_users.au_id','left');
		$this->db->join('tbl_b2b_type','tbl_b2b_inqs.b2binq_type = tbl_b2b_type.b2b_type_id','left');

		if($this->input->post('b2binq_type') && ($this->input->post('b2binq_type') != ''))
        {
           $this->db->like('b2b_type_name', $this->input->post('b2binq_type'));   
        }
        if($this->input->post('b2binq_cust_name') && ($this->input->post('b2binq_cust_name') != ''))
        {
           $this->db->like('b2binq_cust_name', $this->input->post('b2binq_cust_name'));   
        }
        if($this->input->post('b2binq_cust_email') && ($this->input->post('b2binq_cust_email') != ''))
        {
           $this->db->like('b2binq_cust_email', $this->input->post('b2binq_cust_email'));   
        }
         if($this->input->post('b2binq_address') && ($this->input->post('b2binq_address') != ''))
        {
           $this->db->like('b2binq_city', $this->input->post('b2binq_address'));   
        }
         if($this->input->post('b2binq_product_name') && ($this->input->post('b2binq_product_name') != ''))
        {
           $this->db->like('b2binq_product_name', $this->input->post('b2binq_product_name'));   
        }

        if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('b2binq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('b2binq_date <=',$stdate);
		}

		$this->db->order_by('b2binq_datetime','DESC');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	public function get_b2binq_id($id)
	{
		//echo "hiii";die;
		$this->db->select('*');
		$this->db->from('tbl_b2b_inqs');
		$this->db->where('b2binq_id',$id);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->row_array();
	}
	public function get_b2biq_chat($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_b2binq_update');
		$this->db->join('tbl_admin_users','tbl_b2binq_update.b2bu_ad_id = tbl_admin_users.au_id','left');
		$this->db->where('b2bu_b2binq_id',$id);
		$this->db->where('b2bu_isdelete',0);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function edit_b2b($data,$id)
	{
		$item = array(
			'b2bu_b2binq_id' => $id,
			'b2bu_ad_id' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'b2bu_remark' => $data['b2bu_remark'],
			'b2bu_udate' => $data['udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_b2binq_update',$item);
		return $id;
	}
	public function delete_chat($data,$id)
	{
		//echo $id;die();
		$this->db->set('b2bu_isdelete',1);
		$this->db->where('b2bu_id', $id);
		$this->db->update('tbl_b2binq_update');
		return $id;
	}
	public function assign_b2b_inq($id)
	{
		$this->db->set('b2binq_assignby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->where('b2binq_id', $id);
		$this->db->update('tbl_b2b_inqs');
		return $id;
	}
	public function b2b_type_info()
	{
		$this->db->select('*');
		$this->db->from('tbl_b2b_settings');
		$this->db->where('b2b_isdelete',0);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->row_array();
	}

	public function get_stats()
	{
		$this->db->select('SUM(sq_grd_ttl) as count');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}

        //$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        

		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		$value['total_amount'] = $query->row_array();

		$this->db->select('SUM(sq_grd_ttl) as count');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$this->db->where('sq_inq_sts',1);
        //$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        

		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		$value['active_inq'] = $query->row_array();

		$this->db->select('SUM(sq_grd_ttl) as count');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$this->db->where('sq_inq_sts',4);
        //$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        

		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		$value['quote_inq'] = $query->row_array();

		$this->db->select('SUM(sq_grd_ttl) as count');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$this->db->where('sq_inq_sts',5);
        //$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        

		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		$value['drop_inq'] = $query->row_array();

		$this->db->select('SUM(sq_grd_ttl) as count');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sales_enq');
		//$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_source_cat as source','tbl_sales_enq.sq_source_cat = source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('sqi_item_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		//$this->db->order_by('tbl_sales_enq.sq_id','DESC');
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		// if($this->input->get('vendor')){
		// 	$this->db->where('tbl_sales_enq.sq_id', $this->input->get('vendor'));
		// }
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sq_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sq_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sq_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sq_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           //echo "<pre>";print_r($this->input->get('sq_state'));die;
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$this->db->where('sq_inq_sts',6);
        //$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        

		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		$value['order_inq'] = $query->row_array();

		// ************************************** Today ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		$this->db->where('sq_enq_date',date("Y-m-d"));
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['today_amount'] = $query->row_array();
		//***************************** Today End *****************************************************

		// ************************************** Yesterday ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		if(date('D') != 'Mon') {
			$this->db->where('sq_enq_date',date('Y-m-d',strtotime("-1 days")));
		}else{
			$this->db->where('sq_enq_date',date('Y-m-d',strtotime("-2 days")));
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['yesterday_amount'] = $query->row_array();
		//***************************** Yesterday End *****************************************************

		// ************************************** This Week ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		
		$last_monday = date('Y-m-d',strtotime('-1 Monday'));
		if(date('D') != 'Mon') {
			$this->db->where('sq_enq_date >=',$last_monday);
		}else{
			$this->db->where('sq_enq_date',date("Y-m-d"));
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['this_week'] = $query->row_array();
		//***************************** This Week End *****************************************************

		// ************************************** Last Week ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		
		$last_monday = date('Y-m-d',strtotime('-1 Monday'));
		$last_to_last_monday = date('Y-m-d',strtotime('-2 Monday'));
		if(date('D') != 'Mon') {
			$this->db->where('sq_enq_date >=',$last_to_last_monday);
			$this->db->where('sq_enq_date <',$last_monday);
		}else{
			$this->db->where('sq_enq_date >=',$last_monday);
			$this->db->where('sq_enq_date <',date("Y-m-d"));
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['last_week'] = $query->row_array();
		//***************************** last Week End *****************************************************

		// ************************************** month ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		$this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m")',date('Y-m'));
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['month_amount'] = $query->row_array();
		//***************************** month End *****************************************************

		// ************************************** last month ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		$this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m")',date('Y-m',strtotime("-1 month")));
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['last_month_amount'] = $query->row_array();
		//***************************** last month End *****************************************************
		// ************************************** this year ****************************************************************
		$this->db->select('SUM(sq_grd_ttl) as count');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
		$this->db->where('sq_isdeleted',0);
		//$this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m")',date('Y-m',strtotime("-1 month")));
		if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(sq_enq_date,"%Y-%m") >=',"".$this_year."-04");
        }
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sales_enq.sq_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(vendor)', strtoupper($str_vendor));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sales_enq.sq_id', $this->input->get('conper'));
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_country',$this->input->get('country'));
		}
		if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_allotedto',$this->input->get('sq_attendto'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('sq_state') && ($this->input->get('sq_state') != ''))
        {
           $this->db->like('state_name', $this->input->get('sq_state'));   
        }
        if($this->input->get('sq_city') && ($this->input->get('sq_city') != ''))
        {
           $this->db->like('city_name', $this->input->get('sq_city'));   
        }
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',3);
			}
			if($this->input->get('status') == 'Drop')
			{
				$this->db->where('tbl_sales_enq.sq_inq_sts',5);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sales_enq.sq_end_st',$this->input->get('sq_end_st'));
		}
		$query = $this->db->get();
		$value['year_amount'] = $query->row_array();
		//***************************** This Year End *****************************************************

		return $value;
	}
}
?>