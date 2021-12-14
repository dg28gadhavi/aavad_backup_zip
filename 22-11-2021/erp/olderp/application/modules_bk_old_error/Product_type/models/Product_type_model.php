<?php 

class product_type_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'prot_name' => $data['typ_name'],
			'prot_pro_id' => $data['pro_name'],
			'pro_adid' => $data['pro_adid'],
			'pro_atype' => $data['pro_atype'],
			'pro_ip' => $this->input->ip_address(),
			'pro_cdate' => $data['pro_cdate'],
			'pro_udate' => $data['pro_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_product_type',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'prot_name' => $data['typ_name'],
			'prot_pro_id' => $data['pro_name'],
			'pro_adid' => $data['pro_adid'],
			'pro_atype' => $data['pro_atype'],
			'pro_ip' => $this->input->ip_address(),
			'pro_udate' => $data['pro_udate'],
			);
		$this->db->where('prot_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_product_type', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->where('prot_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_product_type()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_type');
		//$this->db->join('tbl_product', 'tbl_product_type.prot_name  = tbl_product.pro_id');
		$this->db->order_by('prot_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		
		if($this->input->post('prot_name') && ($this->input->post('prot_name') != ''))
        {
           $this->db->like('prot_name', $this->input->post('prot_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function get_products()
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('pro_is_delete', '1');
		$this->db->where('prot_id', $id);
		$this->db->update('tbl_product_type');
		return $id;
	}
}
?>