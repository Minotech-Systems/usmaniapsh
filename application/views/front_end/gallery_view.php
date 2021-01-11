<!DOCTYPE html>
<html lang="en">

    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/hs-megamenu/src/hs.megamenu.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/cubeportfolio/css/cubeportfolio.min.css">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/ultimate/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/frontend/css/custom.css">

    <?php include 'includes/header.php'; ?>
    <body style="font-family:'Noto Nastaliq Urdu Draft', serif;" dir="rtl">



        <?php
        $gallery_info = $this->frontend_model->get_gallery_info_by_id($gallery_id);
        foreach ($gallery_info as $row) {
            $this->db->where('frontend_gallery_id', $row['frontend_gallery_id']);
            $this->db->order_by('frontend_gallery_image_id', 'DESC');
            $query = $this->db->get('frontend_gallery_image');
            $images = $query->result_array();
            ?>
            <!-- ========== MAIN ========== -->
            <main id="content" role="main">
                <!-- Hero Section -->
                <div class="" style="background: url('<?= base_url('assets/frontend/default/img/patteren-lighten-2.jpg') ?>')">
                    <div class="container">
                        <!-- Title -->
                        <div class="col-md-12" style="text-align: center;padding: 30px;">
                            <h3 style="display:inline-block">
                                <?php echo $row['title']; ?>
                            </h3>
                            <h3 class="pull-right" style="display:inline-block">
                                <a href="<?= base_url('gallery') ?>">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </h3>

                        </div>
                        <!-- End Title -->
                    </div>
                </div>
                <!-- End Hero Section -->

                <!-- Gallery section starts -->
                <div class="container space-2 space-md-2">

                    <!-- Title -->
                    <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5">
                        <span class="btn btn-xs btn-soft-success btn-pill mb-2">
                            <?php echo date('d-m-Y', $row['date_added']); ?>
                        </span>
                    </div>
                    <p class="font-size-1" style="text-align:right;"><?php echo $row['description']; ?></p>

                    <!-- End Title -->




                    <!-- Cubeportfolio Section -->
                    <div class= u-cubeportfolio">
                        <!-- Filter -->

                        <!-- End Filter -->

                        <!-- Content -->
                        <div class="cbp mb-7"
                             data-controls="#cubeFilter"
                             data-animation="quicksand"
                             data-x-gap="16"
                             data-y-gap="16"
                             data-load-more-selector="#cubeLoadMore"
                             data-load-more-action="auto"
                             data-load-items-amount="2"
                             data-media-queries='[
                             {"width": 1500, "cols": 4},
                             {"width": 1100, "cols": 4},
                             {"width": 800, "cols": 3},
                             {"width": 480, "cols": 2},
                             {"width": 300, "cols": 1}
                             ]'>

                            <?php foreach ($images as $image) { ?>
                                <!-- Item -->
                                <div class="cbp-item rounded abstract">
                                    <div class="cbp-caption">
                                        <a class="cbp-lightbox u-media-viewer"
                                           href="<?php echo base_url(); ?>uploads/images/gallery_images/<?php echo $image['image']; ?>"
                                           data-title="<?php echo $row['title']; ?>">
                                            <img src="<?php echo base_url(); ?>uploads/images/gallery_images/<?php echo $image['image']; ?>"
                                                 alt="<?php echo $row['title']; ?>">
                                            <span class="u-media-viewer__container">
                                                <span class="u-media-viewer__icon">
                                                    <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Item -->
                            <?php } ?>

                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- Gallery section ends -->
                </div>
            </main>
            <!-- ========== END MAIN ========== -->

        <?php } ?>




<!--<script src="<?= base_url('assets/frontend/default/js/main.js') ?>"></script>-->

        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/vendor/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>


        <!-- JS Front -->
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/hs.core.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.header.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.unfold.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.slick-carousel.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.validation.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.focus-state.js"></script>

        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.g-map.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.cubeportfolio.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.svg-injector.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/ultimate/js/components/hs.go-to.js"></script>
        <!--<script src="<?php echo base_url(); ?>assets/frontend/default/js/custom.js"></script>-->
        <script>


            $(document).on('ready', function () {

                // initialization of cubeportfolio
                $.HSCore.components.HSCubeportfolio.init('.cbp');

            });
        </script>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>