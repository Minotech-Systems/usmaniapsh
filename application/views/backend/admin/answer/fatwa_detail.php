<style>
    fieldset{
        border: 2px solid !important;
        padding: 10px;
    }
    legend{
        width: 20%;
        border-bottom: none;
        text-align: center;
    }
    p{ margin: 10px;}
    #border{
        border: solid black 1px;
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
        -webkit-box-shadow: 0 1px 1px #ccc;
        -moz-box-shadow: 0 1px 1px #ccc;
        box-shadow: 0 1px 1px #ccc;
        text-align: center;
        font-size: 12px;
        line-height: 2;
    }
</style>
<?php
foreach ($fatwa as $data) {
    $mujeeb_detail = $this->db->get_where('ifta_user_question', array('question_id' => $data->question_id))->row();
    ?>
    <div class="row">
        <div class="col-sm-6">
            <fieldset>
                <legend><?= 'معلومات سوال' ?></legend>
                <table width="100%" align="center" dir="rtl" style="line-height:2.5; font-size: 13px;">
                    <tr>
                        <td>
                            <?= 'سوال نمبر' . ' : ' . $data->question_no ?><br>
                            <?= 'اقسام سوال' . ' : ' . $data->question_type ?><br>
                            <?= 'تاریخ آمد' . ' : ' . $data->q_date ?><br>
                            <?= 'تاریخ واپسی' . ' : ' . $data->m_solved_date ?><br>
                            <?= 'تاریخ واپسی مجیب' . ' : ' . $data->mu_solved_date ?>
                        </td>
                        <td>
                            <?= 'کتاب' . ' : ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $data->book_id); ?><br>
                            <?= 'باب' . ' : ' . $this->crud_model->get_column_name_by_id('ifta_books_chapters', 'chapter_id', $data->chapter_id); ?><br>
                            <?= 'صنف' . ' : ' . $this->crud_model->get_column_name_by_id('ifta_chapter_lessons', 'lesson_id', $data->lesson_id); ?><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p><?= 'سوال' . ' : ' ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p><?= $data->question ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <p><?= 'مستفتی معلومات' ?></p>
                            <hr style="width:60%">
                        </td>
                    </tr>
                    <?php $questioner = $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row(); ?>
                    <tr>
                        <td><?= 'نام' . ' : ' . $questioner->name ?></td>
                        <td><?= 'ای میل' . ' : ' . $questioner->email ?></td>
                    </tr>
                    <tr>
                        <td><?= 'پتہ' . ' : ' . $questioner->address ?></td>
                        <td><?= 'موبائل نمبرٖ' . ' : ' . $questioner->phone ?></td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div class="col-sm-6">
            <fieldset>
                <legend><?= 'فتویٰ' ?></legend>
                <table width="100%"   dir="rtl">
                    <tr>
                        <td width="70%" align="right">
                            <table   width="60%" align="center" id="border" dir="rtl">
                                <tr>
                                    <td colspan="2"><?= 'دارلافتاء جامعہ عثمانیہ پشاور' ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'سلسلہ نمبر' ?>&nbsp;:&nbsp; <?= $data->selsela_num ?></td>
                                    <td><?= 'بنام:' ?> &nbsp;:&nbsp; <?= $questioner->name ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'تاریخ آمد' ?>&nbsp;: &nbsp;<?= $data->q_date ?></td>
                                    <td><?= 'واپسی' ?>&nbsp; : &nbsp;<?= $data->m_solved_date ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'فتویٰ نمبر' ?>&nbsp; : &nbsp;<?= $data->fatwa_num ?></td>
                                    <td><?= 'دستخط' ?>&nbsp; : &nbsp;<?= '__________' ?></td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
                <table width="90%">
                    <tr>
                        <td colspan="2"><?= 'الجواب وباللہ التوفیق:' ?></td>
                    </tr>
                    <tr>
                        <td style="line-height: 2.5" colspan="2"><?= $data->answer ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?= 'کتبہ : ' ?><?= $this->db->get_where('ifta_users', array('user_id' => $mujeeb_detail->user_id))->row()->name ?>
                            <?= '۔۔۔۔۔۔۔۔۔۔۔۔۔' ?>
                        </td>
                    </tr>
                    <tr>
                        <?php $editors = json_decode($data->editors) ?>
                        <td><p><?= 'شریک تخصص فی الفقہ الاسلامی' ?></p></td>
                        <td>
                            <?php
                            foreach ($editors as $edit) {
                                echo '&nbsp;&nbsp;' . $edit . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <center>
                <a href="<?= base_url('fatwa/print_fatwa/' . $data->answer_id) ?>" target="blank" class="btn btn-default">
                    <i class="fa fa-print"></i>
                    <?= 'پرنٹ رپورٹ' ?>
                </a>
            </center>
        </div>
    </div>
    <?php
}?>