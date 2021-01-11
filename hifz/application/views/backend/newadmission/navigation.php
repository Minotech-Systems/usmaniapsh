<style>
    i{margin-left: 3px;}
</style>
<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

    <div class="navbar-inner" style="box-shadow:0px 0px 11px 3px;">

        <!-- logo -->
        <div class="navbar-brand">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png" width="50" alt="" />
            </a>
        </div>


        <!-- main menu -->

        <!-- main menu -->

        <ul class="navbar-nav">


            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?newadmission/dashboard">
                    <i class="entypo-gauge"></i>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="entypo-user"></i>
                    <span><?php echo get_phrase('student_information'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'admit_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/admit_student">
                            <i class="entypo-gauge"></i>
                            <span><?php echo get_phrase('admit_student'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_information') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/student_information">
                            <i class="entypo-user"></i>
                            <span><?php echo get_phrase('student_information'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'new_admit_students_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/new_admit_students_report">
                            <i class="fa fa-file"></i>
                            <span><?php echo get_phrase('new_admit_students_report'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'end_of_admission') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/end_of_admission">
                            <i class="entypo-user"></i>
                            <span><?php echo get_phrase('end_of_admission'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'end_of_admission') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/select_student_report">
                            <i class="entypo-user"></i>
                            <span><?php echo 'منتخب طلباء رپورٹ' ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'new_students_ajmali_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/new_students_ajmali_report">
                            <i class="fa fa-file"></i>
                            <span><?php echo get_phrase('new_students_ajmali_report'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="<?php
            if ($page_name == 'old_student_promotion')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('old_students'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'old_student_promotion') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/old_student_promotion">
                            <span><i class="entypo-feather"></i> <?php echo 'تجد ید طلباء'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'old_student_promotion_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/old_student_promotion_report">
                            <span><i class="entypo-feather"></i> <?php echo 'رپورٹ تجد ید طلباء '; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'old_student_ajmali_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?newadmission/old_student_ajmali_report">
                            <span><i class="entypo-feather"></i> <?php echo 'قدیم طلباء اجمالی رپورٹ'; ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="<?php if ($page_name == 'fee') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?newadmission/fee_system">
                    <i class="fa fa-money"></i>
                    <span><?php echo 'فیس' ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'fee_report') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?newadmission/fee_report">
                    <i class="fa fa-money"></i>
                    <span><?php echo 'فیس رپورٹ' ?></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'enrolled_student_sms') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?newadmission/enrolled_student_sms">
                    <i class="fa fa-envelope-o"></i>
                    <span><?php echo 'منتحب طلباء پیغام' ?></span>
                </a>
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



