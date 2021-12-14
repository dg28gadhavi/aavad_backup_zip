<?php //$clsar = array('class' => 'form-horizontal','autocomplete' => 'off','method' => 'get');
//echo form_open_multipart($action_serial,$clsar); ?>

<?php //echo form_close(); ?>
<?php  //echo "<pre>"; print_r($itemdetails); die;
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
       <?php $qty = $itemdetails['sritm_qty']; ?>
       <div class="row">
            <?php $x = 1; foreach($serialdetails as $serial) { ?>
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Serial Key<?php echo $x;?></label>
                    <div class="col-md-9">
                   
                        <input type="text"  class="form-control outward_serial_keyname" placeholder="Serial Key" name="outward_serial_keyname[]" maxlength="200" id="outward_serial_keyname<?php echo $x; ?>" value="<?php echo isset($serial['sales_return_serial_keyname']) ? $serial['sales_return_serial_keyname'] : ''; ?>">

                        <input type="hidden"  class="form-control outward_serial_keyid" placeholder="Serial Key" name="outward_serial_keyid[]" maxlength="200" id="outward_serial_keyid<?php echo $x; ?>" value="<?php echo isset($serial['sales_return_serial_keyid']) ? $serial['sales_return_serial_keyid'] : ''; ?>">
                        
                    </div>
                </div>
            </div>
            <?php $x++; } ?>
            <?php for (; $x <= $qty; $x++) {?>
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Serial Key<?php echo $x;?></label>
                        <div class="col-md-9">
                            <input type="text"  class="form-control outward_serial_keyname" placeholder="Serial Key" name="outward_serial_keyname[]" maxlength="200" id="outward_serial_keyname<?php echo $x; ?>" value="">
                            <input type="hidden"  class="form-control outward_serial_keyid" placeholder="Serial Key" name="outward_serial_keyid[]" maxlength="200" id="outward_serial_keyid<?php echo $x; ?>" value="">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
                         
<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" onclick="return mysubmit();" class="btn btn-success btn-space" name="submit" value="Save"/>
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

    function mysubmit()
    {
        //alert("hiii");
        var respons = 1;
        var arr = new Array();
        var msg = "";
        var values = $("input[name='outward_serial_keyid']")
              .map(function(){
                //alert($(this).val());
                if($(this).val() == 0 || $(this).val() == '')
                {
                    respons = 0;
                    msg = "Pl. Select All Serial Key.";
                }
                if ($.inArray($(this).val(), arr) > -1)
                {   
                    if(respons != 0)
                    {
                        respons = 0;
                        msg = "Same Serial Key Selected More Than Once.";
                    }
                    
                }else{
                    arr.push($(this).val());
                }
            }).get();

            if(respons == 0)
            {
                
                alert(msg);
                return false;
            }else{
                return true;
            }
    }   
</script>