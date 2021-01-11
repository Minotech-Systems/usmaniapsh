
<section  class="clearfix d-lg-none" style="background: #53516b; color: white; padding: 3px 0px;">
    <div class="container ">
        <div class="row ">

            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <center>

                    <h2 style="" class="arabic" id="head_start"><?= 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم' ?></h2>

                </center>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <table width="95%" dir="rtl" style="color:white" align="center" id="mobile_head">
                        <tr>
                            <td width="30%" align="right">
                                <a href="#" class=" top_mobile_links">لاگ ان</a>
                            </td>
                            <td width="40%" align="center">
                                <?= date('d/m/Y') ?>
                            </td>

                            <td width="30%" align="left">
                                <select  style="background: #6d6c71; border: none" onchange="change_lang(this.value)">
                                    <option value="english"<?php if ($lang == 'english') echo 'selected'; ?>>English</option>
                                    <option value="urdu" <?php if ($lang == 'urdu') echo 'selected'; ?>>اردو</option>
                                </select>
                            </td>
                            
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
<!--<style>
    .section-bg{background: #5c5248 url("uploads/cen_bg.jpg") repeat; background-attachment: fixed}
</style>-->
<main id="main">

    <section   id="testimonials">
        <div id="slider-animation" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#slider-animation" data-slide-to="0" class="active"></li>
                <li data-target="#slider-animation" data-slide-to="1"></li>
                <li data-target="#slider-animation" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('uploads/slider/bg.jpg') ?>" alt="Los Angeles" width="100%">

                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('uploads/slider/bg.jpg') ?>" alt="Chicago" width="100%">

                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('uploads/slider/bg.jpg') ?>" alt="New York" width="100%">

                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#slider-animation" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slider-animation" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>

    </section>
    <!-- #testimonials -->

    <!-- News About New Admission-->
    <?php
    $admission_notice = $this->db->get('frontend_admission_notice')->row();
    if ($admission_notice->status == 1) {
        ?>
        <section    style="background: linear-gradient(#f5f8fd, #fff); padding: 20px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url('page/اعلان-داخلہ') ?>">
                            <?= $admission_notice->title ?>
                        </a>
                    </div>
                </div>
        </section>
    <?php } ?>

    <section id="services" class="section-bg" >
        <div class="container">

            <div class="row">

                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
                    <div class="box">
                        <a href="<?= base_url('darulifta') ?>">
                            <div style="float: left">
                                <img src="<?= base_url('uploads/icons/icon-book.png') ?>">
                            </div>
                            <div style="float: right; text-align: right">
                                <h4 class="title">دارالافتاء</h4>
                                <br>
                                <p class="description">آپ کے مسائل اور ان کا حل</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
                    <div class="box">
                        <a href="<?= base_url('page/تعارف') ?>">
                            <div style="float: left">
                                <img src="<?= base_url('uploads/icons/taruf-icon.png') ?>">
                            </div>
                            <div style="float: right; text-align: right">
                                <h4 class="title">تعارف جامعہ عثمانیہ پشاور</h4>
                                <br>
                                <p class="description">جامعہ اور اس کی شاخیں ایک نظر میں</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
                    <div class="box">
                        <a href="<?= base_url('contact')?>">
                        <div style="float: left">
                            <img src="<?= base_url('uploads/icons/makalat-icon.png') ?>">
                        </div>
                        <div style="float: right; text-align: right">
                            <h4 class="title">رابطہ</h4>
                            <br>
                            <p class="description">برائے معلومات</p>
                        </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!--==========================
      Aham Elanaat
    ============================-->
    <?php
    $this->db->order_by('news_id', 'desc');
    $frontend_news = $this->db->get('frontend_news')->result();
    if (!empty($frontend_news)) {
        ?>
        <style>
            .news_link:hover{text-decoration: none; color: #101010;}
        </style>
        <section   id="testimonials" style="padding:0px; margin-top: 20px; margin-bottom: 20px">

            <div id="slider-animation1" class="carousel slide" data-ride="carousel">

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <?php
                    $news_no = 1;
                    foreach ($frontend_news as $news) {
                        ?>َ
                        <div class="carousel-item <?php if ($news_no == 1) echo 'active'; ?>">
                            <div class="testimonial-item" style=" background: #f5f8fd; padding: 20px;">
                                <center>
                                    <div class="inner-data" style="width:80%">
                                        <h3><?= $news->news_title ?></h3>
                                        <a href="<?= 'page/ضروری-اعلانات' ?>" class="news_link">
                                            <p style=" text-align: justify;
                                               line-height: 2;
                                               font-style: initial;
                                               width: 100%;
                                               margin-top: 20px;">
                                               <?php
                                               echo $ur_str = (strlen($news->news_description) > 550) ? substr($news->news_description, 0, 550) . '...' : $news->news_description;
                                               ?>
                                            </p>
                                        </a>

                                    </div>
                                </center>
                            </div>
                        </div>
                        <?php
                        $news_no++;
                    }
                    ?>

                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#slider-animation1" data-slide="prev">
                    <span class="carousel-control-prev-icon" style="color:black"></span>
                </a>
                <a class="carousel-control-next" href="#slider-animation1" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </section>

    <?php } ?>
    <style>
        #myTab li{ width: 50%; text-align: center}
        .main_nav .nav-link.active{ background-color:#53516b; border: solid 2px #53516b; color: white }
        .main_nav .nav-link { border-radius: 0px; font-size: 25px; font-weight: bold;}
        .main_nav .nav-link { background: #eaeaea; border: solid 2px #eaeaea; color: #4c4b58}
        #myTabContent .tab-pane{ background: white; color: #413e66; padding: 25px}
        #myTabContent .tab-pane .media{
            padding-bottom: 20px;
            border-bottom: solid 1px #dbdbdb;
            margin-bottom: 20px;
        }
        #myTabContent .tab-pane .media .media-left{ padding-left: 30px;}
        #myTab li a {margin-left: 0px !important; margin-right: 0px;}
        div{text-align: right}
        section{
            padding: 50px 0;
            background: #fff;
            position: relative;
            z-index: 1;
        }
        #myTabContent .tab-pane p{font-size: 12px; text-align: justify; line-height: 2}
        .media-body{overflow: unset;}


    </style>
    <section id="darulifta" class="tabing-section" style="background:#f5f8fd">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding:20px">
                    <ul class="nav nav-tabs main_nav" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#new_question" role="tab" aria-controls="home" aria-selected="true">نئے سوالات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#select_question" role="tab" aria-controls="profile" aria-selected="false">منتخب سوالات</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="new_question" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row wow bounceInUp">
                                <?php
                                $no = 1;
                                foreach ($latest_question as $new_que) {
                                    if ($no == 1) {
                                        ?>
                                        <div class="col-sm-12 col-md-4 " dir="rtl" style="border-left: solid 1px #dbdbdb;">

                                            <p>
                                                <?= 'تاریخ : ' . date('d-m-Y', strtotime($new_que->mu_solved_date)) ?>
                                            </p>
                                            <h6><?php
                                                if (strlen($new_que->title) > 100) {
                                                    echo substr($new_que->title, 0, 100) . '...';
                                                } else {
                                                    echo $new_que->title;
                                                }
                                                ?>
                                            </h6>
                                            <p><?php
                                                if (strlen($new_que->question) > 300) {
                                                    echo substr($new_que->question, 0, 320) . '...';
                                                } else {
                                                    echo $new_que->question;
                                                }
                                                ?></p>
                                            <p></p>
                                            <a href="<?= base_url('read_question/' . $new_que->question_no) ?>">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>

                                        </div>
                                        <?php
                                    }
                                    $no++;
                                }
                                ?>
                                <div class="col-sm-6 col-md-4 " style="border-left: solid 1px #dbdbdb;">
                                    <?php
                                    $no1 = 1;
                                    foreach ($latest_question as $new_que) {
                                        if ($no1 == 2 || $no1 == 3 || $no1 == 4) {
                                            ?>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?= base_url('read_question/' . $new_que->question_no) ?>">
                                                        <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><?= $new_que->title; ?></p>
                                                    <a href="<?= base_url('read_question/' . $new_que->question_no) ?>">
                                                        <i class="fa fa-angle-left"></i>
                                                        <?= 'تفصیل' ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        $no1++;
                                    }
                                    ?>
                                </div>

                                <div class="col-sm-6 col-md-4 ">
                                    <?php
                                    $no2 = 1;
                                    foreach ($latest_question as $new_que) {
                                        if ($no2 == 5 || $no2 == 6 || $no2 == 7) {
                                            ?>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?= base_url('read_question/' . $new_que->question_no) ?>">
                                                        <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p><?= $new_que->title; ?></p>
                                                    <a href="<?= base_url('read_question/' . $new_que->question_no) ?>">
                                                        <i class="fa fa-angle-left"></i>
                                                        <?= 'تفصیل' ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        $no2++;
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="select_question" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-sm-12 col-md-4" dir="rtl" style="border-left: solid 1px #dbdbdb;">
                                    <p>
                                        تاریخ: 13-02-2020
                                    </p>
                                    <h6>حورین نام رکھنا</h6>
                                    <p>حورین نام رکھنا کیسا ہے ؟</p>
                                    <p></p>
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <?= 'تفصیل' ?>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>روزے میں فرض غسل کے دوران کلی کرنا</p>
                                            <a href="#">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>روزے میں فرض غسل کے دوران کلی کرنا</p>
                                            <a href="#">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>روزے میں فرض غسل کے دوران کلی کرنا</p>
                                            <a href="#">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>روزے میں فرض غسل کے دوران کلی کرنا</p>
                                            <a href="#">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>روزے میں فرض غسل کے دوران کلی کرنا</p>
                                            <a href="#">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>روزے میں فرض غسل کے دوران کلی کرنا</p>
                                            <a href="#">
                                                <i class="fa fa-angle-left"></i>
                                                <?= 'تفصیل' ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section class="islam-arkan">
        <div class="container">
            <div class="row iftah-boxes">
                <div class="col-sm-6 col-md-4 wow bounceInUp" data-wow-duration="1.4s">
                    <h4 class="title-heading" style="text-align:right">
                        کتابیں

                    </h4>

                    <div class="islam-box">
                        <?php
                        $where = array();
                        $where['show_on_website'] = 1;
                        $limit['param1'] = 3;
                        $general_books = $this->frontend_model->get_table_data('web_books', $where, '', '', $limit);
                        foreach ($general_books as $g_book) {
                            ?>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3><?= $g_book->name ?></h3>
                                    <p>
                                        <a href="books">پڑھنے کے لیے کلک کریں</a>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow bounceInUp" data-wow-duration="1.8s">
                    <h4 class="title-heading" style="text-align:right">
                        نماز کے اوقات

                    </h4>

                    <div class="islam-box">
                        <p>
                            <?php
                            $urdu_month = $this->crud_model->get_urdu_month_name(date('m'));
                            $islamica_date = $this->crud_model->get_islamic_date(date('d-m-Y'));
                            $date = date('d') . $urdu_month . date('Y');
                            echo $islamica_date . ' - ' . $date . 'ء ' . ' ' . 'پشاور میں نماز کے اوقات';
                            ?>
                        </p>
                        <ul class="namaz-okat">
                            <li>
                                <div class="sun">
                                    <img src="<?= base_url('assets/frontend/images/sun.jpg') ?>">
                                </div>
                                <span class="namaz">فجر</span>
                                <span class="time">12:00</span>
                            </li>
                            <li>
                                <div class="sun">
                                    <img src="<?= base_url('assets/frontend/images/sun.jpg') ?>">
                                </div>
                                <span class="namaz">طلوع</span>
                                <span class="time">12:00</span>
                            </li>
                            <li>
                                <div class="sun">
                                    <img src="<?= base_url('assets/frontend/images/sun2.jpg') ?>">
                                </div>
                                <span class="namaz">زوال</span>
                                <span class="time">12:00</span>
                            </li>
                            <li>
                                <div class="sun">
                                    <img src="<?= base_url('assets/frontend/images/sun2.jpg') ?>">
                                </div>
                                <span class="namaz">عصر</span>
                                <span class="time">12:00</span>
                            </li>
                            <li>
                                <div class="sun">
                                    <img src="<?= base_url('assets/frontend/images/sun3.jpg') ?>">
                                </div>
                                <span class="namaz">غروب</span>
                                <span class="time">12:00</span>
                            </li>
                            <li>
                                <div class="sun">
                                    <img src="<?= base_url('assets/frontend/images/sun.jpg') ?>">
                                </div>
                                <span class="namaz">عشاء</span>
                                <span class="time">12:00</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow bounceInUp" data-wow-duration="2s">
                    <h4 class="title-heading" style="text-align:right">
                        مقالات

                    </h4>
                    <div class="islam-box">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3>اسلامی عقائد</h3>
                                <p>
                                    <a href="#"> وہ خدا بنا ہوا ہے، کہنے کا حکم</a>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3>اسلامی عقائد</h3>
                                <p>
                                    <a href="#"> وہ خدا بنا ہوا ہے، کہنے کا حکم</a>
                                </p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img src="<?= base_url('assets/frontend/images/fallback.jpg') ?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3>اسلامی عقائد</h3>
                                <p>
                                    <a href="#"> وہ خدا بنا ہوا ہے، کہنے کا حکم</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>