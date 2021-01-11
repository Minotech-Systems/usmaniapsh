<?php
$hostel_name = $this->hostel_model->get_hostel_name($hostel_id);
$branch_name = $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row()->name;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
?>
<div>
    <center>
        <a class="btn btn-default pull-left" href="<?= base_url('index.php?hostel/print_hostel_report').'/'.$hostel_id?>" target="_blank">
            <i class="fa fa-print"></i>
            <?= 'پرنٹ رپورٹ'?>
        </a>
        <img src="<?= base_url('uploads/bismillah.png') ?>" width="200"/>
        
        <h3><?= 'تقسیم طلباء کرام' . ' ' . $hostel_name . '(' . 'ہاسٹل' . ')' ?></h3>
        <h4 dir="ltr"><?= $branch_name ?></h4>
        <h4><?= 'تعلیمی سال ' . $talimi_saal ?></h4>

        <table width="85%" align="center" style="text-align: center; line-height: 2.5">
            <?php
            $floors = $this->db->get_where('hostel_floor', array('hostel_id' => $hostel_id))->result();
            foreach ($floors as $floor) {
                ?>
                <tr>
                    <td><h4>&#10090 <?= 'منزل' ?> &#10091</h4></td>
                </tr>
                <tr>
                    <td><h4><?= $floor->floor_name ?></h4></td>
                </tr>
                <?php
                $rooms = $this->db->get_where('hostel_room', array('hostel_id' => $hostel_id, 'floor_id' => $floor->id))->result();
                foreach ($rooms as $room) {
                    ?>
                    <tr>
                        <td><?= 'کمرہ نمبر ' . ' : ' . $room->room_number ?></td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="1" style="line-height: 2.5; border:1px solid black; border-collapse: collapse; text-align: center;">
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
                                        <td><?= $this->db->get_where('class', array('class_id' => $student->class_id))->row()->name; ?></td>
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
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </center>
</div>