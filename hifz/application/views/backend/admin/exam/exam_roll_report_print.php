<html>
    <head>
        <title>Exam Roll Print</title>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <style>
            body{ font-family: jameelnoori;}
        </style>
    </head>
    <body>
        <?php
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $branch_name = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        $r_year = explode('-', $running_year);
        ?>
        <table width="100%" dir="rtl">
            <tr>
                <td width="20%"><image src="uploads/header.jpg" width="200" /></td>
                <td align="center" dir="ltr">
                    <h3 style="font-weight: 600; "><?php echo $branch_name; ?></h3>
                    <?php echo ' حفاظ کرام '.get_phrase('student_exam_roll_record'); ?>

                </td>
                <td align="left">
                    <span style="font-size:12px;"><?php echo get_phrase('session') . ':' . $r_year[1] . '-' . $r_year[0] . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal; ?></span>
                </td>
            </tr>
        </table>
        <table width="90%" align="center" style="text-align: center; line-height: 2; border-collapse: collapse; font-size: 16px; font-weight: bold;" border="1" dir="rtl">
            <thead>
                <tr style=" background: #464646; color: white;">
                    <td>#</td>
                    <td><?= get_phrase('name') ?></td>
                    <td><?= get_phrase('parent') ?></td>
                    <td><?= get_phrase('reg_no') ?></td>
                    <td><?= get_phrase('exam_roll') ?></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $student_data = $this->exam_model->get_branch_year_exam_roll($branch_id);
                foreach ($student_data as $data) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->name ?></td>
                        <td><?= $data->father_name ?></td>
                        <td><?= $data->reg_no ?></td>
                        <td style="font-size: 16px; font-family:sans-serif; font-weight: bold;"><?= $data->roll_no ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
