<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
$r_year = explode('-', $running_year);
$check_list = $data['check_list'];
?>
<link rel="stylesheet" href="assets/fonts/jameel/font.css">
<style type="text/css">
    @media print
    {
        * {-webkit-print-color-adjust:exact;}
        .pagebreak{page-break-after: always;display: block;}
    }

    body{font-family: jameelnoori;}
</style>
<table width="95%" dir="rtl" align="center" style="line-height:1">
    <tr>
        <td>
            <image src="uploads/header.png" width="180" />
            <?php
            if ($teacher_id != 'all') {
                echo $this->crud_model->get_type_name_by_id('teacher', $teacher_id);
            }
            ?>
        </td>
        <td align='center'><h2 style="font-family: sans-serif"><?= 'فھرست حفاظ کرام' ?></h2></td>
        <td align='left'><?= 'سال' . ' : ' . $r_year[1] . '-' . $r_year[0] . 'ھ' ?></td>
    </tr>
    <tr>
        <td width='25%'>
            
            <?= get_phrase('talimi_saal') . ' : ' . $talimi_saal ?>
        </td>
        <td align="center" dir="ltr">
            <h3 style="font-weight: 600; margin: 0px;">
                <?php echo $this->crud_model->get_column_name_by_id('branches', 'branch_id', $login_branch); ?>
            </h3>
        </td>
        <td align='left'>
            <?= get_phrase('total_count') . ' : ' . $total_students ?>
        </td>

    </tr>
</table>
<table style="width:100%; border-collapse:collapse;border: 1px solid black; margin-top: 10px; font-size: 16px; text-align: center;" border="1" dir="rtl">

    <thead style="background-color: black; color: white; font-size: 11px; font-weight: bold">
        <tr>
            <td style="width:4%"><?php echo get_phrase('serial_no') ?></td>
            <?php
            if ($check_list['exam_roll'] != '') {
                echo "<td style='width:5%'>" . 'رول نمبر' . "</td>";
            }
            if ($check_list['reg_no'] != '') {
                echo "<td style='width:7%'>" . get_phrase('reg_no') . "</td>";
            }
            if ($check_list['roll'] != '') {
                echo "<td style='width:5%'> Enroll </td>";
            }
            if ($check_list['name'] != '') {
                echo "<td style='width:10%'>" . get_phrase('name') . "</td>";
            }
            if ($check_list['father'] != '') {
                echo "<td style='width:10%'>" . get_phrase('parent') . "</td>";
            }
            if ($check_list['dob'] != '') {
                echo "<td style='width:10%'>" . get_phrase('dob') . " </td>";
            }
            if ($check_list['phone'] != '') {
                echo "<td style='width:10%'>" . get_phrase('phone') . "</td>";
            }
            if ($check_list['c_address'] != '') {
                echo "<td style='width:21%'>" . get_phrase('current_address') . "</td>";
            }
            if ($check_list['p_address'] != '') {
                echo "<td style='width:21%'>" . get_phrase('permanent_address') . "</td>";
            }
            if ($check_list['admission_date'] != '') {
                echo "<td style='width:10%'> " . get_phrase('admission_date') . " </td>";
            }
            if ($check_list['father_nic'] != '') {
                echo "<td style='width:10%'> " . get_phrase('father_nic') . " </td>";
            }
            if ($check_list['dist'] != '') {
                echo "<td style='width:10%'> " . get_phrase('district') . " </td>";
            }
            if ($check_list['prov'] != '') {
                echo "<td style='width:10%'> " . get_phrase('province') . " </td>";
            }
            if ($check_list['test_marks'] != '') {
                echo "<td style='width:10%'> " . get_phrase('test_marks') . " </td>";
            }
            if ($check_list['parent_login'] != '') {
                echo "<td style='width:10%'> " . get_phrase('parent_login') . " </td>";
            }
            
            ?>
            <?php
            for ($i = 1; $i <= $number_column; $i++) {
                echo "<td>   </td>";
            }
            ?> 
        </tr>

    </thead>
    <?php
    $sr = 1;

    foreach ($students as $row):
        ?>

        <tr>        
            <td><?php echo $sr++; ?></td>
            <?php
            if ($check_list['exam_roll'] != '') {
                echo "<td>" . $this->db->get_where('exam_roll_number', array('student_id' => $row['student_id'], 'session' => $running_year, 'class_id' => $class_id))->row()->roll_no . "</td>";
            }
            if ($check_list['reg_no'] != '') {
                echo "<td dir='ltr' style='text-align:center;'>" . $row->reg_no . "</td>";
            }
            if ($check_list['roll'] != '') {
                echo "<td>" . $row->roll_num . "</td>";
            }

            if ($check_list['name'] != '') {
                echo "<td>" . $row->name . " </td>";
            }
            if ($check_list['father'] != '') {

                echo "<td>" . $row->father_name . "</td>";
            }
            if ($check_list['dob'] != '') {
                echo "<td>" . date('d-m-Y', strtotime($row->dob)) . "</td>";
            }
            if ($check_list['phone'] != '') {
                echo "<td>" . $row->phone . "</td>";
            }
            if ($check_list['c_address'] != '') {
                echo "<td>" . $row->c_address . "</td>";
            }
            if ($check_list['p_address'] != '') {
                echo "<td>" . $row->p_address . "</td>";
            }

            if ($check_list['admission_date'] != '') {
                echo "<td>" . date('d-m-Y', strtotime($row->admission_date)) . "</td>";
            }
            if ($check_list['father_nic'] != '') {
                echo "<td>" . $row->father_nic . "</td>";
            }
            if ($check_list['dist'] != '') {
                echo "<td>" . $this->crud_model->get_column_name_by_id('district', 'dist_id', $row->dist_id) . "</td>";
            }
            if ($check_list['prov'] != '') {
                echo "<td>" . $this->crud_model->get_column_name_by_id('province', 'prov_id', $row->prov_id) . "</td>";
            }
            if ($check_list['test_marks'] != '') {
                echo "<td>" . $row->test_marks . "</td>";
            }
            if ($check_list['parent_login'] != '') {
                echo "<td>" . 'H'.$row->student_id.'-'. $row->reg_no . "</td>";
            }
            ?>


            <?php
            for ($i = 1; $i <= $number_column; $i++) {
                echo "<td>  </td>";
            }
            ?>
        </tr>
        <?php
    endforeach;
    ?>
</table>