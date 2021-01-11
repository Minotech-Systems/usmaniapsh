<?php
$data = $this->db->get_where('frontend_news', array('news_id'=>$param2))->result();
foreach ($data as $edit_data) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <b><?= get_phrase('title')?></b>
                    <p><?= $edit_data->news_title ?></p>
                    <b><?= get_phrase('description')?></b>
                    <p><?= $edit_data->news_description ?></p>
                    <b><?= get_phrase('date')?></b>
                    <p><?= date('d-m-Y', strtotime($edit_data->create_date)) ?></p>
                </div>
            </div>
        </div>
    </div>
    <!--.-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form method="post" action="<?= base_url('admin/upload_news_file') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="news_id" value="<?= $edit_data->news_id ?>">
                        <table class="table responsive">
                            <thead>
                                <tr>
                                    <th>Attach File</th>
                                    <th>
                                        <input type="file" name="file" class="form-control" required="">
                                    </th>
                                    <th>
                                        <input type="text" name="file_name" class="form-control" placeholder="فائل شامل کریں">
                                    </th>
                                    <th><button class="btn btn-success" type="submit"><?= 'فائل '?></button></th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                    <table class="table responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>فائل کا نام</th>
                                <th> فائل آپشن</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $files = $this->db->get_where('news_files', array('news_id' => $edit_data->news_id))->result();
                            $no = 1;
                            foreach ($files as $file_data) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $file_data->file_name ?></td>
                                    <td>
                                        <a class="btn btn-blue btn-icon icon-left" href="<?= base_url("uploads/news/$file_data->file") ?>">
                                            <i class="entypo-download"></i>
                                            Download
                                        </a>

                                        <a class="btn btn-red btn-icon icon-left" href="<?= base_url("admin/delete_news_file/$file_data->file_id") ?>">
                                            <i class="entypo-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
}?>