<br><br>
<div class="row">
    <div class="container">
        <div class="col-md-5">
            <?php foreach ($fatwa as $data) { ?>
                <div class="">
                    <h4><?= 'عنوان:' ?></h4>
                    <h5 style="line-height: 2"><?= $data->title ?></h5>
                    <h4><?= 'سوال:' ?></h4>
                    <h5 style="line-height: 2"><?= $data->question ?></h5>
                </div>
                <hr>
                <div class="">
                    <h4><?= 'فتویٰ:' ?></h4>
                    <h5 style="line-height: 2; font-weight: bold"><?= $data->answer ?></h5>
                </div>

            <?php } ?>
        </div>
        <div class="col-md-7">
            <h4><?= 'مجیب فتویٰ تصحح ریکوسٹ' ?></h4>
            <br />

            <ul class="cbp_tmtimeline">
                <?php
                $edit_detail = $this->db->get_where('ifta_fatwa_review', array('question_id' => $question_id))->result();
                if (empty($edit_detail)) {
                    ?>
                    <li>
                        <div class="cbp_tmicon">
                            <i class="entypo-user"></i>
                        </div>

                        <div class="cbp_tmlabel empty">
                            <span><?= 'کوئی تصحح نہیں بھیجی گئی' ?></span>
                        </div>
                    </li>
                    <?php
                } else {
                    foreach ($edit_detail as $data) {
                        ?>

                        <li>
                            <time class="cbp_tmtime" style="padding-right: 20px"><span><?= date('H:i A', strtotime($data->date)) ?></span> <span><?= date('d/m/Y', strtotime($data->date)) ?></span></time>

                            <div class="cbp_tmicon bg-success">
                                <i class="entypo-feather"></i>
                            </div>

                            <div class="cbp_tmlabel">
                                <p><?= $data->detail ?></p>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="col-md-12">
            <center>
                <a href="<?= base_url('fatwa/edit_fatwa/'.$fatwa_id)?>" class="btn btn-default">
                    <i class="fa fa-pencil"></i>
                        <?= 'دوبارہ تصحح کریں'?>
                </a>
            </center>
        </div>
    </div>

</div>