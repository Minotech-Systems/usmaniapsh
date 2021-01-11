<script src="assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txticomment);
         MakeTextBoxUrduEnabled(txtass);


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
                    <span class="hidden-xs"><?php echo 'امد شامل کریں' ?></span> 
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
                            <th>#</th>
                            <th><?= get_phrase('income_type') ?></th>
                            <th><?= get_phrase('page_no') ?></th>
                            <th><?= get_phrase('bill_no') ?></th>
                            <th><?= get_phrase('assistant_name')?></th>
                            <th><?= get_phrase('date') ?></th>
                            <th><?= get_phrase('month') ?></th>
                            <th><?= get_phrase('amount') ?></th>
                            <th><?= get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($income as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $this->db->get_where('income_category',array('id'=>$data['income_category_id']))->row()->name?></td>
                                <td><?= $data['page_num'] ?></td>
                                <td><?= $data['bill_no']?></td>
                                <th><?= $data['assistant']?></th>
                                <td><?= date('d-m-Y', strtotime($data['date'])) ?></td>
                                <td><?= $this->crud_model->get_month_name($data['arabic_month']); ?></td>
                                <td><?= $data['amount'] ?></td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>  
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modals/modal_edit_jamia_income/<?= $data['id'] ?>')">       
                                                    <i class="fa fa-pencil-square"></i>     
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/add_income/delete/<?php echo $data['id']; ?>')">      
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
            <div class="tab-pane" id="add">
                    <?php echo form_open(base_url() . 'index.php?admin/add_income/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('income_type'); ?></label>
                    <div class="col-sm-4">
                        <select name="income_type_id" class="form-control "  >
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                            $income_cat = $this->db->get('income_category')->result_array();
                            foreach ($income_cat as $inc):
                                ?>
                                <option value="<?php echo $inc['id']; ?>"><?php echo $inc['name']; ?></option>
                    <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('assistant_name'); ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="assistant" id="txtass" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
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
                        <input type="text" class="form-control" name="amount" placeholder="رقم کا اندراج کریں" autocomplete="off" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
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
                        <input type="text" class="form-control" name="comment" id="txticomment">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('page_no'); ?></label>
                    <div class="col-sm-4">
                            <?php $page_num = $this->db->get_where('income_page_lock', array('year' => $running_year, 'status' => 1))->row()->number ?>
                        <input type="text" class="form-control"  value="<?= $page_num ?>" disabled="">
                        <input type="hidden" name="page_no" value="<?= $page_num ?>" >

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <button class="btn btn-success" type="submit"><?= get_phrase('submit') ?></button>
                    </div>
                </div>
            <?php echo form_close() ?>
            </div>

            <!---- Page Number---->
            <div class="tab-pane" id="page">
                <div class="row">
                    <div class="col-md-8" style="margin-top:40px">
                        <?php echo form_open(base_url() . 'index.php?admin/change_income_page', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" align="left"><?php echo get_phrase('page_no'); ?></label>
                            <div class="col-sm-4">
                                <?php $page_num = $this->db->get_where('income_page_lock', array('year' => $running_year, 'status' => 1))->row()->number ?>
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