<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;

$students = $this->db->get_where('enroll', array(
            'teacher_id' => $teacher_id,
            'status' => 1,
            'year' => $running_year
        ))->result_array();
?>
<table width="100%" align="center" style="text-align: center; line-height: 2.5; border: 2px dashed #3390c3;">
    <tr style="background-color: #47a4d8; color: white;">
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('parent'); ?></td>
        <td><?php echo get_phrase('select') ?></td>
        <td><?php echo get_phrase('name'); ?></td>
        <td><?php echo get_phrase('parent'); ?></td>
        <td><?php echo get_phrase('select') ?></td>
    </tr>
    <?php
    $i = 0;
    foreach ($students as $row) {
        $student_id = $row['student_id'];
        $studentName = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $parent_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->father_name;
        if ($i % 2 == 0) {
            ?>
            <tr>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $studentName ?> </td>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $parent_name ?> </td>
                <td style="border-left: dashed 1px #47a4d8"><input type="checkbox" class="check" name="student_id[]" value="<?php echo $student_id ?>"></td> 
                <?php
            } else {
                ?>

                <td style="border-left: dashed 1px #47a4d8"><?php echo $studentName ?> </td>
                <td style="border-left: dashed 1px #47a4d8"><?php echo $parent_name ?> </td>
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


<script>
    function select() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = true;
        }

        //alert('asasas');
    }
    function unselect() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = false;
        }
    }
</script>