
<?php 
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        
    <div class="row">
        <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Outward Code</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="1" class="form-control"  name="otw_no" maxlength="200" id="otw_no" value="<?php echo !$this->uri->segment(3) && isset($sr_no) ? $sr_no : ''; ?><?php echo isset($list[0]['sales_return_code']) ? $list[0]['sales_return_code'] : ""; ?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Customer</label>
                                                <div class="col-md-9">
                                                   <input type="text" tabindex="2" class="form-control otw_customer_name" placeholder="Customer" name="otw_customer_name" maxlength="100" id="otw_customer_name" value="<?php echo isset($list[0]['sales_return_master_party']) ? $list[0]['sales_return_master_party'] : ""; ?>">
                                                    <input type="hidden" tabindex="2" class="form-control sales_return_master_party_id" placeholder="Customer" name="sales_return_master_party_id" maxlength="100" id="sales_return_master_party_id" value="<?php echo isset($list[0]['sales_return_master_party_id']) ? $list[0]['sales_return_master_party_id'] : ""; ?>">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                               <div class="row">                                        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Bill No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control" placeholder="Bill No" name="sales_return_bill_no" maxlength="100" id="sales_return_bill_no" value="<?php echo isset($list[0]['sales_return_bill_no']) ? $list[0]['sales_return_bill_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Bill Date</label>
                                                <div class="col-md-9">
                                                   <input type="text" tabindex="4" class="form-control form-control-inline input-medium date-picker" placeholder="Bill Date" name="sales_return_bill_date" maxlength="200" id="sales_return_bill_date" value="<?php echo isset($list[0]['sales_return_bill_date']) ? date("d-m-Y", strtotime($list[0]['sales_return_bill_date'])) : ""; ?>">
                                                </div>
                                            </div>
                                    </div>
                                </div>       
                                                                 
                               
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Challan No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="5" class="form-control" placeholder="Challan No" name="sales_return_challan_no" maxlength="200" id="sales_return_challan_no" value="<?php echo isset($list[0]['sales_return_challan_no']) ? $list[0]['sales_return_challan_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Challan Date</label>
                                            <div class="col-md-9">
                                                  <input type="text" tabindex="6" class="form-control form-control-inline input-medium date-picker" placeholder="Challan Date" name="sales_return_challan_date" maxlength="200" id="sales_return_challan_date" value="<?php echo isset($list[0]['sales_return_challan_date']) ? date("d-m-Y", strtotime($list[0]['sales_return_challan_date'])) : ""; ?>">                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                                <div class="row">                                    
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">LR No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="7" class="form-control" placeholder="LR No" name="sales_return_lr_no" maxlength="200" id="sales_return_lr_no" value="<?php echo isset($list[0]['sales_return_lr_no']) ? $list[0]['sales_return_lr_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">LR Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="8" class="form-control form-control-inline input-medium date-picker" placeholder="LR Date" name="sales_return_lr_date" maxlength="200" id="sales_return_lr_date" value="<?php echo isset($list[0]['sales_return_lr_date']) ? date("d-m-Y", strtotime($list[0]['sales_return_lr_date'])) : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">                                    
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">INSP No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="9" class="form-control" placeholder="INSP No" name="sales_return_insp_no" maxlength="200" id="sales_return_insp_no" value="<?php echo isset($list[0]['sales_return_insp_no']) ? $list[0]['sales_return_insp_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">INSP Date</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="10" class="form-control form-control-inline input-medium date-picker" placeholder="INSP Date" name="sales_return_insp_date" maxlength="200" id="sales_return_insp_date" value="<?php echo isset($list[0]['sales_return_insp_date']) ? date("d-m-Y", strtotime($list[0]['sales_return_insp_date'])) : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>        
                                <div class="row">                                    
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Transporter Name</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="11" class="form-control" placeholder="Transporter Name" name="sales_return_transporter_name" maxlength="200" id="sales_return_transporter_name" value="<?php echo isset($list[0]['sales_return_transporter_name']) ? $list[0]['sales_return_transporter_name'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Material Return</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="12" class="form-control" placeholder="Transporter Name" name="sales_return_materail_return" maxlength="200" id="sales_return_materail_return" value="<?php echo isset($list[0]['sales_return_materail_return']) ? $list[0]['sales_return_materail_return'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                     
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Remark</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" tabindex="13" name="sales_return_remarks" placeholder="Remark" id="sales_return_remarks" rows="3"><?php echo isset($list[0]['sales_return_remarks']) ? $list[0]['sales_return_remarks'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
    </div>                          

<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" />
</div>
<?php echo form_close(); ?> 
 
<!-- END PAGE LEVEL SCRIPTS -->
<!-- START add more SCRIPTS -->


<!-- END add more SCRIPTS -->