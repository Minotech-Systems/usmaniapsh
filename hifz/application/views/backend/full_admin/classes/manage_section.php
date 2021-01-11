<hr />
<style>
    li{text-align: right;}
</style>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            <select class="form-control" name="class_id" onchange="GotoUrl(this.value); return false;">
                <option value=""><?= get_phrase('select_branch') ?></option>
                <?php foreach ($branches as $bran) { ?>
                    <option value="<?= $bran->branch_id ?>"><?= $bran->name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<?php if (!empty($class_id)) { ?>
    <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/classes/modal_section_add/<?= $branch_id?>');" 
       class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_section'); ?>
    </a> 
    <br><br><br>
    <div class="row">
        <div class="col-md-12">

            <div class="tabs-vertical-env">

                <ul class="nav tabs-vertical">
                    <?php
                    $classes = $this->db->get_where('class', array('branch_id' => $branch_id))->result_array();


                    foreach ($classes as $row):
                        $branch_name = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
                        ?>
                        <li class="<?php if ($row['class_id'] == $class_id) echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>index.php?full_admin/manage_section/sections/<?php echo $row['class_id']; ?>/<?= $branch_id ?>">
                                <i class="entypo-dot"></i>
                                <?php echo get_phrase('class'); ?> <?php echo $row['name'] . ' / <span dir="ltr">' . $branch_name . '</span> '; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active">
                        <table class="table table-bordered responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo get_phrase('section_name'); ?></th>
                                    <th><?php echo get_phrase('nick_name'); ?></th>
                                    <th><?php echo get_phrase('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $count = 1;
                                $sections = $this->db->get_where('section', array(
                                            'class_id' => $class_id
                                        ))->result_array();
                                foreach ($sections as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['nick_name']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo get_phrase('action') ?> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                    <!-- EDITING LINK -->
                                                    <li>
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/classes/modal_edit_section/<?php echo $row['section_id']; ?>/<?= $branch_id?>');">
                                                            <i class="entypo-pencil"></i>
                                                            <?php echo get_phrase('edit'); ?>
                                                        </a>
                                                    </li>
                                                    <li class="divider"></li>

                                                    <!-- DELETION LINK -->
                                                    <li>
                                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?full_admin/sections/delete/<?php echo $row['section_id']; ?>/<?= $branch_id?>');">
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

                </div>

            </div>	

        </div>
    </div>
<?php } ?>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
    function GotoUrl(id) {
        location.href = "<?php echo base_url(); ?>index.php?full_admin/manage_section/" + id;
    }
    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>