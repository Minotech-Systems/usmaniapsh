<?php 
$data = $this->db->get_where('monthly_fee',array('monthly_fee_id'=>$param2))->result_array();
foreach($data as $row){
    $branch =  $this->db->get_where('branches',array('branch_id'=>$row['branch_id']))->row()->name;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo $branch; ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?student_fee/manage_student_fee/update/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate')); ?>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('monthly_fee'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="amount" value="<?php echo $row['amount']; ?>" >
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