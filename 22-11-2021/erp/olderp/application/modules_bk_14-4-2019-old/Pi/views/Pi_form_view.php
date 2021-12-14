<?php //echo '<pre>'; print_r($vendors); die;?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
        <h1>Pi Add</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>Pi">Pi Report</a></li>
            <li><a href="<?php echo base_url(); ?>Pi/add">Pi Add</a></li>
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
                            <?php  $atr = array('class' => 'form-horizontal', 'autocomplete' => 'off');
                            echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">                            
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">   
                                        <div class="portlet-title">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">PO No.</label>
                                                        <div class="col-md-9">
                                                           <input type="text" tabindex="1" class="form-control"  name="po_no" maxlength="200" id="po_no" value="<?php echo !$this->uri->segment(3) && isset($pi_code) ? $pi_code : ''; ?><?php echo isset($list[0]['po_no']) ? $list[0]['po_no'] : ""; ?>" autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PO Date</label>
                                                        <div class="col-md-9">
                                                             <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Quotation Date" name="po_enq_date" maxlength="200" id="po_enq_date" value="<?php echo isset($list[0]['po_enq_date']) ? date("d-m-Y", strtotime($list[0]['po_enq_date'])) : date('d-m-Y'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">PI No.</label>
                                                        <div class="col-md-9">
                                                           <input type="text" tabindex="3" class="form-control"  name="pi_no" maxlength="200" id="pi_no" value="<?php echo !$this->uri->segment(3) && isset($pi_code) ? $pi_code : ''; ?><?php echo isset($list[0]['pi_no']) ? $list[0]['pi_no'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PI Date</label>
                                                        <div class="col-md-9">
                                                             <input type="text" tabindex="4" class="form-control form-control-inline input-medium date-picker" placeholder="Quotation Date" name="pi_enq_date" maxlength="200" id="pi_enq_date" value="<?php echo isset($list[0]['pi_enq_date']) ? date("d-m-Y", strtotime($list[0]['pi_enq_date'])) : date('d-m-Y'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Customer Name</label>
                                                        <div class="col-md-7">
                                                           <input type="text" tabindex="5" class="form-control vendor" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>" required="required">
                                                           <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a class="btn red" href="<?php echo base_url(); ?>Pi/add">RESET</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Customer Address</label>
                                                        <div class="col-md-9">
                                                        <textarea class="form-control" tabindex="6" name="pi_address" placeholder="Customer Address" id="pi_address" rows="3"><?php echo isset($list[0]['pi_address']) ? $list[0]['pi_address'] : ""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Country:</label>
                                                        <div class="col-md-9">
                                                            <select name="pi_country" tabindex="7" id="country_change" class="bs-select form-control country_change" data-live-search="true" data-size="8">
                                                                <option value="">Select Country</option>
                                                                <?php  foreach($countries as $country) {?>  <option value="<?php echo $country['country_id'];?>" <?php if(isset($list[0]['pi_country']) && $list[0]['pi_country'] == $country['country_id']){ echo "selected";}?>><?php echo $country['country_name']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">State:</label>
                                                        <div class="col-md-9">
                                                            <select name="pi_state" tabindex="8" id="state_change" class="bs-select form-control state_change" data-live-search="true" data-size="8">
                                                                <option value="">Select State</option>
                                                                <?php  foreach($states as $state) {?>  <option value="<?php echo $state['state_id'];?>" <?php if(isset($list[0]['pi_state']) && $list[0]['pi_state'] == $state['state_id']){ echo "selected";}?>><?php echo $state['state_name']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="master_party_taxgr">
                                                        <label class="control-label col-md-3">City:</label>
                                                        <div class="col-md-9">
                                                           <select name="pi_city" tabindex="9" id="city_change" class="bs-select form-control city_change" data-live-search="true" data-size="8">
                                                            <option value="">Select City</option>
                                                                <?php  foreach($cities as $citie) {?>  <option value="<?php echo $citie['city_id'];?>" <?php if(isset($list[0]['pi_city']) && $list[0]['pi_city'] == $citie['city_id']){ echo "selected";}?>><?php echo $citie['city_name']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Brand:</label>
                                                        <div class="col-md-9">
                                                        <select multiple="multiple" tabindex="9" class="multi-select" id="my_multi_select1" name="pi_brand[]">
                                                              <?php foreach ($brands as $brand) { 
                                                            ?>
                                                        <option value="<?php echo $brand['brand_id'];?>"<?php 
                                                        if(isset($list[0]['pi_brand']) && $list[0]['pi_brand'] != ''){
                                                        $re_homenames = json_decode($list[0]['pi_brand']);
                                                         if($re_homenames == ''){ echo '';}else{
                                                            //echo "<pre>"; print_r($brand['home_id']); 
                                                            foreach($re_homenames as $re_homename){
                                                              if(isset($re_homename) && $re_homename == $brand['brand_id']){ echo "selected";} } } }?>><?php echo $brand['brand_name']; ?></option>
                                                        <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Contact Person:</label>
                                                        <div class="col-md-9">
                                                           <input type="text" tabindex="10" class="form-control" placeholder="Contact Person" name="pi_con_person" maxlength="100" id="pi_con_person" value="<?php echo isset($list[0]['pi_cont_per']) ? $list[0]['pi_cont_per'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Mobile No</label>
                                                        <div class="col-md-9">
                                                            <input type="text" tabindex="11" class="form-control" placeholder="Mobile No" name="pi_mobile" maxlength="200" id="pi_mobile" value="<?php echo isset($list[0]['pi_mobile']) ? $list[0]['pi_mobile'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Email Id</label>
                                                        <div class="col-md-9">
                                                           <input type="text" tabindex="12" class="form-control" placeholder="Email Id" name="pi_email" maxlength="100" id="pi_email" value="<?php echo isset($list[0]['pi_email']) ? $list[0]['pi_email'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Phone No</label>
                                                        <div class="col-md-9">
                                                            <input type="text" tabindex="13" class="form-control" placeholder="Phone No" name="pi_phone" maxlength="100" id="pi_phone" value="<?php echo isset($list[0]['pi_phone']) ? $list[0]['pi_phone'] : ""; ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Website Address</label>
                                                        <div class="col-md-9">
                                                       
                                                            <input type="text" tabindex="14" class="form-control" placeholder="Website Address" name="pi_website" maxlength="200" id="pi_website" value="<?php echo isset($list[0]['pi_website']) ? $list[0]['pi_website'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">GST No</label>
                                                        <div class="col-md-9">
                                                            <input type="text" tabindex="15" class="form-control" placeholder="GST No" name="pi_gst" maxlength="100" id="pi_gst" value="<?php echo isset($list[0]['pi_gst']) ? $list[0]['pi_gst'] : ""; ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="display:none">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Reminder Date:</label>
                                                        <div class="col-md-9">
                                                             <input type="text" tabindex="16" class="form-control form-control-inline input-medium date-picker" placeholder="Reminder Date" name="pi_rem_date" maxlength="200" id="pi_rem_date" value="<?php echo isset($list[0]['pi_rem_date']) ? date("d-m-Y", strtotime($list[0]['pi_rem_date'])) : ""; ?>">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Remind before (In days):</label>
                                                        <div class="col-md-9">
                                                              <input type="text" tabindex="17" class="form-control" placeholder="Reminder Before Days" name="pi_rem_be_date" maxlength="100" id="pi_rem_be_date" value="<?php echo isset($list[0]['pi_rem_be_date']) ? $list[0]['pi_rem_be_date'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                              <input type="submit" tabindex="18" class="btn btn-success btn-space" name="start" value="Start"/>
                                                            </div>
                                                        </div>
                                                    </div>
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
    </div>
</div>
</div>
                
<script src="<?php echo base_url(); ?>assets/global/plugins/js/icheck/icheck.min.js" type="text/javascript"></script>
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
<!-- START add more SCRIPTS -->
<script type="text/javascript"> var suffix = '<?php echo json_encode(array("me")); ?>'; var paction ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>'; 
         <?php  if($this->uri->segment(3) && $this->uri->segment(3) != ''){ ?>
          var encid = "<?php echo $this->uri->segment(3); ?>"; 
          <?php }else{ ?>
            var encid = 0; 
            <?php } ?>
         var enc ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>' </script>
<script src="<?php echo base_url(); ?>assets/custom/js/quotation_ajax_form.js" type="text/javascript"></script>
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

function ValidateDetails()
{
    var fields;
    fields = "";
    var itemArray = [];
    var itemcountr = -1;
    var isdupli = 0;
    $('.itmchange').each(function() { itemcountr++;
        if($('#'+$(this).attr('id')).val() != undefined && $('#'+$(this).attr('id')).val() != '')
        {
            //alert($(this).val());
            if ($.inArray($(this).val(), itemArray) == -1) { //check if id value not exits than add it
            itemArray.push($(this).val());
                //alert('add index');
                if(isdupli != 3)
                {
                    isdupli = 1;    
                }
            }else{
                //alert('duplicate');
                isdupli = 3;
            }
        }
    });
    //alert(isdupli);
    if(isdupli == 3)
    {
        alert('You can not select single item multiple times. single item selected more than one time.');
        $('.rederror').css('background-color','#F00');
        $('.rederror').css('color','#FFF');
        $('#kind_name').focus();
        fields = '1';
    }
    
    var bomArray = [];
    var bomcountr = -1;
    var bisdupli = 0;
    $('.bomchange').each(function() { bomcountr++;
        if($('#'+$(this).attr('id')).val() != undefined && $('#'+$(this).attr('id')).val() != '')
        {
            //alert($(this).val());
            if ($.inArray($(this).val(), bomArray) == -1) { //check if id value not exits than add it
            bomArray.push($(this).val());
                //alert('add index');
                if(bisdupli != 3)
                {
                    bisdupli = 1;   
                }
            }else{
                //alert('duplicate');
                bisdupli = 3;
            }
        }
    });
    //alert(isdupli);
    if(bisdupli == 3)
    {
        alert('You can not select single BOM multiple times. single BOM selected more than one time.');
        $('.rederror').css('background-color','#F00');
        $('.rederror').css('color','#FFF');
        $('#kind_name').focus();
        fields = '1';
    }
 
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        
        return false;
    }
    else {
        return true;
    }    
}

$('.date-picker').datepicker({
    format: 'dd-mm-yyyy',
});
</script>
<!-- <script src="<?php //echo base_url(); ?>assets/search/js/jquery-ui.js"></script> -->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript">
function sub_cat(i)
{
	var data = { 'id': i.value};
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>Pi/getsub_category",
		data: data,
		dataType:"json",
		  success: function(json)
		  {
			 var data = "";
			 for(var i = 0; i < json.sub_catlists.length; i++)
			 {
			 	data += '<option value="' + json.sub_catlists[i].source_main_cat + '">' + json.sub_catlists[i].source_cat_name + '</option>';
			 }
			 $('#pi_subsource_cat').empty();
			 $('#pi_subsource_cat').append(data);
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
$(document).on('blur', '.qty,.rate,.discount,.quot_ftotl', function() {
        var idd = $(this).attr('id');
        //alert(HII);

        idd = idd.replace('rate', ',');
        //alert(idd);
        idd = idd.replace('qty', ',');
        idd = idd.replace('discount', ',');
        var res = idd.split(',');
        //alert(res[0]);mewo_qty1
        //alert(res[1]);
        //alert($('#wo_qty'+res[1]).val());
        var qty = $('#'+res[0]+'qty'+res[1]).val();
        var rate = $('#'+res[0]+'rate'+res[1]).val();
        var disc = $('#'+res[0]+'discount'+res[1]).val();

        //var seltax = $('#'+res[0]+'itax_amt'+res[1]).val();
        var totaldisc = (((parseFloat(qty) * parseFloat(rate)) * disc) / 100);
        var total = ((parseFloat(qty) * parseFloat(rate)) - totaldisc);
        //alert(totaldisc);
        if(totaldisc != '' && total != '')
        {
          //$('#'+res[0]+'wo_disprice'+res[1]).val(parseFloat(totaldisc).toFixed(2));
          $('#'+res[0]+'quot_ftotl'+res[1]).val(parseFloat(total).toFixed(2));
        }
        });

</script>
<!-- <script src="<?php //echo base_url(); ?>assets/search/js/jquery-ui.js"></script> -->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script>
  $( function() {
    $("#vendor").autocomplete({
            source: base_url+"Sales_enq/get_customer_information",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
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
               $("#pi_con_person").val(ui.item.cperson);
               $("#pi_mobile").val(ui.item.cno);
               $("#pi_email").val(ui.item.email);
               $("#pi_phone").val(ui.item.phone);
               $("#pi_website").val(ui.item.webaddr);
               $('#pi_address').val(ui.item.address);
               $('#vendor_id').val(ui.item.vendor_id);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });

    $('#country_change').change(function () {
            //alert($(this).val()+'aaaaaaaaaaaaaaaaaaaaaaa');
                var countryID = $(this).val();
                if(countryID != '' && countryID != undefined)
                {
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Sales_enq/get_country_to_state',
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
                url:'<?php echo base_url(); ?>Sales_enq/get_state_to_city',
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

        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>
		