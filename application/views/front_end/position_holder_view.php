<?php include 'header.php'; ?>
<style>
    .testimonial-img{
        width: 114px;
        border-radius: 50%;
        border: 4px solid #f7f7f7;
    }
</style>
<section id="pricing" class="wow fadeInUp section-bg">

    <div class="container">

        <div class="row flex-items-xs-middle flex-items-xs-center">

            <?php
            $pos_holders = $this->db->get_where('web_position_holders', array('session' => $session))->result();
            foreach ($pos_holders as $data) {
                ?>
                <div class="col-xs-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                <img src="<?= base_url('uploads/images/position_holder/' . $data->image) ?>" class="testimonial-img">
    <!--                                <span class="period">
                                <?= $data->name ?>
                                <?= 'ولد' . ' : ' . $data->father_name ?>
                                </span>-->
                            </h3>
                        </div>
                        <div class="card-block">
                            <h6 class="card-title" style="font-weight:bold;"> 
                                <?= $data->name ?>
                                <?= 'ولد' . ' ' . $data->father_name ?>
                            </h6>
                            <ul class="list-group">
                                <li class="list-group-item"><?= 'پوزیشن' . ': &nbsp;&nbsp;&nbsp;' . $data->position ?></li>
                                <li class="list-group-item"><?= 'نمبرات' . ': &nbsp;&nbsp;&nbsp;' . $data->marks ?></li>
                                <li class="list-group-item"><?= 'کلاس' . ': &nbsp;&nbsp;&nbsp;' . $data->position ?></li>
                                <li class="list-group-item"><?= 'رول نمبر' . ': &nbsp;&nbsp;&nbsp;' . $data->roll_no ?></li>
                                <li class="list-group-item"><?= 'ملکی /صوبا ئی' . ': &nbsp;&nbsp;&nbsp;' . $data->position_type ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

</section><!-- #pricing -->