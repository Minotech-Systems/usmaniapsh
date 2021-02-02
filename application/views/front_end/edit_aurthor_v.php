<?php include 'ifta_header.php'; ?>
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
                    <?php echo form_open('',array('class'=>'form')) ?>
                     
                                <h3 class="text-center text-info"><?php echo "مصنف کی تصیح کریں"?></h3>
                                <hr/>
                                <div class="form-group" style="text-align:right">
                                    <label for="username" class="text-info"><?php echo "مصنف کا ںام"?></label><br>
                                    <input type="text" name="name" value="<?php echo $result->name?>" id="username" class="form-control eng_input">
                                   <label for="username" class="text-info"><?php echo "پتہ";?></label><br>
                                    <input type="text" name="address" value="<?php echo $result->address?>" id="address" class="form-control eng_input">
                                    <label for="username" class="text-info"><?php echo "مو بال";?></label><br>
                                    <input type="text" name="phone" value="<?php echo $result->phone?>" id="phone" class="form-control eng_input">
                                    
                                    <input type="hidden" name="atur_id" value="<?php echo $result->autr_id?>" id="username" class="form-control eng_input">
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