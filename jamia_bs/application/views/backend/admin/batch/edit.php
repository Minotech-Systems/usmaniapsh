<?php $batches = $this->db->get_where('batch', array('batch_id' => $param1))->result_array(); ?>
<?php foreach ($batches as $batch) { ?>
    <form method="POST" class="d-block ajaxForm" action="<?php echo route('batch/update/' . $param1); ?>">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('department_name'); ?></label>
                <input type="text" class="form-control" value="<?php echo $batch['name']; ?>" id="name" name = "name" required>
            </div>
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('numeric_name'); ?></label>
                <input type="text" class="form-control" value="<?php echo $batch['numeric_name']; ?>" id="numeric_name" name = "numeric_name" required>
            </div>
            <div class="form-group col-md-12">
                <label for=""><?php echo get_phrase('department'); ?></label>
                <select name="department_id" id="" class="form-control "  required>
                    <option value=""><?php echo get_phrase('select_department'); ?></option>
                    <?php
                    $departments = $this->db->get('departments')->result_array();
                    foreach ($departments as $department) {
                        ?>
                        <option value="<?php echo $department['id']; ?>"
                                <?php if ($department['id'] == $batch['department_id']) echo 'selected'; ?>><?php echo $department['name']; ?></option>
                            <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for=""><?php echo get_phrase('start_year'); ?></label>
                <input type="text" class="form-control" id="name" name = "start_year" value="<?= $batch['start_year'] ?>" required >
            </div>
            <div class="form-group col-md-12">
                <label for=""><?php echo get_phrase('end_year'); ?></label>
                <input type="text" class="form-control" id="name" name = "end_year" value="<?= $batch['end_year'] ?>" required>
            </div>
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('comment'); ?></label>
                <input type="text" class="form-control" value="<?php echo $batch['comment']; ?>" id="comment" name = "comment" >
            </div>
            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_batch'); ?></button>
            </div>
        </div>
    </form>
<?php } ?>

<script>
    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function (e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllBatches);
    });
</script>
