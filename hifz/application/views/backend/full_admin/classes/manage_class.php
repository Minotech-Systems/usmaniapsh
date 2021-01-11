
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group">               
            <div class="col-md-6">                   
                <select name="branch_id" class="form-control"  onchange=" goToURL(this.value); return false;">  4
                    <option value=""><?= get_phrase('select_branch') ?></option>                            
                    <?php $branches = $this->db->get('branches')->result();
                    foreach ($branches as $bran){
                        ?>         
                        <option value="<?php echo $bran->branch_id; ?>">             
                        <?php echo $bran->name; ?>                         
                        </option>                                
                    <?php } ?>                  
                </select> 
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">

            <!------CONTROL TABS START------>
            <ul class="nav nav-tabs bordered">
                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
<?php echo get_phrase('class_list'); ?>
                    </a></li>
                <li>
                    <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
<?php echo get_phrase('add_class'); ?>
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
                                <th><div><?php echo get_phrase('class_name'); ?></div></th>
                                <th><div><?php echo get_phrase('numeric_name'); ?></div></th>
                                <th><div><?php echo get_phrase('branch'); ?></div></th>
                                <th><div><?php echo get_phrase('options'); ?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($classes as $row):
                                ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->name_numeric; ?></td>
                                    <td><?php echo $this->db->get_where('branches', array('branch_id' => $row->branch_id))->row()->name; ?></td>

                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
    <?php echo get_phrase('action') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                <!-- EDITING LINK -->
                                                <li>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/classes/modal_edit_class/<?php echo $row->class_id; ?>');">
                                                        <i class="entypo-pencil"></i>
    <?php echo get_phrase('edit'); ?>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>

                                                <!-- DELETION LINK -->
                                                <li>
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?full_admin/manage_classes/delete/<?php echo $row->class_id; ?>');">
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
                <!----TABLE LISTING ENDS--->


                <!----CREATION FORM STARTS---->
                <div class="tab-pane box" id="add" style="padding: 5px">
                    <div class="box-content">
<?php echo form_open(base_url() . 'index.php?full_admin/manage_classes/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name_numeric'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name_numeric"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="branch_id">
                                        <option value="<?= $branch_id?>" selected=""><?= $branch_name?></option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class'); ?></button>
                            </div>
                        </div>
                        </form>                
                    </div>                
                </div>
                <!----CREATION FORM ENDS-->
            </div>
        </div>
    </div>



    <!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
    <script type="text/javascript">
        function goToURL(id) {
            location.href = "<?php echo base_url(); ?>index.php?full_admin/manage_classes/" + id;
        }
        jQuery(document).ready(function ($)
        {


            var datatable = $("#table_export").dataTable();

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });
        });

    </script>