<?php 

class B2b_settings_model extends CI_Model {
	
	public function add($data)
	{
		//echo "<pre>";print_r($data);die();
		$item = array(
			'b2b_ind_mob_no' => $data['b2b_ind_mob_no'],
			'b2b_ind_mob_key' => $data['b2b_ind_mob_key'],
			'b2b_trad_uid' => $data['b2b_trad_uid'],
			'b2b_trad_pid' => $data['b2b_trad_pid'],
			'b2b_trad_key' => $data['b2b_trad_key'],
			'b2b_udate' => $data['B2b_settings_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_b2b_settings',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		//echo "<pre>";print_r($data);die();
		$item = array(
			'b2b_ind_mob_no' => $data['b2b_ind_mob_no'],
			'b2b_ind_mob_key' => $data['b2b_ind_mob_key'],
			'b2b_trad_uid' => $data['b2b_trad_uid'],
			'b2b_trad_pid' => $data['b2b_trad_pid'],
			'b2b_trad_key' => $data['b2b_trad_key'],
			'b2b_udate' => $data['B2b_settings_udate']
			);
		$this->db->where('b2b_id', 1);
		$this->db->update('tbl_b2b_settings', $item); 
		$lid = $this->input->get($id);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_b2b_settings');
		$this->db->where('b2b_id',$id);
		//$this->db->where('B2b_settings_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_B2b_settings()
	{
		$this->db->select('*');
		$this->db->from('tbl_b2b_settings');
		if($this->input->post('b2b_ind_mob_no') && ($this->input->post('b2b_ind_mob_no') != ''))
        {
           $this->db->like('b2b_ind_mob_no', $this->input->post('b2b_ind_mob_no'));   
        }
        if($this->input->post('b2b_ind_mob_key') && ($this->input->post('b2b_ind_mob_key') != ''))
        {
           $this->db->like('b2b_ind_mob_key', $this->input->post('b2b_ind_mob_key'));   
        }
        if($this->input->post('b2b_trad_uid') && ($this->input->post('b2b_trad_uid') != ''))
        {
           $this->db->like('b2b_trad_uid', $this->input->post('b2b_trad_uid'));   
        }
        if($this->input->post('b2b_trad_pid') && ($this->input->post('b2b_trad_pid') != ''))
        {
           $this->db->like('b2b_trad_pid', $this->input->post('b2b_trad_pid'));   
        }
        if($this->input->post('b2b_trad_key') && ($this->input->post('b2b_trad_key') != ''))
        {
           $this->db->like('b2b_trad_key', $this->input->post('b2b_trad_key'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		$this->db->set('b2b_isdelete', 1);
		$this->db->where('b2b_id', $id);
		$this->db->delete('tbl_b2b_settings');
		
		return $id;
	}
	
}
?>