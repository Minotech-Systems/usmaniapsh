<?php echo form_open(base_url() . 'index.php?attendance/attendance_selector/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-1">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control " id="teacher_id">
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <?php
                foreach ($teachers as $row) {
                    ?>
                    <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date'); ?></label>
            <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy" value="<?php echo date("d-m-Y"); ?>"/>
        </div>
    </div>
    <input type="hidden" name="year" value="<?php echo $running_year; ?>">
    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" id = "submit" class="btn btn-info" disabled=""><?php echo get_phrase('submit'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<hr />
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-chart-area"></i></div>

            <h3 style="color: #696969;"><?php echo get_phrase('attendance'); ?> <?php echo $teacher_name ?></h3>
            <h4 style="color: #696969;" dir="ltr">
                <?php echo date("d-m-Y", strtotime($timestamp)); ?>
            </h4>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>


<center>
    <a class="btn btn-default" onclick="mark_all_present()">
        <i class="entypo-check"></i> <?php echo get_phrase('mark_all_present'); ?>
    </a>
    <a class="btn btn-default"  onclick="mark_all_absent()">
        <i class="entypo-cancel"></i> <?php echo get_phrase('mark_all_absent'); ?>
    </a>
</center>
<br>
<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">

        <?php echo form_open(base_url() . 'index.php?attendance/attendance_update/'); ?>
        <div id="attendance_update">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('parent'); ?></th>
                        <th><?php echo get_phrase('status'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $select_id = 0;
                    $attendance_of_students = $this->db->get_where('attendance', array(
                                'teacher_id' => $teacher_id,
                                'year' => $running_year,
                                'timestamp' => $timestamp
                            ))->result_array();


                    foreach ($attendance_of_students as $row):
                        $student_row = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>

                            <td>
                                <?php echo $student_row->name ?>
                            </td>
                            <td>
                                <?php echo $student_row->father_name ?>
                            </td>
                            <td>
                                <select class="form-control" name="status_<?php echo $row['attendance_id']; ?>" id="status_<?php echo $select_id; ?>">
                                    <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>><?php echo get_phrase('undefined'); ?></option>
                                    <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>><?php echo get_phrase('present'); ?></option>
                                    <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>><?php echo get_phrase('absent'); ?></option>
                                    <option value="3" <?php if ($row['status'] == 3) echo 'selected'; ?>><?php echo get_phrase('leave'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <?php
                        $select_id++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <center>
            <button type="submit" class="btn btn-success" id="submit_button">
                <i class="entypo-thumbs-up"></i> <?php echo get_phrase('save_changes'); ?>
            </button>
        </center>
        <?php echo form_close(); ?>

    </div>



</div>

<script type="text/javascript">

    function mark_all_present() {
        var count = <?php echo count($attendance_of_students); ?>;
        for (var i = 0; i < count; i++)
            $('#status_' + i).val("1");
    }

    function mark_all_absent() {
        var count = <?php echo count($attendance_of_students); ?>;
        for (var i = 0; i < count; i++)
            $('#status_' + i).val("2");
    }

    function check_validation(teacher_id) {
        if (teacher_id !== '') {
            $('#submit').removeAttr('disabled')
        } else {
            $('#submit').attr('disabled', 'disabled');
        }
    }

    $('#teacher_id').change(function () {
        teacher_id = $('#teacher_id').val();
        check_validation(teacher_id);
    });
</script>
