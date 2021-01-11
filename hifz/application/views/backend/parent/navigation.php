
<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

    <div class="navbar-inner">

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
                <a href="<?php echo base_url(); ?>index.php?parents/dashboard">
                    <i class="entypo-gauge"></i>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>



            <?php
            $children_of_parent = $this->db->get_where('student', array(
                        'student_id' => $this->session->userdata('parent_id')
                    ))->result_array();
            ?>


            <!-- EXAMS -->
            <li class="<?php if ($page_name == 'marks') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('exam_marks'); ?></span>
                </a>
                <ul>
                    <?php
                    foreach ($children_of_parent as $row):
                        ?>
                        <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?parents/exam_marks/">
                                <span><i class="entypo-dot"></i> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>




            <!-- DAILY ATTENDANCE -->
            <li class="<?php if ($page_name == 'attendance') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-chart-area"></i>
                    <span><?php echo get_phrase('attendance'); ?></span>
                </a>

                <ul>
                    <?php
                    foreach ($children_of_parent as $row) {
                        ?>
                        <li class="<?php if ($page_name == 'attendance') echo 'active'; ?> ">
                            <a href="#">
                                <span><i class="entypo-dot"></i> <?php echo $row['name']; ?></span>
                            </a>
                            <ul>
                                <!--*class attendance report*-->
                                <li class="<?php if ($page_name == 'attendance') echo 'active'; ?> ">
                                    <a href="<?php echo base_url(); ?>index.php?parents/attendance_report">
                                        <span><i class="entypo-dot"></i> <?php echo get_phrase('attendance_report'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <!-- STUDENT FEE -->
            <li class="<?php if ($page_name == 'student_fee') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-chart-area"></i>
                    <span><?php echo get_phrase('student_fee'); ?></span>
                </a>

                <ul>
                    <?php
                    foreach ($children_of_parent as $row) {
                        ?>
                        <li class="<?php if ($page_name == 'student_fee') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?parent_login/student_fee/<?php echo $row['student_id']; ?>">
                                <span><i class="entypo-dot"></i> <?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <!-- DAILY REPORT -->
            <li class="<?php if ($page_name == 'daily_student_report') echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-chart-area"></i>
                    <span><?php echo get_phrase('daily_student_report'); ?></span>
                </a>

                <ul>
                    <?php
                    foreach ($children_of_parent as $row) {
                        ?>
                        <li class="<?php if ($page_name == 'daily_student_report') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>index.php?parents/daily_student_report/<?php echo $row['student_id']; ?>">
                                <span><i class="entypo-dot"></i> <?php echo $row['name']; ?></span>
                            </a>

                        </li>
                    <?php } ?>
                </ul>
            </li>
            <!-- ACCOUNT -->
<!--            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?parent_login/manage_profile">
                    <i class="entypo-lock"></i>
                    <span><?php echo get_phrase('account'); ?></span>
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

