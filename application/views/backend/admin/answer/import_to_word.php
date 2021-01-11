<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-6" style="padding: 30px;">
        <form method="post" action="<?= base_url('fatwa/import_to_word/create') ?>" >
            <div class="form-group">
                <div class="col-sm-6"> 
                    <select class="form-control" required="" name="book_id">
                        <option value=""><?= 'کتاب منتخب کریں' ?></option>
                        <?php
                        $ifta_books = $this->db->get('ifta_books')->result();
                        foreach ($ifta_books as $data) {
                            ?>
                            <option value="<?= $data->book_id ?>"><?= $data->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-file-word-o"></i>
                        <?= 'امپورٹ کریں' ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>