<div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add_income_type'); ?>
                    </div>
                </div>
                <div class="panel-body">
    <?php echo form_open(base_url() . 'index.php?admin/income_category/add/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="" > 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('comment'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="comment" value="" > 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_income_type'); ?></button>
                        </div>
                    </div>
    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

