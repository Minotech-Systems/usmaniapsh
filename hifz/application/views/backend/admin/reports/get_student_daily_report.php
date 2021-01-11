<?php
$date_actual = date('Y-m-d', strtotime($date));
$student_data = $this->db->get_where('daily_student_report',array('student_id'=>$student_id,'date'=>$date_actual))->row();
if(!empty($student_data)){
    $lession_a = $student_data->lesson_a;
    $lession_a_quantity = $student_data->lesson_a_quantity;
    $lession_a_state = $student_data->lesson_a_state;
    
    $lession_b = $student_data->lesson_b;
    $lession_b_quantity = $student_data->lesson_b_quantity;
    $lession_b_state = $student_data->lesson_b_state;
    
    $lession_c = $student_data->lesson_c;
    $lession_c_quantity = $student_data->lesson_c_quantity;
    $lession_c_state = $student_data->lesson_c_state;
    
}
 else {
    $lession_a = '';
    $lession_a_quantity = '';
    $lession_a_state = '';
    
    $lession_b = '';
    $lession_b_quantity = '';
    $lession_b_state ='';
    
    $lession_c = '';
    $lession_c_quantity = '';
    $lession_c_state = '';
}?>
<div class="row">
    <div class="col-md-10" style="margin-top: 50px;">
        <div class="form-group">
            <div dir="rtl">
                <center>
                    <?= 'روزانہ رپورٹ ' . '&nbsp;&nbsp;&nbsp;' . $this->crud_model->get_type_name_by_id('student', $student_id).'&nbsp;&nbsp;&nbsp;'.$date ?>
                </center>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'سبق' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_a" required="" value="<?= $lession_a?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'مقدار سبق' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_a_quantity" required=""  value="<?= $lession_a_quantity?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'کیفیت' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_a_state" required="" value="<?= $lession_a_state?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'سبقی' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_b" required="" value="<?= $lession_b?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'مقدار سبقی' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_b_quantity" required="" value="<?= $lession_b_quantity?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'کیفیت' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_b_state" required="" value="<?= $lession_b_state?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'منزل' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_c" required="" value="<?= $lession_c?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'مقدار منزل' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_c_quantity" required="" value="<?= $lession_c_quantity?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo 'کیفیت' ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lession_c_state" required="" value="<?= $lession_c_state?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-8" style="text-align: left">
                <button type="submit" class="btn btn-success"><?= get_phrase('submit')?></button>
            </div>
        </div>
    </div>
</div>