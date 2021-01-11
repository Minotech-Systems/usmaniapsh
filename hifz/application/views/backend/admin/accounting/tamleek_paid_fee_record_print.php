<html>
    <head>
        <title><?= 'تملیک رپورٹ' ?></title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <style>
            body{font-family:'Noto Nastaliq Urdu Draft', serif}
            @media print {
                #cross{ color: red !important;}
            }
        </style>
    </head>
    <body>
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
        $branch = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        $r_year = explode('-', $running_year);
        ?>
        <table width="95%" dir="rtl" align="center">
            <tr >
                <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
                <td align="center">
                    <h3 style="font-weight: 100; margin-bottom: -25px;" dir="ltr"><?php echo $branch; ?></h3>
                    <br>
                    <?php echo 'سالانہ تملیک شدہ طلبہ فیس ریکارڈ' ?>

                </td>
                <td width="25%">
                    <u style="border-bottom:2px solid black;"><?php echo get_phrase('class') . ' : ' . ' ' . $class_name . ' (' . $section_name . ')' ?></u>
                    <br>
                    <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
                </td>
                <td width="7%">
                    <span style="display:inline"> <img src="uploads/logo.png" height="80"/></span>
                </td>
            </tr>
        </table>
        <table width="90%" border="1" dir="rtl" align="center" style="text-align: center; line-height: 2;font-weight: bold;font-size: 12px;">
            <thead>
                <tr style="background-color: #03b2e7; line-height: 3; color: white;">
                    <td><?php echo get_phrase('serial_no') ?></td>
                    <td><?php echo get_phrase('name') ?></td>
                    <td><?php echo get_phrase('parent') ?></td>
                    <td><?php echo get_phrase('monthly_fee'); ?></td>
                    <?php for ($i = 1; $i <= $month; $i++) { ?>
                        <td><?php echo $this->studentfee_model->get_month_name($i); ?></td>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $monthy_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id, 'year' => $running_year))->row()->amount;
                $students = $this->studentfee_model->get_fee_record_all($teacher_id, $running_year);
                foreach ($students as $data) {
                    $parent = $data['father_name'];
                    if ($data['amount'] < $monthy_fee) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $parent ?></td>
                            <td><?php echo $data['amount'] ?></td>
                            <?php for ($i = 1; $i <= $month; $i++) { ?>
                                <td><?php
                                    if ($this->studentfee_model->check_student_tamleek($data['student_id'], $i, $running_year) != 0) {
                                        echo '&#10004';
                                    } else {
                                        echo '<span id="cross" style="color:red;">' . '&#10006' . '</span>';
                                    }
                                    ?></td>
                            <?php } ?>
                        </tr>
                        <?php
                        $total_fee += $data['amount'];
                    }
                }
                ?>
                <tr>
                    <td colspan="3"><?php echo 'مجموعی ریکارڈ' ?></td>
                    <td><?php echo $total_fee; ?></td>
                    <td colspan="12"></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>