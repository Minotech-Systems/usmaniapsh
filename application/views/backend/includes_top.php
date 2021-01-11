<link rel="stylesheet" href="<?= base_url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/font-icons/entypo/css/entypo.css') ?>">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/neon-core.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/neon-theme.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/neon-forms.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/fonts/nastaleeq/font.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/fonts/nafees/font.css') ?>">

<?php
$skin_colour = $this->db->get_where('settings', array(
            'type' => 'skin_colour'
        ))->row()->description;
if ($skin_colour != ''):
    ?>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/skins/<?php echo $skin_colour; ?>.css">

<?php endif; ?>

<link rel="stylesheet" href="<?= base_url('assets/css/neon-rtl.css') ?>">
<script src="<?= base_url('assets/js/jquery-1.11.0.min.js') ?>"></script>

<link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/font-icons/font-awesome/css/font-awesome.min.css') ?>">

<link rel="stylesheet" href="<?= base_url('assets/js/vertical-timeline/css/component.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/js/datatables/responsive/css/datatables.responsive.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/js/wysihtml5/bootstrap-wysihtml5.css') ?>">


<!--Amcharts-->
<script src="<?php echo base_url(); ?>assets/js/amcharts/amcharts1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/serial1.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/amcharts/amcharts.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/js/amcharts/pie.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/amcharts/serial.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/js/amcharts/gauge.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/funnel.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/exporting/amexport.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/exporting/canvg.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>

<script>
    function checkDelete()
    {
        var chk = confirm("Are You Sure To Delete This !");
        if (chk)
        {
            return true;
        } else {
            return false;
        }
    }
</script>