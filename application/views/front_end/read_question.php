<?php include 'ifta_header.php'; ?>
<link rel="stylesheet" href="<?= base_url('assets/fonts/amiri/font.css') ?>">
<style>
    .sawal-jawab h3 {
        background: #f8f6f4;
    }
    .sawal-jawab h3, .sawal-jawab h4 {
        background: #ccc;
        color: #73161f;
        font-size: 20px;
        padding: 10px 12px;
        margin-bottom: 20px;
    }
    .sawal-jawab p {
        font-weight: bold;
        font-size: 13px;
        line-height: 36px;
    }
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
    .tag a {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        padding: 12px;
        -webkit-transition: 0.5s;
        -o-transition: 0.5s;
        transition: 0.5s;
        padding-right: 35px;
        text-align: right;
        font-size: 16px;
    }
    .tag i {
        margin-left: 10px;
        top: 14px;
        right: 10px;
        position: absolute;
    }
    .tag span{ font-size: 12px;}
    .tag:hover {
        background: #53516b;
        color :white;
    }

    .tag:hover a {
        text-decoration: none;
        color: #fff
    }
    div{ text-align: right;}
    .img-responsive{
        max-width: 100%;
        margin-top: 20px;
    }
    .marker{ font-family: 'amiri'}
    .marker{ font-size: 17px;}
    .sawal_jawab p{ text-align: justify}
</style>
<section class="inner-section" >
    <div class="container">
        <?php foreach ($question_data as $data) { ?>
            <div class="row">
                <div class="col-md-9 col-md-push-3 listing-bok">
                    <div class="row">
                        <div class="col-md-12" dir="header_darulifta">
                            <div class="row"> 
                                <img src="<?= base_url('uploads/ifta_header.png') ?>" class="img-responsive">
                                <div class="big-hr">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="text-black"><?= $data->title ?></h3>
                            <hr class="big-hr">
                        </div>
                        <div class="col-md-12 sawal-jawab">
                            <h3 class="question_heading" style="color:black">سوال</h3>
                            <p></p>
                            <p style="text-align:justify;">
                                <?= $data->question ?>
                            </p>
                            <p></p>
                            <h4 class="question_heading" style="color:black"> جواب</h4>
                            <div class="sawal_jawab">
                                <?= $data->answer ?>
                            </div>
                            <p></p>
                            <hr class="big-hr">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <p style="color:#000" class="question_heading">
                                        <?= 'فتوی نمبر : ' ?>
                                        <a id="fatwa_number"><?= $data->question_no ?></a>
                                    </p>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <p style="color:#000">
                                        <?= 'دارالافتاء : جامعہ عثمانیہ پشاور' ?>
                                    </p>
                                </div>
                            </div>

                            <hr class="big-hr">
                            <div class="col-sm-4 col-md-4">
                                <div class="tag" style="height: fit-content;">
                                    <a href="<?= base_url('search_individual/kitab/' . $this->db->get_where('ifta_books', array('book_id' => $data->book_id))->row()->eng_name) ?>">
                                        <i class="fa fa-file-text-o"></i>
                                        <span><?= $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $data->book_id) ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="tag" style="height: fit-content;">
                                    <a href="<?= base_url('search_individual/baab/' . $this->db->get_where('ifta_books_chapters', array('chapter_id' => $data->chapter_id))->row()->eng_name) ?>">
                                        <i class="fa fa-file-text-o"></i>
                                        <span><?= $this->crud_model->get_column_name_by_id('ifta_books_chapters', 'chapter_id', $data->chapter_id) ?></span>
                                    </a>
                                </div>
                            </div>
                            <?php if (!empty($data->lesson_id)) { ?>
                                <div class="col-sm-4 col-md-4">
                                    <div class="tag" style="height: fit-content;">
                                        <a href="<?= base_url('search_individual/fasal/' . $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $data->lesson_id))->row()->eng_name) ?>">
                                            <i class="fa fa-file-text-o"></i>
                                            <span><?= $this->crud_model->get_column_name_by_id('ifta_chapter_lessons', 'lesson_id', $data->lesson_id) ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-12">
                            <hr class="big-hr">
                        </div>
                    </div>
                </div>
                <?php include 'right_widgets.php'; ?>
            </div>
        <?php } ?>
    </div>
</div>
</section>