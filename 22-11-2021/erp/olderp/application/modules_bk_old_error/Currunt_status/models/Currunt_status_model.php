<?php 

class currunt_status_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'cs_name' => $data['cs_name'],
			'cs_adid' => $data['cs_adid'],
			'cs_atype' => $data['cs_atype'],
			'cs_ip' => $this->input->ip_address(),
			'cs_cdate' => $data['cs_cdate'],
			'cs_udate' => $data['cs_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_current_status',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'cs_name' => $data['cs_name'],
			'cs_adid' => $data['cs_adid'],
			'cs_atype' => $data['cs_atype'],
			'cs_ip' => $this->input->ip_address(),
			'cs_udate' => $data['cs_udate']
			);
		$this->db->where('cs_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_current_status', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_current_status');
		$this->db->where('cs_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_currunt_status()
	{
		$this->db->select('*');
		$this->db->from('tbl_current_status');
		$this->db->order_by('cs_id', 'desc');
		$this->db->where('cs_is_delete', '0');
		
		if($this->input->post('cs_name') && ($this->input->post('cs_name') != ''))
        {
           $this->db->like('cs_name', $this->input->post('cs_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('cs_is_delete', '1');
		$this->db->where('cs_id', $id);
		$this->db->update('tbl_current_status');
		return $id;
	}
}
?>