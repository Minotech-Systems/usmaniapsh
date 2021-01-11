<?php include 'ifta_header.php'; ?>

<section class="inner-section ifta_search" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="talash-karein dark" >
                    <form action="<?= base_url('darulifta/search_question') ?>" method="get" class="form-groups-bordered validate">
                        <div class="col-xs-12 col-sm-12 col-md-2" style="text-align:right">
                            <h3 style="color:white;">
                                <i class="fa fa-search" style="margin-left:10px;"></i>تلاش
                            </h3>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" placeholder="مطلوبہ لفظ" class="form-control" name="word">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="book_id" onchange="get_book_chapter(this.value)"  style="padding:0px 10px;">
                                    <option value=""><?= 'کتاب منتخب کریں' ?></option>
                                    <?php foreach ($ifta_books as $book) { ?>
                                        <option value="<?= $book->book_id ?>"><?= $book->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-2"></div>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
                                <select id="chapters" class="form-control select2" name="chapter_id" onchange="get_chapter_lesson(this.value)" style="padding:0px 10px;">
                                    <option value=""><?= 'باب منتخب کریں' ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
                                <select id="lesson" class="form-control select2" name="lesson_id" style="padding:0px 10px;">
                                    <option value=""><?= 'فصل منتخب کریں' ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <button type="submit" title="تلاش کریں">
                                <i class="fa fa-search"></i>
                                <span>تلاش کریں</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="dar-ul-iftah" style="background: #f5f8fd;">
                    <div class="col-md-6">
                        <div class="bar" style="text-align:right; background:#53516b;">
                            <h4>نئے سوالات</h4>
                            <a href="<?= base_url('new_questions') ?>">تمام سوالات دیکھیں</a>
                            <i class="drop-down"></i>

                        </div>
                        <ul class="star-listing">
                            <?php
                            $qno = 1;
                            $questions = $this->frontend_model->get_tatest_question(6);
                            foreach ($questions as $q_data) {
                                if ($qno < 4) {
                                    ?>
                                    <li>
                                        <a href="<?= base_url('read_question/' . $q_data->question_no) ?>"><?= $q_data->title ?></a>
                                    </li>
                                    <?php
                                }
                                $qno++;
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <div class="bar" style="text-align:right; background: #53516b;">
                            <h4>نئے سوالات</h4>
                            <a href="<?= base_url('new_questions') ?>">تمام سوالات دیکھیں</a>
                            <i class="drop-down"></i>

                        </div>
                        <ul class="star-listing">
                            <?php
                            $qno = 1;
                            $questions = $this->frontend_model->get_tatest_question(6);
                            foreach ($questions as $q_data) {
                                if ($qno >= 4) {
                                    ?>
                                    <li>
                                        <a href="<?= base_url('read_question/' . $q_data->question_no) ?>"><?= $q_data->title ?></a>
                                    </li>
                                    <?php
                                }
                                $qno++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--.-->
        <div class="row iftah-boxes">
            <?php
            $no = 1;
            foreach ($limit_books as $q_books) {
                ?>
                <div class="col-sm-6 col-md-4 wow bounceInUp" data-wow-duration="<?= $no ?>s">
                    <h4 class="title-heading" style="text-align:right">
                        <?= $q_books->name ?>
                        <a href="<?= base_url('new_questions') ?>">تمام سوالات دیکھیں
                            <i class="drop-down"></i>
                        </a>
                    </h4>

                    <div class="islam-box">
                        <?php
                        $where = array();
                        $where['book_id'] = $q_books->book_id;
                        $where['show_no_site'] = 1;
                        $where['status'] = 1;
                        $order = "question_id desc";
                        $limit['param1'] = 3;
                        $limit['param2'] = 0;
                        $limt_questions = $this->frontend_model->get_table_data('ifta_question', $where, '', $order, $limit, 'other');

                        foreach ($limt_questions as $ques) {
                            ?>
                            <div class="media">
                                <div class="media-body">
                                    <h3><?= $this->crud_model->get_column_name_by_id('ifta_books_chapters', 'chapter_id', $ques->chapter_id); ?></h3>
                                    <p>
                                        <a href="<?= base_url('read_question/' . $ques->question_no) ?>"><?= $ques->title ?></a>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                $no += 0.5;
            }
            ?>
        </div>

        <!--.-->
        <div class="row">
            <div class="col-md-12">
                <div class="matloba-sawal full-width" style="height:180px">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-2 matloba">
                            <i class="entypo-chat" id="matloba"></i>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8 matloba">
                            <h3 class="text-red">
                                مطلوبہ سوال موجود نہیں؟
                            </h3>
                            <hr>
                            <p  id="matloba_p">اگر آپ کا مطلوبہ سوال موجود نہیں تو اپنا سوال پوچھنے کے لیے یہاں کلک کریں، سوال بھیجنے کے بعد جواب کا انتظار کریں۔ سوالات کی کثرت کی وجہ سے کبھی جواب دینے میں پندرہ بیس دن کا وقت بھی لگ جاتا ہے</p>

                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 matloba">
                            <div class="txt">
                                <a href="<?= base_url('ask_question') ?>" class="btn btn-primary" style="margin-top:80px">سوال پوچھیں
                                    <i class="drop-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--.-->
        <div class="row">

        </div>
    </div>
</section>
<script type="text/javascript">
    function get_book_chapter(book_id) {

        if (book_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_book_chapters/' + book_id,
                success: function (response)
                {

                    jQuery('#chapters').html(response);
                }
            });
        }
    }

    function get_chapter_lesson(chapter_id) {
        if (chapter_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_chapter_lesson/' + chapter_id,
                success: function (response)
                {

                    jQuery('#lesson').html(response);
                }
            });
        }
    }
</script>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>