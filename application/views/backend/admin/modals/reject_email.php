<?php
$question_data = $this->db->get_where('ifta_question', array('question_id' => $param2))->result();

foreach ($question_data as $data) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo $data->title; ?>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal form-groups-bordered validate" action="<?= base_url('questions/send_reject_email') ?>" method="post">
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo 'تشریح'; ?></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="email" rows="8" placeholder="<?= 'منسوخ سوال کیلئے واضح بیان لکھیں۔۔۔' ?>"></textarea>
                                </div>
                            </div>
                            <input type="hidden" value="<?= $param2 ?>" name="question_id">
                            <div class="form-group" style="text-align: center">
                                <button type="submit" class="btn btn-success"><?= 'ای میل بھیجئے' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}?>