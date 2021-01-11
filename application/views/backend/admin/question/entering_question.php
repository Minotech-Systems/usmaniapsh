<script src="<?= base_url() ?>assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txttitle);

    }

</script>
<br><br>
<?php echo form_open(base_url() . 'questions/create_question/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-2">
        <input type="text" class="form-control" name="title" id="txttitle" placeholder="<?= 'موضوع' ?>">
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-7 col-md-offset-2">
        <textarea style="padding: 6px" class="form-control" rows="5" required="" dir="rtl"  name="question"  placeholder="<?= 'سوال لکھیں۔۔۔' ?>"></textarea>
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-3 col-md-offset-2 col-sm-6">
        <select class="form-control select2" name="book_id" onchange="get_book_chapter(this.value)" required="">
            <option value=""><?= 'کتاب منتخب کریں' ?></option>
            <?php foreach ($ifta_books as $book) { ?>
                <option value="<?= $book->book_id ?>"><?= $book->name ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-3 col-sm-6">
        <select id="chapters" class="form-control select2" name="chapter_id" onchange="get_chapter_lesson(this.value)" >
            <option value=""><?= 'باب منتخب کریں' ?></option>

        </select>
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-3 col-sm-6 col-md-offset-2">
        <select id="lesson" class="form-control select2" name="lesson_id">
            <option value=""><?= 'فصل منتخب کریں' ?></option>
        </select>
    </div>
    <div class="col-md-3 col-sm-6">
        <select id="lesson" class="form-control " name="question_type">
            <option value=""><?= 'اقسام سوال' ?></option>
            <option value="<?= 'ڈاک' ?>"><?= 'ڈاک' ?></option>
            <option value="<?= 'دستی' ?>"><?= 'دستی' ?></option>
            <option value="<?= 'ای میل' ?>"><?= 'ای میل' ?></option>
        </select>
    </div>

    <div class="clear"></div>
    <br />
    <div class="col-md-3 col-sm-6 col-md-offset-2">
        <input type="text" class="form-control" name="questioner" placeholder="<?= 'مستفتی' ?>">
    </div>
    <div class="col-md-3 col-sm-6 ">
        <input type="email" class="form-control" name="email" placeholder="<?= 'مستفتی ایمیل' ?>">
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-3 col-sm-6 col-md-offset-2">
        <input type="text" class="form-control" name="address" placeholder="<?= 'پتہ۔۔۔۔' ?>">
    </div>
    <div class="col-md-3 col-sm-6 ">
        <input type="number" class="form-control" name="phone" placeholder="<?= 'مستفتی موبائل نمبر' ?>">
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-3 col-sm-6 col-md-offset-2">
        <select class="form-control" name="mujeeb_id"  onchange="get_mujeeb_question(this.value)">
            <option value=""><?= 'مجیب منتخب کریں' ?></option>
            <?php foreach ($ifta_users as $users) { ?>
                <option value="<?= $users->user_id ?>"><?= $users->name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-3 col-sm-6 col-md-offset-2">
        <div class="input-group" dir="ltr">
            <input type="text" name="return_date_questioner" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="<?= 'تاریخ واپسی  مستفتی' ?>">
            <div class="input-group-addon">
                <a href="#"><i class="entypo-calendar"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="input-group" dir="ltr">
            <input type="text" name="return_date_mujeeb" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="<?= 'تاریخ واپسی  مجیب' ?>">
            <div class="input-group-addon">
                <a href="#"><i class="entypo-calendar"></i></a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-6 col-md-offset-2" id="mujeeb_question_view">
        <div id="loading_gif" style="display: none"><img src="<?= base_url('uploads/loading.gif') ?>" width="100"></div>
    </div>
    <div class="col-md-3 col-sm-6 col-md-offset-3">
        <button class="btn btn-success">
            <?= 'اندراج سوال' ?>
        </button>
    </div>
</div>
<?= form_close() ?>
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

    function get_mujeeb_question(mujeeb_id) {
        $('#loading_gif').show();
        $.ajax({
            url: '<?php echo base_url(); ?>questions/get_mujeeb_question/' + mujeeb_id,
            success: function (response)
            {
                $('#loading_gif').hide();
                jQuery('#mujeeb_question_view').html(response);  //other_fee_detial

            }
        });


    }

</script>
