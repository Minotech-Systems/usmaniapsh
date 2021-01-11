<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('daily_student_report'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_report'); ?>
                </a>
            </li>
            <li>
                <a href="#class" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('class_daily_report'); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="row">

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher'); ?></label>
                                <div class="col-sm-9">
                                    <select name="teacher_id_1" class="form-control "  onchange="get_student(this.value)" id="teacher_id_1" style="margin-bottom: 10px">
                                        <option value=""><?= get_phrase('select_teacher') ?></option>
                                        <?php
                                        $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
                                        foreach ($teachers as $row):
                                            ?>
                                            <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--.-->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student'); ?></label>
                                <div class="col-sm-9">
                                    <select name="student_id" class="form-control" id="student_1" style="margin-bottom: 10px">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                                <div class="col-sm-9">
                                    <select name="month" class="form-control" id="month">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++):
                                            if ($i == 1)
                                                $m = 'جنوری';
                                            else if ($i == 2)
                                                $m = 'فروری';
                                            else if ($i == 3)
                                                $m = 'مارچ ';
                                            else if ($i == 4)
                                                $m = 'اپریل ';
                                            else if ($i == 5)
                                                $m = 'مئی ';
                                            else if ($i == 6)
                                                $m = 'جون ';
                                            else if ($i == 7)
                                                $m = 'جولائی ';
                                            else if ($i == 8)
                                                $m = 'اگست ';
                                            else if ($i == 9)
                                                $m = 'ستمبر ';
                                            else if ($i == 10)
                                                $m = 'اکتوبر ';
                                            else if ($i == 11)
                                                $m = 'نومبر ';
                                            else if ($i == 12)
                                                $m = 'دسمبر ';
                                            ?>
                                            <option value="<?php echo $i; ?>"
                                                    <?php if ($month == $i) echo 'selected'; ?>  >
                                                        <?php echo get_phrase($m); ?>
                                            </option>
                                            <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9" style="margin-bottom: 10px">
                                    <a  class="btn btn-success" onclick="get_student_daily_report_view()"><?= get_phrase('submit') ?></a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--.-->
                    <div class="col-sm-8  col-md-8" style="padding: 30px;">
                        <div id="daily_report_view"></div>
                    </div>
                </div>
            </div>
            <!--.-->
            <div class="tab-pane box " id="add">
                <div class="row">
                    <?php echo form_open(base_url(), array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="row">
                                <div class="col-sm-12  col-md-12" style="padding: 30px;">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><?php echo get_phrase('teacher'); ?></label>
                                        <div class="col-sm-8">
                                            <select name="teacher_id" class="form-control "  onchange="get_students(this.value)" id="teacher_id">
                                                <option value=""><?= get_phrase('select_teacher') ?></option>
                                                <?php
                                                $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
                                                foreach ($teachers as $row):
                                                    ?>
                                                    <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><?php echo get_phrase('student'); ?></label>
                                        <div class="col-sm-8">
                                            <select name="student_id" class="form-control" id="student" >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><?php echo get_phrase('date'); ?></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control datepicker" name="date" data-format="dd-mm-yyyy" value="<?php echo date("d-m-Y"); ?>" id="date"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" style="text-align: center">
                                            <button type="button" id="submit" class="btn btn-success" onclick="get_student_daily_report()"><?= get_phrase('submit') ?></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div style="display: none" id="loading">
                                <center>
                                    <img src="<?= base_url('uploads/loading_gif.gif') ?>" width="100" style="align-self: center">
                                </center>

                            </div>
                            <div id="std_view" style="display: none"></div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

            <!--.-->
            <div class="tab-pane box " id="class">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="row">

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher'); ?></label>
                                <div class="col-sm-9">
                                    <select name="teacher_id_c" class="form-control "   id="teacher_id_c" style="margin-bottom: 10px">
                                        <option value=""><?= get_phrase('select_teacher') ?></option>
                                        <?php
                                        $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
                                        foreach ($teachers as $row):
                                            ?>
                                            <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!--.-->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                                <div class="col-sm-9">
                                    <select name="month_c" class="form-control" id="month_c">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++):
                                            if ($i == 1)
                                                $m = 'جنوری';
                                            else if ($i == 2)
                                                $m = 'فروری';
                                            else if ($i == 3)
                                                $m = 'مارچ ';
                                            else if ($i == 4)
                                                $m = 'اپریل ';
                                            else if ($i == 5)
                                                $m = 'مئی ';
                                            else if ($i == 6)
                                                $m = 'جون ';
                                            else if ($i == 7)
                                                $m = 'جولائی ';
                                            else if ($i == 8)
                                                $m = 'اگست ';
                                            else if ($i == 9)
                                                $m = 'ستمبر ';
                                            else if ($i == 10)
                                                $m = 'اکتوبر ';
                                            else if ($i == 11)
                                                $m = 'نومبر ';
                                            else if ($i == 12)
                                                $m = 'دسمبر ';
                                            ?>
                                            <option value="<?php echo $i; ?>"
                                                    <?php if ($month == $i) echo 'selected'; ?>  >
                                                        <?php echo get_phrase($m); ?>
                                            </option>
                                            <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--.-->
                            <div class="form-group">
                                <div class="col-sm-9" style="margin-bottom: 10px">
                                    <a  class="btn btn-success" onclick="get_student_daily_report_view_c()"><?= get_phrase('submit') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-8  col-md-8" style="padding: 30px;">
                        <div id="daily_report_view_c"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function get_students(teacher_id) {
        if (teacher_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?exam/get_students/' + teacher_id,
                success: function (response)
                {

                    jQuery('#student').html(response);
                }
            });
        }
    }

    function get_student(teacher_id) {
        if (teacher_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?exam/get_students/' + teacher_id,
                success: function (response)
                {

                    jQuery('#student_1').html(response);
                }
            });
        }
    }

    function get_student_daily_report() {
        $('#loading').show();
        $('#std_view').hide();
        var student_id = $('#student').val();
        var date = $('#date').val();
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?exam/get_student_daily_report/' + student_id + '/' + date,
            success: function (response)
            {
                $('#loading').hide();
                $('#std_view').show();
                jQuery('#std_view').html(response);
            }
        });
    }

    function get_student_daily_report_view() {
        var student_id = $('#student_1').val();
        var teacher_id = $('#teacher_id_1').val();
        var month = $('#month').val();
        if (student_id && teacher_id && month) {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?exam/load_daily_report_view/' + student_id + '/' + teacher_id + '/' + month,
                success: function (response)
                {
                    jQuery('#daily_report_view').html(response);
                }
            });
        } else {
            alert('Select All field...')
            return false;
        }
    }
    function get_student_daily_report_view_c() {
        var teacher_id = $('#teacher_id_c').val();
        var month = $('#month_c').val();
//        alert(teacher_id);
        if (teacher_id && month) {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?exam/load_daily_report_class_view/' + teacher_id + '/' + month,
                success: function (response)
                {
                    jQuery('#daily_report_view_c').html(response);
                }
            });
        } else {
            alert('Select All field...')
            return false;
        }
    }
</script>
<script>
    $(function () {
        $('form').on('submit', function (e) {
            $('#loading').show();
            $('#std_view').hide();
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?= base_url('index.php?exam/student_daily_report_update') ?>',
                data: $('form').serialize(),
                success: function (response) {
                    $('#loading').hide();
                    $('#std_view').show();
                }
            });

        });

    });
</script>