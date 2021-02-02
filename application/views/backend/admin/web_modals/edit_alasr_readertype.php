<?php
$param2 = $this->uri->segment(5);
 
$edit_data = $this->db->get_where('lib_readertype', array('readtype_id' => $param2))->row();

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    
                    <?php echo 'قسم کی  تصیح کریں' ?>
                </div>
            </div>
                            <?php echo form_open(base_url().'website/alasr_readertype/update_readertype/'. $edit_data->readtype_id); ?>

            <div class="panel-body">
                    
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="name" name="name" class="form-control" value="<?= $edit_data->readtype_name?>">
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





