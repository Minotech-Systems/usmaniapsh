<style>
    li{text-align: right;}
</style>
<hr />

<div class="row">            

    <div class="col-sm-6 col-sm-offset-3  col-md-4 col-md-offset-4 col-xs-12 col-xs-offset-0 alert bg-primary ">       

        <div class="form-group">               

            <label class="col-xs-5 control-label"><?php echo get_phrase('select_class'); ?></label>  

            <div class="col-xs-7">                   
                <select name="class_id" class="form-control selectboxit"  onchange="goToURL(this.value)" id = "class_selection">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php
                    if ($login_user_level == 0) {
                        $classes = $this->db->get('class')->result_array();
                    } else {
                        $classes = $this->db->get_where('class', array('branch_id' => $login_user_branch))->result_array();
                    }

                    foreach ($classes as $row):
                        $branch_name = $this->db->get_where('branches', array('branch_id' => $row['branch_id']))->row()->name;
                        ?>

                        <option value="<?php echo $row['class_id']; ?>"
                                ><?php echo $row['name'] . '/' . $branch_name; ?></option>

                    <?php endforeach; ?>
                </select>
            </div>                
        </div>            
    </div>        
</div> 


<div class="row">        
    <div class="col-md-12">        
        <!--        ----CONTROL TABS START----     -->

        <ul class="nav nav-tabs bordered">         

            <li class="active">                
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>        


                    <?php echo get_phrase('subject_list'); ?>             
                </a>
            </li>            
            <li>     
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>          
                    <?php echo get_phrase('add_subject'); ?>              
                </a>
            </li>      
        </ul>       
<!--        ----CONTROL TABS END----   -->

        <div class="tab-content">          

            <br>                        
<!--            --TABLE LISTING STARTS     -->

            <div class="tab-pane box active" id="list">              

                <table class="table table-bordered datatable" id="table_export">           

                    <thead>                        
                        <tr>                            
                            <th><div><?php echo get_phrase('class'); ?></div></th>                            
                            <th><div><?php echo get_phrase('book_name'); ?></div></th>                            
                            <th><div><?php echo get_phrase('تفصیلی نام'); ?></div></th>                            
                            <th><div><?php echo get_phrase('options'); ?></div></th>                        
                        </tr>                    
                    </thead>                    
                    <tbody>                        
                        <?php
                        $count = 1;
                        foreach ($subjects as $row):
                            ?>                            
                            <tr>                                
                                <td><?php echo $this->crud_model->get_type_name_by_id('class', $row['class_id']); ?></td>
                                <td><?php echo $row['name']; ?></td>                                
                                <td><?php echo $row['description']; ?></td>
                                <td>                                    
                                    <div class="btn-group">                                        
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">     
                                            <?php echo get_phrase('action');?> 
                                            <span class="caret"></span>                                        
                                        </button>                                        
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">       
<!--                                             EDITING LINK                                             -->
                                            <li>                                                
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/subject_edit_modal/<?php echo $row['subject_id']; ?>');">  
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit'); ?>                                                
                                                </a>                                            
                                            </li>                                           
                                            <li class="divider"></li>                                            
<!--                                             DELETION LINK                                             -->
                                            <li>                                               
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?classes/manage_subject/delete/<?php echo $row['subject_id']; ?>/<?php echo $class_id; ?>');"> 
                                                    <i class="entypo-trash"></i>   
                                                    <?php echo get_phrase('delete'); ?>                                               
                                                </a>                                            
                                            </li>                                       
                                        </ul>                                    
                                    </div>                               
                                </td>                            
                            </tr>
                        <?php endforeach; ?>                   
                    </tbody>                
                </table>            
            </div>            
<!--            --TABLE LISTING ENDS-            
            --CREATION FORM STARTS--            -->
            <div class="tab-pane box" id="add" style="padding: 5px">               
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?classes/manage_subject/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>                    
                    <div class="padded">                        
                        <div class="form-group">                            
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>                            
                            <div class="col-sm-5">                                
                                <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>                            
                            </div>                        
                        </div>
                        <div class="form-group">                            
                            <label class="col-sm-3 control-label"><?php echo get_phrase('تفصیلی نام'); ?></label>                            
                            <div class="col-sm-5">                                
                                <input type="text" class="form-control" name="description" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>                            
                            </div>                        
                        </div>                        
                        <div class="form-group">                            
                            <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>                            
                            <div class="col-sm-5">                                
                                <select name="class_id" class="form-control selectboxit" >
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                    <?php
                                    if ($login_user_level == 0) {
                                        $classes = $this->db->get('class')->result_array();
                                    } else {
                                        $classes = $this->db->get_where('class', array('branch_id' => $login_user_branch))->result_array();
                                    }

                                    foreach ($classes as $row):
                                        $branch_name = $this->db->get_where('branches', array('branch_id' => $row['branch_id']))->row()->name;
                                        ?>

                                        <option value="<?php echo $row['class_id']; ?>"
                                                ><?php echo $row['name'] . '/' . $branch_name; ?></option>

                                    <?php endforeach; ?>
                                </select>                            
                            </div>                        
                        </div>                        
                        <div class="form-group">                            
                            <label class="col-sm-3 control-label"><?php echo get_phrase('teacher'); ?></label>                            
                            <div class="col-sm-5">                                
                                <select name="teacher_id" class="form-control selectboxit" style="width:100%;">                                    
                                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>                                    
                                    <?php
                                    $teachers = $this->db->get('staff')->result_array();
                                    foreach ($teachers as $row):
                                        ?>                                        
                                        <option value="<?php echo $row['staff_id']; ?>"><?php echo $row['name']; ?></option> 
                                    <?php endforeach; ?>                                
                                </select>                            
                            </div>                        
                        </div>
                        <input type="hidden" value="<?php echo $login_user_branch;?>" name="branch_id">
                    </div>                    
                    <div class="form-group">                        
                        <div class="col-sm-offset-3 col-sm-5">                           
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_subject'); ?></button>  
                        </div>                   
                    </div>                   
                    <?php echo form_close(); ?>                             
                </div>                            
            </div>            
<!--            --CREATION FORM ENDS        -->
        </div>    
    </div>
</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS --                      -->
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var datatable = $("#table_export").dataTable();
        $(".dataTables_wrapper select").select2({minimumResultsForSearch: -1});
    });
    function goToURL(id) {
        location.href = "<?php echo base_url(); ?>index.php?classes/manage_subject/" + id;
    }


</script>
