<style>
    li{text-align: right}
    .popover-content{line-height: 2}
    .popover{width: 600px}
    #red{color: red}
</style>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered datatable" id="table-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= 'سوال نمبر' ?></th>
                    <th><?= get_phrase('question') ?></th>
                    <th><?= get_phrase('date_added') ?></th>
                    <th><?= get_phrase('book') ?></th>
                    <th><?= get_phrase('chapter') ?></th>
                    <th><?= get_phrase('lesson') ?></th>
                    <th><?= get_phrase('mujeeb') ?></th>
                    <th><?= get_phrase('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($questions as $ques) {
                    $book_where = array('book_id' => $ques->book_id);
                    $chapter_where = array('chapter_id' => $ques->chapter_id);
                    $lesson_where = array('lesson_id' => $ques->lesson_id);
                    $questioner_data = $this->db->get_where('ifta_user_question', array('question_id' => $ques->ques_id))->row();
                    $questioner_where = array('user_id' => $questioner_data->user_id);
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $ques->question_no ?></td>
                        <td>
                            <a href="<?= base_url() ?>questions/answering_to_question/<?= $ques->ques_id ?>">
                                <span id="<?php
                                if (empty($this->question_model->check_user_question($ques->ques_id))) {
                                    echo 'red';
                                }
                                ?>"  data-toggle="popover" data-trigger="hover" dir="rtl" data-placement="top" data-content="<?= $ques->question ?>" data-original-title="تفصیل سوال">
                                          <?= substr($ques->question, 0, 150) ?>
                                </span>
                            </a>
                        </td>
                        <td><?= date('d-m-Y', strtotime($ques->qdate)) ?></td>
                        <td><?= $this->question_model->get_table_column('ifta_books', $book_where, 'name') ?></td>
                        <td><?= $this->question_model->get_table_column('ifta_books_chapters', $chapter_where, 'name') ?></td>
                        <td><?= $this->question_model->get_table_column('ifta_chapter_lessons', $lesson_where, 'name') ?></td>
                        <td><?= $this->question_model->get_table_column('ifta_users', $questioner_where, 'name') ?></td>

                        <td>
                            <div class="btn-group">      
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                    <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                </button>     
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <li>
                                        <a href="<?= base_url('questions/answering_to_question') . '/' . $ques->ques_id ?>" >
                                            <i class="entypo-newspaper"></i>
                                            <?php echo 'الجواب' ?>   
                                        </a> 
                                    </li>
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/question_detail/<?= $ques->ques_id ?>');">
                                            <i class="entypo-newspaper"></i>
                                            <?php echo 'تشریح' ?>   
                                        </a> 
                                    </li>
                                    <li>     
                                        <a href="<?php echo base_url(); ?>questions/mostafti_question_print/<?= $ques->ques_id ?>" target="blank">          
                                            <i class="entypo-print"></i>    
                                            <?php echo get_phrase('print_question'); ?>   
                                        </a>  
                                    </li>
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/add_question_file/<?= $ques->ques_id ?>');">
                                            <i class="entypo-attach"></i>
                                            <?php echo get_phrase('add_file'); ?>   
                                        </a> 
                                    </li>
                                    <li class="divider"></li>
                                    <?php if (!empty($ques->file)) { ?>
                                        <li>
                                            <a href="<?= base_url() ?>questions/download_question_file/<?= $ques->file ?>" target="_blank">
                                                <i class="entypo-attach"></i>
                                                <?= 'ڈاونلوڈ فائل' ?>
                                            </a
                                        </li>
                                        <li class="divider"></li>
                                    <?php } ?>
                                    <li>     
                                        <a href="<?php echo base_url(); ?>questions/update_question/<?= $ques->ques_id ?>">          
                                            <i class="entypo-pencil"></i>    
                                            <?php echo get_phrase('edit'); ?>   
                                        </a>  
                                    </li>
                                    <li>  
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>questions/delete_question/<?= $ques->ques_id ?>')">   
                                            <i class="entypo-trash"></i>     
                                            <?php echo get_phrase('delete'); ?>        
                                        </a>  
                                    </li>
                                    <li>  
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>questions/reject_question/reject/<?= $ques->ques_id ?>')"> 
                                            <i class="entypo-block"></i>     
                                            <?php echo get_phrase('reject'); ?>        
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
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $table1 = jQuery('#table-3');

        // Initialize DataTable
        $table1.DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            //"bStateSave": true,
            // "order": [[ 2, "desc" ]]
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
    });

//    $(document).ready(function () {
//        $('#table-3').DataTable({
//            "ordering": false // false to disable sorting (or any other option)
//        });
//    });
</script>