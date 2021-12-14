<?php 

class Tax_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'tax_name' => $data['tax_name'],
			'tax_amount' => $data['tax_amount'],
			'tax_informat' => $data['tax_informat'],
			'tax_usedfor' => $data['tax_usedfor'],
			'master_party_tax' => $data['master_party_tax'],
			'tax_cdate' => $data['tax_cdate'],
			'tax_udate' => $data['tax_udate']
			);
		$this->db->insert('tbl_tax',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'tax_name' => $data['tax_name'],
			'tax_amount' => $data['tax_amount'],
			'tax_informat' => $data['tax_informat'],
			'tax_usedfor' => $data['tax_usedfor'],
			'master_party_tax' => $data['master_party_tax'],
			'tax_udate' => $data['tax_udate']
			);
		$this->db->where('tax_id', $id);
		//$this->db->where('tax_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_tax', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('tax_id', $id);
		$this->db->delete('tbl_tax');
		return $id;
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$this->db->where('tax_id',$id);
		//$this->db->where('tax_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_tax()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		//$this->db->where('tax_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_tax_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax_category');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
}
?>