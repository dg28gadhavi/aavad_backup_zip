<?php //echo '<pre>'; print_r($products); die;?>
<?php //echo '<pre>'; print_r($producttypes); die;?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>product category Add</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Product_cat">product category List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Product_cat/add">product category Add</a>
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
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open($action,$atr); ?>
                            <div class="form-body">
                                <h3 class="form-section">product category</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">product category</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="product category" name="procat_name" maxlength="200" id="procat_name" value="<?php echo isset($list[0]['procat_name']) ? $list[0]['procat_name'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Product Name</label>
                                            <div class="col-md-9">
                                                <select name="product_name" id="product_name" class="bs-select form-control" data-live-search="true" data-size="8" onchange="product_type(this)">
                                                	<option value="">Select product</option>
                                                    <?php foreach ($products as $product) { ?>
                                                	<option value="<?php echo $product['pro_id']; ?>" <?php if(isset($list[0]['product_name']) && ($list[0]['product_name'] == $product['pro_id'])){ ?> selected="selected" <?php } ?> ><?php echo $product['pro_name']; ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Product Type</label>
                                            <div class="col-md-9">
                                                <select name="ptype_id" id="ptype_id" class="bs-select form-control" data-live-search="true" data-size="8">
                                                	<option value="">Product Type</option>
                                                <?php foreach ($productypes as $protype) { ?>
                                                	<option value="<?php echo $protype['prot_id']; ?>" <?php if(isset($list[0]['ptype_id']) && ($list[0]['ptype_id'] == $protype['prot_id'])){ ?> selected="selected" <?php } ?> ><?php echo $protype['prot_name']; ?></option>
                                                <?php } ?>
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
    document.getElementById('procat_name').className = 'form-control';
    $('#procat_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('procat_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("procat_name").focus();
        }
        fields = '1';
        document.getElementById('procat_name').className = 'form-control error';
        if($('#procat_name').parent().parent().attr('class') == 'form-group')
        {
            $('#procat_name').parent().parent().addClass('has-error');
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

<script type="text/javascript">
function product_type(i)
{
	//alert(i.value);
	 
	var data = { 'id': i.value};
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>Product_cat/product_getype",
		data: data,
		dataType:"json",
		  success: function(json)
		  {
			 var data = "";
			 for(var i = 0; i < json.productypelists.length; i++)
			 {
			 	data += '<option value="' + json.productypelists[i].prot_id + '">' + json.productypelists[i].prot_name + '</option>';
			 }
			 $('#ptype_id').empty();
			 $('#ptype_id').append(data);
		  },
		  error: function( error )
		 {
			 alert( error );
		 }
		});
}
</script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>