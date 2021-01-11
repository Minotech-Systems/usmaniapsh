<?php
$login_user_branch = $this->session->userdata('branch_id');
$edit_data = $this->db->get_where('students_sponsor', array('sponsor_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_sponsor'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?student_fee/student_sponsor/edit/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" >
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" >
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                        <div class="col-sm-5">
                            <select name="branch_id" class="form-control "  required="">
                                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                                <?php
                                    $branches = $this->db->get_where('branches', array('branch_id' => $login_user_branch))->row();
                                    ?>
                                    <option value="<?php echo $branches->branch_id ?>" <?php echo 'selected'; ?>><?php echo $branches->name ?></option>
                            </select>
                        </div> 
                    </div>



                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('update'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>