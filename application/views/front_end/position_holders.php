<?php include 'header.php'; ?>
<!--Custom Css-->
<link href="<?= base_url('assets/frontend/default/css/theme.css') ?>" rel="stylesheet">
<style>
    .d-flex{border:1px solid #e3dad2}
    .text-white{font-family: unset; font-size: 18px;}
</style>
<?php
$this->db->order_by('session','DESC');
$this->db->group_by('session');
$query = $this->db->get('web_position_holders');
$positions = $query->result_array();
?>
<section class="inner-section">
    <div class="container">
        <div class="row mx-gutters-2" style="margin-top:10px">
            <?php
            foreach ($positions as $row) {
                ?>
                <div class="col-md-4 mb-3">
                    <a class="d-flex align-items-end bg-img-hero gradient-overlay-half-dark-v1 transition-3d-hover  rounded-pseudo" href="<?php echo site_url('position_holder_view/' . $row['session']); ?>"
                       style="background-image: url(<?php echo base_url(); ?>uploads/logo.png); background-size:contain; height:340px;">
                        <article class="w-100 text-center p-6">
                            <h3 class="h4 text-white">
                                <?php echo get_phrase('position_holders'); ?>
                            </h3>
                            <div class="mt-4" style="margin-top:0px !important;">
                                <strong class="d-block text-white-70 mb-2">
                                    <?= $row['session'] ?>
                                </strong>
                            </div>
                        </article>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
