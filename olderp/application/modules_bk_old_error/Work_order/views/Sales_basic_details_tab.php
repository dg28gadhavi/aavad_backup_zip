<?php $logo=$this->session->userdata['miconlogin'];
//echo "<pre>"; print_r($confirm_or_not); die;
//echo encrypt_decrypt('decrypt',$logo['userid']);die;
 ?>
 
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<!-- END BREADCRUMBS -->
<!-- BEGIN CONTENT -->
<div class="page-content-container">
<div class="col-md-12">
<?php echo validation_errors(); ?>
<?php
if (!empty($success) || $this->session->flashdata('success') != '') {
    $msg = !empty($success) ? $success : $this->session->flashdata('success');
    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
if (!empty($error) || $this->session->flashdata('error') != '') {
    $msg = !empty($error) ? $error : $this->session->flashdata('error');
    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
if (!empty($warning) || $this->session->flashdata('warning') != '') {
    $msg = !empty($warning) ? $warning : $this->session->flashdata('warning');
    echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
?>
<div class="space-2"></div>
</div>
<div class="row">
    <div class="col-md-6">
    <div class="breadcrumbs breadcrumbs-header">
        <h1>Work order Description</h1>
        <?php $id = $this->uri->segment(3); ?>
           <!--  <a class="btn green" href="<?php echo base_url(); ?>pdf/enq/enq<?php echo $this->uri->segment(3); ?>.pdf" target="_blank">View PDF</a>
            <a class="btn green" href="">Mail Sent</a> -->
     </div> 
     </div>      
    <div class="col-md-6 breadcrumbs breadcrumbs-header">
        <ol class="breadcrumb">
        <li>
        <a class="bread-space" href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
        <a class="bread-space" href="<?php echo base_url(); ?>Work_order/Work_order_report">Work order Report</a>
        <a class="bread-space" href="<?php echo base_url(); ?>Work_order/add">Create New Work order</a>
        </li>
        </ol>
</div>
    <!-- Sidebar Toggle Button -->
       <?php  //$atr = array('class' => 'form-horizontal');

             //echo form_open_multipart($action,$atr); ?>
    <!-- Sidebar Toggle Button -->
</div>
<!-- BEGIN CONTENT BODY -->
<div class="page-content-row">
<!-- BEGIN PAGE HEADER-->
<div class="page-content-col">
<?php //echo '<pre>';print_r($emails);//die; ?>
<div class="row">
<div class="portlet box blue">     
     <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>Work Order  Process </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <!-- <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="javascript:;" class="remove"> </a> -->
            </div>
        </div>
            <div class="portlet-body">
                <div class="tabbable-custom">
                <?php //$tabono = $this->session->userdata('tabno') ? $this->session->userdata('tabno') : 0; ?>
                            <ul class="nav nav-tabs">
                            <?php $tabno = $this->session->userdata('tabno') ? $this->session->userdata('tabno') : 0 ; 
                            ?>
                            <li class="<?php if(isset($tabno) && ($tabno == 1)) { ?> active <?php } ?>">
                                <a href="#tab_2_1"  data-toggle="tab" aria-expanded="false"> Basic Details </a>
                            </li>
                            <li class="<?php if(isset($tabno) && ($tabno == 2 || $tabno == 0)) { ?> active <?php } ?>">
                                <a href="#tab_2_2"  data-toggle="tab" aria-expanded="false"> Item </a>
                            </li>
                            <!-- <?php if($confirm_or_not['wo_confirm_or_not'] == 1) { ?>
                            <li class="<?php if(isset($tabno) && ($tabno == 3)) { ?> active <?php } ?>">
                                <a href="#tab_2_3" data-toggle="tab" aria-expanded="false">Management</a>
                            </li>
                           <?php } ?> -->
                            <!-- <li class="<?php if(isset($tabno) && ($tabno == 4)) { ?> active <?php } ?>">
                                <a href="#tab_2_4"  data-toggle="tab" aria-expanded="false"> Other </a>
                            </li> -->
                                    <!-- <li class="dropdown">
                                        <a href="javascript:;" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Dropdown
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                                            <li>
                                                <a href="#tab_2_3" tabindex="-1" data-toggle="tab"> Option 1 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_2_4" tabindex="-1" data-toggle="tab"> Option 2 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_2_3" tabindex="-1" data-toggle="tab"> Option 3 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_2_4" tabindex="-1" data-toggle="tab"> Option 4 </a>
                                            </li>
                                        </ul>
                                    </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade <?php if(isset($tabno) && ($tabno == 1)) { ?> active in <?php } ?>" id="tab_2_1">
                                       <?php $this->load->view('Work_order_bd_view_tab');?>    
                                </div>
                                <div class="tab-pane fade <?php if(isset($tabno) && ($tabno == 2 || $tabno == 0)) { ?> active in <?php } ?>" id="tab_2_2">
                                         <?php $this->load->view('Work_order_item_details_tab');?>     
                                </div>
</div>
</div>
<!-- END CONTENT BODY -->
</div>
</div>
</div>
<?php //echo form_close(); ?>
<!-- END CONTENT -->
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
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
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
    var base_url = "<?php echo base_url(); ?>";
</script>
 <script>
  $( function() {
    $("#sqi_itm_pno").autocomplete({
            source: base_url+"Sales_enq/get_item_details",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                //alert("");
                //var url="<?php echo base_url();?>uploads/master_item_img/";
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                $('#itemid').val(ui.item.value);
                $('#sqi_itm_stock').val(ui.item.stock);
                $('#sqi_itm_hsncode').val(ui.item.hsncode);
                $('#sqi_itm_desc').val(ui.item.description);
                $('#sqi_itm_price').val(ui.item.rate);
                $('#sqi_itm_pno_id').val(ui.item.autoid);
                $('#sqi_itm_title').val(ui.item.title);
                //$('#master_item_  img').val(ui.item.autoid);
                //var imgurl=url + ui.item.image;
                //alert(ui.item.image);
                //$('#img').empty();
                //$('#img').append("<img src="+ui.item.image+" >");
            },
            focus: function (a, b)
            {
                return false
            }
    });
    });
  </script>
  <script>  
$(document).ready(function(){  
    $("#disi_qty").blur(function(){ 
        //alert('hiiiiiiiiiiii');
     if(($("#disi_qty").val() - $("#sqi_itm_stock").val()) > 0)
     {
        $("#sqi_itm_opn_qty").val($("#disi_qty").val() - $("#sqi_itm_stock").val());
        
     }else{
        $("#sqi_itm_opn_qty").val('0');
     }     
        //alert("This text box has lost its focus.");  
        return false;
    });  
});  
</script>
<script type="text/javascript">
$(document).on('blur', '.woi_qty,.woi_price,.woi_discount,.sqi_itm_stock,.woi_gst', function() {
        var idd = $(this).attr('id');
        //ert(idd);
        $("#woi_open_qty").val(Math.abs($("#sqi_itm_stock").val() - $("#woi_qty").val()));
        var total =($("#woi_qty").val() * $("#woi_price").val());
        var totaldisc = ((($("#woi_qty").val() * $("#woi_price").val()) * $("#woi_discount").val()) / 100);
        var ftotal = (($("#woi_qty").val() * $("#woi_price").val()) - totaldisc);
        var gstrate=ftotal*($("#woi_gst").val() / 100);
        var gstwithftotal=ftotal + gstrate;
        $("#woi_total").val(parseFloat(total).toFixed(2));
        $("#woi_final_price").val(parseFloat(gstwithftotal).toFixed(2));
        //ert(totaldisc);        
        });
</script>
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
    var base_url = "<?php echo base_url(); ?>";
</script>
<script>
  $( function() {
    $("#vendor").autocomplete({
            source: base_url+"Work_order/get_customer_information",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                //alert(ui.item.customer_id);
                var itemname = ui.item.label;
                $('#temp_cname').val(ui.item.label);
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
               $("#sq_mobile").val(ui.item.cno);
               $("#sq_email").val(ui.item.email);
               $("#sq_phone").val(ui.item.phone);
               $("#sq_website").val(ui.item.webaddr);
               $('#wo_address').val(ui.item.address);
               $('#wo_billing_address').val(ui.item.address);
               $('#wo_shipping_address').val(ui.item.address);
               $('#wo_custo_id').val(ui.item.vendor_id);
               $('#wo_gstno').val(ui.item.gstno);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });

    $(document).on("blur","#vendor",function() {
        var temp_name = $('#temp_cname').val();
        var vendor_name = $('#vendor').val();
        // alert(temp_name);
        // alert(vendor_name);
        if(temp_name != vendor_name)
        {
            alert("This Customer is not exist in master party.")
            $('#temp_cname').val('');
            $('#vendor').val('');
            $('#wo_custo_id').val('');
        }
    });


    });
  </script>
<script>
    $("#wo_taxbleamount,#wo_pfgst").blur(function(){ 
     var total = parseFloat(($("#wo_taxbleamount").val() * $("#wo_pfgst").val()) / 100);

     //var discount = total - ((total * $("#pii_itm_discount").val())/100);
     $("#wo_taxamount").val(total);
     var gtotal=parseFloat(total) + parseFloat($("#wo_taxbleamount").val());
     $("#wo_pf_grandtotal").val(gtotal);
        //alert("This text box has lost its focus.");  
        return false;
    });  
</script>
<script>
    $("#wo_fright_taxbleamount,#wo_fright_pfgst").blur(function(){ 
     var total = parseFloat(($("#wo_fright_taxbleamount").val() * $("#wo_fright_pfgst").val()) / 100);

     //var discount = total - ((total * $("#pii_itm_discount").val())/100);
     $("#wo_fright_taxamount").val(total);
     var gtotal=parseFloat(total) + parseFloat($("#wo_fright_taxbleamount").val());
     $("#wo_fright_grandtotal").val(gtotal);
        //alert("This text box has lost its focus.");  
        return false;
    });  
</script>
<script>
    $("#wo_fright_taxbleamount,#wo_fright_pfgst").blur(function(){ 
     var total = parseFloat(($("#wo_fright_taxbleamount").val() * $("#wo_fright_pfgst").val()) / 100);

     //var discount = total - ((total * $("#pii_itm_discount").val())/100);
     $("#wo_fright_taxamount").val(total);
     var gtotal=parseFloat(total) + parseFloat($("#wo_fright_taxbleamount").val());
     $("#wo_fright_grandtotal").val(gtotal);
        //alert("This text box has lost its focus.");  
        return false;
    });  
</script>
<script type="text/javascript">
function sub_cat(i)
{
    var data = { 'id': i.value};
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Sales_enq/getsub_category",
        data: data,
        dataType:"json",
          success: function(json)
          {
             var data = "";
             data += '<option value="">Select Sub Source</option>';
             for(var i = 0; i < json.sub_catlists.length; i++)
             {
                data += '<option value="' + json.sub_catlists[i].source_main_cat + '">' + json.sub_catlists[i].source_cat_name + '</option>';
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