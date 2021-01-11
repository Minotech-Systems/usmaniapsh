<?php
$this->db->order_by('batch_id', 'ASC');
$semesters = $this->db->get('semester')->result_array();
if (count($semesters) > 0):
    ?>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead>
            <tr style="background-color: #313a46; color: #ababab;">
                <th>#</th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('batch'); ?></th>
                <th><?php echo get_phrase('department'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($semesters as $semester):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?php echo $semester['name']; ?></td>
                    <td><?php
                        $where1 = array();
                        $where1['batch_id'] = $semester['batch_id'];
                        echo table_column('batch', $where1, 'name');
                        ?>
                    </td>
                    <td>
                        <?php
                        $where = array();
                        $where['id'] = $semester['department_id'];
                        echo table_column('departments', $where, 'name');
                        ?>
                    </td>
                    <td>
                        <div class="dropdown text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/semester/edit/' . $semester['id']) ?>', '<?php echo get_phrase('update_semester'); ?>');"><?php echo get_phrase('edit'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('semester/delete/' . $semester['id']); ?>', showAllSemester)"><?php echo get_phrase('delete'); ?></a>
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
