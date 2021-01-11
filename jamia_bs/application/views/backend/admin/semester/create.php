<form method="POST" class="d-block ajaxForm" action="<?php echo route('semester/create'); ?>">
    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="name"><?php echo get_phrase('semester_name'); ?></label>
            <input type="text" class="form-control" id="name" name = "name" required>
        </div>
        <div class="form-group col-md-12">
            <label for="name"><?php echo get_phrase('numeric_name'); ?></label>
            <input type="number" class="form-control" id="name" name = "numeric_name" required>
        </div>
        <div class="form-group col-md-12">
            <label for=""><?php echo get_phrase('department'); ?></label>
            <select name="department_id" id="" class="form-control "  required onchange="get_deparment_batch(this.value)">
                <option value=""><?php echo get_phrase('select_department'); ?></option>
                <?php
                $departments = $this->db->get('departments')->result_array();
                foreach ($departments as $department) {
                    ?>
                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for=""><?php echo get_phrase('batch'); ?></label>
            <select name="batch_id" id="batch" class="form-control "  required>
                <option value=""><?php echo get_phrase('select_batch_first'); ?></option>
            </select>
        </div>
        
        <div class="form-group col-md-12">
            <label for="name"><?php echo get_phrase('comment'); ?></label>
            <input type="text" class="form-control" id="name" name = "comment" >
        </div>

        <div class="form-group  col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('create_semester'); ?></button>
        </div>
    </div>
</form>

<script>
    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function (e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllSemester);
    });

    function get_deparment_batch(department_id) {
        $.ajax({
            url: "<?php echo route('get_deparment_batch/'); ?>" + department_id,
            success: function (response) {
                $('#batch').html(response);
            }
        });
    }
</script>
