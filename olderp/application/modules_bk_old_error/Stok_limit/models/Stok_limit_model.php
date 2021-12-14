<?php 

class Stok_limit_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'Stok_limit_name' => $data['Stok_limit_name'],
			'Stok_limit_state' => $data['Stok_limit_state'],
			'Stok_limit_country' => $data['Stok_limit_country']
			//'Stok_limit_roe' => $data['Stok_limit_roe'],
			//'Stok_limit_cid' => $this->session->userdata['login']['aus_Id'],
			//'Stok_limit_cdate' => $data['Stok_limit_cdate'],
			///'Stok_limit_udate' => $data['Stok_limit_udate']
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_master_Stok_limit',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'Stok_limit_name' => $data['Stok_limit_name'],
			'Stok_limit_state' => $data['Stok_limit_state'],
			'Stok_limit_country' => $data['Stok_limit_country']
			//'Stok_limit_roe' => $data['Stok_limit_roe'],
			//'Stok_limit_udate' => $data['Stok_limit_udate']
			);
		$this->db->where('Stok_limit_id', $id);
		//$this->db->where('Stok_limit_cid',$this->session->userdata['login']['aus_Id']);
		$this->db->update('tbl_master_Stok_limit', $item); 
		$lid = $id;
		return $lid;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_Stok_limit');
		$this->db->where('Stok_limit_id',$id);
		//$this->db->where('Stok_limit_cid',$this->session->userdata['login']['aus_Id']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

    public function get_Stok_limit()
    {

        
        //echo "<pre>";print_r($query->result_array());die;
        $value = array();
        
        $sql = "SELECT * FROM (SELECT tbl_master_item.master_item_id,tbl_master_item.master_item_name,tbl_master_item.master_item_part_no,tbl_master_item.master_item_limit,IFNULL((IFNULL((select ROUND(SUM(tcredit.tran_itm_qty), 2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_master_item.master_item_id AND tcredit.tran_is_hold = '0' ),0)-IFNULL((select ROUND(SUM(tdebit.tran_itm_qty), 2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_master_item.master_item_id AND tdebit.tran_is_hold = '0' ),0)),0) as finalstock FROM tbl_master_item LEFT JOIN tbl_hsn_code ON tbl_hsn_code.hsn_id = tbl_master_item.master_item_hsncode) as newtable WHERE newtable.finalstock < newtable.master_item_limit";
            $query = $this->db->query($sql);
            //$stock_itm =  $query->result_array();
            //echo $this->db->last_query();die;
            //echo "<pre>";print_r($query->result_array());die;
            return $query->result_array();
    }

	
}
?>