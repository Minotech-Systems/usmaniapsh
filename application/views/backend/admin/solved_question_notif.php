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
$this->db->order_by('date_added', 'DESC');
$notify = $this->db->get_where('ifta_user_question', array('solved_status' => 1, 'admin_view_status' => 0))->result();

foreach ($notify as $hire) {
    $ques_data = $this->db->get_where('ifta_question', array('question_id' => $hire->question_id))->row();
    ?>

    <li class="unread notification-success  select_question" id="<?= $hire->question_id ?>">

        <a href="#"><i class="pull-right" style="color:black !important"><?= 'تاریخ' . ' : ' . date('d/m/Y', strtotime($hire->date_added)) ?></i><i class="fa fa-circle"></i><?= $ques_data->title ?></a>
    </li>
<?php } ?>
<script>
    $(function () {
        $('.select_question').click(function () {
            var question_id = $(this).attr('id');
            $.ajax({
                url: '<?= base_url('admin/viewed_answer?question_id=') ?>' + question_id,
                success: function (data)
                {
                    window.location.href = "<?= base_url('fatwa/answers') ?>";
                }
            });

        });
    });
</script>