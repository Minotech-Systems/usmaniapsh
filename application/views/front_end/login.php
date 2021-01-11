<?php include 'ifta_header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-main">
                    <h3>اکاؤنٹ لاگ ان کریں</h3>
                    <div class="form-wrapper">
                        <form action="<?= base_url('validate_userlogin') ?>" method="post">
                            <?php if (!empty($this->session->userdata('login_error'))) { ?>
                                <div class="form-group" style="text-align:right">
                                    <div class="alert alert-danger" id="alert-danger"> <?= 'لاگ ان ایرر' ?></div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <input type="email" class="form-control eng_input" name="email" placeholder="ای میل"  required="">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control eng_input" name="password" placeholder="پاسورڈ" required="">
                            </div>
                            <div class="form-group" style="text-align:right">
                                <button class="btn btn-success ">
                                    <span><?= 'لاگ ان' ?></span>
                                </button>
                            </div>
                            <div class="form-group" style="text-align:left">
                                <a href="<?= base_url('forgot-password')?>" class="txt-link">پاسورڈ یاد نہیں؟</a>
                                <br>
                                <a href="<?= base_url('register') ?>" class="txt-link"><?= 'نیا اکاؤنٹ بنائیں' ?></a>
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
<?php $this->session->unset_userdata('login_error'); ?>
        }, 3000);


    });
</script>