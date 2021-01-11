<hr/>
<?php echo form_open(base_url() . 'index.php?newadmission/promote_old_students');?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-1">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control " onchange="select_teachers(this.value)" id="branch_id">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->db->get('branches')->result_array();

                foreach ($branches as $row):
                    ?>
                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
            <select class="form-control " name="teacher_id" id="teacher_holders">
                <option value=""><?php echo get_phrase('select_branch_first') ?></option>

            </select>
        </div>
    </div>
    

    <div class="col-md-2" style="margin-top: 20px;">
        <button  type="button" class="btn btn-info" onclick="get_student_to_promote('<?php echo $running_year; ?>')">
            <?php echo get_phrase('submit'); ?>
        </button>
    </div>

</div>
<div id="student_for_promotion_holder"></div>
<?php echo form_close();?>
<script type="text/javascript">


    function select_teachers(branch_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?newadmission/get_branch_teacher/' + branch_id,

            success: function (response)

            {
                jQuery('#teacher_holders').html(response);

            }});

    }
</script>

<script type="text/javascript">

    function get_student_to_promote(running_year)
    {
        branch_id = $("#branch_id").val();
        teacher_id = $("#teacher_holders").val();

        if (branch_id == "" || teacher_id == "" ) {
            toastr.error("<?php echo get_phrase('select_all_required_fields'); ?>")
            return false;
        }
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?newadmission/get_students_to_promote/' + branch_id + '/' + teacher_id + '/' + running_year,
            success: function (response)
            {
                jQuery('#student_for_promotion_holder').html(response);
            }
        });
        return false;
    }

</script>