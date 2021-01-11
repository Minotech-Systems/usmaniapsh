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
<?php
$student_data = $this->crud_model->get_student_all_data($student_id);
foreach ($student_data as $data) {
    ?>
    <?php echo form_open(base_url() . 'index.php?admission/edit_student/'.$data->student_id, array('class' => 'form-wizard validate', 'id' => 'rootwizard-2', 'enctype' => 'multipart/form-data', 'target' => '_top'));
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
                                <input type="text" class="form-control" name="name"  id="txtname" value="<?= $data->name ?>"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('parent'); ?>*</label>
                                <input type="text" class="form-control" name="father_name"  id="txtparent" value="<?= $data->father_name ?>"/>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('current_address'); ?>*</label>
                                <input type="text" class="form-control" name="c_address"  id="txtcaddress" value="<?= $data->c_address ?>"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('permanent_address'); ?></label>
                                <input type="text" class="form-control" name="p_address"  id="txtpaddress" value="<?= $data->p_address ?>"/>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('country'); ?></label>
                                <select name="country_id" class="form-control " onchange="return get_province(this.value)" >
                                    <option value="<?= $data->country_id ?>">
                                        <?= $this->crud_model->get_column_name_by_id('country', 'country_id', $data->country_id) ?>
                                    </option>
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
                                    <option value="<?= $data->prov_id ?>">
                                        <?= $this->crud_model->get_column_name_by_id('province', 'prov_id', $data->prov_id) ?>
                                    </option>			                        			                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('district'); ?></label>
                                <select name="district_id" class="form-control" id="dist_selector_holder">		                            
                                    <option value="<?= $data->dist_id ?>">
                                        <?= $this->crud_model->get_column_name_by_id('district', 'dist_id', $data->dist_id) ?>
                                    </option>			                        			                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <label class="control-label" ><?php echo get_phrase('dob'); ?>*</label>
                                <input type="text" class="form-control datepicker" data-start-view="2" name="dob" data-format="dd-mm-yyyy" value="<?= date('d-m-Y', strtotime($data->dob)) ?>">
                            </div>
                        </div>

                    </div>


                    <div class="col-md-4">
                        <div class="row" style="text-align: center;">
                            <div class="fileinput fileinput-new col-md-12 col-md-offset-1" data-provides="fileinput">								
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                                    <img src="<?= $this->crud_model->get_image_url('student', $data->image); ?>" alt="...">								
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
                                    <input dir="ltr" type="text" class="form-control" name="father_nic"  data-mask="99999-9999999-9" value="<?= $data->father_nic ?>"/> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><?php echo get_phrase('father_phone'); ?>*</label>
                                    <input dir="ltr" type="text" class="form-control" name="father_phone"  data-mask="99999999999" value="<?= $data->phone ?>"/> 
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
                            <input type="text" class="form-control" name="quran_nazra" value="<?= $data->nazra_quran ?>" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('hifz'); ?></label>
                            <input type="text" class="form-control" name="hifz"  value="<?= $data->hifz ?>"/> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('madrasa'); ?></label>
                            <input type="text" class="form-control" name="madrasa" value="<?= $data->madrasa ?>" /> 
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
                            <input type="text" class="form-control" name="class" value="<?= $data->class ?>" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label" ><?php echo get_phrase('school'); ?></label>
                            <select name="school" class="form-control ">
                                <option value=""><?php echo get_phrase('select_school'); ?></option>
                                <option value="پرائیوٹ" <?php if ($data->school_type == 'پرائیوٹ') echo 'selected'; ?>><?php echo get_phrase('پرائیوٹ'); ?></option>
                                <option value="سرکاری" <?php if ($data->school_type == 'سرکاری') echo 'selected'; ?>><?php echo get_phrase('سرکاری'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('school_name'); ?></label>
                            <input type="text" class="form-control" name="school_name"  value="<?= $data->school_name ?>"/> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('test_marks'); ?></label>
                            <input type="text" class="form-control" name="test_marks"  value="<?= $data->test_marks ?>"/> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2-3">
                <input type="checkbox" value="Same as Father" name="same_as_father" <?php
                if ($data->guardian_id == '') {
                    echo 'checked';
                }
                ?>>

                <div id="guardian" <?php
                         if ($data->guardian_id == '') {
                             echo 'style="display: none;"';
                         }
                         ?>>
                         <?php
                         if ($data->guardian_id != '') {
                             $guar_data = $this->db->get_where('guardian', array('id' => $data->guardian_id))->result();
                             foreach ($guar_data as $g_data) {
                                 ?>
                            <div class="row">
                                <div class="col-md-4 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="name"><?php echo get_phrase('name'); ?></label>
                                        <input type="text" class="form-control" name="g_name"  id="txtgname" value="<?= $g_data->name ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="name"><?php echo get_phrase('parent'); ?></label>
                                        <input type="text" class="form-control" name="g_pname"  id="txtgpname" value="<?= $g_data->father_name ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo get_phrase('nic'); ?></label>
                                        <input dir="ltr" type="text" class="form-control" name="g_nic"  data-mask="99999-9999999-9" value="<?= $g_data->nic ?>"/> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="name"><?php echo get_phrase('address'); ?></label>
                                        <input type="text" class="form-control" name="g_address"  id="txtgaddress" value="<?= $g_data->address ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="name"><?php echo get_phrase('phone'); ?></label>
                                        <input type="text" class="form-control" name="g_phone"  value="<?= $g_data->phone ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" ><?php echo get_phrase('country'); ?></label>
                                        <select name="g_country_id" class="form-control " onchange="return get_provinceg(this.value)" >
                                            <option value="<?= $g_data->country_id ?>">
                                            <?= $this->crud_model->get_column_name_by_id('country', 'country_id', $g_data->country_id) ?>
                                            </option>
                                            <?php
                                            $country = $this->crud_model->get_table_data('country');
                                            foreach ($country as $country1):
                                                ?>
                                                <option value="<?php echo $country1['country_id']; ?>"><?php echo $country1['name']; ?></option>
            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" ><?php echo get_phrase('province'); ?></label>
                                        <select name="g_province_id" class="form-control" id="prov_selector_holderg" onchange="return get_districtsg(this.value)" >		                            
                                            <option value="<?= $g_data->prov_id ?>">
                                                <?= $this->crud_model->get_column_name_by_id('province', 'prov_id', $g_data->prov_id) ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" ><?php echo get_phrase('district'); ?></label>
                                        <select name="g_district_id" class="form-control" id="dist_selector_holderg">		                            
                                            <option value="<?= $g_data->dist_id ?>">
                                                <?= $this->crud_model->get_column_name_by_id('district', 'dist_id', $g_data->dist_id) ?>
                                            </option>			                        			                    
                                        </select>
                                    </div>
                                </div>
                            </div>
        <?php }
    }
    ?>
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
<?php } ?>
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



