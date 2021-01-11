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
                    <?php echo get_phrase('books'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_book'); ?>
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
                            <th><?= 'سال' ?></th>
                            <th><?= get_phrase('date') ?></th>
                            <th><?= 'file' ?></th>
                            <th><?php echo get_phrase('options'); ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $rasala = $this->db->get('web_alasr_resala')->result();
                        foreach ($rasala as $bk_data) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $bk_data->name ?></td>
                                <td><?= $bk_data->year ?></td>
                                <td><?= date('d-m-Y', strtotime($bk_data->date)) ?></td>
                                <td>
                                    <a href="<?= base_url('uploads/alasr/' . $bk_data->file) ?>" target="blank">
                                        <i class="fa fa-download"></i>
                                        <?= 'ڈاون لوڈ فائل' ?>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/web_modals/edit_alasr_resala/<?= $bk_data->id ?>')">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>website/alasr_resala/delete/<?= $bk_data->id ?>')">   
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
                    <form action="<?= base_url('website/alasr_resala/add') ?>" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="txtbook" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('year'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" id="txtbook" name="year" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
                            <div class="col-sm-5">
                                <input type="file" id="txtbook" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo ' تصویر' ?></label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?= base_url('uploads/book_image.jpg') ?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new"><?php echo 'منتخب کریں'; ?></span>
                                            <span class="fileinput-exists"><?php echo 'تبدیل کریں' ?></span>
                                            <input type="file" name="image" accept="image/*" required="">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo 'ختم کریں' ?></a>
                                    </div>
                                </div>
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
