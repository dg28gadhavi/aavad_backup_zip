<?php //echo "<pre>"; print_r($item_data); die; ?>
<?php //echo '<pre>';print_r($item_data); die;?>
<!-- <?php// echo "<pre>"; print_r($this->session->userdata['miconlogin']); die; ?> -->
 
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
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

<div class="container-fluid">

<div class="page-content">

<!-- BEGIN BREADCRUMBS -->
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
        <h1>Description</h1>
        <?php $id = $this->uri->segment(3); ?>
            <a class="btn green" href="<?php echo base_url(); ?>Pi/load_pdf/<?php echo $this->uri->segment(3); ?>.pdf" target="_blank">View PDF</a>
            <a class="btn green" href="<?php echo base_url(); ?>Pi/mail/<?php echo $this->uri->segment(3); ?>">Mail Sent</a>            
     </div> 
     </div>      
    <div class="col-md-6 breadcrumbs breadcrumbs-header">
        <ol class="breadcrumb">
        <li>
            <a class="bread-space" href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
            <a class="bread-space" href="<?php echo base_url(); ?>Pi">Pi Report</a>
            <a class="bread-space" href="<?php echo base_url(); ?>Pi/add">Create New Pi</a>
        </li>
        </ol>
    </div>

<!-- Sidebar Toggle Button -->
   <?php  //$atr = array('class' => 'form-horizontal');

         //echo form_open_multipart($action,$atr); ?>
</div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <?php //echo '<pre>';print_r($emails);//die; ?>
                    	<div class="row">
                        <div class="portlet box blue">     
                             <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Pi Process </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <!-- <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                            <div class="portlet-body">
                                <div class="tabbable-custom">                                
                                        	<ul class="nav nav-tabs">
                                                <?php $qtabno = $this->session->userdata('qtabno') ? $this->session->userdata('qtabno') : 0 ; ?>
                                            <li class="<?php if(isset($qtabno) && ($qtabno == 1)) { ?> active <?php } ?>">
                                                <a href="#tab_2_1" data-toggle="tab" aria-expanded="true">  Basic Details </a>
                                            </li>                                            
                                            <li class="<?php if(isset($qtabno) && ($qtabno == 2 || $qtabno == 0)) { ?> active <?php } ?>">
                                                <a href="#tab_2_2" data-toggle="tab" aria-expanded="false"> Detail of Item </a>
                                            </li>
                                            <li class="<?php if(isset($qtabno) && ($qtabno == 4)) { ?> active <?php } ?>">
                                                <a href="#tab_2_4" data-toggle="tab" aria-expanded="false"> Other </a>
                                            </li>
                                            <li class="<?php if(isset($qtabno) && ($qtabno == 5)) { ?> active <?php } ?>">
                                                <a href="#tab_2_5" data-toggle="tab" aria-expanded="false"> Extra </a>
                                            </li>   
                                        	</ul>
                                            <div class="tab-content">
                                                    <div class="tab-pane fade <?php if(isset($qtabno) && ($qtabno == 1)) { ?> active in <?php } ?>" id="tab_2_1">
                                                        <?php $this->load->view('basic_details'); ?>
                                                    </div>
                                                    <div class="tab-pane fade <?php if(isset($qtabno) && ($qtabno == 2  || $qtabno == 0)) { ?> active in <?php } ?>" id="tab_2_2">
                                                            <?php $this->load->view('item_details'); ?> 		
    					                              </div>	
                                                      <div class="tab-pane fade <?php if(isset($qtabno) && ($qtabno == 4)) { ?> active in <?php } ?>" id="tab_2_4">
                                                            <?php $this->load->view('other_details'); ?>       
                                                        </div>
                                                     <div class="tab-pane fade <?php if(isset($qtabno) && ($qtabno == 5)) { ?> active in <?php } ?>" id="tab_2_5">
                                                           <?php $this->load->view('extra_details'); ?>  
                                                        </div>
                                            </div>
                                    </div>
                                </div>
                <!-- END CONTENT BODY -->
            </div>
           </div>
       </div>
   </div>
</div>
</div>
</div>
<?php //echo form_close(); ?> 
<!-- END CONTENT -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script>

<![endif]-->
<!-- BEGIN CORE PLUGINS -->
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
        

        <!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
                $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
        });
        </script>
        <?php //theme layout scripts ?>
        <!-- <script src="<?php echo base_url(); ?>assets/search/js/jquery-1.12.4.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/search/js/jquery-ui.js"></script> -->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
 <script>
  $( function() {
    $("#pii_itm_pno").autocomplete({
            source: base_url+"Sales_enq/get_item_details",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                  $('#sqi_itm_hsncode').val(ui.item.hsncode);
                $('#itemid').val(ui.item.value);
                $('#pii_itm_stock').val(ui.item.stock);
                $('#pii_itm_desc').val(ui.item.description);
                //$('input[name='sa_itm_desc']').val(ui.item.description);
                $('#pii_itm_price').val(ui.item.rate);
                 $('#pii_itm').val(ui.item.autoid);
                  $('#pii_itm_title').val(ui.item.title);
            },
            focus: function (a, b)
            {
                return false
            }
    });
    });
  </script>
   <script>
   
    $("#pii_itm_qty,#pii_itm_stock").blur(function(){ 
     if(($("#pii_itm_qty").val() - $("#pii_itm_stock").val()) > 0)
     {
        $("#pii_itm_opn_qty").val($("#pii_itm_qty").val() - $("#pii_itm_stock").val());
     }else{
        $("#pii_itm_opn_qty").val('0');
        
     }
     
        //alert("This text box has lost its focus.");  
        return false;
    });  
  
</script>
<script>
   
    $("#pi_extra_qty,#pi_extra_price").blur(function()
    { 
     
     var total = parseFloat($("#pi_extra_qty").val() * $("#pi_extra_price").val());
      $("#pi_extra_total").val(total);
    });  
  
</script>
<script>
    $("#pi_taxbleamount,#pi_pfgst").blur(function(){ 
     var total = parseFloat(($("#pi_taxbleamount").val() * $("#pi_pfgst").val()) / 100);

     //var discount = total - ((total * $("#pii_itm_discount").val())/100);
     $("#pi_taxamount").val(total);
     var gtotal=parseFloat(total) + parseFloat($("#pi_taxbleamount").val());
     $("#pi_grandtotal").val(gtotal);
        //alert("This text box has lost its focus.");  
        return false;
    });  
</script>
<script>
    $("#pi_fright_taxbleamount,#pi_fright_pfgst").blur(function(){ 
     var total = parseFloat(($("#pi_fright_taxbleamount").val() * $("#pi_fright_pfgst").val()) / 100);

     //var discount = total - ((total * $("#pii_itm_discount").val())/100);
     $("#pi_fright_taxamount").val(total);
     var gtotal=parseFloat(total) + parseFloat($("#pi_fright_taxbleamount").val());
     $("#pi_fright_grandtotal").val(gtotal);
        //alert("This text box has lost its focus.");  
        return false;
    });  
</script>
<script>
    $("#pii_itm_qty,#pii_itm_price,#pii_itm_discount,#pii_itm_gst_per").blur(function(){ 
     var total = $("#pii_itm_qty").val() * $("#pii_itm_price").val();
     var discount = total - ((total * $("#pii_itm_discount").val())/100);
     $("#pii_itm_ftotal").val(discount);
        //alert("This text box has lost its focus.");
       var gst= parseFloat($("#pii_itm_gst_per").val());
        var gstrate = (total * gst) / 100;
        //alert(gstrate);
        //alert(discount);
        if($("#pii_itm_discount").val()!="")
        {
            var ftotal =discount + gstrate;
            $("#pii_itm_ftotal").val(ftotal);
        }
        else{
            var ftotal = gstrate + total;
            $("#pii_itm_ftotal").val(ftotal);
        }
        
        return false;
    });  
</script>

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
          },
          error: function( error )
         {
             alert( error );
         }
        });
}
</script>
<script type="text/javascript">
$(document).on('blur', '.pii_itm_qty,.pii_itm_price,.pii_itm_discount,.pii_itm_gst_per', function() {
        var idd = $(this).attr('id');
        

         $("#pii_itm_total").val(parseFloat($("#pii_itm_qty").val() * $("#pii_itm_price").val()).toFixed(2));
       // var totaldisc = ((($("#pii_itm_qty").val() * $("#pii_itm_price").val())) / 100);
        alert(totaldisc);
        var total = (($("#pii_itm_qty").val() * $("#pii_itm_price").val()) - totaldisc);
        var gstrate = ((total * $("#pii_itm_gst_per").val())/100);
        var ftotal = gstrate + total;
        $("#pii_itm_ftotal").val(parseFloat(ftotal).toFixed(2));
        //alert(totaldisc);
        
        });

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
                    //alert('hiii');
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
               $("#pi_address").val(ui.item.address);
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
 <script type="text/javascript">
    $(document).ready(function () {
        $('#sqi_itm_hsncode').change(function () {
                var customerID = $(this).val();
                if(customerID){
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Pi/get_gst',
                data:'id='+customerID,
                success: function(data) {
                    //alert(data);
                   // $('#pii_itm_gst_per').empty();
                   console.log(data);
                    data = $.parseJSON(data);
                    $('#pii_itm_gst_per').val(data.hsn_tax);
                }
                });
            }
        })
    });
</script>