<?php
$students_info = $this->studentfee_model->branch_students_transaction($running_year, $login_user_branch);
$teachers = $this->db->get_where('teacher', array('branch_id' => $login_user_branch))->result_array();
?>
<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#student_wise" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo 'علیحدہ رسید بنائے'; ?>
                </a>
            </li>
            <li>
                <a href="#class_wise" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'متحدہ رسید بنائے'; ?>
                </a>
            </li>
            <li>
                <a href="#selected_student_invoice" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('selected_student_invoice'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box  active" id="student_wise">
                <?php echo form_open(base_url() . 'index.php?student_fee/student_invoice/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_blank')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('teacher'); ?></label>
                        <div class="col-sm-3">
                            <select name="teacher_id" class="form-control" data-validate="required" id="class_id" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return get_teacher_students(this.value)">
                                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                                <?php
                                foreach ($teachers as $row):
                                    ?>
                                    <option value="<?php echo $row['teacher_id']; ?>" ><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('student'); ?></label>
                        <div class="col-sm-3">
                            <select class="form-control select2 select2-offscreen visible" name="student_id" id="student_list">
                                <option value=""><?php echo get_phrase('select_section_first') ?></option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                        <div class="col-sm-3">
                            <select name="month_s[]" class="form-control select2"   multiple="" id="month" dir="rtl">
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo 'آخری تاریخ' ?></label>
                        <div class="col-sm-3">
                            <input type="text" name="due_date" class="form-control datepicker" data-format="dd-mm-yyyy" autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('create_invoice'); ?></button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>                
                </div>

            </div>
            <div class="tab-pane box " id="class_wise">
                <?php echo form_open(base_url() . 'index.php?student_fee/class_student_invoice/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_blank')); ?>
                <div class="padding">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('teacher'); ?></label>
                        <div class="col-sm-3">
                            <select name="teacher_id_c" class="form-control" data-validate="required" id="class_id_c" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return select_section_c(this.value)">
                                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                                <?php
                                foreach ($teachers as $row1):
                                    ?>
                                    <option value="<?php echo $row1['teacher_id']; ?>" ><?php echo $row1['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                        <div class="col-sm-3">
                            <select name="month_c[]" class="form-control select2" multiple="" id="month" dir="rtl">
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo 'آخری تاریخ' ?></label>
                        <div class="col-sm-3">
                            <input type="text" name="due_date_c" class="form-control datepicker" data-format="dd-mm-yyyy" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('create_invoice'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="tab-pane box" id="selected_student_invoice">
                <?php echo form_open(base_url() . 'index.php?student_fee/selected_student_invoice/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_blank')); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="padding">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher'); ?></label>
                                <div class="col-sm-9">
                                    <select name="teacher_id_s" class="form-control" data-validate="required" id="class_id_s" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"
                                            onchange="return student_list_table(this.value)">
                                        <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                                        <?php
                                        foreach ($teachers as $row):
                                            ?>
                                            <option value="<?php echo $row['teacher_id']; ?>" ><?php echo $row['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                                <div class="col-sm-9">
                                    <select name="month_s" class="form-control "  id="month" dir="rtl">
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
                                            <option value="<?php echo $i . '_' . $m; ?>"
                                                    <?php if ($month == $i) echo 'selected'; ?>  >
                                                        <?php echo ucfirst($m); ?>
                                            </option>
                                            <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-3">
                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('create_invoice'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="student_list_table"></div>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>


        </div>
    </div>
</div>

<script type="text/javascript">

    function get_teacher_students(teacher_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?student_fee/get_class_students_parents/' + teacher_id,
            success: function (response)
            {
                jQuery('#student_list').html(response);
            }
        });

    }
</script>
<script type="text/javascript">

    function select_section_c(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?student_fee/get_class_section/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder_c').html(response);
                }
            });
        }
    }

    function select_section_s(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?student_fee/get_class_section/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder_s').html(response);
                }
            });
        }
    }


</script>
<script type="text/javascript">
    function student_list_table(value) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?student_fee/get_class_students_mass/' + value,
            success: function (response)
            {
                jQuery('#student_list_table').html(response);
            }
        });

    }
</script>