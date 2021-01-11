<br>
<style>
    .tile-stats .icon i{ vertical-align: unset;}
    li{ text-align: right}
</style>
<div class="row">
    <div class="col-sm-3">

        <div class="tile-stats tile-cyan">
            <div class="icon"><i class="entypo-mail"></i></div>
            <div class="num" data-start="0" 
                 data-end="<?= $this->db->from("ifta_question")->count_all_results(); ?>" 
                 data-postfix="" data-duration="1500" data-delay="0">0</div>

            <h3><?= 'تمام سوالات' ?></h3>
            <p><?= 'دارلافتاء کے تمام سوالات' ?></p>
        </div>

    </div>

    <div class="col-sm-3">

        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-search"></i></div>
            <div class="num" data-start="0" 
                 data-end="<?= $this->db->where(array('status' => 1))->from("ifta_question")->count_all_results(); ?>" 
                 data-postfix="" data-duration="1500" data-delay="600">0</div>

            <h3><?= ' حل شدہ سوالات' ?></h3>
            <p><?= '  تمام حل شدہ سوالات' ?></p>
        </div>

    </div>

    <div class="col-sm-3">

        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-mail"></i></div>
            <div class="num" data-start="0" 
                 data-end="<?= $this->db->where(array('status' => 0))->from("ifta_question")->count_all_results(); ?>" 
                 data-postfix="" data-duration="1500" data-delay="1200">0</div>

            <h3><?= 'غیر حل شدہ سوالات' ?></h3>
            <p><?= 'دارلافتاء کے تمام غیر حل شدہ ' ?></p>
        </div>

    </div>

    <div class="col-sm-3">

        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-cancel-circled"></i></div>
            <div class="num" data-start="0" 
                 data-end="<?= $this->db->where(array('reject' => 1))->from("ifta_question")->count_all_results(); ?>"
                 data-postfix="" data-duration="1500" data-delay="1800">0</div>

            <h3><?= 'مسترد سوالات' ?></h3>
            <p><?= 'تمام مسترد سوالات' ?></p>
        </div>

    </div>
</div>
<style>
    .table > thead > tr > th{ font-weight: bold;}
</style>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="border-left: dashed 1px;">
        <table class="table table-hover" style="font-weight:bold">
            <thead>
                <tr>
                    <th colspan="5" style="text-align:center; "><h4 style="font-weight: bold;"><?= 'مجیب حل شدہ سوالات' ?></h4></th>
                </tr>
                <tr>
                    <th>#</th>
                    <th><?= 'مجیب' ?></th>
                    <th><?= 'سوال نمبر' ?></th>
                    <th><?= 'فتوی نمبر' ?></th>
                    <th><?= 'اختیارات' ?></th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($mujeeb_solved_questions as $solved) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $this->crud_model->get_column_name_by_id('ifta_users', 'user_id', $solved->user_id) ?></td>
                        <td><?= $solved->question_no ?></td>
                        <th><?= $solved->fatwa_num ?></th>
                        <td>
                            <a href="<?= base_url('fatwa/fatwa_detail/' . $solved->answer_id) ?>" class="btn btn-default btn-icon btn-xs">
                                <i class="fa fa-eye"></i>
                                <?= 'دیکھیں' ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="col-md-12">

            <!------CONTROL TABS START------>
            <ul class="nav nav-tabs bordered">
                <li class="active">
                    <a href="#new_unsolved" data-toggle="tab"><i class="entypo-menu"></i> 
                        <?= 'نئے غیر حل شدہ سوالات' ?>
                    </a>
                </li>
                <li>
                    <a href="#mujeeb_question" data-toggle="tab"><i class="entypo-plus-circled"></i>
                        <?php echo 'مجیب معلومات' ?>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane box active" id="new_unsolved">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center" colspan="6"><?= 'نئے غیر حل شدہ سوالات' ?></th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th><?= 'سوال نمبر' ?></th>
                                <th><?= 'نام مستفتی' ?></th>
                                <th><?= 'عنوان' ?></th>
                                <th><?= 'تاریخ آمد' ?></th>
                                <th><?= 'اختیارات' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no1 = 1;
                            foreach ($questions as $ques) {
                                $questioner = $this->question_model->get_mustafti_data($ques->questioner_id);
                                ?>
                                <tr>
                                    <td><?= $no1++ ?></td>
                                    <td><?= $ques->question_no ?></td>
                                    <td><?= $questioner->name ?></td>
                                    <td><?= $ques->title ?></td>
                                    <td><?= date('d-m-Y', strtotime($ques->qdate)) ?></td>
                                    <td>
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <li>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/question_detail/<?= $ques->ques_id ?>');">
                                                        <i class="entypo-newspaper"></i>
                                                        <?php echo 'تشریح' ?>   
                                                    </a> 
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="<?= base_url('questions/update_question/' . $ques->ques_id) ?>">
                                                        <i class="entypo-pencil"></i>
                                                        <?php echo 'تصحیح' ?>   
                                                    </a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane box " id="mujeeb_question">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= 'نام' ?></th>
                                <th><?= 'حل شدہ سوالات' ?></th>
                                <th><?= 'غیر حل شدہ سوالات' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $ifta_users = $this->db->get_where('ifta_users', array('status' => 1))->result();
                            foreach ($ifta_users as $user) {
                                $user_data = $this->db->get_where('ifta_user_question', array('user_id' => $user->user_id))->row();
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $user->name ?></td>
                                    <td>
                                        <?php
                                        $where = array();
                                        $where['solved_status'] = 1;
                                        $where['user_id'] = $user->user_id;
                                        echo $this->question_model->count_user_question($where);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $where = array();
                                        $where['solved_status'] = 0;
                                        $where['user_id'] = $user->user_id;
                                        echo $this->question_model->count_user_question($where);
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


