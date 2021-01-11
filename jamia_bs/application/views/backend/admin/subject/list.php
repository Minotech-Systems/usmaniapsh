<?php
$check_data = $this->db->get_where('subject', array('status' => 1))->result_array();
if (count($check_data) > 0):
    ?>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead>
            <tr style="background-color: #313a46; color: #ababab;">
                <th>#</th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('code'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $subjects = $this->db->get_where('subject', array('status' => 1))->result_array();
            foreach ($subjects as $subject) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?php echo $subject['name']; ?></td>
                    <td><?php echo $subject['code']; ?></td>
                    <td>

                        <div class="dropdown text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/subject/edit/' . $subject['subject_id']) ?>', '<?php echo get_phrase('update_subject'); ?>');"><?php echo get_phrase('edit'); ?></a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('subject/delete/' . $subject['subject_id']); ?>', showAllSubjects)"><?php echo get_phrase('delete'); ?></a>
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


