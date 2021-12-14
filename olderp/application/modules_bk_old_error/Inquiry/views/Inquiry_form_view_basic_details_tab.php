<div class="tab-pane tab-space" id="tab_1_1_2">
      <div class="portlet-body">
                           
                             <div class="row">
                              <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['basic_details'][0]['bd_fullname']) && $list['basic_details'][0]['bd_fullname'] != ''){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Client Name</label>
                                        <div class="col-md-8" style="color:#F30">
                                          <?php echo isset($list['basic_details'][0]['bd_fullname']) ? $list['basic_details'][0]['bd_fullname'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                              </div>
                              <div class="row">
                                 <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['basic_details'][0]['bd_executive']) && $list['basic_details'][0]['bd_executive'] != ''){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Executive</label>
                                        <div class="col-md-8">
                                          <?php echo isset($list['basic_details'][0]['bd_executive']) ? $list['basic_details'][0]['bd_executive'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                              </div>
                              <div class="row">
                              <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['basic_details'][0]['bd_band']) && $list['basic_details'][0]['bd_band'] != ''){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Band</label>
                                        <div class="col-md-8">
                                          <?php echo isset($list['basic_details'][0]['bd_band']) ? $list['basic_details'][0]['bd_band'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                              </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">First Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_fname" name="basic_details[1][fname]" value="<?php echo isset($list['basic_details'][0]['bd_fname']) ? $list['basic_details'][0]['bd_fname'] : ""; ?>" maxlength="40" tabindex="16">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Middle Name</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="inq_mname" name="basic_details[1][mname]" value="<?php echo isset($list['basic_details'][0]['bd_mname']) ? $list['basic_details'][0]['bd_mname'] : ""; ?>" maxlength="40" tabindex="17">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Last Name of birth</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_lbname" name="basic_details[1][lbname]" value="<?php echo isset($list['basic_details'][0]['bd_lname']) ? $list['basic_details'][0]['bd_lname'] : ""; ?>" maxlength="40" tabindex="18">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="display:none">
                                        <label class="control-label col-md-5">Last Name after marriage, if applicable</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="inq_lmname" name="basic_details[1][lmname]" value="<?php echo isset($list['basic_details'][0]['bd_lname_mrg']) ? $list['basic_details'][0]['bd_lname_mrg'] : ""; ?>" maxlength="40" tabindex="19">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="control-label col-md-3">Date of Birth</label>
                                    <div class="col-md-3">                               
                                        <select class="bs-select form-control dobchange" data-live-search="true" data-placeholder="Choose Day" id="dobdays" name="basic_details[1][dbirth_day]">
                                        <option value=''>Select Day</option>
                                        <?php for($days = 1;$days<=31;$days++)
										{ ?>
                                        	<option value="<?php echo $days  ?>" <?php if(isset($list['basic_details'][0]['bd_day']) && ($list['basic_details'][0]['bd_day'] != '') && ($list['basic_details'][0]['bd_day'] == $days)){ ?> selected="selected" <?php } ?> ><?php echo $days; ?>
                                            </option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="bs-select form-control dobchange" data-live-search="true" data-placeholder="Choose Month" id="dobmonths" name="basic_details[1][dbirth_month]"><option value=''>Select Month</option>
                                        <?php for($month = 1;$month<=12;$month++)
                                                { ?>
                                                    <option value="<?php echo $month ?>" <?php if(isset($list['basic_details'][0]['bd_month']) && ($list['basic_details'][0]['bd_month'] != '') && ($list['basic_details'][0]['bd_month'] == $month)){ ?> selected="selected" <?php } ?>><?php echo date('F', mktime(0, 0, 0, $month, 10)); // March ?></option>
                                                <?php }?>
                                        </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="bs-select form-control dobchange" data-live-search="true" data-placeholder="Choose Year" id="dobyears" name="basic_details[1][dbirth_year]">
                                            <option value="">Select Year</option>
                                            <?php for($year = date('Y');$year>=1947;$year--)
                                                { ?>
                                                    <option value="<?php echo $year ?>" <?php if(isset($list['basic_details'][0]['bd_year']) && ($list['basic_details'][0]['bd_year'] != '') && ($list['basic_details'][0]['bd_year'] == $year)){ ?> selected="selected" <?php } ?> ><?php echo $year; // March ?></option>
                                                <?php }?>
                                            </select>                                       
                                        </div>
                                    </div>
                                </div>
                                
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Age</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" tabindex="21" id="inq_age" name="basic_details[1][age]" value="<?php echo isset($list['basic_details'][0]['bd_age']) ? $list['basic_details'][0]['bd_age'] : ""; ?>" maxlength="21"/>
                                            </div>
                                    </div>
                                </div>
                                 <!--/span-->
                                <div class="col-md-3">
                                 <div class="form-group">
                                   <label class="col-md-3 control-label">Gender</label>
                                                <div class="col-md-9">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="basic_details[1][gender]" id="optionsRadios25" <?php  if(isset($list['basic_details'][0]['bd_gender']) && ($list['basic_details'][0]['bd_gender'] == 'm')){ ?> checked <?php }  ?> value="m" tabindex="22" checked > Male
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="basic_details[1][gender]" <?php  if(isset($list['basic_details'][0]['bd_gender']) && ($list['basic_details'][0]['bd_gender'] == 'f')){ ?> checked <?php }  ?> id="optionsRadios26" value="f" tabindex="23"> Female
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="basic_details[1][gender]" <?php  if(isset($list['basic_details'][0]['bd_gender']) && ($list['basic_details'][0]['bd_gender'] == 'o')){ ?> checked <?php }  ?> id="optionsRadios27" value="o" tabindex="24"> Other
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                 </div>
                                </div>
                                <!--/span--> 
                            </div>
                            <div class="row">            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Country of Residance</label>
                                        <div class="col-md-7">
                                            <select id="Country of Residance" name="basic_details[1][city]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose City" tabindex="25">
                                              <option>Select Country</option>
                                              <?php if($this->uri->segment('2') == 'edit') { ?>
                                            <?php foreach($datas['countrys'] as $country) { ?>
                                           <option value="<?php echo  $country['country_id'];?>" <?php if(isset($list['basic_details'][0]['bd_country_of_citizen']) && ($list['basic_details'][0]['bd_country_of_citizen'] == $country['country_id'])){ ?> selected="selected" <?php } ?>><?php echo  $country['country_name'];?></option>
                                           <?php } ?>
                                           <?php } ?>
                                           <?php if($this->uri->segment('2') == 'add') { ?>
                                            <?php foreach($datas['countrys'] as $country) { ?>
                                           <option value="<?php echo  $country['country_id'];?>" <?php if(105 == $country['country_id']) { ?> selected="selected" <?php } ?>><?php echo  $country['country_name'];?></option>
                                           <?php } ?>
                                           <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                         <label class="control-label col-md-6">What is your Current Status </label>
                                           <div class="col-md-6">
                                            <select id="inq_status" name="basic_details[1][status]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose status" tabindex="26">
                                            <option value="">Select current Status</option>
                                            <?php foreach($datas['cstates'] as $cstate) { ?>
                                                       <option value="<?php echo $cstate['cs_id']?>" <?php if(isset($list['basic_details'][0]['bd_curr_status']) && ($list['basic_details'][0]['bd_curr_status'] == $cstate['cs_id'])){ ?> selected="selected" <?php } ?>><?php echo $cstate['cs_name']?>
                                                       </option>
                                                       <?php } ?>
                                                       </select>
                                                       
                                           </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Company Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inq_cname" name="basic_details[1][inq_cname]" value="<?php echo isset($list['basic_details'][0]['bd_company_name']) ? $list['basic_details'][0]['bd_company_name'] : ""; ?>" maxlength="40" tabindex="27"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">  
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label class="control-label col-md-5">Present marital Status</label>
                                    <div class="col-md-7">
                                        <select id="fam_pmarital" name="basic_details[1][fam_pmarital]" onchange="showDiv(this)" class="bs-select form-control" data-live-search="true" data-placeholder="Choose State" tabindex="28">								<option value="0">Present Marital Status</option>
                                           <option value="1" <?php if(isset($list['basic_details'][0]['bd_mari_status']) && ($list['basic_details'][0]['bd_mari_status'] == 1)){ ?> selected="selected" <?php } ?>>Single</option>
                                           <option value="2" <?php if(isset($list['basic_details'][0]['bd_mari_status']) && ($list['basic_details'][0]['bd_mari_status'] == 2)){ ?> selected="selected" <?php } ?>>Married</option>
                                           <option value="3" <?php if(isset($list['basic_details'][0]['bd_mari_status']) && ($list['basic_details'][0]['bd_mari_status'] == 3)){ ?> selected="selected" <?php } ?>>De facto Spouse</option>
                                           <option value="4" <?php if(isset($list['basic_details'][0]['bd_mari_status']) && ($list['basic_details'][0]['bd_mari_status'] == 4)){ ?> selected="selected" <?php } ?>>Separated</option>
                                           <option value="5" <?php if(isset($list['basic_details'][0]['bd_mari_status']) && ($list['basic_details'][0]['bd_mari_status'] == 5)){ ?> selected="selected" <?php } ?>>Divorced </option>
                                           <option value="6" <?php if(isset($list['basic_details'][0]['bd_mari_status']) && ($list['basic_details'][0]['bd_mari_status'] == 6)){ ?> selected="selected" <?php } ?>>Widowed</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Passport No.</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control inq_cnoall" id="inq_email" name="basic_details[1][pno]" value="<?php echo isset($list['passport'][0]['up_pp_no']) ? $list['passport'][0]['up_pp_no'] : ""; ?>"  maxlength="16" tabindex="29"/>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                         <div class="form-group">
                                          <label class="control-label col-md-6">Net Worth in Crore</label>
                                           <div class="col-md-6">
                                                <select id="o_networth" name="basic_details[1][o_networth]" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Net Worth" tabindex="30">
                                                  <option>Select networth</option>
                                                   <?php foreach($datas['networth'] as $nw) { ?>
                                           <option value="<?php echo  $nw['nw_id'];?>" <?php if(isset($list['basic_details'][0]['bd_net_worth']) && ($list['basic_details'][0]['bd_net_worth'] == $nw['nw_id'])){ ?> selected="selected" <?php } ?>><?php echo  $nw['nw_name'];?></option>
                                           <?php } ?>
                                                </select>
                                           </div>
                                        </div>
                              </div> 
                            </div>
                            <?php //************************************ Address 1 Details start **************************** ?>
                            <div class="row">
                              <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['address'][0]['add_area_text']) && $list['address'][0]['add_area_text'] != ''){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Area</label>
                                        <div class="col-md-8">
                                          <?php echo isset($list['address'][0]['add_area_text']) ? $list['address'][0]['add_area_text'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                              </div>
                          <div id="meadd1_ajax_main">
                          </div>
                        <?php //************************************Address 1 Details End **************************** ?> 
                        <h3>Contact No.</h3>
                           <hr />
                            <div class="contact_all">
                                <div class="contact_1">
                                   <div class="row">
                                   <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email ID<span class="" aria-required="true">  </span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                          <input id="basicemail" name="basic_details[1][basicemail]" value="<?php echo isset($list['basic_details'][0]['bd_email']) ? $list['basic_details'][0]['bd_email'] : ""; ?>"  type="email" class="form-control" placeholder="Email Address"  tabindex="91"> </div>
                                        </div>
                                </div>
                             </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                           <div class="col-md-3">
                                                <input type="text" class="form-control inq_cnoall" id="inq_cno1" name="contact[inq_cno]"  maxlength="15" value="(M)" disabled="disabled">
                                             </div>
                                             <div class="col-md-9">
                                                <input type="text" class="form-control inq_cnoall" id="inq_cno1" name="contact[inq_cmno]" value="<?php echo isset($list['contact'][0]['con_no_mnos']) ? $list['contact'][0]['con_no_mnos'] : ""; ?>" tabindex="92" maxlength="15">
                                             </div>
                                         </div>
                                        </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                           <div class="col-md-3">
                                                <input type="text" class="form-control inq_cnoall" id="inq_cno1" name="contact[inq_cno]"  maxlength="15" value="(H)" disabled="disabled">
                                             </div>
                                             <div class="col-md-9">
                                                <input type="text" class="form-control inq_cnoall" id="inq_cno1" name="contact[inq_chno]" value="<?php echo isset($list['contact'][0]['con_no_hnos']) ? $list['contact'][0]['con_no_hnos'] : ""; ?>" tabindex="93" maxlength="15">
                                             </div>
                                         </div>
                                        </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                           <div class="col-md-3">
                                                <input type="text" class="form-control inq_cnoall" id="inq_cno1" name="contact[inq_cno]"  maxlength="15" value="(W)" disabled="disabled">
                                             </div>
                                             <div class="col-md-9">
                                                <input type="text" class="form-control inq_cnoall" id="inq_cno1" name="contact[inq_cwno]" value="<?php echo isset($list['contact'][0]['con_no_wnos']) ? $list['contact'][0]['con_no_wnos'] : ""; ?>" tabindex="94" maxlength="15">
                                             </div>
                                         </div>
                                        </div>
                                   </div>
                               </div>
                            </div>
                           <h3 style="display:none;">Login Details</h3>
                           <hr /> 
                           <div class="row" style="display:none;">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email ID</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                          <input id="emailid" name="basic_details[1][emailid]" value="<?php echo isset($list['basic_details'][0]['bd_login_email']) ? $list['basic_details'][0]['bd_login_email'] : ""; ?>" type="email" class="form-control" placeholder="Email Address"  tabindex="95"> </div>
                                        </div>
                                </div>
                             </div>
                            </div>
                            <div class="row" style="display:none;">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Password</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="password" name="basic_details[1][password]"  type="password" class="form-control" placeholder="Password" tabindex="96">
                                            </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                           <!--/row-->
                           <div class="row" style="display:none;">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Confirm Password</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <input id="confirmpwd" name="basic_details[1][confirmpwd]" type="password" class="form-control" placeholder="Confirm Password" tabindex="97">
                                            </div>
                                        </div>
                                </div>
                              </div>
                           </div>
                           <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Remark :</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="4" id="basic_remark" name="basic_details[1][basic_remark]" value="" tabindex="98"><?php echo isset($list['basic_details'][0]['bd_remark']) ? $list['basic_details'][0]['bd_remark'] : ""; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                     <a href="javascript:;" class="btn default button-previous" id="continue_basic_back" tabindex="99">
                                            <i class="fa fa-angle-left"></i> Back </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next" tabindex="100" id="continue_basic"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                        
                           </div>
                        </div>
 