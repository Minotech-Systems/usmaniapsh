<?php
$data = $this->db->get_where('ifta_question', array('question_id' => $param2))->row();
?>
<div class="row">
    <div class="col-md-12">
        <table width="100%" align="center" dir="rtl" style="font-size: 10px; line-height: 2">
            <tr>
                <td>
                    <?= 'سوال نمبر' ?>: &nbsp;&nbsp;<?= $data->question_no ?>
                    <br>
                    <?= 'اقسام سوال' ?>:&nbsp;&nbsp;<?= $data->question_type ?>
                    <br>
                    <?= 'تاریخ آمد' ?>: &nbsp;&nbsp;<?= date('d-m-Y', strtotime($data->date_added)) ?>
                    <br>
                    <?= 'تاریخ واپسی' ?>:&nbsp;&nbsp;<?= date('d-m-Y', strtotime($data->m_solved_date)) ?>
                    <br>
                    <?= 'تاریخ واپسی مجیب' ?>:&nbsp;&nbsp;<?= date('d-m-Y', strtotime($data->mu_solved_date)) ?>
                </td>
                <td align="center">
                    <?= 'کتاب' ?>: &nbsp;&nbsp;<?= $this->db->get_where('ifta_books', array('book_id' => $data->book_id))->row()->name ?>
                    <br>
                    <?= 'باب' ?>:&nbsp;&nbsp;<?= $this->db->get_where('ifta_books_chapters', array('chapter_id' => $data->chapter_id))->row()->name ?>
                    <br>
                    <?= 'صنف' ?>:&nbsp;&nbsp;<?= $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $data->lesson_id))->row()->name ?>
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <?= 'عنوان' . ' : ' ?><br>
                    <p style="margin-right: 20px"><?= $data->title ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= 'سوال' . ' : ' ?><br>
                    <p style="margin-right: 20px; line-height: 3;"><?= $data->question ?></p>
                </td>
            </tr>

        </table>

        <table class="table table-striped">

            <?php
            if (!empty($data->questioner_id)) {
                $questioner_data = $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row()
                ?>
                <tr>
                    <td align="center" colspan="6"><?= 'مستفتی معلومات' ?></td>
                </tr>
                <tr>
                    <td><?= 'نام' ?>:</td>
                    <td><?= $questioner_data->name ?></td>
                    <td><?= 'موبائل نمبر' ?>:</td>
                    <td><?= $questioner_data->phone ?></td>
                    <td><?= 'ای میل' ?>:</td>
                    <td><?= $questioner_data->email ?></td>
                </tr>
                <tr>
                    <td><?= 'پتہ' ?></td>
                    <td colspan="5"><?= $questioner_data->address ?></td>
                </tr>
                <?php
            }
            $check_user = $this->db->get_where('ifta_user_question', array('question_id' => $data->question_id))->row();
            if (!empty($check_user)) {
                $user_data = $this->db->get_where('ifta_users', array('user_id' => $check_user->user_id))->row();
                ?>
                <tr>
                    <td colspan="6" align="center"><?= 'معلومات مجیب' ?></td>
                </tr>
                <tr>
                    <td><?= 'نام' ?></td>
                    <td><?= $user_data->name ?></td>
                    <td><?= 'ای میل' ?></td>
                    <td><?= $user_data->email ?></td>
                    <td><?= 'موبائل نمبر' ?></td>
                    <td><?= $user_data->phone ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>





