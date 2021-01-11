
<script src="assets/js/urdutextbox.js"></script>
<script>
    window.onload = myOnload;
    function myOnload(evt) {
        MakeTextBoxUrduEnabled();
    }

</script>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('student_exam_roll'); ?>
                </a>
            </li>
            <!--            <li>
                            <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
            <?php echo get_phrase('exam_roll'); ?>
                            </a>
                        </li>-->
            <li>
                <a href="#add_single_exam_roll" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_single_exam_roll'); ?>
                </a>
            </li>
            <li>
                <a href="#add_exam_roll" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_exam_roll'); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th><?= get_phrase('session') ?></th>
                            <th><?= get_phrase('starting_number') ?></th>
                            <th><?= get_phrase('end_number') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $this->db->get_where('exam_roll_no', array('year' => $running_year))->result();
                        if (!empty($query)) {
                            ?>
                            <tr>
                                <td><?= $running_year ?></td>
                                <td><?= $this->db->get_where('exam_roll_no', array('year' => $running_year))->first_row()->roll_no; ?></td>
                                <td><?= $this->db->get_where('exam_roll_no', array('year' => $running_year))->last_row()->roll_no; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane box" id="add_single_exam_roll">
                <?php echo form_open(base_url() . 'index.php?exam/exam_roll/edit_exam_roll', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                <div class="box-content">

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="class_id" onchange="get_class_students(this.value)">
                                <option><?= get_phrase('select_class') ?></option>
                                <?php
                                if ($user_level == 0) {
                                    $classes = $this->db->get('class')->result();
                                } else {
                                    $classes = $this->db->get_where('class', array('branch_id' => $branch_id))->result();
                                }
                                foreach ($classes as $class) {
                                    ?>
                                    <option value="<?= $class->class_id ?>"><?= $class->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('students'); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="student_id" id="student_holder" onchange="check_exam_roll(this.value)">
                                <option><?= get_phrase('select_class_first') ?></option>
                            </select>
                            <div id="display_message" class="alert alert-success" style="display: none"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('exam_roll'); ?></label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="roll_no" oninput="check_roll(this.value)">
                            <div id="show_exam_roll_d" class="alert alert-danger" style="display: none"><?= 'یہ امتحانی رولنمبر پہلے سے موجود ہے۔۔۔' ?></div>
                            <div id="show_exam_roll_s" class="alert alert-success" style="display: none"><?= 'یہ امتحانی رولنمبر اپ لگا سکتے ہیں۔۔۔' ?></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-5 col-md-offset-3">
                            <button type="submit" class="btn btn-success" id="submit_in"><?= get_phrase('submit') ?></button>
                        </div>

                    </div>

                </div>
                <?= form_close() ?>
            </div>
            <!--.-->
            <div class="tab-pane box" id="add_exam_roll">
                <?php echo form_open(base_url() . 'index.php?exam/exam_roll/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                <div class="box-content">

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo 'ابتدائی نمبر' ?></label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="starting_num">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-5 col-md-offset-3">
                            <button type="submit" class="btn btn-success" id="submit_in"><?= get_phrase('submit') ?></button>
                        </div>

                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function get_class_students(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?exam/get_class_students_parents/' + class_id,
                success: function (response)
                {

                    jQuery('#student_holder').html(response);
                }
            });
        }
    }

    function check_exam_roll(student_id) {
        if (student_id !== '') {
            $('#display_message').hide('slow');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?exam/check_student_exam_roll/' + student_id,
                success: function (response)
                {
                    $('#display_message').show('slow');
                    jQuery('#display_message').html(response);
                }
            });
        }
    }

    function check_roll(roll_no) {
        //jQuery('#show_exam_roll').html(value);
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?exam/check_exam_roll/' + roll_no,
            success: function (response)
            {
                if (response == 1) {
                    $('#show_exam_roll_d').show('slow');
                    $('#show_exam_roll_s').hide('slow');
                    $("#submit_in").attr("disabled", true);

                } else if (response == 0) {
                    $('#show_exam_roll_s').show('slow');
                    $('#show_exam_roll_d').hide('slow');
                    $("#submit_in").attr("disabled", false);

                }

            }
        });
    }
</script>