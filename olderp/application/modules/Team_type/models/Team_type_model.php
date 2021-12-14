<?php 

class Team_type_model extends CI_Model {
	
	public function add($data)
	{
		//echo "<pre>";print_r($data);die();
		$item = array(
			'ag_teamname' => $data['ag_teamname'],
			'ag_udate' => $data['Team_type_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_admin_group',$item);
		$lid = $this->db->insert_id();
		//echo '<pre>'; print_r($data['group_id']);die;
		foreach ($data['group_id'] as $key => $value) 
		{
			$item = array(
			'agi_ag_id' => $lid,
			'agi_adminid' => $value,
			'agi_udate' => date("Y-m-d")
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_admin_group_ids',$item);
		}
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		//echo "<pre>";print_r($data);die();
		$item = array(
			'ag_teamname' => $data['ag_teamname']
			);
		$this->db->where('ag_id', $id);
		$this->db->update('tbl_admin_group', $item); 
		$lid = $this->input->get('id');

		$this->db->delete('tbl_admin_group_ids',array('agi_ag_id' => $id));

		foreach ($data['group_id'] as $key => $value) 
		{
			$item = array(
			'agi_ag_id' => $id,
			'agi_adminid' => $value,
			'agi_udate' => date("Y-m-d")
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_admin_group_ids',$item);
		}
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_group');
		$this->db->join('tbl_admin_group_ids','tbl_admin_group.ag_id = tbl_admin_group_ids.agi_ag_id','left');
		$this->db->where('ag_id',$id);
		//$this->db->where('Team_type_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_admin_user()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Team_type()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_group');
		//$this->db->where('Team_type_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('ag_teamname') && ($this->input->post('ag_teamname') != ''))
        {
           $this->db->like('ag_teamname', $this->input->post('ag_teamname'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('ag_id', $id);
		$this->db->delete('tbl_admin_group');

		$this->db->where('agi_ag_id', $id);
		$this->db->delete('tbl_admin_group_ids');
		
		return $id;
	}
	
}
?>