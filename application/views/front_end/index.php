<html dir="rtl" lang="en">
    <?php include 'includes/header.php'; ?>

    <body style="font-family:'Noto Nastaliq Urdu Draft', serif;">

        <!--<div class="se-pre-con"></div>-->
        <div class="content">
            <?php include 'includes/navbar.php'; ?>
            <?php include $page_name . '.php'; ?>
            <?php include 'includes/footer.php'; ?>
            <?php include 'includes/bottom.php'; ?>
            
        </div>
        <style>
            .content {
                background-size: 100%;
                width: 100%;
            }
        </style>

<!--        <script>
            $(window).load(function () {
                $(".se-pre-con").delay(10).fadeOut("slow");
            });
        </script>-->
    </body>
</html>



