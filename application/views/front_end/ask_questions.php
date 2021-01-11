<style>
    #widget_ask_question{
        display: none;
    }
    #alert-success p{
        font-size: 12px;
        text-align: right;
        color: black;
        line-height: 2.5;
        font-weight: bold;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
include 'ifta_header.php';
$user_login = $this->session->userdata('user_login');
?>
<section class="inner-section" >
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 sawal-pochain">
                <h3  style="margin:20px;" class="text-black">مختصر تعارف</h3>
                <hr class="big-hr">
                <ul class="listStyle" style="text-align:right; line-height: 2; padding: 0px;">
                    <li><?= 'دارالافتاء جامعہ عثمانیہ کا ایک اہم شعبہ ہے جہاں عامۃ المسلمین کو صحیح احکام اسلام سے واقفیت حاصل کرنے کی سہولت فراہم کی گئی ہے اور دینی معاملات میں سوالات کی شرعی رہنمائی کی جاتی ہے۔' ?></li>
                    <li><?= 'دارالافتاء کے رئیس حضرت مولانا مفتی غلام الرحمن صاحب مد ظلہ العالی اور نائب رئیس حضرت مولانا مفتی نجم الرحمن صاحب مد ظلہ ا لعالی ہیں۔' ?></li>
                    <li><?= 'دارالافتاء میں موصول ہونے والے تمام سوالات کے جوابات قرآن وحدیث اور فقہائے حنفیہ کی تحقیقات کی روشنی میں دیے جاتے ہیں ، تاہم اگر  بہ تقاضائے ضرورت متاخرین فقہاء نے کسی مسئلے میں مسالک اربعہ حقہ میں سے کسی اور مسلک کو مختار ،پسندیدہ اور مفتی بہ قرار دیا ہو تو اسے اختیا رکیا جاتا ہے ۔' ?></li>
                </ul>

                <h3  style="margin:20px;" class="text-black">مسئلہ پوچھنے سے متعلق ہدایات</h3>
                <hr class="big-hr">
                <ul class="listStyle" style="text-align:right; line-height: 2; padding: 0px;">
                    <li><?= 'برائے کرم سوال بھیجتے وقت مندرجہ ذیل امور کا خیال رکھئے :' ?></li>
                    <li><?= 'کوشش کریں کہ اردو رسم الخط میں سوال تحریر کریں تاہم اگر اردو رسم الخط میں لکھنا دشوار ہو تو انگریزی حروف میں اردو لکھ سکتے ہیں۔' ?></li>
                    <li><?= 'سوال میں صورتحال کو پوری طرح واضح کریں ۔اگر دارالافتاء کی طرف سے سوال کے کسی پہلو کے بارے میں وضاحت طلب کی جائے تو اس سے بھی ضرور آگاہ کریں۔' ?></li>
                    <li><?= 'ایک مرتبہ میں ایک ہی سوال بھیجیں۔اگر دوسرا سوا ل بھی بھیجنا ہو تو اس کو الگ بھیج دیا کریں۔' ?></li>
                    <li><?= 'اپنے روز مرہ کے پیش آمدہ مسائل کے بارے میں سوال کریں غیر ضروری اور بے مقصد سوال نہ کریں۔' ?></li>
                    <li><?= 'آسان اور عامۃ الوقوع کے مسائل کے حل میں دو ہفتے تک وقت لگ سکتاہے جب کہ زیادہ غور طلب مسائل میں اس سے زیادہ وقت لگ سکتاہے ۔ فتوی حل ہونے پر آن لائن میسیج موصول ہوگا۔' ?></li>
                    <li><?= 'طلاق کے مسائل میں خود طلاق دینے والے شخص کی حاضری اور اس کا بیان ضروری ہے تاکہ اس سے صحیح الفاظ و کیفیات معلوم ہو سکیں۔' ?></li>
                    <li><?= 'میراث کے مسائل میں وارث یا کسی قریبی رشتہ دار کا آنا ضروری ہے تاکہ صحیح ورثاء معلوم کیے جاسکیں ۔'?></li>
                    <li><?= 'تنسیخ نکاح کے مسائل میں عدالتی فیصلے کے بعد استفتاء کے ساتھ پوری عدالتی کاروائیکی فوٹو کاپی لف کرنا ضروری ہے ۔'?></li>
                    <li><?= 'متنازع مسائل میں کوئی استفتاء وصول نہیں کیا جاتا اور نہ ہی صرف تحریری بیانات پر کوئی تحریر لکھی جائے گی۔'?></li>
                </ul>
                
                <div class="clearfix"></div>
                <h3  style="margin:20px;" class="text-black">سوال پوچھیں</h3>
                <hr class="big-hr">
                <?php if ($this->session->userdata('flash_message') == 'success') { ?>
                    <div class="alert alert-success" id="alert-success">
                        <center><h3><?= 'شکریہ۔' ?></h3></center>
                        <p><?= 'سوال موصول ہونے پرآپ کو بذریعہ ای میل اطلاع کردی جائے گی، جواب تحقیق طلب ہونے کی صورت میں یا دیگر عوارض کی وجہ سے جواب میں تاخیر ممکن ہے ، لہٰذا وہی سوال دوبارہ نہ بھیجیں، ویب سائٹ پر جواب جاری ہونے کے ساتھ ہی بذریعہ ای میل آپ کو اطلاع کردی جائے گی' ?></p>
                    </div>
                <?php } ?>
                <div id="ask">
                    <form action="<?= base_url('user_question') ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="نام" class="form-control eng_input" value="<?php if ($user_login == 1) echo $this->session->userdata('name'); ?>" autocomplete="off" required="">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="ای میل" class="form-control eng_input"  value="<?php if ($user_login == 1) echo $this->session->userdata('email'); ?>" autocomplete="off" required=""> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="number" name="phone" placeholder="موبائل نمبر" class="form-control eng_input" value="<?php if ($user_login == 1) echo $this->session->userdata('phone'); ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="address" placeholder="پتہ" class="form-control eng_input" value="<?php if ($user_login == 1) echo $this->session->userdata('address'); ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="title" placeholder="عنوان" class="form-control eng_input" value="" autocomplete="off" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control eng_input" name="question" rows="3" placeholder="سوال" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary" data-animation="fadeInUp">پوچھیں</button>
                        </div>
                        <?php if (!empty($this->session->userdata('error_message'))) { ?>
                            <div class="alert alert-danger" role="alert" style="text-align:right">
                                <?= 'برائے مہربانی قواعد وضوابط کے ساتھ تمام معلومات کا اندراج کریں' ?>
                            </div>
                        <?php } ?>
                    </form>
                </div>


            </div>
            <?php include 'right_widgets.php'; ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $('#alert-success').hide('slow');
            }, 15000);


        });
    </script>
</section><a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>