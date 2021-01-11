<?php
    $this->db->order_by('sponsor_id','ASC');
    $fee_data = $this->studentfee_model->branch_kafalat_list($login_user_branch, $running_year);

?>
<div class="row">
    <div class="col-md-9 col-md-offset-2">
        <a href="<?php echo base_url(); ?>index.php?student_fee/beneficiary_report_print/" target="_blank" class="btn btn-success btn-icon icon-left hidden-print pull-right">
            <?php echo 'پرنٹ ریکارڈ' ?>
            <i class="entypo-print" style="background-color:#2191bf"></i>
        </a>
    </div>
</div>
<div class="row">

    <center>
        <h3><?php
            if ($login_user_level == 0) {
                echo $system_name;
            } else {
                echo $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row()->name;
            }
            ?></h3>
    </center>
</div>
<table width="90%" border="1" align="center" style="text-align: center; line-height: 2.5">
    <tr style="background-color: #03b2e7; color: white;">
        <td><?php echo get_phrase('serial_no');?></td>
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('parent') ?></td>
        <td><?php echo get_phrase('address')?></td>
        <td><?php echo get_phrase('class') ?></td>
        <td><?php echo get_phrase('sponsor_name') ?></td>
        <td><?php echo get_phrase('sponsor_monthly_help') ?></td>
    </tr>
    <?php $no =1;
    
    foreach ($fee_data as $data) {
        $class = $this->db->get_where('class', array('class_id' => $data['class_id']))->row()->name;
        $section = $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name;
        $sponsor = $this->db->get_where('students_sponsor', array('sponsor_id' => $data['sponsor_id']))->row()->name;
        $sponsor_help = $this->db->get_where('sponsor_help', array('sponsor_id' => $data['sponsor_id'], 'student_id' => $data['student_id'], 'year' => $running_year))->row()->amount;
        ?>
        <tr>
            <td><?php echo $no++;?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $this->db->get_where('parent', array('parent_id' => $data['parent_id']))->row()->name; ?></td>
            <td><?php echo $data['c_address']?></td>
            <td><?php echo $class . '(' . $section . ')'; ?></td>
            <td><?php echo $sponsor ?></td>
            <td><?php echo $sponsor_help; ?></td>
        </tr>
<?php } ?>
</table>

