<?php 

class Tagline_model extends CI_Model {
	
	public function add($data)
	{
		$item = array(
			'tagline_name' => $data['tagline_name'],
			'tagline_status' => $data['tagline_status'],
			'tagline_cdate' => $data['tagline_cdate'],
			'tagline_udate' => $data['tagline_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_tagline',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'tagline_name' => $data['tagline_name'],
			'tagline_status' => $data['tagline_status'],
			'tagline_udate' => date("Y-m-d H:i:s")
			);
		$this->db->where('tagline_id', $id);
		$this->db->update('tbl_tagline', $item); 
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tagline');
		$this->db->where('tagline_id',$id);
		//$this->db->where('Tagline_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Tagline()
	{
		$this->db->select('*');
		$this->db->from('tbl_tagline');
		//$this->db->where('Tagline_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('tagline_name') && ($this->input->post('tagline_name') != ''))
        {
           $this->db->like('tagline_name', $this->input->post('tagline_name'));   
        }
        if($this->input->post('tagline_status') && ($this->input->post('tagline_status') != ''))
        {
           $this->db->like('tagline_status', $this->input->post('tagline_status'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('tagline_id', $id);
		$this->db->delete('tbl_tagline');
		return $id;
	}
	
}
?>