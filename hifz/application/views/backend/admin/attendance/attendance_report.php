<hr />

<?php echo form_open(base_url() . 'index.php?attendance/attendance_report_selector/'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>

            <select name="teacher_id" class="form-control "   id = "teacher_id">
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <?php
                foreach ($teachers as $row):
                    ?>
                    <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?>
                    </option>

                <?php endforeach; ?>
            </select>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control ">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'جنوری';
                    else if ($i == 2)
                        $m = 'فروری';
                    else if ($i == 3)
                        $m = 'مارچ ';
                    else if ($i == 4)
                        $m = 'اپریل ';
                    else if ($i == 5)
                        $m = 'مئی ';
                    else if ($i == 6)
                        $m = 'جون ';
                    else if ($i == 7)
                        $m = 'جولائی ';
                    else if ($i == 8)
                        $m = 'اگست ';
                    else if ($i == 9)
                        $m = 'ستمبر ';
                    else if ($i == 10)
                        $m = 'اکتوبر ';
                    else if ($i == 11)
                        $m = 'نومبر ';
                    else if ($i == 12)
                        $m = 'دسمبر ';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('year'); ?></label>
            <select name="year" class="form-control">		  	
                <?php $date_year = date('Y') ?>		  	
                <option value=""><?php echo get_phrase('select_year'); ?></option>		  	
                <?php for ($i = 0; $i < 30; $i++): ?>		      	
                    <option value="<?php echo 2016 + $i ?>"<?php if ($date_year == 2016 + $i) echo 'selected'; ?>>		          	
                        <?php echo 2016 + $i ?>		      	
                    </option>		  
                <?php endfor; ?>		
            </select>
        </div>
    </div>

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info" disabled="" id="submit"><?php echo get_phrase('show_report'); ?></button>
    </div>
</div>

<?php echo form_close(); ?>







<script type="text/javascript">

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
