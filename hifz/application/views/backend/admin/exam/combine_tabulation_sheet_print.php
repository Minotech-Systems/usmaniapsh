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
        $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id4))->row()->name;
        $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
        $class_id = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->class_id;
        $section = $this->db->get_where('section', array('class_id' => $class_id))->row()->name;
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $sign = $this->db->get_where('exam_date', array('year' => $year, 'exam_id' => $exam_id4))->row()->signature;
        $r_year = explode('-', $year);
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
        <table width="95%" style="border:1px solid black; border-collapse: collapse; text-align: center; line-height: 1.3; font-size: 12px; font-weight: bold;" border="1" dir="rtl">
            <thead>
                <tr style="font-size: 10px">
                    <td><?php echo get_phrase('serial_no'); ?></td>
                    <td align='center'><?php echo get_phrase('exam_roll'); ?></td>
                    <td align='center'><?php echo get_phrase('reg_no') ?></td>
                    <td align='center'><?php echo get_phrase('students'); ?></td>
                    <td align='center'><?php echo get_phrase('parent'); ?></td>
                    <td align='center' width="7%"><?php echo $this->exam_model->get_exam_name_by_id($exam_id1); ?></td>
                    <td align='center' width="7%"><?php echo $this->exam_model->get_exam_name_by_id($exam_id2); ?></td>
                    <td align='center' width="7%"><?php echo $this->exam_model->get_exam_name_by_id($exam_id3); ?></td>
                    <td align='center' width="7%"><?php echo $exam_name ?></td>
                    <td align='center' width="7%"><?php echo get_phrase('marks_obtained'); ?></td>
                    <td align='center'><?php echo get_phrase('total_marks'); ?></td>
                    <td align='center'><?php echo get_phrase('percentage'); ?></td>
                    <td align='center'><?php echo get_phrase('grade'); ?></td>
                    <td align='center'><?php echo get_phrase('position'); ?></td>
                    <td style="border-left: 1px solid white; border-bottom:1px solid white; border-top:1px solid white;"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $students = $this->exam_model->get_students_signle_tabulation_sheet($teacher_id, $year);
                foreach ($students as $data) {
                    $percent = 0;
                    $marks_data = $this->db->get_where('mark_summery', array('student_id' => $data->student_id, 'exam_id' => $exam_id4, 'year' => $year))->row();
                    $marks_total_summmary = $this->db->get_where('mark_summery_total', array('student_id' => $data->student_id, 'exam_id_4' => $exam_id4, 'year' => $year))->row();
                    ?>
                    <tr>
                        <td align='center'><?= $no++ ?></td>
                        <td align='center'><?php echo $data->roll_no; ?></td>
                        <td align='center'><?php echo $data->reg_no ?></td>
                        <td align='center' id="jameel"><?php echo $data->name ?></td>
                        <td align='center' id="jameel"><?php echo $data->father_name ?></td>
                        <td align='center'>
                            <?php
                            echo $test1 = $this->db->get_where('mark_summery', array(
                                'teacher_id' => $teacher_id,
                                'exam_id' => $exam_id1,
                                'student_id' => $data->student_id,
                                'year' => $year
                            ))->row()->obt_marks;
                            ?>
                        </td>
                        <td align='center'>
                            <?php
                            echo $test2 = $this->db->get_where('mark_summery', array(
                                'teacher_id' => $teacher_id,
                                'exam_id' => $exam_id2,
                                'student_id' => $data->student_id,
                                'year' => $year
                            ))->row()->obt_marks;
                            ?>
                        </td>
                        <td align='center'>
                            <?php
                            echo $test3 = $this->db->get_where('mark_summery', array(
                                'teacher_id' => $teacher_id,
                                'exam_id' => $exam_id3,
                                'student_id' => $data->student_id,
                                'year' => $year
                            ))->row()->obt_marks;
                            ?>
                        </td>
                        <td align='center'><?php echo $marks_data->obt_marks ?></td>
                        <td align='center'><?= $total_obt_marks = $marks_data->obt_marks + $test1 + $test2 + $test3 ?></td>
                        <td align="center"><?= $marks_total_summmary->total_marks ?></td>
                        <td align='center'><?= $percnt = $marks_total_summmary->percent ?></td>
                        <td align='center'>
                            <?php
                            $exam_status = $this->db->get_where('mark', array(
                                        'student_id' => $data->student_id,
                                        'exam_id' => $exam_id4
                                    ))->row()->status;
                            $AdminC = & get_instance();
                            $grade = $AdminC->get_result_grade($percnt);
                            if ($exam_status == 0) {
                                echo 'غائب';
                            } elseif ($grade == 'راسب') {
                                echo '<span style="background-color:black; color:white; ">' . $grade . '</span>';
                            } else {
                                echo $grade;
                            }
                            ?>
                        </td>
                        <td align='center'>
                            <?php
                            $posi = $marks_total_summmary->position;
                            $AdminP = & get_instance();
                            $position = $AdminP->get_position($posi);
                            if ($posi == 1 || $posi == 2 || $posi == 3) {
                                echo '<b>' . '<u style="color:#2196F3;">' . $posi . $position . '</u>' . '</b>';
                            } else {
                                echo $posi . $position;
                            }
                            ?>
                        </td>
                        <td style="border-left: 1px solid white; border-bottom:1px solid white;">
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
        <table border="6" width="20%"  align='right' style="margin-right:55px; margin-top: 20px">
            <tr><td align='center'>مجموعی ریکارڈ</td></tr>
        </table>
        <table style="width:60%; font-family: jameelnoori; border-collapse:collapse;border: 1px solid black; margin-top: 10px; margin-top: 20px;" border="1" align='center' dir="rtl">
            <thead>
                <tr>
                    <th><?php echo 'کل تعداد' ?></th>
                    <th>ممتاز</th>
                    <th>جید جدا</th>
                    <th>جید</th>
                    <th>مقبول</th>
                    <th><?php echo get_phrase('absent') ?></th>
                    <th><?php echo get_phrase('fail') ?></th>
                    <th><?php echo get_phrase('Percentage'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center"><?php echo $all_students = $this->db->where(array('status' => 1, 'teacher_id' => $teacher_id, 'year' => $year))->from("enroll")->count_all_results(); ?></td>
                    <td style="text-align: center;"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery_total')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id_4', $exam_id4)
                                ->where('year', $year)
                                ->where('percent >=', 80)
                                ->count_all_results();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery_total')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id_4', $exam_id4)
                                ->where('year', $year)
                                ->where('percent >=', 70)
                                ->where('percent <=', 79.99)
                                ->count_all_results();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery_total')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id_4', $exam_id4)
                                ->where('year', $year)
                                ->where('percent >=', 60)
                                ->where('percent <=', 69.99)
                                ->count_all_results();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        echo $this->db
                                ->select('*')
                                ->from('mark_summery_total')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id_4', $exam_id4)
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
                        ->where('exam_id', $exam_id4)
                        ->where('year', $year)
                        ->count_all_results();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        $fail_students = $this->db
                                ->select('*')
                                ->from('mark_summery_total')
                                ->where('teacher_id', $teacher_id)
                                ->where('exam_id_4', $exam_id4)
                                ->where('year', $year)
                                ->where('percent <=', 49.99)
                                ->count_all_results();
                        echo $all_fail_students = $fail_students - $absent;
                        ?>
                    </td>
                    <td style="text-align: center;"><?php
                        $studentss = $all_students - $all_fail_students;
                        echo round($studentss * 100 / $all_students, 2) . '%';
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
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
        <!--<div class="col-md-8" style="text-align: left; font-family: jameelnoori; margin-left: 150px; margin-top: 35px; "><?php echo '____________' . get_phrase('sign_educator') ?></div>-->
    </body>
</html>