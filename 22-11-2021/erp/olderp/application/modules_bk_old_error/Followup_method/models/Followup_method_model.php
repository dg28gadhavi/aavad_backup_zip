<?php 

class Followup_method_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'fu_method_name' => $data['fu_method_name'],
			'fu_method_adid' => $data['fu_method_adid'],
			'fu_method_atype' => $data['fu_method_atype'],
			'fu_method_ip' => $this->input->ip_address(),
			'fu_method_cdate' => $data['fu_method_cdate'],
			'fu_method_udate' => $data['fu_method_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_followup_method',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'fu_method_name' => $data['fu_method_name'],
			'fu_method_adid' => $data['fu_method_adid'],
			'fu_method_atype' => $data['fu_method_atype'],
			'fu_method_ip' => $this->input->ip_address()
			);
		$this->db->where('fu_method_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_followup_method', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_followup_method');
		$this->db->where('fu_method_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_followup_method()
	{
		$this->db->select('*');
		$this->db->from('tbl_followup_method');
		$this->db->order_by('fu_method_id', 'asc');
		$this->db->where('fu_method_is_delete', '0');
		if($this->input->post('followup_method_name') && ($this->input->post('followup_method_name') != ''))
        {
           $this->db->like('fu_method_name', $this->input->post('followup_method_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('fu_method_is_delete', '1');
		$this->db->where('fu_method_id', $id);
		$this->db->update('tbl_followup_method');
		return $id;
	}
}
?>