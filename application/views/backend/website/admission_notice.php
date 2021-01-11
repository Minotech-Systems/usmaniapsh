<div class="row">
    <div class="col-md-12">
        <center>
            <span><?= 'ویب سائٹ پر دیکھائے '?></span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            if ($notice->status == '1') {
                ?>
            <span>ہاں</span>
            <a href="<?= base_url('website/change_notice_status/0')?>" class="btn btn-default"><?= 'تبدیل کریں'?></a>
            <?php } else { ?>
            <span>نہیں</span>
            <a href="<?= base_url('website/change_notice_status/1')?>" class="btn btn-default"><?= 'تبدیل کریں'?></a>
            <?php } ?>
        </center>
        <br><br>
    </div>
    
    <div class="col-md-12">
        <form class="form-horizontal" method="post" action="<?= base_url('update_web_settings/admission_notice') ?>">
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="<?= 'عنوان داخلہ'?>" value="<?= $notice->title?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <textarea class="form-control ckeditor" required=""  name="notice"><?= $notice->description ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10" style="text-align: center; margin-top: 10px;">
                    <button type="submit" class="btn btn-success"><?= 'آپڈیٹ اعلان داخلہ' ?></button>
                </div>
            </div>
        </form>
    </div>
</div>