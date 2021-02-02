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
                    <form action="<?= base_url('website/alasr_topic/update_topic') ?>" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo 'ٹاپک کا نام'; ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="topicname" name="topicname" value="<?php echo $reult->top_name;?>" class="form-control">
                            </div></div>
                              
                              <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reference'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="reference" name="reference" value="<?php echo $reult->phone;?>" class="form-control">
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
