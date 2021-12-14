<?php 

class Master_party_model extends CI_Model {
	
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
			'sqm_from' => $data['sqm_from'],
			'sqm_to' => $data['sqm_to'],
			'sqm_to_cc' => $data['sqm_to_cc'],
			'sqm_sub' => $data['sqm_sub'],
			'sqm_attch' => json_encode($data['files']),
			'sqm_body' => $data['sqm_body'],
			'sqm_udate' => date("Y-m-d"),
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_sale_quotation_mail',$item);
		return $this->db->insert_id();
	}

	public function item_img($data)
	{
		//echo "<pre>"; print_r($data); die;
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		$this->db->where('master_item_id',$data['sai_itm']);
		$this->db->where('master_item_img','');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($data)
	{
		if($this->uri->segment(3))
		{

			$id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
			$item = array(
			'master_party_com_name' => $data['master_party_com_name'],
			'master_party_contact' => $data['master_party_contact'],
			'master_party_cust_type' => $data['master_party_cust_type'],
			'master_party_location' => $data['master_party_location'],
			'master_party_country' => $data['master_party_country'],
			'master_party_currency' => $data['master_party_currency'],
			'master_party_state' => $data['master_party_state'],
			'master_party_city' => $data['master_party_city'],
			'master_party_email_address' => $data['master_party_email_address'],
			'master_party_mobile_no' => $data['master_party_mobile_no'],
			'master_party_office_no' => $data['master_party_office_no'],
			'master_party_fax_no' => $data['master_party_fax_no'],
			'master_party_website' => $data['master_party_website'],
			'master_party_office_address' => $data['master_party_office_address'],
			'master_party_billing_address' => $data['master_party_billing_address'],
			'master_party_shipping_address' => $data['master_party_shipping_address'],
			'master_party_pincode' => $data['master_party_pincode'],
			'master_party_gst' => $data['master_party_gst'],
			'master_party_tax' => $data['master_party_tax'],

			'master_party_docdone' => $data['master_party_docdone'],
			'master_party_typeindustries' => $data['master_party_typeindustries'],


			'master_party_co_ai'=> isset($data['master_party_co_ai']) ? $data['master_party_co_ai'] : '',
			'master_party_remark'=> isset($data['master_party_remark']) ? $data['master_party_remark'] : '',
			'master_party_pastcomment'=> isset($data['master_party_pastcomment']) ? $data['master_party_pastcomment'] : '',
			'master_party_cdate' =>date("Y-m-d", strtotime($data['master_party_cdate'])),
			'master_party_udate' => date("Y-m-d", strtotime($data['master_party_udate']))
			);
			$this->db->where('master_party_id', $id);
			$this->db->update('tbl_master_party',$item); 
			//die;
			$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Master Party Edit',
					'adlog_edit' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		
		$lid = $id;

		}
		else{
			//echo '<pre>';print_r($data);die;
			$item = array(
			'master_party_com_name' => $data['master_party_com_name'],
			'master_party_contact' => $data['master_party_contact'],
			'master_party_cust_type' => $data['master_party_cust_type'],
			'master_party_location' => $data['master_party_location'],
			'master_party_country' => $data['master_party_country'],
			'master_party_currency' => $data['master_party_currency'],
			'master_party_state' => $data['master_party_state'],
			'master_party_city' => $data['master_party_city'],
			'master_party_email_address' => $data['master_party_email_address'],
			'master_party_mobile_no' => $data['master_party_mobile_no'],
			'master_party_office_no' => $data['master_party_office_no'],
			'master_party_fax_no' => $data['master_party_fax_no'],
			'master_party_website' => $data['master_party_website'],
			'master_party_office_address' => $data['master_party_office_address'],
			'master_party_billing_address' => $data['master_party_billing_address'],
			'master_party_shipping_address' => $data['master_party_shipping_address'],
			'master_party_pincode' => $data['master_party_pincode'],
			'master_party_gst' => $data['master_party_gst'],
			'master_party_tax' => $data['master_party_tax'],

			'master_party_docdone' => $data['master_party_docdone'],
			'master_party_typeindustries' => $data['master_party_typeindustries'],

			'master_party_co_ai'=> isset($data['master_party_co_ai']) ? $data['master_party_co_ai'] : '',
			'master_party_pastcomment'=> isset($data['master_party_pastcomment']) ? $data['master_party_pastcomment'] : '',
			'master_party_remark'=> isset($data['master_party_remark']) ? $data['master_party_remark'] : '',
			'master_party_cdate' =>date("Y-m-d", strtotime($data['master_party_cdate'])),
			'master_party_udate' => date("Y-m-d", strtotime($data['master_party_udate']))
			);
		//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_master_party',$item);
		$lid = $this->db->insert_id();
		
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Master Party Add',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		}
		return $lid;	
	}

	public function importcsv($data)
	{
		//echo '<pre>';print_r($data);die;

		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->where('master_party_com_name',$data['COMPANY NAME']);
		$query = $this->db->get();
		$c_data = $query->row_array();
		//echo '<pre>';print_r($c_data);die;

		if($c_data['master_party_id'] == 0 || $c_data['master_party_id'] == '')
		{
			$this->db->select('ctype_id');
			$this->db->from('tbl_customer_type');
			$this->db->where('ctype_name',$data['TYPE OF INDUSTRIES']);
			$query = $this->db->get();
			$ctype_data = $query->row_array();

			if($ctype_data['ctype_id'] == 0)
			{
				$item = array(
					'ctype_name' => $data['TYPE OF INDUSTRIES'],
					'ctype_cdate' => date('Y-m-d H:i:s'),
					'ctype_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item);die;
				$this->db->insert('tbl_customer_type',$item);
				$ctype_data['ctype_id'] = $this->db->insert_id();
			}
			//echo '<pre>';print_r($ctype_data['ctype_id']);die;
			$item = array(
				'master_party_com_name' => isset($data['COMPANY NAME']) ? $data['COMPANY NAME'] : '',
				'master_party_contact' => isset($data['CONTACT PERSON']) ? $data['CONTACT PERSON'] : '',
				'master_party_contact_department' => isset($data['DEPARMANT']) ? $data['DEPARMANT'] : '',
				'master_party_contact_designation' => isset($data['DESIGNATION']) ? $data['DESIGNATION'] : '',
				'master_party_co_ai'=> isset($data['C/O AAVAD INSTRUMENT']) ? $data['C/O AAVAD INSTRUMENT'] : '',
				'master_party_pastcomment'=> isset($data['PAST COMMENTS']) ? $data['PAST COMMENTS'] : '',
				'master_party_docdone'=> isset($data['DOCUMENTATION DONE']) ? $data['DOCUMENTATION DONE'] : '',
				'master_party_typeindustries'=> isset($data['TYPE OF INDUSTRIES']) ? $data['TYPE OF INDUSTRIES'] : '',
				'master_party_email_address' => isset($data['E-MAIL ID']) ? $data['E-MAIL ID'] : '',
				'master_party_mobile_no' => isset($data['MOBILE NUMBER']) ? $data['MOBILE NUMBER'] : '',
				'master_party_office_no' => isset($data['PHONE NUMBER']) ? $data['PHONE NUMBER'] : '',
				'master_party_location' => isset($data['LOCATION']) ? $data['LOCATION'] : '',
				'master_party_remark' => isset($data['REMARKS']) ? $data['REMARKS'] : '',
				'master_party_cust_type' => isset($ctype_data['ctype_id']) ? $ctype_data['ctype_id'] : 0,
				'master_party_office_address' => isset($data['ADDRESS']) ? $data['ADDRESS'] : '',
				'master_party_billing_address' => isset($data['ADDRESS']) ? $data['ADDRESS'] : '',
				'master_party_shipping_address' => isset($data['ADDRESS']) ? $data['ADDRESS'] : '',
				'master_party_cdate' => date('Y-m-d H:i:s'),
				'master_party_udate' => date('Y-m-d H:i:s')
				);
			//echo '<pre>';print_r($item);die;
			$this->db->insert('tbl_master_party',$item);
			$lid = $this->db->insert_id();

			$item = array(
						'contact_master_id' => $lid,
						'contact_pname' => isset($data['CONTACT PERSON']) ? $data['CONTACT PERSON'] : '',
						'contact_designation' => isset($data['DESIGNATION']) ? $data['DESIGNATION'] : '',
						'contact_department' => isset($data['DEPARMANT']) ? $data['DEPARMANT'] : '',
						'contact_mobile'=> isset($data['MOBILE NUMBER']) ? $data['MOBILE NUMBER'] : '',
						'contact_phone'=> isset($data['PHONE NUMBER']) ? $data['PHONE NUMBER'] : '',
						'contact_email'=> isset($data['E-MAIL ID']) ? $data['E-MAIL ID'] : '',
						'contact_address' => isset($data['ADDRESS']) ? $data['ADDRESS'] : '',
						'contact_location' => isset($data['LOCATION']) ? $data['LOCATION'] : '',
						'contact_cdate' => date('Y-m-d H:i:s'),
						'contact_udate' => date('Y-m-d H:i:s')
				);
				//echo '<pre>';print_r($item);die;
			$this->db->insert('tbl_master_contactperson',$item);
			$lid = $this->db->insert_id();
		}else if($c_data['master_party_id'] != '')
		{
			//echo '<pre>';print_r($c_data);die;
			$item = array(
						'contact_master_id' => $c_data['master_party_id'],
						'contact_pname' => isset($data['CONTACT PERSON']) ? $data['CONTACT PERSON'] : '',
						'contact_designation' => isset($data['DEPARMANT']) ? $data['DEPARMANT'] : '',
						'contact_mobile'=> isset($data['MOBILE NUMBER']) ? $data['MOBILE NUMBER'] : '',
						'contact_phone'=> isset($data['PHONE NUMBER']) ? $data['PHONE NUMBER'] : '',
						'contact_email'=> isset($data['E-MAIL ID']) ? $data['E-MAIL ID'] : '',
						'contact_address' => isset($data['ADDRESS']) ? $data['ADDRESS'] : '',
						'contact_location' => isset($data['LOCATION']) ? $data['LOCATION'] : '',
						'contact_cdate' => date('Y-m-d H:i:s'),
						'contact_udate' => date('Y-m-d H:i:s')
				);
				//echo '<pre>';print_r($item);die;
			$this->db->insert('tbl_master_contactperson',$item);
			$lid = $this->db->insert_id();

			if(isset($data['REMARKS']) && ($data['REMARKS'] != ''))
			{
				$update = array(
					'master_party_pastcomment'=> isset($data['PAST COMMENTS']) ? $data['PAST COMMENTS'] : '',
					'master_party_remark' => isset($data['REMARKS']) ? $data['REMARKS'] : ''
				);
				$this->db->where('master_party_id',$c_data['master_party_id']);
				//echo '<pre>';print_r($item);die;
				$this->db->update('tbl_master_party',$update);
			}
		}
		
	}

	public function other_add($data,$id)
	{
		//echo "<pre>"; print_r($data); die;
		$item = array(
			
			'sale_quotation_term' => $data['sale_quotation_desc'],
			'sa_tc_price' => $data['sa_tc_price'],
			'sa_tc_wrnty' => $data['sa_tc_wrnty'],
			'sa_tc_pf' => $data['sa_tc_pf'],
			'sa_tc_deli' => $data['sa_tc_deli'],
			'sa_tc_paynt' => $data['sa_tc_paynt'],
			'sa_tc_ovali' => $data['sa_tc_ovali'],
			'sa_tc_frght' => $data['sa_tc_frght'],
			'sa_tc_gst' => $data['sa_tc_gst'],
			'sa_remarks' => $data['sa_remarks'],
			'sa_isdiscount' => $data['sa_isdiscount'],
			'sa_udate' => $data['sa_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('sa_id', $id);
		$this->db->update('tbl_sale_quotation', $item); 
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
		return $id;
	}
	public function item_add($data,$enid)
	{
		//echo "<pre>"; print_r($enid); die;
		//$qid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item = array(
					'contact_master_id' => $enid,
					'contact_pname' => $data['contact_pname'],
					'contact_designation' => $data['contact_designation'],
					'contact_department' => $data['contact_department'],
					'contact_mobile'=> $data['contact_mobile'],
					'contact_email'=> $data['contact_email'],
					'contact_phone'=> $data['contact_phone'],
					'contact_address'=> $data['contact_address'],
					'contact_location '=> $data['contact_location'],
					'contact_remark '=> $data['contact_remark'],
					'contact_cdate' => date('Y-m-d H:i:s'),
					'contact_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_master_contactperson',$item);
		$lid = $this->db->insert_id();
		
		$this->db->set('contact_remarkdtlog', "CONCAT(contact_remarkdtlog,', ', '".$data['contact_remark']." dt:".date('Y-m-d H:i:s')."</br>"."')", FALSE);
		$this->db->where('contact_id',$lid);
		$this->db->update('tbl_master_contactperson');
		//echo "<pre>";print_r($id);die;
		return $enid;
	}
	public function follow_add($data,$id)
	{
		$item = array(
					'fu_inq_id' => $id,
					'fu_followdate' => date("Y-m-d", strtotime($data['fu_followdate'])),
					'fu_followmethod' => $data['fu_followmethod'],
					'fu_followexe' => $data['fu_followexe'],
					'fu_followupst' => $data['fu_followupst'],
					'fu_remark' => $data['fu_remark'],
					'fu_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_sale_quotation_followup',$item);
		$lid = $this->db->insert_id();
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
		return $id;
	}
	public function edit($data,$id)
	{ 
		if(isset($data['sa_brand']) && $data['sa_brand'] != ''){
			$aus_home = json_encode($data['sa_brand']);
		}
		else{
			$aus_home = '';
		}
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'sa_no' => $data['sa_no'],
			'sa_enq_date' => date("Y-m-d", strtotime($data['sa_enq_date'])),
			'vendor' => $data['vendor'],
			'sa_remarks' => $data['sa_remarks'],
			'sa_address' => $data['sa_address'],
			'sa_country' => $data['sa_country'],
			'sa_state' => $data['sa_state'],
			'sa_city' => $data['sa_city'],
			'sa_brand' => $aus_home,
			'sa_con_person' => $data['sa_con_person'],
			'sa_email' => $data['sa_email'],
			'sa_phone' => $data['sa_phone'],
			'sa_mobile' => $data['sa_mobile'],
			'sa_website' => $data['sa_website'],
			'sa_rem_date' => date("Y-m-d", strtotime($data['sa_rem_date'])),
			'sa_rem_be_date' => $data['sa_rem_be_date'],
			// 'sa_mode_inq' => $data['sa_mode_inq'],
			'sa_inq_st' => $data['sa_inq_sts'],
			'sa_priority' => $data['sa_inq_priority'],
			'sa_source_cat' => $data['sa_source_cat'],
			'sa_subsource_cat' => $data['sa_subsource_cat'],
			// 'sa_end_st' => $data['sa_end_st'],
			// //'sa_party_tax' => $data['sa_party_tax'],
			// 'sa_ref_by' => $data['sa_ref_by'],
			// //'sa_attach' => $data['sa_attach'],
			 'sale_quotation_term' => $data['sale_quotation_desc'],
			// 'sa_sub_ttl' => $data['itm_subttl'],
			// 'sa_grd_ttl' => $data['itm_grdttl'],
			// 'sa_grd_ttl_words' => $data['grdttlinword'],
			//'sa_cid' => $this->session->userdata['login']['aus_Id'],
			'sa_udate' => $data['sa_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('sa_id', $id);
		//$this->db->where('sa_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_sale_quotation', $item); 
		//$lid = $this->input->get('id');
		$this->db->delete('tbl_sale_quotation_item',array('sai_sale_quotation_id' => $id));
		//$this->db->delete('tbl_sale_quotation_itax',array('sqit_pid' => $lid));
		//echo '<pre>'; print_r($data['mequot_detail_item']); die;
		if(isset($data['mequot_detail_item']) && !empty($data['mequot_detail_item']))
		foreach ($data['mequot_detail_item'] as $key => $mequot_detail_item) {
			if($mequot_detail_item != '' && $data['mequot_desc'][$key] != '')
			{
				$item1 = array(
					'sai_sale_quotation_id' => $id,
					'sai_itm_name' => $mequot_detail_item,
					'sai_itm_desc'=> $data['mequot_desc'][$key],
					'sai_itm_qty'=> $data['mequot_qty'][$key],
					'sai_itm_price'=> $data['mequot_rate'][$key],
					'sai_itm_discount'=> $data['mequot_dis'][$key],
					'sai_itm_total'=> $data['mequot_ftotl'][$key],
					'sai_item_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1);
				$this->db->insert('tbl_sale_quotation_item',$item1);

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
		$this->db->from('tbl_master_party');
		//$this->db->join('tbl_master_party','tbl_sale_quotation.vendor = tbl_master_party.master_party_id');
		$this->db->where('master_party_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_excel_certificate()
	{
		$this->db->select('master_party_co_ai,master_party_docdone,ctype_name,contact_location,master_party_com_name,contact_pname,contact_department,contact_address,master_party_pincode,contact_phone,contact_mobile,contact_email,contact_remark,master_party_typeindustries');
		$this->db->from('tbl_master_party');
		$this->db->join('tbl_customer_type','tbl_customer_type.ctype_id = tbl_master_party.master_party_cust_type','left');
		$this->db->join('tbl_master_contactperson','tbl_master_contactperson.contact_master_id = tbl_master_party.master_party_id','left');
		$this->db->where('master_party_isdelete',0);
    	$this->db->where('tbl_master_contactperson.contact_isdelete',0);
		$this->db->order_by('master_party_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_Master_party_report()
	{
		$this->db->select('tbl_master_party.*,tbl_customer_type.*, tbl_master_contactperson.*');
		$this->db->from('tbl_master_party');
		$this->db->join('tbl_customer_type','tbl_customer_type.ctype_id = tbl_master_party.master_party_cust_type','left');
		$this->db->join('tbl_master_contactperson','tbl_master_contactperson.contact_master_id = tbl_master_party.master_party_id','left');
		if($this->input->post('master_party_code') && ($this->input->post('master_party_code') != ''))
        {
           $this->db->like('master_party_code', $this->input->post('master_party_code'));   
        }
        if($this->input->post('master_party_com_name') && ($this->input->post('master_party_com_name') != ''))
        {
           $this->db->like('master_party_com_name', $this->input->post('master_party_com_name'));   
        }
         if($this->input->post('master_party_office_address') && ($this->input->post('master_party_office_address') != ''))
        {
           $this->db->like('contact_address', $this->input->post('master_party_office_address'));   
        }
         if($this->input->post('master_party_location') && ($this->input->post('master_party_location') != ''))
        {
           $this->db->like('contact_location', $this->input->post('master_party_location'));   
        }
         if($this->input->post('master_party_docdone') && ($this->input->post('master_party_docdone') != ''))
        {
           $this->db->like('master_party_docdone', $this->input->post('master_party_docdone'));   
        }
         if($this->input->post('ctype_name') && ($this->input->post('ctype_name') != ''))
        {
           $this->db->like('ctype_name', $this->input->post('ctype_name'));   
        }
        if($this->input->post('master_party_co_ai') && ($this->input->post('master_party_co_ai') != ''))
        {
           $this->db->like('master_party_co_ai', $this->input->post('master_party_co_ai'));   
        }
        if($this->input->post('master_party_cpersondata') && ($this->input->post('master_party_cpersondata') != ''))
        {
           $this->db->like('contact_pname', $this->input->post('master_party_cpersondata'));   
        }
        if($this->input->post('master_party_remark') && ($this->input->post('master_party_remark') != ''))
        {
           $this->db->like('contact_remark', $this->input->post('master_party_remark'));   
        }
         if($this->input->post('master_party_email_address') && ($this->input->post('master_party_email_address') != ''))
        {
          //$this->db->join('tbl_master_contactperson','tbl_master_contactperson.contact_master_id = tbl_master_party.master_party_id','left');
          $this->db->like('contact_email', $this->input->post('master_party_email_address')); 
          
          // $this->db->like('master_party_email_address', $this->input->post('master_party_email_address'));   
        }
        if($this->input->post('master_party_mobile_no') && ($this->input->post('master_party_mobile_no') != ''))
        {
          //  die;
          //$this->db->join('tbl_master_contactperson','tbl_master_contactperson.contact_master_id = tbl_master_party.master_party_id','left');
          $this->db->like('contact_mobile', $this->input->post('master_party_mobile_no')); 
          //$this->db->where('contact_isdelete',0);
           //$this->db->like('master_party_mobile_no', $this->input->post('master_party_mobile_no'));   
        }
        $this->db->where('contact_isdelete',0);
        $this->db->where('master_party_isdelete',0);
        $this->db->order_by('master_party_id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_all_tax()
	{
		$this->db->select('in_tax_name, sum(in_tax_amount) as total_taxval');
		$this->db->group_by('in_tax_name'); 
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_sale_quotation_tax','tbl_sale_quotation.inv_id = tbl_sale_quotation_tax.in_invid');
		//$this->db->where('inv_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_tax_gst()
	{
		$this->db->select('SUM(tbl_sale_quotation_itax.sqit_tax_amount) as total,UPPER(tbl_sale_quotation_itax.sqit_tax_name) as tax_name, tbl_sale_quotation_itax.*');
		//SUM(IF(itmtax_tax_name = 'CGST', itmtax_tax_amount, 0)) AS 'CGST',
		$this->db->from('tbl_sale_quotation_itax');
		//$this->db->join('tbl_invoice_itmtax','tbl_invoice_item.invi_id = tbl_invoice_itmtax.itmtax_invi_id');
		//$this->db->join('tbl_invoice','tbl_invoice.inv_id = tbl_invoice_itmtax.itmtax_invid');
		$this->db->group_by('tax_name');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Master_partyno_wise()
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		//$this->db->join('tbl_master_party','tbl_sale_quotation.vendor = tbl_master_party.master_party_id');
		//$this->db->join('tbl_sale_quotation_item','tbl_sale_quotation.inv_id = tbl_sale_quotation_item.invi_inv_id');
		//$this->db->join('tbl_master_item','tbl_sale_quotation_item.invi_itm_name = tbl_master_item.master_item_id');
		//$this->db->where('sa_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->get('start_date') && ($this->input->get('start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('start_date')));
			$this->db->where('sa_cdate >=',$stdate);
		}
		if($this->input->get('end_date') && ($this->input->get('end_date') != ''))
		{
			$end_date = date("Y-m-d", strtotime($this->input->get('end_date')));
			$this->db->where('sa_cdate <=',$end_date);
		}
		if($this->input->get('party') && ($this->input->get('party') != ''))
		{
			$party = $this->input->get('party');
			$this->db->where('vendor',$party);
		}
		$this->db->order_by('tbl_sale_quotation.sa_id','DESC');
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
		$this->db->from('tbl_sale_quotation_itax');
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
		$this->db->from('tbl_sale_quotation_btax');
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
		//echo "<pre>";print_r($id);die;
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_admin_users','tbl_sale_quotation.sa_inq_by = tbl_admin_users.au_id','left');
		$this->db->join('tbl_master_city','tbl_sale_quotation.sa_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sale_quotation.sa_state = tbl_master_state.state_id','left');
		$this->db->where('tbl_sale_quotation.sa_id',$id);
		$this->db->order_by('tbl_sale_quotation.sa_id','DESC');
		$query = $this->db->get();
		$value['inv'] = $query->row_array();
		//echo "<pre>"; print_r($value['inv']); die;

		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_admin_users','tbl_sale_quotation.sa_inq_by = tbl_admin_users.au_id','left');
		$this->db->join('tbl_master_city','tbl_sale_quotation.sa_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sale_quotation.sa_state = tbl_master_state.state_id','left');
		$this->db->where('tbl_sale_quotation.sa_id',$id);
		$this->db->order_by('tbl_sale_quotation.sa_id','DESC');
		$query = $this->db->get();
		$value['currency'] = $query->row_array();

		$this->db->select('*');
		$this->db->from('tbl_sale_quotation_item');
		$this->db->join('tbl_master_item','tbl_sale_quotation_item.sai_itm_name = tbl_master_item.master_item_id');
		$this->db->where('tbl_sale_quotation_item.sai_sale_quotation_id',$id);
		$this->db->where('tbl_sale_quotation_item.sai_isdeleted','0');
		//$this->db->where('tbl_sale_quotation_item.sai_is_bom !=',1);
		//$this->db->order_by('tbl_sale_quotation_item.invi_inv_id','DESC');
		$query = $this->db->get();
		$value['items'] = $query->result_array();
		//echo "<pre>"; print_r($value['items']); die;

		return $value;
	}
	public function get_taxs_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax_category');
		//$this->db->where('city_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_items($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_contactperson');
		$this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_master_contactperson.contact_master_id');
		$this->db->where('contact_master_id',$id);
		$this->db->where('contact_isdelete',0);
		$query = $this->db->get();
		$values = $query->result_array();
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
		$this->db->from('tbl_sale_quotation_tax');
		//$this->db->where('tbl_sale_quotation_tax.sqt_tax_cid',$this->session->userdata['login']['aus_Id']);
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
		$this->db->from('tbl_sale_quotation_bom');
		$this->db->join('tbl_bom','tbl_bom.bom_id = tbl_sale_quotation_bom.sqb_bom_id');
		//$this->db->where('tbl_sale_quotation_bom.sqb_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('tbl_sale_quotation_bom.sqb_bom_id',$data['bomid']);
		$this->db->where('tbl_sale_quotation_bom.sqb_sa_id',$this->input->get('id'));
		$query = $this->db->get();
		echo '<pre>';print_r($query->result_array());die;
		return $query->row_array();
	}
	
	public function get_boms_edit()
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation_bom');
		$this->db->join('tbl_bom','tbl_bom.bom_id = tbl_sale_quotation_bom.sqb_bom_id');
		//$this->db->where('tbl_sale_quotation_bom.sqb_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('tbl_sale_quotation_bom.sqb_sa_id',$this->input->get('id'));
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
		$this->db->from('tbl_sale_quotation');
		$this->db->where('sa_id',$this->input->get('id'));
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
			'sa_enq_date' => date("Y-m-d", strtotime($item['pdetails']['sa_enq_date'])),
			'vendor' => $item['pdetails']['vendor'],
			'sa_address' => $item['pdetails']['sa_address'],
			'sa_remarks' => $item['pdetails']['sa_remarks'],
			'sa_email' => $item['pdetails']['sa_email'],
			'sa_phone' => $item['pdetails']['sa_phone'],
			'sa_mobile' => $item['pdetails']['sa_mobile'],
			'sa_brand' => $item['pdetails']['sa_brand'],
			//'sa_quotation_stu' => $item['pdetails']['remarks'],
			'sa_referred_by' => $item['pdetails']['sa_ref_by'],
			'sa_attach' => $item['pdetails']['sa_attach'],
			'sale_quotation_term' => $item['pdetails']['sale_quotation_desc'],
			'sa_sub_ttl' => $item['pdetails']['sa_sub_ttl'],
			'sa_grd_ttl' => $item['pdetails']['sa_grd_ttl'],
			'sa_grd_ttl_words' => $item['pdetails']['sa_grd_ttl_words'],
			'sa_cid' => $this->session->userdata['login']['aus_Id'],
			'sa_cdate' => date('Y-m-d H:i:s'),
			'sa_udate' =>date('Y-m-d H:i:s')
			);//echo'<pre>';print_r($item);die;
		$this->db->insert('tbl_sale_quotation',$item);
		$lid = $this->db->insert_id();
		
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation_item');
		$this->db->where('sai_sale_quotation_id',$this->input->get('id'));
		$this->db->where('sai_is_bom !=',1);
		$query = $this->db->get();
		$item['piitemdetails'] = $query->result_array();
           //echo'<pre>';print_r($item);die;
		foreach ($item['piitemdetails'] as $key => $grnitem) {
			if($grnitem['sai_itm_name'] != '' && $grnitem['sai_itm_currency'] != '')
			{
				$item = array(
					'sai_sale_quotation_id' =>$lid,
					'sai_itm_name' => $grnitem['sai_itm_name'],
					'sai_itm_grade' =>$grnitem['sai_itm_grade'],
					'sai_itm_desc' =>$grnitem['sai_itm_desc'],
					'sai_itm_qty' => $grnitem['sai_itm_qty'],
					'sai_itm_unit' => $grnitem['sai_itm_unit'],
					'sai_itm_price' => $grnitem['sai_itm_price'],
					'sai_itm_total' =>$grnitem['sai_itm_total'],
					'sai_itm_currency' => $grnitem['sai_itm_currency'],
					'sai_itm_days' => $grnitem['sai_itm_days'],
					'sai_itm_roe' => $grnitem['sai_itm_roe'],
					'sai_itm_tax' => $grnitem['sai_itm_tax'],
					'sai_itm_cid' => $this->session->userdata['login']['aus_Id'],
					'sai_is_bom' => $grnitem['sai_is_bom'],
					'sai_bomid' => $grnitem['sai_bomid'],
					'sai_pbomid' => $grnitem['sai_pbomid'],
					'sai_item_udate' =>date('Y-m-d H:i:s')
					);//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_sale_quotation_item',$item);

				$this->db->select('*');
				$this->db->from('tbl_sale_quotation_itax');
				$this->db->where('sqit_pid',$this->input->get('id'));
				$this->db->where('sqit_pitemid',$grnitem['sai_itm_name']);
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
		$this->db->from('tbl_sale_quotation_bom');
		$this->db->where('sqb_sa_id',$this->input->get('id'));
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
					$this->db->from('tbl_sale_quotation_item');
					$this->db->where('sai_sale_quotation_id',$this->input->get('id'));
					$this->db->where('sai_bomid',$grnbomlist['sqb_bom_id']);
					$this->db->where('sai_is_bom',1);
					$query = $this->db->get();
					$item['pitmbomdetails'] = $query->result_array();
					//echo'<pre>';print_r($item);die;
					if(isset($item['pitmbomdetails']) && !empty($item['pitmbomdetails']))
					{
						foreach ($item['pitmbomdetails'] as $bikey => $grnitem) {
							if($grnitem['sai_itm_name'] != '')
							{
								$item = array(
									'sai_sale_quotation_id' =>$lid,
									'sai_itm_name' => $grnitem['sai_itm_name'],
									'sai_itm_grade' =>$grnitem['sai_itm_grade'],
									'sai_itm_desc' =>$grnitem['sai_itm_desc'],
									'sai_itm_qty' => $grnitem['sai_itm_qty'],
									'sai_itm_unit' => $grnitem['sai_itm_unit'],
									'sai_itm_price' => $grnitem['sai_itm_price'],
									'sai_itm_total' =>$grnitem['sai_itm_total'],
									'sai_itm_currency' => $grnitem['sai_itm_currency'],
									'sai_itm_days' => $grnitem['sai_itm_days'],
									'sai_itm_roe' => $grnitem['sai_itm_roe'],
									'sai_itm_tax' => $grnitem['sai_itm_tax'],
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
					$this->db->from('tbl_sale_quotation_btax');
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

		$this->db->select('*');
		$this->db->from('tbl_sale_quotation_tax');
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
			$this->db->insert('tbl_sale_quotation_tax',$tax);
			//echo'<pre>';print_r($tax);die;
		}
		return $lid;
	}
	public function Master_party_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		//$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_sale_quotation.vendor');
		if($this->input->get('party')){
			$this->db->where('tbl_sale_quotation.sa_id', $this->input->get('party'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('sa_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('sa_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('sa_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sa_enq_date <=',$stdate);
		}
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['date_wise'] = $query->result_array();
	//**************************************************End customer wise
		// $this->db->select('*');
		// $this->db->from('tbl_sale_quotation_item');
		// $this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_sale_quotation_item.sai_sale_quotation_id');
		// $this->db->join('tbl_sale_quotation', 'tbl_sale_quotation.sa_id = tbl_sale_quotation_item.sai_sale_quotation_id');
		// if($this->input->get('items')){
		// 	$this->db->where('tbl_sale_quotation_item.sai_sale_quotation_id', $this->input->get('items'));
		// }
		// if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
		// 	$this->db->where('sa_cdate >=',$stdate);
		// }
		// if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
		// 	$this->db->where('sa_cdate <=',$stdate);
		// }
		// if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
		// 	$this->db->where('sa_enq_date >=',$stdate);
		// }
		// if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
		// 	$this->db->where('sa_enq_date <=',$stdate);
		// }
		// $query = $this->db->get();
		// //echo'<pre>';print_r($query->result_array());die;
		// $value['item_wise'] =  $query->result_array();	
		//echo'<pre>';print_r($value);die;
	//*************************************************End item wise
	//*************************************************Tax Wise Start
		$this->db->select('*');
		$this->db->from('tbl_tax');
		//$this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_sale_quotation_item.sai_sale_quotation_id');
		// $this->db->join('tbl_sale_quotation', 'tbl_sale_quotation.sa_id = tbl_sale_quotation_item.sai_sale_quotation_id');
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
		$this->db->from('tbl_sale_quotation');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['customer'] =  $query->result_array();
	//**************************************************End master customer	
		return $value;	
	}
	public function sa_no_get()
	{
		$this->db->select('sa_id');
		$this->db->from('tbl_sale_quotation');
		$this->db->order_by('sa_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['sa_id'] = isset($autoid['sa_id']) ? $autoid['sa_id'] : '';
		return $code['pre_quotation'].''.($autoid['sa_id']+1);
	}
    public function get_report_result()
    {
    	$this->db->select('sum(tbl_sale_quotation.sa_grd_ttl) as grand_total_view');
    	$this->db->from('tbl_sale_quotation');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_result_sub()
    {
    	$this->db->select('sum(tbl_sale_quotation_item.sai_itm_ftotal) as sub_total_view');
    	$this->db->from('tbl_sale_quotation_item');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_tax()
    {
    	$this->db->select('sum(tbl_sale_quotation_itax.sqit_tax_amount) as grand_tax_amount');
    	$this->db->from('tbl_sale_quotation_itax');
    	$query = $this->db->get();
		return $query->result_array();
    }
    public function get_inqno_wise()
    {
    	$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_sale_quotation.vendor','left');
		$this->db->order_by('tbl_sale_quotation.sa_id','DESC');
    	$query = $this->db->get();
		return $query->result_array();
    }

    public function delete($id,$custoid)
    {
        //echo'<pre>';print_r($custoid);die;
        $this->db->select('*');
		$this->db->from('tbl_master_contactperson');
		$this->db->where('contact_master_id', $id);
		$this->db->where('contact_isdelete', 0);
    	$query = $this->db->get();
		$cdata = $query->row_array();
		//'<pre>';print_r($query->num_rows());die;
		if($query->num_rows() == 0 || $query->num_rows() == 1)
		{
		    $this->db->set('master_party_isdelete',1);
    		$this->db->where('master_party_id', $id);
    		$this->db->update('tbl_master_party'); 
    		$log = array(
    					'adlog_name' => $this->session->userdata['miconlogin']['email'],
    					'adlog_datetime' => date('Y-m-d H:i:s'),
    					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
    					'adlog_module' => 'Master Party',
    					'adlog_delete' => 1
    				);
    			$this->db->insert('tbl_adminlogs',$log);
    			
    			
    			$this->db->set('contact_isdelete',1);
        		$this->db->where('contact_id', $custoid);
        		$this->db->update('tbl_master_contactperson'); 
        		$log = array(
        					'adlog_name' => $this->session->userdata['miconlogin']['email'],
        					'adlog_datetime' => date('Y-m-d H:i:s'),
        					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
        					'adlog_module' => 'Master Party',
        					'adlog_delete' => 1
        				);
    			$this->db->insert('tbl_adminlogs',$log);
    			return $id;
		}else{
		    $this->db->set('contact_isdelete',1);
    		$this->db->where('contact_id', $custoid);
    		$this->db->update('tbl_master_contactperson'); 
    		$log = array(
    					'adlog_name' => $this->session->userdata['miconlogin']['email'],
    					'adlog_datetime' => date('Y-m-d H:i:s'),
    					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
    					'adlog_module' => 'Master Party',
    					'adlog_delete' => 1
    				);
    			$this->db->insert('tbl_adminlogs',$log);
    			return $id;
		}
		
		
		
	}

	public function change_fstatus_toact($id)
    {
		$this->db->set('fu_followupst',5);
		$this->db->where('fu_id', $id);
		$this->db->update('tbl_sale_quotation_followup'); 
		return $id;
	}

	public function change_fstatus_todeact($id)
    {
		$this->db->set('fu_followupst',6);
		$this->db->where('fu_id', $id);
		$this->db->update('tbl_sale_quotation_followup'); 
		return $id; 
	}

 	public function delete_select_item($id,$enid)
    {
    	//echo $enid; die;
		$this->db->set('sai_isdeleted','1');
		$this->db->where('sai_id', $id);
		$this->db->update('tbl_sale_quotation_item'); 
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
		$this->db->where('source_main_cat !=', 0);
		$this->db->where('source_cat_isdelete', '0');
		$this->db->order_by('source_cat_id', 'desc');
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
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_sale_quotation_item', 'tbl_sale_quotation.sa_id = tbl_sale_quotation_item.sai_sale_quotation_id');
		$this->db->join('tbl_master_item','tbl_sale_quotation_item.sai_itm_name = tbl_master_item.master_item_id');
		$this->db->where('sa_id', $idenc);
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
		$this->db->from('tbl_sale_quotation_item');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_sale_quotation_item.sai_itm_name','left');
		$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_sale_quotation_item.sai_itm_hsncode','left');
		$this->db->where('sai_sale_quotation_id',$id);
		$this->db->where('sai_isdeleted','0');
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
    }

    public function get_excel_certificateeee()
	{
		$this->db->select('tbl_sale_quotation.sa_id,DATE_FORMAT(tbl_sale_quotation.sa_enq_date, "%d-%m-%Y"),tbl_sale_quotation.vendor,tbl_sale_quotation.sa_cont_per,tbl_sale_quotation.sa_mobile,tbl_sale_quotation.sa_email,tbl_master_city.city_name,tbl_master_item.master_item_part_no,tbl_sale_quotation_item.sai_itm_qty,tbl_sale_quotation_item.sai_itm_price,tbl_sale_quotation_item.sai_itm_total,tbl_sale_quotation.sa_inq_st,source.source_cat_name as sourcename,tbl_sale_quotation.sa_remarks');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_sale_quotation_item','tbl_sale_quotation_item.sai_sale_quotation_id = tbl_sale_quotation.sa_id','left');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_sale_quotation_item.sai_itm_name','left');
		$this->db->join('tbl_mode_inquiry','tbl_sale_quotation.sa_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sale_quotation.sa_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sale_quotation.sa_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sale_quotation.sa_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_sale_quotation_brand','tbl_sale_quotation.sa_id = tbl_sale_quotation_brand.sab_sq_id','left');
		$this->db->join('tbl_source_cat as source','tbl_sale_quotation.sa_source_cat =  source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sale_quotation.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_admin_users','tbl_sales_enq.sq_end_st = tbl_admin_users.aus_Id');
		$this->db->where('tbl_sale_quotation_item.sai_oa_completed',0);
		$this->db->where('tbl_sale_quotation_item.sai_isdeleted','0');
		$this->db->where('tbl_sale_quotation.sa_isdeleted','0');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		
		// if($this->input->get('sq_brand')){
		// 	$this->db->where('tbl_sale_quotation_brand.sab_brand', $this->input->get('sq_brand'));
		// }
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_quotation_brand.sab_brand', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor')){
			$this->db->where('tbl_sale_quotation.sa_id', $this->input->get('vendor'));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sale_quotation.sa_id', $this->input->get('conper'));
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
			$this->db->where('sa_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sa_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_country',$this->input->get('country'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',3);
			}
			if($this->input->get('status') == 0)
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',0);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_inq_by',$this->input->get('sq_end_st'));
		}
		//********************************************************************************************
		
        $this->db->order_by('tbl_sale_quotation.sa_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

    public function sales_qoute_report()
	{
		$this->db->select('*');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_sale_quotation');
		//$this->db->join('tbl_sale_quotation_item','tbl_sale_quotation_item.sai_sale_quotation_id = tbl_sale_quotation.sa_id','left');
		//$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_sale_quotation_item.sai_itm_name','left');
		$this->db->join('tbl_mode_inquiry','tbl_sale_quotation.sa_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_sale_quotation.sa_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_sale_quotation.sa_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_sale_quotation.sa_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_sale_quotation_brand','tbl_sale_quotation.sa_id = tbl_sale_quotation_brand.sab_sq_id','left');
		$this->db->join('tbl_source_cat as source','tbl_sale_quotation.sa_source_cat =  source.source_cat_id','left');
		// $this->db->join('tbl_source_cat as subsource','tbl_sale_quotation.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_admin_users','tbl_sale_quotation.sa_inq_st = tbl_admin_users.aus_Id','left');
		//$this->db->where('sai_oa_completed',0);
		//$this->db->where('sai_isdeleted','0');
		$this->db->where('sa_isdeleted','0');

		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_sale_quotation.sa_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('tbl_sale_quotation.sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_quotation_brand.sab_brand', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor')){
			$this->db->where('tbl_sale_quotation.sa_id', $this->input->get('vendor'));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_sale_quotation.sa_id', $this->input->get('conper'));
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
			$this->db->where('sa_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('sa_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_country',$this->input->get('country'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_city',$this->input->get('city'));
		}
		if($this->input->get('mobile_no') && ($this->input->get('mobile_no') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_mobile',$this->input->get('mobile_no'));
		}
		if($this->input->get('total') && ($this->input->get('total') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_grd_ttl',$this->input->get('total'));
		}
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',3);
			}
			if($this->input->get('status') == 0)
			{
				$this->db->where('tbl_sale_quotation.sa_inq_st',0);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_inq_by',$this->input->get('sq_end_st'));
		}
		//********************************************************************************************
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('sa_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('order_customer_name') && ($this->input->post('order_customer_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('order_customer_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('sa_inq_by', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('mode_of_inq') && ($this->input->post('mode_of_inq') != ''))
        {
           $this->db->like('sa_mode_inq', $this->input->post('mode_of_inq'));   
        }
         if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('sa_inq_st', $this->input->post('status'));   
        }
         if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('sa_priority', $this->input->post('priority'));   
        }
        if($this->input->post('remark') && ($this->input->post('remark') != ''))
        {
           $this->db->like('sa_remarks', $this->input->post('remark'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('sa_mobile', $this->input->post('mobile_no'));   
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
        	$stdate = date("Y-m-d", strtotime($this->input->post('inquiry_date')));
           $this->db->like('sa_enq_date', $stdate);   
        }
         if($this->input->post('reffered_by') && ($this->input->post('reffered_by') != ''))
        {
           $this->db->like('sa_referred_by', $this->input->post('reffered_by'));   
        }
         if($this->input->post('inquiry_cdate') && ($this->input->post('inquiry_cdate') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_cdate')));
           $this->db->like('sa_cdate', $stdate);   
        }
        if($this->input->post('detailofitm') && ($this->input->post('detailofitm') != ''))
        {
           $this->db->like('master_item_name', $this->input->post('detailofitm'));   
        }
        if($this->input->post('qty') && ($this->input->post('qty') != ''))
        {
           $this->db->like('sai_itm_qty', $this->input->post('qty'));   
        }
        if($this->input->post('price') && ($this->input->post('price') != ''))
        {
           $this->db->like('sai_itm_price', $this->input->post('price'));   
        }
        $posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sale_quotation.sa_grd_ttl','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sale_quotation.sa_grd_ttl','DESC');
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
        		$this->db->order_by('tbl_sale_quotation.sa_mobile','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sale_quotation.sa_mobile','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sale_quotation.vendor','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sale_quotation.vendor','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sale_quotation.sa_enq_date','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sale_quotation.sa_enq_date','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 0))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_sale_quotation.sa_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_sale_quotation.sa_no','DESC');
        	}
        }else{
        	$this->db->order_by('tbl_sale_quotation.sa_id','DESC');
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_followup()
	{//tbl_followup_method
		$this->db->select('tbl_sale_quotation.sa_id as id,tbl_sale_quotation.sa_enq_date as inq_dt,tbl_sale_quotation_followup.fu_followdate as followdate,tbl_sale_quotation.sa_no as no,tbl_sale_quotation.sa_con_person as name,tbl_sale_quotation.sa_mobile as mno,tbl_sale_quotation.sa_inq_st as stname,tbl_admin_users.au_fname as executive,tbl_sale_quotation_followup.fu_id as fuid,tbl_sale_quotation_followup.fu_followupst as folst');
		$this->db->from('tbl_sale_quotation');
		$this->db->join('tbl_sale_quotation_followup', 'tbl_sale_quotation_followup.fu_inq_id = tbl_sale_quotation.sa_id','left');
		//$this->db->join('tbl_ubasic_details', 'tbl_ubasic_details.bd_inq_id = tbl_sales_enq.sq_id','left');
		//$this->db->join('tbl_ucontact_nos', 'tbl_ucontact_nos.con_no_inq_id = tbl_sales_enq.sq_id','left');
		//$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_sales_enq.inq_inqstatus','left');
		$this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sale_quotation_followup.fu_followexe','left');
		//$this->db->join('tbl_uproduct_details', 'tbl_uproduct_details.prod_inq_id = tbl_sales_enq.sq_id','left');
		//$this->db->join('tbl_product_category', 'tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id','left');
		//$this->db->where('tbl_salesq_followup.fu_followupst',5);
		//$this->db->where('tbl_ubasic_details.bd_bit',1);
		$this->db->order_by('tbl_sale_quotation_followup.fu_followdate','desc');
		$this->db->where('tbl_sale_quotation_followup.fu_isdelete',0);
		$this->db->where('tbl_sale_quotation.sa_isdeleted','0');
		if($this->input->get('status') == 'active')
		{
			$this->db->where('tbl_sale_quotation_followup.fu_followupst',5);
		}
		if($this->input->get('status') == 'deactive')
		{
			$this->db->where('tbl_sale_quotation_followup.fu_followupst',6);
		}
		if($this->input->post('date') && $this->input->post('date') != ''){
			$this->db->like('tbl_sale_quotation_followup.fu_followdate', date("Y-m-d", strtotime($this->input->post('date'))));
		}
		if($this->input->post('name') && $this->input->post('name') != ''){
			$this->db->like('tbl_sale_quotation.sa_con_person', $this->input->post('name'));
		}
		if($this->input->post('cno') && $this->input->post('cno') != ''){
			$this->db->like('tbl_sale_quotation.sa_mobile', $this->input->post('cno'));
		}
		if($this->input->post('cat') && $this->input->post('cat') != ''){
			$this->db->like('tbl_product_category.procat_name', $this->input->post('cat'));
		}
		if($this->input->post('status') && $this->input->post('status') != ''){
			$this->db->like('tbl_sale_quotation.sa_inq_st', $this->input->post('status'));
		}
		if($this->input->post('exec') && $this->input->post('exec') != ''){
			$this->db->like('tbl_admin_users.au_fname', $this->input->post('exec'));
		}
		//inq_au_id
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		
		$query = $this->db->get();
		return $query->result_array();
	}
	public function count()
	{
		$value = array();
        $this->db->select('count(tbl_sale_quotation_followup.fu_id) as cnt');
        $this->db->from('tbl_sale_quotation');
        $this->db->join('tbl_sale_quotation_followup','tbl_sale_quotation_followup.fu_inq_id = tbl_sale_quotation.sa_id');
        $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sale_quotation.sa_cid','left');
		if($this->input->get('status') == 'active')
		{
			$this->db->where('tbl_sale_quotation_followup.fu_followupst',5);
		}
		if($this->input->get('status') == 'deactive')
		{
			$this->db->where('tbl_sale_quotation_followup.fu_followupst',6);
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_sale_quotation.sa_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$this->db->where('tbl_sale_quotation_followup.fu_isdelete',0);
        $this->db->where('tbl_sale_quotation.sa_isdeleted','0');
        $query = $this->db->get();
        $value['task'] = $query->row_array();
        return $value;
	}
	
	public function get_listofollow()
	{
		/***********************************************************/
        /******************List Of Followup***************************/
        /***********************************************************/
        
        $this->db->select('tbl_sale_quotation.sa_id as id,tbl_sale_quotation.sa_enq_date as inq_dt,tbl_sale_quotation_followup.fu_followdate as followdate,tbl_sale_quotation_followup.fu_remark as fu_remark,tbl_sale_quotation.sa_mobile as mno,tbl_sale_quotation.sa_con_person as name,tbl_sale_quotation.sa_inq_st as stname,tbl_admin_users.au_fname as executive,tbl_sale_quotation_followup.fu_id as fuid,tbl_sale_quotation_followup.fu_followupst as folst');
        $this->db->from('tbl_sale_quotation');
         $this->db->join('tbl_sale_quotation_followup', 'tbl_sale_quotation_followup.fu_inq_id = tbl_sale_quotation.sa_id','left');
         $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sale_quotation.sa_cid','left');
         //$this->db->limit('tbl_ufollowup.fu_id',20);
         //$this->db->where('tbl_ufollowup.fu_followdate<=',date('Y-m-d'));
        //$this->db->or_where('tbl_sale_quotation_followup.fu_followupst',5);
         //$this->db->where('tbl_ubasic_details.bd_bit',1);
         $this->db->order_by('tbl_sale_quotation_followup.fu_followdate','desc');
         if($this->input->get('status') == 'active')
		{
			$this->db->where('tbl_sale_quotation_followup.fu_followupst',5);
		}
		if($this->input->get('status') == 'deactive')
		{
			$this->db->where('tbl_sale_quotation_followup.fu_followupst',6);
		}
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('tbl_sale_quotation.sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $this->db->where('tbl_sale_quotation_followup.fu_isdelete',0);
        $this->db->where('tbl_sale_quotation.sa_isdeleted','0');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->result_array()); die;
         return $query->result_array();
	}

	public function get_folup_details($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation_followup');
		$this->db->join('tbl_admin_users','tbl_sale_quotation_followup.fu_followexe = tbl_admin_users.au_id','left');
		$this->db->join('tbl_followup_status','tbl_sale_quotation_followup.fu_followupst = tbl_followup_status.inqfus_id','left');
		$this->db->join('tbl_followup_method','tbl_sale_quotation_followup.fu_followmethod = tbl_followup_method.fu_method_id','left');
		$this->db->where('fu_inq_id',$id);
		$this->db->where('fu_isdelete ',0);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
	}

	public function delete_fup($id)
    {
		$this->db->set('fu_isdelete',1);
		$this->db->where('fu_id', $id);
		$this->db->update('tbl_sale_quotation_followup'); 
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Sales Qoutation',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}

	public function delete_itms($id,$sid)
    {
		$this->db->set('contact_isdelete','1');
		$this->db->where('contact_id', $sid);
		$this->db->update('tbl_master_contactperson'); 

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Master Party Delete',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}

		public function get_all_hsns()
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$query = $this->db->get();
		$value = $query->result_array();
		return $value;
	}
	public function get_state_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_city_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_isdelete',0);
		$query = $this->db->get();
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

	public function get_currency()
	{
		$this->db->select('*');
		$this->db->from('tbl_currency');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('currency_isdelete','0');
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_edit_inqitems($id,$itemid)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_contactperson');
		$this->db->where('contact_master_id',$id);
		$this->db->where('contact_id',$itemid);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function item_edit($data,$sqiitemid)
	{

		//echo "<pre>"; print_r($data); die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		//echo "<pre>";print_r($lid);die;
		$item = array(
					'contact_master_id' => $lid,
					'contact_pname' => $data['contact_pname'],
					'contact_designation' => $data['contact_designation'],
					'contact_department' => $data['contact_department'],
					'contact_mobile'=> $data['contact_mobile'],
					'contact_phone'=> $data['contact_phone'],
					'contact_address'=> $data['contact_address'],
					'contact_location '=> $data['contact_location'],
					'contact_remark '=> $data['contact_remark'],
					//'contact_remarkdtlog' => 'contact_remarkdtlog +'.date('Y-m-d H:i:s'),
					'contact_email'=> $data['contact_email'],
					'contact_cdate' => date('Y-m-d H:i:s'),
					'contact_udate' => date('Y-m-d H:i:s')
			);
				$this->db->where('contact_id',$sqiitemid);
				$this->db->update('tbl_master_contactperson',$item);
				
			//	$this->db->set('contact_remarkdtlog','CONCAT(contact_remarkdtlog + '.date('Y-m-d H:i:s'));
			$this->db->set('contact_remarkdtlog', "CONCAT(contact_remarkdtlog,', ', '".$data['contact_remark']." dt:".date('Y-m-d H:i:s')."</br>"."')", FALSE);
				$this->db->where('contact_id',$sqiitemid);
				$this->db->update('tbl_master_contactperson');
				
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Master Party Other Edit',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;

	}

	
}
?>