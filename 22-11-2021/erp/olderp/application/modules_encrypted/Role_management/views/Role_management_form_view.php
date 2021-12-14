<?php //echo "<pre>"; print_r($list); die;?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Rights Management</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li class="active">Rights Management</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
<!-- BEGIN PAGE BASE CONTENT -->
<div class="page-content-col">
<!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
       <div class="col-md-12">
                   <div class="portlet-body form">
                      <!-- BEGIN FORM-->
                      <?php $departments = array('class' => 'form-horizontal');
                        echo form_open_multipart($action,$departments); ?>
                        <div class="form-body form-space">
                         <h3 class="form-section">Rights Information</h3>
                           <div class="row">
                                <div class="col-md-4">
                                 <div class="form-group">
                                   <label class="control-label col-md-3">Rights Name<span class="required" aria-required="true"> * </span></label>
                                     <div class="col-md-9">
                                        <input type="text" class="form-control" id="rolename" name="rolename" value="<?php echo isset($list['rght'][0]['rights_name']) ? $list['rght'][0]['rights_name'] : '';?>" tabindex="1" maxlength="40" required="required">
                                     </div>
                                 </div>
                                </div>
                           	<!--/span-->
                            <!--/row-->
                            </div>
                           <!--/row-->
                           <div class="row">
                                <?php foreach($datas['modules'] as $module) { ?>
                                
                              <div class="col-md-12">
                              <div class="form-group">
 								<label class="control-label col-md-2"><?php echo isset($module['module_name']) ? $module['module_name'] : ""; ?></label>
                            		<div class="mt-checkbox-inline">
                                		<label class="mt-checkbox">
                                    	<input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][add]" id="add<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="add" value="1" tabindex="5" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_add']) && ($module['edit_rights']['rightsdt_add'] == 1)){ ?> checked="checked" <?php } ?>> Add
                                    		<span></span>
                                		</label>
                                		<label class="mt-checkbox">
                                    	<input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][edit]" id="edit<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="edit" value="1" tabindex="6" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_edit']) && ($module['edit_rights']['rightsdt_edit'] == 1)){ ?> checked="checked" <?php } ?> > Edit
                                    		<span></span>
                                		</label>
                                    <label class="mt-checkbox">
                                      <input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][view]" id="view<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="view" value="1" tabindex="7" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_view']) && ($module['edit_rights']['rightsdt_view'] == 1)){ ?> checked="checked" <?php } ?> > View
                                      <span></span>
                                    </label>
                                		<label class="mt-checkbox">
                                    	<input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][delete]" id="delete<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="delete" value="1" tabindex="8" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_delete']) && ($module['edit_rights']['rightsdt_delete'] == 1)){ ?> checked="checked" <?php } ?> > Delete
                                    	<span></span>
                                		</label>
                                    <label class="mt-checkbox">
                                      <input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][print]" id="print<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="print" value="1" tabindex="9" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_print']) && ($module['edit_rights']['rightsdt_print'] == 1)){ ?> checked="checked" <?php } ?> > Print
                                      <span></span>
                                    </label>
                                    <label class="mt-checkbox">
                                      <input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][download]" id="download<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="download" value="1" tabindex="10" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_download']) && ($module['edit_rights']['rightsdt_download'] == 1)){ ?> checked="checked" <?php } ?> > Download
                                      <span></span>
                                    </label>
                                        <label class="mt-checkbox">
                                    	<input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][mail]" id="mail<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="mail" value="1" tabindex="11" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit') && isset($module['edit_rights']) && !empty($module['edit_rights']) && isset($module['edit_rights']['rightsdt_mail']) && ($module['edit_rights']['rightsdt_mail'] == 1)){ ?> checked="checked" <?php } ?> > Mail
                                    	<span></span>
                                		</label>
                                        <label class="mt-checkbox">
                                    	<input type="checkbox" name="rights[<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>][checkall]" id="checkall<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" class="checkall" value="<?php echo isset($module['module_id']) ? $module['module_id'] : ""; ?>" tabindex="10" > Check all
                                    	<span></span>
                                		</label>
                            		</div>
                                </div>
                             </div>
                             <!--/span-->
                             
                                <?php } ?>
                              </div> 
                           <div class="form-actions">
                           <div class="row">
                             <div class="col-md-6">
                              <div class="row">
                               <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Submit</button>
                                 <button type="button" class="btn default">Cancel</button>
                               </div>
                              </div>
                             </div>
                             <div class="col-md-6"> </div>
                            </div>
                          </div>                        
                      <?php echo form_close(); ?>
                         <!-- END FORM-->
                        <!-- </div>
                       </div>-->
                                                    
                    <!-- END PORTLET-->
            </div>
         <!-- END PAGE BASE CONTENT -->
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
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
  
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/role_management.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        

         <script type="text/javascript">
        $('.checkall').change(function(){
            //alert($(this).attr('id'));
           // alert($(this).val());
            if($('#'+$(this).attr('id')).is(':checked')){

              $('#add'+$(this).val()).prop('checked', true); 
              $('#edit'+$(this).val()).prop('checked', true); 
              $('#delete'+$(this).val()).prop('checked', true); 
              $('#view'+$(this).val()).prop('checked', true);  
              $('#print'+$(this).val()).prop('checked', true);  
              $('#download'+$(this).val()).prop('checked', true); 
              $('#mail'+$(this).val()).prop('checked', true);   
            } 
            else {
              $('#add'+$(this).val()).prop('checked', false); 
              $('#edit'+$(this).val()).prop('checked', false); 
              $('#delete'+$(this).val()).prop('checked', false);
              $('#view'+$(this).val()).prop('checked', false);  
              $('#print'+$(this).val()).prop('checked', false);  
              $('#download'+$(this).val()).prop('checked', false); 
              $('#mail'+$(this).val()).prop('checked', false);     
            }
        });
        </script>

        