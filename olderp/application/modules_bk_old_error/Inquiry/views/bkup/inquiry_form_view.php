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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
              <?php $departments = array('class' => 'form-horizontal');
                        echo form_open_multipart($action,$departments); ?>
             <div class="add-section-bg">
                      
                    <div class="row">
                        <div class="pull-right"><a class="btn btn-success btn-space" href="<?php echo base_url(); ?>/inquiry/add"> Save </a><a class="btn btn-success btn-space" href="#"> Save & Continue Edit </a><a class="btn btn-success btn-space" href="#"> Add </a>
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
                                        <label class="control-label col-md-4">Inq. No.<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_no" name="inq_no" tabindex="1" maxlength="20" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Date<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-8">
                                            <input class="form-control form-control-inline date-picker" size="16" type="text" value="" id="inq_date" name="Inq_date" tabindex="2" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                     <label class="control-label col-md-4">Inquiry Type</label>
                                       <div class="col-md-8">
                                        <select id="inq_type" name="inq_type" class="form-control" data-placeholder="Choose Source" tabindex="3">
                                           <option value="Category 1">Only</option>
                                           <option value="Category 2">Walk-in</option>
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
                                        <select id="inq_source" name="inq_source" class="form-control" data-placeholder="Choose Source" tabindex="4">
                                           <option value="Category 1">Category 1</option>
                                           <option value="Category 2">Category 2</option>
                                           <option value="Category 3">Category 5</option>
                                           <option value="Category 4">Category 4</option>
                                        </select>
                                       </div>
                                  </div>
                                  <!--/span-->
                                </div>                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Sub Source</label>
                                           <div class="col-md-8">
                                            <select id="inq_ssource" name="inq_ssource" class="form-control" data-placeholder="Choose Sub Source" tabindex="5">
                                               <option value="Category 1">Category 1</option>
                                               <option value="Category 2">Category 2</option>
                                               <option value="Category 3">Category 5</option>
                                               <option value="Category 4">Category 4</option>
                                            </select>
                                           </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Inquiry Status</label>
                                           <div class="col-md-8">
                                            <select id="inq_area" name="inq_area" class="form-control" data-placeholder="Choose Inquiry Status" tabindex="6">
                                               <option value="Category 1">Suspect</option>
                                               <option value="Category 2">Prospect</option>
                                               <option value="Category 3">Hot</option>
                                               <option value="Category 4">Hot +</option>
                                               <option value="Category 4">Hot ++</option>
                                               <option value="Category 4">Order</option>
                                               <option value="Category 4">Drop</option>
                                            </select>
                                           </div>
                                  </div>
                                </div>                                
                            </div>
                            <div class="row">
                              <div class="col-md-5">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Country Interested :</label>
                                   <div class="col-md-8">
                                        <select multiple="multiple" class="multi-select" id="my_multi_select3" name="cou_inter[]" tabindex="7">
                                            <option>Dallas Cowboys</option>
                                            <option>New York Giants</option>
                                            <option selected>Philadelphia Eagles</option>
                                            <option selected>Washington Redskins</option>
                                            <option>Chicago Bears</option>
                                            <option>Detroit Lions</option>
                                            <option>Green Bay Packers</option>
                                            <option>Minnesota Vikings</option>
                                            <option selected>Atlanta Falcons</option>
                                            <option>Carolina Panthers</option>
                                            <option>New Orleans Saints</option>
                                            <option>Tampa Bay Buccaneers</option>
                                            <option>Arizona Cardinals</option>
                                            <option>St. Louis Rams</option>
                                            <option>San Francisco 49ers</option>
                                            <option>Seattle Seahawks</option>
                                        </select>
                                   </div>
                              </div>
                              </div>
                              <!--/span--> 
                              <div class="col-md-5">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Country Elegable :</label>
                                   <div class="col-md-8">
                                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="con_eleg[]" tabindex="8">
                                            <option>Dallas Cowboys</option>
                                            <option>New York Giants</option>
                                            <option selected>Philadelphia Eagles</option>
                                            <option selected>Washington Redskins</option>
                                            <option>Chicago Bears</option>
                                            <option>Detroit Lions</option>
                                            <option>Green Bay Packers</option>
                                            <option>Minnesota Vikings</option>
                                            <option selected>Atlanta Falcons</option>
                                            <option>Carolina Panthers</option>
                                            <option>New Orleans Saints</option>
                                            <option>Tampa Bay Buccaneers</option>
                                            <option>Arizona Cardinals</option>
                                            <option>St. Louis Rams</option>
                                            <option>San Francisco 49ers</option>
                                            <option>Seattle Seahawks</option>
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
                                                            <input type="radio" name="inq_ref" id="inq_ref" value="option1" tabindex="9" checked> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="inq_ref" id="inq_ref" value="option2" tabindex="10"> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Reference Name<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_custname" name="inq_custname" tabindex="11" maxlength="40" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Reference No.<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="inq_custno" name="inq_custno" tabindex="12" maxlength="20" required="required">
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <h3>Product Details</h3>
                           <hr />
                           <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                 <label class="control-label col-md-4">Product</label>
                                   <div class="col-md-8">
                                    <select id="product" name="product" class="form-control" data-placeholder="Choose City" tabindex="30">
                                       <option value="Category 1">Visa</option>
                                       <option value="Category 2">Education</option>
                                       <option value="Category 3">Franchise</option>
                                    </select>
                                   </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Type</label>
                                       <div class="col-md-8">
                                        <select id="pro_type" name="pro_type" class="form-control" data-placeholder="Choose Area" tabindex="31">
                                           <option value="Category 1">Student Visa</option>
                                           <option value="Category 2">Immigration</option>
                                           <option value="Category 3">Visitor Visa</option>
                                        </select>
                                       </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Category</label>
                                       <div class="col-md-8">
                                        <select id="pro_category" name="pro_category" class="form-control" data-placeholder="Choose Zip" tabindex="32">
                                           <option value="Category 1">SW</option>
                                           <option value="Category 2">Q</option>
                                           <option value="Category 3">PNP</option>
                                        </select>
                                       </div>
                                  </div>
                                </div>
                            </div>
                            <h3>Follow Up Details</h3>
                            <hr />
                            <div class="edu_info">
                                <div class="row">
                                        <div class="col-md-3 text-center">
                                          <div>
                                             <label class="control-label">Follow Up Date</label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                          <div>
                                             <label class="control-label">Follow Up Method</label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                          <div>
                                             <label class="control-label">Follow Up By Executive</label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                          <div>
                                             <label class="control-label">Follow Up Status</label>
                                          </div>
                                        </div>                           
                                </div>
                            </div>
                            <div class="edu_all">
                                <div class="edu_1">
                                   <div class="row">
                                        <div class="col-md-3">
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <input type="text" class="form-control" id="inq_fdate" name="inq_fdate" tabindex="13" maxlength="15" required="required">
                                             </div>
                                         </div>
                                        </div>
                                        <div class="col-md-3">
                                             <div class="form-group">
                                                 <div class="col-md-12">
                                                    <input type="text" class="form-control" id="inq_fmethod" name="inq_fmethod" tabindex="14" maxlength="50" required="required" placeholder="SMS, Email, Call">
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                 <div class="col-md-12">
                                                    <input type="text" class="form-control" id="inq_fexe" name="inq_fexe" tabindex="15" maxlength="50" required="required">
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                <select id="inq_status" name="inq_status" class="form-control" data-placeholder="Choose Sub Source" tabindex="16">
                                                   <option value="Category 1">Category 1</option>
                                                   <option value="Category 2">Category 2</option>
                                                   <option value="Category 3">Category 5</option>
                                                   <option value="Category 4">Category 4</option>
                                                </select>
                                                </div>
                                          </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                   <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="control-label col-md-2">Remark :</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="3" id="inq_remark" name="inq_remark" tabindex="17"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                  </div> 
                               </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:;" class="btn green button-submit" tabindex="17"> Add More Follow Up
                                    <i class="fa fa-check"></i>
                                    </a>  
                                </div>
                            </div>
                            <br />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                        <a href="javascript:;" class="btn default button-previous" style="display: none;" tabindex="18">
                                            <i class="fa fa-angle-left"></i> Back </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next" tabindex="19" id="continue-btn"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <a href="javascript:;" class="btn green button-submit" style="display: none;"> Submit
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php //********************** Inquiry end ***************************** ?>
<?php //********************** Basic Detail start ***************************** ?>
                        <?php echo $this->load->view('inquiry_form_view_basic_details_tab'); ?>
<?php //********************** Basic Detail end ***************************** ?>
<?php //********************** Applicant start ***************************** ?>
                        <?php echo $this->load->view('inquiry_form_view_applicant_tab'); ?>
<?php //********************** Education end ***************************** ?>
<?php //********************** Spouse Details Start ***************************** ?>
						<?php echo $this->load->view('inquiry_form_view_spouse_tab'); ?>
<?php //********************** Spouse Details End ***************************** ?>
                        <br />
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                        <a href="javascript:;" class="btn default button-previous" style="display: inline-block;">
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
        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
         <script type="text/javascript"> var suffix = '<?php echo json_encode(array("me","spouse")); ?>';</script>
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
// <script type="text/javascript">
 $(function(){

    $('#continue-btn').click(function(e){
      //alert('fhfhhf');
      e.preventDefault();
         $('#mytabs a[href="#tab_1_1_2"]').tab('show');
           e.preventDefault();
          $('#mytabs a[href="#tab_1_1_3"]').tab('show');


    })

})
 </script>
 <script type="text/javascript">
 $(function(){

    $('#back-btn').click(function(e){
      //alert('fhfhhf');
      e.preventDefault();
         $('#mytabs a[href="#tab_1_1_1"]').tab('show');
           e.preventDefault();
            e.preventDefault();
         $('#mytabs a[href="#tab_1_1_2"]').tab('show');
           e.preventDefault();
          $('#mytabs a[href="#tab_1_1_3"]').tab('show');


    })

})
 </script>
