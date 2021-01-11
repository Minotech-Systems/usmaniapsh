<html>
    <head>
        <title><?= 'ماہانہ رپرٹ' ?></title>
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
        <style>
            body{ 
                font-family: 'Noto Nastaliq Urdu Draft';
                border: 2px solid;
                padding: 10px;
                border-style: dotted;
                border-radius: 10px;}
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                .pagebreak{page-break-after: always;display: block;}
            }   
        </style>
    </head>
    <body>
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $student_data = $this->crud_model->get_student_teacher_data($teacher_id);
//        $student_data = $this->db->get_where('student', array('student_id' => $student_id))->row();
        $month_name = $this->crud_model->get_georg_month($month);
        $teacher_data = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
        $year = date('Y');
        $count_firday = 0;
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 1; $i <= $days; $i++) {
            $timestamp = ($year . '-' . $month . '-' . $i);
            $get_name = date('l', strtotime($timestamp)); //get week day
            $day_name = substr($get_name, 0, 3);
            if ($day_name == 'Fri') {
                $count_firday++;
            }
        }
        ?>
        <?php
        foreach ($student_data as $std_data) {
            $student_id = $std_data->student_id;
            ?>
            <table width="90%" align="center" dir="rtl" >
                <tr>
                    <td colspan="4" align="center">
                        <h4 style="margin:0px;"><?= 'ماہانہ رپورٹ شعبہ حفظ القران الکریم  جامعہ عثمانیہ پشاور' . '&nbsp;&nbsp;&nbsp;' . 'تعلیمی سال نمبر' . ' : ' . $talimi_saal ?></h4>
                    </td>
                </tr>
                <tr style="font-size:12px;">
                    <td><?= 'نام طالب علم' . ' : ' . $std_data->name ?></td>
                    <td><?= get_phrase('parent') . ' : ' . $std_data->father_name ?></td>
                    <td><?= 'فریق' . ':' . '_______________' ?></td>
                    <td><?= get_phrase('teacher') . ' : ' . $teacher_data->name ?></td>
                </tr>
                <tr style="font-size:12px;">
                    <td><?= 'پارہ' . ':' . '_______________' ?></td>
                    <td><?= 'سورہ' . ':' . '_______________' ?></td>
                    <td><?= 'بابت ماہ' . ' : ' . $month_name ?></td>
                    <td><?= 'سال' . ' : ' . $running_year ?></td>
                </tr>
            </table>
            <!--.-->
            <table width="100%" align="center" dir="rtl" border="1" style="border:1px solid black; border-collapse: collapse; text-align: center; font-size: 10px;line-height: 3">

                <tr>
                    <td width="60"><?= 'مادہ' ?></td>
                    <?php for ($i = 1; $i <= 8; $i++) { ?>
                        <td width="11.5%"><?= $i ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="height:90px"><?= ' سبق' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                        ?>
                        <td><?= $leason_a ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبق' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                        ?>
                        <td><?= $leason_a_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                        ?>
                        <td><?= $leason_a_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' سبقی' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                        ?>
                        <td><?= $leason_b ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبقی' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                        ?>
                        <td><?= $leason_b_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                        ?>
                        <td><?= $leason_b_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' منزل' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                        ?>
                        <td><?= $leason_c ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار منزل' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                        ?>
                        <td><?= $leason_c_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                        ?>
                        <td><?= $leason_c_state ?></td>
                    <?php } ?>
                </tr>
            </table>
            <!--.-->
            <table width="100%" align="center" dir="rtl" border="1" style="border:1px solid black; margin-top: 10px; border-collapse: collapse; text-align: center; font-size: 10px;line-height: 3">

                <tr>
                    <td width="60"><?= 'مادہ' ?></td>
                    <?php for ($i = 9; $i <= 16; $i++) { ?>
                        <td width="11.5%"><?= $i ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="height:90px;"><?= ' سبق' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                        ?>
                        <td><?= $leason_a ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبق' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                        ?>
                        <td><?= $leason_a_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                        ?>
                        <td><?= $leason_a_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' سبقی' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                        ?>
                        <td><?= $leason_b ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبقی' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                        ?>
                        <td><?= $leason_b_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                        ?>
                        <td><?= $leason_b_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' منزل' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                        ?>
                        <td><?= $leason_c ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار منزل' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                        ?>
                        <td><?= $leason_c_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 9; $i <= 16; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                        ?>
                        <td><?= $leason_c_state ?></td>
                    <?php } ?>
                </tr>
            </table>
            <!--.-->

            <?php echo'<span class="pagebreak"></span>' ?>
            <table width="100%" align="center" border="1" dir="rtl" style="border:1px solid black; margin-top: 10px; border-collapse: collapse; text-align: center; font-size: 10px;line-height: 3">

                <tr>
                    <td width="60"><?= 'مادہ' ?></td>
                    <?php for ($i = 17; $i <= 24; $i++) { ?>
                        <td width="11.5%"><?= $i ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="height:90px;"><?= ' سبق' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                        ?>
                        <td><?= $leason_a ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبق' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                        ?>
                        <td><?= $leason_a_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                        ?>
                        <td><?= $leason_a_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' سبقی' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                        ?>
                        <td><?= $leason_b ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبقی' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                        ?>
                        <td><?= $leason_b_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                        ?>
                        <td><?= $leason_b_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' منزل' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                        ?>
                        <td><?= $leason_c ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار منزل' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                        ?>
                        <td><?= $leason_c_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 17; $i <= 24; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                        ?>
                        <td><?= $leason_c_state ?></td>
                    <?php } ?>
                </tr>
            </table>
            <!--.-->
            <table width="100%" align="center" border="1" dir="rtl" style="border:1px solid black; margin-top: 10px; border-collapse: collapse; text-align: center; font-size: 10px;line-height: 3">

                <tr>
                    <td width="60"><?= 'مادہ' ?></td>
                    <?php for ($i = 25; $i <= 31; $i++) { ?>
                        <td width="11.5%"><?= $i ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="height:90px;"><?= ' سبق' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                        ?>
                        <td><?= $leason_a ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبق' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                        ?>
                        <td><?= $leason_a_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                        ?>
                        <td><?= $leason_a_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' سبقی' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                        ?>
                        <td><?= $leason_b ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار سبقی' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                        ?>
                        <td><?= $leason_b_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                        ?>
                        <td><?= $leason_b_state ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= ' منزل' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                        ?>
                        <td><?= $leason_c ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'مقدار منزل' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                        ?>
                        <td><?= $leason_c_quantity ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><?= 'کیفیت' ?></td>
                    <?php
                    for ($i = 25; $i <= 31; $i++) {
                        $timestamp = ($year . '-' . $month . '-' . $i);
                        $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                        ?>
                        <td><?= $leason_c_state ?></td>
                    <?php } ?>
                </tr>
            </table>
            <table width="100%" align="center" border="1" dir="rtl" style="border:1px solid black; margin-top: 10px; border-collapse: collapse; text-align: center; font-size: 10px;line-height: 2">
                <tr>
                    <td colspan="12" align="center">
                        <?= 'ہم نصابی سرگرمیاں  اور  غیرہم نصابی سرگرمیاں' ?>
                    </td>
                </tr>
                <tr>
                    <td><?= 'ایام' ?></td>
                    <td><?= 'حاضری' ?></td>
                    <td><?= 'رخصت' ?></td>
                    <td><?= 'غیرحاضری' ?></td>
                    <td><?= 'شب ہفتہ حاضری' ?></td>
                    <td><?= 'جمعہ' ?></td>
                    <td><?= 'صفائی کا معیار' ?></td>
                    <td><?= 'وقت کی پابندی' ?></td>
                    <td><?= 'کلاس میں رویہ' ?></td>
                    <td><?= 'سبق کا ناغہ' ?></td>
                    <td><?= 'سبقی کا ناغہ' ?></td>
                    <td><?= 'منزل کا ناغہ' ?></td>
                </tr>
                <tr>
                    <td><?= $total_month_days = $days - $count_firday ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= $count_firday ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $this->crud_model->count_daily_report_absenty($student_id, $month, 'lesson_a'); ?></td>
                    <td><?php echo $this->crud_model->count_daily_report_absenty($student_id, $month, 'lesson_b'); ?></td>
                    <td><?php echo $this->crud_model->count_daily_report_absenty($student_id, $month, 'lesson_c'); ?></td>
                </tr>
                <tr style="height:40px; vertical-align: bottom">
                    <td colspan="12">
                        <?= 'گزشتہ ماہ میں حفظ کئے گئے پاروں کی تعداد' . '&nbsp;&nbsp;&nbsp;' . 'پارہ۔۔۔۔۔۔۔۔۔۔تا۔۔۔۔۔۔۔' . '&nbsp;&nbsp;&nbsp;' . 'کیفیت۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔' ?>
                        <?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔۔' ?>
                    </td>
                </tr>
            </table>
        <?php echo'<span class="pagebreak"></span>' ; } ?>
    </body>
</html>