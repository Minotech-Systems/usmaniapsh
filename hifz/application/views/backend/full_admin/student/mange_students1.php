<div class="row">
    <form method="post" action="<?= base_url('index.php?admin/manage_students/manage')?>">
        <div class="col-md-3 col-sm-3 col-md-offset-2">
            <div class="form-group">
                <label class="control-label" ><?php echo get_phrase('students'); ?></label>
                <select name="student_id[]" class="form-control select2" multiple dir="rtl" >
                    <?php
                    $students = $this->crud_model->get_unrranged_students($this->session->userdata('branch_id'));
                    foreach ($students as $stud):
                        ?>
                        <option value="<?php echo $stud->student_id; ?>"><?php echo $stud->name . ' / ' . $stud->father_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 ">
            <div class="form-group">
                <label class="control-label" ><?php echo get_phrase('teacher'); ?></label>
                <select name="teacher_id" class="form-control" dir="rtl" >
                     <option value=""><?= get_phrase('select_teacher')?></option>
                    <?php
                    $teachers = $this->crud_model->get_table_data_where('teacher',array('status'=>1));
                    foreach ($teachers as $tech):
                        ?>
                        <option value="<?php echo $tech->teacher_id; ?>"><?php echo $tech->name;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 ">
            <div class="form-group">
                <button class="btn btn-success" style="margin-top: 20px;"><?= get_phrase('submit')?></button>
            </div>
        </div>
    </form>
</div>
<br>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <table class="table table" style="text-align: center; margin-top: 20px;">
            <tr style="background: #7b7b7b; color: white; hover:">
                <?php foreach ($teachers as $tech) { ?>
                    <td><?= $tech->name ?></td>
                <?php } ?>
            </tr>
            <?php
            $students = $this->crud_model->get_student_parent_data($this->session->userdata('branch_id'));
            foreach ($students as $data) {
                ?>
                <tr>
                    <?php
                    $all_teacher = $this->db->get_where('teacher')->result();
                    foreach ($all_teacher as $rowCat) {
                        $where_in = array(
                            'student_id' => $data->student_id,
                            'teacher_id' => $rowCat->teacher_id
                        );
                        $all_teacher = $this->db->get_where('enroll', $where_in)->row();
                        $student_name = '';
                        if (empty($all_teacher)):
                            $student_name = '';
                        else:
                            $student_name = $this->crud_model->get_column_name_by_id('student','student_id',$all_teacher->student_id);
                        endif;
                        ?>
                        <td><?= $student_name ?></td>
                <?php } ?>
                </tr>
<?php } ?>
        </table>
    </div>
</div>