<div class="row justify-content-center">
    <div class="col-md-12">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
            <thead>
                <tr style="background-color: #313a46; color: #ababab;">
                    <th>#</th>
                    <th>Image</th>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>S/O</th>
                    <th>DOB</th>
                    <!--<th>Address</th>-->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;

                foreach ($student_data as $data) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img class="rounded-circle" width="50" height="50" src="<?php echo $data['image_url'] ?>">
                        </td>
                        <td><?= $data['reg_no'] ?></td>
                        <td><?= $data['student_name'] ?></td>
                        <td><?= $data['father_name'] ?></td>
                        <td><?= date('d/m/Y', strtotime($data['dob'])) ?></td>
                        <!--<td><?= $data['c_address'] ?></td>-->
                        <td>
                            <div class="dropdown text-center">
                                <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item"  onclick="largeModal('<?php echo site_url('modal/popup/student/profile/' . $data['student_id']) ?>')">Profile</a>
                                    <!-- item-->
                                    <a href="<?php echo route('student/edit/' . $data['student_id']); ?>" class="dropdown-item">Edit Profile</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    initDataTable('basic-datatable');
</script>
