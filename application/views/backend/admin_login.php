<!doctype html>
<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
?>

<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link href="<?= base_url('uploads/logo.png') ?>" rel="icon">
        <title>
            <?php echo get_phrase('login'); ?> | <?php echo $system_name; ?>
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #17a2b8;
                height: 100vh;
                font-family: 'Noto Nastaliq Urdu Draft',serif;
            }
            #login .container #login-row #login-column #login-box {
                margin-top: 120px;
                max-width: 600px;
                height: 320px;
                border: 1px solid #9C9C9C;
                background-color: #EAEAEA;
            }
            #login .container #login-row #login-column #login-box #login-form {
                padding: 20px;
            }
            #login .container #login-row #login-column #login-box #login-form #register-link {
                margin-top: -85px;
            }
        </style>
    </head>


    <body dir="rtl">

        <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

        <div id="login">
            <h3 class="text-center text-white pt-5"><?= 'جامعہ عثمانیہ پشاور' ?></h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12" style="box-shadow:0px 0px 10px 2px">
                            <form id="login-form" class="form" action="<?= base_url('validate_adminlogin') ?>" method="post">
                                <h3 class="text-center text-info"><?= 'دارلافتاء' ?></h3>
                                <div class="form-group" style="text-align:right">
                                    <label for="username" class="text-info"><?= 'نام صارف' ?></label><br>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="form-group" style="text-align:right">
                                    <label for="password" class="text-info"><?= 'پاسورڈ' ?></label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group" style="text-align:center">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="لاگ ان">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('login_error') != '') { ?>
            <script type="text/javascript">
                $.notify({
                    // options
                    title: '<strong><?php echo get_phrase('error'); ?>!!</strong>',
                    message: '<?php echo $this->session->flashdata('login_error'); ?>'
                }, {
                    // settings
                    type: 'danger'
                });
            </script>
        <?php } ?>


    </body>
</html>
