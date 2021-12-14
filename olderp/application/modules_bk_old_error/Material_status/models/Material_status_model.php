<?php 

class material_status_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'ms_name' => $data['ms_name'],
			'ms_adid' => $data['ms_adid'],
			'ms_atype' => $data['ms_atype'],
			'ms_ip' => $this->input->ip_address(),
			'ms_cdate' => $data['ms_cdate'],
			'ms_udate' => $data['ms_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_material_status',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'ms_name' => $data['ms_name'],
			'ms_adid' => $data['ms_adid'],
			'ms_atype' => $data['ms_atype'],
			'ms_ip' => $this->input->ip_address(),
			'ms_udate' => $data['ms_udate']
			);
		$this->db->where('ms_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_material_status', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_material_status');
		$this->db->where('ms_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_material_status()
	{
		$this->db->select('*');
		$this->db->from('tbl_material_status');
		$this->db->order_by('ms_id', 'desc');
		$this->db->where('ms_is_delete', '0');
		
		if($this->input->post('ms_name') && ($this->input->post('ms_name') != ''))
        {
           $this->db->like('ms_name', $this->input->post('ms_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('ms_is_delete', '1');
		$this->db->where('ms_id', $id);
		$this->db->update('tbl_material_status');
		return $id;
	}
}
?>