<style>
    li{text-align:right;}
</style>

<?php echo form_open(base_url() . 'index.php?student_fee/class_fee_record/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control"  >
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <option value="all"><?php echo 'تمام'; ?></option>
                <?php
                $teachers = $this->db->get_where('teacher', array('branch_id' => $login_user_branch))->result_array();
                foreach ($teachers as $row) {
                    ?>
                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']; ?></option>

                <?php } ?>
            </select>
        </div>
    </div>

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>

<?php
if ($teacher_id != '' && $branch_id != '') {
    $teacher_name = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
    ?>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;"><?php echo 'تملیک زکواۃ فارم' ?></h3>
                <br>
                <h4 style="color: #696969;">
                    <?php echo $teacher_name; ?><br><br>

                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

    <table width="90%" border="1" style="border-collapse: collapse; text-align: center; line-height: 2" align="center">
        <thead>
            <tr style="background-color: #03b2e7; line-height: 3; color: white;">
                <td><?php echo get_phrase('serial_no') ?></td>
                <td><?php echo get_phrase('name') ?></td>
                <td><?php echo get_phrase('parent') ?></td>
                <td><?php echo get_phrase('monthly') ?></td>
                <td><?php echo 'چارماہی' ?></td>
                <td><?php echo 'ذاتی تعاون' ?></td>
                <td><?php echo get_phrase('scholorship') ?></td>
                <!--<td><?php echo get_phrase('total'); ?></td>-->
                <td><?php echo 'دستخط' ?></td>
                <td><?php echo 'چارماہی' . '۲' ?></td>
                <td><?php echo 'ذاتی تعاون' ?></td>
                <td><?php echo get_phrase('scholorship') ?></td>
                <!--<td><?php echo get_phrase('total'); ?></td>-->
                <td><?php echo 'دستخط' ?></td>
                <td><?php echo 'چارماہی' . '۳' ?></td>
                <td><?php echo 'ذاتی تعاون' ?></td>
                <td><?php echo get_phrase('scholorship') ?></td>
                <!--<td><?php echo get_phrase('total'); ?></td>-->
                <td><?php echo 'دستخط' ?></td>
            </tr>

        </thead>
        <tbody>
            <?php
            $no = 1;
            if (is_numeric($teacher_id)) {
                $students = $this->studentfee_model->get_fee_record_all($teacher_id, $running_year);
            } else {
                $students = $this->studentfee_model->get_fee_record_all_branch($running_year);
            }
            foreach ($students as $data) {
                $parent = $data['father_name'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $parent ?></td>
                    <td><?php echo $month_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id))->row()->amount; ?></td>
                    <td><?php echo $month_fees = $month_fee * 4 ?></td>
                    <td><?php echo $stud_tobe_paid = ($data['amount'] * 4) ?></td>
                    <td>
                        <?php
                        if ($stud_tobe_paid > $month_fees) {
                            echo $insti_tobe_paid = 0;
                        } else {
                            echo $insti_tobe_paid = ($month_fees - $stud_tobe_paid);
                        }
                        ?>
                    </td>
                    <?php
                    $month1_total += $month_fees;
                    $std_month_total += $stud_tobe_paid;
                    $insti_total_paid += $insti_tobe_paid;
                    ?>
                    <td></td>
                    <td><?php echo $month_fees ?></td>
                    <td><?php echo $stud_tobe_paid; ?></td>
                    <td><?php echo $insti_tobe_paid ?></td>
                    <!--<td><?php echo $month_fees; ?></td>-->
                    <td></td>
                    <td><?php echo $month_fees ?></td>
                    <td><?php echo $stud_tobe_paid; ?></td>
                    <td><?php echo $insti_tobe_paid ?></td>
                    <!--<td><?php echo $month_fees; ?></td>-->
                    <td></td>

                </tr>
            <?php } ?>
            <tr>
                <td colspan="3"><?php echo 'مجموعی ریکارڈ' ?></td>
                <td><?php; ?></td>
                <td><?php echo $month1_total ?></td>
                <td><?php echo $std_month_total; ?></td>
                <td><?php echo $insti_total_paid; ?></td>
                <!--<td><?php ?></td>-->
                <?php ?>
                <td></td>
                <td><?php echo $month1_total ?></td>
                <td><?php echo $std_month_total; ?></td>
                <td><?php echo $insti_total_paid; ?></td>
                <!--<td><?php ?></td>-->
                <td></td>
                <td><?php echo $month1_total ?></td>
                <td><?php echo $std_month_total; ?></td>
                <td><?php echo $insti_total_paid; ?></td>
                <!--<td><?php ?></td>-->
                <td></td>
            </tr>
        </tbody>
    </table>
    <table width="40%" align="center" border="1" style="margin-top:20px; line-height: 2; text-align: center;">
        <tr style="background-color: #03b2e7; line-height: 3; color: white;">
            <td colspan="2" align="center"><?php echo 'سالانہ مجموعی ریکارڈ' ?></td>
        </tr>
        <tr>
            <td width="40%"><?php echo 'مجموعی فیس' ?></td>
            <td><?php echo $month1_total * 3 ?></td>
        </tr>
        <tr>
            <td width="40%"><?php echo 'مجموعی تعاون ازادارہ' ?></td>
            <td><?php echo $insti_total_paid * 3 ?></td>
        </tr>
        <tr>
            <td width="40%"><?php echo 'مجموعی تعاون از طلبہ' ?></td>
            <td><?php echo $std_month_total * 3 ?></td>
        </tr>
    </table>
    <br><br>
    <div class="row">
        <center>
            <a href="<?php echo base_url(); ?>index.php?student_fee/class_fee_record_print/" target="_blank" class="btn btn-success btn-icon icon-left hidden-print ">
                <?php echo 'پرنٹ ریکارڈ' ?>
                <i class="entypo-print" style="background-color:#2191bf"></i>
            </a>
        </center>
    </div>

<?php } ?>
