<div class="modal fade in" id="inquiryselect" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog modal-full">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                               <h4 class="modal-title">Modal Title</h4>
                            </div>
                            <div class="modal-body"> 
                          <?php $inquirys = array('class' => 'form-horizontal');
                        echo form_open($set_action,$inquirys); ?>
   <?php /*?>  #######################  Inquiry Details  ###################<?php */?>
                            <h4><strong>Inquiry Details:</strong></h4>
                                  <div class="row">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Inq.No.</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_no" name="chk_inquiry[inq_no]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Date</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_date" name="chk_inquiry[inq_date]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Inquiry Type</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_type" name="chk_inquiry[inq_type]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Source</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_source" name="chk_inquiry[inq_source]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Sub Source</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_sub_source" name="chk_inquiry[inq_subsource]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Inquiry Status</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_status" name="chk_inquiry[inq_inqstatus]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                   <div class="row">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Country Interested </label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_country" name="chk_inquiry[inq_county]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Country Elegable </label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_ele_country" name="chk_inquiry[inq_ele_country]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                           </div>
                                           <hr>
           <?php /*?>  #######################  Product Details  ###################<?php */?>
                                         <h5>Product Details </h5>
                                          <div class="row">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Product</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_product" name="chk_inquiry[inq_product]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                          <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Type</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_pro_type" name="chk_inquiry[inq_pro_type]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                          <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Category
</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_category" name="chk_inquiry[inq_pro_cat]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                   <hr>
         <?php /*?>  #######################  Basic Details  ###################<?php */?>
                                   <h4><strong>Basic Details</strong> </h4>
                                   <div class="row">
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">First Name</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_no" name="chk_inquiry[bd_fname]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Middle Name</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_date" name="chk_inquiry[bd_lname]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Last Name of birth</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_type" name="chk_inquiry[bd_bfname]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Date of Birth</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_source" name="chk_inquiry[bd_dob]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="control-label col-md-8">Email ID</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" class="form-control" id="check_inq_status" name="chk_inquiry[bd_email]" value="1" />
                                                </div>
                                            </div>
                                        </div>
                                </div> 
                                </div>
                               
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn green">Save changes</button>
                                                </div>
                                            </div>
                                            <div id="inputs"></div>
							 <?php echo form_close(); ?>
                                            <!-- /.modal-content -->
                                        <!-- </div> -->
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>