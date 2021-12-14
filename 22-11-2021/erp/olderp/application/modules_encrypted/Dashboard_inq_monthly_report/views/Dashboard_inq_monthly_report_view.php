<?php //echo "<pre>"; print_r($dailys); die;?>
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <?php echo validation_errors(); ?>
                            <?php
                            if (!empty($success) || $this->session->flashdata('success') != '') {
                                $msg = !empty($success) ? $success : $this->session->flashdata('success');
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            if (!empty($error) || $this->session->flashdata('error') != '') {
                                $msg = !empty($error) ? $error : $this->session->flashdata('error');
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            if (!empty($warning) || $this->session->flashdata('warning') != '') {
                                $msg = !empty($warning) ? $warning : $this->session->flashdata('warning');
                                echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            ?>
                        <?php if (!empty($rights_error) || $this->session->flashdata('rights_error') != '') {
            $msg = !empty($rights_error) ? $rights_error : $this->session->flashdata('rights_error');
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';}?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo number_format($inq_stats['totalinq']['count']);?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <small>TOTAL INQUIRIES</small>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                    <!-- <div class="progress-info">
                                        <div class="progress">
                                            <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                                <span class="sr-only">76% progress</span>
                                            </span>
                                        </div>
                                        <div class="status">
                                            <div class="status-title"> progress </div>
                                            <div class="status-number"> 76% </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalvisa']['count']) ? number_format($inq_stats['totalvisa']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <small>TOTAL Visa File</small>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                    <!-- <div class="progress-info">
                                        <div class="progress">
                                            <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                                <span class="sr-only">76% progress</span>
                                            </span>
                                        </div>
                                        <div class="status">
                                            <div class="status-title"> progress </div>
                                            <div class="status-number"> 76% </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body form">
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                <h3 class="form-section">Monthly Report</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Executive Name:</label>
                                            <label class="control-label col-md-1"><?php echo isset($month_datas['au_fname']) ? $month_datas['au_fname'] : '';?></label>
                                                <div class="col-md-9"><input type="hidden" class="form-control" id="exec_name" name="exec_name" value="<?php echo isset($month_datas['au_fname']) ? $month_datas['au_fname'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Partner Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="partner_name" name="partner_name" value="<?php echo isset($month_datas['exec_month_partner_name']) ? $month_datas['exec_month_partner_name'] : '';?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                     </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Investor Visa</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                 <input type="text" class="form-control" id="iv_comi_name" name="iv_comi_name" value="<?php echo isset($month_datas['exec_month_inv_commited']) ? $month_datas['exec_month_inv_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="iv_actu_name" name="iv_actu_name" value="<?php echo isset($month_datas['exec_month_inv_actual']) ? $month_datas['exec_month_inv_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Immigration (PR)</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="im_comi_name" name="im_comi_name" value="<?php echo isset($month_datas['exec_month_im_commited']) ? $month_datas['exec_month_im_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                

                                                 <input type="text" class="form-control" id="im_actu_name" name="im_actu_name" value="<?php echo isset($month_datas['exec_month_im_actual']) ? $month_datas['exec_month_im_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Student Visa</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="sv_comi_name" name="sv_comi_name" value="<?php echo isset($month_datas['exec_month_st_commited']) ? $month_datas['exec_month_st_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="sv_actu_name" name="sv_actu_name" value="<?php echo isset($month_datas['exec_month_st_actual']) ? $month_datas['exec_month_st_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Franchise</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="svf_frai_name" name="svf_frai_name" value="<?php echo isset($month_datas['exec_month_franchise_commited']) ? $month_datas['exec_month_franchise_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="svf_frau_name" name="svf_frau_name" value="<?php echo isset($month_datas['exec_month_franchise_actual']) ? $month_datas['exec_month_franchise_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Visitor</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="svf_visic_name" name="svf_visic_name" value="<?php echo isset($month_datas['exec_month_visiter_commited']) ? $month_datas['exec_month_visiter_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="svf_visiu_name" name="svf_visiu_name" value="<?php echo isset($month_datas['exec_month_visiter_actual']) ? $month_datas['exec_month_visiter_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Other</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="svf_otherc_name" name="svf_otherc_name" value="<?php echo isset($month_datas['exec_month_other_commited']) ? $month_datas['exec_month_other_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="svf_otheru_name" name="svf_otheru_name" value="<?php echo isset($month_datas['exec_month_other_actual']) ? $month_datas['exec_month_other_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Total</label>
                                            <label class="control-label col-md-3">Committed</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="tot_comi_name" name="tot_comi_name" value="<?php echo isset($month_datas['exec_month_total_commited']) ? $month_datas['exec_month_total_commited'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Actual</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="tot_actu_name" name="tot_actu_name" value="<?php echo isset($month_datas['exec_month_total_actual']) ? $month_datas['exec_month_total_actual'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Monthly Executive Report List</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3">
                                            <thead>
                                                <tr>
                                                    <th class="all">Date</th>
                                                    <th class="all">Executive Name</th>
                                                    <th class="all">Investor Visa Committed</th>
                                                    <th class="all">Investor Visa Actual</th>
                                                    <th class="all">Immigration (PR) Committed</th>
                                                    <th class="all">Immigration (PR) Actual</th>
                                                    <th class="all">Student Visa Committed</th>
                                                    <th class="all">Student Visa Actual</th>
                                                    <th class="all">Franchise Committed</th> 
                                                    <th class="all">Franchise Actual</th>
                                                    <th class="all">Visitor Committed</th> 
                                                    <th class="all">Visitor Actual</th>
                                                    <th class="all">Other Committed</th> 
                                                    <th class="all">Other Actual</th>
                                                    <th class="all">Total Committed</th>
                                                    <th class="all">Total Actual</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($dailys as $daily) { $id++; ?>
                                                    <tr>
                                                        <td><?php echo date("d-m-Y", strtotime($daily['exec_month_date'])); ?></td>
                                                        <td><?php echo $daily['exec_month_exec_name']; ?></td>
                                                        <td><?php echo $daily['exec_month_inv_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_inv_actual']; ?></td>
                                                        <td><?php echo $daily['exec_month_im_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_im_actual']; ?></td>
                                                        <td><?php echo $daily['exec_month_st_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_st_actual']; ?></td>
                                                        <td><?php echo $daily['exec_month_franchise_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_franchise_actual']; ?></td>

                                                        <td><?php echo $daily['exec_month_visiter_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_visiter_actual']; ?></td>
                                                        <td><?php echo $daily['exec_month_other_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_other_actual']; ?></td>
                                                        
                                                        <td><?php echo $daily['exec_month_total_commited']; ?></td>
                                                        <td><?php echo $daily['exec_month_total_actual']; ?></td>
                                                        
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    
                   <!-- END PAGE BASE CONTENT -->
                </div>

<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->