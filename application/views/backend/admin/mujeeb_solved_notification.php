<?php $solved_questions = $this->admin_model->get_solved_questions(); ?>
<li>
    <ul class="dropdown-menu-list scroller">
        <li class="active">
            <p><?= 'مجیب تمام حل شدہ سوالات' ?></p>

        </li>
        <?php foreach ($solved_questions as $solved) { ?>
            <li class="active">
                <a href="#">
                    <i class="fa fa-envelope-o"></i>
                    <?= $solved->title ?>
                </a>
            </li>
        <?php } ?>

    </ul>
</li>