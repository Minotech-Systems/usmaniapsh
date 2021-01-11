<form method="post" action="<?= base_url('index.php?message/send_enrolled_sms') ?>">
    <div class="row">
        <div class="col-md-4 col-sm-4">

            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
                <select name="branch_id1" class="form-control "  onchange="get_class_students(this.value);">
                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                    <?php
                    $branches = $this->db->get('branches')->result_array();
                    foreach ($branches as $row):
                        ?>
                        <option value="<?php echo $row['branch_id']; ?>" dir="ltr"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?= 'پیغام' ?></label>
                <textarea class="form-control" name="message" rows="4" placeholder="پیغام لکھیں۔۔۔"  required=""></textarea>
            </div>

        </div>

        <div class="col-md-8 col-sm-8">
            <div id="student_list"></div>
            <center>
                <button type="submit" class="btn btn-success"><?= 'پیغام ارسال کریں' ?></button>
            </center>
        </div>
    </div>
</form>
<script type="text/javascript">
    function get_class_students(branch_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?newadmission/get_class_students_mass/' + branch_id,
            success: function (response)
            {
                jQuery('#student_list').html(response);
            }
        });

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