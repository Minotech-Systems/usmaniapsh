<?php include 'alasr_header.php'; ?>
<style>
    .listing-bok .list-question li a.ans-done {
        min-width: 100px;
        min-height: 30px;
        padding: 6px 0 6px;
        background: #3ab226;
        text-align: center;
        display: inline-block;
        top: 0;
        bottom: 0;
        height: 30px;
        color: #fff;
        font-size: 12px;
        text-decoration: none;
        margin: auto 0;
    }
    .listing-bok .list-question li a.not-done{
        min-width: 100px;
        min-height: 30px;
        padding: 6px 0 6px;
        background: #bc2626;
        text-align: center;
        display: inline-block;
        top: 0;
        bottom: 0;
        height: 30px;
        color: #fff;
        font-size: 12px;
        text-decoration: none;
        margin: auto 0;
    }
</style>
<section class="inner-section" >
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-md-push-3 listing-bok">
                <div class="col-md-12">
                    <h3 class="text-red"></h3>
                </div>
                <div class="col-md-12">
                    <a href="<?php echo base_url('index.php?/LibraryController/all_aurther/'); ?>">
                        <input type="button" dir="rtl" name="submit" class="btn btn-info btn-md" value="All records"></a>

                    <form id="" class="form" method="post">
                        <h3 class="text-center text-info"><?php echo "مصنف کا اندراج کریں" ?></h3>
                        <hr/>

                        <div class="form-group" style="text-align:right">
                            <label for="username" class="text-info"><?php echo "مصنف کا ںام" ?></label><br>
                            <input type="text" name="name" id="username" class="form-control eng_input">
                        </div>
                         <div class="form-group" style="text-align:right">
                            <label for="username" class="text-info"><?php echo "فون نمبر " ?></label><br>
                            <input type="text" name="phone" id="phone" class="form-control eng_input">
                        </div>
                         <div class="form-group" style="text-align:right">
                            <label for="address" class="text-info"><?php echo "پتہ "?></label><br>
                            <input type="text" name="address" id="address" class="form-control eng_input">
                        </div>

                        <div class="form-group" style="text-align:center">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="محفوظ کریں">
                        </div>
                    </form>
                </div>

            </div>
            <?php include 'user_right_widgets.php'; ?>
        </div>
    </div>
</div>
</section><a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>