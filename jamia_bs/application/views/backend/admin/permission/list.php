<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
    <thead>
        <tr style="background-color: #313a46; color: #ababab;">
            <th><?php echo get_phrase('teacher'); ?></th>
            <th><?php echo get_phrase('marks'); ?></th>
            <!-- <th><?php echo get_phrase('assignment'); ?></th> -->
            <th><?php echo get_phrase('attendance'); ?></th>
            <!-- <th><?php echo get_phrase('online_exam'); ?></th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $teachers = $this->db->get_where('teacher', array('status' => 1))->result_array();
        foreach ($teachers as $teacher) {
            $permission = $this->db->get_where('teacher_permissions', array('teacher_id' => $teacher['teacher_id'],
                        'department_id' => $department_id,
                        'batch_id' => $batch_id,
                        'semester_id' => $semester_id
                    ))->row_array();
            ?>
            <tr>
                <td><?php echo $this->db->get_where('users', array('id' => $teacher['user_id']))->row('name'); ?></td>
                <td>
                    <input type="checkbox" value="<?php echo $permission['marks']; ?>" id="<?php echo $teacher['teacher_id'] . '1'; ?>" data-switch="success" onchange="togglePermission(this.id, 'marks', '<?php echo $teacher['teacher_id']; ?>')" <?php if ($permission['marks'] == 1) echo 'checked'; ?>>
                    <label for="<?php echo $teacher['teacher_id'] . '1'; ?>" data-on-label="Yes" data-off-label="No">
                </td>
                <td>
                    <input type="checkbox" value="<?php echo $permission['attendance']; ?>" id="<?php echo $teacher['teacher_id'] . '3'; ?>" data-switch="success" onchange="togglePermission(this.id, 'attendance', '<?php echo $teacher['teacher_id']; ?>')" <?php if ($permission['attendance'] == 1) echo 'checked'; ?>>
                    <label for="<?php echo $teacher['teacher_id'] . '3'; ?>" data-on-label="Yes" data-off-label="No">
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<!-- <script type="text/javascript">
    initDataTable('basic-datatable');
</script> -->
