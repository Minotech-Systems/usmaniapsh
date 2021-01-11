<?php
$this->db->order_by('department_id', 'ASC');
$sections = $this->db->get('section')->result_array();
if (count($sections) > 0):
    ?>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead>
            <tr style="background-color: #313a46; color: #ababab;">
                <th>#</th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('department'); ?></th>
                <th><?php echo get_phrase('batch'); ?></th>
                <th><?php echo get_phrase('semester'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($sections as $section):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?php echo $section['name']; ?></td>
                    <td>
                        <?php
                        $where = array();
                        $where['id'] = $section['department_id'];
                        echo table_column('departments', $where, 'name');
                        ?>
                    </td>
                    <td><?php
                        $where1 = array();
                        $where1['batch_id'] = $section['batch_id'];
                        echo table_column('batch', $where1, 'name');
                        ?>
                    </td>
                    <td><?php
                        $where1 = array();
                        $where1['id'] = $section['semester_id'];
                        echo table_column('semester', $where1, 'name');
                        ?>
                    </td>

                    <td>
                        <div class="dropdown text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/section/edit/' . $section['section_id']) ?>', '<?php echo get_phrase('update_section'); ?>');"><?php echo get_phrase('edit'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('section/delete/' . $section['section_id']); ?>', showAllSection)"><?php echo get_phrase('delete'); ?></a>
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
