<style>
    li{ text-align: right;}
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter{ background: white;}
</style>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-body" style="padding-top: 0px;">
                <div class="row">
                    <form id="add_hostel" method="post" action="<?= base_url('index.php?hostel/add_hostel') ?>">
                        <div class="form-group">                    
                            <label for="field-2" class="col-sm-3 control-label"><?php echo 'ہاسٹل کا نام'; ?></label>                    
                            <div class="col-sm-8">                        
                                <input type="text" name="hostel_name" class="form-control" placeholder="<?= 'ہاسٹل کا نام لکھیں۔۔۔' ?>">                   
                            </div>                
                        </div>
                        <div class="form-group">                   
                            <div class="col-sm-12">
                                <center>
                                    <button class="btn btn-success"  style="margin-top: 10px;"><?= ' ہاسٹل کا نام داخل کریں' ?></button>
                                </center>                  
                            </div>                
                        </div>
                    </form>
                </div>
                <hr>
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= 'نام' ?></th>
                                <th><?= 'فلورز' ?></th>
                                <th><?= 'کاروائی' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($hostels as $hostel) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $hostel->name ?></td>
                                    <td><?= $this->db->where(array('hostel_id' => $hostel->id))->from("hostel_floor")->count_all_results(); ?></td>
                                    <td>
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_hostel/modal_edit_hostel/<?= $hostel->id ?>');">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit'); ?>   
                                                    </a>  
                                                </li>   
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_hostel/modal_add_floor/<?= $hostel->id ?>');">       
                                                        <i class="fa fa-home"></i>     
                                                        <?php echo get_phrase('add_floor'); ?>   
                                                    </a>  
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!--.-->

    </div>

    <div class="col-md-7 col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-body" style="padding-top: 0px;">
                <?php echo form_open(base_url() . 'index.php?hostel/add_hostel_room/'); ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('hostel'); ?></label>
                            <select name="hostel_id" class="form-control " onchange="get_hostel_floor(this.value)" >
                                <option value=""><?php echo get_phrase('select_hostel'); ?></option>
                                <?php
                                foreach ($hostels as $row) {
                                    ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?= 'ہاسٹل فلور'; ?></label>
                            <select name="floor_id" class="form-control " id="hostel_floor" required="">
                                <option value=""><?php echo 'پہلے ہاسٹل منتخب کریں'; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?= 'روم نمبر'; ?></label>
                            <input type="number" name="room" placeholder="روم نمبر کا اندراج کریں" class="form-control" required="">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" style="margin-top: 20px;"><?= 'فلور کا اندراج کریں' ?></button>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered datatable" id="table_export"> 
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= ' ہاسٹل' ?></th>
                                    <th><?= 'فلور نمبر' ?></th>
                                    <th><?= 'روم نمبر' ?></th>
                                    <th><?=  'اختیارات'?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($hostel_rooms as $room) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $this->hostel_model->get_hostel_name($room->hostel_id) ?></td>
                                        <td><?= $this->hostel_model->get_hostel_floor($room->floor_id) ?></td>
                                        <td><?= $room->room_number ?></td>
                                        <td>
                                            <a href="#" onclick="confirm_modal('<?= base_url(); ?>index.php?hostel/delete_room/<?= $room->id ;?>')" style="margin-left:20px">
                                                <i class="entypo-trash"></i>
                                            </a>
                                            <a href="#"onclick="showAjaxModal('<?= base_url(); ?>index.php?modal/popup/hostel/modal_edit_room/<?= $room->id  ?>');">       
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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