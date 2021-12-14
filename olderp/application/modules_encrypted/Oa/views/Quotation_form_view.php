<?php //echo "<pre>"; print_r($item_data); die; ?>
<?php //echo '<pre>';print_r($item_data); die;?>

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
<div class="page-content headerpage-desc">
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
            <a class="btn green" href="<?php echo base_url(); ?>pdf/oa/oa<?php echo $this->uri->segment(3); ?>.pdf" target="_blank">View PDF</a>
            <a title="Create PI" href="<?php echo base_url() ?>Oa/oatopi/<?php echo $this->uri->segment(3); ?>"onclick="return confirm('."'Are you sure you want to Create PI?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i>Create PI</a>
            <a class="btn green" href="<?php echo base_url(); ?>Oa/mail/<?php echo $this->uri->segment(3); ?>">Mail Sent</a>
           <a title="Create PI" href="<?php echo base_url() ?>Oa/oatoworkorder/<?php echo $this->uri->segment(3); ?>"onclick="return confirm('."'Are you sure you want to Create Work Order?'".')" class="btn btn-sm btn-outline red"><i class="fa fa-plus-circle"></i>Create Work Order</a>
     </div> 
     </div>      
    <div class="col-md-6 breadcrumbs breadcrumbs-header">
        <ol class="breadcrumb">
        <li>
            <a class="bread-space" href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
            <a class="bread-space" href="<?php echo base_url(); ?>Oa">Oa Report</a>
            <a class="bread-space" href="<?php echo base_url(); ?>Oa/add">Create New Oa</a>
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
                            <i class="fa fa-cogs"></i>OA Process </div>
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
                            </div>
                        </div>
                    </div>
                <!-- END CONTENT BODY -->
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
<!-- <script src="<?php //echo base_url(); ?>assets/search/js/jquery-ui.js"></script> -->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
 <script>
  $( function() {
    $("#oai_itm_pno").autocomplete({
            source: base_url+"Sales_enq/get_item_details",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                $('#itemid').val(ui.item.value);
                $('#oai_itm_stock').val(ui.item.stock);
                $('#oai_itm_desc').val(ui.item.description);
                $('#sqi_itm_hsncode').val(ui.item.hsncode);
                //$('input[name='sa_itm_desc']').val(ui.item.description);
                $('#oai_itm_price').val(ui.item.rate);
                 $('#oai_itm').val(ui.item.autoid);
                 $('#oai_itm_title').val(ui.item.title);
            },
            focus: function (a, b)
            {
                return false
            }
    });
    });
  </script>
   <script>
   
    $("#oai_itm_qty,#oai_itm_stock").blur(function(){ 
     if(($("#oai_itm_qty").val() - $("#oai_itm_stock").val()) > 0)
     {
        $("#oai_itm_opn_qty").val($("#oai_itm_qty").val() - $("#oai_itm_stock").val());
     }else{
        $("#oai_itm_opn_qty").val('0');
        
     }
     
        //alert("This text box has lost its focus.");  
        return false;
    });  
  
</script>
<script type="text/javascript">
$(document).on('blur', '.oai_itm_qty,.oai_itm_price,.oai_itm_discount', function() {
        var idd = $(this).attr('id');
        //alert(idd);

        var totaldisc = ((($("#oai_itm_qty").val() * $("#oai_itm_price").val()) * $("#oai_itm_discount").val()) / 100);
        var total = (($("#oai_itm_qty").val() * $("#oai_itm_price").val()) - totaldisc);
        $("#oai_itm_ftotal").val(parseFloat(total).toFixed(2));
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
                //alert('hiii');
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
                $("#oa_cust_type").val(ui.item.ctype);
               $("#country_change").val(ui.item.country);
               $("#state_change").val(ui.item.state);
               $("#city_change").val(ui.item.city);
               $("#oa_con_person").val(ui.item.cperson);
               $("#oa_mobile").val(ui.item.cno);
               $("#oa_email").val(ui.item.email);
               $("#oa_phone").val(ui.item.phone);
               $("#oa_website").val(ui.item.webaddr);
               $('#oa_address').val(ui.item.address);
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