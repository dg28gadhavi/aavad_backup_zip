<?php 

class Stock_adjustment_model extends CI_Model {
	
	
	public function add($data)
	{
		//echo "<pre>"; print_r($data); die;
		$item = array(
			'tran_itm_id' => $data['sqi_itm_pno_id'],
			'tran_itm_qty' => $data['sqi_itm_opn_qty'],
			'tran_cr_or_dr' => $data['sqi_bit'],
			'tran_stock_adjustment' => 1,
			//'tran_cid' => $this->session->userdata['login']['aus_Id'],
			'tran_cdate' => date("Y-m-d H:i:s"),
			'tran_udate' => date("Y-m-d H:i:s"),
			'tran_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_transaction',$item);
		$lid = $this->db->insert_id();
		return $lid;


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
	
	public function outward($data)
	{
		die;
		$itmlists = array(
  array('partno' => 'RTD (PT-100) Sensor','qty' => '24'),
  array('partno' => 'AI-518P-A','qty' => '1'),
  array('partno' => 'AI-509-D2','qty' => '1'),
  array('partno' => 'AI-526-D2-X3','qty' => '10'),
  array('partno' => 'AI-509-A','qty' => '10'),
  array('partno' => 'AI-526-D','qty' => '5'),
  array('partno' => 'AI-509-A','qty' => '4'),
  array('partno' => 'AI-509-A','qty' => '1'),
  array('partno' => 'AI-5201-D2','qty' => '4'),
  array('partno' => 'AI-509-A','qty' => '4'),
  array('partno' => 'AI-526-D2-X3','qty' => '6'),
  array('partno' => 'AI-509-A','qty' => '6'),
  array('partno' => 'AI-526-D2-X3','qty' => '5'),
  array('partno' => 'AI-509-A','qty' => '5'),
  array('partno' => 'AI-708-B','qty' => '2'),
  array('partno' => 'AI-509-A','qty' => '2'),
  array('partno' => 'AI-519-E','qty' => '3'),
  array('partno' => 'AI-509-A','qty' => '3'),
  array('partno' => 'AI-708-F','qty' => '6'),
  array('partno' => 'AI-509-A','qty' => '6'),
  array('partno' => 'AI-500-D2-24V','qty' => '10'),
  array('partno' => 'AI-509-D2','qty' => '10'),
  array('partno' => 'Display Card ','qty' => '3'),
  array('partno' => 'AI-516-D5-K6-LS','qty' => '16'),
  array('partno' => 'LEVI2043E','qty' => '125'),
  array('partno' => 'LEVI2070','qty' => '50'),
  array('partno' => 'LX3V-2AD2DA-BD','qty' => '2'),
  array('partno' => 'LX3VM-1412-MT-A','qty' => '5'),
  array('partno' => 'PI3070-N','qty' => '50'),
  array('partno' => 'PI3102-N','qty' => '5'),
  array('partno' => 'LX2V-1814MR-A','qty' => '5'),
  array('partno' => 'LX3V-1616MT-A','qty' => '10'),
  array('partno' => 'LX3V-16EYR','qty' => '10'),
  array('partno' => 'Glass Touch 7','qty' => '8'),
  array('partno' => 'LEVI2043T','qty' => '30')
);

	foreach ($itmlists as $key => $itmlist) 
	{
		$this->db->select('master_item_id');
		$this->db->from('tbl_master_item');
		$this->db->where('master_item_part_no',$itmlist['partno']);
		$query=$this->db->get();
		if($query->num_rows() == 1)
		{
			$itmdata= $query->row_array();
			$item = array(
			'tran_itm_id' => $itmdata['master_item_id'],
			'tran_itm_qty' => $itmlist['qty'],
			'tran_cr_or_dr' => 1,
			'tran_stock_adjustment' => 1,
			'tran_cdate' => date("Y-m-d H:i:s"),
			'tran_udate' => date("Y-m-d H:i:s")
			);
			//echo '<pre>'; print_r($item);die;
			$this->db->insert('tbl_transaction',$item);
		}

	}


	}

	
	
     
}
?>