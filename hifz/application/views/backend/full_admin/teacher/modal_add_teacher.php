<?php echo form_open(base_url() . 'index.php?admin/teacher/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>

<div class="form-group">
    <div class="col-sm-6 col-sm-offset-4">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                <img src="" alt="...">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
            <div>
                <span class="btn btn-white btn-file">
                    <span class="fileinput-new">تصویر منتخب کریں</span>
                    <span class="fileinput-exists">تبدیل کریں</span>
                    <input type="file" name="teacher_image" accept="image/*">
                </span>
                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">ختم کریں</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
        <div class="col-sm-6">
            <input type="text"  dir="rtl" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('nic'); ?></label>
        <div class="col-sm-6">
            <input type="text"  dir="ltr" data-mask="99999-9999999-9" placeholder="99999-9999999-9" class="form-control" name="nic" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('current_address'); ?></label>
        <div class="col-sm-6">
            <input type="text"  dir="rtl" class="form-control" name="c_address" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('permanent_address'); ?></label>
        <div class="col-sm-6">
            <input type="text"  dir="rtl" class="form-control" name="p_address" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
        <div class="col-sm-6">
            <input type="text"  dir="ltr" class="form-control" name="phone" data-mask="99999999999" placeholder="03152277999" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
        <div class="col-sm-6">
            <select name="branch_id" class="form-control" required="">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->crud_model->get_table_data('branches');
                foreach ($branches as $branch):
                    ?>
                    <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label>
        <div class="col-sm-6">
            <select name="country_id" class="form-control " onchange="return get_province(this.value)" >
                <option value=""><?php echo get_phrase('select_country'); ?></option>
                <?php
                $country = $this->crud_model->get_table_data('country');
                foreach ($country as $country):
                    ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('province'); ?></label>
        <div class="col-sm-6">
            <select name="province_id" class="form-control" id="prov_selector_holder" onchange="return get_districts(this.value)" >		                            
                <option value=""><?php echo get_phrase('select_country_first'); ?></option>			                        			                    
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
        <div class="col-sm-6">
            <select name="district_id" class="form-control" id="dist_selector_holder">		                            
                <option value=""><?php echo get_phrase('select_province_first'); ?></option>			                        			                    
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo get_phrase('joining_date'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control datepicker" data-start-view="2" name="joining_date" value="<?= date('d-m-Y') ?>" data-format="dd-mm-yyyy">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label"></label>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success"><?= get_phrase('add_teacher') ?></button>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script type="text/javascript">

    function get_province(country_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?admin/get_province/' + country_id,

            success: function (response)

            {
                jQuery('#prov_selector_holder').html(response);

            }});

    }


    function get_districts(prov_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?admin/get_districts/' + prov_id,

            success: function (response)

            {
                jQuery('#dist_selector_holder').html(response);

            }});

    }




</script>