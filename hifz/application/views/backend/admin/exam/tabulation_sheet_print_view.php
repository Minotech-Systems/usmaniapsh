<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">
        <style type="text/css">
            td {
                padding: 5px;
            }
            .btn-primary{background-color: black; color: white;}
            body{font-family: Noto Nastaliq Urdu Draft;}
            #numbers{ font-family: sans-serif !important; font-size: 15px !important}

            #jameel{font-family: jameelnoori; font-size: 17px;}
            h4{margin: 0px;}
        </style>
    </head>
    <body>
        <?php
        $branch_id = $this->session->userdata('branch_id');
        $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
        $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
        $class_id = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->class_id;
        $section = $this->db->get_where('section', array('class_id' => $class_id))->row()->name;
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $r_year = explode('-', $year);
        $sign = $this->db->get_where('exam_date', array('year' => $year, 'exam_id' => $exam_id))->row()->signature;
        $edu_year = $r_year[0] - 1412;
        ?>

        <table  dir="rtl" style="margin-right: 130px; font-size: 12px;" width="90%" align="center">
            <tr>
                <td colspan="2"  width="20%">
                    <img src="<?= base_url('uploads/header.png') ?>" width="200"/>
                </td>
                <td colspan="5" align="center" >
                    <h4><?= $system_name . ' ' . $class_name . '(' . $section . ')' ?></h4>
                    <hr style="border-top: 1px solid #000000; width: 50%">
                    <?= 'محترم جناب۔۔۔' . $this->crud_model->get_type_name_by_id('teacher', $teacher_id) ?>

                </td>
                <td>
                    <?= 'نتیجہ' . ' : &nbsp;&nbsp;&nbsp;' . $exam_name ?><br>
                    <?= get_phrase('session') . ' : <span dir="ltr">' . $year . '</span>' . '&nbsp;&nbsp;&nbsp;' . get_phrase('talimi_saal') . ' : ' . $edu_year ?>
                </td>
                <td colspan="3" align="left"><img src="uploads/logo.png" height="80"/></td>
                <td width='6.7%' style="border-left: 1px solid white; border-top: 1px solid white; border-bottom: 1px solid white; "></td>
            </tr>
        </table>
        <table  dir="rtl" style="border: 1px solid black; border-collapse: collapse; font-size: 11px; font-weight: bold; line-height: 1.2; margin-right: 130px" border="1" width="90%" align="center">
            <thead>
                <tr style="font-size:10px">
                    <td align='center' width='8%'><?php echo get_phrase('serial_no') ?></td>
                    <td align='center' width='8%'><?php echo get_phrase('exam_roll'); ?></td>
                    <td align='center' width='8%'><?php echo get_phrase('reg_no') ?></td>
                    <td align='center' width='13%' id="jameel"><?php echo get_phrase('students'); ?></td>
                    <td align='center' width='13%' id="jameel"><?php echo get_phrase('parent') ?></td>
                    <td align='center' width='8%'><?php echo get_phrase('obtained_marks'); ?></td>
                    <td align='center' width='8%'><?php echo get_phrase('total_marks'); ?></td>
                    <td align='center' width='6%'><?php echo get_phrase('percentage'); ?></td>
                    <td align='center' width='6%'><?php echo get_phrase('grade'); ?></td>
                    <td align='center' width='8%' style="border:1px solid black"><?php echo get_phrase('position'); ?></td>
                    <td width='6%' style="border: 1px solid white"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $students = $this->exam_model->get_students_signle_tabulation_sheet($teacher_id, $year);
                foreach ($students as $row) {
                    $percent = 0;
                    $marks_data = $this->db->get_where('mark_summery', array('student_id' => $row->student_id, 'exam_id' => $exam_id, 'year' => $year))->row();
                    ?>
                    <tr>
                        <td align='center' id="numbers"><?php echo $no ++; ?></td>
                        <td align='center' id="numbers"><?php echo $row->roll_no; ?></td>
                        <td align='center' id="numbers"><?php echo $row->reg_no ?></td>
                        <td align='center' id="jameel"><?php echo $row->name ?></td>
                        <td align='center' id="jameel"><?php echo $row->father_name ?></td>
                        <td align='center' id="numbers"><?php echo $marks_data->obt_marks ?></td>
                        <td align='center' id="numbers"><?php echo $marks_data->total_marks ?></td>
                        <td align='center' id="numbers"><?php echo $percent = $marks_data->percent ?></td>
                        <td align='center'>
                            <?php
                            $AdminC = & get_instance();
                            $grade = $AdminC->get_result_grade($percent);
                            $exam_status = $this->db->get_where('mark', array(
                                        'student_id' => $row->student_id,
                                        'exam_id' => $exam_id,
                                        'year' => $year
                                    ))->row()->status;
                            if ($exam_status == 0) {
                                echo 'غائب';
                            } elseif ($grade == 'راسب') {
                                echo '<span style="background-color:black; color:white; ">' . $grade . '</span>';
                            } else {
                                echo $grade;
                            }
                            ?>
                        </td>
                        <td align="center" style="border:1px solid black">
                            <?php
                            $posi = $marks_data->class_position;
                            $AdminP = & get_instance();
                            $position = $AdminP->get_position($posi);
                            if ($posi == 1 || $posi == 2 || $posi == 3) {
                                echo '<b>' . '<u style="color:#2196F3;">' . $posi . $position . '</u>' . '</b>';
                            } else {
                                echo $posi . $position;
                            }
                            ?>
                        </td>
                        <td style="border: 1px solid white">
                            <?php
                            if ($posi == 1) {
                                echo 'اول';
                            } elseif ($posi == 2) {
                                echo 'دوم';
                            } elseif ($posi == 3) {
                                echo 'سوم';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--.-->
        <table border="6" width="20%"  align='right' style="margin-right:100px; margin-top: 30px">
            <tr><td align='center'>مجموعی ریکارڈ</td></tr>
        </table>
        <table style="width:60%; border-collapse:collapse;border: 1px solid black; margin-top: 20px;" border="1" align='center' dir="rtl">
            <thead>
                <tr>
                    <td align="center"><?php echo get_phrase('کل تعداد') ?></td>
                    <td align="center">ممتاز</td>
                    <td align="center">جید جدا</td>
                    <td align="center">جید</td>
                    <td align="center">مقبول</td>
                    <td align="center"><?php echo get_phrase('absent') ?></td>
                    <td align="center"><?php echo get_phrase('fail') ?></td>
                    <td align="center"><?php echo get_phrase('Percentage') ?></td>
                </tr>
            </thead>
            <tbody style="font-weight:bold;">
                <tr>
                    <td align="center"><?php echo $all_students = $this->db->where(array('status' => 1, 'teacher_id' => $teacher_id, 'year' => $year))->from("enroll")->count_all_results(); ?></td>
                    <td align="center"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id', $exam_id)
                                ->where('year', $year)
                                ->where('percent >=', 80)
                                ->count_all_results();
                        ?></td>
                    <td align="center"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id', $exam_id)
                                ->where('year', $year)
                                ->where('percent >=', 70)
                                ->where('percent <=', 79.99)
                                ->count_all_results();
                        ?>
                    </td>
                    <td align="center"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id', $exam_id)
                                ->where('year', $year)
                                ->where('percent >=', 60)
                                ->where('percent <=', 69.99)
                                ->count_all_results();
                        ?>
                    </td>
                    <td align="center"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id', $exam_id)
                                ->where('year', $year)
                                ->where('percent >=', 50)
                                ->where('percent <=', 59.99)
                                ->count_all_results();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        echo $absent = $this->db
                        ->select('student_id')
                        ->distinct()
                        ->from('mark')
                        ->where('status', 0)
                        ->where('teacher_id', $teacher_id)
                        ->where('exam_id', $exam_id)
                        ->where('year', $year)
                        ->count_all_results();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        $fail_students = $this->db
                                ->select('*')
                                ->from('mark_summery')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id', $exam_id)
                                ->where('year', $year)
                                ->where('percent <=', 49.99)
                                ->count_all_results();
                        echo $all_fail = $fail_students - $absent;
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        $studentss = $all_students - $all_fail;
                        echo round($studentss * 100 / $all_students, 2) . '%';
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <!--.-->

        <table width="20%" align="left" style="margin-left:100px ; margin-top: 70px; text-align: center" dir="rtl">
            <?php if ($sign == 0) { ?>
                <tr>
                    <td style="border-top: 1px solid black"><?= 'امین ادارۃ التعلیمات' ?></td>
                </tr>
            <?php } else {
                ?>
                <tr>
                    <td><?= 'امین ادارۃ التعلیمات' ?>: &nbsp;&nbsp;<img src="<?= base_url('uploads/signs/sign2.png')?>" height="45"></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>



