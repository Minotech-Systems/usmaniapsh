<style>
    .notifications.dropdown .dropdown-menu > li > ul > li{ text-align: right;}
    .notifications.dropdown .dropdown-menu > li{text-align: right}
    .notifications.dropdown .dropdown-menu > li > ul > li > a > i{background: transparent; color: black; float: right;}
    .badge-secondary_m{background: #ee4749; color: white;}
</style>
<?php $image = $this->crud_model->get_user_image($this->session->userdata('login_type')) ?>
<div class="row">

    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

        <ul class="user-info pull-left pull-none-xsm">

            <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php
                    if (!empty($image)) {
                        echo $image;
                    } else {
                        base_url('uploads/user.jpg');
                    }
                    ?>" alt="" class="img-circle" width="44" />
                         <?= $this->session->userdata('name'); ?>
                </a>

            </li>

        </ul>
        <?php if ($this->session->userdata('login_type') == 'admin') { ?>
            <ul class="user-info pull-left pull-right-xs pull-none-xsm" dir="rtl">

                <!-- New Question Notification  -->
                <li class="notifications dropdown">

                    <a href="#" class="dropdown-toggle" id="notification_bar" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="entypo-globe"></i>
                        <span class="badge badge-info"></span>
                    </a>

                    <ul class="dropdown-menu" dir="rtl">
                        <li class="top">
                            <p class="small"><?= 'مندرجہ ذیل نئے سوالات موصول ہوچکے ہیں' ?></p>
                        </li>

                        <li>
                            <ul class="dropdown-menu-list scroller" id="notifications">
                                <div class="loading"><img src="<?= base_url('uploads/loading.gif') ?>"></div>

                            </ul>
                        </li>

                        <li class="external">
                            <a href="#"><?= 'تمام اطلاع ملاحظہ کریں' ?></a>
                        </li>
                    </ul>

                </li>

                <!-- Solved Question Notification -->
                <li class="notifications dropdown">

                    <a href="#" class="dropdown-toggle" id="solved_notify" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="entypo-mail"></i>
                        <span class="badge badge-secondary"></span>
                    </a>

                    <ul class="dropdown-menu" dir="rtl">
                        <li class="top">
                            <p class="small"><?= 'مجیب تمام حل شدہ سوالات' ?></p>
                        </li>

                        <li>
                            <ul class="dropdown-menu-list scroller" id="solved_question">
                                <div class="loading" style="text-align:center"><img src="<?= base_url('uploads/loading.gif') ?>" width="30%"></div>

                            </ul>
                        </li>

                        <li class="external">
                            <a href="#"><?= 'تمام اطلاع ملاحظہ کریں' ?></a>
                        </li>
                    </ul>

                </li>


            </ul>
        <?php } else { ?>
            <ul class="user-info pull-left pull-right-xs pull-none-xsm" dir="rtl">

                <!-- New Question Notification  -->
                <li class="notifications dropdown">

                    <a href="#" class="dropdown-toggle" id="notification_bar_m" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="entypo-globe"></i>
                        <span class="badge badge-secondary_m" id="review"></span>
                    </a>

                    <ul class="dropdown-menu" dir="rtl">
                        <li class="top">
                            <p class="small"><?= 'مندرجہ ذیل فتویٰ کو دوبارہ توجہ فرمائے ' ?></p>
                        </li>

                        <li>
                            <ul class="dropdown-menu-list scroller" id="notifications_m">
                                <div class="loading"><img src="<?= base_url('uploads/loading.gif') ?>"></div>

                            </ul>
                        </li>

                        <li class="external">
                            <a href="<?= base_url('mujeeb/view_all_review') ?>"><?= 'تمام اطلاع ملاحظہ کریں' ?></a>
                        </li>
                    </ul>

                </li>
            </ul>
        <?php } ?>

    </div>


    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">

        <ul class="list-inline links-list pull-right">
            <li class="sep"></li>

            <li>

                <a href="<?= base_url('adminlogout') ?>">
                    <?= 'لاگ آوٹ' ?><i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>

    </div>

</div>
<script>
    $(document).ready(function () {
        $('#notification_bar').click(function () {
            $('#notifications').load("<?php echo base_url('admin/load_notifications/new_question'); ?>");
        });

        $('#notification_bar_m').click(function () {
            $('#notifications_m').load("<?php echo base_url('mujeeb/load_notifications/edit_review'); ?>");
        });
        $('#solved_notify').click(function () {
            $('#solved_question').load("<?php echo base_url('admin/load_notifications/solved_question'); ?>");
        });



        setInterval(function () {
            get_new_question_notifications();
            get_solved_question_notif();
            get_review_question_edit();
        }, 3000);

    });

    function get_new_question_notifications() {
        $.ajax({
            dataType: "json",
            url: '<?= base_url('admin/count_new_questions') ?>',
            success: function (data)
            {
                if (data) {
                    //$("#notifications").append('<li><a>' + 'You are hired for the job' + '</a></li>')
                    $(".badge-info").html(data);
                }
            },
            error: function (jqXHR, status, err) {
            }
        });
    }

    function get_solved_question_notif() {
        $.ajax({
            dataType: "json",
            url: '<?= base_url('admin/count_solved_questions') ?>',
            success: function (data)
            {
                if (data) {
                    //$("#notifications").append('<li><a>' + 'You are hired for the job' + '</a></li>')
                    $(".badge-secondary").html(data);
                }
            },
            error: function (jqXHR, status, err) {
            }
        });
    }

    function get_review_question_edit() {
        $.ajax({
            dataType: "json",
            url: '<?= base_url('mujeeb/count_review_questions') ?>',
            success: function (data)
            {
                if (data) {
                    //$("#notifications").append('<li><a>' + 'You are hired for the job' + '</a></li>')
                    $("#review").html(data);
                }
            },
            error: function (jqXHR, status, err) {
            }
        });
    }
</script>