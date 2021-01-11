<?php
$student_data = $this->db->get_where('new_student', array('student_id' => $student_id))->row();
$student_enroll = $this->db->get_where('new_enroll', array('student_id' => $student_id))->row();
$student_transactions = $this->db->get_where('new_student_transaction', array('student_id' => $student_id, 'year' => $running_year))->result();
$student_trans = $this->db->get_where('new_student_transaction', array('student_id' => $student_id, 'year' => $running_year))->row();
$student_fee_data = $this->db->get_where('new_student_fee', array('student_id' => $student_id))->row();
?>َ
<form method="post" action="<?= base_url('index.php?newadmission/add_student_monthly_fee') ?>">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('month') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                        <select name="month[]" class="form-control select2" multiple="" id="month" dir="rtl">
                            <?php
                            for ($i = 1; $i <= 12; $i++):
                                if ($i == 1)
                                    $m = 'شوال';
                                else if ($i == 2)
                                    $m = 'ذوالقعدۃ';
                                else if ($i == 3)
                                    $m = 'ذوالحجۃ';
                                else if ($i == 4)
                                    $m = 'محرم';
                                else if ($i == 5)
                                    $m = 'صفر';
                                else if ($i == 6)
                                    $m = 'ر بیع الاول';
                                else if ($i == 7)
                                    $m = 'ر بیع الثانی';
                                else if ($i == 8)
                                    $m = 'جمادی الاول';
                                else if ($i == 9)
                                    $m = 'جمادی الثانی';
                                else if ($i == 10)
                                    $m = 'رجب';
                                else if ($i == 11)
                                    $m = 'شعبان';
                                else if ($i == 12)
                                    $m = ' رمضان';
                                ?>
                                <option value="<?php echo $i; ?>">
                                    <?php echo ucfirst($m); ?>
                                </option>
                                <?php
                            endfor;
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <label class="control-label" for="full_name"><?php echo get_phrase('amount') ?></label>
                    <div class="input-group minimal">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="fa fa-money"></i></button>
                        </span>
                        <input type="number" class="form-control"  name="amount" value="<?php
                        if (!empty($student_fee_data)) {
                            echo $student_fee_data->amount;
                        }
                        ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group minimal">
                    <button type="submit" class="btn btn-success" style="margin-top: 20px;"><?= 'داخل کریں' ?></button>
                </div>
            </div>
            <input type="hidden" name="student_id" value="<?= $student_id ?>">
            <input type="hidden" name="branch_id" value="<?= $student_enroll->branch_id ?>">

        </div>
    </div>
</form>
<div class="row">
    <form action="<?= base_url('index.php?newadmission/edit_student_fee') ?>" method="post">
        <input type="hidden" value="<?= $student_id ?>" name="student_id">
        <div class="col-md-6 col-sm-6" style="text-align: center; border-left: 1px dashed">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center" colspan="4">
                            <h3>
                                <?= $student_data->name . ' ولدیت ' . ' ' . $student_data->father_name ?>
                                &nbsp;&nbsp;&nbsp;
                                <?= 'ماہانہ فیس' ?>
                            </h3>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>#</td>
                        <td><?= 'مہینہ' ?></td>
                        <td><?= 'فیس' ?></td>
                        <td><?= 'حذف' ?></td>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($student_transactions as $tran) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $this->crud_model->get_month_name($tran->month); ?></td>
                            <td><?= $tran->amount ?></td>
                            <td><a href=""><i class="entypo-trash"></i></a></td>
                        </tr>
                        <?php
                        $total_fee += $tran->amount;
                    }
                    ?>
                    <tr>
                        <td colspan="2"><?= 'ٹوٹل اداشدہ فیس' ?></td>
                        <td colspan="2" align="right"><?= $total_fee ?></td>
                    </tr>

                    <tr>

                        <td></td>
                        <td>
                            <input type="number" name="fee" value="<?= $student_trans->amount ?>" class="form-control" style="width: 60%">
                        </td>
                        <td colspan="2">
                            <button type="submit" class="btn btn-success"><?= 'فیس تصحح' ?></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <div class="col-md-6 col-sm-6">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="text-align: center" colspan="4"><h3><?= 'اضافی فیس' ?></h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#</td>
                    <td><?= 'نام' ?></td>
                    <td><?= 'رقم' ?></td>
                    <td><?= 'کیفیت' ?></td>
                </tr>
                <?php
                $other_fee = $this->db->get_where('new_other_fee', array('branch_id' => $student_enroll->branch_id))->result();
                $no2 = 1;
                foreach ($other_fee as $other) {
                    ?>
                    <tr>
                        <td><?= $no2++ ?></td>
                        <td><?= $other->name ?></td>
                        <td><?= $other->amount ?></td>
                        <td>
                            <?php
                            $other_trans = $this->db->get_where('new_other_fee_transaction', array('student_id' => $student_id, 'fee_id' => $other->id, 'year' => $running_year))->row();
                            if (!empty($other_trans)) {
                                echo $other_trans->amount . '  ادا کیا گیاہے۔';
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>