<?php 

class Category_master_model extends CI_Model {
	
	public function add($data)
	{
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'cat_name' => $data['cat_name'],
			'cat_phid' => $data['cat_phid'],
			'cat_cdate' => $data['Category_master_cdate'],
			'cat_udate' => $data['Category_master_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_category_master',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'cat_name' => $data['cat_name'],
			'cat_phid' => $data['cat_phid'],
			'cat_udate' => date("Y-m-d")
			);
		$this->db->where('cat_id', $id);
		$this->db->update('tbl_category_master', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}

	public function get_plist()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_heads');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category_master');
		$this->db->where('cat_id',$id);
		//$this->db->where('Category_master_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Category_master()
	{
		$this->db->select('*');
		$this->db->from('tbl_category_master');
		$this->db->join('tbl_product_heads','tbl_product_heads.ph_id = tbl_category_master.cat_phid');
		//$this->db->where('Category_master_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('attrib_name') && ($this->input->post('attrib_name') != ''))
        {
           $this->db->like('attrib_name', $this->input->post('attrib_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		$this->db->where('cat_id', $id);
		$this->db->delete('tbl_category_master');
		return $id;
	}
	
}
?>