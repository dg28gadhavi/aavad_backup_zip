<?php 

class Oa_model extends CI_Model {
	
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
	public function send_mail($data)
	{
		$item = array(
			'oam_from' => $data['oam_from'],
			'oam_to' => $data['oam_to'],
			'oam_to_cc' => $data['oam_to_cc'],
			'oam_sub' => $data['oam_sub'],
			'oam_attch' => json_encode($data['files']),
			'oam_body' => $data['oam_body'],
			'oam_udate' => date("Y-m-d"),
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_oa_mail',$item);
		return $this->db->insert_id();
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
	public function add($data)
	{
		if(isset($data['oa_brand']) && $data['oa_brand'] != ''){
			$aus_home = json_encode($data['oa_brand']);
		}
		else{
			$aus_home = '';
		}
		//echo "<pre>"; print_r($data); die;
		if($this->uri->segment(3))
		{
			$id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
			$item = array(
			//'oa_no' => $data['oa_no'],
			'oa_enq_date' => date("Y-m-d", strtotime($data['oa_enq_date'])),
			'vendor' => $data['vendor'],
			'vendor_id' => $data['vendor_id'],
			// 'oa_remarks' => $data['oa_remarks'],
			'oa_address' => $data['oa_address'],
			'oa_country' => isset($data['oa_country']) ? $data['oa_country'] : 0,
			'oa_state' => isset($data['oa_state']) ? $data['oa_state'] : 0,
			'oa_city' => isset($data['oa_city']) ? $data['oa_city'] : 0,
			'oa_brand' => $aus_home,
			'oa_con_person' => $data['oa_con_person'],
			'oa_email' => $data['oa_email'],
			'oa_phone' => $data['oa_phone'],
			'oa_mobile' => $data['oa_mobile'],
			'oa_website' => $data['oa_website'],
			'oa_gstno' => $data['oa_gstno'],
			//'oa_isdiscount' => $data['oa_isdiscount'],
			// 'oa_rem_date' => date("Y-m-d", strtotime($data['oa_rem_date'])),
			// 'oa_rem_be_date' => $data['oa_rem_be_date'],
			// 'oa_mode_inq' => $data['oa_mode_inq'],
			// 'oa_inq_st' => $data['oa_inq_sts'],
			// 'oa_priority' => $data['oa_inq_priority'],
			// 'oa_source_cat' => $data['oa_source_cat'],
			// 'oa_subsource_cat' => $data['oa_subsource_cat'],
			// //'oa_ref_by' => $data['oa_ref_by'],
			// //'oa_attach' => $data['oa_attach'],
			// 'oa_term' => $data['oa_desc'],
			// 'oa_sub_ttl' => $data['itm_subttl'],
			// 'oa_grd_ttl' => $data['itm_grdttl'],
			// 'oa_grd_ttl_words' => $data['grdttlinword'],
			//'oa_cid' => $this->session->userdata['login']['aus_Id'],
			//'oa_cdate' => $data['oa_cdate'],
			'oa_udate' => $data['oa_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('oa_id',$id);
		$this->db->update('tbl_oa',$item);
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		$lid = $id;
		}else{
			$oanocode = $this->oa_no_get();
			$item = array(
			'oa_no' => $oanocode,
			'oa_enq_date' => date("Y-m-d", strtotime($data['oa_enq_date'])),
			'vendor' => $data['vendor'],
			'vendor_id' => $data['vendor_id'],
			// 'oa_remarks' => $data['oa_remarks'],
			'oa_address' => $data['oa_address'],
			'oa_country' => isset($data['oa_country']) ? $data['oa_country'] : 0,
			'oa_state' => isset($data['oa_state']) ? $data['oa_state'] : 0,
			'oa_city' => isset($data['oa_city']) ? $data['oa_city'] : 0,
			'oa_brand' => $aus_home,
			'oa_con_person' => $data['oa_con_person'],
			'oa_email' => $data['oa_email'],
			'oa_phone' => $data['oa_phone'],
			'oa_mobile' => $data['oa_mobile'],
			'oa_website' => $data['oa_website'],
			'oa_gstno' => $data['oa_gstno'],
			//'oa_isdiscount' => $data['oa_isdiscount'],
			// 'oa_rem_date' => date("Y-m-d", strtotime($data['oa_rem_date'])),
			// 'oa_rem_be_date' => $data['oa_rem_be_date'],
			// 'oa_mode_inq' => $data['oa_mode_inq'],
			// 'oa_inq_st' => $data['oa_inq_sts'],
			// 'oa_priority' => $data['oa_inq_priority'],
			// 'oa_source_cat' => $data['oa_source_cat'],
			// 'oa_subsource_cat' => $data['oa_subsource_cat'],
			// //'oa_ref_by' => $data['oa_ref_by'],
			// //'oa_attach' => $data['oa_attach'],
			// 'oa_term' => $data['oa_desc'],
			// 'oa_sub_ttl' => $data['itm_subttl'],
			// 'oa_grd_ttl' => $data['itm_grdttl'],
			// 'oa_grd_ttl_words' => $data['grdttlinword'],
			'oa_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'oa_cdate' => $data['oa_cdate'],
			'oa_udate' => $data['oa_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_oa',$item);
		$lid = $this->db->insert_id();
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance',
					'adlog_edit' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		}
		
		
		return $lid;
	}
	public function other_add($data,$id)
	{
		$item = array(
			//'oa_mode_inq' => $data['oa_mode_inq'],
			'oa_inq_st' => $data['oa_inq_sts'],
			'oa_priority' => $data['oa_inq_priority'],
			'oa_prepared_by' => $data['oa_prepared_by'],
			//'oa_subsource_cat' => $data['oa_subsource_cat'],
			'oa_ref_by' => $data['oa_ref_by'],
			//'oa_attach' => $data['oa_attach'],
			'oa_term' => $data['oa_term'],
			'oa_remarks' => $data['oa_remarks'],
			'oa_tc_price' => $data['oa_tc_price'],
			'oa_tc_wrnty' => $data['oa_tc_wrnty'],
			'oa_tc_pf' => $data['oa_tc_pf'],
			'oa_tc_deli' => $data['oa_tc_deli'],
			'oa_tc_paynt' => $data['oa_tc_paynt'],
			'oa_tc_ovali' => $data['oa_tc_ovali'],
			'oa_tc_frght' => $data['oa_tc_frght'],
			'oa_tc_gst' => $data['oa_tc_gst'],
			'oa_isdiscount' => $data['oa_isdiscount'],
			'oa_udate' => $data['oa_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('oa_id', $id);
		$this->db->update('tbl_oa', $item); 
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
	public function item_add($data,$id)
	{
		$item = array(
					'oai_oale_quotation_id' => $id,
					'oai_itm_name' => $data['oai_itm'],
					'oai_itm_title' => $data['oai_itm_title'],
					'oai_itm' => $data['oai_itm_pno'],
					'oai_itm_hsncode'=> $data['oai_itm_hsncode'],
					'oai_itm_desc'=> $data['oai_itm_desc'],
					'oai_itm_qty'=> $data['oai_itm_qty'],
					'oai_itm_stock'=> $data['oai_itm_stock'],
					'oai_itm_opn_qty'=> $data['oai_itm_opn_qty'],
					'oai_itm_price'=> $data['oai_itm_price'],
					'oai_itm_discount'=> $data['oai_itm_discount'],
					'oai_itm_total'=> $data['oai_itm_ftotal'],
					'oai_item_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_oa_item',$item);
		$lid = $this->db->insert_id();

		$this->db->select('SUM(oai_itm_total) as count');
        		$this->db->from('tbl_oa_item');
        		$this->db->where('oai_oale_quotation_id',$id);
        		$this->db->where_in('oai_isdeleted',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'oa_grd_ttl' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('oa_id',$id);
				$this->db->update('tbl_oa',$item);

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
	public function item_edit($data,$sqiitemid)
	{
		//echo "<pre>";print_r($id);die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item = array(
					'oai_oale_quotation_id' => $lid,
					'oai_itm_name' => $data['oai_itm'],
					'oai_itm_title' => $data['oai_itm_title'],
					'oai_itm' => $data['oai_itm_pno'],
					'oai_itm_hsncode'=> $data['oai_itm_hsncode'],
					'oai_itm_desc'=> $data['oai_itm_desc'],
					'oai_itm_qty'=> $data['oai_itm_qty'],
					'oai_itm_stock'=> $data['oai_itm_stock'],
					'oai_itm_opn_qty'=> $data['oai_itm_opn_qty'],
					'oai_itm_price'=> $data['oai_itm_price'],
					'oai_itm_discount'=> $data['oai_itm_discount'],
					'oai_itm_total'=> $data['oai_itm_ftotal'],
					'oai_item_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
				$this->db->where('oai_id',$sqiitemid);
				$this->db->update('tbl_oa_item',$item);

				$this->db->select('SUM(oai_itm_total) as count');
        		$this->db->from('tbl_oa_item');
        		$this->db->where('oai_oale_quotation_id',$lid);
        		$this->db->where_in('oai_isdeleted',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'oa_grd_ttl' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('oa_id',$lid);
				$this->db->update('tbl_oa',$item);
				
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		if(isset($data['oa_brand']) && $data['oa_brand'] != ''){
			$aus_home = json_encode($data['oa_brand']);
		}
		else{
			$aus_home = '';
		}
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'oa_no' => $data['oa_no'],
			'oa_enq_date' => date("Y-m-d", strtotime($data['oa_enq_date'])),
			'vendor' => $data['vendor'],
			'oa_remarks' => $data['oa_remarks'],
			'oa_address' => $data['oa_address'],
			'oa_country' => $data['oa_country'],
			'oa_state' => $data['oa_state'],
			'oa_city' => $data['oa_city'],
			'oa_brand' => $aus_home,
			'oa_con_person' => $data['oa_con_person'],
			'oa_email' => $data['oa_email'],
			'oa_phone' => $data['oa_phone'],
			'oa_mobile' => $data['oa_mobile'],
			'oa_website' => $data['oa_website'],
			'oa_rem_date' => date("Y-m-d", strtotime($data['oa_rem_date'])),
			'oa_rem_be_date' => $data['oa_rem_be_date'],
			// 'oa_mode_inq' => $data['oa_mode_inq'],
			'oa_inq_st' => $data['oa_inq_sts'],
			'oa_priority' => $data['oa_inq_priority'],
			'oa_source_cat' => $data['oa_source_cat'],
			'oa_subsource_cat' => $data['oa_subsource_cat'],
			// 'oa_end_st' => $data['oa_end_st'],
			// //'oa_party_tax' => $data['oa_party_tax'],
			// 'oa_ref_by' => $data['oa_ref_by'],
			// //'oa_attach' => $data['oa_attach'],
			 'oa_term' => $data['oa_desc'],
			// 'oa_sub_ttl' => $data['itm_subttl'],
			// 'oa_grd_ttl' => $data['itm_grdttl'],
			// 'oa_grd_ttl_words' => $data['grdttlinword'],
			//'oa_cid' => $this->session->userdata['login']['aus_Id'],
			'oa_udate' => $data['oa_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('oa_id', $id);
		//$this->db->where('oa_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_oa', $item); 
		//$lid = $this->input->get('id');
		$this->db->delete('tbl_oa_item',array('oai_oale_quotation_id' => $id));
		//$this->db->delete('tbl_oa_itax',array('sqit_pid' => $lid));
		//echo '<pre>'; print_r($data['mequot_detail_item']); die;
		if(isset($data['mequot_detail_item']) && !empty($data['mequot_detail_item']))
		foreach ($data['mequot_detail_item'] as $key => $mequot_detail_item) {
			if($mequot_detail_item != '' && $data['mequot_desc'][$key] != '')
			{
				$item1 = array(
					'oai_oale_quotation_id' => $id,
					'oai_itm_name' => $mequot_detail_item,
					'oai_itm_desc'=> $data['mequot_desc'][$key],
					'oai_itm_qty'=> $data['mequot_qty'][$key],
					'oai_itm_price'=> $data['mequot_rate'][$key],
					'oai_itm_discount'=> $data['mequot_dis'][$key],
					'oai_itm_total'=> $data['mequot_ftotl'][$key],
					'oai_item_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1);
				$this->db->insert('tbl_oa_item',$item1);

			}
		}
		$this->db->where('fu_inq_id', $id);
		$this->db->delete('tbl_salesq_followup');
		if(isset($data['mefuq_exec']) && $data['mefuq_exec'] != '')
		{//die;
			foreach ($data['mefuq_date'] as $fukey => $spousechdtl_date) {
				$fu = array(
				'fu_moduleid' => 19,
				'fu_inq_id' => $id,
				//'urefu_uf_id' =>
				'fu_followdate' => date("Y-m-d", strtotime($spousechdtl_date)),
				'fu_followmethod' => $data['mefuq_method'][$fukey],
				'fu_followexe' => $data['mefuq_exec'][$fukey],
				'fu_followupst' => $data['mefuq_status'][$fukey],
				'fu_remark' => $data['mefuq_remrk'][$fukey],
				'fu_udate' => date('Y-m-d H:i:s')
				);
				//echo '<pre>'; print_r($fu);
				$this->db->insert('tbl_salesq_followup',$fu);
			}
		}
		return $id;	
}
		
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa');
		$this->db->join('tbl_admin_users','tbl_oa.oa_cid = tbl_admin_users.au_id');
		//$this->db->join('tbl_master_party','tbl_oa.vendor = tbl_master_party.master_party_id');
		$this->db->where('oa_id',$id);
		$this->db->where('oa_isdeleted',0);
		//$this->db->where('oa_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_oa()
	{
		
		$this->db->select('*');//sum(tbl_oa.inv_grand_total) as grand_total_view
		$this->db->from('tbl_oa');
		// $this->db->join('tbl_oa_item','tbl_oa_item.oai_oale_quotation_id = tbl_oa.oa_id','left');
		//$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_oa_item.oai_itm_name','left');
		$this->db->join('tbl_mode_inquiry','tbl_oa.oa_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->where('oa_isdeleted','0');
		//$this->db->where('oai_isdeleted',0);
		//$this->db->join('tbl_admin_users','tbl_oa.oa_end_st = tbl_admin_users.aus_Id');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('oa_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('oa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}

		//$this->db->order_by('tbl_oa.oa_id','DESC');
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('oa_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('vendor_name') && ($this->input->post('vendor_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('vendor_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('aus_FirstName', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('address') && ($this->input->post('address') != ''))
        {
           $this->db->like('oa_address', $this->input->post('address'));   
        }
         if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
        {
           $this->db->like('oa_email', $this->input->post('email_id'));   
        }
         if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
        {
           $this->db->like('oa_phone', $this->input->post('phone_no'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('oa_mobile', $this->input->post('mobile_no'));   
        }
        if($this->input->post('dtlofitm') && ($this->input->post('dtlofitm') != ''))
        {
           $this->db->like('master_item_name', $this->input->post('dtlofitm'));   
        }
        if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('oa_inq_st', $this->input->post('status'));   
        }
        if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('oa_priority', $this->input->post('priority'));   
        }
  //       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		// {
		// 	$this->db->where('tbl_oa.oa_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		// }
		$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_oa.oa_mobile','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_oa.oa_mobile','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 7))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('oa_ref_by','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('oa_ref_by','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 10))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('oa_udate','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('oa_udate','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 9))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('oa_grd_ttl','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('oa_grd_ttl','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 8))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('oa_enq_date','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('oa_enq_date','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 5))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('oa_remarks','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('oa_remarks','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_oa.vendor','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_oa.vendor','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_oa.oa_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_oa.oa_no','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 0))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_oa.oa_id','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_oa.oa_id','DESC');
        	}
        }else{
        	$this->db->order_by('tbl_oa.oa_id','DESC');
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_oa_report()
	{
		$this->db->select('*');//sum(tbl_oa.inv_grand_total) as grand_total_view
		$this->db->from('tbl_oa');
		$this->db->where('oa_isdeleted','0');
		$this->db->join('tbl_mode_inquiry','tbl_oa.oa_mode_inq = tbl_mode_inquiry.mode_inquiry_id');
		$this->db->join('tbl_admin_users','tbl_oa.oa_end_st = tbl_admin_users.aus_Id');
		//$this->db->where('oa_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->order_by('tbl_oa.oa_id','DESC');
		if($this->input->get('party')){
			$this->db->where('tbl_oa.oa_id', $this->input->get('party'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('oa_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('oa_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('oa_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('oa_enq_date <=',$stdate);
		}
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('oa_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('vendor_name') && ($this->input->post('vendor_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('vendor_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('aus_FirstName', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('address') && ($this->input->post('address') != ''))
        {
           $this->db->like('oa_address', $this->input->post('address'));   
        }
         if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
        {
           $this->db->like('oa_email', $this->input->post('email_id'));   
        }
         if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
        {
           $this->db->like('oa_phone', $this->input->post('phone_no'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('oa_mobile', $this->input->post('mobile_no'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_all_tax()
	{
		$this->db->select('in_tax_name, sum(in_tax_amount) as total_taxval');
		$this->db->group_by('in_tax_name'); 
		$this->db->from('tbl_oa');
		$this->db->join('tbl_oa_tax','tbl_oa.inv_id = tbl_oa_tax.in_invid');
		//$this->db->where('inv_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_tax_gst()
	{
		$this->db->select('SUM(tbl_oa_itax.sqit_tax_amount) as total,UPPER(tbl_oa_itax.sqit_tax_name) as tax_name, tbl_oa_itax.*');
		//SUM(IF(itmtax_tax_name = 'CGST', itmtax_tax_amount, 0)) AS 'CGST',
		$this->db->from('tbl_oa_itax');
		//$this->db->join('tbl_invoice_itmtax','tbl_invoice_item.invi_id = tbl_invoice_itmtax.itmtax_invi_id');
		//$this->db->join('tbl_invoice','tbl_invoice.inv_id = tbl_invoice_itmtax.itmtax_invid');
		$this->db->group_by('tax_name');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_oano_wise()
	{
		$this->db->select('*');
		$this->db->from('tbl_oa');
		//$this->db->join('tbl_master_party','tbl_oa.vendor = tbl_master_party.master_party_id');
		//$this->db->join('tbl_oa_item','tbl_oa.inv_id = tbl_oa_item.invi_inv_id');
		//$this->db->join('tbl_master_item','tbl_oa_item.invi_itm_name = tbl_master_item.master_item_id');
		//$this->db->where('oa_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->get('start_date') && ($this->input->get('start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('start_date')));
			$this->db->where('oa_cdate >=',$stdate);
		}
		if($this->input->get('end_date') && ($this->input->get('end_date') != ''))
		{
			$end_date = date("Y-m-d", strtotime($this->input->get('end_date')));
			$this->db->where('oa_cdate <=',$end_date);
		}
		if($this->input->get('party') && ($this->input->get('party') != ''))
		{
			$party = $this->input->get('party');
			$this->db->where('vendor',$party);
		}
		$this->db->order_by('tbl_oa.oa_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_ajaxItmtograde($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('master_item_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_ajaxItmtotax($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_tax');
		//$this->db->where('mit_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('mit_item_id',$id);
		if($this->input->post('taxcat') && ($this->input->post('taxcat') != '')  && ($this->input->post('taxcat') != 0))
		{
			$this->db->where('mit_tax_cat_id',$this->input->post('taxcat'));
		}else{
			$this->db->where('mit_tax_cat_id',$ptax);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function edit_ajaxItmtotax($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_itax');
		//$this->db->where('sqit_tax_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('sqit_pitemid',$id);
		$this->db->where('sqit_pid',$this->input->get('id'));
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_ajaxBOMtotax($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_bom_tax');
		//$this->db->where('bt_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('bt_bomid',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function edit_ajaxBOMtotax($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_btax');
		//$this->db->where('sqbt_tax_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('sqbt_pbomid',$id);
		$this->db->where('sqbt_pid',$this->input->get('id'));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_ajaxGradetoall($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_itm_bom');
		$this->db->where('bom_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_ajaxCuurencytoROE($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_currency');
		//$this->db->where('currency_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('currency_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_ajaxpartyAdd($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		//$this->db->where('master_party_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('master_party_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_tAX_perchase_datas()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$array = array(1,2,3);
		//$this->db->where('tax_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where_in('tax_usedfor',$array);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_pdfdata($id,$module=false)
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_oa');
		$this->db->join('tbl_admin_users','tbl_oa.oa_prepared_by = tbl_admin_users.au_id','left');
		$this->db->join('tbl_master_city','tbl_oa.oa_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_oa.oa_state = tbl_master_state.state_id','left');
		$this->db->where('tbl_oa.oa_id',$id);
		$this->db->order_by('tbl_oa.oa_id','DESC');
		$query = $this->db->get();
		$value['inv'] = $query->row_array();

		$this->db->select('*');
		$this->db->from('tbl_oa_item');
		$this->db->join('tbl_master_item','tbl_oa_item.oai_itm_name = tbl_master_item.master_item_id');
		$this->db->where('tbl_oa_item.oai_oale_quotation_id',$id);
		$this->db->where('tbl_oa_item.oai_isdeleted',0);
		//$this->db->where('tbl_oa_item.oai_is_bom !=',1);
		//$this->db->order_by('tbl_oa_item.invi_inv_id','DESC');
		$query = $this->db->get();
		$value['items'] = $query->result_array();


		return $value;
	}

	public function get_items()
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_item');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_oa_item.oai_itm_name');
		$this->db->where('oai_oale_quotation_id',$this->input->get('id'));
		// $this->db->where('oai_is_bom !=',1);
		$query = $this->db->get();
		$values['itm'] = $query->result_array();
		return $values;
	}

	public function get_follow_status()
	{
		 $this->db->select('*');
        $this->db->from('tbl_followup_status');
       // $this->db->where('country_id',$id);
        $this->db->where('inqfus_is_delete','0');
         $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
	}
	public function get_follow_method()
	{
		 $this->db->select('*');
        $this->db->from('tbl_followup_method');
       // $this->db->where('country_id',$id);
        $this->db->where('fu_method_is_delete','0');
         $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
	}
	public function get_follow_exe()
	{
		 $this->db->select('*');
        $this->db->from('tbl_admin_users');
       // $this->db->where('country_id',$id);
        $this->db->where('au_is_delete','0');
         $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
	}
	public function get_taxs()
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_tax');
		//$this->db->where('tbl_oa_tax.sqt_tax_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('sqt_pid',$this->input->get('id'));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_company_details()
	{
		$this->db->select('*');
		$this->db->from('tbl_company_info');
		//$this->db->where('ci_id',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function get_editbom_details($data)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_bom');
		$this->db->join('tbl_bom','tbl_bom.bom_id = tbl_oa_bom.sqb_bom_id');
		//$this->db->where('tbl_oa_bom.sqb_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('tbl_oa_bom.sqb_bom_id',$data['bomid']);
		$this->db->where('tbl_oa_bom.sqb_oa_id',$this->input->get('id'));
		$query = $this->db->get();
		echo '<pre>';print_r($query->result_array());die;
		return $query->row_array();
	}
	
	public function get_boms_edit()
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_bom');
		$this->db->join('tbl_bom','tbl_bom.bom_id = tbl_oa_bom.sqb_bom_id');
		//$this->db->where('tbl_oa_bom.sqb_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('tbl_oa_bom.sqb_oa_id',$this->input->get('id'));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_currencies()
	{
		$this->db->select('*');
		$this->db->from('tbl_currency');
		//$this->db->where('tbl_currency.currency_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_itmuall()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_unit');
		//$this->db->where('tbl_master_item_unit.master_item_unit_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->result_array();
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
		$this->db->from('tbl_oa');
		$this->db->where('oa_id',$this->input->get('id'));
		$query = $this->db->get();
		$item['pdetails'] = $query->row_array();
		//echo'<pre>';print_r($item);die;

		$this->db->select('oa_id');
		$this->db->from('tbl_oa');
		$this->db->order_by('oa_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['oa_id'] = isset($autoid['oa_id']) ? $autoid['oa_id'] : '';
	    $code['pre_quotation'].''.($autoid['oa_id']+1);
		$item = array(
			'oa_no' =>$code['pre_quotation'].''.($autoid['oa_id']+1),
			'oa_enq_date' => date("Y-m-d", strtotime($item['pdetails']['oa_enq_date'])),
			'vendor' => $item['pdetails']['vendor'],
			'oa_address' => $item['pdetails']['oa_address'],
			'oa_remarks' => $item['pdetails']['oa_remarks'],
			'oa_email' => $item['pdetails']['oa_email'],
			'oa_phone' => $item['pdetails']['oa_phone'],
			'oa_mobile' => $item['pdetails']['oa_mobile'],
			'oa_brand' => $item['pdetails']['oa_brand'],
			//'oa_quotation_stu' => $item['pdetails']['remarks'],
			'oa_referred_by' => $item['pdetails']['oa_ref_by'],
			'oa_attach' => $item['pdetails']['oa_attach'],
			'oa_term' => $item['pdetails']['oa_desc'],
			'oa_sub_ttl' => $item['pdetails']['oa_sub_ttl'],
			'oa_grd_ttl' => $item['pdetails']['oa_grd_ttl'],
			'oa_grd_ttl_words' => $item['pdetails']['oa_grd_ttl_words'],
			'oa_cid' => $this->session->userdata['login']['aus_Id'],
			'oa_cdate' => date('Y-m-d H:i:s'),
			'oa_udate' =>date('Y-m-d H:i:s')
			);//echo'<pre>';print_r($item);die;
		$this->db->insert('tbl_oa',$item);
		$lid = $this->db->insert_id();
		
		$this->db->select('*');
		$this->db->from('tbl_oa_item');
		$this->db->where('oai_oale_quotation_id',$this->input->get('id'));
		$this->db->where('oai_is_bom !=',1);
		$query = $this->db->get();
		$item['piitemdetails'] = $query->result_array();
           //echo'<pre>';print_r($item);die;
		foreach ($item['piitemdetails'] as $key => $grnitem) {
			if($grnitem['oai_itm_name'] != '' && $grnitem['oai_itm_currency'] != '')
			{
				$item = array(
					'oai_oale_quotation_id' =>$lid,
					'oai_itm_name' => $grnitem['oai_itm_name'],
					'oai_itm_grade' =>$grnitem['oai_itm_grade'],
					'oai_itm_desc' =>$grnitem['oai_itm_desc'],
					'oai_itm_qty' => $grnitem['oai_itm_qty'],
					'oai_itm_unit' => $grnitem['oai_itm_unit'],
					'oai_itm_price' => $grnitem['oai_itm_price'],
					'oai_itm_total' =>$grnitem['oai_itm_total'],
					'oai_itm_currency' => $grnitem['oai_itm_currency'],
					'oai_itm_days' => $grnitem['oai_itm_days'],
					'oai_itm_roe' => $grnitem['oai_itm_roe'],
					'oai_itm_tax' => $grnitem['oai_itm_tax'],
					'oai_itm_cid' => $this->session->userdata['login']['aus_Id'],
					'oai_is_bom' => $grnitem['oai_is_bom'],
					'oai_bomid' => $grnitem['oai_bomid'],
					'oai_pbomid' => $grnitem['oai_pbomid'],
					'oai_item_udate' =>date('Y-m-d H:i:s')
					);//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_oa_item',$item);

				$this->db->select('*');
				$this->db->from('tbl_oa_itax');
				$this->db->where('sqit_pid',$this->input->get('id'));
				$this->db->where('sqit_pitemid',$grnitem['oai_itm_name']);
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
					$this->db->insert('tbl_oa_itax',$tax);
				}

			}
		}
		$this->db->select('*');
		$this->db->from('tbl_oa_bom');
		$this->db->where('sqb_oa_id',$this->input->get('id'));
		$query = $this->db->get();
		$item['pbomdetails'] = $query->result_array();
		//echo'<pre>';print_r($item);die;
		if(isset($item['pbomdetails']) && !empty($item['pbomdetails']))
		{
			foreach ($item['pbomdetails'] as $bkey => $grnbomlist) {
				if($grnbomlist['sqb_bom_id'] != '')
				{
					$item = array(
						'sab_oa_id' =>$lid,
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
					$this->db->insert('tbl_oa_bom',$item);
					//echo'<pre>';print_r($item);die;
					$pbomid = $this->db->insert_id();
					//$data['fbomautoid'][$bkey]
					$this->db->select('*');
					$this->db->from('tbl_oa_item');
					$this->db->where('oai_oale_quotation_id',$this->input->get('id'));
					$this->db->where('oai_bomid',$grnbomlist['sqb_bom_id']);
					$this->db->where('oai_is_bom',1);
					$query = $this->db->get();
					$item['pitmbomdetails'] = $query->result_array();
					//echo'<pre>';print_r($item);die;
					if(isset($item['pitmbomdetails']) && !empty($item['pitmbomdetails']))
					{
						foreach ($item['pitmbomdetails'] as $bikey => $grnitem) {
							if($grnitem['oai_itm_name'] != '')
							{
								$item = array(
									'oai_oale_quotation_id' =>$lid,
									'oai_itm_name' => $grnitem['oai_itm_name'],
									'oai_itm_grade' =>$grnitem['oai_itm_grade'],
									'oai_itm_desc' =>$grnitem['oai_itm_desc'],
									'oai_itm_qty' => $grnitem['oai_itm_qty'],
									'oai_itm_unit' => $grnitem['oai_itm_unit'],
									'oai_itm_price' => $grnitem['oai_itm_price'],
									'oai_itm_total' =>$grnitem['oai_itm_total'],
									'oai_itm_currency' => $grnitem['oai_itm_currency'],
									'oai_itm_days' => $grnitem['oai_itm_days'],
									'oai_itm_roe' => $grnitem['oai_itm_roe'],
									'oai_itm_tax' => $grnitem['oai_itm_tax'],
									'oai_itm_cid' => $this->session->userdata['login']['aus_Id'],
									'oai_is_bom' => 1,
									'oai_bomid' => $grnbomlist['sqb_bom_id'],
									'oai_pbomid' => $pbomid,
									'oai_item_udate' =>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_oa_item',$item);
								//echo'<pre>';print_r($item);die;
								//echo $fbom;die;								
							}
						}
					}
					$this->db->select('*');
					$this->db->from('tbl_oa_btax');
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
							$this->db->insert('tbl_oa_btax',$tax);
							//echo'<pre>';print_r($tax);die;
						}	
					}
				}
			}
		}

		$this->db->select('*');
		$this->db->from('tbl_oa_tax');
		$this->db->where('sqt_pid',$this->input->get('id'));
		$query = $this->db->get();
		$item['pttaxdetails']= $query->result_array();
          //echo'<pre>';print_r($item);die;
		foreach ($item['pttaxdetails'] as $key => $itemtax) {
			$tax = array(
				'sat_pid' =>$lid,
				'sat_tax_name' =>$itemtax['sqt_tax_name'],
				'sat_tax_per' => $itemtax['sqt_tax_per'],
				'sat_tax_informat' => $itemtax['sqt_tax_informat'],
				'sat_tax_amount' => $itemtax['sqt_tax_amount'],
				'sat_tax_cid' => $this->session->userdata['login']['aus_Id'],
				'sat_udate' =>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_oa_tax',$tax);
			//echo'<pre>';print_r($tax);die;
		}
		return $lid;
	}
	public function oa_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_oa');
		//$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_oa.vendor');
		if($this->input->get('party')){
			$this->db->where('tbl_oa.oa_id', $this->input->get('party'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('oa_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('oa_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('oa_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('oa_enq_date <=',$stdate);
		}
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['date_wise'] = $query->result_array();
	//**************************************************End customer wise
		// $this->db->select('*');
		// $this->db->from('tbl_oa_item');
		// $this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_oa_item.oai_oale_quotation_id');
		// $this->db->join('tbl_oa', 'tbl_oa.oa_id = tbl_oa_item.oai_oale_quotation_id');
		// if($this->input->get('items')){
		// 	$this->db->where('tbl_oa_item.oai_oale_quotation_id', $this->input->get('items'));
		// }
		// if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
		// 	$this->db->where('oa_cdate >=',$stdate);
		// }
		// if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
		// 	$this->db->where('oa_cdate <=',$stdate);
		// }
		// if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
		// 	$this->db->where('oa_enq_date >=',$stdate);
		// }
		// if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
		// 	$this->db->where('oa_enq_date <=',$stdate);
		// }
		// $query = $this->db->get();
		// //echo'<pre>';print_r($query->result_array());die;
		// $value['item_wise'] =  $query->result_array();	
		//echo'<pre>';print_r($value);die;
	//*************************************************End item wise
	//*************************************************Tax Wise Start
		$this->db->select('*');
		$this->db->from('tbl_tax');
		//$this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_oa_item.oai_oale_quotation_id');
		// $this->db->join('tbl_oa', 'tbl_oa.oa_id = tbl_oa_item.oai_oale_quotation_id');
		$query = $this->db->get();
		$value['tax_wise'] =  $query->result_array();	
		//echo'<pre>';print_r($value);die;
	//*************************************************Tax Wise End
	    $this->db->select('*');
		$this->db->from(' tbl_master_item');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['item'] =  $query->result_array();
	//*************************************************End master item	
		$this->db->select('*');
		$this->db->from('tbl_oa');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['customer'] =  $query->result_array();
	//**************************************************End master customer	
		return $value;	
	}
	public function oa_no_get()
	{
		$this->db->select('oa_id');
		$this->db->from('tbl_oa');
		$this->db->order_by('oa_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		/* $this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['oa_id'] = isset($autoid['oa_id']) ? $autoid['oa_id'] : '';
		return $code['pre_oa'].''.($autoid['oa_id']+1); */
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

		$autoid['oa_id'] = isset($autoid['oa_id']) ? $autoid['oa_id'] : '';
		return 'OA-'.$year_string.'-'.($autoid['oa_id']+1);
	}
    public function get_report_result()
    {
    	$this->db->select('sum(tbl_oa.oa_grd_ttl) as grand_total_view');
    	$this->db->from('tbl_oa');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_result_sub()
    {
    	$this->db->select('sum(tbl_oa_item.oai_itm_ftotal) as sub_total_view');
    	$this->db->from('tbl_oa_item');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_tax()
    {
    	$this->db->select('sum(tbl_oa_itax.sqit_tax_amount) as grand_tax_amount');
    	$this->db->from('tbl_oa_itax');
    	$query = $this->db->get();
		return $query->result_array();
    }
    public function get_inqno_wise()
    {
    	$this->db->select('*');
		$this->db->from('tbl_oa');
		$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_oa.vendor','left');
		$this->db->order_by('tbl_oa.oa_id','DESC');
    	$query = $this->db->get();
		return $query->result_array();
    }

    public function delete($id)
    {
		$this->db->set('oa_isdeleted', 1);
		$this->db->where('oa_id', $id);
		$this->db->update('tbl_oa');
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
 	public function delete_select_item($id)
    {
    	//echo $id; die;
		$this->db->set('oai_isdeleted','1');
		$this->db->where('oai_id', $id);
		$this->db->update('tbl_oa_item'); 
	}
	public function get_cust($id)
	{
		//echo $this->input->post('cust_detail_id');die;
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->where('master_party_name',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_parentsources()
	{
		$query = $this->db->get_where('tbl_source_cat',array('source_main_cat'=>0));
		return $query->result_array();
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
	
	

	function get_customer_information($q)
	{
		$sql = "SELECT * from tbl_master_party WHERE UPPER(master_party_name) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%'";
		$query = $this->db->query($sql);
		
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['master_party_name']));
				$new_row['value']=htmlentities(stripslashes($row['master_party_name']));
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
	
	/*msd code start*/
	public function get_uquotedata($idenc)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa');
		$this->db->join('tbl_oa_item', 'tbl_oa.oa_id = tbl_oa_item.oai_oale_quotation_id');
		$this->db->join('tbl_master_item','tbl_oa_item.oai_itm_name = tbl_master_item.master_item_id');
		$this->db->where('oa_id', $idenc);
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
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
    public function get_item_data($id)
    {
    	//echo "$id";die;
    	$this->db->select('*');
		$this->db->from('tbl_oa_item');
		$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_oa_item.oai_itm_hsncode','left');
		$this->db->where('oai_oale_quotation_id',$id);
		$this->db->where('oai_isdeleted',0);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
    }

    public function sales_qoute_report()
	{
		$this->db->select('*');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_oa');
		$this->db->join('tbl_mode_inquiry','tbl_oa.oa_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_oa.oa_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_oa.oa_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_oa.oa_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_admin_users','tbl_sales_enq.sq_end_st = tbl_admin_users.aus_Id');
		$this->db->where('oa_isdeleted','0');
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->order_by('tbl_oa.oa_id','DESC');
		if($this->input->get('vendor')){
			$this->db->where('tbl_oa.oa_id', $this->input->get('vendor'));
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
			$this->db->where('oa_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('oa_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_oa.oa_country',$this->input->get('country'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_oa.oa_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_oa.oa_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_oa.oa_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_oa.oa_inq_st',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_oa.oa_inq_st',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_oa.oa_inq_st',3);
			}
			if($this->input->get('status') == 0)
			{
				$this->db->where('tbl_oa.oa_inq_st',0);
			}
			
		}
		//********************************************************************************************
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('oa_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('order_customer_name') && ($this->input->post('order_customer_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('order_customer_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('oa_inq_by', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('mode_of_inq') && ($this->input->post('mode_of_inq') != ''))
        {
           $this->db->like('oa_mode_inq', $this->input->post('mode_of_inq'));   
        }
         if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('sq_email', $this->input->post('status'));   
        }
         if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('oa_priority', $this->input->post('priority'));   
        }
        if($this->input->post('remark') && ($this->input->post('remark') != ''))
        {
           $this->db->like('oa_remarks', $this->input->post('remark'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('oa_mobile', $this->input->post('mobile_no'));   
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
           $this->db->like('oa_enq_date', $stdate);   
        }
         if($this->input->post('reffered_by') && ($this->input->post('reffered_by') != ''))
        {
           $this->db->like('oa_referred_by', $this->input->post('reffered_by'));   
        }
         if($this->input->post('inquiry_cdate') && ($this->input->post('inquiry_cdate') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_cdate')));
           $this->db->like('oa_cdate', $stdate);   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	
	public function count()
	{
		$value = array();
        $this->db->select('count(tbl_salesq_followup.fu_id) as cnt');
        $this->db->from('tbl_oa');
        $this->db->join('tbl_salesq_followup','tbl_salesq_followup.fu_inq_id = tbl_oa.oa_id');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_oa.oa_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
        $this->db->where('tbl_oa.oa_isdeleted','0');
        $query = $this->db->get();
        $value['task'] = $query->row_array();
        return $value;
	}
	

	public function delete_itms($id,$oa_id)
    {
		$this->db->set('oai_isdeleted',1);
		$this->db->where('oai_id', $id);
		$this->db->update('tbl_oa_item'); 

		$this->db->select('SUM(oai_itm_total) as count');
        		$this->db->from('tbl_oa_item');
        		$this->db->where('oai_oale_quotation_id',$oa_id);
        		$this->db->where_in('oai_isdeleted',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'oa_grd_ttl' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('oa_id',$oa_id);
				$this->db->update('tbl_oa',$item);

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Order Acceptance',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
	public function oatopi()
	{
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$enuserid=$this->session->userdata['miconlogin']['userid'];
		$userid= $this->encrypt_decrypt('decrypt', $enuserid);
		$get_array = $id;
		//echo "<pre>";print_r($id);die;
		if($get_array!='')
		{
				$value = array();
				$this->db->select('*');
				$this->db->from('tbl_oa');
				$this->db->where('oa_id',$id);
				$query = $this->db->get();
				$value['salesoa'] = $query->row_array();
				//echo '<pre>';print_r($value['salesoa']);die;
				$this->db->select('oa_id');
				$this->db->from('tbl_oa');
				$this->db->order_by('oa_id','DESC');
				$this->db->limit(1);
				$query = $this->db->get();
				$autoid = $query->row_array();
				$this->db->select('*');
				$this->db->from('tbl_prefix');
				//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
				$query = $this->db->get();
				$code = $query->row_array();
				$autoid['pi_id'] = isset($autoid['pi_id']) ? $autoid['pi_id'] : '';
			    $code['pre_pi'].''.($autoid['pi_id']+1); 
			    $item = array(
						'pi_no' =>$code['pre_pi'].''.($autoid['pi_id']+1),
						'po_no' =>$code['pre_pi'].''.($autoid['pi_id']+1),
						'pi_oa_no' => $value['salesoa']['oa_sa_no'],
						'po_enq_date' => date("Y-m-d", strtotime($value['salesoa']['oa_enq_date'])),
						'vendor' => $value['salesoa']['vendor'],
						//'sa_cus_type' => $value['salesoa']['sq_cust_type'],
						'pi_address' => $value['salesoa']['oa_address'],
						'pi_country' => $value['salesoa']['oa_country'],
						'pi_state' => $value['salesoa']['oa_state'],
						'pi_city' => $value['salesoa']['oa_city'],
						'pi_brand' => $value['salesoa']['oa_brand'],
						'pi_con_person' => $value['salesoa']['oa_con_person'],
						'pi_mobile' => $value['salesoa']['oa_mobile'],
						'pi_phone' => $value['salesoa']['oa_phone'],
						'pi_email' => $value['salesoa']['oa_email'],
						'pi_website' => $value['salesoa']['oa_website'],
						'pi_gst' =>$value['salesoa']['oa_gstno'],
						'pi_source_cat' => $value['salesoa']['oa_source_cat'],
						'pi_subsource_cat' => $value['salesoa']['oa_subsource_cat'],
						'pi_mode_inq' => $value['salesoa']['oa_mode_inq'],
						'pi_subject' => $value['salesoa']['oa_subject'],
						'pi_priority' => $value['salesoa']['oa_priority'],
						'pi_inq_st' => $value['salesoa']['oa_inq_st'],
						'pi_prepared_by' => $userid,
						'pi_ref_by' => $value['salesoa']['oa_ref_by'],
						//'sq_attach' => $data['sq_attach'],
						//'sq_grd_ttl_words' => $data['grdttlinword'],
						'pi_remarks' => $value['salesoa']['oa_remarks'],
						'pi_term' => $value['salesoa']['oa_term'],
						//'sa_rem_date' => date("Y-m-d", strtotime($value['salesoa']['sq_rem_date'])),
						'pi_cid' => $userid,
						// 'oa_isdeleted' => 0,
						'pi_cdate' => date('Y-m-d H:i:s'),
						'pi_udate' => date('Y-m-d H:i:s')
						);
						//echo '<pre>';print_r($item);die;
					$this->db->insert('tbl_pi',$item);
					$lid = $this->db->insert_id();

					//echo '<pre>';print_r($get_array);die;
			$this->db->select('*');
			$this->db->from('tbl_oa_item');
			$this->db->where_in('oai_oale_quotation_id',$id);
			$this->db->where('oai_isdeleted','0');
			$query = $this->db->get();
			$data['oaitm'] = $query->result_array();
			//echo '<pre>';print_r($data['oaitm']);die;
			if(isset($data['oaitm']) && !empty($data['oaitm']) && $data['oaitm'] != '')
			{
				foreach($data['oaitm'] as $key => $itm)
				{
				$item = array(
						'pii_itm_title' => $itm['oai_itm_title'],
						'pii_oale_quotation_id' => $lid,
							'pii_itm_name' => $itm['oai_itm_name'],
							'pii_itm' => $itm['oai_itm'],
							//'pi_itm_currency' => $data['item_currency'][$key],
							'pii_itm_qty' => $itm['oai_itm_qty'],
							//'pi_itm_unit' => $data['item_unit'][$key],
							//'pi_itm_desc' => $data['item_desc'][$key],
							//'pi_itm_price' => $data['item_price'][$key],
							//'pi_itm_days' => $data['item_days'][$key],
							// 'pi_itm_roe' => $data['item_roe'][$key],
							// 'pi_itm_total' => $data['item_total'][$key],
							// 'pi_itm_discount' => $data['item_discount'][$key],
							// 'pi_itm_ftotal' => $data['item_ftotal'][$key],
							// 'pi_itm_tax' => $data['item_tax'][$key],
							'pii_hsncode' => $itm['oai_itm_hsncode'],
							'pii_itm_stock' => $itm['oai_itm_stock'],
							'pii_itm_opn_qty' => $itm['oai_itm_opn_qty'],
							'pii_itm_price' => $itm['oai_itm_price'],
							'pii_itm_discount' => $itm['oai_itm_discount'],
							'pii_itm_total' => $itm['oai_itm_total'],
							'pii_hsncode' => $itm['oai_itm_hsncode'],
							//'pii_itm_cid' => $userid,
							'pii_item_udate' => date('Y-m-d H:i:s')
						);
					//echo'<pre>';print_r($item);die;
					$this->db->insert('tbl_pi_item',$item);
					}
			}

			return $lid;



		}

				
	}
		public function get_all_hsns()
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$query = $this->db->get();
		$value = $query->result_array();
		return $value;
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
	public function get_edit_inqitems($id,$itemid)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa_item');
		$this->db->where('oai_oale_quotation_id',$id);
		$this->db->where('oai_id',$itemid);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function work_order()
	{
		$id = $this->uri->segment(3) ? $this->encrypt_decrypt('decrypt', $this->uri->segment(3)) : '';
		$enuserid=$this->session->userdata['miconlogin']['userid'];
		$userid= $this->encrypt_decrypt('decrypt', $enuserid);
		$get_array = $id;
		//echo "<pre>";print_r($id);die;
		if($get_array!='')
		{
				$value = array();
				$this->db->select('*');
				$this->db->from('tbl_oa');
				$this->db->where('oa_id',$id);
				$query = $this->db->get();
				$value['salesoa'] = $query->row_array();
				//echo '<pre>';print_r($value['salesoa']);die;
				$this->db->select('wo_id');
				$this->db->from('tbl_work_order');
				$this->db->order_by('wo_id','DESC');
				$this->db->limit(1);
				$query = $this->db->get();
				$autoid = $query->row_array();
				//echo '<pre>';print_r($autoid);die;
				$this->db->select('*');
				$this->db->from('tbl_prefix');
				//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
				$query = $this->db->get();
				$code = $query->row_array();

				$autoid['wo_id'] = isset($autoid['wo_id']) ? $autoid['wo_id'] : '';
			    $code['pre_pi'].''.($autoid['wo_id']+1); 
			    
			    $item = array(
						'wo_no' =>$code['pre_wo'].''.($autoid['wo_id']+1),
						'wo_oa_no' => $value['salesoa']['oa_sa_no'],
						'wo_enq_date' => date("Y-m-d", strtotime($value['salesoa']['oa_enq_date'])),
						'vendor' => $value['salesoa']['vendor'],
						//'sa_cus_type' => $value['salesoa']['sq_cust_type'],
						'wo_address' => $value['salesoa']['oa_address'],
						'wo_country' => $value['salesoa']['oa_country'],
						'wo_state' => $value['salesoa']['oa_state'],
						'wo_city' => $value['salesoa']['oa_city'],
						'wo_brand' => $value['salesoa']['oa_brand'],
						'wo_con_person' => $value['salesoa']['oa_con_person'],
						'wo_mobile' => $value['salesoa']['oa_mobile'],
						'wo_phone' => $value['salesoa']['oa_phone'],
						'wo_email' => $value['salesoa']['oa_email'],
						'wo_website' => $value['salesoa']['oa_website'],
						'wo_gst' =>$value['salesoa']['oa_gstno'],
						'wo_source_cat' => $value['salesoa']['oa_source_cat'],
						'wo_subsource_cat' => $value['salesoa']['oa_subsource_cat'],
						'wo_mode_inq' => $value['salesoa']['oa_mode_inq'],
						'wo_subject' => $value['salesoa']['oa_subject'],
						'wo_priority' => $value['salesoa']['oa_priority'],
						'wo_inq_st' => $value['salesoa']['oa_inq_st'],
						'wo_prepared_by' => $userid,
						'wo_sales_dept_bit' => '1',
						'wo_ref_by' => $value['salesoa']['oa_ref_by'],
						//'sq_attach' => $data['sq_attach'],
						//'sq_grd_ttl_words' => $data['grdttlinword'],
						'wo_remarks' => $value['salesoa']['oa_remarks'],
						'wo_term' => $value['salesoa']['oa_term'],
						//'sa_rem_date' => date("Y-m-d", strtotime($value['salesoa']['sq_rem_date'])),
						'wo_cid' => $userid,
						// 'oa_isdeleted' => 0,
						'wo_cdate' => date('Y-m-d H:i:s'),
						'wo_udate' => date('Y-m-d H:i:s')
						);
						//echo '<pre>';print_r($item);die;
					$this->db->insert('tbl_work_order',$item);
					$lid = $this->db->insert_id();
					//echo '<pre>';print_r($get_array);die;
			$this->db->select('*');
			$this->db->from('tbl_oa_item');
			$this->db->where_in('oai_oale_quotation_id',$id);
			$this->db->where('oai_isdeleted','0');
			$query = $this->db->get();
			$data['oaitm'] = $query->result_array();
			//echo '<pre>';print_r($data['oaitm']);die;
			if(isset($data['oaitm']) && !empty($data['oaitm']) && $data['oaitm'] != '')
			{
				foreach($data['oaitm'] as $key => $itm)
				{
				$item = array(
							'woi_itm_title' => $itm['oai_itm_title'],
							'woi_oale_quotation_id' => $lid,
							'woi_itm_name' => $itm['oai_itm_name'],
							'woi_itm_part_no' => $itm['oai_itm'],
							'woi_itm_qty' => $itm['oai_itm_qty'],
							//'pi_itm_unit' => $data['item_unit'][$key],
							//'pi_itm_desc' => $data['item_desc'][$key],
							//'pi_itm_price' => $data['item_price'][$key],
							//'pi_itm_days' => $data['item_days'][$key],
							// 'pi_itm_roe' => $data['item_roe'][$key],
							// 'pi_itm_total' => $data['item_total'][$key],
							// 'pi_itm_discount' => $data['item_discount'][$key],
							// 'pi_itm_ftotal' => $data['item_ftotal'][$key],
							// 'pi_itm_tax' => $data['item_tax'][$key],
							'woi_itm_hsncode' => $itm['oai_itm_hsncode'],
							'woi_itm_stock' => $itm['oai_itm_stock'],
							'woi_itm_opn_qty' => $itm['oai_itm_opn_qty'],
							'woi_itm_price' => $itm['oai_itm_price'],
							'woi_itm_dic' => $itm['oai_itm_discount'],
							'woi_itm_ftotal' => $itm['oai_itm_total'],
							'woi_itm_cid' => $userid,
							'woi_item_udate' => date('Y-m-d H:i:s')
						);
					//echo'<pre>';print_r($item);die;
					$this->db->insert('tbl_work_order_item',$item);
					}
			}
			return $lid;
		}
	
	}
	
}
?>