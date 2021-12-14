<?php 

class Support_ticket_model extends CI_Model {
	
	function encrypt_decrypt($action, $string)
	{
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}
	public function st_no_get()
	{
		$this->db->select('st_id');
		$this->db->from('tbl_support_ticket');
		$this->db->order_by('st_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['st_id'] = isset($autoid['st_id']) ? $autoid['st_id'] : '1000';
		return $code['pre_support_ticket'].''.date('dmy').'/'.($autoid['st_id']+1);
	}
	public function get_mailer_detail($id)
	{
		//echo "<pre>"; print_r($data); die;
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_b2biq_chat($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_support_communication');
		$this->db->join('tbl_admin_users','tbl_support_communication.stcomm_adid = tbl_admin_users.au_id','left');
		$this->db->where('stcomm_stid',$id);
		$this->db->where('stcomm_isdelete',0);
		$this->db->order_by('stcomm_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function edit_communication($data,$id)
	{
		//echo "<pre>"; print_r($data); die;
		$item = array(
			'stcomm_stid' => $id,
			'stcomm_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'stcomm_solution' => $data['st_solution'],
			'stcomm_feedback' => $data['st_clientfeedback'],
			'stcomm_udate' => $data['udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_support_communication',$item);
		return $id;
	}
	public function delete_chat($data,$id)
	{
		//echo $id;die();
		$this->db->set('stcomm_isdelete',1);
		$this->db->where('stcomm_id', $id);
		$this->db->update('tbl_support_communication');
		return $id;
	}
	public function add($data)
	{
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'st_coname' => $data['st_coname'],
			'st_email' => $data['st_email'],
			'st_subject' => $data['st_subject'],
			'st_location' => $data['st_location'],
			'st_ticketno' => $data['st_ticketno'],
			'st_tackenby' => $data['st_tackenby'],
			'st_details' => $data['st_details'],
			'st_prodetails' => $data['st_prodetails'],
			'st_attendedby' => $data['st_attendedby'],
			'st_status' => $data['st_status'],
			'st_createdby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'st_cdate' => $data['Support_ticket_udate'],
			'st_udate' => $data['Support_ticket_cdate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_support_ticket',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}

	public function close_sts($id)
	{
		$item = array(
			'st_status' => 2
			);
		$this->db->where('st_id', $id);
		//$this->db->where('Support_ticket_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_support_ticket', $item); 
		return $id;
	}
	
	public function edit($data,$id)
	{ 
		//echo '<pre>'; print_r($data);die;
		$item = array(
			'st_coname' => $data['st_coname'],
			'st_subject' => $data['st_subject'],
			'st_email' => $data['st_email'],
			'st_location' => $data['st_location'],
			'st_ticketno' => $data['st_ticketno'],
			'st_tackenby' => $data['st_tackenby'],
			'st_details' => $data['st_details'],
			'st_prodetails' => $data['st_prodetails'],
			'st_attendedby' => $data['st_attendedby'],
			//'st_status' => isset($data['st_status']) ? $data['st_status'] : 1,
			'st_createdby' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
			'st_cdate' => $data['Support_ticket_udate']
			);
		$this->db->where('st_id', $id);
		//$this->db->where('Support_ticket_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_support_ticket', $item); 
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_support_ticket');
		$this->db->where('st_id',$id);
		//$this->db->where('Support_ticket_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Support_ticket()
	{
		$this->db->select('tbl_support_ticket.*,attand_admin.au_fname as attand_fname,attand_admin.au_lname as attand_lname	,creted_admin.au_fname as creted_fname,creted_admin.au_lname as creted_lname,support_admin.au_fname as support_fname,support_admin.au_lname as support_lname');
		$this->db->from('tbl_support_ticket');
		$this->db->join('tbl_admin_users as attand_admin','attand_admin.au_id = tbl_support_ticket.st_attendedby');
		$this->db->join('tbl_admin_users as creted_admin','creted_admin.au_id = tbl_support_ticket.st_createdby');
		$this->db->join('tbl_admin_users as support_admin','support_admin.au_id = tbl_support_ticket.st_tackenby');
		$this->db->order_by('st_id','DESC');
		if($this->input->post('st_coname') && ($this->input->post('st_coname') != ''))
        {
           $this->db->like('tbl_support_ticket.st_coname', $this->input->post('st_coname'));   
        }
        if($this->input->post('st_email') && ($this->input->post('st_email') != ''))
        {
           $this->db->like('tbl_support_ticket.st_email', $this->input->post('st_email'));   
        }
        if($this->input->post('st_location') && ($this->input->post('st_location') != ''))
        {
           $this->db->like('tbl_support_ticket.st_location', $this->input->post('st_location'));   
        }
        if($this->input->post('st_ticketno') && ($this->input->post('st_ticketno') != ''))
        {
           $this->db->like('tbl_support_ticket.st_ticketno', $this->input->post('st_ticketno'));   
        }
        if($this->input->post('st_tackenby') && ($this->input->post('st_tackenby') != ''))
        {
           $this->db->like('support_admin.au_fname', $this->input->post('st_tackenby'));   
        }
        if($this->input->post('st_details') && ($this->input->post('st_details') != ''))
        {
           $this->db->like('tbl_support_ticket.st_details', $this->input->post('st_details'));   
        }
        if($this->input->post('st_prodetails') && ($this->input->post('st_prodetails') != ''))
        {
           $this->db->like('tbl_support_ticket.st_prodetails', $this->input->post('st_prodetails'));   
        }
        if($this->input->post('st_status') && ($this->input->post('st_status') != ''))
        {
           $this->db->like('tbl_support_ticket.st_status', $this->input->post('st_status'));   
        }
        if($this->input->post('st_status') && ($this->input->post('st_status') != ''))
        {
           $this->db->where('tbl_support_ticket.st_status', $this->input->post('st_status'));   
        }
         if($this->input->post('st_createdby') && ($this->input->post('st_createdby') != ''))
        {
           $this->db->where('creted_admin.au_fname', $this->input->post('st_createdby'));   
        }
        if($this->input->post('st_createdby') && ($this->input->post('st_createdby') != ''))
        {
           $this->db->where('creted_admin.au_fname', $this->input->post('st_createdby'));   
        }
        if($this->input->post('st_startudate') && $this->input->post('st_startudate') != ''){
			$start_date = date("Y-m-d", strtotime($this->input->post('st_startudate')));
			$this->db->where('DATE_FORMAT(tbl_support_ticket.st_udate,"%Y-%m-%d") >=', $start_date);
		}
		if($this->input->post('st_endudate') && $this->input->post('st_endudate') != ''){
			$end_date = date("Y-m-d", strtotime($this->input->post('st_endudate')));
			$this->db->where('DATE_FORMAT(tbl_support_ticket.st_udate,"%Y-%m-%d") <=', $end_date);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->where('st_id', $id);
		$this->db->delete('tbl_support_ticket');
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
    public function get_admin()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
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
	
	/*public function addtSupport_ticket()
	{
		
		$this->db->select('Support_ticket as Support_ticket_name');
		$this->db->from('Support_ticket');
		$query = $this->db->get();
		foreach ($query->result_array() as $Support_ticket) {
			  $this->db->insert('tbl_master_Support_ticket',$Support_ticket);
		}
	}
	public function get_addressbook() 
	{     
        $query = $this->db->get('tbl_Support_ticket');
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
                        //'Support_ticket_cdate'=>date("Y-m-d"),
                        //'Support_ticket_udate'=>date("Y-m-d"),
                    );
                    $this->db->insert('tbl_Support_ticket', $insert_data);
                    //$this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                redirect(base_url('Support_ticket'), 'refresh');
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