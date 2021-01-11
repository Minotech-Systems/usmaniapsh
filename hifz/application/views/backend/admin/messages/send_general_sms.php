
<?php echo form_open(base_url() . 'index.php?message/send_general_sms', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
<div class="row">
    <div class="col-sm-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-sm-9">
                        <select name="relation" class="form-control" style="width:100%;" id="messageType">
                            <option value=""><?php echo '-منتخب کریں-'; ?></option>
                            <option value="class_wise"><?php echo 'طلباء میسیج ' ?></option>
                            <option value="all_teacher"><?php echo 'تمام اساتذہ' ?></option>
                        </select>
                        <br/>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-sm-9">
                        <!--<textarea class="form-control" rows="6" name="general_message"></textarea>-->
                        <textarea id="textareaChars" maxlength="300" class="form-control" rows="6" name="general_message"></textarea>

                        <span id="chars">300</span> characters remaining
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="col-xs-3 col-sm-3" id="class_wise_message" style="display: none;">
        <!--Class List-->
        <div class="form-group" >
            <div class="col-sm-9">
                <select name="teacher_id" class="form-control "  onchange="get_class_students(this.value)" id = "class_selection">
                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                    <?php
                    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
                    foreach ($teachers as $row) {
                        ?>
                        <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                    <?php } ?>
                </select>
            </div> 
        </div>
    </div>
    <div class="col-sm-4" id="student_list">

    </div>
    <div class="col-sm-4" id="teacher_list"></div>




</div>
<div class="form-group">
    <div class="col-sm-12" style="text-align: center">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('میسیج بھیجے'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">

    var maxLength = 300;
    $('#textareaChars').keyup(function () {
        var length = $(this).val().length;
        var length = maxLength - length;
        $('#chars').text(length);
    });


    $(function () {

        $("#messageType").on("change", function () {
            var messageType = $(this).val();

            $("#teacher_list").hide();
            $("#general_list").hide();
            $("#class_list").hide();
            $("#class_wise_message").hide();

            jQuery('#student_list').html('');
            if (messageType == 'class_wise') {
                $("#class_wise_message").show();
            } else if (messageType == 'all_teacher') {
                $("#class_wise_message").hide();
                $("#student_list").hide();
                get_teachers();

            }

        });
    });

    function select2() {
        var chk = $('.class_check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = true;
        }
    }
    function unselect2() {
        var chk = $('.class_check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = false;
        }
    }


    function select() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = true;
        }

        //alert('asasas');
    }
    function unselect() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = false;
        }
    }



    function get_teachers() {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?message/get_branch_teachers/',
            success: function (response)
            {
                $('#teacher_list').show();
                jQuery('#teacher_list').html(response);
            }
        });
    }



</script>
<script type="text/javascript">
    function get_class_students(teacher_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?message/get_class_students_mass/' + teacher_id,
            success: function (response)
            {
                $("#student_list").show();
                jQuery('#student_list').html(response);
            }
        });

    }
</script>
