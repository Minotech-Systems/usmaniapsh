<?php
$edit_data = $this->db->get_where('hostel_students', array('id' => $param2))->row();
$year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
<div class="row">
    <div class="col-md-12">
        <center>
            <form action="<?= base_url('index.php?hostel/add_room_pro_leader') ?>" method="post">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td align="center" colspan="2"><h3><?= $this->hostel_model->get_hostel_name($edit_data->hostel_id) ?></h3></td>
                        </tr>
                        <tr>
                            <td align="center"><?= 'فلور' . ' : ' . $this->hostel_model->get_hostel_floor($edit_data->floor_id) ?></td>
                            <td align="center"><?= 'روم نمبر' . ' : ' . $this->hostel_model->get_room($edit_data->room_id) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <div class="form-group">
                                        <label class="control-label" style="margin-bottom: 5px;"><?= 'منتخب معاون' ?></label>
                                        <select name="proleader_id" class="form-control ">
                                            <option value=""><?php echo 'معاون منتخب کریں'; ?></option>
                                            <?php
                                            $students = $this->db->get_where('hostel_students', array('hostel_id' => $edit_data->hostel_id,
                                                        'floor_id' => $edit_data->floor_id,
                                                        'room_id' => $edit_data->room_id,
                                                        'year' => $year))->result();
                                            foreach ($students as $std_data) {
                                                $name = $this->db->get_where('student', array('student_id' => $std_data->student_id))->row()->name;
                                                ?>
                                                <option value="<?= $std_data->id; ?>" <?php if ($std_data->pro_leader == 1) echo 'selected'; ?>><?= $name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><?= 'امیر داخل کریں' ?></button> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </form>
        </center>
    </div>
</div>