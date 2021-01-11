<style>
    li{text-align: right;}
</style>
<hr>
<div class="row">
    <div class="col-sm-12" style="text-align: left">
        <a class="btn btn-success" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_add_income_type/')">
            <i class="fa fa-plus-square"></i>
            <?= get_phrase('add_expense_type') ?>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= get_phrase('name') ?></th>
                    <th><?= get_phrase('comment') ?></th>
                    <th><?= get_phrase('action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($income_category as $data) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['comment'] ?></td>
                        <td>
                            <div class="btn-group">      
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                    <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                </button>     
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <li>  
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_income_cate/<?= $data['id'] ?>')">       
                                            <i class="fa fa-pencil-square"></i>     
                                            <?php echo get_phrase('edit'); ?>   
                                        </a>  
                                    </li>
                                    <li>  
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/income_category/delete/<?php echo $data['id']; ?>')">      
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