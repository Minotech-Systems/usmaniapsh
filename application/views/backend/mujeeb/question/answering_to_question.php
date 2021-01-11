<style>
    @media (max-width: 500px) {
        #question_detail{ font-size: 7px !important}
    }
    @media (max-width: 768px){
        .form-horizontal .control-label{
            margin-top: 0;
            margin-bottom: 8px;
            padding-top: 0px;
            font-size: 11px;
        }
    }
</style>
<?php
foreach ($question_data as $data) {
    $book_where = array('book_id' => $data->book_id);
    $chapter_where = array('chapter_id' => $data->chapter_id);
    $lesson_where = array('lesson_id' => $data->lesson_id);
    ?>
    <div class="row">
        <div class="col-md-12">

            <table width="90%" align="center"  style="line-height: 2.5" id="question_detail">
                <tr>
                    <td width="75%">
                        <h3 style="margin-top: 0px; line-height: 2;"><?= 'سوال نمبر' . ' : ' . $data->question_no ?></h3>
                        <?= 'عنوان' . ' : ' ?><?= $data->title ?>
                    </td>
                    <td>
                        <?= 'کتاب' . ' : ' ?><?= $this->question_model->get_table_column('ifta_books', $book_where, 'name') ?>
                        <br>            
                        <?= 'باب' . ' : ' ?><?= $this->question_model->get_table_column('ifta_books_chapters', $chapter_where, 'name') ?>
                        <br>
                        <?= 'صنف' . ' : ' ?><?= $this->question_model->get_table_column('ifta_chapter_lessons', $lesson_where, 'name') ?>


                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= 'سوال تشریح : ' ?>
                        <?= $data->question ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr style="border: 1px solid #ebebeb">
    <form action="<?= base_url('questions/add_question_answer') ?>" method="post" class="form-horizontal form-groups-bordered validate" id="answer">
        <div class="row">
            <div class="col-md-7">
                <textarea class="form-control ckeditor" required="" name="fitwa">
                                                                                                                                                                                                                                                            
                </textarea>
                <input type="hidden" name="question_id" value="<?= $data->question_id ?>">

                <br>
                <center>
                    <div>
                        <button class="btn btn-success" type="submit" style="padding-left: 50px; padding-right: 50px;">فتویٰ شامل کریں</button>
                    </div>
                </center>
            </div>
            <div class="col-md-5">
                <!--                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= 'فتویٰ نمبر' ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="fatwa_num" placeholder="فتویٰ نمبر">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= 'سلسہ نمبر' ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="selsela_num" placeholder="<?= 'سلسلہ نمبر' ?>">
                                    </div>
                                </div>
                                <div id="jawab_u_sahi">
                                </div>
                                <center>
                                    <a class="btn btn-default btn-sm add" name="add">الجواب صحیح شامل کریں</a>
                                </center>-->


            </div>
        </div>

    </form>

<?php }
?>

<script text="javascript">
    $(document).ready(function () {
        $(document).on('click', '.add', function () {
            var html = '';
            html += '<div class="form-group">';
            html += '<label class="col-sm-3 col-xs-12 control-label">الجواب صحیح</label>';
            html += '<div class="col-sm-7 col-xs-8">';
            html += '<input type="text" class="form-control" name="jawab_u_sahi[]" placeholder="الجواب صحیح">';
            html += '</div>';
            html += '<div><button type="button" name="remove" class="btn btn-danger remove">ختم کریں</button></div>';
            html += '</div></div>';

            $('#jawab_u_sahi').append(html);

            $(document).on('click', '.remove', function () {
                $(this).closest('.form-group').remove();
            });
        });
    });
</script>