<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $table1 = jQuery('#table-1');

        // Initialize DataTable
        $table1.DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
    });
    jQuery(document).ready(function ($) {
        var $table1 = jQuery('#table-2');

        // Initialize DataTable
        $table1.DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
    });

    jQuery(document).ready(function ($) {
        var $table1 = jQuery('#table-3');

        // Initialize DataTable
        $table1.DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
    });
</script>
<script src="<?= base_url() ?>assets/js/urdutextbox.js"></script>

<script>
    window.onload = myOnload;

    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtbookname);
        MakeTextBoxUrduEnabled(txtchapter);
        MakeTextBoxUrduEnabled(txtlesson);

    }

</script>
<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#book" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo 'کتب' .  ' /' . 'باب'; ?>
                </a>
            </li>
            <li>
                <a href="#lessons" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('lesson'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="book">
                <div class="row">      
                    <div class="col-md-6" style="border-left: 1px dashed;">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?= base_url('admin/add_book') ?>" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="txtbookname" name="book" placeholder="<?= 'کتاب نام کا اندراج کریں' ?>"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success"><?= 'اندراج کتاب' ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered datatable" id="table-1">
                                    <thead>
                                        <tr>
                                            <th><?= get_phrase('serial_no'); ?></th>
                                            <th><?= 'نام کتب' ?></th>
                                            <!--<th> <?= 'تشریح' ?></th>-->
                                            <th> <?= get_phrase('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($ifta_books as $book) {
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $book->name ?></td>
                                                <!--<td><?= $book->comment ?></td>-->
                                                <td>
                                                    <a href="#" class="btn btn-white" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/edit_book/<?= $book->book_id ?>')">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="#" class="btn btn-white" onclick="confirm_modal('<?php echo base_url(); ?>admin/delete_book/<?= $book->book_id ?>')">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>        

                    </div>     

                    <div class="col-md-6" >
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="<?= base_url('admin/add_book_chapter') ?>">
                                    <div class="form-group">
                                        <div class="col-sm-4"> 
                                            <select class="form-control" required="" name="book_id">
                                                <option value=""><?= 'کتاب منتخب کریں' ?></option>
                                                <?php foreach ($ifta_books as $data) { ?>
                                                    <option value="<?= $data->book_id ?>"><?= $data->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" required="" id="txtchapter" name="chapter" placeholder="<?= 'کتاب نام کا اندراج کریں' ?>"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-success"><?= 'باب کا اندراج کریں' ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered datatable" id="table-2">
                                    <thead>
                                        <tr>
                                            <th><?= get_phrase('serial_no'); ?></th>
                                            <th><?= 'نام کتب' ?></th>
                                            <th><?= 'باب' ?></th>
                                            <!--<th> <?= 'تشریح' ?></th>-->
                                            <th> <?= get_phrase('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($ifta_book_chapters as $chapter) {
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $this->db->get_where('ifta_books', array('book_id' => $chapter->book_id))->row()->name ?></td>
                                                <td><?= $chapter->name ?></td>
                                                <!--<td><?= $chapter->comment ?></td>-->
                                                <td>
                                                    <a href="#" class="btn btn-white" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/edit_chapter/<?= $chapter->chapter_id ?>')">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="#" class="btn btn-white" onclick="confirm_modal('<?php echo base_url(); ?>admin/delete_book_chapter/<?= $chapter->chapter_id ?>')">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
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
            <div class="tab-pane box " id="lessons">
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?= base_url('admin/add_book_lessons') ?>" method="post">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <select class="form-control"  name="lesson_book_id" onchange="get_book_chapters(this.value)">
                                        <option value=""><?= 'کتاب منتخب کریں' ?></option>
                                        <?php foreach ($ifta_books as $data) { ?>
                                            <option value="<?= $data->book_id ?>"><?= $data->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <select class="form-control"  name="chapters" id="chapters">
                                        <option value=""><?= 'باب منتخب کریں' ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="lesson" placeholder="<?= 'صف کا نام لکیھں۔۔۔' ?>" required="" id="txtlesson">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success"><?= 'اندراج صف' ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <!--.-->
                <div class="row">
                    <center>
                        <div class="col-md-8" style="text-align: center">
                            <table class="table table-bordered datatable" id="table-3" align="center">
                                <thead>
                                    <tr>
                                        <th width="100"><?= get_phrase('serial_no'); ?></th>
                                        <th> <?= get_phrase('lesson') ?></th>
                                        <th><?= 'باب' ?></th>
                                        <th><?= 'نام کتب' ?></th>
                                        <th> <?= get_phrase('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($ifta_books_lessons as $lessons) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $lessons->name ?></td>
                                            <td><?= $this->crud_model->get_column_name_by_id('ifta_books_chapters','chapter_id', $lessons->chapter_id); ?></td>
                                            <td><?= $this->crud_model->get_column_name_by_id('ifta_books','book_id', $lessons->book_id); ?></td>
                                            <td>
                                                <a href="#" class="btn btn-white" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modals/edit_lesson/<?= $lessons->lesson_id ?>')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="#" class="btn btn-white" onclick="confirm_modal('<?php echo base_url(); ?>admin/delete_lesson/<?= $lessons->lesson_id ?>')">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </center>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function get_book_chapters(book_id) {

        if (book_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_book_chapters/' + book_id,
                success: function (response)
                {

                    jQuery('#chapters').html(response);
                }
            });
        }
    }
</script>
<script type="text/javascript">
    function get_book_ch(book_id) {
        if (book_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_book_chapters/' + book_id,
                success: function (response)
                {

                    jQuery('#chapters1').html(response);
                }
            });
        }
    }
</script>