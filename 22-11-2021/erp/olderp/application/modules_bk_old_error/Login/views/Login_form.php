<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset">
            <div class="login-bg" style="background-image:url(<?php echo base_url(); ?>assets/pages/img/login/bg1.jpg)">
                <img class="login-logo" src="http://www.thegreenbattiproject.in/images/gbp-logo-home.png" /> 
            </div>
        </div>
        <div class="col-md-6 login-container bs-reset">
            <div class="login-content">
                <h1>nbgroup | Admin</h1>
                <!-- <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>-->
                   <?php  $atr = array('class' => 'login-form');
            echo form_open($action,$atr); ?>
                    <?php
                        if(!empty($error)){
                            $msg = $error; ?>
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                    <span><?php echo $msg ?></span>
                            </div>
                        <?php } ?>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Enter valid e-mail address and password. </span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">                             
                            <input  name="aus_UserName" id="txtUserName" type="email" placeholder="admin@company.com" required class="form-control form-control-solid placeholder-no-fix form-group">
                        </div>
                        <div class="col-xs-6">                            
                            <input type="password" name="aus_Password" id="txtPassword" placeholder="Password" required class="form-control form-control-solid placeholder-no-fix form-group">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                            </div>
                            <button class="btn blue" type="submit" name="btnLogin" id="btnLogin">Sign In</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form" action="javascript:;" method="post">
                    <h3 class="font-green">Forgot Password ?</h3>
                    <p> Enter your e-mail address below to reset your password. </p>
                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn grey btn-default">Back</button>
                        <button type="submit" class="btn blue btn-success uppercase pull-right">Submit</button>
                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-5 bs-reset">
                        
                    </div>
                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy; nbgroup <?php echo date("Y"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
