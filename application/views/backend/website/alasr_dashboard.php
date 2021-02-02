<div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-2" style="border-left: dashed 1px black;">
            <a href="<?php echo base_url('website/dashboard/about_jamia'); ?>"
               class="btn btn-<?php echo $page_content == 'about_jamia' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px;margin-top: 10px;">
                <i class="fa fa-home"></i>
                <?php echo get_phrase('about_jamia'); ?>
            </a>
            <a href="<?php echo base_url('website/alasr_musanif'); ?>"
               class="btn btn-<?php echo $page_content == 'alasr_musanif' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px;margin-top: 10px;">
                <i class="fa fa-home"></i>
                <?php echo get_phrase('Musanif'); ?>
            </a><!--
            <a href="<?php echo base_url('website/dashboard/historical_travel'); ?>"
               class="btn btn-<?php echo $page_content == 'historical_travel' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px;margin-top: 10px;">
                <i class="fa fa-calendar"></i>
                <?php echo get_phrase('historical_travel'); ?>
            </a>
            <a href="<?php echo base_url('website/dashboard/jamia_aim'); ?>"
               class="btn btn-<?php echo $page_content == 'jamia_aim' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px;margin-top: 10px;">
                <i class="entypo-chart-line"></i>
                <?php echo get_phrase('jamia_aim'); ?>
            </a>
            <a href="<?php echo base_url('website/dashboard/books'); ?>"
               class="btn btn-<?php echo $page_content == 'books' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px; ">
                <i class="fa fa-file-o"></i>
                <?php echo get_phrase('books'); ?>
            </a>
            <a href="<?php echo base_url('website/dashboard/news_updates'); ?>"
               class="btn btn-<?php echo $page_content == 'news_updates' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px; ">
                <i class="entypo-newspaper"></i>
                <?php echo get_phrase('news_updates'); ?>
            </a>
            <a href="<?php echo base_url('website/dashboard/departments'); ?>"
               class="btn btn-<?php echo $page_content == 'departments' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px; ">
                <i class="entypo-home"></i>
                <?php echo get_phrase('departments'); ?>
            </a>
            <a href="<?php echo base_url('website/dashboard/admission_notice'); ?>"
               class="btn btn-<?php echo $page_content == 'admission_notice' ? 'info' : 'default'; ?> btn-block" style="text-align:right; padding-right: 15px; ">
                <i class="entypo-home"></i>
                <?php echo get_phrase('admission_notice'); ?>
            </a>-->

        </div>
        <div class="col-md-10 col-sm-10">
            <?php include $page_content . '.php'; ?>
        </div>
    </div>
</div>