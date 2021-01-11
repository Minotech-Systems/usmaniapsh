<?php
$edit_data = $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $param2))->row();
$books = $this->db->get('ifta_books')->result();
$chapter = $this->db->get_where('ifta_books_chapters', array('chapter_id' => $edit_data->chapter_id))->row()->name;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_lesson'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'admin/update_book_lesson/' . $edit_data->lesson_id, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('book'); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="book_id" onchange="get_book_ch(this.value)">
                                <?php foreach ($books as $book) { ?>
                                    <option value="<?= $book->book_id ?>" <?php if ($book->book_id == $edit_data->book_id) echo 'selected'; ?>><?= $book->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('book'); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="chapter_id" id="chapters1">
                                <option value="<?= $edit_data->chapter_id; ?>"><?= $chapter ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?= $edit_data->name?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_lesson'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>





