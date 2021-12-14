<?php 

class Product_heads_model extends CI_Model {
	
	public function add($data)
	{
		$item = array(
			'ph_name' => $data['Product_heads_name'],
			'ph_cdate' => $data['Product_heads_cdate'],
			'ph_udate' => $data['Product_heads_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_product_heads',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'ph_name' => $data['Product_heads_name'],
			'ph_udate' => date("Y-m-d")
			);
		$this->db->where('ph_id', $id);
		$this->db->update('tbl_product_heads', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_heads');
		$this->db->where('ph_id',$id);
		//$this->db->where('Product_heads_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Product_heads()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_heads');
		//$this->db->where('Product_heads_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('ph_name') && ($this->input->post('ph_name') != ''))
        {
           $this->db->like('ph_name', $this->input->post('ph_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('ph_id', $id);
		$this->db->delete('tbl_product_heads');
		return $id;
	}
	
}
?>