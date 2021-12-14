<?php 

class Otwserialkey_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'otwserialkey_name' => $data['otwserialkey_name'],
			'otwserialkey_order' => $data['order_name'],
			'otw_cdate' => $data['otw_cdate'],
			'otw_udate' => $data['otw_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_otwserialkey',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'otwserialkey_name' => $data['otwserialkey_name'],
			'otwserialkey_order' => $data['order_name'],
			'otw_udate' => $data['otw_udate']
			);
		$this->db->where('outward_serial_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_otwserialkey', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_otwserialkey');
		$this->db->where('outward_serial_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_otwserialkey()
	{
		$this->db->select('*');
		$this->db->from('tbl_outward_serail_key');
		$this->db->join('tbl_outward_item','tbl_outward_serail_key.outward_item_id = tbl_outward_item.otwi_id');
		$this->db->join('tbl_outward','tbl_outward_serail_key.outward_mainotwid  = tbl_outward.otw_id');
		//$this->db->where('otw_isdelete',0);
		
		
		
		if($this->input->post('ouw_code') && ($this->input->post('ouw_code') != ''))
        {
           $this->db->like('tbl_outward.otw_no', $this->input->post('ouw_code'));   
        }
        if($this->input->post('otw_item') && ($this->input->post('otw_item') != ''))
        {
           $this->db->like('tbl_outward_item.otwi_itm_title', $this->input->post('otw_item'));   
        }
         if($this->input->post('otw_serial') && ($this->input->post('otw_serial') != ''))
        {
           $this->db->like('tbl_outward_serail_key.outward_serial_keyname', $this->input->post('otw_serial'));   
        }
        //$this->db->order_by('tbl_outward.otw_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		//$this->db->set('otwserialkey_isdelete', 1);
		$this->db->where('outward_serial_id', $id);
		$this->db->delete('tbl_otwserialkey');
		return $id;
	}
	
	
public function importcsv($data)
	{
		//echo '<pre>';print_r($data['Otwserialkey']);die;
          $item = array(
			'otwserialkey_name' => $data['Otwserialkey'],
			'counry_latitude' => $data['Latitude'],
			'counry_longitude' => $data['Longitude'],
			'otwserialkey_code' => $data['otwserialkeyCode'],
			'otw_cdate' => date('Y-m-d H:i:s'),
			'otw_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_otwserialkey', $item);
            $cid = $this->db->insert_id();
		    return $cid;
    }

	
	/*public function addtotwserialkey()
	{
		
		$this->db->select('otwserialkey as otwserialkey_name');
		$this->db->from('otwserialkey');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_otwserialkey',$city);
		}
	}*/

	public function setbit_otwserialkey()
	{
		$this->db->set('otwserialkey_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('otwserialkey_name !=', $update);
		$this->db->where_not_in('LOWER(otwserialkey_name)', array_map('strtolower', $update));
		$this->db->update('tbl_otwserialkey');
	}

}
?>