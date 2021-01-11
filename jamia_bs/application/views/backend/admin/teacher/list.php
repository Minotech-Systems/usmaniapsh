<?php
$check_data = $this->db->get_where('teacher', array('status' => 1));
if ($check_data->num_rows() > 0):
    ?>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead>
            <tr style="background-color: #313a46; color: #ababab;">
                <th><?php echo get_phrase('image'); ?></th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('phone'); ?></th>
                <th><?php echo get_phrase('designation'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $teachers = $this->db->get_where('teacher', array('status' => 1))->result_array();
            foreach ($teachers as $teacher) {
                ?>
                <tr>
                    <td><img class="rounded-circle" width="50" height="50" src="<?php echo $this->user_model->get_user_image($teacher['user_id']); ?>"></td>
                    <td><?= $teacher['name'] ?></td>
                    <td><?php echo $teacher['phone'] ?></td>
                    <td><?php echo $teacher['designation']; ?></td>
                    <td>
                        <div class="dropdown text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/teacher/permission_overview/' . $teacher['teacher_id'] )?>', '<?php echo get_phrase('assigned_permissions'); ?>')"><?php echo get_phrase('permissions'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/teacher/edit/' . $teacher['teacher_id']); ?>', '<?php echo get_phrase('update_teacher'); ?>')"><?php echo get_phrase('edit'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('teacher/delete/' . $teacher['teacher_id']); ?>', showAllTeachers)"><?php echo get_phrase('delete'); ?></a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php else: ?>
    <?php include APPPATH . 'views/backend/empty.php'; ?>
<?php endif; ?>
