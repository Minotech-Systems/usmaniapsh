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
    .btn-brwon {
        background: #4e3a26;
        border: solid 1px #4e3a26;
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
        .btn-brwon:hover {
            color: #fff;
        }
    }
    .btn-brwon {
        background: #4e3a26;
        border: solid 1px #4e3a26;
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
                $books = $this->db->get_where('web_books', array('show_on_website' => 1))->result();
                foreach ($books as $book) {
                    ?>
                    <div class="books-list">
                        <div class="books-inner">
                            <div class="books-thumbs">
                                <a>
                                    <img src="<?= base_url('uploads/books/' . $book->image) ?>" class="lazy loaded">
                                </a>
                            </div>
                            <p><?= $book->description ?></p>
                            <a class="btn btn-brwon" href="<?= base_url('uploads/books/' . $book->file) ?>">
                                <span>ڈاؤن لوڈ</span>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <?php include 'book_right_widgets.php'; ?>

        </div>
    </div>
</section>


<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>