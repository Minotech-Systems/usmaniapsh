<style>
    .books-list .books-inner {
        padding: 35px 35px;
        border: 1px solid #D4C8BD;
        background: url(<?= base_url('assets/frontend/images/patteren-lighten.jpg') ?>) repeat center center;
        overflow: hidden;
        position: relative;
        margin-bottom: 30px;
    }
    .books-list .books-inner .books-thumbs {
        float: right;
        margin: 0 0 0 20px;
    }
    .books-list .books-inner a.btn {
        position: absolute;
        bottom: 35px;
        left: 35px;
        min-width: 110px;
    }
    .btn-blue {
        background: #53516b;
        border: solid 1px #53516b;
        color: #fff;
        position: relative;
    }
    .books-list .books-inner a.btn span {
        z-index: 1;
        position: relative;
    }
    .books-list .books-inner a.btn i {
        z-index: 1;
        left: 25px;
        top: 5px;
    }
    .books-list .books-inner .books-thumbs img {
        max-width: 150px;
    }
    @media (min-width: 1200px){
        .btn-blue:hover {
            color: #fff;
        }
    }
    .btn-blue {
        background: #53516b;
        border: solid 1px #53516b;
        color: #fff !important;
        position: relative;
    }
    .books-inner p{
        text-align: right;
        line-height: 2;
        font-size: 14px;
    }
</style>
<?php include 'header.php'; ?>
<section class="inner-section">
    <div class="container">
        <div class="row" style="margin-top:30px;">
            <div class="col-md-9 col-md-push-3">
                <?php
                foreach ($alasr_resla as $book) {
                    $ayat1 = base_url('uploads/ayat1.png');
                    $ayat2 = base_url('uploads/ayat2.png');
                    $ayat3 = base_url('uploads/ayat3.png');
                    ?>
                    <div class="books-list">
                        <div class="books-inner">
                            <div class="books-thumbs">
                                <a>
                                    <img src="<?= base_url('uploads/alasr/' . $book->image) ?>" class="lazy loaded">
                                </a>
                            </div>
                            <p><?= $book->name . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'سال' . ' : ' . $book->year ?></p>
                            <p><?= 'وَالْعَصْرِ' . '<img src="' . $ayat1 . '" width="25">' . '  إِنَّ الْإِنْسَانَ لَفِي خُسْرٍ' . '<img src="' . $ayat2 . '" width="25">' . 'إِلَّا الَّذِينَ آمَنُوا وَعَمِلُوا الصَّالِحَاتِ وَتَوَاصَوْا بِالْحَقِّ وَتَوَاصَوْا بِالصَّبْرِ' . '<img src="' . $ayat3 . '" width="25">' ?></p>
                            <a class="btn btn-blue" href="<?= base_url('uploads/alasr/' . $book->file) ?>" target="blank">
                                <span>ڈاؤن لوڈ</span>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12" style="text-align:center">          
                    <div class="border_container">                   
                        <ul class="pagination">       
                            <?php //echo $links; ?>                   
                        </ul>               
                    </div>           
                </div>
            </div>

            <?php include 'book_right_widgets.php'; ?>

        </div>
    </div>
</section>


<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>