<style>
    li{text-align: right}
</style>
<?php echo form_open(base_url() . 'index.php?newadmission/student_information/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('branch'); ?></label>
            <select name="branch_id" class="form-control "  onchange="this.form.submit()">
                <option value=""><?php echo get_phrase('select_branch'); ?></option>
                <?php
                $branches = $this->db->get('branches')->result_array();
                foreach ($branches as $row):
                    ?>
                    <option value="<?php echo $row['branch_id']; ?>" dir="ltr"><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<?php if (!empty($branch)) { ?>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs bordered">             
                <li class="active">                        
                    <a href="#home" data-toggle="tab">     
                        <span class="visible-xs" dir="ltr"><?php echo $branch ?></span> 
                        <span class="hidden-xs" dir="ltr"><?php echo $branch ?></span> 
                    </a>                       
                </li>  
            </ul>
            <div class="tab-content">      
                <div class="tab-pane active" id="home"> 
                    <table class="table table-bordered datatable" id="table_export"> 
                        <thead>
                            <tr>
                                <td width="80"><?= get_phrase('serial_no') ?></td>
                                <td><?= get_phrase('image') ?></td>
                                <td><?= get_phrase('name') ?></td>
                                <td><?= get_phrase('parent') ?></td>
                                <td><?= get_phrase('reg_no') ?></td>
                                <td><?= get_phrase('current_address') ?></td>
                                <td><?= get_phrase('fee'); ?></td>
                                <td><?= 'پرنٹ فارم' ?></td>
                                <td><?= get_phrase('action') ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($students as $data) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?php echo $this->crud_model->get_image_url('new_admission', $data->image); ?>" class="img-circle" width="30" /></td>
                                    <td><?= $data->name ?></td>
                                    <td><?= $data->father_name ?></td>
                                    <td><?= $data->reg_no ?></td>
                                    <td><?= $data->c_address; ?></td>
                                    <td><?= $this->newadmission_model->get_student_transaction_sum($data->student_id, $running_year); ?></td>
                                    <td>
                                        <a href="<?= base_url('index.php?newadmission/print_admission_from') . '/' . $data->student_id ?>" target="_blank">
                                            <i class="fa fa-print"></i>
                                            <?= 'پرنٹ فارم' ?>
                                        </a>
                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <a target="blank" href="<?= base_url('index.php?newadmission/print_reg_form') . '/' . $data->student_id ?>"><i class="fa fa-print"></i><?= 'داخلہ فارم' ?></a>
                                    </td>
                                    <td>
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                <!-- STUDENT PROFILE LINK -->    
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_student_profile/<?php echo $data->student_id; ?>');">       
                                                        <i class="entypo-user"></i>     
                                                        <?php echo get_phrase('profile'); ?>   
                                                    </a>  
                                                </li>
                                                <!-- STUDENT EDIT PROFILE LINK -->    
                                                <li>  
                                                    <a href="<?= base_url('index.php?newadmission/edit_student_profile') . '/' ?><?= $data->student_id ?>"  target="blank">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit_profile'); ?>   
                                                    </a>  
                                                </li>
                                                <!-- STUDENT IMAGE LINK -->    
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_student_image/<?php echo $data->student_id; ?>');">       
                                                        <i class="fa fa-picture-o"></i>     
                                                        <?php echo get_phrase('profile_image'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="<?= base_url('index.php?newadmission/student_fee/' . $data->student_id) ?>" >       
                                                        <i class="fa fa-money"></i>     
                                                        <?php echo 'طلبہ فیس' ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_add_student_otherfee/<?php echo $data->student_id; ?>');">        
                                                        <i class="fa fa-money"></i>     
                                                        <?php echo 'داخلہ اضافی فیس' ?>   
                                                    </a>  
                                                </li>
                                                <li class="divider"></li>
                                                <!-- STUDENT DELETION -->    
                                                <li>  
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?newadmission/delete_student/<?php echo $data->student_id ?>');" >       
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



    jQuery(document).ready(function ($)

    {
        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 3, 4, 6, 7, 8, 9]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 3, 4, 6, 7, 8, 9]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(2, false);
                            datatable.fnSetColumnVis(5, false);
                            datatable.fnSetColumnVis(11, false);
                            this.fnPrint(true, oConfig);
                            window.print();
                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(0, true);

                                    datatable.fnSetColumnVis(10, true);
                                }
                            });
                        },
                    },
                ]},
        });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>
