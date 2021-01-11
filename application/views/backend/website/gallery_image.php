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
    .float-left{
        float: left;
    }
    .mdi{font-size: 16px;}
</style>
<div class="gallery_photo_content">
  <?php
  $gallery_photos = $this->db->get_where('frontend_gallery_image', array('frontend_gallery_id' => $gallery_id))->result_array();
  $gallery_info = $this->db->get_where('frontend_gallery', array('frontend_gallery_id' => $gallery_id))->row_array();
  ?>
  <div class="row ">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h4 class="page-title">
            <i class="mdi mdi-chart-timeline title_icon"></i> <?php echo $gallery_info['title']; ?>
            <button type="button" class="btn btn-outline-primary btn-rounded float-left" onclick="showAjaxModal('<?php echo base_url('modal/popup/modals/add_gallery_image/'.$gallery_id); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_photo'); ?></button>
          </h4>
        </div>  
      </div>  
    </div> 
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          <?php if (count($gallery_photos) > 0): ?>
            <div class="row">
              <?php foreach($gallery_photos as $gallery_photo):?>
                <div class="col-md-6 col-xl-3">
                  <div class="card d-block">
                    <img class="card-img-top" src="<?php echo $this->frontend_model->get_gallery_image($gallery_photo['image']); ?>" alt="project image cap">
                    <div class="card-img-overlay">
                      <div style="float: right;">
                          <a class="btn  btn-warning btn-sm"  href="#" onclick="confirm_modal('<?php echo base_url('website/gallery_photo_delete/'.$gallery_photo['frontend_gallery_image_id'].'/'.$gallery_id); ?>')"> <i class="mdi mdi-delete"></i> </a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <?php include APPPATH.'views/backend/empty.php'; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>


