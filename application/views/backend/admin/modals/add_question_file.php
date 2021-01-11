<?php
$edit_data = $this->db->get_where('ifta_question', array('question_id' => $param2))->row();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_file'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'questions/upload_question_file/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype'=>'multipart/form-data')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo 'عنوان' ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control"  value="<?php echo $edit_data->title ?>" disabled="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= 'تشریح' ?></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" disabled="" rows="5"><?php echo $edit_data->question ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= 'فائل' ?></label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="question_file">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_file'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>





