<?php $semesters = $this->db->get_where('semester', array('id' => $param1))->result_array(); ?>
<?php foreach ($semesters as $sem) { ?>
    <form method="POST" class="d-block ajaxForm" action="<?php echo route('semester/update/' . $param1); ?>">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('semester_name'); ?></label>
                <input type="text" class="form-control" value="<?php echo $sem['name']; ?>" id="name" name = "name" required>
            </div>
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('numeric_name'); ?></label>
                <input type="text" class="form-control" value="<?php echo $sem['numeric_name']; ?>" id="numeric_name" name = "numeric_name" required>
            </div>
            <div class="form-group col-md-12">
                <label for=""><?php echo get_phrase('department'); ?></label>
                <select name="department_id" id="" class="form-control "  required onchange="get_deparment_batch(this.value)">
                    <option value=""><?php echo get_phrase('select_department'); ?></option>
                    <?php
                    $departments = $this->db->get('departments')->result_array();
                    foreach ($departments as $department) {
                        ?>
                        <option value="<?php echo $department['id']; ?>"
                                <?php if ($department['id'] == $sem['department_id']) echo 'selected'; ?>><?php echo $department['name']; ?></option>
                            <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for=""><?php echo get_phrase('batch'); ?></label>
                <select name="batch_id" id="batch" class="form-control "  required>
                    <option value="<?= $sem['batch_id'] ?>">
                        <?php
                        $where = array();
                        $where['batch_id'] = $sem['batch_id'];
                        echo table_column('batch', $where, 'name');
                        ?>
                    </option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('comment'); ?></label>
                <input type="text" class="form-control" value="<?php echo $sem['comment']; ?>" id="comment" name = "comment" >
            </div>
            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_semester'); ?></button>
            </div>
        </div>
    </form>
<?php } ?>

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
