<?php //echo "<pre>";print_r($list);die; ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Product Generator Add</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>Product_generator">Product Generator List</a></li>
        <li><a href="<?php echo base_url(); ?>Product_generator/add">Product Generator Add</a></li>
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
                    <h3 class="form-section">Product Generator</h3>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Product Select</label>
                                <div class="col-md-9">
                                    <select name="product_head" id="product_head" class="form-control" required="required" autofocus="autofocus" tabindex="1">
                                        <option value="">Select Product Head</option>
                                        <?php foreach ($masters['product_heads'] as $key => $product_head) { ?>
                                            <option value="<?php echo $product_head['ph_id']; ?>" <?php if(isset($list[0]['pg_ph_id']) && ($list[0]['pg_ph_id'] == $product_head['ph_id'])){ ?> selected="selected" <?php } ?>><?php echo $product_head['ph_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Product Code</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Product Code" name="product_code" maxlength="200" id="product_code" value="<?php echo isset($list[0]['pg_ph_code']) ? $list[0]['pg_ph_code'] : ""; ?>" readonly >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Category</label>
                                <div class="col-md-9">
                                    <select name="product_category" id="product_category" class="form-control" tabindex="2">
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Category Code</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Category Code" name="category_code" maxlength="200" id="category_code" value="<?php echo isset($list[0]['pg_cat_code']) ? $list[0]['pg_cat_code'] : ""; ?>" readonly >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="col-md-12">
                                <div class="form-group" id="mcna_namegr">
                                    <label class="control-label col-md-12">Attribute</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="mcna_namegr">
                                    <label class="control-label col-md-12">Value</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="mcna_namegr">
                                    <label class="control-label col-md-12">Code</label>
                                </div>
                            </div>
                        </div>
                        <?php $tabindexi = 2; for ($i=1; $i < 10; $i++) { $tabindexi++; ?>
                            <div class="col-md-1">
                                <div class="col-md-12">
                                    <div class="form-group" id="mcna_namegr">
                                        <div class="col-md-12">
                                            <input type="text" readonly class="form-control attri_product_head" placeholder="Head" name="attri_product_head[]" maxlength="200" id="attri_product_head<?php echo $i; ?>" value="" >
                                            <input type="hidden" class="form-control product_attri_id" placeholder="Head" name="product_attri_id[]" maxlength="200" id="product_attri_id<?php echo $i; ?>" value="" >
                                            <input type="hidden" class="form-control product_attri_ref_id" placeholder="Head" name="product_attri_ref_id[]" maxlength="200" id="product_attri_ref_id<?php echo $i; ?>" value="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="mcna_namegr">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control product_value" placeholder="Value" name="product_value[]" maxlength="200" id="product_value<?php echo $i; ?>" value="" tabindex="<?php echo $tabindexi; ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="mcna_namegr">
                                        <div class="col-md-12">
                                            <input type="text" readonly class="form-control attri_product_code" placeholder="Code" name="attri_product_code[]" maxlength="200" id="attri_product_code<?php echo $i; ?>" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Final Code</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control final_code" placeholder="Value" name="final_code" maxlength="200" id="final_code" value="<?php echo isset($list[0]['pg_final_code']) ? $list[0]['pg_final_code'] : ""; ?>" readonly="readonly" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Specification</label>
                                <div class="col-md-9">
                                   <textarea class="form-control" name="pg_specification" tabindex="4" placeholder="Specification" id="pg_specification" rows="3"><?php echo isset($list[0]['pg_specification']) ? $list[0]['pg_specification'] : ""; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $tabindexi = $tabindexi + 1; ?>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green" tabindex="<?php echo $tabindexi; ?>" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
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
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
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

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function final_code_generate()
{
    var final_code = '';
    final_code += $("#product_code").val();
    final_code += $("#category_code").val();
    if($("#attri_product_code1").val() != '')
    {
        final_code += $("#attri_product_code1").val();
    }else{
        final_code += '00';
    }
    if($("#attri_product_code2").val() != '')
    {
        final_code += $("#attri_product_code2").val();
    }else{
        final_code += '00';
    }
    if($("#attri_product_code3").val() != '')
    {
        final_code += $("#attri_product_code3").val();
    }else{
        final_code += '00';
    }
    if($("#attri_product_code4").val() != '')
    {
        final_code += $("#attri_product_code4").val();
    }else{
        final_code += '00';
    }
    if($("#attri_product_code5").val() != '')
    {
        final_code += $("#attri_product_code5").val();
    }else{
        final_code += '00';
    }
    if($("#attri_product_code6").val() != '')
    {
        final_code += $("#attri_product_code6").val();
    }else{
        final_code += '00';
    }
    if($("#attri_product_code7").val() != '')
    {
        final_code += $("#attri_product_code7").val();
    }else{
        final_code += '00';
    }
    $("#final_code").val(final_code);
}

function ValidateDetails()
{
    var fields;
    fields = "";
    document.getElementById('Product_generator_name').className = 'form-control';
    $('#Product_generator_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('Product_generator_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("Product_generator_name").focus();
        }
        fields = '1';
        document.getElementById('Product_generator_name').className = 'form-control error';
        if($('#Product_generator_name').parent().parent().attr('class') == 'form-group')
        {
            $('#Product_generator_name').parent().parent().addClass('has-error');
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
$('#product_head').on('change', function() {
  //alert( this.value );
  $('#product_category').empty();
  $("#category_code").val('00');
  $("#product_code").val('00');
  $(".attri_product_code").val('00');
  $(".product_value").val('');
  $(".attri_product_head").val('');
  $(".product_attri_id").val('');
  $(".product_attri_ref_id").val('');
  var id = $(this).val();
  if(id != '' && id != undefined)
                {
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Product_generator/product_to_other_details',
                data:'id='+id,
                success: function(data) {
                    var data = jQuery.parseJSON( data );
                    console.log(data);
                    $("#product_code").val(data.product_code);
                    $("#category_code").val('00');
                    var str = '';
                    str += '<option value="">Select Category</option>';
                    jQuery.each( data.category_lists, function( i, val ) {
                      str += '<option value="'+val.cat_id+'">'+val.cat_name+'</option>';
                    });
                    $('#product_category').empty();
                    $('#product_category').append(str);
                    var inputindex = 0;
                    jQuery.each( data.attribute_lists, function( i, val ) {
                        //inputindex = parseInt(i)+1;
                        //alert(inputindex);
                      $('#attri_product_head'+val.placement_id).val(val.attrobute_name);
                      $('#product_attri_id'+val.placement_id).val(val.attributed_id);
                      $('#product_attri_ref_id'+val.placement_id).val(val.attribute_ref_id);
                      $('#attri_product_code'+val.placement_id).val('00');
                    });
                    final_code_generate();
                }
                });
            }

});

$('#product_category').on('change', function() {

    var category_code = pad($(this).val(), 2);
    //alert(category_code);
    $("#category_code").val(category_code);
    final_code_generate();
});
$(document).on('blur', '.product_value', function() {
    //alert('hiiii');
    var idd = $(this).attr('id');
    idd = idd.replace('product_value', '');
    //alert(idd);
    var product_id = $("#product_head").val();
    var attribute_id = $("#product_attri_id"+idd).val();
    var attribute_ref_id = $("#product_attri_ref_id"+idd).val();
    var attribute_value = $("#product_value"+idd).val();
    // alert(attribute_id);
    // alert(attribute_ref_id);
    // alert(attribute_value);
    var postdata = { 'attribute_id': attribute_id,'attribute_ref_id': attribute_ref_id,'attribute_value': attribute_value};
    $.ajax({
        type:'POST',
        datatype: 'JSON',
        url:'<?php echo base_url(); ?>Product_generator/attribute_to_code',
        data:postdata,
        success: function(data) {
            var data = jQuery.parseJSON( data );
            console.log(data);
            $("#attri_product_code"+idd).val(data.code);
            final_code_generate();
        }
    });

});
$(".product_value").autocomplete({
            source: function(request, response) {
                $.getJSON(base_url+"Product_generator/search_attribute_value", { attribute_value : $('#product_attri_id'+($(this.element).prop("id")).replace("product_value", "")).val(),search_val : $('#product_value'+($(this.element).prop("id")).replace("product_value", "")).val()  }, 
                          response);
              },

            //source: base_url+"Sales_enq/get_contactperson_information?id="+$('#vendor_id').val(),
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                //alert('hiii');
            },
            focus: function (a, b)
            {
                return false
            }
    });
</script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>