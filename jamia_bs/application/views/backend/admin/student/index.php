<?php if ($working_page == 'filter'): ?>
    <!--title-->
    <div class="row d-print-none">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">
                        <i class="mdi mdi-calendar-today title_icon"></i> <?php echo get_phrase('student'); ?>
                        <a href="<?php echo route('student/create'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_new_student'); ?></a>
                    </h4>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <div class="row d-print-none">
        <div class="col-12">
            <div class="card ">
                <div class="row mt-3">
                    <div class="col-md-2 mb-1">
                        <select name="department_id"  id = "department" class="form-control"   onchange="get_batch(this.value)">
                            <option value="">Select Department</option>
                            <?php
                            $departments = $this->db->get('departments')->result();
                            foreach ($departments as $dept) {
                                ?>
                                <option value="<?= $dept->id ?>"><?php echo $dept->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-1">
                        <select name="batch_id" id="batch" class="form-control"   onchange="get_semester(this.value)">
                            <option value="">Select Department First</option>
                        </select> 
                    </div>
                    <div class="col-md-2 mb-1">
                        <select name="semester_id"  class="form-control"  id="semester" onchange="get_section(this.value)">
                            <option value="">Select Batch First</option>
                        </select> 
                    </div>
                    <div class="col-md-2 mb-1">
                        <select name="section_id" id="section" class="form-control">
                            <option value="">Select Semester First</option>
                        </select> 
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-secondary" onclick="filter_student()" ><?php echo get_phrase('filter'); ?></button>
                    </div>
                </div>
                <div class="card-body student_content">
                    <div class="empty_box">
                        <img class="mb-3" width="150px" src="<?php echo base_url('assets/backend/images/empty_box.png'); ?>" />
                        <br>
                        <span class=""><?php echo get_phrase('no_data_found'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($working_page == 'create'): ?>
    <?php include 'create.php'; ?>
<?php elseif ($working_page == 'edit'): ?>
    <?php include 'update.php'; ?>
<?php endif; ?>

<script>
    $('document').ready(function () {

    });

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

    function filter_student() {
        var department_id = $('#department').val();
        var batch_id = $('#batch').val();
        var semester_id = $('#semester').val();
        var section_id = $('#section').val();
        if (department_id != "" || batch_id != "" || semester_id != "" || section_id != "") {
            showAllStudents();
        } else {
            toastr.error('<?php echo get_phrase('please_select_a_class_and_section'); ?>');
        }
    }

    var showAllStudents = function () {
        var department_id = $('#department').val();
        var batch_id = $('#batch').val();
        var semester_id = $('#semester').val();
        var section_id = $('#section').val();
        if (department_id != "" || batch_id != "" || semester_id != "" || section_id != "") {
            $.ajax({
                url: '<?php echo route('student/filter/') ?>' + department_id + '/' + batch_id + '/' + semester_id + '/' + section_id,
                success: function (response) {
                    $('.student_content').html(response);
                }
            });
        }
    }
</script>
