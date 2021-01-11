<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$data = $this->db->get_where('student_transaction', array('student_transaction_id' => $param2))->result_array();

foreach ($data as $row) {
    $student = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
    $amount = $this->db->get_where('student_fee', array('student_id' => $row['student_id'], 'year' => $running_year))->row()->amount;
    $scholorship_data = $this->db->get_where('scholorship_transaction', array('student_id' => $row['student_id'],
                'year' => $running_year,
                'month' => $row['month']))->row();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo $student; ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?student_fee/view_student_transaction/edit/' . $param2, array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('monthly_fee'); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" dir="ltr" name="amount" value="<?php echo $row['amount'] ?>" >
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('month'); ?></label>
                                <div class="col-sm-8">
                                    <select name="month" class="form-control " id="month" dir="rtl">
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
                                                    <?php if ($row['month'] == $i) echo 'selected'; ?>  >
                                                        <?php echo $m; ?>
                                            </option>
                                            <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('date'); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="datepicker form-control" name="date" data-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', strtotime($row['date'])) ?>" 
                                           data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>


                        </div>
                        <input type="hidden" name="scholarship_id" value="<?= $scholorship_data->id ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="col-sm-4 control-label"><?= 'تعاون ازادارہ' ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" dir="ltr" name="amount_s" value="<?php echo $scholorship_data->amount ?>" >
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('month'); ?></label>
                                <div class="col-sm-8">
                                    <select name="month_s" class="form-control " id="month_s" dir="rtl">
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
                                                    <?php if ($row['month'] == $i) echo 'selected'; ?>  >
                                                        <?php echo $m; ?>
                                            </option>
                                            <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('date'); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="datepicker form-control" name="date_s" data-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', strtotime($scholorship_data->date)) ?>" 
                                           data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('update'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>