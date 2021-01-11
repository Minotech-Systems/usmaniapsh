<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;

if ($teacher_id == 'all') {
    $students = $this->db->get_where('enroll', array(
                'status' => 1,
                'year' => $running_year,
                'branch_id' => $branch_id
            ))->result_array();
} else {
    $students = $this->db->get_where('enroll', array(
                'status' => 1,
                'year' => $running_year,
                'branch_id' => $branch_id,
                'teacher_id' => $teacher_id
            ))->result_array();
}
?>
<table width="100%" align="center" style="text-align: center; line-height: 2.5; border: 2px dashed #3390c3;">
    <tr style="background-color: #47a4d8; color: white;">
        <td>#</td>
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('parent'); ?></td>
        <td><?php echo get_phrase('select') ?></td>
        <td>#</td>
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('parent'); ?></td>
        <td><?php echo get_phrase('select') ?></td>
    </tr>
    <?php
    $i = 0;
    $no =1;
    foreach ($students as $row) {
        $student_id = $row['student_id'];
        $studentName = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $FaherName = $this->db->get_where('student', array('student_id' => $student_id))->row()->father_name;
        if ($i % 2 == 0) {
            ?>
            <tr>
                <td><?= $no?></td>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $studentName ?> </td>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $FaherName ?> </td>
                <td style="border-left: dashed 1px #47a4d8"><input type="checkbox" class="check" name="student_id[]" value="<?php echo $student_id ?>"></td> 
                <?php
            } else {
                ?>
                <td><?= $no?></td>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $studentName ?> </td> 
                <td style="border-left: dashed 1px #47a4d8"><?php echo $FaherName ?> </td>
                <td><input type="checkbox" class="check" name="student_id[]" value="<?php echo $student_id ?>"></td>

                <?php
            } $i++; $no++;
        }
        ?>
</table>
<table width="80%" align="center" style="margin-top: 20px; text-align: center;">
    <tr>
        <td><button type="button" class="btn btn-success" onClick="select()"> <?php echo get_phrase('select_all') ?></button></td>
        <td><button type="button" class="btn btn-success" onClick="unselect()"><?php echo get_phrase('کوئی بھی منتخب نہ کریں') ?></button></td>
    </tr>
</table>


