<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php //echo '<pre>';print_r($list);die; ?>
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
<!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
    <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>Task : <small><?php echo isset($list['ticketno']) ? $list['ticketno'] : ""; ?></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Dashborad">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>Task">Task Ticket List</a></li>
                <li><a href="<?php echo base_url(); ?>Task/add">Task Ticket Add</a></li>
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
                        <?php $Tasks = array('class' => 'form-horizontal','autocomplete' => 'off');
                        echo form_open_multipart($action,$Tasks); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-md-3" style="font-weight:bold;">Ticket No : </label>
                                        <label class="col-md-9"><?php echo isset($list['ticketno']) ? $list['ticketno'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-3" style="font-weight:bold;">Alloted  To : </label>
                                        <label class="col-md-9"><?php echo isset($list['allot_first_name']) ? $list['allot_first_name'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <label class="col-md-4" style="font-weight:bold;">Customer Name : </label>
                                        <label class="col-md-8"><?php echo isset($list['task_vendor']) ? $list['task_vendor'] : ""; ?></label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-4" style="font-weight:bold;">Subject : </label>
                                        <label class="col-md-8"><?php echo isset($list['subject']) ? $list['subject'] : ""; ?></label>
                                    </div>
                                     <div class="col-md-4">
                                        <label class="col-md-4" style="font-weight:bold;">Location : </label>
                                        <label class="col-md-8"><?php echo isset($list['location']) ? $list['location'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Details : </label>
                                            <label class="col-md-8"><?php echo !$this->uri->segment(3) && isset($st_code) ? $st_code : ''; ?><?php echo isset($list['details']) ? $list['details'] : ""; ?></label>
                                    </div>  
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Customer Name : </label>
                                            <label class="col-md-8"><?php echo isset($list['task_vendor']) ? $list['task_vendor'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Contact Person : </label>
                                            <label class="col-md-8"><?php echo isset($list['ctype_name']) ? $list['ctype_name'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Customer Type : </label>
                                            <label class="col-md-8"><?php echo isset($list['task_customer_type']) ? $list['task_customer_type'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-4" style="font-weight:bold;">Email : </label>
                                        <label class="col-md-8"><?php echo isset($list['task_email']) ? $list['task_email'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Mobile : </label>
                                            <label class="col-md-8 "><?php echo isset($list['task_mobile']) ? $list['task_mobile'] : ""; ?></label>
                                    </div>  
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Address : </label>
                                            <label class="col-md-8 "><?php echo isset($list['task_address']) ? $list['task_address'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">CO avad Instruments. : </label>
                                            <label class="col-md-8 "><?php echo isset($list['task_co_aavad_ins']) ? $list['task_co_aavad_ins'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Past Comments : </label>
                                            <label class="col-md-8 "><?php echo isset($list['task_pastcomment']) ? $list['task_pastcomment'] : ""; ?></label>
                                    </div>
                                    <div class="col-md-4">
                                            <label class="col-md-4" style="font-weight:bold;">Task Type : </label>
                                            <label class="col-md-8 "><?php echo isset($list['type_of_work_name']) ? $list['type_of_work_name'] : ""; ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr></hr>
                                    <h3>Task Followup Details</h3>

                                            <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                            <thead>
                                            <tr>
                                            <th  width="2%">Sr.No</th>
                                            <th  width="2%">Reminder Date</th>
                                            <th  width="2%">Details</th> 
                                            <th  width="2%">Complete Date</th>
                                            <th  width="2%">Details</th>
                                            <th  width="2%">Expense</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $id = 0;
                                            if(isset($list['reminder_datas'])) { 
                                            foreach($list['reminder_datas'] as $row){ $id++; ?>

                                            <tr>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $row['remind_date'];?></td>
                                            <td><?php echo $row['reminder_details'];?></td>
                                            <td><?php echo $row['completed_date'];?></td>
                                            <td><?php echo $row['complete_remark'];?></td>
                                            <td><?php echo $row['expence'];?></td>
                                            </tr>
                                            <?php } } ?>
                                            </tbody>
                                            </table>
                                            </div> 



                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <?php if($list['reminder_is_completed'] == 0){ ?>
                                                <a class="btn btn-sm btn-outline green" href="<?php echo base_url()."Task/task_start/".$list['task_id']."/".$list['reminder_auto_id']; ?>?task_complet=0" title="Click To here to Start task"><i class="fa fa-play" ></i></a>
                                            <?php }else if($list['reminder_is_completed'] == 1){ ?>
                                                <label class="control-label col-md-6">Task Allredy start</label>
                                                <a class="btn btn-sm btn-outline green" href="<?php echo base_url()."Task/task_start/".$list['task_id']."/".$list['reminder_auto_id']; ?>?task_complet=1" title="Click To here to Complete task"><i class="fa fa-edit" ></i></a>
                                            <?php  } ?>
                                                 
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
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<!-- START add more SCRIPTS -->

<!-- END add more SCRIPTS -->

<script type="text/javascript">
$(document).ready(function(){
    $('#Task_state').on('change',function(){
        //alert('hiiii');
        var countryID = $(this).val();
      //alert(countryID);
        if(countryID){
            $.ajax({
                type:'POST',
                datatype:'JSON',
                url:base_url+"Task/get_country_from_country",
                data:'state_id='+countryID,
                success:function(data)
                {
                    //alert(response);
                    var opts = $.parseJSON(data);
                    $('#Task_country').empty();
                     $('#Task_country').append('<option value="0" selected>Select State</option>');
                    $.each(opts, function(i, d) {
                    $('#Task_country').append('<option value="' + d.state_id + '">' + d.state_name + '</option>');
                    
                });
                    $('#Task_country').selectpicker('refresh');
                }
            }); 
        }
        else{
            $('#Task_country').html('<option value="">Select country1 first</option>');
        }
    });
});
</script>
<script>
  $( function() {
    $("#st_coname").autocomplete({
            source: base_url+"Sales_enq/get_customer_information",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                //state_lists
                var str = '';
                str += '<option value="">Select State</option>';
                jQuery.each( ui.item.state_lists, function( i, val ) {
                  str += '<option value="'+val.state_id+'">'+val.state_name+'</option>';
                });
                $('#state_change').empty();
                $('#city_change').empty();
                $('#state_change').append(str);
                $('#state_change').selectpicker('refresh');
                var str = '';
                str += '<option value="">Select City</option>';
                jQuery.each( ui.item.city_lists, function( i, val ) {
                  str += '<option value="'+val.city_id+'">'+val.city_name+'</option>';
                });
                $('#city_change').append(str);
                $('#city_change').selectpicker('refresh');
                $('#itemid').val(ui.item.value);
                $("#sq_cust_type").val(ui.item.ctype);
               $("#country_change").val(ui.item.country);
               $("#state_change").val(ui.item.state);
               $("#city_change").val(ui.item.city);
               $("#sq_con_person").val(ui.item.cperson);
               $("#sq_mobile").val(ui.item.cno);
               $("#st_email").val(ui.item.email);
               $("#sq_phone").val(ui.item.phone);
               $("#sq_website").val(ui.item.webaddr);
               $('#sq_address').val(ui.item.address);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });
    });
  </script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php //theme layout scripts ?>

<script type="text/javascript">
    $('.date-picker').datepicker({
    format: 'dd-mm-yyyy',
});
</script>