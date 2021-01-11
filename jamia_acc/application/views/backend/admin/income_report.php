<hr>
<?php echo form_open(base_url() . 'index.php?admin/income_report/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control"  id="month" dir="rtl" >
                <option selected=""> منتخب کریں</option>
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
    
    <div class="col-sm-3 ">
        <div class="form-group">
            <label class="control-label"><?php echo get_phrase('year'); ?></label>
           <select name="year" class="form-control" onchange="submit()">		  	
            <option value=""><?php echo get_phrase('year');?></option>		  	
                <?php for($i = 0; $i < 30; $i++):?>		      	
            <option value="<?php echo (1438+$i);?>-<?php echo (1438+$i+1);?>">		          	
                    <?php echo (1438+$i);?>-<?php echo (1438+$i+1);?>		      	
            </option>		  
                <?php endfor;?>		
        </select>
        </div>
    </div>
</div>
<?=
form_close();
if ($month != '') {
    ?>
    <div class="row">
        <div class="col-sm-3">
        <?= 'بابت ماہ ' . ' : ' . $this->crud_model->get_month_name($month).' '.'<span dir="ltr">'.$d_year.'</span>'; ?>
        </div>
        <div class="col-sm-6">
            <center><h3>تفصیل خرچ <?= $system_name ;?></h3></center>
        </div>
        <div class="col-sm-2">
            <image src="uploads/logo.png" height="80"/>
        </div>
        <div class="col-sm-1">
            <a class="btn btn-success" align="left" target="_blank" href="<?php echo base_url(); ?>index.php?admin/print_income_report/<?= $month?>/<?= $d_year?>">
                <i class="fa fa-print"></i>
                <?= 'پرنٹ رپورٹ'?>
            </a>
        </div>
    </div>
<hr>
    <?php include 'reports/income_report_view.php'; ?>
    <?php
}?>