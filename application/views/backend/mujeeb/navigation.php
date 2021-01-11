
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
                <a href="<?php echo base_url(); ?>mujeeb/dashboard">
                    <i class="entypo-gauge"></i>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>
            <!-- Fatawa -->
            <li class="<?php if ($page_name == 'mujeeb/answers') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>mujeeb/answers">
                    <i class="fa fa-file-o"></i>
                    <span><?php echo get_phrase('fatawa'); ?></span>
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
                    <!-- ACCOUNT -->
                    <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>mujeeb/manage_profile">
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