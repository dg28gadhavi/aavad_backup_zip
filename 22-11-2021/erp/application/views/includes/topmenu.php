    <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown dropdown-fw  active open selected">
                    <a href="<?php echo base_url(); ?>" class="text-uppercase">
                        <i class="icon-home"></i> Dashboard 
                    </a>                                    
                </li>                                
                <li class="dropdown dropdown-fw  ">
                    <a href="javascript:;" class="text-uppercase">
                        Mentors / Mentee 
                    </a>                                    
                    <ul class="dropdown-menu dropdown-menu-fw">
                       <li class="dropdown more-dropdown-sub">
                            <a href="#">
                               Mentors
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Manage Mentors</a>
                                </li>                                
                            </ul>
                        </li>         
                        <li class="dropdown more-dropdown-sub">
                            <a href="#">
                                Mentee
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>manage_mentee">Manage Mentee</a>
                                </li>                                
                            </ul>
                        </li>           
                    </ul>    
                </li>
            </ul>
    </div>