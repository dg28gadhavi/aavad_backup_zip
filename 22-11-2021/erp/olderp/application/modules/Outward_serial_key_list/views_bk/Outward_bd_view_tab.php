
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
                                               <input type="text" tabindex="1" class="form-control"  name="otw_no" maxlength="200" id="otw_no" value="<?php echo !$this->uri->segment(3) && isset($otw_no) ? $otw_no : ''; ?><?php echo isset($list[0]['otw_no']) ? $list[0]['otw_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Customer</label>
                                                <div class="col-md-9">
                                                   <input type="text" tabindex="2" class="form-control" placeholder="Customer" name="otw_customer_name" maxlength="100" id="otw_customer_name" value="<?php echo isset($list[0]['otw_customer_name']) ? $list[0]['otw_customer_name'] : ""; ?>">
                                                </div>
                                            </div>

                                        </div>
                                </div>
                                <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Invoice No</label>
                                                <div class="col-md-9">
                                                   <input type="text" tabindex="3" class="form-control" placeholder="Invoice No" name="otw_invoice_no" maxlength="100" id="otw_invoice_no" value="<?php echo isset($list[0]['otw_invoice_no']) ? $list[0]['otw_invoice_no'] : ""; ?>">
                                                </div>
                                            </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Work Order No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="4" class="form-control" placeholder="Work Order No" name="otw_work_ord_no" maxlength="200" id="otw_work_ord_no" value="<?php echo isset($list[0]['otw_work_ord_no']) ? $list[0]['otw_work_ord_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                       
                                  </div>
                                        
                                <div class="row">
                                    
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Delivery Challan No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="5" class="form-control" placeholder="Delivery Challan No" name="otw_challan_no" maxlength="200" id="otw_challan_no" value="<?php echo isset($list[0]['otw_challan_no']) ? $list[0]['otw_challan_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Delivery Challan Date</label>
                                            <div class="col-md-9">
                                                  <input type="text" tabindex="6" class="form-control form-control-inline input-medium date-picker" placeholder="Delivery Challan Date" name="otw_challan_date" maxlength="200" id="otw_challan_date" value="<?php echo isset($list[0]['otw_challan_date']) ? date("d-m-Y", strtotime($list[0]['otw_challan_date'])) : ""; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>     
                                <div class="row">
                                    <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Remark</label>
                                                    <div class="col-md-9">
                                                    <textarea class="form-control" tabindex="7" name="otw_remark" placeholder="Remark" id="otw_remark" rows="3"><?php echo isset($list[0]['otw_remark']) ? $list[0]['otw_remark'] : ""; ?></textarea>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">After Return</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="8" class="form-control" placeholder="After Return" name="otw_after_return" maxlength="200" id="otw_after_return" value="<?php echo isset($list[0]['otw_after_return']) ? $list[0]['otw_after_return'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Completed</label>
                                                    <div class="col-md-9">
                                                         <select class="form-control" tabindex="9" name="otw_completed" id="otw_completed">
                                                              <option value="0">No</option>
                                                              <option value="1" <?php echo isset($list[0]['otw_completed']) && ($list[0]['otw_completed'] == '1') ? "selected" : ""; ?>>Yes</option>
                                                         </select> 
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