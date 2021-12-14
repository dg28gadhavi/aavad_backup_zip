<?php 

class Area_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'area_name' => $data['area_name'],
			'area_pincode' => $data['area_pincode'],
			'area_city' => $data['area_city'],
			'area_state' => $data['area_state'],
			'area_country' => $data['area_country'],
			//'area_cid' => $this->session->userdata['login']['aus_Id'],
			'area_cdate' => $data['area_cdate'],
			'area_udate' => $data['area_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_master_area',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'area_name' => $data['area_name'],
			'area_pincode' => $data['area_pincode'],
			'area_city' => $data['area_city'],
			'area_state' => $data['area_state'],
			'area_country' => $data['area_country'],
			//'area_cid' => $this->session->userdata['login']['aus_Id'],
			'area_udate' => $data['area_udate'],
			);
		//echo '<pre>'; print_r($item);die;
		$this->db->where('area_id', $id);
		//$this->db->where('area_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_area', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->where('area_id',$id);
        //$this->db->where('area_isdeleted','0');
		//$this->db->where('area_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_area()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->order_by('area_id', 'desc');
		$this->db->join('tbl_master_city', 'tbl_master_city.city_id = tbl_master_area.area_city');
		$this->db->join('tbl_master_state', 'tbl_master_state.state_id = tbl_master_area.area_state');
		$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_area.area_country');
		//$this->db->where('area_isdeleted','0');
		//$this->db->where('area_cid',$this->session->userdata['login']['aus_Id']);
		
		if($this->input->post('area_name') && ($this->input->post('area_name') != ''))
        {
           $this->db->like('area_name', $this->input->post('area_name'));   
        }
        if($this->input->post('pincode') && ($this->input->post('pincode') != ''))
        {
           $this->db->like('area_pincode', $this->input->post('pincode'));   
        }
        if($this->input->post('city_name') && ($this->input->post('city_name') != ''))
        {
           $this->db->like('area_city', $this->input->post('city_name'));   
        }
        if($this->input->post('state_name') && ($this->input->post('state_name') != ''))
        {
           $this->db->like('area_state', $this->input->post('state_name'));   
        }
        if($this->input->post('country_name') && ($this->input->post('country_name') != ''))
        {
           $this->db->like('area_country', $this->input->post('country_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('area_isdelete', '1');
		$this->db->where('area_id', $id);
		$this->db->update('tbl_master_area');
		//return $id;
	}
    
    public function get_country_from_country()
    { 
    	$this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->join('tbl_country','tbl_country.country_id = tbl_master_state.state_country');
        $this->db->order_by('state_id', 'desc');
        //$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_state.state_country');
        $this->db->where('state_id', $this->input->post('state_id'));
        $query = $this->db->get();
        $value = $query->result_array();
        //echo(json_encode($value));
        return $value;
    }

    public function get_state_from_city()
    {
    	$this->db->select('*');
        $this->db->from('tbl_master_city');
        $this->db->join('tbl_master_state','tbl_master_state.state_id = tbl_master_city.city_state');
         $this->db->join('tbl_country','tbl_country.country_id = tbl_master_state.state_country');
        $this->db->order_by('city_id', 'desc');
        //$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_state.state_country');
        $this->db->where('city_id', $this->input->post('city_id'));
        $query = $this->db->get();
        $value = $query->result_array();
        //echo(json_encode($value));
        return $value;
    }

     public function get_state()
    {
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_isdelete','0');
        $this->db->order_by('state_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_country()
    {
        $this->db->select('*');
        $this->db->from('tbl_country');
        $this->db->where('country_isdelete','0');
        $this->db->order_by('country_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }

      public function get_city()
    {
        $this->db->select('*');
        $this->db->from('tbl_master_city');
        $this->db->where('city_isdelete','0');
        $this->db->order_by('city_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }

    // public function importcsv($data) 
    // {
    //   //echo "<pre>"; print_r($data); die;
    //     $this->db->select('*');
    //     $this->db->from('tbl_country');
    //     $this->db->where('country_name',$data['Country']);
    //     $query = $this->db->get();
    //     if($query->num_rows() == 0)
    //     {
    //         $item = array(
    //           'country_name' => $data['Country'],
    //           'country_cdate' => date("Y-m-d"),
    //           //'state_udate' => date("Y-m-d"),
    //           );
    //           $this->db->insert('tbl_country',$item);
    //         $country_id = $this->db->insert_id();
    //     }else if($query->num_rows() > 0)
    //     {
    //         $country_data = $query->row_array();
    //         $country_id = $country_data['state_id'];
    //     }else{
    //         $country_id = 0;
    //     }

    //     $this->db->select('*');
    //     $this->db->from('tbl_master_state');
    //     $this->db->where('state_name',$data['State']);
    //     $query = $this->db->get();
    //     if($query->num_rows() == 0)
    //     {
    //         $item = array(
    //           'state_name' => $data['State'],
    //           'state_country' => $country_id,
    //           'state_cdate' => date("Y-m-d"),
    //           //'state_udate' => date("Y-m-d"),
    //           );
    //           $this->db->insert('tbl_master_state',$item);
    //         $state_id = $this->db->insert_id();
    //     }else if($query->num_rows() > 0)
    //     {
    //         $state_data = $query->row_array();
    //         $state_id = $state_data['state_id'];
    //     }else{
    //         $state_id = 0;
    //     }
        
    //     $this->db->select('*');
    //     $this->db->from('tbl_master_city');
    //     $this->db->where('city_name',$data['City']);
    //     $query = $this->db->get();
    //     if($query->num_rows() == 0)
    //     {
    //         $item = array(
    //         'city_name' => $data['City'],
    //         'city_state' => $state_id,
    //         'city_country' => $country_id
    //         //'city_udate' => date("Y-m-d"),
    //         );
    //         $this->db->insert('tbl_city',$item);
    //         $city_id = $this->db->insert_id();
    //     }else if($query->num_rows() > 0)
    //     {
    //         $city_data = $query->row_array();
    //         $city_id = $city_data['city_id'];
    //     }else{
    //         $city_id = 0;
    //     }
        
    //     $this->db->select('*');
    //     $this->db->from('tbl_master_area');
    //     $this->db->where('area_name',$data['Area']);
    //     $query = $this->db->get();
    //     if($query->num_rows() == 0)
    //     {
    //         $item = array(
    //         'area_name' => $data['Area'],
    //         'area_pincode' => $data['Areapincode'],
    //         'area_state' => $state_id,
    //         'area_city' => $city_id,
    //         'area_country' => $country_id,
    //         'area_cdate' => date("Y-m-d"),
    //         'area_udate' => date("Y-m-d"),
    //         );
    //         $this->db->insert('tbl_area',$item);
    //         $area_id = $this->db->insert_id();
    //     }else if($query->num_rows() > 0)
    //     {
    //         $area_data = $query->row_array();
    //         $area_id = $area_data['area_id'];
    //     }else{
    //         $area_id = 0;
    //     }
        
    //     $item = array(
    //       'area_state' => $state_id,
    //       'area_city' => $city_id,
    //       'area_id' => $area_id,
    //       'area_name' => $data['Area'],
    //       'area_pincode' => $data['Areapincode'],
    //       'area_country' => $country_id,
    //       'area_cdate' => date("Y-m-d"),
    //       'area_udate' => date("Y-m-d"),
    //       );
    //       //echo '<pre>'; print_r($item);die;
    //       $this->db->insert('tbl_master_area',$item);
    // }

    public function importcsv($data) 
    {
      //echo "<pre>"; print_r($data); die;
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_name',$data['State']);
        $query = $this->db->get();
        if($query->num_rows() == 0)
        {
            $item = array(
                'state_name' => $data['State'],
                'state_country' => 1
            );
            $this->db->insert('tbl_master_state',$item);
            $state_id = $this->db->insert_id();
        }else if($query->num_rows() == 1)
        {
            $state_data = $query->row_array();
            $state_id = $state_data['state_id'];
        }

        $this->db->select('*');
        $this->db->from('tbl_master_city');
        $this->db->where('city_name',$data['Name of City']);
        $query = $this->db->get();
        if($query->num_rows() == 0)
        {
            $item = array(
            'city_name' => $data['Name of City'],
            'city_state' => $state_id,
            'city_country' => 1
            );
            //echo '<pre>'; print_r($item);die;
            $this->db->insert('tbl_master_city',$item);
            $city_id = $this->db->insert_id();
        }
    }
}
?>