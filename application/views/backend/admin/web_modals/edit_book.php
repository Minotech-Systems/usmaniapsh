<?php
$edit_data = $this->db->get_where('web_books', array('book_id' => $param2))->row();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_book'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'website/books/update/' . $edit_data->book_id, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name1" value="<?php echo $edit_data->name ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
                        <div class="col-sm-9 col-md-9">
                            <textarea class="form-control" rows="4"  name="description1"style="line-height: 2.5"><?= $edit_data->description ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'کتاب تصویر' ?></label>
                        <div class="col-sm-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="<?= base_url("uploads/books/$edit_data->image") ?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo 'منتخب کریں'; ?></span>
                                        <span class="fileinput-exists"><?php echo 'تبدیل کریں' ?></span>
                                        <input type="file" name="book_image_e" accept="image/*" >
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo 'ختم کریں' ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('show_on_site'); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="show_on_site">
                                <option value="1"<?php if ($edit_data->show_on_website == 1) echo 'selected'; ?>><?= 'ہاں' ?></option>
                                <option value="0" <?php if ($edit_data->show_on_website == 0) echo 'selected'; ?>><?= 'نہیں' ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_book'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>





