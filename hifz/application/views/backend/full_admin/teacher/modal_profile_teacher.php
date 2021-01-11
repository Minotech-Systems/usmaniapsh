<?php  $edit_data = $this->db->get_where('teacher',array('teacher_id'=>$param2))->result();
foreach ($edit_data as $data){
   ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-12">
        <img class="img-circle" src="<?= $this->crud_model->get_image_url('teacher', $data->image); ?>" width="90">
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <table class="table responsive" width="90%" style="font-size: 13px; font-weight: bold; color: black;">
            <thead>
                <tr>
                    <th><?= get_phrase('name').' : '?></th>
                    <th><?= $data->name?></th>
                    <th><?= get_phrase('nic').' : '?></th>
                    <th><?= $data->nic?></th>
                </tr>
                <tr>
                    <th><?= get_phrase('current_address').' : '?></th>
                    <th  colspan="4"><?= $data->c_address?></th>
                </tr>
                <tr>
                    <th><?= get_phrase('permanent_address').' : '?></th>
                    <th colspan="4"><?= $data->p_address?></th>
                </tr>
                <tr>
                    <th><?= get_phrase('phone').' : '?></th>
                    <th><?= $data->phone?></th>
                    <th><?= get_phrase('joining_date').' : '?></th>
                    <th><?= date('d-m-Y', strtotime($data->joining_date));?></th>
                </tr>
                <tr>
                    <th><?= get_phrase('country').' : '?></th>
                    <th><?= $this->crud_model->get_column_name_by_id('country','country_id',$data->country_id);?></th>
                    <th><?= get_phrase('province').' : '?></th>
                    <th><?= $this->crud_model->get_column_name_by_id('province','prov_id',$data->prov_id);?></th>
                </tr>
                <tr>
                    <th><?= get_phrase('district').' : '?></th>
                    <th><?= $this->crud_model->get_column_name_by_id('district','dist_id',$data->dist_id);?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php }?>