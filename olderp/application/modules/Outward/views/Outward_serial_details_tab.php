<?php //$clsar = array('class' => 'form-horizontal','autocomplete' => 'off','method' => 'get');
//echo form_open_multipart($action_serial,$clsar); ?>
<div class="row">
    <div class="col-md-2">
        <div class="form-group" id="mcna_namegr">
            <div class="col-md-12">
                <input type="text"  class="form-control" placeholder="Prefix" name="prefix" maxlength="200" id="prefix" value="">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group" id="mcna_namegr">
            <div class="col-md-12">
                <input type="text"  class="form-control" placeholder="Start" name="sstart" maxlength="200" id="sstart" value="">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group" id="mcna_namegr">
            <div class="col-md-12">
                <input type="text"  class="form-control" placeholder="End" name="send" maxlength="200" id="send" value="">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group" id="mcna_namegr">
            <div class="col-md-12">
                <input type="text"  class="form-control" placeholder="Suffix" name="suffix" maxlength="200" id="suffix" value="">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <a href="#" class="btn btn-primary green" onclick="return fill_skeys();"><i class="fa fa-check"></i> Click Here to generate Auto Serail Key</a>
    </div>
</div>
<?php //echo form_close(); ?>
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
                   
                        <input type="text"  class="form-control" placeholder="Serial Key" name="outward_serial_keyname[]" maxlength="200" id="outward_serial_keyname<?php echo $x; ?>" value="<?php echo isset($serial['outward_serial_keyname']) ? $serial['outward_serial_keyname'] : ''; ?>">
                        
                    </div>
                </div>
            </div>
            <?php $x++; } ?>
            <?php for (; $x <= $qty; $x++) {?>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Serial Key<?php echo $x;?></label>
                        <div class="col-md-9">
                       
                            <input type="text"  class="form-control" placeholder="Serial Key" name="outward_serial_keyname[]" maxlength="200" id="outward_serial_keyname<?php echo $x; ?>" value="">
                            
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
<script type="text/javascript">
    function fill_skeys()
    {
        var suffix = $("#suffix").val();
        var prefix = $("#prefix").val();
        var sstart = $("#sstart").val();
        var send = $("#send").val();
        if(sstart != '' && send != '')
        {
            var csx = 1;
            for (; sstart <= send; sstart++,csx++) {
                $("#outward_serial_keyname"+csx).val(prefix+sstart+suffix);
            }
        }else{
            alert("You Need to select start and end field.");
        }
    }
</script>