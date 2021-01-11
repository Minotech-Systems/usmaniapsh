<!-- JavaScript Libraries -->
<script src="<?= base_url('assets/frontend/default/lib/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/jquery/jquery-migrate.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/easing/easing.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/mobile-nav/mobile-nav.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/wow/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/waypoints/waypoints.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/counterup/counterup.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/owlcarousel/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/isotope/isotope.pkgd.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/default/lib/lightbox/js/lightbox.min.js') ?>"></script>
<!-- Contact Form JavaScript File -->
<script src="<?= base_url('assets/frontend/default/contactform/contactform.js') ?>"></script>

<!-- Template Main Javascript File -->
<script src="<?= base_url('assets/frontend/default/js/main.js') ?>"></script>

<script>
    function change_lang(value) {

        $.ajax({url: '<?php echo base_url(); ?>home/switchLang/' + value,
            success: function (response) {

                window.location.href = "<?= base_url()?>";

            }});

    }


</script>