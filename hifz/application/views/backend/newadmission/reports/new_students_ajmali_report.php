<style>
    li{text-align: right}

</style>
<?php echo form_open(base_url() . 'index.php?newadmission/new_students_ajmali_report/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control "  onchange="this.form.submit()">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <option value="all"><?php echo 'تمام'; ?></option>
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
            <a href="<?= base_url('index.php?newadmission/new_students_ajmali_report_print/' . $branch_id1) ?>" target="blank" class="btn btn-success">
                <i class="fa fa-print"></i>
                <?= 'پرنٹ رپورٹ' ?>
            </a>
        </div>
        <div class="col-md-4">
            <center><h3 dir="ltr"><?= $branch_name1 ?></h3></center>
        </div>
        <div class="col-md-4"></div>

    </div>
    <?php if (is_numeric($branch_id1)) { ?>
        <div class="row">
            <div class="col-md-12">
                <table align='center' width='90%' border='1' style="border: 1px solid black; border-collapse: collapse; line-height: 2.5; text-align: center">
                    
                    <tr>
                        <td><?= 'تمام داخلہ طلبہ' ?></td>
                        <td><?= $this->db->where(array('year' => $running_year, 'branch_id' => $branch_id1))->from("new_enroll")->count_all_results(); ?></td>
                    </tr>
                    <tr>
                        <td><?= 'ٹوٹل منتخب طلبہ' ?></td>
                        <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 0, 'branch_id' => $branch_id1))->from("new_enroll")->count_all_results(); ?></td>
                    </tr>
                    <tr>
                        <td><?= 'تمام غیر منتخب طلبہ' ?></td>
                        <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 1, 'branch_id' => $branch_id1))->from("new_enroll")->count_all_results(); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-12">
                <table align='center' width='50%' border='1' style="border: 1px solid black; border-collapse: collapse; line-height: 2.5; text-align: center">
                    <?php
                    $branches = $this->db->get_where('branches')->result();
                    foreach ($branches as $bran) {
                        ?>
                        <tr style="background: #ef9e64;">
                            <td colspan="4" align='center' dir="ltr"><?= $bran->name ?></td>
                        </tr>
                        <tr>
                            <td><?= 'تمام داخلہ طلبہ' ?></td>
                            <td><?= $this->db->where(array('year' => $running_year, 'branch_id' => $bran->branch_id))->from("new_enroll")->count_all_results(); ?></td>
                        </tr>
                        <tr>
                            <td><?= 'ٹوٹل منتخب طلبہ' ?></td>
                            <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 0, 'branch_id' => $bran->branch_id))->from("new_enroll")->count_all_results(); ?></td>
                        </tr>
                        <tr>
                            <td><?= 'تمام غیر منتخب طلبہ' ?></td>
                            <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 1, 'branch_id' => $bran->branch_id))->from("new_enroll")->count_all_results(); ?></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
        <?php
    }
}
?>