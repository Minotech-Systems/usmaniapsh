<?php echo form_open(base_url() . 'index.php?attendance/friday_attendance_selector/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-1">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control " >
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <?php

                foreach ($teachers as $row):
                    ?>

                    <option value="<?php echo $row->teacher_id ?>"><?php echo $row->name ; ?></option>

                <?php endforeach; ?>
            </select>
        </div>
    </div>
     <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date'); ?></label>
            <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy" id="datepicker" autocomplete="off"/>
            
        </div>
    </div>
     <input type="hidden" name="year" value="<?php echo $running_year; ?>">
    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" id = "submit" class="btn btn-info" ><?php echo get_phrase('submit'); ?></button>
    </div>
</div>
<div class="row">
    <div class="col-sm-4" id="response">
    </div>
</div>
<?php echo form_close(); ?>

