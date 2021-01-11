<?php $lang = $this->session->userdata('system_lang') ?>
<!--==========================
  Header
  ============================-->
<style>
    /*    .main-nav ul li a {
            color: #7b654d;
            line-height: 21px;
            padding: 5px 26px;
            margin: 0;
            position: relative;
            -webkit-transition: all .5s ease-in-out;
            -moz-transition: all .5s ease-in-out;
            -o-transition: all .5s ease-in-out;
            transition: all .5s ease-in-out;
        }*/
    .main-nav ul li a.active {
        color: #fff
    }
    .main-nav ul li a.active:before {
        height: 100%
    }
    .main-nav ul li a.active:after {
        width: 100%
    }
    .main-nav ul li a:before {
        position: absolute;
        right: 0;
        bottom: 0;
        background: rgba(40, 38, 70, 0.8);;
        width: 100%;
        height: 0;
        -webkit-transition: all .5s ease-in-out;
        -moz-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
        content: '';
        z-index: -1;
    }
    /*    .main-nav ul li a:after {
            content: '';
            width: 0;
            height: 3px;
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            margin: 0 auto;
            background: #C19B76;
            -webkit-transition: all .5s ease-in-out;
            -moz-transition: all .5s ease-in-out;
            -o-transition: all .5s ease-in-out;
            transition: all .5s ease-in-out;
        }*/
    .main-nav ul li a:hover, .main-nav ul li a:focus {
        text-decoration: none
    }
    .main-nav ul li.active a {
        color: #fff;
    }

    .main-nav ul li.active a:before {
        height: 100%
    }

    .main-nav ul li.active a:after {
        width: 100%
    }


    @media (min-width: 1200px) {
        .main-nav ul li:hover > a {
            color: #fff
        }

        .main-nav ul li:hover > a:before {
            height: 100%
        }

        .main-nav ul li:hover > a:after {
            width: 100%
        }

        .main-nav ul li:hover i {
            color: #fff
        }

        .main-nav ul li ul li:hover a {
            background: #4e4c5a;
        }


    }

    #topbar .login-btn{
        color: #fff;
        float: right;
        padding: 12px 24px;
        line-height: 24px;
        display: block;
        -webkit-transition: all .5s ease-in-out;
        -moz-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
    }
    @media (min-width: 1200px){
        #topbar .login-btn:hover {
            background: #7b654d;
        }
    }

</style>
<header id="header" style="padding:0px; background: white;">

    <div id="topbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4" style="text-align:right;">
                    <?php if ($this->session->userdata('user_login') == 1) { ?>
                        <a href="<?= base_url('dashboard') ?>" class="login-btn"><?= $this->session->userdata('name') ?></a>
                    <?php } else { ?>
                        <a href="<?= base_url('login') ?>" class="login-btn"><?= 'لاگ ان' ?></a>
                    <?php } ?>

                    <select style="background: #4e4c5a; padding: 5px; border: none; margin-right: 30px; color: white;" onchange="change_lang(this.value)">
                        <option value="english"<?php if ($lang == 'english') echo 'selected'; ?>>English</option>
                        <option value="urdu" <?php if ($lang == 'urdu') echo 'selected'; ?>>اردو</option>
                    </select>
                </div>
                <div class="col-sm-4 col-md-4">
                    <center>
                        <h2 style="margin-top: 10px; font-size: 18px" class="arabic"><?= 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم' ?></h2>
                    </center>
                </div>
                <div class="col-sm-4 col-md-4 text-left">
                    <p style="color: #fff;margin: 10px 0; font-weight: bold" class="text-left">
                        <?php
                        echo $date = $this->crud_model->get_islamic_date(date('d-m-Y')) . ' - ';
                        echo date('d') . $urdu_month = $this->crud_model->get_urdu_month_name(date('m')) . date('Y') . 'ء';
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="container " >

        <div class="logo float-right">
            <!-- Uncomment below if you prefer to use an image logo -->
            <h1 class="text-light">
                <a href="#intro" class="scrollto">
                    <img src="<?= base_url('uploads/logo/logo.png') ?>">
                </a>
            </h1>
            <!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
        </div>

        <nav class="main-nav float-right d-none d-lg-block" >
            <ul dir="rtl">
                <li class="<?php if ($page_name == 'home') echo 'active'; ?>"><a href="<?= base_url() ?>"><?= get_phrase('home') ?></a></li>
                <li class="drop-down " >
                    <a href="<?= base_url('darulifta') ?>" class="
                    <?php if ($page_name == 'darulifta' || $page_name == 'new_questions' || $page_name == 'ask_questions') echo 'active'; ?>"
                       >
                        <?= get_phrase('darulifta') ?></a>
                    <ul style="margin-top: 12px;">
                        <li>
                            <a href="<?= base_url('new_questions') ?>"><?= get_phrase('new_questions') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('ask_question') ?>"><?= get_phrase('ask_question') ?></a>
                        </li>
                    </ul>
                </li>
                <li class="drop-down " >
                    <a href="<?= base_url('page/تعارف') ?>" class="
                    <?php
                    if ($page_name == 'about_jamia' ||
                            $page_name == 'jamia_tasees' ||
                            $page_name == 'historical_travel' ||
                            $page_name == 'jamia_aim' ||
                            $page_name == 'jamia_departments'||
                            $page_name == 'videos')
                        echo 'active';
                    ?>"
                       >
                        <?= get_phrase('introduction') ?></a>
                    <ul style="margin-top: 12px;">
                        <li>
                            <a href="<?= base_url('page/جامعہ-کی-تاسیس') ?>"><?= get_phrase('jamia_tasees') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('page/تاریخی-سفر') ?>"><?= get_phrase('historical_travel') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('page/اغراض-و-مقاصد') ?>"><?= get_phrase('jamia_aim') ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('page/جامعہ-شعبہ-جات') ?>"><?= get_phrase('jamia_departments') ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'books') echo 'active'; ?>">
                            <a href="<?= base_url('books') ?>"><?= get_phrase('books') ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'videos') echo 'active'; ?>">
                            <a href="<?= base_url('videos') ?>"><?= 'جامعہ ' . get_phrase('videos') ?></a>
                        </li>

                    </ul>
                </li>
                <li class="<?php if ($page_name == 'gallery') echo 'active'; ?>">
                    <a href="<?= base_url('gallery') ?>"><?= 'جامعہ ' . get_phrase('gallery') ?></a>
                </li>
                <!--<li class="<?php if ($page_name == 'books') echo 'active'; ?>">-->
                <!--    <a href="<?= base_url('books') ?>"><?= get_phrase('books') ?></a>-->
                <!--</li>-->
                <li class="<?php if ($page_name == 'position_holders') echo 'active'; ?>">
                    <a href="<?= base_url('position_holders') ?>"><?= get_phrase('position_holders') ?></a>
                </li>
                <li class="drop-down " >
                    <a href="<?= base_url('contact') ?>" class="
                    <?php
                    if ($page_name == 'contact')
                        echo 'active';
                    ?>"
                       >
                        <?= get_phrase('contact') ?></a>
                    <ul style="margin-top: 12px;">
                        <li>
                            <a href="<?= base_url('cooperation') ?>"><?= get_phrase('cooperation_method') ?></a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($page_name == 'alasr_resala') echo 'active'; ?>">
                    <a href="<?= base_url('alasr_resala') ?>"><?= get_phrase('alasr_resala') ?></a>
                </li>
                <!--<li class="<?php if ($page_name == 'videos') echo 'active'; ?>">-->
                <!--    <a href="<?= base_url('videos') ?>"><?= 'جامعہ ' . get_phrase('videos') ?></a>-->
                <!--</li>-->
                <li class="drop-down " >
                    <a href="#" ><?= 'والدین لاگ ان'?></a>
                    <ul style="margin-top: 12px;">
                        <li>
                            <a href="<?= base_url('drsi_nizami/index.php?parent_login') ?>"><?= 'درسی نظامی' ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header><!-- #header -->