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
                url: '<?php echo base_url(); ?>index.php?student_fee/add_scholarship_transation',
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