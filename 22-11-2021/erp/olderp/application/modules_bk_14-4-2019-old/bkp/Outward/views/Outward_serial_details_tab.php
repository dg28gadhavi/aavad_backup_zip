<?php //echo "<pre>"; print_r($itemdetails); die;
//echo "<pre>"; print_r($serialdetails); die;
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open_multipart($action_serial,$clsar); ?>
 <h4>Enter Serial Keys</h4> 
        <?php
if (!empty($success) || $this->session->flashdata('success_item') != '') {
    $msg = !empty($success) ? $success : $this->session->flashdata('success_item');
    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
if (!empty($error) || $this->session->flashdata('error_item') != '') {
    $msg = !empty($error) ? $error : $this->session->flashdata('error_item');
    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
if (!empty($warning) || $this->session->flashdata('warning_item') != '') {
    $msg = !empty($warning) ? $warning : $this->session->flashdata('warning_item');
    echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
?>
       
       <?php $qty = $itemdetails['otwi_qty']; ?>
       <div class="row">
            <?php $x = 1; foreach($serialdetails as $serial) { ?>
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Serial Key<?php echo $x;?></label>
                    <div class="col-md-9">
                   
                        <input type="text"  class="form-control" placeholder="Serial Key" name="outward_serial_keyname[]" maxlength="200" id="outward_serial_keyname1" value="<?php echo isset($serial['outward_serial_keyname']) ? $serial['outward_serial_keyname'] : ''; ?>">
                        
                    </div>
                </div>
            </div>
            <?php $x++; } ?>
            <?php for (; $x <= $qty; $x++) {?>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Serial Key<?php echo $x;?></label>
                        <div class="col-md-9">
                       
                            <input type="text"  class="form-control" placeholder="Serial Key" name="outward_serial_keyname[]" maxlength="200" id="outward_serial_keyname1" value="">
                            
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
                         
<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save"/>
</div>
<?php echo form_close(); ?>
   