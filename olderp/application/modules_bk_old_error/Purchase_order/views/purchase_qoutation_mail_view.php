<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php //echo "<pre>";print_r($lists);die; ?>
       <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <!-- <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
         <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url(); ?>assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url(); ?>assets/layouts/layout5/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
        

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Send mail</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashborad">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>">mail List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Purchase_order/send_mail">mail Add</a>
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
                     <?php if($this->input->post()){ ?>
                        <div class="col-md-12 col-xs-6"><div class="alert alert-danger">
                        <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                        </div></div>
                        </div>
                        <?php } ?>
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
                        <?php $citys = array('class' => 'form-horizontal');
                        echo form_open_multipart($action_mail,$citys); ?>
                            <div class="form-body">
                                      <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Mail to</label>
                                                        <div class="col-md-9">
                                                           <input type="text" class="form-control"  name="sqm_to" maxlength="200" id="sqm_to" value="<?php echo isset($lists[0]['master_vendor_email_address']) ? $lists[0]['master_vendor_email_address'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                         <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">CC</label>
                                                        <div class="col-md-9">
                                                           <input type="text" class="form-control"  name="sqm_to_cc" maxlength="200" id="sqm_to_cc" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Subject</label>
                                                <div class="col-md-9">
                                                   <input type="text" class="form-control"  name="sqm_sub" maxlength="200" id="sqm_sub" value="">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-1">Body</label>
                            <div class="col-md-11">
                            <textarea class="form-control ckeditor" name="sqm_body" placeholder="Body" rows="3"><?php echo ($maildata['au_signature']); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                     <a class="btn green" href="<?php echo base_url(); ?>Purchase_order/load_pdf/<?php echo $this->uri->segment(3); ?>" target="_blank">View PDF</a>
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
            </div>
            </div>
            <!-- END CONTENT -->
        <!-- END CONTAINER -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

       <!--  <script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> -->

        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script type="text/javascript">
function delete_itm(id)
{
   // alert(id);
    if (confirm("Are you sure you want to delete?") == true) {
        var res = id.split('delete_itm');
        if(res[1] != 1)
        {
            $('#itmmain'+res[1]).remove();   
        }else{
            
            alert('You can not delete this item');
        }
    } else {
        
    }
    return false;
}

function add_more_item()
{
     //alert("hiiiiii");
     var hvalue = parseInt($('#prohid').val());
     hvalue = hvalue + 1;

     //alert(hvalue);
     var hhvalue = parseInt($('#prohid').val(hvalue));
     var str = '';
     //'+hvalue+'
     
         str += '<div id="itmmain'+hvalue+'"><div class="col-md-11 col-md-offset-1"><div class="form-group" id="mcna_namegr"><label class="control-label col-md-3">Attachment'+hvalue+'</label><div class="col-md-7"><input type="file" class="form-control-file"  name="files[]" maxlength="200" id="sqm_attch'+hvalue+'" multiple="multiple"></div><div class="col-md-2"> <button id="delete_itm'+hvalue+'" class="btn btn-default red" onclick="return delete_itm(this.id)"> <i class="fa fa-remove"></i> </div></div></div></div>';
         
     $('#Devices_add_div').append(str);
     
     return false;              
}
</script>
        

        <!-- END PAGE LEVEL SCRIPTS -->        