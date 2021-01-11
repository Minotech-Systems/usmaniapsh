<br>
<div class="row">
    <div class="col-md-12">
        <div class="tabs-vertical-env">
            <ul class="nav tabs-vertical right-aligned">
                <?php
                foreach ($branches as $row):
                    ?>
                    <li class="<?php if ($row->branch_id == $branch_id) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?full_admin/manage_students/<?php echo $row->branch_id; ?>">
                            <i class="entypo-dot"></i>
                            <span dir="ltr"><?php echo $row->name; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                        <form method="post" action="<?= base_url('index.php?full_admin/manage_students/manage') ?>">
                            <div class="col-md-3 col-sm-3 col-md-offset-2">
                                <div class="form-group">
                                    <label class="control-label" ><?php echo get_phrase('students'); ?></label>
                                    <select name="student_id[]" class="form-control select2" multiple dir="rtl" >
                                        <?php
                                        $students = $this->crud_model->get_unrranged_students($branch_id);
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
                                        <option value=""><?= get_phrase('select_teacher') ?></option>
                                        <?php
                                        $teachers = $this->crud_model->get_table_data_where('teacher', array('status' => 1, 'branch_id' => $branch_id));
                                        foreach ($teachers as $tech):
                                            ?>
                                            <option value="<?php echo $tech->teacher_id; ?>"><?php echo $tech->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <div class="form-group">
                                    <button class="btn btn-success" style="margin-top: 20px;"><?= get_phrase('submit') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <?php
                        foreach ($teachers as $teacher) {
                            ?>
                            <div class="col-md-3">
                                <table class="table table" style="text-align: center; margin-top: 20px;">
                                    <tr style="background: #7b7b7b; color: white;">
                                        <td colspan="3"><?= $teacher->name; ?></td>
                                    </tr>
                                    <tr style="background: #ebebeb;">
                                        <td><?= '#' ?></td>
                                        <td><?= get_phrase('name') ?></td>
                                        <td><?= get_phrase('parent') ?></td>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    $students = $this->crud_model->get_student_teacher_data($teacher->teacher_id);
                                    foreach ($students as $data) {
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-icon btn-xs" onclick="confirm_modal('<?php echo base_url(); ?>index.php?full_admin/remove_student_teacher/<?= $data->student_id ?>');">
                                                    <?= $data->name; ?>
                                                    <i class="entypo-cancel"></i>
                                                </button>
                                            </td>
                                            <td><?= $data->father_name ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php
                            $no1++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</div>

