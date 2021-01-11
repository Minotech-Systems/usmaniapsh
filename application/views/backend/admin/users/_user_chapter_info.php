<?php
$this->db->order_by('book_id');
$data = $this->admin_model->get_user_cahpter_question_data($user_id, $chapter_id);
$user_data = $this->db->get_where('ifta_users', array('user_id' => $user_id))->row();
$book_data = $this->db->get_where('ifta_books', array('book_id' => $book_id))->row();
$chapter_data = $this->db->get_where('ifta_books_chapters', array('chapter_id' => $chapter_id))->row();
?>
<style>
    li{text-align: right}
</style>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="tile-stats tile-gray">
            <div class="icon">
                <i class="entypo-docs"></i>
            </div>
            <h3><?= $user_data->name ?></h3>
            <h4 style="text-align: center; color: #8f8f8f"><?= 'کتاب : ٰ' . $book_data->name ?></h4>
            <h4 style="text-align: center; color: #8f8f8f"><?= 'باب : ٰ' . $chapter_data->name ?></h4>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= 'سوال ںمبر' ?></th>
                    <th><?= 'فتویٰ نمبر' ?></th>
                    <th><?= 'سلسلہ نمبر' ?></th>
                    <th><?= 'فتوی موضوع' ?></th>
                    <th><?= 'کتاب' ?></th>
                    <th><?= 'باب' ?></th>
                    <th><?= 'صنف' ?></th>
                    <th><?= get_phrase('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data as $info) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $info->question_no ?></td>
                        <td><?= $info->fatwa_num ?></td>
                        <td><?= $info->selsela_num ?></td>
                        <td><?= $info->title ?></td>
                        <td><?= $this->db->get_where('ifta_books', array('book_id' => $info->book_id))->row()->name ?></td>
                        <td><?= $this->db->get_where('ifta_books_chapters', array('chapter_id' => $info->chapter_id))->row()->name ?></td>
                        <td><?= $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $info->lesson_id))->row()->name ?></td>
                        <td>
                            <div class="btn-group">      
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                    <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                </button>     
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <li>     
                                        <a href="<?php echo base_url(); ?>fatwa/print_fatwa/<?= $info->answer_id ?>" target="blank">          
                                            <i class="entypo-print"></i>    
                                            <?php echo 'پرنٹ فتویٰ' ?>   
                                        </a>  
                                    </li>
                                    <li class="divider"></li>
                                    <li>     
                                        <a href="<?php echo base_url(); ?>fatwa/edit_fatwa/<?= $info->answer_id ?>">          
                                            <i class="entypo-pencil"></i>    
                                            <?php echo 'تصحیح' ?>   
                                        </a>  
                                    </li>
                                    <li class="divider"></li>
                                    <li>     
                                        <a href="<?= base_url('fatwa/fatwa_detail/' . $info->answer_id) ?>" >
                                            <i class="entypo-newspaper"></i>
                                            <?= 'تسریح' ?>
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