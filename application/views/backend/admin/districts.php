<hr /> 
<!----Province Start---->
<div class="row" style="margin: auto;">    
    <?php echo form_open(base_url() . 'index.php?admin/districts/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
    ?>     
    <div class="col-md-4 col-md-offset-1">                
        <div class="panel panel-primary" > 
            <div class="panel-heading">                    
                <div class="panel-title">  
                    <?php echo get_phrase('add_district'); ?>  
                </div>                
            </div> 
            <div class="panel-body">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('select_country'); ?></label> 
                    <div class="col-sm-9">
                        <select name="country_id" class="form-control select2" required="" onchange="return get_province(this.value)">
                            <option value=""><?php echo get_phrase('select_country'); ?></option>
                            <?php
                            $country = $this->places_model->get_countries();
                            foreach ($country as $country):
                                ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> 
                </div>
                <div class="form-group">	
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_province'); ?></label>		                   
                    <div class="col-sm-9">		                       
                        <select name="province_id" class="form-control" id="prov_selector_holder" required="">		                            
                            <option value=""><?php echo get_phrase('select_country_first'); ?></option>			                        			                    
                        </select>			                
                    </div>					
                </div>
                <div class="form-group">                      
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('district_name'); ?></label>     
                    <div class="col-sm-9">                          
                        <input type="text" class="form-control" name="district" required="">
                    </div>                  
                </div>                                   
                <div class="form-group">                    
                    <div class="col-sm-offset-3 col-sm-9">                        
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('add_district'); ?></button>                   
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
                    <?php echo get_phrase('district_details'); ?>  
                </div>                
            </div> 
            <div class="panel-body">                                     
                <table class="table table-bordered datatable" id="table_export1"> 
                    <thead>       
                        <tr> 
                            <th width="100px"><?php echo get_phrase('serial_no')?></th> 
                            <th><?php echo get_phrase('district');?></th>
                            <th><?php echo get_phrase('province');?></th>
                            <th><?php echo get_phrase('action');?></th>
                        </tr>   
                    </thead>     
                    <tbody>
                        <?php
                        $district  = $this->places_model->get_districts();
                        $no = 1;
                        foreach ($district as $data1) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data1['name']; ?></td>
                                <td><?php echo $this->db->get_where('province', array('prov_id'=> $data1['prov_id'] ))->row()->name;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">   
                                            Action <span class="caret"></span>   
                                        </button>                                
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">    
                                            <!-- EDITING LINK -->        
                                            <li>                                 
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/places_modal/modal_district_edit/<?php echo $data1['dist_id']; ?>');">        
                                                    <i class="entypo-pencil"></i>  
                                                    <?php echo get_phrase('edit'); ?>    
                                                </a>                                      
                                            </li>
                                            <!-- DELETION LINK -->     
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/districts/delete/<?php echo $data1['dist_id'];  ?>');">   
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
<!----Province End---->



<script type="text/javascript">

    jQuery(document).ready(function ($)

    {
        var datatable = $("#table_export1").dataTable({
            "sPaginationType": "bootstrap",

        });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>

<script type="text/javascript">

    function get_province(country_id) {

        $.ajax({

            url: '<?php echo base_url(); ?>index.php?admin/get_province/' + country_id,

            success: function (response)

            {
                jQuery('#prov_selector_holder').html(response);

            }});

    }

</script>