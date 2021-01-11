<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
        <style>
            body{font-family: Noto Nastaliq Urdu Draft}
        </style>
    </head>
    <body>
        <?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        ?>
        <table width="90%" align="center" dir="rtl">
            <tr>
                <td width="20%"><img src="uploads/header.png" width="200" /></td>
                <td align="center">
                    <h4 >
                        <?= $system_name; ?>
                        <?= 'حفاظ کرام تصاویر رپورٹ' ?>
                        <br>
                        <?php
                        if (is_numeric($teacher_id)) {
                            echo $teacher = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
                        }
                        ?>

                    </h4>
                </td>
                <td width="5%">
                    <span style="display:inline"> <img src="uploads/logo.png" height="80"/></span>
                </td>
            </tr>
        </table>
        <table width="90%" border="1" style="border-collapse: collapse; border: 1px solid black; text-align: center" dir="rtl" align="center"> 
            <thead>
                <?php
                $i = 0;
                foreach ($students as $data) {
                    $image = $this->db->get_where('student', array('student_id' => $data))->row()->image;
                    ?>
                    <?php if ($i % 2 == 0) { ?>
                        <tr>
                            <td>
                                <img src="<?php echo $this->crud_model->get_image_url('student', $image); ?>" width="100" height="100">
                                <br>
                                <?= $this->db->get_where('student', array('student_id' => $data))->row()->reg_no; ?>
                            </td>
                        <?php } else { ?>
                            <td> 
                                <img src="<?php echo $this->crud_model->get_image_url('student', $image); ?>" width="100" height="100">
                                <br>
                                <?= $this->db->get_where('student', array('student_id' => $data))->row()->reg_no; ?>
                            </td>
                        <?php } ?>

                        <?php
                        $i++;
                    }
                    ?>
            </thead>
        </table>
    </body>
</html>
