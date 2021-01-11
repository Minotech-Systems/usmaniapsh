<hr />

<?php echo form_open(base_url() . 'index.php?attendance/attendance_report_selector/'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>

            <select name="teacher_id" class="form-control "   id = "teacher_id">
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <?php
                foreach ($teachers as $row):
                    ?>
                    <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?>
                    </option>

                <?php endforeach; ?>
            </select>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control ">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'جنوری';
                    else if ($i == 2)
                        $m = 'فروری';
                    else if ($i == 3)
                        $m = 'مارچ ';
                    else if ($i == 4)
                        $m = 'اپریل ';
                    else if ($i == 5)
                        $m = 'مئی ';
                    else if ($i == 6)
                        $m = 'جون ';
                    else if ($i == 7)
                        $m = 'جولائی ';
                    else if ($i == 8)
                        $m = 'اگست ';
                    else if ($i == 9)
                        $m = 'ستمبر ';
                    else if ($i == 10)
                        $m = 'اکتوبر ';
                    else if ($i == 11)
                        $m = 'نومبر ';
                    else if ($i == 12)
                        $m = 'دسمبر ';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('year'); ?></label>
            <select name="year" class="form-control">		  	
                <?php $date_year = date('Y') ?>		  	
                <option value=""><?php echo get_phrase('select_year'); ?></option>		  	
                <?php for ($i = 0; $i < 30; $i++): ?>		      	
                    <option value="<?php echo 2016 + $i ?>"<?php if ($date_year == 2016 + $i) echo 'selected'; ?>>		          	
                        <?php echo 2016 + $i ?>		      	
                    </option>		  
                <?php endfor; ?>		
            </select>
        </div>
    </div>

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info" disabled="" id="submit"><?php echo get_phrase('show_report'); ?></button>
    </div>
</div>

<?php echo form_close(); ?>
<hr />
<div class="row" style="text-align: center;">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center;">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-docs"></i></div>
            <h3 style="color: #696969;">
                <?php
                if ($month == 1)
                    $m = 'جنوری';
                else if ($month == 2)
                    $m = 'فروری';
                else if ($month == 3)
                    $m = 'مارچ';
                else if ($month == 4)
                    $m = 'اپریل';
                else if ($month == 5)
                    $m = 'مئی';
                else if ($month == 6)
                    $m = 'جون';
                else if ($month == 7)
                    $m = 'جولائی';
                else if ($month == 8)
                    $m = 'اگست';
                else if ($month == 9)
                    $m = 'ستمبر';
                else if ($month == 10)
                    $m = 'اکتوبر';
                else if ($month == 11)
                    $m = 'نومبر';
                else if ($month == 12)
                    $m = 'دسمبر';
                echo get_phrase('اسباق حاضری');
                ?>
            </h3>
            <br>
            <h4 style="color: #696969;">
                <?php echo $teacher_name; ?> <br><br>
                <?php echo $m . ', ' . $s_year; ?>
            </h4>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="my_table">
            <thead>
                <tr>
                    <td style="text-align: center;">
                        <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                    </td>
                    <td><?php echo get_phrase('parent'); ?></td>
                    <?php
                    $year = explode('-', $running_year);
                    $days = cal_days_in_month(CAL_GREGORIAN, $month, $s_year);

                    for ($i = 1; $i <= $days; $i++) {
                        ?>
                        <td style="text-align: center;"><?php echo $i; ?></td>
                    <?php } ?>
                    <td align="center" style="width: 80px"><?php echo 'مجموعی' . '"حاضری"' ?></td>
                    <td align="center" style="width: 80px"><?php echo 'مجموعی' . '"غیرحاضری"' ?></td>

                </tr>
            </thead>
            <tbody>
                <?php
                $data = array();
                $student_row = 0;
                $students = $this->db->get_where('enroll', array('teacher_id' => $teacher_id, 'status' => 1, 'year' => $running_year))->result_array();

                $countstudent = count($students);
                foreach ($students as $row):
                    $student_row++;
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                        </td>
                        <td><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->father_name; ?></td>
                        <?php
                        $status = 0;
                        for ($i = 1; $i <= $days; $i++) {
                            $timestamp = ($s_year . '-' . $month . '-' . $i);
                            $get_name = date('l', strtotime($timestamp)); //get week day
                            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                            if ($day_name == 'Fri') {
                                if ($student_row == 1) {
                                    ?>
                                    <td style="vertical-align: middle" rowspan="<?php echo $countstudent ?>" class="weekendtr" width="20">
                                        <i class="entypo-star-empty"></i><br/>
                                        <br/>F<br/> <br/>R<br/> <br/>I<br/><br/> D<br/><br/> A<br/><br/> Y<br/><br/>
                                        <i class="entypo-star-empty"></i> <br/><br/><br/><br/>
                                    </td>
                                    <?php
                                }
                            } else {

                                $this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('teacher_id' => $teacher_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();


                                foreach ($attendance as $row1):
                                    //$month_dummy = date('d', $row1['timestamp']);
                                    //if ($i == $month_dummy)
                                    $status = $row1['status'];


                                endforeach;
                                ?>
                                <td style="text-align: center;">
                                    <?php if ($status == 1) { ?>
                                        <i class="entypo-record" style="color: #00a651;"></i>
                                    <?php } if ($status == 2) { ?>
                                        <i class="entypo-record" style="color: #ee4749;"></i>
                                    <?php } if ($status == 3) { ?>
                                        <i class="entypo-record" style="color: #e89420;"></i>
                                    <?php } $status = 0; ?>


                                </td>

                                <?php
                            }
                        }
                        ?>
                        <td align="center">
                            <?php
                            $current_att = $this->db->get_where('attendance_count', array(
                                        'teacher_id' => $teacher_id,
                                        'student_id' => $row['student_id'],
                                        'year' => $running_year,
                                        'month' => $month,
                                    ))->row()->total_atd;

                            echo $current_att;
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            $current_att = $this->db->get_where('attendance_count', array(
                                        'teacher_id' => $teacher_id,
                                        'student_id' => $row['student_id'],
                                        'year' => $running_year,
                                        'month' => $month,
                                    ))->row()->total_absent;

                            echo $current_att;
                            ?>
                        </td>
                    <?php endforeach; ?>


                </tr>

            </tbody>

        </table>
    </div>
</div>
<center>
    <a href="<?php echo base_url(); ?>index.php?attendance/attendance_report_print_view/"
       class="btn btn-success" target="_blank">
           <?php echo get_phrase('پرنٹ حاضری رپورٹ'); ?>
    </a>
</center>

<script type="text/javascript">

    // ajax form plugin calls at each modal loading,
    $(document).ready(function () {

        // SelectBoxIt Dropdown replacement
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
            {
                var $this = $(el),
                        opts = {
                            showFirstOption: attrDefault($this, 'first-option', true),
                            'native': attrDefault($this, 'native', false),
                            defaultText: attrDefault($this, 'text', ''),
                        };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    });

</script>

<script type="text/javascript">

    function select_section(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admission/get_sections/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder').html(response);
                }
            });
        }
    }
</script>
<style type="text/css">
    .weekendtr
    {

        /*background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='50px'><text x='0' y='15' fill='white' font-size='5'>SUNDAY</text></svg>");*/
        background-color: #ff9999 !important;
        color: #ffffcc;
        vertical-align: middle;

        /*border-bottom: 1px solid #999999 !important;*/
    }

</style>
<script type="text/javascript">

    function check_validation(teacher_id) {
        if (teacher_id !== '') {
            $('#submit').removeAttr('disabled')
        } else {
            $('#submit').attr('disabled', 'disabled');
        }
    }

    $('#teacher_id').change(function () {
        teacher_id = $('#teacher_id').val();
        check_validation(teacher_id);
    });
</script>