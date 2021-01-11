<html>
    <head>
        <title><?= 'جامعہ رپورٹ' ?></title>
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
        <style>
            body{font-family:'Noto Nastaliq Urdu Draft', serif;  font-size: 12px;}
            table{font-size: 12px; line-height: 2}
            #right-left-white{
                border-right: 1px solid white;
                border-left: 1px solid white;
            }
            #inner_tabel tr td:first-child {
                border-top: 1px solid white;
                border-bottom: 1px solid black;
            }

        </style>
    </head>
    <body>
        <?php
        $branch_data = $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row();
        $branch_monthly_fee = $this->db->get_where('monthly_fee', array('year' => $running_year, 'branch_id' => $login_user_branch))->row()->amount;
        ?>
        <table align="center" border="1" style="border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 2; margin-top: 30px;" width="90%" dir="rtl">
            <tr style="background: #1485b154;">
                <td colspan="8">
                    <?php
                    echo 'تملیک وذاتی تعاون رپورٹ ' . '۔۔۔۔۔۔۔ ' .
                    $this->studentfee_model->get_month_name($months[0]) . ' - ' . $this->studentfee_model->get_month_name(end($months)) .
                    '۔۔۔۔۔۔۔ ' . 'تحفیظ القران ' . ' <span dir="ltr">' . $branch_data->name . '</span>';
                    ?>
                </td>
            </tr>
            <tr>
                <td><?= 'نمبر شمار' ?></td>
                <td><?= 'معلم' ?></td>
                <td><?= 'ازادارہ رقم' ?></td>
                <td><?= 'تملیک شدہ رقم' ?></td>
                <td><?= 'بقایا رقم' ?></td>
                <td><?= 'ذاتی تعاون' ?></td>
                <td><?= 'اداہ شدہ رقم' ?></td>
                <td><?= 'بقایا رقم' ?></td>
            </tr>
            <?php
            $first_month = $months[0];
            $last_month = end($months);
            $no = 1;
            $teachers = $this->db->get_where('teacher', array('branch_id' => $login_user_branch, 'status' => 1))->result();
            foreach ($teachers as $teac) {
                ?>
                <tr>
                    <td rowspan="" style="width: 7.785%;"><?= $no++; ?></td>
                    <td rowspan="" style="width: 6.514%;"><?= $teac->name ?></td>
                    <td width="9%">
                        <?php
                        $total_students = count($this->studentfee_model->get_students_fee($teac->teacher_id, $running_year));
                        $total_class_fee = $total_students * $branch_monthly_fee;
                        $total_class_student_fee = $this->studentfee_model->student_fee_according_intstiute($teac->teacher_id, $running_year);
                        echo $az_edara = ($total_class_fee - $total_class_student_fee) * $last_month;
                        $total_az_edara1 += $az_edara;
                        ?>
                    </td>
                    <td width="9%">
                        <?php
                        $where1 = array();
                        $where1['teacher_id'] = $teac->teacher_id;
                        $where1['year'] = $running_year;
                        $institute_paid_fee = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where1, 'amount', $first_month . '-' . $last_month);
                        if ($institute_paid_fee > 0) {
                            echo $institute_paid_fee;
                        } else {
                            echo '0';
                        }
                        $total_tamleek_raqam += $institute_paid_fee;
                        ?>
                    </td>
                    <td width="9%">
                        <?php
                        echo $tmaleek_remain = $az_edara - $institute_paid_fee;
                        $total_tmaleek_remaine += $tmaleek_remain;
                        ?>
                    </td>
                    <!--.-->
                    <td width="8%">
                        <?php
                        $total_class_student_fee1 = $this->studentfee_model->student_fee_join($teac->teacher_id, $running_year);
                        echo $total_class_student_fee = $total_class_student_fee1 * $last_month;
                        $tamam_zati_tawoon += $total_class_student_fee;
                        ?>
                    </td>
                    <td width="8%">
                        <?php
                        $student_paided = $this->studentfee_model->get_class_student_transaction_sum($teac->teacher_id, $running_year, $first_month . '-' . $last_month);
                        $additional_student_fee = $this->studentfee_model->student_aditional_transaction($teac->teacher_id, $running_year, $first_month . '-' . $last_month);
                        $student_paided_fee = $student_paided + $additional_student_fee;
                        if ($student_paided_fee > 0) {
                            echo $student_paided_fee;
                        } else {
                            echo '0';
                        }
                        $tamam_add_zati_tawoon += $student_paided_fee;
                        ?> 
                    </td>
                    <td width="8%">
                        <?php
                        echo $total_class_student_remain = $total_class_student_fee - $student_paided_fee;
                        $tamam_baqayea_zati_tawoon += $total_class_student_remain;
                        ?>
                    </td>
                </tr>

            <?php } ?>
            <tr>
                <td colspan="2"><?= 'ٹوٹل' ?></td>
                <td><?= $total_az_edara1 ?></td>
                <td><?= $total_tamleek_raqam ?></td>
                <td><?= $total_tmaleek_remaine ?></td>
                <td><?= $tamam_zati_tawoon ?></td>
                <td><?= $tamam_add_zati_tawoon ?></td>
                <td><?= $tamam_baqayea_zati_tawoon ?></td>
            </tr>
        </table>
    </body>
</html>