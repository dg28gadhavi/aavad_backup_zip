<?php 
$clsar = array('class' => 'form-horizontal');
echo form_open($action_othr,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        
                                <div class="row" style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Inquiry By :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="sq_end_st" id="sq_end_st" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Inquiry By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sq_end_st']) && $list[0]['sq_end_st'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode of Inquiry :</label>
                                            <div class="col-md-9">
                                                <select name="sq_mode_inq" id="sq_mode_inq" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Mode of Inquiry</option>
 <?php  foreach($modeinquries as $modeinqurie) {?>  <option value="<?php echo $modeinqurie['mode_inquiry_id'];?>" <?php if(isset($list[0]['sq_mode_inq']) && $list[0]['sq_mode_inq'] == $modeinqurie['mode_inquiry_id']){ echo "selected";}?>><?php echo $modeinqurie['mode_inquiry_name']; ?></option>
                                                  <?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row"  style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_taxgr">
                                            <label class="control-label col-md-3">Source category</label>
                                            <div class="col-md-9">
                                                <select name="sq_source_cat" id="sq_source_cat" class="form-control"  onchange="sub_cat(this)">
                                                    <?php foreach($sources as $source)
                                                    { ?>
                                                    <option value="0">Select Source category</option>
                                                            <option value="<?php echo $source['source_cat_id']; ?>" <?php if(isset($list[0]['sq_source_cat']) && $list[0]['sq_source_cat'] == $source['source_cat_id']){ echo "selected";} ?>> <?php echo $source['source_cat_name']; ?>
                                                            </option>                                                    
                                                    <?php }?>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Sub Source category</label>
                                            <div class="col-md-9">
                                            <select name="sq_subsource_cat" id="sq_subsource_cat" class="form-control">
                                                <option value="0">Select sub category</option>
                                                  <?php  foreach($subsources as $subsource) {?>  
                                                  <option value="<?php echo $subsource['source_cat_id'];?>" <?php if(isset($list[0]['sq_subsource_cat']) && $list[0]['sq_subsource_cat'] == $subsource['source_cat_id']){ echo "selected";}?>><?php echo $subsource['source_cat_name']; ?></option>
                                                  <?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row"  style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Status :</label>
                                            <div class="col-md-9">
                                                 <select name="sq_inq_sts" id="sq_inq_sts" class="form-control">
                                                <option value="0">Select Status</option>
                                                  <option value="1" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 1){ echo "selected";}?>>Active</option>
                                                  <option value="2" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 2){ echo "selected";}?>>Pending</option>
                                                  <option value="3" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 3){ echo "selected";}?>>Completed</option>
                                                </select>
                                           </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Priority :</label>
                                            <div class="col-md-9">
                                                <select name="sq_inq_priority" id="sq_inq_priority" class="form-control">
                                                <option value="0">Select Priority</option>
                                                  <option value="1" <?php if(isset($list[0]['sq_inq_priority']) && $list[0]['sq_inq_priority'] == 1){ echo "selected";}?>>High</option>
                                                  <option value="2" <?php if(isset($list[0]['sq_inq_priority']) && $list[0]['sq_inq_priority'] == 2){ echo "selected";}?>>Low</option>
                                                  <option value="3" <?php if(isset($list[0]['sq_inq_priority']) && $list[0]['sq_inq_priority'] == 3){ echo "selected";}?>>Medium</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row"  style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Referred By</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Referred By" name="sq_ref_by" maxlength="200" id="sq_ref_by" value="<?php echo isset($list[0]['sq_ref_by']) ? $list[0]['sq_ref_by'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="row" style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Remark</label>
                                            <div class="col-md-9">
                                             <textarea class="form-control" placeholder="Remark" name="sq_remarks" id="sq_remarks" rows="3"><?php echo isset($list[0]['sq_remarks']) ? $list[0]['sq_remarks'] : ""; ?></textarea>   
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Sub:</label>
                                            <div class="col-md-9">
                                        <textarea class="form-control" id="sales_enq_sub" name="sales_enq_sub" rows="3"><?php echo isset($list[0]['sales_enq_sub']) ? $list[0]['sales_enq_sub'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-1">Terms & Conditions:</label>
                                            <div class="col-md-11">
                                       <textarea class="form-control" id="sale_quotation_desc" name="sales_enq_desc" rows="5"><?php echo isset($list[0]['sales_enq_desc']) ? $list[0]['sales_enq_desc'] : ''; ?><?php if(isset($list[0]['sales_enq_desc']) && $list[0]['sales_enq_desc'] == '') { ?>PRICES : F.O.R. (Ahmedabad) 
WARRANTY : 12 months from the date of supply against any Mfg. Defects. 
P&F : NIL 
DELIVERY : Within 2-3 days from the date of technically clear and Conﬁrm Purchase Order 
PAYMENT : 100% Advance (Against Proforma Invoice) 
OFFER VALIDITY : 30 days from the date of this quote 
FREIGHT : Extra At Actual 
<?php } ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PRICES</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="PRICES" name="sales_enq_tc_price" maxlength="200" id="sales_enq_tc_price" value="<?php echo isset($list[0]['sales_enq_tc_price']) ? $list[0]['sales_enq_tc_price'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_price']) && $list[0]['sales_enq_tc_price'] == '') { ?>F.O.R. (Ahmedabad)<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">WARRANTY</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="WARRANTY" name="sales_enq_tc_wrnty" maxlength="200" id="sales_enq_tc_wrnty" value="<?php echo isset($list[0]['sales_enq_tc_wrnty']) ? $list[0]['sales_enq_tc_wrnty'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_wrnty']) && $list[0]['sales_enq_tc_wrnty'] == '') { ?>12 months from the date of supply against any Mfg. Defects.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">P&F</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="P&F" name="sales_enq_tc_pf" maxlength="200" id="sales_enq_tc_pf" value="<?php echo isset($list[0]['sales_enq_tc_pf']) ? $list[0]['sales_enq_tc_pf'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_pf']) && $list[0]['sales_enq_tc_pf'] == '') { ?>NIL<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">DELIVERY</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="DELIVERY" name="sales_enq_tc_deli" maxlength="200" id="sales_enq_tc_deli" value="<?php echo isset($list[0]['sales_enq_tc_deli']) ? $list[0]['sales_enq_tc_deli'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_deli']) && $list[0]['sales_enq_tc_deli'] == '') { ?>Within 2-3 days from the date of technically clear and Conﬁrm PO<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PAYMENT</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="PAYMENT" name="sales_enq_tc_paynt" maxlength="200" id="sales_enq_tc_paynt" value="<?php echo isset($list[0]['sales_enq_tc_paynt']) ? $list[0]['sales_enq_tc_paynt'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_paynt']) && $list[0]['sales_enq_tc_paynt'] == '') { ?>100% Advance (Against Proforma Invoice)<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">OFFER VALIDITY</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="OFFER VALIDITY" name="sales_enq_tc_ovali" maxlength="200" id="sales_enq_tc_ovali" value="<?php echo isset($list[0]['sales_enq_tc_ovali']) ? $list[0]['sales_enq_tc_ovali'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_ovali']) && $list[0]['sales_enq_tc_ovali'] == '') { ?>30 days from the date of this quote<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">FREIGHT</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="FREIGHT" name="sales_enq_tc_frght" maxlength="200" id="sales_enq_tc_frght" value="<?php echo isset($list[0]['sales_enq_tc_frght']) ? $list[0]['sales_enq_tc_frght'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_frght']) && $list[0]['sales_enq_tc_frght'] == '') { ?>Extra At Actual<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">GST</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="GST" name="sales_enq_tc_gst" maxlength="200" id="sales_enq_tc_gst" value="<?php echo isset($list[0]['sales_enq_tc_gst']) ? $list[0]['sales_enq_tc_gst'] : ""; ?><?php if(isset($list[0]['sales_enq_tc_gst']) && $list[0]['sales_enq_tc_gst'] == '') { ?>@ per HSN Chapter<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" />
</div>
<?php echo form_close(); ?> 