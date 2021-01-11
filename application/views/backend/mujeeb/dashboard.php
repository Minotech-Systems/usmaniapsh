<br>
<style>
    .tile-stats .icon i{ vertical-align: unset;}
    li{ text-align: right}
</style>
<div class="row">
    <div class="col-sm-3">

        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-mail"></i></div>
            <div class="num" data-start="0" data-end="
            <?php
            $where['solved_status'] = 0;
            echo $this->mujeeb_model->count_questions($where);
            ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>

            <h3><?= 'تمام غیرحل شدہ سوالات' ?></h3>
            <p><?= $this->session->userdata('name') . ' : ' . 'غیر حل شدہ سوالات' ?></p>
        </div>
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-search"></i></div>
            <div class="num" data-start="0" data-end="
            <?php
            $where['solved_status'] = 1;
            $where['admin_approval'] = 1;
            echo $this->mujeeb_model->count_questions($where);
            ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>

            <h3><?= 'تمام حل شدہ سوالات' ?></h3>
            <p><?= $this->session->userdata('name') . ' : ' . 'تمام حل شدہ سوالات' ?></p>
        </div>

    </div>
    <div class="col-sm-8">
        <table class="table table-hover" style="font-weight:bold">
            <thead>
                <tr>
                    <th colspan="6" style="text-align:center; "><h4 style="font-weight: bold;"><?= $this->session->userdata('name') . ' ' . 'غیر حل شدہ سوالات' ?></h4></th>
                </tr>
                <tr>
                    <th>#</th>
                    <th><?= 'کتاب' ?></th>
                    <th><?= 'عنوان' ?></th>
                    <th><?= 'تاریخ آمد' ?></th>
                    <th><?= 'تاریخ واپسی' ?></th>
                    <th><?= get_phrase('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($un_solved_question as $data) {
                    ?>
                    <tr>

                        <td><?= $no++ ?></td>
                        <td><a href="<?= base_url('mujeeb/answering/' . $data->question_id) ?>"><?= $this->crud_model->get_column_name_by_id('ifta_books','book_id',$data->book_id); ?></a></td>
                        <td><a href="<?= base_url('mujeeb/answering/' . $data->question_id) ?>"><?= $data->title ?></a></td>
                        <td><a href="<?= base_url('mujeeb/answering/' . $data->question_id) ?>"><?= $data->mdate ?></a></td>
                        <td><a href="<?= base_url('mujeeb/answering/' . $data->question_id) ?>"><?= $data->mu_solved_date ?></a></td>

                        <td>
                            <div class="btn-group">      
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                    <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                </button>     
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/question_detail/<?= $data->question_id ?>');">
                                            <i class="entypo-newspaper"></i>
                                            <?php echo 'تشریح' ?>   
                                        </a> 
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?= base_url('mujeeb/answering/' . $data->question_id) ?>">
                                            <i class="entypo-newspaper"></i>
                                            <?php echo 'الجواب' ?>   
                                        </a> 
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?= base_url('mujeeb/print_question/' . $data->question_id) ?>" target="blank">
                                            <i class="fa fa-print"></i>
                                            <?php echo 'پرنٹ سوال' ?>   
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
</div>