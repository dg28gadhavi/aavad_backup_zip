
<?php 
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<!-- <h4>Some Input</h4> -->        
<div class="row">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Inward Code</label>
                    <div class="col-md-9">
                       <input type="text" tabindex="1" class="form-control"  name="inw_no" maxlength="200" id="inw_no" value="<?php echo !$this->uri->segment(3) && isset($inw_no) ? $inw_no : ''; ?><?php echo isset($list[0]['inw_no']) ? $list[0]['inw_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Supplier</label>
                    <div class="col-md-9">
                       <input type="text" tabindex="2" class="form-control" placeholder="Supplier" name="inw_suppiler" maxlength="100" id="inw_suppiler" value="<?php echo isset($list[0]['inw_suppiler']) ? $list[0]['inw_suppiler'] : ""; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">                                        
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Bill No</label>
                    <div class="col-md-9">
                       <input type="text" tabindex="3" class="form-control" placeholder="Bill No" name="inw_billno" maxlength="100" id="inw_billno" value="<?php echo isset($list[0]['inw_billno']) ? $list[0]['inw_billno'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Bill Date</label>
                        <div class="col-md-9">
                           <input type="text" tabindex="4" class="form-control form-control-inline input-medium date-picker" placeholder="Po Date" name="inw_billdate" maxlength="200" id="inw_billdate" value="<?php echo isset($list[0]['inw_billdate']) ? date("d-m-Y", strtotime($list[0]['inw_billdate'])) : ""; ?>">
                        </div>
                    </div>
            </div>
        </div>                                        
        <div class="row">                                    
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Challan No</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="5" class="form-control" placeholder="Challan No" name="inw_challan_no" maxlength="200" id="inw_challan_no" value="<?php echo isset($list[0]['inw_challan_no']) ? $list[0]['inw_challan_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Challan Date</label>
                    <div class="col-md-9">
                          <input type="text" tabindex="6" class="form-control form-control-inline input-medium date-picker" placeholder="Po Date" name="inw_challan_date" maxlength="200" id="inw_challan_date" value="<?php echo isset($list[0]['inw_challan_date']) ? date("d-m-Y", strtotime($list[0]['inw_challan_date'])) : ""; ?>">                        
                    </div>
                </div>
            </div>
        </div>     
        <div class="row">                                    
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">LR No</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="7" class="form-control" placeholder="LR No" name="inw_lr_no" maxlength="200" id="inw_lr_no" value="<?php echo isset($list[0]['inw_lr_no']) ? $list[0]['inw_lr_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">LR Date</label>
                    <div class="col-md-9">
                         <input type="text" tabindex="8" class="form-control form-control-inline input-medium date-picker" placeholder="Po Date" name="inw_lr_date" maxlength="200" id="inw_lr_date" value="<?php echo isset($list[0]['inw_lr_date']) ? date("d-m-Y", strtotime($list[0]['inw_lr_date'])) : ""; ?>">
                    </div>
                </div>
            </div>
        </div>    
        <div class="row">            
              <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">INSP No</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="9" class="form-control" placeholder="INSP No" name="inw_insp_no" maxlength="200" id="inw_insp_no" value="<?php echo isset($list[0]['inw_insp_no']) ? $list[0]['inw_insp_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">INSP Date</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="10" class="form-control form-control-inline input-medium date-picker" placeholder="Po Date" name="inw_insp_date" maxlength="200" id="inw_insp_date" value="<?php echo isset($list[0]['inw_insp_date']) ? date("d-m-Y", strtotime($list[0]['inw_insp_date'])) : ""; ?>">
                    </div>
                </div>
            </div>
        </div>        
        <div class="row">                                    
              <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Transporter Name</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="11" class="form-control" placeholder="Transporter Name" name="inw_transport_name" maxlength="200" id="inw_transport_name" value="<?php echo isset($list[0]['inw_transport_name']) ? $list[0]['inw_transport_name'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Material Return</label>
                    <div class="col-md-9">
                        <input type="text" tabindex="12" class="form-control" placeholder="Transporter Name" name="inw_material_return" maxlength="200" id="inw_material_return" value="<?php echo isset($list[0]['inw_material_return']) ? $list[0]['inw_material_return'] : ""; ?>">
                    </div>
                </div>
            </div>
        </div>                                     
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Remark</label>
                    <div class="col-md-9">
                    <textarea class="form-control" tabindex="13" name="inw_remark" placeholder="Remark" id="inw_remark" rows="3"><?php echo isset($list[0]['inw_remark']) ? $list[0]['inw_remark'] : ""; ?></textarea>
                    </div>
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