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
    .tag {
        background: #f8f6f4;
        color: #7b654d;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 20px;
        -webkit-transition: 0.5s;
        -o-transition: 0.5s;
        transition: 0.5s;
    }
</style>
<?php include 'header.php'; ?>
<section class="inner-section">
    <div class="container">
        <div class="row" style="margin-top:30px;">
            <div class="col-md-9 col-md-push-3">
                <?php
                $this->db->order_by('news_id', 'DESC');
                $news_updates = $this->db->get('frontend_news')->result();
                foreach ($news_updates as $news) {
                    ?>
                    <div class="inner-head">
                        <div class="para">
                            <p><?= $news->news_title ?></p>
                        </div>
                    </div>
                    <div id="about_jamia" style="text-align:right; line-height:2">
                        <?= $news->news_description ?>
                    </div>
                    <div id="news_file" style="text-align:center">
                        <?php
                        $news_files = $this->db->get_where('news_files', array('news_id' => $news->news_id))->result();
                        if (!empty($news_files)) {
                            ?>
                            <div class="row" style="margin-top:10px;">
                                <?php
                                foreach ($news_files as $files) {
                                    ?>
                                    <div class="col-sm-3">
                                        <div class="tag">
                                            <a href="<?= base_url('uploads/news/' . $files->file) ?>" target="blank">
                                                <i class="fa fa-file-text-o"></i>
                                                <span><?= $files->file_name ?></span>
                                            </a>
                                        </div>

                                    </div>


                                <?php }
                                ?>
                            </div>

                        <?php }
                        ?>
                    </div>
                    <br><br>
                    <span><?= 'تاریخ' . ' : ' . date('d/m/Y', strtotime($news->create_date)) ?></span>
                    <hr>
                <?php } ?>
            </div>

            <?php include 'book_right_widgets.php'; ?>

        </div>
    </div>
</section>