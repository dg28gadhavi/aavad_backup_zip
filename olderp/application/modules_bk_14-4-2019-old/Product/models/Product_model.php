<?php 

class product_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'pro_name' => $data['pro_name'],
			'pro_adid' => $data['pro_adid'],
			'pro_atype' => $data['pro_atype'],
			'pro_ip' => $this->input->ip_address(),
			'pro_cdate' => $data['pro_cdate'],
			'pro_udate' => $data['pro_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_product',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'pro_name' => $data['pro_name'],
			'pro_adid' => $data['pro_adid'],
			'pro_atype' => $data['pro_atype'],
			'pro_ip' => $this->input->ip_address(),
			'pro_udate' => $data['pro_udate']
			);
		$this->db->where('pro_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_product', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('pro_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_product()
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->order_by('pro_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		
		if($this->input->post('pro_name') && ($this->input->post('pro_name') != ''))
        {
           $this->db->like('pro_name', $this->input->post('pro_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('pro_is_delete', '1');
		$this->db->where('pro_id', $id);
		$this->db->update('tbl_product');
		return $id;
	}
}
?>