<?php 

class Master_item_model extends CI_Model {
	
	
	public function add($data)
	{

		if(isset($data['master_item_catname']) && ($data['master_item_catname'] != ''))
		{
			$category = array(
			'itm_cat_name' => $data['master_item_catname'],
			'itm_cat_parent' => $data['master_item_catp'],
			'itm_cat_cid' => $this->session->userdata['login']['aus_Id'],
			'itm_cat_status' => 1,
			'itm_cat_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_item_category',$category);
			$data['master_item_selcatp'] = $this->db->insert_id();
		}

		if(isset($data['master_item_heads']) && $data['master_item_heads'] != ''){
			$aus_home = json_encode($data['master_item_heads']);
		}
		else{
			$aus_home = '';
		}
		$item = array(
			'master_item_name' => $data['master_item_name'],
			//'master_item_code' => $data['master_item_name'],
			'master_item_description' => $data['master_item_description'],
			'master_item_location' => $data['master_item_location'],
			'master_item_stock' => $data['master_item_stock'],
			'master_item_ldescription' => $data['master_item_ldescription'],
			'master_item_tags' => $data['master_item_tags'],
			'master_item_make' => $data['master_item_make'],
			'master_item_heads' => $aus_home,
			'master_item_part_no' => $data['master_item_pno'],
			'master_item_rate' => $data['master_item_rate'],
			'master_item_unit' => $data['master_item_unit'],
			//'master_item_cats' => $data['master_item_selcatp'],
			'master_item_make' => $data['item_supplier_id'],
			'master_item_make_name' => $data['item_supplier'],
			'master_item_weight' => $data['master_item_weight'],
			'master_item_dimension' => $data['master_item_dimension'],
			'master_item_hsncode' => $data['master_item_hsn'],
			'master_item_tax' => $data['master_item_Tax'],
			'master_item_limit' => $data['master_item_limit'],
			'master_item_created_date' => $data['master_item_created_date'],
			'master_item_updated_date' => $data['master_item_updated_date'],
			'master_item_code' => $data['master_item_code']
			);
			//echo "<pre>";print_r($item);die;
		$this->db->insert('tbl_master_item',$item);
		//$lastid = "ITEM".$this->db->insert_id();
		$lid = $this->db->insert_id();

		foreach ($data['master_item_heads'] as $hid) 
		{
			$auh = array(
					'mih_item_id' => $lid,
					'mih_heads_id' => $hid,
					'mih_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_master_item_heads',$auh);
		}

		if(isset($data['master_item_img']))
		{
			$item = array(
			'master_item_img' => $data['master_item_img']
			);
			$this->db->where('master_item_id', $lid);
			$this->db->update('tbl_master_item', $item); 
		}
	
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Item',
					'adlog_add' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $lid;
	}
	
	public function add_image($image,$lid)
	{
		$where = array(
		'master_item_image' => $image
		);
		$this->db->where('master_item_id',$lid);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_item',$where);
	}
	
	public function edit($data,$id)
	{ 
		//echo "<pre>"; print_r($data); die;
		//echo "<pre>"; print_r(json_encode($data['master_item_heads'])); die;
		if(isset($data['master_item_catname']) && ($data['master_item_catname'] != ''))
		{
			$category = array(
			'itm_cat_name' => $data['master_item_catname'],
			'itm_cat_parent' => $data['master_item_catp'],
			'itm_cat_cid' => $this->session->userdata['login']['aus_Id'],
			'itm_cat_status' => 1,
			'itm_cat_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_item_category',$category);
			$data['master_item_selcatp'] = $this->db->insert_id();
		}
		if(isset($data['master_item_heads']) && $data['master_item_heads'] != ''){
			$aus_home = json_encode($data['master_item_heads']);
		}
		else{
			$aus_home = '';
		}
		//echo "<pre>"; print_r($aus_home); die;

		$item = array(
		'master_item_name' => $data['master_item_name'],
			//'master_item_hsncode' => $data['master_item_hsncode'],
			//'master_item_party' => $data['master_item_party'],
			'master_item_description' => $data['master_item_description'],
			'master_item_location' => $data['master_item_location'],
			'master_item_stock' => $data['master_item_stock'],
			'master_item_ldescription' => $data['master_item_ldescription'],
			'master_item_tags' => $data['master_item_tags'],
			'master_item_make' => $data['master_item_make'],
			//'master_item_brand' => $aus_home,
			'master_item_heads' => $aus_home,
			'master_item_part_no' => $data['master_item_pno'],
			'master_item_rate' => $data['master_item_rate'],
			'master_item_unit' => $data['master_item_unit'],
			'master_item_make' => $data['item_supplier_id'],
			'master_item_make_name' => $data['item_supplier'],
			//'master_item_cats' => $data['master_item_selcatp'],
			'master_item_weight' => $data['master_item_weight'],
			'master_item_dimension' => $data['master_item_dimension'],
			'master_item_hsncode' => $data['master_item_hsn'],
			'master_item_tax' => $data['master_item_Tax'],
			'master_item_limit' => $data['master_item_limit'],
			'master_item_updated_date' => $data['master_item_updated_date']
			);
		$this->db->where('master_item_id', $id);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_item', $item); 
		//$lid = $this->input->get('id');
		if(isset($data['master_item_img']))
		{
			$item = array(
			'master_item_img' => $data['master_item_img']
			);
			$this->db->where('master_item_id',$id);
			$this->db->update('tbl_master_item', $item); 
		}
		//echo '<pre>';print_r($item);die;
		$this->db->delete('tbl_master_item_heads',array('mih_item_id'=>$id));
	
		foreach ($data['master_item_heads'] as $hid) 
		{
			$auh = array(
					'mih_item_id' => $id,
					'mih_heads_id' => $hid,
					'mih_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_master_item_heads',$auh);
		}

		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Item',
					'adlog_edit' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;	
	}

	public function sa_no_get()
	{
		$this->db->select('master_item_id');
		$this->db->from('tbl_master_item');
		$this->db->order_by('master_item_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$autoid = $query->row_array();
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		$code = $query->row_array();
		$autoid['master_item_id'] = isset($autoid['master_item_id']) ? $autoid['master_item_id'] : '';
		return $code['pre_item_code'].''.($autoid['master_item_id']+1);
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		//$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_master_item.master_item_id');
		//$this->db->join('tbl_master_party', 'tbl_master_party.master_party_id = tbl_itm_bom.bom_make');
		$this->db->where('master_item_id',$id);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	/*public function get_supplier()
	{ //die;
		//$result1=array();
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		$value['master_item']=$query->result_array();

		foreach ($value['master_item'] as $key => $master){
			$this->db->select('*');
			$this->db->from('tbl_master_party');
			$this->db->where('master_party_id',$master['master_item_make']);
			$query = $this->db->get();
			$rows=$query->row_array();
			//echo "<pre>"; print_r($rows); die;
			
			if($query->num_rows()==1)
		{
			$id=$rows['master_party_id']; 
			$item = array(
			'master_item_make_name' => $rows['master_party_name']
			);
			$this->db->where('master_item_id',$master['master_item_id']);
			$this->db->update('tbl_master_item', $item); 
		}
			
			}
			//return $value;

	}
*/


	public function get_master_items($Start,$end)
	{
		//$this->db->select('tbl_master_item.*,tbl_hsn_code.*,tbl_master_party.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'0'".' ) as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_master_item.master_item_id AND tdebit.tran_is_hold = '."'0'".' ) as tdebitpoints,(IFNULL((select ROUND(SUM(tcredit_hold.tran_itm_qty),2) FROM tbl_transaction as tcredit_hold WHERE tcredit_hold.tran_cr_or_dr = 2 AND tcredit_hold.tran_itm_id = tbl_master_item.master_item_id AND tcredit_hold.tran_is_hold = '."'1'".' ),0) - IFNULL((select ROUND(SUM(tdebit_hold.tran_itm_qty),2) FROM tbl_transaction as tdebit_hold WHERE tdebit_hold.tran_cr_or_dr = 1 AND tdebit_hold.tran_itm_id = tbl_master_item.master_item_id  AND tdebit_hold.tran_is_hold = '."'1'".' ),0)) as hold_stock');
		$this->db->select('tbl_master_item.*,tbl_hsn_code.*,tbl_master_party.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'0'".' ) as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_master_item.master_item_id AND tdebit.tran_is_hold = '."'0'".' ) as tdebitpoints');
		$this->db->from('tbl_master_item');
		$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_master_item.master_item_hsncode','left');
		$this->db->join('tbl_master_party','tbl_master_item.master_item_make = tbl_master_party.master_party_id','left');
		//$this->db->join('tbl_inward','tbl_inward.inw_id = tbl_inward_item.inwi_inw_id','left');
		//$this->db->where('tbl_master_item.master_item_flag !=',3);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		 // $this->db->order_by('inv_id','desc');
   	   if($this->input->post('item_no') && ($this->input->post('item_no') != ''))
        {
           $this->db->like('master_item_code', $this->input->post('item_no'));   
        }
        if($this->input->post('inw_suppiler') && ($this->input->post('inw_suppiler') != ''))
        {
           $this->db->like('master_party_name', $this->input->post('inw_suppiler'));   
        }
          if($this->input->post('item_name') && ($this->input->post('item_name') != ''))
        {
           $this->db->like('master_item_name', $this->input->post('item_name'));   
        }
        if($this->input->post('detail_of_item') && ($this->input->post('detail_of_item') != ''))
        {
           $this->db->like('master_item_description', $this->input->post('detail_of_item'));   
        }
   
    	 if($this->input->post('hsn_code') && ($this->input->post('hsn_code') != ''))
        {
           $this->db->like('master_item_hsncode', $this->input->post('hsn_code'));   
        }
        if($this->input->post('pno') && ($this->input->post('pno') != ''))
        {
           $this->db->like('master_item_part_no', $this->input->post('pno'));   
        }
        $posdata = $this->input->post();
        if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 1))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_party_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_party_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 25))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_item_code','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_item_code','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 2))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_item_hsncode','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_item_hsncode','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 3))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_item_name','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_item_name','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 4))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_item_part_no','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_item_part_no','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 5))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_item_description','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_item_description','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 6))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('master_item_rate','ASC');
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('master_item_rate','DESC');
        	}
        }else if(isset($posdata) && isset($posdata['order']) && isset($posdata['order'][0]) && isset($posdata['order'][0]['column']) && ($posdata['order'][0]['column'] == 7))
        {
        	if($posdata['order'][0]['dir'] == 'asc')
        	{
        		$this->db->order_by('IFNULL(IFNULL((select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'0'".' ),0) - IFNULL((select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_master_item.master_item_id AND tdebit.tran_is_hold = '."'0'".' ),0),0)','ASC',false);
        	}else if($posdata['order'][0]['dir'] == 'desc'){
        		$this->db->order_by('IFNULL(IFNULL((select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'0'".' ),0) - IFNULL((select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_master_item.master_item_id AND tdebit.tran_is_hold = '."'0'".' ),0),0)','DESC',false);
        	}
        }else{
        	$this->db->order_by('tbl_master_item.master_item_id','DESC');
        }
        //$this->db->order_by('tbl_master_item.master_item_id','DESC');
        $this->db->limit($end,$Start);
		$query = $this->db->get();
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query->result_array();
	}

	public function get_master_items_count()
	{
		$this->db->select('tbl_master_item.*,tbl_hsn_code.*,tbl_master_party.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '."'0'".' ) as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_master_item.master_item_id AND tdebit.tran_is_hold = '."'0'".' ) as tdebitpoints');
		$this->db->from('tbl_master_item');
		$this->db->join('tbl_hsn_code','tbl_hsn_code.hsn_id = tbl_master_item.master_item_hsncode','left');
		$this->db->join('tbl_master_party','tbl_master_item.master_item_make = tbl_master_party.master_party_id','left');
		//$this->db->join('tbl_inward','tbl_inward.inw_id = tbl_inward_item.inwi_inw_id','left');
		//$this->db->where('tbl_master_item.master_item_flag !=',3);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		 // $this->db->order_by('inv_id','desc');
   	   if($this->input->post('item_no') && ($this->input->post('item_no') != ''))
        {
           $this->db->like('master_item_code', $this->input->post('item_no'));   
        }
        if($this->input->post('inw_suppiler') && ($this->input->post('inw_suppiler') != ''))
        {
           $this->db->like('master_party_name', $this->input->post('inw_suppiler'));   
        }
          if($this->input->post('item_name') && ($this->input->post('item_name') != ''))
        {
           $this->db->like('master_item_name', $this->input->post('item_name'));   
        }
        if($this->input->post('detail_of_item') && ($this->input->post('detail_of_item') != ''))
        {
           $this->db->like('master_item_description', $this->input->post('detail_of_item'));   
        }
   
    	 if($this->input->post('hsn_code') && ($this->input->post('hsn_code') != ''))
        {
           $this->db->like('master_item_hsncode', $this->input->post('hsn_code'));   
        }
        if($this->input->post('pno') && ($this->input->post('pno') != ''))
        {
           $this->db->like('master_item_part_no', $this->input->post('pno'));   
        }
        $this->db->order_by('tbl_master_item.master_item_id','DESC');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->num_rows();
	}
	
	public function insert_csv($data)
	{
		$query = $this->db->get_where('tbl_master_party',array('master_party_name' => $data['master_item_make']));
		if($query->num_rows() > 0)
		{
			$resultcity = $query->row_array();
			$data['master_item_make'] = $resultcity['master_party_id'];
		}
		$query = $this->db->get_where('tbl_master_item',array('master_item_name' => $data['master_item_name']));
		if($query->num_rows() == 0)
		{
			$this->db->insert('tbl_master_item',$data);
			$lastid = "ITEM".$this->db->insert_id();
			$lid = $this->db->insert_id();
			$result = array('master_item_code' => $lastid);
			$this->db->where('master_item_id', $lid);
			$this->db->update('tbl_master_item', $result); 
		}
	}
	
	public function insert_csv_2($data)
	{
		$query = $this->db->get_where('tbl_master_party',array('master_party_name' => $data['master_item_make']));
		if($query->num_rows() > 0)
		{
			$resultcity = $query->row_array();
			$data['master_item_make'] = $resultcity['master_party_id'];
		}
		$query = $this->db->get_where('tbl_master_item',array('master_item_name' => $data['master_item_name']));
		if($query->num_rows() == 0)
		{
			$this->db->insert('tbl_master_item',$data);
			$lastid = "ITEM".$this->db->insert_id();
			$lid = $this->db->insert_id();
			$result = array('master_item_code' => $lastid);
			$this->db->where('master_item_id', $lid);
			$this->db->update('tbl_master_item', $result); 
		}
	}

	public function set_Delete_flag($id)
	{
		$this->db->where('master_item_id',$id);
		//$this->db->where('master_item_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_item',array('master_item_flag'=>3));
		return $id;
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('master_item_id', $id);
		$this->db->delete('tbl_master_item');
		$log = array(
					'adlog_name' => $this->session->userdata['miconlogin']['email'],
					'adlog_datetime' => date('Y-m-d H:i:s'),
					'adlog_ip' =>$_SERVER['REMOTE_ADDR'],
					'adlog_module' => 'Item',
					'adlog_delete' => 1
				);
			$this->db->insert('tbl_adminlogs',$log);
		return $id;
	}

	public function item_txs()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		//$this->db->where('tax_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_units()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_unit');
		$this->db->where('master_item_unit_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_item_makes()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_party');
		$this->db->where('master_party_isdelete',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function geteditax()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_tax');
		//$this->db->where('mit_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->where('mit_item_id',$this->input->get('id'));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_tax_datas()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax_category');
		$query = $this->db->get();
		$values = array();
		$values = $query->result_array();
		foreach($values as $key => $value)
		{
			$this->db->select('*');
			$this->db->from('tbl_master_item_tax');
			$this->db->where('mit_item_id',$this->input->get('id'));
			$this->db->where('mit_tax_cat_id',$value['tax_cat_id']);
			$query = $this->db->get();
			$values[$key]['tax_details'] = $query->result_array();
		}
		return $values;
	}

	public function get_hsn()
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$query = $this->db->get();
		$values = $query->result_array();
		return $values;
	}

	public function get_item_heads()
	{
		$this->db->select('*');
		$this->db->from('tbl_item_heads');
		$this->db->where('item_head_parent',0);
		$query = $this->db->get();
		$values = $query->result_array();
		return $values;
	}

	public function get_tax($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$this->db->where('hsn_id',$id);
		$query = $this->db->get();
		return $query->row_array();
    }
    public function get_salesbrand()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$query = $this->db->get();
		return $query->result_array();
	}
	//  public function item_gets()
	//  {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_master_item');
	// 	$query = $this->db->get();
	// 	$items = $query->result_array();
	// 	 foreach ($items as $tname) {
	// 		{
	// 			$item = array(
	// 				'master_item_code' => $tname['master_item_code'],
	// 				'master_item_name' => $tname['master_item_name'],
	// 				'master_item_party' => '',
	// 				'master_item_hsncode' => '',
	// 				'master_item_make' => $tname['master_item_make'],
	// 				'master_item_pno' => $tname['master_item_part_no'],
	// 				'master_item_img' => $tname['master_item_image'],
	// 				'master_item_currency' => '',
	// 				'master_item_unit' => $tname['master_item_unit'],
	// 				'master_item_qty' => '',
	// 				'master_item_rate' => $tname['master_item_price'],
	// 				'master_item_minrate' => '',
	// 				'master_item_has_tax' => '',
	// 				'master_item_description' => $tname['master_item_description'],
	// 				'master_item_stock' => $tname['master_item_stock_limit'],
	// 				'master_item_ldescription' => '',
	// 				'master_item_tags' => '',
	// 				'master_item_cats' => '',
	// 				'master_item_flag' => $tname['master_item_stock_flag'],
	// 				'master_item_cid' => '2',
	// 				'master_item_bom' => '',
	// 				'master_item_bomid' => '',
	// 				'master_item_created_date' => date('Y-m-d H:i:s'),
	// 				'master_item_updated_date' =>  date('Y-m-d H:i:s'),
			
	// 				);
	// 			$this->db->insert('tbl_master_item1',$item);	
	// 			$lid = $this->db->insert_id();
                 
 //  //               $lastid = "ITEM".$this->db->insert_id();
	// 	// 		//$lid = $this->db->insert_id();
	// 	// 		$result = array('master_item_code' => $lastid,'master_item_cid' => $this->session->userdata['login']['aus_Id']);
	// 	// 		$this->db->where('master_item_id', $lid);
	// 	// 		$this->db->update('tbl_master_item', $result); 
	// 			$tax = array(
	// 				'mit_item_id' => $tname['master_item_id'],
	// 				'mit_name' => 'SGST',
	// 				'mit_tax_cat_id' =>'1',
	// 				'mit_tax_id' =>'1',
	// 				'mit_value' => 9,
	//                 //'mit_sgst' => 10,
	// 				'mit_cid' => 2,
	// 				'mit_cdate' => date('Y-m-d H:i:s'),
	// 				'mit_udate' => date('Y-m-d H:i:s')
	// 				);
	// 				//echo "<pre>";print_r($tax);die;
	// 			$this->db->insert('tbl_master_item_tax',$tax);
	// 			$taddx = array(
	// 				'mit_item_id' => $tname['master_item_id'],
	// 				'mit_name' => 'CGST',
	// 				'mit_tax_cat_id' =>'1',
	// 				'mit_tax_id' =>'2',
	// 				'mit_value' => 9,
	//                 //'mit_sgst' => 10,
	// 				'mit_cid' => 2,
	// 				'mit_cdate' => date('Y-m-d H:i:s'),
	// 				'mit_udate' => date('Y-m-d H:i:s')
	// 				);
	// 				//echo "<pre>";print_r($tax);die;
	// 			$this->db->insert('tbl_master_item_tax',$taddx);
	// 			$taxyy = array(
	// 				'mit_item_id' => $tname['master_item_id'],
	// 				'mit_name' => 'IGST',
	// 				'mit_tax_cat_id' =>'2',
	// 				'mit_tax_id' =>'3',
	// 				'mit_value' => 18,
	//                 //'mit_sgst' => 10,
	// 				'mit_cid' => 2,
	// 				'mit_cdate' => date('Y-m-d H:i:s'),
	// 				'mit_udate' => date('Y-m-d H:i:s')
	// 				);
	// 				//echo "<pre>";print_r($tax);die;
	// 			$this->db->insert('tbl_master_item_tax',$taxyy);
			
	//  	}
	//  }
	// }

	public function get_cust($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_hsn_code');
		$this->db->where('hsn_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function itm_tblmitmr_insert()
	{
		die;
		$hsidautoid = 0;
		$this->db->select('*');
		$this->db->from('tbl_master_item_oldr');
		$this->db->join('tbl_master_hsn_code','tbl_master_hsn_code.mhc_id = tbl_master_item_oldr.hsn_code');
		$query = $this->db->get();
		$old_itm = $query->result_array();
		foreach ($old_itm as $key => $value) 
		{
			$this->db->select('*');
			$this->db->from('tbl_hsn_code');
			$this->db->where('hsn_hcode',$value['mhc_hsn_code']);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				$insert = array(
					'hsn_hcode' => $value['mhc_hsn_code'],
					'hsn_sgst' => $value['mhc_sgst'],
					'hsn_cgst' => $value['mhc_cgst'],
					'hsn_remark' => $value['mhc_remarks'],
					'hsn_tax' => $value['mhc_total_tax'],
					'hsn_cdate' => date("Y-m-d H:i:s"),
					'hsn_udate' => date("Y-m-d H:i:s")
				);
				$hsidautoid = $this->db->insert('tbl_hsn_code',$insert);
			}
			if($query->num_rows() == 1)
			{
				$hsndata = $query->row_array();
				$hsidautoid = $hsndata['hsn_id'];
			}

			if($hsidautoid != 0){
				$partno = $value['master_item_part_no'];
				$hsnid = $hsidautoid;
				$update = array('master_item_hsncode' => $hsnid);
				$this->db->where('master_item_part_no',$partno);
				$this->db->update('tbl_master_item',$update);
			}
		}
die;

		die;
		$this->db->select('*');
		$this->db->from('tbl_master_item_oldr');
		$query = $this->db->get();
		$old_itm = $query->result_array();
		foreach ($old_itm as $key => $value) 
		{
			$this->db->select('*');
			$this->db->from('tbl_master_item');
			$this->db->where('master_item_part_no',$value['master_item_part_no']);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				//echo "hii";die;
				$new_itm = $query->row_array();
				
				//echo "<pre>";print_r($new_itm);die;
				unset($value['master_item_image']);
				unset($value['master_item_id']);
				$this->db->insert('tbl_master_item',$value);
				$itm_id=$this->db->insert_id();

				$stock = $value['master_item_stock'];
				//$itm_id = $new_itm['master_item_id'];
				//echo "<pre>";print_r($itm_id);die;
				$itme = array(
					'tran_itm_id' => $itm_id,
					'tran_itm_qty' => $stock,
					'tran_cr_or_dr' => 1,
					'tran_ip' => $_SERVER['REMOTE_ADDR'],
					'tran_cdate' => date('Y-m-d H:i:s'),
					'tran_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_transaction',$itme);



			}
		}
	}

	public function itm_stock_insert()
	{
		$this->db->select('*');
		$this->db->from('tbl_master_item_old');
		$this->db->where('master_item_stock !=',0);
		$query = $this->db->get();
		$old_itm = $query->result_array();

		foreach ($old_itm as $key => $value) 
		{
			$this->db->select('*');
			$this->db->from('tbl_master_item');
			$this->db->where('master_item_part_no',$value['master_item_part_no']);
			$query = $this->db->get();
			if($query->num_rows() == 1)
			{
				$new_itm = $query->row_array();
				$stock = $value['master_item_stock'];
				$itm_id = $new_itm['master_item_id'];
				//echo "<pre>";print_r($itm_id);die;
				$itme = array(
					'tran_itm_id' => $itm_id,
					'tran_itm_qty' => $stock,
					'tran_cr_or_dr' => 1,
					'tran_ip' => $_SERVER['REMOTE_ADDR'],
					'tran_cdate' => date('Y-m-d H:i:s'),
					'tran_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_transaction',$itme);

			}
		}
	}
	
}
?>