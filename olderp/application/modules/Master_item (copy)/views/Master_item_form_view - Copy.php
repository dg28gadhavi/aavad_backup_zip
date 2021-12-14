<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Master Item Add</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Master_item">Master Item List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Master_item/add">Master Item Add</a>
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
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Item Code</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Item Code" maxlength="20"   name="master_item_code" id="master_item_code" value="<?php echo isset($list[0]['master_item_code']) ? $list[0]['master_item_code'] : '';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Item Name</label>
                                            <div class="col-md-9">
                                               <input type="text" class="form-control" placeholder="Item Name" name="master_item_name" maxlength="200" id="master_item_name" value="<?php echo isset($list[0]['master_item_name']) ? $list[0]['master_item_name'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">HSN Code</label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control" placeholder="HSN Code" name="master_item_hsncode" maxlength="200" id="master_item_name" value="<?php echo isset($list[0]['master_item_hsncode']) ? $list[0]['master_item_hsncode'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Item Short Description</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" placeholder="Item Description" name="master_item_description" id="master_item_description" rows="5" ><?php echo isset($list[0]['master_item_description']) ? $list[0]['master_item_description'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Location</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="master_item_location" name="master_item_location" value="<?php echo isset($list[0]['master_item_location']) ? $list[0]['master_item_location'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Current Stock</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="master_item_stock" name="master_item_stock" value="<?php echo isset($list[0]['master_item_stock']) ? $list[0]['master_item_stock'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="col-md-10">Item Long Description</label>
                                            <div class="col-md-10">
                                                <textarea class="wysihtml5 form-control" placeholder="Item Description" name="master_item_ldescription" id="master_item_ldescription" rows="5" ><?php echo isset($list[0]['master_item_ldescription']) ? $list[0]['master_item_ldescription'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Item Make</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="master_item_make" id="master_item_make">
                                     <?php  foreach($vendors as $vendor) {?>
                                                            <option value="<?php echo $vendor['master_party_id'];?>" <?php if(isset($list[0]['master_item_make']) && $list[0]['master_item_make'] == $vendor['master_party_id']){ echo "selected";}?>><?php echo $vendor['master_party_name'];?></option>
                                     <?php } ?>                       
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Item Unit</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="master_item_unit" id="master_item_unit">
                                     <?php  foreach($units as $unit) {?>
                                                            <option value="<?php echo $unit['master_item_unit_id'];?>" <?php if(isset($list[0]['master_item_unit']) && $list[0]['master_item_unit'] == $unit['master_item_unit_id']){ echo "selected";}?>><?php echo $unit['master_item_unit_name'];?></option>
                                     <?php } ?>                       
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                     <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_namegr">
                                                    <label class="control-label col-md-3">Item Partno</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" placeholder="Item partno" maxlength="20" name="master_item_pno" id="master_item_pno" value="<?php echo isset($list[0]['master_item_pno']) ? $list[0]['master_item_pno'] : ''; ?>" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                           <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_namegr">
                                                    <label class="control-label col-md-3">Item Price</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="Rate" maxlength="20"   name="master_item_rate" id="master_item_rate" value="<?php echo isset($list[0]['master_item_rate']) ? $list[0]['master_item_rate'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="master_party_namegr">
                                                            <label class="control-label col-md-3">Tags</label>                                            <div class="col-md-9">
                                                            <input type="text" value="<?php echo isset($list[0]['master_item_tags']) ? $list[0]['master_item_tags'] : ''; ?>" name="master_item_tags" data-role="tagsinput"> 
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" id="master_party_namegr">
                                                    <label class="control-label col-md-3">Item Image</label>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="<?php if(isset($list[0]['master_item_img']) && ($list[0]['master_item_img'] != '')) {?><?php echo base_url();?>uploads/master_item_img/150x150/<?php echo $list[0]['master_item_img']; ?><?php } else{ ?>http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image<?php } ?>" alt=""> </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                    <div>
                                                        <span class="btn default btn-file">
                                                            <span class="fileinput-new"> Select image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                           <input type="file"  name="master_item_img"  />
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                     <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Item Weight</label>
                                            <div class="col-md-9">
                                               <input type="text" class="form-control" placeholder="Item Weight" name="master_item_weight" maxlength="200" id="master_item_weight" value="<?php echo isset($list[0]['master_item_weight']) ? $list[0]['master_item_weight'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Item Dimension</label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control" placeholder="Item Dimension" name="master_item_dimension" maxlength="200" id="master_item_dimension" value="<?php echo isset($list[0]['master_item_dimension']) ? $list[0]['master_item_dimension'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                     <?php //**************************** Add Part Start ************************ ?>
                                <?php if(!$this->input->get('id') && ($this->uri->segment(3) != 'edit')){ ?>
                                <div class="taxtypeall">
                                    <?php foreach($taxcats as $taxcat){ ?>
                                        <div class="taxtype<?php echo $taxcat['tax_cat_id']; ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="form-section"><?php echo $taxcat['tax_cat_name'];?> Tax</h3>
                                            </div>
                                            <?php $x = 0; foreach($taxes as $tax){ 
                                                if(isset($tax['master_party_tax']) && isset($taxcat['tax_cat_id']) && ($tax['master_party_tax'] == $taxcat['tax_cat_id'])){ $x++; ?>
                                            <div class="form-group" id="master_party_namegr">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                             <div class="col-md-4">
                                                                <input class="form-control" type="text" id="charge_taxn<?php echo $x; ?>" name="charge_taxn[<?php echo $taxcat['tax_cat_id']; ?>][<?php echo $tax['tax_id']; ?>]" value="<?php echo $tax['tax_name']; ?>"/>
                                                             </div>
                                                             <div class="col-md-4">
                                                                <input class="form-control" type="text" id="charge_taxamt<?php echo $x; ?>" name="charge_taxamt[<?php echo $taxcat['tax_cat_id']; ?>][<?php echo $tax['tax_id']; ?>]" value="<?php echo $tax['tax_amount']; ?>"/>
                                                             </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                            
                                        </div>
                                        </div>
                                      <?php } ?>
                                 </div>
                                <?php } ?>
                                <?php //**************************** Add Part End ************************ ?>
                                <?php //**************************** Edit Part Start ************************ ?>
                                <?php if($this->input->get('id') && ($this->uri->segment(3) == 'edit')){ ?>
                                    <?php //echo '<pre>';print_r($tax_datas);die; ?>
                                    <div class="taxtypeall">
                                    <?php foreach($tax_datas as $taxcats){ ?>
                                        <div class="taxtype<?php echo $taxcats['tax_cat_id']; ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="form-section"><?php echo $taxcats['tax_cat_name'];?> Tax</h3>
                                            </div>
                                            <?php $x = 0; foreach($taxcats['tax_details'] as $taxname){ $x++; ?>
                                            <div class="form-group" id="master_party_namegr">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                             <div class="col-md-4">
                                                                <input class="form-control" type="text" id="charge_taxn<?php echo $x; ?>" name="charge_taxn[<?php echo $taxcats['tax_cat_id']; ?>][<?php echo $taxname['mit_tax_id']; ?>]" value="<?php echo $taxname['mit_name']; ?>"/>
                                                             </div>
                                                             <div class="col-md-4">
                                                                <input class="form-control" type="text" id="charge_taxamt<?php echo $x; ?>" name="charge_taxamt[<?php echo $taxcats['tax_cat_id']; ?>][<?php echo $taxname['mit_tax_id']; ?>]" value="<?php echo $taxname['mit_value']; ?>"/>
                                                             </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }  ?>
                                            
                                        </div>
                                        </div>
                                      <?php } ?>
                                 </div>
                                <?php } ?>
                              
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
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
         <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/ecommerce-products-edit.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            var UITree = function () {

    var handleSample2 = function () {
        $('#tree_2').jstree({
            'plugins': ["wholerow", "checkbox", "types"],
            'core': {
                "themes" : {
                    "responsive": false
                },    
                'data': [{
                        "text": "Same but with checkboxes",
                        "children": [{
                            "text": "initially selected",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "custom icon",
                            "icon": "fa fa-warning icon-state-danger"
                        }, {
                            "text": "initially open",
                            "icon" : "fa fa-folder icon-state-default",
                            "state": {
                                "opened": true
                            },
                            "children": ["Another node"]
                        }, {
                            "text": "custom icon",
                            "icon": "fa fa-warning icon-state-warning"
                        }, {
                            "text": "disabled node",
                            "icon": "fa fa-check icon-state-success",
                            "state": {
                                "disabled": true
                            }
                        }]
                    },
                    "And wholerow selection"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });
    }


    return {
        //main function to initiate the module
        init: function () {

            //handleSample1();
            handleSample2();
            //contextualMenuSample();
            //ajaxTreeSample();

        }

    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {    
       UITree.init();
    });
}
        </script>
                <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-tagsinput.min.js" type="text/javascript"></script>
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

//master_item_selcatp
<?php if($this->input->get('id') && isset($list[0]['master_item_cats']) && ($list[0]['master_item_cats'] != '')){ ?>
    var catselectp = '<?php echo $list[0]['master_item_cats'];  ?>';
    $('#master_item_selcatp').val(catselectp);
<?php }?>
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
    document.getElementById('master_item_name').className = 'form-control';
    $('#master_item_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('master_item_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("master_item_name").focus();
        }
        fields = '1';
        document.getElementById('master_item_name').className = 'form-control error';
        if($('#master_item_name').parent().parent().attr('class') == 'form-group')
        {
            $('#master_item_name').parent().parent().addClass('has-error');
        }
        //return false;
    }

    $('input[name^="grade"]').each(function() {
        if($(this).val() == '')
        {
            fields = '1';
            if($(this).parent().parent().attr('class') == 'form-group')
            {
                $(this).parent().parent().addClass('has-error');
            }
        }else{
            $(this).parent().parent().removeClass('has-error');
        }
    });

    $('select[name^="itmmake"]').each(function() {
        if($(this).val() == '')
        {
            fields = '1';
            if($(this).parent().parent().attr('class') == 'form-group')
            {
                $(this).parent().parent().addClass('has-error');
            }
        }else{
            $(this).parent().parent().removeClass('has-error');
        }
    });
    
    
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        
        return false;
    }
    else {
        return true;
    }
    
}
</script>
<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
$(function() {
    //alert('hiii');
    $("#customer_save").click(function(){
        //alert($("#master_party_ajax").serialize());
        $.ajax({
            url: base_url+'admin/master_party/add_ajax',
            dataType: 'json',
            type: 'post',
            data: $("#master_party_ajax").serialize(),
            success: function( data, textStatus, jQxhr ){
                //alert( JSON.stringify( data ) );
//              show_error_party
                if(data.status == 'success')
                {
                    var fresult = jQuery.parseJSON(data.result);
                    //alert(fresult.master_party_id);
                    var ser = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'+data.msg+'</div>';
                    $('#show_error_party').html('');
                    $('#show_error_party').html(ser);
                    $('#master_item_make').append($('<option>', {
                            value: fresult.master_party_id,
                            text: fresult.master_party_name
                        }));
                        //).append('<option value=1>My option</option>').selectmenu('refresh');
                    $('#master_item_make').val(fresult.master_party_id);
                    $('.bs-select').selectpicker('refresh');
                }else if(data.status == 'error')
                {
                    //alert('error');
                    var ser = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'+data.msg+'</div>';
                    $('#show_error_party').html('');
                    $('#show_error_party').html(ser);
                }
                $('#customer_add').modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                alert('hiiiiiii error');
                console.log( errorThrown );
            }
        });
    });
        
        $("#itemunit_save").click(function(){
        alert($("#master_itemunit_ajax").serialize());
        $.ajax({
            url: base_url+'admin/master_item_unit/add_ajax',
            dataType: 'json',
            type: 'post',
            data: $("#master_itemunit_ajax").serialize(),
            success: function( data, textStatus, jQxhr ){
                //alert( JSON.stringify( data ) );
//              show_error_party
                if(data.status == 'success')
                {
                    var fresult = jQuery.parseJSON(data.result);
                    //alert(fresult.master_item_unit_name);
                    var ser = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'+data.msg+'</div>';
                    $('#show_error_itemunit').html('');
                    $('#show_error_itemunit').html(ser);
                    $('#master_item_unit').append($('<option>', {
                            value: fresult.master_item_unit_id,
                            text: fresult.master_item_unit_name
                        }));
                        //).append('<option value=1>My option</option>').selectmenu('refresh');
                    $('#master_item_unit').val(fresult.master_item_unit_id);
                    $('.bs-select').selectpicker('refresh');
                }else if(data.status == 'error')
                {
                    //alert('error');
                    var ser = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'+data.msg+'</div>';
                    $('#show_error_itemunit').html('');
                    $('#show_error_itemunit').html(ser);
                }
                $('#itemunit_add').modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                var ser = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>Something Went Wrong</div>';
                $('#itemunit_add').modal('hide');
                console.log( errorThrown );
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.bs-select').selectpicker('refresh');
});
</script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>