<?php //echo '<pre>';print_r($work_orders);die; ?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url(); ?>assets/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo base_url(); ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    @media print
    {
    .noprint{display:none;}
    .copyright {display:none;}
    .well{writing-mode: vertical-rl;text-orientation: mixed; position: fixed; margin: 0 auto; top:20px; right: 40%; border: 1px dashed #e1e1e1;}
    h4{color: rgba(0, 0, 0, 0); text-shadow: 0 0 0 #ccc;}
    @media print and (-webkit-min-device-pixel-ratio:0) {
    h4 {color: #0872ba;-webkit-print-color-adjust: exact; }
    }
    h4 {color: #0872ba;}
</style>
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs noprint">
                        <h1>Sticker View</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
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
                    <div class="page-content-col content-col-bg">
                    <div class="invoice well">
                            
                                    <div class="">
                                        <address>
                                            <h2><strong><?php echo $work_orders['wo_customer_name']; ?></strong></h2>
                                            <h3><strong><?php echo $work_orders['wo_address']; ?></strong>
                                            </h3>
                                            <h3><strong>Phone:</span> <?php $work_orders['wo_phone']; ?> </strong></h3>
                                            <h3><strong>GST No:</span> <?php echo $work_orders['wo_gstno']; ?> </strong></h3></address>
                                        
                                    </div>
                                
                            <br/>
                                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                                        <i class="fa fa-print"></i>
                                    </a>
                        </div>
    </div>
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->