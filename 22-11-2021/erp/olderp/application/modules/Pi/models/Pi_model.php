<?php 
class Pi_model extends CI_Model {
	
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
			'pim_from' => $data['pim_from'],
			'pim_to' => $data['pim_to'],
			'pim_to_cc' => $data['pim_to_cc'],
			'pim_sub' => $data['pim_sub'],
			'pim_attch' => json_encode($data['files']),
			'pim_body' => $data['pim_body'],
			'pim_udate' => date("Y-m-d"),
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_pi_mail',$item);
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
		//echo "<pre>";print_r($data);die;
		if(isset($data['pi_brand']) && $data['pi_brand'] != ''){
			$aus_home = json_encode($data['pi_brand']);
		}
		else{
			$aus_home = '';
		}
		//echo "<pre>"; print_r($data); die;
		if($this->uri->segment(3))
		{
			$id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
			$item = array(
			//'pi_no' => $data['pi_no'],
			'pi_enq_date' => date("Y-m-d", strtotime($data['pi_enq_date'])),
			'po_no' => $data['po_no'],
			'po_enq_date' => date("Y-m-d", strtotime($data['po_enq_date'])),
			'vendor' => $data['vendor'],
			'vendor_id' => $data['vendor_id'],
			// 'pi_remarks' => $data['pi_remarks'],
			'pi_address' => $data['pi_address'],
			'pi_country' => isset($data['pi_country']) ? $data['pi_country'] : 0,
			'pi_state' => isset($data['pi_state']) ? $data['pi_state'] : 0,
			'pi_city' => isset($data['pi_city']) ? $data['pi_city'] : 0,
			'pi_brand' => $aus_home,
			'pi_con_person' => $data['pi_con_person'],
			'pi_email' => $data['pi_email'],
			'pi_phone' => $data['pi_phone'],
			'pi_mobile' => $data['pi_mobile'],
			'pi_website' => $data['pi_website'],
			'pi_hsncode' => $data['pi_hsncode'],
			'pi_fright_hsncode' => $data['pi_fright_hsncode'],
			'pi_pfgst' => $data['pi_pfgst'],
			'pi_fright_pfgst' => $data['pi_fright_pfgst'],
			//'pi_isdiscount' => $data['pi_isdiscount'],
			// 'pi_rem_date' => date("Y-m-d", strtotime($data['pi_rem_date'])),
			// 'pi_rem_be_date' => $data['pi_rem_be_date'],
			// 'pi_mode_inq' => $data['pi_mode_inq'],
			// 'pi_inq_st' => $data['pi_inq_sts'],
			// 'pi_priority' => $data['pi_inq_priority'],
			// 'pi_source_cat' => $data['pi_source_cat'],
			// 'pi_subsource_cat' => $data['pi_subsource_cat'],
			// //'pi_ref_by' => $data['pi_ref_by'],
			// //'pi_attach' => $data['pi_attach'],
			// 'pi_term' => $data['pi_desc'],
			// 'pi_sub_ttl' => $data['itm_subttl'],
			// 'pi_grd_ttl' => $data['itm_grdttl'],
			// 'pi_grd_ttl_words' => $data['grdttlinword'],
			//'pi_cid' => $this->session->userdata['login']['aus_Id'],
			//'pi_cdate' => $data['pi_cdate'],
			'pi_udate' => $data['pi_udate'],
			'pi_gst' => $data['pi_gst']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('pi_id',$id);
		$this->db->update('tbl_pi',$item);
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'PI',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		$lid = $id;
		}else{
			$pi_no_get = $this->pi_no_get();
			$item = array(
			'pi_no' => $pi_no_get,
			'pi_enq_date' => date("Y-m-d", strtotime($data['pi_enq_date'])),
			'po_no' => $data['po_no'],
			'po_enq_date' => date("Y-m-d", strtotime($data['po_enq_date'])),
			'vendor' => $data['vendor'],
			'vendor_id' => $data['vendor_id'],
			// 'pi_remarks' => $data['pi_remarks'],
			'pi_address' => $data['pi_address'],
			'pi_country' => isset($data['pi_country']) ? $data['pi_country'] : 0,
			'pi_state' => isset($data['pi_state']) ? $data['pi_state'] : 0,
			'pi_city' => isset($data['pi_city']) ? $data['pi_city'] : 0,
			'pi_brand' => $aus_home,
			'pi_con_person' => $data['pi_con_person'],
			'pi_email' => $data['pi_email'],
			'pi_phone' => $data['pi_phone'],
			'pi_mobile' => $data['pi_mobile'],
			'pi_website' => $data['pi_website'],
			'pi_gst' => $data['pi_gst'],
			'pi_hsncode' => $data['pi_hsncode'],
			'pi_fright_hsncode' => $data['pi_fright_hsncode'],
			'pi_pfgst' => $data['pi_pfgst'],
			'pi_fright_pfgst' => $data['pi_fright_pfgst'],
			//'pi_isdiscount' => $data['pi_isdiscount'],
			// 'pi_rem_date' => date("Y-m-d", strtotime($data['pi_rem_date'])),
			// 'pi_rem_be_date' => $data['pi_rem_be_date'],
			// 'pi_mode_inq' => $data['pi_mode_inq'],
			// 'pi_inq_st' => $data['pi_inq_sts'],
			// 'pi_priority' => $data['pi_inq_priority'],
			// 'pi_source_cat' => $data['pi_source_cat'],
			// 'pi_subsource_cat' => $data['pi_subsource_cat'],
			// //'pi_ref_by' => $data['pi_ref_by'],
			// //'pi_attach' => $data['pi_attach'],
			// 'pi_term' => $data['pi_desc'],
			// 'pi_sub_ttl' => $data['itm_subttl'],
			// 'pi_grd_ttl' => $data['itm_grdttl'],
			// 'pi_grd_ttl_words' => $data['grdttlinword'],
			'pi_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'pi_cdate' => $data['pi_cdate'],
			'pi_udate' => $data['pi_udate'],
			'pi_gst' => $data['pi_gst']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_pi',$item);
		$lid = $this->db->insert_id();
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'PI',
					'adlog_edit' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		}
		
		
		return $lid;
	}
	public function other_add($data,$id)
	{
		//echo "<pre>";print_r($data);die;
		$item = array(
			//'pi_mode_inq' => $data['pi_mode_inq'],
			'pi_inq_st' => $data['pi_inq_sts'],
			'pi_priority' => $data['pi_inq_priority'],
			'pi_prepared_by' => $data['pi_prepared_by'],
			//'pi_subsource_cat' => $data['pi_subsource_cat'],
			'pi_ref_by' => $data['pi_ref_by'],
			//'pi_attach' => $data['pi_attach'],
			'pi_term' => $data['pi_term'],
			'pi_tc_price' => $data['pi_tc_price'],
			'pi_tc_wrnty' => $data['pi_tc_wrnty'],
			'pi_tc_pf' => $data['pi_tc_pf'],
			'pi_tc_deli' => $data['pi_tc_deli'],
			'pi_tc_paynt' => $data['pi_tc_paynt'],
			'pi_tc_ovali' => $data['pi_tc_ovali'],
			'pi_tc_frght' => $data['pi_tc_frght'],
			'pi_tc_gst' => $data['pi_tc_gst'],
			'pi_remarks' => $data['pi_remarks'],
			'pi_isdiscount' => $data['pi_isdiscount'],

			'pi_hsncode' => $data['pi_hsncode'],
			'pi_taxbleamount' => $data['pi_taxbleamount'],
			'pi_pfgst' => $data['pi_pfgst'],
			'pi_taxamount' => $data['pi_taxamount'],
			'pi_grandtotal' => $data['pi_grandtotal'],
			'pi_payment_term' => $data['pi_payment_term'],
			'pi_delivery' => $data['pi_delivery'],

			'pi_fright_hsncode' => $data['pi_fright_hsncode'],
			'pi_fright_taxbleamount' => $data['pi_fright_taxbleamount'],
			'pi_fright_pfgst' => $data['pi_fright_pfgst'],
			'pi_fright_taxamount' => $data['pi_fright_taxamount'],
			'pi_fright_grandtotal' => $data['pi_fright_grandtotal'],
			
			'pi_udate' => $data['pi_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('pi_id', $id);
		$this->db->update('tbl_pi', $item); 


		$this->db->select('SUM(pii_itm_ftotal) as countitem');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$id);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['countitem']= $query->row_array();

		$this->db->select('SUM(pi_extra_total) as count');
        		$this->db->from('tbl_pi_extra');
        		$this->db->where('pi_no',$id);
        		$this->db->where_in('pi_extra_delete',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['countitem']['countitem'] + $value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['countitem']['countitem'] + $value['count']['count'] + $data['pi_grandtotal'] + $data['pi_fright_grandtotal']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$id);
				$this->db->update('tbl_pi',$item);


		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'PI',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
	public function extra_add($data,$id)
	{
		$item = array(
					'pi_no' => $id,
					'pi_extra_descriptio' => $data['pi_extra_descriptio'],
					'pi_extra_qty' => $data['pi_extra_qty'],
					'pi_extra_price' => $data['pi_extra_price'],
					'pi_extra_total'=> $data['pi_extra_total'],
					'pi_extra_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_pi_extra',$item);
		$lid = $this->db->insert_id();

		$this->db->select('SUM(pii_itm_ftotal) as countitem');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$id);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['countitem']= $query->row_array();

		$this->db->select('SUM(pi_extra_total) as count');
        		$this->db->from('tbl_pi_extra');
        		$this->db->where('pi_no',$id);
        		$this->db->where_in('pi_extra_delete',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['countitem']['countitem'] + $value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['countitem']['countitem'] + $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$id);
				$this->db->update('tbl_pi',$item);
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'PI Extra',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
	public function item_add($data,$id)
	{
		$item = array(
					'pii_oale_quotation_id' => $id,
					'pii_itm_name' => $data['pii_itm'],
					'pii_itm_title' => $data['pii_itm_title'],
					'pii_itm' => $data['pii_itm_pno'],
					'pii_hsncode'=> $data['pii_hsncode'],
					'pii_itm_desc'=> $data['pii_itm_desc'],
					'pii_itm_qty'=> $data['pii_itm_qty'],
					'pii_itm_stock'=> $data['pii_itm_stock'],
					'pii_itm_opn_qty'=> $data['pii_itm_opn_qty'],
					'pii_itm_price'=> $data['pii_itm_price'],
					'pii_itm_total'=> $data['pii_itm_total'],
					'pii_itm_discount'=> $data['pii_itm_discount'],
					'pii_itm_gst_per'=> $data['pii_itm_gst_per'],
					'pii_itm_ftotal'=> $data['pii_itm_ftotal'],
					'pii_item_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_pi_item',$item);
		$lid = $this->db->insert_id();

		$this->db->select('SUM(pii_itm_ftotal) as count');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$id);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$id);
				$this->db->update('tbl_pi',$item);
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'PI Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}
	
	public function edit($data,$id)
	{ 
		if(isset($data['pi_brand']) && $data['pi_brand'] != ''){
			$aus_home = json_encode($data['pi_brand']);
		}
		else{
			$aus_home = '';
		}
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'pi_no' => $data['pi_no'],
			'pi_enq_date' => date("Y-m-d", strtotime($data['pi_enq_date'])),
			'po_no' => $data['po_no'],
			'po_enq_date' => date("Y-m-d", strtotime($data['po_enq_date'])),
			'vendor' => $data['vendor'],
			'pi_remarks' => $data['pi_remarks'],
			'pi_address' => $data['pi_address'],
			'pi_country' => $data['pi_country'],
			'pi_state' => $data['pi_state'],
			'pi_city' => $data['pi_city'],
			'pi_brand' => $aus_home,
			'pi_con_person' => $data['pi_con_person'],
			'pi_email' => $data['pi_email'],
			'pi_phone' => $data['pi_phone'],
			'pi_mobile' => $data['pi_mobile'],
			'pi_website' => $data['pi_website'],
			'pi_gst' => $data['pi_gst'],
			'pi_rem_date' => date("Y-m-d", strtotime($data['pi_rem_date'])),
			'pi_rem_be_date' => $data['pi_rem_be_date'],
			// 'pi_mode_inq' => $data['pi_mode_inq'],
			'pi_inq_st' => $data['pi_inq_sts'],
			'pi_priority' => $data['pi_inq_priority'],
			'pi_source_cat' => $data['pi_source_cat'],
			'pi_subsource_cat' => $data['pi_subsource_cat'],
			// 'pi_end_st' => $data['pi_end_st'],
			// //'pi_party_tax' => $data['pi_party_tax'],
			// 'pi_ref_by' => $data['pi_ref_by'],
			// //'pi_attach' => $data['pi_attach'],
			 'pi_term' => $data['pi_desc'],
			// 'pi_sub_ttl' => $data['itm_subttl'],
			// 'pi_grd_ttl' => $data['itm_grdttl'],
			// 'pi_grd_ttl_words' => $data['grdttlinword'],
			//'pi_cid' => $this->session->userdata['login']['aus_Id'],
			'pi_udate' => $data['pi_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('pi_id', $id);
		//$this->db->where('pi_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_pi', $item); 
		//$lid = $this->input->get('id');
		$this->db->delete('tbl_pi_item',array('pii_oale_quotation_id' => $id));
		//$this->db->delete('tbl_pi_itax',array('sqit_pid' => $lid));
		//echo '<pre>'; print_r($data['mequot_detail_item']); die;
		if(isset($data['mequot_detail_item']) && !empty($data['mequot_detail_item']))
		foreach ($data['mequot_detail_item'] as $key => $mequot_detail_item) {
			if($mequot_detail_item != '' && $data['mequot_desc'][$key] != '')
			{
				$item1 = array(
					'pii_oale_quotation_id' => $id,
					'pii_itm_name' => $mequot_detail_item,
					'pii_itm_desc'=> $data['mequot_desc'][$key],
					'pii_itm_qty'=> $data['mequot_qty'][$key],
					'pii_itm_price'=> $data['mequot_rate'][$key],
					'pii_itm_discount'=> $data['mequot_dis'][$key],
					'pii_itm_total'=> $data['mequot_ftotl'][$key],
					'pii_item_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1);
				$this->db->insert('tbl_pi_item',$item1);

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
		$this->db->from('tbl_pi');
		$this->db->join('tbl_admin_users','tbl_pi.pi_cid = tbl_admin_users.au_id');
		//$this->db->join('tbl_master_party','tbl_pi.vendor = tbl_master_party.master_party_id');
		$this->db->where('pi_id',$id);
		$this->db->where('pi_isdeleted',0);
		//$this->db->where('pi_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_pi()
	{
		
		$this->db->select('*');//sum(tbl_pi.inv_grand_total) as grand_total_view
		$this->db->from('tbl_pi');
		// $this->db->join('tbl_pi_item','tbl_pi_item.pii_oale_quotation_id = tbl_pi.pi_id','left');
		// $this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_pi_item.pii_itm_name','left');
		$this->db->join('tbl_mode_inquiry','tbl_pi.pi_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->where('pi_isdeleted','0');
		//$this->db->where('pii_isdeleted',0);
		//$this->db->join('tbl_admin_users','tbl_pi.pi_end_st = tbl_admin_users.aus_Id');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('pi_cid', $this->session->userdata['miconlogin']['all_users']);
			}else{
				$this->db->where('pi_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		$posdata = $this->input->post();
		//$this->db->order_by('tbl_pi.pi_id','DESC');
		if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_pi.pi_mobile','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_pi.pi_mobile','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 7))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('pi_report_gtotal','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('pi_report_gtotal','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 8))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('pi_enq_date','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('pi_enq_date','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 9))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('pi_ref_by','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('pi_ref_by','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 10))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('pi_udate','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('pi_udate','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 5))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('pi_remarks','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('pi_remarks','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_pi.vendor','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_pi.vendor','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_pi.pi_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_pi.pi_no','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 0))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_pi.pi_id','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_pi.pi_id','DESC');
        	}
        }else{
        	$this->db->order_by('tbl_pi.pi_id','DESC');
        }
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('pi_no', $this->input->post('inquiry_number'));   
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
           $this->db->like('pi_address', $this->input->post('address'));   
        }
         if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
        {
           $this->db->like('pi_email', $this->input->post('email_id'));   
        }
         if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
        {
           $this->db->like('pi_phone', $this->input->post('phone_no'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('pi_mobile', $this->input->post('mobile_no'));   
        }
        if($this->input->post('dtlofitm') && ($this->input->post('dtlofitm') != ''))
        {
           $this->db->like('master_item_name', $this->input->post('dtlofitm'));   
        }
        if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('pi_inq_st', $this->input->post('status'));   
        }
        if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('pi_priority', $this->input->post('priority'));   
        }
  //       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		// {
		// 	$this->db->where('tbl_pi.pi_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		// }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_pi_report()
	{
		$this->db->select('*');//sum(tbl_pi.inv_grand_total) as grand_total_view
		$this->db->from('tbl_pi');
		$this->db->where('pi_isdeleted','0');
		$this->db->join('tbl_mode_inquiry','tbl_pi.pi_mode_inq = tbl_mode_inquiry.mode_inquiry_id');
		$this->db->join('tbl_admin_users','tbl_pi.pi_end_st = tbl_admin_users.aus_Id');
		//$this->db->where('pi_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->order_by('tbl_pi.pi_id','DESC');
		if($this->input->get('party')){
			$this->db->where('tbl_pi.pi_id', $this->input->get('party'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('pi_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('pi_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('pi_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('pi_enq_date <=',$stdate);
		}
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('pi_no', $this->input->post('inquiry_number'));   
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
           $this->db->like('pi_address', $this->input->post('address'));   
        }
         if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
        {
           $this->db->like('pi_email', $this->input->post('email_id'));   
        }
         if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
        {
           $this->db->like('pi_phone', $this->input->post('phone_no'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('pi_mobile', $this->input->post('mobile_no'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_all_tax()
	{
		$this->db->select('in_tax_name, sum(in_tax_amount) as total_taxval');
		$this->db->group_by('in_tax_name'); 
		$this->db->from('tbl_pi');
		$this->db->join('tbl_pi_tax','tbl_pi.inv_id = tbl_pi_tax.in_invid');
		//$this->db->where('inv_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_tax_gst()
	{
		$this->db->select('SUM(tbl_pi_itax.sqit_tax_amount) as total,UPPER(tbl_pi_itax.sqit_tax_name) as tax_name, tbl_pi_itax.*');
		//SUM(IF(itmtax_tax_name = 'CGST', itmtax_tax_amount, 0)) AS 'CGST',
		$this->db->from('tbl_pi_itax');
		//$this->db->join('tbl_invoice_itmtax','tbl_invoice_item.invi_id = tbl_invoice_itmtax.itmtax_invi_id');
		//$this->db->join('tbl_invoice','tbl_invoice.inv_id = tbl_invoice_itmtax.itmtax_invid');
		$this->db->group_by('tax_name');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_oano_wise()
	{
		$this->db->select('*');
		$this->db->from('tbl_pi');
		//$this->db->join('tbl_master_party','tbl_pi.vendor = tbl_master_party.master_party_id');
		//$this->db->join('tbl_pi_item','tbl_pi.inv_id = tbl_pi_item.invi_inv_id');
		//$this->db->join('tbl_master_item','tbl_pi_item.invi_itm_name = tbl_master_item.master_item_id');
		//$this->db->where('pi_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->get('start_date') && ($this->input->get('start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('start_date')));
			$this->db->where('pi_cdate >=',$stdate);
		}
		if($this->input->get('end_date') && ($this->input->get('end_date') != ''))
		{
			$end_date = date("Y-m-d", strtotime($this->input->get('end_date')));
			$this->db->where('pi_cdate <=',$end_date);
		}
		if($this->input->get('party') && ($this->input->get('party') != ''))
		{
			$party = $this->input->get('party');
			$this->db->where('vendor',$party);
		}
		$this->db->order_by('tbl_pi.pi_id','DESC');
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
		$this->db->from('tbl_pi_itax');
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
		$this->db->from('tbl_pi_btax');
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
		$this->db->from('tbl_pi');
		$this->db->join('tbl_admin_users','tbl_pi.pi_prepared_by = tbl_admin_users.au_id','left');
		$this->db->join('tbl_master_city','tbl_pi.pi_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_pi.pi_state = tbl_master_state.state_id','left');
		$this->db->where('tbl_pi.pi_id',$id);
		$this->db->order_by('tbl_pi.pi_id','DESC');
		$query = $this->db->get();
		$value['inv'] = $query->row_array();
		//echo "<pre>"; print_r($value['inv']); die;

		$this->db->select('*');
		$this->db->from('tbl_pi_item');
		$this->db->join('tbl_hsn_code','tbl_pi_item.pii_hsncode = tbl_hsn_code.hsn_id','left');
		$this->db->join('tbl_master_item','tbl_pi_item.pii_itm_name = tbl_master_item.master_item_id','left');
		$this->db->join('tbl_master_item_unit','tbl_master_item_unit.master_item_unit_id = tbl_master_item.master_item_unit','left');
		$this->db->where('tbl_pi_item.pii_oale_quotation_id',$id);
		$this->db->where('tbl_pi_item.pii_isdeleted',0);
		//$this->db->where('tbl_Pi_item.Pii_is_bom !=',1);
		//$this->db->order_by('tbl_Pi_item.invi_inv_id','DESC');
		$query = $this->db->get();
		$value['items'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_pi_extra');
		$this->db->where('pi_no',$id);
		$this->db->where('pi_extra_delete',0);
		$query = $this->db->get();
		$value['extra'] = $query->result_array();

		return $value;
	}

	public function get_items()
	{
		$this->db->select('*');
		$this->db->from('tbl_pi_item');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_pi_item.pii_itm_name');
		$this->db->where('pii_oale_quotation_id',$this->input->get('id'));
		// $this->db->where('pii_is_bom !=',1);
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
		$this->db->from('tbl_pi_tax');
		//$this->db->where('tbl_pi_tax.sqt_tax_cid',$this->session->userdata['login']['aus_Id']);
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
		$this->db->from('tbl_pi_bom');
		$this->db->join('tbl_bom','tbl_bom.bom_id = tbl_pi_bom.sqb_bom_id');
		//$this->db->where('tbl_pi_bom.sqb_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('tbl_pi_bom.sqb_bom_id',$data['bomid']);
		$this->db->where('tbl_pi_bom.sqb_pi_id',$this->input->get('id'));
		$query = $this->db->get();
		echo '<pre>';print_r($query->result_array());die;
		return $query->row_array();
	}
	
	public function get_boms_edit()
	{
		$this->db->select('*');
		$this->db->from('tbl_pi_bom');
		$this->db->join('tbl_bom','tbl_bom.bom_id = tbl_pi_bom.sqb_bom_id');
		//$this->db->where('tbl_pi_bom.sqb_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('tbl_pi_bom.sqb_pi_id',$this->input->get('id'));
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
		$this->db->from('tbl_pi');
		$this->db->where('pi_id',$this->input->get('id'));
		$query = $this->db->get();
		$item['pdetails'] = $query->row_array();
		//echo'<pre>';print_r($item);die;

		$this->db->select('pi_id');
		$this->db->from('tbl_pi');
		$this->db->order_by('pi_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['pi_id'] = isset($autoid['pi_id']) ? $autoid['pi_id'] : '';
	    $code['pre_quotation'].''.($autoid['pi_id']+1);
		$item = array(
			'pi_no' =>$code['pre_quotation'].''.($autoid['pi_id']+1),
			'pi_enq_date' => date("Y-m-d", strtotime($item['pdetails']['pi_enq_date'])),
			'vendor' => $item['pdetails']['vendor'],
			'pi_address' => $item['pdetails']['pi_address'],
			'pi_remarks' => $item['pdetails']['pi_remarks'],
			'pi_email' => $item['pdetails']['pi_email'],
			'pi_phone' => $item['pdetails']['pi_phone'],
			'pi_mobile' => $item['pdetails']['pi_mobile'],
			'pi_brand' => $item['pdetails']['pi_brand'],
			//'pi_quotation_stu' => $item['pdetails']['remarks'],
			'pi_referred_by' => $item['pdetails']['pi_ref_by'],
			'pi_attach' => $item['pdetails']['pi_attach'],
			'pi_term' => $item['pdetails']['pi_desc'],
			'pi_sub_ttl' => $item['pdetails']['pi_sub_ttl'],
			'pi_grd_ttl' => $item['pdetails']['pi_grd_ttl'],
			'pi_grd_ttl_words' => $item['pdetails']['pi_grd_ttl_words'],
			'pi_cid' => $this->session->userdata['login']['aus_Id'],
			'pi_cdate' => date('Y-m-d H:i:s'),
			'pi_udate' =>date('Y-m-d H:i:s')
			);//echo'<pre>';print_r($item);die;
		$this->db->insert('tbl_pi',$item);
		$lid = $this->db->insert_id();
		
		$this->db->select('*');
		$this->db->from('tbl_pi_item');
		$this->db->where('pii_oale_quotation_id',$this->input->get('id'));
		$this->db->where('pii_is_bom !=',1);
		$query = $this->db->get();
		$item['piitemdetails'] = $query->result_array();
           //echo'<pre>';print_r($item);die;
		foreach ($item['piitemdetails'] as $key => $grnitem) {
			if($grnitem['pii_itm_name'] != '' && $grnitem['pii_itm_currency'] != '')
			{
				$item = array(
					'pii_oale_quotation_id' =>$lid,
					'pii_itm_name' => $grnitem['pii_itm_name'],
					'pii_itm_grade' =>$grnitem['pii_itm_grade'],
					'pii_itm_desc' =>$grnitem['pii_itm_desc'],
					'pii_itm_qty' => $grnitem['pii_itm_qty'],
					'pii_itm_unit' => $grnitem['pii_itm_unit'],
					'pii_itm_price' => $grnitem['pii_itm_price'],
					'pii_itm_total' =>$grnitem['pii_itm_total'],
					'pii_itm_currency' => $grnitem['pii_itm_currency'],
					'pii_itm_days' => $grnitem['pii_itm_days'],
					'pii_itm_roe' => $grnitem['pii_itm_roe'],
					'pii_itm_tax' => $grnitem['pii_itm_tax'],
					'pii_itm_cid' => $this->session->userdata['login']['aus_Id'],
					'pii_is_bom' => $grnitem['pii_is_bom'],
					'pii_bomid' => $grnitem['pii_bomid'],
					'pii_pbomid' => $grnitem['pii_pbomid'],
					'pii_item_udate' =>date('Y-m-d H:i:s')
					);//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_pi_item',$item);

				$this->db->select('*');
				$this->db->from('tbl_pi_itax');
				$this->db->where('sqit_pid',$this->input->get('id'));
				$this->db->where('sqit_pitemid',$grnitem['pii_itm_name']);
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
					$this->db->insert('tbl_pi_itax',$tax);
				}

			}
		}
		$this->db->select('*');
		$this->db->from('tbl_pi_bom');
		$this->db->where('sqb_pi_id',$this->input->get('id'));
		$query = $this->db->get();
		$item['pbomdetails'] = $query->result_array();
		//echo'<pre>';print_r($item);die;
		if(isset($item['pbomdetails']) && !empty($item['pbomdetails']))
		{
			foreach ($item['pbomdetails'] as $bkey => $grnbomlist) {
				if($grnbomlist['sqb_bom_id'] != '')
				{
					$item = array(
						'sab_pi_id' =>$lid,
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
					$this->db->insert('tbl_pi_bom',$item);
					//echo'<pre>';print_r($item);die;
					$pbomid = $this->db->insert_id();
					//$data['fbomautoid'][$bkey]
					$this->db->select('*');
					$this->db->from('tbl_pi_item');
					$this->db->where('pii_oale_quotation_id',$this->input->get('id'));
					$this->db->where('pii_bomid',$grnbomlist['sqb_bom_id']);
					$this->db->where('pii_is_bom',1);
					$query = $this->db->get();
					$item['pitmbomdetails'] = $query->result_array();
					//echo'<pre>';print_r($item);die;
					if(isset($item['pitmbomdetails']) && !empty($item['pitmbomdetails']))
					{
						foreach ($item['pitmbomdetails'] as $bikey => $grnitem) {
							if($grnitem['pii_itm_name'] != '')
							{
								$item = array(
									'pii_oale_quotation_id' =>$lid,
									'pii_itm_name' => $grnitem['pii_itm_name'],
									'pii_itm_grade' =>$grnitem['pii_itm_grade'],
									'pii_itm_desc' =>$grnitem['pii_itm_desc'],
									'pii_itm_qty' => $grnitem['pii_itm_qty'],
									'pii_itm_unit' => $grnitem['pii_itm_unit'],
									'pii_itm_price' => $grnitem['pii_itm_price'],
									'pii_itm_total' =>$grnitem['pii_itm_total'],
									'pii_itm_currency' => $grnitem['pii_itm_currency'],
									'pii_itm_days' => $grnitem['pii_itm_days'],
									'pii_itm_roe' => $grnitem['pii_itm_roe'],
									'pii_itm_tax' => $grnitem['pii_itm_tax'],
									'pii_itm_cid' => $this->session->userdata['login']['aus_Id'],
									'pii_is_bom' => 1,
									'pii_bomid' => $grnbomlist['sqb_bom_id'],
									'pii_pbomid' => $pbomid,
									'pii_item_udate' =>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_pi_item',$item);
								//echo'<pre>';print_r($item);die;
								//echo $fbom;die;								
							}
						}
					}
					$this->db->select('*');
					$this->db->from('tbl_pi_btax');
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
							$this->db->insert('tbl_pi_btax',$tax);
							//echo'<pre>';print_r($tax);die;
						}	
					}
				}
			}
		}

		$this->db->select('*');
		$this->db->from('tbl_pi_tax');
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
			$this->db->insert('tbl_pi_tax',$tax);
			//echo'<pre>';print_r($tax);die;
		}
		return $lid;
	}
	public function pi_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_pi');
		//$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_pi.vendor');
		if($this->input->get('party')){
			$this->db->where('tbl_pi.pi_id', $this->input->get('party'));
		}
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('pi_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('pi_cdate <=',$stdate);
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('pi_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('pi_enq_date <=',$stdate);
		}
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['date_wise'] = $query->result_array();
	//**************************************************End customer wise
		// $this->db->select('*');
		// $this->db->from('tbl_pi_item');
		// $this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_pi_item.pii_oale_quotation_id');
		// $this->db->join('tbl_pi', 'tbl_pi.pi_id = tbl_pi_item.pii_oale_quotation_id');
		// if($this->input->get('items')){
		// 	$this->db->where('tbl_pi_item.pii_oale_quotation_id', $this->input->get('items'));
		// }
		// if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
		// 	$this->db->where('pi_cdate >=',$stdate);
		// }
		// if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
		// 	$this->db->where('pi_cdate <=',$stdate);
		// }
		// if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
		// 	$this->db->where('pi_enq_date >=',$stdate);
		// }
		// if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
		// 	$this->db->where('pi_enq_date <=',$stdate);
		// }
		// $query = $this->db->get();
		// //echo'<pre>';print_r($query->result_array());die;
		// $value['item_wise'] =  $query->result_array();	
		//echo'<pre>';print_r($value);die;
	//*************************************************End item wise
	//*************************************************Tax Wise Start
		$this->db->select('*');
		$this->db->from('tbl_tax');
		//$this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_pi_item.pii_oale_quotation_id');
		// $this->db->join('tbl_pi', 'tbl_pi.pi_id = tbl_pi_item.pii_oale_quotation_id');
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
		$this->db->from('tbl_pi');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['customer'] =  $query->result_array();
	//**************************************************End master customer	
		return $value;	
	}
	public function pi_no_get()
	{
		$this->db->select('pi_id');
		$this->db->from('tbl_pi');
		$this->db->order_by('pi_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		/* $this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array(); */
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

		$autoid['pi_id'] = isset($autoid['pi_id']) ? $autoid['pi_id'] : '';
		return 'PI-'.$year_string.'-'.($autoid['pi_id']+1);
	}
    public function get_report_result()
    {
    	$this->db->select('sum(tbl_pi.pi_grd_ttl) as grand_total_view');
    	$this->db->from('tbl_pi');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_result_sub()
    {
    	$this->db->select('sum(tbl_pi_item.pii_itm_ftotal) as sub_total_view');
    	$this->db->from('tbl_pi_item');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_tax()
    {
    	$this->db->select('sum(tbl_pi_itax.sqit_tax_amount) as grand_tax_amount');
    	$this->db->from('tbl_pi_itax');
    	$query = $this->db->get();
		return $query->result_array();
    }
    public function get_inqno_wise()
    {
    	$this->db->select('*');
		$this->db->from('tbl_pi');
		$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_pi.vendor','left');
		$this->db->order_by('tbl_pi.pi_id','DESC');
    	$query = $this->db->get();
		return $query->result_array();
    }

    public function delete($id)
    {
		$this->db->set('pi_isdeleted', 1);
		$this->db->where('pi_id', $id);
		$this->db->update('tbl_pi');
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
		$this->db->set('pii_isdeleted','1');
		$this->db->where('pii_id', $id);
		$this->db->update('tbl_pi_item'); 
	}
	public function delete_select_extra($id,$pid)
    {
    	//echo $id; die;
		$this->db->set('pi_extra_delete','1');
		$this->db->where('pi_extra_id', $id);
		$this->db->update('tbl_pi_extra'); 

		$this->db->select('SUM(pii_itm_ftotal) as countitem');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$id);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['countitem']= $query->row_array();

		$this->db->select('SUM(pi_extra_total) as count');
        		$this->db->from('tbl_pi_extra');
        		$this->db->where('pi_no',$pid);
        		$this->db->where_in('pi_extra_delete',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['countitem']['countitem'] + $value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['countitem']['countitem'] + $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$pid);
				$this->db->update('tbl_pi',$item);
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

	public function get_gst($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$this->db->where('hsn_id', $id);
		$query = $this->db->get();
		return $query->row_array();
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
		$this->db->from('tbl_pi');
		$this->db->join('tbl_pi_item', 'tbl_pi.pi_id = tbl_pi_item.pii_oale_quotation_id');
		$this->db->join('tbl_master_item','tbl_pi_item.pii_itm_name = tbl_master_item.master_item_id');
		$this->db->where('pi_id', $idenc);
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
		$this->db->from('tbl_pi_item');
		$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_pi_item.pii_hsncode','left');
		$this->db->where('pii_oale_quotation_id',$id);
		$this->db->where('pii_isdeleted',0);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
    }
    public function get_extra_data($id)
    {
    	//echo "$id";die;
    	$this->db->select('*');
		$this->db->from('tbl_pi_extra');
		$this->db->where('pi_no',$id);
		$this->db->where('pi_extra_delete',0);
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		return $query->result_array();
    }
    public function sales_qoute_report()
	{
		$this->db->select('*');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
		$this->db->from('tbl_pi');
		$this->db->join('tbl_mode_inquiry','tbl_pi.pi_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_pi.pi_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_pi.pi_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_pi.pi_state = tbl_master_state.state_id','left');
		//$this->db->join('tbl_admin_users','tbl_sales_enq.sq_end_st = tbl_admin_users.aus_Id');
		$this->db->where('pi_isdeleted','0');
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->order_by('tbl_pi.pi_id','DESC');
		if($this->input->get('vendor')){
			$this->db->where('tbl_pi.pi_id', $this->input->get('vendor'));
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
			$this->db->where('pi_enq_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('pi_enq_date <=',$stdate);
		}
		if($this->input->get('country') && ($this->input->get('country') != ''))
		{
			$this->db->where('tbl_pi.pi_country',$this->input->get('country'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_pi.pi_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_pi.pi_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_pi.pi_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_pi.pi_inq_st',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_pi.pi_inq_st',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_pi.pi_inq_st',3);
			}
			if($this->input->get('status') == 0)
			{
				$this->db->where('tbl_pi.pi_inq_st',0);
			}
			
		}
		//********************************************************************************************
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('pi_no', $this->input->post('inquiry_number'));   
        }
        if($this->input->post('order_customer_name') && ($this->input->post('order_customer_name') != ''))
        {
           $this->db->like('vendor', $this->input->post('order_customer_name'));   
        }
         if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
        {
           $this->db->like('pi_inq_by', $this->input->post('inquiry_by'));   
        }
         if($this->input->post('mode_of_inq') && ($this->input->post('mode_of_inq') != ''))
        {
           $this->db->like('pi_mode_inq', $this->input->post('mode_of_inq'));   
        }
         if($this->input->post('status') && ($this->input->post('status') != ''))
        {
           $this->db->like('sq_email', $this->input->post('status'));   
        }
         if($this->input->post('priority') && ($this->input->post('priority') != ''))
        {
           $this->db->like('pi_priority', $this->input->post('priority'));   
        }
        if($this->input->post('remark') && ($this->input->post('remark') != ''))
        {
           $this->db->like('pi_remarks', $this->input->post('remark'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('pi_mobile', $this->input->post('mobile_no'));   
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
           $this->db->like('pi_enq_date', $stdate);   
        }
         if($this->input->post('reffered_by') && ($this->input->post('reffered_by') != ''))
        {
           $this->db->like('pi_referred_by', $this->input->post('reffered_by'));   
        }
         if($this->input->post('inquiry_cdate') && ($this->input->post('inquiry_cdate') != ''))
        {
        	$stdate = date("Y-m-d", strtotime($this->input->get('inquiry_cdate')));
           $this->db->like('pi_cdate', $stdate);   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	
	public function count()
	{
		$value = array();
        $this->db->select('count(tbl_salesq_followup.fu_id) as cnt');
        $this->db->from('tbl_pi');
        $this->db->join('tbl_salesq_followup','tbl_salesq_followup.fu_inq_id = tbl_pi.pi_id');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_pi.pi_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
        $this->db->where('tbl_pi.pi_isdeleted','0');
        $query = $this->db->get();
        $value['task'] = $query->row_array();
        return $value;
	}
	

	public function delete_itms($id,$pi_id)
    {
		$this->db->set('pii_isdeleted',1);
		$this->db->where('pii_id', $id);
		$this->db->update('tbl_pi_item');
		$this->db->select('SUM(pii_itm_ftotal) as count');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$pi_id);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$pi_id);
				$this->db->update('tbl_pi',$item); 
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
		$get_array = $this->input->get('delid');
		//echo "<pre>";print_r($get_array);die;
		if($this->input->get('id') && is_array($get_array) && !empty($get_array))
		{
			$this->db->select('*');
			$this->db->from('tbl_sale_quotation_item');
			//$this->db->join('tbl_booking_order','tbl_indend_status.ind_booking_id = tbl_booking_order.bo_id');
			$this->db->where_in('sai_id',$get_array);
			$query = $this->db->get();
			$inditems = $query->result_array();

				$this->db->select('pi_id');
				$this->db->from('tbl_pi');
				$this->db->order_by('pi_id','DESC');
				$this->db->limit(1);
				$query = $this->db->get();
				$autoid = $query->row_array();
				$this->db->select('*');
				$this->db->from('tbl_prefix');
				//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
				$query = $this->db->get();
				$code = $query->row_array();
				$autoid['pi_id'] = isset($autoid['pi_id']) ? $autoid['pi_id'] : '';
				 $pono = $code['pre_po'].''.($autoid['pi_id']+1);

				$item = array(
					'pi_no' => $pono,
					'pi_enq_date' => date("Y-m-d"),
					//'po_cid' => $this->session->userdata['login']['aus_Id'],
					'pi_cdate' => date("Y-m-d"),
					'pi_udate' => date("Y-m-d")
					);
				//echo '<pre>';print_r($item);die;
				$this->db->insert('tbl_pi',$item);
				$lid = $this->db->insert_id();
				//echo $lid; die;
				foreach($inditems as $inditem)
				{
					$this->db->select('*');
					$this->db->from('tbl_sale_quotation_item');
					//$this->db->join('tbl_booking_order','tbl_indend_status.ind_booking_id = tbl_booking_order.bo_id');
					$this->db->where('sai_id',$inditem['sai_id']);
					$query = $this->db->get();
					$inddata = $query->row_array();

					 $item = array(
							'pii_oale_quotation_id' => $lid,
							'pii_itm_name' => $inddata['sai_itm_name'],
							'pii_itm' => $inddata['sai_itm'],
							//'pi_itm_currency' => $data['item_currency'][$key],
							'pii_itm_qty' => $inddata['sai_itm_qty'],
							//'pi_itm_unit' => $data['item_unit'][$key],
							//'pi_itm_desc' => $data['item_desc'][$key],
							//'pi_itm_price' => $data['item_price'][$key],
							//'pi_itm_days' => $data['item_days'][$key],
							// 'pi_itm_roe' => $data['item_roe'][$key],
							// 'pi_itm_total' => $data['item_total'][$key],
							// 'pi_itm_discount' => $data['item_discount'][$key],
							// 'pi_itm_ftotal' => $data['item_ftotal'][$key],
							// 'pi_itm_tax' => $data['item_tax'][$key],
							'pii_itm_stock' => $inddata['sai_itm_stock'],
							'pii_itm_opn_qty' => $inddata['sai_itm_opn_qty'],
							'pii_itm_price' => $inddata['sai_itm_price'],
							'pii_itm_discount' => $inddata['sai_itm_discount'],
							'pii_itm_total' => $inddata['sai_itm_total'],
							//'pi_itm_cid' => $this->session->userdata['login']['aus_Id'],
							'pii_item_udate' => date('Y-m-d H:i:s')
							);
						//echo '<pre>';print_r($item);die;
						$this->db->insert('tbl_pi_item',$item);
					

					$this->db->set('sai_pi_completed',1);
					$this->db->where_in('sai_id',$get_array);
					$this->db->update('tbl_sale_quotation_item');
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
		$this->db->from('tbl_pi_item');
		$this->db->where('pii_oale_quotation_id',$id);
		$this->db->where('pii_id',$itemid);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_edit_inqextra($id,$itemid)
	{
		$this->db->select('*');
		$this->db->from('tbl_pi_extra');
		$this->db->where('pi_no',$id);
		$this->db->where('pi_extra_id',$itemid);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function item_edit($data,$sqiitemid)
	{
		//echo "<pre>";print_r($sqiitemid);die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item = array(
					'pii_oale_quotation_id' => $lid,
					'pii_itm_name' => $data['pii_itm'],
					'pii_itm_title' => $data['pii_itm_title'],
					'pii_itm' => $data['pii_itm_pno'],
					'pii_hsncode'=> $data['pii_hsncode'],
					'pii_itm_desc'=> $data['pii_itm_desc'],
					'pii_itm_qty'=> $data['pii_itm_qty'],
					'pii_itm_stock'=> $data['pii_itm_stock'],
					'pii_itm_opn_qty'=> $data['pii_itm_opn_qty'],
					'pii_itm_price'=> $data['pii_itm_price'],
					'pii_itm_total'=> $data['pii_itm_total'],
					'pii_itm_discount'=> $data['pii_itm_discount'],
					'pii_itm_gst_per'=> $data['pii_itm_gst_per'],
					'pii_itm_ftotal'=> $data['pii_itm_ftotal'],
					'pii_item_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
				$this->db->where('pii_id',$sqiitemid);
				$this->db->update('tbl_pi_item',$item);

				$this->db->select('SUM(pii_itm_ftotal) as count');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$lid);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$lid);
				$this->db->update('tbl_pi',$item); 

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
	public function extra_edit($data,$sqiitemid)
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		//echo "<pre>";print_r($lid);die;
		//$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item = array(
					'pi_no' => $lid,
					'pi_extra_descriptio' => $data['pi_extra_descriptio'],
					'pi_extra_qty' => $data['pi_extra_qty'],
					'pi_extra_price' => $data['pi_extra_price'],
					'pi_extra_total'=> $data['pi_extra_total'],
					'pi_extra_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('pi_extra_id',$sqiitemid);
		$this->db->update('tbl_pi_extra',$item);

				$this->db->select('SUM(pii_itm_ftotal) as countitem');
        		$this->db->from('tbl_pi_item');
        		$this->db->where('pii_oale_quotation_id',$lid);
        		$this->db->where_in('pii_isdeleted',0);
        		$query = $this->db->get();
        		$value['countitem']= $query->row_array();

		$this->db->select('SUM(pi_extra_total) as count');
        		$this->db->from('tbl_pi_extra');
        		$this->db->where('pi_no',$lid);
        		$this->db->where_in('pi_extra_delete',0);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();
        		//echo "<pre>";print_r($value['countitem']['countitem'] + $value['count']['count']);die;
        		$item = array(
					'pi_report_gtotal' => $value['countitem']['countitem'] + $value['count']['count']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('pi_id',$lid);
				$this->db->update('tbl_pi',$item);

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Edit Extra Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
	}
	
}
?>