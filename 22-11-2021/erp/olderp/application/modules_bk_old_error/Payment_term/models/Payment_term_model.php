<?php 

class Payment_term_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'payment_term_name' => $data['payment_term_name'],
			'payment_term_cdate' => $data['payment_term_cdate'],
			'payment_term_udate' => $data['payment_term_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_payment_term',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'payment_term_name' => $data['payment_term_name'],
			'payment_term_udate' => $data['payment_term_udate']
			);
		$this->db->where('payment_term_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_payment_term', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_term');
		$this->db->where('payment_term_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Payment_term()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_term');
		$this->db->order_by('payment_term_id', 'desc');
		$this->db->where('payment_term_is_delete', '0');
		if($this->input->post('payment_term_name') && ($this->input->post('payment_term_name') != ''))
        {
           $this->db->like('payment_term_name', $this->input->post('payment_term_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('payment_term_is_delete', '1');
		$this->db->where('payment_term_id', $id);
		$this->db->update('tbl_payment_term');
		return $id;
	}
}
?>