<?php //echo '<pre>'; print_r($vendors); die;?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<style type="text/css">
.centerbox {
    margin: 50px;
}   
.btndata{
    color: #fff;
    text-transform: uppercase;
    position: relative;
    transition: all 0.3s ease 0s;
    margin-left: 10px;
}
.btndata:hover{
    color: #fff;
}
.btndata:after{
    content: "";
    width: 120%;
    height: 130%;
    padding: 7px;
    position: absolute;
    top: -15%;
    left: -10%;
    opacity: 0;
    transition: all 0.2s ease 0s;
}
.btndata:hover:after{
    opacity: 1;
    width: 110%;
    height: 120%;
    top: -10%;
    left: -5%;
}
.btndata.red{
    background: #fe6d6d;
}
.btndata.red:after{
    box-shadow: 0 0 0 2px #fe6d6d;
}

@media only screen and (max-width: 767px){
    .btndata{ margin-bottom: 20px; }
}

@media print
    {
     @page { 
        size: A4 landscape;
        max-height:100%; 
        max-width:100%;
    }
    .noprint{display:none;}
    .copyright {display:none;}
    .chartbox{writing-mode: horizontal-tb;-webkit-writing-mode: horizontal-tb;-ms-writing-mode: horizontal-tb; text-orientation: mixed; position: fixed; margin-left: -150px; top:-50px;}
}
</style>
<div class="container-fluid">
    <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>Add</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>Dispatch/dispatch_report">Dispatch Report</a></li>
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
            <?php if($this->input->post()){ ?>
            <div class="col-md-12 col-xs-6">
                <div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                </div>
            </div>
        </div>
        <?php } ?>
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
                                                                   
                                <div class="form-actions">
                               <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="centerbox">
                              <a href="<?php echo base_url(); ?>Dispatch/return_stock/<?php echo $this->uri->segment(3); ?>" class="btn btn-lg red btndata">Demo Return</a>
                              <a href="<?php echo base_url(); ?>Dispatch/create_invoice/<?php echo $this->uri->segment(3); ?>" class="btn btn-lg red btndata">Invoice</a>
                              <a href="<?php echo base_url(); ?>Dispatch/free_return_item/<?php echo $this->uri->segment(3); ?>" class="btn btn-lg red btndata">Free/Return</a>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
            <!-- /.modal -->
                <?php //echo $this->load->view('admin/master/ajaxview/party_ajax_view'); ?>
            <!-- /.modal -->
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url(); ?>js/icheck/icheck.min.js" type="text/javascript"></script>
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
<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
 <!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- <script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<!-- START add more SCRIPTS -->

<!-- END add more SCRIPTS -->
<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php //theme layout scripts ?>