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
	//	//$this->load->library('encrypt');
		$this->load->library('form_validation');
	}

	public function ajax_global()
	{
		$str = $this->party_address_more(0);
	}


     // ***************** Add More Contact Start*******************//
	

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
	
/* sales inquiry add more start*/	
	public function sales_enq_add_more($aid = false)
	{

		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$suffixar = $this->input->get('suffix');
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		//$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
			$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Deatils of Item',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
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
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'detail_item[]',
								'id' => $suffix.'detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecng '.$suffix.'detail_item'.$aid,
								'value_type' => 'master',
								'value' => 0,					
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'desc[]',
								'id' => $suffix.'desc'.$aid,
								'class' => 'form-control '.$suffix.'desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_desc']) ? $salesinq['sai_itm_desc'] : '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'quantity[]',
								'id' => $suffix.'quantity'.$aid,
								'class' => 'form-control '.$suffix.'quantity'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_qty']) ? $salesinq['sai_itm_qty'] : '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'rate[]',
								'id' => $suffix.'rate'.$aid,
								'class' => 'form-control '.$suffix.'rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_price']) ? $salesinq['sai_itm_price'] : '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						
			)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'saladdmore_ajax_main',
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
			$idencr = $this->input->post('sqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('sqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$suffixar = $this->input->get('suffix');
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$salesinqs = $this->ajax_add_more_model->get_usalesdata($idencr);
					//echo "<pre>"; print_r($salesinqs); die;
					//echo "<pre>"; print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); die;
					$exce = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
					//echo $exce; die;
					//echo "<pre>"; print_r($exce); die;
					//$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']);
					$estr = ''; 
					$saleinqcount  = count($salesinqs);
					foreach ($salesinqs as $salesinq) { $aid++;
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Deatils of Item',
									'col_size' => 4
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 4
								),
								
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
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'detail_item[]',
								'id' => $suffix.'detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecng '.$suffix.'detail_item'.$aid,
								'value_type' => 'master',
								'value' => isset($salesinq['sqi_itm_pno']) ? $salesinq['sqi_itm_pno'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
									'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'desc[]',
								'id' => $suffix.'desc'.$aid,
								'class' => 'form-control '.$suffix.'desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sqi_itm_desc']) ? $salesinq['sqi_itm_desc'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'quantity[]',
								'id' => $suffix.'quantity'.$aid,
								'class' => 'form-control '.$suffix.'quantity'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sqi_itm_qty']) ? $salesinq['sqi_itm_qty'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'rate[]',
								'id' => $suffix.'rate'.$aid,
								'class' => 'form-control '.$suffix.'rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sqi_itm_price']) ? $salesinq['sqi_itm_price'] : '',
								'col_size' => 4,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
					
			)
					);
				if($saleinqcount == $aid)
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
									'heading' => 'Deatils of Item',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
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
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'detail_item[]',
								'id' => $suffix.'detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecng '.$suffix.'detail_item'.$aid,
								'value_type' => 'master',
								'value' => 0,					
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'desc[]',
								'id' => $suffix.'desc'.$aid,
								'class' => 'form-control '.$suffix.'desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_desc']) ? $salesinq['sai_itm_desc'] : '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'quantity[]',
								'id' => $suffix.'quantity'.$aid,
								'class' => 'form-control '.$suffix.'quantity'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_qty']) ? $salesinq['sai_itm_qty'] : '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'rate[]',
								'id' => $suffix.'rate'.$aid,
								'class' => 'form-control '.$suffix.'rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_price']) ? $salesinq['sai_itm_price'] : '',
								'col_size' => 4,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						
			)
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'saladdmore_ajax_main',
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
/* sales inquiry add more end*/	

/* sales quotation add more start*/	
	public function sales_quote_add_more($aid = false)
	{

		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$suffixar = $this->input->get('suffix');
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		//$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
			$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Deatils of Item',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Discount',
									'col_size' => 3
								),
								'5' => array(
									'heading' => 'Final Total',
									'col_size' => 3
								),
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'quot_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'quothname',
					'hidinputid' => $suffix.'quothid',
					'hidinputcls' => $suffix.'quothcls',
					'anchoraddmoreid' => $suffix.'quotaddid',
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'quot_detail_item[]',
								'id' => $suffix.'quot_detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecngquot'.$suffix.'quot_detail_item'.$aid,
								'value_type' => 'master',
								'value' => 0,								
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'quot_desc[]',
								'id' => $suffix.'desc'.$aid,
								'class' => 'form-control '.$suffix.'quot_desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_desc']) ? $salesinq['sai_itm_desc'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'quot_qty[]',
								'id' => $suffix.'qty'.$aid,
								'class' => 'form-control qty '.$suffix.'qty'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'quot_rate[]',
								'id' => $suffix.'rate'.$aid,
								'class' => 'form-control rate '.$suffix.'rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Discount',
								'type' => 'input',
								'name' => $suffix.'quot_dis[]',
								'id' => $suffix.'discount'.$aid,
								'class' => 'form-control discount '.$suffix.'discount'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Final Total',
								'type' => 'input',
								'name' => $suffix.'quot_ftotl[]',
								'id' => $suffix.'quot_ftotl'.$aid,
								'class' => 'form-control '.$suffix.'quot_ftotl'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						
			)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'quoteaddmore_ajax_main',
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
			$idencr = $this->input->post('quoteid') ? $this->encrypt_decrypt('decrypt', $this->input->post('quoteid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$suffixar = $this->input->get('suffix');
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					//$this->load->model('Sale_quotation_model');
					$quotes = $this->ajax_add_more_model->get_uquotedata($idencr);
					//echo "<pre>"; print_r($quotes); die;
					//echo "<pre>"; print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); die;
					$exce = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
					//echo $exce; die;
					//echo "<pre>"; print_r($exce); die;
					//$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']);
					$estr = ''; 
					$quotecount  = count($quotes);
					foreach ($quotes as $quote) { $aid++;
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Deatils of Item',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 4
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 4
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 4
								),
								'4' => array(
									'heading' => 'Discount',
									'col_size' => 4
								),
								'5' => array(
									'heading' => 'Final Total',
									'col_size' => 4
								),
								
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'quot_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'quothname',
					'hidinputid' => $suffix.'quothid',
					'hidinputcls' => $suffix.'quothcls',
					'anchoraddmoreid' => $suffix.'quotaddid',
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'quot_detail_item[]',
								'id' => $suffix.'quot_detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecngquot '.$suffix.'quot_detail_item'.$aid,
								'value_type' => 'master',
								'value' => isset($quote['sai_itm_name']) ? $quote['sai_itm_name'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
									'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'quot_desc[]',
								'id' => $suffix.'quot_desc'.$aid,
								'class' => 'form-control '.$suffix.'quot_desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_desc']) ? $quote['sai_itm_desc'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'quot_qty[]',
								'id' => $suffix.'qty'.$aid,
								'class' => 'form-control qty '.$suffix.'qty'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'quot_rate[]',
								'id' => $suffix.'rate'.$aid,
								'class' => 'form-control rate '.$suffix.'rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Discount',
								'type' => 'input',
								'name' => $suffix.'quot_dis[]',
								'id' => $suffix.'discount'.$aid,
								'class' => 'form-control discount '.$suffix.'discount'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_discount']) ? $quote['sai_itm_discount'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Final total',
								'type' => 'input',
								'name' => $suffix.'quot_ftotl[]',
								'id' => $suffix.'quot_ftotl'.$aid,
								'class' => 'form-control '.$suffix.'quot_ftotl'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_total']) ? $quote['sai_itm_total'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
					
			)
					);
				if($quotecount == $aid)
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
									'heading' => 'Deatils of Item',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Discount',
									'col_size' => 3
								),
								'5' => array(
									'heading' => 'Final Total',
									'col_size' => 3
								),
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'quot_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'quothname',
					'hidinputid' => $suffix.'quothid',
					'hidinputcls' => $suffix.'quothcls',
					'anchoraddmoreid' => $suffix.'quotaddid',
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'quot_detail_item[]',
								'id' => $suffix.'quot_detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecngquot '.$suffix.'quot_detail_item'.$aid,
								'value_type' => 'master',
								'value' => 0,								
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'quot_desc[]',
								'id' => $suffix.'desc'.$aid,
								'class' => 'form-control '.$suffix.'quot_desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_desc']) ? $salesinq['sai_itm_desc'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'quot_qty[]',
								'id' => $suffix.'qty'.$aid,
								'class' => 'form-control qty '.$suffix.'qty'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'quot_rate[]',
								'id' => $suffix.'rate'.$aid,
								'class' => 'form-control rate '.$suffix.'rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Discount',
								'type' => 'input',
								'name' => $suffix.'quot_dis[]',
								'id' => $suffix.'discount'.$aid,
								'class' => 'form-control discount '.$suffix.'discount'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'5' => array(
								'heading' => 'Final Total',
								'type' => 'input',
								'name' => $suffix.'quot_ftotl[]',
								'id' => $suffix.'quot_ftotl'.$aid,
								'class' => 'form-control '.$suffix.'quot_ftotl'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						
			)
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'quoteaddmore_ajax_main',
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
/* sales quotation add more end*/	
	public function work_order_add_more($aid = false)
	{

		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$suffixar = $this->input->get('suffix');
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		//$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
			$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Part No.',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Hsn Code',
									'col_size' => 3
								),
								'5' => array(
									'heading' => 'Tax',
									'col_size' => 3
								),
								'6' => array(
									'heading' => 'Discount',
									'col_size' => 3
								),
								'7' => array(
									'heading' => 'Discount Price',
									'col_size' => 3
								),
								'8' => array(
									'heading' => 'Final Total',
									'col_size' => 3
								),
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'wo_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'wohname',
					'hidinputid' => $suffix.'wohid',
					'hidinputcls' => $suffix.'wohcls',
					'anchoraddmoreid' => $suffix.'woaddid',
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part No',
								'type' => 'select',
								'name' => $suffix.'wo_detail_item[]',
								'id' => $suffix.'wo_detail_item'.$aid,
								'class' => 'bs-select form-control wo'.$suffix.'wo_detail_item'.$aid,
								'value_type' => 'master',
								'value' => 0,								
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'wo_desc[]',
								'id' => $suffix.'wo_desc'.$aid,
								'class' => 'form-control'.$suffix.'wo_desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($salesinq['sai_itm_desc']) ? $salesinq['sai_itm_desc'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'wo_qty[]',
								'id' => $suffix.'wo_qty'.$aid,
								'class' => 'form-control qty '.$suffix.'wo_qty'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : 0,
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'wo_rate[]',
								'id' => $suffix.'wo_rate'.$aid,
								'class' => 'form-control rate '.$suffix.'wo_rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : 0,
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'wo_hsn[]',
								'id' => $suffix.'wo_hsn'.$aid,
								'class' => 'bs-select form-control wotax '.$suffix.'wo_hsn'.$aid,
								'value_type' => 'master',
								'value' => 0,								
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'DESC'
													)
								),
						'5' => array(
								'heading' => 'Tax',
								'type' => 'input',
								'name' => $suffix.'wo_tax[]',
								'id' => $suffix.'wo_tax'.$aid,
								'class' => 'form-control '.$suffix.'wo_tax'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : 0,
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Discount',
								'type' => 'input',
								'name' => $suffix.'wo_dis[]',
								'id' => $suffix.'wo_dis'.$aid,
								'class' => 'form-control discount '.$suffix.'wo_dis'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'7' => array(
								'heading' => 'Discount Price',
								'type' => 'input',
								'name' => $suffix.'wo_disprice[]',
								'id' => $suffix.'wo_disprice'.$aid,
								'class' => 'form-control ftotal '.$suffix.'wo_disprice'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_discount']) ? $quote['sai_itm_discount'] : 0,
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'8' => array(
								'heading' => 'Final Total',
								'type' => 'input',
								'name' => $suffix.'wo_ftotl[]',
								'id' => $suffix.'wo_ftotl'.$aid,
								'class' => 'form-control ftotl '.$suffix.'wo_ftotl'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : 0,
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						
			)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'woaddmore_ajax_main',
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
			//echo $this->input->post('woid'); die;
			$idencr = $this->input->post('inqid') ? $this->encrypt_decrypt('decrypt', $this->input->post('inqid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$suffixar = $this->input->get('suffix');
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					//$this->load->model('Sale_quotation_model');
					//echo "<pre>"; print_r($idencr); die;
					$quotes = $this->ajax_add_more_model->get_workorderdata($idencr);
					//echo "<pre>"; print_r($quotes); die;
					$exce = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
					//echo $exce; die;
					//echo "<pre>"; print_r($exce); die;
					//$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']);
					$estr = ''; 
					$quotecount  = count($quotes);
					foreach ($quotes as $quote) { $aid++;
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Part No.',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Hsn Code',
									'col_size' => 3
								),
								'5' => array(
									'heading' => 'Tax',
									'col_size' => 3
								),
								'6' => array(
									'heading' => 'Discount',
									'col_size' => 3
								),
								'7' => array(
									'heading' => 'Discount Price',
									'col_size' => 3
								),
								'8' => array(
									'heading' => 'Final Total',
									'col_size' => 3
								),
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'wo_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'wohname',
					'hidinputid' => $suffix.'wohid',
					'hidinputcls' => $suffix.'wohcls',
					'anchoraddmoreid' => $suffix.'woaddid',
					'main_heading_hthree' => 'Details of Item',
					'results' => array(
						'0' => array(
								'heading' => 'Part NO',
								'type' => 'select',
								'name' => $suffix.'wo_detail_item[]',
								'id' => $suffix.'wo_detail_item'.$aid,
								'class' => 'bs-select form-control itmnamecngquot '.$suffix.'wo_detail_item'.$aid,
								'value_type' => 'master',
								'value' => isset($quote['woi_itm_name']) ? $quote['woi_itm_name'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_master_item',
													'auto_id' => 'master_item_id',
													'result_field' => 'master_item_part_no',
													//'delete_id' => 'master_item_delete',
													'order_by_field' => 'master_item_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Discription',
								'type' => 'textarea',
								'name' => $suffix.'wo_desc[]',
								'id' => $suffix.'wo_desc'.$aid,
								'class' => 'form-control '.$suffix.'wo_desc'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_desc']) ? $quote['woi_itm_desc'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Qty',
								'type' => 'input',
								'name' => $suffix.'wo_qty[]',
								'id' => $suffix.'wo_qty'.$aid,
								'class' => 'form-control '.$suffix.'wo_qty'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_qty']) ? $quote['woi_itm_qty'] : 0,
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'3' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'wo_rate[]',
								'id' => $suffix.'wo_rate'.$aid,
								'class' => 'form-control '.$suffix.'wo_rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_price']) ? $quote['woi_itm_price'] : 0,
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'4' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'wo_hsn[]',
								'id' => $suffix.'wo_hsn'.$aid,
								'class' => 'bs-select form-control wotax '.$suffix.'wo_hsn'.$aid,
								'value_type' => 'master',
								'value' => isset($quote['woi_itm_hsncode']) ? $quote['woi_itm_hsncode'] : '',								
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'DESC'
													)
								),
						'5' => array(
								'heading' => 'Tax',
								'type' => 'input',
								'name' => $suffix.'wo_tax[]',
								'id' => $suffix.'wo_tax'.$aid,
								'class' => 'form-control '.$suffix.'wo_tax'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_tax']) ? $quote['woi_itm_tax'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 2,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'6' => array(
								'heading' => 'Discount',
								'type' => 'input',
								'name' => $suffix.'wo_dis[]',
								'id' => $suffix.'wo_dis'.$aid,
								'class' => 'form-control '.$suffix.'wo_dis'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_dic']) ? $quote['woi_itm_dic'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'7' => array(
								'heading' => 'Discount Price',
								'type' => 'input',
								'name' => $suffix.'wo_disprice[]',
								'id' => $suffix.'wo_disprice'.$aid,
								'class' => 'form-control '.$suffix.'wo_disprice'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_dic_total']) ? $quote['woi_itm_dic_total'] : 0,
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'8' => array(
								'heading' => 'Final total',
								'type' => 'input',
								'name' => $suffix.'wo_ftotl[]',
								'id' => $suffix.'wo_ftotl'.$aid,
								'class' => 'form-control '.$suffix.'wo_ftotl'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['woi_itm_ftotal']) ? $quote['woi_itm_ftotal'] : 0,
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
					
			)
					);
				if($quotecount == $aid)
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
									'heading' => 'Part No.',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Discription',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Quantity',
									'col_size' => 3
								),
								'3' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'4' => array(
									'heading' => 'Hsn Code',
									'col_size' => 3
								),
								'5' => array(
									'heading' => 'Tax',
									'col_size' => 3
								),
								'6' => array(
									'heading' => 'Discount',
									'col_size' => 3
								),
								'7' => array(
									'heading' => 'Discount Price',
									'col_size' => 3
								),
								'8' => array(
									'heading' => 'Final Total',
									'col_size' => 3
								),
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'wo_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'wohname',
					'hidinputid' => $suffix.'wohid',
					'hidinputcls' => $suffix.'wohcls',
					'anchoraddmoreid' => $suffix.'woaddid',
					'main_heading_hthree' => 'Details of item',
					'results' => array()
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'woaddmore_ajax_main',
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
	/* Work Order add more end*/
	public function item_hsn_addr_more($aid = false)
	{

		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$suffixar = $this->input->get('suffix');
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		//$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
			$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Hsn code',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'tax',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'hsn_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'hsnhname',
					'hidinputid' => $suffix.'hsnhid',
					'hidinputcls' => $suffix.'hsnhcls',
					'anchoraddmoreid' => $suffix.'hsnaddid',
					'main_heading_hthree' => 'Hsn Code',
					'results' => array(
						'0' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'hsn_code[]',
								'id' => $suffix.'hsn_code'.$aid,
								'class' => 'bs-select form-control hsn '.$suffix.'hsn_code'.$aid,
								'value_type' => 'master',
								'value' => 0,								
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_hsn_code',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Tax',
								'type' => 'input',
								'name' => $suffix.'tax[]',
								'id' => $suffix.'tax'.$aid,
								'class' => 'form-control '.$suffix.'tax'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
						
			)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'hsnaddmore_ajax_main',
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
			$idencr = $this->input->post('quoteid') ? $this->encrypt_decrypt('decrypt', $this->input->post('quoteid')) : ''; 
			//$this->load->model('Inquiry/Inquiry_model');
			//echo "<pre>"; print_r($educations); die;
			$aid = (isset($aid) && ($aid != false)) ? $aid : 0;
			$suffixar = $this->input->get('suffix');
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					//$this->load->model('Sale_quotation_model');
					$quotes = $this->ajax_add_more_model->get_uquotedata($idencr);
					//echo "<pre>"; print_r($quotes); die;
					//echo "<pre>"; print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); die;
					$exce = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
					//echo $exce; die;
					//echo "<pre>"; print_r($exce); die;
					//$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']);
					$estr = ''; 
					$quotecount  = count($quotes);
					foreach ($quotes as $quote) { $aid++;
					$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Hsn code',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'tax',
									'col_size' => 3
								)
								
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'hsn_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'hsnhname',
					'hidinputid' => $suffix.'hsnhid',
					'hidinputcls' => $suffix.'hsnhcls',
					'anchoraddmoreid' => $suffix.'hsnaddid',
					'main_heading_hthree' => 'Hsn Code',
					'results' => array(
						'0' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'hsn_code[]',
								'id' => $suffix.'hsn_code'.$aid,
								'class' => 'bs-select form-control hsn '.$suffix.'hsn_code'.$aid,
								'value_type' => 'master',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'autoval' => $aid,
								'table_name' => 'tbl_hsn_code',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'ASC'
													)
								),
						'1' => array(
								'heading' => 'Tax',
								'type' => 'input',
								'name' => $suffix.'tax[]',
								'id' => $suffix.'tax'.$aid,
								'class' => 'form-control '.$suffix.'tax'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_qty']) ? $quote['sai_itm_qty'] : '',
								'col_size' => 3,
								'head_col_size' => 4,
								'val_col_size' => 8,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								)
					
			)
					);
				if($quotecount == $aid)
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
									'heading' => 'Hsn code',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'tax',
									'col_size' => 3
								)
								
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'quot_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'quothname',
					'hidinputid' => $suffix.'quothid',
					'hidinputcls' => $suffix.'quothcls',
					'anchoraddmoreid' => $suffix.'quotaddid',
					'main_heading_hthree' => 'Details of item',
					'results' => array()
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'quoteaddmore_ajax_main',
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

	public function fui_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$suffixar = $this->input->get('suffix');	
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		//$suffixar = $this->input->get('suffix');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
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
					'ajaxaddmorecls' => $suffix.'fui_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fuihname',
					'hidinputid' => $suffix.'fuihid',
					'hidinputcls' => $suffix.'fuihcls',
					'anchoraddmoreid' => $suffix.'fuiaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fui_date[]',
								'id' => $suffix.'fui_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fui_date'.$aid,
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
								'name' => $suffix.'fui_method[]',
								'id' => $suffix.'fui_method'.$aid,
								'class' => 'form-control '.$suffix.'fui_method'.$aid,
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
								'name' => $suffix.'fui_exec[]',
								'id' => $suffix.'fui_exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fui_exec'.$aid,
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
								'name' => $suffix.'fui_status[]',
								'id' => $suffix.'fui_status'.$aid,
								'class' => 'form-control '.$suffix.'fui_status'.$aid,
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
								'name' => $suffix.'fui_remrk[]',
								'id' => $suffix.'fui_remrk'.$aid,
								'class' => 'form-control '.$suffix.'fui_remrk'.$aid,
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
								'ajax_main_id' => $suffix.'fui_ajax_main',
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
			$suffixar = $this->input->get('suffix');
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$educations = $this->ajax_add_more_model->get_sifollowup($idencr);
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
					'ajaxaddmorecls' => $suffix.'fui_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fuihname',
					'hidinputid' => $suffix.'fuihid',
					'hidinputcls' => $suffix.'fuihcls',
					'anchoraddmoreid' => $suffix.'fuiaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fui_date[]',
								'id' => $suffix.'fui_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fui_date'.$aid,
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
								'name' => $suffix.'fui_method[]',
								'id' => $suffix.'fui_method'.$aid,
								'class' => 'form-control '.$suffix.'fui_method'.$aid,
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
								'name' => $suffix.'fui_exec[]',
								'id' => $suffix.'fui_exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fui_exec'.$aid,
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
								'name' => $suffix.'fui_status[]',
								'id' => $suffix.'fui_status'.$aid,
								'class' => 'form-control '.$suffix.'fui_status'.$aid,
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
								'name' => $suffix.'fui_remrk[]',
								'id' => $suffix.'fui_remrk'.$aid,
								'class' => 'form-control '.$suffix.'fui_remrk'.$aid,
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
					'ajaxaddmorecls' => $suffix.'fui_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'fuihname',
					'hidinputid' => $suffix.'fuihid',
					'hidinputcls' => $suffix.'fuihcls',
					'anchoraddmoreid' => $suffix.'fuiaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fui_date[]',
								'id' => $suffix.'fui_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fui_date'.$aid,
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
								'name' => $suffix.'fui_method[]',
								'id' => $suffix.'fui_method'.$aid,
								'class' => 'form-control '.$suffix.'fui_method'.$aid,
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
								'name' => $suffix.'fui_exec[]',
								'id' => $suffix.'fui_exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fui_exec'.$aid,
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
								'name' => $suffix.'fui_status[]',
								'id' => $suffix.'fui_status'.$aid,
								'class' => 'form-control '.$suffix.'fui_status'.$aid,
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
								'name' => $suffix.'fui_remrk[]',
								'id' => $suffix.'fui_remrk'.$aid,
								'class' => 'form-control '.$suffix.'fui_remrk'.$aid,
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
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'fui_ajax_main',
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

	public function fuq_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
			$suffixar = $this->input->get('suffix');	
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		//$suffixar = $this->input->get('suffix');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
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
					'ajaxaddmorecls' => $suffix.'fuq_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fuqhname',
					'hidinputid' => $suffix.'fuqhid',
					'hidinputcls' => $suffix.'fuqhcls',
					'anchoraddmoreid' => $suffix.'fuqaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fuq_date[]',
								'id' => $suffix.'fuq_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fuq_date'.$aid,
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
								'name' => $suffix.'fuq_method[]',
								'id' => $suffix.'fuq_method'.$aid,
								'class' => 'form-control '.$suffix.'fuq_method'.$aid,
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
								'name' => $suffix.'fuq_exec[]',
								'id' => $suffix.'fuq_exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fuq_exec'.$aid,
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
								'name' => $suffix.'fuq_status[]',
								'id' => $suffix.'fuq_status'.$aid,
								'class' => 'form-control '.$suffix.'fuq_status'.$aid,
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
								'name' => $suffix.'fuq_remrk[]',
								'id' => $suffix.'fuq_remrk'.$aid,
								'class' => 'form-control '.$suffix.'fuq_remrk'.$aid,
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
								'ajax_main_id' => $suffix.'fuq_ajax_main',
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
			$suffixar = $this->input->get('suffix');	
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$educations = $this->ajax_add_more_model->get_sqfollowup($idencr);
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
					'ajaxaddmorecls' => $suffix.'fuq_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fuqhname',
					'hidinputid' => $suffix.'fuqhid',
					'hidinputcls' => $suffix.'fuqhcls',
					'anchoraddmoreid' => $suffix.'fuqaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fuq_date[]',
								'id' => $suffix.'fuq_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fuq_date'.$aid,
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
								'name' => $suffix.'fuq_method[]',
								'id' => $suffix.'fuq_method'.$aid,
								'class' => 'form-control '.$suffix.'fuq_method'.$aid,
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
								'name' => $suffix.'fuq_exec[]',
								'id' => $suffix.'fuq_exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fuq_exec'.$aid,
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
								'name' => $suffix.'fuq_status[]',
								'id' => $suffix.'fuq_status'.$aid,
								'class' => 'form-control '.$suffix.'fuq_status'.$aid,
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
								'name' => $suffix.'fuq_remrk[]',
								'id' => $suffix.'fuq_remrk'.$aid,
								'class' => 'form-control '.$suffix.'fuq_remrk'.$aid,
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
					'ajaxaddmorecls' => $suffix.'fuq_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'fuqhname',
					'hidinputid' => $suffix.'fuqhid',
					'hidinputcls' => $suffix.'fuqhcls',
					'anchoraddmoreid' => $suffix.'fuqaddid',
					'main_heading_hthree' => 'Follow Up Details',
					'results' => array(
						'0' => array(
								'heading' => 'Start MM/YYYY',
								'type' => 'date',
								'name' => $suffix.'fuq_date[]',
								'id' => $suffix.'fuq_date'.$aid,
								'class' => 'form-control form-control-inline input-medium date-picker '.$suffix.'fuq_date'.$aid,
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
								'name' => $suffix.'fuq_method[]',
								'id' => $suffix.'fuq_method'.$aid,
								'class' => 'form-control '.$suffix.'fuq_method'.$aid,
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
								'name' => $suffix.'fuq_exec[]',
								'id' => $suffix.'fuq_exec'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fuq_exec'.$aid,
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
								'name' => $suffix.'fuq_status[]',
								'id' => $suffix.'fuq_status'.$aid,
								'class' => 'form-control '.$suffix.'fuq_status'.$aid,
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
								'name' => $suffix.'fuq_remrk[]',
								'id' => $suffix.'fuq_remrk'.$aid,
								'class' => 'form-control '.$suffix.'fuq_remrk'.$aid,
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
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'fuq_ajax_main',
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

	public function fraight_add_more($aid = false)
	{
		if($this->input->post('mtype') && $this->input->post('mtype') == 'add'){
			$aid = (isset($aid) && ($aid != false)) ? $aid : 1;
		$suffixar = $this->input->get('suffix');	
		$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
		$multiresult = array();
		$methods = array('By Call','By Email','By SMS','By Whatsapp','By Courier','Other');
		$suffixar = $this->input->get('suffix');
		if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1;
			foreach ($this->input->get('suffix') as $sufkey => $suffix) { $inc++;
			$fields = array( 
					'headdata' => array(
								'0' => array(
									'heading' => 'Fraight',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Hsn Code',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'fraight_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fraighthname',
					'hidinputid' => $suffix.'fraighthid',
					'hidinputcls' => $suffix.'fraighthcls',
					'anchoraddmoreid' => $suffix.'fraightaddid',
					'main_heading_hthree' => 'Other Charges Details',
					'results' => array(
						'0' => array(
								'heading' => 'Charge Name',
								'type' => 'input',
								'name' => $suffix.'fraight_name[]',
								'id' => $suffix.'fraight_name'.$aid,
								'class' => 'form-control '.$suffix.'fraight_name'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'fraight_rate[]',
								'id' => $suffix.'fraight_rate'.$aid,
								'class' => 'form-control '.$suffix.'fraight_rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'fraight_hsn[]',
								'id' => $suffix.'fraight_hsn'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fraight_hsn'.$aid,
								'value_type' => 'master',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'DESC'
													)
								)
			)
					);
			$multiresult[$inc] = array(
								'string' => $this->create_form($fields),
								'ajax_main_id' => $suffix.'fraight_ajax_main',
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
			$suffixar = $this->input->get('suffix');	
			$scount = ($this->input->get('suffix') && !empty($suffixar)) ? count($suffixar) : 1;
			$multiresult = array();
			if ($this->input->get('suffix') && !empty($suffixar)) { $inc = -1; //$aud = -1;
				foreach ($this->input->get('suffix') as $sufkey => $suffix) { $aid = 0; $inc++;
					$educations = $this->ajax_add_more_model->get_otherchargs($idencr);
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
									'heading' => 'Fraight',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Hsn Code',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'fraight_add_more',
					'col_no' => $aid,
					'hidinputname' => $suffix.'fraighthname',
					'hidinputid' => $suffix.'fraighthid',
					'hidinputcls' => $suffix.'fraighthcls',
					'anchoraddmoreid' => $suffix.'fraightaddid',
					'main_heading_hthree' => 'Other Charges Details',
					'results' => array(
						'0' => array(
								'heading' => 'Charge Name',
								'type' => 'input',
								'name' => $suffix.'fraight_name[]',
								'id' => $suffix.'fraight_name'.$aid,
								'class' => 'form-control '.$suffix.'fraight_name'.$aid,
								'value_type' => 'no_value',
								'value' => isset($education['wof_wo_details']) ? $education['wof_wo_details'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'fraight_rate[]',
								'id' => $suffix.'fraight_rate'.$aid,
								'class' => 'form-control '.$suffix.'fraight_rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($education['wof_rate']) ? $education['wof_rate'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'fraight_hsn[]',
								'id' => $suffix.'fraight_hsn'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fraight_hsn'.$aid,
								'value_type' => 'master',
								'value' => isset($education['wof_hsn_code']) ? $education['wof_hsn_code'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'DESC'
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
									'heading' => 'Fraight',
									'col_size' => 3
								),
								'1' => array(
									'heading' => 'Rate',
									'col_size' => 3
								),
								'2' => array(
									'heading' => 'Hsn Code',
									'col_size' => 3
								)
							),
					'designformat' => 'horizontal',
					'headmainclass' => 'edu_info',
					'resultmainclass' => 'edu_all',
					'ajaxaddmorecls' => $suffix.'fraight_add_more',
					'col_no' => 1,
					'hidinputname' => $suffix.'fraighthname',
					'hidinputid' => $suffix.'fraighthid',
					'hidinputcls' => $suffix.'fraighthcls',
					'anchoraddmoreid' => $suffix.'fraightaddid',
					'main_heading_hthree' => 'Other Charges Details',
					'results' => array(
						'0' => array(
								'heading' => 'Charge Name',
								'type' => 'input',
								'name' => $suffix.'fraight_name[]',
								'id' => $suffix.'fraight_name'.$aid,
								'class' => 'form-control '.$suffix.'fraight_name'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'1' => array(
								'heading' => 'Rate',
								'type' => 'input',
								'name' => $suffix.'fraight_rate[]',
								'id' => $suffix.'fraight_rate'.$aid,
								'class' => 'form-control '.$suffix.'fraight_rate'.$aid,
								'value_type' => 'no_value',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => '',
								'table_details' => array()
								),
						'2' => array(
								'heading' => 'Hsn Code',
								'type' => 'select',
								'name' => $suffix.'fraight_hsn[]',
								'id' => $suffix.'fraight_hsn'.$aid,
								'class' => 'bs-select form-control '.$suffix.'fraight_hsn'.$aid,
								'value_type' => 'master',
								'value' => isset($quote['sai_itm_price']) ? $quote['sai_itm_price'] : '',
								'col_size' => 3,
								'head_col_size' => 6,
								'val_col_size' => 6,
								'rows' => 4,
								'autoval' => $aid,
								'table_name' => 'tbl_master_item',
								'table_details' => array(
													'table_name' => 'tbl_hsn_code',
													'auto_id' => 'hsn_id',
													'result_field' => 'hsn_code',
													//'delete_id' => 'master_item_is_delete',
													'order_by_field' => 'hsn_id',
													'order_by' => 'DESC'
													)
								)
			)
					);
				$estr .= $this->create_form($fields,$action = 'edit',$has_addmore = 'yes');
				$onlyaddmore = 1;
			}
			$multiresult[$inc] = array(
								'string' => $estr,
								'ajax_main_id' => $suffix.'fraight_ajax_main',
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

}?>