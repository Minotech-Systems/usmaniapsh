<?php $lang = $this->session->userdata('system_lang') ?>
<!--==========================
  Header
  ============================-->
<header id="header" style="padding:0px; background: white;">

    <div id="topbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4" style="text-align:right;">
                    <a href="<?= base_url('login') ?>"><?= 'لاگ ان' ?></a>
                    <select style="background: #7b654d; padding: 5px; border: none; margin-right: 30px; color: white;" onchange="change_lang(this.value)">
                        <option value="english"<?php if ($lang == 'english') echo 'selected'; ?>>English</option>
                        <option value="urdu" <?php if ($lang == 'urdu') echo 'selected'; ?>>اردو</option>
                    </select>
                </div>
                <div class="col-sm-4 col-md-4">
                    <center>
                        <h2 style="margin-top: 10px; font-size: 18px" class="arabic"><?= 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم' ?></h2>
                    </center>
                </div>
                <div class="col-sm-4 col-md-4"></div>
            </div>
        </div>
    </div>


    <div class="container" >

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
                <li class="active"><a href="#intro"><?= get_phrase('home') ?></a></li>
                <li class="drop-down">
                    <a href="#about"><?= get_phrase('darulifta') ?></a>
                    <ul>
                        <li>
                            <a href="#"><?= get_phrase('new_questions') ?></a>
                        </li>
                        <li>
                            <a href="#"><?= get_phrase('ask_question') ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header><!-- #header -->