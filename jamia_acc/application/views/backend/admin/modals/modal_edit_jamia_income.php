<?php
$edit_data = $this->db->get_where('income', array('id' => $param2))->result_array();
foreach ($edit_data as $data) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo $this->crud_model->get_column_name_by_id('income_category', 'id', $data['income_category_id']); ?>
                    </div>
                </div>
                <div class="panel-body">
    <?php echo form_open(base_url() . 'index.php?admin/add_income/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <select name="income_category_id" class="form-control">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $income_cat = $this->db->get('income_category')->result_array();
                                foreach ($income_cat as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" <?php if ($row1['id'] == $data['income_category_id']) echo 'selected'; ?>>
                                    <?php echo $row1['name']; ?>
                                    </option>
    <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assistant_name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="assistant" value="<?= $data['assistant'] ?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bill_no'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="bill_no" value="<?= $data['bill_no'] ?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="amount" value="<?= $data['amount'] ?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                        <div class="col-sm-5">
                            <select name="islamic_month" class="form-control"  id="month" dir="rtl">
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
                                    <?php if ($data['arabic_month'] == $i) echo 'selected'; ?>  >
                                    <?php echo $m; ?>
                                    </option>
                                    <?php
                                endfor;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="date" data-format="dd-mm-yyyy" value="<?= date('d-m-Y', strtotime($data['date'])); ?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('comment'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="comment" value="<?= $data['comment'] ?>"> 
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('update'); ?></button>
                        </div>
                    </div>
    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

