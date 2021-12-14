<?php 

class Department_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'dep_name' => $data['dep_name'],
			'dep_adid' => $data['dep_adid'],
			'dep_atype' => $data['dep_atype'],
			'dep_ip' => $this->input->ip_address(),
			'dep_cdate' => $data['dep_cdate'],
			'dep_udate' => $data['dep_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_department',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'dep_name' => $data['dep_name'],
			'dep_adid' => $data['dep_adid'],
			'dep_atype' => $data['dep_atype'],
			'dep_ip' => $this->input->ip_address()
			);
		$this->db->where('dep_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_department', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_department');
		$this->db->where('dep_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_department()
	{
		$this->db->select('*');
		$this->db->from('tbl_department');
		$this->db->order_by('dep_id', 'desc');
		$this->db->where('dep_is_delete', '0');
		if($this->input->post('department_name') && ($this->input->post('department_name') != ''))
        {
           $this->db->like('dep_name', $this->input->post('department_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('dep_is_delete', '1');
		$this->db->where('dep_id', $id);
		$this->db->update('tbl_department');
		return $id;
	}
}
?>