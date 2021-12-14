<?php 

class product_cat_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'procat_name' => $data['procat_name'],
			'product_name' => $data['product_name'],
			'ptype_id' => $data['ptype_id'],
			'procat_adid' => $data['procat_adid'],
			'procat_atype' => $data['procat_atype'],
			'procat_ip' => $this->input->ip_address(),
			'procat_cdate' => $data['procat_cdate'],
			'procat_udate' => $data['procat_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_product_category',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'procat_name' => $data['procat_name'],
			'product_name' => $data['product_name'],
			'ptype_id' => $data['ptype_id'],
			'procat_adid' => $data['procat_adid'],
			'procat_atype' => $data['procat_atype'],
			'procat_ip' => $this->input->ip_address(),
			'procat_udate' => $data['procat_udate']
			);
		$this->db->where('procat_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_product_category', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->where('procat_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_product_cat()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->order_by('procat_id', 'desc');
		$this->db->where('procat_is_delete', '0');
		
		if($this->input->post('procat_name') && ($this->input->post('procat_name') != ''))
        {
           $this->db->like('procat_name', $this->input->post('procat_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('procat_is_delete', '1');
		$this->db->where('procat_id', $id);
		$this->db->update('tbl_product_category');
		return $id;
	}
	
	public function get_products()
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_productype()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_product_typelist($data)
	{
		//echo "hi";die;
		$sql5 = "SELECT prot_id,prot_name,prot_pro_id from tbl_product_type where prot_pro_id = ".$this->db->escape($data['pro_id'])."";
		
		$query = $this->db->query($sql5);
		//echo '<pre>'; print_r($query);die;
		return $query->result_array();
	}
	
}
?>