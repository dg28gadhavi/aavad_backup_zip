<?php //echo "<pre>"; print_r($list['inquiry']); die;?>
<?php //echo "<pre>"; print_r($datas['sources']); die;?>
<?php //echo "<pre>";print_r($inq_code);die;?>
<div class="loader"></div>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>skin/css/style.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Inquiry Add</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li class="active">Inquiry</li>
                        </ol>                        
                    </div>
                    <!-- END BREADCRUMBS -->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="page-content-col">
<!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
       <div class="col-md-12">             
            <div class="portlet-body form">
              <?php $departments = array('class' => 'form-horizontal', 'id' => 'inquiry_form');
                        echo form_open_multipart($action,$departments); ?>
                         <!--  -->
             <div class="add-section-bg">
              <input type="hidden" id="me" class="me" name="me">
                    <div class="row">
                        <div class="pull-right"><button type="button" class="btn green btn-space" id="1" onclick="return savestatus(1)">Save</button><button type="button" class="btn green btn-space" id="2" onclick="return savestatus(2)" style="display:none"> Save & Continue Edit </button><button type="button" class="btn green btn-space" style="display:none"> Add </button>
                        </div>
                    </div>
                    </div>
                  
                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified" id="mytabs">
                        <li class="active">
                            <a href="#tab_1_1_1" data-toggle="tab"> <span class="badge badge-danger">1</span> <strong>Inquiry Details</strong> </a>
                        </li>
                        <li>
                            <a href="#tab_1_1_2" data-toggle="tab"> <span class="badge badge-danger">2</span> <strong>Basic Details</strong> </a>
                        </li>
                        <li>
                            <a href="#tab_1_1_3" data-toggle="tab"> <span class="badge badge-danger">3</span> <strong>Applicant Details</strong> </a>
                        </li>
                        <li>
                            <a href="#tab_1_1_4" data-toggle="tab"> <span class="badge badge-danger">4</span> <strong>Spouse Details</strong> </a>
                        </li>
                    </ul>
                    <div class="tab-content">
<?php //********************** Inquiry start ***************************** ?>
                            <div class="tab-pane tab-space active" id="tab_1_1_1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Inq. No.<span class="" aria-required="true">  </span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_no" name="inquiry_details[inq_no]" value="<?php echo !$this->input->get('id') && isset($inq_code) ? $inq_code : ''; ?><?php echo isset($list['inquiry'][0]['inq_no']) ? $list['inquiry'][0]['inq_no'] : ""; ?>" tabindex="1" maxlength="20">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Date<span class="" aria-required="true">  </span></label>
                                        <div class="col-md-8">
                                            <input class="form-control form-control-inline date-picker" size="16" type="text"  id="inq_date" name="inquiry_details[date]" value="<?php echo isset($list['inquiry'][0]['inq_date']) ? date("d-m-Y", strtotime($list['inquiry'][0]['inq_date'])) : ""; ?>" tabindex="2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                     <label class="control-label col-md-4">Inquiry Type</label>
                                       <div class="col-md-8">
                                        <select id="inq_type" name="inquiry_details[type]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source" tabindex="3">
                                          <option>Select Inquiry Type</option>
                                           <?php foreach($datas['inquirys'] as $inq) { ?>
                                           <option value="<?php echo  $inq['inquiry_type_id'];?>" <?php if(isset($list['inquiry'][0]['inq_type']) && ($list['inquiry'][0]['inq_type'] == $inq['inquiry_type_id'])){ ?> selected="selected" <?php } ?>><?php echo  $inq['inquiry_type_name'];?></option>
                                           <?php } ?>
                                        </select>
                                       </div>
                                  </div>
                                </div>
                            <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Source</label>
                                       <div class="col-md-8">
                                        <select id="inq_source" name="inquiry_details[source]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source"  tabindex="4">
                                          <option value="">Select Source</option>
                                            <?php foreach($datas['sources'] as $src) { ?>
                                           <option value="<?php echo  $src['source_cat_id'];?>" <?php if(isset($list['inquiry'][0]['inq_source']) && ($list['inquiry'][0]['inq_source'] == $src['source_cat_id'])){ ?> selected="selected" <?php } ?>><?php echo  $src['source_cat_name'];?></option>
                                           <?php } ?>
                                        </select>
                                       </div>
                                  </div>
                                  <!--/span-->
                                </div>                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Sub Source</label>
                                           <div class="col-md-8">
                                            <?php //echo '<pre>'; print_r($list['subsource']); die;?>
                                            <select id="inq_ssource" name="inquiry_details[ssource]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Sub Source"  tabindex="5">
                                           <option value="">Select Sub Source</option>
                                           <?php /* if(isset($list) && isset($list['inquiry']) && $list != '' && $list['inquiry'] != '') { ?> 
                                           <option value="<?php echo  $list['inquiry'][0]['parentcat'];?>" selected><?php echo  $list['inquiry'][0]['parentcat'];?></option>
                                           <?php } */ ?>
                                           <?php if(isset($list) && isset($list['subsource']) && is_array($list['subsource']) && !empty($list['subsource'])) { ?>
                                           <?php foreach ($list['subsource'] as $subsource) { ?>
                                             <option value="<?php echo  $subsource['source_main_cat'];?>" <?php if(isset($list['inquiry'][0]['inq_subsource']) && ($list['inquiry'][0]['inq_subsource'] == $subsource['source_main_cat'])){ ?> selected="selected" <?php } ?> ><?php echo  $subsource['source_cat_name'];?></option>
                                           <?php } ?> 
                                           <?php } ?>
                                            </select>
                                           </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Inquiry Status</label>
                                           <div class="col-md-8">
                                            <select id="inq_inqstatus" name="inquiry_details[inqstatus]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Inquiry Status" tabindex="6">
                                              <option value="">Select Inquiry Status</option>
                                                <?php foreach($datas['inqst'] as $inqs) { ?>
                                           <option value="<?php echo  $inqs['inquiry_status_id'];?>" <?php if(isset($list['inquiry'][0]['inq_inqstatus']) && ($list['inquiry'][0]['inq_inqstatus'] == $inqs['inquiry_status_id'])){ ?> selected="selected" <?php } ?>><?php echo  $inqs['inquiry_status_name'];?></option>
                                           <?php } ?>
                                            </select>
                                           </div>
                                  </div>
                                </div>                                
                            </div>
                            <?php if($this->uri->segment(2) && ($this->uri->segment(2) != 'edit')){
                              $countryoptions = ''; $countryoptions .= ''; ?>
							               <?php foreach($datas['countrys'] as $country) { ?>
                                           <?php $countryoptions .= '<option value="'.$country['country_id'].'" ';
                                           $countryoptions .= ' > '.$country['country_name'].'</option>'; ?>
                                           <?php } }else if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){
                                            $icountryoptions = ''; $ecountryoptions = '';
                                            ?>
                                            <?php $cintrest = array(); $celegible = array();
                                              if(isset($list) && isset($list['ucountry']) && !empty($list['ucountry']))
                                                {
                                                  foreach ($list['ucountry'] as $ucountry) {
                                                      if(isset($ucountry['inqci_bit']) && isset($ucountry['locations']) && ($ucountry['locations'] != '') && ($ucountry['inqci_bit'] == 1))
                                                      {
                                                        $cintrest = explode(',', $ucountry['locations']);
                                                      }
                                                      if(isset($ucountry['inqci_bit']) && isset($ucountry['locations']) && ($ucountry['locations'] != '') && ($ucountry['inqci_bit'] == 2))
                                                      {
                                                        $celegible = explode(',', $ucountry['locations']);
                                                      }
                                                  }
                                                }
                                             ?>
                                              <?php foreach($datas['countrys'] as $country) { ?>
                                                <?php $icountryoptions .= '<option value="'.$country['country_id'].'" ';
                                                $ecountryoptions .= '<option value="'.$country['country_id'].'" ';
                                           //$list['ucountry']
                                                if(isset($cintrest) && !empty($cintrest) && in_array($country['country_id'],$cintrest))
                                                {
                                                  $icountryoptions .= ' selected="selected"';
                                                }
                                                if(isset($celegible) && !empty($celegible) && in_array($country['country_id'],$celegible))
                                                {
                                                  $ecountryoptions .= ' selected="selected"';
                                                }
                                           $icountryoptions .= ' > '.$country['country_name'].'</option>';
                                           $ecountryoptions .= ' > '.$country['country_name'].'</option>'; ?>
                                              <?php } ?>
                                           <?php } ?>
                            <div class="row">
                              <div class="col-md-5">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Country Interested :</label>
                                   <div class="col-md-8">
                                        <select multiple="multiple" class="multi-select" id="my_multi_select3" name="inquiry_details[cou_inter][1][]" tabindex="7">
                                        <?php if($this->uri->segment(2) && ($this->uri->segment(2) != 'edit')){ ?>
                                         <?php echo $countryoptions; ?>   
                                         <?php }else if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ ?>
                                          <?php echo $icountryoptions; ?>   
                                         <?php } ?>
                                        </select>
                                   </div>
                              </div>
                              </div>
                              <!--/span--> 
                              <div class="col-md-5">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Country Elegable :</label>
                                   <div class="col-md-8">
                                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="inquiry_details[cou_inter][2][]" tabindex="8">
                                            <?php if($this->uri->segment(2) && ($this->uri->segment(2) != 'edit')){ ?>
                                         <?php echo $countryoptions; ?>   
                                         <?php }else if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ ?>
                                          <?php echo $ecountryoptions; ?>   
                                         <?php } ?>
                                        </select>
                                   </div>
                              </div>
                              </div>
                              <!--/span-->                             
                           </div>
                           <br />
                           <div class="row">
                            <div class="col-md-3">
                                    <div class="form-group">
                                   <label class="col-md-5 control-label">Reference</label>
                                                <div class="col-md-7">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="inquiry_details[hasref]" id="inq_ref" onchange="showDivno(this)" value="1" <?php  if(isset($list['basic_details'][0]['bd_gender']) && ($list['basic_details'][0]['bd_gender'] == 'm')){ ?> checked <?php }  ?> tabindex="9" > Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input  type="radio" name="inquiry_details[hasref]" id="inq_refno"  value="2" tabindex="10" checked> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                    </div>
                            </div>
                            <div class="col-md-4" id="reference_name">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Reference Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_custname" name="inquiry_details[custname]" value="<?php echo isset($list['inquiry'][0]['inq_rername']) ? $list['inquiry'][0]['inq_rername'] : ""; ?>" tabindex="11" maxlength="40">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="reference_no">
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Reference No.<!--<span class="" aria-required="true">-->  </span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="inq_custno" name="inquiry_details[inq_custno]" value="<?php echo isset($list['inquiry'][0]['inq_refno']) ? $list['inquiry'][0]['inq_refno'] : ""; ?>" tabindex="12" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Admin</label>
                                       <div class="col-md-8">
                                        <select id="inq_au" name="inquiry_details[au]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source"  tabindex="4">
                                          <option value="">Select Admin</option>
                                            <?php foreach($datas['users'] as $user) { ?>
                                           <option value="<?php echo  $user['au_id'];?>" <?php if(isset($list['inquiry'][0]['inq_au_id']) && ($list['inquiry'][0]['inq_au_id'] == $user['au_id'])){ ?> selected="selected" <?php } ?>><?php echo  $user['au_fname'];?> <?php echo  $user['au_lname'];?></option>
                                           <?php } ?>
                                        </select>
                                       </div>
                                  </div>
                                  <!--/span-->
                                </div> 
                                </div>
                           <h3>Product Details</h3>
                           <hr />
                           <div class="row">
                                <div class="col-md-4" style="display:none">
                                <div class="form-group">
                                 <label class="control-label col-md-4">Product</label>
                                   <div class="col-md-8">
                                    <select id="product" name="product" class="bs-select form-control" data-live-search="true" data-placeholder="Choose City" tabindex="13">
                                      <option value="">Select Product</option>
                                      <?php foreach($datas['prds'] as $prd) { ?>
                                           <option value="<?php echo  $prd['pro_id'];?>" <?php if(isset($list['products'][0]['pro_id']) && ($list['products'][0]['pro_id'] == $prd['pro_id'])){ ?> selected="selected" <?php } ?>><?php echo  $prd['pro_name'];?></option>
                                           <?php } ?>
                                    </select>
                                   </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Type</label>
                                       <div class="col-md-8">
                                        <select id="pro_type" name="pro_type" class="bs-select form-control"  data-live-search="true" data-placeholder="Choose Area" tabindex="14">
                                           <option value="">Select Type</option>
                                           <?php if($this->uri->segment(2) == 'add') { ?>
                                           <?php foreach ($datas['ptypes'] as $prtps) { ?>
                                             <option value="<?php echo  $prtps['prot_id'];?>" <?php if(isset($datas['products'][0]['pro_id']) && ($datas['products'][0]['prot_id'] == $prtps['prot_id'])){ ?> selected="selected" <?php } ?> ><?php echo  $prtps['prot_name'];?></option>
                                           <?php } ?> 
                                           <?php } ?>
                                           
                                           <?php if($this->uri->segment(2) == 'edit') { ?>
                                           <?php if(isset($list) && isset($list['prtps']) && is_array($list['prtps']) && !empty($list['prtps'])) { ?>
                                           <?php foreach ($list['prtps'] as $prtps) { ?>
                                             <option value="<?php echo  $prtps['prot_id'];?>" <?php if(isset($list['products'][0]['pro_id']) && ($list['products'][0]['prot_id'] == $prtps['prot_id'])){ ?> selected="selected" <?php } ?> ><?php echo  $prtps['prot_name'];?></option>
                                           <?php } ?> 
                                           <?php } ?>
                                           <?php } ?>
                                        </select>
                                       </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Category</label>
                                       <div class="col-md-8">
                                        <select id="pro_category" name="pro_category" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Zip" tabindex="15">
                                          <option value="">Select Category</option>
                                          <?php /*foreach($datas['prcats'] as $prcat) { ?>
                                           <option value="<?php echo  $prcat['procat_id'];?>" <?php if(isset($list['products'][0]['prod_cat_id']) && ($list['products'][0]['prod_cat_id'] == $prcat['procat_id'])){ ?> selected="selected" <?php } ?>><?php echo  $prcat['procat_name'];?></option>
                                           <?php } */ ?>
                                           <?php if(isset($list) && isset($list['prcats']) && is_array($list['prcats']) && !empty($list['prcats'])) { ?>
                                           <?php foreach ($list['prcats'] as $prcats) { ?>
                                             <option value="<?php echo  $prcats['procat_id'];?>" <?php if(isset($list['products'][0]['pro_id']) && ($list['products'][0]['procat_id'] == $prcats['procat_id'])){ ?> selected="selected" <?php } ?> ><?php echo  $prcats['procat_name'];?></option>
                                           <?php } ?> 
                                           <?php } ?>
                                        </select>
                                       </div>
                                  </div>
                                </div>
                            </div>
                                    <?php //**************************** Followup Start ************************** ?>
                                    <?php if($this->uri->segment('2') == 'edit'){ ?>
                                      <div id="mefup_ajax_main">
                                      </div>
                                      <?php } ?>
                                    <?php //**************************** Followup End ************************** ?>
                            <br />
                             
                                <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                        <a href="javascript:;" class="btn btn-outline green button-next" tabindex="15" id="continue-btn"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                            
                        </div>
<?php //********************** Inquiry end ***************************** ?>
<?php //********************** Basic Detail start ***************************** ?>
                        <?php echo $this->load->view('Inquiry_form_view_basic_details_tab'); ?>
<?php //********************** Basic Detail end ***************************** ?>
<?php //********************** Applicant start ***************************** ?>
                        <?php echo $this->load->view('Inquiry_form_view_applicant_tab'); ?>
<?php //********************** Education end ***************************** ?>
<?php //********************** Spouse Details Start ***************************** ?>
						<?php echo $this->load->view('Inquiry_form_view_spouse_tab'); ?>
<?php //********************** Spouse Details End ***************************** ?>
                        <br />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                        <a href="javascript:;" class="btn default button-previous" style="display: none;">
                                            <i class="fa fa-angle-left"></i> Back </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next" style="display: none;"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <a href="javascript:;" class="btn green button-submit" style="display: none;"> Submit
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
  </div>
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
         <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
         <script type="text/javascript"> var suffix = '<?php echo json_encode(array("me","spouse")); ?>'; var paction ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>'; 
         <?php  if($this->uri->segment(3) && $this->uri->segment(3) != ''){ ?>
          var encid = "<?php echo $this->uri->segment(3); ?>"; 
          <?php }else{ ?>
            var encid = 0; 
            <?php } ?>
         var enc ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>' </script>
        <script src="<?php echo base_url(); ?>assets/custom/js/inquiry_form.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/role_management.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

<?php //theme layout scripts ?>