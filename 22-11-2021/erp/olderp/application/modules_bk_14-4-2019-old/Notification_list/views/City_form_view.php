<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
    <div class="page-content">
    <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>city Add</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>Dashborad">Dashboard</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url(); ?>City">city List</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>City/add">city Add</a>
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
            <div class="col-md-12 col-xs-6">
                <div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                </div>
            </div>
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
                            <?php $citys = array('class' => 'form-horizontal','autocomplate' => 'off');
                            echo form_open_multipart($action,$citys); ?>
                            <div class="form-body">
                                <h3 class="form-section">City Name</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">City Name</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="1" class="form-control" placeholder="City Name" name="city_name" maxlength="200" id="city_name" value="<?php echo isset($list[0]['city_name']) ? $list[0]['city_name'] : ""; ?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Country Name</label>
                                            <div class="col-md-9">
                                                <select name="city_country" id="city_state" tabindex="2" class="bs-select form-control" data-live-search="true" data-size="8" required="required">
                                                    <option value="">Select Country</option>
                                                <?php foreach($country as $countris) { ?>
                                                 <option value="<?php echo $countris['country_id'];?>" <?php if(isset($list[0]['city_country']) && ($list[0]['city_country']) == $countris['country_id']) { ?> selected="selected" <?php } ?>><?php echo $countris['country_name']; ?></option>
                                                 <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                     </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">State Name</label>
                                            <div class="col-md-9">
                                                <select name="city_state" id="city_country" tabindex="3" class="bs-select form-control" data-live-search="true" required="required">
                                                <?php if($this->uri->segment(2) == 'add') { ?>
                                                    <option value="0">Select Country First</option>
                                                    <?php }else { ?>
                                                  <?php foreach($states as $state) { ?>
                                                 <option value="<?php echo $state['state_id'];?>" <?php if(isset($list[0]['city_state']) && ($list[0]['city_state']) == $state['state_id']) { ?> selected="selected" <?php } ?>><?php echo $state['state_name']; ?></option>
                                                 <?php } } ?>
                                                </select>
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
                                                <button type="submit" tabindex="4" class="btn green" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
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

function ValidateDetails()
{
    var fields;
    fields = "";
    document.getElementById('city_name').className = 'form-control';
    $('#city_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('city_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("city_name").focus();
        }
        fields = '1';
        document.getElementById('city_name').className = 'form-control error';
        if($('#city_name').parent().parent().attr('class') == 'form-group')
        {
            $('#city_name').parent().parent().addClass('has-error');
        }
        //return false;
    }
    
    
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        
        return false;
    }
    else {
        return true;
    }    
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#city_state').on('change',function(){
        //alert('hiiii');
        var countryID = $(this).val();
      //alert(countryID);
        if(countryID){
            $.ajax({
                type:'POST',
                datatype:'JSON',
                url:base_url+"city/get_country_from_country",
                data:'state_id='+countryID,
                success:function(data)
                {
                    //alert(response);
                    var opts = $.parseJSON(data);
                    $('#city_country').empty();
                     $('#city_country').append('<option value="0" selected>Select State</option>');
                    $.each(opts, function(i, d) {
                    $('#city_country').append('<option value="' + d.state_id + '">' + d.state_name + '</option>');
                    
                });
                    $('#city_country').selectpicker('refresh');
                }
            }); 
        }
        else{
            $('#city_country').html('<option value="">Select country1 first</option>');
        }
    });
});
</script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>