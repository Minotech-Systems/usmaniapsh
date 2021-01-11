<style>
    .notifications.dropdown .dropdown-menu > li > ul > li > a > i{
        float: right;
        background: transparent !important;
        padding: 0px;
        color: #8BC34A !important;
        font-size: 8px;
    }

</style>
<?php
$this->db->order_by('date', 'DESC');
$notify = $this->db->get_where('ifta_fatwa_review', array('view_status' => 0, 'mujeeb_id' => $this->session->userdata('mujeeb_id')))->result();
foreach ($notify as $hire) {
    ?>

    <li class="unread notification-success  select_question" >

        <a href="<?= base_url('mujeeb/view_review_question/'.$hire->question_id.'/'.$hire->id)?>"><i class="pull-right" style="color:black !important; width: min-content; direction: ltr;"><?= date('d/m/Y H:i A', strtotime($hire->date)) ?></i>
            <i class="fa fa-circle"></i>
            <?php
            if (strlen($hire->detail) > 70) {
                echo substr($hire->detail, 0, 70) . '...';
            } else {
                echo $hire->detail;
            }
            ?>
        </a>
    </li>
<?php } ?>
<script>
//    $(function () {
//        $('.select_question').click(function () {
//            var question_id = $(this).attr('id');
//            $.ajax({
//                url: '<?= base_url('mujeeb/viewed_review_question?question_id=') ?>' + question_id,
//                success: function (data)
//                {
//                    window.location.href = "<?= base_url('questions/ifta_questions') ?>";
//                }
//            });
//
//        });
//    });
</script>