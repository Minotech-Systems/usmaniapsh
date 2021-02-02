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

                    <ul class="list-question">
                        <?php
                        if(!empty($user_questions)):
                            
                        
                        foreach ($user_questions as $q_data) {
                            ?>
                            <li>
                                <a href="#">
                                    <div class="question_sign" style="float:right; margin-left: 20px;">
                                        <i class="fa fa-comment-o"></i><i class="fa fa-question"></i>
                                    </div>
                                    <?= $q_data->title ?>
                                </a>
                                <?php if ($q_data->status == 1) { ?>
                                    <a href="" class="ans-done pull-right"><?= 'جواب دیا گیا ہے' ?></a>
                                <?php } else { ?>
                                    <a href="" class="not-done pull-right"><?='سوال موصول ہوگیا ہے' ?></a>
                                <?php } ?>
                                
                            </li>
                        <?php } endif; ?>


                    </ul>
                </div>
            </div>
            <?php include 'user_right_widgets.php'; ?>
        </div>
    </div>
</div>
</section><a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>