<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$login_user_branch = $this->session->userdata('branch_id');

$this->db->select('*');
$this->db->from('sponsor_help');
$this->db->where(array('student_id' => $param2, 'year' => $running_year));
$query = $this->db->get();
if ($query->num_rows() > 0) {
    echo '<h3>' . 'اس طالب علم کا کفیل پہلے سے موجود ہے۔ لہزا اپ تصیح کریں۔۔۔' . '</h3>';
} else {


    $student_info = $this->db->get_where('student', array('student_id' => $param2))->result_array();

    foreach ($student_info as $row) {
        $monthly_fee = $this->db->get_where('student_fee', array('student_id' => $param2, 'year' => $running_year))->row()->amount;
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title" >
                            <i class="entypo-plus-circled"></i>
                            <?php echo get_phrase('add_sponsor') . ' / ' . $row['name']; ?>
                        </div>
                    </div>
                    <div class="panel-body">

                        <?php echo form_open(base_url() . 'index.php?student_fee/add_student_sponsor/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('monthly_fee'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" disabled="" autocomplete="off" value="<?php echo $monthly_fee ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo 'ماہانہ تعاون'; ?></label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="amount" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('sponsor'); ?></label>
                            <div class="col-sm-5">
                                <select name="sponsor_id" class="form-control "  required="">
                                    <option value=""><?php echo get_phrase('sponsor'); ?></option>
                                    <?php
                                    $sponsors = $this->db->get_where('students_sponsor', array('branch_id' => $login_user_branch))->result_array();

                                    foreach ($sponsors as $row1):
                                        ?>
                                        <option value="<?php echo $row1['sponsor_id']; ?>"> <?php echo $row1['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> 
                        </div>




                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo 'داخلہ کفیل'; ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        </div>
        <?php
    }
}
?>	