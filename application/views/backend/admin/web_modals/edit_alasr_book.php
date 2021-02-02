<?php
$param2 = $this->uri->segment(5);

$edit_data = $this->db->get_where('lib_books', array('book_id' => $param2))->row();

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    
                    <?php echo 'کتاب کی  تصیح کریں' ?>
                </div>
            </div>
                            <?php echo form_open(base_url().'website/alasr_book/update_book/'. $edit_data->book_id); ?>

            <div class="panel-body">
                    
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo get_phrase('کتاب'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="book" name="book" class="form-control" value="<?= $edit_data->book_name?>">
                        </div>
                        <label class="col-sm-12 control-label"><?php echo get_phrase('ایڈیشن'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="edition" name="edition" class="form-control" value="<?= $edit_data->book_edition?>">
                        </div>
                        <label class="col-sm-12 control-label"><?php echo get_phrase('شائع'); ?></label>
                        <div class="col-sm-12">
                            <input type="date" id="publish" name="publish" class="form-control" value="<?=date('Y-m-d',  strtotime($edit_data->book_publish_date)) ?>">
                        </div>
                         <label class="col-sm-12 control-label"><?php echo get_phrase('ختم مدت'); ?></label>
                        <div class="col-sm-12">
                            <input type="date" id="expiery" name="expiery" class="form-control" value="<?= date('Y-m-d',  strtotime($edit_data->book_expirey_date))?>">
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





