<form method="POST" class="d-block ajaxForm" action="<?php echo route('subject/create'); ?>">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name"><?php echo get_phrase('subject_name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" required>
            <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_subject_name'); ?></small>
        </div>
        <div class="form-group col-md-12">
            <label for="name">Subject Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
            <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_subject_code'); ?></small>
        </div>

        <div class="form-group  col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('create_subject'); ?></button>
        </div>
    </div>
</form>

<script>

    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function (e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllSubjects);
    });
    
</script>
