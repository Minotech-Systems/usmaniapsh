<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$std_enroll = $this->db->get_where('new_enroll', array('student_id' => $param2, 'year' => $running_year))->row();
$std_data = $this->db->get_where('new_student', array('student_id' => $param2))->row();
$other_fee = $this->db->get_where('new_other_fee', array('branch_id' => $std_enroll->branch_id, 'year' => $running_year))->result();
?>
<form method="post" action="<?= base_url('index.php?newadmission/add_other_transaction') ?>" class="form-horizontal form-groups-bordered validate">
    <div class="row">
        <div class="col-md-12">
            <center>
                <h3><?= $std_data->name . ' ' . 'ولدیت ' . ' ' . $std_data->father_name ?></h3>
                <h4><?= 'داخلہ اضافی فیس' ?></h4>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($other_fee as $fee) { ?> 
                <div class="form-group">    
                    <label  class="col-sm-3 control-label"><?= $fee->name ?></label> 
                    <div class="col-sm-6">  
                        <input type="text" class="form-control" name="amount_<?= $fee->id ?>" value="<?= $fee->amount ?>">  
                    </div>   
                </div> 
                <input type="hidden" value="<?= $std_enroll->branch_id ?>" name="branch_id">
                <input type="hidden" value="<?= $param2 ?>" name="student_id">
            <?php } ?> 
            <div class="form-group" style="text-align: center"> 
                <button type="submit" class="btn btn-default"><?= 'اضافی فیس شامل کریں' ?></button>
            </div>
        </div>
    </div>
</form>