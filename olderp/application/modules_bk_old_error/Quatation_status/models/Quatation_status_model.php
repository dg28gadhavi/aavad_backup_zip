<?php 

class Quatation_status_model extends CI_Model {
	
	
	public function add($data)
	{
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'qs_name' => $data['qs_name'],
			'qs_cdate' => $data['qs_cdate'],
			'qs_udate' => $data['qs_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_quatation_status',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'qs_name' => $data['qs_name'],
			'qs_udate' => $data['qs_udate']
			);
		$this->db->where('qs_is', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_quatation_status', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_quatation_status');
		$this->db->where('qs_is',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Quatation_status()
	{
		$this->db->select('*');
		$this->db->from('tbl_quatation_status');
		$this->db->order_by('qs_is', 'desc');
		$this->db->where('qs_isdelete', '0');
		if($this->input->post('qs_name') && ($this->input->post('qs_name') != ''))
        {
           $this->db->like('qs_name', $this->input->post('qs_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('qs_isdelete', '1');
		$this->db->where('qs_is', $id);
		$this->db->update('tbl_quatation_status');
		return $id;
	}
}
?>