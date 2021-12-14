<?php 

class File_stage_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'file_stage_name' => $data['file_stage_name'],
			'file_stage_cdate' => $data['file_stage_cdate'],
			'file_stage_udate' => $data['file_stage_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_file_stage',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'file_stage_name' => $data['file_stage_name'],
			'file_stage_udate' => $data['file_stage_udate']
			);
		$this->db->where('file_stage_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_file_stage', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_file_stage');
		$this->db->where('file_stage_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_file_stage()
	{
		$this->db->select('*');
		$this->db->from('tbl_file_stage');
		$this->db->order_by('file_stage_name', 'asc');
		$this->db->where('file_stage_isdelete', 0);
		if($this->input->post('file_stage_name') && ($this->input->post('file_stage_name') != ''))
        {
           $this->db->like('file_stage_name', $this->input->post('file_stage_name'));   
        }
        if($this->input->post('cdate') && ($this->input->post('cdate') != ''))
        {
           $this->db->like('file_stage_cdate', $this->input->post('cdate'));   
        }
        if($this->input->post('udate') && ($this->input->post('udate') != ''))
        {
           $this->db->like('file_stage_udate', $this->input->post('udate'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('file_stage_isdelete', 1);
		$this->db->where('file_stage_id', $id);
		$this->db->update('tbl_file_stage');
		return $id;
	}

}
?>