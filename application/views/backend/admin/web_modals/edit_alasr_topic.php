<?php
$param2 = $this->uri->segment(5);

$edit_data = $this->db->get_where('lib_topics', array('top_id' => $param2))->row();

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    
                    <?php echo 'ٹاپک کی  تصیح کریں' ?>
                </div>
            </div>
                            <?php echo form_open(base_url().'website/alasr_topic/update_topic/'. $edit_data->top_id); ?>

            <div class="panel-body">
                    
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo get_phrase('ٹاپک'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="topicname" name="topicname" class="form-control" value="<?= $edit_data->top_name?>">
                        </div>
                       
                        <label class="col-sm-12 control-label"><?php echo get_phrase('reference'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="reference" name="reference" class="form-control" value="<?= $edit_data->top_reference?>">
                        </div>
                    </div>
                </div>
                 
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo ' داخل کریں'; ?></button>
                        </div>
                    </div>
                   
                </div>
             <?php echo form_close(); ?>
            </div>
        </div>
    </div>





