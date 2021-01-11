<?php echo form_open(base_url() . 'index.php?newadmission/old_student_promotion_report'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control " onchange="this.form.submit()" >
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->db->get('branches')->result_array();

                foreach ($branches as $row):
                    ?>
                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<?= form_close(); ?>
<?php if (!empty($branch_id1)) { ?>
    <div class="row">
        <div class="col-md-4">
            <a href="<?= base_url('index.php?newadmission/print_old_student_promotion_report/' . $branch_id1) ?>" target="blank" class="btn btn-success">
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
                    <td><?= get_phrase('address') ?></td>
                </tr>
                <?php $no = 1; foreach ($students as $data){?>
                <tr>
                    <td><?= $no++?></td>
                    <td><?= $data->name?></td>
                    <td><?= $data->father_name?></td>
                    <td><?= $data->c_address?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
    <?php
}?>