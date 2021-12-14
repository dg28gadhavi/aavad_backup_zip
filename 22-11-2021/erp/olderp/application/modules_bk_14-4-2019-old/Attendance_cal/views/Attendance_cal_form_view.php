<?php     ?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">


 <link type="text/css" href="css/bootstrap.min.css" />
<link type="text/css" href="css/bootstrap-timepicker.min.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>

<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Attendance_cal Add</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
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
                   <?php $sal_cal = array('class' => 'form-horizontal','method' => 'get');
                echo form_open($action,$sal_cal); ?>
                      
                <div class="form-body">
                    <h3 class="form-section">Attendance</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Select Date</label>
                                <div class="col-md-9">

                                    <input type="text" tabindex="6" class="form-control form-control-inline input-medium date-picker" placeholder="Challan Date" name="attend_date_name" maxlength="200" id="attend_date_name" value="<?php echo isset($list[0]['attend_date_name']) ? date("d-m-Y", strtotime($list[0]['attend_date_name'])) : ""; ?>">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" tabindex="5" class="btn green text-left" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
                                            <?php if($this->input->get('attend_date_name') != ''){ ?>
                        <a class="btn red" tabindex="11" href="<?php echo base_url(); ?>Attendance_cal/email?attend_date_name=<?php echo $this->input->get('attend_date_name'); ?>">E Mail</a>
                    <?php } ?>  
                    <?php if($this->input->get('attend_date_name') != ''){ ?>
                        <a class="btn red" tabindex="11" href="<?php echo base_url(); ?>Attendance_cal/confirm_calculation?attend_date_name=<?php echo $this->input->get('attend_date_name'); ?>">Confirm</a>
                    <?php } ?>
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
            <?php //echo "<pre>"; print_r($autosearch_items); die;
                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                echo form_open_multipart($action_salcal, $clsar); ?>
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                </div>
                                <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3">
                                            <thead>
                                                <tr>
                                                    <th class="all">Sr. No.</th>
                                                  <th class="all">Date</th> 
                                                    <th class="all">Executive Name</th>
                                                    <th class="all">Select Attendance</th>
                                                    <th class="all">Intime</th>
                                                    <th class="all">Out Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                //echo "<pre>"; print_r($Sal_cals);die;
                                                 $id = 0; 
                                                 if(isset($Sal_cals)){ 

                                                 foreach($Sal_cals as $calculation){ 

                                                    $id++; ?>
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><?php echo $calculation['attend_date_name']; ?></td>
                                                        <td><?php echo $calculation['au_fname']; ?></td>
                                                        <td> 
                                                            <select tabindex="2" class="bs-select form-control form-control attend_pa_id" data-live-search="true" data-size="8"  name="attend_pa_id[<?php echo $calculation['attend_id']; ?>]"  id="attend_pa_id<?php echo $calculation['attend_id']; ?>" >
                                                    <option value="0">Select Attendance</option>
                                               
                                                    <option value="1" <?php if(isset($calculation['attend_pa_id']) && $calculation['attend_pa_id'] == '1'){ echo "selected";}?>>Present</option>
                                                    <option value="2" <?php if(isset($calculation['attend_pa_id']) && $calculation['attend_pa_id'] == '2'){ echo "selected";}?>>Absent</option>
                                                                   
                                                </select>      </td>
                                                        <td>

                                                            <div class="input-group bootstrap-timepicker timepicker ">
                                                                        <input id="attend_intime<?php echo $id; ?>" name="attend_intime[<?php echo $calculation['attend_id']; ?>]"   type="text" class="form-control attend_intime" value="<?php echo isset($calculation['attend_intime']) ? $calculation['attend_intime'] : ""; ?>">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                                    </div>

                                                           </td>

                                                        <td><div class="input-group bootstrap-timepicker timepicker ">
                                                                        <input id="attend_outtime<?php echo $id; ?>" name="attend_outtime[<?php echo $calculation['attend_id']; ?>]"  type="text" class="form-control attend_outtime" value="<?php echo isset($calculation['attend_outtime']) ? $calculation['attend_outtime'] : ""; ?>">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                                    </div></td>
                                                        
                                                        
                                                        
                                                    </tr>


                                                <?php  } }?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <div class="modal-footer pull-left">
                                  <input type="submit" tabindex="24" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" onclick="return item_submit();"/>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                        <?php echo form_close(); ?>
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

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
 <script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
  var attend_date_name = "<?php echo  $this->input->get('attend_date_name') ? $this->input->get('attend_date_name') : '';?>";
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

$('.date-picker').datepicker({
    format: 'dd-mm-yyyy',
});
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
</script>
<!-- <script type="text/javascript">
 function load()
 {
      $.ajax({
      type:"GET",
      url: "<?php // echo base_url(); ?>Attendance_cal",
      data: { country: $("#attend_pa_id").val()}
      }).done(function(msg){
       $("#attend_intime").html(msg);
      });
 }

 </script> -->
<?php while ($id != 0) { ?>
<script type="text/javascript">
$('#attend_intime<?php echo $id; ?>').timepicker();
</script>

<script type="text/javascript">
$('#attend_outtime<?php echo $id; ?>').timepicker();
</script>

<?php $id--; } ?> 
<script>
$(document).ready(function(){
  $(".attend_pa_id,.attend_intime,.attend_outtime,.py_with,.extra_day,.late_hrs,.latehrs_hrs,.basic_sal,.pay_sal,.prof_tax,.esic,.pf,.net_sal").blur(function(){
        //alert("hiii");
        //alert($(this).attr('id'));
        var idstring = $(this).attr('id');
        idstring = idstring.replace("attend_pa_id", "");
        idstring = idstring.replace("attend_intime", "");
        idstring = idstring.replace("attend_outtime", "");
        idstring = idstring.replace("py_with", "");
        idstring = idstring.replace("extra_day", "");
        idstring = idstring.replace("late_hrs", "");
        idstring = idstring.replace("latehrs_hrs", ""); 
        idstring = idstring.replace("basic_sal", "");
        idstring = idstring.replace("pay_sal", "");
        idstring = idstring.replace("prof_tax", "");
        idstring = idstring.replace("esic", "");
        idstring = idstring.replace("pf", "");
        idstring = idstring.replace("net_sal", "");

        var attend_pa_id = $('#attend_pa_id'+idstring).val();
        var attend_intime = $('#attend_intime'+idstring).val();
        var attend_outtime = $('#attend_outtime'+idstring).val();
        var py_with = $('#py_with'+idstring).val();
        var extra_day = $('#extra_day'+idstring).val();
        var late_hrs = $('#late_hrs'+idstring).val();
        var latehrs_hrs = $('#latehrs_hrs'+idstring).val();
        var basic_sal = $('#basic_sal'+idstring).val();
        var pay_sal = $('#pay_sal'+idstring).val();
        var prof_tax = $('#prof_tax'+idstring).val();
        var esic = $('#esic'+idstring).val();
        var pf = $('#pf'+idstring).val();
        var net_sal = $('#net_sal'+idstring).val();

       /* if(attend_intime > 1)
        {
            attend_outtime = parseFloat(attend_intime) - 1;
            $('#attend_outtime'+idstring).val(attend_outtime);
            $('#py_with'+idstring).val(1);
        }else if(attend_intime == 1){
            $('#attend_outtime'+idstring).val(0);
            $('#py_with'+idstring).val(1);
        }else if(attend_intime == 0.5){
            $('#attend_outtime'+idstring).val(0);
            $('#py_with'+idstring).val(0.5);
        }else{
            $('#attend_outtime'+idstring).val(0);
            $('#py_with'+idstring).val(0);
        }
        var pay_sal = (parseFloat(basic_sal)/30*parseFloat(attend_pa_id))-(((parseFloat(basic_sal)/30)*parseFloat(attend_outtime))+((parseFloat(basic_sal)/30)*parseFloat(late_hrs)))+(parseFloat(basic_sal)/parseFloat(attend_pa_id))*parseFloat(extra_day)*1.5;
        $('#pay_sal'+idstring).val(pay_sal);
        var pay_sal = $('#pay_sal'+idstring).val();
        var net_sal = (parseFloat(pay_sal)-parseFloat(prof_tax))-(parseFloat(esic)+parseFloat(pf));
        $('#net_sal'+idstring).val(net_sal);*/
        //alert(idstring);

    });    

});
</script>