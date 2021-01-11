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
                    <li class="<?php if ($page_name == 'edit_student_reg_no') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/edit_student_reg_no">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('edit_student_reg_no'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_card') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_card">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_card'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'daily_student_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?exam/daily_student_report">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('daily_student_report'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_pics_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/student_pics_report">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_pics_report'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Exams -->
            <li class="<?php
            if ($page_name == 'exams' ||
                    $page_name == 'manage_exams' ||
                    $page_name == 'exam_marks'
            )
                echo 'opened active';
            ?> ">
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
                    <li class="<?php if ($page_name == 'exam_marks') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?exam/exam_marks">
                            <span><i class="entypo-chart-bar"></i> <?php echo get_phrase('manage_exam_marks'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('results'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if ($page_name == 'single_tabulation_sheet') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?exam/single_tabulation_sheet">
                                    <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('single_result'); ?></span>
                                </a>
                            </li>
                            <li class="<?php if ($page_name == 'combine_tabulation_sheet') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?exam/combine_tabulation_sheet">
                                    <span><i class="fa fa-list-ol"></i> <?php echo get_phrase('multiple_result'); ?></span>
                                </a>
                            </li>
                        </ul>

                    </li>
                </ul>
            </li>

            <!-- Student Fee Management -->
            <li class="<?php
            if ($page_name == 'student_fee' ||
                    $page_name == 'student_fee_detail' ||
                    $page_name == 'student_sponsor' ||
                    $page_name == 'student_transaction'
            )
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span><?php echo get_phrase('student_fee'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'student_fee') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/manage_student_fee">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_fee'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_fee_detail') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/student_fee_detail">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_fee_info'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_transaction') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/student_transaction">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_transaction'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'scholarship_transaction') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/scholarship_transaction">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('scholarship_transaction'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_sponsor') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/student_sponsor">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('sponsor'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'student_fee_invoice') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/student_fee_invoice">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('fee_invoice'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-money"></i>
                            <span><?php echo get_phrase('tamleek_report'); ?></span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php?student_fee/class_fee_record">
                                    <span><i class="entypo-dot"></i> <?php echo get_phrase('tamleek_report'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php?student_fee/tamleek_paid_fee_record">
                                    <span><i class="entypo-dot"></i> <?php echo get_phrase('tamleek_paid_fee_record'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
<!--                    <li class="<?php // if ($page_name == 'class_fee_record') echo 'active';    ?> ">
                        <a href="<?php //echo base_url();    ?>index.php?student_fee/class_fee_record">
                            <span><i class="entypo-dot"></i> <?php //echo get_phrase('tamleek_report');    ?></span>
                        </a>
                    </li>-->
                    <li class="<?php if ($page_name == 'student_paid_fee_record') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/student_paid_fee_record">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('student_paid_fee_record'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'beneficiary_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/beneficiary_report">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('beneficiary_report'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'beneficiary_student_fee_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?student_fee/beneficiary_student_fee_report">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('beneficiary_student_fee_report'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('reports'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if ($page_name == 'empty_months_report') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?student_fee/empty_months_report">
                                    <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('empty_months_report'); ?></span>
                                </a>
                            </li>
                            <li class="<?php if ($page_name == 'total_class_fee_report') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?student_fee/total_class_fee_report">
                                    <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('total_class_fee_report'); ?></span>
                                </a>
                            </li>
                            <li class="<?php if ($page_name == 'branch_fee_report') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?student_fee/branch_fee_report">
                                    <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('branch_fee_report'); ?></span>
                                </a>
                            </li>
                            <li class="<?php if ($page_name == 'tamlek_report_for_kafalat_students') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?student_fee/tamlek_report_for_kafalat_students">
                                    <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('tamlek_report_for_kafalat_students'); ?></span>
                                </a>
                            </li>
                            <li class="<?php if ($page_name == 'sector_report') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>index.php?student_fee/sector_report">
                                    <span><i class="fa fa-file-text-o"></i> <?php echo get_phrase('sector_report'); ?></span>
                                </a>
                            </li>
                        </ul>

                    </li>
                </ul>
            </li>

            <!-- Attendance Management -->
            <li class="<?php
            if ($page_name == 'manage_attendance' ||
                    $page_name == 'manage_attendance_view'
            )
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-chart-area"></i>
                    <span><?php echo get_phrase('attendance'); ?></span>
                </a>
                <ul>

                    <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?attendance/manage_attendance">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_attendance'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?attendance/attendance_report">
                            <span><i class="fa fa-file"></i> <?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'friday_attendance') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?attendance/friday_attendance">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('friday_attendance'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'friday_attendance_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?attendance/friday_attendance_report">
                            <span><i class="fa fa-file"></i> <?php echo get_phrase('friday_attendance_report'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Attendance Management -->
            <!-- Messages -->
            <li class="<?php
            if ($page_name == 'sending_sms'
            )
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span><?php echo get_phrase('messages'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'messages') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?message/sending_sms">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('messages'); ?></span>
                        </a>
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

            <!-- Reports -->
            <li class="<?php
            if ($page_name == 'monthly_syllabus' ||
                    $page_name == 'manage_exams' ||
                    $page_name == 'exam_subject_report'
            )
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span><?php echo get_phrase('reports'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'monthly_syllabus') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/monthly_syllabus">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('monthly_syllabus'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'exam_subject_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?exam/exam_subject_report">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_subject_report'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Hostel  Management -->
            <li class="">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span><?php echo get_phrase('hostel'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?hostel/manage_hostel">
                            <i class="fa fa-home"></i>
                            <span><?php echo get_phrase('hostel'); ?></span>
                        </a>
                    </li> 
                    <li class="<?php if ($page_name == 'hostel_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?hostel/hostel_student">
                            <i class="fa fa-users"></i>
                            <span><?php echo get_phrase('hostel_student'); ?></span>
                        </a>
                    </li> 
                    <li class="<?php if ($page_name == 'hostel_student_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?hostel/hostel_student_report">
                            <i class="fa fa-file"></i>
                            <span><?php echo get_phrase('hostel_student_report'); ?></span>
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
                    <li class="<?php if ($page_name == 'responsible') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/responsible">
                            <span><i class="entypo-users"></i> <?php echo get_phrase('responsible'); ?></span>
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



