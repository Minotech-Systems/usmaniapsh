<div class="row">
    <div class="col-md-12">
        <form class="" method="post" action="<?= base_url('fatwa/print_fatwa_list') ?>" target="_blank">
            <div class="col-md-3 col-sm-6 col-md-offset-2">
                <div class="input-group">
                    <input type="text" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="<?= ' تاریخ سے۔۔۔' ?>" autocomplete="off" name="date_from">
                    <div class="input-group-addon">
                        <a href="#">
                            <i class="entypo-calendar"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="input-group">
                    <input type="text" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="<?= 'تاریخ تک' ?>" autocomplete="off" name="date_to">
                    <div class="input-group-addon">
                        <a href="#">
                            <i class="entypo-calendar"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="input-group">
                    <button type="submit" class="btn btn-success"><?= 'پرنٹ لسٹ' ?></button>
                </div>
            </div>
        </form>
    </div>
</div>