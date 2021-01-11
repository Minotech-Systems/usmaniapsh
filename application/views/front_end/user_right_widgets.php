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
    <div class="side-menu user_profile">
        <h3><i class="fa fa-user"></i> <?= $this->session->userdata('name'); ?></h3>
        <div class="container-fluid">
            <div class="row">
                <div class="mazameeen-toggle" id="faq"  style="padding:0px; width: 100%">
                    <ul id="faq-list" class=" page-links" dir="rtl">
                        <li>
                            <a href="AddAurther"><?= "مصنف" ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'ٹایٹل' ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'رسالہ' ?></a>
                        </li>
                        <li>
                            <a href="#"><?= 'قارین' ?></a>
                        </li>
                        <li>
                            <a href="<?= base_url('login/logout') ?>"><?= 'لاگ آوؑٹ' ?></a>
                        </li>
                    </ul>
                </div>           
            </div>
        </div>
    </div>

</div>

