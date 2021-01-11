<br>
<style>
    li{text-align: right;}
</style>
<!--<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control "  onchange="goToURL(this.value)">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->db->get_where('branches')->result_array();
                foreach ($branches as $row):
                    ?>
                    <option value="<?php echo $row['branch_id']; ?>" dir="ltr" ><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>-->
<?php if (!empty($branch_id)) { ?>
    <div class="row">
        <div class="col-md-4" style="text-align:center">
            <a class="btn btn-success" href="<?= base_url('index.php?exam/exam_roll_report_print').'/'.$branch_id?>" target="blank">
                <i class="fa fa-print"></i>
                <?= 'پرنٹ ریکارڈ' ?>
            </a>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table width="80%" align="center" style="text-align: center; line-height: 2; margin-top: 10px;" border="1">
                <tr style=" background: #464646; color: white;">
                    <td>#</td>
                    <td><?= get_phrase('name') ?></td>
                    <td><?= get_phrase('parent') ?></td>
                    <td><?= get_phrase('reg_no') ?></td>
                    <td><?= get_phrase('exam_roll') ?></td>
                </tr>
                <?php
                $no = 1;
                $student_data = $this->exam_model->get_branch_year_exam_roll($branch_id);
                foreach ($student_data as $data) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->name ?></td>
                        <td><?= $data->father_name ?></td>
                        <td><?= $data->reg_no ?></td>
                        <td style="font-size: 14px; font-weight: bold;"><?= $data->roll_no ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    function goToURL(id) {
        location.href = "<?php echo base_url(); ?>index.php?exam/exam_roll_report/" + id;
    }


</script>