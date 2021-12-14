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

	public function test_product()
	{

		// $this->db->select('*');
		// 	$this->db->from('products_new');
		// 	$query = $this->db->get();
		// echo "<pre>";print_r($query->row_array());die;

		$sql = 'SELECT name, COUNT(name) as countsno FROM products GROUP BY name HAVING COUNT(name) > 1 ORDER BY `countsno` DESC';
		$query = $this->db->query($sql);
		$namedatas = $query->result_array();
		foreach ($namedatas as $namedata) {
			$this->db->select('*');
			$this->db->from('products');
			$this->db->where('name',$namedata['name']);
			$query = $this->db->get();
			//echo "<pre>";print_r($query->result_array());die;
			$i = 0;
			$insert = array();
			$productdatas = $query->result_array();
			$sku_string = '';
			foreach ($productdatas as $key => $value) { $i++;
				$value['itemcode'] = str_replace("'","",$value['itemcode']);
				$value['itemcode'] = str_replace('"','',$value['itemcode']);
				$value['itemcode'] = str_replace(',','',$value['itemcode']);
				$value['shortdescr'] = str_replace('"','in',$value['shortdescr']);
				$value['shortdescr'] = str_replace(',','',$value['shortdescr']);
				if(isset($value['act10']) && ($value['act10'] == 1)){
					$value['act10'] = 'Yes';
				}else if(isset($value['act10']) && ($value['act10'] == 2)){
					$value['act10'] = 'No';
				}else{
					$value['act10'] = 'No';
				}
				if(isset($value['act21']) && ($value['act21'] == 1)){
					$value['act21'] = 'Yes';
				}else if(isset($value['act21']) && ($value['act21'] == 2)){
					$value['act21'] = 'No';
				}else{
					$value['act21'] = 'No';
				}
				$this->db->select('*');
				$this->db->from('categories');
				$this->db->where('lid',$value['catagory']);
				$query = $this->db->get();
				if($query->num_rows() == 1)
				{
					$catdatas = $query->row_array();
					$cat_name = $catdatas['name'];
				}else{
					$cat_name = "";
				}
				if($i != 1)
				{
					$sku_string .= '|';
				}
				$sku_string .= "sku=".$value['itemcode'].",size=".$value['shortdescr'];
				if($i == 1)
				{
					$insert[] = array(
					    'sku' => $value['itemcode']."-A",
					    'store_view_code' => '',
					    'attribute_set_code' => 'Products',
					    'product_type' => 'configurable',
					    'categories' => $cat_name,
					    'product_websites' => 'base',
					    'name' => $value['name'],
					    'description' => $value['longdescr'],
					    'short_description' => $value['shortdescr'],
					    'weight' => $value['wt'],
					    'product_online' => '1.00',
					    'tax_class_name' => '0.00',
					    'visibility' => "Catalog, Search",
					    'price' => '',//$value['price0'],
					    'special_price' => '',
					    'special_price_from_date' => '',
					    'special_price_to_date' => '',
					    'url_key' => url_title(convert_accented_characters($value['name']), 'dash', TRUE),
					    'meta_title' => $value['name'],
					    'meta_keywords' => $value['name'],
					    'meta_description' => $value['name'],
					    'base_image' => $value['imagename'].'.jpg',
					    'base_image_label' => '',
					    'small_image' => $value['imagename'].'.jpg',
					    'small_image_label' => '',
					    'thumbnail_image' => $value['imagename'].'.jpg',
					    'thumbnail_image_label' => '',
					    'swatch_image' => $value['imagename'].'.jpg',
					    'swatch_image_label' => '',
					    'created_at' => date("d-m-yy H:i"),//2/12/20, 2:25 AM
					    'updated_at' => date("d-m-yy H:i"),
					    'new_from_date' => date("d-m-yy"),
					    'new_to_date' => date("d-m-yy"),
					    'display_product_options_in' => "Block after Info Column",
					    'map_price' => '',
					    'msrp_price' => '',
					    'map_enabled' => '',
					    'gift_message_available' => "Use config",
					    'custom_design' => '',
					    'custom_design_from' => '',
					    'custom_design_to' => '',
					    'custom_layout_update' => '', 
					    'page_layout' => '',
					    'product_options_container' => '',
					    'msrp_display_actual_price_type' => "Use config",
					    'country_of_manufacture' => "United States",
					    'additional_attributes' => "act10=".str_replace(" ","",$value['act10']).",act21=".str_replace(" ","",$value['act21']).",itemcode=".str_replace(" ","",$value['itemcode'])."-A,model=".str_replace(" ","",$value['model']).",promo10=".str_replace(" ","",$value['promo10']).",promo21=".str_replace(" ","",$value['promo21']).",restrstates=".str_replace(" ","",$value['restrstates']).",retail=".$value['retail'].",upc=".str_replace(" ","",$value['upc']).",vendor=".str_replace(" ","",$value['vendor']).",pack=".str_replace(" ","",$value['pack']).",price0=".str_replace(" ","",$value['price0']).",price1=".str_replace(" ","",$value['price1']).",price2=".str_replace(" ","",$value['price2']).",price3=".str_replace(" ","",$value['price3']).",price4=".str_replace(" ","",$value['price4']).",price5=".str_replace(" ","",$value['price5']).",price6=".str_replace(" ","",$value['price6']).",ts_packaging_type=None", // act10=1,act21=1,itemcode=013-00001-A,model=FO 2004,promo10=0,promo21=0,restrstates= AK CO HI ID MT NM NV TX UT WE WY,retail=30.890000,ts_packaging_type=None,upc=7-68980-88010-3,vendor=65281 // .",pack=".$value['pack'].",price0=".$value['price0'].",price1=".$value['price1'].""
					    'qty' => "0.00",
					    'out_of_stock_qty' => "0.00",
					    'use_config_min_qty' => "1.00",
					    'is_qty_decimal' => "0.00",
					    'allow_backorders' => "0.00",
					    'use_config_backorders' => "1.00",
					    'min_cart_qty' => "1.00",
					    'use_config_min_sale_qty' => "1.00",
					    'max_cart_qty' => "10000.00",
					    'use_config_max_sale_qty' => "1.00",
					    'is_in_stock' => "1.00",
					    'notify_on_stock_below' => "20.00",
					    'use_config_notify_stock_qty' => '0.00',
					    'manage_stock' => "1.00",
					    'use_config_manage_stock' => "1.00",
					    'use_config_qty_increments' => "1.00",
					    'qty_increments' => "1.00",
					    'use_config_enable_qty_inc' => "1.00",
					    'enable_qty_increments' => "0.00",
					    'is_decimal_divided' => "0.00",
					    'website_id' => "0.00",
					    'related_skus' => "",
					    'related_position' => "",
					    'crosssell_skus' => "",
					    'crosssell_position' => "",
					    'upsell_skus' => "",
					    'upsell_position' => "",
					    'additional_images' => $value['imagename'].'.jpg',
					    'additional_image_labels' => '',
					    'hide_from_product_page' => '',
					    'custom_options' => '',
					    'bundle_price_type' => '',
					    'bundle_sku_type' => '',
					    'bundle_price_view' => '',
					    'bundle_weight_type' => '',
					    'bundle_values' => '',
					    'bundle_shipment_type' => '',
					    'associated_skus' => '',
					    'downloadable_links' => '',
					    'downloadable_samples' => '',
					    'configurable_variations' => "",//"sku=999-00001,size=1 gal. Concentrate|sku=999-00002,size=2.5 gal. Concentrate|sku=999-00003,size=5 g"
					    'configurable_variation_labels' => "size=Size"
					);


					$insert[] = array(
					    'sku' => $value['itemcode'],
					    'store_view_code' => '',
					    'attribute_set_code' => 'Products',
					    'product_type' => 'simple',
					    'categories' => $cat_name,
					    'product_websites' => 'base',
					    'name' => $value['name'],
					    'description' => $value['longdescr'],
					    'short_description' => $value['shortdescr'],
					    'weight' => $value['wt'],
					    'product_online' => '1.00',
					    'tax_class_name' => '0.00',
					    'visibility' => "Not Visible Individually",
					    'price' => $value['price0'],
					    'special_price' => '',
					    'special_price_from_date' => '',
					    'special_price_to_date' => '',
					    'url_key' => url_title(convert_accented_characters($value['name']), 'dash', TRUE),
					    'meta_title' => $value['name'],
					    'meta_keywords' => $value['name'],
					    'meta_description' => $value['name'],
					    'base_image' => $value['imagename'].'.jpg',
					    'base_image_label' => '',
					    'small_image' => $value['imagename'].'.jpg',
					    'small_image_label' => '',
					    'thumbnail_image' => $value['imagename'].'.jpg',
					    'thumbnail_image_label' => '',
					    'swatch_image' => $value['imagename'].'.jpg',
					    'swatch_image_label' => '',
					    'created_at' => date("d-m-yy H:i"),//2/12/20, 2:25 AM
					    'updated_at' => date("d-m-yy H:i"),
					    'new_from_date' => date("d-m-yy"),
					    'new_to_date' => date("d-m-yy"),
					    'display_product_options_in' => "Block after Info Column",
					    'map_price' => '',
					    'msrp_price' => '',
					    'map_enabled' => '',
					    'gift_message_available' => "No",
					    'custom_design' => '',
					    'custom_design_from' => '',
					    'custom_design_to' => '',
					    'custom_layout_update' => '', 
					    'page_layout' => '',
					    'product_options_container' => '',
					    'msrp_display_actual_price_type' => "Use config",
					    'country_of_manufacture' => "United States",
					    'additional_attributes' => "act10=".str_replace(" ","",$value['act10']).",act21=".str_replace(" ","",$value['act21']).",itemcode=".str_replace(" ","",$value['itemcode']).",model=".str_replace(" ","",$value['model']).",promo10=".str_replace(" ","",$value['promo10']).",promo21=".str_replace(" ","",$value['promo21']).",restrstates=".str_replace(" ","",$value['restrstates']).",retail=".$value['retail'].",upc=".str_replace(" ","",$value['upc']).",vendor=".str_replace(" ","",$value['vendor']).",pack=".str_replace(" ","",$value['pack']).",price0=".str_replace(" ","",$value['price0']).",price1=".str_replace(" ","",$value['price1']).",price2=".str_replace(" ","",$value['price2']).",price3=".str_replace(" ","",$value['price3']).",price4=".str_replace(" ","",$value['price4']).",price5=".str_replace(" ","",$value['price5']).",price6=".str_replace(" ","",$value['price6']).",ts_packaging_type=None".",size=".$value['shortdescr'],
					    'qty' => "0.00",
					    'out_of_stock_qty' => "0.00",
					    'use_config_min_qty' => "1.00",
					    'is_qty_decimal' => "0.00",
					    'allow_backorders' => "0.00",
					    'use_config_backorders' => "1.00",
					    'min_cart_qty' => "1.00",
					    'use_config_min_sale_qty' => "1.00",
					    'max_cart_qty' => "10000.00",
					    'use_config_max_sale_qty' => "1.00",
					    'is_in_stock' => "0.00",
					    'notify_on_stock_below' => "20.00",
					    'use_config_notify_stock_qty' => '0.00',
					    'manage_stock' => "1.00",
					    'use_config_manage_stock' => "1.00",
					    'use_config_qty_increments' => "1.00",
					    'qty_increments' => "1.00",
					    'use_config_enable_qty_inc' => "1.00",
					    'enable_qty_increments' => "0.00",
					    'is_decimal_divided' => "0.00",
					    'website_id' => "0.00",
					    'related_skus' => "",
					    'related_position' => "",
					    'crosssell_skus' => "",
					    'crosssell_position' => "",
					    'upsell_skus' => "",
					    'upsell_position' => "",
					    'additional_images' => $value['imagename'].'.jpg',
					    'additional_image_labels' => '',
					    'hide_from_product_page' => '',
					    'custom_options' => '',
					    'bundle_price_type' => '',
					    'bundle_sku_type' => '',
					    'bundle_price_view' => '',
					    'bundle_weight_type' => '',
					    'bundle_values' => '',
					    'bundle_shipment_type' => '',
					    'associated_skus' => '',
					    'downloadable_links' => '',
					    'downloadable_samples' => '',
					    'configurable_variations' => "",//"sku=999-00001,size=1 gal. Concentrate|sku=999-00002,size=2.5 gal. Concentrate|sku=999-00003,size=5 g"
					    'configurable_variation_labels' => ""
					);
				}else{
					$insert[] = array(
					    'sku' => $value['itemcode'],
					    'store_view_code' => '',
					    'attribute_set_code' => 'Products',
					    'product_type' => 'simple',
					    'categories' => $cat_name,
					    'product_websites' => 'base',
					    'name' => $value['name'],
					    'description' => $value['longdescr'],
					    'short_description' => $value['shortdescr'],
					    'weight' => $value['wt'],
					    'product_online' => '1.00',
					    'tax_class_name' => '0.00',
					    'visibility' => "Not Visible Individually",
					    'price' => $value['price0'],
					    'special_price' => '',
					    'special_price_from_date' => '',
					    'special_price_to_date' => '',
					    'url_key' => url_title(convert_accented_characters($value['name']), 'dash', TRUE),
					    'meta_title' => $value['name'],
					    'meta_keywords' => $value['name'],
					    'meta_description' => $value['name'],
					    'base_image' => $value['imagename'].'.jpg',
					    'base_image_label' => '',
					    'small_image' => $value['imagename'].'.jpg',
					    'small_image_label' => '',
					    'thumbnail_image' => $value['imagename'].'.jpg',
					    'thumbnail_image_label' => '',
					    'swatch_image' => $value['imagename'].'.jpg',
					    'swatch_image_label' => '',
					    'created_at' => date("d-m-yy H:i"),//2/12/20, 2:25 AM
					    'updated_at' => date("d-m-yy H:i"),
					    'new_from_date' => date("d-m-yy"),
					    'new_to_date' => date("d-m-yy"),
					    'display_product_options_in' => "Block after Info Column",
					    'map_price' => '',
					    'msrp_price' => '',
					    'map_enabled' => '',
					    'gift_message_available' => "No",
					    'custom_design' => '',
					    'custom_design_from' => '',
					    'custom_design_to' => '',
					    'custom_layout_update' => '', 
					    'page_layout' => '',
					    'product_options_container' => '',
					    'msrp_display_actual_price_type' => "Use config",
					    'country_of_manufacture' => "United States",
					    'additional_attributes' => "act10=".str_replace(" ","",$value['act10']).",act21=".str_replace(" ","",$value['act21']).",itemcode=".str_replace(" ","",$value['itemcode']).",model=".str_replace(" ","",$value['model']).",promo10=".str_replace(" ","",$value['promo10']).",promo21=".str_replace(" ","",$value['promo21']).",restrstates=".str_replace(" ","",$value['restrstates']).",retail=".$value['retail'].",upc=".str_replace(" ","",$value['upc']).",vendor=".str_replace(" ","",$value['vendor']).",pack=".str_replace(" ","",$value['pack']).",price0=".str_replace(" ","",$value['price0']).",price1=".str_replace(" ","",$value['price1']).",price2=".str_replace(" ","",$value['price2']).",price3=".str_replace(" ","",$value['price3']).",price4=".str_replace(" ","",$value['price4']).",price5=".str_replace(" ","",$value['price5']).",price6=".str_replace(" ","",$value['price6']).",ts_packaging_type=None".",size=".$value['shortdescr'],
					    'qty' => "0.00",
					    'out_of_stock_qty' => "0.00",
					    'use_config_min_qty' => "1.00",
					    'is_qty_decimal' => "0.00",
					    'allow_backorders' => "0.00",
					    'use_config_backorders' => "1.00",
					    'min_cart_qty' => "1.00",
					    'use_config_min_sale_qty' => "1.00",
					    'max_cart_qty' => "10000.00",
					    'use_config_max_sale_qty' => "1.00",
					    'is_in_stock' => "0.00",
					    'notify_on_stock_below' => "20.00",
					    'use_config_notify_stock_qty' => '0.00',
					    'manage_stock' => "1.00",
					    'use_config_manage_stock' => "1.00",
					    'use_config_qty_increments' => "1.00",
					    'qty_increments' => "1.00",
					    'use_config_enable_qty_inc' => "1.00",
					    'enable_qty_increments' => "0.00",
					    'is_decimal_divided' => "0.00",
					    'website_id' => "0.00",
					    'related_skus' => "",
					    'related_position' => "",
					    'crosssell_skus' => "",
					    'crosssell_position' => "",
					    'upsell_skus' => "",
					    'upsell_position' => "",
					    'additional_images' => $value['imagename'].'.jpg',
					    'additional_image_labels' => '',
					    'hide_from_product_page' => '',
					    'custom_options' => '',
					    'bundle_price_type' => '',
					    'bundle_sku_type' => '',
					    'bundle_price_view' => '',
					    'bundle_weight_type' => '',
					    'bundle_values' => '',
					    'bundle_shipment_type' => '',
					    'associated_skus' => '',
					    'downloadable_links' => '',
					    'downloadable_samples' => '',
					    'configurable_variations' => "",//"sku=999-00001,size=1 gal. Concentrate|sku=999-00002,size=2.5 gal. Concentrate|sku=999-00003,size=5 g"
					    'configurable_variation_labels' => ""
					);
				}
				//echo "<pre>";print_r($value);die;
			}
			//echo "<pre>";print_r($insert);die;
			if(isset($insert) && is_array($insert) && !empty($insert)){
				$insert[0]['configurable_variations'] = $sku_string;
				$this->db->insert_batch('products_new', $insert); 
			}
		}

		
	}


	public function test_product_simple()
	{

		// $this->db->select('*');
		// 	$this->db->from('products_new');
		// 	$query = $this->db->get();
		// echo "<pre>";print_r($query->row_array());die;

		$sql = 'SELECT name, COUNT(name) as countsno FROM products GROUP BY name HAVING COUNT(name) = 1 ORDER BY `countsno` ASC';
		$query = $this->db->query($sql);
		$namedatas = $query->result_array();
		//echo "<pre>";print_r($query->result_array());die;
		foreach ($namedatas as $namedata) {
			$this->db->select('*');
			$this->db->from('products');
			$this->db->where('name',$namedata['name']);
			$query = $this->db->get();
			//echo "<pre>";print_r($query->result_array());die;
			$i = 0;
			$insert = array();
			$productdatas = $query->result_array();
			$sku_string = '';
			foreach ($productdatas as $key => $value) { $i++;
				$value['itemcode'] = str_replace("'","",$value['itemcode']);
				$value['itemcode'] = str_replace('"','',$value['itemcode']);
				$value['itemcode'] = str_replace(',','',$value['itemcode']);
				$value['shortdescr'] = str_replace('"','in',$value['shortdescr']);
				$value['shortdescr'] = str_replace(',','',$value['shortdescr']);
				if(isset($value['act10']) && ($value['act10'] == 1)){
					$value['act10'] = 'Yes';
				}else if(isset($value['act10']) && ($value['act10'] == 2)){
					$value['act10'] = 'No';
				}else{
					$value['act10'] = 'No';
				}
				if(isset($value['act21']) && ($value['act21'] == 1)){
					$value['act21'] = 'Yes';
				}else if(isset($value['act21']) && ($value['act21'] == 2)){
					$value['act21'] = 'No';
				}else{
					$value['act21'] = 'No';
				}
				$this->db->select('*');
				$this->db->from('categories');
				$this->db->where('lid',$value['catagory']);
				$query = $this->db->get();
				if($query->num_rows() == 1)
				{
					$catdatas = $query->row_array();
					$cat_name = $catdatas['name'];
				}else{
					$cat_name = "";
				}
				if($i != 1)
				{
					//$sku_string .= '|';
				}
				//$sku_string .= "sku=".$value['itemcode'].",size=".$value['shortdescr'];
				$insert[] = array(
					    'sku' => $value['itemcode'],
					    'store_view_code' => '',
					    'attribute_set_code' => 'Products',
					    'product_type' => 'simple',
					    'categories' => $cat_name,
					    'product_websites' => 'base',
					    'name' => $value['name'],
					    'description' => $value['longdescr'],
					    'short_description' => $value['shortdescr'],
					    'weight' => $value['wt'],
					    'product_online' => '1.00',
					    'tax_class_name' => '0.00',
					    'visibility' => "Catalog, Search",
					    'price' => $value['price0'],
					    'special_price' => '',
					    'special_price_from_date' => '',
					    'special_price_to_date' => '',
					    'url_key' => url_title(convert_accented_characters($value['name']), 'dash', TRUE),
					    'meta_title' => $value['name'],
					    'meta_keywords' => $value['name'],
					    'meta_description' => $value['name'],
					    'base_image' => $value['imagename'].'.jpg',
					    'base_image_label' => '',
					    'small_image' => $value['imagename'].'.jpg',
					    'small_image_label' => '',
					    'thumbnail_image' => $value['imagename'].'.jpg',
					    'thumbnail_image_label' => '',
					    'swatch_image' => $value['imagename'].'.jpg',
					    'swatch_image_label' => '',
					    'created_at' => date("d-m-yy H:i"),//2/12/20, 2:25 AM
					    'updated_at' => date("d-m-yy H:i"),
					    'new_from_date' => date("d-m-yy"),
					    'new_to_date' => date("d-m-yy"),
					    'display_product_options_in' => "Block after Info Column",
					    'map_price' => '',
					    'msrp_price' => '',
					    'map_enabled' => '',
					    'gift_message_available' => "No",
					    'custom_design' => '',
					    'custom_design_from' => '',
					    'custom_design_to' => '',
					    'custom_layout_update' => '', 
					    'page_layout' => '',
					    'product_options_container' => '',
					    'msrp_display_actual_price_type' => "Use config",
					    'country_of_manufacture' => "United States",
					    'additional_attributes' => "act10=".str_replace(" ","",$value['act10']).",act21=".str_replace(" ","",$value['act21']).",itemcode=".str_replace(" ","",$value['itemcode']).",model=".str_replace(" ","",$value['model']).",promo10=".str_replace(" ","",$value['promo10']).",promo21=".str_replace(" ","",$value['promo21']).",restrstates=".str_replace(" ","",$value['restrstates']).",retail=".$value['retail'].",upc=".str_replace(" ","",$value['upc']).",vendor=".str_replace(" ","",$value['vendor']).",pack=".str_replace(" ","",$value['pack']).",price0=".str_replace(" ","",$value['price0']).",price1=".str_replace(" ","",$value['price1']).",price2=".str_replace(" ","",$value['price2']).",price3=".str_replace(" ","",$value['price3']).",price4=".str_replace(" ","",$value['price4']).",price5=".str_replace(" ","",$value['price5']).",price6=".str_replace(" ","",$value['price6']).",ts_packaging_type=None".",size=".$value['shortdescr'],
					    'qty' => "0.00",
					    'out_of_stock_qty' => "0.00",
					    'use_config_min_qty' => "1.00",
					    'is_qty_decimal' => "0.00",
					    'allow_backorders' => "0.00",
					    'use_config_backorders' => "1.00",
					    'min_cart_qty' => "1.00",
					    'use_config_min_sale_qty' => "1.00",
					    'max_cart_qty' => "10000.00",
					    'use_config_max_sale_qty' => "1.00",
					    'is_in_stock' => "0.00",
					    'notify_on_stock_below' => "20.00",
					    'use_config_notify_stock_qty' => '0.00',
					    'manage_stock' => "1.00",
					    'use_config_manage_stock' => "1.00",
					    'use_config_qty_increments' => "1.00",
					    'qty_increments' => "1.00",
					    'use_config_enable_qty_inc' => "1.00",
					    'enable_qty_increments' => "0.00",
					    'is_decimal_divided' => "0.00",
					    'website_id' => "0.00",
					    'related_skus' => "",
					    'related_position' => "",
					    'crosssell_skus' => "",
					    'crosssell_position' => "",
					    'upsell_skus' => "",
					    'upsell_position' => "",
					    'additional_images' => $value['imagename'].'.jpg',
					    'additional_image_labels' => '',
					    'hide_from_product_page' => '',
					    'custom_options' => '',
					    'bundle_price_type' => '',
					    'bundle_sku_type' => '',
					    'bundle_price_view' => '',
					    'bundle_weight_type' => '',
					    'bundle_values' => '',
					    'bundle_shipment_type' => '',
					    'associated_skus' => '',
					    'downloadable_links' => '',
					    'downloadable_samples' => '',
					    'configurable_variations' => "",//"sku=999-00001,size=1 gal. Concentrate|sku=999-00002,size=2.5 gal. Concentrate|sku=999-00003,size=5 g"
					    'configurable_variation_labels' => ""
					);
				//echo "<pre>";print_r($value);die;
			}
			//echo "<pre>";print_r($insert);die;
			if(isset($insert) && is_array($insert) && !empty($insert)){
				
				$this->db->insert_batch('products_new', $insert); 
			}
		}

		
	}

	public function generate_stock()
	{
		die;
		$this->db->select('*');
		$this->db->from('products');
		//$this->db->where('catagory <=',3);
		// $this->db->where('catagory >=',4);
		// $this->db->where('catagory <=',6);
		$query = $this->db->get();
		$i = 0;
		$insert = array();
		$productdatas = $query->result_array();
		$sku_string = '';
		foreach ($productdatas as $key => $value){ $i++;
			$value['itemcode'] = str_replace("'","",$value['itemcode']);
			$value['itemcode'] = str_replace('"','',$value['itemcode']);
			$value['itemcode'] = str_replace(',','',$value['itemcode']);
			$scode = 'CA';
			if(isset($value['act10']) && ($value['act10'] == 1))
			{
				$status = 1;
			}else{
				$status = 0;
			}
			$insert[] = array(
				'source_code' => $scode,
				'sku' => $value['itemcode'],
				'status' => $status,
				'quantity' => $value['qoh10']
				);
			$scode = 'WA';
			if(isset($value['act21']) && ($value['act21'] == 1))
			{
				$status = 1;
			}else{
				$status = 0;
			}
			$insert[] = array(
				'source_code' => $scode,
				'sku' => $value['itemcode'],
				'status' => $status,
				'quantity' => $value['qoh21']
				);

		}

		if(isset($insert) && is_array($insert) && !empty($insert)){
			$this->db->insert_batch('source_inventory', $insert); 
		}
	}

	public function test_user()
	{
		// $this->db->select('*');
		// $this->db->from('new_customer');
		// $query = $this->db->get();
		//echo '<pre>';print_r($query->row_array());die;


		$this->db->select('DISTINCT(users.email) as emailid');
		$this->db->from('users');
		$this->db->where('users.email !=','');
		//$this->db->join('customer','customer.custnum = users.custnum');
		//$this->db->limit(1);
		$query = $this->db->get();
		$emaildatas = $query->result_array();
		$insert = array();
		$duplicate_temp = 0;
		foreach ($emaildatas as $key => $emaildatas) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('customer','customer.custnum = users.custnum','left');
			$this->db->where('users.email',$emaildatas['emailid']);
			$query = $this->db->get();
			
			if($query->num_rows() == 1)
			{
				$userdata = $query->row_array();
				//echo '1111<pre>';print_r($userdata);die;
				//group_id 4 = pricelvl 0
				// group_id 5 = pricelvl 1
				// group_id 6 = pricelvl 2
				// group_id 7 = pricelvl 3
				// group_id 8 = pricelvl 4
				// group_id 9 = pricelvl 5
				// group_id 10 = pricelvl 6
				// group_id 11 = pricelvl 7

				if($userdata['pricelvl'] == 0){
					$userdata['pricelvl'] = 4;
				}else if($userdata['pricelvl'] == 1){
					$userdata['pricelvl'] = 5;
				}else if($userdata['pricelvl'] == 2){
					$userdata['pricelvl'] = 6;
				}else if($userdata['pricelvl'] == 3){
					$userdata['pricelvl'] = 7;
				}else if($userdata['pricelvl'] == 4){
					$userdata['pricelvl'] = 8;
				}else if($userdata['pricelvl'] == 5){
					$userdata['pricelvl'] = 9;
				}else if($userdata['pricelvl'] == 6){
					$userdata['pricelvl'] = 10;
				}else if($userdata['pricelvl'] == 7){
					$userdata['pricelvl'] = 11;
				}
				if (filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)) {

					if($userdata['fname'] == '')
					{
						$emailexplode = explode("@",$userdata['email']);
						$userdata['fname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
					}
					if($userdata['lname'] == '')
					{
						$emailexplode = explode("@",$userdata['email']);
						$userdata['lname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
					}
					
					$insert[] = array(
							    'email' => $userdata['email'],
							    '_website' => 'base',
							    '_store' => 'default',
							    'confirmation' => '',
							    'created_at' => date("Y-m-d H:i:s"),
							    'created_in' => "Default Store View",
							    'disable_auto_group_change' => '0',
							    'dob' => '',
							    'firstname' => $userdata['fname'],
							    'gender' => '',
							    'group_id' => $userdata['pricelvl'],
							    'lastname' => $userdata['lname'],
							    'middlename' => '',
							    'password_hash' => hash('sha256','6e5172cc1919f06de8b6b58b85dee786'.$userdata['password']).":6e5172cc1919f06de8b6b58b85dee786:1",
							    'prefix' => '',
							    'rp_token' => '',
							    'rp_token_created_at' => date("Y-m-d H:i:s"),
							    'store_id' => '1',
							    'suffix' => '',
							    'taxvat' => '',
							    'updated_at' => date("Y-m-d H:i:s"),
							    'website_id' => '1',
							    'password' => ''
							);
				}
				
			}else if($query->num_rows() > 1){
				$userdatas = $query->result_array();
				$duplicate_temp = 0;
				foreach ($userdatas as $key => $userdata) { $duplicate_temp++;

					if($userdata['pricelvl'] == 0){
						$userdata['pricelvl'] = 4;
					}else if($userdata['pricelvl'] == 1){
						$userdata['pricelvl'] = 5;
					}else if($userdata['pricelvl'] == 2){
						$userdata['pricelvl'] = 6;
					}else if($userdata['pricelvl'] == 3){
						$userdata['pricelvl'] = 7;
					}else if($userdata['pricelvl'] == 4){
						$userdata['pricelvl'] = 8;
					}else if($userdata['pricelvl'] == 5){
						$userdata['pricelvl'] = 9;
					}else if($userdata['pricelvl'] == 6){
						$userdata['pricelvl'] = 10;
					}else if($userdata['pricelvl'] == 7){
						$userdata['pricelvl'] = 11;
					}


					if (filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)) {

						if($userdata['fname'] == '')
						{
							$emailexplode = explode("@",$userdata['email']);
							$userdata['fname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
						}
						if($userdata['lname'] == '')
						{
							$emailexplode = explode("@",$userdata['email']);
							$userdata['lname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
						}

						$insert[] = array(
						    'email' => 'duplicate-'.$duplicate_temp.$userdata['email'],
						    '_website' => 'base',
						    '_store' => 'default',
						    'confirmation' => '',
						    'created_at' => date("Y-m-d H:i:s"),
						    'created_in' => "Default Store View",
						    'disable_auto_group_change' => '0',
						    'dob' => '',
						    'firstname' => $userdata['fname'],
						    'gender' => '',
						    'group_id' => $userdata['pricelvl'],
						    'lastname' => $userdata['lname'],
						    'middlename' => '',
						    'password_hash' => hash('sha256','6e5172cc1919f06de8b6b58b85dee786'.$userdata['password']).":6e5172cc1919f06de8b6b58b85dee786:1",
						    'prefix' => '',
						    'rp_token' => '',
						    'rp_token_created_at' => date("Y-m-d H:i:s"),
						    'store_id' => '1',
						    'suffix' => '',
						    'taxvat' => '',
						    'updated_at' => date("Y-m-d H:i:s"),
						    'website_id' => '1',
						    'password' => ''
						);
					}
				}
				//echo '222<pre>';print_r($userdata);die;
			}
		}
		if(isset($insert) && is_array($insert) && !empty($insert)){
			$this->db->insert_batch('new_customer', $insert); 
		}
	}

	public function test_user_without_email()
	{

		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('customer','customer.custnum = users.custnum','left');
		$this->db->where('users.email','');
		$query = $this->db->get();

		$userdatas = $query->result_array();
		$duplicate_temp = 0;
		foreach ($userdatas as $key => $userdata) { $duplicate_temp++;

			if($userdata['pricelvl'] == 0){
				$userdata['pricelvl'] = 4;
			}else if($userdata['pricelvl'] == 1){
				$userdata['pricelvl'] = 5;
			}else if($userdata['pricelvl'] == 2){
				$userdata['pricelvl'] = 6;
			}else if($userdata['pricelvl'] == 3){
				$userdata['pricelvl'] = 7;
			}else if($userdata['pricelvl'] == 4){
				$userdata['pricelvl'] = 8;
			}else if($userdata['pricelvl'] == 5){
				$userdata['pricelvl'] = 9;
			}else if($userdata['pricelvl'] == 6){
				$userdata['pricelvl'] = 10;
			}else if($userdata['pricelvl'] == 7){
				$userdata['pricelvl'] = 11;
			}
			if($userdata['fname'] != '')
			{
				$userdata['email'] = $userdata['fname'].'@nomail.com';
			}else{
				$userdata['email'] = 'abc@nomail.com';
			}
			$whilecount = 1;
			$counter = -1;
			while($whilecount != 0)
			{ $counter++;
				$this->db->select('*');
				$this->db->from('new_customer');
				$this->db->where('new_customer.email',$userdata['email']);
				$query = $this->db->get();
				$whilecount = $query->num_rows();
				if($whilecount != 0)
				{
					if($counter == 0)
					{
						$userdata['email'] = $userdata['fname'].$userdata['lname'].'@nomail.com';
					}else{
						$userdata['email'] = $userdata['fname'].$userdata['lname'].$counter.'@nomail.com';
					}
				}
			}

			if (filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)) {

				if($userdata['fname'] == '')
				{
					$emailexplode = explode("@",$userdata['email']);
					$userdata['fname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
				}
				if($userdata['lname'] == '')
				{
					$emailexplode = explode("@",$userdata['email']);
					$userdata['lname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
				}

				$insert = array(
				    'email' => $userdata['email'],
				    '_website' => 'base',
				    '_store' => 'default',
				    'confirmation' => '',
				    'created_at' => date("Y-m-d H:i:s"),
				    'created_in' => "Default Store View",
				    'disable_auto_group_change' => '0',
				    'dob' => '',
				    'firstname' => $userdata['fname'],
				    'gender' => '',
				    'group_id' => $userdata['pricelvl'],
				    'lastname' => $userdata['lname'],
				    'middlename' => '',
				    'password_hash' => hash('sha256','6e5172cc1919f06de8b6b58b85dee786'.$userdata['password']).":6e5172cc1919f06de8b6b58b85dee786:1",
				    'prefix' => '',
				    'rp_token' => '',
				    'rp_token_created_at' => date("Y-m-d H:i:s"),
				    'store_id' => '1',
				    'suffix' => '',
				    'taxvat' => '',
				    'updated_at' => date("Y-m-d H:i:s"),
				    'website_id' => '1',
				    'password' => ''
				);
				$this->db->insert('new_customer', $insert); 
			}
		}
		
		// if(isset($insert) && is_array($insert) && !empty($insert)){
			
		// }
	}

	public function test_user_address()
	{
		// $this->db->select('*');
		// $this->db->from('new_customer_address');
		// $query = $this->db->get();
		// echo '<pre>';print_r($query->row_array());die;


		$this->db->select('DISTINCT(users.email) as emailid');
		$this->db->from('users');
		$this->db->where('users.email !=','');
		$query = $this->db->get();
		$emaildatas = $query->result_array();
		$insert = array();
		$duplicate_temp = 0;
		foreach ($emaildatas as $key => $emaildatas) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('customer','customer.custnum = users.custnum','left');
			$this->db->where('users.email',$emaildatas['emailid']);
			$query = $this->db->get();
			
			if($query->num_rows() == 1)
			{
				$userdata = $query->row_array();
				
				if (filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)) {

					if($userdata['fname'] == '')
					{
						$emailexplode = explode("@",$userdata['email']);
						$userdata['fname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
					}
					if($userdata['lname'] == '')
					{
						$emailexplode = explode("@",$userdata['email']);
						$userdata['lname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
					}

					if($userdata['state'] != '')
					{
						$this->db->select('*');
						$this->db->from('a_location_master');
						$this->db->where('loc_scode',$userdata['state']);
						$query = $this->db->get();
						if($query->num_rows() >= 1)
						{
							$localtiondatas = $query->row_array();
							$region = $localtiondatas['loc_state'];
							$region_id = $localtiondatas['loc_m2scode'];
						}else{
							$region = '';
							$region_id = '';
						}
					}else{
						$region = '';
						$region_id = '';
					}

					if($region_id != '')
					{
						$insert[] = array(
						    '_website' => 'base',
						    '_email' => $userdata['email'],
						    '_entity_id' => '1',
						    'city' => 'New York',
						    'company' => $userdata['custname'],
						    'country_id' => 'US',
						    'fax' => '',
						    'firstname' => $userdata['fname'],
						    'lastname' => $userdata['lname'],
						    'middlename' => '',
						    'postcode' => $userdata['zip'],
						    'prefix' => '',
						    'region' => $region,
						    'region_id' => $region_id,
						    'street' => trim($userdata['addr1']).' '.trim($userdata['addr2']).' '.trim($userdata['addr3']),
						    'suffix' => '',
						    //'telephone' => '',
						    'vat_id' => '',
						    'vat_is_valid' => '',
						    'vat_request_date' => '',
						    'vat_request_id' => '',
						    'vat_request_success' => '',
						    '_address_default_billing_' => 1,
						    '_address_default_shipping_' => 1
						);
					}
				}
				
			}else if($query->num_rows() > 1){
				$userdatas = $query->result_array();
				$duplicate_temp = 0;
				foreach ($userdatas as $key => $userdata) { $duplicate_temp++;

					if (filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)) {

							if($userdata['fname'] == '')
							{
								$emailexplode = explode("@",$userdata['email']);
								$userdata['fname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
							}
							if($userdata['lname'] == '')
							{
								$emailexplode = explode("@",$userdata['email']);
								$userdata['lname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
							}

							if($userdata['state'] != '')
							{
								$this->db->select('*');
								$this->db->from('a_location_master');
								$this->db->where('loc_scode',$userdata['state']);
								$query = $this->db->get();
								if($query->num_rows() >= 1)
								{
									$localtiondatas = $query->row_array();
									$region = $localtiondatas['loc_state'];
									$region_id = $localtiondatas['loc_m2scode'];
								}else{
									$region = '';
									$region_id = '';
								}
							}else{
								$region = '';
								$region_id = '';
							}

							if($region_id != '')
							{
								$insert[] = array(
								    '_website' => 'base',
								    '_email' => 'duplicate-'.$duplicate_temp.$userdata['email'],
								    '_entity_id' => '1',
								    'city' => $userdata['city'],
								    'company' => $userdata['custname'],
								    'country_id' => 'US',
								    'fax' => '',
								    'firstname' => $userdata['fname'],
								    'lastname' => $userdata['lname'],
								    'middlename' => '',
								    'postcode' => $userdata['zip'],
								    'prefix' => '',
								    'region' => $region,
								    'region_id' => $region_id,
								    'street' => trim($userdata['addr1']).' '.trim($userdata['addr2']).' '.trim($userdata['addr3']),
								    'suffix' => '',
								    //'telephone' => '',
								    'vat_id' => '',
								    'vat_is_valid' => '',
								    'vat_request_date' => '',
								    'vat_request_id' => '',
								    'vat_request_success' => '',
								    '_address_default_billing_' => 1,
								    '_address_default_shipping_' => 1
								);
							}
							
					}
				}
			}
		}
		if(isset($insert) && is_array($insert) && !empty($insert)){
			$this->db->insert_batch('new_customer_address', $insert); 
		}
	}

	public function test_user_address_without_email()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('customer','customer.custnum = users.custnum','left');
		$this->db->where('users.email','');
		$query = $this->db->get();

		$userdatas = $query->result_array();
		$duplicate_temp = 0;
		foreach ($userdatas as $key => $userdata) { $duplicate_temp++;

			
			if($userdata['fname'] != '')
			{
				$userdata['email'] = $userdata['fname'].'@nomail.com';
			}else{
				$userdata['email'] = 'abc@nomail.com';
			}
			$whilecount = 1;
			$counter = -1;
			while($whilecount != 0)
			{ $counter++;
				$this->db->select('*');
				$this->db->from('new_customer_address');
				$this->db->where('new_customer_address._email',$userdata['email']);
				$query = $this->db->get();
				$whilecount = $query->num_rows();
				if($whilecount != 0)
				{
					if($counter == 0)
					{
						$userdata['email'] = $userdata['fname'].$userdata['lname'].'@nomail.com';
					}else{
						$userdata['email'] = $userdata['fname'].$userdata['lname'].$counter.'@nomail.com';
					}
				}
			}

			if (filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)) {

				if($userdata['fname'] == '')
				{
					$emailexplode = explode("@",$userdata['email']);
					$userdata['fname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
				}
				if($userdata['lname'] == '')
				{
					$emailexplode = explode("@",$userdata['email']);
					$userdata['lname'] = isset($emailexplode[0]) ? $emailexplode[0] : 0;
				}

				if($userdata['state'] != '')
				{
					$this->db->select('*');
					$this->db->from('a_location_master');
					$this->db->where('loc_scode',$userdata['state']);
					$query = $this->db->get();
					if($query->num_rows() >= 1)
					{
						$localtiondatas = $query->row_array();
						$region = $localtiondatas['loc_state'];
						$region_id = $localtiondatas['loc_m2scode'];
					}else{
						$region = '';
						$region_id = '';
					}
				}else{
					$region = '';
					$region_id = '';
				}

				if($region_id != '')
				{
					$insert = array(
					    '_website' => 'base',
					    '_email' => $userdata['email'],
					    '_entity_id' => '1',
					    'city' => $userdata['city'],
					    'company' => $userdata['custname'],
					    'country_id' => 'US',
					    'fax' => '',
					    'firstname' => $userdata['fname'],
					    'lastname' => $userdata['lname'],
					    'middlename' => '',
					    'postcode' => $userdata['zip'],
					    'prefix' => '',
					    'region' => $region,
					    'region_id' => $region_id,
					    'street' => trim($userdata['addr1']).' '.trim($userdata['addr2']).' '.trim($userdata['addr3']),
					    'suffix' => '',
					    //'telephone' => '',
					    'vat_id' => '',
					    'vat_is_valid' => '',
					    'vat_request_date' => '',
					    'vat_request_id' => '',
					    'vat_request_success' => '',
					    '_address_default_billing_' => 1,
					    '_address_default_shipping_' => 1
					);
					$this->db->insert('new_customer_address', $insert); 
				}
			}
		}
	}
	
}
?>