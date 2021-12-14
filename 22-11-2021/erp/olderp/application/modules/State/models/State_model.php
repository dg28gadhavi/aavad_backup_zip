<?php 
class State_model extends CI_Model {

	public function add($data)
	{
		$item = array(
			'state_name' => $data['state_name'],
			'state_country' => $data['state_country'],
			'state_udate' => $data['state_udate']
		);
		$this->db->insert('tbl_master_state',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}

	public function edit($data,$id)
	{ 
		$item = array(
			'state_name' => $data['state_name'],
			'state_country' => $data['state_country'],
			'state_udate' => $data['state_udate']
		);
		$this->db->where('state_id', $id);
		$this->db->update('tbl_master_state', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_id',$id);
		//$this->db->where('state_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_state()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->order_by('state_id', 'desc');
		$this->db->where('state_isdelete', 0);
		$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_state.state_country');
		if($this->input->post('state_name') && ($this->input->post('state_name') != ''))
		{
			$this->db->like('state_name', $this->input->post('state_name'));   
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		$this->db->set('state_isdelete', 1);
		$this->db->where('state_id', $id);
		$this->db->update('tbl_master_state');
	}

	public function get_country()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_isdelete', 0);
		$this->db->order_by('country_name', 'asc');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	/*public function addtstate()
	{
		
		$this->db->select('statename as state_name');
		$this->db->from('state');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_master_state',$city);
		}
	}*/

	public function state_entry()
	{ die;
		$this->db->select('POName,PinCode,POType,PODivision,PORegion,POCircle,Taluk,State,District');
		$this->db->from('pincodes');
		$this->db->where('State','GUJARAT');
		$this->db->where('District','Ahmedabad');
		$query = $this->db->get();
		//echo '<pre>';print_r($query->result_array());die;
		foreach ($query->result_array() as $states) {
			$item = array(
				'area_name' => $states['POName'],
				'area_pincode' => $states['PinCode'],
				'area_POType' => $states['POType'],
				'area_PODivision' => $states['PODivision'],
				'area_PORegion' => $states['PORegion'],
				'area_POCircle' => $states['POCircle'],
				'area_Taluk' => $states['Taluk'],
				'area_city' => 9,
				'area_state' => 10,
				'area_country' => 105,
				'area_cdate' => date('Y-m-d H:i:s'),
				'area_udate' => date('Y-m-d H:i:s')

			);
			$this->db->insert('tbl_master_area',$item);
		}
	}

	public function state_copy(){
		$this->db->select('*');
		$this->db->from('tbl_master_state_old');
		$query = $this->db->get();
		foreach ($query->result_array() as $skey => $states) {
			$this->db->select('*');
			$this->db->from('tbl_master_state');
			$this->db->where('UPPER(state_name)',strtoupper($states['master_state_name']));
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				$insert = array(
					'state_name' => $states['master_state_name'],
					'state_country' => 1,
					'state_udate' => date("Y-m-d H:i:s")
					);
				$this->db->insert('tbl_master_state',$insert);
			}
			if($query->num_rows() == 1)
			{
				$state_new = $query->row_array();
				//echo '<pre>';print_r($state_new);die;
				$update = array('state_xid' => $states['master_state_id']);
				$this->db->where('state_id',$state_new['state_id']);
				$this->db->update('tbl_master_state',$update);
			}
		}
	}

	public function city_copy(){
		$this->db->select('*');
		$this->db->from('tbl_master_city_old');
		$query = $this->db->get();
		foreach ($query->result_array() as $skey => $states) {
			$this->db->select('*');
			$this->db->from('tbl_master_city');
			$this->db->where('UPPER(city_name)',strtoupper($states['city_name']));
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				//echo "<pre>";print_r($states);die;
				$this->db->select('*');
				$this->db->from('tbl_master_state');
				$this->db->where('state_xid',$states['city_state']);
				$query = $this->db->get();
				if($query->num_rows() >= 1){
					$statedata = $query->row_array();
					$statename = $statedata['state_id'];
				}else{
					$statename = 0;
				}
				$insert = array(
					'city_name' => $states['city_name'],
					'city_xid' => $states['city_id'],
					'city_state' => $statename,
					'city_country' => 1
					);
				$this->db->insert('tbl_master_city',$insert);
			}
			if($query->num_rows() == 1)
			{
				/* $state_new = $query->row_array();
				//echo '<pre>';print_r($state_new);die;
				$update = array('city_xid' => $states['city_id']);
				$this->db->where('city_id',$state_new['city_id']);
				$this->db->update('tbl_master_city',$update); */
			}
		}
	}

	public function customer_copy()
	{
die;
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$query = $this->db->get();
		$newdata = $query->result_array();
		foreach ($newdata as $key => $value) {
			$update = array('master_party_code' => "V".$value['master_party_id'],'master_party_country' => 1);
			$this->db->where('master_party_id',$value['master_party_id']);
			$this->db->update('tbl_master_party',$update);
		}
		/*
		$this->db->select('*');
		$this->db->from('tbl_master_party_old');
		$query = $this->db->get();
		$olddata = $query->result_array();
		foreach ($olddata as $key => $oldval) {
			$this->db->select('*');
			$this->db->from('tbl_master_party');
			$this->db->where('UPPER(master_party_name)',strtoupper($oldval['master_party_name']));
			$query = $this->db->get();
			if($query->num_rows() == 1){
				$newdata = $query->row_array();
				$this->db->select('*');
				$this->db->from('tbl_master_state');
				$this->db->where('state_xid',$oldval['master_party_state']);
				$query = $this->db->get();
				if($query->num_rows() >= 1){
					$statedata = $query->row_array();
					$stateid = $statedata['state_id'];
				}else{
					$stateid = 0;
				}

				$this->db->select('*');
				$this->db->from('tbl_master_city');
				$this->db->where('city_xid',$oldval['master_party_city']);
				$query = $this->db->get();
				if($query->num_rows() >= 1){
					$citydata = $query->row_array();
					$cityid = $citydata['city_id'];
				}else{
					$cityid = 0;
				}
				$updatear = array('master_party_state' => $stateid,'master_party_city' => $cityid);
				$this->db->where('master_party_id',$newdata['master_party_id']);
				$this->db->update('tbl_master_party',$updatear);
			}else{
				echo $oldval['master_party_name']."<br/>";
			}
		}
		*/
	}
}?>