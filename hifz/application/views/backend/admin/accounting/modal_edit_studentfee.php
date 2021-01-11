<?php 
$year = $param3;
$data = $this->db->get_where('student',array('student_id'=>$param2))->result_array();

foreach($data as $row){
	$amount = $this->db->get_where('student_fee',array('student_id'=>$row['student_id'], 'year'=>$year))->row()->amount;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo $row['name']; ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?student_fee/student_fee_detail/edit/' . $param2.'/'.$param3, array('class' => 'form-horizontal form-groups-bordered validate')); ?>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('monthly_fee'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="amount" value="<?php echo $amount ?>" >
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