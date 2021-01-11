<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
<link rel="stylesheet" href="assets/css/neon-forms.css">
<style>
    body{font-family:'Noto Nastaliq Urdu Draft', serif}
</style>
<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
$r_year = explode('-', $running_year);

?>

<table width="95%" dir="rtl" align="center">
    <tr >
        <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
        <td align="center">
            <h3><?php  echo 'کفالت سکیم'.' <span dir="ltr">'.$this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name.'</span>'?></h3>

        </td>
        <td width="25%">
            <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
        </td>
        <td width="7%">
            <span style="display:inline"> <image src="uploads/logo.png" height="80"/></span>
        </td>
    </tr>
</table>
 <table width="90%" border="1" dir="rtl" align="center" style="text-align: center; line-height: 2; font-size: 12px; font-weight: bold;">
        <thead>
            <tr style="background-color: #03b2e7; line-height: 3; color: white;">
                <td><?php echo get_phrase('serial_no') ?></td>
                <td><?php echo get_phrase('name') ?></td>
                <td><?php echo get_phrase('parent') ?></td>
                <td><?php echo get_phrase('class')?></td>
                <td><?php echo get_phrase('monthly_fee'); ?></td>
                <td><?php echo get_phrase('sponsor') ?></td>
                <?php for ($i = 1; $i <= $month; $i++) { ?>
                    <td><?php echo $this->studentfee_model->get_month_name($i); ?></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $students = $this->studentfee_model->branch_kafalat_list($branch_id, $running_year);
            foreach ($students as $data) {
                $parent = $data['father_name'];
                $class = $this->db->get_where('class', array('class_id' => $data['class_id']))->row()->name;
                $section = $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name;
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $parent ?></td>
                    <td><?php echo $class.'('.$section.')'?></td>
                    <td><?php echo $data['amount'] ?></td>
                    <td><?php echo $this->db->get_where('students_sponsor', array('sponsor_id' => $data['sponsor_id']))->row()->name; ?></td>
                    <?php for ($i = 1; $i <= $month; $i++) { ?>
                        <td><?php
                            if ($this->studentfee_model->check_student_fee_month($data['student_id'], $i, $running_year) != 0) {
                                echo '&#10004';
                            } else {
                                echo '&#10006';
                            }
                            ?></td>
                        <?php } ?>
                </tr>
                <?php $total_fee += $data['amount'];
            } ?>
            <tr>
                <td colspan="4"><?php echo 'مجموعی ریکارڈ' ?></td>
                <td><?php echo $total_fee; ?></td>
                <td colspan="13"></td>
            </tr>
        </tbody>
    </table>