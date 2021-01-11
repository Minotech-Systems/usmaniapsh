<?php echo form_open(base_url() . 'index.php?student_fee/student_paid_fee_record/'); ?>
<div class="row">
    <div class="col-sm-2 col-sm-offset-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control"   id = "class_selection">
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
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
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control "  id="month" dir="rtl">
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
                    <option value="<?php echo $i ?>"
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
if ($teacher_id != '' ) {
    if(is_numeric($teacher_id)){
        $teacher_name = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
    }
    
    ?>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;"><?php echo 'طلبہ فیس رپورٹ' ?></h3>
                <br>
                <h4 style="color: #696969;">
                    <?php echo $teacher_name; ?> <br><br>
                    <?php echo $this->studentfee_model->get_month_name($month); ?>
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
                <td><?php echo get_phrase('monthly_fee'); ?></td>
                <?php for ($i = 1; $i <= $month; $i++) { ?>
                    <td><?php echo $this->studentfee_model->get_month_name($i); ?></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if(is_numeric($teacher_id)){
                $students = $this->studentfee_model->get_fee_record($teacher_id, $running_year);
            } else {
                $students = $this->studentfee_model->get_fee_record_branch($running_year);
            }
            
            foreach ($students as $data) {
                $parent = $data['father_name'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $parent ?></td>
                    <td><?php echo $data['amount'] ?></td>
                    <?php for ($i = 1; $i <= $month; $i++) { ?>
                        <td><?php
                            if ($this->studentfee_model->check_student_fee_month($data['student_id'], $i, $running_year) != 0) {
                                echo '&#10004';
                            } else {
                                echo '<span style="color:red;">' . '&#10006' . '</span>';
                            }
                            ?></td>
                        <?php } ?>
                </tr>
                <?php $total_fee += $data['amount'];
            } ?>
            <tr>
                <td colspan="3"><?php echo 'مجموعی ریکارڈ' ?></td>
                <td><?php echo $total_fee; ?></td>
                <td colspan="12"></td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <center>
            <a href="<?php echo base_url(); ?>index.php?student_fee/student_paid_fee_record_print/" target="_blank" class="btn btn-success btn-icon icon-left hidden-print ">
                <?php echo 'پرنٹ ریکارڈ' ?>
                <i class="entypo-print" style="background-color:#2191bf"></i>
            </a>
        </center>
    </div>
<?php } ?>
