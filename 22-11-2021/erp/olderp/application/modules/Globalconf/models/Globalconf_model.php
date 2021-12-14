<?php 

class Globalconf_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'globalconf_name' => $data['globalconf_name'],
			'globalconf_order' => $data['order_name'],
			'globalconf_cdate' => $data['globalconf_cdate'],
			'globalconf_udate' => $data['globalconf_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_globalconf',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'globalconf_name' => $data['globalconf_name'],
			'globalconf_order' => $data['order_name'],
			'globalconf_udate' => $data['globalconf_udate']
			);
		$this->db->where('globalconf_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_globalconf', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_globalconf');
		$this->db->where('globalconf_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_globalconf()
	{
		$this->db->select('*');
		$this->db->from('tbl_globalconf');
		$this->db->order_by('globalconf_order', 'asc');
		$this->db->where('globalconf_isdelete', 0);
		
		if($this->input->post('globalconf_name') && ($this->input->post('globalconf_name') != ''))
        {
           $this->db->like('globalconf_name', $this->input->post('globalconf_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('globalconf_isdelete', 1);
		$this->db->where('globalconf_id', $id);
		$this->db->update('tbl_globalconf');
		return $id;
	}
	
	
public function importcsv($data)
	{
		//echo '<pre>';print_r($data['Globalconf']);die;
          $item = array(
			'globalconf_name' => $data['Globalconf'],
			'counry_latitude' => $data['Latitude'],
			'counry_longitude' => $data['Longitude'],
			'globalconf_code' => $data['globalconfCode'],
			'globalconf_cdate' => date('Y-m-d H:i:s'),
			'globalconf_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_globalconf', $item);
            $cid = $this->db->insert_id();
		    return $cid;
    }

	
	/*public function addtglobalconf()
	{
		
		$this->db->select('globalconf as globalconf_name');
		$this->db->from('globalconf');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_globalconf',$city);
		}
	}*/

	public function setbit_globalconf()
	{
		$this->db->set('globalconf_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('globalconf_name !=', $update);
		$this->db->where_not_in('LOWER(globalconf_name)', array_map('strtolower', $update));
		$this->db->update('tbl_globalconf');
	}

}
?>