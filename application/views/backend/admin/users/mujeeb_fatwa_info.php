<br>
<form method="post" action="<?= base_url('admin/mujeeb_fatwa_info/search') ?>">
    <div class="row">	
        <div class="col-md-2 col-md-offset-1">	
            <div class="form-group">
                <label class="control-label"><?= 'مجیب' ?></label>		
                <select name="user_id" class="form-control" required="">	
                    <option value=""><?php echo get_phrase('select_mujeeb'); ?></option>			
                    <?php
                    foreach ($ifta_users as $data) {
                        ?>  
                        <option value="<?= $data->user_id ?>" ><?= $data->name ?></option>                                
                    <?php } ?>			
                </select>	
            </div>	
        </div>
        <!--.-->
        <div class="col-md-2">	
            <div class="form-group">
                <label class="control-label"><?= 'کتاب' ?></label>		
                <select class="form-control " name="book_id" onchange="get_book_chapter(this.value)" >
                    <option value=""><?= 'کتاب منتخب کریں' ?></option>
                    <?php foreach ($ifta_books as $book) { ?>
                        <option value="<?= $book->book_id ?>"><?= $book->name ?></option>
                    <?php } ?>
                </select>	
            </div>	
        </div>
        <!--.-->
        <div class="col-md-2">	
            <div class="form-group">
                <label class="control-label"><?= 'باب' ?></label>
                <select id="chapters" class="form-control " name="chapter_id" onchange="get_chapter_lesson(this.value)" >
                    <option value=""><?= 'باب منتخب کریں' ?></option>

                </select>
            </div>
        </div>
        <!--.-->
        <div class="col-md-2">	
            <div class="form-group">
                <label class="control-label"><?= 'صنف' ?></label>
                <select id="lesson" class="form-control" name="lesson_id" >
                    <option value=""><?= 'صنف منتخب کریں' ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-2">	
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="margin-top: 20px;"><?= 'تلاش کریں' ?></button>
            </div>
        </div>
    </div>
</form>
<?php include 'get_user_fatwa_info.php'; ?>
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