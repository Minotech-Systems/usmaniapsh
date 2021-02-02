<script src="<?= base_url() ?>assets/js/urdutextbox.js"></script>
<style>
    li{text-align: right;}
</style>
<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtbook);
        MakeTextBoxUrduEnabled(txtdescription);

    }

</script>
<!--<div class="container">-->
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('Author'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'مصنف کا اندراج کر یں'; ?>
                </a></li>

        </ul>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('name') ?></th>
                            <th><?php echo get_phrase('phone') ?></th>
                            <th><?php echo get_phrase('address') ?></th>
                            <th><?php echo get_phrase('options'); ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $this->db->limit('10', '0');
                        $this->db->order_by('autr_id', 'desc');
                        $author = $this->db->get('lib_authors')->result();
                        foreach ($author as $autr_data) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $autr_data->name ?></td>
                                <td><?= $autr_data->phone ?></td>
                                <td><?= $autr_data->address ?></td>

                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();  ?>modal/popup/web_modals/edit_alasr_musanif/<?php echo  $autr_data->autr_id ?>')"> 
                                                                                                  
                                                    <i class="entypo-pencil"></i>  
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>website/alasr_musanif/delete_musf/<?= $autr_data->autr_id ?>')">   
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
            <!--.-->
            <div class="tab-pane box" id="add">
                <div class="row">
                    <form action="<?= base_url('website/alasr_musanif/add_musf') ?>" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="name" name="name" class="form-control">
                            </div></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="address" name="address" class="form-control">
                            </div></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="phone" name="phone" class="form-control">
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success"><?= ' داخل کریں' ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
