<form action="<?= base_url('index.php?admin/student_pics_report_print') ?>" method="post" target="blank">
    <div class="row">
        <div class="col-sm-3 col-sm-offset-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select name="teacher" class="form-control "  onchange="get_class_students(this.value)">
                    <option value="" selected=""><?php echo get_phrase('select'); ?></option>
                    <option value="all" ><?php echo get_phrase('select_all'); ?></option>
                    <?php
                    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();

                    foreach ($teachers as $row):
                        ?>

                        <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="branch_id" id="branch_id" value="<?= $branch_id ?>"> 
            </div>
        </div>
    </div>
    <div class="row" id="report" style="display: none">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
                    <div id="student_list">

                    </div>
                </div> 
            </div> 

        </div>
        <div class="col-md-12">
            <center>
                <button type="submit" class="btn btn-success">
                    <?= get_phrase('submit') ?>
                </button>
            </center>

        </div>

    </div>
</form>

<script>
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


    function get_class_students(value) {
        var branch_id = document.getElementById("branch_id").value;
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_students/' + branch_id + '/' + value,
            success: function (response)
            {
                $('#report').show();
                jQuery('#student_list').html(response);
            }
        });

    }
</script>