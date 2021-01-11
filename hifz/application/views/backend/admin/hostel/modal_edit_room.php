<?php
$branch_id = $this->session->userdata('login_user_branch');
if ($branch_id == 0) {
    $hostels = $this->db->get('hostel')->result();
} else {
    $hostels = $this->db->get_where('hostel', array('branch_id' => $branch_id))->result();
}

$edit_data = $this->db->get_where('hostel_room', array('id' => $param2))->result();
foreach ($edit_data as $row):
    $floor = $this->db->get_where('hostel_floor', array('id' => $row->floor_id))->row();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_room'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?hostel/room_update/' .$row->id, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('hostel'); ?></label>
                            <div class="col-sm-5">
                                <select name="hostel_id" class="form-control " onchange="get_hostel_floor1(this.value)">
                                    <?php foreach ($hostels as $hos) { ?>
                                        <option value="<?= $hos->id ?>" <?php if ($hos->id == $row->hostel_id) echo 'selected'; ?>><?= $hos->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('floor'); ?></label>
                            <div class="col-sm-5">
                                <select name="floor_id" class="form-control " id="hostel_floor1" required="">
                                    <option value="<?= $floor->id ?>"><?= $floor->floor_name ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo 'روم نمبر'; ?></label>
                            <div class="col-sm-5">
                                <input class="form-control" type="number" value="<?= $row->room_number ?>" name="room_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_room'); ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    endforeach;
    ?>

    <script type="text/javascript">

        function get_hostel_floor1(hostel_id) {

            if (hostel_id !== '') {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php?hostel/get_hostel_floor/' + hostel_id,
                    success: function (response)
                    {

                        jQuery('#hostel_floor1').html(response);
                    }
                });
            }
        }
    </script>





