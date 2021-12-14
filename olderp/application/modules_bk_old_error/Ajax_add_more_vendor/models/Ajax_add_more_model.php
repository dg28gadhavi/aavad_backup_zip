<?php 

class Ajax_add_more_model extends CI_Model {
	
	
	public function get_global_masters($tdata)
	{
		$this->db->select(''.$tdata['auto_id'].' as autoid, '.$tdata['result_field'].' as result_field');
		$this->db->from($tdata['table_name']);
		$this->db->where($tdata['delete_id'],'0');
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

	public function get_contact_info($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_party_contact_info');
		$this->db->where('conparty_party_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_address($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_cus_address');
		$this->db->where('mas_add_cus_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

}
?>