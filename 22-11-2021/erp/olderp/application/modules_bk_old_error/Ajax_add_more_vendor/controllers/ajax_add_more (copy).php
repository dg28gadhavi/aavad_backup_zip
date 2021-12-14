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
		$this->load->library('encrypt');
		$this->load->library('form_validation');
	}

	public function ajax_global()
	{
		$str = $this->education_add_more(0);
	}

	public function education_add_more($aid = false)
	{
		$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$scount = ($this->input->get('suffix') && !empty($this->input->get('suffix'))) ? count($this->input->get('suffix')) : 1;
		$multiresult = array();
		if ($this->input->get('suffix') && !empty($this->input->get('suffix'))) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
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
								'class' => 'form-control '.$suffix.'edu'.$aid,
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
								'class' => 'form-control '.$suffix.'subject'.$aid,
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
								'dateformat' => 'mm/yyyy'
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
								'dateformat' => 'mm/yyyy'
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
	}

	public function language_add_more($aid = false)
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
								'dateformat' => 'mm/yyyy'
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
	}

	public function exp_add_more($aid = false)
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
	}

	public function relative_add_more($aid = false)
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
								'value_type' => '',
								'value' => '',
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
	}

	public function create_form($fields)
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
		if(isset($fields['col_no']) && $fields['col_no'] == 1)
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
		return $str;
	}

	public function is_select_box($field,$designformat)
	{
		$select_str = '';
		$selectf = '';
		$selectf .= '<select name="'.$field['name'].'" id="'.$field['id'].'" class="'.$field['class'].'">';
		if($field['value_type'] == 'master')
		{
			$tdata = array();
			$tdata = $field['table_details'];
			$optiondatas = $this->ajax_add_more_model->get_global_masters($tdata);
			foreach ($optiondatas as $optiondata) {
				$selectf .= '<option value="'.$optiondata['autoid'].'">'.$optiondata['result_field'].'</option>';
			}
		}
		if($field['value_type'] == 'direct_value')
		{
			foreach ($field['value'] as $optiondata) {
				$selectf .= '<option value="'.$optiondata['option_val'].'">'.$optiondata['option_text'].'</option>';
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
		$input_str .= '<div class="form-group">
                       <label class="col-md-5 control-label">Relative in Foreign</label>
                            <div class="col-md-7">
                                
                            </div>
                        </div>';
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
	
	
}?>