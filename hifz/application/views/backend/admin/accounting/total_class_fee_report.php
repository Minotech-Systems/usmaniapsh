<?php echo form_open(base_url() . 'index.php?student_fee/total_class_fee_report/'); ?>
<div class="row">
    <div class="col-sm-2 col-sm-offset-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control "   id = "class_selection">
                <option value=""><?php echo get_phrase('select_tecaher'); ?></option>
                <option value="all"><?php echo 'تمام' ?></option>
                <?php
                $teachers = $this->db->get_where('teacher', array('branch_id' => $login_user_branch))->result_array();

                foreach ($teachers as $row) {
                    ?>

                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']; ?></option>

                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month') . ' سے'; ?></label>
            <select name="month_start" class="form-control "  id="month" dir="rtl">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'شوال';
                    else if ($i == 2)
                        $m = 'ذوالقعدۃ';
                    else if ($i == 3)
                        $m = 'ذوالحجۃ';
                    else if ($i == 4)
                        $m = 'محرم';
                    else if ($i == 5)
                        $m = 'صفر';
                    else if ($i == 6)
                        $m = 'ر بیع الاول';
                    else if ($i == 7)
                        $m = 'ر بیع الثانی';
                    else if ($i == 8)
                        $m = 'جمادی الاول';
                    else if ($i == 9)
                        $m = 'جمادی الثانی';
                    else if ($i == 10)
                        $m = 'رجب';
                    else if ($i == 11)
                        $m = 'شعبان';
                    else if ($i == 12)
                        $m = ' رمضان';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo ucfirst($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month') . ' تک'; ?></label>
            <select name="month_end" class="form-control "  id="month" dir="rtl">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'شوال';
                    else if ($i == 2)
                        $m = 'ذوالقعدۃ';
                    else if ($i == 3)
                        $m = 'ذوالحجۃ';
                    else if ($i == 4)
                        $m = 'محرم';
                    else if ($i == 5)
                        $m = 'صفر';
                    else if ($i == 6)
                        $m = 'ر بیع الاول';
                    else if ($i == 7)
                        $m = 'ر بیع الثانی';
                    else if ($i == 8)
                        $m = 'جمادی الاول';
                    else if ($i == 9)
                        $m = 'جمادی الثانی';
                    else if ($i == 10)
                        $m = 'رجب';
                    else if ($i == 11)
                        $m = 'شعبان';
                    else if ($i == 12)
                        $m = ' رمضان';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo ucfirst($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>
<?php
if ($teacher_id != '' && $month_start != '') {
    $branch_name = $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row()->name;
    ?>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;"><?php echo 'طلبہ فیس رپورٹ' ?></h3>
                <br>
                <h4 style="color: #696969;">
                    <?php echo $branch_name; ?><br><br>
                    <?php echo $this->studentfee_model->get_month_name($month_start) . ' - ' . $this->studentfee_model->get_month_name($month_end); ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <table width="90%" border="1" dir="rtl" align="center" style="text-align: center; line-height: 2">
        <thead>
            <tr style="background-color: #03b2e7; line-height: 3; color: white;">
                <td><?php echo get_phrase('serial_no') ?></td>
                <td><?php echo get_phrase('name') ?></td>
                <td><?php echo get_phrase('parent') ?></td>
                <td><?php echo get_phrase('expenses'); ?></td>
                <td><?php echo get_phrase('self_payment'); ?></td>
                <td><?php echo get_phrase('scholorship') ?></td>
                <td><?php echo get_phrase('total_amount'); ?></td>
                <td><?= 'مجموعی وظیفہ' ?></td>
                <td><?php echo get_phrase('paid_amount'); ?></td>
                <td><?php echo get_phrase('remaining'); ?></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (is_numeric($teacher_id)) {
                $students = $this->studentfee_model->get_students_fee($teacher_id, $running_year);
            } else {
                $students = $this->studentfee_model->get_students_fee_b($running_year);
            }

            foreach ($students as $data) {
                $sum_add_fee = 0;
                $t_ad_stdudent_fee = 0;
                $parent = $data['father_name'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php
                        if ($data['sponsor_id'] > 0) {
                            echo $data['name'] . ' &#9994';
                        } else {
                            echo $data['name'];
                        }
                        ?></td>
                    <td><?php echo $parent ?></td>
                    <td><?php echo $monthly_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id))->row()->amount; ?></td>
                    <td><?php echo $std_fee = $data['amount'] ?></td>
                    <?php
                    if ($std_fee > $monthly_fee) {
                        $ad_fee = $std_fee - $monthly_fee;
                        $t_ad_stdudent_fee = $ad_fee * $months;
                        echo '<td>' . $inst_paid = 0;
                        '</td>';
                    } else {
                        echo '<td>' . $inst_paid = $monthly_fee - $data['amount'];
                        '</td>';
                    }
                    ?>
                    <td><?php echo $month_total = $monthly_fee * $months ?></td>
                    <td><?php echo $total_scholorship = $inst_paid * $months; ?></td>
                    <td>
                        <?php
                        if (is_numeric($teacher_id)) {
                            $student_paid = $this->studentfee_model->get_student_transactions_sum($month_start, $month_end, $data['student_id'], $teacher_id);
                            $additional_fee = $this->studentfee_model->get_additional_transactions_sum($month_start, $month_end, $data['student_id'], $teacher_id);
                        } else {
                            $student_paid = $this->studentfee_model->get_student_transactions_sum_b($month_start, $month_end, $data['student_id']);
                            $additional_fee = $this->studentfee_model->get_additional_transactions_sum($month_start, $month_end, $data['student_id']);
                        }
                        $sum_add_fee = $t_ad_stdudent_fee - $additional_fee;
                        echo $student_paid + $additional_fee;
                        ?>
                    </td>
                    <td><?php echo $st_remian = ($month_total - $student_paid) - $total_scholorship + $sum_add_fee; ?></td>
                </tr>
                <?php
                $t_month_fee += $monthly_fee;
                $t_stud_fee += $std_fee;
                $t_inst_paid += $inst_paid;
                $t_months_fee += $month_total;
                $t_std_paid += $student_paid;
                $t_std_remain += $st_remian;
                $all_scholorship += $total_scholorship;
                $all_additional += $additional_fee;
            }
            ?>
            <tr style="font-size: 14px;">
                <td colspan="3"><?php echo 'مجموعی ریکارڈ' ?></td>
                <td><?php echo $t_month_fee; ?></td>
                <td><?php echo $t_stud_fee; ?></td>
                <td><?php echo $t_inst_paid; ?></td>
                <td><?php echo $t_months_fee ?></td>
                <td><?php echo $all_scholorship ?></td>
                <td><?php echo $t_std_paid + $all_additional; ?></td>
                <td><?php echo $t_std_remain; ?></td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <center>
            <a href="<?php echo base_url(); ?>index.php?student_fee/total_class_fee_report_print/<?php echo $class_id ?>/<?php echo $section_id ?>/<?php echo $month_start ?>/<?php echo $month_end ?>" target="_blank" class="btn btn-success btn-icon icon-left hidden-print ">
                <?php echo 'پرنٹ ریکارڈ' ?>
                <i class="entypo-print" style="background-color:#2191bf"></i>
            </a>
        </center>
    </div>
<?php } ?>
