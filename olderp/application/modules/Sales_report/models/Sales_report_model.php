<?php 

class Sales_report_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'Sales_report_name' => $data['Sales_report_name'],
			'source_main_cat' => $data['source_main_cat'],
			'Sales_report_cdate' => $data['Sales_report_cdate'],
			'Sales_report_udate' => $data['Sales_report_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_Sales_report',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'Sales_report_name' => $data['Sales_report_name'],
			'source_main_cat' => $data['source_main_cat'],
			'Sales_report_udate' => $data['Sales_report_udate']
			);
		$this->db->where('Sales_report_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_Sales_report', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_Sales_report');
		$this->db->where('Sales_report_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Sales_report()
	{
		$this->db->select('as.*,bs.Sales_report_name as parentcat');
		$this->db->from('tbl_Sales_report as as');
		$this->db->join('tbl_Sales_report as bs', 'as.source_main_cat  = bs.Sales_report_id', 'left');
		$this->db->order_by('as.Sales_report_id', 'desc');
		$this->db->where('as.Sales_report_isdelete', 0);
		
		if($this->input->post('source_name') && ($this->input->post('source_name') != ''))
        {
           $this->db->like('as.Sales_report_name', $this->input->post('source_name'));   
        }
		else if($this->input->post('parent_source_name') && ($this->input->post('parent_source_name') != ''))
		{
			$this->db->like('bs.Sales_report_name', $this->input->post('parent_source_name'));
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('Sales_report_isdelete', 1);
		$this->db->where('Sales_report_id', $id);
		$this->db->update('tbl_Sales_report');
		return $id;
	}
	
	public function get_parents()
	{
		$query = $this->db->get_where('tbl_Sales_report',array('source_main_cat'=>0));
		return $query->result_array();
	}
}
?>