
<div class="col-md-3 col-sm-12 col-md-pull-9">
    <div class="side-menu">
        <h3><i class="fa fa-search"></i> تلاش</h3>
        <div class="form-box">
            <div class="form-wrapper">
                <form action="<?= base_url('search_question') ?>" method="get" class="form-groups-bordered validate">
                    <div class="form-group">
                        <input type="text" class="form-control" name="word" placeholder="مطلوبہ لفظ" value="<?= $this->session->userdata('word') ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="فتوی نمبر">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="book_id" onchange="get_book_chapter(this.value)"  style="padding:0px 10px;">
                            <option value=""><?= 'کتاب منتخب کریں' ?></option>
                            <?php
                            
                            $ifta_books = $this->db->get('ifta_books')->result();
                            foreach ($ifta_books as $book) {
                                ?>
                                <option value="<?= $book->book_id ?>"<?php if ($this->session->userdata('search_book') == $book->book_id) echo 'selected'; ?>><?= $book->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="chapters" class="form-control" name="chapter_id" onchange="get_chapter_lesson(this.value)" style="padding:0px 10px;">
                            <?php
                            if (!empty($this->session->userdata('search_book'))) {
                                echo '<option value="">' . 'باب منتخب کریں' . '</option>';
                                $chapters = $this->db->get_where('ifta_books_chapters', array('book_id' => $this->session->userdata('search_book')))->result();
                                foreach ($chapters as $chap) {
                                    ?>
                                    <option value="<?= $chap->chapter_id ?>" <?php if ($this->session->userdata('search_chapter') == $chap->chapter_id) echo 'selected'; ?>><?= $chap->name ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value=""><?= 'باب منتخب کریں' ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="lesson" class="form-control select2" name="lesson_id" style="padding:0px 10px;">
                            <?php
                            if (!empty($this->session->userdata('search_lesson'))) {
                                echo '<option value="">' . 'فصل منتخب کریں' . '</option>';
                                $lessons = $this->db->get_where('ifta_chapter_lessons', array('chapter_id' => $this->session->userdata('search_chapter')))->result();
                                foreach ($lessons as $lesson) {
                                    ?>
                                    <option value="<?= $lesson->lesson_id ?>" <?php if ($this->session->userdata('search_lesson') == $lesson->lesson_id) echo 'selected'; ?>><?= $lesson->name ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value=""><?= 'صنف منتخب کریں' ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group" style="text-align:right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                            <span>تلاش کریں</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="side-menu">
        <h3><i class="fa fa-book"></i> تلاش</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="mazameeen-toggle" id="faq"  style="padding:0px; width: 100%">
                    <ul id="faq-list" class=" page-links" dir="rtl">
                        <?php
                        $book_no = 1;
                        $book_no2 = 2;
                        $book_no3 = 0;
                        $ifta_books = $this->db->get('ifta_books')->result();
                        foreach ($ifta_books as $book) {
                            ?>
                            <li>
                                <a data-toggle="collapse" class="collapsed" href="#faq<?= $book_no ?>" ><i class="ion-android-remove"></i><?= $book->name ?> </a>
                                <div id="faq<?= $book_no ?>" class="collapse" >
                                    <ul  class="page-links" dir="rtl">
                                        <?php
                                        $book_chapters = $this->db->get_where('ifta_books_chapters', array('book_id' => $book->book_id))->result();
                                        foreach ($book_chapters as $chapter) {
                                            $book_lessons = $this->db->get_where('ifta_chapter_lessons', array('chapter_id' => $chapter->chapter_id))->result();
                                            ?>
                                            <li>
                                                <?php if (empty($book_lessons)) { ?>

                                                    <a href="<?= base_url('search_individual/baab/' . $chapter->eng_name) ?>"><?= $chapter->name ?></a>

                                                <?php } else { ?>
                                                    <a data-toggle="collapse" class="collapsed" href="#faq_s<?= $book_no2 + $book_no3; ?>"><i class="ion-android-remove"></i><?= $chapter->name ?> </a> 
                                                    <div id="faq_s<?= $book_no2 + $book_no3; ?>" class="collapse" >
                                                        <ul  class="page-links" dir="rtl">
                                                            <?php
                                                            foreach ($book_lessons as $lesson) {
                                                                ?>
                                                                <li>
                                                                    <a href="<?= base_url('search_individual/fasal/' . $lesson->eng_name) ?>"><?= $lesson->name ?></a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                            <?php
                                            $book_no3++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>

                            <?php
                            $book_no += 2;
                            $book_no2 += 2;
                        }
                        ?>
                    </ul>
                </div>           
            </div>
        </div>
    </div>
    <div class="side-menu" id="widget_ask_question">
        <h3><i class="fa fa-comment"></i> <?= 'سوال پوچھیں' ?></h3>
        <p>اگر آپ کا مطلوبہ سوال موجود نہیں تو اپنا سوال پوچھنے کے لیے یہاں کلک کریں، سوال بھیجنے کے بعد جواب کا انتظار کریں۔ سوالات کی کثرت کی وجہ سے کبھی جواب دینے میں پندرہ بیس دن کا وقت بھی لگ جاتا ہے</p>
        <a href="<?= base_url('ask_question') ?>" class="btn btn-primary" style="width:80%; margin: 0 7% 20px 7%; font-size: 12px;">
            سوال پوچھیں
            <i class="drop-down"></i>
        </a>
    </div>
</div>
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
