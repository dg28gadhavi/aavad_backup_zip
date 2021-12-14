<?php 

class Master_party_model extends CI_Model {
	
	
	public function add($data)
	{

		$item = array(
				'master_party_name' => $data['master_party_name'],
				'master_party_cust_type' => $data['master_party_cust_type'],
				'master_party_address' => $data['master_party_address'],
				'master_party_billing_add' => $data['master_party_billing_add'],
				'master_party_shipping_add' => $data['master_party_shipping_add'],
				'master_party_state' => $data['master_party_state'],
				'master_party_city' => $data['master_party_city'],
				'master_party_country' => $data['master_party_country'],
				'master_party_handled_by' => $data['master_handled_by'],
				'master_party_distributor' => isset($data['master_party_distributor']) ? $data['master_party_distributor'] : 0,
				'master_party_gst' => $data['master_party_gst'],
				
				'master_party_contact_person' => $data['conparty_name'],
				'master_party_contact_no' => $data['conparty_mobile'],
				'master_party_email_address' => $data['conparty_emailid'],
				'master_party_tax' => $data['master_party_tax'],
				'master_party_phone' => $data['master_party_phone'],
				'master_party_category' => $data['master_party_category'],
				'master_party_created_date' => $data['master_party_created_date'],
				'master_party_updated_date' => $data['master_party_updated_date']
			);

		$this->db->insert('tbl_master_party',$item);

		$random_no = "V".$this->db->insert_id();
		$id = $this->db->insert_id();
		$result = array(
		'master_party_code' => $random_no,
		);
		$this->db->where('master_party_id', $id);
		$this->db->update('tbl_master_party', $result); 
		if(isset($data['mebill_add']) && !empty($data['mebill_add'])){
			foreach ($data['mebill_add'] as $key => $value) {
				$cntitem = array(
					'mas_add_cus_id' => $id,
					'mas_add_address' => $value,
					'mas_add_cdate' => date('Y-m-d H:i:s'),
					'mas_add_udate' => date('Y-m-d H:i:s'),
					);
				$this->db->insert('tbl_cus_address',$cntitem);
			}
		}

					$contact = array(
					'conparty_party_id' => $id,
					'conparty_name' => $data['conparty_name'],
					'conparty_mobile' => $data['conparty_mobile'],
					'conparty_emailid' => $data['conparty_emailid'],
					'conparty_depart' => $data['conparty_depart'],
					'conparty_cdate' => date('Y-m-d H:i:s'),
					'conparty_udate' => date('Y-m-d H:i:s'),
					);
				$this->db->insert('tbl_party_contact_info',$contact);
				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Customer/Vendor',
					'adlog_add' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}

	public function edit($data,$id)
	{
		//echo "<pre>"; print_r($data); die;
		$item = array(
				'master_party_name' => $data['master_party_name'],
				'master_party_cust_type' => $data['master_party_cust_type'],
				'master_party_address' => $data['master_party_address'],
				'master_party_billing_add' => $data['master_party_billing_add'],
				'master_party_shipping_add' => $data['master_party_shipping_add'],
				//'master_party_admin'  => json_encode($data['master_party_admin']),
				'master_party_state' => $data['master_party_state'],
				'master_party_city' => $data['master_party_city'],
				'master_party_country' => $data['master_party_country'],
				'master_party_handled_by' => $data['master_handled_by'],
				'master_party_phone' => $data['master_party_phone'],

				'master_party_contact_person' => $data['conparty_name'],
				'master_party_contact_no' => $data['conparty_mobile'],
				'master_party_email_address' => $data['conparty_emailid'],
				//'master_party_contact_person' => $data['conparty_depart'],

				'master_party_distributor' => isset($data['master_party_distributor']) ? $data['master_party_distributor'] : 0,
				'master_party_gst' => $data['master_party_gst'],
				'master_party_tax' => $data['master_party_tax'],
				'master_party_category' => $data['master_party_category'],
				'master_party_updated_date' => $data['master_party_updated_date']
			);
		//$this->db->where('master_party_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('master_party_id', $id);
		$this->db->update('tbl_master_party', $item); 
		
		$this->db->delete('tbl_cus_address',array('mas_add_cus_id' => $id));
		if(isset($data['mebill_add']) && !empty($data['mebill_add']))
		{
			foreach ($data['mebill_add'] as $key => $value) {
					$cntitem = array(
					'mas_add_cus_id' => $id,
					'mas_add_address' => $value,
					'mas_add_cdate' => date('Y-m-d H:i:s'),
					'mas_add_udate' => date('Y-m-d H:i:s'),
					);
				$this->db->insert('tbl_cus_address',$cntitem);
				}
		}
		//$this->db->delete('tbl_party_contact_info',array('conparty_party_id' => $id));
		//foreach ($data['mecontact_name'] as $keyi => $valueg) {
					$contact = array(
					'conparty_party_id' => $id,
					'conparty_name' => $data['conparty_name'],
					'conparty_mobile' => $data['conparty_mobile'],
					'conparty_emailid' => $data['conparty_emailid'],
					'conparty_depart' => $data['conparty_depart'],
					'conparty_cdate' => date('Y-m-d H:i:s'),
					'conparty_udate' => date('Y-m-d H:i:s'),
					);
					$this->db->where('conparty_party_id', $id);
				$this->db->update('tbl_party_contact_info',$contact);
				//}
				$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Customer/Vendor',
					'adlog_edit' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);

			return $id;
	}

	public function get_master_party($Start,$end)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->join('tbl_party_contact_info', 'tbl_party_contact_info.conparty_party_id = tbl_master_party.master_party_id','left');
		//$this->db->join('tbl_master_party_category', 'tbl_master_party_category.master_party_category_id = tbl_master_party.master_party_category','left');
		$this->db->join('tbl_master_state', 'tbl_master_state.state_id = tbl_master_party.master_party_state','left');
		$this->db->join('tbl_master_city', 'tbl_master_city.city_id = tbl_master_party.master_party_city','left');
		$this->db->where('master_party_isdelete',0);
		//$this->db->order_by('master_party_id','desc');
		
		if($this->input->post('party_code') && ($this->input->post('party_code') != ''))
		{
		   $this->db->like('UPPER(master_party_code)', strtoupper($this->input->post('party_code')));   
		}
		if($this->input->post('party_name') && ($this->input->post('party_name') != ''))
		{
		   $this->db->like('UPPER(master_party_name)', strtoupper($this->input->post('party_name')));   
		}
		if($this->input->post('address') && ($this->input->post('address') != ''))
		{
		   $this->db->like('UPPER(master_party_address)', strtoupper($this->input->post('address')));   
		}
		if($this->input->post('contact_person') && ($this->input->post('contact_person') != ''))
		{
		   $this->db->like('UPPER(master_party_contact_person)', strtoupper($this->input->post('contact_person')));
		   $this->db->or_like('UPPER(conparty_name)', strtoupper($this->input->post('contact_person'))); 
		}
		if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
		{
		   $this->db->like('master_party_contact_no', $this->input->post('mobile_no'));   
		   $this->db->or_like('conparty_mobile', $this->input->post('mobile_no')); 
		}
		if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
		{
		   $this->db->like('master_party_contact_no', $this->input->post('phone_no'));   
		   $this->db->or_like('master_party_phone', $this->input->post('phone_no')); 
		}
		if($this->input->post('email_address') && ($this->input->post('email_address') != ''))
		{
		   $this->db->like('UPPER(master_party_email_address)', strtoupper($this->input->post('email_address')));   
		   $this->db->or_like('UPPER(conparty_emailid)', strtoupper($this->input->post('email_address'))); 
		}
		if($this->input->post('state') && ($this->input->post('state') != ''))
		{
		   $this->db->like('UPPER(state_name)', strtoupper($this->input->post('state')));   
		}
		if($this->input->post('city') && ($this->input->post('city') != ''))
		{
		   $this->db->like('UPPER(city_name)', strtoupper($this->input->post('city')));   
		}


		$posdata = $this->input->post();
        //echo '<pre>';print_r($posdata['order']);die;
        if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 9))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('tbl_master_city.city_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('tbl_master_city.city_name','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 8))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('state_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('state_name','DESC');
        	}
        }
       else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 7))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_email_address','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_email_address','DESC');
        	}
        }
       else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_phone','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_phone','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 5))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_contact_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_contact_no','DESC');
        	}
        }
       else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 4))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_gst','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_gst','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 3))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_contact_person','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_contact_person','DESC');
        	}
        }
        else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_address','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_address','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 0))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_code','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_code','DESC');
        	}
        }else{
        	$this->db->order_by('master_party_id','DESC');
        }

		$this->db->limit($end,$Start);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	public function get_master_party_count()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->join('tbl_party_contact_info', 'tbl_party_contact_info.conparty_party_id = tbl_master_party.master_party_id','left');
		//$this->db->join('tbl_master_party_category', 'tbl_master_party_category.master_party_category_id = tbl_master_party.master_party_category','left');
		$this->db->join('tbl_master_state', 'tbl_master_state.state_id = tbl_master_party.master_party_state','left');
		$this->db->join('tbl_master_city', 'tbl_master_city.city_id = tbl_master_party.master_party_city','left');
		$this->db->where('master_party_isdelete',0);
		$this->db->order_by('master_party_id','desc');
		
		if($this->input->post('party_code') && ($this->input->post('party_code') != ''))
		{
		   $this->db->like('master_party_code', $this->input->post('party_code'));   
		}
		if($this->input->post('party_name') && ($this->input->post('party_name') != ''))
		{
		   $this->db->like('master_party_name', $this->input->post('party_name'));   
		}
		if($this->input->post('address') && ($this->input->post('address') != ''))
		{
		   $this->db->like('master_party_address', $this->input->post('address'));   
		}
		if($this->input->post('contact_person') && ($this->input->post('contact_person') != ''))
		{
		   $this->db->like('master_party_contact_person', $this->input->post('contact_person'));
		   $this->db->or_like('conparty_name', $this->input->post('contact_person')); 
		}
		if($this->input->post('mobile_no') && ($this->input->post('mobile_no') != ''))
		{
		   $this->db->like('master_party_contact_no', $this->input->post('mobile_no'));   
		   $this->db->or_like('conparty_mobile', $this->input->post('mobile_no')); 
		}
		if($this->input->post('phone_no') && ($this->input->post('phone_no') != ''))
		{
		   $this->db->like('master_party_contact_no', $this->input->post('phone_no'));   
		   $this->db->or_like('master_party_phone', $this->input->post('phone_no')); 
		}
		if($this->input->post('email_address') && ($this->input->post('email_address') != ''))
		{
		   $this->db->like('master_party_email_address', $this->input->post('email_address'));   
		   $this->db->or_like('conparty_emailid', $this->input->post('email_address')); 
		}
		if($this->input->post('state') && ($this->input->post('state') != ''))
		{
		   $this->db->like('state_name', $this->input->post('state'));   
		}
		if($this->input->post('city') && ($this->input->post('city') != ''))
		{
		   $this->db->like('city_name', $this->input->post('city'));   
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	
	public function sa_no_get()
	{
		$this->db->select('master_party_id');
		$this->db->from('tbl_master_party');
		$this->db->order_by('master_party_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['master_party_id'] = isset($autoid['master_party_id']) ? $autoid['master_party_id'] : '';
		return $code['pre_party_code'].''.($autoid['master_party_id']+1);
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->join('tbl_party_contact_info', 'tbl_party_contact_info.conparty_party_id = tbl_master_party.master_party_id','left');
		$this->db->join('tbl_cus_address','tbl_master_party.master_party_id = tbl_cus_address.mas_add_cus_id','left');
		$this->db->where('master_party_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_area_model($data)
	{
		$query = $this->db->get_where('tbl_city',array('city_state' => $data['id']));
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function insert_csv($data)
	{
		$query = $this->db->get_where('tbl_master_party',array('master_party_name' => $data['master_party_name'],'master_party_cid' => $this->session->userdata['login']['aus_Id']));
		if($query->num_rows() == 0)
		{
			$this->db->insert('tbl_master_party',$data);
		}
		$last_nsert_id = $this->db->insert_id();
		$where = array(
		'master_party_code' => "V".$last_nsert_id,
		'master_party_cid' => $this->session->userdata['login']['aus_Id']
		);
		$this->db->where('master_party_id',$last_nsert_id);
		$this->db->update('tbl_master_party',$where);
	}
	public function get_report_data()
	{
		$query = $this->db->get_where('tbl_master_party',array('master_party_id' => $this->input->get('id'),'master_party_cid' => $this->session->userdata['login']['aus_Id']));
		return $query->result_array();
	}
	public function getvendorlist()
	{
		$query = $this->db->get_where('tbl_master_party',array('master_party_cid' => $this->session->userdata['login']['aus_Id']));
		return $query->result_array();
	}
	public function get_selected_vendor($sv)
	{
		$query = $this->db->get_where('tbl_master_party',array('master_party_id' => $sv,'master_party_cid' => $this->session->userdata['login']['aus_Id']));
		//echo " inside s v l<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function get_ajax($id)
	{
		$query = $this->db->get_where('tbl_master_party',array(
			'master_party_id' => $id,
			'master_party_cid' => $this->session->userdata['login']['aus_Id']
			));
		return $query->row_array();
	}
	public function delete($id)
    {
		$this->db->set('master_party_isdelete',1);
		$this->db->where('master_party_id', $id);
		$this->db->delete('tbl_master_party'); 
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Customer/Vendor',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
	}

	public function get_counrty_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_state_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_city_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_taxs_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax_category');
		//$this->db->where('city_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_address($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->where('master_party_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_customertype()
	{
		$this->db->select('*');
		$this->db->from('tbl_customer_type');
		//$this->db->join('tbl_master_party','tbl_sales_enq.vendor = tbl_master_party.master_party_id');
		$this->db->where('ctype_isdelete',0);
		//$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_admin()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>