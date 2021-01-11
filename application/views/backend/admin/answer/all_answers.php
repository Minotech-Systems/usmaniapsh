<style>
    li{ text-align: right}
</style>
<hr>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#approved" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo 'تمام فتوی'; ?>
                </a>
            </li>
            <li>
                <a href="#unapproved" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'غیر تصدیق شدہ' ?>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane box active" id="approved">
                <table class="table table-bordered datatable" id="table-3">
                    <thead>
                    <!--<th></th>-->
                    <th>#</th>
                    <th><?= 'فتویٰ نمبر' ?></th>
                    <th><?= 'سلسلہ نمبر' ?></th>
                    <th><?= 'فتوی موضوع' ?></th>
                    <th><?= 'کتاب' ?></th>
                    <th><?= 'باب' ?></th>
                    <th><?= 'صنف' ?></th>
                    <th><?= 'مستفتی' ?></th>
                    <th><?= get_phrase('action') ?></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($answer_data as $fatwa) {
                            $questioner = $this->db->get_where('ifta_questioner', array('questioner_id' => $fatwa->questioner_id))->row();
                            ?>
                            <tr <?php if ($fatwa->show_no_site == '0') echo 'style="background-color:antiquewhite"'; ?>>
                                <!--<td><?= $fatwa->question_id ?></td>-->
                                <td><?= $fatwa->question_no ?></td>
                                <td><?= $fatwa->fatwa_num ?></td>
                                <td><?= $fatwa->selsela_num ?></td>
                                <td><?= $fatwa->title ?></td>
                                <td><?= $this->db->get_where('ifta_books', array('book_id' => $fatwa->book_id))->row()->name ?></td>
                                <td><?= $this->db->get_where('ifta_books_chapters', array('chapter_id' => $fatwa->chapter_id))->row()->name ?></td>
                                <td><?= $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $fatwa->lesson_id))->row()->name ?></td>
                                <td><?php
                                    if ($fatwa->response_email == 1) {
                                        echo $questioner->name . '&#10003';
                                    } else {
                                        echo $questioner->name;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="<?php echo base_url(); ?>fatwa/print_fatwa/<?= $fatwa->answer_id ?>" target="_blank">          
                                                    <i class="entypo-print"></i>    
                                                    <?php echo 'پرنٹ فتویٰ' ?>   
                                                </a>  
                                            </li>
                                            <li>     
                                                <a href="<?php echo base_url(); ?>fatwa/edit_fatwa/<?= $fatwa->answer_id ?>">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo 'تصحیح' ?>   
                                                </a>  
                                            </li>
                                            <li>     
                                                <a href="<?= base_url('fatwa/fatwa_detail/' . $fatwa->answer_id) ?>" >
                                                    <i class="entypo-newspaper"></i>
                                                    <?= 'تسریح' ?>
                                                </a> 
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" onclick="send_email_modal('<?php echo base_url(); ?>fatwa/send_answer_email/<?= $fatwa->answer_id ?>')">
                                                    <i class="entypo-mail"></i>
                                                    <?php echo 'ای میل مستفتی' ?> 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('fatwa/show_on_site/' . $fatwa->question_id . '/' . $fatwa->show_no_site) ?>">  
                                                    <i class="fa fa-pencil"></i>
                                                    <?php echo 'ویب سائٹ پر دیکھائے' ?> 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?= base_url('fatwa/delete_fatwa/' . $fatwa->question_id ) ?>')"> 
                                                    <i class="entypo-trash"></i>
                                                    <?php echo 'ختم کریں' ?> 
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
            <!--.-->
            <div class="tab-pane box" id="unapproved">
                <table class="table table-bordered datatable" id="table-3">
                    <thead>
                    <!--<th></th>-->
                    <th>#</th>
                    <th><?= 'فتویٰ نمبر' ?></th>
                    <th><?= 'سلسلہ نمبر' ?></th>
                    <th><?= 'فتوی موضوع' ?></th>
                    <th><?= 'کتاب' ?></th>
                    <th><?= 'باب' ?></th>
                    <th><?= 'صنف' ?></th>
                    <th><?= 'مستفتی' ?></th>
                    <th><?= get_phrase('action') ?></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($unsolved_ans as $fatwa) {
                            $questioner = $this->db->get_where('ifta_questioner', array('questioner_id' => $fatwa->questioner_id))->row();
                            ?>
                            <tr>
                                <!--<td><?= $fatwa->question_id ?></td>-->
                                <td><?= $fatwa->question_no ?></td>
                                <td><?= $fatwa->fatwa_num ?></td>
                                <td><?= $fatwa->selsela_num ?></td>
                                <td><?= $fatwa->title ?></td>
                                <td><?= $this->db->get_where('ifta_books', array('book_id' => $fatwa->book_id))->row()->name ?></td>
                                <td><?= $this->db->get_where('ifta_books_chapters', array('chapter_id' => $fatwa->chapter_id))->row()->name ?></td>
                                <td><?= $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $fatwa->lesson_id))->row()->name ?></td>
                                <td><?php
                                    if ($fatwa->response_email == 1) {
                                        echo $questioner->name . '&#10003';
                                    } else {
                                        echo $questioner->name;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="<?php echo base_url(); ?>fatwa/print_fatwa/<?= $fatwa->answer_id ?>" target="blank">          
                                                    <i class="entypo-print"></i>    
                                                    <?php echo 'پرنٹ فتویٰ' ?>   
                                                </a>  
                                            </li>
                                            <li>     
                                                <a href="<?php echo base_url(); ?>fatwa/edit_fatwa/<?= $fatwa->answer_id ?>">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo 'تصحیح' ?>   
                                                </a>  
                                            </li>
                                            <li>     
                                                <a href="<?= base_url('fatwa/fatwa_detail/' . $fatwa->answer_id) ?>" >
                                                    <i class="entypo-newspaper"></i>
                                                    <?= 'تسریح' ?>
                                                </a> 
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" onclick="accept_answer('<?php echo base_url(); ?>fatwa/approve_fatwa/<?= $fatwa->answer_id ?>')">
                                                    <i class="entypo-check"></i>
                                                    <?php echo 'تصدیق  کریں' ?> 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" onclick="send_email_modal('<?php echo base_url(); ?>fatwa/send_answer_email/<?= $fatwa->answer_id ?>')">
                                                    <i class="entypo-mail"></i>
                                                    <?php echo 'ای میل مستفتی' ?> 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('fatwa/review_mujeeb_editing/' . $fatwa->question_id) ?>">  
                                                    <i class="fa fa-user"></i>
                                                    <?php echo 'دوبارہ تصحح کریں' ?> 
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