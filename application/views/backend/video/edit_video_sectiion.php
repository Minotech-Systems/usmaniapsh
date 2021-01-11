<?php
$section_edit = $this->db->get_where('video_section', array('id' => $section_id))->result();
foreach ($section_edit as $data) {
    ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-2">
            <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('videos/update_section') ?>" method="post">
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('title') ?></label>
                    <input type="text" class="form-control" name="title"  value="<?= $data->title ?>"/>
                    <input type="hidden" name="section_id" value="<?= $section_id ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="full_name"><?= get_phrase('description') ?></label>
                    <textarea class="form-control" rows="3" name="description"> <?= $data->description ?></textarea>
                </div>

                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 300px; height: 180px;" data-trigger="fileinput">
                            <img src="<?= base_url('uploads/section_thumbnail/' . $data->thumbnail) ?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 180px"></div>
                        <div>
                            <span class="btn btn-white btn-file">
                                <span class="fileinput-new"><?php echo get_phrase('select_image'); ?></span>
                                <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                <input type="file" name="section_thumbnail" accept="image/*">
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