<style>
    input[type="checkbox"]{margin-left: 10px;}
</style>
<div class="row">
    <form method="post" target="_blank" action="<?= base_url('index.php?admin/student_detail_view/create') ?>">
        <div class="col-md-2 col-sm-2 col-md-offset-2">
            <div class="form-group">
                <label class="control-label" ><?php echo get_phrase('teacher'); ?></label>
                <select name="teacher_id" class="form-control" dir="rtl" >
                    <option value="all"><?= get_phrase('all_students') ?></option>
                    <?php
                    $teachers = $this->crud_model->get_table_data_where('teacher', array('status' => 1));
                    foreach ($teachers as $tech):
                        ?>
                        <option value="<?php echo $tech->teacher_id; ?>"><?php echo $tech->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <td><label><input type="checkbox" name="check_list[name]" value="name" > نام</label></td> 
                    <td><label><input type="checkbox" name="check_list[father]" value="father">ولدیت</label></td>
                </tr>
                <tr>
                    <td><label><input type="checkbox" name="check_list[dob]" value="dob">تاریخ پیدایش </label></td>
                    <td><label><input type="checkbox" name="check_list[roll]" value="roll" > کلاس نمبر</label></td> 
                </tr>
                <tr>
                    <td><label><input type="checkbox" name="check_list[admission_date]" value="admission_date" >تاریخ اجرا</label></td>
                    <td><label><input type="checkbox" name="check_list[phone]" value="phone" >موبائل نمبر</label></td> 
                </tr>    
                <tr>
                    <td><label><input type="checkbox" name="check_list[c_address]" value="c_address" > موجودہ پتہ </label></td>
                    <td><label><input type="checkbox" name="check_list[p_address]" value="p_address" > مستقل پتہ </label></td>
                </tr>    
                <tr>
                    <td><label><input type="checkbox" name="check_list[reg_no]" value="reg_no" >رجسٹریشن نمبر</label></td>
                    <td><label><input type="checkbox" name="check_list[test_marks]" value="test_marks" ><?= get_phrase('test_marks')?></label></td> 
                </tr>
                <tr>
                    <td><label><input type="checkbox" name="check_list[father_nic]" value="father_nic" ><?php echo get_phrase('father_nic'); ?></label></td>
                    <td><label><input type="checkbox" name="check_list[dist]" value="dist" ><?php echo get_phrase('district'); ?></label></td>
                </tr>
                <tr>
                    <td><label><input type="checkbox" name="check_list[prov]" value="prov" ><?php echo get_phrase('province'); ?></label></td>
                    <td><label><input type="checkbox" name="check_list[parent_login]" value="parent_login" ><?php echo 'والیدین لاگن نمبر' ?></label></td>
                </tr>
            </table>

        </div>
        <div class="col-md-3 col-sm-3 ">
            <div class="form-group">
                <button class="btn btn-success" style="margin-top: 20px;"><?= get_phrase('submit') ?></button>
            </div>
        </div>
    </form>
</div>