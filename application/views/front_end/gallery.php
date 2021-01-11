<?php include 'header.php'; ?>
<!--Custom Css-->
<link href="<?= base_url('assets/frontend/default/css/theme.css') ?>" rel="stylesheet">
<style>
    .d-flex{border:1px solid #e3dad2}
    .text-white{font-family: unset; font-size: 18px;}
</style>
<?php
$this->db->where('show_on_website', 1);
$this->db->order_by('date_added', 'DESC');
$query = $this->db->get('frontend_gallery');
$galleries = $query->result_array();
?>
<section class="inner-section">
    <div class="container">
        <div class="row mx-gutters-2" style="margin-top:10px">
            <?php
            foreach ($galleries as $row) {
                $this->db->where('frontend_gallery_id', $row['frontend_gallery_id']);
                $query = $this->db->get('frontend_gallery_image');
                $images = $query->result_array();
                $number_of_image = count($images);
                $cover_image = $row['image'];
                ?>
                <div class="col-md-4 mb-3">
                    <a class="d-flex align-items-end bg-img-hero gradient-overlay-half-dark-v1 transition-3d-hover height-450 rounded-pseudo" href="<?php echo site_url('gallery_view/' . $row['frontend_gallery_id']); ?>"
                        style="background-image: url(<?php echo base_url(); ?>uploads/images/gallery_cover/<?php echo $cover_image;?>);">
                        <article class="w-100 text-center p-6">
                            <h3 class="h4 text-white">
                                <?php echo $row['title']; ?>
                            </h3>
                            <div class="mt-4" style="margin-top:0px !important;">
                                <strong class="d-block text-white-70 mb-2">
                                    <?php echo $number_of_image; ?> <?php echo get_phrase('images'); ?>
                                </strong>
                            </div>
                        </article>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
