<style>
    li{text-align: right}

</style>
<?php echo form_open(base_url() . 'index.php?newadmission/select_student_report/'); ?>
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
            <a href="<?= base_url('index.php?newadmission/print_select_student_report/' . $branch_id1) ?>" target="blank" class="btn btn-success">
                <i class="fa fa-print"></i>
                <?= 'پرنٹ رپورٹ' ?>
            </a>
        </div>
        <div class="col-md-4">
            <center><h3 dir="ltr"><?= $branch_name1 ?></h3></center>
        </div>
        <div class="col-md-4"></div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table width="90%" align="center" border="1" style="border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 2">
                <tr style="line-height: 3; background: #e0bd8e;">
                    <td>#</td>
                    <td><?= get_phrase('name') ?></td>
                    <td><?= get_phrase('parent') ?></td>
                    <td><?= get_phrase('current_address') ?></td>
                    <td><?= 'ٹسٹ نمبرات' ?></td>
                    <td><?= 'ذاتی تعاون' ?></td>
                    <td><?= 'ادا شدہ فیس' ?></td>
                </tr>
                <?php
                $no = 1;
                foreach ($students as $data) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->name ?></td>
                        <td><?= $data->father_name ?></td>
                        <td><?= $data->c_address ?></td>
                        <td><?= $data->test_marks ?></td>
                        <td><?= $this->db->get_where('new_student_fee', array('student_id' => $data->student_id))->row()->amount; ?></td>
                        <td>
                            <?php
                            $transactions = $this->db->get_where('new_student_transaction', array('student_id' => $data->student_id))->result();
                            foreach ($transactions as $tran) {
                                echo $this->crud_model->get_month_name($tran->month) . ' , ';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } ?>
