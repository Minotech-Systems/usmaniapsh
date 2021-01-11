<?php $gallery = $this->db->get_where('frontend_gallery', array('frontend_gallery_id' => $param2))->row_array(); ?>
<form method="POST" class="d-block" action="<?php echo base_url('website/frontend_gallery/update/' . $param2); ?>" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="title"><?php echo get_phrase('gallery_title'); ?></label>
            <input type="text" class="form-control" id="title" name = "title" value="<?php echo $gallery['title']; ?>" required>
        </div>

        <div class="form-group col-md-12">
            <label for="title"><?php echo get_phrase('description'); ?></label>
            <textarea name="description" class="form-control" rows="8" cols="80" required><?php echo $gallery['description']; ?></textarea>
        </div>

        <div class="form-group col-md-12">
            <label for="show_on_website"><?php echo get_phrase('show_on_website'); ?></label>
            <select name="show_on_website" id="show_on_website" class="form-control">
                <option value="1" <?php if ($gallery['show_on_website'] == 1) echo "selected"; ?>><?php echo get_phrase('show'); ?></option>
                <option value="0" <?php if ($gallery['show_on_website'] == 0) echo "selected"; ?>><?php echo get_phrase('no_need_to_show'); ?></option>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="cover_image"><?php echo get_phrase('cover_image'); ?></label>
            <div class="custom-file-upload">
                <input type="file" class="form-control" id="cover_image" name = "cover_image" required>
            </div>
        </div>

        <div class="form-group  col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('save_gallery'); ?></button>
        </div>
    </div>
</form>

