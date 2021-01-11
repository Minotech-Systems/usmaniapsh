<?php 
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$data = $this->db->get_where('additional_student_fee',array('id'=>$param2))->result();

foreach($data as $row){
    $student = $this->db->get_where('student', array('student_id'=>$row->student_id))->row()->name;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo $student.'&nbsp;&nbsp;&nbsp;'.'اضافی فیس تصحیح'; ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?student_fee/view_student_transaction/edit_additional/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate')); ?>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('monthly_fee'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" dir="ltr" name="amount" value="<?php echo $row->amount ?>" >
                        </div> 
                    </div>
                     
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('month');?></label>
                        <div class="col-sm-5">
                            <select name="month" class="form-control " id="month" dir="rtl">
                                <?php
                                for ($i = 1; $i <= 12; $i++):
                                    if ($i == 1)
                                        $m = 'شوال';
                                    else if ($i == 2)
                                        $m = 'ذوالقعدۃ';
                                    else if ($i == 3)
                                        $m = 'ذوالحجۃ';
                                    else if ($i == 4)
                                        $m = 'محرم';
                                    else if ($i == 5)
                                        $m = 'صفر';
                                    else if ($i == 6)
                                        $m = 'ر بیع الاول';
                                    else if ($i == 7)
                                        $m = 'ر بیع الثانی';
                                    else if ($i == 8)
                                        $m = 'جمادی الاول';
                                    else if ($i == 9)
                                        $m = 'جمادی الثانی';
                                    else if ($i == 10)
                                        $m = 'رجب';
                                    else if ($i == 11)
                                        $m = 'شعبان';
                                    else if ($i == 12)
                                        $m = ' رمضان';
                                    ?>
                                    <option value="<?php echo $i; ?>"
                                            <?php if ($row->month == $i) echo 'selected'; ?>  >
                                                <?php echo $m; ?>
                                    </option>
                                    <?php
                                endfor;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="datepicker form-control" name="date" data-format="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($row->date))?>" 
                                   data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('update'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>