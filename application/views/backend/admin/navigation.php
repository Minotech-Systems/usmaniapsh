
<style>
    .navbar-brand{height: 42px;}
    @media screen and (min-width: 768px){
        .navbar-inner {box-shadow: 0px 0px 7px -2px}
    }

</style>
<header class="navbar navbar-fixed-top">

    <div class="navbar-inner" >

        <!-- logo -->
        <div class="navbar-brand">
            <a href="<?php echo base_url(); ?>">
                <img src="<?= base_url('uploads/logo.png') ?>" width="50" alt="" />
            </a>
        </div>


        <!-- main menu -->

        <!-- main menu -->

        <ul class="navbar-nav">


            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/dashboard">
                    <i class="entypo-gauge"></i>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>
            <!-- DASHBOARD -->
            <li class="<?php
            if ($page_name == 'entering_question')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-pencil"></i>
                    <span><?php echo get_phrase('questions'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'entering_question') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>questions/entering_question">
                            <span><i class="entypo-pencil"></i> <?php echo get_phrase('enter_question'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'ifta_questions') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>questions/ifta_questions">
                            <span><i class="entypo-comment"></i> <?php echo get_phrase('questions'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'reject_question') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>questions/reject_question">
                            <span><i class="entypo-block"></i> <?php echo get_phrase('reject_question'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Fatawa -->
<!--            <li class="<?php if ($page_name == 'fatawa/answers') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>fatwa/answers">
                    <i class="fa fa-file-o"></i>
                    <span><?php echo get_phrase('fatawa'); ?></span>
                </a>
            </li>-->
            <li class="<?php
            if ($page_name == 'answers')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="fa fa-file-o"></i>
                    <span><?php echo get_phrase('fatawa'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'fatwa/answers') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>fatwa/answers">
                            <i class="fa fa-file-o"></i>
                            <span><?php echo 'نئے فتاویٰ'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'fatawa/all_answers') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>fatwa/all_answers">
                            <span><i class="fa fa-file-o"></i> <?php echo get_phrase('all_answers'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'fatawa/fatwa_list') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>fatwa/fatwa_list">
                            <span><i class="fa fa-file-o"></i> <?php echo get_phrase('fatwa_list'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Mujeeb info about Fatawas -->
            <li class="<?php if ($page_name == 'users/mujeeb_fatwa_info') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/mujeeb_fatwa_info">
                    <i class="entypo-chart-bar"></i>
                    <span><?php echo get_phrase('mujeeb_fatwa_info'); ?></span>
                </a>
            </li>

            <!-- SETTINGS -->
            <li class="<?php
            if ($page_name == 'system_settings' ||
                    $page_name == 'manage_language' ||
                    $page_name == 'users')
                echo 'opened active';
            ?> ">
                <a href="#">
                    <i class="entypo-lifebuoy"></i>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'users') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/users">
                            <span><i class="entypo-users"></i> <?php echo get_phrase('users'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/system_settings">
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
                        <a href="<?php echo base_url(); ?>admin/manage_profile">
                            <i class="entypo-lock"></i>
                            <span><?php echo get_phrase('account'); ?></span>
                        </a>
                    </li>



                </ul>
            </li>
            <!-- IMPORT INTO WORD -->
            <li class="<?php if ($page_name == 'import_to_word') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>fatwa/import_to_word">
                    <i class="fa fa-file-o"></i>
                    <span><?php echo get_phrase('import_to_word'); ?></span>
                </a>
            </li>
            <!-- Frontend website -->
            <li class="<?php if ($page_name == 'website/dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>website">
                    <i class="fa fa-globe"></i>
                    <span><?php echo get_phrase('website'); ?></span>
                </a>
            </li>
            <!-- Search Fatwa -->
            <li>
                <form action="<?= base_url('fatwa/search_fatwa') ?>" method="get">
                    <input type="text" name="search" placeholder="<?= 'تلاش فتوی' ?>" class="form-control" autofocus="off" autocomplete="off" style="border:1px solid #c8cdd7; margin-top: 4px;">
                </form>
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
<script>
    var prev = 0;
    var $window = $(window);
    var nav = $('.top');

    $window.on('scroll', function () {
        var scrollTop = $window.scrollTop();
        nav.toggleClass('hidden', 10, scrollTop > prev);
        prev = scrollTop;
    });
</script>