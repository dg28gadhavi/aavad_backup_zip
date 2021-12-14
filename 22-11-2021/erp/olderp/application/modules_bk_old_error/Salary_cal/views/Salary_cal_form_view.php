<?php     ?>
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Salary_cal Add</h1>
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
                    <h3 class="form-section">Salary Calculator</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Select Month</label>
                                <div class="col-md-9">
                                    <select name="sal_month_name" id="sal_month_name" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8">
                                            <option value="0">select month</option>
                                        <?php 
                                                $start_date = "2019-03-01";
                                                $start_month = "03-2019";
                                                $start_date = date("Y-m-d", strtotime($start_date));
                                                //$start_date = date("d-m-Y", strtotime($start_date));
                                              $current_date=date('d-m-Y',strtotime("-1 month"));
                                              $current_month=date("m-Y",strtotime("-1 month"));
                                                    while($start_month!=$current_month){ ?>    
                                                    <option value="<?php echo "01-".$current_month;?>" <?php if($this->input->get('sal_month_name') && ($this->input->get('sal_month_name') != '') && ($this->input->get('sal_month_name') == "01-".$current_month)){ ?> selected <?php } ?> >
                                                     <?php  echo $current_month; ?>    
                                                     </option>                          
                                                 <?php 
                                                 $current_date= date("Y-m-d", strtotime("-1 month", strtotime($current_date)));
                                                       $current_month = date("m-Y", strtotime($current_date));
                                             }  ?> 

                                                                          
                                                </select>
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
                                            <?php if($this->input->get('sal_month_name') != ''){ ?>
                        <a class="btn red" tabindex="11" href="<?php echo base_url(); ?>Salary_cal/email?sal_month_name=<?php echo $this->input->get('sal_month_name'); ?>">E Mail</a>
                    <?php } ?>  
                    <?php if($this->input->get('sal_month_name') != ''){ ?>
                        <a class="btn red" tabindex="11" href="<?php echo base_url(); ?>Salary_cal/confirm_calculation?sal_month_name=<?php echo $this->input->get('sal_month_name'); ?>">Confirm</a>
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
                                                    <th class="all">Executive Name</th>
                                                    <th class="all">Working Days</th>
                                                    <th class="all">Total Leave</th>
                                                    <th class="all">Pay Without Leave</th>
                                                    <th class="all">Pay with Leave</th>
                                                    <th class="all">Extra Days</th>
                                                    <th class="all">Late By</th>
                                                    <th class="all">Late Hours</th>
                                                    <th class="all">Basic Salary</th>
                                                    <th class="all">Pay Salary</th>
                                                    <th class="all">Proffessional Tax</th>
                                                    <th class="all">Esic</th>
                                                    <th class="all">Pf</th>                                         
                                                    <th class="all">Net Salary</th>
                                                    <th class="all">Remark</th>
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
                                                        <td><?php echo $calculation['au_fname']; ?></td>
                                                        <td> <input type="text" tabindex="2" class="form-control working_days" name="sal_cal_work_days[<?php echo $calculation['sal_cal_id']; ?>]" id="working_days<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_work_days']) ? $calculation['sal_cal_work_days'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control total_leave" name="sal_cal_total_leave[<?php echo $calculation['sal_cal_id']; ?>]" id="total_leave<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_total_leave']) ? $calculation['sal_cal_total_leave'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control py_without" name="sal_cal_py_without[<?php echo $calculation['sal_cal_id']; ?>]" id="py_without<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_py_without']) ? $calculation['sal_cal_py_without'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control py_with" name="sal_cal_py_with[<?php echo $calculation['sal_cal_id']; ?>]" id="py_with<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_py_with']) ? $calculation['sal_cal_py_with'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control extra_day" name="sal_cal_extra_day[<?php echo $calculation['sal_cal_id']; ?>]" id="extra_day<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_extra_day']) ? $calculation['sal_cal_extra_day'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control late_hrs" name="sal_cal_late_hrs[<?php echo $calculation['sal_cal_id']; ?>]" id="late_hrs<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_late_hrs']) ? $calculation['sal_cal_late_hrs'] : ""; ?>"></td>

                                                        <td><input type="text" tabindex="2" class="form-control latehrs_hrs" name="sal_cal_latehrs_hrs[<?php echo $calculation['sal_cal_id']; ?>]" id="latehrs_hrs<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_latehrs_hrs']) ? $calculation['sal_cal_latehrs_hrs'] : ""; ?>"></td>

                                                        <td><input type="text" tabindex="2" class="form-control basic_sal" name="sal_cal_basic_sal[<?php echo $calculation['sal_cal_id']; ?>]" id="basic_sal<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_basic_sal']) ? $calculation['sal_cal_basic_sal'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control pay_sal" name="sal_cal_pay_sal[<?php echo $calculation['sal_cal_id']; ?>]" id="pay_sal<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_pay_sal']) ? $calculation['sal_cal_pay_sal'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control prof_tax" name="sal_cal_prof_tax[<?php echo $calculation['sal_cal_id']; ?>]" id="prof_tax<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_prof_tax']) ? $calculation['sal_cal_prof_tax'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control esic" name="sal_cal_esic[<?php echo $calculation['sal_cal_id']; ?>]" id="esic<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_esic']) ? $calculation['sal_cal_esic'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control pf" name="sal_cal_pf[<?php echo $calculation['sal_cal_id']; ?>]" id="pf<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_pf']) ? $calculation['sal_cal_pf'] : ""; ?>"></td>
                                                        <td><input type="text" tabindex="2" class="form-control net_sal" name="sal_cal_net_sal[<?php echo $calculation['sal_cal_id']; ?>]" id="net_sal<?php echo $calculation['sal_cal_id']; ?>" value="<?php echo isset($calculation['sal_cal_net_sal']) ? $calculation['sal_cal_net_sal'] : ""; ?>"></td>
                                                        <td>
                                                            <textarea class="form-control" rows="3" id="sal_cal_remark" name="sal_cal_remark[<?php echo $calculation['sal_cal_id']; ?>]" tabindex="2"><?php echo isset($calculation['sal_cal_remark']) ? $calculation['sal_cal_remark'] : ""; ?></textarea>

                                                        </td>
                                                        
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
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
 <script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
  var sal_month_name = "<?php echo  $this->input->get('sal_month_name') ? $this->input->get('sal_month_name') : '';?>";
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
</script>
<script>
$(document).ready(function(){
  $(".working_days,.total_leave,.py_without,.py_with,.extra_day,.late_hrs,.latehrs_hrs,.basic_sal,.pay_sal,.prof_tax,.esic,.pf,.net_sal").blur(function(){
        //alert("hiii");
        //alert($(this).attr('id'));
        var idstring = $(this).attr('id');
        idstring = idstring.replace("working_days", "");
        idstring = idstring.replace("total_leave", "");
        idstring = idstring.replace("py_without", "");
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

        var working_days = $('#working_days'+idstring).val();
        var total_leave = $('#total_leave'+idstring).val();
        var py_without = $('#py_without'+idstring).val();
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

        if(total_leave > 1)
        {
            py_without = parseFloat(total_leave) - 1;
            $('#py_without'+idstring).val(py_without);
            $('#py_with'+idstring).val(1);
        }else if(total_leave == 1){
            $('#py_without'+idstring).val(0);
            $('#py_with'+idstring).val(1);
        }else if(total_leave == 0.5){
            $('#py_without'+idstring).val(0);
            $('#py_with'+idstring).val(0.5);
        }else{
            $('#py_without'+idstring).val(0);
            $('#py_with'+idstring).val(0);
        }
        var pay_sal = (parseFloat(basic_sal)/30*parseFloat(working_days))-(((parseFloat(basic_sal)/30)*parseFloat(py_without))+((parseFloat(basic_sal)/30)*parseFloat(late_hrs)))+(parseFloat(basic_sal)/parseFloat(working_days))*parseFloat(extra_day)*1.5;
        $('#pay_sal'+idstring).val(pay_sal);
        var pay_sal = $('#pay_sal'+idstring).val();
        var net_sal = (parseFloat(pay_sal)-parseFloat(prof_tax))-(parseFloat(esic)+parseFloat(pf));
        $('#net_sal'+idstring).val(net_sal);
        //alert(idstring);

    });    

});
</script>