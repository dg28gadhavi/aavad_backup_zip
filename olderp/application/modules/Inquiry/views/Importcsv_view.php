
<div class="breadcrumbs">
                        <h1>CSV</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>home">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Inquiry">Inquiry</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Inquiry/add">Inquiry Add</a>
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

<div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                        <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body form">
                         <?php $currencys = array('class' => 'form-horizontal');
                       echo form_open_multipart($action,$currencys); ?> 
                            <div class="form-body">
                                <!-- <h3 class="form-section">Customer</h3> -->
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-6">
                                <div class="form-group" id="mcna_namegr">
                                    <input type="file" name="userfile" required>
                                    <div class="col-md-12">
                                        </div>
                                        <a target="_BLANK" href="<?php echo base_url(); ?>uploads/sample_csv/Sample.csv">Download Sample CSV</a>
                                    </div>
                                </div>
                                </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green" value="UPLOAD" name="submit"><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>

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
        <!-- END CORE PLUGINS-->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
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
<?php /*?>function myFunction() {
    var inpObj = document.getElementById("cu_address");
    if (inpObj.checkValidity() == false) {
        document.getElementById("cu_address").innerHTML = inpObj.validationMessage;
    } else {
        document.getElementById("cu_address").innerHTML = "Input OK";
    } 
} <?php */?>

function ValidateDetails()
{
    var fields;
    fields = "";
    document.getElementById('cu_address').className = 'form-control';
    $('#cu_address').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('cu_address').value).length == 0) {
        if(fields != 1){
        document.getElementById("cu_address").focus();
        }
        fields = '1';
        document.getElementById('cu_address').className = 'form-control error';
        if($('#cu_address').parent().parent().attr('class') == 'form-group')
        {
            $('#cu_address').parent().parent().addClass('has-error');
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


        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

