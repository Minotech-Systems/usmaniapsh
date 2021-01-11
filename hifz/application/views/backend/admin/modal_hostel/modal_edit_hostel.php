<?php
$hostel_data = $this->db->get_where('hostel', array('id' => $param2))->result();
foreach ($hostel_data as $data) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <center>
                <h3><?= $data->name ?></h3>
                <form id="add_hostel" method="post" action="<?= base_url('index.php?hostel/update_hostel/' . $param2) ?>">
                    <div class="form-group">                    
                        <label for="field-2" class="col-sm-4 control-label"><?php echo 'ہاسٹل کا نام'; ?></label>                    
                        <div class="col-sm-6">                        
                            <input type="text" name="name" class="form-control" required="" value="<?= $data->name ?>">                   
                        </div>                
                    </div>
                    <div class="form-group" >                                        
                        <div class="col-sm-12">                        
                            <button type="submit" class="btn btn-success" style="margin-top: 10px;"> <?= 'تصیحح ہاسٹل' ?></button>                   
                        </div>                
                    </div>
                </form>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <center>
                <table class="table table-striped">
                    <thead>
                        <tr><td colspan="3"><?= $data->name .' '. 'کے تمام فلورز ' ?></td></tr>
                        <tr>
                            <th>#</th>
                            <th><?= 'فلور نمبر' ?></th>
                            <th><?= 'فلور کانام' ?></th>
                            <th><?= 'ختم کرنا' ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $f =1;
                        $floors = $this->db->get_where('hostel_floor', array('hostel_id' => $param2))->result();
                        foreach ($floors as $floor) {
                            ?>
                            <tr>
                                <td><?= $f++?></td>
                                <td><?= $floor->floor_number?></td>
                                <td><?= $floor->floor_name?></td>
                                <td>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?hostel/delete_hostel_floor/<?= $floor->id ?>');">
                                        <i class="entypo-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
    <?php
}?>