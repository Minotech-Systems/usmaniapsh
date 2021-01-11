<style>
    @media (min-width: 1200px){
        .user_profile #faq #faq-list a:hover {
            background: #444352 url('<?= base_url('assets/frontend/default/img/listing-side-white.png') ?>') no-repeat 90% center;
            color: #fff;
            text-decoration: none;
            padding-right: 45px;
        }
    }
    .user_profile #faq #faq-list li{
        padding: 0px;
    }

    .user_profile #faq #faq-list a{
        line-height: 2;
        font-size:12px;
        font-weight:bold;
    }
    .user_profile i{
        font-size:28px;
    }
    .user_profile h3{
        font-size: 18px;
        font-weight:bold;
    }
</style>
<div class="col-md-3 col-sm-12 col-md-pull-9">
    <div class="side-menu user_profile" style="margin-top:0px;">
        <h3><i class="fa fa-book"></i> <?= 'معلوماتی لنکس' ?></h3>
        <div class="container-fluid">
            <div class="row">
                <div class="mazameeen-toggle" id="faq"  style="padding:0px; width: 100%">
                    <ul id="faq-list" class=" page-links" dir="rtl">
                        <li <?php if ($page_name == 'about_jamia') echo 'class="active"'; ?>>
                            <a href="<?= base_url('page/تعارف') ?>"><?= 'تعارف' ?></a>
                        </li>
                        <li <?php if ($page_name == 'jamia_tasees') echo 'class="active"'; ?>>
                            <a href="<?= base_url('page/جامعہ-کی-تاسیس') ?>"><?= 'جامعہ کی تاسیس' ?></a>
                        </li>
                        <li <?php if ($page_name == 'historical_travel') echo 'class="active"'; ?>>
                            <a href="<?= base_url('page/تاریخی-سفر') ?>"><?= 'تاریخی سفر' ?></a>
                        </li>
                        <li <?php if ($page_name == 'jamia_aim') echo 'class="active"'; ?>>
                            <a href="<?= base_url('page/اغراض-و-مقاصد') ?>"><?= 'جامعہ کے اغراض و مقاصد' ?></a>
                        </li>
                        <li <?php if ($page_name == 'news_updates') echo 'class="active"'; ?>>
                            <a href="<?= base_url('page/ضروری-اعلانات') ?>"><?= 'ضروری اعلانات' ?></a>
                        </li>
                        <li <?php if ($page_name == 'jamia_departments') echo 'class="active"'; ?>>
                            <a href="<?= base_url('page/جامعہ-شعبہ-جات') ?>"><?= 'جامعہ کے شعبہ جات' ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'جامعہ کا نظم ونسق' ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'جامعہ کا نظام تعلیم' ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'ضروری ہدایات اور قواعد وضوابط' ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'امتحانات' ?></a>
                        </li>
                        
                        <li>
                            <a href="#"><?= 'جامعہ کی شاخیں' ?></a>
                        </li>
                    </ul>
                </div>           
            </div>
        </div>
    </div>


</div>

