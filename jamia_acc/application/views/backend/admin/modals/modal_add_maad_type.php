<script src="assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtname_m);//enable Urdu in html text box
        MakeTextBoxUrduEnabled(txtcomment_m);//enable Urdu in html text box
       

    }

</script>

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
    <?php echo form_open(base_url() . 'index.php?admin/expenses_mad/add/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="" id="txtname_m"> 
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('expenses_type'); ?></label>

                    <div class="col-sm-5">
                        <select name="expenses_category_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                                $exp_category = $this->crud_model->get_table_data('expenses_category');
                            foreach ($exp_category as $row):
                                    
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name'] ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div> 
                </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('comment'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="comment" value="" id="txtcomment_m"> 
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

