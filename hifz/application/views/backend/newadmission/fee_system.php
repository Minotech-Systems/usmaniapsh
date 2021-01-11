<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="5">
                        <a href="#" class="btn btn-default" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_add_otherfee/');">       
                            <?= 'نیاء شامل کریں' ?></a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#</td>
                    <td><?= 'نام' ?></td>
                    <td><?= 'شاخ' ?></td>
                    <td><?= 'رقم' ?></td>
                    <td><?= 'اختیارات' ?></td>
                </tr>
                <?php
                $this->db->order_by('branch_id');
                $fee_data = $this->db->get_where('new_other_fee', array('year' => $running_year))->result();
                $no = 1;
                foreach ($fee_data as $data) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->name ?></td>
                        <td dir="ltr" style="text-align: right"><?= $this->crud_model->get_branch_name($data->branch_id); ?></td>
                        <td><?= $data->amount; ?></td>
                        <td>
                            <div class="btn-group">      
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                    <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                </button>     
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDIT LINK -->    
                                    <li>  
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_other_fee/<?php echo $data->id; ?>');">       
                                            <i class="entypo-pencil"></i>     
                                            <?php echo get_phrase('edit'); ?>   
                                        </a>  
                                    </li>
                                    <li class="divider"></li>
                                    <!-- STUDENT DELETION -->    
                                    <li>  
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?newadmission/delete_other_fee/<?php echo $data->id ?>');" >       
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