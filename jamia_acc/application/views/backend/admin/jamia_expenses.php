<script src="assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtcomment);//enable Urdu in html text box
        MakeTextBoxUrduEnabled(txtc);//enable Urdu in html text box


    }

</script>
<style>
    li{text-align: right;}
</style>
<div class="row">    
    <div class="col-md-12">                        
        <ul class="nav nav-tabs bordered">             
            <li class="active">                        
                <a href="#home" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo $system_name ?></span> 
                </a>                       
            </li> 
            <li>                        
                <a href="#add" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo 'شامل اخراجات' ?></span> 
                </a>                       
            </li>
            <li>                        
                <a href="#page" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo 'نمبرات صفحات' ?></span> 
                </a>                       
            </li> 

        </ul>  

        <div class="tab-content">      
            <div class="tab-pane active" id="home">   
                <table class="table table-bordered datatable" id="table_export"> 
                    <thead>       
                        <tr>
                            <td>#</td>
                            <td><?= get_phrase('khata_banam') ?></td>
                            <td><?= get_phrase('bill_no') ?></td>
                            <td><?= get_phrase('expenses_mad'); ?></td>
                            <td><?= get_phrase('expenses_type'); ?></td>
                            <td><?= get_phrase('month'); ?></td>
                            <td><?= get_phrase('date'); ?></td>
                            <td><?= get_phrase('amount'); ?></td>
                            <td width="170"><?= get_phrase('action'); ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($expenses as $data) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $this->crud_model->get_column_name_by_id('sub_child_expense_category', 'id', $data['sub_child_expense_id']) ?></td>
                                <td><?= $data['bill_no'] ?></td>
                                <td><?= $this->crud_model->get_column_name_by_id('child_expense_category', 'id', $data['child_expense_id']) ?></td>
                                <td><?= $this->crud_model->get_column_name_by_id('expenses_category', 'id', $data['expense_category_id']) ?></td>
                                <td><?= $this->crud_model->get_month_name($data['arabic_month']); ?></td>
                                <td><?= date('d-m-Y', strtotime($data['date'])); ?></td>
                                <td><?= $data['amount'] ?></td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>  
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_jamia_expense/<?= $data['id'] ?>')">       
                                                    <i class="fa fa-pencil-square"></i>     
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/jamia_expenses/delete/<?php echo $data['id']; ?>')">      
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
            <div class="tab-pane box" id="add">
                <?php echo form_open(base_url() . 'index.php?admin/jamia_expenses/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('khata_banam'); ?></label>
                    <div class="col-sm-4">
                        <select name="sub_child_expense_id" class="form-control "  >
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                            foreach ($kata_banam as $row):
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('bill_no'); ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="bill_no" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('amount'); ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="amount" placeholder="رقم کا اندراج کریں" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('month'); ?></label>
                    <div class="col-sm-4">
                        <select name="islamic_month" class="form-control"  id="month" dir="rtl">
                            <?php
                            for ($i = 1; $i <= 12; $i++):
                                if ($i == 1)
                                    $m = 'محرم';
                                else if ($i == 2)
                                    $m = 'صفر';
                                else if ($i == 3)
                                    $m = 'ر بیع الاول';
                                else if ($i == 4)
                                    $m = 'ر بیع الثانی';
                                else if ($i == 5)
                                    $m = 'جمادی الاول';
                                else if ($i == 6)
                                    $m = 'جمادی الثانی';
                                else if ($i == 7)
                                    $m = 'رجب';
                                else if ($i == 8)
                                    $m = 'شعبان';
                                else if ($i == 9)
                                    $m = 'رمضان';
                                else if ($i == 10)
                                    $m = 'شوال';
                                else if ($i == 11)
                                    $m = 'ذوالقعدۃ';
                                else if ($i == 12)
                                    $m = 'ذوالحجۃ';
                                ?>
                                <option value="<?php echo $i; ?>"
                                        <?php if ($month == $i) echo 'selected'; ?>  >
                                            <?php echo ucfirst($m); ?>
                                </option>
                                <?php
                            endfor;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" name="date" data-format="dd-mm-yyyy" value="<?= date('d-m-Y') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('comment'); ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="comment" id="txtcomment">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('page_no'); ?></label>
                    <div class="col-sm-4">
                        <?php $page_num = $this->db->get_where('page_lock', array('year' => $running_year, 'status' => 1))->row()->number ?>
                        <input type="text" class="form-control"  value="<?= $page_num ?>" disabled="">
                        <input type="hidden" name="page_no" value="<?= $page_num ?>" >

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <button class="btn btn-success" type="submit"><?= get_phrase('submit') ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="tab-pane " id="page">
                <div class="row">
                    <div class="col-md-8" style="margin-top:40px">
                        <?php echo form_open(base_url() . 'index.php?admin/change_page_num', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" align="left"><?php echo get_phrase('page_no'); ?></label>
                            <div class="col-sm-4">
                                <?php $page_num = $this->db->get_where('page_lock', array('year' => $running_year, 'status' => 1))->row()->number ?>
                                <input type="text" class="form-control" name="page_num" value="<?= $page_num ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-success"  type="submit"><?= 'صفحہ تبدیل کریں' ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-4">
                        <blockquote class="blockquote-gold">
                            <strong>
                                <h4>اہم نوٹ۔۔۔</h4>
                            </strong>
                            <p style="line-height: 2">اگر ایک مرتبہ اپ نے صفحہ تبدیل کر دیا تو وہ واپس نہیں ائے گا۔۔<br> لہزا صفحہ تبدیل کرتے وقت خاض خیال رکھیں۔</p>
                        </blockquote>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($)

    {
        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 3, 4, 6, 7, 8, 9]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 3, 4, 6, 7, 8, 9]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(2, false);
                            datatable.fnSetColumnVis(5, false);
                            datatable.fnSetColumnVis(11, false);
                            this.fnPrint(true, oConfig);
                            window.print();
                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(0, true);

                                    datatable.fnSetColumnVis(10, true);
                                }
                            });
                        },
                    },
                ]},
        });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>

