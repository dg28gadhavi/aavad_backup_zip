<?php
$clsar = array('class' => 'form-horizontal');
echo form_open($action_other,$clsar); ?> 
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Prepared  By :</label>
                        <div class="col-md-9">
                            <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                            <select name="pi_prepared_by" id="pi_prepared_by" tabindex="41" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                <?php  foreach($follow_exe as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['pi_prepared_by']) && $list[0]['pi_prepared_by'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Priority :</label>
                        <div class="col-md-9">
                             <select name="pi_inq_priority" id="pi_inq_priority" tabindex="42" class="form-control">
                                <option value="0">Select Priority</option>
                                <option value="1" <?php if(isset($list[0]['pi_priority']) && $list[0]['pi_priority'] == 1){ echo "selected";}?>>High</option>
                                <option value="2" <?php if(isset($list[0]['pi_priority']) && $list[0]['pi_priority'] == 2){ echo "selected";}?>>Low</option>
                                <option value="3" <?php if(isset($list[0]['pi_priority']) && $list[0]['pi_priority'] == 3){ echo "selected";}?>>Medium</option>
                            </select>
                        </div>
                    </div>
                </div>
                 
        </div>
       
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Status :</label>
                        <div class="col-md-9">
                            <select name="pi_inq_sts" id="pi_inq_sts" tabindex="43" class="form-control">
                            <option value="0">Select Status</option>
                              <option value="1" <?php if(isset($list[0]['pi_inq_st']) && $list[0]['pi_inq_st'] == 1){ echo "selected";}?>>Active</option>
                              <option value="2" <?php if(isset($list[0]['pi_inq_st']) && $list[0]['pi_inq_st'] == 2){ echo "selected";}?>>Pending</option>
                              <option value="3" <?php if(isset($list[0]['pi_inq_st']) && $list[0]['pi_inq_st'] == 3){ echo "selected";}?>>Completed</option>
                            </select>
                       </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Referred By</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="44" placeholder="Referred By" name="pi_ref_by" maxlength="200" id="pi_ref_by" value="<?php echo isset($list[0]['pi_ref_by']) ? $list[0]['pi_ref_by'] : ""; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Remark</label>
                        <div class="col-md-9">
                         <textarea class="form-control" tabindex="45" placeholder="Remark" name="pi_remarks" id="pi_remarks" rows="3"><?php echo isset($list[0]['pi_remarks']) ? $list[0]['pi_remarks'] : ""; ?></textarea>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Payment Term</label>
                        <div class="col-md-9">
                         <textarea class="form-control" tabindex="46" placeholder="Payment Term" name="pi_payment_term" id="pi_payment_term" rows="3"><?php echo isset($list[0]['pi_payment_term']) ? $list[0]['pi_payment_term'] : ""; ?><?php if(isset($list[0]['pi_payment_term']) && $list[0]['pi_payment_term'] == '') { ?>100% Advance Payment should be made through Cheque or RTGS. <?php } ?> </textarea>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Delivery </label>
                        <div class="col-md-9">
                         <textarea class="form-control" tabindex="47" placeholder="Delivery " name="pi_delivery" id="pi_delivery" rows="3"><?php echo isset($list[0]['pi_delivery']) ? $list[0]['pi_delivery'] : ""; ?><?php if(isset($list[0]['pi_delivery']) && $list[0]['pi_delivery'] == '') { ?>Ex Stock<?php } ?></textarea>   
                        </div>
                    </div>
            </div>            
            <div class="row" style="display: none;">
                <div class="col-md-12">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-1">Terms & Conditions:</label>
                        <div class="col-md-11">
                    <textarea class="form-control" tabindex="48" id="pi_term" name="pi_term" rows="5"><?php echo isset($list[0]['pi_term']) ? $list[0]['pi_term'] : ''; ?>    <?php if(isset($list[0]['pi_term']) && $list[0]['pi_term'] == '') { ?>PRICES : F.O.R. (Ahmedabad) 
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
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PRICES</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="49" class="form-control" placeholder="PRICES" name="pi_tc_price" maxlength="200" id="pi_tc_price" value="<?php echo isset($list[0]['pi_tc_price']) ? $list[0]['pi_tc_price'] : ""; ?><?php if(isset($list[0]['pi_tc_price']) && $list[0]['pi_tc_price'] == '') { ?>F.O.R. (Ahmedabad)<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">WARRANTY</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="50" class="form-control" placeholder="WARRANTY" name="pi_tc_wrnty" maxlength="200" id="pi_tc_wrnty" value="<?php echo isset($list[0]['pi_tc_wrnty']) ? $list[0]['pi_tc_wrnty'] : ""; ?><?php if(isset($list[0]['pi_tc_wrnty']) && $list[0]['pi_tc_wrnty'] == '') { ?>12 months from the date of supply against any Mfg. Defects.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">P&F</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="51" class="form-control" placeholder="P&F" name="pi_tc_pf" maxlength="200" id="pi_tc_pf" value="<?php echo isset($list[0]['pi_tc_pf']) ? $list[0]['pi_tc_pf'] : ""; ?><?php if(isset($list[0]['pi_tc_pf']) && $list[0]['pi_tc_pf'] == '') { ?>NIL<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">DELIVERY</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="52" class="form-control" placeholder="DELIVERY" name="pi_tc_deli" maxlength="200" id="pi_tc_deli" value="<?php echo isset($list[0]['pi_tc_deli']) ? $list[0]['pi_tc_deli'] : ""; ?><?php if(isset($list[0]['pi_tc_deli']) && $list[0]['pi_tc_deli'] == '') { ?>Within 2-3 days from the date of technically clear and Conﬁrm PO<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PAYMENT</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="53" class="form-control" placeholder="PAYMENT" name="pi_tc_paynt" maxlength="200" id="pi_tc_paynt" value="<?php echo isset($list[0]['pi_tc_paynt']) ? $list[0]['pi_tc_paynt'] : ""; ?><?php if(isset($list[0]['pi_tc_paynt']) && $list[0]['pi_tc_paynt'] == '') { ?>100% Advance (Against Proforma Invoice)<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">OFFER VALIDITY</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="54" class="form-control" placeholder="OFFER VALIDITY" name="pi_tc_ovali" maxlength="200" id="pi_tc_ovali" value="<?php echo isset($list[0]['pi_tc_ovali']) ? $list[0]['pi_tc_ovali'] : ""; ?><?php if(isset($list[0]['pi_tc_ovali']) && $list[0]['pi_tc_ovali'] == '') { ?>30 days from the date of this quote<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">FREIGHT</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="55" class="form-control" placeholder="FREIGHT" name="pi_tc_frght" maxlength="200" id="pi_tc_frght" value="<?php echo isset($list[0]['pi_tc_frght']) ? $list[0]['pi_tc_frght'] : ""; ?><?php if(isset($list[0]['pi_tc_frght']) && $list[0]['pi_tc_frght'] == '') { ?>Extra At Actual<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row" style="display: none;">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">GST</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="56" class="form-control" placeholder="GST" name="pi_tc_gst" maxlength="200" id="pi_tc_gst" value="<?php echo isset($list[0]['pi_tc_gst']) ? $list[0]['pi_tc_gst'] : ""; ?><?php if(isset($list[0]['pi_tc_gst']) && $list[0]['pi_tc_gst'] == '') { ?>@ per HSN Chapter We hope that above oﬀer may in line with your requirement, Looking forward to your valued<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Discount:</label>
                        <div class="col-md-9">
                                <input type="radio" tabindex="57" name="pi_isdiscount" value="1" <?php if(isset($list[0]['pi_isdiscount']) && $list[0]['pi_isdiscount'] == 1) { ?>checked <?php } ?>checked=""> YES <br>
                                <input type="radio" <?php if(isset($list[0]['pi_isdiscount']) && $list[0]['pi_isdiscount'] == 2) { ?>checked <?php } ?> name="pi_isdiscount" value="2"> NO <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2 text-center" style="text-align:center;"></label>
                        <label class="control-label col-md-2 text-center" style="text-align:center;">HSN Code</label>
                        <label class="control-label col-md-2 text-center" style="text-align:center;">Taxable Amount</label>
                        <label class="control-label col-md-2 text-center"  style="text-align:center;">GST %</label>
                        <label class="control-label col-md-2 text-center" style="text-align:center;">Tax Amt</label>
                         <label class="control-label col-md-2 text-center" style="text-align:center;">Grand Total</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2">P & F(0%):</label>                        
                        <div class="col-md-2">
                             <input type="text" tabindex="58" class="form-control" placeholder="HSN Code" name="pi_hsncode" maxlength="200" id="pi_hsncode" value="<?php echo isset($list[0]['pi_hsncode']) ? $list[0]['pi_hsncode'] : '995840'; ?>">
                        </div>
                        <div class="col-md-2">
                             <input type="text" tabindex="59" class="form-control" placeholder="Taxable Amount" name="pi_taxbleamount" maxlength="200" id="pi_taxbleamount" value="<?php echo isset($list[0]['pi_taxbleamount']) ? $list[0]['pi_taxbleamount'] : ''; ?>">
                        </div>
                         <div class="col-md-2">
                             <input type="text" tabindex="60" class="form-control" placeholder="GST %" name="pi_pfgst" maxlength="200" id="pi_pfgst" value="<?php echo isset($list[0]['pi_pfgst']) ? $list[0]['pi_pfgst'] : '18'; ?>">
                        </div>
                        <div class="col-md-2">
                             <input type="text" tabindex="61" class="form-control" placeholder="Tax Amt" name="pi_taxamount" maxlength="200" id="pi_taxamount" value="<?php echo isset($list[0]['pi_taxamount']) ? $list[0]['pi_taxamount'] : ''; ?>">
                        </div>
                        <div class="col-md-2">
                             <input type="text" tabindex="62" class="form-control" placeholder="grandtotal" name="pi_grandtotal" maxlength="200" id="pi_grandtotal" value="<?php echo isset($list[0]['pi_grandtotal']) ? $list[0]['pi_grandtotal'] : ''; ?>">
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2">Freight:</label>                        
                        <div class="col-md-2">
                             <input type="text" tabindex="62" class="form-control" placeholder="HSN Code" name="pi_fright_hsncode" maxlength="200" id="pi_fright_hsncode" value="<?php echo isset($list[0]['pi_fright_hsncode']) ? $list[0]['pi_fright_hsncode'] : '996812'; ?>">
                        </div>
                        <div class="col-md-2">
                             <input type="text" tabindex="63" class="form-control" placeholder="Taxable Amount" name="pi_fright_taxbleamount" maxlength="200" id="pi_fright_taxbleamount" value="<?php echo isset($list[0]['pi_fright_taxbleamount']) ? $list[0]['pi_fright_taxbleamount'] : ''; ?>">
                        </div>
                         <div class="col-md-2">
                             <input type="text" tabindex="64" class="form-control" placeholder="GST %" name="pi_fright_pfgst" maxlength="200" id="pi_fright_pfgst" value="<?php echo isset($list[0]['pi_fright_pfgst']) ? $list[0]['pi_fright_pfgst'] : ''; ?>">
                        </div>
                        <div class="col-md-2">
                             <input type="text" tabindex="65" class="form-control" placeholder="Tax Amt" name="pi_fright_taxamount" maxlength="200" id="pi_fright_taxamount" value="<?php echo isset($list[0]['pi_fright_taxamount']) ? $list[0]['pi_fright_taxamount'] : ''; ?>">
                        </div>
                        <div class="col-md-2">
                             <input type="text" tabindex="66" class="form-control" placeholder="grandtotal" name="pi_fright_grandtotal" maxlength="200" id="pi_fright_grandtotal" value="<?php echo isset($list[0]['pi_fright_grandtotal']) ? $list[0]['pi_fright_grandtotal'] : ''; ?>">
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
<div class="modal-footer pull-left">
    <input type="submit" class="btn btn-success btn-space" name="submit" value="save" tabindex="67" />
</div>
<?php echo form_close(); ?>      