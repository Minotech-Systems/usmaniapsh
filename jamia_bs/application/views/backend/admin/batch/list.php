<?php
$this->db->order_by('department_id', 'ASC');
$batches = $this->db->get('batch')->result_array();
if (count($batches) > 0):
    ?>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead>
            <tr style="background-color: #313a46; color: #ababab;">
                <th>#</th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('numeric_name'); ?></th>
                <th><?php echo get_phrase('department'); ?></th>
                <th><?php echo get_phrase('start_year'); ?></th>
                <th><?php echo get_phrase('end_year'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($batches as $batch):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?php echo $batch['name']; ?></td>
                    <td><?php echo $batch['numeric_name']; ?></td>
                    <td>
                        <?php
                        $where = array();
                        $where['id'] = $batch['department_id'];
                        echo table_column('departments', $where, 'name');
                        ?>
                    </td>
                    <td><?php echo $batch['start_year']; ?></td>
                    <td><?php echo $batch['end_year']; ?></td>
                    <td>
                        <div class="dropdown text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/batch/edit/' . $batch['batch_id']) ?>', '<?php echo get_phrase('update_batch'); ?>');"><?php echo get_phrase('edit'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('batch/delete/' . $batch['batch_id']); ?>', showAllBatches)"><?php echo get_phrase('delete'); ?></a>
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
