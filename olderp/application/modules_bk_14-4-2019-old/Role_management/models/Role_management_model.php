<?php 

class Role_management_model extends CI_Model {
	
	public function add($data)
	{

		$value['rght'] = array(
			'rights_name' => $data['rolename'],
			'rights_adid' => $data['rights_adid'],
			'rights_atype' => $data['rights_atype'],
			'rights_ip' => $this->input->ip_address(),
			'rights_cdate' => $data['rights_cdate'],
			'rights_udate' => $data['rights_udate']
			);
		$this->db->insert('tbl_rights',$value['rght']);
		$right_lid = $this->db->insert_id();
	//------------------------------------------------- Rights End	
		if(isset($data['products']) && $data['products'] != '')
		{
			foreach($data['products'] as $product)
			{
			$value['rght_prd'] = array(
				'rightsp_rights_id' => $right_lid,
				'rightsp_proid' => $product,
				'rightsp_adid' => $data['rights_adid'],
				'rightsp_atype' => $data['rights_atype'],
				'rightsp_ip' => $this->input->ip_address(),
				'rightsp_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_rights_products',$value['rght_prd']);
			}
		}
		
	//-------------------------------------------------	Rights Prod End
		if(isset($data['types']) && $data['types'] != '')
		{
			foreach($data['types'] as $ptyp)
			{
			$value['rght_typ'] = array(
				'rightst_rights_id' => $right_lid,
				'rightst_typeid' => $ptyp,
				'rightst_adid' => $data['rights_adid'],
				'rightst_atype' => $data['rights_atype'],
				'rightst_ip' => $this->input->ip_address(),
				'rightst_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_rights_type',$value['rght_typ']);
			}
		}
		
	//-------------------------------------------------	Rights Type End
		if(isset($data['category']) && $data['category'] != '')
		{
			foreach($data['category'] as $pcat)
			{
			$value['rght_cat'] = array(
				'rightsc_rights_id' => $right_lid,
				'rightsc_catid' => $pcat,
				'rightsc_adid' => $data['rights_adid'],
				'rightsc_atype' => $data['rights_atype'],
				'rightsc_ip' => $this->input->ip_address(),
				'rightsc_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_rights_category',$value['rght_cat']);
			}	
		}
		
	//-------------------------------------------------	Rights Category End
		if(isset($data['rights']) && $data['rights'] != '')
		{
			foreach($data['rights'] as $rgtkey => $right)
			{
				if(isset($right['add']) && $right['add'] != ''){
					$add = $right['add'];
				}else{
					$add = '0';
				}

				if(isset($right['edit']) && $right['edit'] != ''){
					$edit = $right['edit'];
				}else{
					$edit = '0';
				}

				if(isset($right['view']) && $right['view'] != ''){
					$view = $right['view'];
				}else{
					$view = '0';
				}

				if(isset($right['delete']) && $right['delete'] != ''){
					$delete = $right['delete'];
				}else{
					$delete = '0';
				}

				if(isset($right['print']) && $right['print'] != ''){
					$print = $right['print'];
				}else{
					$print = '0';
				}

				if(isset($right['download']) && $right['download'] != ''){
					$download = $right['download'];
				}else{
					$download = '0';
				}

				if(isset($right['mail']) && $right['mail'] != ''){
					$mail = $right['mail'];
				}else{
					$mail = '0';
				}

					$value['rights'] = array(
					'rightsdt_rights_id' => $right_lid,
					'rightsdt_module_id'=>$rgtkey,
					'rightsdt_add'=>$add,
					'rightsdt_edit'=>$edit,
					'rightsdt_view'=>$view,
					'rightsdt_delete'=>$delete,
					'rightsdt_print'=>$print,
					'rightsdt_download'=>$download,
					'rightsdt_mail'=>$mail,
					'rightsdt_adid' => $data['rights_adid'],
					'rightsdt_atype' => $data['rights_atype'],
					'rightsdt_ip' => $this->input->ip_address(),
					'rightsdt_udate' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($value['rights']);
					$this->db->insert('tbl_rights_details',$value['rights']);
			}

		}
	//-------------------------------------------------	Rights Detail End
		return $right_lid;
	}

	public function edit($data,$id)
	{ 
		$value['rght'] = array(
			'rights_name' => $data['rolename'],
			'rights_adid' => $data['rights_adid'],
			'rights_atype' => $data['rights_atype'],
			'rights_ip' => $this->input->ip_address(),
			'rights_udate' => $data['rights_udate']
			);
		$this->db->where('rights_id', $id);
		$this->db->update('tbl_rights', $value['rght']);

		//$this->db->where('rightsp_rights_id', $id);
		//$this->db->delete('tbl_rights_products'); 
	/*	if(isset($data['products']) && $data['products'] != '')
		{
			foreach($data['products'] as $pkey => $product)
			{
			$value['products'] = array(
			'rightsp_proid' => $product,
			'rightsp_rights_id' => $id,
			'rightsp_adid' => $data['rights_adid'],
			'rightsp_atype' => $data['rights_atype'],
			'rightsp_ip' => $this->input->ip_address(),
			'rightsp_udate' => $data['rights_udate']
			);
			$this->db->insert('tbl_rights_products', $value['products']);
			}
		}*/

		//$this->db->where('rightst_rights_id', $id);
		//$this->db->delete('tbl_rights_type'); 
		/*if(isset($data['types']) && $data['types'] != '')
		{
			foreach($data['types'] as $tkey => $ptyp)
			{
			$value['types'] = array(
			'rightst_typeid' => $ptyp,
			'rightst_rights_id' => $id,
			'rightst_adid' => $data['rights_adid'],
			'rightst_atype' => $data['rights_atype'],
			'rightst_ip' => $this->input->ip_address(),
			'rightst_udate' => $data['rights_udate']
			);
			$this->db->insert('tbl_rights_type', $value['types']);
			}
			
		}*/

		//$this->db->where('rightsc_rights_id', $id);
		//$this->db->delete('tbl_rights_category'); 
		/*if(isset($data['category']) && $data['category'] != '')
		{
			foreach($data['category'] as $ckey => $pcat)
			{
			$value['cate'] = array(
			'rightsc_catid' => $pcat,
			'rightsc_rights_id' => $id,
			'rightsc_adid' => $data['rights_adid'],
			'rightsc_atype' => $data['rights_atype'],
			'rightsc_ip' => $this->input->ip_address(),
			'rightsc_udate' => $data['rights_udate']
			);
			$this->db->insert('tbl_rights_category', $value['cate']);
			}
			
		}*/

		$this->db->where('rightsdt_rights_id', $id);
		$this->db->delete('tbl_rights_details'); 

		if(isset($data['rights']) && $data['rights'] != ''){
		foreach($data['rights'] as $rgtkey => $right){

				if(isset($right['add']) && $right['add'] != ''){
					$add = $right['add'];
				}else{
					$add = '0';
				}

				if(isset($right['edit']) && $right['edit'] != ''){
					$edit = $right['edit'];
				}else{
					$edit = '0';
				}

				if(isset($right['delete']) && $right['delete'] != ''){
					$delete = $right['delete'];
				}else{
					$delete = '0';
				}

				if(isset($right['view']) && $right['view'] != ''){
					$view = $right['view'];
				}else{
					$view = '0';
				}

				if(isset($right['print']) && $right['print'] != ''){
					$print = $right['print'];
				}else{
					$print = '0';
				}

				if(isset($right['download']) && $right['download'] != ''){
					$download = $right['download'];
				}else{
					$download = '0';
				}

				if(isset($right['mail']) && $right['mail'] != ''){
					$mail = $right['mail'];
				}else{
					$mail = '0';
				}

			$value['rght_details'] = array(
			'rightsdt_rights_id' => $id,
			'rightsdt_module_id' => $rgtkey,
			'rightsdt_add' => $add,
			'rightsdt_edit' => $edit,
			'rightsdt_view' => $view,
			'rightsdt_delete' => $delete,
			'rightsdt_print' => $print,
			'rightsdt_download' => $download,
			'rightsdt_mail' => $mail,
			'rightsdt_adid' => $data['rights_adid'],
			'rightsdt_atype' => $data['rights_atype'],
			'rightsdt_ip' => $this->input->ip_address(),
			'rightsdt_udate' => $data['rights_udate']
			);
		//echo "<pre>"; print_r($item); die;
		$this->db->insert('tbl_rights_details', $value['rght_details']);
		}
	}
		
		return $id;	
	}

	public function get_module($id = false)
	{
		$this->db->select('*');
		$this->db->from('tbl_module');
		$this->db->order_by('module_order', 'asc');
		$query = $this->db->get();
		$value['modules'] = $query->result_array();

		if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && ($id != false))
		{
			foreach ($value['modules'] as $mkey => $module) {
				$this->db->select('*');
				$this->db->from('tbl_rights_details');
				$this->db->where('rightsdt_rights_id', $id);
				$this->db->where('rightsdt_module_id', $module['module_id']);
				$query = $this->db->get();
				$value['modules'][$mkey]['edit_rights'] = $query->row_array();
			}
		}

		/*$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['prod'] = $query->result_array();*/

		/*$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->where('procat_is_delete', '0');
		$query = $this->db->get();
		$value['prod_cat'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['prod_typ'] = $query->result_array();*/
		//echo '<pre>';print_r($value['modules']);die;
		return $value;
	}

	public function get_all_right()
	{
		$this->db->select('*');
		$this->db->from('tbl_rights');
		$this->db->where('rights_is_delete', '0');
		$this->db->order_by('rights_id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_right($id)
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_rights');
		$this->db->where('rights_is_delete', '0');
		$this->db->where('rights_id', $id);
		$this->db->order_by('rights_id', 'desc');
		$query = $this->db->get();
		$value['rght'] = $query->result_array();
	//-----------------------------------------
		/*$this->db->select('*');
		$this->db->from('tbl_rights_category');
		$this->db->where('rightsc_rights_id', $id);
		$query = $this->db->get();
		$value['rght_cat'] = $query->result_array();*/
	//-----------------------------------------	
		/*$this->db->select('*');
		$this->db->from('tbl_rights_products');
		$this->db->where('rightsp_rights_id', $id);
		$query = $this->db->get();
		$value['rght_pro'] = $query->result_array();*/
	//-----------------------------------------	
		/*$this->db->select('*');
		$this->db->from('tbl_rights_type');
		$this->db->where('rightst_rights_id', $id);
		$query = $this->db->get();
		$value['rght_typ'] = $query->result_array();*/
	//-----------------------------------------	
		$this->db->select('*');
		$this->db->from('tbl_rights_details');
		$this->db->where('rightsdt_rights_id', $id);
		$query = $this->db->get();
		$value['rght_det'] = $query->result_array();	
		return $value;
	}

	public function delete($id)
	{
		$this->db->set('rights_is_delete', '1');
		$this->db->where('rights_id', $id);
		$this->db->update('tbl_rights');
	}

}
?>