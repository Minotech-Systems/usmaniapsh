<?php $edit_data = $this->db->get_where('child_expense_category',array('id'=>$param2))->result_array();
foreach ($edit_data as $row){?>
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add_expenses_mad'); ?>
                    </div>
                </div>
                <div class="panel-body">
    <?php echo form_open(base_url() . 'index.php?admin/expenses_mad/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name"   value="<?= $row['name']?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('expenses_type'); ?></label>

                    <div class="col-sm-5">
                        <select name="expenses_category_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                                $exp_category = $this->crud_model->get_table_data('expenses_category');
                            foreach ($exp_category as $row1):
                                    
                                ?>
                            <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == $row['expenses_category_id']) echo 'selected';?>><?php echo $row1['name'] ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div> 
                </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('comment'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="comment" value="<?= $row['comment']?>" id="txtcomment_m" > 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_expense_type'); ?></button>
                        </div>
                    </div>
    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php }?>
