
<hr />
<div class="row">
    <div class="col-md-12">
        <?php echo form_open(base_url() . 'index.php?exam/single_tabulation_sheet/create'); ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('teacher'); ?></label>
                <select name="teacher_id" class="form-control" required="">
                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                    <?php
                    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
                    foreach ($teachers as $row) {
                        ?>
                        <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('exam'); ?></label>
                <select name="exam_id" class="form-control" required="">
                    <option value=""><?php echo get_phrase('select_exam'); ?></option>
                    <?php
                    $exams = $this->db->get('exam')->result();
                    foreach ($exams as $row1) {
                        ?>
                        <option value="<?php echo $row1->exam_id; ?>"><?php echo $row1->name; ?></option>

                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo get_phrase('session'); ?></label>
                <select name="session" class="form-control" required="">		  	
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
        <div class="col-md-3" style="margin-top: 20px;">
            <button type="submit" class="btn btn-info"><?php echo get_phrase('view_tabulation_sheet'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php
if ($teacher_id != '' && $year != '' && $exam_id != ''):
    $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
    $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
    $class_id = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->class_id;
    $section = $this->db->get_where('section', array('class_id' => $class_id))->row()->name;
    $r_year = explode('-', $year);
        $edu_year = $r_year[0] - 1412;
    ?>
    <br>
    <style>
        .table-bordered > thead > tr > td{font-size: 12px !important}
    </style>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <td colspan="5" align="center" style="border-left: 1px solid #f5f5f6">
                            <h4><?= $system_name . ' ' . $class_name . '(' . $section . ')' ?></h4>
                            <hr style="border-top: 1px solid #000000; width: 50%">
                            <?= 'محترم جناب۔۔۔' . $this->crud_model->get_type_name_by_id('teacher', $teacher_id) ?>
                        </td>
                        <td colspan="2" style="border-left: 1px solid #f5f5f6;">
                            <?= 'نتیجہ' . ' : &nbsp;&nbsp;&nbsp;' . $exam_name ?><br>
                            <?= get_phrase('session') . ' : <span dir="ltr">' . $year . '</span>' . '&nbsp;&nbsp;&nbsp;' . get_phrase('talimi_saal') . ' : ' . $edu_year ?>
                        </td>
                        <td colspan="3" align="left"><img src="uploads/logo.png" height="80"/></td>
                    </tr>
                    <tr>
                        <td align='center' width='8%'><?php echo get_phrase('serial_no') ?></td>
                        <td align='center' width='8%'><?php echo get_phrase('exam_roll'); ?></td>
                        <td align='center' width='8%'><?php echo get_phrase('reg_no') ?></td>
                        <td align='center' width='13%'><?php echo get_phrase('students'); ?></td>
                        <td align='center' width='13%'><?php echo get_phrase('parent') ?></td>
                        <td align='center' width='8%'><?php echo get_phrase('obtained_marks'); ?></td>
                        <td align='center' width='8%'><?php echo get_phrase('total_marks'); ?></td>
                        <td align='center' width='6%'><?php echo get_phrase('percentage'); ?></td>
                        <td align='center' width='6%'><?php echo get_phrase('grade'); ?></td>
                        <td align='center' width='8%'><?php echo get_phrase('position'); ?></td>
                        <td width='6%' style="border: 1px solid #f5f5f6"></td>
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
                            <td align='center'><?php echo $no ++; ?></td>
                            <td align='center'><?php echo $row->roll_no; ?></td>
                            <td align='center'><?php echo $row->reg_no ?></td>
                            <td align='center'><?php echo $row->name ?></td>
                            <td align='center'><?php echo $row->father_name ?></td>
                            <td align='center'><?php echo $marks_data->obt_marks ?></td>
                            <td align='center'><?php echo $marks_data->total_marks ?></td>
                            <td align='center'><?php echo $percent = $marks_data->percent ?></td>
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
                            <td align="center">
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
                            <td style="border: 1px solid #f5f5f6"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <table border="6" width="20%"  align='right' style="margin-right:55px; line-height: 3">
                <tr><td align='center'>مجموعی ریکارڈ</td></tr>
            </table>
            <table style="width:60%; border-collapse:collapse;border: 1px solid black; margin-top: 10px; line-height: 2" border="1" align='center' dir="rtl">
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
        </div>
    </div>
    <center>
        <a href="<?php echo base_url(); ?>index.php?exam/tabulation_sheet_print_view/" 
           class="btn btn-primary" target="_blank">
            <?php echo get_phrase('print_tabulation_sheet'); ?>
        </a>
    </center>
<?php endif; ?>

<script type="text/javascript">

    function select_section(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admission/get_sections/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder').html(response);
                }
            });
        }
    }
</script>