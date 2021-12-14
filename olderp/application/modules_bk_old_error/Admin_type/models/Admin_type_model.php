<?php 

class Admin_type_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'adt_name' => $data['adt_name'],
			'adt_ip' => $this->input->ip_address(),
			'adt_cdate' => $data['adt_cdate'],
			'adt_udate' => $data['adt_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_admin_type',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'adt_name' => $data['adt_name'],
			'adt_ip' => $this->input->ip_address()
			);
		$this->db->where('adt_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_admin_type', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_type');
		$this->db->where('adt_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_admin_type()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_type');
		$this->db->order_by('adt_id', 'desc');
		$this->db->where('adt_is_delete', '0');
		if($this->input->post('admin_type') && ($this->input->post('admin_type') != ''))
        {
           $this->db->like('adt_name', $this->input->post('admin_type'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('adt_is_delete', '1');
		$this->db->where('adt_id', $id);
		$this->db->update('tbl_admin_type');
		return $id;
	}
}
?>