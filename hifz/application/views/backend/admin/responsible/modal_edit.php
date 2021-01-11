<?php
$edit_data = $this->db->get_where('responsible', array('id' => $param2))->row();

$login_user_branch = $this->session->userdata('branch_id');
?>
<div class="tab-pane box" >
    <div class="row">
        <form class="form-horizontal form-groups-bordered validate" action="<?= base_url('index.php?admin/responsible/update') ?>" method="post">

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher') ?></label>
                <div class="col-sm-5">
                    <select name="teacher_id" class="form-control" >
                        <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                        <?php
                        $teachers = $this->db->get_where('teacher', array('branch_id' => $login_user_branch))->result_array();
                        foreach ($teachers as $teach) {
                            ?>
                            <option value="<?php echo $teach['teacher_id']; ?>" <?php if ($teach['teacher_id'] == $edit_data->teacher_id) echo 'selected'; ?>><?php echo $teach['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class') ?></label>
                <div class="col-sm-5">
                    <select name="class_id" class="form-control" >
                        <option value=""><?php echo get_phrase('select_class'); ?></option>
                        <?php
                        $classes = $this->db->get_where('class', array('branch_id' => $login_user_branch))->result_array();
                        foreach ($classes as $class) {
                            ?>
                            <option value="<?php echo $class['class_id']; ?>" <?php if ($class['class_id'] == $edit_data->class_id) echo 'selected'; ?>><?php echo $class['name']; ?></option>
                        <?php }; ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $param2 ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-success"><?= ' مسئول کی تصحح کریں' ?></button>
                </div>
            </div>
        </form>
    </div>
</div>