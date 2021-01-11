<html>
    <head>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <style>
            body{font-family: jameelnoori;}
            h4,h3{margin: 0px;}
        </style>
    </head>
    <body dir="rtl">
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $student_info = $this->newadmission_model->get_student_data($student_id);
//        $this->db->get_where('new_student', array(
//                    'new_student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
//                ))->result_array();
        foreach ($student_info as $row):
            $branch_id = $row->branch_id;
            ?>
            <table width="90%" align="center" >
                <tr>
                    <td colspan="2" align="center"><h3 style="font-size:26px"><?= 'تکمیل داخلہ' ?></h3></td>
                </tr>
                <tr>
                    <td rowspan="5" align="center" width="200">
                        <img src="<?php echo $this->crud_model->get_image_url('new_admission', $row->image); ?>" width="100" style="border-radius:50%"/>
                    </td>
                    <td style="padding-right:20px;">
                        <h3 ><?php echo $row->name ?></h3>
                        <h4><?php echo get_phrase('parent') . ':' . $row->father_name ?></h4>
                        <?php echo get_phrase('reg_no') . ' : ' . $row->reg_no ?>
                    </td>
                </tr>

            </table>
            <table style="width:95%; border-collapse:collapse;border: 1px solid black; margin-top: 10px; font-size: 16px;" border="1" dir="rtl" align="center">
                <tr>
                    <td><?php echo get_phrase('admission_date'); ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row->admission_date)); ?></td>

                    <td><?php echo get_phrase('admit_class'); ?></td>
                    <td><?php echo $this->db->get_where('class', array('class_id' => $row->class_id))->row()->name; ?></td>

                </tr>

                <tr>

                    <td><b><?php echo get_phrase('gender'); ?></b></td>
                    <td><?php echo $row->gender ?></td>
                    <td><b><?php echo get_phrase('dob'); ?></b></td>
                    <td><?php echo date("d-m-Y", strtotime($row->dob)); ?></td>

                </tr>


                <tr>

                    <td><b><?php echo 'سرپرست کا ' . get_phrase('phone'); ?></b></td>
                    <td><?php echo $row->phone ?></td>
                    <td><b><?php echo 'ولدیت شناختی کارڈ نمبر' ?></b></td>
                    <td><?php echo $row->father_nic ?></td>


                </tr>
                <tr>
                    <td><b><?php echo get_phrase('current_address'); ?></b></td>
                    <td colspan="3" ><?php echo $row->c_address ?>
                    </td>

                </tr>
                <tr>
                    <td><b><?php echo get_phrase('permanent_address'); ?></b></td>
                    <td colspan="3" ><?php echo $row->p_address ?>
                    </td>

                </tr>
                <tr>

                    <td><b><?php echo get_phrase('country'); ?></b></td>
                    <td><?php echo $this->db->get_where('country', array('country_id' => $row->country_id))->row()->name; ?></td>
                    <td><b><?php echo get_phrase('province'); ?></b></td>
                    <td><?php echo $this->db->get_where('province', array('prov_id' => $row->prov_id))->row()->name; ?></td>


                </tr>
                <tr>

                    <td><b><?php echo get_phrase('district'); ?></b></td>
                    <td><?php echo $this->db->get_where('district', array('dist_id' => $row->dist_id))->row()->name; ?></td>
                    <td><b><?php echo 'تعلیمی سال'; ?></b></td>
                    <td><?php echo $row->talimi_saal ?></td>


                </tr>
            </table>
            <?php
            $amount = $this->db->get_where('new_student_transaction', array('student_id' => $student_id))->row();
            if (!empty($amount)) {
                ?>

                <table style="width:85%; border-collapse:collapse;border: 1px solid black; margin-top: 10px; font-size: 16px;" border="1" dir="rtl" align="center">
                    <tr>
                        <td colspan="3" align="center">
                            <h3><?= 'اخراجات' ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td><?= 'ماہانہ' ?></td>
                        <td><?= 'وظیفہ' ?></td>
                        <td><?= 'ذاتی تعاون' ?></td>
                    </tr>
                    <tr>
                        <td><?= $monthly_fee = $this->db->get_where('monthly_fee', array('year' => $running_year, 'branch_id' => $row->branch_id))->row()->amount ?></td>
                        <?php
                        $tobe_paid = $this->db->get_where('new_student_fee', array('student_id' => $student_id))->row()->amount;
                        if ($tobe_paid < $monthly_fee) {
                            $fee = $monthly_fee - $tobe_paid;
                        } else {
                            $fee = 0;
                        }
                        ?>

                        <td><?= $fee ?></td>
                        <td><?= $this->db->get_where('new_student_fee', array('student_id' => $student_id))->row()->amount; ?></td>
                    </tr>
                </table>
            <?php } ?>
            <?php
            $transactions = $this->db->get_where('new_student_transaction', array('student_id' => $student_id))->result();
            if (!empty($transactions)) {
                ?>
                <table style="width:80%; text-align: center; border-collapse:collapse;border: 1px solid black; margin-top: 10px; font-size: 16px;" border="1" dir="rtl" align="center">
                    <tr>
                        <td colspan="3" align="center">
                            <h3><?= 'طالب علم ادا شدہ فیس' ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>#</td>
                        <td><?= 'مہینہ' ?></td>
                        <td><?= 'فیس' ?></td>
                    </tr>
                    <?php
                    $no2 = 1;
                    foreach ($transactions as $tran) {
                        ?>
                        <tr>
                            <td><?= $no2++ ?></td>
                            <td><?= $this->crud_model->get_month_name($tran->month) ?></td>
                            <td><?= $tran->amount ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

        <?php endforeach; ?>
    </body>
</html>

