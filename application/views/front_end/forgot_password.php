<?php include 'ifta_header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-main">
                    <h3>پاسورڈ یاد نہیں؟</h3>
                    <div class="form-wrapper">
                        <form action="<?= base_url('forgot_password') ?>" method="post">
                            <?php if (!empty($this->session->userdata('email_not_exist'))) { ?>
                                <div class="form-group" style="text-align:right">
                                    <div class="alert alert-danger" id="alert-danger"> <?= 'یہ ای میل ہمارے پاس موجود نہیں ہے۔۔۔' ?></div>
                                </div>
                            <?php } ?>
                            <?php if (!empty($this->session->userdata('password_changed'))) { ?>
                                <div class="form-group" style="text-align:right">
                                    <div class="alert alert-success" id="alert-success"> <?= 'آپ کا پاسورڈ تبدیل کردیا گیا ہے۔ آپ اپنا ای میل چیک کریں۔' ?></div>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <input type="email" class="form-control eng_input" name="email" placeholder="ای میل"  required="">
                            </div>
                            <div class="form-group" style="text-align:right">
                                <button class="btn btn-success ">
                                    <span><?= 'تبدیل کریں' ?></span>
                                </button>
                            </div>
                            <div class="form-group" style="text-align:left">
                                <a href="<?= base_url('register') ?>" class="txt-link"><?= 'نیا اکاؤنٹ بنائیں' ?></a>
                                <br>
                                <a href="<?= base_url('login') ?>" class="txt-link"><?= 'اکاؤنٹ لاگ ان کریں' ?></a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    $(document).ready(function () {
        setTimeout(function () {
            $('#alert-danger').hide('slow');
            $('#alert-success').hide('slow');

<?php
$this->session->unset_userdata('email_not_exist');
$this->session->unset_userdata('password_changed');
?>
        }, 3000);


    });
</script>