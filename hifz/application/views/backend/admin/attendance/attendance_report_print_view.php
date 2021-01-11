<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$r_year = explode('-', $running_year);
$teacher_name = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
$branch_name = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
$month_name = $this->attendance_model->get_month_name($month);
?>
<style>
    body{font-family: 'Noto Nastaliq Urdu Draft', serif;}

</style>
<table width="100%" dir="rtl" align="center">
    <tr >
        <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
        <td align="center">
            <h3 style="font-weight: 100; margin-bottom: -25px;" dir="ltr"><?php echo $branch_name; ?></h3><br>
            <?php echo $month_name . ':' . get_phrase('  حفاظ حاضری رپورٹ'); ?>

        </td>
        <td width="25%">
            <u style="border-bottom:2px solid black;"><?php echo get_phrase('معلم') . ' : ' . ' ' . $teacher_name ?></u>
            <br>
            <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
        </td>
        <td width="5%">
            <span style="display:inline"> <img src="uploads/logo.png" height="80"/></span>
        </td>
    </tr>
</table>
<!--.-->
<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px; line-height: 18px; font-size: 12px; " border="1" dir="rtl">
    <thead>
        <tr>
            <td align="center"  style="width: 120px">
                <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
            </td>
            <td align="center" style="width: 120px"><?php echo get_phrase('parent'); ?></td>
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
                <td align="center">
                    <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                </td>
                <td align="center"><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->father_name;  ?></td>
                <?php
                $status = 0;
                for ($i = 1; $i <= $days; $i++) {
                    $timestamp = ($s_year . '-' . $month . '-' . $i);
                    $get_name = date('l', strtotime($timestamp)); //get week day
                    $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                    if ($day_name == 'Fri') {
                        if ($student_row == 1) {
                            ?>
                            <td style="vertical-align: middle; text-align: center; background-color: #ff9800d1;" rowspan="<?php echo $countstudent ?>" class="weekendtr" width="20">
                                <i class="entypo-star-empty"></i><br/> 
                                <br/>F<br/> <br/>R<br/> <br/>I<br/><br/> D<br/><br/> A<br/><br/> Y<br/><br/> 
                                <i class="entypo-star-empty"></i> <br/><br/><br/><br/>
                            </td>
                            <?php
                        }
                    } else {

                        $this->db->group_by('timestamp');
                        $attendance = $this->db->get_where('attendance', array( 'teacher_id' => $teacher_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();


                        foreach ($attendance as $row1):
                            //$month_dummy = date('d', $row1['timestamp']);
                            //if ($i == $month_dummy)
                            $status = $row1['status'];


                        endforeach;
                        ?>
                        <td style="text-align: center;">
                            <?php if ($status == 1) { ?>
                                <i>ح</i>
                            <?php } if ($status == 2) { ?>
                                <i>غ</i>
                            <?php } if ($status == 3) { ?>
                                <i>ر</i>
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