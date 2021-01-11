<?php
$branch_id = $this->session->userdata('branch_id');
$edit_data = $this->db->get_where('section', array(
            'section_id' => $param2
        ))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_section'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?admin/sections/edit/' . $row['section_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                   value="<?php echo $row['name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('nick_name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="nick_name" 
                                   value="<?php echo $row['nick_name']; ?>" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-5">
                            <select name="class_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php
                                $classes = $this->db->get_where('class', array('branch_id' => $branch_id))->result_array();


                                foreach ($classes as $row1):
                                    $branch_name = $this->db->get_where('branches', array('branch_id' => $row1['branch_id']))->row()->name;
                                    ?>

                                    <option value="<?php echo $row1['class_id']; ?>"
                                            <?php if($row['class_id']== $row1['class_id']) echo 'selected';?>><?php echo $row1['name'] . '/' . $branch_name; ?></option>

                                <?php endforeach; ?>
                            </select>
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
<?php endforeach; ?>