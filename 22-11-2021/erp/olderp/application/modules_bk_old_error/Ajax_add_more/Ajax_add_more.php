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

	public function party_add_addmore($aid = false)
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
									'heading' => 'Billing Address',
									'col_size' => 2
								),
								'1' => array(
									'heading' => 'Shipping Address',
									'col_size' => 2
								)
							),
					'designformat' => 'vertical',
					'headmainclass' => 'addrs_info',
					'resultmainclass' => 'addrs_all',
					'ajaxaddmorecls' => $suffix.'addrs_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'addrshname',
					'hidinputid' => $suffix.'addrshid',
					'hidinputcls' => $suffix.'addrshcls',
					'anchoraddmoreid' => $suffix.'addrsaddid',
					'main_heading_hthree' => 'Address Details',
					'results' => array(
						'0' => array(
								'heading' => 'Billing Address',
								'type' => 'textarea',
								'name' => $suffix.'bill_add[]',
								'id' => $suffix.'bill_add'.$aid,
								'class' => 'form-control '.$suffix.'bill_add'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Shipping Address',
								'type' => 'textarea',
								'name' => $suffix.'ship_add[]',
								'id' => $suffix.'ship_add'.$aid,
								'class' => 'form-control '.$suffix.'ship_add'.$aid,
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
								'ajax_main_id' => $suffix.'add_ajax_main',
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
					$educations = $this->User_model->get_uedu($idencr,$bit);
					//echo "<pre>"; print_r($educations); die;
					$estr = ''; 
					$educount  = count($educations);
					if($educount == 0)
					{
						$educations = array(
								'0' => array(
									'uedu_full_education' => '',
									'uedu_education' => '',
									'uedu_subject' => '',
									'uedu_per' => '',
									'uedu_backlogs' => '',
									'uedu_start' => '',
									'uedu_end' => '',
									'uedu_university' => ''
								)
							);
							$educount = 1;
					}
					foreach ($educations as $education) { $aid++;
						
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Billing Address',
									'col_size' => 2
								),
								'1' => array(
									'heading' => 'Shipping Address',
									'col_size' => 2
								)
							),
					'designformat' => 'vertical',
					'headmainclass' => 'addrs_info',
					'resultmainclass' => 'addrs_all',
					'ajaxaddmorecls' => $suffix.'addrs_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'addrshname',
					'hidinputid' => $suffix.'addrshid',
					'hidinputcls' => $suffix.'addrshcls',
					'anchoraddmoreid' => $suffix.'addrsaddid',
					'main_heading_hthree' => 'Address Details',
					'results' => array(
						'0' => array(
								'heading' => 'Billing Address',
								'type' => 'textarea',
								'name' => $suffix.'bill_add[]',
								'id' => $suffix.'bill_add'.$aid,
								'class' => 'form-control '.$suffix.'bill_add'.$aid,
								'value_type' => 'no_value',
								'value' => '',
								'col_size' => 5,
								'head_col_size' => 3,
								'val_col_size' => 9,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Shipping Address',
								'type' => 'textarea',
								'name' => $suffix.'ship_add[]',
								'id' => $suffix.'ship_add'.$aid,
								'class' => 'form-control '.$suffix.'ship_add'.$aid,
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
											'heading' => 'Billing Address',
											'col_size' => 2
										),
										'1' => array(
											'heading' => 'Shipping Address',
											'col_size' => 2
										)	
									),
							'designformat' => 'vertical',
							'headmainclass' => 'addrs_info',
							'resultmainclass' => 'addrs_all',
							'ajaxaddmorecls' => $suffix.'addrs_add_more',
							'col_no' => $aid,
							'hidinputname' => $suffix.'addrshname',
							'hidinputid' => $suffix.'addrshid',
							'hidinputcls' => $suffix.'addrshcls',
							'anchoraddmoreid' => $suffix.'addrsaddid',
							'main_heading_hthree' => 'Address Details',
							'results' => array()
						);
						$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
						$onlyaddmore = 1;
					}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'add_ajax_main',
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