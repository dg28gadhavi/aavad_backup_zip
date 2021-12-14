<?php 

class Task_type_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'type_of_work_name' => $data['type_of_work_name'],
			'type_of_work_adid' => $data['type_of_work_adid'],
			'type_of_work_atype' => $data['type_of_work_atype'],
			'type_of_work_cdate ' => $data['type_of_work_cdate'],
			'type_of_work_udate' => $data['type_of_work_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_type_of_work',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'type_of_work_name' => $data['type_of_work_name'],
			'type_of_work_adid' => $data['type_of_work_adid'],
			'type_of_work_atype' => $data['type_of_work_atype'],
			'type_of_work_udate' => $data['type_of_work_udate']
			);
		$this->db->where('type_of_work_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_type_of_work', $item);
		//die;
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_type_of_work');
		$this->db->where('type_of_work_id',$id);
		$this->db->where('type_of_work_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_type_of_worktype()
	{
		$this->db->select('*');
		$this->db->from('tbl_type_of_work');
		$this->db->order_by('type_of_work_id', 'asc');
		$this->db->where('type_of_work_isdelete', '0');
		if($this->input->post('type_of_workname') && ($this->input->post('type_of_workname') != ''))
        {
           $this->db->like('type_of_workname', $this->input->post('type_of_workname'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('type_of_work_isdelete', '1');
		$this->db->where('type_of_work_id', $id);
		$this->db->update('tbl_type_of_work');
		return $id;
	}
}
?>