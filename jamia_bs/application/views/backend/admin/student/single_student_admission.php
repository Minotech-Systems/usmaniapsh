
<form method="POST" class="col-12 d-block ajaxForm" action="<?php echo route('student/create_single_student'); ?>" id = "student_admission_form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label" for="name">Name</label>
                <div class="col-md-7">
                    <input type="text" id="name" name="name" class="form-control" placeholder="name" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label" for="email">Father Name</label>
                <div class="col-md-7">
                    <input type="text" class="form-control"  name="father_name" placeholder="father_name" required>
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
                        <option value="Male" selected=""><?php echo get_phrase('male'); ?></option>
                        <option value="Female"><?php echo get_phrase('female'); ?></option>
                        <option value="Others"><?php echo get_phrase('others'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label" >Test Marks</label>
                <div class="col-md-7">
                    <input type="number" name="test_marks" class="form-control" placeholder="Test Marks" required autocomplete="off">
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Occupation</label>
                <div class="col-md-7">
                    <input type="text" name="occupation" class="form-control" placeholder="occupation" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Phone</label>
                <div class="col-md-7">
                    <input type="text" class="form-control"  name="phone" placeholder="Phone" required>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Test Roll No</label>
                <div class="col-md-7">
                    <input type="text"  class="form-control" name="test_roll">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">DOB</label>
                <div class="col-md-7">
                    <input type="text"  class="form-control date" name="dob" data-toggle="date-picker" data-single-date-picker="true" required="">
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
                            <option value="<?= $dept->id ?>"><?php echo $dept->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Batch</label>
                <div class="col-md-7">
                    <select name="batch_id" id="batch" class="form-control"   onchange="get_semester(this.value)">
                        <option value="">Select Department First</option>
                    </select> 
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label" >Current Address</label>
                <div class="col-md-7">
                    <input type="text" name="current_address" class="form-control" placeholder="Current Address" autocomplete="off" autofocus="off" required >
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Permanent Address</label>
                <div class="col-md-7">
                    <input type="text" name="permanent_address" class="form-control" placeholder="Permanent Address" autocomplete="off" required > 
                </div>
            </div>
        </div>

    </div>
    <!--.-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Semester</label>
                <div class="col-md-7">
                    <select name="semester_id"  class="form-control"  id="semester" onchange="get_section(this.value)">
                        <option value="">Select Batch First</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Section</label>
                <div class="col-md-7">
                    <select name="section_id" id="section" class="form-control">
                        <option value="">Select Semester First</option>
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
                            <option value="<?= $count->country_id ?>"><?= $count->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label">Province</label>
                <div class="col-md-7">
                    <select name="province_id" id="province" class="form-control" onchange="get_district(this.value)">
                        <option value="">Select Country First</option>
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
                        <option value="">Select Province First</option>
                    </select> 
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-12">
        <label class="col-md-4 col-form-label" for="example-fileinput"><?php echo get_phrase('student_profile_image'); ?></label>
        <div class="col-md-8 custom-file-upload">
            <div class="wrapper-image-preview" style="margin-left: -6px;">
                <div class="box" style="width: 250px;">
                    <div class="js--image-preview" style="background-image: url(<?php echo base_url('uploads/users/placeholder.jpg'); ?>); background-color: #F5F5F5;"></div>
                    <div class="upload-options">
                        <label for="student_image" class="btn"> <i class="mdi mdi-camera"></i> <?php echo get_phrase('upload_an_image'); ?> </label>
                        <input id="student_image" style="visibility:hidden;" type="file" class="image-upload" name="student_image" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="text-center">
        <button type="submit" class="btn btn-secondary col-md-4 col-sm-12 mb-4"><?php echo get_phrase('add_student'); ?></button>

    </div>

</form>

<script type="text/javascript">
//    var form;
//    $(".ajaxForm").submit(function (e) {
//        form = $(this);
//        ajaxSubmit(e, form, refreshForm);
//    });

    var refreshForm = function () {
        form.trigger("reset");
        $('#student_image').val('');
        $('.js--image-preview').prepend('<img class="js--image-preview" src="style="background-image: url(<?php echo base_url('uploads/users/placeholder.jpg'); ?>); background-color: #F5F5F5;"" />')

    }


    function get_batch(department_id) {
        $.ajax({
            url: "<?php echo route('get_department_batch/'); ?>" + department_id,
            success: function (response) {
                $('#batch').html(response);
            }
        });
    }
    function get_semester(batch_id) {
        $.ajax({
            url: "<?php echo route('get_batch_semester/'); ?>" + batch_id,
            success: function (response) {
                $('#semester').html(response);
            }
        });
    }

    function get_section(semester_id) {
        $.ajax({
            url: "<?php echo route('get_semester_section/'); ?>" + semester_id,
            success: function (response) {
                $('#section').html(response);
            }
        });
    }
    function get_province(country_id) {

        $.ajax({
            url: "<?php echo route('get_provinces/'); ?>" + country_id,
            success: function (response) {
                $('#province').html(response);
            }
        });
    }

    function get_district(province_id) {
        $.ajax({
            url: "<?php echo route('get_district/'); ?>" + province_id,
            success: function (response) {
                $('#district').html(response);
            }
        });
    }



</script>
