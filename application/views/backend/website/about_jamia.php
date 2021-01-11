<div class="row">
    <div class="col-md-12">
        <form class="" method="post" action="<?= base_url('update_web_settings/about') ?>">
            <div class="form-group">
                <div class="col-sm-10">
                    <textarea class="form-control ckeditor" required=""  name="about_jamia"><?= $about_jamia?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10" style="text-align: center; margin-top: 10px;">
                    <button type="submit" class="btn btn-success"><?= 'آپڈیٹ جامعہ تعارف' ?></button>
                </div>
            </div>
        </form>
    </div>
</div>