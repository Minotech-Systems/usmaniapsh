<script src="assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtname);
        MakeTextBoxUrduEnabled(txtparent);
        MakeTextBoxUrduEnabled(txtpaddress);
        MakeTextBoxUrduEnabled(txtcaddress);
        MakeTextBoxUrduEnabled(txtgname);
        MakeTextBoxUrduEnabled(txtgpname);
        MakeTextBoxUrduEnabled(txtgaddress);

    }

</script>
<hr>
<?php echo form_open(base_url() . 'index.php?admission/admit_student/', array('class' => 'form-wizard validate', 'id' => 'rootwizard-2', 'enctype' => 'multipart/form-data', 'target' => '_top'));
?>



<div class="steps-progress">
    <div class="progress-indicator"></div>
</div>

<ul>
    <li class="active">
        <a href="#tab2-1" data-toggle="tab"><span>1</span><?php echo get_phrase('personal_info') ?></a>
    </li>
    <li>
        <a href="#tab2-2" data-toggle="tab"><span>3</span><?php echo get_phrase('تعلیمی معلومات') ?></a>
    </li>
    <li>
        <a href="#tab2-3" data-toggle="tab"><span>4</span><?php echo get_phrase(' سرپرت تفصیل') ?></a>
    </li>
</ul>
<div class="col-md-10 col-md-offset-1">
    <div class="tab-content" style="margin-top: 12px;">

        <!--    -Personal Detail Start-->
        <div class="tab-pane active" id="tab2-1">
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="name"><?php echo get_phrase('name'); ?>*</label>
                            <input type="text" class="form-control" name="name"  id="txtname" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('parent'); ?>*</label>
                            <input type="text" class="form-control" name="father_name"  id="txtparent" />
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('current_address'); ?>*</label>
                            <input type="text" class="form-control" name="c_address"  id="txtcaddress" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('permanent_address'); ?></label>
                            <input type="text" class="form-control" name="p_address"  id="txtpaddress"/>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('country'); ?></label>
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
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('province'); ?></label>
                            <select name="province_id" class="form-control" id="prov_selector_holder" onchange="return get_districts(this.value)" >		                            
                                <option value=""><?php echo get_phrase('select_country_first'); ?></option>			                        			                    
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('district'); ?></label>
                            <select name="district_id" class="form-control" id="dist_selector_holder">		                            
                                <option value=""><?php echo get_phrase('select_province_first'); ?></option>			                        			                    
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('dob'); ?>*</label>
                            <input type="text" class="form-control datepicker" data-start-view="2" name="dob" data-format="dd-mm-yyyy" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('branch'); ?></label>
                                <select name="branch_id" class="form-control " required="" onchange="get_classes(this.value)">
                                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                                    <?php
                                    $branches = $this->crud_model->get_table_data('branches');
                                    foreach ($branches as $bran) {
                                        ?>
                                        <option value="<?= $bran['branch_id'] ?>"><?php echo $bran['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('class'); ?></label>
                                <select name="class_id" id="class_holder" class="form-control " required="" onchange="get_sections(this.value)">
                                    <option value=""><?php echo get_phrase('select_branch_first'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-md-4">
                    <div class="row" style="text-align: center;">
                        <div class="fileinput fileinput-new col-md-12 col-md-offset-1" data-provides="fileinput">								
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                                <img src="http://placehold.it/200x200" alt="...">								
                            </div>							
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>								
                            <div>									
                                <span class="btn btn-white btn-file">										
                                    <span class="fileinput-new"><?php echo get_phrase('select_image') ?></span>										
                                    <span class="fileinput-exists">تبدیل کریں</span>										
                                    <input type="file" name="student_image" accept="image/*">									
                                </span>									
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">ختم کریں</a>								
                            </div>							
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo get_phrase('father_nic'); ?>*</label>
                                <input dir="ltr" type="text" class="form-control" name="father_nic"  data-mask="99999-9999999-9" placeholder="99999-9999999-9" required=""/> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo get_phrase('father_phone'); ?>*</label>
                                <input dir="ltr" type="text" class="form-control" name="father_phone"  data-mask="99999999999" placeholder="03153344555" required=""/> 
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('section'); ?></label>
                                <select name="section_id" id="section_holder" class="form-control " required="" >
                                    <option value=""><?php echo get_phrase('select_class_first'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab2-2">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('quran_nazra'); ?></label>
                        <input type="text" class="form-control" name="quran_nazra"  /> 
                    </div>
                </div>
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('hifz'); ?></label>
                        <input type="text" class="form-control" name="hifz"  /> 
                    </div>
                </div>
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('madrasa'); ?></label>
                        <input type="text" class="form-control" name="madrasa"  /> 
                    </div>
                </div>
            </div>
            <div class="row">
                <p><?= 'عصری علوم۔' ?></p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('class'); ?></label>
                        <input type="text" class="form-control" name="class"  /> 
                    </div>
                </div>
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label" ><?php echo get_phrase('school'); ?></label>
                        <select name="school" class="form-control ">
                            <option value=""><?php echo get_phrase('select_school'); ?></option>
                            <option value="پرائیوٹ"><?php echo get_phrase('پرائیوٹ'); ?></option>
                            <option value="سرکاری"><?php echo get_phrase('سرکاری'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('school_name'); ?></label>
                        <input type="text" class="form-control" name="school_name"  /> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('test_marks'); ?></label>
                        <input type="text" class="form-control" name="test_marks"  /> 
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab2-3">
            <input type="checkbox" value="Same as Father" name="same_as_father">
            <div id="guardian">
                <div class="row">
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="name"><?php echo get_phrase('name'); ?></label>
                            <input type="text" class="form-control" name="g_name"  id="txtgname" />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="name"><?php echo get_phrase('parent'); ?></label>
                            <input type="text" class="form-control" name="g_pname"  id="txtgpname" />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('father_nic'); ?></label>
                            <input dir="ltr" type="text" class="form-control" name="g_nic"  data-mask="99999-9999999-9" placeholder="99999-9999999-9" required=""/> 
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="name"><?php echo get_phrase('address'); ?></label>
                            <input type="text" class="form-control" name="g_address"  id="txtgaddress" />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="name"><?php echo get_phrase('phone'); ?></label>
                            <input type="text" class="form-control" name="g_phone"  />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('country'); ?></label>
                            <select name="g_country_id" class="form-control " onchange="return get_provinceg(this.value)" >
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
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('province'); ?></label>
                            <select name="g_province_id" class="form-control" id="prov_selector_holderg" onchange="return get_districtsg(this.value)" >		                            
                                <option value=""><?php echo get_phrase('select_country_first'); ?></option>			                        			                    
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('district'); ?></label>
                            <select name="g_district_id" class="form-control" id="dist_selector_holderg">		                            
                                <option value=""><?php echo get_phrase('select_province_first'); ?></option>			                        			                    
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <center>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info" style="padding-left: 25px; padding-right: 25px;"><?php echo get_phrase('submit'); ?></button>
                        </div>
                    </div>
                </center>
            </div>
        </div>


        <!---Parent Data End-->
        <ul class="pager wizard">
            <li class="previous">
                <a href="#"><i class="entypo-left-open"></i> <?php echo get_phrase('previous') ?></a>
            </li>

            <li class="next">
                <a href="#"><?php echo get_phrase('next') ?> <i class="entypo-right-open"></i></a>
            </li>
        </ul>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">

    function get_province(country_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?admin/get_province/' + country_id,

            success: function (response)

            {
                jQuery('#prov_selector_holder').html(response);

            }});

    }
    function get_provinceg(country_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?admin/get_province/' + country_id,

            success: function (response)

            {
                jQuery('#prov_selector_holderg').html(response);

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
    function get_districtsg(prov_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?admin/get_districts/' + prov_id,

            success: function (response)

            {
                jQuery('#dist_selector_holderg').html(response);

            }});

    }

    //DISPLAY CLASSES
    function get_classes(branch_id) {
        $.ajax({

            url: '<?php echo base_url(); ?>index.php?full_admin/get_classes/' + branch_id,

            success: function (response)

            {
                jQuery('#class_holder').html(response);

            }});
    }

    //DISPLAY SECTION OF CLASS
    function get_sections(class_id) {
        $.ajax({

            url: '<?php echo base_url(); ?>index.php?full_admin/get_sections/' + class_id,

            success: function (response)

            {
                jQuery('#section_holder').html(response);

            }});
    }

</script>
<script type="text/javascript">
    var checkbox = document.querySelector('input[type="checkbox"]');
    checkbox.addEventListener('change', function (e) {
        var val1 = this.checked;
        //alert(this.checked);
        if (val1 == true) {
            $("#guardian").hide("slow");
        } else {
            $("#guardian").show("slow");
        }
        ;
    });
</script>



