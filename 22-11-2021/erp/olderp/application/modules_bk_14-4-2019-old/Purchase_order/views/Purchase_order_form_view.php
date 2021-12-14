<?php //echo '<pre>'; print_r($vendors); die;?>
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
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
    <div class="breadcrumbs">
        <h1>Purchase Order Add</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>Purchase_order/Purchase_order_report">Purchase Order Report</a></li>
            <li><a href="<?php echo base_url(); ?>Purchase_order/add">Purchase Order Add</a></li>
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
                                <?php  $atr = array('class' => 'form-horizontal','autocomplete' => 'off');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">PO No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="1" class="form-control"  name="po_no" maxlength="200" id="po_no" value="<?php echo !$this->uri->segment(3) && isset($po_no) ? $po_no : ''; ?><?php echo isset($list[0]['po_no ']) ? $list[0]['po_no '] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">PO Code</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="2" class="form-control" placeholder="PO Code" name="po_code" maxlength="100" id="po_code" value="<?php echo !$this->uri->segment(3) && isset($po_code) ? $po_code : ''; ?><?php echo isset($list[0]['po_code']) ? $list[0]['po_code'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">PO Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="PO Date" name="po_date" maxlength="200" id="po_date" value="<?php echo isset($list[0]['po_date']) ? date("d-m-Y", strtotime($list[0]['po_date'])) : date('d-m-Y'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Supplier</label>
                                                <div class="col-md-9">
                                                	<input type="text" tabindex="2" class="form-control po_supplier" placeholder="Customer Name" name="po_supplier" maxlength="100" id="po_supplier" value="<?php echo isset($list[0]['po_supplier']) ? $list[0]['po_supplier'] : ""; ?>" required="required">
                                                    <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
                                                </div>
                                            </div>

                                    </div>

                                        
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Made By :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="po_madeby" tabindex="18" id="po_madeby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Made By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['po_madeby']) && $list[0]['po_madeby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Contact No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Contact No." name="po_contactno" maxlength="100" id="po_contactno" value="<?php echo isset($list[0]['po_contactno']) ? $list[0]['po_contactno'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Wo No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Wo No." name="po_wono" maxlength="100" id="po_wono" value="<?php echo isset($list[0]['po_wono']) ? $list[0]['po_wono'] : ""; ?>"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Reference No : </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Reference No : " name="po_refno" maxlength="100" id="po_refno" value="<?php echo isset($list[0]['po_refno']) ? $list[0]['po_refno'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode Of Delivary : </label>
                                            <div class="col-md-9">
                                                <select name="po_mode_delivary" id="po_mode_delivary" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
                                                     <option value="0">Select Currency</option>
                                                    <?php foreach($delivary as $deli)
                                                    { ?>
                                                            <option value="<?php echo $deli['mode_delivery_id']; ?>" <?php if(isset($list[0]['po_mode_delivary']) && $list[0]['po_mode_delivary'] == $deli['mode_delivery_id']){ echo "selected";} ?>> <?php echo $deli['mode_delivery_name']; ?>
                                                            </option>                                                    
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Place Of Delivary : </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Place Of Delivary : " name="po_place_delivary" maxlength="100" id="po_place_delivary" value="<?php echo isset($list[0]['po_place_delivary']) ? $list[0]['po_place_delivary'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode of PO : </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Mode of PO : " name="po_mode" maxlength="100" id="po_mode" value="<?php echo isset($list[0]['po_mode']) ? $list[0]['po_mode'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Remark</label>
                                                    <div class="col-md-9">
                                                    <textarea class="form-control" tabindex="3" name="po_remark" placeholder="Remark" id="po_remark" rows="3"><?php echo isset($list[0]['po_remark']) ? $list[0]['po_remark'] : ""; ?></textarea>
                                                    </div>
                                                </div>
                                       
                                    </div>
                                </div>
                                        
                                <div class="row">
                                    <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Select Currency</label>
                                                    <div class="col-md-9">
                                                        <select name="po_currency" id="po_currency" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
                                                     <option value="0">Select Currency</option>
                                                    <?php foreach($currency as $curre)
                                                    { ?>
                                                   
                                                            <option value="<?php echo $curre['curr_id']; ?>" <?php if(isset($list[0]['po_currency']) && $list[0]['po_currency'] == $curre[' curr_id']){ echo "selected";} ?>> <?php echo $curre['curr_name']; ?>
                                                            </option>                                                    
                                                    <?php }?>
                                                        
                                                </select>
                                                    </div>
                                                </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">GST No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="GST No." name="po_gstno" maxlength="200" id="po_gstno" value="<?php echo isset($list[0]['po_gstno']) ? $list[0]['po_gstno'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Insurance</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Insurance" name="po_insurance" maxlength="200" id="po_insurance" value="<?php echo isset($list[0]['po_insurance']) ? $list[0]['po_insurance'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">P F </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="P F " name="po_pf" maxlength="200" id="po_pf" value="<?php echo isset($list[0]['po_pf']) ? $list[0]['po_pf'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Fright </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Fright " name="po_fright" maxlength="200" id="po_fright" value="<?php echo isset($list[0]['po_fright']) ? $list[0]['po_fright'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">F.O.R</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="F.O.R" name="po_for" maxlength="200" id="po_for" value="<?php echo isset($list[0]['po_for']) ? $list[0]['po_for'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Discount</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Discount" name="po_discount" maxlength="200" id="po_discount" value="<?php echo isset($list[0]['po_discount']) ? $list[0]['po_discount'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Payment Terms</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Payment Terms" name="po_paymentterms" maxlength="200" id="po_paymentterms" value="<?php echo isset($list[0]['po_paymentterms']) ? $list[0]['po_paymentterms'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" tabindex="4" class="btn green" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'Start'; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                                </div>
                        <?php echo form_close(); ?>
            <!-- /.modal -->
                <?php //echo $this->load->view('admin/master/ajaxview/party_ajax_view'); ?>
            <!-- /.modal -->
                        </div>
                        </div>
                        </div>
                    </div>
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


<script type="text/javascript">
    $(document).ready(function () {
        //
        $('#country_change').change(function () {
            //alert($(this).val()+'aaaaaaaaaaaaaaaaaaaaaaa');
                var countryID = $(this).val();
                if(countryID != '' && countryID != undefined)
                {
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Purchase_order/get_country_to_state',
                data:'countryID='+countryID,
                success: function(data) {
                    var data = jQuery.parseJSON( data );
                    //console.log(data);
                    var str = '';
                    str += '<option value="">Select State</option>';
                    jQuery.each( data, function( i, val ) {
                      str += '<option value="'+val.state_id+'">'+val.state_name+'</option>';
                    });
                    $('#state_change').empty();
                    $('#city_change').empty();
                    $('#state_change').append(str);
                    $('#state_change').selectpicker('refresh');
                    var str = '';
                    str += '<option value="">Select City</option>';
                    $('#city_change').append(str);
                    $('#city_change').selectpicker('refresh');
                }
                });
            }
        });

        $('#state_change').change(function () {
            //alert($(this).val()+'aaaaaaaaaaaaaaaaaaaaaaa');
                var stateID = $(this).val();
                if(stateID != '' && stateID != undefined)
                {
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Purchase_order/get_state_to_city',
                data:'stateID='+stateID,
                success: function(data) {
                    var data = jQuery.parseJSON( data );
                    //console.log(data);
                    var str = '';
                    str += '<option value="">Select City</option>';
                    jQuery.each( data, function( i, val ) {
                      str += '<option value="'+val.city_id+'">'+val.city_name+'</option>';
                    });
                    $('#city_change').empty();
                    $('#city_change').append(str);
                    $('#city_change').selectpicker('refresh');
                }
                });
            }
        });
    });
</script>

<script type="text/javascript">
function sub_cat(i)
{
    var data = { 'id': i.value};
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Purchase_order/getsub_category",
        data: data,
        dataType:"json",
          success: function(json)
          {
             var data = '<option value="0">Select Subsource</option>';
             for(var i = 0; i < json.sub_catlists.length; i++)
             {
                data += '<option value="' + json.sub_catlists[i].source_cat_id + '">' + json.sub_catlists[i].source_cat_name + '</option>';
             }
             $('#sq_subsource_cat').empty();
             $('#sq_subsource_cat').append(data);
             $('.bs-select').selectpicker('refresh');
          },
          error: function( error )
         {
             alert( error );
         }
        });
}
</script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script>
  $( function() {
    $("#po_supplier").autocomplete({
            source: base_url+"Purchase_order/get_customer_information",
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
               $("#po_contactno").val(ui.item.cno+','+ui.item.phone);
               $("#sq_email").val(ui.item.email);
               //$("#po_contactno").val(ui.item.phone);
               $("#sq_website").val(ui.item.webaddr);
               $('#dis_cust_address').val(ui.item.address);
               $('#vendor_id').val(ui.item.customer_id);
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
        