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
                                <th><?php echo get_phrase('description') ?></th>
                                <th><?= 'ویب سائٹ پر دیکھائے' ?></th>
                                <th><?php echo get_phrase('options'); ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($books as $bk_data) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $bk_data->name ?></td>
                                    <td><?= $bk_data->description ?></td>
                                    <td><?php
                                        if ($bk_data->show_on_website == 1) {
                                            echo 'ہاں';
                                        } else {
                                            echo 'نہیں';
                                        };
                                        ?></td>
                                    <td>
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <li>     
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/web_modals/edit_book/<?= $bk_data->book_id ?>')">          
                                                        <i class="entypo-pencil"></i>    
                                                        <?php echo get_phrase('edit'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>website/books/delete/<?= $bk_data->book_id ?>')">   
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
                        <form action="<?= base_url('website/books/add') ?>" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" id="txtbook" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
                                <div class="col-sm-5">
                                    <textarea name="description" rows="5" id="txtdescription" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo 'کتاب تصویر' ?></label>
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
                                                <input type="file" name="book_image" accept="image/*" required="">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo 'ختم کریں' ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo 'کتاب فائل' ?></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="book_file" required="">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-success"><?= 'کتاب داخل کریں' ?></button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
