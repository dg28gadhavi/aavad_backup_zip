<?php 

class Task_type_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'task_name' => $data['task_name'],
			'task_adid' => $data['task_adid'],
			'task_atype' => $data['task_atype'],
			'task_cdate' => $data['task_cdate'],
			'task_udate' => $data['task_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_master_task_type',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'task_name' => $data['task_name'],
			'task_adid' => $data['task_adid'],
			'task_atype' => $data['task_atype'],
			'task_udate' => $data['task_udate']
			);
		$this->db->where('task_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_master_task_type', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_task_type');
		$this->db->where('task_id',$id);
		$this->db->where('task_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Task_type()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_task_type');
		$this->db->order_by('task_id', 'asc');
		$this->db->where('task_isdelete', '0');
		if($this->input->post('task_name') && ($this->input->post('task_name') != ''))
        {
           $this->db->like('task_name', $this->input->post('task_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('task_isdelete', '1');
		$this->db->where('task_id', $id);
		$this->db->update('tbl_master_task_type');
		return $id;
	}
}
?>