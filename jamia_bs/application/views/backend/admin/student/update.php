<!--title-->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
                <i class="mdi mdi-update title_icon"></i> <?php echo get_phrase('student_update_form'); ?>
            </h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card pt-0">
            <?php
            $student_data = $this->admin_model->student_data('student', $student_id);
            foreach ($student_data as $data) {
                ?>
                <h4 class="text-center mx-0 py-2 mt-0 mb-3 px-0 text-white bg-primary"><?php echo get_phrase('update_student_information'); ?></h4>
                <form method="POST" class="col-12 d-block ajaxForm" action="<?php echo route('student/updated/' . $student_id . '/' . $data['user_id']); ?>" id = "student_update_form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="name">Name</label>
                                <div class="col-md-7">
                                    <input type="text" id="name" name="name"  value="<?= $data['student_name'] ?>" class="form-control" placeholder="name" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="email">Father Name</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" value="<?= $data['father_name'] ?>" name="father_name" placeholder="father_name" required>
                                </div>
                            </div>
                        </div>

                        <!--.-->
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="gender"><?php echo get_phrase('gender'); ?></label>
                                <div class="col-md-7">
                                    <select name="gender" id="gender" class="form-control select2" data-toggle = "select2"  required>
                                        <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                        <option value="Male" <?php if ($data['gender'] == 'Male') echo 'selected'; ?>><?php echo get_phrase('male'); ?></option>
                                        <option value="Female" <?php if ($data['gender'] == 'Female') echo 'selected'; ?>><?php echo get_phrase('female'); ?></option>
                                        <option value="Others" <?php if ($data['gender'] == 'Others') echo 'selected'; ?>><?php echo get_phrase('others'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" >Test Marks</label>
                                <div class="col-md-7">
                                    <input type="number" name="test_marks" value="<?= $data['test_marks'] ?>" class="form-control" placeholder="Test Marks" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Occupation</label>
                                <div class="col-md-7">
                                    <input type="text" name="occupation"  value="<?= $data['father_profession'] ?>" class="form-control" placeholder="occupation" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Phone</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control"  value="<?= $data['student_phone'] ?>"  name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Test Roll No</label>
                                <div class="col-md-7">
                                    <input type="text"  class="form-control" name="test_roll"  value="<?= $data['test_rollno'] ?>" >
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">DOB</label>
                                <div class="col-md-7">
                                    <input type="text"  class="form-control date" name="dob" data-toggle="date-picker" data-single-date-picker="true" value="<?= date('d-m-Y', strtotime($data['dob'])) ?>" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Department</label>
                                <div class="col-md-7">

                                    <select name="department_id"  class="form-control"   onchange="get_batch(this.value)">
                                        <option value="">Select Department</option>
                                        <?php
                                        $departments = $this->db->get('departments')->result();
                                        foreach ($departments as $dept) {
                                            ?>
                                            <option value="<?= $dept->id ?>" <?php if ($data['department_id'] == $dept->id) echo 'selected'; ?>><?php echo $dept->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Batch</label>
                                <div class="col-md-7">
                                    <select name="batch_id" id="batch" class="form-control"   onchange="get_semester(this.value)">
                                        <option value="<?= $data['batch_id'] ?>" selected=""><?= $data['batch_name'] ?></option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" >Current Address</label>
                                <div class="col-md-7">
                                    <input type="text" name="current_address" class="form-control" value="<?= $data['c_address'] ?>" placeholder="Current Address" autocomplete="off" autofocus="off" required >
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Permanent Address</label>
                                <div class="col-md-7">
                                    <input type="text" name="permanent_address" class="form-control"  value="<?= $data['p_address'] ?>" placeholder="Permanent Address" autocomplete="off" required > 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Semester</label>
                                <div class="col-md-7">
                                    <select name="semester_id"  class="form-control"  id="semester" onchange="get_section(this.value)">
                                        <option value="<?= $data['semester_id'] ?>" selected=""><?= $data['semester_name'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Section</label>
                                <div class="col-md-7">
                                    <select name="section_id" id="section" class="form-control">
                                        <option value="<?= $data['section_id'] ?>" selected=""><?= $data['section_name'] ?></option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Country</label>
                                <div class="col-md-7">
                                    <select name="country_id"  class="form-control" onchange="get_province(this.value)">
                                        <option value="">Select Country</option>
                                        <?php
                                        $countries = $this->db->get('country')->result();
                                        foreach ($countries as $count) {
                                            ?>
                                            <option value="<?= $count->country_id ?>" 
                                                    <?php if ($data['country_id'] == $count->country_id) echo 'selected'; ?>>
                                                <?= $count->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Province</label>
                                <div class="col-md-7">
                                    <select name="province_id" id="province" class="form-control" onchange="get_district(this.value)">
                                        <option value="<?= $data['province_id'] ?>">
                                            <?= $this->db->get_where('province', array('prov_id' => $data['province_id']))->row()->name ?>
                                        </option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">District</label>
                                <div class="col-md-7">
                                    <select name="district_id" id="district" class="form-control" >
                                        <option value="<?= $data['district_id'] ?>">
                                            <?= $this->db->get_where('district', array('dist_id' => $data['district_id']))->row()->name ?>
                                        </option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-secondary col-md-4 col-sm-12 mb-4">
                            Update Student 
                        </button>

                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

