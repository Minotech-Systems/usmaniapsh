<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">
        <style>
            @media print {
                * {-webkit-print-color-adjust:exact;}
                .pagebreak{page-break-after: always; display: block;}
                #print_in_print{display:  inline !important;}
            }
        </style>
    </head>
    <body style="font-family: Noto Nastaliq Urdu Draft;">
        <?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $years = explode('-', $running_year);
        $branch_name = $this->crud_model->get_branch_name($branch_id);
        if ($branch_id == 1) {
            $class = 'ب';
        } else {
            $class = 'الف';
        }
        ?>
        <?php
        if (!empty($value)) {
            if ($value == 'all') {
                $students = $this->crud_model->get_student_data($branch_id);
            } else if (is_numeric($value) && $value != '') {
                $students = $this->crud_model->get_student_teacher_data($value);
            }
            $total = count($students);
            ?>
            <?php
            $no = 1;
            $no1 = 1;
            $head = 0;

            foreach ($students as $std_data) {
                ?>
                <table width="100%" align="center" border="1" style="
                <?php
                for ($j = 2; $j < 200; $j++) {
                    $j = $j + 2;
                    if ($j == $no1 || $no1 == 1) {
                        echo 'margin-top:40px;';
                    }
                }
                ?> font-weight: bold; border-collapse: collapse; color: black; text-align: center; line-height: 1.7; font-size: 10px; border: 1px solid black" dir="rtl">
                       <?php if ($head % 3 == 0) { ?>
                        <thead>
                            <tr style="border-top: 1px solid white;border-right: 1px solid white;border-left: 1px solid white;">
                                <td colspan="26">
                                    <h3 style="font-size:14px;">
                                        <?=
                                        'ماہانہ مقدار خواندگی وتعلیمی کیفیت شعبہ حفظ کلاس' . '&nbsp;&nbsp;&nbsp;' . '(' . $class . ')' . '&nbsp;&nbsp;&nbsp;'
                                        . 'تعلیمی سال  نمبر' . ' : ' . '&nbsp;&nbsp;&nbsp;' . $talimi_saal . '&nbsp;&nbsp;&nbsp;' . ' ازشوال' . '&nbsp;&nbsp;&nbsp;' .
                                        $years[0] . '&nbsp;&nbsp;&nbsp;' . 'تا رجب' . '&nbsp;&nbsp;&nbsp;' . $years[1] . '&nbsp;&nbsp;&nbsp;' . '<span dir="ltr">' . $branch_name . '</span>'
                                        ?>
                                    </h3>
                                </td>
                            </tr>
                            <tr style="line-height: 1.5">
                                <td width="2%"><?= get_phrase('serial_no') ?></td>
                                <td width="3%"><?= get_phrase('student_names') ?></td>
                                <?php foreach ($exams_s as $exam) { ?>
                                    <td  colspan="6"><?= $this->db->get_where('exam', array('exam_id' => $exam))->row()->name ?> &nbsp;&nbsp; <?= 'بتاریخ' . '_______________' ?></td>
                                <?php } ?>
                            </tr>
                        </thead>
                    <?php } ?>
                    <tbody style="font-size:9px">

                        <tr style="height:25px">
                            <td rowspan="7"  width="3%" style="<?php
                            if ($no1 % 3 != 0) {
                                echo 'border-bottom:1px solid white';
                            }
                            ?>"><?= $no++ ?></td>
                            <td rowspan="7" width="4%" style="<?php
                            if ($no1 % 3 != 0) {
                                echo 'border-bottom:1px solid white';
                            }
                            ?>"><?= $std_data->name . '<br>' . 'بن' . '<br>' . $std_data->father_name ?></td>
                                <?php foreach ($exams_s as $exam) { ?>
                                <td><?= 'خواندگی' ?></td>
                                <td colspan="5"></td>
                            <?php } ?>
                        </tr>
                        <tr style="height:25px">
                            <?php foreach ($exams_s as $exam) { ?>
                                <td width="3.8%" height="30"><?= 'سوالات' ?></td>
                                <td width="3.8%" align="right"><span>س</span><br><span>ت</span></td>
                                <td width="3.8%" align="right"><span>س</span><br><span>ت</span></td>
                                <td width="3.8%" align="right"><span>س</span><br><span>ت</span></td>
                                <td width="3.8%"><?= 'اداء' ?></td>
                                <td width="3.8%"><?= 'دینیات' ?></td>
                            <?php } ?>
                        </tr>
                        <tr style="height:25px">
                            <?php foreach ($exams_s as $exam) { ?>
                                <td><?= 'خطاء' ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td rowspan="3"></td>
                                <td></td>
                            <?php } ?>
                        </tr>

                        <tr style="height:25px">
                            <?php foreach ($exams_s as $exam) { ?>
                                <td><?= 'شک' ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?= 'کل نمبرات' ?></td>
                            <?php } ?>
                        </tr>
                        <tr style="height:25px">
                            <?php foreach ($exams_s as $exam) { ?>
                                <td><?= 'تجوید' ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr style="height:25px">
                            <?php foreach ($exams_s as $exam) { ?>
                                <td style="font-size: 9px"><?= 'مہینےکا کل سبق' ?></td>
                                <td colspan="2"></td>
                                <td><?= 'مرحلہ' ?></td>
                                <td colspan="2"></td>
                            <?php } ?>
                        </tr>
                        <tr style=" height: 25px; <?php
                        if ($no1 % 3 != 0) {
                            echo 'border-bottom:1px solid white';
                        }
                        ?>">
                                <?php foreach ($exams_s as $exam) { ?>
                                <td><?= 'کیفیت' ?></td>
                                <td colspan="5"></td>
                            <?php } ?>
                        </tr>
                        <?php if ($no1 % 3 == 0) { ?>
                            <tr style=" height: 65px; vertical-align: bottom; border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid white;">
                                <td colspan="26" align="center">
                                    <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                                    <span style="margin-left: 50px"><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                                    <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                                    <span style="margin-left: 50px"><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                                    <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                                    <span style="margin-left: 50px"><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                                    <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                                    <span><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                                    <br>
                                    <h6  style="font-size: 12px; margin: 0px;"><?= 'بلاحظہ' . ' : ' . 'منزل کے کل نمبرات ' . ' ' . '45،' . ' ' . 'اداء' . ' : ' . '5،' . ' ' . 'دینیات' . ' : ' . '10' . ' ' . 'کل' . ' : ' . '60' ?></h6>

                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

                <?php
                $head++;

                if ($no1 % 3 == 0) {
                    echo '<span class="pagebreak"></span>';
                }
                $no1++;
            }
            ?>

            <?php if ($total % 3 != 0) { ?>
                <hr style="    color: black;display: block;height: 1px;border: 0;border-top: 1px solid #000; margin: 1em 0;padding: 0;margin-top: 0px;">
                <table width="100%" align="center" style="text-align:center;  font-weight: bold; margin-top: 10px; font-size: 9px; color: black" id="print_in_print">
                    <tr  style="  height: 65px; vertical-align: bottom; border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid white;">
                        <td colspan="26" align="center">
                            <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                            <span style="margin-left: 50px"><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                            <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                            <span style="margin-left: 50px"><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                            <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                            <span style="margin-left: 50px"><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                            <span><?= 'دستخط ممتحن۔۔۔۔۔۔۔۔۔۔۔' ?></span>
                            <span><?= 'دستخط مسئول۔۔۔۔۔۔۔۔۔۔۔' ?></span>

                            <br>
                            <h6  style="font-size: 12px; margin: 0px;"><?= 'بلاحظہ' . ' : ' . 'منزل کے کل نمبرات ' . ' ' . '45،' . ' ' . 'اداء' . ' : ' . '5،' . ' ' . 'دینیات' . ' : ' . '10' . ' ' . 'کل' . ' : ' . '60' ?></h6>

                        </td>
                    </tr>
                </table>

                <?php
            }
        }
        ?>
    </body>
</html>