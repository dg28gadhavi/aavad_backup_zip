<?php 

class Executive_monthly_report_model extends CI_Model {
	
	
	public function add($data,$id)
	{
		//echo '<pre>'; print_r($id);die;
		$this->db->select('*');
		$this->db->from('tbl_executive_monthly_report');
		$this->db->where('exec_month_date',date('Y-m-d'));
		$query = $this->db->get();
		if($query->num_rows() == 0)
		{
				$item = array(
						'exec_month_inv_commited' => $data['country_name'],
						'exec_month_inv_actual' => $data['order_name'],
						'exec_month_im_commited' => $data['country_name'],
						'exec_month_im_actual' => $data['order_name'],
						'exec_month_st_commited' => $data['country_name'],
						'exec_month_st_actual' => $data['order_name'],
						'exec_month_st_free_commited' => $data['country_name'],
						'exec_month_st_free_actual' => $data['order_name'],
						'exec_month_total_commited' => $data['country_name'],
						'exec_month_total_actual' => $data['order_name'],
						'exec_month_udate' => date('Y-m-d'),
						'exec_month_ip' => $this->input->ip_address()
				);
			//echo '<pre>'; print_r($item);die;
			$this->db->insert('tbl_executive_monthly_report',$item);
		}else{
				$item = array(
						'exec_month_inv_commited' => $data['country_name'],
						'exec_month_inv_actual' => $data['order_name'],
						'exec_month_im_commited' => $data['country_name'],
						'exec_month_im_actual' => $data['order_name'],
						'exec_month_st_commited' => $data['country_name'],
						'exec_month_st_actual' => $data['order_name'],
						'exec_month_st_free_commited' => $data['country_name'],
						'exec_month_st_free_actual' => $data['order_name'],
						'exec_month_total_commited' => $data['country_name'],
						'exec_month_total_actual' => $data['order_name'],
						'exec_month_udate' => date('Y-m-d'),
						'exec_month_ip' => $this->input->ip_address()
				);
			$this->db->where('country_id', $id);
			//echo "<pre>"; print_r($item); die;
			$this->db->update('tbl_executive_monthly_report', $item);
		}

		
		$lid = $this->db->insert_id();
		return $lid;
	}
	
}
?>