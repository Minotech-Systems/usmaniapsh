<style>
    li{text-align: right}
</style>
<div class="row">
    <!-- CALENDAR-->
    <div class="col-md-12 col-xs-12">
        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
            <li class="active">
                <a href="#news_list" data-toggle="tab">
                    <span><i class="entypo-home"></i> <?= 'ضروری اعلانات لسٹ' ?></span>
                </a>
            </li>
            <li class="">
                <a href="#add" data-toggle="tab">
                    <span><i class="entypo-plus-circled"></i> <?= 'شامل ضروری اعلان' ?></span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <br>
            <div class="tab-pane active" id="news_list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><?= get_phrase('serial_no') ?></th>
                            <th><?= get_phrase('title') ?></th>
                            <th><?= get_phrase('description') ?></th>
                            <th><?= get_phrase('date') ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($news as $row) {
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?= $row->news_title ?></td>
                                <td><?= $row->news_description ?></td>
                                <td align="center"><?= date('d-m-Y', strtotime($row->create_date)) ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <?= get_phrase('action') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modals/modal_add_newsfile/' . $row->news_id); ?>');">
                                                    <i class="entypo-attach"></i>
                                                    <?= 'فائل شامل کریں'?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <?php
                                            $files = $this->db->get_where('news_files', array('news_id' => $row->news_id))->result();
                                            $no = 1;
                                            foreach ($files as $file_data) {
                                                ?>
                                                <li>
                                                    <a href="<?= base_url("uploads/news/$file_data->file") ?>" target="blank">
                                                        <i class="entypo-download"></i>
                                                        <?= $file_data->file_name ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <li class="divider"></li>
                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modals/modal_edit_news/' . $row->news_id); ?>');">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url('admin/delete_news/' . $row->news_id) ?>')">
                                                    <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="add">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="box-content">
                            <form method="post" action="<?= base_url('add_news') ?>" enctype="multipart/form-data" class="form-horizontal form-groups-bordered validate">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="news_title" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">News</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" rows="5" name="news_description" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="datepicker form-control" name="create_date"
                                               value="<?php echo date('m/d/Y'); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3  col-md-3 control-label"><?= get_phrase('file') ?></label>
                                    <div class="col-sm-4 col-md-4">
                                        <input type="file" name="news_file" class="form-control">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input type="text" name="file_name" class="form-control" placeholder="<?= 'فائل کا نام لکیھں' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="submit_button" class="btn btn-info"><?= 'اعلان شامل کریں' ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


