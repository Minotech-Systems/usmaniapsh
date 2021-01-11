<?php
$edit_data = $this->db->get_where('frontend_news', array('news_id' => $param2))->result();
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <form method="post" action="<?= base_url('admin/update_news') ?>" class="form-horizontal form-groups-bordered validate">
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="news_title" value="<?= $row->news_title ?>" required/>
                        </div>
                    </div>
                    <input type="hidden" name="news_id" value="<?= $param2 ?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
                        <div class="col-sm-8">
                            <div class="box closable-chat-box">
                                <div class="box-content padded">
                                    <div class="chat-message-box">
                                        <textarea name="news_description" id="ttt" rows="5" class="form-control"
                                                  placeholder="<?= 'Add News' ?>" required><?php echo $row->news_description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="datepicker form-control" name="create_date" value="<?php echo date('d-m-Y', strtotime($row->create_date)); ?>" required/>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">اعلان تصحح</button>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>