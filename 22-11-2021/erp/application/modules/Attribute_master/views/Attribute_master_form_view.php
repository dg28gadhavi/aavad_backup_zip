<?php //echo "<pre>";print_r($list);die; ?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Attribute_master Add</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>Attribute_master">Attribute_master List</a></li>
        <li><a href="<?php echo base_url(); ?>Attribute_master/add">Attribute_master Add</a></li>
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
                    <?php  $atr = array('class' => 'form-horizontal','autocomplate' => 'off');
                     echo form_open_multipart($action,$atr); ?>
                <div class="form-body">
                    <h3 class="form-section">Attribute_master Name</h3>
                    <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Product Head Name</label>
                            <div class="col-md-9">
                                <select name="attrib_ph_id[]" tabindex="5" class="multi-select" id="my_multi_select1" multiple="multiple" required="required">
                                    <?php foreach($plist as $plists)
                                    { ?>
                                        <option value="<?php echo $plists['ph_id']; ?>" <?php if(isset($list[0]['product_heads_lists']) && is_array($list[0]['product_heads_lists']) && !empty($list[0]['product_heads_lists']) && in_array($plists['ph_id'],$list[0]['product_heads_lists'])){ echo "selected='selected'";} ?>><?php echo $plists['ph_name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Attribute_master Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Attribute_master Name" name="attrib_name" maxlength="200" id="attrib_name" value="<?php echo isset($list[0]['attrib_name']) ? $list[0]['attrib_name'] : ""; ?>" required="required" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Place</label>
                                <div class="col-md-9">
                                     <select name="attrib_place" id="attrib_place" tabindex="22" class="form-control bs-select">
                                        <option value="0">Select</option>
                                          <option value="1" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 1){ echo "selected";}?>>1</option>
                                          <option value="2" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 2){ echo "selected";}?>>2</option>
                                          <option value="3" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 3){ echo "selected";}?>>3</option>
                                          <option value="4" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 4){ echo "selected";}?>>4</option>
                                          <option value="5" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 5){ echo "selected";}?>>5</option>
                                          <option value="6" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 6){ echo "selected";}?>>6</option>
                                          <option value="7" <?php if(isset($list[0]['attrib_place']) && $list[0]['attrib_place'] == 7){ echo "selected";}?>>7</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Digit</label>
                                <div class="col-md-9">
                                     <select name="attrib_digit" id="attrib_digit" tabindex="22" class="form-control bs-select">
                                        <option value="0">Select</option>
                                          <option value="1" <?php if(isset($list[0]['attrib_digit']) && $list[0]['attrib_digit'] == 1){ echo "selected";}?>>1</option>
                                          <option value="2" <?php if(isset($list[0]['attrib_digit']) && $list[0]['attrib_digit'] == 2){ echo "selected";}?>>2</option>
                                          <option value="3" <?php if(isset($list[0]['attrib_digit']) && $list[0]['attrib_digit'] == 3){ echo "selected";}?>>3</option>
                                          <option value="4" <?php if(isset($list[0]['attrib_digit']) && $list[0]['attrib_digit'] == 4){ echo "selected";}?>>4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Order</label>
                                <div class="col-md-9">
                                     <select name="attrib_order" id="attrib_order" tabindex="22" class="form-control bs-select">
                                        <option value="0">Select</option>
                                          <option value="1" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 1){ echo "selected";}?>>1</option>
                                          <option value="2" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 2){ echo "selected";}?>>2</option>
                                          <option value="3" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 3){ echo "selected";}?>>3</option>
                                          <option value="4" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 4){ echo "selected";}?>>4</option>
                                          <option value="5" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 5){ echo "selected";}?>>5</option>
                                          <option value="6" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 6){ echo "selected";}?>>6</option>
                                          <option value="7" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 7){ echo "selected";}?>>7</option>
                                          <option value="8" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 8){ echo "selected";}?>>8</option>
                                          <option value="9" <?php if(isset($list[0]['attrib_order']) && $list[0]['attrib_order'] == 9){ echo "selected";}?>>9</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Part Code Include </label>
                                <div class="col-md-9">
                                     <select name="attrib_digit" id="attrib_digit" tabindex="22" class="form-control bs-select">
                                        <option value="0">Select</option>
                                          <option value="0" <?php if(isset($list[0]['attrib_digit']) && $list[0]['attrib_digit'] == 0){ echo "selected";}?>>Yes</option>
                                          <option value="1" <?php if(isset($list[0]['attrib_digit']) && $list[0]['attrib_digit'] == 1){ echo "selected";}?>>No</option>
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
                                            <button type="submit" class="btn green" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
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
// American Numbering System
var th = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

var dg = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];

var tn = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

var tw = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

function toWords(s) {
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'Hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {
        var y = s.length;
        str += 'Point ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
    }
    return str.replace(/\s+/g, ' ');

}
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