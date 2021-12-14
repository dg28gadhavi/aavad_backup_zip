<?php 

class Hsncode_model extends CI_Model {
	
	public function add($data)
	{
		$item = array(
			'hsn_hcode' => $data['hsncode_name'],
			'hsn_tax' => $data['tax'],
			//'brand_cid' => $this->session->userdata['login']['aus_Id'],
			'hsn_cdate' => date("Y-m-d"),
			'hsn_udate' => date("Y-m-d")
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_hsn_code',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'hsn_hcode' => $data['hsncode_name'],
			'hsn_tax' => $data['tax'],
			//'brand_cid' => $this->session->userdata['login']['aus_Id'],
			'hsn_udate' => date("Y-m-d")
			);
		$this->db->where('hsn_id', $id);
		//$this->db->where('brand_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_hsn_code', $item); 
		$lid = $this->input->get('id');
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$this->db->where('hsn_id',$id);
		//$this->db->where('brand_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_hsncode()
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$this->db->order_by('hsn_id','desc');
		//$this->db->where('brand_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('hsncode_name') && ($this->input->post('hsncode_name') != ''))
        {
           $this->db->like('hsn_hcode', $this->input->post('hsncode_name'));   
        }
        if($this->input->post('tax') && ($this->input->post('tax') != ''))
        {
           $this->db->like('hsn_tax', $this->input->post('tax'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('hsn_id', $id);
		$this->db->delete('tbl_hsn_code');
		return $id;
	}
	
}
?>