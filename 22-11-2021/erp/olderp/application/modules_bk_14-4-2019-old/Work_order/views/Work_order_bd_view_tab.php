<?php 
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">W.O. NO</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="1" class="form-control"  name="wo_no" maxlength="200" id="wo_no " value="<?php echo !$this->uri->segment(3) && isset($wo_no) ? $wo_no : ''; ?><?php echo isset($list[0]['wo_wo_no']) ? $list[0]['wo_wo_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">W.O. Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="W.O Date" name="wo_wo_date" maxlength="200" id="wo_wo_date" value="<?php echo isset($list[0]['wo_wo_date']) ? date("d-m-Y", strtotime($list[0]['wo_wo_date'])) : ""; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">OLD WO No.</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium" placeholder="W.O Date" name="wo_old_wo_no" maxlength="200" id="wo_old_wo_no" value="<?php echo isset($list[0]['wo_old_wo_no']) ? $list[0]['wo_old_wo_no'] : ""; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">P.O. NO</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control"  name="wo_po_no" maxlength="200" id="wo_po_no" value="<?php echo isset($list[0]['wo_po_no']) ? $list[0]['wo_po_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">P.O. Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="4" class="form-control form-control-inline input-medium date-picker" placeholder="W.O Date" name="wo_po_date" maxlength="200" id="wo_po_date" value="<?php echo isset($list[0]['wo_po_date']) ? date("d-m-Y", strtotime($list[0]['wo_po_date'])) : ""; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Customer Name</label>
                                                <div class="col-md-9">
                                                   <input type="text" tabindex="5" class="form-control vendor" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['wo_customer_name']) ? $list[0]['wo_customer_name'] : ""; ?>" required="required">
                                                   <input type="hidden" name="wo_custo_id" id="wo_custo_id" value="<?php echo isset($list[0]['wo_customer_id']) ? $list[0]['wo_customer_id'] : ""; ?>">
                                                    <input type="hidden" name="temp_cname" id="temp_cname" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Customer Address</label>
                                                    <div class="col-md-9">
                                                    <textarea class="form-control" tabindex="6" name="wo_address" placeholder="Customer Address" id="wo_address" rows="3"><?php echo isset($list[0]['wo_address']) ? $list[0]['wo_address'] : ""; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Billing Address</label>
                                            <div class="col-md-9">
                                               <textarea class="form-control" tabindex="7" name="wo_billing_address" placeholder="Billing Address" id="wo_billing_address" rows="3"><?php echo isset($list[0]['wo_billing_address']) ? $list[0]['wo_billing_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Shipping Address</label>
                                            <div class="col-md-9">
                                               <textarea class="form-control" tabindex="8" name="wo_shipping_address" placeholder="Shipping Address" id="wo_shipping_address" rows="3"><?php echo isset($list[0]['wo_shipping_address']) ? $list[0]['wo_shipping_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Delivery Time/Date</label>
                                            <div class="col-md-9">
                                               <!-- <input type="text" tabindex="9" class="form-control form-control-inline input-medium date-picker" placeholder="Delivery Time/Date" name="wo_deliverytime" maxlength="200" id="wo_deliverytime" value="<?php echo isset($list[0]['wo_deliverytime']) ? date("d-m-Y", strtotime($list[0]['wo_deliverytime'])) : ""; ?>"> -->
                                               <input type="text" tabindex="9" class="form-control"  name="wo_deliverytime" maxlength="200" id="wo_deliverytime " value="<?php echo isset($list[0]['wo_deliverytime']) ? $list[0]['wo_deliverytime'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Delivery By</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="10" class="form-control"  name="wo_deliveryby" maxlength="200" id="wo_deliveryby " value="<?php echo isset($list[0]['wo_deliveryby']) ? $list[0]['wo_deliveryby'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Courier Name</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="11" class="form-control"  name="wo_couriername" maxlength="200" id="wo_couriername " value="<?php echo isset($list[0]['wo_couriername']) ? $list[0]['wo_couriername'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Docket No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="12" class="form-control"  name="wo_docket_no" maxlength="200" id="wo_docket_no " value="<?php echo isset($list[0]['wo_docket_no']) ? $list[0]['wo_docket_no'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Prepard By</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="wo_preparedby" tabindex="13" id="wo_preparedby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Inquiry By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['wo_preparedby']) && $list[0]['wo_preparedby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Tested By</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="wo_testedby" tabindex="14" id="wo_testedby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Inquiry By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['wo_testedby']) && $list[0]['wo_testedby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">GST No.</label>
                                            <div class="col-md-9">
                                               
                                               <input type="text" tabindex="15" class="form-control"  name="wo_gstno" maxlength="200" id="wo_gstno " value="<?php echo isset($list[0]['wo_gstno']) ? $list[0]['wo_gstno'] : ""; ?>">
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Remark</label>
                                            <div class="col-md-9">
                                               <textarea class="form-control" tabindex="16" name="wo_remark" placeholder="Customer Address" id="wo_remark" rows="3"><?php echo isset($list[0]['wo_remark']) ? $list[0]['wo_remark'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Payment Terms</label>
                                            <div class="col-md-9">
                                               <textarea class="form-control" tabindex="16" name="wo_paymentterms" placeholder="" id="wo_paymentterms" rows="3"><?php echo isset($list[0]['wo_paymentterms']) ? $list[0]['wo_paymentterms'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Payment Image</label>
                                            <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php if(isset($list[0]['wo_paymnetimg_sales']) && ($list[0]['wo_paymnetimg_sales'] != '')) {?><?php echo base_url();?>uploads/wo_paymnetimg_sales/<?php echo $list[0]['wo_paymnetimg_sales']; ?><?php } else{ ?>http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image<?php } ?>" alt=""> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new" tabindex="13"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                   <input type="file"  name="wo_paymnetimg_sales"  />
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Work Order Type</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="wo_type" tabindex="14" id="wo_type" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($wo_type as $wo_types) {?>  <option value="<?php echo $wo_types['wo_type_id'];?>" <?php if(isset($list[0]['wo_type']) && $list[0]['wo_type'] == $wo_types['wo_type_id']){ echo "selected";}else if($uid && $uid == $wo_types['wo_type_id']) { echo "selected";}?>><?php echo $wo_types['wo_type_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-2 text-center" style="text-align:center;"></label>
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
                                                                 <input type="text" tabindex="17" class="form-control" placeholder="Taxable Amount" name="wo_taxbleamount" maxlength="200" id="wo_taxbleamount" value="<?php echo isset($list[0]['wo_taxbleamount']) ? $list[0]['wo_taxbleamount'] : ''; ?>">
                                                            </div>
                                                             <div class="col-md-2">
                                                                 <input type="text" tabindex="18" class="form-control" placeholder="GST %" name="wo_pfgst" maxlength="200" id="wo_pfgst" value="<?php echo isset($list[0]['wo_pfgst']) ? $list[0]['wo_pfgst'] : '18'; ?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="19" class="form-control" placeholder="Tax Amt" name="wo_taxamount" maxlength="200" id="wo_taxamount" value="<?php echo isset($list[0]['wo_taxamount']) ? $list[0]['wo_taxamount'] : ''; ?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="20" class="form-control" placeholder="grandtotal" name="wo_pf_grandtotal" maxlength="200" id="wo_pf_grandtotal" value="<?php echo isset($list[0]['wo_pf_grandtotal']) ? $list[0]['wo_pf_grandtotal'] : ''; ?>">
                                                            </div>                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Freight:</label>     
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="21" class="form-control" placeholder="Taxable Amount" name="wo_fright_taxbleamount" maxlength="200" id="wo_fright_taxbleamount" value="<?php echo isset($list[0]['wo_fright_taxbleamount']) ? $list[0]['wo_fright_taxbleamount'] : ''; ?>">
                                                            </div>
                                                             <div class="col-md-2">
                                                                 <input type="text" tabindex="22" class="form-control" placeholder="GST %" name="wo_fright_pfgst" maxlength="200" id="wo_fright_pfgst" value="<?php echo isset($list[0]['wo_fright_pfgst']) ? $list[0]['wo_fright_pfgst'] : '18'; ?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="23" class="form-control" placeholder="Tax Amt" name="wo_fright_taxamount" maxlength="200" id="wo_fright_taxamount" value="<?php echo isset($list[0]['wo_fright_taxamount']) ? $list[0]['wo_fright_taxamount'] : ''; ?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="24" class="form-control" placeholder="grandtotal" name="wo_fright_grandtotal" maxlength="200" id="wo_fright_grandtotal" value="<?php echo isset($list[0]['wo_fright_grandtotal']) ? $list[0]['wo_fright_grandtotal'] : ''; ?>">
                                                            </div>                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php $tabindex = 25;
                                                    $charge_ar= array(0,1,2,3,4);
                                                    if(isset($list[0]['wo_charges']) && $list[0]['wo_charges'] != '')
                                                    {
                                                        $charges = $list[0]['wo_charges'];
                                                        if(is_array(json_decode($charges)) && !empty(json_decode($charges)))
                                                        {
                                                            $charge_ar=json_decode($charges);
                                                        }
                                                    }
                                                     foreach ($charge_ar as $i => $value) {  ?>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                             <div class="col-md-2">
                                                                 <input type="text" tabindex="<?php echo $tabindex; ?>" class="form-control" placeholder="Chargeble Title" name="charge[<?php echo $i; ?>][title]" maxlength="200" value="<?php echo isset($value->title) ? $value->title : ''; ?>">
                                                                 <?php $tabindex++; ?>
                                                            </div>     
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="<?php echo $tabindex; ?>" class="form-control" placeholder="Taxable Amount" name="charge[<?php echo $i; ?>][amount]" maxlength="200" value="<?php echo isset($value->amount) ? $value->amount : 0; ?>">
                                                                 <?php $tabindex++; ?>
                                                            </div>
                                                             <div class="col-md-2">
                                                                 <input type="text" tabindex="<?php echo $tabindex; ?>" class="form-control" placeholder="GST %" name="charge[<?php echo $i; ?>][gst]" maxlength="200" value="<?php echo isset($value->gst) ? $value->gst : 0; ?>">
                                                                 <?php $tabindex++; ?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="<?php echo $tabindex; ?>" class="form-control" placeholder="Tax Amt" name="charge[<?php echo $i; ?>][taxamt]" maxlength="200" value="<?php echo isset($value->taxamt) ? $value->taxamt : 0; ?>">
                                                                 <?php $tabindex++; ?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <input type="text" tabindex="<?php echo $tabindex; ?>" class="form-control" placeholder="grandtotal" name="charge[<?php echo $i; ?>][ftotal]" maxlength="200" value="<?php echo isset($value->ftotal) ? $value->ftotal : 0; ?>">
                                                                 <?php $tabindex++; ?>
                                                            </div>                                                           
                                                        </div>
                                                    </div>

                                                    <?php } ?>
                                                </div>
                                                
<div class="modal-footer pull-left">
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="<?php echo $tabindex; ?>" />
</div>
<?php echo form_close(); ?> 