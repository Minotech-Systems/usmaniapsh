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
    p{text-align:justify;}
    *{text-align:right; line-height:2}
</style>
<?php include 'header.php'; ?>
<style>
    #map {
        height: 400px; 
        width: 100%;  
    }
</style>
<section class="inner-section">
    <div class="container">
        <div class="row" style="margin-top:30px;">
            <div class="col-md-9 col-md-push-3" >
                <div class="row">
                    <div class="col-md-12">
                        <div id="map"></div>
                        <script>
                            // Initialize and add the map
                            function initMap() {
                                // The location of Uluru
                                var uluru = {lat: 33.989725, lng: 71.550658};
                                // The map, centered at Uluru
                                var map = new google.maps.Map(
                                        document.getElementById('map'), {zoom: 4, center: uluru});
                                // The marker, positioned at Uluru
                                var marker = new google.maps.Marker({position: uluru, map: map});
                            }
                        </script>
                        <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6Y6d6m5tvajOzFqmCB9zDo7UJYSNymzE&callback=initMap">
                        </script>
                        <br>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-bordered responsive">
                            <tr>
                                <td style="background:#53516b; width:20%; color:white">
                                    <?= 'معلومات' ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?= 'نام' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'name'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'موبائل' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'mobile'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'فون' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'phone'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'ای میل' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'email'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'پتہ' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'address'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'دارالافتاء ای میل' ?></td>
                                <td><a href="<?= base_url('darulifta') ?>"><?= 'دارالافتاء' ?></a></td>
                            </tr>
                            <tr>
                                <td><?= 'چھٹی' ?></td>
                                <td>جمعہ</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <div class="inner-head">
                        <div class="para">
                            <p><?= 'طریقہ تعاون' ?></p>
                        </div>
                    </div>
                    <div>
                        <p style="text-align:justify; line-height: 2.5"><?= $this->db->get_where('web_settings', array('type' => 'cooperation_process'))->row()->description; ?></div>
                    <div>
                        <table class="table table-bordered responsive">
                            <tr>
                                <td style="background: #53516b; width:25%; color:white">
                                    <?= 'معلومات' ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?= 'نام' ?></td>
                                <td><?= $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'اکاونٹ نمبر' . '/' . 'Account No' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'account_no'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'ائی بی ان' . ' / ' . 'IBAN' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'ibn_no'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'برانچ نام' . ' / ' . 'Branch Name' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'branch_name'))->row()->description; ?></td>
                            </tr>
                            <tr>
                                <td><?= 'برانچ کوڈ' . ' / ' . 'Branch Code' ?></td>
                                <td><?= $this->db->get_where('web_settings', array('type' => 'branch_code'))->row()->description; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>



            </div>


            <?php include 'book_right_widgets.php'; ?>

        </div>
    </div>
</section>