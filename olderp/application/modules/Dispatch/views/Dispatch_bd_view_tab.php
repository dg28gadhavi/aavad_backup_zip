
<?php 
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<!-- <h4>Some Input</h4> -->        
    <div class="row">
        <div class="col-md-6">
            <div class="form-group" id="mcna_namegr">
                <label class="control-label col-md-3">O/W Code</label>
                <div class="col-md-9">
                   <input type="text" tabindex="1" class="form-control"  name="dis_no" maxlength="200" id="dis_no " value="<?php echo !$this->uri->segment(3) && isset($dis_no) ? $dis_no : ''; ?><?php echo isset($list[0]['dis_no']) ? $list[0]['dis_no'] : ""; ?>" autofocus>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Party Name</label>
                        <div class="col-md-9">
                           <input type="text" tabindex="2" class="form-control vendor" placeholder="Party Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['dis_vendor']) ? $list[0]['dis_vendor'] : ""; ?>" required="required">
                        </div>
                        
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">M/s:</label>
                        <div class="col-md-9">
                           <input type="text" tabindex="3" class="form-control" placeholder="M/s" name="dis_party_name" maxlength="100" id="dis_party_name" value="<?php echo isset($list[0]['dis_party_name']) ? $list[0]['dis_party_name'] : ""; ?>">
                        </div>
                    </div>
              </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Customer Name</label>
                    <div class="col-md-9">
                       <input type="text" tabindex="4" class="form-control" placeholder="Customer Name" name="dis_cust_name" maxlength="100" id="dis_cust_name" value="<?php echo isset($list[0]['dis_cust_name']) ? $list[0]['dis_cust_name'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Customer Address</label>
                    <div class="col-md-9">
                    <textarea class="form-control" tabindex="5" name="dis_cust_address" placeholder="Customer Address" id="dis_cust_address" rows="3"><?php echo isset($list[0]['dis_cust_address']) ? $list[0]['dis_cust_address'] : ""; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">                                    
              <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">PO No</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="6" class="form-control" placeholder="Po No" name="dis_po_no" maxlength="200" id="dis_po_no" value="<?php echo isset($list[0]['dis_po_no']) ? $list[0]['dis_po_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">PO Date</label>
                    <div class="col-md-9">
                         <input type="text" tabindex="7" class="form-control form-control-inline input-medium date-picker" placeholder="Po Date" name="dis_po_date" maxlength="200" id="dis_po_date" value="<?php if($list[0]['dis_po_date'] == "1970-01-01"){ echo ""; }else{ echo isset($list[0]['dis_po_date']) ? date("d-m-Y", strtotime($list[0]['dis_po_date'])) : ""; } ?>">                        
                    </div>
                </div>
            </div>
        </div>       
        <div class="row">                                    
              <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Docket No</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="8" class="form-control" placeholder="Docket No" name="dis_docket_no" maxlength="200" id="dis_docket_no" value="<?php echo isset($list[0]['dis_docket_no']) ? $list[0]['dis_docket_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Date</label>
                    <div class="col-md-9">
                         <input type="text" tabindex="9" class="form-control form-control-inline input-medium date-picker" placeholder="Date" name="dis_docket_date" maxlength="200" id="dis_docket_date" value="<?php if($list[0]['dis_docket_date'] == "1970-01-01"){ echo ""; } elseif($list[0]['dis_docket_date'] == "0000-00-00"){ echo ""; }else{ echo isset($list[0]['dis_docket_date']) ? date("d-m-Y", strtotime($list[0]['dis_docket_date'])) : ""; } ?>">                        
                    </div>
                </div>
            </div>
        </div>                                     
        <div class="row">
            <div class="col-md-6" style="display: none;">
                <div class="form-group">
                    <label class="control-label col-md-3">W/O Number / Job Card No.</label>
                    <div class="col-md-9">
                       <input type="text" tabindex="10" class="form-control" placeholder="W/O Number / Job Card No." name="dis_job_cno" maxlength="100" id="dis_job_cno" value="<?php echo isset($list[0]['dis_job_cno']) ? $list[0]['dis_job_cno'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Courier Name</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="11" class="form-control" placeholder="Courier Name" name="dis_courier_name" maxlength="100" id="dis_courier_name" value="<?php echo isset($list[0]['dis_courier_name']) ? $list[0]['dis_courier_name'] : ""; ?>" >
                    </div>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Courier Type</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="12" class="form-control" placeholder="Courier Type" name="dis_courier_type" maxlength="100" id="dis_courier_type" value="<?php echo isset($list[0]['dis_courier_type']) ? $list[0]['dis_courier_type'] : ""; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Customer Email</label>
                    <div class="col-md-9">
                       <input type="text" tabindex="4" class="form-control" placeholder="Customer Email" name="dis_cust_email" maxlength="100" id="dis_cust_email" value="<?php echo isset($list[0]['dis_cust_email']) ? $list[0]['dis_cust_email'] : ""; ?>">
                    </div>
                </div>
            </div>
            
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Remark</label>
                    <div class="col-md-9">
                    <textarea class="form-control" tabindex="13" name="dis_remark" placeholder="Remark" id="dis_remark" rows="3"><?php echo isset($list[0]['dis_remark']) ? $list[0]['dis_remark'] : ""; ?></textarea>
                    </div>
                </div>
            </div>
        </div>                              

<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
    <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="14" />
</div>
<?php echo form_close(); ?>  
<!-- END PAGE LEVEL SCRIPTS -->