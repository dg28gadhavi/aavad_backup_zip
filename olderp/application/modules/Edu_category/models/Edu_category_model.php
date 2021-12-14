<?php 

class edu_category_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'sub_name' => $data['sub_name'],
			'sub_adid' => $data['sub_adid'],
			'sub_atype' => $data['sub_atype'],
			'sub_ip' => $this->input->ip_address(),
			'sub_cdate' => $data['sub_cdate'],
			'sub_udate' => $data['sub_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_edusubject',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'sub_name' => $data['sub_name'],
			'sub_adid' => $data['sub_adid'],
			'sub_atype' => $data['sub_atype'],
			'sub_ip' => $this->input->ip_address(),
			'sub_udate' => $data['sub_udate']
			);
		$this->db->where('sub_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_edusubject', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_edusubject');
		$this->db->where('sub_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_edu_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_edusubject');
		$this->db->order_by('sub_id', 'desc');
		$this->db->where('sub_is_delete', '0');
		
		if($this->input->post('sub_name') && ($this->input->post('sub_name') != ''))
        {
           $this->db->like('sub_name', $this->input->post('sub_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('sub_is_delete', '1');
		$this->db->where('sub_id', $id);
		$this->db->update('tbl_edusubject');
		return $id;
	}
}
?>