<div class="row">
    <form action="<?= base_url('index.php?admin/monthly_syllabus/create') ?>" method="post">
        <div class="col-sm-3 col-md-offset-2" style="padding: 30px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <select name="exam_id[]" class="form-control select2" multiple="" data-placeholder="<?= 'امتحان منتخب کریں' ?>" id="exams">
                        <?php
                        $exams = $this->db->get('exam')->result();

                        foreach ($exams as $exam):
                            ?>

                            <option value="<?php echo $exam->exam_id; ?>"><?php echo $exam->name; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-3 " style="padding: 30px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <select name="select_type" class="form-control" >
                        <option value=""><?= get_phrase('select') ?></option>
                        <option value="all" ><?php echo get_phrase('all_students'); ?></option>
                        <?php
                        $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();

                        foreach ($teachers as $row):
                            ?>

                            <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success" style="margin-top: 30px"><?= get_phrase('submit') ?></button>
        </div>
    </form>
</div>
<?php
if (!empty($value)) {
    if ($value == 'all') {
        $students = $this->crud_model->get_student_data($branch_id);
    } else if (is_numeric($value) && $value != '') {
        $students = $this->crud_model->get_student_teacher_data($value);
    }
    ?>
    <div class="row">
        <div class="col-md-12" >
            <center>
                <a class="btn btn-success" target="blank" href="<?= base_url('index.php?admin/monthly_syllabus_print') ?>">
                    <i class="fa fa-print"></i>
                    <?= get_phrase('print_data') ?>
                </a>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table width="95%" align="center" border="1" style="margin-top: 20px; border-collapse: collapse; color: black; text-align: center; line-height: 2; font-size: 10px" dir="rtl">
                <tr style="line-height: 3">
                    <td><?= get_phrase('serial_no') ?></td>
                    <td><?= get_phrase('student_names') ?></td>
                    <?php foreach ($exams_s as $exam) { ?>
                        <td  colspan="6"><?= $this->db->get_where('exam', array('exam_id' => $exam))->row()->name ?> &nbsp;&nbsp; <?= 'بتاریخ' . '_______________' ?></td>
                    <?php } ?>
                </tr>
                <?php
                $no = 1;
                foreach ($students as $std_data) {
                    ?>
                    <tr>
                        <td rowspan="7" style="border-bottom: 2px solid"><?= $no++ ?></td>
                        <td rowspan="7" style="border-bottom: 2px solid"><?= $std_data->name ?></td>
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'خواندگی' ?></td>
                            <td colspan="5"></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'سوالات' ?></td>
                            <td><?= 'س ت' ?></td>
                            <td><?= 'س ت' ?></td>
                            <td><?= 'س ت' ?></td>
                            <td><?= 'اداء' ?></td>
                            <td><?= 'دینیات' ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'خطاء' ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td rowspan="3"></td>
                            <td></td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'شک' ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?= 'کل نمبرات' ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'تجوید' ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'مہینےکا کل سبق' ?></td>
                            <td colspan="2"></td>
                            <td><?= 'مرحلہ' ?></td>
                            <td colspan="2"></td>
                        <?php } ?>
                    </tr>
                    <tr style="border-bottom: 2px solid black">
                        <?php foreach ($exams_s as $exam) { ?>
                            <td><?= 'کیفیت' ?></td>
                            <td colspan="5"></td>
                        <?php } ?>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>
<?php } ?>