<form method="post" action="">
    <div class="row">
        <div class="col-sm-3 col-sm-offset-1">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('hostel'); ?></label>
                <select name="hostel_id" class="form-control "  onchange="get_hostel_floor(this.value)">
                    <option value=""><?php echo get_phrase('select_hostel'); ?></option>
                    <?php
                    foreach ($hostels as $hostel) {
                        ?>
                        <option value="<?php echo $hostel->id ?>"><?= $hostel->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 ">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?= 'ہاسٹل فلور'; ?></label>
                <select name="floor_id" class="form-control " id="hostel_floor">
                    <option value=""><?php echo get_phrase('select_hostel_first'); ?></option>
                </select>
            </div>
        </div>
        <div class="col-sm-3 ">
            <div class="form-group">
                <button class="btn btn-success" type="submit" style="margin-top: 20px;"><?= 'رپورٹ بناے' ?></button>
            </div>
        </div>
    </div>
</form>
<?php if (!empty($hostel_id) && empty($floor_id)) { ?>
<div class="row">
    <div class="col-md-12">
        <?php include 'total_hostel_report.php';?>
    </div>
</div>
<?php } ?>
<?php if (!empty($hostel_id) && !empty($floor_id)) { ?>
<div class="row">
    <div class="col-md-12">
        <?php include 'total_floor_report.php';?>
    </div>
</div>
<?php } ?>
<script type="text/javascript">

    function get_hostel_floor(hostel_id) {

        if (hostel_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?hostel/get_hostel_floor/' + hostel_id,
                success: function (response)
                {

                    jQuery('#hostel_floor').html(response);
                }
            });
        }
    }
</script>