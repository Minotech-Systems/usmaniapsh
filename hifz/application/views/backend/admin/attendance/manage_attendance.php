<?php echo form_open(base_url() . 'index.php?attendance/attendance_selector/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-1">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control "  id="teacher_id">
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

<script>
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