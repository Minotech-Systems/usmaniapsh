<?php

$student_data = $this->admin_model->student_data('student', $param1);


foreach ($student_data as $data) {
    ?>
    <div class="h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-4 pb-2">
                <div class="text-center">
                    <img class="rounded-circle" width="100" height="100" src="<?php echo $data['image_url'] ?>">
                    <br>
                    <span style="font-weight: bold;">
                        Email : <?= $data['email'] ?>
                    </span>
                    <br>
                    <span style="font-weight: bold;">
                        <?php echo get_phrase('student_code'); ?>: <?php echo $data['student_code']; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo get_phrase('profile'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="parent-tab" data-toggle="tab" href="#parent_info" role="tab" aria-controls="parent_info" aria-selected="false"><?php echo get_phrase('parent_info'); ?></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-centered mb-0">
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold;">Name:</td>
                                    <td><?= $data['student_name'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Department:</td>
                                    <td>
                                        <?= $data['department_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Batch:</td>
                                    <td>
                                        <?= $data['batch_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Semester:</td>
                                    <td>
                                        <?= $data['semester_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Current Address:</td>
                                    <td>
                                        <?= $data['c_address'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Permanent Address:</td>
                                    <td><?= $data['p_address'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Phone:</td>
                                    <td><?= $data['student_phone'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Test Roll No:</td>
                                    <td><?= $data['test_rollno'] ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Test Marks:</td>
                                    <td><?= $data['test_marks'] ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="parent_info" role="tabpanel" aria-labelledby="parent-tab">
                        <table class="table table-centered mb-0">
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold;">Father Name:</td>
                                    <td>
                                        <?= $data['father_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;"><?php echo get_phrase('parent_email'); ?>:</td>
                                    <td>
                                        <?= $data['father_email'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;"><?php echo get_phrase('parent_phone_number'); ?>:</td>
                                    <td>
                                        <?= $data['father_phone'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
