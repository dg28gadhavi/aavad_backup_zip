<?php 

class inquiry_type_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'inquiry_type_name' => $data['inquiry_type_name'],
			'inquiry_type_cdate' => $data['inquiry_type_cdate'],
			'inquiry_type_udate' => $data['inquiry_type_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_inquiry_type',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'inquiry_type_name' => $data['inquiry_type_name'],
			'inquiry_type_udate' => $data['inquiry_type_udate']
			);
		$this->db->where('inquiry_type_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_inquiry_type', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry_type');
		$this->db->where('inquiry_type_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_inquiry_type()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry_type');
		$this->db->order_by('inquiry_type_id', 'desc');
		$this->db->where('inquiry_type_isdelete', 0);
		
		if($this->input->post('inquiry_type_name') && ($this->input->post('inquiry_type_name') != ''))
        {
           $this->db->like('inquiry_type_name', $this->input->post('inquiry_type_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('inquiry_type_isdelete', 1);
		$this->db->where('inquiry_type_id', $id);
		$this->db->update('tbl_inquiry_type');
		return $id;
	}
}
?>