<link rel="stylesheet" href="<?= base_url('assets/frontend/css/gallery.css') ?>">
<style>
    @media (min-width: 1200px){
        .col-xl-3 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }
    }

</style>
<br><br>
<div class="frontend_gallery_content">
    <div class="row" style="float: right;">
        <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="showAjaxModal('<?php echo base_url('modal/popup/modals/add_gallery/'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('create_gallery'); ?></button>
    </div>
    <br><br>
    <br><br>
    <?php $frontend_gallery = $this->db->get('frontend_gallery')->result_array(); ?>
    <?php if (count($frontend_gallery) > 0): ?>
        <div class="row">
            <?php foreach ($frontend_gallery as $gallery): ?>
                <div class="col-md-6 col-xl-3">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body" style="height: 160px;">
                            <div class="dropdown card-widgets">
                                <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                                    <i class="dripicons-dots-3"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="#" class="dropdown-item" onclick="showAjaxModal('<?php echo base_url('modal/popup/modals/edit_gallery/' . $gallery['frontend_gallery_id']); ?>')"><i class="fa fa-pencil"></i><?php echo get_phrase('edit'); ?></a>
                                    <!-- item-->
                                    <a href="#" class="dropdown-item" onclick="confirm_modal('<?php echo base_url('website/frontend_gallery/delete/' . $gallery['frontend_gallery_id']); ?>')"><i class="entypo-trash"></i><?php echo get_phrase('delete'); ?></a>
                                </div>
                            </div>
                            <!-- project title-->
                            <h4 class="mt-0">
                                <a href="<?php echo route('website/gallery_image/' . $gallery['frontend_gallery_id']); ?>" class="text-title"><?php echo $gallery['title']; ?></a>
                            </h4>
                            <?php if ($gallery['show_on_website']): ?>
                                <div class="badge badge-success mb-3"><?php echo get_phrase('visible'); ?></div>
                            <?php else: ?>
                                <div class="badge badge-danger mb-3"><?php echo get_phrase('not_visible'); ?></div>
                            <?php endif; ?>


                            <p class="text-muted font-13 mb-3">
                                <?php echo ellipsis($gallery['description'], 150); ?>
                            </p>
                        </div> <!-- end card-body-->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <div style="text-align:left">
                                    <?php $photos = $this->frontend_model->get_photos_by_gallery_id($gallery['frontend_gallery_id']); ?>
                                    <?php if (count($photos) > 0): ?>
                                        <?php foreach ($photos as $key => $photo): ?>
                                            <?php if ($key <= 2): ?>
                                                <a href="<?php echo route('website/gallery_image/' . $gallery['frontend_gallery_id']); ?>" class="d-inline-block">
                                                    <img src="<?php echo $this->frontend_model->get_gallery_image($photo['image']); ?>" class="rounded-circle avatar-xs" alt="friend">
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if (count($photos) > 3): ?>
                                            <a href="<?php echo route('website/gallery_image/' . $gallery['frontend_gallery_id']); ?>" class="d-inline-block text-muted font-weight-bold ml-2">
                                                +<?php echo (count($photos) - 3) . ' ' . get_phrase('more'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span><?php echo get_phrase('no_photos_found'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- end card-->
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php include APPPATH . 'views/backend/empty.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>


<script type="text/javascript">
    var showAllGallery = function () {
        var url = '<?php echo route('frontend_gallery/gallery_list'); ?>';

        $.ajax({
            type: 'GET',
            url: url,
            success: function (response) {
                $('.frontend_gallery_content').html(response);
            }
        });
    }
</script>
