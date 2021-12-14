<?php 

class Notification_list_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'Notification_list_name' => $data['Notification_list_name'],
			'Notification_list_state' => $data['Notification_list_state'],
			'Notification_list_country' => $data['Notification_list_country']
			//'Notification_list_roe' => $data['Notification_list_roe'],
			//'Notification_list_cid' => $this->session->userdata['login']['aus_Id'],
			//'Notification_list_cdate' => $data['Notification_list_cdate'],
			///'Notification_list_udate' => $data['Notification_list_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_master_Notification_list',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'Notification_list_name' => $data['Notification_list_name'],
			'Notification_list_state' => $data['Notification_list_state'],
			'Notification_list_country' => $data['Notification_list_country']
			//'Notification_list_roe' => $data['Notification_list_roe'],
			//'Notification_list_udate' => $data['Notification_list_udate']
			);
		$this->db->where('Notification_list_id', $id);
		//$this->db->where('Notification_list_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_Notification_list', $item); 
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_Notification_list');
		$this->db->where('Notification_list_id',$id);
		//$this->db->where('Notification_list_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_notifcation_list()
	{
		//echo "hiii"; die;
		$this->db->where('wna_toid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->update('tbl_wo_noti_assign',array("wna_read"=>1));
		$value = array();
		$this->db->select('tbl_work_order.wo_wo_no as wo_num, tbl_work_order.wo_customer_name as cust_name, prepared_by.au_fname as prep_by_fname, prepared_by.au_lname as prep_by_lname, from_name.au_fname as from_fname, from_name.au_lname as from_lname, too_name.au_lname as to_lname, too_name.au_fname as to_fname, tbl_work_order_notification.wo_noti_date as date,tbl_work_order_notification.wo_noti_msg as msg');
		$this->db->from('tbl_work_order_notification');
		$this->db->join('tbl_wo_noti_assign','tbl_wo_noti_assign.wna_wo_noti_id = tbl_work_order_notification.wo_noti_id');
		
		//$this->db->join('tbl_admin_users as admin_id','admin_id.au_id = tbl_work_order_notification.wo_noti_id');
		$this->db->join('tbl_admin_users as too_name','too_name.au_id = tbl_wo_noti_assign.wna_toid');
		$this->db->join('tbl_admin_users as from_name','from_name.au_id = tbl_wo_noti_assign.wna_fromid');
		$this->db->join('tbl_work_order','tbl_work_order.wo_id  = tbl_work_order_notification.wo_noti_woid');
		$this->db->join('tbl_admin_users as prepared_by','prepared_by.au_id = tbl_work_order.wo_preparedby');

		$this->db->where('wna_toid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		$this->db->order_by('wo_noti_id', 'desc');
		$this->db->limit(1000);
		$query = $this->db->get();

		$value['count'] = $query->num_rows();
		$value['result'] = $query->result_array();
		//echo "<pre>"; print_r($value['result']); die;
		return $value;
	}

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


	
	public function delete($id)
	{
		$this->db->set('Notification_list_isdelete', 1);
		$this->db->where('Notification_list_id', $id);
		$this->db->update('tbl_master_Notification_list');
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
	
	/*public function addtNotification_list()
	{
		
		$this->db->select('Notification_list as Notification_list_name');
		$this->db->from('Notification_list');
		$query = $this->db->get();
		foreach ($query->result_array() as $Notification_list) {
			  $this->db->insert('tbl_master_Notification_list',$Notification_list);
		}
	}
	public function get_addressbook() 
	{     
        $query = $this->db->get('tbl_Notification_list');
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
                        //'Notification_list_cdate'=>date("Y-m-d"),
                        //'Notification_list_udate'=>date("Y-m-d"),
                    );
                    $this->db->insert('tbl_Notification_list', $insert_data);
                    //$this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                redirect(base_url('Notification_list'), 'refresh');
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