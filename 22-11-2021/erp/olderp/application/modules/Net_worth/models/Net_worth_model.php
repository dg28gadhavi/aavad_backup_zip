<?php 

class net_worth_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'nw_name' => $data['nw_name'],
			'nw_adid' => $data['nw_adid'],
			'nw_atype' => $data['nw_atype'],
			'nw_ip' => $this->input->ip_address(),
			'nw_cdate' => $data['nw_cdate'],
			'nw_udate' => $data['nw_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_net_worth',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'nw_name' => $data['nw_name'],
			'nw_adid' => $data['nw_adid'],
			'nw_atype' => $data['nw_atype'],
			'nw_ip' => $this->input->ip_address(),
			'nw_udate' => $data['nw_udate']
			);
		$this->db->where('nw_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_net_worth', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_net_worth');
		$this->db->where('nw_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_net_worth()
	{
		$this->db->select('*');
		$this->db->from('tbl_net_worth');
		$this->db->order_by('nw_id', 'asc');
		$this->db->where('nw_is_delete', '0');
		
		if($this->input->post('nw_name') && ($this->input->post('nw_name') != ''))
        {
           $this->db->like('nw_name', $this->input->post('nw_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('nw_is_delete', '1');
		$this->db->where('nw_id', $id);
		$this->db->update('tbl_net_worth');
		return $id;
	}
}
?>