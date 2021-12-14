<?php 

class Items_heads_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'item_head_name' => $data['item_head_name'],
			'item_head_code' => $data['item_head_code'],
			'item_head_parent' => $data['item_head_parent'],
			'item_head_type' => $data['item_head_type'],
			'item_head_cdate' => $data['item_head_cdate'],
			'item_head_udate' => $data['item_head_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_item_heads',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'item_head_name' => $data['item_head_name'],
			'item_head_code' => $data['item_head_code'],
			'item_head_parent' => $data['item_head_parent'],
			'item_head_type' => $data['item_head_type'],
			'item_head_udate' => $data['item_head_udate']
			);
		$this->db->where('item_head_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_item_heads', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_item_heads');
		$this->db->where('item_head_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Items_heads()
	{
		$this->db->select('as.*,bs.item_head_name as parentcat');
		$this->db->from('tbl_item_heads as as');
		$this->db->join('tbl_item_heads as bs', 'as.item_head_parent  = bs.item_head_id', 'left');
		$this->db->order_by('as.item_head_id', 'desc');
		$this->db->where('as.item_head_isdelete', 0);
		
		if($this->input->post('source_name') && ($this->input->post('source_name') != ''))
        {
           $this->db->like('as.item_head_name', $this->input->post('source_name'));   
        }
		else if($this->input->post('parent_source_name') && ($this->input->post('parent_source_name') != ''))
		{
			$this->db->like('bs.item_head_name', $this->input->post('parent_source_name'));
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('item_head_isdelete', 1);
		$this->db->where('item_head_id', $id);
		$this->db->update('tbl_item_heads');
		return $id;
	}
	
	public function get_parents()
	{
		$query = $this->db->get_where('tbl_item_heads',array('item_head_parent'=>0));
		return $query->result_array();
	}
}
?>