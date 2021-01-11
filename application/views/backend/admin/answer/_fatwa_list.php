<html>
    <head>
        <title><?= 'جامعہ عثمانیہ پشاور' ?></title>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/fonts/nastaleeq/font.css">
        <style>
            body{
                font-family: Noto Nastaliq Urdu Draft;
            }
        </style>
    </head>
    <body dir="rtl">
        <table width="90%" style="text-align: center" align="center">
            <tr>
                <td><h3><?= 'رجسٹرڈآمدواجرااستفتاءت جامعہ عثمانیہ پشاور' ?></h3></td>
                <td><img src="<?= base_url('uploads/logo.png') ?>" width="90"></td>
            </tr>
        </table>
        <table width="100%" style="border:1px solid black; border-collapse: collapse; text-align: center; font-size: 11px; font-weight: bold;" border="1" align="center">
            <tr>
                <td>#</td>
                <td><?= 'سلسلہ نمبر' ?></td>
                <td><?= 'فتویٰ نمبر' ?></td>
                <td><?= 'نام مستفتی ' ?></td>
                <td><?= 'موبائل نمبر' ?></td>
                <td><?= 'ای میل' ?></td>
                <td><?= 'عنوان فتویٰ' ?></td>
                <td><?= 'کتاب' ?></td>
                <td><?= 'باب' ?></td>
                <td><?= 'تاریخ اجرا' ?></td>
                <td><?= 'قسم' ?></td>
                <td><?= 'مجیب' ?></td>
            </tr>
            <?php
            $no = 1;
            foreach ($fatwa_data as $data) {
                $mustafti_data = $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row();
                $ifta_user_question = $this->db->get_where('ifta_user_question', array('question_id' => $data->questioner_id))->row();
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data->selsela_num ?></td>
                    <td><?= $data->fatwa_num ?></td>
                    <td><?= $mustafti_data->name ?></td>
                    <td><?= $mustafti_data->phone ?></td>
                    <td><?= $mustafti_data->email ?></td>
                    <td><?= $data->title ?></td>
                    <td><?= $this->db->get_where('ifta_books', array('book_id' => $data->book_id))->row()->name; ?></td>
                    <td><?= $this->db->get_where('ifta_books_chapters', array('chapter_id' => $data->chapter_id))->row()->name; ?></td>
                    <td><?= date('d/m/Y', strtotime($data->q_date)) ?></td>
                    <td><?= $data->question_type ?></td>
                    <td><?= $this->db->get_where('ifta_users', array('user_id' => $ifta_user_question->user_id))->row()->name; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>