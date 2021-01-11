<html>
    <head>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <style>
            body{font-family: jameelnoori;}
            h4, h3, h2, h1{ margin: 0px !important;}
        </style>
    </head>
    <body dir="rtl">
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $student_info = $this->newadmission_model->get_student_info($running_year, $branch_id);
        ?>
        <table width='100%' align='center' dir="rtl">
            <tr style="text-align: center">
                <td><img src="uploads/header.png" width="200" /></td>
                <td>
                    <img src="uploads/logo.png" style="max-height : 60px;">
                    <br>
                    <h3><?= 'حفاظ کرام فیس رپورٹ' ?></h3>
                </td>
                <td style="text-align: center">
                    <h4>
                        <?php echo get_phrase('session') . ':' . $running_year . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal ?>
                    </h4>
                </td>
            </tr>
        </table>
        <?php
        $branches = $this->db->get('branches')->result();
        foreach ($branches as $bran) {
            ?>
            <table width="90%" align="center" border="1" dir="rtl" style=" font-size: 19px; font-weight: bold; margin-top: 20px;  border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 1.5">
                <tr style="line-height: 2; background: #e0bd8e;">
                    <td dir="ltr" colspan="2"><h4><?= $bran->name ?></h4></td>
                </tr>
                <tr>
                    <td width="50%"><?= 'ٹوٹل ماہانہ فیس' ?></td>
                    <td><?= $month_fee = $this->newadmission_model->get_monthly_fee_sum($running_year, $bran->branch_id) ?></td>
                </tr>
                <tr>
                    <td width="50%"><?= 'ٹوٹل اضافی فیس' ?></td>
                    <td><?= $other_fee = $this->newadmission_model->get_other_fee_sum($running_year, $bran->branch_id) ?></td>
                </tr>
                <tr>
                    <td><?= 'ٹوٹل فیس' ?></td>
                    <td><?= $bran_total_fee = $month_fee + $other_fee ?></td>
                </tr>
            </table>
            <?php
            $total_fee += $bran_total_fee;
        }
        ?>
        <table width="60%" align="center" style="text-align: center ; margin-top: 30px;; font-weight: bold;">
            <tr>
                <td><?= 'ٹوٹل حفاظ کرام اداشدہ فیس' ?></td>
                <td><?= $total_fee ?></td>
            </tr>
        </table>
    </body>
</html>