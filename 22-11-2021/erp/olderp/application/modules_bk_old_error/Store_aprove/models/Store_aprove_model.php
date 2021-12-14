<?php 

class Store_aprove_model extends CI_Model {
	
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
		if($this->uri->segment(3))
		{
			$id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
   			$item = array(
			'wo_wo_no' => $data['wo_no'],
			'wo_wo_date' => date("Y-m-d", strtotime($data['wo_wo_date'])),
			'wo_customer_id' => $data['wo_custo_id'],
			'wo_po_no' => $data['wo_po_no'],
			'wo_po_date' => date("Y-m-d", strtotime($data['wo_po_date'])),
			'wo_customer_name' => $data['vendor'],
			'wo_address' => $data['wo_address'],
			'wo_billing_address' => $data['wo_billing_address'],
			'wo_shipping_address' => $data['wo_shipping_address'],
			'wo_deliverytime' => $data['wo_deliverytime'],
			'wo_deliveryby' => $data['wo_deliveryby'],
			'wo_couriername' => $data['wo_couriername'],
			'wo_docket_no' => $data['wo_docket_no'],
			'wo_preparedby' => $data['wo_preparedby'],
			'wo_gstno' => $data['wo_gstno'],

			'wo_taxbleamount' => $data['wo_taxbleamount'],
			'wo_pfgst' => $data['wo_pfgst'],
			'wo_taxamount' => $data['wo_taxamount'],
			'wo_pf_grandtotal' => $data['wo_pf_grandtotal'],
			'wo_fright_taxbleamount' => $data['wo_fright_taxbleamount'],
			'wo_fright_pfgst' => $data['wo_fright_pfgst'],
			'wo_fright_taxamount' => $data['wo_fright_taxamount'],
			'wo_fright_grandtotal' => $data['wo_fright_grandtotal'],
			'wo_paymentterms' => $data['wo_paymentterms'],
			'wo_testedby' => $data['wo_testedby'],
			'wo_remark' => $data['wo_remark'],
			'wo_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'wo_udate' => $data['wo_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('wo_id', $id);
		$this->db->update('tbl_Store_aprove',$item); 
		
		if(isset($data['wo_paymnetimg_sales']))
		{
			$item = array(
			'wo_paymnetimg_sales' => $data['wo_paymnetimg_sales']
			);
			$this->db->where('wo_id', $id);
			$this->db->update('tbl_Store_aprove', $item); 
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
			//echo "<pre>"; print_r($data); die;	
			$item = array(
			'wo_wo_no' => $data['wo_no'],
			'wo_wo_date' => date("Y-m-d", strtotime($data['wo_wo_date'])),
			'wo_customer_id' => $data['wo_custo_id'],
			'wo_po_no' => $data['wo_po_no'],
			'wo_po_date' => date("Y-m-d", strtotime($data['wo_po_date'])),
			'wo_customer_name' => $data['vendor'],
			'wo_address' => $data['wo_address'],
			'wo_billing_address' => $data['wo_billing_address'],
			'wo_shipping_address' => $data['wo_shipping_address'],
			'wo_deliverytime' => $data['wo_deliverytime'],
			'wo_deliveryby' => $data['wo_deliveryby'],
			'wo_couriername' => $data['wo_couriername'],
			'wo_docket_no' => $data['wo_docket_no'],
			'wo_preparedby' => $data['wo_preparedby'],
			'wo_gstno' => $data['wo_gstno'],
			'wo_testedby' => $data['wo_testedby'],
			'wo_remark' => $data['wo_remark'],
			'wo_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'wo_udate' => $data['wo_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_Store_aprove',$item);
		$lid = $this->db->insert_id();

		if(isset($data['wo_paymnetimg_sales']))
		{
			$item = array(
			'wo_paymnetimg_sales' => $data['wo_paymnetimg_sales']
			);
			$this->db->where('wo_id', $lid);
			$this->db->update('tbl_Store_aprove', $item); 
		}

		//echo '<pre>'; print_r($data['medetail_item']); die;
		//echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Store_aprove',
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
			// 'sq_source_cat' => $data['sq_source_cat'],
			// 'sq_subsource_cat' => $data['sq_subsource_cat'],
			// 'sq_mode_inq' => $data['sq_mode_inq'],
			// 'sq_inq_sts' => $data['sq_inq_sts'],
			// 'sq_inq_priority' => $data['sq_inq_priority'],
			// 'sq_end_st' => $data['sq_end_st'],
			// //'sq_party_tax' => $data['sq_party_tax'],
			// 'sq_ref_by' => $data['sq_ref_by'],
			//'sq_attach' => $data['sq_attach'],
			'Store_aprove_sub' => $data['Store_aprove_sub'],
			'Store_aprove_desc' => $data['Store_aprove_desc'],
			'Store_aprove_tc_price' => $data['Store_aprove_tc_price'],
			'Store_aprove_tc_wrnty' => $data['Store_aprove_tc_wrnty'],
			'Store_aprove_tc_pf' => $data['Store_aprove_tc_pf'],
			'Store_aprove_tc_deli' => $data['Store_aprove_tc_deli'],
			'Store_aprove_tc_paynt' => $data['Store_aprove_tc_paynt'],
			'Store_aprove_tc_ovali' => $data['Store_aprove_tc_ovali'],
			'Store_aprove_tc_frght' => $data['Store_aprove_tc_frght'],
			'Store_aprove_tc_gst' => $data['Store_aprove_tc_gst'],
			//'sq_grd_ttl_words' => $data['grdttlinword'],
			'sq_remarks' => $data['sq_remarks'],
			//'sq_cid' => $this->session->userdata['login']['aus_Id'],
			'sq_cdate' => $data['sq_cdate'],
			'sq_udate' => $data['sq_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('sq_id',$lid);
		$this->db->update('tbl_Store_aprove',$item);

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
		//echo "<pre>"; print_r($data); die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$item1 = array(
					'woi_wo_id' => $lid,
					'woi_item_id' => $data['sqi_itm_pno_id'],
					'woi_part_no' => $data['sqi_itm_pno'],
					'woi_itm_title' => $data['sqi_itm_title'],
					'woi_itm_desc' => $data['sqi_itm_desc'],
					'woi_stock' => $data['sqi_itm_stock'],
					'woi_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_admin_open_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_manager_open_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_production_open_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_store_open_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_account_open_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_dispatch_open_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_open_qty'=> $data['woi_open_qty'],
					'woi_price'=> $data['woi_price'],
					'woi_gst'=> $data['woi_gst'],
					'woi_total'=> $data['woi_total'],
					'woi_discount'=> $data['woi_discount'],
					'woi_final_price'=> $data['woi_final_price'],
					'woi_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1); die;
				$this->db->insert('tbl_Store_aprove_item',$item1);
				$item_lid = $this->db->insert_id();

				$this->db->select('SUM(woi_final_price) as count');
        		$this->db->from('tbl_Store_aprove_item');
        		$this->db->where('woi_isdelete','0');
        		$this->db->where('woi_wo_id',$lid);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();

        		$this->db->select('*');
        		$this->db->from('tbl_Store_aprove');
        		$this->db->where('wo_id',$lid);
        		$query = $this->db->get();
        		$other_value=$query->row_array();

        		//echo "<pre>";print_r($other_value);die;
        		$item = array(
					'wo_fainaltotal' => $value['count']['count'] + $other_value['wo_pf_grandtotal'] + $other_value['wo_fright_grandtotal']
					);
					//echo '<pre>';print_r($item);die;
				$this->db->where('wo_id',$lid);
				$this->db->update('tbl_Store_aprove',$item);

				$transaction = array(
							'tran_itm_id' => $data['sqi_itm_pno_id'],
							'tran_itm_qty' => $data['woi_qty'],
							'tran_wo_id ' => $lid,
							'tran_woi_id' => $item_lid,
							'tran_is_hold' => "1",
							'tran_cr_or_dr' => 2,
							'tran_add_or_edit' => 1,
							'tran_ip' => $_SERVER['REMOTE_ADDR'],
							'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
							'tran_cdate' => date('Y-m-d H:i:s'),
							'tran_udate' => date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_transaction',$transaction);


				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Store_aprove Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
		//echo '<pre>'; print_r($data['medetail_item']); die;
	}

	public function item_edit($data,$sqiitemid)
	{
		//echo "<pre>"; print_r($data); die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));

		$this->db->select('*');
		$this->db->from('tbl_Store_aprove_item');
		$this->db->where('woi_id',$sqiitemid);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		$deb_qty= $query->row_array();

		$transaction = array(
						'tran_itm_id' => $deb_qty['woi_item_id'],
						'tran_itm_qty' => $deb_qty['woi_qty'],
						'tran_wo_id ' => $lid,
						'tran_woi_id' => $sqiitemid,
						'tran_is_hold' => "1",
						'tran_cr_or_dr' => 1,
						'tran_add_or_edit' => 2,
						'tran_ip' => $_SERVER['REMOTE_ADDR'],
						'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
						'tran_cdate' => date('Y-m-d H:i:s'),
						'tran_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_transaction',$transaction);

		$item1 = array(
					'woi_wo_id' => $lid,
					'woi_item_id' => $data['sqi_itm_pno_id'],
					'woi_part_no' => $data['sqi_itm_pno'],
					'woi_itm_title' => $data['sqi_itm_title'],
					'woi_itm_desc' => $data['sqi_itm_desc'],
					'woi_stock' => $data['sqi_itm_stock'],
					'woi_qty'=> isset($data['woi_qty']) ? $data['woi_qty'] : '',
					//'woi_open_qty'=> $data['woi_open_qty'],
					'woi_price'=> $data['woi_price'],
					'woi_total'=> $data['woi_total'],
					'woi_gst'=> $data['woi_gst'],
					'woi_discount'=> $data['woi_discount'],
					'woi_final_price'=> $data['woi_final_price'],
					'woi_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($item1); die;
				$this->db->where('woi_id',$sqiitemid);
				$this->db->update('tbl_Store_aprove_item',$item1);

				$this->db->select('SUM(woi_final_price) as count');
        		$this->db->from('tbl_Store_aprove_item');
        		$this->db->where('woi_isdelete','0');
        		$this->db->where('woi_wo_id',$lid);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();

        		$this->db->select('*');
        		$this->db->from('tbl_Store_aprove');
        		$this->db->where('wo_id',$lid);
        		$query = $this->db->get();
        		$other_value=$query->row_array();

        		//echo "<pre>";print_r($other_value);die;
        		$item = array(
					'wo_fainaltotal' => $value['count']['count'] + $other_value['wo_pf_grandtotal'] + $other_value['wo_fright_grandtotal']
					);
				$this->db->where('wo_id',$lid);
				$this->db->update('tbl_Store_aprove',$item);

				$transaction = array(
							'tran_itm_id' => $data['sqi_itm_pno_id'],
							'tran_itm_qty' => $data['woi_qty'],
							'tran_wo_id ' => $lid,
							'tran_woi_id' => $sqiitemid,
							'tran_is_hold' => "1",
							'tran_cr_or_dr' => 2,
							'tran_add_or_edit' => 1,
							'tran_ip' => $_SERVER['REMOTE_ADDR'],
							'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
							'tran_cdate' => date('Y-m-d H:i:s'),
							'tran_udate' => date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_transaction',$transaction);


				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_adtype' => $this->session->userdata['miconlogin']['typeid'],
					'adlog_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Store_aprove Edit Item',
					'adlog_add' => 1,
					'adlog_userdetails' => $_SERVER['HTTP_USER_AGENT']
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
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

	public function admin_qty_aprove($data)
	{
		//echo "<pre>"; print_r($data); die;
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$openqty = $data['staff_ori_qty'] - $data['staff_qty'];
		$confirm =array(
			'woi_admin_qty' => $data['staff_qty'],
			'woi_admin_open_qty' => $openqty
		);
		$this->db->where('woi_wo_id', $lid);
		$this->db->where('woi_id', $this->input->get('itm_id'));
		$this->db->update('tbl_Store_aprove_item', $confirm); 
	}
	public function manager_qty_aprove($data)
	{
		//echo "<pre>"; print_r($data); die;
		// $lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		// $openqty = $data['staff_ori_qty'] - $data['staff_qty'];
		// $confirm =array(
		// 	'woi_manager_qty' => $data['staff_qty'],
		// 	'woi_manager_open_qty' => $openqty
		// );
		// $this->db->where('woi_wo_id', $lid);
		// $this->db->where('woi_id', $this->input->get('itm_id'));
		// $this->db->update('tbl_Store_aprove_item', $confirm); 


		$response=array();
		$response['status']=false;
		$response['msg']="";
		$this->db->select('tbl_Store_aprove_item.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_Store_aprove_item.woi_item_id AND tcredit.tran_is_hold = '."'0'".') as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_Store_aprove_item.woi_item_id AND tdebit.tran_is_hold = '."'0'".') as tdebitpoints');
		$this->db->from('tbl_Store_aprove_item');
		$this->db->where('woi_id', $this->input->get('itm_id'));
		$query = $this->db->get();
		$stock_details=$query->row_array();
		$actual_stock=$stock_details['tcreditpoints'] - $stock_details['tdebitpoints'];

		if($actual_stock >= $data['staff_qty'] && $data['staff_ori_qty'] >= ($data['staff_qty'] + $data['staff_complete_qty']))
		{
				$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
			$openqty = $data['staff_ori_qty'] - ($data['staff_qty'] + $data['staff_complete_qty']);
			$confirm =array(
				'woi_manager_qty' => $data['staff_qty'],
				'woi_manager_open_qty' => $openqty
			);
				$this->db->where('woi_wo_id', $lid);
				$this->db->where('woi_id', $this->input->get('itm_id'));
				$this->db->update('tbl_Store_aprove_item', $confirm); 
				$response['status']=true;
		}
		else{
			$response['msg']=$data['staff_ori_qty'] >= ($data['staff_qty'] + $data['staff_complete_qty'])?"Not Enoght stock" : $data['staff_complete_qty']." Alredy Completed.Pl Enter Valid Qty.";
		}
		return $response;
	}
	public function production_qty_aprove($data)
	{
		$response=array();
		$response['status']=false;
		$this->db->select('tbl_Store_aprove_item.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_Store_aprove_item.woi_item_id AND tcredit.tran_is_hold = '."'0'".') as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_Store_aprove_item.woi_item_id AND tdebit.tran_is_hold = '."'0'".') as tdebitpoints');
		$this->db->from('tbl_Store_aprove_item');
		$this->db->where('woi_id', $this->input->get('itm_id'));
		$query = $this->db->get();
		$stock_details=$query->row_array();
		$actual_stock=$stock_details['tcreditpoints'] - $stock_details['tdebitpoints'];

		if($actual_stock >= $data['staff_qty'])
		{
			$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
			$openqty = $data['staff_ori_qty'] - $data['staff_qty'];
			$confirm =array(
				'woi_production_qty ' => $data['staff_qty'],
				'woi_production_open_qty' => $openqty
			);
			$this->db->where('woi_wo_id', $lid);
			$this->db->where('woi_id', $this->input->get('itm_id'));
			$this->db->update('tbl_Store_aprove_item', $confirm); 
			$response['status']=true;
		}
		return $response;
		// $query->result_array();

		
	}
	public function store_qty_aprove($data)
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$openqty = $data['staff_ori_qty'] - $data['staff_qty'];
		$confirm =array(
			'woi_store_qty ' => $data['staff_qty'],
			'woi_store_open_qty' => $openqty
		);
		$this->db->where('woi_wo_id', $lid);
		$this->db->where('woi_id', $this->input->get('itm_id'));
		$this->db->update('tbl_Store_aprove_item', $confirm); 
	}
	public function account_qty_aprove($data)
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$openqty = $data['staff_ori_qty'] - $data['staff_qty'];
		$confirm =array(
			'woi_account_qty ' => $data['staff_qty'],
			'woi_account_open_qty' => $openqty
		);
		$this->db->where('woi_wo_id', $lid);
		$this->db->where('woi_id', $this->input->get('itm_id'));
		$this->db->update('tbl_Store_aprove_item', $confirm); 
	}
	public function dispatch_qty_aprove($data)
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$openqty = $data['staff_ori_qty'] - $data['staff_qty'];
		$confirm =array(
			'woi_dispatch_qty ' => $data['staff_qty'],
			'woi_dispatch_open_qty' => $openqty
		);
		$this->db->where('woi_wo_id', $lid);
		$this->db->where('woi_id', $this->input->get('itm_id'));
		$this->db->update('tbl_Store_aprove_item', $confirm); 
	}
	public function wo_confirm()
	{
		$lid = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
		$confirm =array(
			'wo_confirm_or_not' => 1
		);
		$this->db->where('wo_id', $lid);
		$this->db->update('tbl_Store_aprove', $confirm); 

		$noti = array(
					'wo_noti_woid' => $lid,
					'wo_noti_msg' => "WO Confirm By ".$this->session->userdata['miconlogin']['fname'],
					'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'wo_noti_date' => date('Y-m-d H:i:s')
				);
		$this->db->insert('tbl_Store_aprove_notification',$noti);
		$wonid = $this->db->insert_id();
		$assigndep = array('super_admin','sales_manager','production_manager');
		$this->assign_notification_rights($wonid,$assigndep,$single_user = false,$lid);
	}

	public function assign_notification_rights($wonid,$assigndep,$single_user,$Store_aprove_id)
	{
		if(isset($assigndep) && !empty($assigndep))
		{
			foreach ($assigndep as $dkey => $dep) {
				$depid = 0;
				if($dep == 'super_admin')
				{
					$depid = 12;
				}
				if($dep == 'sales_manager')
				{
					$depid = 10;
				}
				if($dep == 'production_manager')
				{
					$depid = 11;
				}
				if($dep == 'production')
				{
					$depid = 9;
				}
				if($dep == 'store')
				{
					$depid = 5;
				}
				if($dep == 'accounts')
				{
					$depid = 2;
				}
				if($dep == 'dispatch')
				{
					$depid = 4;
				}
				if($dep == 'sales')
				{
					$depid = 1;
				}
				$this->db->select('au_id');
				$this->db->from('tbl_admin_users');
				$this->db->where('au_dep_id',$depid);
				$query = $this->db->get();
				foreach ($query->result_array() as $adkey => $adusers) {
					$insertar = array(
						'wna_fromid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
						'wna_toid' => $adusers['au_id'],
						'wna_dep_id' => $depid,
						'wna_wo_noti_id' => $wonid,
						'wna_read' => 0
						);
					$this->db->insert('tbl_wo_noti_assign',$insertar);
				}
			}
		}
		if(isset($single_user) && is_array($single_user) && !empty($single_user))
		{
			foreach ($single_user as $adkey => $adusers) {
				$insertar = array(
					'wna_fromid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
					'wna_toid' => $adusers['au_id'],
					'wna_dep_id' => 0,
					'wna_wo_noti_id' => $wonid,
					'wna_read' => 0
					);
				$this->db->insert('tbl_wo_noti_assign',$insertar);
			}
		}
		$this->db->select('wo_preparedby');
		$this->db->from('tbl_Store_aprove');
		$this->db->where('wo_id',$Store_aprove_id);
		$query = $this->db->get();
		
		if($query->num_rows() == 1)
		{
			$wodetails = $query->row_array();
			$insertar = array(
				'wna_fromid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
				'wna_toid' => $wodetails['wo_preparedby'],
				'wna_dep_id' => 0,
				'wna_wo_noti_id' => $wonid,
				'wna_read' => 0
				);
			$this->db->insert('tbl_wo_noti_assign',$insertar);
		}
	}
	
	public function edit($data,$id)
	{ 
		
		if(isset($data['sq_brand']) && $data['sq_brand'] != ''){
			$aus_home = json_encode($data['sq_brand']);
		}
		else{
			$aus_home = '';
		}
		$item = array(
			'sq_no' => $data['sq_no'],
			'sq_enq_date' => date("Y-m-d", strtotime($data['sq_enq_date'])),
			'vendor' => $data['vendor'],
			//'sq_remarks' => $data['sq_remarks'],
			'sq_address' => $data['sq_address'],
			'sq_country' => $data['sq_country'],
			'sq_state' => $data['sq_state'],
			'sq_city' => $data['sq_city'],
			'sq_brand' => $aus_home,
			'sq_con_person' => $data['sq_con_person'],
			'sq_email' => $data['sq_email'],
			'sq_phone' => $data['sq_phone'],
			'sq_mobile' => $data['sq_mobile'],
			'sq_website' => $data['sq_website'],
			
			//'sq_party_tax' => $data['sq_party_tax'],
			//'sq_attach' => $data['sq_attach'],
			//'Store_aprove_desc' => $data['Store_aprove_desc'],
			// 'sq_sub_ttl' => $data['itm_subttl'],
			// 'sq_grd_ttl' => $data['itm_grdttl'],
			// 'sq_grd_ttl_words' => $data['grdttlinword'],
			//'sq_cid' => $this->session->userdata['login']['aus_Id'],
			'sq_udate' => $data['sq_udate']
			);
			//echo '<pre>';print_r($item);die;
		$this->db->where('sq_id', $id);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_Store_aprove', $item); 
		//$lid = $this->input->get('id');
		
		return $id;	
}


		
	public function get($id)
	{
		//echo "<pre>";print_r($id);die;
		$this->db->select('*');
		$this->db->from('tbl_Store_aprove');
		//$this->db->join('tbl_master_party','tbl_Store_aprove.vendor = tbl_master_party.master_party_id');
		$this->db->where('wo_id',$id);
		//$this->db->where('dis_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_edit_items()
	{
		$id = $this->encrypt_decrypt('encrypt',$this->uri->segment(3));
		$this->db->select('*');
		$this->db->from('tbl_Store_aprove_item');
		//$this->db->join('tbl_master_party','tbl_Store_aprove.vendor = tbl_master_party.master_party_id');
		$this->db->where('sqi_Store_aprove_id ',$id);
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
		//$this->db->join('tbl_master_party','tbl_Store_aprove.vendor = tbl_master_party.master_party_id');
		$this->db->where('fu_inq_id ',$id);
		$this->db->where('fu_isdelete ',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Executive(){

		$this->db->select('*');
		$this->db->from('tbl_work_order');
		$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby');
		$this->db->where('wo_isdeleted', '0');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();


	}

	public function get_Store_aprove()
	{
		
		$this->db->select('*');//sum(tbl_Store_aprove.inv_grand_total) as grand_total_view
		$this->db->from('tbl_Store_aprove');
		$this->db->where('dis_isdelete',0);
		$this->db->order_by('tbl_Store_aprove.dis_id','DESC');
		// if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
  //       {
  //          $this->db->like('sq_no', $this->input->post('inquiry_number'));   
  //       }
  //       if($this->input->post('vendor_name') && ($this->input->post('vendor_name') != ''))
  //       {
  //          $this->db->like('vendor', $this->input->post('vendor_name'));   
  //       }
  //        if($this->input->post('inquiry_by') && ($this->input->post('inquiry_by') != ''))
  //       {
  //          $this->db->like('aus_FirstName', $this->input->post('inquiry_by'));   
  //       }
  //        if($this->input->post('address') && ($this->input->post('address') != ''))
  //       {
  //          $this->db->like('sq_address', $this->input->post('address'));   
  //       }
  //        if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
  //       {
  //          $this->db->like('sq_email', $this->input->post('email_id'));   
  //       }
  //        if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
  //       {
  //          $this->db->like('sq_phone', $this->input->post('phone_no'));   
  //       }
  //        if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
  //       {
  //          $this->db->like('sq_mobile', $this->input->post('mobile_no'));   
  //       }
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_Store_aprove_report()
	{
		die;
		$this->db->select('*');//sum(tbl_Store_aprove.inv_grand_total) as grand_total_view
		$this->db->from('tbl_Store_aprove');
		$this->db->where('sq_isdeleted',0);
		$this->db->join('tbl_mode_inquiry','tbl_Store_aprove.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id');
		$this->db->join('tbl_admin_users','tbl_Store_aprove.sq_end_st = tbl_admin_users.aus_Id');
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->order_by('tbl_Store_aprove.sq_id','DESC');
		if($this->input->get('party')){
			$this->db->where('tbl_Store_aprove.sq_id', $this->input->get('party'));
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
		if($this->input->post('inquiry_number') && ($this->input->post('inquiry_number') != ''))
        {
           $this->db->like('sq_no', $this->input->post('inquiry_number'));   
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
           $this->db->like('sq_address', $this->input->post('address'));   
        }
         if($this->input->post('email_id') && ($this->input->post('email_id') != ''))
        {
           $this->db->like('sq_email', $this->input->post('email_id'));   
        }
         if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
        {
           $this->db->like('sq_phone', $this->input->post('phone_no'));   
        }
         if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
        {
           $this->db->like('sq_mobile', $this->input->post('mobile_no'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function wo_report()
	{
		//echo "hii"; die;
		$this->db->select('*');
		$this->db->from('tbl_work_order_item');
		$this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
		

		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				//$this->db->where_in('tbl_work_order_item.woi_production_cid', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_Store_aprove.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				//$this->db->where('tbl_work_order_item.woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}

		$dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);

		  if($dep_id ==9) {
       		$this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
       }
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('wo_wo_date >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('wo_wo_date <=',$stdate);
		}
		
	/*	if($this->input->get('au_fname') && ($this->input->get('au_fname') != ''))
        {
           $this->db->where('au_id', $this->input->get('au_fname'));   
        }
*/



		if($this->input->post('wo_wo_no') && ($this->input->post('wo_wo_no') != ''))
        {
           $this->db->like('wo_wo_no', $this->input->post('wo_wo_no'));   
        }
        if($this->input->post('wo_wo_date') && ($this->input->post('wo_wo_date') != ''))
        {
           $this->db->like('wo_wo_date', $this->input->post('wo_wo_date'));   
        }
         if($this->input->post('woi_itm_desc') && ($this->input->post('woi_itm_desc') != ''))
        {
           $this->db->like('woi_part_no', $this->input->post('woi_itm_desc'));   
        }

         if($this->input->post('wo_customer_name') && ($this->input->post('wo_customer_name') != ''))
        {
           $this->db->like('wo_customer_name', $this->input->post('wo_customer_name'));   
        }
        
        
         
        if($this->input->post('woi_qty') && ($this->input->post('woi_qty') != ''))
        {
           $this->db->like('woi_qty', $this->input->post('woi_qty'));   
        }
       
        
       

       if($dep_id ==5) {
       	$this->db->where('woi_store_approve', '1');
       }else if($dep_id ==9) {
       		$this->db->where('woi_production_approve', '3');
       }else if($dep_id ==11) {
       		$this->db->where('woi_promanager_approve', '1');
       }


		
        
        $this->db->order_by('tbl_work_order_item.woi_id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
	//echo "<pre>";print_r($query->result_array());die;
		

		return $query->result_array();
		
	}

	public function wo_pdfdata()
	{
		$this->db->select('*');
		$this->db->from('tbl_Store_aprove');
		$this->db->join('','');
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
			{
				$this->db->where_in('tbl_Store_aprove.wo_id', $this->session->userdata['miconlogin']['all_users']);
				//$this->db->where('tbl_Store_aprove.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}else{
				$this->db->where('tbl_Store_aprove.wo_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
			}
		}
		if($this->input->post('wo_wo_no') && ($this->input->post('wo_wo_no') != ''))
        {
           $this->db->like('wo_wo_no', $this->input->post('wo_wo_no'));   
        }
        if($this->input->post('wo_wo_date') && ($this->input->post('wo_wo_date') != ''))
        {
           $this->db->like('wo_wo_date', $this->input->post('wo_wo_date'));   
        }
         if($this->input->post('wo_customer_name') && ($this->input->post('wo_customer_name') != ''))
        {
           $this->db->like('wo_customer_name', $this->input->post('wo_customer_name'));   
        }
         if($this->input->post('wo_address') && ($this->input->post('wo_address') != ''))
        {
           $this->db->like('wo_address', $this->input->post('wo_address'));   
        }
        
        $this->db->order_by('tbl_Store_aprove.wo_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_all_tax_gst()
	{
		$this->db->select('SUM(tbl_Store_aprove_itax.sqit_tax_amount) as total,UPPER(tbl_Store_aprove_itax.sqit_tax_name) as tax_name, tbl_Store_aprove_itax.*');
		//SUM(IF(itmtax_tax_name = 'CGST', itmtax_tax_amount, 0)) AS 'CGST',
		$this->db->from('tbl_Store_aprove_itax');
		//$this->db->join('tbl_invoice_itmtax','tbl_invoice_item.invi_id = tbl_invoice_itmtax.itmtax_invi_id');
		//$this->db->join('tbl_invoice','tbl_invoice.inv_id = tbl_invoice_itmtax.itmtax_invid');
		$this->db->group_by('tax_name');
		$query = $this->db->get();
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
		$this->db->from('tbl_Store_aprove_itax');
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
		$this->db->from('tbl_Store_aprove_btax');
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

	public function get_pdfdata($id)
	{
		$value = array();
		$this->db->select('*,testedby.au_fname as testedbyf,testedby.au_lname as testedbyl,preparedby.au_fname as preparedbyf,preparedby.au_lname as preparedbyl');
		$this->db->from('tbl_Store_aprove');
		$this->db->join('tbl_admin_users as testedby','tbl_Store_aprove.wo_testedby = testedby.au_id','left');
		$this->db->join('tbl_admin_users as preparedby','tbl_Store_aprove.wo_preparedby = preparedby.au_id','left');
		$this->db->where('tbl_Store_aprove.wo_id',$id);
		$this->db->order_by('tbl_Store_aprove.wo_id','DESC');
		$query = $this->db->get();
		$value['inv'] = $query->row_array();


		$this->db->select('*');
		$this->db->from('tbl_Store_aprove_item');
		$this->db->join('tbl_master_item','tbl_Store_aprove_item.woi_item_id = tbl_master_item.master_item_id','left');
		$this->db->where('tbl_Store_aprove_item.woi_wo_id',$id);
		$this->db->where('tbl_Store_aprove_item.woi_isdelete',0);
		$query = $this->db->get();
		$value['items'] = $query->result_array();
		//***************************************
		
		//echo '<pre>';print_r($value);die;
		return $value;
	}

	public function get_items($id)
	{
		$this->db->select('tbl_Store_aprove_item.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_Store_aprove_item.woi_item_id AND tcredit.tran_is_hold = '."'0'".') as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_Store_aprove_item.woi_item_id AND tdebit.tran_is_hold = '."'0'".') as tdebitpoints');
		$this->db->from('tbl_Store_aprove_item');
		//$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_Store_aprove_item.sqi_itm_hsncode','left');
		//$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_Store_aprove_item.sqi_itm_pno','left');
		$this->db->where('woi_wo_id',$id);
		$this->db->where('woi_isdelete',0);
		$query = $this->db->get();
		$values['itm'] = $query->result_array();
		return $values;
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
		$this->db->from('tbl_Store_aprove');
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
			'sale_quotation_term' => $item['pdetails']['Store_aprove_desc'],
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
		$this->db->from('tbl_Store_aprove_item');
		$this->db->where('sqi_Store_aprove_id',$this->input->get('id'));
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
				$this->db->from('tbl_Store_aprove_itax');
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
		$this->db->from('tbl_Store_aprove_bom');
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
					$this->db->from('tbl_Store_aprove_item');
					$this->db->where('sqi_Store_aprove_id',$this->input->get('id'));
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
					$this->db->from('tbl_Store_aprove_btax');
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
	public function Store_aprove_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_Store_aprove');
		//$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_Store_aprove.vendor');
		if($this->input->get('party')){
			$this->db->where('tbl_Store_aprove.sq_id', $this->input->get('party'));
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
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['date_wise'] = $query->result_array();
	//**************************************************End customer wise
		// $this->db->select('*');
		// $this->db->from('tbl_Store_aprove_item');
		// $this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_Store_aprove_item.sqi_Store_aprove_id');
		// $this->db->join('tbl_Store_aprove', 'tbl_Store_aprove.sq_id = tbl_Store_aprove_item.sqi_Store_aprove_id');
		// if($this->input->get('items')){
		// 	$this->db->where('tbl_Store_aprove_item.sqi_Store_aprove_id', $this->input->get('items'));
		// }
		// if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
		// 	$this->db->where('sq_cdate >=',$stdate);
		// }
		// if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
		// 	$this->db->where('sq_cdate <=',$stdate);
		// }
		// if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
		// 	$this->db->where('sq_enq_date >=',$stdate);
		// }
		// if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		// {
		// 	$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
		// 	$this->db->where('sq_enq_date <=',$stdate);
		// }
		// $query = $this->db->get();
		// //echo'<pre>';print_r($query->result_array());die;
		// $value['item_wise'] =  $query->result_array();	
		//echo'<pre>';print_r($value);die;
	//*************************************************End item wise
	//*************************************************Tax Wise Start
		$this->db->select('*');
		$this->db->from('tbl_tax');
		//$this->db->join('tbl_master_item', 'tbl_master_item.master_item_id = tbl_Store_aprove_item.sqi_Store_aprove_id');
		// $this->db->join('tbl_Store_aprove', 'tbl_Store_aprove.sq_id = tbl_Store_aprove_item.sqi_Store_aprove_id');
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
		$this->db->from('tbl_Store_aprove');
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		$value['customer'] =  $query->result_array();
	//**************************************************End master customer	
		return $value;	
	}

	public function get_excel_certificate()
	{
		$this->db->select('tbl_Store_aprove.sq_id,DATE_FORMAT(tbl_Store_aprove.sq_enq_date, "%d-%m-%Y"),tbl_Store_aprove.vendor,tbl_Store_aprove.sq_con_person,tbl_Store_aprove.sq_mobile,tbl_Store_aprove.sq_email,tbl_master_city.city_name,tbl_master_item.master_item_part_no,tbl_Store_aprove_item.sqi_itm_qty,tbl_Store_aprove_item.sqi_itm_price,tbl_Store_aprove_item.sqi_itm_total,tbl_Store_aprove.sq_end_st,source.source_cat_name as sourcename,tbl_Store_aprove.sq_remarks');//sum(tbl_Store_aprove.inv_grand_total) as grand_total_view
		$this->db->from('tbl_Store_aprove');
		$this->db->join('tbl_Store_aprove_item','tbl_Store_aprove_item.sqi_Store_aprove_id = tbl_Store_aprove.sq_id','left');
		$this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_Store_aprove_item.sqi_itm_pno','left');
		$this->db->join('tbl_mode_inquiry','tbl_Store_aprove.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
		$this->db->join('tbl_country','tbl_Store_aprove.sq_country = tbl_country.country_id','left');
		$this->db->join('tbl_master_city','tbl_Store_aprove.sq_city = tbl_master_city.city_id','left');
		$this->db->join('tbl_master_state','tbl_Store_aprove.sq_state = tbl_master_state.state_id','left');
		$this->db->join('tbl_sale_brand','tbl_Store_aprove.sq_id = tbl_sale_brand.sqb_sqid','left');
		//$this->db->join('tbl_sale_quotation_brand','tbl_Store_aprove.sa_id = tbl_sale_quotation_brand.sab_sq_id','left');
		$this->db->join('tbl_source_cat as source','tbl_Store_aprove.sq_source_cat = source.source_cat_id');
		// $this->db->join('tbl_source_cat as subsource','tbl_Store_aprove.sa_subsource_cat =  subsource.source_main_cat','left');
		//$this->db->join('tbl_admin_users','tbl_Store_aprove.sq_end_st = tbl_admin_users.aus_Id');
		//$this->db->where('tbl_Store_aprove_item.sai_oa_completed',0);
		$this->db->where('tbl_Store_aprove_item.sqi_item_isdelete',0);
		$this->db->where('tbl_Store_aprove.sq_isdeleted',0);
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
		$this->db->where('tbl_Store_aprove.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		
		// if($this->input->get('sq_brand')){
		// 	$this->db->where('tbl_sale_quotation_brand.sab_brand', $this->input->get('sq_brand'));
		// }
		if($this->input->get('sq_brand')){
			$this->db->where('tbl_sale_brand.sqb_bid', $this->input->get('sq_brand'));
		}
		if($this->input->get('vendor')){
			$this->db->where('tbl_Store_aprove.sq_id', $this->input->get('vendor'));
		}
		if($this->input->get('conper')){
			$this->db->where('tbl_Store_aprove.sq_id', $this->input->get('conper'));
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
			$this->db->where('tbl_Store_aprove.sq_country',$this->input->get('country'));
		}
		if($this->input->get('state') && ($this->input->get('state') != ''))
		{
			$this->db->where('tbl_Store_aprove.sq_state',$this->input->get('state'));
		}
		if($this->input->get('city') && ($this->input->get('city') != ''))
		{
			$this->db->where('tbl_Store_aprove.sq_city',$this->input->get('city'));
		}
		if($this->input->get('mobile') && ($this->input->get('mobile') != ''))
		{
			$this->db->where('tbl_Store_aprove.sq_mobile',$this->input->get('mobile'));
		}
		if($this->input->get('status') && ($this->input->get('status') != ''))
		{
			//echo "hi"; die;
			if($this->input->get('status') == 'Active')
			{
				$this->db->where('tbl_Store_aprove.sq_inq_sts',1);
			}
			if($this->input->get('status') == 'Pending')
			{
				$this->db->where('tbl_Store_aprove.sq_inq_sts',2);
			}
			if($this->input->get('status') == 'Completed')
			{
				$this->db->where('tbl_Store_aprove.sq_inq_sts',3);
			}
			
		}
		if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') != ''))
		{
			$this->db->where('tbl_Store_aprove.sq_source_cat',$this->input->get('sq_source_cat'));
		}
		if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') != ''))
		{
			$this->db->where('tbl_Store_aprove.sq_subsource_cat',$this->input->get('sq_subsource_cat'));
		}
		if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') != ''))
		{
			$this->db->where('tbl_Store_aprove.sq_end_st',$this->input->get('sq_end_st'));
		}
		//********************************************************************************************
		
        $this->db->order_by('tbl_Store_aprove.sq_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function wo_no_get()
	{
		$this->db->select('wo_id');
		$this->db->from('tbl_Store_aprove');
		$this->db->order_by('wo_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['wo_id'] = isset($autoid['wo_id']) ? $autoid['wo_id'] : '';
		return $code['pre_Store_aprove'].''.($autoid['wo_id']+1);
	}
    public function get_report_result()
    {
    	$this->db->select('sum(tbl_Store_aprove.sq_grd_ttl) as grand_total_view');
    	$this->db->from('tbl_Store_aprove');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_result_sub()
    {
    	$this->db->select('sum(tbl_Store_aprove_item.sqi_itm_ftotal) as sub_total_view');
    	$this->db->from('tbl_Store_aprove_item');
    	$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
		return $query->result_array();
    }
    public function get_report_tax()
    {
    	$this->db->select('sum(tbl_Store_aprove_itax.sqit_tax_amount) as grand_tax_amount');
    	$this->db->from('tbl_Store_aprove_itax');
    	$query = $this->db->get();
		return $query->result_array();
    }
    public function get_inqno_wise()
    {
    	$this->db->select('*');
		$this->db->from('tbl_Store_aprove');
		$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_Store_aprove.vendor','left');
		$this->db->order_by('tbl_Store_aprove.sq_id','DESC');
    	$query = $this->db->get();
		return $query->result_array();
    }

    public function delete($id)
    {
		$this->db->set('wo_isdeleted',1);
		$this->db->where('wo_id', $id);
		$this->db->update('tbl_Store_aprove');
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Store_aprove',
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

	public function get_customer_information($q)
	{
		$sql = "SELECT * from tbl_master_party WHERE UPPER(master_party_name) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%'";
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['master_party_name']));
				$new_row['value']=htmlentities(stripslashes($row['master_party_name']));
				$new_row['address']=htmlentities(stripslashes($row['master_party_address']));
				$new_row['country']=htmlentities(stripslashes($row['master_party_country']));
				$new_row['state_lists']=$this->get_state($new_row['country']);
				$new_row['state']=htmlentities(stripslashes($row['master_party_state']));
				//get_city
				$new_row['city_lists']=$this->get_city($new_row['state']);

				$new_row['city']=htmlentities(stripslashes($row['master_party_city']));
				$new_row['cperson']=htmlentities(stripslashes($row['master_party_contact_person']));
				$new_row['ctype']=htmlentities(stripslashes($row['master_party_customertype']));
				$new_row['cno']=htmlentities(stripslashes($row['master_party_contact_no']));
				$new_row['phone']=htmlentities(stripslashes($row['master_party_phone']));
				$new_row['customer_id']=htmlentities(stripslashes($row['master_party_id']));
				$new_row['gstno']=htmlentities(stripslashes($row['master_party_gst']));
				$new_row['email']=htmlentities(stripslashes($row['master_party_email_address']));
				$new_row['webaddr']=htmlentities(stripslashes($row['master_party_webpage']));
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

	/*msd code start*/
	public function get_usalesdata($idenc)
	{
		$this->db->select('*');
		$this->db->from('tbl_Store_aprove');
		$this->db->join('tbl_Store_aprove_item', 'tbl_Store_aprove.sq_id = tbl_Store_aprove_item.sqi_Store_aprove_id');
		$this->db->join('tbl_master_item','tbl_Store_aprove_item.sqi_itm_name = tbl_master_item.master_item_id');
		$this->db->where('sq_id', $idenc);
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
	}

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
	public function get_confirm_or_not($id)
	{
		$this->db->select('wo_confirm_or_not');
		$this->db->from('tbl_Store_aprove');
		$this->db->where('wo_id',$id);
		$query = $this->db->get();
		return $query->row_array();
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
	{//tbl_followup_method
		$this->db->select('tbl_Store_aprove.sq_id as id,tbl_Store_aprove.sq_enq_date as inq_dt,tbl_sales_inq_followup.fu_followdate as followdate,tbl_sales_inq_followup.fu_id as fuid,tbl_Store_aprove.sq_no as no,tbl_Store_aprove.sq_con_person as name,tbl_Store_aprove.sq_mobile as mno,tbl_Store_aprove.sq_inq_sts as stname,tbl_admin_users.au_fname as executive,tbl_sales_inq_followup.fu_followupst as folst');
		$this->db->from('tbl_Store_aprove');
		$this->db->join('tbl_sales_inq_followup', 'tbl_sales_inq_followup.fu_inq_id = tbl_Store_aprove.sq_id','left');
		$this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sales_inq_followup.fu_followexe','left');
		//$this->db->where('tbl_sales_inq_followup.fu_followupst',5);
		//$this->db->where('tbl_ubasic_details.bd_bit',1);
		$this->db->order_by('tbl_sales_inq_followup.fu_followdate','desc');
		$this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
		$this->db->where('tbl_Store_aprove.sq_isdeleted',0);
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
			$this->db->where('tbl_Store_aprove.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		if($this->input->post('date') && $this->input->post('date') != ''){
			$this->db->like('tbl_sales_inq_followup.fu_followdate', date("Y-m-d", strtotime($this->input->post('date'))));
		}
		if($this->input->post('name') && $this->input->post('name') != ''){
			$this->db->like('tbl_Store_aprove.sq_con_person', $this->input->post('name'));
		}
		if($this->input->post('cno') && $this->input->post('cno') != ''){
			$this->db->like('tbl_Store_aprove.sq_mobile', $this->input->post('cno'));
		}
		if($this->input->post('cat') && $this->input->post('cat') != ''){
			$this->db->like('tbl_product_category.procat_name', $this->input->post('cat'));
		}
		if($this->input->post('status') && $this->input->post('status') != ''){
			$this->db->like('tbl_Store_aprove.sq_inq_sts', $this->input->post('status'));
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
        $this->db->from('tbl_Store_aprove');
        $this->db->join('tbl_sales_inq_followup','tbl_sales_inq_followup.fu_inq_id = tbl_Store_aprove.sq_id','left');
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
			$this->db->where('tbl_Store_aprove.sq_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		$this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
        $this->db->where('tbl_Store_aprove.sq_isdeleted',0);
        $query = $this->db->get();
        $value['task'] = $query->row_array();
        return $value;
	}
	
	public function get_listofollow()
	{
		/***********************************************************/
        /******************List Of Followup***************************/
        /***********************************************************/
        
        $this->db->select('tbl_Store_aprove.sq_id as id,tbl_Store_aprove.sq_enq_date as inq_dt,tbl_sales_inq_followup.fu_followdate as followdate,tbl_sales_inq_followup.fu_remark as fu_remark,tbl_Store_aprove.sq_mobile as mno,tbl_Store_aprove.sq_con_person as name,tbl_Store_aprove.sq_mobile as no,tbl_Store_aprove.sq_inq_sts as stname,tbl_admin_users.au_fname as executive,tbl_sales_inq_followup.fu_id as fuid,tbl_sales_inq_followup.fu_followupst as folst');
        $this->db->from('tbl_Store_aprove');
         $this->db->join('tbl_sales_inq_followup', 'tbl_sales_inq_followup.fu_inq_id = tbl_Store_aprove.sq_id','left');
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
            $this->db->where('tbl_Store_aprove.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        }
        
        $this->db->where('tbl_sales_inq_followup.fu_isdelete',0);
        $this->db->where('tbl_Store_aprove.sq_isdeleted',0);
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

	public function delete_Store_aprove_item($id,$sa_id)
    {
    	//echo "<pre>"; print_r($sa_id); die;
		$this->db->set('woi_isdelete',1);
		$this->db->where('woi_id', $id);
		$this->db->update('tbl_Store_aprove_item');

		// $this->db->select('SUM(sqi_itm_ftotal) as count');
  //       		$this->db->from('tbl_Store_aprove_item');
  //       		$this->db->where('sqi_item_isdelete',0);
  //       		$this->db->where('sqi_Store_aprove_id',$sa_id);
  //       		$query = $this->db->get();
  //       		$value['count']= $query->row_array();
  //       		//echo "<pre>";print_r($value['count']['count']);die;
  //       		$item = array(
		// 			'sq_grd_ttl' => $value['count']['count']
		// 			);
		// 			//echo '<pre>';print_r($item);die;
		// 		$this->db->where('sq_id',$sa_id);
		// 		$this->db->update('tbl_Store_aprove',$item);

		$this->db->select('SUM(woi_final_price) as count');
        		$this->db->from('tbl_Store_aprove_item');
        		$this->db->where('woi_isdelete','0');
        		$this->db->where('woi_wo_id',$sa_id);
        		$query = $this->db->get();
        		$value['count']= $query->row_array();

        		$this->db->select('*');
        		$this->db->from('tbl_Store_aprove');
        		$this->db->where('wo_id',$sa_id);
        		$query = $this->db->get();
        		$other_value=$query->row_array();

        		//echo "<pre>";print_r($other_value);die;
        		$item = array(
					'wo_fainaltotal' => $value['count']['count'] + $other_value['wo_pf_grandtotal'] + $other_value['wo_fright_grandtotal']
					);
				$this->db->where('wo_id',$sa_id);
				$this->db->update('tbl_Store_aprove',$item);

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Store_aprove Item delete',
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
		//$this->db->select('*');
		//$this->db->like('master_item_name', $q, 'both');
		//$this->db->like('master_item_code', $q, 'before');
		//$this->db->like('master_item_description', $q, 'before');
		
		$sql = "SELECT * from tbl_master_item LEFT JOIN tbl_hsn_code ON 'tbl_master_item.master_item_hsncode = tbl_hsn_code.hsn_id' WHERE UPPER(master_item_part_no) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%'";
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['master_item_part_no']));
				$new_row['value']=htmlentities(stripslashes($row['master_item_part_no']));
				$new_row['autoid']=htmlentities(stripslashes($row['master_item_id']));
				$new_row['title']=htmlentities(stripslashes($row['master_item_name']));
				$new_row['hsncode']=htmlentities(stripslashes($row['master_item_hsncode']));
				$new_row['stock']=htmlentities(stripslashes($row['master_item_stock']));
				$new_row['description']=htmlentities(stripslashes($row['master_item_description']));
				$new_row['rate']=htmlentities(stripslashes($row['master_item_price']));
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
		//$this->db->join('tbl_master_party','tbl_Store_aprove.vendor = tbl_master_party.master_party_id');
		$this->db->where('ctype_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function create_qoute($id)
	{

		//echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
		$enuserid=$this->session->userdata['miconlogin']['userid'];
		$userid= $this->encrypt_decrypt('decrypt', $enuserid);
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_Store_aprove');
		$this->db->where('sq_id',$id);
		$query = $this->db->get();

		$this->db->where('sq_id',$id);
		$stupdate = array('sq_inq_sts'=>4);
		$this->db->update('tbl_Store_aprove',$stupdate);
		
		$value['salesinq'] = $query->row_array();
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
	    $code['pre_quotation'].''.($autoid['sa_id']+1);  
		$item = array(
			'sa_no' =>$code['pre_quotation'].''.($autoid['sa_id']+1),
			'sa_sq_no' => $value['salesinq']['sq_no'],
			'sa_enq_date' => date("Y-m-d", strtotime($value['salesinq']['sq_enq_date'])),
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
			'sale_quotation_sub' => $value['salesinq']['Store_aprove_sub'],
			'sa_priority' => $value['salesinq']['sq_inq_priority'],
			'sa_inq_st' => $value['salesinq']['sq_end_st'],
			//'sq_party_tax' => $data['sq_party_tax'],
			'sa_referred_by' => $value['salesinq']['sq_ref_by'],
			//'sq_attach' => $data['sq_attach'],
			//'sq_grd_ttl_words' => $data['grdttlinword'],
			'sa_remarks' => $value['salesinq']['sq_remarks'],
			'sale_quotation_term' => $value['salesinq']['Store_aprove_desc'],
			'sa_tc_price' => $value['salesinq']['Store_aprove_tc_price'],
			'sa_tc_wrnty' => $value['salesinq']['Store_aprove_tc_wrnty'],
			'sa_tc_pf' => $value['salesinq']['Store_aprove_tc_pf'],
			'sa_tc_deli' => $value['salesinq']['Store_aprove_tc_deli'],
			'sa_tc_paynt' => $value['salesinq']['Store_aprove_tc_paynt'],
			'sa_tc_ovali' => $value['salesinq']['Store_aprove_tc_ovali'],
			'sa_tc_frght' => $value['salesinq']['Store_aprove_tc_frght'],
			'sa_tc_gst' => $value['salesinq']['Store_aprove_tc_gst'],
			//'sa_rem_date' => date("Y-m-d", strtotime($value['salesinq']['sq_rem_date'])),
			'sa_cid' => $userid,
			'sa_isdiscount' => 1,
			'sa_cdate' => date('Y-m-d H:i:s'),
			'sa_udate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>';print_r($item);die;
		$this->db->insert('tbl_sale_quotation',$item);
		$lid = $this->db->insert_id();

		$this->db->select('*');
		$this->db->from('tbl_Store_aprove_item');
		$this->db->where('sqi_Store_aprove_id',$id);
		$this->db->where('sqi_item_isdelete',0);
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
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
					// 'sai_itm_desc' => $itm['sqi_itm_stock'],
					// 'sai_item_cpart_code' => $itm['sqi_itm_opn_qty'],
					'sai_itm_hsncode' => $itm['sqi_itm_hsncode'],
					'sai_itm_desc' => $itm['sqi_itm_desc'],
					'sai_itm_price' => $itm['sqi_itm_price'],
					'sai_itm_discount' => $itm['sqi_itm_discount'],
					'sai_itm_total' => $itm['sqi_itm_ftotal'],
					'sai_isdeleted' => '0',
					//'sai_itm_cid' => $itm['sqi_itm_cid'],
					'sai_item_udate' => date('Y-m-d H:i:s')
					);
				//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_sale_quotation_item',$item);
				}
		}

		$this->db->select('*');
		$this->db->from('tbl_sales_inq_followup');
		$this->db->where('fu_inq_id',$id);
		$this->db->where('fu_isdelete',0);
		$query = $this->db->get();
		//echo'<pre>';print_r($query->result_array());die;
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
					// 'sai_itm_desc' => $itm['sqi_itm_stock'],
					// 'sai_item_cpart_code' => $itm['sqi_itm_opn_qty'],
					'fu_followupst' => $itm['fu_followupst'],
					'fu_remark' => $itm['fu_remark'],
					'fu_isdelete' => 0,
					'fu_udate' => date('Y-m-d H:i:s')
					);
				//echo'<pre>';print_r($item);die;
				$this->db->insert('tbl_sale_quotation_followup',$item);
				}
		}
		
		return $lid;
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
		$this->db->from('tbl_Store_aprove_item');
		$this->db->where('woi_wo_id',$id);
		$this->db->where('woi_id',$itemid);
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
		//echo'<pre>';print_r($data);die;

		foreach ($data as $key => $value) 
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
		//echo "hiii";die;
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
		$this->db->order_by('b2binq_datetime','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
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
}
?>