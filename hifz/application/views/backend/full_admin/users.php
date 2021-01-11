<hr />
<script src="assets/js/urdutextbox.js"></script>
<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtname);
    }

</script>
<!----Province Start---->
<div class="row" style="margin: auto;">    
    <?php echo form_open(base_url() . 'index.php?full_admin/add_user/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
    ?>     
    <div class="col-md-4">                
        <div class="panel panel-primary" > 
            <div class="panel-heading">                    
                <div class="panel-title">  
                    <?php echo get_phrase('add_user'); ?>  
                </div>                
            </div>

            <div class="panel-body">
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="text" class="form-control" name="name" required="" id="txtname" required="">
                    </div>                  
                </div>
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('username'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="text" class="form-control" name="user_name" required="">
                    </div>                  
                </div>
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('password'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="password" class="form-control" name="password" id="password" required="">
                    </div>                  
                </div>
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('confirm_password'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="password" class="form-control" name="c_password" id="confirm_password" required="">
                        <div id='message' class="alert alert-danger" style="display: none"> پاسورڈ ایک جیسا نہیں ہے۔۔۔</div>
                    </div>                  
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('select_branch'); ?></label> 
                    <div class="col-sm-9">
                        <select name="branch_id" class="form-control" required="">
                            <option value=""><?php echo get_phrase('select_branch'); ?></option>
                            <?php
                            $branches = $this->crud_model->get_table_data('branches');
                            foreach ($branches as $branch):
                                ?>
                                <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> 
                </div>

                <div class="form-group">                    
                    <div class="col-sm-offset-3 col-sm-9">                        
                        <button type="submit" id="submit" class="btn btn-info" disabled=""><?php echo get_phrase('add_district'); ?></button>                   
                    </div>                 
                </div>                    
                <?php echo form_close(); ?>                                   
            </div>  

        </div>

    </div>

    <div class="col-md-6"> 
        <div class="panel panel-primary" > 
            <div class="panel-heading">                    
                <div class="panel-title">  
                    <?php echo get_phrase('users_details'); ?>  
                </div>                
            </div> 
            <div class="panel-body">                                     
                <table class="table table-bordered datatable" id="table_export1"> 
                    <thead>       
                        <tr> 
                            <th width="100px"><?php echo get_phrase('serial_no') ?></th> 
                            <th><?php echo get_phrase('name'); ?></th>
                            <th><?php echo get_phrase('branch'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>   
                    </thead>     
                    <tbody>
                        <?php
                        $users = $this->fulladmin_model->admin_table_data();
                        $no = 1;
                        foreach ($users as $data1) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data1->name; ?></td>
                                <td><?php echo $this->db->get_where('branches', array('branch_id' => $data1->branch_id))->row()->name; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">   
                                            Action <span class="caret"></span>   
                                        </button>                                
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">    
                                            <!-- EDITING LINK -->        
                                            <li>                                 
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_district_edit/<?php echo $data1->admin_id; ?>');">        
                                                    <i class="entypo-pencil"></i>  
                                                    <?php echo get_phrase('edit'); ?>    
                                                </a>                                      
                                            </li>
                                            <!-- DELETION LINK -->     
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/districts/delete/<?php echo $data1->admin_id; ?>');">   
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
<?= form_close()?>
<!----Province End---->



<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() && $('#confirm_password').val()) {
            if ($('#password').val() == $('#confirm_password').val()) {
                $("#message").hide('slow');
                 $('#submit').removeAttr("disabled");
            } else
                $("#message").show('slow');
                
        }
    });

</script>