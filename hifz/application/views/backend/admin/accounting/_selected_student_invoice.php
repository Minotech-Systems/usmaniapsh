
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
<style>
    body{font-family: 'Noto Nastaliq Urdu Draft', serif;}
    @media print
    {
        * {-webkit-print-color-adjust:exact;}
    }

</style>
<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$teacher = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
$section = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
$branch_id = $this->session->userdata('branch_id');
$branch = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;

foreach ($students as $std_data) {
    $no = 1;
    $studentName = $this->db->get_where('student', array('student_id' => $std_data))->row()->name;
    $parentName = $this->db->get_where('student', array('student_id' => $std_data))->row()->father_name;
    $sponsor_id = $this->db->get_where('student_fee', array('student_id' => $std_data, 'year' => $running_year))->row()->sponsor_id;
    if ($sponsor_id > 0) {
        $sponsor = $this->db->get_where('students_sponsor', array('sponsor_id' => $sponsor_id))->row()->name;
        $std_status = 'متکفل' . ' / ' . $sponsor;
    } else {
        $std_status = 'غیر متکفل';
    }
    for ($i = 1; $i < 3; $i++) {
        ?>
        <div style=" width:48%; background-color: #05987d24; padding: 10px; display: inline-block; <?php if ($i % 2 != 0) echo 'border-right: 2px dashed'; ?> ">
            <table width="100%" dir="rtl"  style="font-size:10px; line-height: 1.5;">
                <tr>
                    <td><?php echo $std_status; ?></td>
                    <td align="center"><img src="uploads/bismillah.png" style="max-height : 20px;"></td>
                    <td rowspan="2" align="left"><img src="uploads/logo.png" style="max-height : 60px;"></td>

                </tr>
                <tr>
                    <td><?php echo 'رسیدنمبر' . '.........................' ?></td>
                    <td align="center"><h4 dir="ltr"><?php echo $branch ?></h4></td>
                    <td></td>
                </tr>
                <tr>
                    <td><?php echo get_phrase('date') . ' : ' . '<span dir="ltr">' . date('d-m-Y') . '</span>'; ?></td>
                    <td align="center"><p><?php echo 'خیبرپختونخواپاکستان' ?></p></td>
                    <td align='left'><?= $running_year ?></td>
                </tr>
            </table>
            <table width="100%" border="1" dir="rtl" style="border-collapse:collapse;" >
                <tr>
                    <td width="40%">
                        <table style="font-size: 10px; padding-right: 20px; font-weight: bold;">
                            <tr>
                                <td><?php echo get_phrase('name') ?> :</td>
                                <td><?php echo $studentName; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('parent') ?> :</td>
                                <td><?php echo $parentName; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo get_phrase('teacher') ?> :</td>
                                <td><?php echo $teacher; ?></td>
                            </tr>

                        </table>
                    </td>
                    <td>
                        <table style="font-size: 10px; font-weight: bold" width="100%" align='center'>
                            <tr>
                                <td align="center" colspan="2"><u><?php echo 'فیس تفصیل' ?></u></td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo 'ماہانہ فیس' ?></td>
                                <td align="center"><?= $this->db->get_where('monthly_fee', array('branch_id' => $branch_id, 'year' => $running_year))->row()->amount; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo 'ماہانہ ذاتی تعاون' ?></td>
                                <td align="center"><?php echo $student_fee = $this->studentfee_model->get_student_feetobe_paid($std_data, $running_year) ?></td>
                            </tr>

                            <?php
                            $month_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id, 'year' => $running_year))->row()->amount;
                            if ($student_fee > $month_fee) {
                                ?>
                            <?php } else {
                                ?>
                                <tr>
                                    <td align="center"><?php echo ' ماہانہ تعاون ازادارہ' ?></td>
                                    <td align="center"><?php
                                        $month_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id, 'year' => $running_year))->row()->amount;
                                        echo $scholorship = ($month_fee - $student_fee)
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>


                        </table>
                    </td>
                    <td>
                        <table style="font-size: 10px; font-weight: bold" width="100%">
                            <tr>
                                <td align="center" colspan="2"><u><?php echo 'رسید وصولی ماہانہ اخراجات' ?></u></td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo get_phrase('month') ?></td>
                                <td align="center"><?php
                                    if ($month_id == 1) {
                                        echo $month_name;
                                    } else {
                                        echo $this->studentfee_model->get_month_name(1) . ' تا ' . $month_name;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo get_phrase('paid_amount') ?></td>
                                <td align="center">
                                    <?php
                                    $transac1 = $this->studentfee_model->sum_student_transaction($month_id, $std_data, $teacher_id);
                                    $transac2 = $this->studentfee_model->sum_additional_transaction($month_id, $std_data, $teacher_id);
                                    echo $paid = $transac1 + $transac2;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo get_phrase('remaining') ?></td>
                                <td align="center"><?php
                                    $paid_to = ($student_fee * $month_id);
                                    echo $paid_to - $paid;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table width="100%" dir="rtl" style="font-size: 10px;">
                <tr>
                    <td ><div style="font-size: 12px; font-weight: bold;  color: black; width: 60%; padding-right:10px"><?php echo 'اکاونٹ نمبر' . '<span style="font-family:cursive;">' . ': 0-0100716' . '</span>' . '&nbsp; UBL  &nbsp;' . '<br>' . 'برانچ کوڈ' . '<span style="font-family:cursive;">' . ' : 1571' . '</span> &nbsp;' . 'سنہری مسجدروڈپشاور صدر' ?></div></td>
                    <td width="40%" align="left"><?php echo 'دستخط مسئول' . ':..........................' ?></td>
                </tr>
            </table>

        </div>
    <?php } ?>

    <?php
    if ($no % 2 == 0) {
        echo '<span class="pagebreak"></span>';
    }
    $no++;
}
?>

