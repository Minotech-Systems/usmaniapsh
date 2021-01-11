<style>
    li{text-align:right;}
</style>
<?php
$sponsers = $this->db->get_where('students_sponsor', array('branch_id' => $branch_id))->result_array();
?>
<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('sponsor_list'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_sponsor'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('name'); ?></div></th>
                            <th><div><?php echo get_phrase('address'); ?></div></th>
                            <th><div><?php echo get_phrase('phone'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sponsers as $data) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['name'] ?></td>
                                <td><?php echo $data['address'] ?></td>
                                <td><?php echo $data['phone'] ?></td>
                                <td>    
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <!-- STUDENT PROFILE LINK -->    
                                            <li>  
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_sponsor_edit/<?php echo $data['sponsor_id']; ?>');">       
                                                    <i class="entypo-pencil"></i>     
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?student_fee/student_sponsor/delete/<?php echo $row['sponsor_id']; ?>');">   
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
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?student_fee/student_sponsor/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" dir="rtl"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="address" dir="rtl"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="phone" dir="ltr"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-5">
                                <select name="branch_id" class="form-control "  >
                                    <?php $branches = $this->db->get_where('branches', array('branch_id' => $branch_id))->row();?>
                                    <option value="<?php echo $branches->branch_id; ?>" selected=""><?php echo $branches->name; ?></option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_sponsor'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>