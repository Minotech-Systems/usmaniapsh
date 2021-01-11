<?php
$video_edit = $this->db->get_where('video_lectures', array('id' => $video_id))->result();
foreach ($video_edit as $data) {
    ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-2">
            <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('videos/index/update') ?>" method="post">
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('video_title') ?></label>
                    <input type="text" class="form-control" name="title"  value="<?= $data->title ?>"/>
                    <input type="hidden" name="video_id" value="<?= $video_id ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('video_description') ?></label>
                    <textarea class="form-control" rows="3" name="description"> <?= $data->description ?></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('video_section') ?></label>
                    <select class="form-control" name="section_id">
                        <?php
                        $video_sections = $this->db->get('video_section')->result();
                        foreach ($video_sections as $section) {
                            ?>
                            <option value="<?= $section->id ?>" <?php if ($section->id == $data->section_id) echo 'selected'; ?>><?= $section->title ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('video_type') ?></label>
                    <select class="form-control"  name="video_type" >
                        <option value="youtube" <?php if ($data->video_overview_provider == 'yotube') echo 'selected'; ?>><?php echo get_phrase('youtube'); ?></option>
                        <option value="vimeo" <?php if ($data->video_overview_provider == 'vimeo') echo 'selected'; ?>><?php echo get_phrase('vimeo'); ?></option>
                        <option value="html5" <?php if ($data->video_overview_provider == 'html5') echo 'selected'; ?>><?php echo get_phrase('HTML5'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('video_url') ?></label>
                    <input type="text" class="form-control" name="video_url"   value="<?= $data->video_url ?>" placeholder="E.g: https://www.youtube.com/watch?v=oBtf8Yglw2w" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('time') ?></label>
                    <input type="text" class="form-control" name="video_time"  value="<?= $data->duration ?>" placeholder="E.g: hh:mintues:seconds like 0:5:10" required>
                </div>
                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 300px; height: 180px;" data-trigger="fileinput">
                            <img src="<?= base_url('uploads/video_thumbnail/' . $data->thumbnail) ?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 180px"></div>
                        <div>
                            <span class="btn btn-white btn-file">
                                <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                <input type="file" name="video_thumbnail" accept="image/*">
                            </span>
                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success"><?= get_phrase('edit') ?></button>
                </div>
            </form>
        </div>

    </div>
    <?php
}?>