<?php 

class Prefix_model extends CI_Model {
	
	
	public function add($data)
	{        
		     $item = array(
			'pre_enquiry' => $data['pre_enquiry'],
			'pre_quotation' => $data['pre_quotation'],
			'pre_po' => $data['pre_po'],
			'pre_invoice' => $data['pre_invoice'],
			'pre_grn' => $data['pre_grn'],
			'pre_vendor' => $data['pre_vendor'],
			'pre_dc' => $data['pre_dc'],
			'pre_job_card' => $data['pre_job_card'],
			'pre_oa' => $data['pre_oa'],
			'pre_issue_voucher' => $data['pre_issue_voucher'],
			'pre_pi' => $data['pre_pi'],
			'pre_tax_invoice' => $data['pre_tax_invoice'],
			'pre_cdate' => $data['pre_cdate'],
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_prefix',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}

	public function add_prifix_cid()
	{
		$query = $this->db->get_where('tbl_company_info',array('ci_id'=>$this->session->userdata['login']['aus_Id']));
		if($query->num_rows() == 1)
		{
			$item = array(
			'pre_enquiry' => 'ENQ/SllPL/17-18/',
			'pre_quotation' => 'QTN/SllPL/17-18/',
			'pre_po' => 'PO/SllPL/17-18/',
			'pre_invoice' => 'INV/SllPL/17-18/',
			'pre_grn' => 'GRN/SllPL/17-18/',
			'pre_vendor' => 'VDR/SllPL/17-18/',
			'pre_dc' => 'DC/SllPL/17-18/',
			'pre_job_card' => 'JOB/SllPL/17-18/',
			'pre_oa' => 'OA/SllPL/17-18/',
			'pre_issue_voucher' => 'IV/SllPL/17-18/',
			'pre_pi' => 'PI/SllPL/17-18/',
			'pre_tax_invoice' => 'TXI/SllPL/17-18/',
			'pre_cid' => $this->session->userdata['login']['aus_Id'],
			);
			//echo '<pre>'; print_r($item);die;
			$this->db->insert('tbl_prefix',$item);
			$lid = $this->db->insert_id();
			return $lid;
		}else{
			return false;
		}
	}
	
	public function edit($data,$id)
	{ 
		
		$item = array(
			'pre_enquiry' => $data['pre_enquiry'],
			'pre_quotation' => $data['pre_quotation'],
			'pre_po' => $data['pre_po'],
			'pre_invoice' => $data['pre_invoice'],
			'pre_grn' => $data['pre_grn'],
			'pre_vendor' => $data['pre_vendor'],
			'pre_dc' => $data['pre_dc'],
			'pre_job_card' => $data['pre_job_card'],
			'pre_oa' => $data['pre_oa'],
			'pre_issue_voucher' => $data['pre_issue_voucher'],
			'pre_pi' => $data['pre_pi'],
			'pre_tax_invoice' => $data['pre_tax_invoice'],
			'pre_party_code' => $data['pre_party_code'],
			'pre_item_code' => $data['pre_item_code'],
			'pre_cdate' => $data['pre_cdate'],
			);
		$this->db->where('pre_id', $id);
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_prefix', $item); 
		$lid = $this->input->get('id');
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		$this->db->where('pre_id',$id);
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_usingcid()
	{
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->row_array();
	}

	public function get_prefix()
	{
		$this->db->select('*');
		$this->db->from('tbl_prefix');
		//$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
}
?>