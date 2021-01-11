<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-account-multiple-check title_icon"></i> <?php echo get_phrase('assigned_permission_for_teacher'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row mt-3">
                <div class="col-md-3">
                    <select name="department" id="department_id" class="form-control select2" data-toggle = "select2" onchange="get_batch(this.value)" required>
                        <option value=""><?php echo get_phrase('select_a_department'); ?></option>
                        <?php
                        $departments = $this->db->get('departments')->result_array();
                        foreach ($departments as $dept) {
                            ?>
                            <option value="<?php echo $dept['id']; ?>"><?php echo $dept['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="batch" id="batch_id" class="form-control select2" data-toggle = "select2"   onchange="get_semester(this.value)"required>
                        <option value="">Select Department First</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="semester" id="semester_id" class="form-control select2" data-toggle = "select2"  required>
                        <option value="">Select Batch First</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-block btn-secondary" onclick="filter()" ><?php echo get_phrase('filter'); ?></button>
                </div>
            </div>
            <div class="card-body permission_content">
                <div class="empty_box">
                    <img class="mb-3" width="150px" src="<?php echo base_url('assets/backend/images/empty_box.png'); ?>" />
                    <br>
                    <span class=""><?php echo get_phrase('no_data_found'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modyfy section -->
<script>
//    $('document').ready(function(){
//
//    });

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

    function filter() {
        var department_id = $('#department_id').val();
        var batch_id = $('#batch_id').val();
        var semester_id = $('#semester_id').val();
        if (department_id != "" && batch_id != "" && semester_id != "") {
            $.ajax({
                url: '<?php echo route('permission/filter/') ?>' + department_id + '/' + batch_id + '/' + semester_id,
                success: function (response) {
                    $('.permission_content').html(response);
                }
            });
        } else {
            toastr.error('<?php echo get_phrase('please_select_a_class_and_section'); ?>');
        }
    }
</script>

<!-- permission insert and update -->
<script>
    function togglePermission(checkbox_id, column_name, teacher_id) {

        var value = $('#' + checkbox_id).val();
        if (value == 1) {
            value = 0;
        } else {
            value = 1;
        }
        var department_id = $('#department_id').val();
        var batch_id = $('#batch_id').val();
        var semester_id = $('#semester_id').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo route('permission/modify_permission/') ?>',
            data: {department_id: department_id, batch_id: batch_id, semester_id: semester_id, teacher_id: teacher_id, column_name: column_name, value: value},
            success: function (response) {
                $('.permission_content').html(response);
                toastr.success('<?php echo get_phrase('permission_updated_successfully.'); ?>');
            }
        });

    }


</script>
