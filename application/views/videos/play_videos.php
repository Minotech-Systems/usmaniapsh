<?php
//$course_details = $this->lms_model->get_course_by_id($course_id);
?>
<div class="container-fluid course_container">
    <!-- Top bar -->
    <div class="row">
        <div class="col-lg-9 course_header_col">
            <h5>
                <img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height="25"> 
                <?= 'جامعہ عثمانیہ پشاور'?>
            </h5>
        </div>
        <div class="col-lg-3 course_header_col">
            <a href="javascript::" class="course_btn" onclick="toggle_lesson_view()"><i class="mdi mdi-chevron-right"></i><i class="mdi mdi-chevron-left"></i></a>
            <a href="<?php echo site_url('videos'); ?>" class="course_btn"> <i class="mdi mdi-chevron-left"></i> <?php echo get_phrase('back_to_site'); ?></a>
        </div>
    </div>

    <div class="row" id = "lesson-container">
        <?php include 'video_body.php'; ?>

        <?php include 'video_sidebar.php'; ?>
    </div>
</div>

