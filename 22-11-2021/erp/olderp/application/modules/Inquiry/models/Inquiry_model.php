<?php 

class Inquiry_model extends CI_Model {
	
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

	public function create_visa($iddcr)
	{
		//echo "hi";die;
		//echo '<pre>'; print_r($iddcr); die;
		$this->db->select('*');
		$this->db->from('tbl_ubasic_details');
		$this->db->where('bd_inq_id', $iddcr);
		$this->db->where('bd_bit', '1');
		$query = $this->db->get();
		$value['basic_details'] = $query->result_array();
		//echo '<pre>'; print_r($value['basic_details']); die;
	//***********************************************************************	
		$vf = array(
				'vf_module_id' => 21,
				'vf_client_email' => isset($value['basic_details']['bd_email']) ? $value['basic_details']['bd_email'] : '',
			);
			//echo "<pre>"; print_r($inqitem); die;
		$this->db->insert('tbl_visa_file',$vf);
		$lid = $this->db->insert_id();
	//***********************************************************************
		$bd = array(
			'bd_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('bd_inq_id', $iddcr);
		$this->db->update('tbl_ubasic_details',$bd);
	//***********************************************************************	
		$uaddrs = array(
			'add_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('add_inq_id', $iddcr);
		$this->db->update('tbl_uaddress',$uaddrs);
	//***********************************************************************
		$ucno = array(
			'con_no_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('con_no_inq_id', $iddcr);
		$this->db->update('tbl_ucontact_nos',$ucno);	
	//***********************************************************************
			$uedu = array(
			'uedu_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('uedu_inq_id', $iddcr);
		$this->db->update('tbl_ueducation',$uedu);
	//***********************************************************************
			$uexp = array(
			'uexp_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('uexp_inq_id', $iddcr);
		$this->db->update('tbl_uexperience',$uexp);	
	//***********************************************************************
			$ulang = array(
			'ul_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('ul_inq_id', $iddcr);
		$this->db->update('tbl_ulanguage',$ulang);	
	//***********************************************************************
			$urel = array(
			'urel_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('urel_inq_id', $iddcr);
		$this->db->update('tbl_urelative',$urel);
	//***********************************************************************
			$urefu = array(
			'urefu_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('urefu_inq_id', $iddcr);
		$this->db->update('tbl_urefusal',$urefu);
	//***********************************************************************
			$urefu = array(
			'uchild_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('uchild_inq_id', $iddcr);
		$this->db->update('tbl_uchildrens',$urefu);
	//***********************************************************************
			$uprod = array(
			'prod_uf_id' => $lid,
			);
			//echo "<pre>"; print_r($inqitem); die;
			$this->db->where('prod_inq_id', $iddcr);
		$this->db->update('tbl_uproduct_details',$uprod);

		return $lid;

	}
	
	public function add($data)
	{
		//echo "<pre>"; print_r($data); die;
			$inqitem = array(
			'inq_no' => $data['inquiry_details']['inq_no'],
			'inq_date' => date("Y-m-d", strtotime($data['inquiry_details']['date'])), 
			'inq_type' => $data['inquiry_details']['type'],
			'inq_au_id' => $data['inquiry_details']['au'],
			'inq_source' => $data['inquiry_details']['source'],
			'inq_subsource' => $data['inquiry_details']['ssource'],
			'inq_inqstatus' => $data['inquiry_details']['inqstatus'],
			//'inq_hasrefrence' => $data['inquiry_details']['hasref'],
			'inq_rername' => $data['inquiry_details']['custname'],
			'inq_refno' => $data['inquiry_details']['inq_custno']
			);
			//echo "<pre>"; print_r($inqitem); die;
		$this->db->insert('tbl_inquiry',$inqitem);
		$inqlid = $this->db->insert_id();
		
		//******************************************
		if(isset($data['inquiry_details']) && isset($data['inquiry_details']['cou_inter']) && $data['inquiry_details'] != '' && $data['inquiry_details']['cou_inter'] != ''){
			foreach ($data['inquiry_details']['cou_inter'] as $intrkey => $value) {
					foreach ($value as $coid) {
					$cntitem = array(
					'inqci_inq_id' => $inqlid,
					'inqci_moduleid' => 19,
					//'prod_uf_id' => 
					'inqci_countryid' => $coid,
					'inqci_bit' => $intrkey,
					'inqci_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_ucountryoption',$cntitem);
					}
				} 
		}
		//***************************************
		$proditem = array(
			'prod_inq_id' => $inqlid,
			'prod_module_id' => 19,
			//'prod_uf_id' => 
			'prod_pro_id' => 1,
			'prod_type_id' => $data['pro_type'],
			'prod_cat_id '=> $data['pro_category'],
			'prod_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uproduct_details',$proditem);
		//***************************************
		foreach ($data['basic_details'] as $bdkey => $basic_details) {
			# code...
			$year = isset($basic_details['dbirth_year']) ? $basic_details['dbirth_year'] : '';
			$month = isset($basic_details['dbirth_month']) ? $basic_details['dbirth_month'] : '';
			$day = isset($basic_details['dbirth_day']) ? $basic_details['dbirth_day'] : '';
			$final_date = date("Y-m-d H:i:s", strtotime($year.'-'.$month.'-'.$day));
			$bdar = array(
					'bd_module_id' => 19,
					'bd_inq_id' => $inqlid,
					'bd_uf_id' => isset($basic_details['ufid']) ? $basic_details['ufid'] : '',
					'bd_fname' => isset($basic_details['fname']) ? $basic_details['fname'] : '',
					'bd_bfname' => isset($basic_details['bd_bfname']) ? $basic_details['bd_bfname'] : '',
					'bd_bmname' => isset($basic_details['bd_bmname']) ? $basic_details['bd_bmname'] : '',
					'bd_mname' => isset($basic_details['mname']) ? $basic_details['mname'] : '',
					'bd_lname' => isset($basic_details['lbname']) ? $basic_details['lbname'] : '',
					'bd_lname_mrg' => isset($basic_details['lmname']) ? $basic_details['lmname'] : '',
					'bd_dob' => isset($final_date) ? date("Y-m-d", strtotime($final_date))  : '',
					'bd_day' => isset($basic_details['dbirth_day']) ? $basic_details['dbirth_day'] : '',
					'bd_month' => isset($basic_details['dbirth_month']) ? $basic_details['dbirth_month'] : '',
					'bd_year' => isset($basic_details['dbirth_year']) ? $basic_details['dbirth_year'] : '',
					'bd_age' => isset($basic_details['age']) ? $basic_details['age'] : '',
					'bd_gender' => isset($basic_details['gender']) ? $basic_details['gender'] : '',
					'bd_place_of_birth' => isset($basic_details['bd_place_of_birth']) ? $basic_details['bd_place_of_birth'] : '',
					'bd_language' => isset($basic_details['bd_language']) ? $basic_details['bd_language'] : '',
					'bd_country_of_birth' => isset($basic_details['bd_country_of_birth']) ? $basic_details['bd_country_of_birth'] : '',
					'bd_country_of_citizen' => isset($basic_details['city']) ? $basic_details['city'] : '',
					'bd_mono' => isset($basic_details['mobile']) ? $basic_details['mobile'] : '',
					'bd_curr_status' => isset($basic_details['status']) ? $basic_details['status'] : '',
					'bd_mari_status' => isset($basic_details['fam_pmarital']) ? $basic_details['fam_pmarital'] : '',
					'bd_height' => isset($basic_details['bd_height']) ? $basic_details['bd_height'] : '',
					'bd_colour_of_eyes' => isset($basic_details['bd_colour_of_eyes']) ? $basic_details['bd_colour_of_eyes'] : '',
					'bd_company_name' => isset($basic_details['inq_cname']) ? $basic_details['inq_cname'] : '',
					'bd_photo' => isset($basic_details['bd_photo']) ? $basic_details['bd_photo'] : '',
					'bd_aka' => isset($basic_details['bd_aka']) ? $basic_details['bd_aka'] : '',
					'bd_mrg_st' => isset($basic_details['fam_pmarital']) ? $basic_details['fam_pmarital'] : '',
					'bd_dom' => isset($basic_details['bd_dom']) ? $basic_details['bd_dom'] : '',
					'bd_m_more_one' => isset($basic_details['bd_m_more_one']) ? $basic_details['bd_m_more_one'] : '',
					'bd_second_dom' => isset($basic_details['bd_second_dom']) ? $basic_details['bd_second_dom'] : '',
					'bd_net_worth' => isset($basic_details['o_networth']) ? $basic_details['o_networth'] : '',
					'bd_email' => isset($basic_details['basicemail']) ? $basic_details['basicemail'] : '',
					'bd_remark' => isset($basic_details['basic_remark']) ? $basic_details['basic_remark'] : '',
					'bd_login_email' => isset($basic_details['emailid']) ? $basic_details['emailid'] : '',
					'bd_bit' => $bdkey
				);
			$this->db->insert('tbl_ubasic_details',$bdar);
		}
		//***************************************
			$cnoitem = array(
				'con_no_module_id' => 19,
				'con_no_inq_id' => $inqlid,
				//'con_no_uf_id' =>
				'con_no_mnos' => $data['contact']['inq_cmno'],
				'con_no_hnos' => $data['contact']['inq_chno'],
				'con_no_wnos' => $data['contact']['inq_cwno']
				);
			$this->db->insert('tbl_ucontact_nos',$cnoitem);
		
		//***************************************
		foreach ($data['basic_details'] as $pnokey => $pno) {
			$pnoitem = array(
				'up_module_id 	' => 19,
				'up_inq_id' => $inqlid,
				//'urefu_uf_id' =>
				'up_pp_no' => isset($pno['pno']) ? $pno['pno'] : '',
				'up_udate' => date('Y-m-d H:i:s'),
				'up_bit' => $pnokey
				);
			$this->db->insert('tbl_upassport',$pnoitem);
		}
		//***************************************
		if(isset($data['meadd1_country']) && $data['meadd1_country'] != ''){
			foreach ($data['meadd1_country'] as $addkey => $add) {
			$additem = array(
			'add_module_id' => 19,
			'add_inq_id' => $inqlid,
			//'bd_uf_id' =>
			'add_country' => $add,
			'add_state' => isset($data['meadd1_state'][$addkey]) ? $data['meadd1_state'][$addkey] : '',
			'add_city' => isset($data['meadd1_city'][$addkey]) ? $data['meadd1_city'][$addkey] : '',
			'add_area' => isset($data['meadd1_area'][$addkey]) ? $data['meadd1_area'][$addkey] : '',
			'add_pin' => isset($data['meadd1_pin'][$addkey]) ? $data['meadd1_pin'][$addkey] : '',
			'add_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uaddress',$additem);
		}
		}
		// if(isset($data['meadd1_address']) && $data['meadd1_address'] != ''){
		// 	foreach ($data['meadd1_address'] as $addkey => $add) {
		// 	$additem = array(
		// 	'add_module_id' => 19,
		// 	'add_inq_id' => $inqlid,
		// 	//'bd_uf_id' =>
		// 	'add_address' => $add,
		// 	'add_country' => $data['meadd1_country'][$addkey],
		// 	'add_state' => isset($data['meadd1_state'][$addkey]) ? $data['meadd1_state'][$addkey] : '',
		// 	'add_city' => isset($data['meadd1_city'][$addkey]) ? $data['meadd1_city'][$addkey] : '',
		// 	'add_area' => isset($data['meadd1_area'][$addkey]) ? $data['meadd1_area'][$addkey] : '',
		// 	'add_pin' => isset($data['meadd1_pin'][$addkey]) ? $data['meadd1_pin'][$addkey] : '',
		// 	'add_udate' => date('Y-m-d H:i:s')
		// 	);
		// $this->db->insert('tbl_uaddress',$additem);
		// }
		// }
		//***************************************
		if(isset($data['meedu']) && $data['meedu'] != ''){
			foreach ($data['meedu'] as $meedukey => $meeduu) {
				$additem = array(
				'uedu_module_id' => 19,
				'uedu_inq_id' => $inqlid,
				//'bd_uf_id' =>
				'uedu_education' => $meeduu,
				'uedu_subject' => $data['mesubject'][$meedukey],
				'uedu_per' => $data['meper'][$meedukey],
				'uedu_backlogs' => $data['mebacklogs'][$meedukey],
				'uedu_start' => date("Y-m-d", strtotime($data['mestart'][$meedukey])),
				'uedu_end' => date("Y-m-d", strtotime($data['meend'][$meedukey])),
				'uedu_university' => $data['meuni'][$meedukey],
				'uedu_bit' => '1',
				'uedu_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_ueducation',$additem);
			}
		}
		//***************************************
		if(isset($data['meexp_year']) && $data['meexp_year'] != ''){
			foreach ($data['meexp_year'] as $meexpkey => $meexps) {
				$additem = array(
				'uexp_module_id' => 19,
				'uexp_inq_id' => $inqlid,
				//'uexp_uf_id' =>
				'uexp_exp_years' => $meexps,
				'uexp_exp_field' => $data['meexp_field'][$meexpkey],
				'uexp_bit' => '1',
				'uexp_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_uexperience',$additem);
			}
		}
		//***************************************
		foreach ($data['melang'] as $melangkey => $melangg) {
			$melangitem = array(
			'ul_module_id' => 19,
			'ul_inq_id' => $inqlid,
			//'ul_uf_id' =>
			'ul_lang_id' => $meeduu,
			'ul_reading' => $data['melang_read'][$melangkey],
			'ul_writing' => $data['melang_write'][$melangkey],
			'ul_listening' => $data['melang_listen'][$melangkey],
			'ul_speaking' => $data['lang_speak'][$melangkey],
			'ul_overall' => $data['melang_overall'][$melangkey],
			'ul_exp_date' => date("Y-m-d", strtotime($data['melang_expdate'][$melangkey])),
			'ul_lang_type' => $data['melang_gen'][$melangkey],
			'ul_bit' => '1',
			'ul_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_ulanguage',$melangitem);
		}
		//***************************************
		foreach ($data['merelname'] as $merelkey => $merel) {
			foreach ($data['merel_forign'] as $fkey => $foreign) {
				# code...
				$yes_no = $foreign;
				unset($data['merel_forign'][$fkey]);
				break;
			}
			$merel = array(
			'urel_module_id' => 19,
			'urel_inq_id' => $inqlid,
			//'ul_uf_id' =>
			'urel_name' => $merel,
			'urel_yes_no' => isset($yes_no) ? $yes_no : '1',
			'urel_country' => $data['merelcountry'][$merelkey],
			'urel_address' => $data['mereladd'][$merelkey],
			'urel_bit' => '1',
			'urel_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_urelative',$merel);
		}
		//***************************************
		foreach ($data['merefu_country'] as $merefu_cokey => $merefu_countryy) {
			$additem = array(
			'urefu_module_id' => 19,
			'urefu_inq_id' => $inqlid,
			//'urefu_uf_id' =>
			'urefu_country' => $merefu_countryy,
			'urefu_date' => date("Y-m-d", strtotime($data['merefdate'][$merefu_cokey])),
			'urefu_category' => $data['merefu_category'][$merefu_cokey],
			'urefu_remarks' => $data['merefu_remark'][$merefu_cokey],
			'urefu_bit' => '1',
			'urefu_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_urefusal',$additem);
		}
		//***************************************
		if(isset($data['spouseedu']) && $data['spouseedu'] != ''){
			foreach ($data['spouseedu'] as $spedukey => $spouseedu) {
				$spouceitem = array(
				'uedu_module_id' => 19,
				'uedu_inq_id' => $inqlid,
				//'bd_uf_id' =>
				'uedu_education' => $spouseedu,
				'uedu_subject' => $data['spousesubject'][$spedukey],
				'uedu_per' => $data['spouseper'][$spedukey],
				'uedu_backlogs' => $data['spousebacklogs'][$spedukey],
				'uedu_start' => date("Y-m-d", strtotime($data['spousestart'][$spedukey])), 
				'uedu_end' => date("Y-m-d", strtotime($data['spouseend'][$spedukey])),
				'uedu_university' => $data['spouseuni'][$spedukey],
				'uedu_bit' => '2',
				'uedu_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_ueducation',$spouceitem);
			}
		}
		//***************************************
		if(isset($data['spouseexp_year']) && $data['spouseexp_year'] != ''){
			foreach ($data['spouseexp_year'] as $spexpkey => $spouseexp) {
				$additem = array(
				'uexp_module_id' => 19,
				'uexp_inq_id' => $inqlid,
				//'uexp_uf_id' =>
				'uexp_exp_years' => $spouseexp,
				'uexp_exp_field' => $data['spouseexp_field'][$spexpkey],
				'uexp_bit' => '2',
				'uexp_udate' => date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_uexperience',$additem);
			}
		}
		//***************************************
		foreach ($data['spouselang'] as $splangkey => $spouselang) {
			$splangitem = array(
			'ul_module_id' => 19,
			'ul_inq_id' => $inqlid,
			//'ul_uf_id' =>
			'ul_lang_id' => $spouselang,
			'ul_reading' => $data['spouselang_read'][$splangkey],
			'ul_writing' => $data['spouselang_write'][$splangkey],
			'ul_listening' => $data['spouselang_listen'][$splangkey],
			'ul_speaking' => $data['lang_speak'][$splangkey],
			'ul_overall' => $data['spouselang_overall'][$splangkey],
			'ul_exp_date' => date("Y-m-d", strtotime($data['spouselang_expdate'][$splangkey])),
			'ul_lang_type' => $data['spouselang_gen'][$splangkey],
			'ul_bit' => '2',
			'ul_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_ulanguage',$splangitem);
		}
		//***************************************
		foreach ($data['spouserelname'] as $sprelkey => $sprel) {
			foreach ($data['spouserel_forign'] as $fkey => $foreign) {
				# code...
				$yes_no = $foreign;
				unset($data['spouserel_forign'][$fkey]);
				break;
			}
			$sprelitem = array(
			'urel_module_id' => 19,
			'urel_inq_id' => $inqlid,
			//'ul_uf_id' =>
			'urel_yes_no' => isset($yes_no) ? $yes_no : '1',
			'urel_name' => $sprel,
			'urel_country' => $data['spouserelcountry'][$sprelkey],
			'urel_address' => $data['spousereladd'][$sprelkey],
			'urel_bit' => '2',
			'urel_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_urelative',$sprelitem);
		}
		//***************************************
		foreach ($data['spouserefu_country'] as $sprefukey => $spouserefu_country) {
			$sprefuitem = array(
			'urefu_module_id' => 19,
			'urefu_inq_id' => $inqlid,
			//'urefu_uf_id' =>
			'urefu_country' => $spouserefu_country,
			'urefu_date' => date("Y-m-d", strtotime($data['merefdate'][$sprefukey])),
			'urefu_category' => $data['merefu_category'][$sprefukey],
			'urefu_remarks' => $data['merefu_remark'][$sprefukey],
			'urefu_bit' => '2',
			'urefu_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_urefusal',$sprefuitem);
		}
		//***************************************
		foreach ($data['spousechdtl_date'] as $spchdtlkey => $spousechdtl_date) {
			$sprefuitem = array(
			'uchild_module_id' => 19,
			'uchild_inq_id' => $inqlid,
			//'urefu_uf_id' =>
			'uchild_dob' => isset($spousechdtl_date) ? date("Y-m-d", strtotime($spousechdtl_date)) : '',
			'uchild_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uchildrens',$sprefuitem);
		}

		return $inqlid;
	}
	
	public function edit($data,$id)
	{ 
		//echo "<pre>"; print_r($data); die;
		$inqitem = array(
			'inq_no' => $data['inquiry_details']['inq_no'],
			'inq_date' => date("Y-m-d", strtotime($data['inquiry_details']['date'])), 
			'inq_type' => $data['inquiry_details']['type'],
			'inq_au_id' => $data['inquiry_details']['au'],
			'inq_source' => $data['inquiry_details']['source'],
			'inq_subsource' => $data['inquiry_details']['ssource'],
			'inq_inqstatus' => $data['inquiry_details']['inqstatus'],
			'inq_hasrefrence' => $data['inquiry_details']['hasref'],
			'inq_rername' => $data['inquiry_details']['custname'],
			'inq_refno' => $data['inquiry_details']['inq_custno']
			);
		$this->db->where('inq_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_inquiry', $inqitem);
		//***************************************
		$this->db->where('inqci_inq_id', $id);
		$this->db->where('inqci_bit', '1');
		$this->db->delete('tbl_ucountryoption'); 
		if(isset($data['inquiry_details']) && isset($data['inquiry_details']['cou_inter']) && $data['inquiry_details'] != '' && $data['inquiry_details']['cou_inter'] != ''){
			foreach ($data['inquiry_details']['cou_inter'] as $intrkey => $value) {
					foreach ($value as $coid) {
					$cntitem = array(
					'inqci_inq_id' => $id,
					'inqci_moduleid' => 19,
					//'prod_uf_id' => 
					'inqci_countryid' => $coid,
					'inqci_bit' => $intrkey,
					'inqci_udate' => date('Y-m-d H:i:s')
					);
				$this->db->insert('tbl_ucountryoption',$cntitem);
					}
				} 
		}
		//***************************************
		$this->db->where('prod_inq_id', $id);
		$this->db->delete('tbl_uproduct_details');
		//***************************************
		$proditem = array(
			'prod_inq_id' => $id,
			'prod_module_id' => 19,
			//'prod_uf_id' => 
			'prod_pro_id' => 1,
			'prod_type_id' => $data['pro_type'],
			'prod_cat_id '=> $data['pro_category'],
			'prod_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uproduct_details',$proditem);
		//***************************************
		$this->db->where('bd_inq_id', $id);
		$this->db->delete('tbl_ubasic_details');
		//****************************************
		foreach ($data['basic_details'] as $bdkey => $basic_details) {
			$year = isset($basic_details['dbirth_year']) ? $basic_details['dbirth_year'] : '';
			$month = isset($basic_details['dbirth_month']) ? $basic_details['dbirth_month'] : '';
			$day = isset($basic_details['dbirth_day']) ? $basic_details['dbirth_day'] : '';
			$final_date = date("Y-m-d H:i:s", strtotime($year.'-'.$month.'-'.$day));
			$bdar = array(
					'bd_module_id' => 19,
					'bd_inq_id' => $id,
					'bd_uf_id' => isset($basic_details['ufid']) ? $basic_details['ufid'] : '',
					'bd_fname' => isset($basic_details['fname']) ? $basic_details['fname'] : '',
					'bd_bfname' => isset($basic_details['bd_bfname']) ? $basic_details['bd_bfname'] : '',
					'bd_bmname' => isset($basic_details['bd_bmname']) ? $basic_details['bd_bmname'] : '',
					'bd_mname' => isset($basic_details['mname']) ? $basic_details['mname'] : '',
					'bd_lname' => isset($basic_details['lbname']) ? $basic_details['lbname'] : '',
					'bd_lname_mrg' => isset($basic_details['lmname']) ? $basic_details['lmname'] : '',
					'bd_dob' => isset($final_date) ? date("Y-m-d", strtotime($final_date))  : '',
					'bd_day' => isset($basic_details['dbirth_day']) ? $basic_details['dbirth_day'] : '',
					'bd_month' => isset($basic_details['dbirth_month']) ? $basic_details['dbirth_month'] : '',
					'bd_year' => isset($basic_details['dbirth_year']) ? $basic_details['dbirth_year'] : '',
					'bd_age' => isset($basic_details['age']) ? $basic_details['age'] : '',
					'bd_gender' => isset($basic_details['gender']) ? $basic_details['gender'] : '',
					'bd_place_of_birth' => isset($basic_details['bd_place_of_birth']) ? $basic_details['bd_place_of_birth'] : '',
					'bd_language' => isset($basic_details['bd_language']) ? $basic_details['bd_language'] : '',
					'bd_country_of_birth' => isset($basic_details['bd_country_of_birth']) ? $basic_details['bd_country_of_birth'] : '',
					'bd_country_of_citizen' => isset($basic_details['city']) ? $basic_details['city'] : '',
					'bd_mono' => isset($basic_details['mobile']) ? $basic_details['mobile'] : '',
					'bd_curr_status' => isset($basic_details['status']) ? $basic_details['status'] : '',
					'bd_mari_status' => isset($basic_details['fam_pmarital']) ? $basic_details['fam_pmarital'] : '',
					'bd_height' => isset($basic_details['bd_height']) ? $basic_details['bd_height'] : '',
					'bd_colour_of_eyes' => isset($basic_details['bd_colour_of_eyes']) ? $basic_details['bd_colour_of_eyes'] : '',
					'bd_company_name' => isset($basic_details['inq_cname']) ? $basic_details['inq_cname'] : '',
					'bd_photo' => isset($basic_details['bd_photo']) ? $basic_details['bd_photo'] : '',
					'bd_aka' => isset($basic_details['bd_aka']) ? $basic_details['bd_aka'] : '',
					'bd_mrg_st' => isset($basic_details['fam_pmarital']) ? $basic_details['fam_pmarital'] : '',
					'bd_dom' => isset($basic_details['bd_dom']) ? $basic_details['bd_dom'] : '',
					'bd_m_more_one' => isset($basic_details['bd_m_more_one']) ? $basic_details['bd_m_more_one'] : '',
					'bd_second_dom' => isset($basic_details['bd_second_dom']) ? $basic_details['bd_second_dom'] : '',
					'bd_net_worth' => isset($basic_details['o_networth']) ? $basic_details['o_networth'] : '',
					'bd_email' => isset($basic_details['basicemail']) ? $basic_details['basicemail'] : '',
					'bd_remark' => isset($basic_details['basic_remark']) ? $basic_details['basic_remark'] : '',
					'bd_login_email' => isset($basic_details['emailid']) ? $basic_details['emailid'] : '',
					'bd_bit' => $bdkey
				);
			$this->db->insert('tbl_ubasic_details',$bdar);
		}
		//***************************************
			$cnoitem = array(
				'con_no_module_id' => 19,
				//'con_no_uf_id' =>
				'con_no_mnos' => $data['contact']['inq_cmno'],
				'con_no_hnos' => $data['contact']['inq_chno'],
				'con_no_wnos' => $data['contact']['inq_cwno']
				);
			$this->db->where('con_no_inq_id', $id);
			$this->db->update('tbl_ucontact_nos', $cnoitem);
		//***************************************
		$this->db->where('up_inq_id', $id);
		$this->db->where('up_bit', '1');
		$this->db->delete('tbl_upassport');
		foreach ($data['basic_details'] as $pnokey => $pno) {
			$pnoitem = array(
				'up_module_id' => 19,
				'up_inq_id' => $id,
				//'urefu_uf_id' =>
				'up_pp_no' => isset($pno['pno']) ? $pno['pno'] : '',
				'up_udate' => date('Y-m-d H:i:s'),
				'up_bit' => $pnokey
				);
			$this->db->insert('tbl_upassport',$pnoitem);
		}
		//***************************************
		$this->db->where('add_inq_id', $id);
		$this->db->delete('tbl_uaddress');
		if(isset($data['meadd1_country']) && $data['meadd1_country'] != ''){
			foreach ($data['meadd1_country'] as $addkey => $add) {
			$additem = array(
			'add_module_id' => 19,
			'add_inq_id' => $id,
			//'bd_uf_id' =>
			'add_country' => $add,
			'add_state' => isset($data['meadd1_state'][$addkey]) ? $data['meadd1_state'][$addkey] : '',
			'add_city' => isset($data['meadd1_city'][$addkey]) ? $data['meadd1_city'][$addkey] : '',
			'add_area' => isset($data['meadd1_area'][$addkey]) ? $data['meadd1_area'][$addkey] : '',
			'add_pin' => isset($data['meadd1_pin'][$addkey]) ? $data['meadd1_pin'][$addkey] : '',
			'add_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uaddress',$additem);
		}
		}
		// if(isset($data['meadd1_address']) && $data['meadd1_address'] != ''){
		// 	foreach ($data['meadd1_address'] as $addkey => $add) {
		// 	$additem = array(
		// 	'add_module_id' => 19,
		// 	'add_inq_id' => $id,
		// 	//'bd_uf_id' =>
		// 	'add_address' => $add,
		// 	'add_country' => $data['meadd1_country'][$addkey],
		// 	'add_state' => isset($data['meadd1_state'][$addkey]) ? $data['meadd1_state'][$addkey] :'',
		// 	'add_city' => isset($data['meadd1_city'][$addkey]) ? $data['meadd1_city'][$addkey] : '',
		// 	'add_area' => isset($data['meadd1_area'][$addkey]) ? $data['meadd1_area'][$addkey] : '',
		// 	'add_pin' => isset($data['meadd1_pin'][$addkey]) ? $data['meadd1_pin'][$addkey] : '',
		// 	'add_udate' => date('Y-m-d H:i:s')
		// 	);
		// $this->db->insert('tbl_uaddress',$additem);
		// }
		// }
		//***************************************
		$this->db->where('uedu_inq_id', $id);
		$this->db->where('uedu_bit', '1');
		$this->db->delete('tbl_ueducation');
		if(isset($data['meedu']) && $data['meedu'] != '')
		{
			foreach ($data['meedu'] as $meedukey => $meeduu) {
			$additem = array(
			'uedu_module_id' => 19,
			'uedu_inq_id' => $id,
			//'bd_uf_id' =>
			'uedu_education' => $meeduu,
			'uedu_subject' => $data['mesubject'][$meedukey],
			'uedu_per' => $data['meper'][$meedukey],
			'uedu_backlogs' => $data['mebacklogs'][$meedukey],
			'uedu_start' => date("Y-m-d", strtotime($data['mestart'][$meedukey])),
			'uedu_end' => date("Y-m-d", strtotime($data['meend'][$meedukey])),
			'uedu_university' => $data['meuni'][$meedukey],
			'uedu_bit' => '1',
			'uedu_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_ueducation',$additem);
			}
		}
		
		//***************************************
		$this->db->where('uexp_inq_id', $id);
		$this->db->where('uexp_bit', '1');
		$this->db->delete('tbl_uexperience');
		if(isset($data['meexp_year']) && $data['meexp_year'] != '')
		{
			foreach ($data['meexp_year'] as $meexpkey => $meexps) {
				$additem = array(
				'uexp_module_id' => 19,
				'uexp_inq_id' => $id,
				//'uexp_uf_id' =>
				'uexp_exp_years' => $meexps,
				'uexp_exp_field' => $data['meexp_field'][$meexpkey],
				'uexp_bit' => '1',
				'uexp_udate' => date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_uexperience',$additem);
			}
		}
		
		//***************************************
		$this->db->where('ul_inq_id', $id);
		$this->db->where('ul_bit', '1');
		$this->db->delete('tbl_ulanguage');
		if(isset($data['melang']) && $data['melang'] != '')
		{
			foreach ($data['melang'] as $melangkey => $melangg) {
				$melangitem = array(
					'ul_module_id' => 19,
					'ul_inq_id' => $id,
					//'ul_uf_id' =>
					'ul_lang_id' => $meeduu,
					'ul_reading' => $data['melang_read'][$melangkey],
					'ul_writing' => $data['melang_write'][$melangkey],
					'ul_listening' => $data['melang_listen'][$melangkey],
					'ul_speaking' => $data['lang_speak'][$melangkey],
					'ul_overall' => $data['melang_overall'][$melangkey],
					'ul_exp_date' => date("Y-m-d", strtotime($data['melang_expdate'][$melangkey])),
					'ul_lang_type' => $data['melang_gen'][$melangkey],
					'ul_bit' => '1',
					'ul_udate' => date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_ulanguage',$melangitem);
			}
		}
		
		//***************************************
		$this->db->where('urel_inq_id', $id);
		$this->db->where('urel_bit', '1');
		$this->db->delete('tbl_urelative');
		if(isset($data['merelname']) && $data['merelname'] != '')
		{
			foreach ($data['merelname'] as $merelkey => $merel) {
			foreach ($data['merel_forign'] as $fkey => $foreign) {
				$yes_no = $foreign;
				unset($data['merel_forign'][$fkey]);
				break;
			}
			$merel = array(
			'urel_module_id' => 19,
			'urel_inq_id' => $id,
			//'ul_uf_id' =>
			'urel_name' => $merel,
			'urel_yes_no' => isset($yes_no) ? $yes_no : '1',
			'urel_country' => $data['merelcountry'][$merelkey],
			'urel_address' => $data['mereladd'][$merelkey],
			'urel_bit' => '1',
			'urel_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_urelative',$merel);
			}
		}
		//***************************************
		if(isset($data['merefu_country']) && $data['merefu_country'] != '')
		{
			$this->db->where('urefu_inq_id', $id);
			$this->db->where('urefu_bit', '1');
			$this->db->delete('tbl_urefusal');
			foreach ($data['merefu_country'] as $merefu_cokey => $merefu_countryy) {
			$additem = array(
			'urefu_module_id' => 19,
			'urefu_inq_id' => $id,
			//'urefu_uf_id' =>
			'urefu_country' => $merefu_countryy,
			'urefu_date' => date("Y-m-d", strtotime($data['merefdate'][$merefu_cokey])),
			'urefu_category' => $data['merefu_category'][$merefu_cokey],
			'urefu_remarks' => $data['merefu_remark'][$merefu_cokey],
			'urefu_bit' => '1',
			'urefu_udate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_urefusal',$additem);
			}
		}
		//***************************************
		if(isset($data['spouseedu']) && $data['spouseedu'] != '')
		{
			$this->db->where('uedu_inq_id', $id);
			$this->db->where('uedu_bit', '2');
			$this->db->delete('tbl_ueducation');
			foreach ($data['spouseedu'] as $spedukey => $spouseedu) {
			$spouceitem = array(
			'uedu_module_id' => 19,
			'uedu_inq_id' => $id,
			//'bd_uf_id' =>
			'uedu_education' => $spouseedu,
			'uedu_subject' => $data['spousesubject'][$spedukey],
			'uedu_per' => $data['spouseper'][$spedukey],
			'uedu_backlogs' => $data['spousebacklogs'][$spedukey],
			'uedu_start' => date("Y-m-d", strtotime($data['spousestart'][$spedukey])), 
			'uedu_end' => date("Y-m-d", strtotime($data['spouseend'][$spedukey])),
			'uedu_university' => $data['spouseuni'][$spedukey],
			'uedu_bit' => '2',
			'uedu_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_ueducation',$spouceitem);
		}
		}
		//***************************************
		if(isset($data['spouseexp_year']) && $data['spouseexp_year'] != '')
		{
			$this->db->where('uexp_inq_id', $id);
			$this->db->where('uexp_bit', '2');
			$this->db->delete('tbl_uexperience');
			foreach ($data['spouseexp_year'] as $spexpkey => $spouseexp) {
			$additem = array(
			'uexp_module_id' => 19,
			'uexp_inq_id' => $id,
			//'uexp_uf_id' =>
			'uexp_exp_years' => $spouseexp,
			'uexp_exp_field' => $data['spouseexp_field'][$spexpkey],
			'uexp_bit' => '2',
			'uexp_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uexperience',$additem);
		}
		}
		//***************************************
		$this->db->where('ul_inq_id', $id);
		$this->db->where('ul_bit', '2');
		$this->db->delete('tbl_ulanguage');
		if(isset($data['spouselang']) && $data['spouselang'] != '')
		{
			foreach ($data['spouselang'] as $splangkey => $spouselang) {
			$splangitem = array(
			'ul_module_id' => 19,
			'ul_inq_id' => $id,
			//'ul_uf_id' =>
			'ul_lang_id' => $spouselang,
			'ul_reading' => $data['spouselang_read'][$splangkey],
			'ul_writing' => $data['spouselang_write'][$splangkey],
			'ul_listening' => $data['spouselang_listen'][$splangkey],
			'ul_speaking' => $data['lang_speak'][$splangkey],
			'ul_overall' => $data['spouselang_overall'][$splangkey],
			'ul_exp_date' => date("Y-m-d", strtotime($data['spouselang_expdate'][$splangkey])),
			'ul_lang_type' => $data['spouselang_gen'][$splangkey],
			'ul_bit' => '2',
			'ul_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_ulanguage',$splangitem);
		}
		}
		//***************************************
		$this->db->where('urel_inq_id', $id);
		$this->db->where('urel_bit', '2');
		$this->db->delete('tbl_urelative');
		if(isset($data['spouserelname']) && $data['spouserelname'] != '')
		{
			foreach ($data['spouserelname'] as $sprelkey => $sprel) {
			foreach ($data['spouserel_forign'] as $fkey => $foreign) {
				# code...
				$yes_no = $foreign;
				unset($data['spouserel_forign'][$fkey]);
				break;
			}
			$sprelitem = array(
			'urel_module_id' => 19,
			'urel_inq_id' => $id,
			//'ul_uf_id' =>
			'urel_yes_no' => isset($yes_no) ? $yes_no : '1',
			'urel_name' => $sprel,
			'urel_country' => $data['spouserelcountry'][$sprelkey],
			'urel_address' => $data['spousereladd'][$sprelkey],
			'urel_bit' => '2',
			'urel_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_urelative',$sprelitem);
		}
		}
		//***************************************
		$this->db->where('urefu_inq_id', $id);
		$this->db->where('urefu_bit', '2');
		$this->db->delete('tbl_urefusal');
		if(isset($data['spouserefu_country']) && $data['spouserefu_country'] != '')
		{
			foreach ($data['spouserefu_country'] as $sprefukey => $spouserefu_country) {
			$sprefuitem = array(
			'urefu_module_id' => 19,
			'urefu_inq_id' => $id,
			//'urefu_uf_id' =>
			'urefu_country' => $spouserefu_country,
			'urefu_date' => date("Y-m-d", strtotime($data['merefdate'][$sprefukey])),
			'urefu_category' => $data['merefu_category'][$sprefukey],
			'urefu_remarks' => $data['merefu_remark'][$sprefukey],
			'urefu_bit' => '2',
			'urefu_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_urefusal',$sprefuitem);
		}
		}
		//***************************************
		$this->db->where('uchild_inq_id', $id);
		$this->db->delete('tbl_uchildrens');
		if(isset($data['spousechdtl_date']) && $data['spousechdtl_date'] != '')
		{
			foreach ($data['spousechdtl_date'] as $spchdtlkey => $spousechdtl_date) {
			$sprefuitem = array(
			'uchild_module_id' => 19,
			'uchild_inq_id' => $id,
			//'urefu_uf_id' =>
			'uchild_dob' => date("Y-m-d", strtotime($spousechdtl_date)),
			'uchild_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uchildrens',$sprefuitem);
	}
		}
		//***************************************
		$this->db->where('fu_inq_id', $id);
		$this->db->delete('tbl_ufollowup');
		if(isset($data['mefu_date']) && $data['mefu_date'] != '')
		{
			foreach ($data['mefu_date'] as $fukey => $spousechdtl_date) {
				$fu = array(
				'fu_moduleid' => 19,
				'fu_inq_id' => $id,
				//'urefu_uf_id' =>
				'fu_followdate' => date("Y-m-d", strtotime($spousechdtl_date)),
				'fu_followmethod' => $data['memethod'][$fukey],
				'fu_followexe' => $data['meexec'][$fukey],
				'fu_followupst' => $data['mestatus'][$fukey],
				'fu_remark' => $data['meremrk'][$fukey],
				'fu_udate' => date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_ufollowup',$fu);
			}
		}
		
		return $id;	
	}

	public function get_pdfdata($id)
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_inquiry');
		$this->db->join('tbl_source_cat as as','as.source_cat_id = tbl_inquiry.inq_source', 'left');
		//$this->db->join('tbl_source_cat as bs', 'bs.source_main_cat  = as.source_cat_id', 'left');
		$this->db->join('tbl_inquiry_status','tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus', 'left');
		$this->db->where('inq_id', $id);
		$query = $this->db->get();
		$value['inquiry'] = $query->result_array();
	//*************************************************************
		if(!empty($value['inquiry']) && isset($value['inquiry'][0]['inq_source']) && isset($value['inquiry'][0]['inq_source']))
		{
			$this->db->select('GROUP_CONCAT(source_cat_name) AS subsource');
			$this->db->from('tbl_source_cat');
			$this->db->order_by('source_cat_name', 'desc');
			$this->db->where('source_cat_isdelete', '0');
			$this->db->where('source_main_cat', $value['inquiry'][0]['inq_source']);
			$this->db->where('source_main_cat !=', 0);
			$this->db->group_by('source_main_cat');
			$query = $this->db->get();
			$value['subsource'] = $query->result_array();
		}
	//*************************************************************
		$this->db->select('GROUP_CONCAT(inqci_countryid) AS locations,inqci_bit,tbl_country.*');
		$this->db->from('tbl_ucountryoption');
		$this->db->join('tbl_country','tbl_country.country_id = tbl_ucountryoption.inqci_countryid', 'left');
		$this->db->where('inqci_inq_id', $id);
		$this->db->group_by('inqci_bit');
		$this->db->order_by('inqci_bit', 'ASC');
		$query = $this->db->get();
		$value['ucountry'] = $query->result_array();
		//echo '<pre>';print_r($value['ucountry']);die;
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_uproduct_details');
		$this->db->join('tbl_product','tbl_product.pro_id = tbl_uproduct_details.prod_pro_id', 'left');
		//$this->db->join('tbl_product_type','tbl_product_type.prot_id = tbl_uproduct_details.prod_type_id', 'left');
		//$this->db->join('tbl_product_category','tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id', 'left');
		$this->db->where('prod_inq_id', $id);
		$query = $this->db->get();
		$value['products'] = $query->result_array();
	//*************************************************************
		if(!empty($value['products']) && isset($value['products'][0]['prod_pro_id']) && isset($value['products'][0]['prod_type_id']))
		{
			$this->db->select('GROUP_CONCAT(prot_name) AS product_type');
			$this->db->from('tbl_product_type');
			$this->db->order_by('prot_id', 'desc');
			$this->db->where('pro_is_delete', '0');
			$this->db->where('prot_pro_id', $value['products'][0]['prod_pro_id']);
			//$this->db->group_by('prot_pro_id');
			$query = $this->db->get();
			$value['prtps'] = $query->result_array();

			$this->db->select('GROUP_CONCAT(procat_name) AS product_category');
			$this->db->from('tbl_product_category');
			$this->db->order_by('procat_id', 'desc');
			$this->db->where('procat_is_delete', '0');
			$this->db->where('product_name', $value['products'][0]['prod_pro_id']);
			$this->db->where('ptype_id', $value['products'][0]['prod_type_id']);
			$this->db->group_by('ptype_id');
			$query = $this->db->get();
			$value['prcats'] = $query->result_array();
		}else{
			$value['prtps'] = array();
			$value['prcats'] = array();
		}
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_ubasic_details');
		$this->db->where('bd_inq_id', $id);
		$query = $this->db->get();
		$value['basic_details'] = $query->result_array();
	//*************************************************************
		$this->db->select('GROUP_CONCAT(up_pp_no) AS passport');
		$this->db->from('tbl_upassport');
		$this->db->where('up_inq_id', $id);
		$this->db->group_by('up_bit');
		$query = $this->db->get();
		$value['passport'] = $query->result_array();
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_uaddress');
		$this->db->where('add_inq_id', $id);
		$query = $this->db->get();
		$value['address'] = $query->result_array();
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_ucontact_nos');
		$this->db->where('con_no_inq_id', $id);
		$query = $this->db->get();
		$value['contact'] = $query->result_array();	
    //*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_urefusal');
		$this->db->where('urefu_inq_id', $id);
		$query = $this->db->get();
		$value['urefu'] = $query->result_array();
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_urelative');
		$this->db->where('urel_inq_id', $id);
		$query = $this->db->get();
		$value['urel'] = $query->result_array();	
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_ueducation');
		$this->db->where('uedu_inq_id', $id);
		$query = $this->db->get();
		$value['uedu'] = $query->result_array();
	//*************************************************************
		$this->db->select('*');
		$this->db->from('tbl_uexperience');
		$this->db->where('uexp_inq_id', $id);
		$query = $this->db->get();
		$value['uexp'] = $query->result_array();
		return $value;	
	}
	
	public function get($id)
	{
		$value = array();
		$this->db->select('tbl_inquiry.*');
		$this->db->from('tbl_inquiry');
		// $this->db->join('tbl_source_cat as as','as.source_cat_id = tbl_inquiry.inq_source', 'left');
		// $this->db->join('tbl_source_cat as bs', 'bs.source_main_cat  = as.source_cat_id', 'left');
		$this->db->join('tbl_inquiry_status','tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus', 'left');
		$this->db->where('inq_id', $id);
		
		$query = $this->db->get();
		$value['inquiry'] = $query->result_array();
		//echo "<pre>";print_r($query->result_array());die;

		$this->db->select('GROUP_CONCAT(inqci_countryid) AS locations,inqci_bit');
		$this->db->from('tbl_ucountryoption');
		$this->db->where('inqci_inq_id', $id);
		$this->db->group_by('inqci_bit');
		$this->db->order_by('inqci_bit', 'ASC');
		$query = $this->db->get();
		$value['ucountry'] = $query->result_array();
		//echo '<pre>';print_r($value['ucountry']);die;

		$this->db->select('tbl_product_category.procat_id,  tbl_product_category.procat_name, tbl_product_type.prot_id, tbl_product_type.prot_name, tbl_product.pro_id, tbl_product.pro_name, tbl_uproduct_details.*');
		$this->db->from('tbl_uproduct_details');
		$this->db->join('tbl_product','tbl_product.pro_id = tbl_uproduct_details.prod_pro_id', 'left');
		$this->db->join('tbl_product_type','tbl_product_type.prot_id = tbl_uproduct_details.prod_type_id', 'left');
		$this->db->join('tbl_product_category','tbl_product_category.procat_id = tbl_uproduct_details.prod_cat_id', 'left');
		$this->db->where('prod_inq_id', $id);
		$query = $this->db->get();
		$value['products'] = $query->result_array();

		if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && !empty($value['products']) && isset($value['products'][0]['prod_pro_id']) && isset($value['products'][0]['prod_type_id']))
		{

			$this->db->select('*');
			$this->db->from('tbl_product_type');
			$this->db->order_by('prot_id', 'desc');
			$this->db->where('pro_is_delete', '0');
			$this->db->where('prot_pro_id', $value['products'][0]['prod_pro_id']);
			$query = $this->db->get();
			$value['prtps'] = $query->result_array();
//echo "<pre>"; print_r($value['prtps']); die;
			$this->db->select('*');
			$this->db->from('tbl_product_category');
			$this->db->order_by('procat_id', 'desc');
			$this->db->where('procat_is_delete', '0');
			//$this->db->where('product_name', $value['products'][0]['prod_pro_id']);
			$this->db->where('ptype_id', $value['products'][0]['prod_type_id']);
			$query = $this->db->get();
			$value['prcats'] = $query->result_array();
			//echo "<pre>"; print_r($value['prcats']); die;
		}else{
			$value['prtps'] = array();
			$value['prcats'] = array();
		}

		if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && !empty($value['inquiry']) && isset($value['inquiry'][0]['inq_source']) && isset($value['inquiry'][0]['inq_source']))
		{

			$this->db->select('*');
			$this->db->from('tbl_source_cat');
			$this->db->order_by('source_cat_name', 'desc');
			$this->db->where('source_cat_isdelete', '0');
			$this->db->where('source_main_cat', $value['inquiry'][0]['inq_source']);
			$this->db->where('source_main_cat !=', 0);
			$query = $this->db->get();
			$value['subsource'] = $query->result_array();
			//echo "<pre>"; print_r($value['subsource']); die;
		}

		$this->db->select('*');
		$this->db->from('tbl_ubasic_details');
		$this->db->where('bd_inq_id', $id);
		$query = $this->db->get();
		$value['basic_details'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_upassport');
		$this->db->where('up_inq_id', $id);
		$query = $this->db->get();
		$value['passport'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_uaddress');
		$this->db->where('add_inq_id', $id);
		$query = $this->db->get();
		$value['address'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_ucontact_nos');
		$this->db->where('con_no_inq_id', $id);
		$query = $this->db->get();
		$value['contact'] = $query->result_array();	

		$this->db->select('*');
		$this->db->from('tbl_urefusal');
		$this->db->where('urefu_inq_id', $id);
		$query = $this->db->get();
		$value['urefu'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_urelative');
		$this->db->where('urel_inq_id', $id);
		$query = $this->db->get();
		$value['urel'] = $query->result_array();	

		$this->db->select('uedu_inq_id,uedu_id,uedu_full_education');
		$this->db->from('tbl_ueducation');
		$this->db->where('uedu_inq_id', $id);
		$query = $this->db->get();
		$value['uedu'] = $query->result_array();
		//echo "<pre>"; print_r($value); die;

		return $value;
	}

	public function get_inquiry_count()
	{
		$query = $this->get_inquiry_query();
		$value = $query->row_array();
		//echo "<pre>";print_r($value);die;
		return $value['totalcount'];
	}

	public function get_inquiry_query($Start = false,$length = false)
	{
		//echo $Start.'--------'.$length;//die;
		if($length == false && $Start == false)
		{
			$this->db->select('COUNT(inq.inq_id) as totalcount');
		}else{
			//echo 'yess'; echo $Start.'--------'.$length;
			$this->db->select('*,source.source_cat_name as source_name,subsource.source_cat_name as subsource_name');
		}
		$this->db->from('tbl_inquiry as inq');
		$this->db->join('tbl_admin_users','inq.inq_au_id = tbl_admin_users.au_id','left');
		$this->db->join('tbl_ubasic_details','inq.inq_id = tbl_ubasic_details.bd_inq_id','left');
		//$this->db->join('tbl_uaddress','inq.inq_id = tbl_uaddress.add_inq_id','left');
		//$this->db->join('tbl_master_city','tbl_master_city.city_id = tbl_uaddress.add_city','left');
		$this->db->join('tbl_ucontact_nos','inq.inq_id = tbl_ucontact_nos.con_no_inq_id','left');
		$this->db->join('tbl_inquiry_type','inq.inq_type = tbl_inquiry_type.inquiry_type_id','left');
		$this->db->join('tbl_inquiry_status','inq.inq_inqstatus = tbl_inquiry_status.inquiry_status_id','left');
		$this->db->join('tbl_uproduct_details','inq.inq_id = tbl_uproduct_details.prod_inq_id','left');
		$this->db->join('tbl_product_type','tbl_uproduct_details.prod_type_id = tbl_product_type.prot_id','left');
		$this->db->join('tbl_product_category','tbl_uproduct_details.prod_cat_id = tbl_product_category.procat_id','left');
		$this->db->join('tbl_source_cat as source','inq.inq_source = source.source_cat_id','left');
		$this->db->join('tbl_source_cat as subsource','inq.inq_subsource = subsource.source_cat_id','left');
		$this->db->where('inq.inq_isdelete','0');
		$this->db->where('bd_bit',1);
		$this->db->order_by('inq_date','desc');
		if($this->input->post('inq_start_date') && $this->input->post('inq_start_date') != ''){
			$start_date = date("Y-m-d", strtotime($this->input->post('inq_start_date')));
			$this->db->where('inq.inq_date >=', $start_date);
		}
		if($this->input->post('inq_end_date') && $this->input->post('inq_end_date') != ''){
			$end_date = date("Y-m-d", strtotime($this->input->post('inq_end_date')));
			$this->db->where('inq.inq_date <=', $end_date);
		}

		if(isset($this->session->userdata['inq_forn']['inq_type']) && $this->session->userdata['inq_forn']['inq_type'] != ''){
			$this->db->where('inq.inq_type', $this->session->userdata['inq_forn']['inq_type']);
		}
		/*if($this->input->post('inq_type') && $this->input->post('inq_type') != ''){
			$this->db->where('tbl_inquiry_type.inquiry_type_id', $this->input->post('inq_type'));
		}*/
		//echo '<pre>';print_r($this->input->post('inq_type'));die;
		if(isset($this->session->userdata['inq_forn']['fname']) && $this->session->userdata['inq_forn']['fname'] != ''){
			$this->db->like('tbl_ubasic_details.bd_fname', $this->session->userdata['inq_forn']['fname']);
		}
		if(isset($this->session->userdata['inq_forn']['lname']) && $this->session->userdata['inq_forn']['lname'] != ''){
			$this->db->like('tbl_ubasic_details.bd_lname', $this->session->userdata['inq_forn']['lname']);
		}
		if(isset($this->session->userdata['inq_forn']['clientname']) && $this->session->userdata['inq_forn']['clientname'] != ''){
			$this->db->like('tbl_ubasic_details.bd_fullname', $this->session->userdata['inq_forn']['clientname']);
		}
		if(isset($this->session->userdata['inq_forn']['companyname']) && $this->session->userdata['inq_forn']['companyname'] != ''){
			$this->db->like('tbl_ubasic_details.bd_company_name', $this->session->userdata['inq_forn']['companyname']);
		}
		if(isset($this->session->userdata['inq_forn']['product_type']) && $this->session->userdata['inq_forn']['product_type'] != ''){
		$this->db->where('tbl_uproduct_details.prod_type_id', $this->session->userdata['inq_forn']['product_type']);
		}
		if(isset($this->session->userdata['inq_forn']['category']) && $this->session->userdata['inq_forn']['category'] != ''){
			$this->db->where('tbl_uproduct_details.prod_cat_id', $this->session->userdata['inq_forn']['category']);
		}
		
		if(isset($this->session->userdata['inq_forn']['status']) && $this->session->userdata['inq_forn']['status'] != ''){
			$this->db->where('inq.inq_inqstatus', $this->session->userdata['inq_forn']['status']);
		}
		if(isset($this->session->userdata['inq_forn']['cno']) && $this->session->userdata['inq_forn']['cno'] != ''){
			$this->db->like('tbl_ucontact_nos.con_no_mnos', $this->session->userdata['inq_forn']['cno']);
		}
		// if(isset($this->session->userdata['inq_forn']['age']) && $this->session->userdata['inq_forn']['age'] != ''){
		// 	$this->db->like('tbl_ubasic_details.bd_age', $this->session->userdata['inq_forn']['age']);
		// }
		if(isset($this->session->userdata['inq_forn']['executive']) && $this->session->userdata['inq_forn']['executive'] != ''){
			$this->db->like('tbl_admin_users.au_fname', $this->session->userdata['inq_forn']['executive']);
		}
		if(isset($this->session->userdata['inq_forn']['source']) && $this->session->userdata['inq_forn']['source'] != ''){
			$this->db->like('source.source_cat_name', $this->session->userdata['inq_forn']['source']);
		}
		if(isset($this->session->userdata['inq_forn']['subsource']) && $this->session->userdata['inq_forn']['subsource'] != ''){
			$this->db->like('subsource.source_cat_name', $this->session->userdata['inq_forn']['subsource']);
		}
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('inq.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		//***************************** Post for Report ----------------------------
		if($length == false && $Start == false)
		{
			//echo 'nooo'; echo $Start.'--------'.$length;
			//
		}else{
			//echo 'yess'; echo $Start.'--------'.$length;
			$this->db->limit($length,$Start);
		}
		return $query = $this->db->get();
	}

	public function get_inquiry($Start,$length)
	{
		$query = $this->get_inquiry_query($Start,$length);
		//$value['inquirys'] = $query->result_array();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

//************************************** REPORT START ********************************************************
//************************************************************************************************************
	public function get_inquiry_report_count()
	{
		$query = $this->get_inquiry_report_query();
		$value = $query->row_array();
		//echo "<pre>";print_r($value);die;
		return $value['totalcount'];
	}
	public function get_inquiry_report_query($Start = false,$length = false)
	{
		//$value = array();
		if($length == false && $Start == false)
		{
			$this->db->select('COUNT(tbl_inquiry.inq_id) as totalcount');
		}else{
			//echo 'yess'; echo $Start.'--------'.$length;
			$this->db->select('*');
		}
		$this->db->from('tbl_inquiry');
		$this->db->join('tbl_admin_users','tbl_inquiry.inq_au_id = tbl_admin_users.au_id','left');
		$this->db->join('tbl_ubasic_details','tbl_inquiry.inq_id = tbl_ubasic_details.bd_inq_id','left');
		//$this->db->join('tbl_uaddress','tbl_inquiry.inq_id = tbl_uaddress.add_inq_id','left');
		//$this->db->join('tbl_master_city','tbl_master_city.city_id = tbl_uaddress.add_city','left');
		$this->db->join('tbl_ucontact_nos','tbl_inquiry.inq_id = tbl_ucontact_nos.con_no_inq_id','left');
		$this->db->join('tbl_inquiry_type','tbl_inquiry.inq_type = tbl_inquiry_type.inquiry_type_id','left');
		$this->db->join('tbl_inquiry_status','tbl_inquiry.inq_inqstatus = tbl_inquiry_status.inquiry_status_id','left');
		$this->db->join('tbl_uproduct_details','tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id','left');
		$this->db->join('tbl_product_type','tbl_uproduct_details.prod_type_id = tbl_product_type.prot_id','left');
		$this->db->join('tbl_product_category','tbl_uproduct_details.prod_cat_id = tbl_product_category.procat_id','left');
		$this->db->join('tbl_source_cat','tbl_inquiry.inq_source = tbl_source_cat.source_cat_id','left');
		//$this->db->join('tbl_source_cat','tbl_inquiry.inq_source = tbl_source_cat.source_cat_id');
		//$this->db->join('tbl_source_cat','tbl_inquiry.inq_subsource = tbl_source_cat.source_cat_id','left');
		$this->db->where('tbl_inquiry.inq_isdelete','0');
		$this->db->where('bd_bit',1);
		$this->db->order_by('inq_date','desc');
		if($this->input->get('inq_start_date') && $this->input->get('inq_start_date') != ''){
			$start_date = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
			$this->db->where('tbl_inquiry.inq_date >=', $start_date);
		}
		if($this->input->get('inq_end_date') && $this->input->get('inq_end_date') != ''){
			$end_date = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
			$this->db->where('tbl_inquiry.inq_date <=', $end_date);
		}
		if($this->input->get('product_type') && $this->input->get('product_type') != ''){
			if($this->input->get('product_type') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_uproduct_details.prod_type_id', 0);
			}else{
				$this->db->where('tbl_product_type.prot_id', $this->input->get('product_type'));
			}
			
		}
		if($this->input->get('Product_Category') && $this->input->get('Product_Category') != ''){
			if($this->input->get('Product_Category') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_uproduct_details.prod_cat_id', 0);
			}else{
				$this->db->where('tbl_product_category.procat_id', $this->input->get('Product_Category'));
			}
		}
		if($this->input->get('inq_Status') && $this->input->get('inq_Status') != ''){
			if($this->input->get('inq_Status') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_inquiry.inq_inqstatus', 0);
			}else{
				$this->db->where('tbl_inquiry_status.inquiry_status_id', $this->input->get('inq_Status'));
			}
		}
		if($this->input->get('Executive') && $this->input->get('Executive') != ''){
			if($this->input->get('Executive') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_inquiry.inq_au_id', 0);
			}else{
				$this->db->where('tbl_admin_users.au_id', $this->input->get('Executive'));
			}
			
		}
		if($this->input->get('inq_Type') && $this->input->get('inq_Type') != ''){
			if($this->input->get('inq_Type') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_inquiry.inq_type', 0);
			}else{
				$this->db->where('tbl_inquiry.inq_type', $this->input->get('inq_Type'));
			}
		}
		if($this->input->get('Source') && $this->input->get('Source') != ''){
			if($this->input->get('Source') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_inquiry.inq_source', 0);
			}else{
				$this->db->where('tbl_source_cat.source_cat_id', $this->input->get('Source'));
			}
		}
		if($this->input->get('Sub_Source') && $this->input->get('Sub_Source') != ''){
			if($this->input->get('Sub_Source') == -1){
				//echo "hi"; die;
				$this->db->where('tbl_inquiry.inq_subsource', 0);
			}else{
				$this->db->where('tbl_inquiry.inq_subsource', $this->input->get('Sub_Source'));
			}
			
		}
	//****************************************************	
		if($this->input->post('inq_date') && $this->input->post('inq_date') != ''){
			$this->db->where('tbl_inquiry.inq_date', date("Y-m-d", strtotime($this->input->post('inq_date'))));
		}
		if($this->input->post('inq_type') && $this->input->post('inq_type') != ''){
			$this->db->where('tbl_inquiry_type.inquiry_type_name', $this->input->post('inq_type'));
		}
		if($this->input->post('fname') && $this->input->post('fname') != ''){
			$this->db->like('tbl_ubasic_details.bd_fname', $this->input->post('fname'));
		}
		if($this->input->post('lname') && $this->input->post('lname') != ''){
			$this->db->like('tbl_ubasic_details.bd_lname', $this->input->post('lname'));
		}
		if($this->input->post('clientname') && $this->input->post('clientname') != ''){
			$this->db->like('tbl_ubasic_details.bd_fullname', $this->input->post('clientname'));
		}
		if($this->input->post('companyname') && $this->input->post('companyname') != ''){
			$this->db->like('tbl_ubasic_details.bd_company_name', $this->input->post('companyname'));
		}
		if($this->input->post('mno') && $this->input->post('mno') != ''){
			$this->db->where('tbl_ucontact_nos.con_no_mnos', $this->input->post('mno'));
		}
		if($this->input->post('ptype') && $this->input->post('ptype') != ''){
			$this->db->where('tbl_product_type.prot_name', $this->input->post('ptype'));
		}
		if($this->input->post('category') && $this->input->post('category') != ''){
			$this->db->where('tbl_product_category.procat_name', $this->input->post('category'));
		}
		if($this->input->post('status') && $this->input->post('status') != ''){
			$this->db->where('tbl_inquiry_status.inquiry_status_name', $this->input->post('status'));
		}
		if($this->input->post('executive') && $this->input->post('executive') != ''){
			$this->db->where('tbl_admin_users.au_fname', $this->input->post('executive'));
		}
		if($this->input->post('source') && $this->input->post('source') != ''){
			$this->db->where('tbl_source_cat.source_cat_name', $this->input->post('source'));
		}
		if($this->input->post('subsource') && $this->input->post('subsource') != ''){
			$this->db->where('tbl_source_cat.source_cat_name', $this->input->post('subsource'));
		}
		if($this->input->post('age') && $this->input->post('age') != ''){
			$this->db->where('tbl_ubasic_details.bd_age', $this->input->post('age'));
		}
		if($this->input->post('remark') && $this->input->post('remark') != ''){
			$this->db->where('tbl_ubasic_details.bd_remark', $this->input->post('remark'));
		}
		//inq_au_id
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		
		if($length == false && $Start == false)
		{
			//echo 'nooo'; echo $Start.'--------'.$length;
			//
		}else{
			//echo 'yess'; echo $Start.'--------'.$length;
			$this->db->limit($length,$Start);
		}
		return $query = $this->db->get();
	}
	public function get_inquiry_report($Start,$length)
	{
		$query = $this->get_inquiry_report_query($Start,$length);
		//$value['inquirys'] = $query->result_array();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
//************************************** REPORT END ****************************************************************
//************************************************************************************************************
//************************************** STATUS START ****************************************************************
public function get_inquiry_status_count()
	{
		$query = $this->get_inquiry_status_query();
		$value = $query->row_array();
		//echo "<pre>";print_r($value);die;
		return $value['totalcount'];
	}
	public function get_inquiry_status_query($Start = false,$length = false)
	{
		//$value = array();
		if($length == false && $Start == false)
		{
			$this->db->select('COUNT(tbl_inquiry.inq_id) as totalcount');
		}else{
			//echo 'yess'; echo $Start.'--------'.$length;
			$this->db->select('*');
		}
		$this->db->from('tbl_inquiry');
		$this->db->join('tbl_admin_users','tbl_inquiry.inq_au_id = tbl_admin_users.au_id','left');
		$this->db->join('tbl_ubasic_details','tbl_inquiry.inq_id = tbl_ubasic_details.bd_inq_id','left');
		$this->db->join('tbl_ucontact_nos','tbl_inquiry.inq_id = tbl_ucontact_nos.con_no_inq_id','left');
		$this->db->join('tbl_inquiry_type','tbl_inquiry.inq_type = tbl_inquiry_type.inquiry_type_id','left');
		$this->db->join('tbl_inquiry_status','tbl_inquiry.inq_inqstatus = tbl_inquiry_status.inquiry_status_id','left');
		$this->db->join('tbl_uproduct_details','tbl_inquiry.inq_id = tbl_uproduct_details.prod_inq_id','left');
		$this->db->join('tbl_product_type','tbl_uproduct_details.prod_type_id = tbl_product_type.prot_id','left');
		$this->db->join('tbl_product_category','tbl_uproduct_details.prod_cat_id = tbl_product_category.procat_id','left');
		$this->db->join('tbl_source_cat','tbl_inquiry.inq_source = tbl_source_cat.source_cat_id','left');
		//$this->db->join('tbl_source_cat','tbl_inquiry.inq_source = tbl_source_cat.source_cat_id');
		//$this->db->join('tbl_source_cat','tbl_inquiry.inq_subsource = tbl_source_cat.source_cat_id','left');
		$this->db->where('bd_bit',1);
		$this->db->where('tbl_inquiry_status.inquiry_status_id',3);
		// $this->db->order_by('inq_id','desc');
		// if($this->input->get('inq_start_date') && $this->input->get('inq_start_date') != ''){
		// 	$start_date = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
		// 	$this->db->where('tbl_inquiry.inq_date >=', $start_date);
		// }
		// if($this->input->get('inq_end_date') && $this->input->get('inq_end_date') != ''){
		// 	$end_date = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
		// 	$this->db->where('tbl_inquiry.inq_date <=', $end_date);
		// }
		// if($this->input->get('product_type') && $this->input->get('product_type') != ''){
		// 	$this->db->where('tbl_product_type.prot_id', $this->input->get('product_type'));
		// }
		// if($this->input->get('Product_Category') && $this->input->get('Product_Category') != ''){
		// 	$this->db->where('tbl_product_category.procat_id', $this->input->get('Product_Category'));
		// }
		// if($this->input->get('inq_Status') && $this->input->get('inq_Status') != ''){
		// 	$this->db->where('tbl_inquiry_status.inquiry_status_id', $this->input->get('inq_Status'));
		// }
		// if($this->input->get('Executive') && $this->input->get('Executive') != ''){
		// 	$this->db->where('tbl_admin_users.au_id', $this->input->get('Executive'));
		// }
		// if($this->input->get('inq_Type') && $this->input->get('inq_Type') != ''){
		// 	$this->db->where('tbl_inquiry_type.inquiry_type_id', $this->input->get('inq_Type'));
		// }
		// if($this->input->get('Source') && $this->input->get('Source') != ''){
		// 	$this->db->where('tbl_source_cat.source_cat_id', $this->input->get('Source'));
		// }
		// if($this->input->get('Sub_Source') && $this->input->get('Sub_Source') != ''){
		// 	$this->db->where('tbl_inquiry.inq_subsource', $this->input->get('Sub_Source'));
		// }
		// if($this->input->post('ptype') && $this->input->post('ptype') != ''){
		// 	$this->db->where('tbl_product_type.prot_name', $this->input->post('ptype'));
		// }
		// if($this->input->post('inq_date') && $this->input->post('inq_date') != ''){
		// 	$this->db->where('tbl_inquiry.inq_date', date("Y-m-d", strtotime($this->input->post('inq_date'))));
		// }
		// if($this->input->post('inq_type') && $this->input->post('inq_type') != ''){
		// 	$this->db->where('tbl_inquiry_type.inquiry_type_name', $this->input->post('inq_type'));
		// }
		if($this->input->post('fname') && $this->input->post('fname') != ''){
			$this->db->like('tbl_ubasic_details.bd_fname', $this->input->post('fname'));
		}
		if($this->input->post('clientname') && $this->input->post('clientname') != ''){
			$this->db->like('tbl_ubasic_details.bd_fullname', $this->input->post('clientname'));
		}
		if($this->input->post('category') && $this->input->post('category') != ''){
			$this->db->where('tbl_product_category.procat_name', $this->input->post('category'));
		}
		if($this->input->post('lname') && $this->input->post('lname') != ''){
			$this->db->like('tbl_ubasic_details.bd_lname', $this->input->post('lname'));
		}
		if($this->input->post('status') && $this->input->post('status') != ''){
			$this->db->where('tbl_inquiry_status.inquiry_status_name', $this->input->post('status'));
		}
		
		if($this->input->post('cno') && $this->input->post('cno') != ''){
			$this->db->where('tbl_ucontact_nos.con_no_mnos', $this->input->post('cno'));
		}
		if($this->input->post('age') && $this->input->post('age') != ''){
			$this->db->where('tbl_ubasic_details.bd_age', $this->input->post('age'));
		}
		if($this->input->post('remark') && $this->input->post('remark') != ''){
			$this->db->where('tbl_ubasic_details.bd_remark', $this->input->post('remark'));
		}
		//inq_au_id
		if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
		{
			$this->db->where('tbl_inquiry.inq_au_id', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
		}
		
		if($length == false && $Start == false)
		{
			//echo 'nooo'; echo $Start.'--------'.$length;
			//
		}else{
			//echo 'yess'; echo $Start.'--------'.$length;
			$this->db->limit($length,$Start);
		}
		return $query = $this->db->get();
	}
	public function get_inquiry_status($Start,$length)
	{
		$query = $this->get_inquiry_status_query($Start,$length);
		//$value['inquirys'] = $query->result_array();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function get_all_master_status()
	{
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_current_status');
		$this->db->order_by('cs_id', 'desc');
		$this->db->where('cs_is_delete', '0');
		$query = $this->db->get();
		$value['cstates'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_inquiry_type');
		$this->db->order_by('inquiry_type_id', 'desc');
		$this->db->where('inquiry_type_isdelete', '0');
		$query = $this->db->get();
		$value['inquirys'] = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sources'] = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat !=', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sub_sources'] = $query->result_array();

		
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status');
		$this->db->order_by('inquiry_status_id', 'desc');
		$this->db->where('inquiry_status_isdelete', '0');
		$query = $this->db->get();
		$value['inqst'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->order_by('country_order', 'ASC');
		$this->db->where('country_isdelete', '0');
		$query = $this->db->get();
		$value['countrys'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->order_by('pro_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['prds'] = $query->result_array();

		$value['prtps'] = array();
		$value['prcats'] = array();

		$this->db->select('*');
		$this->db->from('tbl_net_worth');
		$this->db->order_by('nw_id', 'desc');
		$this->db->where('nw_is_delete', '0');
		$query = $this->db->get();
		$value['networth'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->order_by('au_id', 'desc');
		$this->db->where('au_is_delete', '0');
		$this->db->where_in('au_adt_id', array(3,1));
		$query = $this->db->get();
		$value['users'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->order_by('prot_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['ptypes'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->order_by('procat_id', 'desc');
		$this->db->where('procat_is_delete', '0');
		$query = $this->db->get();
		$value['pcats'] = $query->result_array();
		return $value;
		
	}
	public function delete($id)
	{
		$this->db->set('inq_isdelete', '1');
		$this->db->where('inq_id',$id);
		$this->db->update('tbl_inquiry');
		return $id;
	}
	public function delete_inq_order($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status_log');
		$this->db->where('inq_st_o_id',$id);
		$this->db->delete(tbl_inquiry_status_log);
		return $id;
	}

	public function get_all_master()
	{	
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_current_status');
		$this->db->order_by('cs_id', 'desc');
		$this->db->where('cs_is_delete', '0');
		$query = $this->db->get();
		$value['cstates'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_inquiry_type');
		$this->db->order_by('inquiry_type_id', 'desc');
		$this->db->where('inquiry_type_isdelete', '0');
		$query = $this->db->get();
		$value['inquirys'] = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sources'] = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat !=', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sub_sources'] = $query->result_array();

		
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status');
		$this->db->order_by('inquiry_status_id', 'desc');
		$this->db->where('inquiry_status_isdelete', '0');
		$query = $this->db->get();
		$value['inqst'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->order_by('country_order', 'ASC');
		$this->db->where('country_isdelete', '0');
		$query = $this->db->get();
		$value['countrys'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->order_by('pro_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['prds'] = $query->result_array();

		$value['prtps'] = array();
		$value['prcats'] = array();

		$this->db->select('*');
		$this->db->from('tbl_net_worth');
		$this->db->order_by('nw_id', 'desc');
		$this->db->where('nw_is_delete', '0');
		$query = $this->db->get();
		$value['networth'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->order_by('au_id', 'desc');
		$this->db->where('au_is_delete', '0');
		$this->db->where_in('au_adt_id', array(3,1));
		$query = $this->db->get();
		$value['users'] = $query->result_array();

		$this->db->select('rightst_typeid as ptype');
		$this->db->from('tbl_rights_type');
		$rightsid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['rightsid']);
		$this->db->where('rightst_rights_id', $rightsid);
		$query = $this->db->get();
		$ptype_rights = $query->result_array();
		$ptype_rights = array_column($ptype_rights, 'ptype');
		//echo '<pre>';print_r($ptype_rights);die;

		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->order_by('prot_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$typeid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
		if($typeid != 3)
		{
			$this->db->where_in('prot_id', $ptype_rights);
		}
		$query = $this->db->get();
		$value['ptypes'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->order_by('procat_id', 'desc');
		$this->db->where('procat_is_delete', '0');
		$query = $this->db->get();
		$value['pcats'] = $query->result_array();
		return $value;
	}
	
	public function get_all_masters()
	{	
		$value = array();
		$this->db->select('*');
		$this->db->from('tbl_inquiry_type');
		$this->db->order_by('inquiry_type_id', 'desc');
		$this->db->where('inquiry_type_isdelete', '0');
		$query = $this->db->get();
		$value['inquirys'] = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sources'] = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->order_by('source_cat_id', 'desc');
		$this->db->where('source_main_cat !=', 0);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sub_sources'] = $query->result_array();

		
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status');
		$this->db->order_by('inquiry_status_id', 'desc');
		$this->db->where('inquiry_status_isdelete', '0');
		$query = $this->db->get();
		$value['inqst'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->order_by('country_id', 'desc');
		$this->db->where('country_isdelete', '0');
		$query = $this->db->get();
		$value['countrys'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->order_by('pro_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['prds'] = $query->result_array();

		$value['prtps'] = array();
		$value['prcats'] = array();

		$this->db->select('*');
		$this->db->from('tbl_net_worth');
		$this->db->order_by('nw_id', 'desc');
		$this->db->where('nw_is_delete', '0');
		$query = $this->db->get();
		$value['networth'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->order_by('au_id', 'desc');
		$this->db->where('au_is_delete', '0');
		$query = $this->db->get();
		$value['users'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->order_by('prot_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['ptypes'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->order_by('procat_id', 'desc');
		$this->db->where('procat_is_delete', '0');
		$query = $this->db->get();
		$value['pcats'] = $query->result_array();
		return $value;
	}
	public function get_reset()
	{
		$this->session->unset_userdata('inq_forn');
	}

	public function get_ptype()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->where('prot_pro_id', $this->input->post('prod_id'));
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_pcate()
	{
		//echo "<pre>"; print_r($this->input->post('prdID')); die;

		$this->db->select('rightsc_catid as pcat');
		$this->db->from('tbl_rights_category');
		$rightsid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['rightsid']);
		$this->db->where('rightsc_rights_id', $rightsid);
		$query = $this->db->get();
		$pcat_rights = $query->result_array();
		$pcat_rights = array_column($pcat_rights, 'pcat');

		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->where('ptype_id', $this->input->post('type_id'));
		//$this->db->where('product_name', $this->input->post('prdID'));
		$this->db->where('procat_is_delete', '0');
		$typeid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
		if($typeid != 3)
		{
			$this->db->where_in('procat_id', $pcat_rights);
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_prcate()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->where('ptype_id', $this->input->post('type_id'));
		$this->db->where('procat_is_delete', '0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function get_srctype()
	{
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->where('source_main_cat', $this->input->post('src_id'));
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_sub_sorce($sub)
	{
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->where_in('source_cat_id',$sub);
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$home_string = $query->result_array();
		//echo "<pre>"; print_r($home_string); die;
		$value = array();
		foreach($home_string as $home_stringg)
		{
			$value[] = $home_stringg['source_cat_name'];
			
			// $home;
		} //die;
		$home = implode("," ,$value);
		return $home;
	}

	public function get_uedu($id,$bit)
	{
		$this->db->select('*');
		$this->db->from('tbl_ueducation');
		$this->db->where('uedu_inq_id', $id);
		$this->db->where('uedu_bit', $bit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_ulang($id,$bit)
	{
		$this->db->select('*');
		$this->db->from('tbl_ulanguage');
		$this->db->where('ul_inq_id', $id);
		$this->db->where('ul_bit', $bit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_uexp($id,$bit)
	{
		$this->db->select('*');
		$this->db->from('tbl_uexperience');
		$this->db->where('uexp_inq_id', $id);
		$this->db->where('uexp_bit', $bit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_urefusal($id,$bit)
	{
		$this->db->select('*');
		$this->db->from('tbl_urefusal');
		$this->db->where('urefu_inq_id', $id);
		$this->db->where('urefu_bit', $bit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_uaddress($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_uaddress');
		$this->db->where('add_inq_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_uaddstate($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_state');
		$this->db->where('state_country', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_uaddcity($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_city');
		$this->db->where('city_state', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_uaddarea($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_master_area');
		$this->db->where('area_city', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_urel($id,$bit)
	{
		$this->db->select('*');
		$this->db->from('tbl_urelative');
		$this->db->where('urel_inq_id', $id);
		$this->db->where('urel_bit', $bit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_uchild($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_uchildrens');
		$this->db->where('uchild_inq_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_ufollowup($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_ufollowup');
		$this->db->join('tbl_followup_status', 'tbl_followup_status.inqfus_id = tbl_ufollowup.fu_followupst');
		$this->db->where('fu_inq_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function inq_st_log($data)
	{
		
		//foreach($this->input->get('delid') as $stu){
			//echo '<pre>';print_r($this->input->get());die;
		$status = array(
				//'inq_st_o_inq_id' => $stu,
				  'inq_st_o_bill_no' => $data['inq_st_o_bill_no'],
				  'inq_st_o_bill_dt' => date("Y-m-d", strtotime( $data['inq_st_o_bill_dt'])),
				  'inq_st_o_chln_no' => $data['inq_st_o_chln_no'],
				  'inq_st_o_chln_dt' => date("Y-m-d", strtotime($data['inq_st_o_chln_dt'])),
				  'inq_st_o_rcvd_amt' => $data['inq_st_o_rcvd_amt'],
				  'inq_st_o_cdate' => date('Y-m-d H:i:s'),
				  'inq_st_o_udate' => date('Y-m-d H:i:s')	
			);
			//echo '<pre>';print_r($status);die;
		$this->db->insert('tbl_inquiry_status_log',$status);
		//}
		//die;
	}
	public function edit_status($data,$id)
	{ 
		$item = array(
				//'inq_st_o_inq_id' => $stu,
				  'inq_st_o_bill_no' => $data['inq_st_o_bill_no'],
				  'inq_st_o_bill_dt' => date("Y-m-d", strtotime( $data['inq_st_o_bill_dt'])),
				  'inq_st_o_chln_no' => $data['inq_st_o_chln_no'],
				  'inq_st_o_chln_dt' => date("Y-m-d", strtotime($data['inq_st_o_chln_dt'])),
				  'inq_st_o_rcvd_amt' => $data['inq_st_o_rcvd_amt'],
				  'inq_st_o_cdate' => date('Y-m-d H:i:s'),
			);
		$this->db->where('inq_st_o_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_inquiry_status_log', $item);
		return $id;	
	}
	public function get_inq_order()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry_status_log');
		$this->db->order_by('inq_st_o_id', 'asc');
		
		// if($this->input->post('country_name') && ($this->input->post('country_name') != ''))
  //       {
  //          $this->db->like('country_name', $this->input->post('country_name'));   
  //       }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	

	public function importcsvv($data) 
	{
		die;
		if(isset($data['degree']) && $data['degree'] != ''){
			$this->db->select('*');
			$this->db->from('tbl_education');
			//$this->db->where('inquiry_type_name',$data['inqtype']);
			$this->db->where('LOWER(edu_name)', strtolower($data['degree']));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				$deg = array(
						'edu_name' => $data['degree'],
						'edu_cdate' => date('Y-m-d')
				);
			$this->db->insert('tbl_education',$deg);
			}
			
		}
	}

	public function importcsv($data) 
	{
		die;
		//echo date("Y-m-d", strtotime(str_replace("'","", $data['dateinq']))); die;
		//*******************************************************************
			$this->db->select('*');
			$this->db->from('tbl_inquiry_type');
			//$this->db->where('inquiry_type_name',$data['inqtype']);
			$this->db->where('LOWER(inquiry_type_name)', strtolower($data['inqtype']));
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				$item = array(
				  'inquiry_type_name' => $data['inqtype'],
				  'inquiry_type_cdate' => date('Y-m-d H:i:s'),
				  'inquiry_type_udate' => date('Y-m-d H:i:s')
	          	);
	          	$this->db->insert('tbl_inquiry_type',$item);
				$inq_type_id = $this->db->insert_id();
			}else if($query->num_rows() > 0)
			{
				$inqtype_data = $query->row_array();
				$inq_type_id = $inqtype_data['inquiry_type_id'];
			}else{
				$inq_type_id = 0;
			}
		
		//*****************************************************************
			$this->db->select('*');
		    $this->db->from('tbl_source_cat');
		    $this->db->where('source_main_cat', 0);
		    //$this->db->where('source_cat_name',$data['reference']);
		    $this->db->where('LOWER(source_cat_name)', strtolower($data['reference']));
		    $query = $this->db->get();
		    if($query->num_rows() == 0)
		    {
		      $item = array(
		      'source_cat_name' => $data['reference'],
		      'source_cat_cdate' => date("Y-m-d"),
		      'source_cat_udate' => date("Y-m-d")
		      );
		      $this->db->insert('tbl_source_cat',$item);
		      $source_id = $this->db->insert_id();
		    }else if($query->num_rows() > 0)
		    {
		      $source_data = $query->row_array();
		      $source_id = $source_data['source_cat_id'];
		    }else{
		      $source_id = 0;
		    }
		//*****************************************************************
			$this->db->select('*');
		    $this->db->from('tbl_source_cat');
		    $this->db->where('source_main_cat !=', 0);
		    $this->db->where('LOWER(source_cat_name)', strtolower($data['source']));
		    $query = $this->db->get();
		    if($query->num_rows() == 0)
		    {
		      $item = array(
		      'source_cat_name' => $data['source'],
		      'source_main_cat' => isset($source_id) ? $source_id :'',
		      'source_cat_cdate' => date("Y-m-d"),
		      'source_cat_udate' => date("Y-m-d")
		      );
		      $this->db->insert('tbl_source_cat',$item);
		      $ssource_id = $this->db->insert_id();
		    }else if($query->num_rows() > 0)
		    {
		      $source_data = $query->row_array();
		      $ssource_id = $source_data['source_cat_id'];
		    }else{
		      $ssource_id = 0;
		    }
	    //*****************************************************************
	    	$this->db->select('*');
		    $this->db->from('tbl_inquiry_status');
		    //$this->db->where('inquiry_status_name',$data['status']);
		    $this->db->where('LOWER(inquiry_status_name)', strtolower($data['status']));
		    $query = $this->db->get();
		    if($query->num_rows() == 0)
		    {
		      $item = array(
		      'inquiry_status_name' => $data['status'],
		      'inquiry_status_cdate' => date("Y-m-d"),
		      'inquiry_status_udate' => date("Y-m-d")
		      );
		      $this->db->insert('tbl_inquiry_status',$item);
		      $status_id = $this->db->insert_id();
		    }else if($query->num_rows() > 0)
		    {
		      $status_data = $query->row_array();
		      $status_id = $status_data['inquiry_status_id'];
		    }else{
		      $status_id = 0;
		    }
	    //*******************************************************************
			$this->db->select('*');
			$this->db->from('tbl_admin_users');
			//$this->db->where('inquiry_type_name',$data['inqtype']);
			$this->db->where('LOWER(au_fname)', strtolower($data['executive']));
			$query = $this->db->get();
			if($query->num_rows() == 0)
			{
				$inq_au_id = 0;
			}else if($query->num_rows() > 0)
			{
				$inqau_data = $query->row_array();
				$inq_au_id = $inqau_data['au_id'];
			}else{
				$inq_au_id = 0;
			}
		
	    //*****************************************************************
		// $data['dateinq'] = isset($data['dateinq']) ? DateTime::createFromFormat('d/m/y H:i:s', $data['dateinq']) : '';
		// 						//$data['dateinq'] = isset($data['dateinq']) ? $data['dateinq']->format('Y-m-d H:i:s') : '';
			//date("Y-m-d", strtotime($data['inquiry_details']['date']))
			$date_inq = str_replace("'","", $data['dateinq']);
			$date_inqa = str_replace("/","-", $date_inq);
			$finqdate = date("Y-m-d", strtotime($date_inqa));
			if($finqdate == '1970-01-01')
			{
				$xdate = $date_inqa;
				$dateexp = explode('-',$xdate);
				if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
				{
					$finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
					$finqdate = date("Y-m-d", strtotime($finalformat));
				}
			}
		$inq = array(
			'inq_no' => $data['inqid'],
			'inq_date' => $finqdate, 
			'inq_xdate' => $date_inqa,
			'inq_type' => $inq_type_id,
			'inq_au_id' => $inq_au_id,
			'inq_source' => isset($source_id) ? $source_id : '',
			'inq_subsource' => isset($ssource_id) ? $ssource_id : '',
			'inq_inqstatus' => isset($status_id) ? $status_id : '', 
          );
          $this->db->insert('tbl_inquiry',$inq);
          $inqid = $this->db->insert_id();
          //*****************************************************************
          	if(isset($data['producttype'])){
          		$this->db->select('*');
			    $this->db->from('tbl_product_type');
			    $this->db->where('prot_pro_id',1);
			    $this->db->where('LOWER(prot_name)', strtolower($data['producttype']));
			    $tquery = $this->db->get();
			    if($tquery->num_rows() == 1)
			    {
			    	$tcate_data = $tquery->row_array();
			      	$tcate_id = $tcate_data['prot_id'];
			    }else if($tquery->num_rows() == 0){
			    	$inq = array(
						'prot_name' => isset($data['producttype']) ? $data['producttype'] : '',
						'prot_pro_id' => 1, 
						// 'pro_adid' => '',
						// 'pro_atype' => '',
						'pro_is_delete' => '0'
						// 'prot_moduleid' => '',
						// 'pro_ip' => ''
			          );
			          $this->db->insert('tbl_product_type',$inq);
			          $tcate_id = $this->db->insert_id();
			    }else{
			    	$tcate_id = 0;
			    }
			}
		    if(isset($data['Category'])){
          		$this->db->select('*');
			    $this->db->from('tbl_product_category');
			    $this->db->where('ptype_id',$tcate_id);
			    $this->db->where('product_name',1);
			    $this->db->where('LOWER(procat_name)', strtolower($data['Category']));
			    $catquery = $this->db->get();
			    if($catquery->num_rows() == 1)
			    {
			    	$cate_data = $catquery->row_array();
			      	$cate_id = $cate_data['procat_id'];
			    }else if($catquery->num_rows() == 0){
			    	$inq = array(
						'procat_name' => isset($data['Category']) ? $data['Category'] : '',
						'product_name' => 1,
						'ptype_id' =>  isset($tcate_id) ? $tcate_id : 0,
						// 'pro_adid' => '',
						// 'pro_atype' => '',
						'procat_is_delete' => '0'
						// 'prot_moduleid' => '',
						// 'pro_ip' => ''
			          );
			          $this->db->insert('tbl_product_category',$inq);
			          $cate_id = $this->db->insert_id();
			    }else{
			    	$cate_id = 0;
			    }
		    }
				$uprod = array(
					'prod_inq_id' => $inqid,
					'prod_module_id' => 19,
					'prod_pro_id' => 1,
					'prod_type_id' => isset($tcate_id) ? $tcate_id : '',
					'prod_cat_id' => isset($cate_id) ? $cate_id : '',
					//'prod_type_name' => isset($data['producttype']) ? $data['producttype'] : '',
					//'prod_cat_name' => isset($data['Category']) ? $data['Category'] : '',
				);
				$this->db->insert('tbl_uproduct_details',$uprod);
          	
          //*****************************************************************
          $contact = array(
          	'con_no_inq_id' => $inqid,
          	'con_no_module_id' => 19,
			'con_no_mnos' => $data['contactno'],
			'con_no_hnos' => $data['contactno2']
          );
          $this->db->insert('tbl_ucontact_nos',$contact);
		//*****************************************************************
          if($data['education'] != ''){
          		$this->db->select('*');
			    $this->db->from('tbl_education');
			    //$this->db->where('inquiry_status_name',$data['status']);
			    $this->db->where('LOWER(edu_name)', strtolower($data['education']));
			    $query = $this->db->get();
			    if($query->num_rows() == 0)
			    {
			      $item = array(
			      'edu_name' => $data['education'],
			      'edu_cdate' => date("Y-m-d"),
			      'edu_udate' => date("Y-m-d")
			      );
			      $this->db->insert('tbl_education',$item);
			      $aedu_id = $this->db->insert_id();
			    }else if($query->num_rows() > 0)
			    {
			      $aedu_data = $query->row_array();
			      $aedu_id = $aedu_data['edu_id'];
			    }else{
			      $aedu_id = 0;
			    }
          }else{
			      $aedu_id = 0;
			    }
          
		//*****************************************************************
          $uappedu = array(
          	'uedu_inq_id' => $inqid,
          	'uedu_module_id' => 19,
			'uedu_education' => $aedu_id,
			'uedu_full_education' => isset($data['education']) ? $data['education'] : '', 
			'uedu_bit' => '1'
          );
          $this->db->insert('tbl_ueducation',$uappedu);
          //*****************************************************************
          if($data['education'] != ''){
	          $this->db->select('*');
			    $this->db->from('tbl_education');
			    //$this->db->where('inquiry_status_name',$data['status']);
			    $this->db->where('LOWER(edu_name)', strtolower($data['spouseageedu']));
			    $query = $this->db->get();
			    if($query->num_rows() == 0)
			    {
			      $item = array(
			      'edu_name' => $data['spouseageedu'],
			      'edu_cdate' => date("Y-m-d"),
			      'edu_udate' => date("Y-m-d")
			      );
			      $this->db->insert('tbl_education',$item);
			      $sedu_id = $this->db->insert_id();
			    }else if($query->num_rows() > 0)
			    {
			      $sedu_data = $query->row_array();
			      $sedu_id = $sedu_data['edu_id'];
			    }else{
			      $sedu_id = 0;
			    }
			}else{
			      $sedu_id = 0;
			    }
		//*****************************************************************
          $uspsedu = array(
          	'uedu_inq_id' => $inqid,
          	'uedu_module_id' => 19,
          	'uedu_education' => $sedu_id,
			'uedu_full_education' => isset($data['spouseageedu']) ? $data['spouseageedu'] : '', 
			'uedu_bit' => '2'
          );
          $this->db->insert('tbl_ueducation',$uspsedu);
		//*****************************************************************
          $uapexp = array(
          	'uexp_inq_id' => $inqid,
          	'uexp_module_id' => 19,
			'uexp_exp_years' => isset($data['experience']) ? $data['experience'] : '',
			'uexp_exp_field' => isset($data['expfiled']) ? $data['expfiled'] : '',
			'uexp_bit' => '1'
          );
          $this->db->insert('tbl_uexperience',$uapexp);
		//*****************************************************************
          $uspsexp = array(
          	'uexp_inq_id' => $inqid,
          	'uexp_module_id' => 19,
			'uexp_exp_years' => isset($data['spouseexp']) ? $data['spouseexp'] : '', 
			'uexp_exp_field' => isset($data['spouseexpfiled']) ? $data['spouseexpfiled'] : '',  
			'uexp_bit' => '2'
          );
          $this->db->insert('tbl_uexperience',$uspsexp);
          //*****************************************************************
          $urefu = array(
          	'urefu_inq_id' => $inqid,
          	'urefu_module_id' => 19,
			'urefu_isrefusal' => isset($data['refusal']) ? $data['refusal'] : '', 
			'urefu_bit' => '1'
          );
          $this->db->insert('tbl_urefusal',$urefu);
          //*****************************************************************
          $urel = array(
          	'urel_inq_id' => $inqid,
          	'urel_module_id' => 19,
			'urel_relinforeign' => isset($data['relative_in_foreign']) ? $data['relative_in_foreign'] : '',
			'urel_bit' => '1'
          );
          $this->db->insert('tbl_urelative',$urel);
          //*****************************************************************
		      if( strpos($data['countryeligible'], '/') !== false )
				 {
				     $datas = explode( '/' , $data['countryeligible']);
				     foreach ($datas as $data) {

				     	if(isset($data) && ($data != '') && ($data != 0))
					   	{
					   		$this->db->select('country_id');
					   		$this->db->from('tbl_country');
					   		$this->db->where('country_xid',$data);
					   		$query = $this->db->get();
					   		if($query->num_rows() == 1){
					   			$countrydata = $query->row_array();
					   			$countryid = $countrydata['country_id'];
					   		}else{
					   			$this->db->select('country_id');
						   		$this->db->from('tbl_country');
						   		$this->db->where('country_name',$data);
						   		$query = $this->db->get();
						   		if($query->num_rows() == 1){
						   			$countrydata = $query->row_array();
					   				$countryid = $countrydata['country_id'];
						   		}else{
						   			$this->db->select('country_id');
							   		$this->db->from('tbl_country');
							   		$this->db->where('country_code',$data);
							   		$query = $this->db->get();
							   		if($query->num_rows() == 1){
							   			$countrydata = $query->row_array();
						   				$countryid = $countrydata['country_id'];
							   		}else{
							   			$countryid = 0;
							   		}
						   		}
					   		}
					   	}else{
					   		$countryid = 0;
					   	}
				     	if($countryid != 0)
				     	{
				     		$country_data = $query->row_array();
					    	$country_id = $country_data['country_id'];
				          	$ucountry = array(
				          	'inqci_inq_id' => $inqid,
				          	'inqci_moduleid' => 19,
							'inqci_countryid' => $countryid,
							'inqci_country' => isset($data['countryeligible']) ? $data['countryeligible'] : '',
							'inqci_bit' => '2'
				          );
				          $this->db->insert('tbl_ucountryoption',$ucountry);
				     	}
				     	/*$this->db->select('*');
					    $this->db->from('tbl_country');
					    //$this->db->where('country_code',$data);
					    $this->db->where('LOWER(country_code)', strtolower($data));
					    $query = $this->db->get();
					    if($query->num_rows() > 0){
					    	$country_data = $query->row_array();
					    	$country_id = $country_data['country_id'];
				          	$ucountry = array(
				          	'inqci_inq_id' => $inqid,
				          	'inqci_moduleid' => 19,
							'inqci_countryid' => $country_id,
							'inqci_country' => isset($data['countryeligible']) ? $data['countryeligible'] : '',
							'inqci_bit' => '2'
				          );
				          $this->db->insert('tbl_ucountryoption',$ucountry);
					    } */
	          		}
		    }else{
		    	if($data['countryeligible'] != 'ALL COUNTRY')
		    	{

		    		if(isset($data['countryeligible']) && ($data['countryeligible'] != '') && ($data['countryeligible'] != 0))
				   	{
				   		$this->db->select('country_id');
				   		$this->db->from('tbl_country');
				   		$this->db->where('country_xid',$data['countryeligible']);
				   		$query = $this->db->get();
				   		if($query->num_rows() == 1){
				   			$countrydata = $query->row_array();
				   			$countryid = $countrydata['country_id'];
				   		}else{
				   			$this->db->select('country_id');
					   		$this->db->from('tbl_country');
					   		$this->db->where('country_name',$data['countryeligible']);
					   		$query = $this->db->get();
					   		if($query->num_rows() == 1){
					   			$countrydata = $query->row_array();
				   				$countryid = $countrydata['country_id'];
					   		}else{
					   			$this->db->select('country_id');
						   		$this->db->from('tbl_country');
						   		$this->db->where('country_code',$data['countryeligible']);
						   		$query = $this->db->get();
						   		if($query->num_rows() == 1){
						   			$countrydata = $query->row_array();
					   				$countryid = $countrydata['country_id'];
						   		}else{
						   			$countryid = 0;
						   		}
					   		}
				   		}
				   	}else{
				   		$countryid = 0;
				   	}
				   	if($countryid != 0)
				   	{
				   		$ucountry = array(
							'inqci_inq_id' => $inqid,
							'inqci_moduleid' => 19,
							'inqci_countryid' => $countryid,
							'inqci_country' => isset($data['countryeligible']) ? $data['countryeligible'] : '',
							'inqci_bit' => '2'
						);
						$this->db->insert('tbl_ucountryoption',$ucountry);
				   	}
		    	}else{
		    		$ucountry = array(
						'inqci_inq_id' => $inqid,
						'inqci_moduleid' => 19,
						'inqci_bit' => '2',
						'inqci_country' => isset($data['countryeligible']) ? $data['countryeligible'] : '',
						'inqci_isallcountry' => '1'
						);
						$this->db->insert('tbl_ucountryoption',$ucountry);
		    	}

		   	}
          //*****************************************************************
		   	if(isset($data['country']) && ($data['country'] != '') && ($data['country'] != 0))
		   	{
		   		$this->db->select('country_id');
		   		$this->db->from('tbl_country');
		   		$this->db->where('country_xid',$data['country']);
		   		$query = $this->db->get();
		   		if($query->num_rows() == 1){
		   			$countrydata = $query->row_array();
		   			$countryid = $countrydata['country_id'];
		   		}else{
		   			$this->db->select('country_id');
			   		$this->db->from('tbl_country');
			   		$this->db->where('country_name',$data['country']);
			   		$query = $this->db->get();
			   		if($query->num_rows() == 1){
			   			$countrydata = $query->row_array();
		   				$countryid = $countrydata['country_id'];
			   		}else{
			   			$this->db->select('country_id');
				   		$this->db->from('tbl_country');
				   		$this->db->where('country_code',$data['country']);
				   		$query = $this->db->get();
				   		if($query->num_rows() == 1){
				   			$countrydata = $query->row_array();
			   				$countryid = $countrydata['country_id'];
				   		}else{
				   			$countryid = 0;
				   		}
			   		}
		   		}
		   	}else{
		   		$countryid = 0;
		   	}

		   	if(isset($data['state']) && ($data['state'] != '') && ($data['state'] != 0))
		   	{
		   		$this->db->select('state_id');
		   		$this->db->from('tbl_master_state');
		   		$this->db->where('state_xid',$data['state']);
		   		$query = $this->db->get();
		   		if($query->num_rows() == 1){
		   			$statedata = $query->row_array();
		   			$stateid = $statedata['state_id'];   
		   		}else{
		   			$this->db->select('state_id');
			   		$this->db->from('tbl_master_state');
			   		$this->db->where('state_name',$data['state']);
			   		$query = $this->db->get();
			   		if($query->num_rows() == 1){
			   			$statedata = $query->row_array();
		   				$stateid = $statedata['state_id'];
			   		}else{
				   		$stateid = 0;
				   	}
		   		}
		   	}else{
		   		$stateid = 0;
		   	}

		   		if(isset($data['city']) && ($data['city'] != '') && ($data['city'] != 0))
		   	{
		   		$this->db->select('city_id');
		   		$this->db->from('tbl_master_city');
		   		$this->db->where('city_xid',$data['city']);
		   		$query = $this->db->get();
		   		if($query->num_rows() == 1){
		   			$citydata = $query->row_array();
		   			$cityid = $citydata['city_id'];   
		   		}else{
		   			$this->db->select('city_id');
			   		$this->db->from('tbl_master_city');
			   		$this->db->where('city_name',$data['city']);
			   		$query = $this->db->get();
			   		if($query->num_rows() == 1){
			   			$citydata = $query->row_array();
		   				$cityid = $citydata['city_id'];
			   		}else{
				   		$cityid = 0;
				   	}
		   		}
		   	}else{
		   		$cityid = 0;
		   	}


		   	if(isset($data['areaname']) && ($data['areaname'] != '') && ($data['areaname'] != 0))
		   	{
		   		$this->db->select('area_id');
		   		$this->db->from('tbl_master_area');
		   		$this->db->where('area_name',$data['areaname']);
		   		$query = $this->db->get();
		   		if($query->num_rows() == 1){
		   			$areadata = $query->row_array();
		   			$areaid = $areadata['area_id'];   
		   		}else{
				   		$areaid = 0;
				   	}
		   	}else{
		   		$areaid = 0;
		   	}


          $uaddress = array(
          	'add_inq_id' => $inqid,
          	'add_module_id' => 19,
			'add_country' => $countryid,
			'add_xcountry'  => isset($data['country']) ? $data['country'] : '',
			'add_state' => $stateid,
			'add_xstate'  => isset($data['state']) ? $data['state'] : '',
			'add_city' => $cityid,
			'add_xcity'  => isset($data['city']) ? $data['city'] : '',
			'add_area' => $areaid,
			'add_pin' => $areaid,
			'add_area_text' => isset($data['areaname']) ? $data['areaname'] : '',
          );
          $this->db->insert('tbl_uaddress',$uaddress);
		//*****************************************************************
			if(isset($data['calldate']))
			{
				$date_inq = str_replace("'","", $data['calldate']);
				$date_inqa = str_replace("/","-", $date_inq);
				$calldate_inqa = date("Y-m-d", strtotime($date_inqa));
				if($calldate_inqa == '1970-01-01')
				{
					$xdate = $date_inqa;
					$dateexp = explode('-',$xdate);
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
						$calldate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				}
			}

			if(isset($data['fudate']))
			{
				$date_inq = str_replace("'","", $data['fudate']);
				$date_inqa = str_replace("/","-", $date_inq);
				$fudate_inqa = date("Y-m-d", strtotime($date_inqa));
				if($fudate_inqa == '1970-01-01')
				{
					$xdate = $date_inqa;
					$dateexp = explode('-',$xdate);
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				}
			}

          $bdetails = array(
          	'bd_inq_id' => $inqid,
          	'bd_module_id' => 19,
          	'bd_fullname' => isset($data['clientname']) ? $data['clientname'] :'',
          	'bd_company_name' => isset($data['compnayname']) ? $data['compnayname'] :'',
          	'bd_email' => isset($data['email']) ? $data['email'] :'',
          	'bd_age' => isset($data['age']) ? $data['age'] :'',
          	'bd_calldate' => isset($data['calldate']) ? date("Y-m-d", strtotime($calldate_inqa)) :'',
          	'bd_xcalldate' => isset($data['calldate']) ? $data['calldate'] : '',
          	'bd_fudate' => isset($data['fudate']) ? date("Y-m-d", strtotime($fudate_inqa)) :'',
          	'bd_xfudate' => isset($data['fudate']) ? $data['fudate'] : '',
          	'bd_band' => isset($data['band']) ? $data['band'] :'',
          	'bd_kids' => isset($data['kids']) ? $data['kids'] :'', 
          	'bd_bit' => '1',
          	'bd_remark' => isset($data['remarks']) ? $data['remarks'] :'', 
          );
          $this->db->insert('tbl_ubasic_details',$bdetails);
          //*****************************************************************
          $spoudet = array(
          	'bd_inq_id' => $inqid,
          	'bd_module_id' => 19,
          	'bd_age' => isset($data['spouseage']) ? $data['spouseage'] :'',
          	'bd_bit' => '2'
          );
          $this->db->insert('tbl_ubasic_details',$spoudet);

		//echo"<pre>";print_r($data);die;
		

		// $this->db->select('*');
		// $this->db->from('tbl_country');
		// $this->db->where('country_name',$data['country']);
		// $query = $this->db->get();
		// if($query->num_rows() == 0)
		// {
		// 	$item = array(
		// 	  'country_name' => $data['country'],
		// 	  'country_cdate' => date("Y-m-d"),
		// 	  'country_udate' => date("Y-m-d"),
		// 	  );
		// 	  $this->db->insert('tbl_country',$item);
		// 	$country_id = $this->db->insert_id();
		// }else if($query->num_rows() > 0)
		// {
		// 	$country_data = $query->row_array();
		// 	$country_id = $country_data['country_id'];
		// }else{
		// 	$country_id = 0;
		// }
		
		// $this->db->select('*');
		// $this->db->from('tbl_master_state');
		// $this->db->where('state_name',$data['state']);
		// $query = $this->db->get();
		// if($query->num_rows() == 0)
		// {
		// 	$item = array(
		// 	  'state_name' => $data['state'],
		// 	  'state_country' => $country_id,
		// 	  //'state_cdate' => date("Y-m-d"),
		// 	  'state_udate' => date("Y-m-d"),
		// 	  );
		// 	  $this->db->insert('tbl_master_state',$item);
		// 	$state_id = $this->db->insert_id();
		// }else if($query->num_rows() > 0)
		// {
		// 	$state_data = $query->row_array();
		// 	$state_id = $state_data['state_id'];
		// }else{
		// 	$state_id = 0;
		// }
		
		// $this->db->select('*');
		// $this->db->from('tbl_master_city');
		// $this->db->where('city_name',$data['city']);
		// $query = $this->db->get();
		// if($query->num_rows() == 0)
		// {
		// 	$item = array(
		// 	'city_name' => $data['city'],
		// 	'city_country' => $country_id,
		// 	'city_state_id' => $state_id,
		// 	//'city_cdate' => date("Y-m-d"),
		// 	//'city_udate' => date("Y-m-d"),
		// 	);
		// 	$this->db->insert('tbl_master_city',$item);
		// 	$city_id = $this->db->insert_id();
		// }else if($query->num_rows() > 0)
		// {
		// 	$city_data = $query->row_array();
		// 	$city_id = $city_data['city_id'];
		// }else{
		// 	$city_id = 0;
		// }
		
		// $this->db->select('*');
		// $this->db->from('tbl_master_area');
		// $this->db->where('area_name',$data['areaname']);
		// $query = $this->db->get();
		// if($query->num_rows() == 0)
		// {
		// 	$item = array(
		// 	'area_name' => $data['areaname'],
		// 	'area_country' => $country_id,
		// 	'area_state' => $state_id,
		// 	'area_city' => $city_id,
		// 	'area_cdate' => date("Y-m-d"),
		// 	'area_udate' => date("Y-m-d"),
		// 	);
		// 	$this->db->insert('tbl_master_area',$item);
		// 	$area_id = $this->db->insert_id();
		// }else if($query->num_rows() > 0)
		// {
		// 	$area_data = $query->row_array();
		// 	$area_id = $area_data['area_id'];
		// }else{
		// 	$area_id = 0;
		// }
	    
	}

public function datetest()
{
	$this->db->select('*');
	$this->db->from('tbl_inquiry');
	$this->db->where('inq_xdate!=','');
	//$this->db->limit('100');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach ($query->result_array() as $key => $inqdata) {
		$date_inq = str_replace("'","", $inqdata['inq_xdate']);
		$date_inqa = str_replace("/","-", $date_inq);
		$xdate = $date_inqa;
		$dateexp = explode('-',$xdate);
		//echo "<pre>"; print_r($dateexp); die;
		if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
			{
				$finalformat = '20'.$dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
				//echo "<pre>"; print_r($finalformat); die;
				$finqdate = date("Y-m-d", strtotime($finalformat));
				//echo "<pre>"; print_r($finqdate); die;
			}
			//echo $finqdate.'<br/>';
		if($finqdate == '1970-01-01')
		{
			$xdate = $date_inqa;
			$dateexp = explode('-',$xdate);
			//echo "<pre>"; print_r($dateexp); die;
			if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
			{
				$finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
				$finqdate = date("Y-m-d", strtotime($finalformat));
				//echo "<pre>"; print_r($finqdate); die;
				
			}
		}
		if($finqdate != '1970-01-01')
		{
			$ar = array('inq_date'=>$finqdate);
			$this->db->where('inq_id',$inqdata['inq_id']);
			$this->db->update('tbl_inquiry',$ar);
		}
	} die;
	die;
/*$this->db->select('*');
$this->db->from('tbl_inquiry');
$this->db->where('inq_date','1970-01-01');
$this->db->where('inq_xdate !=','1970-01-01');
$query = $this->db->get();
$dates = $query->result_array();
foreach($dates as $date)
{
$inq_id = $date['inq_id'];
$xdate = $date['inq_xdate'];
$dateexp = explode('-',$xdate);
if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
{
$finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
 $your_date = date("Y-m-d", strtotime($finalformat));
$ar = array('inq_date'=>$your_date);
$this->db->where('inq_id',$inq_id);
$this->db->update('tbl_inquiry',$ar);
}
} */
}

public function xcountry()
{
	$this->db->select('*');
	$this->db->from('countrymaster');
	$query = $this->db->get();

	foreach ($query->result_array() as $key => $contry) {
		$this->db->select('*');
	    $this->db->from('tbl_country');
	    //$this->db->where('country_code',$data);
	    $this->db->where('LOWER(country_name)', strtolower($contry['countryname']));
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	    	$result = $query->row_array();
	    	$update = array(
	    			'country_xid' => $contry['countryid']
	    		);
	    	$this->db->where('country_id',$result['country_id']);
	    	$this->db->update('tbl_country',$update);
	    }
	}
}

public function xstate()
{
	$this->db->select('*');
	$this->db->from('state');
	$query = $this->db->get();

	foreach ($query->result_array() as $key => $state) {
		$this->db->select('*');
	    $this->db->from('tbl_master_state');
	    //$this->db->where('country_code',$data);
	    $this->db->where('LOWER(state_name)', strtolower($state['statename']));
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	    	$result = $query->row_array();
	    	$update = array(
	    			'state_xid' => $state['stateid']
	    		);
	    	$this->db->where('state_id',$result['state_id']);
	    	$this->db->update('tbl_master_state',$update);
	    }
	}
}

public function xcity()
{
	$this->db->select('*');
	$this->db->from('city');
	$query = $this->db->get();

	foreach ($query->result_array() as $key => $city) {
		$this->db->select('*');
	    $this->db->from('tbl_master_city');
	    //$this->db->where('country_code',$data);
	    $this->db->where('LOWER(city_name)', strtolower($city['cityname']));
	    $query = $this->db->get();
	    if($query->num_rows() == 1){
	    	$result = $query->row_array();
	    	$update = array(
	    			'city_xid' => $city['cityid']
	    		);
	    	$this->db->where('city_id',$result['city_id']);
	    	$this->db->update('tbl_master_city',$update);
	    }else{
	    	if($city['countryid'] == 1 && $city['stateid'] == 1)
	    	{
	    		$this->db->select('*');
			    $this->db->from('tbl_master_city');
			    //$this->db->where('country_code',$data);
			    $this->db->where('LOWER(city_name)', strtolower($city['cityname']));
			    $query = $this->db->get();
			    if($query->num_rows() == 0){
		    		$insert = array(
		    			'city_name' => $city['cityname'],
		    			'city_state' => 10,
		    			'city_country' => 105,
		    			'city_xid' => $city['cityid']
		    		);
		    		$this->db->insert('tbl_master_city',$insert);
	    		}
	    	}
	    	if($city['countryid'] == 1 && $city['stateid'] == 2)
	    	{
	    		$this->db->select('*');
			    $this->db->from('tbl_master_city');
			    //$this->db->where('country_code',$data);
			    $this->db->where('LOWER(city_name)', strtolower($city['cityname']));
			    $query = $this->db->get();
			    if($query->num_rows() == 0){
		    		$insert = array(
		    			'city_name' => $city['cityname'],
		    			'city_state' => 13,
		    			'city_country' => 105,
		    			'city_xid' => $city['cityid']
		    		);
		    		$this->db->insert('tbl_master_city',$insert);
	    		}
	    	}
	    	if($city['countryid'] == 1 && $city['stateid'] == 8)
	    	{
	    		$this->db->select('*');
			    $this->db->from('tbl_master_city');
			    //$this->db->where('country_code',$data);
			    $this->db->where('LOWER(city_name)', strtolower($city['cityname']));
			    $query = $this->db->get();
			    if($query->num_rows() == 0){
		    		$insert = array(
		    			'city_name' => $city['cityname'],
		    			'city_state' => 15,
		    			'city_country' => 105,
		    			'city_xid' => $city['cityid']
		    		);
		    		$this->db->insert('tbl_master_city',$insert);
	    		}
	    	}
	    	echo $city['cityname'].'</br>   /n';
	    }
	}
}

public function get_auto_inq_no()
{
	$this->db->select('inq_id');
	$this->db->from('tbl_inquiry');
	$this->db->order_by('inq_id','DESC');
	$this->db->limit(1);
	$query = $this->db->get();
	$autoid = $query->row_array();
	$autoid['inq_id'] = isset($autoid['inq_id']) ? $autoid['inq_id'] : '';
	return $autoid['inq_id']+1;
}

public function country_loop()
{
	$this->db->select('*');
	$this->db->from('tbl_country');
	$query = $this->db->get();
	foreach($query->result_array() as $country){
		$update = array('add_country' => $country['country_id']);
		$this->db->where('add_country',0);
		$this->db->where('add_xcountry',$country['country_name']);
		$this->db->update('tbl_uaddress',$update);
	}
}

public function state_loop()
{
	$this->db->select('*');
	$this->db->from('tbl_master_state');
	$query = $this->db->get();
	foreach($query->result_array() as $country){
		$update = array('add_state' => $country['state_id']);
		$this->db->where('add_state',0);
		$this->db->where('add_xstate',$country['state_name']);
		$this->db->update('tbl_uaddress',$update);
	}
}

public function city_loop()
{
	$this->db->select('*');
	$this->db->from('tbl_master_city');
	$query = $this->db->get();
	foreach($query->result_array() as $country){
		$update = array('add_city' => $country['city_id']);
		$this->db->where('add_city',0);
		$this->db->where('add_xcity',$country['city_name']);
		$this->db->update('tbl_uaddress',$update);
	}
}

public function vidhi_vidhata_loop()
{
	$this->db->select('*');
	$this->db->from('tbl_inquiry');
	$this->db->join('tbl_uproduct_details','tbl_uproduct_details.prod_inq_id = tbl_inquiry.inq_id');
	$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('tbl_uproduct_details.prod_type_id !=',1);
	$query = $this->db->get();
	foreach($query->result_array() as $executive){
		$update = array('tbl_inquiry.inq_au_id' => 23);
		$this->db->where('tbl_inquiry.inq_id',$executive['inq_id']);
		$this->db->update('tbl_inquiry',$update);
	}
}

public function visitor_tovisitor_visa()
{
	$this->db->select('*');
	$this->db->from('tbl_inquiry');
	$this->db->join('tbl_uproduct_details','tbl_uproduct_details.prod_inq_id = tbl_inquiry.inq_id');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('tbl_uproduct_details.prod_type_id',8);
	$query = $this->db->get();
	foreach($query->result_array() as $executive){
		$update = array('tbl_uproduct_details.prod_type_id' => 3);
		$this->db->where('tbl_uproduct_details.prod_id',$executive['prod_id']);
		$this->db->update('tbl_uproduct_details',$update);
	}
}

public function cat_visitor_tovisitor_visa()
{
	$this->db->select('*');
	$this->db->from('tbl_inquiry');
	$this->db->join('tbl_uproduct_details','tbl_uproduct_details.prod_inq_id = tbl_inquiry.inq_id');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('tbl_uproduct_details.prod_cat_id',10);
	$query = $this->db->get();
	foreach($query->result_array() as $executive){
		$update = array('tbl_uproduct_details.prod_cat_id' => 3);
		$this->db->where('tbl_uproduct_details.prod_id',$executive['prod_id']);
		$this->db->update('tbl_uproduct_details',$update);
	}
}

public function inq_toonly()
{
	$this->db->select('*');
	$this->db->from('tbl_inquiry');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('tbl_inquiry.inq_type',6);
	$query = $this->db->get();
	foreach($query->result_array() as $executive){
		$update = array('tbl_inquiry.inq_type' => 1);
		$this->db->where('tbl_inquiry.inq_id',$executive['inq_id']);
		$this->db->update('tbl_inquiry',$update);
	}
}

public function inqid_inqno()
{
	// $this->db->select('t1.inq_id as id1, t2.inq_no');
	// $this->db->from('tbl_inquiry as t1');
	// $this->db->join('tbl_inquiry as t2', 't1.inq_id = t2.inq_id', 'left');
	// $this->db->set('t2.inq_no','t1.inq_id');
	// $this->db->update('tbl_inquiry as t2');

	// UPDATE `tbl_inquiry` SET `inq_no`=`inq_id` where `inq_id`!=0
   
}

public function inqid_toinqno()
{
	// $this->db->select('t1.inq_id as id1, t2.inq_no');
	// $this->db->from('tbl_inquiry as t1');
	// $this->db->join('tbl_inquiry as t2', 't1.inq_id = t2.inq_id', 'left');
	// $this->db->set('t2.inq_no','t1.inq_id');
	// $this->db->update('tbl_inquiry as t2');

	// UPDATE `tbl_inquiry` SET `inq_no`=`inq_id` where `inq_id`!=0
   $sql = 'UPDATE tbl_inquiry SET inq_no = concat("INQ",inq_id)';
   $query = $this->db->query($sql );
}

public function move_date()
{
	$this->db->select('*');
	$this->db->from('tbl_ubasic_details');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('bd_uf_id!=',0);
	$this->db->where('bd_xcalldate!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['bd_xcalldate'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('bd_calldate' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('bd_id',$executive['bd_id']);
		$this->db->update('tbl_ubasic_details',$update);
	}
	$this->db->select('*');
	$this->db->from('tbl_ubasic_details');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('bd_uf_id!=',0);
	$this->db->where('bd_xfudate!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['bd_xfudate'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('bd_fudate' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('bd_id',$executive['bd_id']);
		$this->db->update('tbl_ubasic_details',$update);
	}
	$this->db->select('*');
	$this->db->from('tbl_ubasic_details');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('bd_uf_id!=',0);
	$this->db->where('bd_xdob!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['bd_xdob'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('bd_dob' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('bd_id',$executive['bd_id']);
		$this->db->update('tbl_ubasic_details',$update);
	}
	$this->db->select('*');
	$this->db->from('tbl_ubasic_details');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('bd_uf_id!=',0);
	$this->db->where('bd_xdate!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['bd_xdate'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('bd_date' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('bd_id',$executive['bd_id']);
		$this->db->update('tbl_ubasic_details',$update);
	}
	$this->db->select('*');
	$this->db->from('tbl_ubasic_details');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('bd_uf_id!=',0);
	$this->db->where('bd_xdom!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['bd_xdom'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('bd_dom' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('bd_id',$executive['bd_id']);
		$this->db->update('tbl_ubasic_details',$update);
	}
	$this->db->select('*');
	$this->db->from('tbl_ubasic_details');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('bd_uf_id!=',0);
	$this->db->where('bd_second_xdom!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['bd_second_xdom'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('bd_second_dom' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('bd_id',$executive['bd_id']);
		$this->db->update('tbl_ubasic_details',$update);
	}
	$this->db->select('*');
	$this->db->from('tbl_uchildrens');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('uchild_uf_id!=',0);
	$this->db->where('uchild_xdob!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	//*************** childern basic details *********************************
	foreach($query->result_array() as $executive){
		$xdate = $executive['uchild_xdob'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
					$dateexp = explode('/',$xdate);
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[0].'-'.$dateexp[1];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
		$update = array('uchild_dob' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('uchild_id',$executive['uchild_id']);
		$this->db->update('tbl_uchildrens',$update);
	}
	//*************** Password basic details *********************************
	$this->db->select('*');
	$this->db->from('tbl_upassport');
	//$this->db->where('tbl_inquiry.inq_au_id',26);
	$this->db->where('up_uf_id!=',0);
	$this->db->where('up_dof_xexpiry!=','');
	$query = $this->db->get();
	//echo "<pre>"; print_r($query->result_array()); die;
	foreach($query->result_array() as $executive){
		$xdate = $executive['up_dof_xexpiry'];

					$dateexp = explode('-',$xdate);
					
					if(isset($dateexp[2]) && isset($dateexp[1]) && isset($dateexp[0]))
					{
						$finalformat = $dateexp[2].'-'.$dateexp[1].'-'.$dateexp[0];
						$fudate_inqa = date("Y-m-d", strtotime($finalformat));
					}
				//echo "<pre>"; print_r($fudate_inqa); die;
		$update = array('up_dof_expiry' => date("Y-m-d", strtotime($fudate_inqa)));
		$this->db->where('up_id',$executive['up_id']);
		$this->db->update('tbl_upassport',$update);
	}
	
}
	public function delete_childdate()
	{
		$this->db->select('*');
		$this->db->from('tbl_uchildrens');
		//$this->db->where('tbl_inquiry.inq_au_id',26);
		$this->db->where('uchild_uf_id!=',0);
		$this->db->where('uchild_dob','1970-01-01');
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		foreach($query->result_array() as $executive){
			$this->db->where('uchild_id',$executive['uchild_id']);
			$this->db->delete('tbl_uchildrens');
		}

		$this->db->select('*');
		$this->db->from('tbl_upassport');
		//$this->db->where('tbl_inquiry.inq_au_id',26);
		$this->db->where('up_uf_id!=',0);
		$this->db->where('up_dof_issue','1970-01-01');
		$this->db->where('up_dof_expiry','1970-01-01');
		$query = $this->db->get();
		//echo "<pre>"; print_r($query->result_array()); die;
		foreach($query->result_array() as $executive){
			$this->db->where('up_id',$executive['up_id']);
			$this->db->delete('tbl_upassport');
	}
	}

	public function ss_google()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry');
		$this->db->where('inq_source',15);
		$this->db->where('inq_subsource',0);
		$query = $this->db->get();
		foreach($query->result_array() as $executive){
			$update = array('inq_subsource' => 167);
			$this->db->where('inq_id',$executive['inq_id']);
			$this->db->update('tbl_inquiry',$update);
	}
	}

	public function reset_vfu_pass()
	{
		$this->db->set('au_password', md5('admin123'));
		$this->db->where('au_adt_id', 5);
		$this->db->update('tbl_admin_users');
	}

	public function chg_vfu_email()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry');
		$this->db->where('inq_source',15);
		$this->db->where('inq_subsource',0);
		$query = $this->db->get();
		foreach($query->result_array() as $executive){
			$update = array('inq_subsource' => 167);
			$this->db->where('inq_id',$executive['inq_id']);
			$this->db->update('tbl_inquiry',$update);
	}
	
		$this->db->set('au_password', md5('admin123'));
		$this->db->where('au_adt_id', 5);
		$this->db->update('tbl_admin_users');
	}

	public function col_max_nos()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry');
		// if($this->session->userdata('start_date') && ($this->session->userdata('start_date') != ''))
		// {
		// 	//echo $this->session->userdata('start_date'); die;
		// 	$str = $this->session->userdata('start_date');
		// 	$date = str_replace("-","",$str);
		// 	$start_date = date("Y-m-d H:i:s", strtotime($date));
		// 	$this->db->where('logfile_dt >=',$start_date);
		// }
		// if($this->session->userdata('end_date') && ($this->session->userdata('end_date') != ''))
		// {
		// 	$str = $this->session->userdata('end_date');
		// 	$date = str_replace("-","",$str);
		// 	$end_date = date("Y-m-d H:i:s", strtotime($date));
		// 	$this->db->where('logfile_dt <=',$end_date);
		// }
		$this->db->limit(1);
		$this->db->order_by('inq_no','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_excel_certificate()
	{

		$this->db->select('*');
		$this->db->from('tbl_inquiry as inq');
		$this->db->join('tbl_admin_users','inq.inq_au_id = tbl_admin_users.au_id','left');
		$this->db->join('tbl_ubasic_details','inq.inq_id = tbl_ubasic_details.bd_inq_id','left');
		//$this->db->join('tbl_uaddress','inq.inq_id = tbl_uaddress.add_inq_id','left');
		//$this->db->join('tbl_master_city','tbl_master_city.city_id = tbl_uaddress.add_city','left');
		$this->db->join('tbl_ucontact_nos','inq.inq_id = tbl_ucontact_nos.con_no_inq_id','left');
		$this->db->join('tbl_inquiry_type','inq.inq_type = tbl_inquiry_type.inquiry_type_id','left');
		$this->db->join('tbl_inquiry_status','inq.inq_inqstatus = tbl_inquiry_status.inquiry_status_id','left');
		$this->db->join('tbl_uproduct_details','inq.inq_id = tbl_uproduct_details.prod_inq_id','left');
		$this->db->join('tbl_product_type','tbl_uproduct_details.prod_type_id = tbl_product_type.prot_id','left');
		$this->db->join('tbl_product_category','tbl_uproduct_details.prod_cat_id = tbl_product_category.procat_id','left');
		$this->db->join('tbl_source_cat as source','inq.inq_source = source.source_cat_id','left');
		$this->db->join('tbl_source_cat as subsource','inq.inq_subsource = subsource.source_cat_id','left');
		$this->db->join('tbl_uchildrens','inq.inq_id = tbl_uchildrens.uchild_id','left');
		$this->db->join('tbl_urefusal','inq.inq_id = tbl_urefusal.urefu_id','left');
		$this->db->where('inq.inq_isdelete','0');
		$this->db->where('bd_bit',1);
		$this->db->order_by('inq_id','DESC');
		if($this->input->get('inq_no') && ($this->input->get('inq_no') != ''))
		{
			$this->db->where('inq_no',$this->input->get('inq_no'));
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

}
?>