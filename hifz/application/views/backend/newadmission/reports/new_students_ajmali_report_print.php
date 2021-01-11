<html>
    <head>
        <title><?= 'ماہانہ رپرٹ' ?></title>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <style>
            body{ 
                font-family: 'jameelnoori';
            }
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                .pagebreak{page-break-after: always;display: block;}
            }
            h4, h3, h2, h1{ margin: 0px !important;}
        </style>
    </head>
    <body>
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        ?>

        <?php if (is_numeric($param1)) { ?>
            <table width='100%' align='center' dir="rtl">
                <tr style="text-align: center">
                    <td><img src="uploads/header.png" width="200" /></td>
                    <td>
                        <img src="uploads/logo.png" style="max-height : 60px;">
                        <br>
                        <h3><?= 'اجمالی حفاظ کرام نیاء داخلہ رپورٹ' ?></h3>
                        <h2 dir="ltr"><?= $this->db->get_where('branches', array('branch_id' => $param1))->row()->name; ?></h2>
                    </td>
                    <td style="text-align: center">
                        <h4>
                            <?php echo get_phrase('session') . ':' . $running_year . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal ?>
                        </h4>
                        <br>
                        <?= 'نیاء داخلہ نظام' ?>
                    </td>
                </tr>
            </table>
        <table align='center' width='90%' dir="rtl" border='1' style="border: 1px solid black; border-collapse: collapse; line-height: 2.5; text-align: center">

                <tr>
                    <td><?= 'تمام داخلہ طلبہ' ?></td>
                    <td><?= $this->db->where(array('year' => $running_year, 'branch_id' => $branch_id1))->from("new_enroll")->count_all_results(); ?></td>
                </tr>
                <tr>
                    <td><?= 'ٹوٹل منتخب طلبہ' ?></td>
                    <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 0, 'branch_id' => $branch_id1))->from("new_enroll")->count_all_results(); ?></td>
                </tr>
                <tr>
                    <td><?= 'تمام غیر منتخب طلبہ' ?></td>
                    <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 1, 'branch_id' => $branch_id1))->from("new_enroll")->count_all_results(); ?></td>
                </tr>
            </table>
        <?php } else { ?>
            <table width='100%' align='center' dir="rtl">
                <tr style="text-align: center">
                    <td><img src="uploads/header.png" width="200" /></td>
                    <td>
                        <img src="uploads/logo.png" style="max-height : 60px;">
                        <br>
                        <h3><?= 'اجمالی حفاظ کرام نیاء داخلہ رپورٹ' ?></h3>
                        <h2 dir="ltr"><?= $this->db->get_where('branches', array('branch_id' => $param1))->row()->name; ?></h2>
                    </td>
                    <td style="text-align: center">
                        <h4>
                            <?php echo get_phrase('session') . ':' . $running_year . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal ?>
                        </h4>
                        <br>
                        <?= 'نیاء داخلہ نظام' ?>
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <table align='center' dir="rtl" width='50%' border='1' style="border: 1px solid black; border-collapse: collapse; line-height: 2.5; text-align: center">
                        <?php
                        $branches = $this->db->get_where('branches')->result();
                        foreach ($branches as $bran) {
                            ?>
                            <tr style="background: #ef9e64;">
                                <td colspan="4" align='center' dir="ltr"><?= $bran->name ?></td>
                            </tr>
                            <tr>
                                <td><?= 'تمام داخلہ طلبہ' ?></td>
                                <td><?= $this->db->where(array('year' => $running_year, 'branch_id' => $bran->branch_id))->from("new_enroll")->count_all_results(); ?></td>
                            </tr>
                            <tr>
                                <td><?= 'ٹوٹل منتخب طلبہ' ?></td>
                                <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 0, 'branch_id' => $bran->branch_id))->from("new_enroll")->count_all_results(); ?></td>
                            </tr>
                            <tr>
                                <td><?= 'تمام غیر منتخب طلبہ' ?></td>
                                <td><?= $this->db->where(array('year' => $running_year, 'enroll_status' => 1, 'branch_id' => $bran->branch_id))->from("new_enroll")->count_all_results(); ?></td>
                            </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
        <?php } ?>

    </body>
</html>