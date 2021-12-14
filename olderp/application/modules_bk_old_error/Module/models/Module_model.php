<?php 

class Module_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'module_name' => $data['module_name'],
			'module_order' => $data['module_order'],
			'module_adid' => $data['module_adid'],
			'module_atype' => $data['module_atype'],
			'module_ip' => $this->input->ip_address(),
			'module_udate' => $data['module_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_module',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'module_name' => $data['module_name'],
			'module_order' => $data['module_order'],
			'module_adid' => $data['module_adid'],
			'module_atype' => $data['module_atype'],
			'module_ip' => $this->input->ip_address()
			);
		$this->db->where('module_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_module', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_module');
		$this->db->where('module_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_module()
	{
		$this->db->select('*');
		$this->db->from('tbl_module');
		$this->db->order_by('module_order', 'asc');
		//$this->db->where('module_is_delete', '0');
		if($this->input->post('module_name') && ($this->input->post('module_name') != ''))
        {
           $this->db->like('module_name', $this->input->post('module_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
}
?>