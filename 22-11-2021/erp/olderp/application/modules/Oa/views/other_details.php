<?php
$clsar = array('class' => 'form-horizontal');
echo form_open($action_other,$clsar); ?>
<!-- <h4>Some Input</h4> --> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Prepared By</label>
                        <div class="col-md-9">
                            <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                            <select name="oa_prepared_by" id="oa_prepared_by" tabindex="1" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                               <!--  <?php  foreach($vendors as $vendor) {?>  <option value="<?php echo $vendor['master_party_id'];?>" <?php if(isset($list[0]['oa_end_st']) && $list[0]['oa_end_st'] == $vendor['master_party_id']){ echo "selected";}?>><?php echo $vendor['master_party_name']; ?></option><?php } ?>  -->

                                  <?php  foreach($follow_exe as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['oa_prepared_by']) && $list[0]['oa_prepared_by'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Priority</label>
                        <div class="col-md-9">
                             <select name="oa_inq_priority" id="oa_inq_priority" tabindex="2" class="form-control">
                              <option value="0">Select Priority</option>
                              <option value="1" <?php if(isset($list[0]['oa_priority']) && $list[0]['oa_priority'] == 1){ echo "selected";}?>>High</option>
                              <option value="2" <?php if(isset($list[0]['oa_priority']) && $list[0]['oa_priority'] == 2){ echo "selected";}?>>Low</option>
                              <option value="3" <?php if(isset($list[0]['oa_priority']) && $list[0]['oa_priority'] == 3){ echo "selected";}?>>Medium</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Mode of Inquiry :</label>
                        <div class="col-md-9">
                            <select name="oa_mode_inq" id="oa_mode_inq" class="form-control">
                            <?php  foreach($modeinquries as $modeinqurie) {?>  <option value="<?php echo $modeinqurie['mode_inquiry_id'];?>" <?php if(isset($list[0]['oa_mode_inq']) && $list[0]['oa_mode_inq'] == $modeinqurie['mode_inquiry_id']){ echo "selected";}?>><?php echo $modeinqurie['mode_inquiry_name']; ?></option>
                              <?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>  -->
            </div>
            <!--  <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="master_party_taxgr">
                        <label class="control-label col-md-3">Source category</label>
                        <div class="col-md-9">
                            <select name="oa_source_cat" id="oa_source_cat" class="form-control"  onchange="sub_cat(this)">
                                <?php foreach($sources as $source)
                                { ?>
                                        <option value="<?php echo $source['source_cat_id']; ?>" <?php if(isset($list[0]['oa_source_cat']) && $list[0]['oa_source_cat'] == $source['source_cat_id']){ echo "selected";} ?>> <?php echo $source['source_cat_name']; ?>
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
                        <select name="oa_subsource_cat" id="oa_subsource_cat" class="form-control">
                            <option value="">Select sub category</option>
                              <?php  foreach($subsources as $subsource) {?>  
                              <option value="<?php echo $subsource['source_cat_id'];?>" <?php if(isset($list[0]['oa_subsource_cat']) && $list[0]['oa_subsource_cat'] == $subsource['source_cat_id']){ echo "selected";}?>><?php echo $subsource['source_cat_name']; ?></option>
                              <?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
            </div>  -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select name="oa_inq_sts" id="oa_inq_sts" class="form-control" tabindex="3">
                            <option value="0">Select Status</option>
                              <option value="1" <?php if(isset($list[0]['oa_inq_st']) && $list[0]['oa_inq_st'] == 1){ echo "selected";}?>>Active</option>
                              <option value="2" <?php if(isset($list[0]['oa_inq_st']) && $list[0]['oa_inq_st'] == 2){ echo "selected";}?>>Pending</option>
                              <option value="3" <?php if(isset($list[0]['oa_inq_st']) && $list[0]['oa_inq_st'] == 3){ echo "selected";}?>>Completed</option>
                            </select>
                       </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Referred By</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="4" placeholder="Referred By" name="oa_ref_by" maxlength="200" id="oa_ref_by" value="<?php echo isset($list[0]['oa_ref_by']) ? $list[0]['oa_ref_by'] : ""; ?>">
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Priority :</label>
                        <div class="col-md-9">
                             <select name="oa_inq_priority" id="oa_inq_priority" class="form-control">
                            <option value="0">Select Priority</option>
                              <option value="1" <?php if(isset($list[0]['oa_priority']) && $list[0]['oa_priority'] == 1){ echo "selected";}?>>High</option>
                              <option value="2" <?php if(isset($list[0]['oa_priority']) && $list[0]['oa_priority'] == 2){ echo "selected";}?>>Low</option>
                              <option value="3" <?php if(isset($list[0]['oa_priority']) && $list[0]['oa_priority'] == 3){ echo "selected";}?>>Medium</option>
                            </select>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <!-- <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Referred By</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Referred By" name="oa_ref_by" maxlength="200" id="oa_ref_by" value="<?php echo isset($list[0]['oa_ref_by']) ? $list[0]['oa_ref_by'] : ""; ?>">
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Remark</label>
                        <div class="col-md-9">
                         <textarea class="form-control" tabindex="5" placeholder="Remark" name="oa_remarks" id="oa_remarks" rows="3"><?php echo isset($list[0]['oa_remarks']) ? $list[0]['oa_remarks'] : ""; ?></textarea>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display: none;">
                <div class="col-md-12">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-1">Terms & Conditions:</label>
                        <div class="col-md-11">
                            <textarea class="form-control" id="oa_term" tabindex="6" name="oa_term" rows="5"><?php echo isset($list[0]['oa_term']) ? $list[0]['oa_term'] : ''; ?><?php if(isset($list[0]['oa_term']) && $list[0]['oa_term'] == '') { ?>PRICES : F.O.R. (Ahmedabad) 
                            WARRANTY : 12 months from the date of supply against any Mfg. Defects. 
                            P&F : NIL 
                            DELIVERY : Within 2-3 days from the date of technically clear and Conﬁrm Purchase Order 
                            PAYMENT : 100% Advance (Against Proforma Invoice) 
                            OFFER VALIDITY : 30 days from the date of this quote 
                            FREIGHT : Extra At Actual 
                            GST : @ per HSN Chapter We hope that above oﬀer may in line with your requirement, Looking forward to your valued
                            <?php } ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PRICES</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="7" class="form-control" placeholder="PRICES" name="oa_tc_price" maxlength="200" id="oa_tc_price" value="<?php echo isset($list[0]['oa_tc_price']) ? $list[0]['oa_tc_price'] : ""; ?><?php if(isset($list[0]['oa_tc_price']) && $list[0]['oa_tc_price'] == '') { ?>F.O.R. (Ahmedabad)<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">WARRANTY</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="8" class="form-control" placeholder="WARRANTY" name="oa_tc_wrnty" maxlength="200" id="oa_tc_wrnty" value="<?php echo isset($list[0]['oa_tc_wrnty']) ? $list[0]['oa_tc_wrnty'] : ""; ?><?php if(isset($list[0]['oa_tc_wrnty']) && $list[0]['oa_tc_wrnty'] == '') { ?>12 months from the date of supply against any Mfg. Defects.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">P&F</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="9" class="form-control" placeholder="P&F" name="oa_tc_pf" maxlength="200" id="oa_tc_pf" value="<?php echo isset($list[0]['oa_tc_pf']) ? $list[0]['oa_tc_pf'] : ""; ?><?php if(isset($list[0]['oa_tc_pf']) && $list[0]['oa_tc_pf'] == '') { ?>NIL<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">DELIVERY</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="10" class="form-control" placeholder="DELIVERY" name="oa_tc_deli" maxlength="200" id="oa_tc_deli" value="<?php echo isset($list[0]['oa_tc_deli']) ? $list[0]['oa_tc_deli'] : ""; ?><?php if(isset($list[0]['oa_tc_deli']) && $list[0]['oa_tc_deli'] == '') { ?>Within 2-3 days from the date of technically clear and Conﬁrm PO<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PAYMENT</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="11" class="form-control" placeholder="PAYMENT" name="oa_tc_paynt" maxlength="200" id="oa_tc_paynt" value="<?php echo isset($list[0]['oa_tc_paynt']) ? $list[0]['oa_tc_paynt'] : ""; ?><?php if(isset($list[0]['oa_tc_paynt']) && $list[0]['oa_tc_paynt'] == '') { ?>100% Advance (Against Proforma Invoice)<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">OFFER VALIDITY</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="12" class="form-control" placeholder="OFFER VALIDITY" name="oa_tc_ovali" maxlength="200" id="oa_tc_ovali" value="<?php echo isset($list[0]['oa_tc_ovali']) ? $list[0]['oa_tc_ovali'] : ""; ?><?php if(isset($list[0]['oa_tc_ovali']) && $list[0]['oa_tc_ovali'] == '') { ?>30 days from the date of this quote<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">FREIGHT</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="13" class="form-control" placeholder="FREIGHT" name="oa_tc_frght" maxlength="200" id="oa_tc_frght" value="<?php echo isset($list[0]['oa_tc_frght']) ? $list[0]['oa_tc_frght'] : ""; ?><?php if(isset($list[0]['oa_tc_frght']) && $list[0]['oa_tc_frght'] == '') { ?>Extra At Actual<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">GST</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="14" class="form-control" placeholder="GST" name="oa_tc_gst" maxlength="200" id="oa_tc_gst" value="<?php echo isset($list[0]['oa_tc_gst']) ? $list[0]['oa_tc_gst'] : ""; ?><?php if(isset($list[0]['oa_tc_gst']) && $list[0]['oa_tc_gst'] == '') { ?>@ per HSN Chapter<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Discount</label>
                        <div class="col-md-9">
                              <input type="radio" tabindex="15" name="oa_isdiscount" value="1" <?php if(isset($list[0]['oa_isdiscount']) && $list[0]['oa_isdiscount'] == 1) { ?>checked <?php } ?>checked=""> YES <br>
                                <input type="radio" <?php if(isset($list[0]['oa_isdiscount']) && $list[0]['oa_isdiscount'] == 2) { ?>checked <?php } ?> name="oa_isdiscount" value="2"> NO <br>
                        </div>
                    </div>
                </div>
            </div>
<div class="modal-footer pull-left">
    <input type="submit" class="btn btn-success btn-space" name="submit" value="save" tabindex="16" />
</div>

<?php echo form_close(); ?>      