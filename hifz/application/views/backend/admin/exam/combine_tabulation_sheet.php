<hr />
<div class="row">
    <div class="col-md-12 ">
        <?php echo form_open(base_url() . 'index.php?exam/combine_tabulation_sheet/create'); ?>
        <div class="col-md-3 col-md-offset-1 ">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('teacher'); ?></label>
                <select name="teacher_id" class="form-control ">
                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                    <?php
                    $teachers = $this->db->get_where('teacher',array('branch_id'=>$branch_id))->result();
                    foreach ($teachers as $row1) {
                        ?>
                        <option value="<?php echo $row1->teacher_id ?>" ><?php echo $row1->name; ?></option>

                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('exam'); ?></label>
                <select name="exam_id[]" class="form-control select2" multiple="">
                    <?php
                    $exams = $this->db->get('exam')->result_array();
                    foreach ($exams as $row):
                        ?>
                        <option value="<?php echo $row['exam_id']; ?>"><?php echo $row['name']; ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('session'); ?></label>
                <select name="year" class="form-control" required="">		  	
                    <?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>		  	
                    <option value=""><?php echo get_phrase('select_running_session'); ?></option>		  	
                    <?php for ($i = 0; $i < 30; $i++): ?>		      	
                        <option value="<?php echo (1437 + $i); ?>-<?php echo (1437 + $i + 1); ?>"		        
                                <?php if ($running_year == (1437 + $i) . '-' . (1437 + $i + 1)) echo 'selected'; ?>>		          	
                            <?php echo (1437 + $i); ?>-<?php echo (1437 + $i + 1); ?>		      	
                        </option>		  
                    <?php endfor; ?>		
                </select>
            </div>
        </div>
        <div class="col-md-2" style="margin-top: 20px;">
            <button type="submit" class="btn btn-info"><?php echo get_phrase('create'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if ($teacher_id != '' && $exams != ''): ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-cyan">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #fff;">
                    <?php
                    $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id4))->row()->name;
                    echo get_phrase('tabulation_sheet');
                    ?>
                </h3>
                <h4 style="color: #fff;">
                    <?php echo get_phrase('exam') ?> : <?php echo $exam_name; ?>
                </h4>
                <h4 style="color: #fff;">
                    <?php echo 'محترم جناب۔۔۔' ?> : <?php echo $this->crud_model->get_type_name_by_id('teacher',$teacher_id); ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <style>
        .table-bordered > thead > tr > td{ font-size: 12px;}
    </style>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr style="font-size: 12px">
                        <td><?php echo get_phrase('serial_no'); ?></td>
                        <td align='center'><?php echo get_phrase('exam_roll'); ?></td>
                        <td align='center'><?php echo get_phrase('reg_no') ?></td>
                        <td align='center'><?php echo get_phrase('students'); ?></td>
                        <td align='center'><?php echo get_phrase('parent'); ?></td>
                        <td align='center'><?php echo $this->exam_model->get_exam_name_by_id($exam_id1); ?></td>
                        <td align='center'><?php echo $this->exam_model->get_exam_name_by_id($exam_id2); ?></td>
                        <td align='center'><?php echo $this->exam_model->get_exam_name_by_id($exam_id3); ?></td>
                        <td align='center'><?php echo $exam_name ?></td>
                        <td align='center'><?php echo get_phrase('marks_obtained'); ?></td>
                        <td align='center'><?php echo get_phrase('total_marks'); ?></td>
                        <td align='center'><?php echo get_phrase('percentage'); ?></td>
                        <td align='center'><?php echo get_phrase('grade'); ?></td>
                        <td align='center'><?php echo get_phrase('position'); ?></td>
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
                            <td align='center'><?php echo $data->name ?></td>
                            <td align='center'><?php echo $data->father_name ?></td>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo get_phrase('total') ?></th>
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
                        <td align="center"><?php
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
        </div>
    </div>


    <!--.-->
    <center>
        <span class="pull-center">
            <a href="<?php echo base_url(); ?>index.php?exam/combine_tabulation_sheet_print/"
               class="btn btn-default btn-icon icon-left hidden-print " target="_blank" style="background-color:#21a9e1; color:white;">
                پرنٹ نتیجہ رزلٹ
                <i class="entypo-print" style="background-color: #0a85b7;"></i>
            </a>
        </span>
    </center>
<?php endif; ?>