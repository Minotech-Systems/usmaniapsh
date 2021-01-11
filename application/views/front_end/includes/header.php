<head>
    <meta charset="utf-8">
    <title><?= $page_title . '|' . 'دارالافتاء جامعہ عثمانہ پشاور ' ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta http-equiv="x-ua-compatible" content="IE=edge">

    <!-- Favicons -->
    <link href="<?= base_url('uploads/logo.png') ?>" rel="icon">
    <link href="<?= base_url('assets/frontend/default/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="<?= base_url('assets/frontend/default/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?= base_url('assets/frontend/default/lib/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/default/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/default/lib/ionicons/css/ionicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/default/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/default/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/neon-rtl.css') ?>">
    <!-- Main Stylesheet File -->
    <link href="<?= base_url('assets/frontend/default/css/style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/fonts/nastaleeq/font.css') ?>">

    <!--Custom Css-->
    <link href="<?= base_url('assets/frontend/default/css/custom.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/font-icons/entypo/css/entypo.css') ?>">

    <style>
        .arabic{font-family: 'DroidArabicKufiRegular';}
        .top_mobile_links{ color: white}
        #topbar{
            background: #53516b;
            color: white;
            height: 48px;
        }
        .mobile-nav-toggle{
            top:5px;
        }
        .hidden{ display: none;}
        @media (max-width: 991px){
            .logo{ float: left !important;}
            #header{ height: 50px !important}
        }
        .main-nav a { font-family: 'Noto Nastaliq Urdu Draft',serif }


        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(<?= base_url('uploads/loader/ajax_loader.gif') ?>) center no-repeat #fff;
            background-size: 160px;


        }
        .main-nav > ul > li{
            border-left: solid 1px #d3d3d3;
        }
    </style>

</head>