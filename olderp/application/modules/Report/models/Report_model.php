<?php 

class Report_model extends CI_Model {
	
	
	
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_report()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaction');
		$this->db->join('tbl_admin_users','tbl_transaction.tran_cid = tbl_admin_users.au_id','left');
		$this->db->join('tbl_master_item','tbl_transaction.tran_itm_id = tbl_master_item.master_item_id','left');
		if($this->input->get('created_start_date') && ($this->input->get('created_start_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_start_date')));
			$this->db->where('tran_cdate >=',$stdate);
		}
		if($this->input->get('created_end_date') && ($this->input->get('created_end_date') != ''))
		{
			$stdate = date("Y-m-d", strtotime($this->input->get('created_end_date')));
			$this->db->where('tran_udate <=',$stdate);
		}
		if($this->input->get('itemname') && ($this->input->get('itemname') != ''))
		{
			$item = $this->input->get('itemname');
			$this->db->where('tbl_master_item.master_item_id',$item);
		}
		if($this->input->get('admin') && ($this->input->get('admin') != ''))
		{
			$admin = $this->input->get('admin');
			$this->db->where('tbl_admin_users.au_id',$admin);
		}
		if($this->input->get('credit')){
			$this->db->where('tran_cr_or_dr', $this->input->get('credit'));
		}
		if($this->input->post('admin') && ($this->input->post('admin') != ''))
        {
           $this->db->like('tbl_admin_users.au_fname', $this->input->post('admin'));   
        }
		if($this->input->post('itemname') && ($this->input->post('itemname') != ''))
        {
           $this->db->like('tbl_master_item.master_item_name', $this->input->post('itemname'));   
        }
        if($this->input->post('qty') && ($this->input->post('qty') != ''))
        {
           $this->db->like('tran_itm_qty', $this->input->post('qty'));   
        }
		if($this->input->post('inward') && ($this->input->post('inward') != ''))
        {
           $this->db->like('tran_inw_id', $this->input->post('inward'));   
        }
		if($this->input->post('outwrd') && ($this->input->post('outwrd') != ''))
        {
           $this->db->like('tran_otw_id', $this->input->post('outwrd'));   
        }
		if($this->input->post('credit') && ($this->input->post('credit') != ''))
        {
           $this->db->like('tran_cr_or_dr', $this->input->post('credit'));   
        }
        $this->db->order_by('tran_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	
	public function get_admin()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_items()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('country_isdelete', 1);
		$this->db->where('country_id', $id);
		$this->db->update('tbl_country');
		return $id;
	}
	
	/*public function addtcountry()
	{
		
		$this->db->select('country as country_name');
		$this->db->from('country');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_country',$city);
		}
	}*/

	public function copy_datatable()
	{
		 //echo "hjiii";die();	
		$this->db->select('*');
		$this->db->from('tbl_dispatch_old');
		$this->db->join('tbl_master_party','tbl_dispatch_old.dispatch_party_id = tbl_master_party.master_party_id','left');
		$query = $this->db->get();
		$olddata = $query->result_array();
		//echo "<pre>";print_r($olddata);die();

		foreach ($olddata as $key => $value)
		 {
			//echo "<pre>";print_r($value);die();
			$newdata = array(
				'dis_no' => $value['dispatch_code'],
				'dis_vendor' => isset($value['master_party_name']) ? $value['master_party_name'] : '',
				'dis_party_name' =>isset( $value['master_party_name']) ?  $value['master_party_name'] : '',
				'dis_cust_name' => isset($value['master_party_name']) ? $value['master_party_name'] : '',
				'dis_cust_address' => isset($value['master_party_address']) ? $value['master_party_address'] : '',
				'dis_po_no' => isset($value['dispatch_po_no']) ? $value['dispatch_po_no'] : '',
				'dis_po_date' => isset($value['dispatch_po_date']) ? $value['dispatch_po_date'] : '',
				'dis_docket_no' => isset($value['dispatch_docket_no']) ? $value['dispatch_docket_no'] : '',
				'dis_docket_date' => isset($value['dispatch_date']) ? $value['dispatch_date'] : '',
				'dis_job_cno' => isset($value['dispatch_wo_no']) ? $value['dispatch_wo_no'] : '',
				'dis_courier_name' => isset($value['dispatch_courier_name']) ? $value['dispatch_courier_name'] : '',
				'dis_courier_type' => isset($value['dispatch_courier_type']) ? $value['dispatch_courier_type'] : '',
				'dis_remark' => isset($value['dispatch_remark']) ? $value['dispatch_remark'] : '',
				'dis_cid' => isset($value['dispatch_admin_id']) ? $value['dispatch_admin_id'] : '',
				'dis_cdate' => isset($value['dispatch_created_date']) ? $value['dispatch_created_date'] : '',
				'dis_udate' => isset($value['dispatch_updated_date']) ? $value['dispatch_updated_date'] : ''
				);
				//echo '<pre>';print_r($item);die;
				$this->db->insert('tbl_dispatch',$newdata);
		}
		

	}	
	public function copy_item()
	{
		$this->db->select('*');
		$this->db->from('tbl_dispatch_item_old');
		$this->db->join('tbl_master_item_olddd','tbl_dispatch_item_old.dispatch_session_item_id = tbl_master_item_olddd.master_item_id','left');
		$query = $this->db->get();
		$olddata = $query->result_array();
		//echo "<pre>";print_r($olddata);die();
		foreach ($olddata as $key => $value)
		 {
			//echo "<pre>";print_r($value);die();
			$newdata = array(
			'disi_dispatch_id' => isset($value['dispatch_session_dispatch_id']) ? $value['dispatch_session_dispatch_id'] : '',
				'disi_itm_name' => isset($value['dispatch_session_item_id']) ? $value['dispatch_session_item_id'] : '',
				'disi_itm_code' => isset($value['dispatch_session_item_code']) ? $value['dispatch_session_item_code'] : '',
				'disi_itm_title' => isset($value['dispatch_session_item_name']) ? $value['dispatch_session_item_name'] : '',
				'disi_partno' => isset($value['dispatch_session_item_part_no']) ? $value['dispatch_session_item_part_no'] : '',
				'disi_qty' => isset($value['dispatch_session_item_qty']) ? $value['dispatch_session_item_qty'] : '',
				'disi_unit' => isset($value['dispatch_session_item_unit']) ? $value['dispatch_session_item_unit'] : '',
				'disi_itm_price' => isset($value['dispatch_session_item_price']) ? $value['dispatch_session_item_price'] : '',
				'disi_itm_total' => isset($value['dispatch_session_item_amount']) ? $value['dispatch_session_item_amount'] : '',
		'disi_itm_discount' => isset($value['dispatch_session_item_discount']) ? $value['dispatch_session_item_discount'] : '',
				'disi_ftotal' => isset($value['dispatch_session_item_ftotal']) ? $value['dispatch_session_item_ftotal'] : '',
				'disi_udate' => isset($value['dispatch_session_created_date']) ? $value['dispatch_session_created_date'] : '',
			);
			//echo '<pre>';print_r($item);die;
			$this->db->insert('tbl_dispatch_item',$newdata);
			
		 }
	}
	public function item_stock()
	{
			$this->db->select('*');
			$this->db->from('tbl_master_item');
			$query = $this->db->get();
			$olddata = $query->result_array();
			//echo "<pre>";print_r($olddata);die();
			foreach ($olddata as $key => $value)
			{
				echo "<pre>";print_r($value);die();
				
			}

	}

}
?>