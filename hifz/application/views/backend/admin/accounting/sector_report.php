<div class="row">
    <form method="post" action="<?= base_url() . 'index.php?student_fee/sector_report_view/' ?>" target="_blank">
        <div class="col-md-3 col-md-offset-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
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
                        <option value="<?php echo $i; ?>"
                                <?php if ($month == $i) echo 'selected'; ?>  >
                                    <?php echo ucfirst($m); ?>
                        </option>
                        <?php
                    endfor;
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="margin-top: 20px;"><?= 'رپورٹ دیکھائے' ?></button>
            </div>
        </div>
    </form>
</div>
