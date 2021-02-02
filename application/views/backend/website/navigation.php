
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
                <a href="<?php echo base_url(); ?>website/dashboard">
                    <i class="entypo-gauge"></i>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>

            <!--Books -->
            <li class="<?php if ($page_name == 'books') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>website/books">
                    <i class="fa fa-book"></i>
                    <span><?php echo get_phrase('books'); ?></span>
                </a>
            </li>
            <!--Gallery -->
            <li class="<?php if ($page_name == 'gallery') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>website/gallery">
                    <i class="fa fa-picture-o"></i>
                    <span><?php echo get_phrase('gallery'); ?></span>
                </a>
            </li>
            <!-- Position Holders -->
            <li class="<?php if ($page_name == 'gallery') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>website/position_holders">
                    <i class="fa fa-trophy"></i>
                    <span><?php echo get_phrase('position_holders'); ?></span>
                </a>
            </li>
            <!-- Position Holders -->
            <li class="<?php if ($page_name == 'settings') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>website/web_settings">
                    <i class="fa fa-cogs"></i>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>
            </li>
            <!-- Position Holders -->
            <li class="<?php if ($page_name == 'video_section') echo 'active'; ?> ">
                <a href="<?php echo base_url('videos'); ?>">
                    <i class="fa fa-cogs"></i>
                    <span><?php echo get_phrase('video_section'); ?></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                <a href="<?php echo base_url('website/alasr_resala'); ?>">
                    <i class="fa fa-book"></i>
                    <span><?php echo 'العصر رسالہ' ?></span>
                </a>
            </li>
               <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                <a href="<?php echo base_url('website/alasr_book'); ?>">
                    <i class="fa fa-book"></i>
                    <span><?php echo 'کتاب'; ?></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                <a href="<?php echo base_url('website/alasr_musanif'); ?>">
                    <i class="entypo-pencil"></i>
                    <span><?php echo 'مصنف';?></span>
                </a>
            </li>
          <!--Topics-->
          <li class="">
                <a href="#">
                    <i class="entypo-book-open"></i>
                    <span><?php echo 'ٹاپک'; ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>website/alasr_topic">
                            <span><i class="entypo-pencil"></i> <?php echo 'اندراج ٹاپک'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>website/alasr_subtopic">
                            <span><i class="entypo-pencil"></i> <?php echo'اندراج سب ٹاپک'; ?></span>
                        </a>
                    </li>
                   
                </ul>
            </li>
         
        <!--Readers-->  
            <li class="">
                <a href="#">
                    <i class="entypo-eye"></i>
                    <span><?php echo 'قارئین '; ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>website/alasr_reader">
                            <span><i class="entypo-pencil"></i> <?php echo 'اندراج قاری'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>website/alasr_readertype">
                            <span><i class="entypo-pencil"></i> <?php echo'اندراج قسم قاری '; ?></span>
                        </a>
                    </li>
                   
                </ul>
                </li>
             <!--Publishers-->  
           <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                <a href="<?php echo base_url('website/alasr_publisher'); ?>">
                    <i class="entypo-pencil"></i>
                    <span><?php echo 'ناشرکتب';?></span>
                </a>
            </li>
            <!--Topics-->
          <li class="">
                <a href="#">
                    <i class="entypo-newspaper"></i>
                    <span><?php echo 'ترتیبات'; ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>website/alasr_create_book">
                            <span><i class="entypo-pencil"></i> <?php echo ' کتاب کو ترتیب دیں'; ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>">
                            <span><i class="entypo-pencil"></i> <?php echo'اندراج'; ?></span>
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