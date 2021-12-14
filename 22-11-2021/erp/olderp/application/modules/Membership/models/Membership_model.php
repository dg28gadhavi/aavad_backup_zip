<?php 

class Membership_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'membership_name' => $data['membership_name'],
			'membership_cdate' => $data['membership_cdate'],
			'membership_udate' => $data['membership_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_membership',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'membership_name' => $data['membership_name'],
			'membership_udate' => $data['membership_udate']
			);
		$this->db->where('membership_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_membership', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_membership');
		$this->db->where('membership_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_membership()
	{
		$this->db->select('*');
		$this->db->from('tbl_membership');
		$this->db->order_by('membership_name', 'asc');
		$this->db->where('membership_isdelete', 0);
		
		if($this->input->post('membership_name') && ($this->input->post('membership_name') != ''))
        {
           $this->db->like('membership_name', $this->input->post('membership_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('membership_isdelete', 1);
		$this->db->where('membership_id', $id);
		$this->db->update('tbl_membership');
		return $id;
	}
	
	
}
?>