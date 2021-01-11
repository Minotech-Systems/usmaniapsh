<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="assets/fonts/jameel/font.css">
        <style>
            body{font-family: jameelnoori;}
            h1, h2, h3, h4 , h5 , h6 {margin: 0px;}
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                .pagebreak{page-break-after: always;display: block;}
            }
        </style>
    </head>
    <body>
        <?php
        $hostel_name = $this->hostel_model->get_hostel_name($hostel_id);
        $branch_name = $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row()->name;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        ?>
        <table align="center" style="text-align: center">
            <tr>
                <td>
                    <img src="<?= base_url('uploads/bismillah.png') ?>" width="200"/>
                    <h3 dir="rtl"><?= 'تقسیم طلباء کرام' . ' ' . $hostel_name . '(' . 'ہاسٹل' . ')' . '' ?></h3>
                    <h4 dir="ltr"><?= $branch_name ?></h4>
                    <h4><?= 'تعلیمی سال ' . $talimi_saal ?></h4>
                </td>
            </tr>
        </table>
        <?php
        
        $floors = $this->db->get_where('hostel_floor', array('hostel_id' => $hostel_id))->result();
        foreach ($floors as $floor) {
            $room_no = 1;
            ?>
            <table width="85%" align="center" dir="rtl" style="text-align: center; line-height: 1.5">
                <tr>
                    <td><h4>&#10090 <?= 'منزل' ?> &#10091</h4></td>
                </tr>
                <tr>
                    <td><h4><?= $floor->floor_name ?></h4></td>
                </tr>
            </table>
            <?php
            
            $rooms = $this->db->get_where('hostel_room', array('hostel_id' => $hostel_id, 'floor_id' => $floor->id))->result();
            foreach ($rooms as $room) {
                ?>
                <table style="text-align:center" align="center">
                    <tr>
                        <td style="font-size:22px"><?= 'کمرہ نمبر ' . ' : ' . $room->room_number ?></td>
                    </tr>
                </table>
                <table width="80%"  align="center" border="1" dir="rtl" style="line-height: 1.5; font-size: 18px; font-weight: bold; border:1px solid black; border-collapse: collapse; text-align: center;">
                    <tr>
                        <td><?= 'نمبر شمار' ?></td>
                        <td><?= 'نام طالب علم' ?></td>
                        <td><?= 'ولدیت' ?></td>
                        <td><?= 'پتہ' ?></td>
                        <td><?= 'درجہ' ?></td>
                        <td><?= 'کیفیت' ?></td>
                    </tr>
                    <?php
                    $no = 1;
                    $floor_students = $this->hostel_model->get_floor_students($hostel_id, $floor->id, $room->id);
                    foreach ($floor_students as $student) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $student->name ?></td>
                            <td><?= $student->father_name; ?></td>
                            <td><?= $student->c_address ?></td>
                            <td><?= $this->db->get_where('class', array('class_id' => $student->class_id))->row()->name.'('.
                                    $this->db->get_where('section', array('section_id' => $student->section_id))->row()->name.')'; ?></td>
                            <td>
                                <?php
                                if ($student->leader == 1) {
                                    echo 'امیر';
                                } if ($student->pro_leader == 1) {
                                    echo 'معاون';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <?php
                if (($room_no % 2) == 0) {
                    echo '<span class="pagebreak"></span>';
                }
                $room_no++;
            }
        }
        ?>
</body>
</html>