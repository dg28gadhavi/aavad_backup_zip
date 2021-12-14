<?php 

class Mode_delivery_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'mode_delivery_name' => $data['mode_delivery_name'],
			//'mode_delivery_order' => $data['order_name'],
			'mode_delivery_cdate' => $data['mode_delivery_cdate'],
			'mode_delivery_udate' => $data['mode_delivery_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_mode_delivery',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'mode_delivery_name' => $data['mode_delivery_name'],
			//'mode_delivery_order' => $data['order_name'],
			'mode_delivery_udate' => $data['mode_delivery_udate']
			);
		$this->db->where('mode_delivery_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_mode_delivery', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_mode_delivery');
		$this->db->where('mode_delivery_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_mode_delivery()
	{
		$this->db->select('*');
		$this->db->from('tbl_mode_delivery');
		//$this->db->order_by('mode_delivery_order', 'asc');
		//$this->db->where('mode_delivery_isdelete', 0);
		
		if($this->input->post('mode_delivery_name') && ($this->input->post('mode_delivery_name') != ''))
        {
           $this->db->like('mode_delivery_name', $this->input->post('mode_delivery_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		//$this->db->set('mode_delivery_isdelete', 1);
		$this->db->where('mode_delivery_id', $id);
		$this->db->delete('tbl_mode_delivery');
		return $id;
	}

	public function setbit_mode_delivery()
	{
		$this->db->set('mode_delivery_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('mode_delivery_name !=', $update);
		$this->db->where_not_in('LOWER(mode_delivery_name)', array_map('strtolower', $update));
		$this->db->update('tbl_mode_delivery');
	}

}
?>