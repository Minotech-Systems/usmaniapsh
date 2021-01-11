<style>
    li{text-align: right;}
</style>
<div class="row">    
    <div class="col-md-12">                        
        <ul class="nav nav-tabs bordered"> 
            <li>                        
                <a class="btn btn-default" href="<?= base_url(); ?>index.php?admin/do_database_backup/">
                    <span><i class="entypo-database"></i></span> 
                    <span class="visible-xs"><i class="entypo-database"></i></span> 
                    <span class="hidden-xs"><?php echo get_phrase('database_backup') ?></span> 
                </a>                       
            </li> 
        </ul>  

        <div class="tab-content">      
            <div class="tab-pane active" id="home">   
                <table class="table table-bordered datatable" id="table_export"> 
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= get_phrase('file_nmae') ?></th>
                            <th><?= get_phrase('date') ?></th>
                            <th><?= get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($backups)) {
                            if (!empty($backups)) {
                                arsort($backups);
                                $no = 1;
                                foreach ($backups as $file) {
                                    $filename = explode("_", $file);
                                    ?>
                        <tr>
                                <td><?= $no++ ?></td>
                                <td><?php echo str_replace('-', ' &nbsp ', $filename[0]); ?></td>
                                <td><?php echo str_replace('.zip', ' &nbsp ', $filename[1]); ?><?php echo str_replace('.zip', ' &nbsp  ', $filename[2]); ?></td>

                                <td>
                                    <a  class="btn btn-primary"
                                        href="<?= base_url() ?>index.php?admin/download_backup/<?= $file ?>">
                                        <i class="fa fa-download"></i> download
                                    </a>

                                    <a href="#" class="btn btn-danger" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/delete_backup/<?php echo $file; ?>')">      
                                        <i class="entypo-trash"></i>     
                                        <?php echo get_phrase('delete'); ?>   
                                    </a>
                                </td>
                        </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>