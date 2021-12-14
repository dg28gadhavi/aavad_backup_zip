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
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">PO No</label>
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
                                <label class="control-label col-md-3">PI No</label>
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
                            <div class="col-md-9">
                               <input type="text" tabindex="5" class="form-control vendor" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>" required="required">
                               <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
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
                                <select name="pi_country" id="country_change" tabindex="7" class="bs-select form-control country_change" data-live-search="true" data-size="8">
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
                                <select name="pi_state" id="state_change" tabindex="8" class="bs-select form-control state_change" data-live-search="true" data-size="8">
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
                                   <select name="pi_city" id="city_change" tabindex="9" class="bs-select form-control city_change" data-live-search="true" data-size="8">
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
                                <select multiple="multiple" tabindex="10" class="multi-select" id="my_multi_select1" name="pi_brand[]">
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
                                   <input type="text" tabindex="11" class="form-control" placeholder="Contact Person" name="pi_con_person" maxlength="100" id="pi_con_person" value="<?php echo isset($list[0]['pi_con_person']) ? $list[0]['pi_con_person'] : ""; ?>">
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Mobile No</label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="12" class="form-control" placeholder="Mobile No" name="pi_mobile" maxlength="200" id="pi_mobile" value="<?php echo isset($list[0]['pi_mobile']) ? $list[0]['pi_mobile'] : ""; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email Id</label>
                                <div class="col-md-9">
                                   <input type="text" tabindex="13" class="form-control" placeholder="Email Id" name="pi_email" maxlength="100" id="pi_email" value="<?php echo isset($list[0]['pi_email']) ? $list[0]['pi_email'] : ""; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Phone No</label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="14" class="form-control" placeholder="Phone No" name="pi_phone" maxlength="100" id="pi_phone" value="<?php echo isset($list[0]['pi_phone']) ? $list[0]['pi_phone'] : ""; ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="mcna_namegr">
                                    <label class="control-label col-md-3">Website Address</label>
                                    <div class="col-md-9">
                                        <input type="text" tabindex="15" class="form-control" placeholder="Website Address" name="pi_website" maxlength="200" id="pi_website" value="<?php echo isset($list[0]['pi_website']) ? $list[0]['pi_website'] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">GST No</label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="16" class="form-control" placeholder="GST No" name="pi_gst" maxlength="100" id="pi_gst" value="<?php echo isset($list[0]['pi_gst']) ? $list[0]['pi_gst'] : ""; ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display:none">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Reminder Date:</label>
                                <div class="col-md-9">
                                     <input type="text" tabindex="17" class="form-control form-control-inline input-medium date-picker" placeholder="Reminder Date" name="pi_rem_date" maxlength="200" id="pi_rem_date" value="<?php echo isset($list[0]['pi_rem_date']) ? date("d-m-Y", strtotime($list[0]['pi_rem_date'])) : ""; ?>">
                                    
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Remind before (In days):</label>
                                <div class="col-md-9">
                                      <input type="text" tabindex="18" class="form-control" placeholder="Reminder Before Days" name="pi_rem_be_date" maxlength="100" id="pi_rem_be_date" value="<?php echo isset($list[0]['pi_rem_be_date']) ? $list[0]['pi_rem_be_date'] : ""; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="modal-footer footer-button pull-left">
                <button type="submit" class="btn green" tabindex="19">Save</button>
            </div>
    </div>
</div>
<?php echo form_close(); ?>