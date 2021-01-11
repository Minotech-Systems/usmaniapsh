<style>
    li{text-align: right;}
</style>
<hr>
<div class="row">
    <div class="col-sm-12" style="text-align: left">
        <a class="btn btn-success" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_add_maad_type/')">
            <i class="fa fa-plus-square"></i>
            <?= get_phrase('add_expenses_mad') ?>
        </a>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">                        
        <ul class="nav nav-tabs bordered">             
            <li class="active">                        
                <a href="#home" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo $system_name?></span> 
                </a>                       
            </li>  

        </ul>  

        <div class="tab-content">      
            <div class="tab-pane active" id="home">   
                <table class="table table-bordered datatable" id="table_export"> 
                    <thead>
                        <tr style="font-size: 16px;">
                            <th><?= '#' ?></th>
                            <th><?= get_phrase('name') ?></th>
                            <th><?= get_phrase('expenses_type'); ?></th>
                            <th><?= get_phrase('comment') ?></th>
                            <th><?= get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($expenses_maad as $type) {
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $type['name'] ?></td>
                                <td><?= $this->db->get_where('expenses_category', array('id' => $type['expenses_category_id']))->row()->name ?></td>
                                <td><?= $type['comments'] ?></td>
                                <td>    
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>  
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_maad_type/<?= $type['id'] ?>');">       
                                                    <i class="fa fa-pencil-square"></i>     
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/expenses_mad/delete/<?php echo $type['id']; ?>')">       
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


