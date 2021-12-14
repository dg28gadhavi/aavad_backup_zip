<?php 
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<!-- <h4>Some Input</h4> -->        
    <div class="row">
        <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">PO No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="1" class="form-control"  name="po_no" maxlength="200" id="po_no" value="<?php echo !$this->uri->segment(3) && isset($po_no) ? $po_no : ''; ?><?php echo isset($list[0]['po_no']) ? $list[0]['po_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">PO Code</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="2" class="form-control" placeholder="PO Code" name="po_code" maxlength="100" id="po_code" value="<?php echo isset($list[0]['po_code']) ? $list[0]['po_code'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">PO Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="PO Date" name="po_date" maxlength="200" id="po_date" value="<?php echo isset($list[0]['po_date']) ? date("d-m-Y", strtotime($list[0]['po_date'])) : date('d-m-Y'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Supplier</label>
                                                <div class="col-md-9">
                                                    <input type="text" tabindex="2" class="form-control po_supplier" placeholder="Customer Name" name="po_supplier" maxlength="100" id="po_supplier" value="<?php echo isset($list[0]['po_supplier']) ? $list[0]['po_supplier'] : ""; ?>" required="required">
                                                </div>
                                            </div>

                                    </div>

                                        
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Made By :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="po_madeby" tabindex="18" id="po_madeby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Made By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['po_madeby']) && $list[0]['po_madeby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Contact No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Contact No." name="po_contactno" maxlength="100" id="po_contactno" value="<?php echo isset($list[0]['po_contactno']) ? $list[0]['po_contactno'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Wo No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Wo No." name="po_wono" maxlength="100" id="po_wono" value="<?php echo isset($list[0]['po_wono']) ? $list[0]['po_wono'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Reference No : </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Reference No : " name="po_refno" maxlength="100" id="po_refno" value="<?php echo isset($list[0]['po_refno']) ? $list[0]['po_refno'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode Of Delivary : </label>
                                            <div class="col-md-9">
                                                <select name="po_mode_delivary" id="po_mode_delivary" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
                                                     <option value="0">Select Currency</option>
                                                    <?php foreach($delivary as $deli)
                                                    { ?>
                                                            <option value="<?php echo $deli['mode_delivery_id']; ?>" <?php if(isset($list[0]['po_mode_delivary']) && $list[0]['po_mode_delivary'] == $deli['mode_delivery_id']){ echo "selected";} ?>> <?php echo $deli['mode_delivery_name']; ?>
                                                            </option>                                                    
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Place Of Delivary : </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Place Of Delivary : " name="po_place_delivary" maxlength="100" id="po_place_delivary" value="<?php echo isset($list[0]['po_place_delivary']) ? $list[0]['po_place_delivary'] : ""; ?>" required="required">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode of PO : </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Mode of PO : " name="po_mode" maxlength="100" id="po_mode" value="<?php echo isset($list[0]['po_mode']) ? $list[0]['po_mode'] : ""; ?>" required="required">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Remark</label>
                                                    <div class="col-md-9">
                                                    <textarea class="form-control" tabindex="3" name="po_remark" placeholder="Remark" id="po_remark" rows="3"><?php echo isset($list[0]['po_remark']) ? $list[0]['po_remark'] : ""; ?></textarea>
                                                    </div>
                                                </div>
                                       
                                    </div>
                                </div>
                                        
                                <div class="row">
                                    <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Select Currency</label>
                                                    <div class="col-md-9">
                                                        <select name="po_currency" id="po_currency" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
                                                     <option value="0">Select Currency</option>
                                                    <?php foreach($currency as $curre)
                                                    { ?>
                                                   
                                                            <option value="<?php echo $curre['curr_id']; ?>" <?php if(isset($list[0]['po_currency']) && $list[0]['po_currency'] == $curre['curr_id']){ echo "selected";} ?>> <?php echo $curre['curr_name']; ?>
                                                            </option>                                                    
                                                    <?php }?>
                                                        
                                                </select>
                                                    </div>
                                                </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">GST No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="GST No." name="po_gstno" maxlength="200" id="po_gstno" value="<?php echo isset($list[0]['po_gstno']) ? $list[0]['po_gstno'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Insurance</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Insurance" name="po_insurance" maxlength="200" id="po_insurance" value="<?php echo isset($list[0]['po_insurance']) ? $list[0]['po_insurance'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">P F </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="P F " name="po_pf" maxlength="200" id="po_pf" value="<?php echo isset($list[0]['po_pf']) ? $list[0]['po_pf'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Fright </label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Fright " name="po_fright" maxlength="200" id="po_fright" value="<?php echo isset($list[0]['po_fright']) ? $list[0]['po_fright'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">F.O.R</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="F.O.R" name="po_for" maxlength="200" id="po_for" value="<?php echo isset($list[0]['po_for']) ? $list[0]['po_for'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Discount</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Discount" name="po_discount" maxlength="200" id="po_discount" value="<?php echo isset($list[0]['po_discount']) ? $list[0]['po_discount'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Payment Terms</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="Payment Terms" name="po_paymentterms" maxlength="200" id="po_paymentterms" value="<?php echo isset($list[0]['po_paymentterms']) ? $list[0]['po_paymentterms'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
    </div>                          

<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
    <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="5" />
</div>
<?php echo form_close(); ?>  
<!-- END PAGE LEVEL SCRIPTS -->