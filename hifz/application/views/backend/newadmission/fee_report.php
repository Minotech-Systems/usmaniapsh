<div class="row">
    <div class="col-md-6 col-md-offset-2">
        <table class="table table-bordered">
            <?php
            $branches = $this->db->get('branches')->result();
            foreach ($branches as $bran) {
                ?>
                <thead>
                    <tr>
                        <th style="text-align: center" colspan="2" dir="ltr"><?= $bran->name ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%"><?= 'ٹوٹل ماہانہ فیس' ?></td>
                        <td><?= $month_fee = $this->newadmission_model->get_monthly_fee_sum($running_year, $bran->branch_id) ?></td>
                    </tr>
                    <tr>
                        <td width="50%"><?= 'ٹوٹل اضافی فیس' ?></td>
                        <td><?= $other_fee = $this->newadmission_model->get_other_fee_sum($running_year, $bran->branch_id) ?></td>
                    </tr>
                </tbody>
                <?php
                $total_month_fee += $month_fee;
                $total_other_fee += $other_fee;
            }
            ?>
            <tr>
                <td>ٹوٹل رقم</td>
                <td><?= $total_month_fee + $total_other_fee ?></td>
            </tr>
        </table>
        <center>
            <a href="<?= base_url('index.php?newadmission/print_fee_report') ?>" class="btn btn-default" target="blank">
                <i class="fa fa-print"></i>
                <?= 'پرنٹ رپورٹ' ?>
            </a>
        </center>
    </div>
</div>