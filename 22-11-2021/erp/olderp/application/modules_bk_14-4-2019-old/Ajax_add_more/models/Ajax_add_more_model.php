<?php 

class Ajax_add_more_model extends CI_Model {
	
	
	public function get_global_masters($tdata)
	{
		$this->db->select(''.$tdata['auto_id'].' as autoid, '.$tdata['result_field'].' as result_field');
		$this->db->from($tdata['table_name']);
		//$this->db->where($tdata['delete_id'],'0');
		if(isset($tdata['where']) && ($tdata['where'] == 'yes'))
		{ 
			foreach ($tdata['where_fields'] as $where_fields) {
				$this->db->where($where_fields['field'],$where_fields['value']);
			}
		}
		if($tdata['table_name'] == 'tbl_admin_users')
		{
			$this->db->where_in('au_adt_id', array(3,1));
		}
		$this->db->order_by($tdata['order_by_field'],$tdata['order_by']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_country_to_state($country_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_country',$country_id);
		$this->db->where('state_isdelete',0);
		$this->db->order_by('state_name','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_state_to_city($country_id,$state_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_state',$state_id);
		$this->db->where('city_country',$country_id);
		$this->db->where('city_isdelete',0);
		$this->db->order_by('city_name','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_city_to_area($country_id,$state_id,$city_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->where('area_city',$city_id);
		$this->db->where('area_state',$state_id);
		$this->db->where('area_country',$country_id);
		$this->db->where('area_isdelete','0');
		$this->db->order_by('area_name','ASC');
		$query = $this->db->get();
		//echo '<pre>'.$country_id.$state_id.$city_id;print_r($query->result_array());
		return $query->result_array();
	}//

	public function get_ctocity($country_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_country',$country_id);
		$this->db->where('city_isdelete',0);
		$this->db->order_by('city_name','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_area_to_pincode($country_id,$state_id,$city_id,$area_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->where('area_id',$area_id);
		$this->db->where('area_city',$city_id);
		$this->db->where('area_state',$state_id);
		$this->db->where('area_country',$country_id);
		$this->db->where('area_isdelete','0');
		$this->db->order_by('area_name','ASC');
		$query = $this->db->get();
		//echo '<pre>'.$country_id.$state_id.$city_id;print_r($query->result_array());
		return $query->result_array();
	}

	public function get_usalesdata($idenc)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
		$this->db->join('tbl_sales_enq_item', 'tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id');
		$this->db->join('tbl_master_item','tbl_sales_enq_item.sqi_itm_pno = tbl_master_item.master_item_id');
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

	public function get_sifollowup($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_inq_followup');
		$this->db->join('tbl_followup_status', 'tbl_followup_status.inqfus_id = tbl_sales_inq_followup.fu_followupst');
		$this->db->where('fu_inq_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_sqfollowup($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_salesq_followup');
		$this->db->join('tbl_followup_status', 'tbl_followup_status.inqfus_id = tbl_salesq_followup.fu_followupst');
		$this->db->where('fu_inq_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_otherchargs($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_work_order_freight');
		//$this->db->join('tbl_followup_status', 'tbl_followup_status.inqfus_id = tbl_salesq_followup.fu_followupst');
		$this->db->where('wof_wo_order_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_workorderdata($idenc)
	{
		$this->db->select('*');
		$this->db->from('tbl_work_order');
		$this->db->join('tbl_work_order_item', 'tbl_work_order.wo_id = tbl_work_order_item.woi_id','left');
		//$this->db->join('tbl_master_item','tbl_work_order_item.woi_itm_part_no = tbl_master_item.master_item_id','left');
		$this->db->where('wo_id', $idenc);
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
	}
}
?>