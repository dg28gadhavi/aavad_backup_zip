<?php 

class inquiry_model extends CI_Model {
	
	
	public function add($data)
	{
			$inqitem = array(
			'inq_no' => $data['inquiry_details']['inq_no'],
			'inq_date' => date("Y-m-d", strtotime($data['inquiry_details']['date'])), 
			'inq_type' => $data['inquiry_details']['type'],
			'inq_source' => $data['inquiry_details']['source'],
			'inq_subsource' => $data['inquiry_details']['ssource'],
			'inq_inqstatus' => $data['inquiry_details']['inqstatus'],
			'inq_hasrefrence' => $data['inquiry_details']['ref'],
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
			'prod_pro_id' => $data['product'],
			'prod_type_id' => $data['pro_type'],
			'prod_cat_id '=> $data['pro_category'],
			'prod_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uproduct_details',$proditem);
		//***************************************
		foreach ($data['basic_details'] as $bdkey => $basic_details) {
			# code...
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
					'bd_dob' => isset($basic_details['dbirth']) ? date("Y-m-d", strtotime($basic_details['dbirth']))  : '',
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
					'bd_email' => isset($basic_details['emailid']) ? $basic_details['emailid'] : '',
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
		if(isset($data['meadd1_address']) && $data['meadd1_address'] != ''){
			foreach ($data['meadd1_address'] as $addkey => $add) {
			$additem = array(
			'add_module_id' => 19,
			'add_inq_id' => $inqlid,
			//'bd_uf_id' =>
			'add_address' => $add,
			'add_country' => $data['meadd1_country'][$addkey],
			'add_state' => $data['meadd1_state'][$addkey],
			'add_city' => $data['meadd1_city'][$addkey],
			'add_area' => $data['meadd1_area'][$addkey],
			'add_pin' => $data['meadd1_pin'][$addkey],
			'add_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uaddress',$additem);
		}
		}
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
			'uchild_dob' => date("Y-m-d", strtotime($spousechdtl_date)),
			'uchild_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uchildrens',$sprefuitem);
		}

		return $inqlid;
	}
	
	public function edit($data,$id)
	{ 
		$inqitem = array(
			'inq_no' => $data['inquiry_details']['inq_no'],
			'inq_date' => date("Y-m-d", strtotime($data['inquiry_details']['date'])), 
			'inq_type' => $data['inquiry_details']['type'],
			'inq_source' => $data['inquiry_details']['source'],
			'inq_subsource' => $data['inquiry_details']['ssource'],
			'inq_inqstatus' => $data['inquiry_details']['inqstatus'],
			'inq_hasrefrence' => $data['inquiry_details']['ref'],
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
		$this->db->where('inqci_inq_id', $id);
		$this->db->delete('tbl_ucountryoption');
		$proditem = array(
			'prod_inq_id' => $id,
			'prod_module_id' => 19,
			//'prod_uf_id' => 
			'prod_pro_id' => $data['product'],
			'prod_type_id' => $data['pro_type'],
			'prod_cat_id '=> $data['pro_category'],
			'prod_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uproduct_details',$proditem);
		//***************************************
		$this->db->where('bd_inq_id', $id);
		$this->db->delete('tbl_ubasic_details');
		foreach ($data['basic_details'] as $bdkey => $basic_details) {
			# code...
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
					'bd_dob' => isset($basic_details['dbirth']) ? date("Y-m-d", strtotime($basic_details['dbirth']))  : '',
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
					'bd_email' => isset($basic_details['emailid']) ? $basic_details['emailid'] : '',
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
				'up_module_id 	' => 19,
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
		if(isset($data['meadd1_address']) && $data['meadd1_address'] != ''){
			foreach ($data['meadd1_address'] as $addkey => $add) {
			$additem = array(
			'add_module_id' => 19,
			'add_inq_id' => $inqlid,
			//'bd_uf_id' =>
			'add_address' => $add,
			'add_country' => $data['meadd1_country'][$addkey],
			'add_state' => $data['meadd1_state'][$addkey],
			'add_city' => $data['meadd1_city'][$addkey],
			'add_area' => $data['meadd1_area'][$addkey],
			'add_pin' => $data['meadd1_pin'][$addkey],
			'add_udate' => date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_uaddress',$additem);
		}
		}
		//***************************************
		$this->db->where('uedu_inq_id', $id);
		$this->db->where('uedu_bit', '1');
		$this->db->delete('tbl_ueducation');
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
		//***************************************
		$this->db->where('uexp_inq_id', $id);
		$this->db->where('uexp_bit', '1');
		$this->db->delete('tbl_uexperience');
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
		//***************************************
		$this->db->where('ul_inq_id', $id);
		$this->db->where('ul_bit', '1');
		$this->db->delete('tbl_ulanguage');
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
		//***************************************
		$this->db->where('urel_inq_id', $id);
		$this->db->where('urel_bit', '1');
		$this->db->delete('tbl_urelative');
		foreach ($data['merelname'] as $merelkey => $merel) {
			foreach ($data['merel_forign'] as $fkey => $foreign) {
				# code...
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
		//***************************************
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
		//***************************************
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
		//***************************************
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
		//***************************************
		$this->db->where('ul_inq_id', $id);
		$this->db->where('ul_bit', '2');
		$this->db->delete('tbl_ulanguage');
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
		//***************************************
		$this->db->where('urel_inq_id', $id);
		$this->db->where('urel_bit', '2');
		$this->db->delete('tbl_urelative');
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
		//***************************************
		$this->db->where('urefu_inq_id', $id);
		$this->db->where('urefu_bit', '2');
		$this->db->delete('tbl_urefusal');
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
		//***************************************
		$this->db->where('uchild_inq_id', $id);
		$this->db->delete('tbl_uchildrens');
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
		return $id;	
	}
	
	public function get($id)
	{
		$value = array();
		$this->db->select('tbl_inquiry.*, as.*, bs.source_cat_name as parentcat');
		$this->db->from('tbl_inquiry');
		$this->db->join('tbl_source_cat as as','as.source_cat_id = tbl_inquiry.inq_source', 'left');
		$this->db->join('tbl_source_cat as bs', 'bs.source_main_cat  = as.source_cat_id', 'left');
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
		//echo "<pre>"; print_r($value['uedu']); die;

		return $value;
	}

	public function get_inquiry()
	{
		$this->db->select('*');
		$this->db->from('tbl_inquiry');
		$this->db->join('tbl_ubasic_details','tbl_inquiry.inq_id = tbl_ubasic_details.bd_id','left');
		$this->db->order_by('inq_id','desc');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('edu_is_delete', '1');
		$this->db->where('edu_id', $id);
		$this->db->update('tbl_inquiry');
		return $id;
	}

	public function get_all_master()
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
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		$value['sources'] = $query->result_array();

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

		$this->db->select('*');
		$this->db->from('tbl_product_category');
		$this->db->order_by('procat_id', 'desc');
		$this->db->where('procat_is_delete', '0');
		$query = $this->db->get();
		$value['prcats'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_product_type');
		$this->db->order_by('prot_id', 'desc');
		$this->db->where('pro_is_delete', '0');
		$query = $this->db->get();
		$value['prtps'] = $query->result_array();

		$this->db->select('*');
		$this->db->from('tbl_net_worth');
		$this->db->order_by('nw_id', 'desc');
		$this->db->where('nw_is_delete', '0');
		$query = $this->db->get();
		$value['networth'] = $query->result_array();
		return $value;
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

	public function get_srctype()
	{
		$this->db->select('*');
		$this->db->from('tbl_source_cat');
		$this->db->where('source_main_cat', $this->input->post('src_id'));
		$this->db->where('source_cat_isdelete', '0');
		$query = $this->db->get();
		return $query->result_array();
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

	public function importcsv($data) 
	{
		//*******************************************************************
		if(isset($data['inqtype']) && ($data['inqtype'] != '')){
			$this->db->select('*');
			$this->db->from('tbl_inquiry_type');
			$this->db->where('inquiry_type_name',$data['inqtype']);
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
		}
		//*****************************************************************
		if (isset($data['reference']) && ($data['reference'] != '')) {
			$this->db->select('*');
		    $this->db->from('tbl_source_cat');
		    $this->db->where('source_cat_name',$data['reference']);
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
		}
		//*****************************************************************
		if (isset($data['source']) && ($data['source'] != '')) {
			$this->db->select('*');
		    $this->db->from('tbl_source_cat');
		    $this->db->where('source_cat_name',$data['source']);
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
		}
	    //*****************************************************************
	    if(isset($data['status']) && $data['status'] !=''){
	    	$this->db->select('*');
		    $this->db->from('tbl_inquiry_status');
		    $this->db->where('inquiry_status_name',$data['status']);
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
	    }
	    //*****************************************************************
		$inq = array(
			'inq_no' => isset($data['inqid']) ? $data['inqid'] : '',
			'inq_date' => date("Y-m-d", strtotime($data['dateinq'])), 
			'inq_type' => $inq_type_id,
			'inq_source' => isset($source_id) ? $source_id : '',
			'inq_subsource' => isset($ssource_id) ? $ssource_id : '',
			'inq_inqstatus' => $status_id
          );
          $this->db->insert('tbl_inquiry',$inq);
          $inqid = $this->db->insert_id();
          //*****************************************************************
          	$this->db->select('*');
		    $this->db->from('tbl_product');
		    $this->db->where('pro_name',$data['producttype']);
		    $query = $this->db->get();
		    if($query->num_rows() > 0){
		    	$pcate_data = $query->row_array();
		      	$pcate_id = $status_data['pro_id'];
		    	$uprod = array(
	          	'prod_inq_id' => $inqid,
	          	'prod_module_id' => 19,
				'prod_pro_id' => 1,
				'prod_type_id' => $pcate_id,
				'prod_cat_id' => 1
	          );
	          $this->db->insert('tbl_uproduct_details',$uprod);
		    }else{
		    	$uprod = array(
	          	'prod_inq_id' => $inqid,
	          	'prod_module_id' => 19,
				'prod_pro_id' => 1,
				'prod_type_id' => 1,
				'prod_cat_id' => 1
	          );
	          $this->db->insert('tbl_uproduct_details',$uprod);
		    }
          //*****************************************************************
          $contact = array(
          	'con_no_inq_id' => $inqid,
          	'con_no_module_id' => 19,
			'con_no_mnos' => $data['contactno'],
			'con_no_hnos' => $data['contactno2']
          );
          $this->db->insert('tbl_ucontact_nos',$contact);
		//*****************************************************************
          $uappedu = array(
          	'uedu_inq_id' => $inqid,
          	'uedu_module_id' => 19,
			'uedu_full_education' => isset($data['education']) ? $data['education'] : '',
			'uedu_bit' => '1'
          );
          $this->db->insert('tbl_ueducation',$uappedu);
          //*****************************************************************
          $uspsedu = array(
          	'uedu_inq_id' => $inqid,
          	'uedu_module_id' => 19,
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
          if(isset($data['countryeligible']) && $data['countryeligible'] != ''){
		      if( strpos($data['countryeligible'], '/') !== false )
				 {
				     $datas = explode( '/' , $data['countryeligible']);
				     foreach ($datas as $data) {
				     	$this->db->select('*');
					    $this->db->from('tbl_country');
					    $this->db->where('country_code',$data);
					    $query = $this->db->get();
					    if($query->num_rows() > 0){
					    	$country_data = $query->row_array();
					    	$country_id = $country_data['country_id'];
				          	$ucountry = array(
				          	'inqci_inq_id' => $inqid,
				          	'inqci_moduleid' => 19,
							'inqci_countryid' => $country_id,
							'inqci_bit' => '2'
				          );
				          $this->db->insert('tbl_ucountryoption',$ucountry);
					    }
	          }
		    }else{
		    	if($data['countryeligible'] != 'ALL COUNTRY')
		    	{
		    		$this->db->select('*');
				    $this->db->from('tbl_country');
				    $this->db->where('country_code',$data['countryeligible']);
				    $query = $this->db->get();
				    if($query->num_rows() > 0){
				    	$country_data = $query->row_array();
					    $country_id = $country_data['country_id'];
						$ucountry = array(
						'inqci_inq_id' => $inqid,
						'inqci_moduleid' => 19,
						'inqci_countryid' => $country_id,
						'inqci_bit' => '2'
						);
						$this->db->insert('tbl_ucountryoption',$ucountry);
	          		}
		    	}else{
		    		$ucountry = array(
						'inqci_inq_id' => $inqid,
						'inqci_moduleid' => 19,
						'inqci_bit' => '2',
						'inqci_isallcountry' => '1'
						);
						$this->db->insert('tbl_ucountryoption',$ucountry);
		    	}
		    		

		   	}
	    }
          //*****************************************************************
          $uaddress = array(
          	'add_inq_id' => $inqid,
          	'add_module_id' => 19,
			'add_country' => 105, 
			'add_state' => 10,
			'add_city' => 9,
			'add_area_text' => isset($data['areaname']) ? $data['areaname'] : '',
          );
          $this->db->insert('tbl_uaddress',$uaddress);
		//*****************************************************************
          $bdetails = array(
          	'bd_inq_id' => $inqid,
          	'bd_module_id' => 19,
          	'bd_fullname' => isset($data['clientname']) ? $data['clientname'] :'',
          	'bd_company_name' => isset($data['compnayname']) ? $data['compnayname'] :'',
          	'bd_email' => isset($data['email']) ? $data['email'] :'',
          	'bd_age' => isset($data['age']) ? $data['age'] :'',
          	'bd_calldate' => isset($data['calldate']) ? date("Y-m-d", strtotime($data['calldate'])) :'',
          	'bd_fudate' => isset($data['fudate']) ? date("Y-m-d", strtotime($data['fudate'])) :'',
          	'bd_executive' => isset($data['executive']) ? $data['executive'] :'',
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
}
?>