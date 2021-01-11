<div class="row">
    <div class="col-md-12">
        <table width="90%" border="1" align="center" style="text-align: center; ">
            <tr style="font-size: 14px;height: 36px;background: #525050; color: white;">
                <td>#</td>
                <td><?= get_phrase('name') ?></td>
                <td><?= get_phrase('parent') ?></td>
                <td><?= get_phrase('reg_no') ?></td>
                <td><?= get_phrase('edit') ?></td>
            </tr>
            <?php
            $no = 1;
            foreach ($students as $data) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data->name ?></td>
                    <td><?= $data->father_name ?></td>
                    <td width="10%">
                        <input type="number" id="reg_no_<?= $data->student_id ?>" value="<?= $data->reg_no ?>" class="form-control" dir="ltr">
                    </td>
                    <td width="22%">
                        <a class="btn btn-success" onclick="change_reg_no(<?= $data->student_id ?>)" id="btn_change_<?= $data->student_id?>"><?= get_phrase('change') ?></a>
                        <img src="<?= base_url('uploads/loading_gif.gif') ?>" width="30" style="display: none" id="loading_<?= $data->student_id?>"/>
                        <div class="alert alert-success" id="success_msg_<?= $data->student_id?>" style="display: inline; display: none" ><?= 'رجسٹریشن نمبر کو کامیابی سے تبدیل کر دیا گیا' ?></div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script>
    function change_reg_no(student_id) {
        var reg_no = document.getElementById("reg_no_" + student_id).value;
        $("#btn_change_"+student_id).hide('slow');
        $("#loading_"+student_id).show('slow');
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/change_student_reg_no/' + student_id + '/' + reg_no,
            success: function (response)
            {
                if (response == 'no') {
                    $("#btn_change_"+student_id).show('slow');
                    $("#loading_"+student_id).hide('slow');
                    alert('This Registration No is already there...');
                }
                 else {
                    $("#loading_"+student_id).hide('slow');
                    $('#success_msg_'+student_id).show();
                    setTimeout(function () {
                        $('#success_msg_'+student_id).fadeOut();
                    }, 2000);
                    $("#btn_change_"+student_id).show('slow');
                }



                //jQuery('#section_holder').html(response);
            }
        });
    }
</script>