<html>
    <head>
        <title>Friday Attendance Report</title>
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
        <style>
            body{font-family: 'Noto Nastaliq Urdu Draft', serif;}

        </style>
    </head>
    <body>
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
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $r_year = explode('-', $running_year);
        $teacher_name = $this->db->get_where('teacher',array('teacher_id'=>$teacher_id))->row()->name;
        $branch_id = $this->session->userdata('branch_id');
        $branch_name = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        ?>
        <table width="100%" dir="rtl" align="center">
            <tr >
                <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
                <td align="center">
                    <h3 style="font-weight: 100; margin-bottom: -50px;" dir="ltr"><?php echo $branch_name; ?></h3><br>
                    <?php echo get_phrase('روز جمعہ حاضری رپورٹ') . ' : ' . $m; ?>

                </td>
                <td width="25%">
                    <u style="border-bottom:2px solid black;"><?php echo get_phrase('teacher') . ' : ' . ' ' . $teacher_name; ?></u>
                    <br>
                    <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
                </td>
                <td width="5%">
                    <span style="display:inline"> <img src="uploads/logo.png" height="80"/></span>
                </td>
            </tr>
        </table>
        <table width="100%" border="1"  style="text-align:center; line-height:2; border-collapse:collapse;border: 1px solid black;" dir="rtl">
            <thead>
                <tr>
                    <td><?php echo get_phrase('serial_no') ?></td>
                    <td style="text-align: center;">
                        <?php echo get_phrase('students'); ?>
                    </td>
                    <td><?php echo get_phrase('parent'); ?></td>
                    <?php
                    $date_year = date('Y');
                    $year = explode('-', $running_year);
                    $days = cal_days_in_month(CAL_GREGORIAN, $month, $date_year);

                    for ($i = 1; $i <= $days; $i++) {
                        $timestamp = ($date_year . '-' . $month . '-' . $i);
                        $get_name = date('l', strtotime($timestamp)); //get week day
                        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                        if ($day_name == 'Fri') {
                            ?>
                            <td style="text-align: center;"><?php echo $timestamp; ?></td>
                            <?php
                        }
                    }
                    ?>
                    <td align="center" style="width: 80px"><?php echo 'مجموعی' . '"حاضری"' ?></td>
                    <td align="center" style="width: 80px"><?php echo 'مجموعی' . '"غیرحاضری"' ?></td>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $students = $this->db->get_where('enroll', array('teacher_id' => $teacher_id, 'status' => 1, 'year' => $running_year,))->result_array();
                foreach ($students as $data) {
                    ?>
                    <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $data['student_id']))->row()->name; ?>
                        </td>
                        <td>
                            <?php echo $this->db->get_where('student', array('student_id' => $data['student_id']))->row()->father_name; ?>
                        </td>
                        <?php
                        $status = 0;
                        for ($i = 1; $i <= $days; $i++) {
                            $timestamp = ($date_year . '-' . $month . '-' . $i);
                            $get_name = date('l', strtotime($timestamp)); //get week day
                            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
                            if ($day_name == 'Fri') {
                                $attendance = $this->db->get_where('friday_attendance', array('teacher_id' => $teacher_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $data['student_id']))->result_array();


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
                            $current_att = $this->db->get_where('friday_attendance_count', array(
                                        'teacher_id' => $teacher_id,
                                        'student_id' => $data['student_id'],
                                        'year' => $running_year,
                                        'month' => $month,
                                    ))->row()->total_atd;

                            echo $current_att;
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            $current_att = $this->db->get_where('friday_attendance_count', array(
                                        'teacher_id' => $class_id,
                                        'student_id' => $data['student_id'],
                                        'year' => $running_year,
                                        'month' => $month,
                                    ))->row()->total_absent;

                            echo $current_att;
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>




