<form method="POST" class="d-block ajaxForm" action="<?php echo route('website/create_gallery'); ?>" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="title"><?php echo get_phrase('gallery_title'); ?></label>
      <input type="text" class="form-control" id="title" name = "title" required>
    </div>

    <div class="form-group col-md-12">
      <label for="title"><?php echo get_phrase('description'); ?></label>
      <textarea name="description" class="form-control" rows="8" cols="80" required></textarea>
    </div>

    <div class="form-group col-md-12">
        <label for="show_on_website"><?php echo get_phrase('show_on_website'); ?></label>
        <select name="show_on_website" id="show_on_website" class="form-control ">
            <option value="1"><?php echo get_phrase('show'); ?></option>
            <option value="0"><?php echo get_phrase('no_need_to_show'); ?></option>
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


