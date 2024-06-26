<div class="row">
    <div class="col-md-12">
        <?php echo validation_errors(); ?>
        <?php
        if (!empty($success) || $this->session->flashdata('inw_success') != '') {
            $msg = !empty($success) ? $success : $this->session->flashdata('inw_success');
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
        }
        if (!empty($error) || $this->session->flashdata('inw_error') != '') {
            $msg = !empty($error) ? $error : $this->session->flashdata('inw_error');
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
        }
        if (!empty($warning) || $this->session->flashdata('inw_warning') != '') {
            $msg = !empty($warning) ? $warning : $this->session->flashdata('inw_warning');
            echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
        }
        ?>
        <div class="space-2"></div>
    </div>
</div>
<?php 
$clsar = array('class' => 'form-horizontal');
echo form_open($action_bd,$clsar); ?>
                        <div class="row">    
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Company name</label>
                                            <div class="col-md-8">
                                               <input type="text"  class="form-control" placeholder="Company name" name="master_vendor_com_name" tabindex="1" maxlength="200" id="master_vendor_com_name" value="<?php echo isset($list[0]['master_vendor_com_name']) ? $list[0]['master_vendor_com_name'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Customer Type</label>
                                            <div class="col-md-8">
                                                <select name="master_vendor_cust_type" id="master_vendor_cust_type" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="2">
                                                    <option value="">Customer Type</option>
                                                    <?php  foreach($custometyps as $country) {?>  <option value="<?php echo $country['ctype_id'];?>" <?php if(isset($list[0]['master_vendor_cust_type']) && $list[0]['master_vendor_cust_type'] == $country['ctype_id']){ echo "selected";}?>><?php echo $country['ctype_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_namegr">
                                            <label class="control-label col-md-4">Contact Name</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="3" class="form-control" placeholder="Contact Name" name="master_vendor_contact" maxlength="70" id="master_vendor_contact" value="<?php echo isset($list[0]['master_vendor_contact']) ? $list[0]['master_vendor_contact'] : ""; ?>">
                                                <span class="help-block"> <?php echo form_error('master_vendor_contact'); ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Email Id</label>
                                            <div class="col-md-8">
                                               <input type="text" tabindex="4" class="form-control" placeholder="Email Id" name="master_vendor_email_address" maxlength="100" id="master_vendor_email_address" value="<?php echo isset($list[0]['master_vendor_email_address']) ? $list[0]['master_vendor_email_address'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Mobile No.</label>
                                            <div class="col-md-8">
                                               <input type="text" tabindex="5" class="form-control" placeholder="Mobile no" name="master_vendor_mobile_no" maxlength="100" id="master_vendor_mobile_no" value="<?php echo isset($list[0]['master_vendor_mobile_no']) ? $list[0]['master_vendor_mobile_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Office No.</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="6" class="form-control" placeholder="Contact" name="master_vendor_office_no" maxlength="200" id="master_vendor_office_no" value="<?php echo isset($list[0]['master_vendor_office_no']) ? $list[0]['master_vendor_office_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>            
                                </div>                       
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_phonegr">
                                            <label class="control-label col-md-4">Country</label>
                                            <div class="col-md-8">
                                               <select name="master_vendor_country" tabindex="9" id="master_vendor_country" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option value="">Select Country</option>
                                                    <?php foreach($countries as $country)
                                                    { ?>
                                                        <option value="<?php echo $country['country_id']; ?>" <?php if(isset($list[0]['master_vendor_country']) && ($list[0]['master_vendor_country'] == $country['country_id'])){ echo "selected='selected'";} ?>><?php echo $country['country_name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_stategr">
                                            <label class="control-label col-md-4">State</label>
                                            <div class="col-md-8">
                                                <select name="master_vendor_state" tabindex="10" class="bs-select form-control" data-live-search="true" data-size="8" id="master_vendor_state" onchange="get_area(this.value)" >
                                                    <option value="">Select State</option>
                                                    <?php foreach($states as $state)
                                                    { ?>
                                                        <option value="<?php echo $state['state_id']; ?>" <?php if(isset($list[0]['master_vendor_state']) && ($list[0]['master_vendor_state'] == $state['state_id'])){ echo "selected='selected'";} ?>><?php echo $state['state_name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_citygr">
                                            <label class="control-label col-md-4">City</label>
                                            <div class="col-md-8">
                                            <select name="master_vendor_city" tabindex="8" class="bs-select form-control" data-live-search="true" data-size="8" id="master_vendor_city" onchange="get_area(this.value)" >
                                                    <option value="">Select State</option>
                                                    <?php foreach($citys as $city)
                                                    { ?>
                                                        <option value="<?php echo $city['city_id']; ?>" <?php if(isset($list[0]['master_vendor_city']) && ($list[0]['master_vendor_city'] == $city['city_id'])){ echo "selected='selected'";} ?>><?php echo $city['city_name']; ?></option>
                                                    <?php }?>
                                                </select>                                       
                                            </div>
                                        </div>
                                    </div>                          
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Location</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="7" class="form-control" placeholder="Area" name="master_vendor_location" maxlength="70" id="master_vendor_location" value="<?php echo isset($list[0]['master_vendor_location']) ? $list[0]['master_vendor_location'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Fax no</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="11" class="form-control" placeholder="Fax No" name="master_vendor_fax_no" maxlength="100" id="master_vendor_fax_no" value="<?php echo isset($list[0]['master_vendor_fax_no']) ? $list[0]['master_vendor_fax_no'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Pin Code</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="12" class="form-control" placeholder="Pin Code" name="master_vendor_pincode" maxlength="200" id="master_vendor_pincode" value="<?php echo isset($list[0]['master_vendor_pincode']) ? $list[0]['master_vendor_pincode'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Shipping Address</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" tabindex="13" name="master_vendor_shipping_address" placeholder="Customer Address" id="master_vendor_shipping_address" rows="3"><?php echo isset($list[0]['master_vendor_shipping_address']) ? $list[0]['master_vendor_shipping_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Office Address</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" tabindex="14" name="master_vendor_office_address" placeholder="Customer Address" id="master_vendor_office_address" rows="3"><?php echo isset($list[0]['master_vendor_office_address']) ? $list[0]['master_vendor_office_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Billing Address</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" tabindex="15" name="master_vendor_billing_address" placeholder="Customer Address" id="master_vendor_billing_address" rows="3"><?php echo isset($list[0]['master_vendor_billing_address']) ? $list[0]['master_vendor_billing_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-4">Website Address</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="16" class="form-control" placeholder="Website Address" name="master_vendor_website" maxlength="200" id="master_vendor_website" value="<?php echo isset($list[0]['master_vendor_website']) ? $list[0]['master_vendor_website'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_gst_tingr">
                                            <label class="control-label col-md-4">GST.</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="17" class="form-control" name="master_vendor_gst" maxlength="50" id="master_vendor_gst" value="<?php echo isset($list[0]['master_vendor_gst']) ? $list[0]['master_vendor_gst'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>                            
                                    <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_taxgr">
                                            <label class="control-label col-md-4">Tax Category</label>
                                            <div class="col-md-8">
                                                <select name="master_vendor_tax" tabindex="18" id="master_vendor_tax" class="form-control"  required="required">
                                                    <option value="">Select Tax Category</option>
                                                    <?php foreach($tax_cats as $taxcat)
                                                    { ?>
                                                        <option value="<?php echo $taxcat['tax_cat_id']; ?>" <?php if(isset($list[0]['master_vendor_tax']) && ($list[0]['master_vendor_tax'] == $taxcat['tax_cat_id'])){ echo "selected='selected'";} ?>>
                                                            <?php
                                                                echo $taxcat['tax_cat_name']; 
                                                            ?></option>
                                                    <?php }?>                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>
                                <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Select Currency</label>
                                                        <div class="col-md-8">
                                                            <select name="master_vendor_currency" id="master_vendor_currency" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="2">
                                                                <option value="">Select Currency</option>
                                                                <?php  foreach($currencys as $currency) {?>  <option value="<?php echo $currency['currency_id'];?>" <?php if(isset($list[0]['master_vendor_currency']) && $list[0]['master_vendor_currency'] == $currency['currency_id']){ echo "selected";}?>><?php echo $currency['currency_name']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                        <div class="form-group" id="master_vendor_gst_tingr">
                                            <label class="control-label col-md-4">C/O AAVAD INSTRUMENT</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="17" class="form-control" name="master_vendor_co_ai" maxlength="50" id="master_vendor_co_ai" value="<?php echo isset($list[0]['master_vendor_co_ai']) ? $list[0]['master_vendor_co_ai'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>    
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Remark</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" tabindex="13" name="master_vendor_remark" placeholder="Remark" id="master_vendor_remark" rows="3"><?php echo isset($list[0]['master_vendor_remark']) ? $list[0]['master_vendor_remark'] : ""; ?></textarea>
                                                </div>
                                            </div>
                                    </div> 
                                </div> 
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" tabindex="36" class="btn green" onclick="return ValidateDetails()">SUBMIT</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
<?php echo form_close(); ?>