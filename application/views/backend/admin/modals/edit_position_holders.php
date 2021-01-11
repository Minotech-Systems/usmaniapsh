<?php $edit_data = $this->db->get_where('web_position_holders', array('id' => $param2))->row(); ?>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" method="post" action="<?= base_url('website/update_position_holder') ?>" enctype="multipart/form-data">
            <div class="col-sm-8">
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="name"  value="<?= $edit_data->name ?>" class="form-control" placeholder="<?= 'نام طالب علم' ?>" required="">
                        <input type="hidden" name="pos_id" value="<?= $param2 ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="father_name"  value="<?= $edit_data->father_name ?>" class="form-control" placeholder="<?= 'نام ولدیت' ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="roll_no"  value="<?= $edit_data->roll_no ?>" class="form-control" placeholder="<?= 'رولنمبر' ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="marks"  value="<?= $edit_data->marks ?>" class="form-control" placeholder="<?= 'حاصل کردہ نمبرات' ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="position"  value="<?= $edit_data->position ?>" class="form-control" placeholder="<?= 'پوزیشن' ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="position_type"  value="<?= $edit_data->position_type ?>" class="form-control" placeholder="<?= 'ملکی/صوبائی' ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" name="session"  value="<?= $edit_data->session ?>" class="form-control" placeholder="<?= 'سیشن اور تعلیمی سال' ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <select class="form-control" name="district_id" placeholder="<?= 'ضلع' ?>" >
                            <?php
                            $dsitricts = $this->db->get('district')->result();
                            foreach ($dsitricts as $dist) {
                                ?>
                                <option value="<?= $dist->dist_id ?>" <?php if ($edit_data->district_id == $dist->dist_id) echo 'selected'; ?>><?= $dist->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <select class="form-control" name="class_id" placeholder="<?= 'درجہ' ?>" required="">
                            <?php
                            $classes = $this->db->get('main_classes')->result();
                            foreach ($classes as $class) {
                                ?>
                                <option value="<?= $class->id ?>" <?php if ($edit_data->class_id == $class->class_id) echo 'selected'; ?>><?= $class->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success"><?= 'تصحح پوزیشن ہولڈر' ?></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">								
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                        <img src="<?= base_url('uploads/images/position_holder/' . $edit_data->image) ?>" alt="...">								
                    </div>							
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>								
                    <div>									
                        <span class="btn btn-white btn-file">										
                            <span class="fileinput-new"><?php echo get_phrase('select_image') ?></span>										
                            <span class="fileinput-exists">تبدیل کریں</span>										
                            <input type="file" name="student_image" accept="image/*">									
                        </span>									
                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">ختم کریں</a>								
                    </div>							
                </div>
            </div>


        </form>
    </div>
</div>