<?php 

class File_status_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'file_status_name' => $data['file_status_name'],
			'file_status_cdate' => $data['file_status_cdate'],
			'file_status_udate' => $data['file_status_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_file_status',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'file_status_name' => $data['file_status_name'],
			'file_status_udate' => $data['file_status_udate']
			);
		$this->db->where('file_status_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_file_status', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_file_status');
		$this->db->where('file_status_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_file_status()
	{
		$this->db->select('*');
		$this->db->from('tbl_file_status');
		$this->db->order_by('file_status_name', 'asc');
		$this->db->where('file_status_isdelete', 0);
		
		if($this->input->post('file_status_name') && ($this->input->post('file_status_name') != ''))
        {
           $this->db->like('file_status_name', $this->input->post('file_status_name'));   
        }
        if($this->input->post('cdate') && ($this->input->post('cdate') != ''))
        {
           $this->db->like('file_status_cdate', $this->input->post('cdate'));   
        }
        if($this->input->post('udate') && ($this->input->post('udate') != ''))
        {
           $this->db->like('file_status_udate', $this->input->post('udate'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('file_status_isdelete', 1);
		$this->db->where('file_status_id', $id);
		$this->db->update('tbl_file_status');
		return $id;
	}

}
?>