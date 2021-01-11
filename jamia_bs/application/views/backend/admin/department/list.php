<?php
$departments = $this->db->get('departments')->result_array();
if (count($departments) > 0):
    ?>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead>
            <tr style="background-color: #313a46; color: #ababab;">
                <th>#</th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('comment'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($departments as $department):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?php echo $department['name']; ?></td>
                    <td><?php echo $department['comment']; ?></td>
                    <td>
                        <div class="dropdown text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/department/edit/' . $department['id']) ?>', '<?php echo get_phrase('update_department'); ?>');"><?php echo get_phrase('edit'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('department/delete/' . $department['id']); ?>', showAllDepartments)"><?php echo get_phrase('delete'); ?></a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <?php include APPPATH . 'views/backend/empty.php'; ?>
<?php endif; ?>
