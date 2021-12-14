<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/select2/select2.css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/icheck/all.css" />

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/icheck/_all.css" />

--><link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<!-- End serchbox css-->

<!-- Start serchbox css-->

<script src="<?php echo base_url(); ?>assets/search/js/jquery-1.12.4.js"></script>

<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

</script>

  

<!-- BEGIN BREADCRUMBS -->

                     <div class="page-content">

<!-- BEGIN BREADCRUMBS -->

                    <div class="breadcrumbs">

                        <h1>Pending Work Addsssssss</h1>

                        <ol class="breadcrumb">

                            <li>

                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>

                            </li>

                            <li class="active">

                                <a href="<?php echo base_url(); ?>Task_assign">Pending Work List</a>

                            </li>

                            <li>

                                <a href="<?php echo base_url(); ?>Task_assign/add">Pending Work Add</a>

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

                        <?php if($this->input->post()){ ?>

                        <div class="col-md-12 col-xs-6"><div class="alert alert-danger">

                        <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 

                        </div></div>

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

                         <?php $inquirys = array('class' => 'form-horizontal');

                         echo form_open_multipart($action,$inquirys); ?>

                            <div class="form-body">

                                 <div class="row">

                                	<div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Task Assign By</label>

                                            <div class="col-md-8">

                                                 <select name="task_fassign" id="task_fassign" class="bs-select form-control" data-live-search="true" data-size="8" required="required">

                                                    <option value="<?php echo $session['au_id'];?>" <?php if(isset($list) && $list[0]['task_fassign'] == $session['au_id']){ ?> selected="selected" <?php } ?>><?php echo $session['au_fname'];?></option>

                                                </select>

                                            </div>

                                        </div>

                                     </div>

                                </div>

                                <div class="row">

                                	<div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Task Assign To</label>

                                            <div class="col-md-8">

                                                 <select name="task_sassign" id="task_sassign" class="bs-select form-control" data-live-search="true" data-size="8" required="required">

                                                     <?php if(isset($users)) { 

                                                        foreach($users as $user){ ?>

                                                    <option value="<?php echo $user['au_id'];?>" <?php if(isset($list) && $list[0]['task_sassign'] == $user['au_id']){ ?> selected="selected" <?php } ?>><?php echo $user['au_fname'];?></option>

                                                    <?php } } ?>

                                                </select>

                                            </div>

                                        </div>

                                     </div>

                                     <div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Priority 1, 2, 3</label>

                                            <div class="col-md-8">

                                                <div class="mt-radio-inline">

                                                        <label class="mt-radio">

                                                            <input type="radio" name="priority" id="optionsRadios25" <?php  if(isset($list[0]['task_priority']) && ($list[0]['task_priority'] == '1')){ ?> checked <?php }  ?> value="1" tabindex="7" > 1

                                                            <span></span>

                                                        </label>

                                                        <label class="mt-radio">

                                                            <input type="radio" name="priority" id="optionsRadios27" <?php  if(isset($list[0]['task_priority']) && ($list[0]['task_priority'] == '2')){ ?> checked <?php }  ?> value="2" tabindex="8" > 2

                                                            <span></span>

                                                        </label>

                                                        <label class="mt-radio">

                                                            <input type="radio" name="priority" id="optionsRadios28" <?php  if(isset($list[0]['task_priority']) && ($list[0]['task_priority'] == '3')){ ?> checked <?php }  ?> value="3" tabindex="8" > 3

                                                            <span></span>

                                                        </label>

                                                    </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row"> 

                                    <div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Assign Date</label>

                                            <div class="col-md-8">

                                                <?php if(isset($list[0]['task_date']) && $list[0]['task_date'] == '1970-01-01'){

                                                                $list[0]['task_date'] = '';

                                                            }elseif(isset($list[0]['task_date']) && $list[0]['task_date'] != '1970-01-01'){

                                                                $list[0]['task_date'] = date("d-m-Y", strtotime($list[0]['task_date']));

                                                            }

                                                    ?>

                                                <input type="text" class="form-control form-control-inline date-picker" placeholder="Assign Date" name="task_date" id="task_date" value="<?php echo isset($list[0]['task_date']) ? $list[0]['task_date'] : ""; ?><?php if($this->uri->segment(2) == 'add'){echo date("d-m-Y");} ?>">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6" style="display:none;">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Task name </label>

                                            <div class="col-md-8">

                                                <input type="text" class="form-control" placeholder="Task name" name="task_name" maxlength="200" id="task_name" value="<?php echo isset($list[0]['task_name']) ? $list[0]['task_name'] : ""; ?>" >

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row"> 

                                    <div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">When(Date to be Completed)</label>

                                            <div class="col-md-8">

                                                <?php if(isset($list[0]['task_when']) && $list[0]['task_when'] == '1970-01-01'){

                                                                $list[0]['task_when'] = '';

                                                            }elseif(isset($list[0]['task_when']) && $list[0]['task_when'] != '1970-01-01'){

                                                                $list[0]['task_when'] = date("d-m-Y", strtotime($list[0]['task_when']));

                                                            }

                                                    ?>

                                                 <input type="text" class="form-control form-control-inline input-medium date-picker" placeholder="When" name="task_when" id="task_when" value="<?php echo isset($list[0]['task_when']) ? $list[0]['task_when'] : ''; ?>">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Work Completed Dt(DD/MM/YYYY)</label>

                                            <div class="col-md-8">

                                                <?php if(isset($list[0]['task_comp_dt']) && $list[0]['task_comp_dt'] == '1970-01-01'){

                                                                $list[0]['task_comp_dt'] = '';

                                                            }elseif(isset($list[0]['task_comp_dt']) && $list[0]['task_comp_dt'] != '1970-01-01'){

                                                                $list[0]['task_comp_dt'] = date("d-m-Y", strtotime($list[0]['task_comp_dt']));

                                                            }

                                                    ?>

                                                <input type="text" class="form-control form-control-inline input-medium date-picker" placeholder="Work Completed Dt" name="task_comp_dt" maxlength="200" id="task_comp_dt" value="<?php echo isset($list[0]['task_comp_dt']) ? $list[0]['task_comp_dt'] : ""; ?>">

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                  <div class="row"> 

                                    <div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Task Description</label>

                                            <div class="col-md-8">

                                                <textarea class="form-control" placeholder="Task description" name="task_desc" maxlength="200" id="task_desc"><?php echo isset($list[0]['task_desc']) ? $list[0]['task_desc'] : ""; ?></textarea>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group" id="mcna_namegr">

                                            <label class="control-label col-md-4">Status</label>

                                            <div class="col-md-8">



                                                <div class="mt-radio-inline">

                                                        <label class="mt-radio">

                                                            <input type="radio" name="status" id="optionsRadios25" <?php  if(isset($list[0]['status']) && ($list[0]['status'] == '1')){ ?> checked <?php }  ?> value="1" tabindex="7" > Completed

                                                            <span></span>

                                                        </label>

                                                        <label class="mt-radio">

                                                            <input type="radio" name="status" id="optionsRadios26" <?php  if(isset($list[0]['status']) && ($list[0]['status'] == '2')){ ?> checked <?php }  ?> value="2" tabindex="8" <?php if($this->uri->segment(2) == 'add'){ ?>checked<?php } ?>> Not Completed

                                                            <span></span>

                                                        </label>

                                                    </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                             </div>

                                <hr/>

                              

                                <div class="form-actions">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="row">

                                                <div class="col-md-offset-3 col-md-9">

                                                    <button type="submit" class="btn green"><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>

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

            <!-- END CONTENT -->

        <!-- END CONTAINER -->

        

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
<script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/general.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->

<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

<!-- END THEME GLOBAL SCRIPTS -->



<script type="text/javascript">



function add_more_item()

{

     //alert("hiiiiii");

     var hvalue = parseInt($('#prohid').val());

     hvalue = hvalue + 1;



     //alert(hvalue);

     var hhvalue = parseInt($('#prohid').val(hvalue));

     var str = '';

     str += '<div class="row"><div class="col-md-2  text-center"><h3> Option '+hvalue+' </h3></div></div><div class="row"><div class="col-md-6 text-center"><div class="form-group"><label class="control-label col-md-3"><strong>Delete this Option</strong></label><div class="col-md-9"><input type="text" name="option_delete[]" id="option_delete1" class="form-control" value="" placeholder="Type DELETE to delete this Option" /></div></div></div></div>';

     str += '<div class="row"><div class="col-md-6"><div class="form-group" id="mcna_namegr"><label class="control-label col-md-3">Option '+hvalue+'</label><div class="col-md-9"><input type="text" class="form-control opt_opt1" placeholder="Option" name="opi_option[]" maxlength="200" id="opt_opt1'+hvalue+'" value="" ></div></div></div></div>';

     $('#Task_assign_add_div').append(str);



     return false;              

}

</script>

<script type="text/javascript">

// $("#bd_spare1,#opi_op_option1").blur(function () {

//        alert('hiiiiii');

//    });

jQuery(document).on('blur', ".opi_op_option, .pro_val_unit, .pro_val_price, .pro_val_stock, .bd_ftotal, .bd_informat", function () { 

var my = $(this).attr('id');

//alert(my);

 var my = my.replace("bd_informat", "");

var my = my.replace("opi_op_option", "");

var my = my.replace("pro_val_unit", "");

var my = my.replace("pro_val_price", "");

var my = my.replace("pro_val_stock", "");

var my = my.replace("bd_ftotal", "");

//alert(my);

//alert('hiii');

var qty = $("#opi_op_option"+my).val();

var pr = $("#pro_val_unit"+my).val();

//alert(pr);

var total = parseFloat(qty) * parseFloat(pr);

//alert(total);

if (!isNaN(total)){

$("#pro_val_price"+my).val(total.toFixed(2));

}

var tax = $("#pro_val_stock"+my).val();

var ftotal = parseFloat(total) * (parseFloat(tax) / 100);

var ftotall = parseFloat(ftotal) + parseFloat(total);

//alert(ftotal);

if (!isNaN(ftotall)){

$("#bd_ftotal"+my).val(ftotall.toFixed(2));

}

});

  </script>

        <script type="text/javascript">

function fsl(val)

{

    if(val==1)

    {

        document.getElementById('stock_limit').style.display='block';

        document.getElementById('master_item_stock_limit').value="";



    }

    if(val==0)

    {

        document.getElementById('stock_limit').style.display="none";

    }

}

</script>



<script type="text/javascript">

function DoTrim(strComp) {

            ltrim = /^\s+/

            rtrim = /\s+$/

            strComp = strComp.replace(ltrim, '');

            strComp = strComp.replace(rtrim, '');

            return strComp;

}



function isPositiveInteger(n) {

    return n >>> 0 === parseFloat(n);

}





$('#task_date,#task_when,#task_comp_dt').datepicker({

     format: 'dd-mm-yyyy',



});

</script>

<script type="text/javascript">

$(document).ready(function(){

    $('#new_country').on('change',function(){

        //alert('hiiii');

        var country = $(this).val();

        //

        if(country != '' && country != undefined)

        {

            $.ajax({

                type:'POST',

                datatype:'JSON',

                url:base_url+"Web_service/get_state",

                data:'country='+country,

                success:function(data){

                    var data = jQuery.parseJSON( data );

                    //console.log(data);

                    var str = '';

                    str += '<option value="">Select State</option>';

                    jQuery.each( data.data, function( i, val ) {

                      str += '<option value="'+val.state_id+'">'+val.state_name+'</option>';

                    });

                    $('#new_state').empty();

                    $('#new_state').append(str);

                    $('#new_state').selectpicker('refresh');

                }

            }); 

        }else{

            $('#new_state').html('<option value="">Select Country first</option>');

            $('#area_city').html('<option value="">Select country first</option>');

        }

    });

});



 $(document).ready(function(){

    $('#new_state').on('change',function(){

        //alert('hiiii');

        var state = $(this).val();

        var country = $('#new_country option:selected').val();

        //

        if(state != '' && state != undefined)

        {

            $.ajax({

                type:'POST',

                datatype:'JSON',

                url:base_url+"Web_service/get_district",

                data:'state='+state+'&country='+country,

                success:function(data){

                    var data = jQuery.parseJSON( data );

                    //console.log(data);

                    var str = '';

                    str += '<option value="">Select District</option>';

                    jQuery.each( data.data, function( i, val ) {

                      str += '<option value="'+val.district_id+'">'+val.district_name+'</option>';

                    });

                    $('#new_district').empty();

                    $('#new_district').append(str);

                    $('#new_district').selectpicker('refresh');

                }

            }); 

        }else{

            $('#new_state').html('<option value="">Select state first</option>');

        }

    });

});



 $(document).ready(function(){

    $('#new_district').on('change',function(){

        //alert('hiiii');

        var district = $(this).val();

        var country = $('#new_country').val();

        var state = $('#new_state').val();

        //

        if(district != '' && district != undefined)

        {

            $.ajax({

                type:'POST',

                datatype:'JSON',

                url:base_url+"Web_service/get_taluka",

                data:'district='+district+'&country='+country+'&state='+state,

                success:function(data){

                    var data = jQuery.parseJSON( data );

                    console.log(data);

                    var str = '';

                    str += '<option value="">Select Taluka</option>';

                    jQuery.each( data.data, function( i, val ) {

                      str += '<option value="'+val.taluka_id+'">'+val.taluka_name+'</option>';

                    });

                    $('#new_taluko').empty();

                    $('#new_taluko').append(str);

                    $('#new_taluko').selectpicker('refresh');

                }

            }); 

        }else{

            $('#new_district').html('<option value="">Select district first</option>');

        }

    });

});



$(document).ready(function(){

    $('#new_taluko').on('change',function(){

        //alert('hiiii');

        var taluko = $(this).val();

        var state = $('#new_state').val();

        var district = $('#new_district').val();

        var country = $('#new_country').val();

        //

        if(taluko != '' && taluko != undefined)

        {

            $.ajax({

                type:'POST',

                datatype:'JSON',

                url:base_url+"Web_service/get_city",

                data:'district='+district+'&country='+country+'&state='+state+'&taluka='+taluko,

                success:function(data){

                    var data = jQuery.parseJSON( data );

                    console.log(data);

                    var str = '';

                    str += '<option value="">Select City</option>';

                    jQuery.each( data.data, function( i, val ) {

                      str += '<option value="'+val.city_id+'">'+val.city_name+'</option>';

                    });

                    $('#new_city').empty();

                    $('#new_city').append(str);

                    $('#new_city').selectpicker('refresh');

                }

            }); 

        }else{

            $('#new_city').html('<option value="">Select state first</option>');

        }

    });

});



$(document).ready(function(){

    $('#new_city').on('change',function(){

        //alert('hiiii');

        var city = $(this).val();

        var taluko = $('#new_taluko').val();

        var state = $('#new_state').val();

        var district = $('#new_district').val();

        var country = $('#new_country').val();

        //

        if(city != '' && city != undefined)

        {

            $.ajax({

                type:'POST',

                datatype:'JSON',

                url:base_url+"Web_service/get_area",

                data:'district='+district+'&country='+country+'&state='+state+'&taluka='+taluko+'&city='+city,

                success:function(data){

                    var data = jQuery.parseJSON( data );

                    console.log(data);

                    var str = '';

                    str += '<option value="">Select City</option>';

                    jQuery.each( data.data, function( i, val ) {

                      str += '<option value="'+val.area_id+'">'+val.area_name+-+val.area_pincode+'</option>';

                    });

                    $('#new_area').empty();

                    $('#new_area').append(str);

                    $('#new_area').selectpicker('refresh');

                }

            }); 

        }else{

            $('#new_area').html('<option value="">Select city first</option>');

        }

    });

});

</script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->       

<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

