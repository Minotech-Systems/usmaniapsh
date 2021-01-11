<?php
$edit_data = $this->db->get_where('web_alasr_resala', array('id' => $param2))->row();
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

                <?php echo form_open(base_url() . 'website/alasr_resala/update/' . $edit_data->id, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" id="txtbook" name="name" class="form-control" value="<?= $edit_data->name?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('year'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" id="txtbook" name="year" class="form-control" value="<?= $edit_data->year?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
                        <div class="col-sm-5">
                            <input type="file" id="txtbook" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo ' تصویر' ?></label>
                        <div class="col-sm-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="<?= base_url('uploads/alasr/'.$edit_data->image) ?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo 'منتخب کریں'; ?></span>
                                        <span class="fileinput-exists"><?php echo 'تبدیل کریں' ?></span>
                                        <input type="file" name="image" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo 'ختم کریں' ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_resala'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>





