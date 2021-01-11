<style>
    i{margin-left: 3px;}
    .page-container.horizontal-menu header.navbar .navbar-nav > li:hover > a{   
        background-color: rgba(160, 161, 165, 0.3);
        color: #ffffff;}
    @media(max-width: 767px){
        .page-container.horizontal-menu header.navbar .navbar-nav > li{background-color: #464646;}
        .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li > a{border-bottom: 1px solid white;}
        .page-body .page-container.horizontal-menu{padding-right: 0px !important;}
        .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li > ul > li > a:first-child{ border-bottom: 1px solid white;}
        .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li > ul > li > a:hover{ background-color: rgba(160, 161, 165, 0.3);
        color: #ffffff;}
    }
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

            <!-- Student Information -->
            <li class="<?php
            if ($page_name == 'student_admmission' ||
                    $page_name == 'students' ||
                    $page_name == 'manage_students' ||
                    $page_name == 'withdraw_students' ||
                    $page_name == 'student_detail_view')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('students'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'student_admmission') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admission/student_admmission">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'students') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/students">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('students'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manage_students') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_students">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_students'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_detail_view') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_detail_view">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_report'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Exams -->
            <li class="<?php
            if ($page_name == 'exams' ||
                    $page_name == 'manage_exams'
            )
                echo 'opened active';
            ?>  has-sub">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('exams'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'exams') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?exam/exams">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('exams'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_roll'); ?></span>
                        </a>
                        <ul>
                            <li class="<?php if ($page_name == 'exam_roll') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?exam/exam_roll">
                                    <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_roll'); ?></span>
                                </a>
                            </li>
                            <li class="<?php if ($page_name == 'exam_roll_report') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?exam/exam_roll_report">
                                    <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_roll_report'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- TEACHERS -->
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/teacher">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('teacher'); ?></span>
                </a>
            </li>
            <!-- Classes And Sections -->
            <li class="<?php
            if ($page_name == 'manage_classes' ||
                    $page_name == 'manage_sections')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('class'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_classes') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_classes">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('class'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manage_sections') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_section">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('section'); ?></span>
                        </a>
                    </li>
                </ul>
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

<!--            <li class="<?php if ($page_name == 'database_backup') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/database_backup">
                    <i class="entypo-database"></i>
                    <span><?php echo get_phrase('database_backup'); ?></span>
                </a>
            </li>-->

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



