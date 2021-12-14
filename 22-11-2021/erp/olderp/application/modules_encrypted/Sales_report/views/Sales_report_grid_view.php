<?php //echo '<pre>'; print_r($parent_cats); die;?><!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Source category Add</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Sales_report">Source category List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Sales_report/add">Source category Add</a>
                            </li>
                        </ol>
                        <!-- Sidebar Toggle Button -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".page-sidebar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                        <!-- Sidebar Toggle Button -->
                    </div>
<!-- END BREADCRUMBS -->
<!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">

                    	<div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body form">
                                
                            <div class="form-body">
                                <h3 class="form-section">Generation of Inquiry</h3>
                                	<div class="row">
	                                	<div class="col-md-1 col-md-offset-1">
	                                        <div class="form-group sr-header" id="mcna_namegr">
	                                           <label class="control-label sr-header-inner">All No.</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group sr-header" id="mcna_namegr">
	                                               <label class="control-label sr-header-inner">All Amount</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group sr-header" id="mcna_namegr">
	                                                <label class="control-label sr-header-inner">Completed No.</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group sr-header" id="mcna_namegr">
	                                                <label class="control-label sr-header-inner">Completed Amount</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group sr-header" id="mcna_namegr">                                            
	                                                <label class="control-label sr-header-inner">Target No.</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group sr-header" id="mcna_namegr"> 
	                                                <label class="control-label sr-header-inner">Target Amount.</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group sr-header" id="mcna_namegr">                                            
	                                                <label class="control-label sr-header-inner">Actual No.</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group sr-header" id="mcna_namegr"> 
	                                                <label class="control-label sr-header-inner">Actual Amount.</label>
	                                        </div>
	                                    </div>
	                                </div>
                                	<div class="row">
	                                	<div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                           <label class="control-label col-md-12"><strong>Social Media</strong></label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand" name="brand_name" maxlength="200" id="brand_name" value="" >
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand" name="brand_name" maxlength="200" id="brand_name" value="" >                                       
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr">                                            
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                           
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
                                	</div>
                                	<div class="row">
	                                	<div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                           <label class="control-label col-md-12"><strong>Social Media</strong></label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand" name="brand_name" maxlength="200" id="brand_name" value="" >
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand" name="brand_name" maxlength="200" id="brand_name" value="" >                                       
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr">                                            
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                           
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
                                	</div>
                                	<div class="row">
	                                	<div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                           <label class="control-label col-md-12"><strong>Social Media</strong></label>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand" name="brand_name" maxlength="200" id="brand_name" value="" >
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand" name="brand_name" maxlength="200" id="brand_name" value="" >                                       
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr">
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr">                                            
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                           
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-1">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <div class="form-group" id="mcna_namegr"> 
	                                                <input type="text" class="form-control" placeholder="Brand Name" name="brand_name" maxlength="200" id="brand_name" value="" >                                            
	                                        </div>
	                                    </div>
                                	</div>
                                <br>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green" onclick="return ValidateDetails()" >Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                    	
                </div>
                <!-- END CONTENT BODY -->
            </div>
            </div>
            </div>
            </div>
            <!-- END CONTENT -->
        <!-- END CONTAINER -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
         <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>