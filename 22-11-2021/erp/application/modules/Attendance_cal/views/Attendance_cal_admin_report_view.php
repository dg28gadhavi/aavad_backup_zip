<?php     ?>
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Salary_cal</h1>
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

        <?php if(isset($Sal_cals)){ 

         foreach($Sal_cals as $calculation){ ?>

        <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"><?php echo date("F Y", strtotime($calculation['attend_date_firstdate'])); ?></span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3">
                                            <thead>
                                                <tr>
                                                    <th class="all">Sr. No.</th>
                                                    <th class="all">Date</th>
                                                   <th class="all">Executive Name</th>
                                                    <th class="all"> Attendance</th>
                                                    <th class="all">Intime</th>
                                                    <th class="all">Out Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                //echo "<pre>"; print_r($Sal_cals);die;
                                                 $id = 0; 
                                                 if(isset($calculation['salary_datas'])){ 

                                                   // $t_work_day=0;$t_leave=0;$t_py_without=0;$t_py_with=0;$t_extra_day=0;$t_late_hrs=0;$t_basic=0;$t_pay_sal=0;$t_prof_tax=0;$t_esic=0;$t_pf=0;$t_netsal=0;
                                                 foreach($calculation['salary_datas'] as $calculation){ 

                                                    $id++; ?>
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                         <td><?php echo $calculation['attend_date_name']; ?></td>
                                                         <td><?php echo $calculation['au_fname']; ?></td>
                                                        <td><?php
                                                        if ($calculation['attend_pa_id']=='1') {
                                                            echo "Present";
                                                        }elseif ($calculation['attend_pa_id']=='2') {
                                                             echo "Absent";
                                                        }
                                                         ?></td>
                                                        <td><?php echo $calculation['attend_intime']; ?></td>
                                                        <td><?php echo $calculation['attend_outtime']; ?></td>
                                                        <?php } ?>
                                                     
                                                </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                    </div>
    </div>
<?php } } ?>



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
  $(".working_days,.total_leave,.py_without,.py_with,.extra_day,.late_hrs,.basic_sal,.pay_sal,.prof_tax,.esic,.pf,.net_sal").blur(function(){
        //alert("hiii");
        //alert($(this).attr('id'));
        var idstring = $(this).attr('id');
        idstring = idstring.replace("working_days", "");
        idstring = idstring.replace("total_leave", "");
        idstring = idstring.replace("py_without", "");
        idstring = idstring.replace("py_with", "");
        idstring = idstring.replace("extra_day", "");
        idstring = idstring.replace("late_hrs", "");
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