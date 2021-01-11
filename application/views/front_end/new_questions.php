<?php include 'ifta_header.php'; ?>
<section class="inner-section" >
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 listing-bok">
                <div class="col-md-12">
                    <h3 class="text-red"></h3>
                </div>
                <div class="col-md-12">
                    <ul class="list-question">
                        <?php foreach ($questions as $q_data) { ?>
                            <li>
                                <a href="<?= base_url('read_question/' . $q_data->question_no) ?>">
                                    <div class="question_sign" style="float:right; margin-left: 20px;">
                                        <i class="fa fa-comment-o"></i><i class="fa fa-question"></i>
                                    </div>
                                    <?= $q_data->title ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-12" style="text-align:center">          
                    <div class="border_container">                   
                        <ul class="pagination">       
                            <?php echo $links; ?>                   
                        </ul>               
                    </div>           
                </div>
            </div>
            <?php include 'right_widgets.php'; ?>
        </div>
    </div>
</div>
</section><a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>