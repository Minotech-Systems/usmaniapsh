<hr>
<?php foreach ($user_data as $data) { 
    $user_name = $this->crud_model->Decrypt($data->user_name);?>
    <div class="row">
        <div class="col-md-12">
            <center>
                <h3><?= $data->name ?></h3>
            </center>
        </div>
    </div>
    <br>
    <div class="row">
        <?php echo form_open(base_url() . 'admin/users/update/'.$data->user_id, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
        <!--                    <form role="form" class="form-horizontal form-groups-bordered">-->
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('name') ?></label>
            <div class="col-sm-5">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="entypo-user"></i></button>
                    </span>
                    <input type="text" class="form-control" name="name" placeholder="نام لکھیں" id="txtname" required="" value="<?= $data->name?>">
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
                    <input type="text" class="form-control" name="user_name" placeholder="یوزرنیم لکھیں" required="" value="<?= $user_name?>">
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
                    <input type="email" class="form-control" name="email" placeholder="ای میل لکھیں" value="<?= $data->email?>">
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
                    <input type="text" class="form-control" name="address" placeholder="پتہ" id="txtaddress" value="<?= $data->address?>">
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
                    <input type="number" class="form-control" name="phone" placeholder="موبائل نمبر" value="<?= $data->phone?>">
                </div>
            </div>
        </div>
        <div class="row" style="text-align: center">
            <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">								
                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">									
                    <img src="<?= base_url('uploads/user_image/'.$data->image)?>" alt="...">								
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
                        <button type="submit" id="submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>						
                        <span id='message'></span>
                    </div>					
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <!--                    </form>-->
    </div>
    <?php
}?>