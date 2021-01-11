<?php echo form_open(base_url() . 'index.php?message/send_combine_exam_sms', array('class' => 'form-wizard validate', 'id' => 'rootwizard-2', 'enctype' => 'multipart/form-data', 'target' => '_top'));
?>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <div class="">
                <select name="teacher_id" class="form-control" onchange="get_class_students(this.value)"  required="">
                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                    <?php
                    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result_array();

                    foreach ($teachers as $row):
                        ?>
                        <option value="<?php echo $row['teacher_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="">
                <select name="exam_id[]" class="form-control select2" multiple="" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    <?php
                    $exams = $this->db->get_where('exam', array('status' =>1))->result_array();
                    foreach ($exams as $row):
                        ?>
                        <option value="<?php echo $row['exam_id']; ?>"
                                <?php if ($exam_id == $row['exam_id']) echo 'selected'; ?>>
                                    <?php echo $row['name']; ?>
                        </option>
                        <?php
                    endforeach;
                    ?>
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