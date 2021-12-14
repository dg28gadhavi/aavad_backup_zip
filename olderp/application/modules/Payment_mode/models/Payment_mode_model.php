<?php 

class Payment_mode_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'payst_name' => $data['payst_name'],
			'payst_adid' => $data['payst_adid'],
			'payst_atype' => $data['payst_atype'],
			'payst_ip' => $this->input->ip_address(),
			'payst_cdate' => $data['payst_cdate'],
			'payst_udate' => $data['payst_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_payment_mode',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'payst_name' => $data['payst_name'],
			'payst_adid' => $data['payst_adid'],
			'payst_atype' => $data['payst_atype'],
			'payst_ip' => $this->input->ip_address()
			);
		$this->db->where('payst_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_payment_mode', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_mode');
		$this->db->where('payst_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_payment_mode()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_mode');
		$this->db->order_by('payst_id', 'desc');
		$this->db->where('payst_is_delete', '0');
		if($this->input->post('payment_mode_name') && ($this->input->post('payment_mode_name') != ''))
        {
           $this->db->like('payst_name', $this->input->post('payment_mode_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('payst_is_delete', '1');
		$this->db->where('payst_id', $id);
		$this->db->update('tbl_payment_mode');
		return $id;
	}
}
?>