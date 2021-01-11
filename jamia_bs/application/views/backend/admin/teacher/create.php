<form method="POST" class="d-block ajaxForm" action="<?php echo route('teacher/create'); ?>" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name"><?php echo get_phrase('name'); ?></label>
            <input type="text" class="form-control" id="name" name = "name" required>
        </div>

        <div class="form-group col-md-12">
            <label for="email"><?php echo get_phrase('email'); ?></label>
            <input type="email" class="form-control" id="email" name = "email" required>
        </div>

        <div class="form-group col-md-12">
            <label for="password"><?php echo get_phrase('password'); ?></label>
            <input type="password" class="form-control" id="password" name = "password" required>
        </div>

        <div class="form-group col-md-12">
            <label for="designation"><?php echo get_phrase('designation'); ?></label>
            <input type="text" class="form-control" id="designation" name = "designation" required>
        </div>

        <div class="form-group col-md-12">
            <label for="department"><?php echo get_phrase('department'); ?></label>
            <select name="department" id="department" class="form-control select2" data-toggle = "select2"  onchange="get_batch(this.value)" required>
                <option value=""><?php echo get_phrase('select_a_department'); ?></option>
                <?php
                $departments = $this->db->get('departments')->result_array();
                foreach ($departments as $department) {
                    ?>
                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="batch">Batch</label>
            <select name="batch" id="batch_id" class="form-control select2" data-toggle = "select2"  onchange="get_semester(this.value)" required>
                <option value="">Select Department First</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="batch">Semester</label>
            <select name="semester" id="semester_id" class="form-control select2" data-toggle = "select2"  required>
                <option value="">Select Batch First</option>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="phone"><?php echo get_phrase('phone_number'); ?></label>
            <input type="text" class="form-control" id="phone" name = "phone" required>
        </div>

        <div class="form-group col-md-12">
            <label for="gender"><?php echo get_phrase('gender'); ?></label>
            <select name="gender" id="gender" class="form-control select2" data-toggle = "select2">
                <option value=""><?php echo get_phrase('select_a_gender'); ?></option>
                <option value="Male"><?php echo get_phrase('male'); ?></option>
                <option value="Female"><?php echo get_phrase('female'); ?></option>
                <option value="Others"><?php echo get_phrase('others'); ?></option>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="blood_group"><?php echo get_phrase('blood_group'); ?></label>
            <select name="blood_group" id="blood_group" class="form-control select2" data-toggle = "select2">
                <option value=""><?php echo get_phrase('select_a_blood_group'); ?></option>
                <option value="a+">A+</option>
                <option value="a-">A-</option>
                <option value="b+">B+</option>
                <option value="b-">B-</option>
                <option value="ab+">AB+</option>
                <option value="ab-">AB-</option>
                <option value="o+">O+</option>
                <option value="o-">O-</option>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label><?php echo get_phrase('facebook_profile_link'); ?></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                </div>
                <input type="text" class="form-control" name="facebook_link">
            </div>

        </div>

        <div class="form-group col-md-12">
            <label><?php echo get_phrase('twitter_profile_link'); ?></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                </div>
                <input type="text" class="form-control" name="twitter_link">
            </div>
        </div>

        <div class="form-group col-md-12">
            <label><?php echo get_phrase('linkedin_profile_link'); ?></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                </div>
                <input type="text" class="form-control" name="linkedin_link">
            </div>
        </div>

        <div class="form-group col-md-12">
            <label for="phone"><?php echo get_phrase('address'); ?></label>
            <textarea class="form-control" id="address" name = "address" rows="5" required></textarea>
        </div>

        <div class="form-group col-md-12">
            <label for="about"><?php echo get_phrase('about'); ?></label>
            <textarea class="form-control" id="about" name = "about" rows="5" required></textarea>
        </div>

        <div class="form-group col-md-12">
            <label for="show_on_website"><?php echo get_phrase('show_on_website'); ?></label>
            <select name="show_on_website" id="show_on_website" class="form-control select2" data-toggle = "select2">
                <option value="1"><?php echo get_phrase('show'); ?></option>
                <option value="0"><?php echo get_phrase('do_not_need_to_show'); ?></option>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="image_file"><?php echo get_phrase('upload_image'); ?></label>
            <input type="file" class="form-control" id="image_file" name = "image_file">
        </div>

        <div class="form-group mt-2 col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('create_teacher'); ?></button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        initSelect2(['#department', '#gender', '#blood_group', '#show_on_website']);
    });
    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function (e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllTeachers);
    });

// initCustomFileUploader();


    function get_batch(department_id) {
        $.ajax({
            url: "<?php echo route('get_department_batch/'); ?>" + department_id,
            success: function (response) {
                $('#batch_id').html(response);
            }
        });
    }
    function get_semester(batch_id) {
        $.ajax({
            url: "<?php echo route('get_batch_semester/'); ?>" + batch_id,
            success: function (response) {
                $('#semester_id').html(response);
            }
        });
    }
</script>
