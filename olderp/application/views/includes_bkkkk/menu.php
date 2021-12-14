	<?php //echo encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);die;
 //echo '<pre>';print_r(encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid'])); ?>
 <?php    // ***************************** ROLE MANAGEMENT START ********************** ?>


     <?php
//echo "<pre>"; print_r(($this->session->userdata['login']['rights'])); die;
    if(isset($this->session->userdata['miconlogin']) && $this->session->userdata['miconlogin']['typeid'] != 5)
    {
        //echo "<pre>"; print_r($this->session->userdata['miconlogin']['userid']); die;
        $dec_userid = $this->session->userdata['miconlogin']['userid'];
        //$decid = encrypt_decrypt('decrypt',$dec_userid);
    }
     ?>
 
 <?php    // ***************************** ROLE MANAGEMENT END ********************** ?>
 <?php $typeid = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
 ?>
<div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                                <?php if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 2) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))
                {  ?>
                                <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if(!$this->uri->segment(1) || ($this->uri->segment(1) && ($this->uri->segment(1) == 'dashboard')) || ($this->uri->segment(1) && ($this->uri->segment(1) == 'Work_order_dashboard') ||  ($this->uri->segment(1) == 'User_dashboard') ||  ($this->uri->segment(1) == 'Dashboard_inq_monthly_report') ||  ($this->uri->segment(1) == 'Dashboard_daily_report') || ($this->uri->segment(1) == 'User_dashboard_sales')  || ($this->uri->segment(1) == 'Dashboard_qoutation') || ($this->uri->segment(1) == 'Dashboard'))){ ?>  active open selected <?php } ?>">
                                    <a href="javascript::void(0)" class="text-uppercase">
                                        <i class="icon-home"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="active">
                                            <a href="<?php echo base_url(); ?>Dashboard?start_date=<?php echo $_SESSION['start_date']; ?>&end_date=<?php echo $_SESSION['end_date']; ?>">
                                                <i class="icon-bar-chart"></i> Inquiry Dashboard </a>
                                        </li>
                                        <li class="active">
                                            <a href="<?php echo base_url(); ?>Dashboard_qoutation?start_date=<?php echo $_SESSION['start_date']; ?>&end_date=<?php echo $_SESSION['end_date']; ?>">
                                                <i class="icon-bar-chart"></i> Quotation Dashboard </a>
                                        </li>
                                        <li class="active">
                                            <a href="<?php echo base_url(); ?>Dashboard/work_order_stats?start_date=<?php echo $_SESSION['start_date']; ?>&end_date=<?php echo $_SESSION['end_date']; ?>">
                                                <i class="icon-bar-chart"></i> Dashboard Workorkorder</a>
                                        </li>
                                        
                                        <?php /* <!-- <li class="active">
                                            <a href="<?php// echo base_url(); ?>Work_order_dashboard">
                                                <i class="icon-bar-chart"></i> Work Order Dashboard </a>
                                        </li> --> */ ?>
                                      <?php /*  <li class="active">
                                            <a href="<?php echo base_url(); ?>Dashboard_inq_monthly_report?id=<?php echo $dec_userid;?>">
                                                <i class="icon-bar-chart"></i>  Monthly Executive Report </a>
                                        </li>
                                        <li class="active">
                                            <a href="<?php echo base_url(); ?>Dashboard_daily_report">
                                                <i class="icon-bar-chart"></i>  Daily Executive Report </a>
                                        </li>
                                          <li class="active">
                                            <a href="<?php echo base_url(); ?>User_dashboard">
                                                <i class="icon-bar-chart"></i> VISA File Dashboard File Executive</a>
                                        </li>
                                        <li class="active">
                                            <a href="<?php echo base_url(); ?>User_dashboard_sales">
                                                <i class="icon-bar-chart"></i> VISA File Dashboard Sales Executive</a>
                                        </li> */ ?>
                                    </ul>
                                </li>
                                <?php } ?>
<?php // *************************** MASTER ADMIN START ****************************************************?>
                               <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Admin_users') || ($this->uri->segment(1) == 'Role_management') ||($this->uri->segment(1) == 'Admin_type') || ($this->uri->segment(1) == 'Inquiry_type')  || ($this->uri->segment(1) == 'Master_item') || ($this->uri->segment(1) == 'Master_item') || ($this->uri->segment(1) == 'Master_party') || ($this->uri->segment(1) == 'Master_item_unit') || ($this->uri->segment(1) == 'Tax') || ($this->uri->segment(1) == 'Inquiry_status') || ($this->uri->segment(1) == 'Country') || ($this->uri->segment(1) == 'Area') || ($this->uri->segment(1) == 'State') || ($this->uri->segment(1) == 'City') || ($this->uri->segment(1) == 'Department') || ($this->uri->segment(1) == 'Item_heads') || ($this->uri->segment(1) == 'Admin_type') || ($this->uri->segment(1) == 'Globalconf') || ($this->uri->segment(1) == 'Brand') || ($this->uri->segment(1) == 'Prefix') || ($this->uri->segment(1) == 'Mode_inquiry') || ($this->uri->segment(1) == 'Mode_delivery') || ($this->uri->segment(1) == 'Product') || ($this->uri->segment(1) == 'Product_type') || ($this->uri->segment(1) == 'Product_cat') || ($this->uri->segment(1) == 'Hsncode')|| ($this->uri->segment(1) == 'Payment_mode')|| ($this->uri->segment(1) == 'Payment_term') || ($this->uri->segment(1) == 'Task_type') || ($this->uri->segment(1) == 'Customer_type') || ($this->uri->segment(1) == 'Module')|| ($this->uri->segment(1) == 'B2b_settings') || ($this->uri->segment(1) == 'Tagline')){ ?>  active open selected <?php } ?>  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        
                                            <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Admin_users')){ ?>active<?php } ?>" >
                                                <a href="#">Admin Users</a>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))
                                                    { ?>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>Admin_users"> Admin Users List </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>Admin_users/add"> Admin Users Add </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>Team_type"> Group Create </a>
                                                    </li>
                                                    <?php }else{ ?>
                                                        <?php if((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 6)){ ?>
                                                            <li>
                                                                <a href="<?php echo base_url(); ?>Admin_users"> Admin Users List </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url(); ?>Admin_users/add"> Admin Users Add </a>
                                                            </li>
                                                        <?php } ?>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>Admin_users/edit/<?php echo $this->session->userdata['miconlogin']['userid']; ?>"> Edit Your Details </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>Salary_cal/View">Salary View</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>Admin_users/retype_password/<?php echo $this->session->userdata['miconlogin']['userid']; ?>"> Change Password </a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3))
                                                    { ?>
                                                    <li>
                                                       <a href="<?php echo base_url(); ?>Admin_type">  Admin type List</a>
                                                    </li>
                                                    <li>
                                                       <a href="<?php echo base_url(); ?>Role_management">  Role List</a>
                                                    </li>
                                                    <li>
                                                       <a href="<?php echo base_url(); ?>Role_management/add">  Role Add</a>
                                                    </li>
                                                    <li>
                                                       <a href="<?php echo base_url(); ?>B2b_settings/edit/TWVWZ29PR3RNZ2hEVVVSQ1dZZEs3QT09"> B2B Settings</a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                       
                                          
 <?php // *************************** MASTER ADMIN END ****************************************************?>
<?php if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 2) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 11) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 5) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 6)))
                {  ?>
 <?php // *************************** MASTER VENDOR AND CUSTOMER ****************************************?>                                       
 <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Master_party')){ ?>active<?php } ?>">
                                            <a href="#">Customer / Vendor Master </a>
                                            <ul class="dropdown-menu">                                            
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Master_party"> Master Customer / Vendor List </a>
                                                </li>                                                 
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Master_party/add"> Customer / Vendor Add </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Customer_type"> Customer Type List </a>
                                                </li>
                                            </ul>
                                        </li>
 <?php // *************************** MASTER VENDOR AND CUSTOMER END ************************************?>

 <?php // *************************** MASTER ITEM START ****************************************?>                                       
 <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Master_item') || ($this->uri->segment(1) == 'Master_item_unit')|| ($this->uri->segment(1) == 'Stok_limit')){ ?>active<?php } ?>">
                                            <a href="#">Item / Unit Master </a>
                                            <ul class="dropdown-menu">                                        
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Master_item/add"> Item Add </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Master_item"> Master Item List </a>
                                                </li>
                                                 <li>
                                                    <a href="<?php echo base_url(); ?>Master_item_unit/add"> Item Unit Add </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Master_item_unit"> Master Item Unit List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Stok_limit">Stock limit</a>
                                                </li>
                                            </ul>
                                        </li>
 <?php // *************************** MASTER ITEM END ************************************?>

 <?php // *************************** MASTER ITEM START ****************************************?>                                       
 <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Tax') || ($this->uri->segment(1) == 'Tax') || ($this->uri->segment(1) == 'Hsncode')){ ?>active<?php } ?>">
                                            <a href="#">Tax Master </a>
                                            <ul class="dropdown-menu">                                        
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Tax/add"> Tax Add </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Tax"> Tax List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Hsncode"> Hsncode List </a>
                                                </li>
                                            </ul>
                                        </li>
 <?php // *************************** MASTER ITEM END ************************************?>
  <?php // *************************** MASTER ITEM START ****************************************?>                                       
 <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Brand') || ($this->uri->segment(1) == 'Brand')){ ?>active<?php } ?>">
                                            <a href="#">Brand Master </a>
                                            <ul class="dropdown-menu">                                        
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Brand/add"> Brand Add </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Brand"> Brand List </a>
                                                </li>
                                            </ul>
                                        </li>
 <?php // *************************** MASTER ITEM END ************************************?>

 <?php // *************************** MASTER ITEM START ****************************************?>                                       
 <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Department') || ($this->uri->segment(1) == 'Mode_inquiry') || ($this->uri->segment(1) == 'Mode_delivery') || ($this->uri->segment(1) == 'Items_heads')|| ($this->uri->segment(1) == 'Prefix') || ($this->uri->segment(1) == 'Followup_method') || ($this->uri->segment(1) == 'Task_type') || ($this->uri->segment(1) == 'Globalconf')){ ?>active<?php } ?>">
                                            <a href="#">Other </a>
                                            <ul class="dropdown-menu">                                        
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Department"> Department List </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Mode_inquiry"> Mode Inquiry List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Mode_delivery"> Mode Delivery List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Items_heads"> Item Heads List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Followup_method"> Mode Followup Method List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Payment_term">Payment Terms</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Payment_mode">Payment Mode</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Prefix/edit/TWNDNFoxQit0M3FicG9ad3ROQzZEZz09">Prefix  </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Globalconf">Global Confirgution</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Task_type"> Task Type List </a>
                                                </li>
                                            </ul>
                                        </li>
 <?php // *************************** MASTER ITEM END ************************************?>

                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Country')){ ?>active<?php } ?>">
                                            <a href="#">Country Master </a>
                                            <ul class="dropdown-menu">
                                        
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Country"> Country List </a>
                                                </li>
                                               
                                                <li>
                                                    <a href="<?php echo base_url(); ?>State"> State List </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>City"> City List </a>
                                                </li>
                                                <!-- <li>
                                                    <a href="<?php echo base_url(); ?>Area"> Area List </a>
                                                </li> -->
                                            </ul>
                                        </li>
                                        
                                         <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Module')){ ?>active<?php } ?>">
                                            <a href="#">Module Master </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Module"> Module  List</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Module/add"> Module  Add </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Tagline')){ ?>active<?php } ?>">
                                            <a href="#">Tagline Master </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Tagline"> Tagline  List</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Tagline/add"> Tagline  Add </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 2) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))
                {  ?>
                           <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Sales_enq') || ($this->uri->segment(1) == 'Sale_quotation')  || ($this->uri->segment(1) == 'Oa') || ($this->uri->segment(1) == 'Pi')  || ($this->uri->segment(1) == 'Weeklytour') || ($this->uri->segment(1) == 'Sales_report')){ ?> active open selected <?php } ?>  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-puzzle"></i> CRM</a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="<?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Sales_report')){ ?>active<?php } ?>" >
                                            <a href="<?php echo base_url(); ?>Sales_enq/sales_b2b_inq_report">B2B Inquiry report</a>
                                        </li>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Sales_enq')){ ?>active<?php } ?>" >
                                            <a href="#">Sales Inquiry</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Sales_enq/add">Sales Inquiry Add </a>
                                                </li>                                               
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Sales_enq/sales_inq_report">Sales Inquiry Report</a>
                                                </li>
                                                <!-- <li>
                                                   <a href="<?php //echo base_url(); ?>Sales_enq/sales_b2b_inq_report">Sales B2B Inquiry Report</a>
                                                </li> -->
                                                <!-- <li>
                                                   <a href="<?php //echo base_url(); ?>Sales_enq/followup">Sales Inquiry Followup List</a>
                                                </li> -->
                                            </ul>
                                        </li>
                                           <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Sale_quotation')){ ?>active<?php } ?>" >
                                            <a href="#">Sales Quotation</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Sale_quotation/add">Sales Quotation Add </a>
                                                </li>
                                                <!-- <li>
                                                   <a href="<?php //echo base_url(); ?>Sale_quotation">Sales Quotation List</a>
                                                </li> -->
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report">Sales Quotation Report</a>
                                                </li>
                                                <!-- <li>
                                                   <a href="<?php// echo base_url(); ?>Sale_quotation/followup">Sales Quotation Followup List</a>
                                                </li> -->
                                            </ul>
                                        </li>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Oa')){ ?>active<?php } ?>" >
                                            <a href="#">OA</a>
                                            <ul class="dropdown-menu">                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Oa/add">OA Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Oa">OA Report</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Pi')){ ?>active<?php } ?>" >
                                            <a href="#">PI</a>
                                            <ul class="dropdown-menu">                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Pi/add">PI Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Pi">PI Report</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        <li class="<?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Sales_report')){ ?>active<?php } ?>" >
                                            <a href="<?php echo base_url(); ?>Sales_report">Sales Report</a>
                                        </li>

                                       
                                        <?php /*
                                        if(isset($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['dep_id']))
                                        {
                                            //echo encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                            $dep_id = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                        }else{
                                            $dep_id = 0;
                                        }
                                         ?>
                                          <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Work_order')){ ?>active<?php } ?>" >
                                            <a href="#">Work Order</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Work_order/add">Work Order Add </a>
                                                </li>
                                                <?php if(isset($dep_id) && ($dep_id == 4)){ ?>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_director">Work Order List (Director)</a>
                                                </li>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_director_approved">Work Order List (Approved)</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(isset($dep_id) && ($dep_id == 3)){ ?>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_pro_manager">Work Order List (Production Manager)</a>
                                                </li>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_pro_manager_approved">Work Order List (Approved)</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(isset($dep_id) && ($dep_id == 5)){ ?>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_sales">Work Order List (Sales)</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(isset($dep_id) && ($dep_id == 1)){ ?>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_account">Work Order List (Account)</a>
                                                </li>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_account_approved">Work Order List (Approved)</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(isset($dep_id) && ($dep_id == 2)){ ?>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_store">Work Order List (Store)</a>
                                                </li>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/wo_store_approved">Work Order List (Approved)</a>
                                                </li>
                                                <?php } ?>
                                                <li>
                                                   <a href="<?php echo base_url(); ?>Work_order/work_order_report">Work Order Report</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Weeklytour')){ ?>active<?php } ?>" >
                                            <a href="#">Weekly Tour</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Weeklytour/tour">Weekly Tour </a>
                                                </li>
                                            
                                            </ul>
                                        </li>
                                        <?php */?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php /*<li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Task_assign')){ ?>  active open selected <?php } ?>  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Pending Work </a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Task_assign')){ ?>active<?php } ?>" >
                                                <a href="#">Pending Work</a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                       <a href="<?php echo base_url(); ?>Task_assign">  Pending Work List</a>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                </li> */?>
                                <!-- <li class="dropdown dropdown-fw dropdown-fw-disabled<?php// if($this->uri->segment(1) && ($this->uri->segment(1) == 'Task_assign')){ ?>  active open selected <?php// } ?>  ">

                                    <a href="<?php// echo base_url(); ?>Task_assign" class="text-uppercase">

                                        <i class="icon-puzzle"></i> Pending Work </a>


                                </li> -->
                                 <?php /* <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'inq-followup')){ ?>  active open selected <?php } ?>  ">
                                    <a href="<?php echo base_url(); ?>inq-followup" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Inq Followup </a>
                                </li>
                                <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'qoutation-followup')){ ?>  active open selected <?php } ?>  ">
                                    <a href="<?php echo base_url(); ?>qoutation-followup" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Qoutation Followup </a>
                                </li> */ ?>
                                <?php //if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 2)  || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))
                          //{  
                                ?>
                           <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Work_order') ||  ($this->uri->segment(1) == 'Dashboard_workorder_final')){ ?>  active open selected <?php } ?>  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-puzzle"></i>WO</a>
                                <ul class="dropdown-menu dropdown-menu-fw">
                                		<li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Dashboard_workorder_final')){ ?>active<?php } ?>" >
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final">Dashboard WO</a>
                                        </li>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Work_order')){ ?>active<?php } ?>" >
                                            <a href="#">Work Order</a>
                                            <ul class="dropdown-menu">                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Work_order/add">Work Order Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Work_order/Work_order_report">Work Order Report</a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                        <?php if(encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) != 2){  ?>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Work_order_item_list')){ ?>active<?php } ?>" >
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report">Work Order Item List</a></li>
                                            <?php 
                                            $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                            if($dep_id==5 || $dep_id==9 || $dep_id==11 ) { ?>
                                               <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Store_aprove')){ ?>active<?php } ?>" >
                                            <a href="<?php echo base_url(); ?>Store_aprove/Store_aprove_report">Aproval List</a></li>

                                           <?php } }
                                            ?>
                                             


                                        </ul>
                             </li>
                            <?php //} ?>

                            <?php if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3) ||  (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 11)))
                          {  ?>
                           <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Indent') || ($this->uri->segment(1) == 'Purchase_order') || ($this->uri->segment(1) == 'Inward')){ ?>  active open selected <?php } ?>  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Purchase </a>
                                <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Indent')){ ?>active<?php } ?>" >
                                            <a href="#">Indent</a>
                                            <ul class="dropdown-menu">
                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Indent">Indent Report</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Indent/Wo_indent_report">Work Order Indent Report</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Purchase_order')){ ?>active<?php } ?>" >
                                            <a href="#">Purchase Order</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Purchase_order/add">Purchase Order Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Purchase_order">Purchase Order Report</a>
                                                </li>
                                            </ul>
                                        </li>
                                       <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Inward')){ ?>active<?php } ?>" >
                                            <a href="#">Inward</a>
                                            <ul class="dropdown-menu">                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Inward/add">Inward Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Inward/Inward_report">Inward Report</a>
                                                </li>
                                            </ul>
                                        </li>
                                        </ul>
                             </li>
                            <?php } ?>

                            <?php if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 2) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 6) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 9) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3) ||  (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 11)))
                          {  ?>
                           <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Outward') || ($this->uri->segment(1) == 'Store_mgmt') || ($this->uri->segment(1) == 'Production_manager') || ($this->uri->segment(1) == 'Production_mgmt')|| ($this->uri->segment(1) == 'Account_mgmt') || ($this->uri->segment(1) == 'Production_mgmt') || ($this->uri->segment(1) == 'Dispatch_mgmt') || ($this->uri->segment(1) == 'Dispatch') ||  ($this->uri->segment(1) == 'Report')){ ?>  active open selected <?php } ?>  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Sales </a>
                                <ul class="dropdown-menu dropdown-menu-fw">
                                        
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Outward')){ ?>active<?php } ?>" >
                                            <a href="#">Outward</a>
                                            <ul class="dropdown-menu">                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Outward/add">Outward Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Outward/Outward_report">Outward Report</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Outward_serial_key_list/Outward_serial_key_list_report">Outward Serial Key List </a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        <?php if(isset($this->session->userdata['miconlogin']) && ((isset($this->session->userdata['miconlogin']['dep_id']) && encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 9) || (isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))))
                                        { ?>
                                       
                                    <?php } ?>
                                        <?php if(isset($this->session->userdata['miconlogin']) && ((isset($this->session->userdata['miconlogin']['dep_id']) && encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 5) || (isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))))
                                        { ?>
                                        
                                     <?php } ?>
                                     
                                    <?php if(isset($this->session->userdata['miconlogin']) && ((isset($this->session->userdata['miconlogin']['dep_id']) && encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 2) || (isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))))
                                        { ?>
                                      
                                        <?php } ?>
                                        <?php if(isset($this->session->userdata['miconlogin']) && ((isset($this->session->userdata['miconlogin']['dep_id']) && encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 4) || (isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)))))
                                        { ?>
                                        
                                    <?php } ?>
                                    	<?php if((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) != 9)) { ?>
                                        <li class="dropdown more-dropdown-sub <?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Dispatch')){ ?>active<?php } ?>" >
                                            <a href="#">Dispatch</a>
                                            <ul class="dropdown-menu">                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Dispatch/add">Dispatch Add</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Dispatch/dispatch_report">Dispatch Report</a>
                                                </li>
                                                <?php if((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']) == 42) || ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3))) { ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>Dispatch/dispatch_demoreport">Dispatch Demo Report</a>
                                                </li>
                                                 <li>
                                                    <a href="<?php echo base_url(); ?>Dispatch/demoreturn">Demo Return</a>
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                        <li class="<?php if($this->uri->segment(1) && $this->uri->segment(1) && ($this->uri->segment(1) == 'Report')){ ?>active<?php } ?>" >
                                            <a href="<?php echo base_url(); ?>Report">Report</a>
                                        </li>                                        
								</ul>
                             </li>
                            <?php } ?>
                            <?php 
                                            if($typeid == 3) { ?>
                                <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Log')){ ?>  active open selected <?php } ?>  ">
                                    <a href="<?php echo base_url(); ?>Log" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Log </a>
                                </li>
                                <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Calendar/tour')){ ?>  active open selected <?php } ?>  ">
                                    <a href="<?php echo base_url(); ?>Calendar/tour" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Task </a>
                                </li>
                                <?php } ?>
                            <?php 
                                            $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                            if($dep_id==9 || $typeid == 3 || $dep_id == 10 || $dep_id == 1) { ?>
                                <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Support_ticket')){ ?>  active open selected <?php } ?>  ">
                                    <a href="<?php echo base_url(); ?>Support_ticket" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Support </a>
                                        <ul class="dropdown-menu dropdown-menu-fw">
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Support_ticket">Support Ticket</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                        </ul>
                                </li>
                                <?php } ?>
                                <?php 
                                            $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                            if($dep_id==6 || $typeid == 3 || $dep_id == 11) { ?>
                                 <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Doc_inward')){ ?>  active open selected <?php } ?>  ">
                                    <a  class="text-uppercase">
                                        <i class="icon-puzzle"></i> Doc Inward </a>
                                         

                                        <ul class="dropdown-menu dropdown-menu-fw">
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Doc_inward/add">Document Inward Add</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Doc_inward/Doc_inward_report">Document Inward Report</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                        </ul>
                                </li>
                                <?php }?>
                                <?php 
                                            $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                            if($typeid == 3 || $dep_id == 6) { ?>
                                 <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Salary_cal')){ ?>  active open selected <?php } ?>  ">
                                    <a  class="text-uppercase">
                                        <i class="icon-puzzle"></i> Salary View </a>
                                        <ul class="dropdown-menu dropdown-menu-fw">
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Salary_cal">Salary Calculator</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Salary_cal/View">Salary Report</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                        </ul>
                                </li>
                                <?php }?>

                               
                                 <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Attendance_cal')){ ?>  active open selected <?php } ?>  ">
                                    <a  class="text-uppercase">
                                        <i class="icon-puzzle"></i> Attendance </a>
                                        <ul class="dropdown-menu dropdown-menu-fw">
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Attendance_cal">Attendance Calculator</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                             <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Attendance_cal/View">Attendance Report</a>
                                                <ul class="dropdown-menu">                                            
                                                </ul>
                                            </li>
                                        </ul>
                                </li>
                                

                                <?php 
                                            $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                            if($typeid == 3 || $dep_id == 11) { ?>
                                 <li class="dropdown dropdown-fw dropdown-fw-disabled<?php if($this->uri->segment(1) && ($this->uri->segment(1) == 'Sales_return')){ ?>  active open selected <?php } ?>  ">
                                    <a  class="text-uppercase">
                                        <i class="icon-puzzle"></i> Sales Return </a>
                                        <ul class="dropdown-menu dropdown-menu-fw">
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Sales_return/add">Sales Return Add</a>
                                                <ul class="dropdown-menu">                                           
                                                </ul>
                                            </li>
                                            <li class="dropdown more-dropdown-sub" >
                                                <a href="<?php echo base_url(); ?>Sales_return/Sales_return_report">Sales Return Report</a>
                                                <ul class="dropdown-menu">           
                                                </ul>
                                            </li>
                                        </ul>
                                </li>
                                <?php }?>

                            </ul>
                        </div>
                        