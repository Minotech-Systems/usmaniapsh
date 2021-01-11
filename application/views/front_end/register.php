<?php include 'ifta_header.php'; ?>

<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-main">
                    <h3><?= 'نیا اکاؤنٹ بنائیں' ?></h3>
                    <div class="form-wrapper">
                        <form action="<?= base_url('register_user') ?>" data-toggle="validator" role="form" method="post">
                            <?php if (!empty($this->session->userdata('email_already_exist'))) { ?>
                                <div class="form-group" style="text-align:right">
                                    <div class="alert alert-danger"><?= 'یہ ای میل پہلے سے رجسٹرڈ ہے' ?></div>
                                </div>
                            <?php } ?>
                            <?php if (!empty($this->session->userdata('account_created'))) { ?>
                                <div class="form-group" style="text-align:right" id="alert-success">
                                    <div class="alert alert-success"><?= 'آپ کا اکانٹ کامیابی سے رجسٹرڈ کر دیا گیا ہے۔' ?></div>
                                </div>
                            <?php } ?>

                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <input type="text" class="form-control eng_input" name="name" placeholder="نام"  required="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control eng_input" name="phone" placeholder="فون"  required="">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control eng_input" name="email" placeholder="ای میل"  >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control eng_input" name="password" placeholder="پاسورڈ" >
                            </div>
                            <div class="form-group" style="text-align:right">
                                <button class="btn btn-success ">
                                    <span><?= 'لاگ ان' ?></span>
                                </button>
                            </div>
                            <div class="form-group" style="text-align:left">
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
            $('#alert-success').hide('slow');
<?php
$this->session->unset_userdata('email_already_exist');
$this->session->unset_userdata('account_created');
?>

        }, 300);
    });
</script>