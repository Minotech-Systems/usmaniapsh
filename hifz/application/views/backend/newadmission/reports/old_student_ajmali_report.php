<style>
    li{text-align: right}

</style>
<?php echo form_open(base_url() . 'index.php?newadmission/old_student_ajmali_report/'); ?>
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
        <div class="col-md-4">
            <a href="<?= base_url('index.php?newadmission/old_student_ajmali_report_print/' . $branch_id1) ?>" target="blank" class="btn btn-success">
                <i class="fa fa-print"></i>
                <?= 'پرنٹ رپورٹ' ?>
            </a>
        </div>
        <div class="col-md-4">
            <center>
                <h3 dir="ltr"><?= $branch_name1 ?></h3>
                <h4><?= 'تجدید رپورٹ'?></h4>
            </center>
            
        </div>
        <div class="col-md-4"></div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table width="90%" align="center" border="1" dir="rtl" style="  font-weight: bold; border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 2">
                <?php
                $no1 = 1;
                $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id1))->result();
                foreach ($teachers as $teach) {
                    ?>
                <tr <?php if($no1 != 1){echo 'style = "border-top: 2px solid black; line-height:3"';}?> style="line-height:3">
                        <td align='center' colspan="4"><?= $teach->name ?></td>
                    </tr>
                    <tr style="background: bisque;">
                        <td><?= '#'?></td>
                        <td><?= get_phrase('name')?></td> 
                        <td><?= get_phrase('parent');?></td>
                        <td><?= get_phrase('reg_no')?></td>
                    </tr>
                    <?php
                    $no = 1;
                    $students = $this->newadmission_model->get_student_teacher_info($running_year, $branch_id1, $teach->teacher_id);
                    foreach ($students as $data) {
                        ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $data->name?></td>
                        <td><?= $data->father_name?></td>
                        <td><?= $data->reg_no?></td>
                    </tr>
                        <?php
                    }
                    $no1++;
                }
                ?>
            </table>
        </div>
    </div>
    <?php
}?>