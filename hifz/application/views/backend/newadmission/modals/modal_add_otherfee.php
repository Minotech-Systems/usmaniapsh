<form method="post" action="<?= base_url('index.php?newadmission/add_other_fee') ?>" class="form-horizontal form-groups-bordered validate">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">    
                <label  class="col-sm-3 control-label"><?= 'نام' ?></label> 
                <div class="col-sm-9">  
                    <input type="text" class="form-control" name="name" placeholder="<?= 'نام' ?>">  
                </div>   
            </div> 
            <div class="form-group">    
                <label  class="col-sm-3 control-label"><?= 'رقم' ?></label> 
                <div class="col-sm-9">  
                    <input type="text" class="form-control" name="amount" placeholder="<?= 'رقم' ?>">  
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
                            <option value="<?= $branch->branch_id ?>"><?= $branch->name ?></option>
                        <?php } ?>
                    </select>
                </div>   
            </div> 
            <div class="form-group" style="text-align: center"> 
                <button type="submit" class="btn btn-default"><?= 'شامل کریں' ?></button>
            </div>
        </div>
    </div>
</form>