<?php
$clsar = array('class' => 'form-horizontal');
echo form_open($action_other,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        

        <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Inquiry By :</label>
                        <div class="col-md-9">
                            <select name="sa_end_st" id="sa_end_st" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                <option value="0">Select Inquiry By</option>
                                <?php  foreach($follow_exe as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sa_inq_st']) && $list[0]['sa_inq_st'] == $vendor['au_id']){ echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Mode of Inquiry :</label>
                        <div class="col-md-9">
                            <select name="sa_mode_inq" id="sa_mode_inq" class="form-control">
                                <option value="0">Select Mode of Inquiry</option>
<?php  foreach($modeinquries as $modeinqurie) {?>  <option value="<?php echo $modeinqurie['mode_inquiry_id'];?>" <?php if(isset($list[0]['sa_mode_inq']) && $list[0]['sa_mode_inq'] == $modeinqurie['mode_inquiry_id']){ echo "selected";}?>><?php echo $modeinqurie['mode_inquiry_name']; ?></option>
                              <?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
        </div> -->
        <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="master_party_taxgr">
                        <label class="control-label col-md-3">Source category</label>
                        <div class="col-md-9">
                            <select name="sa_source_cat" id="sa_source_cat" class="form-control"  onchange="sub_cat(this)">
                                <option value="0">Select Source category</option>
                                <?php foreach($sources as $source)
                                { ?>
                                        <option value="<?php echo $source['source_cat_id']; ?>" <?php if(isset($list[0]['sa_source_cat']) && $list[0]['sa_source_cat'] == $source['source_cat_id']){ echo "selected";} ?>> <?php echo $source['source_cat_name']; ?>
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
                        <select name="sa_subsource_cat" id="sa_subsource_cat" class="form-control">
                            <option value="">Select sub category</option>
                              <?php  foreach($subsources as $subsource) {?>  
                              <option value="<?php echo $subsource['source_cat_id'];?>" <?php if(isset($list[0]['sa_subsource_cat']) && $list[0]['sa_subsource_cat'] == $subsource['source_cat_id']){ echo "selected";}?>><?php echo $subsource['source_cat_name']; ?></option>
                              <?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
        </div> -->
        <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Status :</label>
                        <div class="col-md-9">
                            <select name="sa_inq_sts" id="sa_inq_sts" class="form-control">
                            <option value="0">Select Status</option>
                              <option value="1" <?php if(isset($list[0]['sa_inq_st']) && $list[0]['sa_inq_st'] == 1){ echo "selected";}?>>Active</option>
                              <option value="2" <?php if(isset($list[0]['sa_inq_st']) && $list[0]['sa_inq_st'] == 2){ echo "selected";}?>>Pending</option>
                              <option value="3" <?php if(isset($list[0]['sa_inq_st']) && $list[0]['sa_inq_st'] == 3){ echo "selected";}?>>Completed</option>
                            </select>
                       </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Priority :</label>
                        <div class="col-md-9">
                             <select name="sa_inq_priority" id="sa_inq_priority" class="form-control">
                            <option value="0">Select Priority</option>
                              <option value="1" <?php if(isset($list[0]['sa_priority']) && $list[0]['sa_priority'] == 1){ echo "selected";}?>>High</option>
                              <option value="2" <?php if(isset($list[0]['sa_priority']) && $list[0]['sa_priority'] == 2){ echo "selected";}?>>Low</option>
                              <option value="3" <?php if(isset($list[0]['sa_priority']) && $list[0]['sa_priority'] == 3){ echo "selected";}?>>Medium</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Referred By</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Referred By" name="sa_ref_by" maxlength="200" id="sa_ref_by" value="<?php echo isset($list[0]['sa_referred_by']) ? $list[0]['sa_referred_by'] : ""; ?>">
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Remark</label>
                        <div class="col-md-9">
                         <textarea class="form-control" tabindex="61" placeholder="Remark" name="sa_remarks" id="sa_remarks" rows="3"><?php echo isset($list[0]['sa_remarks']) ? $list[0]['sa_remarks'] : ""; ?></textarea>   
                        </div>
                    </div>
                </div>
            </div>
           <!--  <div class="row">
                <div class="col-md-12">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-1">Subject:</label>
                        <div class="col-md-11">
                        <textarea class="form-control" id="sale_quotation_sub" name="sale_quotation_sub" rows="5"><?php echo isset($list[0]['sa_subject']) ? $list[0]['sa_subject'] : ''; ?><?php if(isset($list[0]['sa_subject']) && $list[0]['sa_subject'] == '') { ?><?php } ?></textarea>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row" style="display: none;">
                <div class="col-md-12">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-1">Terms & Conditions:</label>
                        <div class="col-md-11">
                        <textarea class="form-control" tabindex="62" id="sale_quotation_desc" name="sale_quotation_desc" rows="5"><?php echo isset($list[0]['sale_quotation_term']) ? $list[0]['sale_quotation_term'] : ''; ?><?php if(isset($list[0]['sale_quotation_term']) && $list[0]['sale_quotation_term'] == '') { ?>PRICES : F.O.R. (Ahmedabad) 
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
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">PRICES</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="63" placeholder="PRICES" name="sa_tc_price" maxlength="200" id="sa_tc_price" value="<?php echo isset($list[0]['sa_tc_price']) ? $list[0]['sa_tc_price'] : ""; ?><?php if(isset($list[0]['sa_tc_price']) && $list[0]['sa_tc_price'] == '') { ?>Prices Quoted Are Ex – Works, Ahmadabad.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Packing & Forwarding</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="65" placeholder="P&F" name="sa_tc_pf" maxlength="200" id="sa_tc_pf" value="<?php echo isset($list[0]['sa_tc_pf']) ? $list[0]['sa_tc_pf'] : ""; ?><?php if(isset($list[0]['sa_tc_pf']) && $list[0]['sa_tc_pf'] == '') { ?>Extra @ 3%.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">FREIGHT</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="69" placeholder="FREIGHT" name="sa_tc_frght" maxlength="200" id="sa_tc_frght" value="<?php echo isset($list[0]['sa_tc_frght']) ? $list[0]['sa_tc_frght'] : ""; ?><?php if(isset($list[0]['sa_tc_frght']) && $list[0]['sa_tc_frght'] == '') { ?>Extra At Actual<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            
            
             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Insurance</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="66" placeholder="Insurance" name="sa_tc_insu" maxlength="200" id="sa_tc_insu" value="<?php echo isset($list[0]['sa_tc_insu']) ? $list[0]['sa_tc_insu'] : ""; ?><?php if(isset($list[0]['sa_tc_insu']) && $list[0]['sa_tc_insu'] == '') { ?>Purchaser To Arrange,<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Inspection</label>
                        <div class="col-md-9">
                           <textarea class="form-control" tabindex="61" placeholder="Inspection" name="sa_tc_inspection" id="sa_tc_inspection" rows="3"><?php echo isset($list[0]['sa_tc_inspection']) ? $list[0]['sa_tc_inspection'] : ""; ?><?php if(isset($list[0]['sa_tc_inspection']) && $list[0]['sa_tc_inspection'] == '') { ?>If Required, Material Will Be Offered For Inspection At Our Factory At 
The Cost Of The Buyer. Material Will Be Offered For Visual / Functional Inspection On Sampling Basis.<?php } ?></textarea>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Payment Terms</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="67" placeholder="PAYMENT" name="sa_tc_paynt" maxlength="200" id="sa_tc_paynt" value="<?php echo isset($list[0]['sa_tc_paynt']) ? $list[0]['sa_tc_paynt'] : ""; ?><?php if(isset($list[0]['sa_tc_paynt']) && $list[0]['sa_tc_paynt'] == '') { ?>40 % Advance Along With Order And Balance Against Dispatch Through Bank Or On Cod Basis By Way Of Demand Draft Only <?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">VALIDITY</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="68" placeholder="OFFER VALIDITY" name="sa_tc_ovali" maxlength="200" id="sa_tc_ovali" value="<?php echo isset($list[0]['sa_tc_ovali']) ? $list[0]['sa_tc_ovali'] : ""; ?><?php if(isset($list[0]['sa_tc_ovali']) && $list[0]['sa_tc_ovali'] == '') { ?>Our Offer Is Valid For A Period Of 30 Days.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">GST</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="70" placeholder="GST" name="sa_tc_gst" maxlength="200" id="sa_tc_gst" value="<?php echo isset($list[0]['sa_tc_gst']) ? $list[0]['sa_tc_gst'] : ""; ?><?php if(isset($list[0]['sa_tc_gst']) && $list[0]['sa_tc_gst'] == '') { ?>@ per HSN Chapter<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">WARRANTY</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="64" placeholder="WARRANTY" name="sa_tc_wrnty" maxlength="200" id="sa_tc_wrnty" value="<?php echo isset($list[0]['sa_tc_wrnty']) ? $list[0]['sa_tc_wrnty'] : ""; ?><?php if(isset($list[0]['sa_tc_wrnty']) && $list[0]['sa_tc_wrnty'] == '') { ?>Instruments Are Guaranteed For A Period Of 12 Months From The Date Of Dispatch.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Jurisdiction</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" tabindex="64" placeholder="Jurisdiction" name="sa_tc_jurisdiction" maxlength="200" id="sa_tc_jurisdiction" value="<?php echo isset($list[0]['sa_tc_jurisdiction']) ? $list[0]['sa_tc_jurisdiction'] : ""; ?><?php if(isset($list[0]['sa_tc_jurisdiction']) && $list[0]['sa_tc_jurisdiction'] == '') { ?> Competent Court In The City Of Ahmadabad Only.<?php } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Commissioning &  Field Services Charges</label>
                        <div class="col-md-9">
                           <textarea class="form-control" tabindex="61" placeholder="Commissioning &  Field Services Charges" name="sa_tc_cfsc" id="sa_tc_cfsc" rows="3"><?php echo isset($list[0]['sa_tc_cfsc']) ? $list[0]['sa_tc_cfsc'] : ""; ?><?php if(isset($list[0]['sa_tc_cfsc']) && $list[0]['sa_tc_cfsc'] == '') { ?>Will be provided commissioning and services for technical assistance,    
                    for the following charges will be applicable within India and will have 
       to be separately ordered in the PO/work Order.
Visit Charges of Rs. 5000/-per man day (upto 8 Hours)
To & Fro charges will be claimed at actual based on Economy air fare or II A/C rail fare or Taxi Fare as applicable.
Boarding and Lodging will claimed at actual as applicable<?php } ?></textarea>   
                        </div>
                    </div>
                </div>
            </div>

            
            
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Discount:</label>
                            <div class="col-md-9">
                                  <input type="radio" tabindex="71" name="sa_isdiscount" value="1" <?php if(isset($list[0]['sa_isdiscount']) && $list[0]['sa_isdiscount'] == 1) { ?>checked <?php } ?>checked=""> YES <br>
                                    <input type="radio" <?php if(isset($list[0]['sa_isdiscount']) && $list[0]['sa_isdiscount'] == 2) { ?>checked <?php } ?> name="sa_isdiscount" value="2"> NO <br>
                            </div>
                        </div>
                    </div>
            </div> 
<!-- <div class="modal-footer pull-left">
  <input type="submit" class="btn btn-success btn-space" name="submit" value="save" tabindex="10" />
</div> -->
    <div class="form-actions">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" tabindex="72" class="btn green" onclick="return ValidateDetails()">SUBMIT</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> </div>
        </div>
    </div>
<?php echo form_close(); ?>      