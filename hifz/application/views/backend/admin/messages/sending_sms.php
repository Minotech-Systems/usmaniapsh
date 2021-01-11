<hr>
<div class="row">
    <div class="col-md-2">
        <a href="<?php echo base_url(); ?>index.php?message/sending_sms/send_general_sms"
           class="btn btn-<?php echo $page_content == 'send_general_sms' ? 'info' : 'default'; ?> btn-block">
            <i class="fa fa-envelope"></i>
            <?php echo get_phrase('general_sms'); ?>
        </a>
        <a href="<?php echo base_url(); ?>index.php?message/sending_sms/mark_sms"
           class="btn btn-<?php echo $page_content == 'mark_sms' ? 'info' : 'default'; ?> btn-block">
            <i class="fa fa-envelope"></i>
            <?php echo get_phrase('exam_sms'); ?>
        </a> 
        <a href="<?php echo base_url(); ?>index.php?message/sending_sms/combine_exam_sms"
           class="btn btn-<?php echo $page_content == 'combine_exam_sms' ? 'info' : 'default'; ?> btn-block">
            <i class="fa fa-envelope"></i>
            <?php echo get_phrase('combine_exam_sms'); ?>
        </a>
        <a href="<?php echo base_url(); ?>index.php?message/sending_sms/parent_login_sms"
           class="btn btn-<?php echo $page_content == 'parent_login_sms' ? 'info' : 'default'; ?> btn-block">
            <i class="fa fa-envelope"></i>
            <?php echo get_phrase('parent_login_sms'); ?>
        </a>

    </div>
    <div class="col-md-10" style="border-right: dashed #3390c3;">
        <?php include $page_content . '.php'; ?>
    </div>
</div>
