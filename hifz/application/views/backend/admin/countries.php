<hr /> 
<!----Country Start---->
<div class="row" style="margin: auto;">    
    <?php echo form_open(base_url() . 'index.php?admin/countries/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
    ?>     
    <div class="col-md-4 col-md-offset-1">                
        <div class="panel panel-primary" > 
            <div class="panel-heading">                    
                <div class="panel-title">  
                    <?php echo get_phrase('add_country'); ?>  
                </div>                
            </div> 
            <div class="panel-body">                                     
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="text" class="form-control" name="country">
                    </div>                  
                </div>                                   
                <div class="form-group">                    
                    <div class="col-sm-offset-3 col-sm-9">                        
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('add_country'); ?></button>                   
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
                    <?php echo get_phrase('country_details'); ?>  
                </div>                
            </div> 
            <div class="panel-body">                                     
                <table class="table table-bordered datatable" id="table_export1"> 
                    <thead>       
                        <tr> 
                            <th width="100px"><?php echo get_phrase('serial_no');?></th> 
                            <th><?php echo get_phrase('name')?></th>
                            <th><?php echo get_phrase('action')?></th>
                        </tr>   
                    </thead>     
                    <tbody>
                        <?php
                        $count = $this->crud_model->get_table_data('country');
                        $no = 1;
                        foreach ($count as $data) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">   
                                            <?php echo get_phrase('action')?> <span class="caret"></span>   
                                        </button>                                
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">    
                                            <!-- EDITING LINK -->        
                                            <li>                                 
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_country_edit/<?php echo $data['country_id']; ?>');">        
                                                    <i class="entypo-pencil"></i>  
                                                        <?php echo get_phrase('edit'); ?>    
                                                </a>                                      
                                            </li>
                                            <!-- DELETION LINK -->     
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/countries/delete/<?php echo $data['country_id']; ?>');">   
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
<!----Country End---->
<hr>
<!----Province Start---->
<div class="row">    
    <?php echo form_open(base_url() . 'index.php?admin/provinces/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
    ?>     
    <div class="col-md-4 col-md-offset-1">                
        <div class="panel panel-primary" > 
            <div class="panel-heading">                    
                <div class="panel-title">  
                    <?php echo get_phrase('add_province'); ?>  
                </div>                
            </div> 
            <div class="panel-body">                                     
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('province'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="text" class="form-control" name="province">
                    </div>                  
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 
                    <div class="col-sm-9">
                        <select name="country_id" class="form-control select2">
                            <option value=""><?php echo get_phrase('select_country'); ?></option>
                            <?php
                            $country = $this->crud_model->get_table_data('country');
                            foreach ($country as $country):
                                ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div> 
                </div>
                <div class="form-group">                    
                    <div class="col-sm-offset-3 col-sm-9">                        
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('add_province'); ?></button>                   
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
                    <?php echo get_phrase('province_details'); ?>  
                </div>                
            </div> 
            <div class="panel-body">                                     
                <table class="table table-bordered datatable1" id="table_export"> 
                    <thead>       
                        <tr> 
                            <th width="100px"><?php echo get_phrase('serial_no');?></th> 
                            <th><?php echo get_phrase('name');?></th>
                            <th><?php echo get_phrase('country');?></th>
                            <th><?php echo get_phrase('action');?></th>
                        </tr>   
                    </thead>     
                    <tbody>
                        <?php
                        $prov = $this->crud_model->get_table_data('province');
                        $no = 1;
                        foreach ($prov as $data1) {
                            ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data1['name'] ?></td>
                                <td><?php echo $this->db->get_where('country', array('country_id' => $data1['country_id']))->row()->name; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">   
                                            <?php echo get_phrase('action');?> <span class="caret"></span>   
                                        </button>                                
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">    
                                            <!-- EDITING LINK -->        
                                            <li>                                 
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_province_edit/<?php echo $data1['prov_id']; ?>');">        
                                                    <i class="entypo-pencil"></i>  
                                                        <?php echo get_phrase('edit'); ?>    
                                                </a>                                      
                                            </li>
                                            <!-- DELETION LINK -->     
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/provinces/delete/<?php echo $data1['prov_id']; ?>');">   
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

