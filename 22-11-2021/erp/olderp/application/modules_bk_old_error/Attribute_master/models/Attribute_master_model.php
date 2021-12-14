<?php 

class Attribute_master_model extends CI_Model {
	
	public function add($data)
	{
		//echo '<pre>'; print_r($data);die;
		if(isset($data['attrib_ph_id']) && is_array($data['attrib_ph_id']) && !empty($data['attrib_ph_id'])){

			$item = array(
				'attrib_name' => $data['attrib_name'],
				'attrib_ph_id' => json_encode($data['attrib_ph_id']),

				'attrib_place' => ($data['attrib_place']),
				'attrib_digit' => ($data['attrib_digit']),
				'attrib_order' => ($data['attrib_order']),
				'attrib_in_partcode' => '0',

				'attrib_cdate' => $data['Attribute_master_cdate'],
				'attrib_udate' => $data['Attribute_master_udate']
				);
				//echo '<pre>'; print_r($item);die;
			$this->db->insert('tbl_attribute_master',$item);
			$lid = $this->db->insert_id();

			foreach ($data['attrib_ph_id'] as $key => $value) {
				$insert = array(
					'amv_attrib_id' => $lid,
					'amv_ph_id' => $value
					);
				$this->db->insert('tbl_attribute_master_values',$insert);
			}
			
		}
		return $lid;
	}
	
	public function edit($data,$id)
	{ 

		if(isset($data['attrib_ph_id']) && is_array($data['attrib_ph_id']) && !empty($data['attrib_ph_id'])){

			$item = array(
				'attrib_name' => $data['attrib_name'],
				'attrib_ph_id' => json_encode($data['attrib_ph_id']),
				'attrib_place' => ($data['attrib_place']),
				'attrib_digit' => ($data['attrib_digit']),
				'attrib_order' => ($data['attrib_order']),
				//'attrib_in_partcode' => '0',
				'attrib_udate' => date("Y-m-d")
				);
			//echo $id."dddddddd<pre>";print_r($item);die;
			$this->db->where('attrib_id', $id);
			$this->db->update('tbl_attribute_master', $item); 
			$lid = $id;

			$this->db->delete('tbl_attribute_master_values',array('amv_attrib_id' => $lid));

			foreach ($data['attrib_ph_id'] as $key => $value) {
				$insert = array(
					'amv_attrib_id' => $lid,
					'amv_ph_id' => $value
					);
				$this->db->insert('tbl_attribute_master_values',$insert);
			}
			
		}

		
		return $lid;	
	}

	public function get_plist()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_heads');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_attribute_master');
		$this->db->where('attrib_id',$id);
		//$this->db->where('Attribute_master_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		$result = $query->result_array();

		$this->db->select('amv_ph_id');
		$this->db->from('tbl_attribute_master_values');
		$this->db->where('amv_attrib_id',$id);
		//$this->db->where('Attribute_master_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result[0]['product_heads_lists'] = array_column($query->result_array(), "amv_ph_id");
		}else{
			$result[0]['product_heads_lists'] = array();
		}

		return $result;
	}

	public function get_Attribute_master()
	{
		$this->db->select('tbl_attribute_master.*,(SELECT GROUP_CONCAT(tbl_product_heads.ph_name) FROM tbl_product_heads JOIN tbl_attribute_master_values ON tbl_attribute_master_values.amv_ph_id = tbl_product_heads.ph_id WHERE tbl_attribute_master_values.amv_attrib_id = tbl_attribute_master.attrib_id) AS product_heads_values');
		$this->db->from('tbl_attribute_master');
		//$this->db->join('tbl_attribute_master_values','tbl_attribute_master_values.amv_attrib_id = tbl_attribute_master.attrib_id');
		//$this->db->join('tbl_product_heads','tbl_product_heads.ph_id = tbl_attribute_master_values.amv_ph_id');
		//$this->db->where('Attribute_master_cid',$this->session->userdata['login']['aus_Id']);
		if($this->input->post('attrib_name') && ($this->input->post('attrib_name') != ''))
        {
           $this->db->like('attrib_name', $this->input->post('attrib_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function delete($id)
	{
		$this->db->where('attrib_id', $id);
		$this->db->delete('tbl_attribute_master');

		$this->db->where('amv_attrib_id', $id);
		$this->db->delete('tbl_attribute_master_values');
		return $id;
	}
	
}
?>