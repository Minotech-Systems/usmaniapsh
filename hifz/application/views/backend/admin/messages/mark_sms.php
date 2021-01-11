<?php echo form_open(base_url() . 'index.php?message/send_marks_sms', array('class' => 'form-wizard validate', 'id' => 'rootwizard-2', 'enctype' => 'multipart/form-data', 'target' => '_top'));
?>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <div class="">
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

        <div class="form-group">
            <div class="">
                <select name="exam_id" class="form-control " data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    <option value=""><?php echo get_phrase('select_exam'); ?></option>
                    <?php
                    $exams = $this->db->get('exam')->result_array();
                    foreach ($exams as $row1):
                        ?>
                        <option value="<?php echo $row1['exam_id']; ?>"><?php echo $row1['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <!---Display the Ajax Response here--->
    <div class="col-sm-8" id="student_list" >

    </div>
</div>
<div class="row">
    <center>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info" style="padding-left: 25px; padding-right: 25px;"><?php echo get_phrase('submit'); ?>
                </button>
            </div>
        </div>
    </center>
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
            } else if (messageType == 'specific_student') {
                $("#class_list").show();
            } else if (messageType == 'specific_teacher') {
                $("#teacher_list").show();
            } else if (messageType == 'specific_directory') {
                $("#general_list").show();
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

    function select_section(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admission/get_class_section/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder').html(response);
                }
            });
        }
    }

</script>

<script type="text/javascript">
    function get_class_students(teacher_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?message/get_class_students_mass/' + teacher_id ,
            success: function (response)
            {
                jQuery('#student_list').html(response);
            }
        });

    }
</script>