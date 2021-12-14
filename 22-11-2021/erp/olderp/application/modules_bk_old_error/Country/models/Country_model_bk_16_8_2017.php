<?php 

class Country_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'country_name' => $data['country_name'],
			'country_cdate' => $data['country_cdate'],
			'country_udate' => $data['country_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_country',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'country_name' => $data['country_name'],
			'country_udate' => $data['country_udate']
			);
		$this->db->where('country_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_country', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_country()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->order_by('country_id', 'desc');
		$this->db->where('country_isdelete', 0);
		
		if($this->input->post('country_name') && ($this->input->post('country_name') != ''))
        {
           $this->db->like('country_name', $this->input->post('country_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('country_isdelete', 1);
		$this->db->where('country_id', $id);
		$this->db->update('tbl_country');
		return $id;
	}
	
	/*public function addtcountry()
	{
		
		$this->db->select('country as country_name');
		$this->db->from('country');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_country',$city);
		}
	}*/

}
?>