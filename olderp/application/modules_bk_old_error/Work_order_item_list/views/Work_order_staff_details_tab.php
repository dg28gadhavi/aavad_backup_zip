<div class="portlet-body">
    <?php if(isset($this->session->userdata['miconlogin']) && (isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3))))
                                        { ?>
            <h4>Admin Approve</h4>
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Stock</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Confirm Qty</th>
                                 <th  width="2%">Open Qty</th>
                                <th  width="2%">Opratation</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                         <?php //echo "<pre>"; print_r($list); die;
                                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                                echo form_open_multipart(base_url()."Work_order/admin_aprove/".$this->uri->segment(3)."?itm_id=".$row['woi_id'],$clsar); ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['tcreditpoints'] - $row['tdebitpoints'];?></td>
                            <td><?php echo $row['woi_qty'];?><input type="hidden" tabindex="18" class="form-control" placeholder="Quantity" name="staff_ori_qty" maxlength="200" id="staff_ori_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_qty" maxlength="200" id="staff_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_admin_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_open_qty" maxlength="200" id="staff_open_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_admin_open_qty'];?>" readonly="readonly"></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td> <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Update" tabindex="10"/>
                            </td>
                           
                        </tr>
                        <?php echo form_close(); ?>
                           <?php } } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                     <?php if(isset($this->session->userdata['miconlogin']) && ((isset($this->session->userdata['miconlogin']['dep_id']) && $this->session->userdata['miconlogin']['dep_id'] == 10 ) || (isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))))
                                        { ?>
                    <h4>Sales Manager Approve</h4>
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Stock</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Approve Qty</th>
                                <th  width="2%">Confirm Qty</th>
                                 <th  width="2%">Open Qty</th>
                                 <th  width="2%">Complete Qty</th>
                                <th  width="2%">Opratation</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                         <?php //echo "<pre>"; print_r($list); die;
                                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                                echo form_open_multipart(base_url()."Work_order/manager_aprove/".$this->uri->segment(3)."?itm_id=".$row['woi_id'],$clsar); ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['tcreditpoints'] - $row['tdebitpoints'];?></td>
                            <td><?php echo $row['woi_qty'];?><input type="hidden" tabindex="18" class="form-control" placeholder="Quantity" name="staff_ori_qty" maxlength="200" id="staff_ori_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_admin_qty'];?>"></td>

                            <td><?php echo $row['woi_admin_qty'];?></td>

                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_qty" maxlength="200" id="staff_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_manager_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_open_qty" maxlength="200" id="staff_open_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_manager_open_qty'];?>" readonly="readonly"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_complete_qty" maxlength="200" id="staff_complete_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_manager_complete_qty'];?>" readonly="readonly"></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td> <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Update" tabindex="10"/>
                            </td>
                           
                        </tr>
                        <?php echo form_close(); ?>
                           <?php } } ?>
                        </tbody>
                    </table>

                <?php } ?>
                   <!--  <h4>Production Approve</h4>
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Stock</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Confirm Qty</th>
                                 <th  width="2%">Open Qty</th>
                                <th  width="2%">Opratation</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                         <?php //echo "<pre>"; print_r($list); die;
                                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                                echo form_open_multipart(base_url()."Work_order/production_aprove/".$this->uri->segment(3)."?itm_id=".$row['woi_id'],$clsar); ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['tcreditpoints'] - $row['tdebitpoints'];?></td>
                            <td><?php echo $row['woi_qty'];?><input type="hidden" tabindex="18" class="form-control" placeholder="Quantity" name="staff_ori_qty" maxlength="200" id="staff_ori_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_qty" maxlength="200" id="staff_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_production_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_open_qty" maxlength="200" id="staff_open_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_production_open_qty'];?>" readonly="readonly"></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td> <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Update" tabindex="10"/>
                            </td>
                           
                        </tr>
                        <?php echo form_close(); ?>
                           <?php } } ?>
                        </tbody>
                    </table> -->

                    <!-- <h4>Store Approve</h4>
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Stock</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Confirm Qty</th>
                                 <th  width="2%">Open Qty</th>
                                <th  width="2%">Opratation</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                         <?php //echo "<pre>"; print_r($list); die;
                                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                                echo form_open_multipart(base_url()."Work_order/store_aprove/".$this->uri->segment(3)."?itm_id=".$row['woi_id'],$clsar); ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['tcreditpoints'] - $row['tdebitpoints'];?></td>
                            <td><?php echo $row['woi_qty'];?><input type="hidden" tabindex="18" class="form-control" placeholder="Quantity" name="staff_ori_qty" maxlength="200" id="staff_ori_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_qty" maxlength="200" id="staff_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_store_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_open_qty" maxlength="200" id="staff_open_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_store_open_qty'];?>" readonly="readonly"></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td> <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Update" tabindex="10"/>
                            </td>
                           
                        </tr>
                        <?php echo form_close(); ?>
                           <?php } } ?>
                        </tbody>
                    </table>

                    <h4>Account Approve</h4>
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Stock</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Confirm Qty</th>
                                 <th  width="2%">Open Qty</th>
                                <th  width="2%">Opratation</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                         <?php //echo "<pre>"; print_r($list); die;
                                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                                echo form_open_multipart(base_url()."Work_order/account_aprove/".$this->uri->segment(3)."?itm_id=".$row['woi_id'],$clsar); ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['tcreditpoints'] - $row['tdebitpoints'];?></td>
                            <td><?php echo $row['woi_qty'];?><input type="hidden" tabindex="18" class="form-control" placeholder="Quantity" name="staff_ori_qty" maxlength="200" id="staff_ori_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_qty" maxlength="200" id="staff_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_account_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_open_qty" maxlength="200" id="staff_open_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_account_open_qty'];?>" readonly="readonly"></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td> <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Update" tabindex="10"/>
                            </td>
                           
                        </tr>
                        <?php echo form_close(); ?>
                           <?php } } ?>
                        </tbody>
                    </table>
                    <h4>Dispatch Approve</h4>
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Stock</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Confirm Qty</th>
                                 <th  width="2%">Open Qty</th>
                                <th  width="2%">Opratation</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                         <?php //echo "<pre>"; print_r($list); die;
                                $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
                                echo form_open_multipart(base_url()."Work_order/dispatch_aprove/".$this->uri->segment(3)."?itm_id=".$row['woi_id'],$clsar); ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['tcreditpoints'] - $row['tdebitpoints'];?></td>
                            <td><?php echo $row['woi_qty'];?><input type="hidden" tabindex="18" class="form-control" placeholder="Quantity" name="staff_ori_qty" maxlength="200" id="staff_ori_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_qty" maxlength="200" id="staff_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_dispatch_qty'];?>"></td>
                            <td><input type="text" tabindex="18" class="form-control" placeholder="Quantity" name="staff_open_qty" maxlength="200" id="staff_open_qty<?php echo $row['woi_id']; ?>" value="<?php echo $row['woi_dispatch_open_qty'];?>" readonly="readonly"></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td> <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Update" tabindex="10"/>
                            </td>
                           
                        </tr>
                        <?php echo form_close(); ?>
                           <?php } } ?>
                        </tbody>
                    </table> -->
        </div>   