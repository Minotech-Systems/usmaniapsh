<script src="<?= base_url() ?>assets/js/urdutextbox.js"></script>
<style>
    li{text-align: right;}
</style>
<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtbook);
        MakeTextBoxUrduEnabled(txtdescription);

    }

</script>
<!--<div class="container">-->
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('Author'); ?>
                </a></li>
            <li>
                <a href="#edit" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'مصنف کی تصیح کر یں'; ?>
                </a></li>
          
        </ul>

        <div class="tab-content">
            <br>
            <div class="tab-pane box" id="edit">
                <div class="row">
                    <form action="<?= base_url('website/alasr_musanif/update_musf') ?>" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="name" name="name" value="<?php echo $reult->name;?>" class="form-control">
                            </div></div>
                              <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="address" name="address" value="<?php echo $reult->address;?>" class="form-control">
                            </div></div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="phone" name="phone" value="<?php echo $reult->phone;?>" class="form-control">
                            </div>

                        </div>
                         
                         
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success"><?= ' داخل کریں' ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
