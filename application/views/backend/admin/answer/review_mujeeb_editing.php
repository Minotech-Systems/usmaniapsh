<hr>
<div class="row">
    <div class="col-md-4">
        <form class="form-horizontal" method="post"  action="<?= base_url('fatwa/add_review_mujeed_edit') ?>">
            <div class="form-group" style="text-align: right">
                <label class="control-label"><?= 'دوبارہ تصحح شامل کریں' ?></label>
                <input type="hidden" name="question_id" value="<?= $question_id ?>">
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <textarea class="form-control" name="detail" rows="8" required="" placeholder="<?= 'مجیب کو تصحح کا خلاصہ یہاں لکھیں' ?>"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success"><?= 'تصحح شامل کریں' ?></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
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
                        <time class="cbp_tmtime" datetime="2015-11-04T03:45"><span><?= date('H:i A', strtotime($data->date)) ?></span> <span><?= date('d/m/Y', strtotime($data->date)) ?></span></time>

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
</div>