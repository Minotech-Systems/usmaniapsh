<?php
$edit_data = $this->db->get_where('exam', array('exam_id' => $param2))->result();
$year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$exam_date = $this->db->get_where('exam_date', array('exam_id' => $param2, 'year' => $year))->row()->date;
$signature = $this->db->get_where('exam_date', array('exam_id' => $param2, 'year' => $year))->row()->signature;
if (!empty($exam_date)) {
    $date = $exam_date;
} else {
    $date = '';
}
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_exam'); ?>
                    </div>
                </div>
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?exam/exams/do_update/' . $row->exam_id, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row->name; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="datepicker form-control" name="date" data-format="dd-mm-yyyy" 
                                   value="<?php
                                   if (!empty($date)) {
                                       echo date('d-m-Y', strtotime($date));
                                   } else {
                                       echo date('d-m-Y');
                                   }
                                   ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('signature'); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="sign">
                                <option value="0" <?php if($signature == 0)echo 'selected'?>><?= 'خالی'?></option>
                                <option value="1" <?php if($signature == 1) echo 'selected'?>><?= 'امین ادارۃ التعلیمات'?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_exam'); ?></button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>



    <?php
endforeach;
?>





