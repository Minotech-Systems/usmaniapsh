<?php $edit_data = $this->db->get_where('new_other_fee', array('id' => $param2))->row(); ?>
<form method="post" action="<?= base_url('index.php?newadmission/update_other_fee') ?>" class="form-horizontal form-groups-bordered validate">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">    
                <label  class="col-sm-3 control-label"><?= 'نام' ?></label> 
                <div class="col-sm-9">  
                    <input type="text" class="form-control" name="name" placeholder="<?= 'نام' ?>" value="<?= $edit_data->name ?>">  
                </div>   
            </div> 
            <input type="hidden" value="<?= $param2 ?>" name="fee_id">
            <div class="form-group">    
                <label  class="col-sm-3 control-label"><?= 'رقم' ?></label> 
                <div class="col-sm-9">  
                    <input type="text" class="form-control" name="amount" placeholder="<?= 'رقم' ?>" value="<?= $edit_data->amount ?>">  
                </div>   
            </div> 
            <div class="form-group">    
                <label  class="col-sm-3 control-label"><?= 'شاخ' ?></label> 
                <div class="col-sm-9">  
                    <select name="branch_id" class="form-control ">    
                        <?php
                        $branches = $this->db->get('branches')->result();
                        foreach ($branches as $branch) {
                            ?>
                            <option value="<?= $branch->branch_id ?>" <?php if ($branch->branch_id == $edit_data->branch_id) echo 'selected'; ?>><?= $branch->name ?></option>
                        <?php } ?>
                    </select>
                </div>   
            </div> 
            <div class="form-group" style="text-align: center"> 
                <button type="submit" class="btn btn-default"><?= 'تصحح کریں' ?></button>
            </div>
        </div>
    </div>
</form>