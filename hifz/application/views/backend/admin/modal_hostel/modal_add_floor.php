<?php
$hostel_data = $this->db->get_where('hostel', array('id' => $param2))->result();
foreach ($hostel_data as $data) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <center>
                <h3><?= $data->name ?></h3>
                <form id="add_hostel" method="post" action="<?= base_url('index.php?hostel/add_hostel_floor/'.$param2) ?>">
                    <div class="form-group">                    
                        <label for="field-2" class="col-sm-4 control-label"><?php echo 'فلور کے نام کا اندراج کریں'; ?></label>                    
                        <div class="col-sm-6">                        
                            <input type="number" name="floor_num" class="form-control" required="">                   
                        </div>                
                    </div>
                    <div class="form-group" >                    
                        <label for="field-2" class="col-sm-4 control-label" style="margin-top: 20px"><?php echo 'تحریری نام'; ?></label>                    
                        <div class="col-sm-6">                        
                            <input type="text" name="floor_name" class="form-control" required="" style="margin-top: 20px">                   
                        </div>                
                    </div>
                    
                    <div class="form-group" >                                        
                        <div class="col-sm-12">                        
                            <button type="submit" class="btn btn-success" style="margin-top: 10px;"> <?= 'فلور کا اندراج کریں'?></button>                   
                        </div>                
                    </div>
                </form>
            </center>
        </div>
    </div>
    <?php
}?>