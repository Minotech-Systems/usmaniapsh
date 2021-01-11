<?php include 'ifta_header.php'; ?>
<section class="inner-section" >
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 listing-bok">
                <div class="col-md-12">
                    <h3 class="text-red"><?= 'سوال برائے ' . ' ' . $word ?></h3>
                </div>

                <div class="col-md-12">
                    <ul class="list-question">
                        <?php foreach ($questions as $question) { ?>
                            <li>
                                <a href="#">
                                    <div class="question_sign" style="float:right; margin-left: 20px;">
                                        <i class="fa fa-comment-o"></i><i class="fa fa-question"></i>
                                    </div>
                                    <?= $question->title ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>          
                <div class="col-md-12" style="text-align:center">          
                    <div class="border_container">                   
                        <ul class="pagination pagination-sm" style="margin: 0px !important;">       
                            <?php echo $links; ?>                   
                        </ul>               
                    </div>           
                </div> 
            </div>
            <?php include 'right_widgets.php'; ?>
        </div>
    </div>
</div>
</section>