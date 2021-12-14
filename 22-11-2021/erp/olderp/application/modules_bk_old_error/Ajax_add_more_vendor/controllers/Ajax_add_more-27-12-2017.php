<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_add_more extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
		$loggedin = $this->is_loggedin(); 
		if($loggedin == false)
		{
			redirect(base_url().'login');
		}
		$this->load->model('ajax_add_more_model');
		$this->load->model('Inquiry/inquiry_model');
		$this->load->model('User/User_model');
		$this->load->model('Admin_users/admin_users_model');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
	}

	public function ajax_global()
	{
		$str = $this->education_add_more(0);
	}

	public function uf_plclive_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) 
			{ $inc = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) 
				{ $inc++;
					$fields = array( 
						'headdata' => array(
								'0' => array(
									'heading' => 'Duration From YY/MM/DD',
									'col_size' => 2
								),
								'1' => array(
									'heading' => 'Duration To YY/MM/DD',
									'col_size' => 2
								),
								'2' => array(
									'heading' => 'Country',
									'col_size' => 2
								),
								'3' => array(
									'heading' => 'State',
									'col_size' => 2
								),
								'4' => array(
									'heading' => 'City',
									'col_size' => 2
								)
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'plclive_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'plclivehname',
					'hidinputid' => $suffix.'plclivehid',
					'hidinputcls' => $suffix.'plclivehcls',
					'anchoraddmoreid' => $suffix.'plcliveaddid',
					'main_heading_hthree' => '',
					'results' => array(
						'0' => array(
								'heading' => 'Duration From YY/MM/DD',
								'type' => 'date',
								'name' => $suffix.'plclive_start[]',
								'id' => $suffix.'plclive_start'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'plclive_start'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'1' => array(
								'heading' => 'Duration To YY/MM/DD',
								'type' => 'date',
								'name' => $suffix.'plclive_to[]',
								'id' => $suffix.'plclive_to'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'plclive_to'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'2' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'plcadd1_country[]',
								'id' => $suffix.'plcadd1_country'.$aid,
								'class' => 'bs-select form-control country '.$suffix.'plcadd1_country'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'State',
								'type' => 'select',
								'name' => $suffix.'plcadd1_state[]',
								'id' => $suffix.'plcadd1_state'.$aid,
								'class' => 'bs-select form-control state '.$suffix.'plcadd1_state'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'City',
								'type' => 'select',
								'name' => $suffix.'add1_city[]',
								'id' => $suffix.'plcadd1_city'.$aid,
								'class' => 'bs-select form-control city '.$suffix.'plcadd1_city'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
					$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'plclive_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
				}
			}
			$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
			echo json_encode($value);
		}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
		{
			$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$educations = $this->User_model->get_place_lived($idencr,$bit);
					$estr = ''; 
					$educount  = count($educations);
					if($educount == 0)
					{
						$educations = array(
								'0' => array(
								'plived_dur_from' => '',
								'plived_dur_to' => '',
								'plived_country' => '',
								'plived_state' => '',
								'plived_city' => '',
								'plived_udate' => '',
								)
							);
							$educount = 1;
					}
					foreach ($educations as $education) { $aid++;
						//echo "<pre>"; print_r($education); die;
						if(isset($education['plived_dur_from']) && $education['plived_dur_from'] == '1970-01-01') 
                        {
                          $plived_dur_from = '';
                        }else{
                          $plived_dur_from = date("d-m-Y", strtotime($education['plived_dur_from']));
                        }
                        if(isset($education['plived_dur_to']) && $education['plived_dur_to'] == '1970-01-01') 
                        {
                          $plived_dur_to = '';
                        }else{
                          $plived_dur_to = date("d-m-Y", strtotime($education['plived_dur_to']));
                        }
					$fields = array( 
					'headdata' => array(
								'0' => array(
											'heading' => 'Duration From YY/MM/DD',
											'col_size' => 2
										),
										'1' => array(
											'heading' => 'Duration To YY/MM/DD',
											'col_size' => 2
										),
										'2' => array(
											'heading' => 'Country',
											'col_size' => 2
										),
										'3' => array(
											'heading' => 'State',
											'col_size' => 2
										),
										'4' => array(
											'heading' => 'City',
											'col_size' => 2
										)
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'plclive_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'plclivehname',
					'hidinputid' => $suffix.'plclivehid',
					'hidinputcls' => $suffix.'plclivehcls',
					'anchoraddmoreid' => $suffix.'plcliveaddid',
					'main_heading_hthree' => '',
					'results' => array(
						'0' => array(
								'heading' => 'Duration From YY/MM/DD',
								'type' => 'date',
								'name' => $suffix.'plclive_start[]',
								'id' => $suffix.'plclive_start'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'plclive_start'.$aid,
								'value_type' => 'no_value',
								'value' => $plived_dur_from,
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'1' => array(
								'heading' => 'Duration To YY/MM/DD',
								'type' => 'date',
								'name' => $suffix.'plclive_to[]',
								'id' => $suffix.'plclive_to'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'plclive_to'.$aid,
								'value_type' => 'no_value',
								'value' => $plived_dur_to,
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'2' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'plcadd1_country[]',
								'id' => $suffix.'plcadd1_country'.$aid,
								'class' => 'bs-select form-control country '.$suffix.'plcadd1_country'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => isset($education['plived_country']) ? $education['plived_country'] : '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'State',
								'type' => 'select',
								'name' => $suffix.'plcadd1_state[]',
								'id' => $suffix.'plcadd1_state'.$aid,
								'class' => 'bs-select form-control state '.$suffix.'plcadd1_state'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => isset($education['plived_state']) ? $education['plived_state'] : '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => 'tbl_master_state',
								'table_details' => array(
													'table_name' => 'tbl_master_state',
													'auto_id' => 'state_id',
													'result_field' => 'state_name',
													'delete_id' => 'state_isdelete',
													'order_by_field' => 'state_name',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														'0' => array(
															'field' => 'state_country',
															'value' => isset($education['plived_country']) ? $education['plived_country'] : ''
															)
														)
									)
								),
						'4' => array(
								'heading' => 'City',
								'type' => 'select',
								'name' => $suffix.'plcadd1_city[]',
								'id' => $suffix.'plcadd1_city'.$aid,
								'class' => 'bs-select form-control city '.$suffix.'plcadd1_city'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => isset($education['plived_city']) ? $education['plived_city'] : '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => 'tbl_master_city',
								'table_details' => array(
													'table_name' => 'tbl_master_city',
													'auto_id' => 'city_id',
													'result_field' => 'city_name',
													'delete_id' => 'city_isdelete',
													'order_by_field' => 'city_name',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														'0' => array(
															'field' => 'city_country',
															'value' => isset($education['plived_country']) ? $education['plived_country'] : ''
															),
														'1' => array(
															'field' => 'city_state',
															'value' => isset($education['plived_state']) ? $education['plived_state'] : ''
															)
														)
									)
								)
						)
					);
				if($educount == $aid)
				{
					$has_addmore = 'yes';
				}else{
					$has_addmore = 'no';
				}
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
			}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
							'headdata' => array(
										'0' => array(
											'heading' => 'Duration From YY/MM/DD',
											'col_size' => 2
										),
										'1' => array(
											'heading' => 'Duration To YY/MM/DD',
											'col_size' => 2
										),
										'2' => array(
											'heading' => 'Country',
											'col_size' => 2
										),
										'3' => array(
											'heading' => 'State',
											'col_size' => 2
										),
										'4' => array(
											'heading' => 'City',
											'col_size' => 2
										)
									),
							'designformat' => 'vertical',
							'headmainclass' => 'edu_info',
							'resultmainclass' => 'edu_all',
							'ajaxaddmorecls' => $suffix.'plclive_add_more',
							'col_no' => 1,
							'hidinputname' => $suffix.'plclivehname',
							'hidinputid' => $suffix.'plclivehid',
							'hidinputcls' => $suffix.'plclivehcls',
							'anchoraddmoreid' => $suffix.'plcliveaddid',
							'main_heading_hthree' => '',
							'results' => array()
						);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'plclive_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
		
	}

	
	public function education_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) 
			{ $inc = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) 
				{ $inc++;
					$fields = array( 
						'headdata' => array(
								'0' => array(
									'heading' => 'Education',
									'col_size' => 2
								),
								'1' => array(
									'heading' => 'Subject/Stream',
									'col_size' => 2
								),
								'2' => array(
									'heading' => '%',
									'col_size' => 1
								),
								'3' => array(
									'heading' => 'Back Logs',
									'col_size' => 1
								),
								'4' => array(
									'heading' => 'Start MM/YYYY',
									'col_size' => 2
								),
								'5' => array(
									'heading' => 'End MM/YYYY',
									'col_size' => 2
								),
								'6' => array(
									'heading' => 'University/Board',
									'col_size' => 2
								),
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'edu_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'eduhname',
					'hidinputid' => $suffix.'eduhid',
					'hidinputcls' => $suffix.'eduhcls',
					'anchoraddmoreid' => $suffix.'eduaddid',
					'main_heading_hthree' => 'Education Details',
					'results' => array(
						'0' => array(
								'heading' => 'Education',
								'type' => 'select',
								'name' => $suffix.'edu[]',
								'id' => $suffix.'edu'.$aid,
								'class' => 'bs-select form-control'.$suffix.'edu'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => 'tbl_education',
								'table_details' => array(
													'table_name' => 'tbl_education',
													'auto_id' => 'edu_id',
													'result_field' => 'edu_name',
													'delete_id' => 'edu_is_delete',
													'order_by_field' => 'edu_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Subject/Stream',
								'type' => 'select',
								'name' => $suffix.'subject[]',
								'id' => $suffix.'subject'.$aid,
								'class' => 'bs-select form-control'.$suffix.'subject'.$aid,
								'value_type' => 'master',
								'value' => '',
								'table_name' => 'tbl_edusubject',
								'col_size' => 2,
								'autoval' => $aid,
								'table_details' => array(
													'table_name' => 'tbl_edusubject',
													'auto_id' => 'sub_id',
													'result_field' => 'sub_name',
													'delete_id' => 'sub_is_delete',
													'order_by_field' => 'sub_id',
													'order_by' => 'ASC'
													)
								),
						'2' => array(
								'heading' => '%',
								'type' => 'input',
								'name' => $suffix.'per[]',
								'id' => $suffix.'per'.$aid,
								'class' => 'form-control '.$suffix.'per'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Back Logs',
								'type' => 'input',
								'name' => $suffix.'backlogs[]',
								'id' => $suffix.'backlogs'.$aid,
								'class' => 'form-control '.$suffix.'backlogs'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'start[]',
								'id' => $suffix.'start'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'start'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'5' => array(
								'heading' => 'End MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'end[]',
								'id' => $suffix.'end'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'end'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'6' => array(
								'heading' => 'University/Board',
								'type' => 'input',
								'name' => $suffix.'uni[]',
								'id' => $suffix.'uni'.$aid,
								'class' => 'form-control '.$suffix.'uni'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
					$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'edu_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
				}
			}
			$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
			echo json_encode($value);
		}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
		{
			$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$educations = $this->inquiry_model->get_uedu($idencr,$bit);
					$estr = ''; 
					$educount  = count($educations);
					foreach ($educations as $education) { $aid++;
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Education',
									'col_size' => 2
								),
								'1' => array(
									'heading' => 'Subject/Stream',
									'col_size' => 2
								),
								'2' => array(
									'heading' => '%',
									'col_size' => 1
								),
								'3' => array(
									'heading' => 'Back Logs',
									'col_size' => 1
								),
								'4' => array(
									'heading' => 'Start MM/YYYY',
									'col_size' => 2
								),
								'5' => array(
									'heading' => 'End MM/YYYY',
									'col_size' => 2
								),
								'6' => array(
									'heading' => 'University/Board',
									'col_size' => 2
								),
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'edu_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'eduhname',
					'hidinputid' => $suffix.'eduhid',
					'hidinputcls' => $suffix.'eduhcls',
					'anchoraddmoreid' => $suffix.'eduaddid',
					'main_heading_hthree' => 'Education Details',
					'results' => array(
						'0' => array(
								'heading' => 'Education',
								'type' => 'select',
								'name' => $suffix.'edu[]',
								'id' => $suffix.'edu'.$aid,
								'class' => 'bs-select form-control'.$suffix.'edu'.$aid,
								'value_type' => 'master',
								'value' => $education['uedu_education'],
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => 'tbl_education',
								'table_details' => array(
													'table_name' => 'tbl_education',
													'auto_id' => 'edu_id',
													'result_field' => 'edu_name',
													'delete_id' => 'edu_is_delete',
													'order_by_field' => 'edu_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Subject/Stream',
								'type' => 'select',
								'name' => $suffix.'subject[]',
								'id' => $suffix.'subject'.$aid,
								'class' => 'form-control '.$suffix.'subject'.$aid,
								'value_type' => 'master',
								'value' => $education['uedu_subject'],
								'table_name' => 'tbl_edusubject',
								'col_size' => 2,
								'autoval' => $aid,
								'table_details' => array(
													'table_name' => 'tbl_edusubject',
													'auto_id' => 'sub_id',
													'result_field' => 'sub_name',
													'delete_id' => 'sub_is_delete',
													'order_by_field' => 'sub_id',
													'order_by' => 'ASC'
													)
								),
						'2' => array(
								'heading' => '%',
								'type' => 'input',
								'name' => $suffix.'per[]',
								'id' => $suffix.'per'.$aid,
								'class' => 'form-control '.$suffix.'per'.$aid,
								'value_type' => 'no_value',
								'value' => $education['uedu_per'],
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Back Logs',
								'type' => 'input',
								'name' => $suffix.'backlogs[]',
								'id' => $suffix.'backlogs'.$aid,
								'class' => 'form-control '.$suffix.'backlogs'.$aid,
								'value_type' => 'no_value',
								'value' => $education['uedu_backlogs'],
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'start[]',
								'id' => $suffix.'start'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'start'.$aid,
								'value_type' => 'no_value',
								'value' => date("d-m-Y", strtotime($education['uedu_start'])),
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'5' => array(
								'heading' => 'End MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'end[]',
								'id' => $suffix.'end'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'end'.$aid,
								'value_type' => 'no_value',
								'value' => date("d-m-Y", strtotime($education['uedu_end'])),
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'6' => array(
								'heading' => 'University/Board',
								'type' => 'input',
								'name' => $suffix.'uni[]',
								'id' => $suffix.'uni'.$aid,
								'class' => 'form-control '.$suffix.'uni'.$aid,
								'value_type' => 'no_value',
								'value' => $education['uedu_university'],
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
			)
					);
				if($educount == $aid)
				{
					$has_addmore = 'yes';
				}else{
					$has_addmore = 'no';
				}
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
			}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
							'headdata' => array(
										'0' => array(
											'heading' => 'Education',
											'col_size' => 2
										),
										'1' => array(
											'heading' => 'Subject/Stream',
											'col_size' => 2
										),
										'2' => array(
											'heading' => '%',
											'col_size' => 1
										),
										'3' => array(
											'heading' => 'Back Logs',
											'col_size' => 1
										),
										'4' => array(
											'heading' => 'Start MM/YYYY',
											'col_size' => 2
										),
										'5' => array(
											'heading' => 'End MM/YYYY',
											'col_size' => 2
										),
										'6' => array(
											'heading' => 'University/Board',
											'col_size' => 2
										),
									),
							'designformat' => 'vertical',
							'headmainclass' => 'edu_info',
							'resultmainclass' => 'edu_all',
							'ajaxaddmorecls' => $suffix.'edu_add_more',
							'col_no' => 1,
							'hidinputname' => $suffix.'eduhname',
							'hidinputid' => $suffix.'eduhid',
							'hidinputcls' => $suffix.'eduhcls',
							'anchoraddmoreid' => $suffix.'eduaddid',
							'main_heading_hthree' => 'Education Details',
							'results' => array()
						);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'edu_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
		
	}

	public function uf_edulang_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Test Report Form No ',
									'col_size' => 6
								),
								'8' => array(
									'heading' => 'Center No',
									'col_size' => 5
								),
								'9' => array(
									'heading' => 'General/Academic',
									'col_size' => 6
								),
								'10' => array(
									'heading' => 'Remark',
									'col_size' => 5
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'ufedulng_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'ufedulnghname',
					'hidinputid' => $suffix.'ufedulnghid',
					'hidinputcls' => $suffix.'ufedulnghcls',
					'anchoraddmoreid' => $suffix.'ufedulngaddid',
					'main_heading_hthree' => '',
					'results' => array(
						'0' => array(
								'heading' => 'Language',
								'type' => 'select',
								'name' => $suffix.'ufedulang[]',
								'id' => $suffix.'ufedulang'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_language',
								'table_details' => array(
													'table_name' => 'tbl_language',
													'auto_id' => 'lang_id',
													'result_field' => 'lang_name',
													'delete_id' => 'lang_is_delete',
													'order_by_field' => 'lang_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Reading',
								'type' => 'input',
								'name' => $suffix.'ufedulang_read[]',
								'id' => $suffix.'ufedulang_read'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_read'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Writing',
								'type' => 'input',
								'name' => $suffix.'ufedulang_write[]',
								'id' => $suffix.'ufedulang_write'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_write'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Listening',
								'type' => 'input',
								'name' => $suffix.'ufeduufedulang_listen[]',
								'id' => $suffix.'ufedulang_listen'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_listen'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Speaking',
								'type' => 'input',
								'name' => 'ufedulang_speak[]',
								'id' => $suffix.'ufedulang_speak'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_speak'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Over All',
								'type' => 'input',
								'name' => $suffix.'ufedulang_overall[]',
								'id' => $suffix.'ufedulang_overall'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_overall'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Expiry Date',
								'type' => 'date',
								'name' => $suffix.'ufedulang_expdate[]',
								'id' => $suffix.'ufedulang_expdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'ufedulang_expdate'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'7' => array(
								'heading' => 'Test Report Form No',
								'type' => 'input',
								'name' => $suffix.'ufedulang_no[]',
								'id' => $suffix.'ufedulang_no'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_no'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 5,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'8' => array(
								'heading' => 'Center No',
								'type' => 'input',
								'name' => $suffix.'ufedulang_cno[]',
								'id' => $suffix.'ufedulang_cno'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_cno'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'9' => array(
								'heading' => 'General/Academic',
								'type' => 'select',
								'name' => $suffix.'ufedulang_gen[]',
								'id' => $suffix.'ufedulang_gen'.$aid,
								'class' => 'form-control'.$suffix.'ufedulang_gen'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_val' => '1',
													'option_text' => 'General'
													),
											'1' => array(
													'option_val' => '2',
													'option_text' => 'Academic'
													),
											),
								'col_size' => 6,
								'head_col_size' => 3,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'10' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'ufedulang_remrk[]',
								'id' => $suffix.'ufedulang_remrk'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_remrk'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'ufedulng_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
	{
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		//$this->load->model('Inquiry/Inquiry_model');
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
				if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$languages = $this->User_model->get_ulang($idencr,$bit);
					
					$estr = ''; 
					$langcount  = count($languages);
					if($langcount == 0)
					{
						$languages = array(
							'0' => array(
							'ul_id' => '',
							'ul_module_id' => '',
							'ul_inq_id' => '',
							'ul_uf_id' => '',
							'ul_lang_id' => '',
							'ul_reading' => '',
							'ul_writing' => '',
							'ul_listening' => '',
							'ul_speaking' => '',
							'ul_overall' => '',
							'ul_exp_date' => '',
							'ul_form_no' => '',
							'ul_center_no' => '',
							'ul_lang_type' => '',
							'ul_remark' => '',
							'ul_udate' => '',
							'ul_bit' => ''
							)
							);
							$langcount = 1;
					}
					foreach ($languages as $language) { $aid++;
						//echo "<pre>"; print_r($language); die;
                      		if(isset($language['ul_exp_date']) && $language['ul_exp_date'] == '1970-01-01') 
                            {
                              $ul_exp_date = '';
                            }else{
                              $ul_exp_date = date("d-m-Y", strtotime($language['ul_exp_date']));
                            }
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Test Report Form No ',
									'col_size' => 6
								),
								'8' => array(
									'heading' => 'Center No',
									'col_size' => 5
								),
								'9' => array(
									'heading' => 'General/Academic',
									'col_size' => 6
								),
								'10' => array(
									'heading' => 'Remark',
									'col_size' => 5
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'ufedulng_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'ufedulnghname',
					'hidinputid' => $suffix.'ufedulnghid',
					'hidinputcls' => $suffix.'ufedulnghcls',
					'anchoraddmoreid' => $suffix.'ufedulngaddid',
					'main_heading_hthree' => '',
					'results' => array(
						'0' => array(
								'heading' => 'Language',
								'type' => 'select',
								'name' => $suffix.'ufedulang[]',
								'id' => $suffix.'ufedulang'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang'.$aid,
								'value_type' => 'master',
								'value' => $language['ul_lang_id'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_language',
								'table_details' => array(
													'table_name' => 'tbl_language',
													'auto_id' => 'lang_id',
													'result_field' => 'lang_name',
													'delete_id' => 'lang_is_delete',
													'order_by_field' => 'lang_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Reading',
								'type' => 'input',
								'name' => $suffix.'ufedulang_read[]',
								'id' => $suffix.'ufedulang_read'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_read'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_reading'],
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Writing',
								'type' => 'input',
								'name' => $suffix.'ufedulang_write[]',
								'id' => $suffix.'ufedulang_write'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_write'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_writing'],
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Listening',
								'type' => 'input',
								'name' => $suffix.'ufeduufedulang_listen[]',
								'id' => $suffix.'ufedulang_listen'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_listen'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_listening'],
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Speaking',
								'type' => 'input',
								'name' => 'ufedulang_speak[]',
								'id' => $suffix.'ufedulang_speak'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_speak'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_speaking'],
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Over All',
								'type' => 'input',
								'name' => $suffix.'ufedulang_overall[]',
								'id' => $suffix.'ufedulang_overall'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_overall'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_overall'],
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Expiry Date',
								'type' => 'date',
								'name' => $suffix.'ufedulang_expdate[]',
								'id' => $suffix.'ufedulang_expdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'ufedulang_expdate'.$aid,
								'value_type' => 'no_value',
								'value' => $ul_exp_date,
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'7' => array(
								'heading' => 'Test Report Form No',
								'type' => 'input',
								'name' => $suffix.'ufedulang_no[]',
								'id' => $suffix.'ufedulang_no'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_no'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_form_no'],
								'col_size' => 6,
								'head_col_size' => 5,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'8' => array(
								'heading' => 'Center No',
								'type' => 'input',
								'name' => $suffix.'ufedulang_cno[]',
								'id' => $suffix.'ufedulang_cno'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_cno'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_center_no'],
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'9' => array(
								'heading' => 'General/Academic',
								'type' => 'select',
								'name' => $suffix.'ufedulang_gen[]',
								'id' => $suffix.'ufedulang_gen'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_gen'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_val' => '1',
													'option_text' => 'General'
													),
											'1' => array(
													'option_val' => '2',
													'option_text' => 'Academic'
													),
											),
								'col_size' => 6,
								'head_col_size' => 3,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'10' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'ufedulang_remrk[]',
								'id' => $suffix.'ufedulang_remrk'.$aid,
								'class' => 'form-control '.$suffix.'ufedulang_remrk'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_remark'],
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
						if($langcount == $aid)
						{
							$has_addmore = 'yes';
						}else{
							$has_addmore = 'no';
						}
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Test Report Form No ',
									'col_size' => 6
								),
								'8' => array(
									'heading' => 'Center No',
									'col_size' => 5
								),
								'9' => array(
									'heading' => 'General/Academic',
									'col_size' => 6
								),
								'10' => array(
									'heading' => 'Remark',
									'col_size' => 5
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'ufedulng_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'ufedulnghname',
					'hidinputid' => $suffix.'ufedulnghid',
					'hidinputcls' => $suffix.'ufedulnghcls',
					'anchoraddmoreid' => $suffix.'ufedulngaddid',
					'main_heading_hthree' => '',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
					$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'ufedulng_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
		
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}
	}

	public function uf_child_add_more($aid = false)
	{
		$onlyaddmore = 0;
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'First Name(as per passport)',
									'col_size' => 6
								),
								'1' => array(
									'heading' => 'Middle Name',
									'col_size' => 6
								),
								'2' => array(
									'heading' => 'Last Name',
									'col_size' => 6
								),
								'3' => array(
									'heading' => 'Date of Birth',
									'col_size' => 6
								),
								'4' => array(
									'heading' => 'Place of Birth',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Passport No.',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Place of issue',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Date of issue',
									'col_size' => 4
								),
								'8' => array(
									'heading' => 'Date of Expiry',
									'col_size' => 6
								),
								'9' => array(
									'heading' => 'Height(cms)',
									'col_size' => 4
								),
								'10' => array(
									'heading' => 'Color of Eyes',
									'col_size' => 4
								),
								'11' => array(
									'heading' => 'No. of years of completed education',
									'col_size' => 4
								),
								'12' => array(
									'heading' => 'Gender',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'ufchld_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'ufchldhname',
					'hidinputid' => $suffix.'ufchldhid',
					'hidinputcls' => $suffix.'ufchldhcls',
					'anchoraddmoreid' => $suffix.'ufchldaddid',
					'main_heading_hthree' => 'Child 1',
					'results' => array(
						'0' => array(
								'heading' => 'First Name(as per passport)',
								'type' => 'input',
								'name' => $suffix.'uf_fname[]',
								'id' => $suffix.'uf_fname'.$aid,
								'class' => 'form-control '.$suffix.'uf_fname'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								),
						'1' => array(
								'heading' => 'Middle Name',
								'type' => 'input',
								'name' => $suffix.'uf_mname[]',
								'id' => $suffix.'uf_mname'.$aid,
								'class' => 'form-control '.$suffix.'uf_mname'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Last Name',
								'type' => 'input',
								'name' => $suffix.'uf_lname[]',
								'id' => $suffix.'uf_lname'.$aid,
								'class' => 'form-control '.$suffix.'uf_lname'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Date of Birth',
								'type' => 'date',
								'name' => $suffix.'uf_dob[]',
								'id' => $suffix.'uf_dob'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'uf_dob'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'4' => array(
								'heading' => 'Place of Birth',
								'type' => 'input',
								'name' => $suffix.'uf_plcbrth[]',
								'id' => $suffix.'uf_plcbrth'.$aid,
								'class' => 'form-control '.$suffix.'uf_plcbrth'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Passport No.',
								'type' => 'input',
								'name' => $suffix.'uf_passno[]',
								'id' => $suffix.'uf_passno'.$aid,
								'class' => 'form-control '.$suffix.'uf_passno'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Place of issue',
								'type' => 'input',
								'name' => $suffix.'uf_plcissue[]',
								'id' => $suffix.'uf_plcissue'.$aid,
								'class' => 'form-control '.$suffix.'uf_plcissue'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'7' => array(
								'heading' => 'Date of issue',
								'type' => 'date',
								'name' => $suffix.'uf_doi[]',
								'id' => $suffix.'uf_doi'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'uf_doi'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'8' => array(
								'heading' => 'Date of Expiry',
								'type' => 'date',
								'name' => $suffix.'uf_doe[]',
								'id' => $suffix.'uf_doe'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'uf_doe'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'9' => array(
								'heading' => 'Height(cms)',
								'type' => 'input',
								'name' => $suffix.'uf_height[]',
								'id' => $suffix.'uf_height'.$aid,
								'class' => 'form-control '.$suffix.'uf_height'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'10' => array(
								'heading' => 'Color of Eyes',
								'type' => 'input',
								'name' => $suffix.'uf_clreyes[]',
								'id' => $suffix.'uf_clreyes'.$aid,
								'class' => 'form-control '.$suffix.'uf_clreyes'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'11' => array(
								'heading' => 'No. of years of completed education',
								'type' => 'input',
								'name' => $suffix.'uf_compedu[]',
								'id' => $suffix.'uf_compedu'.$aid,
								'class' => 'form-control '.$suffix.'uf_compedu'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'12' => array(
								'heading' => 'Gender',
								'type' => 'checkbox',
								'name' => $suffix.'ch_gender[]',
								'id' => $suffix.'ch_gender'.$aid,
								'class' => 'form-control '.$suffix.'ch_gender'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_name' => $suffix.'ch_gender['.$aid.']',
													'option_id' => $suffix.'ch_gender',
													'option_val' => '1',
													'option_text' => 'Male',
													'option_checked' => 'checked="checked"'
													),
											'1' => array(
													'option_name' => $suffix.'ch_gender['.$aid.']',
													'option_id' => $suffix.'ch_gender',
													'option_val' => '2',
													'option_text' => 'Female',
													'option_checked' => ''
													),
											),
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								)
						)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'ufchld_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
	{
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		//$this->load->model('Inquiry/Inquiry_model');
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
				//echo 'hiiiiiiii';die;
					$languages = $this->User_model->get_uchild($idencr);
					//echo "<pre>"; print_r($languages); die;
					$estr = ''; 
					$langcount  = count($languages);
					if($langcount == 0)
					{
						$languages = array(
							'0' => array(
							'uchild_fname' => '',
							'uchild_mname' => '',
							'uchild_lname' => '',
							'uchild_dob' => '',
							'uchild_pob' => '',
							'uchild_height' => '',
							'uchild_colour_of_eyes' => '',
							'uchild_edu_years' => '',
							'passport' => array(
				                    'up_pp_no' => '',
				                    'up_pof_issue' => '',
				                    'up_dof_issue' => '',
				                    'up_dof_expiry'=> ''
			                    )
							)
							);
							$langcount = 1;
					}
					foreach ($languages as $language) { $aid++;
						//echo "<pre>"; print_r($language); die;
						if(isset($language['uchild_gender']) && ($language['uchild_gender'] == 1))
						{
							$ystr = 'checked="checked"';
							$nstr = '';
						}else if(isset($language['uchild_gender']) && ($language['uchild_gender'] == 2))
						{
							$nstr = 'checked="checked"';
							$ystr = '';
						}else{
							$ystr = '';
							$nstr = '';
						}
						if(isset($language['uchild_dob']) && $language['uchild_dob'] == '1970-01-01')
						{
							$uchild_dob = '';
						}else{
							$uchild_dob = date("d-m-Y", strtotime($language['uchild_dob']));
						}
						if(isset($language['passport']['up_dof_issue']) && $language['passport']['up_dof_issue'] == '1970-01-01')
						{
							$up_dof_issue = '';
						}else{
							$up_dof_issue = date("d-m-Y", strtotime($language['passport']['up_dof_issue']));
						}
						if(isset($language['passport']['up_dof_expiry']) && $language['passport']['up_dof_expiry'] == '1970-01-01')
						{
							$up_dof_expiry = '';
						}else{
							$up_dof_expiry = date("d-m-Y", strtotime($language['passport']['up_dof_expiry']));
						}
						//$language['uchild_height']
						if(isset($language['uchild_height']) && $language['uchild_height'] == '0')
						{
							$uchild_height = '';
						}else{
							$uchild_height = $language['uchild_height'];
						}
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'First Name(as per passport)',
									'col_size' => 6
								),
								'1' => array(
									'heading' => 'Middle Name',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Last Name',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Date of Birth',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Place of Birth',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Passport No.',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Place of issue',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Date of issue',
									'col_size' => 4
								),
								'8' => array(
									'heading' => 'Date of Expiry',
									'col_size' => 4
								),
								'9' => array(
									'heading' => 'Height(cms)',
									'col_size' => 4
								),
								'10' => array(
									'heading' => 'Color of Eyes',
									'col_size' => 4
								),
								'11' => array(
									'heading' => 'No. of years of completed education',
									'col_size' => 4
								),
								'12' => array(
									'heading' => 'Gender',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'ufchld_add_more',
					'col_no' => $aid,
					'ajaxaddmorecls' => $suffix.'ufchld_add_more',
					'hidinputname' => $suffix.'ufchldhname',
					'hidinputid' => $suffix.'ufchldhid',
					'hidinputcls' => $suffix.'ufchldhcls',
					'anchoraddmoreid' => $suffix.'ufchldaddid',
					'main_heading_hthree' => 'Child 1',
					'results' => array(
						'0' => array(
								'heading' => 'First Name(as per passport)',
								'type' => 'input',
								'name' => $suffix.'uf_fname[]',
								'id' => $suffix.'uf_fname'.$aid,
								'class' => 'form-control '.$suffix.'uf_fname'.$aid,
								'value_type' => 'no_value',
								'value' => $language['uchild_fname'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								),
						'1' => array(
								'heading' => 'Middle Name',
								'type' => 'input',
								'name' => $suffix.'uf_mname[]',
								'id' => $suffix.'uf_mname'.$aid,
								'class' => 'form-control '.$suffix.'uf_mname'.$aid,
								'value_type' => 'no_value',
								'value' => $language['uchild_mname'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Last Name',
								'type' => 'input',
								'name' => $suffix.'uf_lname[]',
								'id' => $suffix.'uf_lname'.$aid,
								'class' => 'form-control '.$suffix.'uf_lname'.$aid,
								'value_type' => 'no_value',
								'value' => $language['uchild_lname'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Date of Birth',
								'type' => 'date',
								'name' => $suffix.'uf_dob[]',
								'id' => $suffix.'uf_dob'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'uf_dob'.$aid,
								'value_type' => 'no_value',
								'value' => $uchild_dob,
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'4' => array(
								'heading' => 'Place of Birth',
								'type' => 'input',
								'name' => $suffix.'uf_plcbrth[]',
								'id' => $suffix.'uf_plcbrth'.$aid,
								'class' => 'form-control '.$suffix.'uf_plcbrth'.$aid,
								'value_type' => 'no_value',
								'value' => $language['uchild_pob'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Passport No.',
								'type' => 'input',
								'name' => $suffix.'uf_passno[]',
								'id' => $suffix.'uf_passno'.$aid,
								'class' => 'form-control '.$suffix.'uf_passno'.$aid,
								'value_type' => 'no_value',
								'value' => $language['passport']['up_pp_no'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Place of issue',
								'type' => 'input',
								'name' => $suffix.'uf_plcissue[]',
								'id' => $suffix.'uf_plcissue'.$aid,
								'class' => 'form-control '.$suffix.'uf_plcissue'.$aid,
								'value_type' => 'no_value',
								'value' => $language['passport']['up_pof_issue'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'7' => array(
								'heading' => 'Date of issue',
								'type' => 'date',
								'name' => $suffix.'uf_doi[]',
								'id' => $suffix.'uf_doi'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'uf_doi'.$aid,
								'value_type' => 'no_value',
								'value' => $up_dof_issue,
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'8' => array(
								'heading' => 'Date of Expiry',
								'type' => 'date',
								'name' => $suffix.'uf_doe[]',
								'id' => $suffix.'uf_doe'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'uf_doe'.$aid,
								'value_type' => 'no_value',
								'value' => $up_dof_expiry,
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'9' => array(
								'heading' => 'Height(cms)',
								'type' => 'input',
								'name' => $suffix.'uf_height[]',
								'id' => $suffix.'uf_height'.$aid,
								'class' => 'form-control '.$suffix.'uf_height'.$aid,
								'value_type' => 'no_value',
								'value' => $uchild_height,
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'10' => array(
								'heading' => 'Color of Eyes',
								'type' => 'input',
								'name' => $suffix.'uf_clreyes[]',
								'id' => $suffix.'uf_clreyes'.$aid,
								'class' => 'form-control '.$suffix.'uf_clreyes'.$aid,
								'value_type' => 'no_value',
								'value' => $language['uchild_colour_of_eyes'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'11' => array(
								'heading' => 'No. of years of completed education',
								'type' => 'input',
								'name' => $suffix.'uf_compedu[]',
								'id' => $suffix.'uf_compedu'.$aid,
								'class' => 'form-control '.$suffix.'uf_compedu'.$aid,
								'value_type' => 'no_value',
								'value' => $language['uchild_edu_years'],
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'12' => array(
								'heading' => 'Gender',
								'type' => 'checkbox',
								'name' => $suffix.'gender[]',
								'id' => $suffix.'gender'.$aid,
								'class' => 'form-control '.$suffix.'gender'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_name' => $suffix.'ch_gender['.$aid.']',
													'option_id' => $suffix.'ch_gender',
													'option_val' => '1',
													'option_text' => 'Male',
													'option_checked' => $ystr
													),
											'1' => array(
													'option_name' => $suffix.'ch_gender['.$aid.']',
													'option_id' => $suffix.'ch_gender',
													'option_val' => '2',
													'option_text' => 'Female',
													'option_checked' => $nstr
													),
											),
								'col_size' => 6,
								'head_col_size' => 4,
								'val_col_size' => 5,
								'autoval' => $aid,
								)
						)
					);
						if($langcount == $aid)
						{
							$has_addmore = 'yes';
						}else{
							$has_addmore = 'no';
						}
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'ufchld_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'ufchldhname',
					'hidinputid' => $suffix.'ufchldhid',
					'hidinputcls' => $suffix.'ufchldhcls',
					'anchoraddmoreid' => $suffix.'ufchldaddid',
					'main_heading_hthree' => '',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
					$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'ufchld_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
		
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}
	}

	public function uf_language_add_more($aid = false)
	{
		$onlyaddmore = 0;
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Remark',
									'col_size' => 3
								),
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'lang_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'langhname',
					'hidinputid' => $suffix.'langhid',
					'hidinputcls' => $suffix.'langhcls',
					'anchoraddmoreid' => $suffix.'langaddid',
					'main_heading_hthree' => 'Language',
					'results' => array(
						'0' => array(
								'heading' => 'Language',
								'type' => 'select',
								'name' => $suffix.'lang[]',
								'id' => $suffix.'lang'.$aid,
								'class' => 'form-control '.$suffix.'lang'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_language',
								'table_details' => array(
													'table_name' => 'tbl_language',
													'auto_id' => 'lang_id',
													'result_field' => 'lang_name',
													'delete_id' => 'lang_is_delete',
													'order_by_field' => 'lang_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Reading',
								'type' => 'input',
								'name' => $suffix.'lang_read[]',
								'id' => $suffix.'lang_read'.$aid,
								'class' => 'form-control '.$suffix.'lang_read'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Writing',
								'type' => 'input',
								'name' => $suffix.'lang_write[]',
								'id' => $suffix.'lang_write'.$aid,
								'class' => 'form-control '.$suffix.'lang_write'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Listening',
								'type' => 'input',
								'name' => $suffix.'lang_listen[]',
								'id' => $suffix.'lang_listen'.$aid,
								'class' => 'form-control '.$suffix.'lang_listen'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Speaking',
								'type' => 'input',
								'name' => $suffix.'lang_speak[]',
								'id' => $suffix.'lang_speak'.$aid,
								'class' => 'form-control '.$suffix.'lang_speak'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Over All',
								'type' => 'input',
								'name' => $suffix.'lang_overall[]',
								'id' => $suffix.'lang_overall'.$aid,
								'class' => 'form-control '.$suffix.'lang_overall'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Expiry Date',
								'type' => 'date',
								'name' => $suffix.'lang_expdate[]',
								'id' => $suffix.'lang_expdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'lang_expdate'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'7' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'lang_remrk[]',
								'id' => $suffix.'lang_remrk'.$aid,
								'class' => 'form-control '.$suffix.'lang_remrk'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 3,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'lang_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
	{
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		//$this->load->model('Inquiry/Inquiry_model');
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
				if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$languages = $this->User_model->get_ulang($idencr,$bit);
					$estr = ''; 
					$langcount  = count($languages);
					if($langcount == 0)
					{
						$languages = array(
							'0' => array(
							'ul_id' => '',
							'ul_module_id' => '',
							'ul_inq_id' => '',
							'ul_uf_id' => '',
							'ul_lang_id' => '',
							'ul_reading' => '',
							'ul_writing' => '',
							'ul_listening' => '',
							'ul_speaking' => '',
							'ul_overall' => '',
							'ul_exp_date' => '',
							'ul_form_no' => '',
							'ul_center_no' => '',
							'ul_lang_type' => '',
							'ul_remark' => '',
							'ul_udate' => '',
							'ul_bit' => ''
							)
							);
							$langcount = 1;
					}
					foreach ($languages as $language) { $aid++;
						//echo "<pre>"; print_r($language); die;
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 4
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 4
								),
								'7' => array(
									'heading' => 'Remark',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'lang_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'langhname',
					'hidinputid' => $suffix.'langhid',
					'hidinputcls' => $suffix.'langhcls',
					'anchoraddmoreid' => $suffix.'langaddid',
					'main_heading_hthree' => 'Language',
					'results' => array(
						'0' => array(
								'heading' => 'Language',
								'type' => 'select',
								'name' => $suffix.'lang[]',
								'id' => $suffix.'lang'.$aid,
								'class' => 'form-control '.$suffix.'lang'.$aid,
								'value_type' => 'master',
								'value' => $language['ul_lang_id'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_language',
								'table_details' => array(
													'table_name' => 'tbl_language',
													'auto_id' => 'lang_id',
													'result_field' => 'lang_name',
													'delete_id' => 'lang_is_delete',
													'order_by_field' => 'lang_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Reading',
								'type' => 'input',
								'name' => $suffix.'lang_read[]',
								'id' => $suffix.'lang_read'.$aid,
								'class' => 'form-control '.$suffix.'lang_read'.$aid,
								'value_type' => '',
								'value' => $language['ul_reading'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Writing',
								'type' => 'input',
								'name' => $suffix.'lang_write[]',
								'id' => $suffix.'lang_write'.$aid,
								'class' => 'form-control '.$suffix.'lang_write'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_writing'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Listening',
								'type' => 'input',
								'name' => $suffix.'lang_listen[]',
								'id' => $suffix.'lang_listen'.$aid,
								'class' => 'form-control '.$suffix.'lang_listen'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_listening'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Speaking',
								'type' => 'input',
								'name' => $suffix.'lang_speak[]',
								'id' => $suffix.'lang_speak'.$aid,
								'class' => 'form-control '.$suffix.'lang_speak'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_speaking'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Over All',
								'type' => 'input',
								'name' => $suffix.'lang_overall[]',
								'id' => $suffix.'lang_overall'.$aid,
								'class' => 'form-control '.$suffix.'lang_overall'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_overall'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Expiry Date',
								'type' => 'date',
								'name' => $suffix.'lang_expdate[]',
								'id' => $suffix.'lang_expdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'lang_expdate'.$aid,
								'value_type' => 'no_value',
								'value' => date("d-m-Y", strtotime($language['ul_exp_date'])),
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'7' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'lang_remrk[]',
								'id' => $suffix.'lang_remrk'.$aid,
								'class' => 'form-control '.$suffix.'lang_remrk'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_remark'],
								'col_size' => 3,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
						if($langcount == $aid)
						{
							$has_addmore = 'yes';
						}else{
							$has_addmore = 'no';
						}
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
					'headdata' => array(
								
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'lang_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'langhname',
					'hidinputid' => $suffix.'langhid',
					'hidinputcls' => $suffix.'langhcls',
					'anchoraddmoreid' => $suffix.'langaddid',
					'main_heading_hthree' => 'Language',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
					$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'lang_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
		
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}
	}	


	public function language_add_more($aid = false)
	{
		$onlyaddmore = 0;
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 1
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 1
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 1
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 1
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 2
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 1
								),
								'7' => array(
									'heading' => 'General/Academic',
									'col_size' => 2
								),
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'lang_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'langhname',
					'hidinputid' => $suffix.'langhid',
					'hidinputcls' => $suffix.'langhcls',
					'anchoraddmoreid' => $suffix.'langaddid',
					'main_heading_hthree' => 'Language',
					'results' => array(
						'0' => array(
								'heading' => 'Language',
								'type' => 'select',
								'name' => $suffix.'lang[]',
								'id' => $suffix.'lang'.$aid,
								'class' => 'form-control '.$suffix.'lang'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 3,
								'autoval' => $aid,
								'table_name' => 'tbl_language',
								'table_details' => array(
													'table_name' => 'tbl_language',
													'auto_id' => 'lang_id',
													'result_field' => 'lang_name',
													'delete_id' => 'lang_is_delete',
													'order_by_field' => 'lang_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Reading',
								'type' => 'input',
								'name' => $suffix.'lang_read[]',
								'id' => $suffix.'lang_read'.$aid,
								'class' => 'form-control '.$suffix.'lang_read'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Writing',
								'type' => 'input',
								'name' => $suffix.'lang_write[]',
								'id' => $suffix.'lang_write'.$aid,
								'class' => 'form-control '.$suffix.'lang_write'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Listening',
								'type' => 'input',
								'name' => $suffix.'lang_listen[]',
								'id' => $suffix.'lang_listen'.$aid,
								'class' => 'form-control '.$suffix.'lang_listen'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Speaking',
								'type' => 'input',
								'name' => 'lang_speak[]',
								'id' => 'lang_speak'.$aid,
								'class' => 'form-control '.$suffix.'lang_speak'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Over All',
								'type' => 'input',
								'name' => $suffix.'lang_overall[]',
								'id' => $suffix.'lang_overall'.$aid,
								'class' => 'form-control '.$suffix.'lang_overall'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Expiry Date',
								'type' => 'date',
								'name' => $suffix.'lang_expdate[]',
								'id' => $suffix.'lang_expdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'lang_expdate'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'7' => array(
								'heading' => 'General/Academic',
								'type' => 'select',
								'name' => $suffix.'lang_gen[]',
								'id' => $suffix.'lang_gen'.$aid,
								'class' => 'form-control '.$suffix.'lang_gen'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_val' => '1',
													'option_text' => 'General'
													),
											'1' => array(
													'option_val' => '2',
													'option_text' => 'Academic'
													),
											),
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'lang_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
	{
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		//$this->load->model('Inquiry/Inquiry_model');
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
				if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$languages = $this->inquiry_model->get_ulang($idencr,$bit);
					
					$estr = ''; 
					$langcount  = count($languages);
					foreach ($languages as $language) { $aid++;
						//echo "<pre>"; print_r($language); die;
						# code...
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 1
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 1
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 1
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 1
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 2
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 1
								),
								'7' => array(
									'heading' => 'General/Academic',
									'col_size' => 2
								),
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'lang_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'langhname',
					'hidinputid' => $suffix.'langhid',
					'hidinputcls' => $suffix.'langhcls',
					'anchoraddmoreid' => $suffix.'langaddid',
					'main_heading_hthree' => 'Language',
					'results' => array(
						'0' => array(
								'heading' => 'Language',
								'type' => 'select',
								'name' => $suffix.'lang[]',
								'id' => $suffix.'lang'.$aid,
								'class' => 'form-control '.$suffix.'lang'.$aid,
								'value_type' => 'master',
								'value' => $language['ul_lang_id'],
								'col_size' => 3,
								'autoval' => $aid,
								'table_name' => 'tbl_language',
								'table_details' => array(
													'table_name' => 'tbl_language',
													'auto_id' => 'lang_id',
													'result_field' => 'lang_name',
													'delete_id' => 'lang_is_delete',
													'order_by_field' => 'lang_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Reading',
								'type' => 'input',
								'name' => $suffix.'lang_read[]',
								'id' => $suffix.'lang_read'.$aid,
								'class' => 'form-control '.$suffix.'lang_read'.$aid,
								'value_type' => '',
								'value' => $language['ul_reading'],
								'col_size' => 1,
								'autoval' => $aid,
								),
						'2' => array(
								'heading' => 'Writing',
								'type' => 'input',
								'name' => $suffix.'lang_write[]',
								'id' => $suffix.'lang_write'.$aid,
								'class' => 'form-control '.$suffix.'lang_write'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_writing'],
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Listening',
								'type' => 'input',
								'name' => $suffix.'lang_listen[]',
								'id' => $suffix.'lang_listen'.$aid,
								'class' => 'form-control '.$suffix.'lang_listen'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_listening'],
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Speaking',
								'type' => 'input',
								'name' => 'lang_speak[]',
								'id' => 'lang_speak'.$aid,
								'class' => 'form-control '.$suffix.'lang_speak'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_speaking'],
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Over All',
								'type' => 'input',
								'name' => $suffix.'lang_overall[]',
								'id' => $suffix.'lang_overall'.$aid,
								'class' => 'form-control '.$suffix.'lang_overall'.$aid,
								'value_type' => 'no_value',
								'value' => $language['ul_overall'],
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Expiry Date',
								'type' => 'date',
								'name' => $suffix.'lang_expdate[]',
								'id' => $suffix.'lang_expdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'lang_expdate'.$aid,
								'value_type' => 'no_value',
								'value' => date("d-m-Y", strtotime($language['ul_lang_id'])),
								'col_size' => 1,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'7' => array(
								'heading' => 'General/Academic',
								'type' => 'select',
								'name' => $suffix.'lang_gen[]',
								'id' => $suffix.'lang_gen'.$aid,
								'class' => 'form-control '.$suffix.'lang_gen'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_val' => '1',
													'option_text' => 'General'
													),
											'1' => array(
													'option_val' => '2',
													'option_text' => 'Academic'
													),
											),
								'col_size' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						)
					);
						if($langcount == $aid)
						{
							$has_addmore = 'yes';
						}else{
							$has_addmore = 'no';
						}
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Language',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Reading',
									'col_size' => 1
								),
								'2' => array(
									'heading' => 'Writing',
									'col_size' => 1
								),
								'3' => array(
									'heading' => 'Listening',
									'col_size' => 1
								),
								'4' => array(
									'heading' => 'Speaking',
									'col_size' => 1
								),
								'5' => array(
									'heading' => 'Over All',
									'col_size' => 2
								),
								'6' => array(
									'heading' => 'Expiry Date',
									'col_size' => 1
								),
								'7' => array(
									'heading' => 'General/Academic',
									'col_size' => 2
								),
							),
					'designformat' => 'vertical',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'lang_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'langhname',
					'hidinputid' => $suffix.'langhid',
					'hidinputcls' => $suffix.'langhcls',
					'anchoraddmoreid' => $suffix.'langaddid',
					'main_heading_hthree' => 'Language',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
					$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'lang_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
		
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}
		
	}

	public function exp_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Experience ( In Year )',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Experience In Field',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'exp_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'exphname',
					'hidinputid' => $suffix.'exphid',
					'hidinputcls' => $suffix.'exphcls',
					'anchoraddmoreid' => $suffix.'expaddid',
					'main_heading_hthree' => 'Experience Details',
					'results' => array(
						'0' => array(
								'heading' => 'Experience ( In Year )',
								'type' => 'input',
								'name' => $suffix.'exp_year[]',
								'id' => $suffix.'exp_year'.$aid,
								'class' => 'form-control '.$suffix.'exp_year'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								),
						'1' => array(
								'heading' => 'Experience In Field',
								'type' => 'input',
								'name' => $suffix.'exp_field[]',
								'id' => $suffix.'exp_field'.$aid,
								'class' => 'form-control '.$suffix.'exp_field'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 5,
								'val_col_size' => 7,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'exp_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
		{
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		//$this->load->model('Inquiry/Inquiry_model');
		//echo "<pre>"; print_r($educations); die;
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$exps = $this->inquiry_model->get_uexp($idencr,$bit);
					$estr = ''; 
					$educount  = count($exps);
					foreach ($exps as $exp) { $aid++;
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Experience ( In Year )',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Experience In Field',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'exp_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'exphname',
					'hidinputid' => $suffix.'exphid',
					'hidinputcls' => $suffix.'exphcls',
					'anchoraddmoreid' => $suffix.'expaddid',
					'main_heading_hthree' => 'Experience Details',
					'results' => array(
						'0' => array(
								'heading' => 'Experience ( In Year )',
								'type' => 'input',
								'name' => $suffix.'exp_year[]',
								'id' => $suffix.'exp_year'.$aid,
								'class' => 'form-control '.$suffix.'exp_year'.$aid,
								'value_type' => '',
								'value' => $exp['uexp_exp_years'],
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								),
						'1' => array(
								'heading' => 'Experience In Field',
								'type' => 'input',
								'name' => $suffix.'exp_field[]',
								'id' => $suffix.'exp_field'.$aid,
								'class' => 'form-control '.$suffix.'exp_field'.$aid,
								'value_type' => 'no_value',
								'value' => $exp['uexp_exp_field'],
								'col_size' => 4,
								'head_col_size' => 5,
								'val_col_size' => 7,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
					if($educount == $aid)
					{
						$has_addmore = 'yes';
					}else{
						$has_addmore = 'no';
					}
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
							'headdata' => array(
										'0' => array(
											'heading' => 'Experience ( In Year )',
											'col_size' => 4
										),
										'1' => array(
											'heading' => 'Experience In Field',
											'col_size' => 4
										)
									),
							'designformat' => 'horizontal',
							'headmainclass' => 'edu_info',
							'resultmainclass' => 'edu_all',
							'ajaxaddmorecls' => $suffix.'exp_add_more',
							'col_no' => 1,
							'hidinputname' => $suffix.'exphname',
							'hidinputid' => $suffix.'exphid',
							'hidinputcls' => $suffix.'exphcls',
							'anchoraddmoreid' => $suffix.'expaddid',
							'main_heading_hthree' => 'Experience Details',
							'results' => array()
						);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'exp_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
		
	}

	public function relative_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Relative in Foreign',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Relation',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Country',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Address',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'rel_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'relhname',
					'hidinputid' => $suffix.'relhid',
					'hidinputcls' => $suffix.'relhcls',
					'anchoraddmoreid' => $suffix.'reladdid',
					'main_heading_hthree' => 'Relative',
					'results' => array(
						'0' => array(
								'heading' => 'Relative in Foreign',
								'type' => 'checkbox',
								'name' => $suffix.'exp_year[]',
								'id' => $suffix.'exp_year'.$aid,
								'class' => 'form-control '.$suffix.'exp_year'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_name' => $suffix.'rel_forign['.$aid.']',
													'option_id' => $suffix.'rel_forign',
													'option_val' => '1',
													'option_text' => 'Yes',
													'option_checked' => 'checked="checked"'
													),
											'1' => array(
													'option_name' => $suffix.'rel_forign['.$aid.']',
													'option_id' => $suffix.'rel_forign',
													'option_val' => '2',
													'option_text' => 'No',
													'option_checked' => ''
													),
											),
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								),
						'1' => array(
								'heading' => 'Relation',
								'type' => 'input',
								'name' => $suffix.'relname[]',
								'id' => $suffix.'relname'.$aid,
								'class' => 'form-control '.$suffix.'relname'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'relcountry[]',
								'id' => $suffix.'relcountry'.$aid,
								'class' => 'form-control '.$suffix.'relcountry'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'Address',
								'type' => 'textarea',
								'name' => $suffix.'reladd[]',
								'id' => $suffix.'reladd'.$aid,
								'class' => 'form-control '.$suffix.'reladd'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 2,
								'val_col_size' => 10,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'rel_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
			
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit'){
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		//$this->load->model('Inquiry/Inquiry_model');
		///echo "<pre>"; print_r($educations); die;
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$urel = $this->inquiry_model->get_urel($idencr,$bit);
					$estr = ''; 
					$educount  = count($urel);
					foreach ($urel as $rel) { $aid++;
						if(isset($rel['urel_yes_no']) && ($rel['urel_yes_no'] == 'y'))
						{
							$ystr = 'checked="checked"';
							$nstr = '';
						}else if(isset($rel['urel_yes_no']) && ($rel['urel_yes_no'] == 'n'))
						{
							$nstr = 'checked="checked"';
							$ystr = '';
						}else{
							$ystr = '';
							$nstr = '';
						}
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Relative in Foreign',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Relation',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Country',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Address',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'rel_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'relhname',
					'hidinputid' => $suffix.'relhid',
					'hidinputcls' => $suffix.'relhcls',
					'anchoraddmoreid' => $suffix.'reladdid',
					'main_heading_hthree' => 'Relative',
					'results' => array(
						'0' => array(
								'heading' => 'Relative in Foreign',
								'type' => 'checkbox',
								'name' => $suffix.'exp_year[]',
								'id' => $suffix.'exp_year'.$aid,
								'class' => 'form-control '.$suffix.'exp_year'.$aid,
								'value_type' => 'direct_value',
								'value' => array(
											'0' => array(
													'option_name' => $suffix.'rel_forign['.$aid.']',
													'option_id' => $suffix.'rel_forign',
													'option_val' => '1',
													'option_text' => 'Yes',
													'option_checked' => $ystr
													),
											'1' => array(
													'option_name' => $suffix.'rel_forign['.$aid.']',
													'option_id' => $suffix.'rel_forign',
													'option_val' => '2',
													'option_text' => 'No',
													'option_checked' => $nstr
													),
											),
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								),
						'1' => array(
								'heading' => 'Relation',
								'type' => 'input',
								'name' => $suffix.'relname[]',
								'id' => $suffix.'relname'.$aid,
								'class' => 'form-control '.$suffix.'relname'.$aid,
								'value_type' => 'no_value',
								'value' => $rel['urel_name'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'relcountry[]',
								'id' => $suffix.'relcountry'.$aid,
								'class' => 'form-control '.$suffix.'relcountry'.$aid,
								'value_type' => 'master',
								'value' => $rel['urel_country'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'Address',
								'type' => 'textarea',
								'name' => $suffix.'reladd[]',
								'id' => $suffix.'reladd'.$aid,
								'class' => 'form-control '.$suffix.'reladd'.$aid,
								'value_type' => 'no_value',
								'value' => $rel['urel_address'],
								'col_size' => 6,
								'head_col_size' => 2,
								'val_col_size' => 10,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
					if($educount == $aid)
					{
						$has_addmore = 'yes';
					}else{
						$has_addmore = 'no';
					}
					$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Relative in Foreign',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Relation',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Country',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Address',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'rel_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'relhname',
					'hidinputid' => $suffix.'relhid',
					'hidinputcls' => $suffix.'relhcls',
					'anchoraddmoreid' => $suffix.'reladdid',
					'main_heading_hthree' => 'Relative',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'rel_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
			
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}
		
	}

	public function refusal_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
		$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Country',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Date',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Category',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Remark :',
									'col_size' => 7
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'refu_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'refuhname',
					'hidinputid' => $suffix.'refuhid',
					'hidinputcls' => $suffix.'refuhcls',
					'anchoraddmoreid' => $suffix.'refuaddid',
					'main_heading_hthree' => 'Refusal Details',
					'results' => array(
						'0' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'refu_country[]',
								'id' => $suffix.'refu_country'.$aid,
								'class' => 'form-control '.$suffix.'refu_country'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Date',
								'type' => 'date',
								'name' => $suffix.'refdate[]',
								'id' => $suffix.'refdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'refdate'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'2' => array(
								'heading' => 'Product Type',
								'type' => 'select',
								'name' => $suffix.'refu_category[]',
								'id' => $suffix.'refu_category'.$aid,
								'class' => 'form-control '.$suffix.'refu_category'.$aid,
								'value_type' => 'master',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_product_type',
								'table_details' => array(
													'table_name' => 'tbl_product_type',
													'auto_id' => 'prot_id',
													'result_field' => 'prot_name',
													'delete_id' => 'pro_is_delete',
													'order_by_field' => 'prot_name',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'refu_remark[]',
								'id' => $suffix.'refu_remark'.$aid,
								'class' => 'form-control '.$suffix.'refu_remark'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 7,
								'head_col_size' => 2,
								'val_col_size' => 10,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'refu_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit'){
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					if($suffix == 'me')
					{
						$bit = 1;
					}else if($suffix == 'spouse'){
						$bit = 2;
					}else{
						$bit = 3;
					}
					$refusals = $this->inquiry_model->get_urefusal($idencr,$bit);
					$estr = ''; 
					$educount  = count($refusals);
					foreach ($refusals as $refusal) { $aid++;
						$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Country',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Date',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Category',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Remark :',
									'col_size' => 7
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'refu_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'refuhname',
					'hidinputid' => $suffix.'refuhid',
					'hidinputcls' => $suffix.'refuhcls',
					'anchoraddmoreid' => $suffix.'refuaddid',
					'main_heading_hthree' => 'Refusal Details',
					'results' => array(
						'0' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'refu_country[]',
								'id' => $suffix.'refu_country'.$aid,
								'class' => 'form-control '.$suffix.'refu_country'.$aid,
								'value_type' => 'master',
								'value' => $refusal['urefu_country'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Date',
								'type' => 'date',
								'name' => $suffix.'refdate[]',
								'id' => $suffix.'refdate'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'refdate'.$aid,
								'value_type' => 'no_value',
								'value' => date("d-m-Y", strtotime($refusal['urefu_date'])),
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'2' => array(
								'heading' => 'Category',
								'type' => 'select',
								'name' => $suffix.'refu_category[]',
								'id' => $suffix.'refu_category'.$aid,
								'class' => 'form-control '.$suffix.'refu_category'.$aid,
								'value_type' => 'master',
								'value' => $refusal['urefu_category'],
								'col_size' => 4,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_product_category',
													'auto_id' => 'procat_id',
													'result_field' => 'procat_name',
													'delete_id' => 'procat_is_delete',
													'order_by_field' => 'procat_name',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'refu_remark[]',
								'id' => $suffix.'refu_remark'.$aid,
								'class' => 'form-control '.$suffix.'refu_remark'.$aid,
								'value_type' => 'no_value',
								'value' => $refusal['urefu_remarks'],
								'col_size' => 7,
								'head_col_size' => 2,
								'val_col_size' => 10,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
					if($educount == $aid)
					{
						$has_addmore = 'yes';
					}else{
						$has_addmore = 'no';
					}
					$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Country',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Date',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Category',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Remark :',
									'col_size' => 7
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'refu_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'refuhname',
					'hidinputid' => $suffix.'refuhid',
					'hidinputcls' => $suffix.'refuhcls',
					'anchoraddmoreid' => $suffix.'refuaddid',
					'main_heading_hthree' => 'Refusal Details',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'refu_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}
		
	}

	public function address1_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
		$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Address',
									'col_size' => 8
								),
								'1' => array(
									'heading' => 'Country',
									'col_size' => 5
									
								),
								'2' => array(
									'heading' => 'State',
									'col_size' => 3
									
								),
								'3' => array(
									'heading' => 'City',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Area',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Pin No.',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'add1_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'add1hname',
					'hidinputid' => $suffix.'add1hid',
					'hidinputcls' => $suffix.'add1hcls',
					'anchoraddmoreid' => $suffix.'add1addid',
					'main_heading_hthree' => 'Address 1',
					'results' => array(
						'0' => array(
								'heading' => 'Address',
								'type' => 'hidden',
								'name' => $suffix.'add1_address[]',
								'id' => $suffix.'add1_address'.$aid,
								'class' => 'form-control '.$suffix.'add1_address'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 8,
								'head_col_size' => 2,
								'val_col_size' => 10,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'add1_country[]',
								'id' => $suffix.'add1_country'.$aid,
								'class' => 'bs-select form-control country '.$suffix.'add1_country'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => '105',
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								
								),
						'2' => array(
								'heading' => 'State',
								'type' => 'select',
								'name' => $suffix.'add1_state[]',
								'id' => $suffix.'add1_state'.$aid,
								'class' => 'bs-select form-control state '.$suffix.'add1_state'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => '10',
								'col_size' => 3,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_master_state',
								'table_details' => array(
													'table_name' => 'tbl_master_state',
													'auto_id' => 'state_id',
													'result_field' => 'state_name',
													'delete_id' => 'state_isdelete',
													'order_by_field' => 'state_name',
													'order_by' => 'ASC',
									)
								),
						'3' => array(
								'heading' => 'City',
								'type' => 'select',
								'name' => $suffix.'add1_city[]',
								'id' => $suffix.'add1_city'.$aid,
								'class' => 'bs-select form-control city '.$suffix.'add1_city'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => '9',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_city',
								'table_details' => array(
													'table_name' => 'tbl_master_city',
													'auto_id' => 'city_id',
													'result_field' => 'city_name',
													'delete_id' => 'city_isdelete',
													'order_by_field' => 'city_name',
													'order_by' => 'ASC',
									)
								),
						'4' => array(
								'heading' => 'Area',
								'type' => 'select',
								'name' => $suffix.'add1_area[]',
								'id' => $suffix.'add1_area'.$aid,
								'class' => 'bs-select form-control area '.$suffix.'add1_area'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => '9',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_area',
								'table_details' => array(
													'table_name' => 'tbl_master_area',
													'auto_id' => 'area_id',
													'result_field' => 'area_name',
													'delete_id' => 'area_isdelete',
													'order_by_field' => 'area_name',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														
														'0' => array(
															'field' => 'area_city',
															'value' => 9
															)
														)
													)
								
								),
						'5' => array(
								'heading' => 'Pin No.',
								'type' => 'select',
								'name' => $suffix.'add1_pin[]',
								'id' => $suffix.'add1_pin'.$aid,
								'class' => 'bs-select form-control pinno '.$suffix.'add1_pin'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'add1_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
	}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit'){
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$addresses = $this->inquiry_model->get_uaddress($idencr);
					$estr = ''; 
					$addcount  = count($addresses);
					foreach ($addresses as $address) { $aid++;
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Address',
									'col_size' => 8
								),
								'1' => array(
									'heading' => 'Country',
									'col_size' => 5
								),
								'2' => array(
									'heading' => 'State',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'City',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Area',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Pin No.',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'add1_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'add1hname',
					'hidinputid' => $suffix.'add1hid',
					'hidinputcls' => $suffix.'add1hcls',
					'anchoraddmoreid' => $suffix.'add1addid',
					'main_heading_hthree' => 'Address 1',
					'results' => array(
						'0' => array(
								'heading' => 'Address',
								'type' => 'hidden',
								'name' => $suffix.'add1_address[]',
								'id' => $suffix.'add1_address'.$aid,
								'class' => 'form-control '.$suffix.'add1_address'.$aid,
								'value_type' => 'no_value',
								'value' => isset($address['add_address']) ? $address['add_address'] : '',
								'col_size' => 8,
								'head_col_size' => 2,
								'val_col_size' => 10,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Country',
								'type' => 'select',
								'name' => $suffix.'add1_country[]',
								'id' => $suffix.'add1_country'.$aid,
								'class' => 'bs-select form-control country '.$suffix.'add1_country'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => isset($address['add_country']) ? $address['add_country'] : '',
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_country',
								'table_details' => array(
													'table_name' => 'tbl_country',
													'auto_id' => 'country_id',
													'result_field' => 'country_name',
													'delete_id' => 'country_isdelete',
													'order_by_field' => 'country_name',
													'order_by' => 'ASC'
													)
								),
						'2' => array(
								'heading' => 'State',
								'type' => 'select',
								'name' => $suffix.'add1_state[]',
								'id' => $suffix.'add1_state'.$aid,
								'class' => 'bs-select form-control state '.$suffix.'add1_state'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => isset($address['add_state']) ? $address['add_state'] : '',
								'col_size' => 3,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'autoval' => $aid,
								'table_name' => 'tbl_master_state',
								'table_details' => array(
													'table_name' => 'tbl_master_state',
													'auto_id' => 'state_id',
													'result_field' => 'state_name',
													'delete_id' => 'state_isdelete',
													'order_by_field' => 'state_name',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														'0' => array(
															'field' => 'state_country',
															'value' => isset($address['add_country']) ? $address['add_country'] : ''
															)
														)
													)
								),
						'3' => array(
								'heading' => 'City',
								'type' => 'select',
								'name' => $suffix.'add1_city[]',
								'id' => $suffix.'add1_city'.$aid,
								'class' => 'bs-select form-control city '.$suffix.'add1_city'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => isset($address['add_city']) ? $address['add_city'] : '', 
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_city',
								'table_details' => array(
													'table_name' => 'tbl_master_city',
													'auto_id' => 'city_id',
													'result_field' => 'city_name',
													'delete_id' => 'city_isdelete',
													'order_by_field' => 'city_name',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														'0' => array(
															'field' => 'city_country',
															'value' => isset($address['add_country']) ? $address['add_country'] : ''
															),
														'1' => array(
															'field' => 'city_state',
															'value' => isset($address['add_state']) ? $address['add_state'] : ''
															)
														)
													)
								),
						'4' => array(
								'heading' => 'Area',
								'type' => 'select',
								'name' => $suffix.'add1_area[]',
								'id' => $suffix.'add1_area'.$aid,
								'class' => 'bs-select form-control area '.$suffix.'add1_area'.$aid,
								'data_live_search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',  
								'value' => isset($address['add_area']) ? $address['add_area'] : '', 
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_area',
								'table_details' => array(
													'table_name' => 'tbl_master_area',
													'auto_id' => 'area_id',
													'result_field' => 'area_name',
													'delete_id' => 'area_isdelete',
													'order_by_field' => 'area_name',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														'0' => array(
															'field' => 'area_country',
															'value' => isset($address['add_country']) ? $address['add_country'] : ''
															),
														'1' => array(
															'field' => 'area_state',
															'value' => isset($address['add_state']) ? $address['add_state'] : ''
															),
														'2' => array(
															'field' => 'area_city',
															'value' => isset($address['add_city']) ? $address['add_city'] : ''
															)
														)
													)
								
								),
						'5' => array(
								'heading' => 'Pin No.',
								'type' => 'select',
								'name' => $suffix.'add1_pin[]',
								'id' => $suffix.'add1_pin'.$aid,
								'class' => 'bs-select form-control pinno '.$suffix.'add1_pin'.$aid,
								'value_type' => 'master',  
								'value' => isset($address['add_pin']) ? $address['add_pin'] : '', 
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_area',
								'table_details' => array(
													'table_name' => 'tbl_master_area',
													'auto_id' => 'area_id',
													'result_field' => 'area_pincode',
													'delete_id' => 'area_isdelete',
													'order_by_field' => 'area_pincode',
													'order_by' => 'ASC',
													'where' => 'yes',
													'where_fields' => array(
														'0' => array(
															'field' => 'area_country',
															'value' => isset($address['add_country']) ? $address['add_country'] : ''
															),
														'1' => array(
															'field' => 'area_state',
															'value' => isset($address['add_state']) ? $address['add_state'] : ''
															),
														'2' => array(
															'field' => 'area_city',
															'value' => isset($address['add_city']) ? $address['add_city'] : ''
															)
														)
													)
								)
					)
					);
					if($addcount == $aid)
					{
						$has_addmore = 'yes';
					}else{
						$has_addmore = 'no';
					}
					$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Address',
									'col_size' => 8
								),
								'1' => array(
									'heading' => 'Country',
									'col_size' => 5
								),
								'2' => array(
									'heading' => 'State',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'City',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Area',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Pin No.',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'add1_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'add1hname',
					'hidinputid' => $suffix.'add1hid',
					'hidinputcls' => $suffix.'add1hcls',
					'anchoraddmoreid' => $suffix.'add1addid',
					'main_heading_hthree' => 'Address 1',
					'results' => array()
					);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'add1_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
	}

	public function child_dtl_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Child 1 Date of Birth',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'chdtl_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'chdtlhname',
					'hidinputid' => $suffix.'chdtlhid',
					'hidinputcls' => $suffix.'chdtlhcls',
					'anchoraddmoreid' => $suffix.'chdtladdid',
					'main_heading_hthree' => 'Child Details',
					'results' => array(
						'0' => array(
								'heading' => 'Child 1 Date of Birth',
								'type' => 'date',
								'name' => $suffix.'chdtl_date[]',
								'id' => $suffix.'chdtl_date'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'chdtl_date'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								)
					)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'chdtl_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit'){
		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;	
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$uchild = $this->inquiry_model->get_uchild($idencr);
					$estr = ''; 
					$educount  = count($uchild);
					foreach ($uchild as $child) { $aid++;
						$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Child 1 Date of Birth',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'chdtl_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'chdtlhname',
					'hidinputid' => $suffix.'chdtlhid',
					'hidinputcls' => $suffix.'chdtlhcls',
					'anchoraddmoreid' => $suffix.'chdtladdid',
					'main_heading_hthree' => 'Child Details',
					'results' => array(
						'0' => array(
								'heading' => 'Child 1 Date of Birth',
								'type' => 'date',
								'name' => $suffix.'chdtl_date[]',
								'id' => $suffix.'chdtl_date'.$aid,
								'class' => 'form-control form-control-inline date-picker '.$suffix.'chdtl_date'.$aid,
								'value_type' => 'no_value',
								'value' => isset($child['uchild_dob']) ? date("d-m-Y", strtotime($child['uchild_dob'])) : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								)
					)
					);
					if($educount == $aid)
					{
						$has_addmore = 'yes';
					}else{
						$has_addmore = 'no';
					}
					$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
					if(isset($estr) && ($estr == ''))
					{
						$fields = array( 
							'headdata' => array(
										'0' => array(
											'heading' => 'Child 1 Date of Birth',
											'col_size' => 4
										)
									),
							'designformat' => 'horizontal',
							'headmainclass' => 'edu_info',
							'resultmainclass' => 'edu_all',
							'ajaxaddmorecls' => $suffix.'chdtl_add_more',
							'col_no' => 1,
							'hidinputname' => $suffix.'chdtlhname',
							'hidinputid' => $suffix.'chdtlhid',
							'hidinputcls' => $suffix.'chdtlhcls',
							'anchoraddmoreid' => $suffix.'chdtladdid',
							'main_heading_hthree' => 'Child Details',
							'results' => array()
						);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
					$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'chdtl_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
		
	}

	public function followup_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
			$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Follow Up Date',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Follow Up Method',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Follow Up By Executive',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Follow Up Status',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Remark',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'fup_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fuphname',
					'hidinputid' => $suffix.'fuphid',
					'hidinputcls' => $suffix.'fuphcls',
					'anchoraddmoreid' => $suffix.'fupaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fu_date[]',
								'id' => $suffix.'fu_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fu_date'.$aid,
								'value_type' => 'no_value',
								'value' => isset($education['fu_followdate']) ? $education['fu_followdate'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'1' => array(
								'heading' => 'Follow Up Method',
								'type' => 'select',
								'name' => $suffix.'method[]',
								'id' => $suffix.'method'.$aid,
								'class' => 'form-control '.$suffix.'method'.$aid,
								'value_type' => 'master',
								'value' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_followup_method',
								'table_details' => array(
													'table_name' => 'tbl_followup_method',
													'auto_id' => 'fu_method_id',
													'result_field' => 'fu_method_name',
													'delete_id' => 'fu_method_is_delete',
													'order_by_field' => 'fu_method_id',
													'order_by' => 'ASC'
													)
								),
						'2' => array(
								'heading' => 'Follow Up By Executive',
								'type' => 'select',
								'name' => $suffix.'exec[]',
								'id' => $suffix.'exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'exec'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_admin_users',
								'table_details' => array(
													'table_name' => 'tbl_admin_users',
													'auto_id' => 'au_id',
													'result_field' => 'au_fname',
													'delete_id' => 'au_is_delete',
													'order_by_field' => 'au_id',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'Follow Up Status',
								'type' => 'select',
								'name' => $suffix.'status[]',
								'id' => $suffix.'status'.$aid,
								'class' => 'form-control '.$suffix.'status'.$aid,
								'value_type' => 'master',
								'value' => isset($education['inqfus_name']) ? $education['inqfus_name'] : '',
								'table_name' => 'tbl_followup_status',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_details' => array(
													'table_name' => 'tbl_followup_status',
													'auto_id' => 'inqfus_id',
													'result_field' => 'inqfus_name',
													'delete_id' => 'inqfus_is_delete',
													'order_by_field' => 'inqfus_id',
													'order_by' => 'ASC'
													)
								),
						'4' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'remrk[]',
								'id' => $suffix.'remrk'.$aid,
								'class' => 'form-control '.$suffix.'remrk'.$aid,
								'value_type' => 'no_value',
								'value' => isset($education['fu_remark']) ? $education['fu_remark'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
			)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'fup_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit')
		{
			$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$educations = $this->inquiry_model->get_ufollowup($idencr);
					//echo "<pre>"; print_r($educations); die;
					//echo "<pre>"; print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); die;
					$exce = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
					//echo $exce; die;
					//echo "<pre>"; print_r($exce); die;
					//$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']);
					$estr = ''; 
					$educount  = count($educations);
					foreach ($educations as $education) { $aid++;
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Follow Up Date',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Follow Up Method',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Follow Up By Executive',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Follow Up Status',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Remark',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'fup_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fuphname',
					'hidinputid' => $suffix.'fuphid',
					'hidinputcls' => $suffix.'fuphcls',
					'anchoraddmoreid' => $suffix.'fupaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fu_date[]',
								'id' => $suffix.'fu_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fu_date'.$aid,
								'value_type' => 'no_value',
								'value' => isset($education['fu_followdate']) ? date("d-m-Y", strtotime($education['fu_followdate'])) : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array(),
								'dateformat' => 'dd-mm-yyyy'
								),
						'1' => array(
								'heading' => 'Follow Up Method',
								'type' => 'select',
								'name' => $suffix.'method[]',
								'id' => $suffix.'method'.$aid,
								'class' => 'form-control '.$suffix.'method'.$aid,
								'value_type' => 'master',
								'value' => isset($education['fu_followmethod']) ? $education['fu_followmethod'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_followup_method',
								'table_details' => array(
													'table_name' => 'tbl_followup_method',
													'auto_id' => 'fu_method_id',
													'result_field' => 'fu_method_name',
													'delete_id' => 'fu_method_is_delete',
													'order_by_field' => 'fu_method_id',
													'order_by' => 'ASC'
													)
								),
						'2' => array(
								'heading' => 'Follow Up By Executive',
								'type' => 'select',
								'name' => $suffix.'exec[]',
								'id' => $suffix.'exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'exec'.$aid,
								'data-live-search' => 'true',
								'data-size' => '8',
								'value_type' => 'master',
								'value' => $exce,
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_admin_users',
								'table_details' => array(
													'table_name' => 'tbl_admin_users',
													'auto_id' => 'au_id',
													'result_field' => 'au_fname',
													'delete_id' => 'au_is_delete',
													'order_by_field' => 'au_id',
													'order_by' => 'ASC'
													)
								),
						'3' => array(
								'heading' => 'Follow Up Status',
								'type' => 'select',
								'name' => $suffix.'status[]',
								'id' => $suffix.'status'.$aid,
								'class' => 'form-control '.$suffix.'status'.$aid,
								'value_type' => 'master',
								'value' => isset($education['fu_followupst']) ? $education['fu_followupst'] : '',
								'table_name' => 'tbl_followup_status',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_details' => array(
													'table_name' => 'tbl_followup_status',
													'auto_id' => 'inqfus_id',
													'result_field' => 'inqfus_name',
													'delete_id' => 'inqfus_is_delete',
													'order_by_field' => 'inqfus_id',
													'order_by' => 'ASC'
													)
								),
						'4' => array(
								'heading' => 'Remark',
								'type' => 'textarea',
								'name' => $suffix.'remrk[]',
								'id' => $suffix.'remrk'.$aid,
								'class' => 'form-control '.$suffix.'remrk'.$aid,
								'value_type' => 'no_value',
								'value' => isset($education['fu_remark']) ? $education['fu_remark'] : '',
								'rows' => 4,
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
			)
					);
				if($educount == $aid)
				{
					$has_addmore = 'yes';
				}else{
					$has_addmore = 'no';
				}
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
			}
			if(isset($estr) && ($estr == ''))
			{
				$fields = array(
					'headdata' => array(
								'0' => array(
									'heading' => 'Follow Up Date',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Follow Up Method',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Follow Up By Executive',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Follow Up Status',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Remark',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'fup_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'fuphname',
					'hidinputid' => $suffix.'fuphid',
					'hidinputcls' => $suffix.'fuphcls',
					'anchoraddmoreid' => $suffix.'fupaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array()
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'fup_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
		
	}

	public function achievement_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add')
		{
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
		$fields = 
				array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Achievement',
									'col_size' => 4
								)
							), 
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'achievement_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'achievementhname',
					'hidinputid' => $suffix.'achievementhid',
					'hidinputcls' => $suffix.'achievementhcls',
					'anchoraddmoreid' => $suffix.'achievementaddid',
					'main_heading_hthree' => 'Achievement Details',
					'results' => array(
						'0' => array(
								'heading' => 'Description',
								'type' => 'textarea',
								'name' => $suffix.'achievement[]',
								'id' => $suffix.'achievement'.$aid,
								'class' => 'form-control '.$suffix.'achievement'.$aid,
								'value_type' => '',
								'value' => '',
								'col_size' => 6,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'achievement_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}else if($this->input->post('mtype') && $this->input->post('mtype') == 'edit'){

		$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
		
		$aid = (isset($aid) && ($aid != false)) ? $aid : 0;	
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;

			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
				//echo "string"; die;
					$uchild = $this->admin_users_model->get_achiev($idencr);
					//echo "<pre>"; print_r($idencr); die;
					$estr = ''; 
					$educount  = count($uchild);
					foreach ($uchild as $child) { $aid++;
						$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Achievement',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'achievement_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'achievementhname',
					'hidinputid' => $suffix.'achievementhid',
					'hidinputcls' => $suffix.'achievementhcls',
					'anchoraddmoreid' => $suffix.'achievementaddid',
					'main_heading_hthree' => 'Achievement Details',
					'results' => array(
						'0' => array(
								'heading' => 'Achievement',
								'type' => 'textarea',
								'name' => $suffix.'achievement[]',
								'id' => $suffix.'achievement'.$aid,
								'class' => 'form-control '.$suffix.'achievement'.$aid,
								'value_type' => 'no_value',
								'value' => isset($child['adachi_achivements']) ? $child['adachi_achivements'] : '',
								'col_size' => 6,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 3,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					)
					);

					if($educount == $aid)
					{
						$has_addmore = 'yes';
					}else{
						$has_addmore = 'no';
					}
					$estr .= $this->create_form($fields,$action = 'edit',$has_addmore);
					}
			if(isset($estr) && ($estr == ''))
			{
				$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Achievement',
									'col_size' => 4
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'achievement_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'achievementhname',
					'hidinputid' => $suffix.'achievementhid',
					'hidinputcls' => $suffix.'achievementhcls',
					'anchoraddmoreid' => $suffix.'achievementaddid',
					'main_heading_hthree' => 'Achievement Details',
					'results' => array()
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'achievement_ajax_main',
								'ajax_addmore_id' => $fields['ajaxaddmorecls'],
								'hidinputid' => $fields['hidinputid']
							);
			}
		}
		$value = array(
				'no_of_result' => $scount,
				'result' => $multiresult
				);
		echo json_encode($value);
		}
		
	}

	public function create_form($fields,$action  = false,$has_addmore = false)
	{
		//echo '<pre>';print_r($fields);die;
		$str = '';
		$col_counter = 0;
		$field_counter = 0;
		if($fields['col_no'] == 1)
		{
			$str .= '<h3>'.$fields['main_heading_hthree'].'</h3><hr/>';
		}
		if($fields['designformat'] == 'vertical' && $fields['col_no'] == 1)
		{
			$str .= '<div class="'.$fields['headmainclass'].'">';
			$str .= '<div class="row">';
			foreach ($fields['headdata'] as $headdata) {
				$str .= '<div class="col-md-'.$headdata['col_size'].' text-center">
					<div>
					 <label class="control-label">'.$headdata['heading'].'</label>
					</div>
				</div>';
			}
			$str .= '</div>';
			$str .= '</div>';
		}
		if(isset($fields['results']) && !empty($fields['results']))
		{
			$str .= '<div class="'.$fields['resultmainclass'].'">';
			$str .= '<div class="'.$fields['resultmainclass'].''.$fields['col_no'].'">';
			$str .= '<div class="row">';
			foreach ($fields['results'] as $key => $field) {
				//echo $field['type'];die;
				$str .= '<div class="col-md-'.$field['col_size'].'">';
				if($field['type'] == 'select')
				{
					$str .= $this->is_select_box($field,$fields['designformat']);
				}
				if($field['type'] == 'input')
				{
					$str .= $this->is_input_box($field,$fields['designformat']);
				}
				if($field['type'] == 'date')
				{
					$str .= $this->is_date_box($field,$fields['designformat']);
				}
				if($field['type'] == 'textarea')
				{
					$str .= $this->is_textarea($field,$fields['designformat']);
				}
				if($field['type'] == 'checkbox')
				{
					$str .= $this->is_checkbox($field,$fields['designformat']);
				}
				$str .= '</div>';
			}
			$str .= '</div>';
			$str .= '</div>';
		}
		//$action  = false,$has_addmore = false
		if(isset($action) && $action == 'edit' && isset($has_addmore) && ($has_addmore == 'yes'))
		{ 
			$str .= '<div id="'.$fields['ajaxaddmorecls'].'"></div><div class="row">
                                    <div class="col-md-12">
                                        <a href="javascript:;" id="'.$fields['anchoraddmoreid'].'" class="btn green button-submit ajaxaddmorebtn" tabindex="8"> Add More
                                        <i class="fa fa-check"></i>
                                        </a>  
                                        <input type="hidden" name="'.$fields['hidinputname'].'" id="'.$fields['hidinputid'].'" class="'.$fields['hidinputcls'].'" value="'.$fields['col_no'].'" />
                                    </div>
                                </div>';
		}else{
			if(isset($fields['col_no']) && ($fields['col_no'] == 1) && ($action != 'edit'))
			{
				$str .= '<div id="'.$fields['ajaxaddmorecls'].'"></div><div class="row">
	                                    <div class="col-md-12">
	                                        <a href="javascript:;" id="'.$fields['anchoraddmoreid'].'" class="btn green button-submit ajaxaddmorebtn" tabindex="8"> Add More
	                                        <i class="fa fa-check"></i>
	                                        </a>  
	                                        <input type="hidden" name="'.$fields['hidinputname'].'" id="'.$fields['hidinputid'].'" class="'.$fields['hidinputcls'].'" value="'.$fields['col_no'].'" />
	                                    </div>
	                                </div>';
			}
		}
		return $str;
	}

	public function is_select_box($field,$designformat)
	{
		//echo '<pre>';print_r($field);die;
		$select_str = '';
		$selectf = '';
		$selectf .= '<select name="'.$field['name'].'" id="'.$field['id'].'" class="'.$field['class'].'" data-live-search="true">';
		if($field['value_type'] == 'master')
		{
			$tdata = array();
			$tdata = $field['table_details'];
			$optiondatas = $this->ajax_add_more_model->get_global_masters($tdata);
			$selectf .= '<option value="">Select '.$field['heading'].'</option>';
			foreach ($optiondatas as $optiondata) {
				$selectf .= '<option value="'.$optiondata['autoid'].'"';
				if(isset($optiondata['autoid']) && isset($field['value']) && ($field['value'] != '') && ($optiondata['autoid'] != '') && ($optiondata['autoid'] == $field['value']))
				{
					$selectf .= ' selected="selected" ';
				}
				$selectf .= '>'.$optiondata['result_field'].'</option>';
			}
		}
		if($field['value_type'] == 'direct_value')
		{
			foreach ($field['value'] as $optiondata) {
				$selectf .= '<option value="'.$optiondata['option_val'].'"';
				if(isset($optiondata['option_val']) && isset($field['direct_selvalue']) && ($field['direct_selvalue'] != '') && ($optiondata['option_val'] != '') && ($optiondata['option_val'] == $field['direct_selvalue']))
				{
					$selectf .= ' selected="selected" ';
				}
				$selectf .= '>'.$optiondata['option_text'].'</option>';
			}
		}
		$selectf .= '</select>';
		if($designformat == 'vertical')
		{
			$select_str .= '<div class="form-group">                                            
			<div class="col-md-12">'.$selectf.'</div>
		</div>';
		}
		if($designformat == 'horizontal')
		{
			$select_str .= '<div class="form-group">
			<label class="control-label col-md-'.$field['head_col_size'].'">'.$field['heading'].'</label>                                            
			<div class="col-md-'.$field['val_col_size'].'">'.$selectf.'</div>
		</div>';
		}
		return $select_str;
	}

	public function is_input_box($field,$designformat)
	{
		$input_str = '';
		$inputf = '<input type="text" name="'.$field['name'].'" id="'.$field['id'].'" class="'.$field['class'].'" value="'.$field['value'].'">';
		if($designformat == 'vertical')
		{
			$input_str .= '<div class="form-group">                                            
			<div class="col-md-12">'.$inputf.'</div>
		</div>';
		}
		if($designformat == 'horizontal')
		{
			$input_str .= '<div class="form-group">
			<label class="control-label col-md-'.$field['head_col_size'].'">'.$field['heading'].'</label>                                            
			<div class="col-md-'.$field['val_col_size'].'">'.$inputf.'</div>
		</div>';
		}
		return $input_str;
	}

	public function is_date_box($field,$designformat)
	{
		$input_str = '';
		$inputf = '<input size="16" name="'.$field['name'].'" id="'.$field['id'].'" class="'.$field['class'].'" value="'.$field['value'].'" data-date="10/2012" data-date-format="'.$field['dateformat'].'" tabindex="5" type="text">';
		if($designformat == 'vertical')
		{
			$input_str .= '<div class="form-group">                                            
			<div class="col-md-12">'.$inputf.'</div>
		</div>';
		}
		if($designformat == 'horizontal')
		{
			$input_str .= '<div class="form-group">
			<label class="control-label col-md-'.$field['head_col_size'].'">'.$field['heading'].'</label>                                            
			<div class="col-md-'.$field['val_col_size'].'">'.$inputf.'</div>
		</div>';
		}
		return $input_str;//
	}

	public function is_checkbox($field,$designformat)
	{
		$input_str = '';
		if($designformat == 'vertical')
		{
			/*$input_str .= '<div class="form-group">                                            
			<div class="col-md-12">'.$inputf.'</div>
		</div>';*/
		}
		if($designformat == 'horizontal')
		{
			$input_str .= '<div class="form-group">
			<label class="control-label col-md-'.$field['head_col_size'].'">'.$field['heading'].'</label>                                            
			<div class="col-md-'.$field['val_col_size'].'">
			
			<div class="mt-radio-inline">';
			foreach ($field['value'] as $optiondata) {
			$input_str .= '<label class="mt-radio">
					<input type="radio" name="'.$optiondata['option_name'].'" id="'.$optiondata['option_id'].'" value="'.$optiondata['option_val'].'" '.$optiondata['option_checked'].'> '.$optiondata['option_text'].'
					<span></span>
				</label>';
			}
			$input_str .= '</div>
			
			</div>
		</div>';
		}
		return $input_str;//
		//<input type="radio" name="inq" id="inq" value="option1" tabindex="3" checked> Yes
		//<input type="radio" name="inq" id="inq" value="option2" tabindex="4"> No
	} //

	public function is_textarea($field,$designformat)
	{
		$input_str = '';
		$inputf = '<textarea name="'.$field['name'].'" id="'.$field['id'].'" rows="'.$field['rows'].'" class="'.$field['class'].'">'.$field['value'].'</textarea>';
		if($designformat == 'vertical')
		{
			$input_str .= '<div class="form-group">                                            
			<div class="col-md-12">'.$inputf.'</div>
		</div>';
		}
		if($designformat == 'horizontal')
		{
			$input_str .= '<div class="form-group">
			<label class="control-label col-md-'.$field['head_col_size'].'">'.$field['heading'].'</label>                                            
			<div class="col-md-'.$field['val_col_size'].'">'.$inputf.'</div>
		</div>';
		}
		return $input_str;
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
	
	function is_loggedin()
	{
		if(isset($this->session->userdata['miconlogin']))
		{
			if(isset($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && isset($this->session->userdata['miconlogin']['rightsid']) && isset($this->session->userdata['miconlogin']['status']) && ($this->session->userdata['miconlogin']['status'] == 1))
			{
				$loginstatus = true;
			}else{
				$loginstatus = false;
			}
		}else{
			$loginstatus = false;
		}
		return $loginstatus; 
	}

	public function get_state()
	{
		if($this->input->post('country_id') && ($this->input->post('country_id') != ''))
		{
			$states = $this->ajax_add_more_model->get_country_to_state($this->input->post('country_id'));
			$statestr = '';
			$statestr = '<option value="">Select State</option>';
			foreach ($states as $key => $state) {
				$statestr .= '<option value="';
				$statestr .= $state['state_id'];
				$statestr .= '">';
				$statestr .= $state['state_name'];
				$statestr .= '</option>';
			}
			echo $statestr;
		}else{
			echo '<option value="">Select State</option>';
		}
	}

	public function get_ctocity()
	{
		if($this->input->post('country_id') && ($this->input->post('country_id') != ''))
		{
			$states = $this->ajax_add_more_model->get_ctocity($this->input->post('country_id'));
			$statestr = '';
			$statestr = '<option value="">Select City</option>';
			foreach ($states as $key => $state) {
				$statestr .= '<option value="';
				$statestr .= $state['city_id'];
				$statestr .= '">';
				$statestr .= $state['city_name'];
				$statestr .= '</option>';
			}
			echo $statestr;
		}else{
			echo '<option value="">Select City</option>';
		}
	}

	public function get_city()
	{
		if($this->input->post('country_id') && ($this->input->post('country_id') != '') && $this->input->post('state_id') && ($this->input->post('state_id') != ''))
		{
			$states = $this->ajax_add_more_model->get_state_to_city($this->input->post('country_id'),$this->input->post('state_id'));
			$statestr = '';
			$statestr = '<option value="">Select City</option>';
			foreach ($states as $key => $state) {
				$statestr .= '<option value="';
				$statestr .= $state['city_id'];
				$statestr .= '">';
				$statestr .= $state['city_name'];
				$statestr .= '</option>';
			}
			echo $statestr;
		}else{
			echo '<option value="">Select City</option>';
		}
	}

	public function get_area()
	{
		if($this->input->post('country_id') && ($this->input->post('country_id') != '') && $this->input->post('state_id') && ($this->input->post('state_id') != '') && $this->input->post('city_id') && ($this->input->post('city_id') != ''))
		{
			$states = $this->ajax_add_more_model->get_city_to_area($this->input->post('country_id'),$this->input->post('state_id'),$this->input->post('city_id'));
			$statestr = '';
			$statestr = '<option value="">Select Area</option>';
			foreach ($states as $key => $state) {
				$statestr .= '<option value="';
				$statestr .= $state['area_id'];
				$statestr .= '">';
				$statestr .= $state['area_name'].' - '.$state['area_pincode'];
				$statestr .= '</option>';
			}
			echo $statestr;
		}else{
			echo '<option value="">Select Area</option>';
		}
	}

	public function get_pincode()
	{
		if($this->input->post('country_id') && ($this->input->post('country_id') != '') && $this->input->post('state_id') && ($this->input->post('state_id') != '') && $this->input->post('city_id') && ($this->input->post('city_id') != '') && $this->input->post('area_id') && ($this->input->post('area_id') != ''))
		{
			$states = $this->ajax_add_more_model->get_area_to_pincode($this->input->post('country_id'),$this->input->post('state_id'),$this->input->post('city_id'),$this->input->post('area_id'));
			$statestr = '';
			//$statestr = '<option value="">Select Pincode</option>';
			foreach ($states as $key => $state) {
				$statestr .= '<option value="';
				$statestr .= $state['area_id'];
				$statestr .= '">';
				$statestr .= $state['area_pincode'];
				$statestr .= '</option>';
			}
			echo $statestr;
		}else{
			echo '<option value="">Select Pincode</option>';
		}
	}
	
	
}?>