<?php 

class language_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'lang_name' => $data['lang_name'],
			'lang_adid' => $data['lang_adid'],
			'lang_atype' => $data['lang_atype'],
			'lang_ip' => $this->input->ip_address(),
			'lang_cdate' => $data['lang_cdate'],
			'lang_udate' => $data['lang_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_language',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'lang_name' => $data['lang_name'],
			'lang_adid' => $data['lang_adid'],
			'lang_atype' => $data['lang_atype'],
			'lang_ip' => $this->input->ip_address(),
			'lang_udate' => $data['lang_udate']
			);
		$this->db->where('lang_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_language', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_language');
		$this->db->where('lang_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_language()
	{
		$this->db->select('*');
		$this->db->from('tbl_language');
		$this->db->order_by('lang_id', 'desc');
		$this->db->where('lang_is_delete', '0');
		
		if($this->input->post('lang_name') && ($this->input->post('lang_name') != ''))
        {
           $this->db->like('lang_name', $this->input->post('lang_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('lang_is_delete', '1');
		$this->db->where('lang_id', $id);
		$this->db->update('tbl_language');
		return $id;
	}
}
?>