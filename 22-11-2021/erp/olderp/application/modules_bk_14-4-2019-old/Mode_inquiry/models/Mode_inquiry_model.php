<?php 

class Mode_inquiry_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'mode_inquiry_name' => $data['mode_inquiry_name'],
			'mode_inquiry_cdate' => $data['mode_inquiry_cdate'],
			'mode_inquiry_udate' => $data['mode_inquiry_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_mode_inquiry',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'mode_inquiry_name' => $data['mode_inquiry_name'],
			'mode_inquiry_udate' => $data['mode_inquiry_udate']
			);
		$this->db->where('mode_inquiry_id', $id);
		//$this->db->where('mode_inquiry_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_mode_inquiry', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_mode_inquiry');
		$this->db->where('mode_inquiry_id',$id);
		//$this->db->where('mode_inquiry_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function get_mode_inquiry()
	{
		$this->db->select('*');
		$this->db->from('tbl_mode_inquiry');
		//$this->db->where('mode_inquiry_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_master_item_unit()
	{
		$this->db->select('*');
		$this->db->from('tbl_mode_inquiry');
		//$this->db->where('mode_inquiry_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('inquiry_name') && ($this->input->post('inquiry_name') != ''))
        {
           $this->db->like('mode_inquiry_name', $this->input->post('inquiry_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	// public function delete_mode_inquiry()
	// {
	// 	$this->db->where('mode_inquiry_id', $this->input->get('id'));
	// 	$this->db->delete('tbl_mode_inquiry'); 
	// }

	public function delete($id)
	{
		$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('mode_inquiry_id', $id);
		$this->db->delete('tbl_mode_inquiry');
		return $id;
	}
	
}
?>