<style>
    .books-list .books-inner {
        padding: 35px 35px;
        border: 1px solid #D4C8BD;
        background: url(<?= base_url('assets/frontend/images/patteren-lighten.jpg') ?>) repeat center center;
        overflow: hidden;
        position: relative;
        margin-bottom: 30px;
    }
    .books-list .books-inner .books-thumbs {
        float: right;
        margin: 0 0 0 20px;
    }
    .books-list .books-inner a.btn {
        position: absolute;
        bottom: 35px;
        left: 35px;
        min-width: 110px;
    }
    .btn-brwon {
        background: #4e3a26;
        border: solid 1px #4e3a26;
        color: #fff;
        position: relative;
    }
    .books-list .books-inner a.btn span {
        z-index: 1;
        position: relative;
    }
    .books-list .books-inner a.btn i {
        z-index: 1;
        left: 25px;
        top: 5px;
    }
    .books-list .books-inner .books-thumbs img {
        max-width: 150px;
    }
    @media (min-width: 1200px){
        .btn-brwon:hover {
            color: #fff;
        }
    }
    .btn-brwon {
        background: #4e3a26;
        border: solid 1px #4e3a26;
        color: #fff !important;
        position: relative;
    }
    .books-inner p{
        text-align: right;
        line-height: 2;
        font-size: 14px;
    }
    p{text-align:justify;}
    /*p,h1,h2,h3,h4,h5,h6{text-align:right; line-height:2}*/
</style>
<?php $this->load->view('front_end/header') ?>
<style>
    #map {
        height: 400px; 
        width: 100%;  
    }
</style>




<section class="inner-section" id="video">
    <div class="container">
        <div class="row" style="margin-top:30px;">
            <div class="col-md-9 col-md-push-3" >
                <div class="row">
                    <?php
                    $video_sections = $this->db->get('video_section')->result();
                    foreach ($video_sections as $v_section) {
                        if (!empty($v_section->thumbnail)) {
                            $thubmnial = 'uploads/section_thumbnail/' . $v_section->thumbnail;
                        } else {
                            $thubmnial = 'uploads/bg.jpg';
                        }
                        ?>
                        <div class="col-md-6 wow fadeInUp">
                            <div class="member">
                                <img src="<?= base_url("$thubmnial") ?>" class="img-fluid" alt="" style="max-height:240px">
                                <div class="member-info">
                                    <div class="member-info-content">
                                        <h4><?= $v_section->title ?></h4>
                                        <span><?= $v_section->description ?></span>
                                        <div class="social">
                                            <a href="<?= base_url('videos/play/' . $v_section->title . '/' . $v_section->id) ?>">
                                                <?= 'ویڈیوز کو دیکھنے کیلئے کلک کریں' ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <?php $this->load->view('front_end/book_right_widgets') ?>

        </div>
    </div>
</section>