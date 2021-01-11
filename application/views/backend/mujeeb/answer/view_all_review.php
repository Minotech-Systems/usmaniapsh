<div class="row">
    <div class="col-md-12">
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= 'سوال عنوان' ?></th>
                        <th><?= 'ایڈمن تشریح' ?></th>
                        <th><?= 'تاریخ' ?></th>
                        <th><?= 'ملاحظہ کیجئے' ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($all_review as $data) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data->title?></td>
                            <td><?= $data->detail?></td>
                            <td><?= date('d/m/Y H:i:s A', strtotime($data->date))?></td>
                            <td>
                                <a href="<?= base_url('mujeeb/view_review_question/'.$data->question_id.'/'.$data->review_id)?>"><i class="entypo-eye"></i></a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>