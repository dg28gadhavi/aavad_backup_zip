<?php 

class Customer_type_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'ctype_name' => $data['ctype_name'],
			'ctype_cdate' => $data['ctype_cdate'],
			'ctype_udate' => $data['ctype_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_customer_type',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'ctype_name' => $data['ctype_name'],
			'ctype_udate' => $data['ctype_udate']
			);
		$this->db->where('ctype_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_customer_type', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_customer_type');
		$this->db->where('ctype_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Customer_type()
	{
		$this->db->select('*');
		$this->db->from('tbl_customer_type');
		$this->db->where('ctype_isdelete', 0);
		
		if($this->input->post('ctype_name') && ($this->input->post('ctype_name') != ''))
        {
           $this->db->like('ctype_name', $this->input->post('ctype_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('ctype_isdelete', 1);
		$this->db->where('ctype_id', $id);
		$this->db->update('tbl_customer_type');
		return $id;
	}
	
	
public function importcsv($data)
	{
		//echo '<pre>';print_r($data['ctype']);die;
          $item = array(
			'ctype_name' => $data['ctype'],
			'counry_latitude' => $data['Latitude'],
			'counry_longitude' => $data['Longitude'],
			'ctype_code' => $data['ctypeCode'],
			'ctype_cdate' => date('Y-m-d H:i:s'),
			'ctype_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_customer_type', $item);
            $cid = $this->db->insert_id();
		    return $cid;
    }

	
	/*public function addtctype()
	{
		
		$this->db->select('ctype as ctype_name');
		$this->db->from('ctype');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_customer_type',$city);
		}
	}*/

	public function setbit_ctype()
	{
		$this->db->set('ctype_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('ctype_name !=', $update);
		$this->db->where_not_in('LOWER(ctype_name)', array_map('strtolower', $update));
		$this->db->update('tbl_customer_type');
	}

}
?>