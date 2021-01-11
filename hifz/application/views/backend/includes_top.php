<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/neon-core.css">
<link rel="stylesheet" href="assets/css/neon-theme.css">
<link rel="stylesheet" href="assets/css/neon-forms.css">
<link rel="stylesheet" href="assets/fonts/nastaleeq/font.css">

<?php
    $skin_colour = $this->db->get_where('settings' , array(
        'type' => 'skin_colour'
    ))->row()->description; 
    if ($skin_colour != ''):?>

    <link rel="stylesheet" href="assets/css/skins/<?php echo $skin_colour;?>.css">

<?php endif;?>

<?php if ($text_align == 'right-to-left') : ?>
    <link rel="stylesheet" href="assets/css/neon-rtl.css">
<?php endif; ?>
<script src="assets/js/jquery-1.11.0.min.js"></script>

<link rel="shortcut icon" href="assets/images/favicon.png">
<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="assets/js/vertical-timeline/css/component.css">
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">


<!--<link href="assets/js/arabic/bootstrap.min.css" media="all" rel="stylesheet" />-->
<link href="assets/js/arabic/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" />
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<!--<script src="assets/js/arabic/bootstrap.min.js"></script>-->
<script src="assets/js/arabic/jquery.calendars.min.js"></script>
<script src="assets/js/arabic/jquery.calendars.ummalqura.min.js"></script>
<script src="assets/js/arabic/jquery.calendars.ummalqura-ar.js"></script>
<script src="assets/js/arabic/bootstrap-calendars.min.js"></script>
<script src="assets/js/arabic/bootstrap-datetimepicker.min.js"></script>

<script src="assets/js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="assets/js/amcharts/serial.js" type="text/javascript"></script>
<script src="assets/js/amcharts/lib/core.js"></script>
<script src="assets/js/amcharts/lib/chart.js"></script>
<script src="assets/js/amcharts/lib/animated.js"></script>

<script>
    function checkDelete()
    {
        var chk=confirm("Are You Sure To Delete This !");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
</script>