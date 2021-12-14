<?php 

class Country_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'country_name' => $data['country_name'],
			'country_order' => $data['order_name'],
			'country_cdate' => $data['country_cdate'],
			'country_udate' => $data['country_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_country',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'country_name' => $data['country_name'],
			'country_order' => $data['order_name'],
			'country_udate' => $data['country_udate']
			);
		$this->db->where('country_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_country', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_country()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->order_by('country_order', 'asc');
		$this->db->where('country_isdelete', 0);
		
		if($this->input->post('country_name') && ($this->input->post('country_name') != ''))
        {
           $this->db->like('country_name', $this->input->post('country_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('country_isdelete', 1);
		$this->db->where('country_id', $id);
		$this->db->update('tbl_country');
		return $id;
	}
	
	
public function importcsv($data)
	{
		//echo '<pre>';print_r($data['Country']);die;
          $item = array(
			'country_name' => $data['Country'],
			'counry_latitude' => $data['Latitude'],
			'counry_longitude' => $data['Longitude'],
			'country_code' => $data['countryCode'],
			'country_cdate' => date('Y-m-d H:i:s'),
			'country_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_country', $item);
            $cid = $this->db->insert_id();
		    return $cid;
    }

	
	/*public function addtcountry()
	{
		
		$this->db->select('country as country_name');
		$this->db->from('country');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_country',$city);
		}
	}*/

	public function setbit_country()
	{
		$this->db->set('country_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('country_name !=', $update);
		$this->db->where_not_in('LOWER(country_name)', array_map('strtolower', $update));
		$this->db->update('tbl_country');
	}

}
?>