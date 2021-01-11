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
                    <h3><?= 'تجدید حفاظ کرام' ?></h3>
                    <h2 dir="ltr"><?= $branch_name1 ?></h2>
                </td>
                <td style="text-align: center">
                    <h4>
                        <?php echo get_phrase('session') . ':' . $running_year . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal ?>
                    </h4>
                </td>
            </tr>
        </table>
        
        <!--.-->
        <table width="90%" align="center" border="1" dir="rtl" style=" font-size: 19px; font-weight: bold; border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 1.5">
            <tr style="line-height: 2; background: #e0bd8e;">
                <td>#</td>
                <td><?= get_phrase('name') ?></td>
                <td><?= get_phrase('parent') ?></td>
                <td><?= get_phrase('current_address') ?></td>
            </tr>
            <?php
            $no = 1;
            foreach ($student_info as $data) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data->name ?></td>
                    <td><?= $data->father_name ?></td>
                    <td><?= $data->c_address ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>

