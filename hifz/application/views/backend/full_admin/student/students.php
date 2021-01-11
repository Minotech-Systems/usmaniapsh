<br>
<style>
    li{text-align: right;}
</style>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control "  onchange="goToURL(this.value)">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->db->get('branches')->result_array();
                foreach ($branches as $row):
                    ?>
                    <option value="<?php echo $row['branch_id']; ?>" dir="ltr" ><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<?php if (!empty($branch_id)) {
   $students =  $this->crud_model->get_student_data($branch_id);?>
    <div class="row">    
        <div class="col-md-12">                        
            <ul class="nav nav-tabs bordered">             
                <li class="active">                        
                    <a href="#home" data-toggle="tab">     
                        <span class="visible-xs"><i class="entypo-users"></i></span> 
                        <span class="hidden-xs" dir="ltr"><?php echo $branch_name; ?></span> 
                    </a>                       
                </li>  
            </ul>  

            <div class="tab-content">      
                <div class="tab-pane active" id="home">   
                    <table class="table table-bordered datatable" id="table_export"> 
                        <thead>       
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('photo'); ?></th>
                                <th><?php echo get_phrase('name'); ?></th>
                                <th><?php echo get_phrase('parent'); ?></th>
                                <th><?php echo get_phrase('reg_no'); ?></th>
                                <th><?php echo get_phrase('dob'); ?></th>
                                <th><?php echo get_phrase('current_address'); ?></th>
                                <th><?php echo get_phrase('teacher'); ?></th>
                                <th><div><?php echo get_phrase('options'); ?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($students as $data) {
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><img class="img-circle" width="30" src="<?php echo $this->crud_model->get_image_url('student', $data->image); ?>"></td>
                                    <td><?= $data->name ?></td>
                                    <td><?= $data->father_name ?></td>
                                    <td><?= $data->reg_no ?></td>
                                    <td><?= date('d-m-Y', strtotime($data->dob)) ?></td>
                                    <td><?= $data->c_address ?></td>
                                    <td><?php
                                        if ($data->teacher_id != 0) {
                                            echo $this->crud_model->get_column_name_by_id('teacher', 'teacher_id', $data->teacher_id);
                                        }
                                        ?></td>
                                    <td>
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">


                                                <!-- STUDENT PROFILE LINK -->    
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/student/modal_student_profile/<?php echo $data->student_id; ?>');">       
                                                        <i class="entypo-user"></i>     
                                                        <?php echo get_phrase('profile'); ?>   
                                                    </a>  
                                                </li>
                                                <!-- STUDENT EDIT LINK -->    
                                                <li>  
                                                    <a href="<?php echo base_url(); ?>index.php?admin/edit_student/<?php echo $data->student_id ?>">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit'); ?>   
                                                    </a>  
                                                </li>
                                                <li class="divider"></li>
                                                <!-- STUDENT EDIT LINK -->    
                                                <li>  
                                                    <a onclick="confirm_modal('<?php echo base_url(); ?>index.php?admission/delete_student/<?php echo $data->student_id ?>');">       
                                                        <i class="entypo-trash"></i>     
                                                        <?php echo get_phrase('delete'); ?>   
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
    </div>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var datatable = $("#table_export").dataTable();
        $(".dataTables_wrapper select").select2({minimumResultsForSearch: -1});
    });

    function goToURL(id) {
        location.href = "<?php echo base_url(); ?>index.php?full_admin/students/" + id;
    }


</script>