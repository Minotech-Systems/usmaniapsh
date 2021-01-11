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

$this->db->order_by('sponsor_id', 'ASC');
$fee_data = $this->studentfee_model->branch_kafalat_list($login_user_branch, $running_year);
?>

<table width="95%" dir="rtl" align="center">
    <tr >
        <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
        <td align="center">
            <h3><?php
echo 'کفالت سکیم' . ' ';
if ($login_user_level == 0) {
    echo $system_name;
} else {
    echo $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row()->name;
}
?></h3>

        </td>
        <td width="25%">
            <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
        </td>
        <td width="7%">
            <span style="display:inline"> <image src="uploads/logo.png" height="80"/></span>
        </td>
    </tr>
</table>
<table width="90%" border="1" align="center" style="text-align: center; line-height: 2.5; font-size: 12px; font-weight: bold;" dir="rtl">
    <tr style="background-color: #03b2e7; color: white;">
        <td><?php echo get_phrase('serial_no'); ?></td>
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('parent') ?></td>
        <td><?php echo get_phrase('address') ?></td>
        <td><?php echo get_phrase('class') ?></td>
        <td><?php echo get_phrase('sponsor_name') ?></td>
        <td><?php echo get_phrase('sponsor_monthly_help') ?></td>
    </tr>
    <?php
    $no = 1;
    foreach ($fee_data as $data) {
        $class = $this->db->get_where('class', array('class_id' => $data['class_id']))->row()->name;
        $section = $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name;
        $sponsor = $this->db->get_where('students_sponsor', array('sponsor_id' => $data['sponsor_id']))->row()->name;
        $sponsor_help = $this->db->get_where('sponsor_help', array('sponsor_id' => $data['sponsor_id'], 'student_id' => $data['student_id'], 'year' => $running_year))->row()->amount;
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $this->db->get_where('parent', array('parent_id' => $data['parent_id']))->row()->name; ?></td>
            <td><?php echo $data['c_address'] ?></td>
            <td><?php echo $class . '(' . $section . ')'; ?></td>
            <td><?php echo $sponsor ?></td>
            <td><?php echo $sponsor_help; ?></td>
        </tr>
    <?php } ?>
</table>