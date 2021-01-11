<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;

$students = $this->db->get_where('new_enroll', array(
            'branch_id' => $branch_id,
            'enroll_status' => 0,
            'year' => $running_year
        ))->result_array();
?>
<table width="100%" align="center" style="text-align: center; line-height: 2.5; border: 2px dashed #3390c3;">
    <tr style="background-color: #47a4d8; color: white;">
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('select') ?></td>
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('select') ?></td>
    </tr>
    <?php
    $i = 0;
    foreach ($students as $row) {
        $student_id = $row['student_id'];
        $studentName = $this->db->get_where('new_student', array('student_id' => $student_id))->row()->name;
        if ($i % 2 == 0) {
            ?>
            <tr>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $studentName ?> </td> 
                <td style="border-left: dashed 1px #47a4d8"><input type="checkbox" class="check" name="student_id[]" value="<?php echo $student_id ?>"></td> 
                <?php
            } else {
                ?>

                <td style="border-left: dashed 1px #47a4d8"><?php echo $studentName ?> </td> 
                <td><input type="checkbox" class="check" name="student_id[]" value="<?php echo $student_id ?>"></td>

                <?php
            } $i++;
        }
        ?>
</table>
<table width="80%" align="center" style="margin-top: 20px; text-align: center;">
    <tr>
        <td><button type="button" class="btn btn-success" onClick="select()"> <?php echo get_phrase('select_all') ?></button></td>
        <td><button type="button" class="btn btn-success" onClick="unselect()"><?php echo get_phrase('کوئی بھی منتخب نہ کریں') ?></button></td>
    </tr>
</table>


