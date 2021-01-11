<style>
    li{text-align: right}
</style>
<?php echo form_open(base_url() . 'index.php?newadmission/end_of_admission/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control "  onchange="this.form.submit()">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->db->get('branches')->result_array();
                foreach ($branches as $row):
                    ?>
                    <option value="<?php echo $row['branch_id']; ?>" dir="ltr"><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<?php if (!empty($branch_id1)) { ?>
    <div class="row">
        <div class="col-md-12">
            <center>
                <h4 dir="ltr"><?= $branch_name1 ?></h4>
            </center>
        </div>
    </div>
    <form action="<?= base_url('index.php?newadmission/end_of_admission/confirm') ?>" method="post">

        <div class="row">
            <div class="col-md-12">
                <table width="90%" align="center" border="1" style="border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 2">
                    <tr style="line-height: 3; background: #e0bd8e;">
                        <td>#</td>
                        <td><?= get_phrase('name') ?></td>
                        <td><?= get_phrase('parent') ?></td>
                        <td><?= get_phrase('phone') ?></td>
                        <td><?= 'ٹسٹ نمبرات' ?></td>
                        <td><?= 'status' ?></td>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($students as $std_data) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $std_data->name ?></td>
                            <td><?= $std_data->father_name ?></td>
                            <td><?= $std_data->phone ?></td>
                            <td><?= $std_data->test_marks ?></td>
                            <td>
                                <input type="hidden" name="branch_id1" value="<?= $branch_id1 ?>">
                                <?php if ($std_data->enroll_status == 1) { ?>
                                    <input type="checkbox" name="student_id[]" value="<?= $std_data->student_id ?>">
                                <?php } else { ?>  
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?newadmission/delete_new_enroll/<?php echo $std_data->student_id ?>/<?= $std_data->enroll_student_id ?>');">
                                        <?= 'پہلے سے داخل ہے' ?>
                                        <i class="entypo-trash"></i>
                                    </a>
                                    &nbsp;
                                    <a href="<?= base_url('index.php?newadmission/print_admission_from') . '/' . $std_data->student_id ?>" target="_blank">
                                        <i class="fa fa-print"></i>
                                        <?= 'پرنٹ فارم' ?>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <center>
                <button type="submit" class="btn btn-success"><?= get_phrase('submit') ?></button>
            </center>
        </div>
    </form>
<?php } ?>
