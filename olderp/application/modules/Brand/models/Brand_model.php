<?php 

class Brand_model extends CI_Model {
	
	public function add($data)
	{
		$item = array(
			'brand_name' => $data['brand_name'],
			'brand_cdate' => $data['brand_cdate'],
			'brand_udate' => $data['brand_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_brand',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'brand_name' => $data['brand_name'],
			'brand_udate' => date("Y-m-d")
			);
		$this->db->where('brand_id', $id);
		$this->db->update('tbl_brand', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_id',$id);
		//$this->db->where('brand_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_brand()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		//$this->db->where('brand_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('brand_name') && ($this->input->post('brand_name') != ''))
        {
           $this->db->like('brand_name', $this->input->post('brand_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('brand_id', $id);
		$this->db->delete('tbl_brand');
		return $id;
	}
	
}
?>