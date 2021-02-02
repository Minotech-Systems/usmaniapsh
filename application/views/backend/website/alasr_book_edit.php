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
                    <?php echo get_phrase('book'); ?>
                </a></li>
            <li>
                <a href="#edit" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'کتاب کی تصیح کر یں'; ?>
                </a></li>
          
        </ul>

        <div class="tab-content">
            <br>
            <div class="tab-pane box" id="edit">
                <div class="row">
                    <form action="<?= base_url('website/alasr_book/update_book') ?>" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                         <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo get_phrase('کتاب'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="book" name="book" class="form-control" value="<?= $result->book_name?>">
                        </div>
                        <label class="col-sm-12 control-label"><?php echo get_phrase('ایڈیشن'); ?></label>
                        <div class="col-sm-12">
                            <input type="text" id="edition" name="edition" class="form-control" value="<?= $result->book_edition?>">
                        </div>
                        <label class="col-sm-12 control-label"><?php echo get_phrase('شائع'); ?></label>
                        <div class="col-sm-12">
                               <input type="text" class="form-control datepicker" name="publish" id="publish" data-format="dd-mm-yyyy" value="<?php echo date("d-m-Y");?>" />
                        </div>
                         <label class="col-sm-12 control-label"><?php echo get_phrase('ختم مدت'); ?></label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control " name="expiery" id="expiery" data-format="dd-mm-yyyy" value="<?= date('m/d/Y',  strtotime($result->book_expirey_date))?>" />
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
