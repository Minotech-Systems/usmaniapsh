<hr>
<div class="row">
    <div class="col-sm-12" style="text-align: left">
        <a class="btn btn-success" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_add_expense_type/')">
            <i class="fa fa-plus-square"></i>
            <?= get_phrase('add_expense_type')?>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <table class="table table-condensed">
    <thead>
        <tr style="font-size: 16px;">
            <th><?= '#'?></th>
            <th><?= get_phrase('name')?></th>
            <th><?= get_phrase('comment')?></th>
            <th><?= get_phrase('action')?></th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($expenses_type as $type){ ?>
        <tr>
            <td><?= $no++;?></td>
            <td><?= $type['name']?></td>
            <td><?= $type['comments']?></td>
            <td>
                <a class="btn btn-orange" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_expense_type/<?= $type['id']?>')">
                    <i class="fa fa-pencil-square"></i>
                    <?= get_phrase('edit')?>
                </a>
                <a class="btn btn-danger" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/expenses_type/delete/<?php echo $type['id']; ?>')">
                    <i class="entypo-trash"></i>
                        <?= get_phrase('delete');?>
                </a>
                
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
    </div>
</div>
