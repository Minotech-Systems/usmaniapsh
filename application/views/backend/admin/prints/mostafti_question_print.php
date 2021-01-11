<html>
    <head>
        <title><?= 'دارالفتاء جامعہ عثمانیہ پشاور' ?></title>
        <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/nastaleeq/font.css">
    </head>
    <body style="font-family: Noto Nastaliq Urdu Draft">
        <?php
        foreach ($question_data as $data) {
            $questioner_data = $this->db->get_where('ifta_questioner', array('questioner_id' => $data->questioner_id))->row();
            ?>
            <table width="50%" dir="rtl"  style="line-height: 1; background-color: #ffeb3b69; padding: 10px; font-size: 12px; font-weight: bold;">
                <tr>
                    <td align="right"><?= 'رسید نمبر' . ' : ' . $data->question_no ?></td>
                    <td rowspan="3" align="center" ><img src="<?= base_url('uploads/raseed_head.png') ?>" width="150"></td>
                    <td rowspan="3" align="left"><img src="<?= base_url('uploads/logo.png') ?>" width="90"></td>
                </tr>
                <tr>
                    <td><?= 'فون نمبر' . ' : ' . '<span dir="ltr">091-5240422</span>' ?></td>
                </tr>
                <tr>
                    <td><?= 'رابطہ دارالافتاء' .' ..........................'?></td>
                </tr>
            </table>
            <table width="50%"  dir="rtl" style="background-color: #ffeb3b69; padding: 10px; font-size: 12px; font-weight: bold" >
                <tr>
                    <td width="70"><?= 'نام مستفتی' . ' : ' ?>&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom: dashed 1px;"><?= $questioner_data->name ?></td>
                    <td width="90"><?= 'رابطہ نمبر مستفتی' . ' : ' ?>&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-bottom: dashed 1px;"><?= $questioner_data->phone ?></td>
                </tr>
                <tr>
                    <td><?= 'مکمل پتہ' . ' : ' ?></td>
                    <td colspan="3" style="border-bottom: dashed 1px;"><?= $questioner_data->address ?></td>
                </tr>
                <tr>
                    <td><?= 'تاریخ آمد' . ' : ' ?></td>
                    <td style="border-bottom: dashed 1px;"><?= date('d-m-Y', strtotime($data->date_added)) ?></td>
                    <td><?= 'تاریخ واپسی' . ' : ' ?></td>
                    <td style="border-bottom: dashed 1px;"><?= date('d-m-Y', strtotime($data->m_solved_date)) ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="left"><?= 'دستخط نگران' . ' .......................' ?></td>
                </tr>
            </table>
        <?php } ?>
    </body>
</html>