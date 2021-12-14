<div class="tab-pane tab-space" id="tab_1_1_3">
                        <div class="portlet-body">
                          
                        <?php //**************************** Education Start ************************** ?>
                             <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['uedu'][0]['uedu_full_education']) && $list['uedu'][0]['uedu_full_education'] != ''){ ?>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Full Education</label>
                                        <div class="col-md-8">
                                          <?php echo isset($list['uedu'][0]['uedu_full_education']) ? $list['uedu'][0]['uedu_full_education'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <?php } ?>
                            <div id="meedu_ajax_main">
                            </div>
                        <?php //**************************** Education End ************************** ?>
                        <?php //**************************** Experience Start ************************** ?>
                            <div id="meexp_ajax_main">
                            </div>
                        <?php //**************************** Experience End ************************** ?>
                        <?php //************************************ Language start **************************** ?>
                            <div id="melang_ajax_main">
                            </div>
                        <?php //************************************ Language End **************************** ?>
                        <hr>
                        <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['urel'][0]['urel_relinforeign']) && $list['urel'][0]['urel_relinforeign'] != ''){ ?>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Relatives :</label>
                                        <div class="col-md-8" style="color:#F30">
                                          <?php echo isset($list['urel'][0]['urel_relinforeign']) ? $list['urel'][0]['urel_relinforeign'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <?php } ?>
                        <?php //************************************ Relative start **************************** ?>
                          <div id="merel_ajax_main">
                          </div>
                        <?php //************************************ Relative End **************************** ?>  
                        <?php //************************************ Refusal Details start **************************** ?>
                        <hr>
                        <?php if(($this->uri->segment(2) == 'edit') &&  isset($list['urefu'][0]['urefu_isrefusal']) && $list['urefu'][0]['urefu_isrefusal'] != ''){ ?>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Refusal :</label>
                                        <div class="col-md-8" style="color:#F30">
                                          <?php echo isset($list['urefu'][0]['urefu_isrefusal']) ? $list['urefu'][0]['urefu_isrefusal'] : ""; ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <?php } ?>
                          <div id="merefu_ajax_main">
                          </div>
                        <?php //************************************ Refusal Details End **************************** ?>    
                             <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                     <a href="javascript:;" class="btn default button-previous" id="continue_applicant_back"  tabindex="366">
                                            <i class="fa fa-angle-left"></i> Back </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next" tabindex="367" id="continue_applicant"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                        </div>                   
                       </div>
                      