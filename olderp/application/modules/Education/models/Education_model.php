<?php 

class Education_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'edu_name' => $data['edu_name'],
			'edu_adid' => $data['edu_adid'],
			'edu_atype' => $data['edu_atype'],
			'edu_ip' => $this->input->ip_address(),
			'edu_cdate' => $data['edu_cdate'],
			'edu_udate' => $data['edu_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_education',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'edu_name' => $data['edu_name'],
			'edu_adid' => $data['edu_adid'],
			'edu_atype' => $data['edu_atype'],
			'edu_ip' => $this->input->ip_address(),
			'edu_udate' => $data['edu_udate']
			);
		$this->db->where('edu_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_education', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_education');
		$this->db->where('edu_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_education()
	{
		$this->db->select('*');
		$this->db->from('tbl_education');
		$this->db->order_by('edu_id', 'desc');
		$this->db->where('edu_is_delete', '0');
		
		if($this->input->post('edu_name') && ($this->input->post('edu_name') != ''))
        {
           $this->db->like('edu_name', $this->input->post('edu_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('edu_is_delete', '1');
		$this->db->where('edu_id', $id);
		$this->db->update('tbl_education');
		return $id;
	}
}
?>