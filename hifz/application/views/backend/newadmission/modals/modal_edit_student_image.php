<?php
$student_info = $this->db->get_where('new_student', array( 'student_id' => $param2 ))->result_array();
foreach ($student_info as $row):
    ?>
    <?php echo form_open(base_url() . 'index.php?newadmission/update_student_image/' . $row['student_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>

    <div class="profile-env">

        <header class="row">

            <div class="row">
                <div class="col-sm-12" style="text-align: center;">
                    <div class="form-group">

                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo $this->crud_model->get_image_url('new_admission', $row['image']); ?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">تصویر منتخب کریں</span>
                                        <span class="fileinput-exists">تبدیل کریں</span>
                                        <input type="file" name="student_image" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </header>
        <div class="row">
            <div class="col-sm-12">
                <center>
                    <h3><?php echo get_phrase('name') . ':' . $row['name'] ?></h3>
                    <h3><?php echo get_phrase('parent') . ':' . $row['father_name'] ?></h3>
                </center>
            </div>
        </div>

        <div class="form-group">

            <div class="col-sm-offset-5 col-sm-4">

                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_image'); ?></button>

            </div>

        </div>


    </div>
    <?php echo form_close(); ?>

<?php endforeach; ?>