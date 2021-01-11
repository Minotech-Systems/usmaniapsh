<?php $student_data = $this->db->get_where('student', array('student_id' => $student_id))->row();
$month_name = $this->crud_model->get_georg_month($month);?>
<div class="row">
    <div class="col-m-12">
        <center>
            <h4><?= 'ماہانہ رپورٹ حافظ' .' : ' ?><?= $student_data->name . ' | ' . ' ولدیت'.' ' . $student_data->father_name.' | '.'ماہ'.' '.$month_name ?></h4>
        </center>
    </div>
</div>
<div class="row" style="text-align: center">
    <a class="btn btn-success" href="<?= base_url('index.php?exam/print_daily_report/' . $teacher_id . '/' . $student_id . '/' . $month) ?>" target="blank">
        <i class="fa fa-print"></i>
        <?= 'پرنٹ ریکارڈ' ?>
    </a>
</div>
<?php $year = date('Y'); ?>
<div class="row">
    <table width="100%" align="center" border="1" style="border:1px solid black; border-collapse: collapse; text-align: center; font-size: 11px;line-height: 2">

        <tr>
            <td width="60"><?= 'مادہ' ?></td>
            <?php for ($i = 1; $i <= 8; $i++) { ?>
                <td width="11%"><?= $i ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبق' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                ?>
                <td><?= $leason_a ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبق' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                ?>
                <td><?= $leason_a_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                ?>
                <td><?= $leason_a_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبقی' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                ?>
                <td><?= $leason_b ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبقی' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                ?>
                <td><?= $leason_b_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                ?>
                <td><?= $leason_b_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' منزل' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                ?>
                <td><?= $leason_c ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار منزل' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                ?>
                <td><?= $leason_c_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                ?>
                <td><?= $leason_c_state ?></td>
            <?php } ?>
        </tr>
    </table>
    <!--.-->
    <table width="100%" align="center" border="1" style="border:1px solid black; border-collapse: collapse; text-align: center; font-size: 11px;line-height: 2">

        <tr>
            <td width="60"><?= 'مادہ' ?></td>
            <?php for ($i = 9; $i <= 16; $i++) { ?>
                <td width="11%"><?= $i ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبق' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                ?>
                <td><?= $leason_a ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبق' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                ?>
                <td><?= $leason_a_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                ?>
                <td><?= $leason_a_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبقی' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                ?>
                <td><?= $leason_b ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبقی' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                ?>
                <td><?= $leason_b_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                ?>
                <td><?= $leason_b_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' منزل' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                ?>
                <td><?= $leason_c ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار منزل' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                ?>
                <td><?= $leason_c_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 9; $i <= 16; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                ?>
                <td><?= $leason_c_state ?></td>
            <?php } ?>
        </tr>
    </table>
    <!--.-->
    <table width="100%" align="center" border="1" style="border:1px solid black; border-collapse: collapse; text-align: center; font-size: 11px;line-height: 2">

        <tr>
            <td width="60"><?= 'مادہ' ?></td>
            <?php for ($i = 17; $i <= 24; $i++) { ?>
                <td width="11%"><?= $i ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبق' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                ?>
                <td><?= $leason_a ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبق' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                ?>
                <td><?= $leason_a_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                ?>
                <td><?= $leason_a_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبقی' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                ?>
                <td><?= $leason_b ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبقی' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                ?>
                <td><?= $leason_b_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                ?>
                <td><?= $leason_b_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' منزل' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                ?>
                <td><?= $leason_c ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار منزل' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                ?>
                <td><?= $leason_c_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 17; $i <= 24; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                ?>
                <td><?= $leason_c_state ?></td>
            <?php } ?>
        </tr>
    </table>
    <!--.-->
    <table width="100%" align="center" border="1" style="border:1px solid black; border-collapse: collapse; text-align: center; font-size: 11px;line-height: 2">

        <tr>
            <td width="60"><?= 'مادہ' ?></td>
            <?php for ($i = 25; $i <= 31; $i++) { ?>
                <td width="11%"><?= $i ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبق' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a;
                ?>
                <td><?= $leason_a ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبق' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_quantity;
                ?>
                <td><?= $leason_a_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_a_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_a_state;
                ?>
                <td><?= $leason_a_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' سبقی' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b;
                ?>
                <td><?= $leason_b ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار سبقی' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_quantity;
                ?>
                <td><?= $leason_b_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_b_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_b_state;
                ?>
                <td><?= $leason_b_state ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= ' منزل' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c;
                ?>
                <td><?= $leason_c ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'مقدار منزل' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_quantity = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_quantity;
                ?>
                <td><?= $leason_c_quantity ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= 'کیفیت' ?></td>
            <?php
            for ($i = 25; $i <= 31; $i++) {
                $timestamp = ($year . '-' . $month . '-' . $i);
                $leason_c_state = $this->db->get_where('daily_student_report', array('student_id' => $student_id, 'date' => $timestamp))->row()->lesson_c_state;
                ?>
                <td><?= $leason_c_state ?></td>
            <?php } ?>
        </tr>
    </table>
</div>