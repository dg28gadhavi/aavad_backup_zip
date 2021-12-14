<?php 

class inquiry_follow_satus_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'inqfus_name' => $data['inqfus_name'],
			'inqfus_adid' => $data['inqfus_adid'],
			'inqfus_atype' => $data['inqfus_atype'],
			'inqfus_ip' => $this->input->ip_address(),
			'inqfus_name' => $data['inqfus_name'],
			'inqfus_cdate' => $data['inqfus_cdate'],
			'inqfus_udate' => $data['inqfus_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_followup_status',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'inqfus_name' => $data['inqfus_name'],
			'inqfus_adid' => $data['inqfus_adid'],
			'inqfus_atype' => $data['inqfus_atype'],
			'inqfus_ip' => $this->input->ip_address(),
			'inqfus_name' => $data['inqfus_name'],
			'inqfus_udate' => $data['inqfus_udate']
			);
		$this->db->where('inqfus_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_followup_status', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_followup_status');
		$this->db->where('inqfus_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_inquiry_follow_satus()
	{
		$this->db->select('*');
		$this->db->from('tbl_followup_status');
		$this->db->order_by('inqfus_id', 'desc');
		$this->db->where('inqfus_is_delete', '0');
		
		if($this->input->post('inqfus_name') && ($this->input->post('inqfus_name') != ''))
        {
           $this->db->like('inqfus_name', $this->input->post('inqfus_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('inqfus_is_delete', '1');
		$this->db->where('inqfus_id', $id);
		$this->db->update('tbl_followup_status');
		return $id;
	}
}
?>