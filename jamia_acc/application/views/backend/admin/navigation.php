<style>
    i{margin-left: 3px;}
</style>
<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

    <div class="navbar-inner" style="box-shadow:0px 0px 4px 1px;">

        <!-- logo -->
        <div class="navbar-brand">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png" width="50" alt="" />
            </a>
        </div>


        <!-- main menu -->

        <ul class="navbar-nav">


            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                    <i class="entypo-gauge"></i>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>
            
            <li class="<?php if ($page_name == 'expenses_type') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/expenses_type">
                    <i class="fa fa-dollar"></i>
                    <span><?php echo get_phrase('expenses_type'); ?></span>
                </a>
            </li>
            
            <li class="<?php if ($page_name == 'expenses_mad') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/expenses_mad">
                    <i class="fa fa-dollar"></i>
                    <span><?php echo get_phrase('expenses_mad'); ?></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'khata_banam') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/khata_banam">
                    <i class="fa fa-dollar"></i>
                    <span><?php echo get_phrase('khata_banam'); ?></span>
                </a>
            </li>
            
            <!---Jamia Expenses--->
            <li class="<?php if ($page_name == 'jamia_expenses') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/jamia_expenses">
                    <i class="fa fa-dollar"></i>
                    <span><?php echo get_phrase('jamia_expenses'); ?></span>
                </a>
            </li>
            
            <!---Jamia Expenses Report--->
            <li class="<?php if ($page_name == 'jamia_expenses_report') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/jamia_expenses_report">
                    <i class="fa fa-file-o"></i>
                    <span><?php echo get_phrase('jamia_expenses_report'); ?></span>
                </a>
            </li>
            
             <!---- JAMIA INCOME ---->
            <li>
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span><?php echo get_phrase('jamia_income'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'income_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/income_category">
                            <span><i class="fa fa-money"></i> <?php echo get_phrase('income_category'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'add_income') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/add_income">
                            <span><i class="fa fa-money"></i> <?php echo get_phrase('add_income'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="<?php if ($page_name == 'income_report') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/income_report">
                    <i class="fa fa-file-o"></i>
                    <span><?php echo get_phrase('income_report'); ?></span>
                </a>
            </li>
            
            <!-- SETTINGS -->
            <li class="<?php
            if ($page_name == 'system_settings' ||
                    $page_name == 'manage_language' ||
                    $page_name == 'sms_settings' ||
                    $page_name == 'countries' ||
                    $page_name == 'users')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-lifebuoy"></i>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'users') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/users">
                            <span><i class="entypo-users"></i> <?php echo get_phrase('users'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'countries') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/countries">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('countries'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'districts') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/districts">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('districts'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                        </a>
                    </li>
                    <!-- ACCOUNT -->
                    <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                            <i class="entypo-lock"></i>
                            <span><?php echo get_phrase('account'); ?></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>



        <!-- notifications and other links -->
        <ul class="nav navbar-right pull-right">


            <!-- mobile only -->
            <li class="visible-xs">

                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="horizontal-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </li>

        </ul>
    </div>

</header>



