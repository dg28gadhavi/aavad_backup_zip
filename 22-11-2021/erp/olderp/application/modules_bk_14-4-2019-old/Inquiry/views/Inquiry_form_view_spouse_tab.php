<div class="tab-pane tab-space" id="tab_1_1_4">                        
                    <div class="portlet-body">
                        <div id="spouse_detailsall">
                                    <h3>Spouse Details</h3>
                                    <hr />
                                    <!-- <h5><strong>At Birth</strong></h5> -->
                                    <div class="row" style="display:none">                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label col-md-4">First Name</label>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" id="spouse_fname" name="basic_details[2][bd_bfname]" value="<?php echo isset($list['basic_details'][1]['bd_bfname']) ? $list['basic_details'][1]['bd_bfname'] : ""; ?>" tabindex="1" maxlength="40">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label col-md-4">Middle Name</label>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" id="spouse_mname" name="basic_details[2][bd_bmname]" value="<?php echo isset($list['basic_details'][1]['bd_bmname']) ? $list['basic_details'][1]['bd_bmname'] : ""; ?>" tabindex="2" maxlength="40">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label col-md-5">Last Name of birth</label>
                                                    <div class="col-md-7">
                                                    <input type="text" class="form-control" id="spouse_lbname" name="basic_details[2][lbname]" value="<?php echo isset($list['basic_details'][1]['bd_lname']) ? $list['basic_details'][1]['bd_lname'] : ""; ?>" tabindex="3" maxlength="40">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                   
                                    <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label col-md-4">First Name</label>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" id="mother_fname" name="basic_details[2][fname]" value="<?php echo isset($list['basic_details'][1]['bd_fname']) ? $list['basic_details'][1]['bd_fname'] : ""; ?>" tabindex="4" maxlength="40">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label col-md-4">Middle Name</label>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" id="mother_mname" name="basic_details[2][mname]" value="<?php echo isset($list['basic_details'][1]['bd_mname']) ? $list['basic_details'][1]['bd_mname'] : ""; ?>" tabindex="5" maxlength="40">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label col-md-6">Last Name after marriage, if applicable</label>
                                                    <div class="col-md-6">
                                                    <input type="text" class="form-control" id="mother_lnmarriage" name="basic_details[2][lmname]" value="<?php echo isset($list['basic_details'][1]['bd_lname_mrg']) ? $list['basic_details'][1]['bd_lname_mrg'] : ""; ?>" tabindex="6" maxlength="40">
                                                    </div>
                                                </div>
                                            </div>                                
                                    </div>
                                    <div class="row">
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <label class="control-label col-md-3">Date of Birth</label>
                                    <div class="col-md-3">                               
                                        <select class="form-control spo_dobchange" id="spo_dobdays" name="basic_details[2][dbirth_day]">
                                        <option value=''>Select Day</option>
                                        <?php for($days = 1;$days<=31;$days++)
										{ ?>
                                        	<option value="<?php echo $days ?>" <?php if(isset($list['basic_details'][1]['bd_day']) && ($list['basic_details'][1]['bd_day'] != '') && ($list['basic_details'][1]['bd_day'] == $days)){ ?> selected="selected" <?php } ?>><?php echo $days; ?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control spo_dobchange" id="spo_dobmonths" name="basic_details[2][dbirth_month]"><option value=''>Select Month</option>
                                        <?php for($month = 1;$month<=12;$month++)
                                                { ?>
                                                    <option value="<?php echo $month ?>" <?php if(isset($list['basic_details'][1]['bd_month']) && ($list['basic_details'][1]['bd_month'] != '') && ($list['basic_details'][1]['bd_month'] == $month)){ ?> selected="selected" <?php } ?>><?php echo date('F', mktime(0, 0, 0, $month, 10)); // March ?></option>
                                                <?php }?>
                                        </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control spo_dobchange" name="basic_details[2][dbirth_year]" id="spo_dobyears">
                                            <option value="">Select Year</option>
                                            <?php for($year = date('Y');$year>=1947;$year--)
                                                { ?>
                                                    <option value="<?php echo $year ?>" <?php if(isset($list['basic_details'][1]['bd_year']) && ($list['basic_details'][1]['bd_year'] != '') && ($list['basic_details'][1]['bd_year'] == $year)){ ?> selected="selected" <?php } ?>><?php echo $year; // March ?></option>
                                                <?php }?>
                                            </select>                                       
                                        </div>
                                    </div>
                                </div>
                                        <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Age</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" tabindex="21" id="spo_age" name="basic_details[2][age]" value="<?php echo isset($list['basic_details'][0]['bd_age']) ? $list['basic_details'][1]['bd_age'] : ""; ?>" maxlength="21"/>
                                            </div>
                                    </div>
                                </div>                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="col-md-3 control-label">Gender</label>
                                                <div class="col-md-9">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="basic_details[2][gender]" id="optionsRadios25" <?php  if(isset($list['basic_details'][1]['bd_gender']) && ($list['basic_details'][1]['bd_gender'] == 'm')){ ?> checked <?php }  ?> value="1" checked tabindex="9"> Male
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="basic_details[2][gender]" id="optionsRadios26" <?php  if(isset($list['basic_details'][1]['bd_gender']) && ($list['basic_details'][1]['bd_gender'] == 'f')){ ?> checked <?php }  ?> value="2" tabindex="10"> Female
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="basic_details[2][gender]" id="optionsRadios27" <?php  if(isset($list['basic_details'][1]['bd_gender']) && ($list['basic_details'][1]['bd_gender'] == 'o')){ ?> checked <?php }  ?>  value="3" tabindex="11"> Other
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['basic_details'][0]['bd_kids']) && $list['basic_details'][0]['bd_kids'] != ''){ ?>
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Kids</label>
                                                <div class="col-md-8">
                                                  <?php echo isset($list['basic_details'][0]['bd_kids']) ? $list['basic_details'][0]['bd_kids'] : ""; ?>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <?php } ?>
                                        <!--/span-->
                                        </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Mobile No.</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" id="inq_mobile" name="basic_details[2][mobile]" value="<?php echo isset($list['basic_details'][1]['bd_mono']) ? $list['basic_details'][1]['bd_mono'] : ""; ?>" maxlength="15" tabindex="12">
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                          <div class="form-group">
                                                 <label class="control-label col-md-6">What is your Current Status </label>
                                                   <div class="col-md-6">
                                                    <select id="inq_status" name="basic_details[2][status]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose status" tabindex="13">
                                                      <option>Select current Status</option>
                                                       <?php foreach($datas['cstates'] as $cstate) { ?>
                                                       <option value="<?php echo $cstate['cs_id']?>" <?php if(isset($list['basic_details'][1]['bd_curr_status']) && ($list['basic_details'][1]['bd_curr_status'] == $cstate['cs_id'])){ ?> selected="selected" <?php } ?>><?php echo $cstate['cs_name']?></option>
                                                       <?php } ?>
                                                    </select>
                                                   </div>
                                          </div>
                                        </div>
                                         <div class="col-md-4" style="display:none">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Passport No.</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control inq_cnoall" id="inq_pno" name="basic_details[2][pno]"  value="<?php echo isset($list['passport'][1]['up_pp_no']) ? $list['passport'][1]['up_pp_no'] : ""; ?>" maxlength="16" tabindex="14">
                                                </div>
                                            </div>
                                        </div>                   
                                    </div>
                                    <?php //**************************** Education Start ************************** ?>
                                    <hr>
                                        <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['uedu'][1]['uedu_full_education']) && $list['uedu'][0]['uedu_full_education'] != ''){ ?>
                                         <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Education :</label>
                                                    <div class="col-md-8">
                                                      <?php echo isset($list['uedu'][1]['uedu_full_education']) ? $list['uedu'][1]['uedu_full_education'] : ""; ?>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        <?php } ?>
                                      <div id="spouseedu_ajax_main">
                                      </div> 
                                    <?php //**************************** Education End ************************** ?>
                                    <?php //**************************** Experience Start ************************** ?>
                                      <div id="spouseexp_ajax_main">
                                      </div>
                                    <?php //**************************** Experience End ************************** ?>
                                    <br/>
                                    <?php //************************************ Language start **************************** ?>
                                      <div id="spouselang_ajax_main">
                                      </div>
                                    <?php //************************************ Language End **************************** ?>
                                    <?php //************************************ Relative start **************************** ?>
                                      <div id="spouserel_ajax_main">
                                      </div>
                                    <?php //************************************ Relative End **************************** ?>
                                    <?php //************************************ Refusal Details start **************************** ?>
                                      <div id="spouserefu_ajax_main">
                                      </div>
                                    <?php //************************************ Refusal Details End **************************** ?>
                                    <?php //************************************ child Details start **************************** ?>
                                      <div id="spousechdtl_ajax_main">
                                      </div>
                                    <?php //************************************ child Details End **************************** ?>
                                             
                        
                    </div> 
                    <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                     <a href="javascript:;" class="btn default button-previous" id="continue_spouse_back">
                                            <i class="fa fa-angle-left"></i> Back </a>
								<div>
                                </div>
                    </div> 
                    </div>