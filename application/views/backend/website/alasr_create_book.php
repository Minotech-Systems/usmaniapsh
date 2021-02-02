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
<div class="form-group">
    <div class="col-md-4 col-md-offset-4">
        <h2><?php echo 'کتاب کو ترتیب دیں'; ?></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
   <div class="tab-pane box" id="add">
       
       <div class="row"><br><br>
                    <form action="" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('Book'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" id="name" name="name" class="form-control">
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
<!--</div>-->
