<?php
    $students_info = $this->studentfee_model->branch_students_transaction($running_year, $branch_id);
    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result_array();

?>
<style>
    .form-groups-bordered > .form-group{
        border-bottom: 0px;
        padding-bottom: 0px;
    }
</style>
<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('transaction_list'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('student_transaction'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('name'); ?></div></th>
                            <th><div><?php echo get_phrase('parent'); ?></div></th>
                            <th><div><?php echo get_phrase('class'); ?></div></th>
                            <th><div><?php echo get_phrase('paid_payment'); ?></div></th>
                            <th><div><?php echo get_phrase('self_payment'); ?></div></th>
                            <th><div><?php echo 'متکفل' . ' / ' . 'ازادارہ'; ?></div></th>
                            <th><div><?php echo get_phrase('remaining'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($students_info as $data) {
                            $monthly_fee = 0;
                            $to_be_paid = 0;
                            $paid_amount = 0;
                            $class = $this->db->get_where('class', array('class_id' => $data['class_id']))->row()->name;
                            $section = $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name;
                            $branch_id = $this->db->get_where('class', array('class_id' => $data['class_id']))->row()->branch_id;
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['name'] ?></td>
                                <td><?php echo $data['father_name'] ?></td>
                                <td><?php echo $class . ' (' . $section . ' )' ?></td>
                                <td><?php echo $paid_amount = $this->studentfee_model->get_student_transaction_sum($data['student_id'], $data['class_id'], $running_year) ?></td>
                                <td><?php
                                    $monthly_fee = $this->db->get_where('monthly_fee', array('year' => $running_year, 'branch_id' => $branch_id))->row()->amount;
                                    $to_be_paid = $this->studentfee_model->get_student_monthly_fee($data['student_id'], $running_year);
                                    $sponsor_id = $this->db->get_where('student_fee', array('student_id' => $data['student_id'], 'year' => $running_year))->row()->sponsor_id;
                                    if ($sponsor_id > 0) {
                                        echo 'متکفل';
                                    } else {
                                        echo $this->studentfee_model->get_student_monthly_fee($data['student_id'], $running_year);
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if ($sponsor_id > 0) {
                                        echo $this->db->get_where('students_sponsor', array('sponsor_id' => $sponsor_id))->row()->name . ' / ';
                                        echo $this->db->get_where('sponsor_help', array('sponsor_id' => $sponsor_id, 'student_id' => $data['student_id'], 'year' => $running_year))->row()->amount;
                                    } else {
                                        echo ($monthly_fee - $to_be_paid);
                                    }
                                    ?>
                                </td>
                                <td><?php echo ($monthly_fee * 12) - $paid_amount; ?></td>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>index.php?student_fee/view_student_transaction/<?php echo $data['student_id']; ?>" class="btn btn-success" target="_blank">
                                        <i class="entypo-eye"><?php echo get_phrase('detail') ?></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane box " id="add">
                <div class="row">
                    <div class="col-md-6" >

                        <div class="padded">

                            <form method="post" id="student_tran" enctype="multipart/form-data" action="" class="form-horizontal form-groups-bordered">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo get_phrase('teacher'); ?></label>
                                    <div class="col-sm-7">
                                        <select name="teacher_id" class="form-control" data-validate="required" id="class_id" 
                                                data-message-required="<?php echo get_phrase('value_required'); ?>"
                                                onchange="return get_students(this.value)">
                                            <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                                            <option value="all"><?php echo 'تمام'; ?></option>
                                            <?php
                                            foreach ($teachers as $row):
                                                ?>
                                                <option value="<?php echo $row['teacher_id']; ?>" ><?php echo $row['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo get_phrase('student'); ?></label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 select2-offscreen visible" name="student_id" id="student_list"  onchange="return get_students_fee(this.value, '1')" >


                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('month'); ?></label>
                                    <div class="col-sm-7">
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
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo get_phrase('amount'); ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo 'اضافی فیس'; ?></label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="additional_amount" placeholder="اضافی فیس کا اندراج یہاں کریں">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-3">
                                        <button type="submit" class="btn btn-info" onclick="upload_social_links()"><?php echo get_phrase('add_transaction'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-6" >
                        <div class="row" style="display: none" id="loading_gif1" >
                            <div class="col-md-12"  style="text-align: center">
                                <image src="<?= base_url('uploads/loading.gif') ?>">
                            </div>
                        </div>
                        <div class="alert alert-success" style="display:none;" id="success_message">
                            <strong>کامیابی سے فیس کو ادا کیا گیا۔۔۔</strong>
                        </div>
                        <div id="student_fee_detail"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

 

    function get_students(value) {
        var class_id = document.getElementById("class_id").value;
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?student_fee/get_class_students_parents/' + value,
            success: function (response)
            {
                jQuery('#student_list').html(response);
            }
        });

    }
</script>
<script>
    $(function () {

        $('#student_tran').on('submit', function (e) {
            $('#loading_gif1').show();
            $('#student_fee_detail').hide();
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>index.php?student_fee/add_student_transation',
                data: $('form').serialize(),
                success: function () {
                    $('#loading_gif1').hide();
                    $('#success_message').show();
                    setTimeout(function () {
                        $('#success_message').hide()
                    }, 2000);
                    var e = document.getElementById("student_list");
                    var student_id = e.options[e.selectedIndex].value;
                    get_students_fee(student_id);
                   
                }
            });

        });

    });


    function get_students_fee(student_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?student_fee/get_student_fee_info/' + student_id,
            success: function (response)
            {
                $('#student_fee_detail').show();
                jQuery('#student_fee_detail').html(response);  //other_fee_detial

            }
        });


    }
</script>