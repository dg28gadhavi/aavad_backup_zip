<?php 

class Product_generator_model extends CI_Model {
	
	public function add($data)
	{
		$response = array();
		$response['msg'] = '';
		$response['status'] = false;
		$this->db->select('*');
		$this->db->from('tbl_master_item');
		$this->db->where('master_item_part_no',$data['final_code']);
		$query = $this->db->get();
		if($query->num_rows() == 0)
		{
			$this->db->select('*');
			$this->db->from('tbl_product_generator');
			$this->db->where('pg_final_code',$data['final_code']);
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				$response['msg'] = 'Success';
				$response['status'] = true;
				$item_name = '';
				$item_model = '';
				$system_final_code = '';
				$this->db->select('ph_name,ph_id');
				$this->db->from('tbl_product_heads');
				$this->db->where('ph_id',$data['product_head']);
				$query = $this->db->get();
				if($query->num_rows() == 1)
				{
					$pheadname = $query->row_array();
					$item_name .= $pheadname['ph_name'];
					$system_final_code .= str_pad( $pheadname['ph_id'], 2, "0", STR_PAD_LEFT );
				}

				$this->db->select('cat_name,cat_id');
				$this->db->from('tbl_category_master');
				$this->db->where('cat_id',$data['product_category']);
				$query = $this->db->get();
				if($query->num_rows() == 1)
				{
					$catname = $query->row_array();
					$item_name .= ' - '.$catname['cat_name'].' ';
					$system_final_code .= str_pad( $catname['cat_id'], 2, "0", STR_PAD_LEFT );
				}

				$insert = array(
					'pg_ph_id' => $data['product_head'],
					'pg_ph_code' => $data['product_code'],
					'pg_cat_id' => $data['product_category'],
					'pg_cat_code' => $data['category_code'],
					'pg_final_code' => $data['final_code'],
					'pg_specification' => $data['pg_specification'],
					'pg_udate' => date("Y-m-d H:i:s")
					);
				$this->db->insert('tbl_product_generator',$insert);
				$pg_id = $this->db->insert_id();
				if(isset($data['attri_product_head']) && is_array($data['attri_product_head']) && !empty($data['attri_product_head']))
				{
					$ame_id = 0;
					$result['code'] = 0;
					$result['count'] = 0;
					$j = 0;
					foreach ($data['attri_product_head'] as $headkey => $headvalue) { $j++;
						


						// ******** Attribute Master Entries *******************
						$this->db->select('ame_id,ame_code as attribute_code,ame_count as attribute_count,attrib_digit as digitno');
						$this->db->from('tbl_attribute_master_entries');
						$this->db->join('tbl_attribute_master','tbl_attribute_master.attrib_id = tbl_attribute_master_entries.ame_attrib_id');
						$this->db->where('ame_attrib_id',$data['product_attri_id'][$headkey]);
						$this->db->where('ame_values',$data['product_value'][$headkey]);
						$this->db->order_by('ame_id','DESC');
						$query = $this->db->get();
						if($query->num_rows() == 1)
						{
							$attri_entries = $query->row_array();
							$ame_id = $attri_entries['ame_id'];
							$result['code'] = $attri_entries['attribute_code'];
							$result['count'] = $attri_entries['attribute_count'];
						}else if($query->num_rows() == 0)
						{
							$this->db->select('ame_code as attribute_code,ame_count as attribute_count,attrib_digit as digitno');
							$this->db->from('tbl_attribute_master_entries');
							$this->db->join('tbl_attribute_master','tbl_attribute_master.attrib_id = tbl_attribute_master_entries.ame_attrib_id');
							$this->db->where('ame_attrib_id',$data['product_attri_id'][$headkey]);
							$this->db->order_by('ame_id','DESC');
							$query = $this->db->get();
							if($query->num_rows() > 0)
							{
								$attri_entries = $query->row_array();
								//echo '<pre>';print_r($attri_entries);die;
								$attri_entries['attribute_count'] = $attri_entries['attribute_count'] + 1;
								$result['code'] = str_pad( $attri_entries['attribute_count'], $attri_entries['digitno'], "0", STR_PAD_LEFT );;
								$result['count'] = $attri_entries['attribute_count'];

								$insert = array(
									'ame_attrib_id' => $data['product_attri_id'][$headkey],
									'ame_values' => $data['product_value'][$headkey],
									'ame_code' => $result['code'],
									'ame_count' => $result['count'],
									'ame_udate' => date("Y-m-d H:i:s")
									);
								$this->db->insert('tbl_attribute_master_entries',$insert);
								$ame_id = $this->db->insert_id();
							}else{

								$this->db->select('attrib_digit as digitno');
								$this->db->from('tbl_attribute_master');
								$this->db->where('attrib_id',$data['product_attri_id'][$headkey]);
								$this->db->order_by('attrib_id','DESC');
								$query = $this->db->get();
								if($query->num_rows() == 1)
								{
									$attri_entries = $query->row_array();
									$attri_entries['attribute_count'] = 1;
									$result['code'] = str_pad( $attri_entries['attribute_count'], $attri_entries['digitno'], "0", STR_PAD_LEFT );;
									$result['count'] = $attri_entries['attribute_count'];

									$insert = array(
										'ame_attrib_id' => $data['product_attri_id'][$headkey],
										'ame_values' => $data['product_value'][$headkey],
										'ame_code' => $result['code'],
										'ame_count' => $result['count'],
										'ame_udate' => date("Y-m-d H:i:s")
										);
									$this->db->insert('tbl_attribute_master_entries',$insert);
									$ame_id = $this->db->insert_id();

								}
							}
						}
						// ******** Attribute Master Entries *******************
						// ******** Product Generator Values Entries ***************
						if($j <= 7)
						{
							if($j == 1)
							{
								$item_name .= '| ';
							}else{
								$item_name .= ',';
							}
							$item_name .= ''.$data['attri_product_head'][$headkey].' : '.$data['product_value'][$headkey];
						}
						if($data['attri_product_head'][$headkey] == 'Model'){
							$item_model = $data['product_value'][$headkey];
						}
						if($data['attri_product_head'][$headkey] == 'MAKE'){
							$item_make = $data['product_value'][$headkey];
						}
						$insert = array(
							'pgv_pg_id' => $pg_id,
							'pgv_attrib_id' => $data['product_attri_id'][$headkey],
							'pgv_attrib_ref_id' => $data['product_attri_ref_id'][$headkey],
							'pgv_attrib_name' => $data['attri_product_head'][$headkey],
							'pgv_attrib_value' => $data['product_value'][$headkey],
							'pgv_ame_id' => $ame_id,
							'pgv_ame_code' => $result['code'],
							'pgv_udate' => date("Y-m-d H:i:s")
							);
						$this->db->insert('tbl_product_generator_values',$insert);
						// ******** Product Generator Values Entries ***************
					}

					$item = array(
						'master_item_pg_id' => $pg_id,
						'master_item_name' => $item_name,
						'master_item_modal_code' => $item_model,
						'master_item_description' => $item_name,
						'master_item_ldescription' => $item_name,
						'master_item_make' => 0,
						'master_item_make_name' => isset($item_make) ? $item_make : '',
						'master_item_part_no' => $data['final_code'],
						'master_item_rate' => 0,
						'master_item_unit' => 3,
						//'master_item_hsncode' => $data['master_item_hsn'],
						'master_item_tax' => 18,
						//'master_item_limit' => $data['master_item_limit'],
						'master_item_created_date' => date("Y-m-d H:i:s"),
						'master_item_updated_date' => date("Y-m-d H:i:s")
						);
						//echo "<pre>";print_r($item);die;
					$this->db->insert('tbl_master_item',$item);

				}else{
					$response['msg'] = 'Pl. check heads first.';
					$response['status'] = false;
				}
			}else{
				$response['msg'] = 'Item Part Code Already Exist in Product Generator';
				$response['status'] = false;
			}
		}else{
			$response['msg'] = 'Item Part Code Already Exist in Item Master';
			$response['status'] = false;
		}
		return $response;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'ph_name' => $data['Product_generator_name'],
			'ph_udate' => date("Y-m-d")
			);
		$this->db->where('ph_id', $id);
		$this->db->update('tbl_Product_generator', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_generator');
		$this->db->where('pg_id',$id);
		//$this->db->where('Product_generator_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_Product_generator()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_generator');
		$this->db->join('tbl_product_heads','tbl_product_heads.ph_id = tbl_product_generator.pg_ph_id');
		$this->db->join('tbl_category_master','tbl_category_master.cat_phid = tbl_product_generator.pg_cat_id');
		//$this->db->where('Product_generator_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('ph_name') && ($this->input->post('ph_name') != ''))
        {
           $this->db->like('ph_name', $this->input->post('ph_name'));   
        }
        if($this->input->post('pg_ph_code') && ($this->input->post('pg_ph_code') != ''))
        {
           $this->db->like('pg_ph_code', $this->input->post('pg_ph_code'));   
        }
        if($this->input->post('cat_name') && ($this->input->post('cat_name') != ''))
        {
           $this->db->like('cat_name', $this->input->post('cat_name'));   
        }
        if($this->input->post('pg_cat_code') && ($this->input->post('pg_cat_code') != ''))
        {
           $this->db->like('pg_cat_code', $this->input->post('pg_cat_code'));   
        }
        if($this->input->post('pg_final_code') && ($this->input->post('pg_final_code') != ''))
        {
           $this->db->like('pg_final_code', $this->input->post('pg_final_code'));   
        }
        if($this->input->post('pg_udate') && ($this->input->post('pg_udate') != ''))
        {
           $this->db->like('pg_udate', $this->input->post('pg_udate'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		//$this->db->set('master_item_unit_isdelete', 1);
		$this->db->where('ph_id', $id);
		$this->db->delete('tbl_Product_generator');
		return $id;
	}

	public function get_masters()
	{
		$value = array();

		$this->db->select('*');
		$this->db->from('tbl_product_heads');
		$query = $this->db->get();
		$value['product_heads'] = $query->result_array();

		return $value;
	}

	public function product_to_other_details($data)
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_product_heads');
		$this->db->where('ph_id',$data['id']);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$pdatas = $query->row_array();
			$result['product_code'] = str_pad( $pdatas['ph_id'], 3, "0", STR_PAD_LEFT );

			$this->db->select('*');
			$this->db->from('tbl_category_master');
			$this->db->where('cat_phid',$data['id']);
			$query = $this->db->get();
			$result['category_lists'] = $query->result_array();

			$this->db->select('attrib_id as attributed_id,attrib_name as attrobute_name,amv_id as attribute_ref_id,attrib_place as placement_id');
			$this->db->from('tbl_attribute_master_values');
			$this->db->join('tbl_attribute_master','tbl_attribute_master.attrib_id = tbl_attribute_master_values.amv_attrib_id');
			$this->db->where('amv_ph_id',$data['id']);
			$this->db->order_by('attrib_place','ASC');
			$query = $this->db->get();
			$result['attribute_lists'] = $query->result_array();

		}
		return $result;
	}

	public function attribute_to_code($data)
	{
		$result = array();
		$this->db->select('ame_code as attribute_code,ame_count as attribute_count,attrib_digit as digitno');
		$this->db->from('tbl_attribute_master_entries');
		$this->db->join('tbl_attribute_master','tbl_attribute_master.attrib_id = tbl_attribute_master_entries.ame_attrib_id');
		$this->db->where('ame_attrib_id',$data['attribute_id']);
		$this->db->where('ame_values',$data['attribute_value']);
		$this->db->order_by('ame_id','DESC');
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$attri_entries = $query->row_array();
			$result['code'] = $attri_entries['attribute_code'];
			$result['count'] = $attri_entries['attribute_count'];
		}else if($query->num_rows() == 0)
		{
			$this->db->select('ame_code as attribute_code,ame_count as attribute_count,attrib_digit as digitno');
			$this->db->from('tbl_attribute_master_entries');
			$this->db->join('tbl_attribute_master','tbl_attribute_master.attrib_id = tbl_attribute_master_entries.ame_attrib_id');
			$this->db->where('ame_attrib_id',$data['attribute_id']);
			$this->db->order_by('ame_id','DESC');
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$attri_entries = $query->row_array();
				//echo '<pre>';print_r($attri_entries);die;
				$attri_entries['attribute_count'] = $attri_entries['attribute_count'] + 1;
				$result['code'] = str_pad( $attri_entries['attribute_count'], $attri_entries['digitno'], "0", STR_PAD_LEFT );;
				$result['count'] = $attri_entries['attribute_count'];
			}else{

				$this->db->select('attrib_digit as digitno');
				$this->db->from('tbl_attribute_master');
				$this->db->where('attrib_id',$data['attribute_id']);
				$this->db->order_by('attrib_id','DESC');
				$query = $this->db->get();
				if($query->num_rows() == 1)
				{
					$attri_entries = $query->row_array();
					$attri_entries['attribute_count'] = 1;
					$result['code'] = str_pad( $attri_entries['attribute_count'], $attri_entries['digitno'], "0", STR_PAD_LEFT );;
					$result['count'] = $attri_entries['attribute_count'];
				}else{
					$result['code'] = '01';
					$result['count'] = 1;
				}
			}
		}else{
			$result['code'] = '01';
			$result['count'] = 1;
		}
		return $result;
	}

	public function search_attribute_value($attribute_value,$q)
	{
		$sql = "SELECT ame_values from tbl_attribute_master_entries WHERE UPPER(ame_values) LIKE '%".$this->db->escape_like_str(strtoupper($q))."%' AND ame_attrib_id = ".$attribute_value;
		$query = $this->db->query($sql);
		//echo "<pre>"; print_r($query->result_array()); die;
		//$query = $this->db->get('tbl_master_item');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$new_row['label']=htmlentities(stripslashes($row['ame_values']));
				$new_row['value']=htmlentities(stripslashes($row['ame_values']));
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		}
		else
		{
			$row_set = array();
			echo json_encode($row_set);
		}
	}
	
}
?>