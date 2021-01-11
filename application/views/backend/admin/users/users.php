<style>
    #bt_submit{ padding-left: 25px; padding-right: 25px; font-size: 15px;}
    li{text-align: right}
</style>
<script src="<?= base_url() ?>assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtname);
        MakeTextBoxUrduEnabled(txtaddress);

    }

</script>
<hr />

<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#users" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('users'); ?>
                </a></li>
            <li>
                <a href="#add_user" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_user'); ?>
                </a></li>
        </ul>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="users">
                <table class="table table-hover">
                    <thead>
                    <th><?php echo get_phrase('image') ?></th>
                    <th><?php echo get_phrase('name') ?></th>
                    <th><?php echo get_phrase('user_name') ?></th>
                    <th><?php echo get_phrase('address') ?></th>
                    <th><?php echo get_phrase('email') ?></th>
                    <th><?php echo get_phrase('phone') ?></th>
                    <th><?php echo get_phrase('options'); ?></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $row):
                            $user_name = $this->crud_model->Decrypt($row->user_name);
                            ?>
                            <tr>
                                <td width="100"><img src="<?= base_url('uploads/user_image/' . $row->image) ?>" class="img-circle" width="40" /></td>
                                <td><?php echo $row->name ?></td>
                                <td><?= $user_name ?></td>
                                <td><?php echo $row->address ?></td>
                                <td><?= $row->email ?></td>
                                <td><?= $row->phone ?></td>
                                <td>    
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="<?php echo base_url(); ?>admin/update_user/<?php echo $row->user_id; ?>">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/users/delete/<?= $row->user_id ?>')">   
                                                    <i class="entypo-trash"></i>     
                                                    <?php echo get_phrase('delete'); ?>        
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/lock_user/<?= $row->user_id ?>')">   
                                                    <i class="entypo-lock"></i>     
                                                    <?php echo get_phrase('lock_mujeeb'); ?>        
                                                </a>  
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            <div class="tab-pane box" id="add_user">
                <div class="row">
                    <?php echo form_open(base_url() . 'admin/users/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                    <!--                    <form role="form" class="form-horizontal form-groups-bordered">-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name') ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-user"></i></button>
                                </span>
                                <input type="text" class="form-control" name="name" placeholder="نام لکھیں" id="txtname" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?= 'یوزرنیم' ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-user"></i></button>
                                </span>
                                <input type="text" class="form-control" name="user_name" placeholder="یوزرنیم لکھیں" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('email') ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-mail"></i></button>
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="ای میل لکھیں">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('password') ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-dot"></i></button>
                                </span>
                                <input type="password" class="form-control" name="password" placeholder="پاس ورڈ لکھیں" id="password" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_password') ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-dot"></i></button>
                                </span>
                                <input type="password" class="form-control" name="confirm_password" placeholder="تصدیق پاسورڈ" id="confirm_password">
                            </div>
                            <div id="pass_lenght" class="alert alert-danger" style="display:none;">
                                Password must be greater than six character..!
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('address') ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-dot"></i></button>
                                </span>
                                <input type="text" class="form-control" name="address" placeholder="پتہ" id="txtaddress">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('phone') ?></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="entypo-dot"></i></button>
                                </span>
                                <input type="number" class="form-control" name="phone" placeholder="موبائل نمبر">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align: center">
                        <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">								
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                                <img src="http://placehold.it/200x200" alt="...">								
                            </div>							
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>								
                            <div>									
                                <span class="btn btn-white btn-file">										
                                    <span class="fileinput-new"><?php echo get_phrase('select_image') ?></span>										
                                    <span class="fileinput-exists">تبدیل کریں</span>										
                                    <input type="file" name="user_image" accept="image/*">									
                                </span>									
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">ختم کریں</a>								
                            </div>							
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center;">
                            <div class="form-group">						
                                <div class="col-sm-12">							
                                    <button type="submit" id="submit" class="btn btn-info" disabled><?php echo get_phrase('submit'); ?></button>						
                                    <span id='message'></span>
                                </div>					
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <!--                    </form>-->
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() && $('#confirm_password').val()) {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('');
                $("#submit").removeAttr("disabled");
            } else
                $('#message').html('Your Password is not matching').css('color', 'red');
            //$('#submit').attr('disabled',true);
        }
    });

    var max_chars = 6;
    $('#password').keyup(function (e) {
        if ($(this).val().length < max_chars) {
            $('#pass_lenght').show('slow');
        } else {
            $('#pass_lenght').hide('slow');
        }
    });

</script>

