<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
<link rel="stylesheet" href="assets/css/neon-forms.css">
<style>
    body{font-family:'Noto Nastaliq Urdu Draft', serif}
</style>
<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
$teacher_name = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
$branch = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
$r_year = explode('-', $running_year);
?>
<table width="95%" dir="rtl" align="center">
    <tr >
        <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
        <td align="center">
            <h3 style="font-weight: 100; margin-bottom: -25px;" dir="ltr"><?php echo $branch; ?></h3>
            <br>
            <?php echo 'تملیک زکواۃ فارم' ?>

        </td>
        <td width="25%">
            <?php if (is_numeric($teacher_id)) { ?>
                <u style="border-bottom:2px solid black;"><?php echo get_phrase('teacher') . ' : ' . ' ' . ' (' . $teacher_name . ')' ?></u>
                <br>
            <?php } ?>
            <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
        </td>
        <td width="5%">
            <span style="display:inline"> <img src="uploads/logo.png" height="80"/></span>
        </td>
    </tr>
</table>

<table width="100%" border="1" style="border-collapse: collapse; text-align: center; line-height: 2; font-size: 10px; font-weight: bold;" align="center" dir="rtl">
    <thead>
        <tr>
            <td><?php echo get_phrase('serial_no') ?></td>
            <td><?php echo get_phrase('name') ?></td>
            <td><?php echo get_phrase('parent') ?></td>
            <td><?php echo get_phrase('monthly') ?></td>
            <td><?php echo 'چارماہی' ?></td>
            <td><?php echo 'ذاتی تعاون' ?></td>
            <td><?php echo get_phrase('scholorship') ?></td>
            <!--<td><?php echo get_phrase('total'); ?></td>-->
            <td style="width:75px"><?php echo 'دستخط' ?></td>
            <td><?php echo 'چارماہی' . '۲' ?></td>
            <td><?php echo 'ذاتی تعاون' ?></td>
            <td><?php echo get_phrase('scholorship') ?></td>
            <!--<td><?php echo get_phrase('total'); ?></td>-->
            <td style="width:75px"><?php echo 'دستخط' ?></td>
            <td><?php echo 'چارماہی' . '۳' ?></td>
            <td><?php echo 'ذاتی تعاون' ?></td>
            <td><?php echo get_phrase('scholorship') ?></td>
            <!--<td><?php echo get_phrase('total'); ?></td>-->
            <td style="width:75px"><?php echo 'دستخط' ?></td>
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
<table width="40%" align="center" border="1" style="margin-top:20px; line-height: 2; text-align: center;" dir="rtl">
    <tr>
        <td colspan="2" align="center"><?php echo 'سالانہ مجموعی ریکارڈ' ?></td>
    </tr>
    <tr>
        <td width="40%"><?php echo 'مجموعی فیس' ?></td>
        <td><?php echo $month1_total * 3 ?></td>
    </tr>
    <tr>
        <td width="40%"><?php echo 'مجموعی وظیفہ' ?></td>
        <td><?php echo $insti_total_paid * 3 ?></td>
    </tr>
    <tr>
        <td width="40%"><?php echo 'مجموعی رقم' ?></td>
        <td><?php echo $std_month_total * 3 ?></td>
    </tr>
</table>

