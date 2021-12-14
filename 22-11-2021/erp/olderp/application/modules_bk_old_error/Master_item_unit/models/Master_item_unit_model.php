<?php 

class Master_item_unit_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'master_item_unit_name' => $data['master_item_unit_name'],
			//'master_item_unit_order' => $data['order_name'],
			'master_item_unit_cdate' => $data['master_item_unit_cdate'],
			'master_item_unit_udate' => $data['master_item_unit_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_master_item_unit',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'master_item_unit_name' => $data['master_item_unit_name'],
			//'master_item_unit_order' => $data['order_name'],
			'master_item_unit_udate' => $data['master_item_unit_udate']
			);
		$this->db->where('master_item_unit_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_master_item_unit', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_unit');
		$this->db->where('master_item_unit_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_master_item_unit()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_unit');
		$this->db->where('master_item_unit_isdelete',0);
		$this->db->order_by('master_item_unit_id','desc');
		
		if($this->input->post('master_item_unit_name') && ($this->input->post('master_item_unit_name') != ''))
        {
           $this->db->like('master_item_unit_name', $this->input->post('master_item_unit_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('master_item_unit_id', $id);
		$this->db->update('tbl_master_item_unit');
		return $id;
	}
	
	
public function importcsv($data)
	{
		//echo '<pre>';print_r($data['Master_item_unit']);die;
          $item = array(
			'master_item_unit_name' => $data['Master_item_unit'],
			'counry_latitude' => $data['Latitude'],
			'counry_longitude' => $data['Longitude'],
			'master_item_unit_code' => $data['master_item_unitCode'],
			'master_item_unit_cdate' => date('Y-m-d H:i:s'),
			'master_item_unit_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_master_item_unit', $item);
            $cid = $this->db->insert_id();
		    return $cid;
    }

	
	/*public function addtmaster_item_unit()
	{
		
		$this->db->select('master_item_unit as master_item_unit_name');
		$this->db->from('master_item_unit');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_master_item_unit',$city);
		}
	}*/

	public function setbit_master_item_unit()
	{
		$this->db->set('master_item_unit_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('master_item_unit_name !=', $update);
		$this->db->where_not_in('LOWER(master_item_unit_name)', array_map('strtolower', $update));
		$this->db->update('tbl_master_item_unit');
	}

}
?>