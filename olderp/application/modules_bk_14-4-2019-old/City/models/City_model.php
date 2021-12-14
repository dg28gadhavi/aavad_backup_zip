<?php 

class city_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'city_name' => $data['city_name'],
			'city_state' => $data['city_state'],
			'city_country' => $data['city_country']
			//'city_roe' => $data['city_roe'],
			//'city_cid' => $this->session->userdata['login']['aus_Id'],
			//'city_cdate' => $data['city_cdate'],
			///'city_udate' => $data['city_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_master_city',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'city_name' => $data['city_name'],
			'city_state' => $data['city_state'],
			'city_country' => $data['city_country']
			//'city_roe' => $data['city_roe'],
			//'city_udate' => $data['city_udate']
			);
		$this->db->where('city_id', $id);
		//$this->db->where('city_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_city', $item); 
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_id',$id);
		//$this->db->where('city_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_city()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->order_by('city_id', 'desc');
		$this->db->where('city_isdelete', 0);
		$this->db->join('tbl_master_state', 'tbl_master_state.state_id = tbl_master_city.city_state');
		$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_city.city_country');
		//$this->db->where('city_isdelete', 0);
		//$this->db->where('city_cid',$this->session->userdata['login']['aus_Id']);
		
		if($this->input->post('city_name') && ($this->input->post('city_name') != ''))
        {
           $this->db->like('city_name', $this->input->post('city_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('city_isdelete', 1);
		$this->db->where('city_id', $id);
		$this->db->update('tbl_master_city');
	}
    
    public function get_country_from_country()
    { 
    	$this->db->select('*');
        $this->db->from('tbl_master_state');
        //$this->db->join('tbl_country','tbl_country.country_id = tbl_master_state.state_country');
        $this->db->order_by('state_id', 'desc');
        //$this->db->join('tbl_country', 'tbl_country.country_id = tbl_master_state.state_country');
        $this->db->where('state_country', $this->input->post('state_id'));
        $query = $this->db->get();
        $value = $query->result_array();
        //echo(json_encode($value));
        return $value;
    }

     public function get_state($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_state');
        $this->db->where('state_isdelete', 0);
        $this->db->where('state_country', $id);
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_country()
    {
        $this->db->select('*');
        $this->db->from('tbl_country');
        $this->db->where('country_isdelete', 0);
        $this->db->order_by('country_id', 'desc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        return $query->result_array();
    }
	
	/*public function addtcity()
	{
		
		$this->db->select('city as city_name');
		$this->db->from('city');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_master_city',$city);
		}
	}
	public function get_addressbook() 
	{     
        $query = $this->db->get('tbl_city');
       //echo "<pre>"; print_r($query);die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	*/
	 public function insert_csv() 
    {
    	//$data['addressbook'] = $this->csv_model->get_addressbook();
        //echo "string";die;
        $data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 		
        $this->load->library('upload', $config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            $this->data['main_content'] = 'importcsv_view';
		$this->load->view('includes/template',$this->data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
               // echo "<pre>"; print_r($csv_array);die;
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'name'=>$row['Baroda House S.O'],
                        //'city_cdate'=>date("Y-m-d"),
                        //'city_udate'=>date("Y-m-d"),
                    );
                    $this->db->insert('tbl_city', $insert_data);
                    //$this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                redirect(base_url('City'), 'refresh');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
              	 $this->data['main_content'] = 'importcsv_view';
				$this->load->view('includes/template',$this->data,$data);
                //$this->load->view('csvindex', $data);
            }
    }
}
?>