
<?php $subjects = $this->db->get_where('subject', array('subject_id' => $param1))->result_array(); ?>
<?php foreach ($subjects as $subject) { ?>
    <form method="POST" class="d-block ajaxForm" action="<?php echo route('subject/update/' . $param1); ?>">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('subject_name'); ?></label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $subject['name']; ?>" required>
                <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_subject_name'); ?></small>
            </div>
            <div class="form-group col-md-12">
                <label for="name"><?php echo get_phrase('subject_code'); ?></label>
                <input type="text" class="form-control" id="code" name="code" value="<?php echo $subject['code']; ?>" required>
                <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_subject_code'); ?></small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">Update Subject</button>
            </div>
        </div>
    </form>
<?php } ?>

<script>
    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function (e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllSubjects);
    });

//    $(document).ready(function () {
//        initSelect2(['#class_id_on_create']);
//    });
</script>
