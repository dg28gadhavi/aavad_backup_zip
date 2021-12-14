<?php
//echo "<pre>"; print_r($this->session->userdata('miconlogin')); die;
function encrypt_decrypt($action, $string)
    {
        
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
 ?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<title>Aavad Instrument Erp</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="Preview page of Metronic Admin Theme #5 for statistics, charts, recent events and reports" name="description" />
<meta content="" name="author" />
<!-- BEGIN LAYOUT FIRST STYLES -->
<!-- <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" /> -->
<!-- END LAYOUT FIRST STYLES -->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
<link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo base_url(); ?>assets/layouts/layout5/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/layouts/layout5/css/custom.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>skin/css/style.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
<style type="text/css">
    .page-header .navbar-fixed-top{
        <?php if($this->session->userdata('miconlogin') && isset($this->session->userdata['miconlogin']['colorcode']) && ($this->session->userdata['miconlogin']['colorcode'] != '')){
                                    echo "box-shadow: 0px 0px 3px ".$this->session->userdata['miconlogin']['colorcode'].';';
                                    }else{ echo "box-shadow: 0px 0px 3px #836234;"; } ?>
        background:<?php if($this->session->userdata('miconlogin') && isset($this->session->userdata['miconlogin']['colorcode']) && ($this->session->userdata['miconlogin']['colorcode'] != '')){
                                    echo $this->session->userdata['miconlogin']['colorcode'];
                                    }else{ echo "#d2b68e;"; } ?>
    }
    body{
        background:<?php if($this->session->userdata('miconlogin') && isset($this->session->userdata['miconlogin']['colorcode']) && ($this->session->userdata['miconlogin']['colorcode'] != '')){
                                    echo $this->session->userdata['miconlogin']['colorcode'];
                                    }else{ echo "#d2b68e;"; } ?>
    }
    .btn-notify {
        padding-right: 10px;
    }
    .dropdown-menu-v2 {                
        right: 11px;
    }
 </style>
 <style type="text/css">
    .tagline { height: 50px; overflow: hidden; position: relative;}
    .tagline h3 { font-size: 16px; font-weight: 600; color: #fff; position: absolute; width: 100%; height: 100%; margin: 0; line-height: 50px; text-align: center;
        /* Starting position */
        -moz-transform:translateX(100%);
        -webkit-transform:translateX(100%);    
        transform:translateX(100%);
        /* Apply animation to this element */  
        -moz-animation:tagline 25s linear infinite;
        -webkit-animation:tagline 25s linear infinite;
        animation:tagline 25s linear infinite;
        }
        /* Move it (define the animation) */
        @-moz-keyframes tagline {
        0%   { -moz-transform: translateX(100%); }
        100% { -moz-transform: translateX(-100%); }
        }
        @-webkit-keyframes tagline {
        0%   { -webkit-transform: translateX(100%); }
        100% { -webkit-transform: translateX(-100%); }
        }
        @keyframes tagline {
        0%   { 
        -moz-transform: translateX(100%); /* Firefox bug fix */
        -webkit-transform: translateX(100%); /* Firefox bug fix */
        transform: translateX(100%);       
        }
        100% { 
        -moz-transform: translateX(-100%); /* Firefox bug fix */
        -webkit-transform: translateX(-100%); /* Firefox bug fix */
        transform: translateX(-100%); 
        }
        }
        .tagline h3:hover {
         -moz-animation-play-state: paused;
         -webkit-animation-play-state: paused;
         animation-play-state: paused;
        }
</style>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
</script> 
</head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN CONTAINER -->
        <div class="wrapper">
            <!-- BEGIN HEADER -->
            <header class="page-header">
                <nav class="navbar mega-menu" role="navigation">
                    <div class="container-fluid">
                        <div class="clearfix navbar-fixed-top">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="toggle-icon">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span>
                            </button>
                            <!-- End Toggle Button -->
                            <!-- BEGIN LOGO -->
                            <a id="index" class="page-logo" href="<?php echo base_url(); ?>">
                                <img src="<?php echo base_url(); ?>skin/images/logo_signeture.png" alt="Logo"> </a>
                            <!-- END LOGO -->
                            <!-- BEGIN SEARCH -->
                           <!--  <form class="search" action="extra_search.html" method="GET">
                                <input type="name" class="form-control" name="query" placeholder="Search...">
                                <a href="javascript:;" class="btn submit md-skip">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form> -->
                            <!-- END SEARCH -->


                    <div class="col-md-8">
                            <div class="tagline">
                                <h3>
                                    <?php
                                    if($admin_data!=NULL) {
                                        echo "Happy Birthday ". $admin_data[0]['au_fname'] ." ||";                                     
                                    }
                                     elseif($admin_data ==NULL){
                                        
                                    }   
                                    if($anniversary!=NULL) {
                                        echo "  Happy Anniversary ". $anniversary[0]['au_fname'] ." ||";                                  
                                    }elseif($anniversary ==NULL){
                                        
                                    }

                                   if($joining != NULL) {
                                        echo "  Joining Anniversary ". $joining[0]['au_fname'] ." ||";                               
                                    }elseif($joining == NULL){
                                   
                                   }?>

                               <?php 
                               $i=0;
                               foreach($tagline_data['tagline_data'] as $key => $tagline) { 
                                $i++;
                                if($i==1) {
                                    echo " ". $tagline['tagline_name'];
                                }else{
                                     echo " || ". $tagline['tagline_name'];

                                }
                            } ?> </h3>
                            </div>

                       </div>

                       
                            <div class="topbar-actions">
                                <!-- BEGIN GROUP NOTIFICATION -->
                               <div class="btn-group-notification btn-group btn-notify" id="header_notification_bar">
                                    <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <i class="icon-bell"></i>
                                        <span class="badge"><?php echo isset($data['count']) ? $data['count'] : 0; ?></span>
                                    </button>
                                    <ul class="dropdown-menu-v2">
                                        <li class="external">
                                            <h3>
                                                <span class="bold"><?php echo isset($data['count']) ? $data['count'] : 0; ?> pending</span> notifications</h3>
                                            <a href="<?php echo base_url();?>Notification_list">view all</a>
                                        </li>
                                        <li>
                                            <ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
                                                <?php foreach ($data['result'] as $key => $value) { ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Dashboard_workorder_final#wonoids<?php echo $value['wo_noti_woid']; ?>">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-success md-skip">
                                                                <i class="fa fa-plus"></i>
                                                            </span><?php echo $value['wo_noti_msg']; ?></span>
                                                        <span class="time"><?php echo $value['wo_noti_date']; ?></span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END GROUP NOTIFICATION -->
                                <!-- BEGIN GROUP INFORMATION -->
                              
                                <!-- END GROUP INFORMATION -->
                                <!-- BEGIN USER PROFILE -->
                                <div class="btn-group-img btn-group">
                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <span>Hi, <?php if($this->session->userdata('miconlogin') && isset($this->session->userdata['miconlogin']['fname']) && ($this->session->userdata['miconlogin']['fname'] != '')){
                                            echo $this->session->userdata['miconlogin']['fname'];
                                        }else if($this->session->userdata('login') && isset($this->session->userdata['miconlogin']['fname']) && ($this->session->userdata['miconlogin']['fname'] != '')){
                                            echo $this->session->userdata['login']['fname'];
                                        } ?></span>
                                        <?php if(isset($this->session->userdata['miconlogin']['image']) && $this->session->userdata['miconlogin']['image'] != '') { 
                                            $image = $this->session->userdata['miconlogin']['image'];
                                        }else{
                                            $image = '';
                                        }
                                            ?>
                                        <img src="<?php echo base_url();?>uploads/au_photo/<?php echo $image; ?>" alt=""> </button>
                                       
                                    <ul class="dropdown-menu-v2" role="menu">
                                        <li>
                                            <a href="<?php echo base_url();?>Admin_users/admin_seting">
                                                <i class="fa fa-wrench"></i> Settings </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>Admin_users/retype_password/<?php echo $this->session->userdata['miconlogin']['userid']; ?>">
                                                <i class="fa fa-key"></i> Change Password </a>
                                        </li>
                                         <li>
                                            <a href="<?php echo base_url();?>Login/logout">
                                                <i class="fa fa-sign-out"></i> Log Out </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <!-- END USER PROFILE -->
                                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                
                                <!-- END QUICK SIDEBAR TOGGLER -->
                            </div>
                        </div>
                        <!-- BEGIN HEADER MENU -->
                        <?php echo $this->load->view('includes/menu'); ?>
                        <!-- END HEADER MENU -->
                    </div>
                    <!--/container-->
                </nav>
            </header>
            <!-- END HEADER -->