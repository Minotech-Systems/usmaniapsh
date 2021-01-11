
<form action="<?= base_url() . 'index.php?student_fee/tamleek_paid_fee_record_print/' ?>" method="post" target="_blank">
    <div class="row">
        <div class="col-sm-2 col-sm-offset-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
                <select name="teacher_id" class="form-control "  onchange="select_section(this.value)" id = "class_selection">
                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                    <?php
                        $teachers = $this->db->get_where('teacher', array('branch_id' => $login_user_branch))->result_array();
                    
                    foreach ($teachers as $row):
                        ?>

                        <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']  ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                <select name="month" class="form-control "  id="month" dir="rtl">
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

        <div class="col-md-2" style="margin-top: 20px;">
            <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>
        </div>

    </div>
</form>
<script type="text/javascript">

    function select_section(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admission/get_sections/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder').html(response);
                }
            });
        }
    }
</script>