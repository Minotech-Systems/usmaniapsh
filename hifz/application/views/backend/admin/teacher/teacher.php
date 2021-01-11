<style>
    li{text-align: right;}
</style>
<hr>
<div class="row">
    <div class="col-sm-12 ">
        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/teacher/modal_add_teacher/');" 
           class="btn btn-primary pull-right">
            <i class="entypo-plus-circled"></i>
            <?php echo get_phrase('add_new_employee'); ?>
        </a>
    </div>

</div>
<br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>#</th>
            <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>
            <th><div><?php echo get_phrase('name'); ?></div></th>
            <th><?php echo get_phrase('phone'); ?></div></th>
            <th><div><?php echo get_phrase('current_address'); ?></div></th>
            <th><div><?php echo get_phrase('permanent_address'); ?></div></th>
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($teachers as $tech) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><img class="img-circle" width="30" src="<?= $this->crud_model->get_image_url('teacher', $tech->image); ?>"/></td>
                <td><?= $tech->name ?></td>
                <td><?= $tech->phone ?></td>
                <td><?= $tech->c_address ?></td>
                <td><?= $tech->p_address ?></td>
                <td>
                    <div class="btn-group">      
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                        </button>     
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                            <!-- STUDENT PROFILE LINK -->    
                            <li>  
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/teacher/modal_profile_teacher/<?php echo $tech->teacher_id; ?>');">       
                                    <i class="entypo-user"></i>     
                                        <?php echo get_phrase('profile'); ?>   
                                </a>  
                            </li>
                            <li>  
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/teacher/modal_edit_teacher/<?php echo $tech->teacher_id; ?>');">       
                                    <i class="entypo-pencil"></i>     
                                        <?php echo get_phrase('edit'); ?>   
                                </a>  
                            </li>
<!--                            <li>  
                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/teacher/delete/<?php echo $tech->teacher_id; ?>');">   
                                    <i class="entypo-trash"></i>     
                                        <?php echo get_phrase('delete'); ?>        
                                </a>  
                            </li>-->
                        </ul>
                    </div>
                </td>
            </tr>  
<?php } ?>
    </tbody>
</table>
