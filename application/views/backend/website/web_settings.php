<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-offset-1">
            <form class="form-horizontal" action="<?= base_url('website/web_settings_update') ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">نام</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?= $this->db->get_where('web_settings', array('type' => 'name'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">موبائل</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="mobile" value="<?= $this->db->get_where('web_settings', array('type' => 'mobile'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ٹیلی فون</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?= $this->db->get_where('web_settings', array('type' => 'phone'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ای میل</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" value="<?= $this->db->get_where('web_settings', array('type' => 'email'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">اکاونٹ نمبر</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="account_no" value="<?= $this->db->get_where('web_settings', array('type' => 'account_no'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ائ بی ان نمبر</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="ibn_no" value="<?= $this->db->get_where('web_settings', array('type' => 'ibn_no'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">برانچ نام</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="branch_name" value="<?= $this->db->get_where('web_settings', array('type' => 'branch_name'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">برانچ کوڈ</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="branch_code" value="<?= $this->db->get_where('web_settings', array('type' => 'branch_code'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">طریقہ تعاون</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="cooperation_process" rows="3"><?= $this->db->get_where('web_settings', array('type' => 'cooperation_process'))->row()->description; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" id="submit_button" class="btn btn-info"><?= 'سیٹنگز آپڈیٹ کریں' ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
