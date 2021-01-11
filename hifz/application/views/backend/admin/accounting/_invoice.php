<html>
    <head>
        <title><?= 'فیس رسید' ?></title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
        <style>
            body{font-family: 'Noto Nastaliq Urdu Draft';}
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                #color{background: #eee !important}
            }
            #data_table span{ font-weight: bold; font-family: 'Noto Nastaliq Urdu Draft'}
            #data_table td{padding-left: 10px; padding-right: 10px;}

            h4{font-size: 12px !important}

        </style>
    </head>
    <body>
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $student_data = $this->db->get_where('student', array('student_id' => $student_id))->row();
        $studentName = $student_data->name;
        $teacher = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
        $branch = $this->db->get_where('branches', array('branch_id' => $this->session->userdata('branch_id')))->row()->name;
        $sponsor_id = $this->db->get_where('student_fee', array('student_id' => $student_id, 'year' => $running_year))->row()->sponsor_id;
        $responsible = $this->db->get_where('responsible', array('branch_id' => $this->session->userdata('branch_id')))->row();

        $responsible_data = $this->db->get_where('teacher', array('teacher_id' => $responsible->teacher_id))->row();
        if ($sponsor_id > 0) {
            $sponsor = $this->db->get_where('students_sponsor', array('sponsor_id' => $sponsor_id))->row()->name;
            $std_status = 'متکفل' . ' / ' . $sponsor;
        } else {
            $std_status = 'غیر متکفل';
        }
//for ($i = 1; $i < 3; $i++) {
        ?>
        <div class="panel panel-primary" style="font-size:12px;">
            <div class="panel-body">
                <div class="row">
                    <?php for ($i = 1; $i < 4; $i++) { ?>

                        <div class="col-xs-4" <?php
                        if ($i != 3) {
                            echo 'style="border-right: 1px dashed"';
                        }
                        ?>>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <img src="uploads/logo.png" style="max-height : 80px;">
                                    </td>
                                    <td align="center">
                                        <h3 style="margin: 0px;
                                            font-size: 16px;
                                            font-weight: bold;"><?php echo $branch; ?></h3>
                                        <p style="margin: 0px"> <?= 'پوسٹ بکس 1209 نوتھیہ روڈ پشاور' ?></p>
                                        <p style="margin: 0px">Phone: 091-5240422 Mob: <?= $responsible_data->phone ?>  </p>
                                        <p style="margin: 0px; width: 50%; border:1px solid black;">
                                            <?php
                                            if ($i == 1) {
                                                echo 'کاپی برائے طالبعلم';
                                            } else if ($i == 2) {
                                                echo 'کاپی برائے مسئول';
                                            } else {
                                                echo 'کاپی برائے دفتر مالیات';
                                            }
                                            ?></p>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%"  dir="rtl" style=" line-height: 2.3; border: 1px solid #dadada; border-collapse: collapse; margin-top: 20px; font-size: 10px;" border="1" id="data_table">
                                <tr>
                                    <td><?= 'رسید نمبر:' ?><span><?= $student_id; ?></span></td>
                                    <td><?= 'رجسٹریشن نمبر:' ?><span><?= $student_data->reg_no; ?></span></td>
                                </tr>
                                <tr>
                                    <td><?= 'نام طالب علم:' ?></td>
                                    <td style="font-weight:bold"><?= $studentName ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'ولدیت:' ?></td>
                                    <td style="font-weight:bold"><?= $student_data->father_name ?></td>
                                </tr>
                                <tr>
                                    <td><?= 'معلم:' ?><span><?= $teacher ?></span></td>
                                    <td><?= 'کلاس:' ?><span><?= 'تحفیظ القران ' ?></span></td>
                                </tr>
                                <tr style="font-size:14px; font-weight: bold">
                                    <td><?= 'تاریخ اجراء : ' ?> <span><?= date('d-m-Y') ?></span></td>
                                    <td><?= 'آخری تاریخ :' ?><span style="font-size:12px"><?= date('d-m-Y', strtotime($due_date)) ?></span></td>
                                </tr>
                                <tr style="background: #eee;
                                    font-weight: bold;" id="color">
                                    <td colspan="2" align="center">
                                        <?= 'فیس تفصیل ' ?>
                                        <?php
                                        if (count($months) < 1) {
                                            echo $this->studentfee_model->get_month_name($months[0]);
                                        } else {
                                            echo $this->studentfee_model->get_month_name($months[0]) . ' تا ' . $this->studentfee_model->get_month_name(end($months));
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" dir="rtl" >
                                <tr>
                                    <td>
                                        <table style="text-align: center;line-height: 2;font-size: 10px; font-weight: bold; border: 1px solid black; border-collapse: collapse" border="1" width="100%" align='center'>
                                            <tr>
                                                <td align="center"><?php echo 'ماہانہ فیس' ?></td>
                                                <td align="center"><?= $monthly_fee = $this->db->get_where('monthly_fee', array('branch_id' => $this->session->userdata('branch_id'), 'year' => $running_year))->row()->amount; ?>
                                                </td>
                                                <td><?= 'تفصیل' ?></td>
                                                <td><?= 'ٹوٹل رقم' ?></td>
                                                <td align="center"><?php echo 'بقایا گزشتہ' ?></td>
                                                <td><?= 'دستخط طالبعلم' ?></td>
                                            </tr>
                                            <tr>
                                                <td align="center"><?php echo 'ماہانہ ذاتی تعاون' ?></td>
                                                <td align="center"><?php echo $student_fee = $this->studentfee_model->get_student_feetobe_paid($student_id, $running_year) ?></td>
                                                <td>
                                                    <?php
                                                    $total_month = count($months);
                                                    $total_student_fee = $total_month * $student_fee;
                                                    echo $student_fee . 'x' . $total_month;
                                                    ?>
                                                </td>
                                                <td><?= $total_student_fee ?></td>
                                                <td>
                                                    <?php
                                                    $where1 = array();
                                                    $where1['student_id'] = $student_id;
                                                    $where1['year'] = $running_year;

                                                    if ($months[0] == 5) {
                                                        $four_month_fee = $student_fee * 4;
                                                        $w_months = '1-4';
                                                        $paid_month = $this->studentfee_model->get_transactions_sum('student_transaction', $where1, 'amount', $w_months);
                                                        echo ($four_month_fee - $paid_month);
                                                    } elseif ($months[0] == 9) {
                                                        $eight_month_fee = $student_fee * 8;
                                                        $w_months = '1-8';
                                                        $paid_month = $this->studentfee_model->get_transactions_sum('student_transaction', $where1, 'amount', $w_months);
                                                        echo ($eight_month_fee - $paid_month);
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </td>
                                                <td rowspan="2" style="border-right:dashed 1px;">

                                                </td>
                                            </tr>
                                            <?php
                                            $month_fee = $this->db->get_where('monthly_fee', array('branch_id' => $this->session->userdata('branch_id'), 'year' => $running_year))->row()->amount;
                                            if ($student_fee > $month_fee) {
                                                ?>
                                            <?php } else {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo ' ماہانہ تعاون ازادارہ' ?></td>
                                                    <td align="center"><?php
                                                        $month_fee = $this->db->get_where('monthly_fee', array('branch_id' => $this->session->userdata('branch_id'), 'year' => $running_year))->row()->amount;
                                                        echo $scholorship = ($month_fee - $student_fee)
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $total_scholorship = $total_month * $scholorship;
                                                        echo $scholorship . 'x' . $total_month;
                                                        ?>
                                                    </td>
                                                    <td><?= $total_scholorship; ?></td>
                                                    <td align="center" rowspan="2"><?php
                                                        $where2 = array();
                                                        $where2['student_id'] = $student_id;
                                                        $where2['teacher_id'] = $teacher_id;
                                                        $where2['year'] = $running_year;
                                                        if ($months[0] == 5) {
                                                            $four_month_scholorship = $scholorship * 4;
                                                            $w_months = '1-4';
                                                            $paid_scholorship = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where2, 'amount', $w_months);
                                                            echo $four_month_scholorship - $paid_scholorship;
                                                        } elseif ($months[0] == 9) {
                                                            $eight_month_scholorship = $scholorship * 8;
                                                            $w_months = '1-8';
                                                            $paid_scholorship = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where2, 'amount', $w_months);
                                                            echo $eight_month_scholorship - $paid_scholorship;
                                                        } else {
                                                            echo '';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>


                                        </table>
                                    </td>

                                </tr>
                            </table>

                            <br>
                            <table width="100%"  style="line-height:1.5">
                                <tr>
                                    <td align="left">
                                        <span style="text-align:center; float: left">
                                            <p style="margin:0px;">________________</p>
                                            <p><?= 'تاریخ وصولی' ?></p>
                                        </span> 
                                    </td>
                                    <td align="right">
                                        <span style="text-align:center; float: right">
                                            <p  style="margin:0px;">________________</p>
                                            <p><?= 'دستخظ مسئول' ?></p>
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <h4 style="margin:10px; font-weight: bold; float: right; margin-top: 0px;"><?= 'ادا شدہ فیس معلومات' ?></h4>
                            <table width="100%"  dir="rtl" style="line-height: 2;border: 1px solid black; border-collapse: collapse;  text-align: center; font-size: 10px;" border="1" >
                                <tr style="background: #eee;
                                    font-weight: bold;" id="color">
                                    <td><?= 'شوال' . ' - ' . 'محرم' ?></td>
                                    <td><?= 'صفر' . ' - ' . 'جمادی الاول' ?></td>
                                    <td><?= 'جمادی ثانی' . ' - ' . 'رمضان' ?></td>
                                </tr>
                                <tr>
                                    <td><?php
                                        $where = array();
                                        $where['student_id'] = $student_id;
                                        $where['teacher_id'] = $teacher_id;
                                        $where['year'] = $running_year;
                                        $four_paid = $this->studentfee_model->get_student_transactions_sum(1, 4, $student_id, $class_id);
                                        $paid_scholorship = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where, 'amount', '1-4');
                                        $four_months = $month_fee * 4;
                                        echo 'ادا شدہ رقم:' . ($four_paid + $paid_scholorship) . '<br>';
                                        echo 'بقایاجات:' . ($four_months - ($four_paid + $paid_scholorship));
//                                        echo '0';
                                        ?>
                                    </td>
                                    <td><?php
                                        $where = array();
                                        $where['student_id'] = $student_id;
                                        $where['teacher_id'] = $teacher_id;
                                        $where['year'] = $running_year;
                                        if (end($months) > 4) {
                                            $four_paid1 = $this->studentfee_model->get_student_transactions_sum(5, 8, $student_id, $class_id);
                                            $paid_scholorship = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where, 'amount', '5-8');
                                            $four_months1 = $month_fee * 4;
                                            echo 'ادا شدہ رقم:' . ($four_paid1 + $paid_scholorship) . '<br>';
                                            echo 'بقایاجات:' . ($four_months1 - ($four_paid1 + $paid_scholorship));
                                        }
                                        ?>
                                    </td>
                                    <td><?php
                                        $where = array();
                                        $where['student_id'] = $student_id;
                                        $where['teacher_id'] = $teacher_id;
                                        $where['year'] = $running_year;
                                        if (end($months) > 8) {
                                            $four_paid2 = $this->studentfee_model->get_student_transactions_sum(9, 12, $student_id, $class_id);
                                            $paid_scholorship = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where, 'amount', '9-12');
                                            $four_months2 = $month_fee * 4;
                                            echo 'ادا شدہ رقم:' . ($four_paid2 + $paid_scholorship) . '<br>';
                                            echo 'بقایاجات:' . ($four_months2 - ($four_paid2 + $paid_scholorship));
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" style="margin-top:5px; font-size:10px; line-height: 2" dir="rtl">
                                <tr>
                                    <td><h4 style="margin:0px; font-weight: bold"><?= 'ہدایات' ?></h4></td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul>
                                            <li><?= 'جامعہ سے وفاداری کا تقاضہ ہے کہ تمام واجبات مقررہ تاریخ سے پہلے ادا کیے جائیں۔' ?></li>
                                            <li><?= 'مقررہ تاریخ سے ایک مہینہ تک بلاوجہ تاخیر پر جامعہ کے مطبخ سے کھانا بند ہوگا جس کیلئے طالبعلم کو یومیہ پچاس روپے  کی ادائیگی ضروری ہوگی اور دو مہینوں تک تاخیر پر داخلہ معطل ہو سکتا ہے۔' ?></li>
                                            <li><?= 'کلی یا جزوی طورپر جامعہ سےمنظور شدہ وظیفہ زکواۃ کی مد میں مسئول' . '/' . 'کلاس ٹیچر سے وصول کرا کے اخراجات کی ادائیگی یقینی بنائیں' ?></li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php // }         ?>
    </body>
</html>






