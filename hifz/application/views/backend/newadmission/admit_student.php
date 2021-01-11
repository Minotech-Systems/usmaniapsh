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


<?php echo form_open(base_url() . 'index.php?newadmission/admit_student/admit', array('class' => 'form-wizard validate', 'id' => 'rootwizard-2', 'enctype' => 'multipart/form-data', 'target' => '_top'));
?>

<div class="row">
    <div class="col-sm-8 col-sm-offset-2" style=" box-shadow: 0px 1px 7px 1px; padding-top: 20px; padding: 20px;">
        <div class="row">
            <div class="col-sm-12" style="text-align: center"><h2 style="margin-bottom: 10px;">طالب علم داخلہ فارم</h2></div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('name') ?>*</label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-user"></i></button>
                        </span>
                        <input type="text" class="form-control"  name="name" id="txtname" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('parent') ?>*</label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-user"></i></button>
                        </span>
                        <input type="text" id="txtparent" class="form-control" name="parent" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('dob') ?>*</label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-calendar" ></i></button>
                        </span>
                        <input type="text" class="form-control datepicker" data-start-view="2" name="dob" data-format="dd-mm-yyyy" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('current_address') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-address"></i></button>
                        </span>
                        <input type="text" class="form-control" id="txtcaddress" name="c_address">
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('permanent_address') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-address"></i></button>
                        </span>
                        <input type="text" class="form-control" id="txtpaddress" name="p_address">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('phone') ?>*</label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-mobile"></i></button>
                        </span>
                        <input type="text" dir="ltr" class="form-control" name="phone" data-mask="99999999999" placeholder="03153344555"  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('country') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-flag"></i></button>
                        </span>
                        <select name="country_id" class="form-control " onchange="return get_province(this.value)">
                            <option value=""><?php echo get_phrase('select_country'); ?></option>
                            <?php
                            $country = $this->db->get('country')->result_array();
                            foreach ($country as $country):
                                ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('province') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-flag"></i></button>
                        </span>
                        <select name="province_id" class="form-control" id="prov_selector_holder" onchange="return get_districts(this.value)">		                            
                            <option value=""><?php echo get_phrase('select_country_first'); ?></option>			                        			                    
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('district') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-flag"></i></button>
                        </span>
                        <select name="district_id" class="form-control" id="dist_selector_holder">		                            
                            <option value=""><?php echo get_phrase('select_province_first'); ?></option>			                        			                    
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('branch') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-home"></i></button>
                        </span>
                        <select name="branch_id" class="form-control " >
                            <option value=""><?php echo get_phrase('select_branch'); ?></option>
                            <?php
                            $branches = $this->db->get('branches')->result_array();
                            foreach ($branches as $branch):
                                ?>
                                <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('gender') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-users"></i></button>
                        </span>
                        <select name="gender" class="form-control " data-validate="">                              
                            <option value=""><?php echo 'صنف ' . get_phrase('select'); ?></option>                            
                            <option value="مرد"><?php echo get_phrase('male'); ?></option>                             
                            <option value="خاتون"><?php echo get_phrase('female'); ?></option>                         
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('reg_no') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-pencil"></i></button>
                        </span>
                        <input type="number"  class="form-control" name="reg_no">
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('month') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                        <select name="month[]" class="form-control select2" multiple="" id="month" dir="rtl">
                            <?php
                            for ($i = 1; $i <= 12; $i++):
                                if ($i == 1)
                                    $m = 'شوال';
                                else if ($i == 2)
                                    $m = 'ذوالقعدۃ';
                                else if ($i == 3)
                                    $m = 'ذوالحجۃ';
                                else if ($i == 4)
                                    $m = 'محرم';
                                else if ($i == 5)
                                    $m = 'صفر';
                                else if ($i == 6)
                                    $m = 'ر بیع الاول';
                                else if ($i == 7)
                                    $m = 'ر بیع الثانی';
                                else if ($i == 8)
                                    $m = 'جمادی الاول';
                                else if ($i == 9)
                                    $m = 'جمادی الثانی';
                                else if ($i == 10)
                                    $m = 'رجب';
                                else if ($i == 11)
                                    $m = 'شعبان';
                                else if ($i == 12)
                                    $m = ' رمضان';
                                ?>
                                <option value="<?php echo $i; ?>">
                                    <?php echo ucfirst($m); ?>
                                </option>
                                <?php
                            endfor;
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('amount') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="fa fa-money"></i></button>
                        </span>
                        <input type="number" class="form-control"  name="amount">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?= 'ٹسٹ نمبرات' ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="fa fa-trophy"></i></button>
                        </span>
                        <input type="number" class="form-control"  name="test_marks">
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?= 'ولدیت شناختی کارڈ' ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="entypo-vcard"></i></button>
                        </span>
                        <input type="text" class="form-control"  name="father_nic">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="text-align: center">
            <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">								
                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                    <img src="<?= base_url('uploads/user.jpg')?>" alt="...">								
                </div>							
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>								
                <div>									
                    <span class="btn btn-white btn-file">										
                        <span class="fileinput-new"><?php echo get_phrase('select_image') ?></span>										
                        <span class="fileinput-exists">تبدیل کریں</span>										
                        <input type="file" name="student_image" accept="image/*" >									
                    </span>									
                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">ختم کریں</a>								
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

</div>


<?php echo form_close(); ?>

<script type="text/javascript">

    function get_province(country_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?newadmission/get_province/' + country_id,

            success: function (response)

            {
                jQuery('#prov_selector_holder').html(response);

            }});

    }

    function get_districts(prov_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?newadmission/get_districts/' + prov_id,

            success: function (response)

            {
                jQuery('#dist_selector_holder').html(response);

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

<script type="text/javascript">

    function get_classes(branch_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?newadmission/get_classes/' + branch_id,

            success: function (response)

            {
                jQuery('#class_holder').html(response);

            }});

    }

</script>