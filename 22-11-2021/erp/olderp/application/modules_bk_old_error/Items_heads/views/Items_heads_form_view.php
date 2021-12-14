<?php //echo '<pre>'; print_r($parent_cats); die;?><!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
            <h1>Item Heads Add</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>Items_heads">Item Heads List</a></li>
                <li><a href="<?php echo base_url(); ?>Items_heads/add">Item Heads Add</a></li>
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
                <div class="page-content-col">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body form">
                                <?php  $atr = array('class' => 'form-horizontal','autocomplate' => 'off');
                                 echo form_open($action,$atr); ?>
                            <div class="form-body">
                                <h3 class="form-section">Item Heads</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Heads</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="1" class="form-control" placeholder="Heads Name" name="item_head_name" maxlength="200" id="item_head_name" value="<?php echo isset($list[0]['item_head_name']) ? $list[0]['item_head_name'] : ""; ?>" required="required" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Head Code</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="1" class="form-control" placeholder="Heads Code" name="item_head_code" maxlength="200" id="item_head_code" value="<?php echo isset($list[0]['item_head_code']) ? $list[0]['item_head_code'] : ""; ?>" required="required" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Parent</label>
                                            <div class="col-md-8">
                                            	<select name="item_head_parent" id="item_head_parent" tabindex="2" class="bs-select form-control" data-live-search="true" data-size="8" required="required">
                                                	<option value="0">no parent</option>
                                                    <?php foreach ($parent_cats as $maincat) { ?>
                                                	<option value="<?php echo $maincat['item_head_id']; ?>" <?php if(isset($list[0]['item_head_parent']) && ($list[0]['item_head_parent'] == $maincat['item_head_id'])){ ?> selected="selected" <?php } ?> ><?php echo $maincat['item_head_name']; ?></option>
                                                <?php } ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Select Heads Type</label>
                                            <div class="col-md-8">
                                                <select tabindex="8" class="bs-select form-control" data-live-search="true" data-size="8" name="item_head_type" id="master_item_make">
                                                    <option value="0">Select Heads Type</option>
                                                    
                                                    <option value="1" <?php if(isset($list[0]['item_head_type']) && $list[0]['item_head_type'] == '1'){ echo "selected";} ?> >Select</option>
                                                     <option value="2" <?php if(isset($list[0]['item_head_type']) && $list[0]['item_head_type'] == '2'){ echo "selected";}?> >Input</option>
                                                                      
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
                                                <button type="submit" tabindex="3" class="btn green" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
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
    document.getElementById('item_head_name').className = 'form-control';
    $('#item_head_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('item_head_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("item_head_name").focus();
        }
        fields = '1';
        document.getElementById('item_head_name').className = 'form-control error';
        if($('#item_head_name').parent().parent().attr('class') == 'form-group')
        {
            $('#item_head_name').parent().parent().addClass('has-error');
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
        <?php //theme layout scripts ?>