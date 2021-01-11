<hr>
<style>
    li{text-align: right;}
</style>
<div class="row">
    <div class="col-sm-12" style="text-align: left">
        <a class="btn btn-success" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_add_kata_banam_type/')">
            <i class="fa fa-plus-square"></i>
            <?= get_phrase('khata_banam') ?>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <table class="table table-condensed">
            <thead>
                <tr style="font-size: 16px;">
                    <th><?= '#' ?></th>
                    <th><?= get_phrase('khata_banam') ?></th>
                    <th><?= get_phrase('expenses_mad') ?></th>
                    <th><?= get_phrase('expenses_type'); ?></th>
                    <th><?= get_phrase('comment') ?></th>
                    <th><?= get_phrase('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($khata_banaam as $type) {
                    $expense_id = $this->db->get_where('child_expense_category', array('id' => $type['child_expense_id']))->row()->expenses_category_id;
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $type['name'] ?></td>
                        <td><?= $this->db->get_where('child_expense_category', array('id' => $type['child_expense_id']))->row()->name ?></td>
                        <td><?= $this->db->get_where('expenses_category', array('id' => $expense_id))->row()->name; ?></td>
                        <td><?= $type['comments'] ?></td>
                        <td>
                            <div class="btn-group">      
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                    <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                </button>     
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <li>  
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_khata_banam/<?= $type['id'] ?>')">       
                                            <i class="fa fa-pencil-square"></i>     
                                            <?php echo get_phrase('edit'); ?>   
                                        </a>  
                                    </li>
                                    <li>  
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/khata_banam/delete/<?php echo $type['id']; ?>')">       
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
