<style>
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter{background: white;}
    .red{ color:red !important;}
</style>
<div class="row">
    <div class="col-md-12">
        <?php echo form_open(base_url() . 'index.php?hostel/add_student_to_room/'); ?>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('hostel'); ?></label>
                <select name="hostel_id" class="form-control" onchange="get_hostel_floor(this.value)">
                    <option value=""><?php echo get_phrase('select_hostel'); ?></option>
                    <?php
                    foreach ($hostels as $row) {
                        ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?= 'ہاسٹل فلور'; ?></label>
                <select name="floor_id" class="form-control " id="hostel_floor" required="" onchange="get_floor_room(this.value)">
                    <option value=""><?php echo 'پہلے ہاسٹل منتخب کریں'; ?></option>
                </select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?= 'کمرہ نمبر'; ?></label>
                <select name="room_id" class="form-control " id="hostel_room" required="" >
                    <option value=""><?php echo 'پہلے فلور منتخب کریں'; ?></option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?= 'طلباء'; ?></label>
                <select name="student_id[]" class="form-control select2" multiple="" required="">
                    <?php
                    foreach ($students as $std) {
                        $father_name = $std->father_name;
                        $class = $this->db->get_where('teacher', array('teacher_id' => $std->teacher_id))->row()->name;
                        $student_check = $this->db->get_where('hostel_students', array('student_id' => $std->student_id, 'year' => $running_year))->row();
                        if ($student_check) {
                            ?>
                            <option value="<?php echo $std->student_id; ?>" class="red">
                                <?= $std->name . " 'ولد' " . $father_name . ' / ' . $class; ?>
                            </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?= $std->student_id ?>">
                                <?= $std->name . " 'ولد' " . $father_name . ' / ' . $class; ?>
                            </option>
                            <?php
                        } } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="margin-top: 20px"><?= 'طالب کا اندراج کریں' ?></button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered datatable" id="table_export"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= ' ہاسٹل' ?></th>
                    <th><?= 'فلور نمبر' ?></th>
                    <th><?= 'روم نمبر' ?></th>
                    <th><?= 'طلباء' ?></th>
                    <th><?= 'کاروائی' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($hostel_rooms as $room) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $this->hostel_model->get_hostel_name($room->hostel_id) ?></td>
                        <td><?= $this->hostel_model->get_hostel_floor($room->floor_id) ?></td>
                        <td><?= $room->room_number ?></td>
                        <td>
                            <?php
                            $students = $this->hostel_model->get_room_students($room->id, $running_year);
                            foreach ($students as $student) {
                                ?>
                                <span class="btn <?php
                                if ($student->leader == 1) {
                                    echo ' btn-gold btn-icon btn-xs';
                                } if ($student->pro_leader == 1) {
                                    echo ' btn-info btn-icon btn-xs';
                                } else {
                                    echo ' btn-default btn-icon btn-xs';
                                }
                                ?>">
                                      <?= $student->name ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?hostel/delete_student_room/<?= $student->student_id ?>');">
                                        <i class="entypo-cancel"></i>
                                    </a>

                                </span>
                            <?php } ?>
                        </td>
                        <td>
                            <span class="btn btn-gold btn-icon">
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/hostel/modal_addroom_leader/<?= $student->id; ?>');">
                                    <i class="entypo-user"></i>
                                    امیر
                                </a>
                            </span>
                            <span class="btn btn-info btn-icon">
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/hostel/modal_addroom_proleader/<?= $student->id; ?>');">
                                    <i class="entypo-user"></i>
                                    معاون
                                </a>
                            </span>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">

    function get_hostel_floor(hostel_id) {

        if (hostel_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?hostel/get_hostel_floor/' + hostel_id,
                success: function (response)
                {

                    jQuery('#hostel_floor').html(response);
                }
            });
        }
    }

    function get_floor_room(floor_id) {

        if (floor_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?hostel/get_floor_room/' + floor_id,
                success: function (response)
                {

                    jQuery('#hostel_room').html(response);
                }
            });
        }
    }


</script>