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
   
</style>
<?php include 'header.php'; ?>
<section class="inner-section">
    <div class="container">
        <div class="row" style="margin-top:30px;">
            <div class="col-md-9 col-md-push-3">
                <div class="inner-head">
                    <div class="para">
                        <p><?= 'جامعہ کا تاریخی سفر' ?></p>
                    </div>
                </div>
                <div id="about_jamia" style="text-align:right; line-height:2">
                    <?= $this->db->get_where('web_settings', array('type' => 'historical_travel'))->row()->description; ?>
                </div>


            </div>

            <?php include 'book_right_widgets.php'; ?>

        </div>
    </div>
</section>