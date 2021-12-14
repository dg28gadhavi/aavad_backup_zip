<?php 

class Payment_report_model extends CI_Model {
	
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
		//echo "<pre>";print_r($data);die;
		$item = array(
			'crp_customerid' => $data['vendor_id'],
			'crp_customer' => $data['vendor'],
			'crp_amt' => $data['crp_amt'],
			'crp_type' => $data['crp_type'],
			'crp_bankname' => $data['crp_bankname'],
			'crp_refno' => $data['crp_refno'],
			'crp_invno' => $data['crp_invno'],
			'crp_paymentdate' => date("Y-m-d", strtotime($data['crp_paymentdate'])),
			'crp_remark' => $data['crp_remark'],
			'crp_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'crp_cdate' => $data['crp_cdate'],
			'crp_udate' => $data['crp_cdate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_credit_payment',$item);
		$lid = $this->db->insert_id();

		$item = array(
			'tran_payment_crpid' => $lid,
			'tran_payment_customer_id' => $data['vendor_id'],
			'tran_paymentitm_amt' => $data['crp_amt'],
			'tran_paymentcr_or_dr' => 1,
            'tran_paymentadd_or_edit' => 1,
            'tran_paymentip' => $_SERVER['REMOTE_ADDR'],
            'tran_paymentcid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
            'tran_paymentcdate' => date('Y-m-d H:i:s'),
            'tran_paymentudate' => date('Y-m-d H:i:s')
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_payment',$item);

		if(isset($data['crp_invno']) && ($data['crp_invno'] != 0))
		{
			$this->db->where('otw_id',$data['crp_invno']);
			$this->db->set('otw_paymentrecive', 'otw_paymentrecive + '.$data['crp_amt'], FALSE);
			$this->db->update('tbl_outward');

			$sql = "UPDATE  tbl_outward SET otw_pay_complete = CASE WHEN otw_paymentrecive >= otw_invftotal_withgst THEN '1' ELSE '0' END WHERE otw_id = ".$data['crp_invno'];
			$this->db->query($sql);
		}

		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'Payment_report_name' => $data['Payment_report_name'],
			'Payment_report_state' => $data['Payment_report_state'],
			'Payment_report_country' => $data['Payment_report_country']
			//'Payment_report_roe' => $data['Payment_report_roe'],
			//'Payment_report_udate' => $data['Payment_report_udate']
			);
		$this->db->where('Payment_report_id', $id);
		//$this->db->where('Payment_report_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_Payment_report', $item); 
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_Payment_report');
		$this->db->where('Payment_report_id',$id);
		//$this->db->where('Payment_report_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Payment_report()
	{
		$this->db->select('tbl_payment.*,tbl_master_party.*,(select ROUND(SUM(tcredit.tran_paymentitm_amt),2) as tcreditpoints FROM tbl_payment as tcredit WHERE tcredit.tran_paymentcr_or_dr = 1 AND tcredit.tran_payment_customer_id = tbl_payment.tran_payment_customer_id) as tcreditpoints,(select ROUND(SUM(tdebit.tran_paymentitm_amt),2) as tdebitpoints FROM tbl_payment as tdebit WHERE tdebit.tran_paymentcr_or_dr = 2 AND tdebit.tran_payment_customer_id = tbl_payment.tran_payment_customer_id) as tdebitpoints');
		$this->db->from('tbl_payment');
		$this->db->order_by('tran_paymentid', 'desc');
		//$this->db->where('tran_paymentcr_or_dr', 2);
		$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_payment.tran_payment_customer_id');
		$this->db->group_by("tbl_payment.tran_payment_customer_id");
		if($this->input->post('tran_payment_customer') && ($this->input->post('tran_payment_customer') != ''))
		{
			$str_vendor = $this->input->post('tran_payment_customer');
			$this->db->like('UPPER(master_party_com_name)', strtoupper($str_vendor));
		}
		$this->db->where('IFNULL((select ROUND(SUM(tdebit.tran_paymentitm_amt),2) as tdebitpoints FROM tbl_payment as tdebit WHERE tdebit.tran_paymentcr_or_dr = 2 AND tdebit.tran_payment_customer_id = tbl_payment.tran_payment_customer_id),0) - IFNULL((select ROUND(SUM(tcredit.tran_paymentitm_amt),2) as tcreditpoints FROM tbl_payment as tcredit WHERE tcredit.tran_paymentcr_or_dr = 1 AND tcredit.tran_payment_customer_id = tbl_payment.tran_payment_customer_id),0) >',0);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Payment_overall()
	{
		$this->db->select('tbl_payment.*,tbl_credit_payment.*,tbl_master_party.*,(select ROUND(SUM(tcredit.tran_paymentitm_amt),2) as tcreditpoints FROM tbl_payment as tcredit WHERE tcredit.tran_paymentcr_or_dr = 1 AND tcredit.tran_payment_customer_id = tbl_payment.tran_payment_customer_id) as tcreditpoints,(select ROUND(SUM(tdebit.tran_paymentitm_amt),2) as tdebitpoints FROM tbl_payment as tdebit WHERE tdebit.tran_paymentcr_or_dr = 2 AND tdebit.tran_payment_customer_id = tbl_payment.tran_payment_customer_id) as tdebitpoints');
		$this->db->from('tbl_payment');
		$this->db->order_by('tran_paymentid', 'desc');
		$this->db->join('tbl_credit_payment', 'tbl_credit_payment.crp_id = tbl_payment.tran_payment_crpid','left');
		$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_payment.tran_payment_customer_id');
		if($this->input->post('master_party_com_name') && ($this->input->post('master_party_com_name') != ''))
		{
			//die;
			$str_vendor = $this->input->post('master_party_com_name');
			$this->db->like('UPPER(master_party_com_name)', strtoupper($str_vendor));
		}
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('tran_paymentudate >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('tran_paymentudate <=',$stdate);
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Payment_inv_wise()
	{
		$this->db->select('tbl_work_order.*,otw_id as auto_id,otw_customer_name,otw_invno,otw_invdate,otw_invftotal_withgst,otw_paymentrecive,');
		$this->db->from('tbl_outward');
		$this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
		$this->db->order_by('otw_invdate', 'desc');
		//$this->db->where('tran_paymentcr_or_dr', 2);
		$this->db->where('otw_pay_complete','0');
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('otw_invdate >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('otw_invdate <=',$stdate);
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(otw_customer_name)', strtoupper($str_vendor));
		}
		if($this->input->post('otw_customer_name') && ($this->input->post('otw_customer_name') != ''))
		{
			$str_vendor = $this->input->post('otw_customer_name');
			$this->db->like('UPPER(otw_customer_name)', strtoupper($str_vendor));
		}
		if($this->input->post('otw_invno') && ($this->input->post('otw_invno') != ''))
		{
			$str_vendor = $this->input->post('otw_invno');
			$this->db->like('UPPER(otw_invno)', strtoupper($str_vendor));
		}
		if($this->input->post('otw_invdate') && ($this->input->post('otw_invdate') != ''))
		{
			$str_vendor = $this->input->post('otw_invdate');
			$this->db->like('otw_invdate', $str_vendor);
		}
		if($this->input->post('otw_invftotal_withgst') && ($this->input->post('otw_invftotal_withgst') != ''))
		{
			$str_vendor = $this->input->post('otw_invftotal_withgst');
			$this->db->like('otw_invftotal_withgst', $str_vendor);
		}
		if($this->input->post('otw_paymentrecive') && ($this->input->post('otw_paymentrecive') != ''))
		{
			$str_vendor = $this->input->post('otw_paymentrecive');
			$this->db->like('otw_paymentrecive', $str_vendor);
		}
		if($this->input->post('wo_po_no') && ($this->input->post('wo_po_no') != ''))
		{
			$str_vendor = $this->input->post('wo_po_no');
			$this->db->like('wo_po_no', $str_vendor);
		}
		if($this->input->post('wo_po_date') && ($this->input->post('wo_po_date') != ''))
		{
			$str_vendor = $this->input->post('wo_po_date');
			$this->db->like('wo_po_date', $str_vendor);
		}
		if($this->input->post('wo_paymentterms') && ($this->input->post('wo_paymentterms') != ''))
		{
			$str_vendor = $this->input->post('wo_paymentterms');
			$this->db->like('wo_paymentterms', $str_vendor);
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_inqmaildata()
	{
		$this->db->select('tbl_work_order.*,otw_id as auto_id,otw_customer_name,otw_invno,otw_invdate,otw_invftotal_withgst,otw_paymentrecive,');
		$this->db->from('tbl_outward');
		$this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
		$this->db->order_by('otw_invdate', 'desc');
		//$this->db->where('tran_paymentcr_or_dr', 2);
		$this->db->where('otw_pay_complete','0');
		if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('otw_invdate >=',$stdate);
		}
		if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('otw_invdate <=',$stdate);
		}
		if($this->input->get('vendor') && ($this->input->get('vendor') != ''))
		{
			//echo "<pre>";print_r($this->input->get('vendor'));die;
			$str_vendor = $this->input->get('vendor');
			$this->db->like('UPPER(otw_customer_name)', strtoupper($str_vendor));
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
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
	
	public function delete($id)
	{
		$this->db->set('Payment_report_isdelete', 1);
		$this->db->where('Payment_report_id', $id);
		$this->db->update('tbl_master_Payment_report');
	}
    
    public function get_country_from_country()
    { 
    	$this->db->select('*');
        $this->db->from('tbl_master_state');
        //$this->db->join('tbl_country','tbl_country.country_id = tbl_master_state.state_country');
        $this->db->order_by('state_id', 'desc');
        //$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_state.state_country');
        $this->db->where('state_country', $this->input->post('state_id'));
        $query = $this->db->get();
        $value = $query->result_array();
        //echo(json_encode($value));
        return $value;
    }

     public function get_state($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_isdelete', 0);
        $this->db->where('state_country', $id);
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_inv_no()
    {
        $this->db->select('*');
        $this->db->from('tbl_outward');
        $this->db->where('otw_isdelete', 0);
        $this->db->where('otw_pay_complete', '0');
        if($this->input->get("customerid") && ($this->input->get("customerid") != 0) && ($this->input->get("customerid") != '')){
        	$this->db->where('otw_customer_id', $this->input->get("customerid"));
        }else{
        	$this->db->where('otw_customer_id',0);
        }
        $this->db->order_by('otw_invno', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }
	
	/*public function addtPayment_report()
	{
		
		$this->db->select('Payment_report as Payment_report_name');
		$this->db->from('Payment_report');
		$query = $this->db->get();
		foreach ($query->result_array() as $Payment_report) {
			  $this->db->insert('tbl_master_Payment_report',$Payment_report);
		}
	}
	public function get_addressbook() 
	{     
        $query = $this->db->get('tbl_Payment_report');
       //echo "<pre>"; print_r($query);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	*/
	 public function insert_csv() 
    {
    	//$data['addressbook'] = $this->csv_model->get_addressbook();
        //echo "string";die;
        $data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 		
        $this->load->library('upload', $config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            $this->data['main_content'] = 'importcsv_view';
		$this->load->view('includes/template',$this->data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
               // echo "<pre>"; print_r($csv_array);die;
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'name'=>$row['Baroda House S.O'],
                        //'Payment_report_cdate'=>date("Y-m-d"),
                        //'Payment_report_udate'=>date("Y-m-d"),
                    );
                    $this->db->insert('tbl_Payment_report', $insert_data);
                    //$this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                redirect(base_url('Payment_report'), 'refresh');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
              	 $this->data['main_content'] = 'importcsv_view';
				$this->load->view('includes/template',$this->data,$data);
                //$this->load->view('csvindex', $data);
            }
    }
}
?>