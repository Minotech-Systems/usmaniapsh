<?php
$teacher = $this->db->get_where('teacher', array('teacher_id' => $param1))->result_array();

foreach ($teacher as $data):
    $users = $this->db->get_where('users', array('id' => $data['user_id']))->row_array();
    $teach = $this->db->get_where('teacher', array('teacher_id' => $param1))->row_array();
    $social_links = json_decode($teach['social_links'], true);
    ?>
    <form method="POST" class="d-block ajaxForm" action="<?php echo route('teacher/update/' . $param1); ?>">
        <div class="form-row">
            <input type="hidden" value="<?= $data['user_id'] ?>" name="user_id">
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('name'); ?></label>
                <input type="text" value="<?php echo $data['name']; ?>" class="form-control" id="name" name = "name" required>
            </div>

            <div class="form-group col-md-12">
                <label for="email"><?php echo get_phrase('email'); ?></label>
                <input type="email" value="<?php echo $users['email']; ?>" class="form-control" id="email" name = "email" required>
            </div>

            <div class="form-group col-md-12">
                <label for="designation"><?php echo get_phrase('designation'); ?></label>
                <input type="text" value="<?php echo $data['designation']; ?>" class="form-control" id="designation" name = "designation" required>
            </div>

            <div class="form-group col-md-12">
                <label for="phone"><?php echo get_phrase('phone_number'); ?></label>
                <input type="text" value="<?php echo $data['phone']; ?>" class="form-control" id="phone" name = "phone" required>

            </div>

            <div class="form-group col-md-12">
                <label for="gender"><?php echo get_phrase('gender'); ?></label>
                <select name="gender" id="gender" class="form-control select2" data-toggle = "select2">
                    <option value=""><?php echo get_phrase('select_a_gender'); ?></option>
                    <option value="Male" <?php if ($data['sex'] == 'Male') echo 'selected'; ?>><?php echo get_phrase('male'); ?></option>
                    <option value="Female" <?php if ($data['sex'] == 'Female') echo 'selected'; ?>><?php echo get_phrase('female'); ?></option>
                    <option value="Others" <?php if ($data['sex'] == 'Others') echo 'selected'; ?>><?php echo get_phrase('others'); ?></option>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label for="blood_group"><?php echo get_phrase('blood_group'); ?></label>
                <select name="blood_group" id="blood_group" class="form-control select2" data-toggle = "select2">
                    <option value=""><?php echo get_phrase('select_a_blood_group'); ?></option>
                    <option value="a+" <?php if ($data['blood_group'] == 'a+') echo 'selected'; ?>>A+</option>
                    <option value="a-" <?php if ($data['blood_group'] == 'a-') echo 'selected'; ?>>A-</option>
                    <option value="b+" <?php if ($data['blood_group'] == 'b+') echo 'selected'; ?>>B+</option>
                    <option value="b-" <?php if ($data['blood_group'] == 'b-') echo 'selected'; ?>>B-</option>
                    <option value="ab+" <?php if ($data['blood_group'] == 'ab+') echo 'selected'; ?>>AB+</option>
                    <option value="ab-" <?php if ($data['blood_group'] == 'ab-') echo 'selected'; ?>>AB-</option>
                    <option value="o+" <?php if ($data['blood_group'] == 'o+') echo 'selected'; ?>>O+</option>
                    <option value="o-" <?php if ($data['blood_group'] == '0-') echo 'selected'; ?>>O-</option>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label><?php echo get_phrase('facebook_profile_link'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                    </div>
                    <input type="text" class="form-control" name="facebook_link" value="<?php echo $social_links['facebook']; ?>">
                </div>
            </div>

            <div class="form-group col-md-12">
                <label><?php echo get_phrase('twitter_profile_link'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                    </div>
                    <input type="text" class="form-control" name="twitter_link" value="<?php echo $social_links['twitter']; ?>">
                </div>
            </div>

            <div class="form-group col-md-12">
                <label><?php echo get_phrase('linkedin_profile_link'); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                    </div>
                    <input type="text" class="form-control" name="linkedin_link" value="<?php echo $social_links['linkedin']; ?>">
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="phone"><?php echo get_phrase('address'); ?></label>
                <textarea class="form-control" id="address" name = "address" rows="5" required><?php echo $data['address']; ?></textarea>

            </div>

            <div class="form-group col-md-12">
                <label for="about"><?php echo get_phrase('about'); ?></label>
                <textarea class="form-control" id="about" name = "about" rows="5" required><?php echo $data['about']; ?></textarea>

            </div>

            <div class="form-group col-md-12">
                <label for="show_on_website"><?php echo get_phrase('show_on_website'); ?></label>
                <select name="show_on_website" id="show_on_website" class="form-control select2" data-toggle = "select2">
                    <option value="1" <?php if ($data['show_on_website'] == 1) echo 'selected'; ?>><?php echo get_phrase('show'); ?></option>
                    <option value="0" <?php if ($data['show_on_website'] == 0) echo 'selected'; ?>><?php echo get_phrase('do_not_need_to_show'); ?></option>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label for="image_file"><?php echo get_phrase('upload_image'); ?></label>
                <input type="file" class="form-control" id="image_file" name = "image_file">
            </div>

            <div class="form-group mt-2 col-md-12">
                <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_teacher'); ?></button>
            </div>
        </div>
    </form>
<?php endforeach; ?>

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
</script>
