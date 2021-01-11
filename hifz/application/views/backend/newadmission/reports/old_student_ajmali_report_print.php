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
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        ?>

        <table width='100%' align='center' dir="rtl">
            <tr style="text-align: center">
                <td><img src="uploads/header.png" width="200" /></td>
                <td>
                    <img src="uploads/logo.png" style="max-height : 60px;">
                    <br>
                    <h3><?= 'تجدید حفاظ کرام' ?></h3>
                    <h2 dir="ltr"><?= $branch_name ?></h2>
                </td>
                <td style="text-align: center">
                    <h4>
                        <?php echo get_phrase('session') . ':' . $running_year . ' ' . get_phrase('talimi_saal') . ':' . $talimi_saal ?>
                    </h4>
                </td>
            </tr>
        </table>
        <table width="90%" align="center" border="1" dir="rtl" style="  font-weight: bold; border: 1px solid black; border-collapse: collapse; text-align: center; line-height: 2">
            <?php
            $no1 = 1;
            $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
            
            foreach ($teachers as $teach) {
                ?>
                <tr <?php
                if ($no1 != 1) {
                    echo 'style = "border-top: 2px solid black; line-height:3"';
                }
                ?> style="line-height:3">
                    <td align='center' colspan="4"><?= $teach->name ?></td>
                </tr>
                <tr style="background: bisque;">
                    <td><?= '#' ?></td>
                    <td><?= get_phrase('name') ?></td> 
                    <td><?= get_phrase('parent'); ?></td>
                    <td><?= get_phrase('reg_no') ?></td>
                </tr>
                <?php
                $no = 1;
                $students = $this->newadmission_model->get_student_teacher_info($running_year, $branch_id, $teach->teacher_id);
                foreach ($students as $data) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->name ?></td>
                        <td><?= $data->father_name ?></td>
                        <td><?= $data->reg_no ?></td>
                    </tr>
                    <?php
                }
                $no1++;
            }
            ?>
        </table>
    </body>
</html>