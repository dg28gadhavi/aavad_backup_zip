<?php 

class Inquiry_status_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'inquiry_status_name' => $data['inquiry_status_name'],
			'inquiry_status_cdate' => $data['inquiry_status_cdate'],
			'inquiry_status_udate' => $data['inquiry_status_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_inquiry_status',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'inquiry_status_name' => $data['inquiry_status_name'],
			'inquiry_status_udate' => $data['inquiry_status_udate']
			);
		$this->db->where('inquiry_status_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_inquiry_status', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status');
		$this->db->where('inquiry_status_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_inquiry_status()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status');
		$this->db->order_by('inquiry_status_id', 'desc');
		$this->db->where('inquiry_status_isdelete', 0);
		
		if($this->input->post('inquiry_status_name') && ($this->input->post('inquiry_status_name') != ''))
        {
           $this->db->like('inquiry_status_name', $this->input->post('inquiry_status_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('inquiry_status_isdelete', 1);
		$this->db->where('inquiry_status_id', $id);
		$this->db->update('tbl_inquiry_status');
		return $id;
	}
}
?>