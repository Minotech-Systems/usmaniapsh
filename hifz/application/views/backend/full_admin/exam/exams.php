<script src="assets/js/urdutextbox.js"></script>
<script>
    window.onload = myOnload;
    function myOnload(evt) {
        MakeTextBoxUrduEnabled(txtname);
    }

</script>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('exam_list'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_exam'); ?>
                </a></li>
        </ul>
        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" style="text-align: center">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td><?= get_phrase('name') ?></td>
                                    <td><?= get_phrase('date'); ?></td>
                                    <td><?= get_phrase('action') ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($exams as $data) {
                                    $exam_date = $this->db->get_where('exam_date', array('exam_id' => $data->exam_id, 'year' => $running_year))->row()->date;
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->name ?></td>
                                        <td><?php
                                            if (!empty($exam_date)) {
                                                echo date('d-m-Y', strtotime($exam_date));
                                            } else {
                                                echo '';
                                            }
                                            ?></td>
                                        <td>
                                            <a href="#" class="btn btn-success" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/exam/modal_edit_exam/<?php echo $data->exam_id; ?>');">
                                                <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane box " id="add">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?exam/exams/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="txtname" name="name" data-validate="required" placeholder="امتحان کا نام لکھیں" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_exam'); ?></button>
                        </div>
                    </div>
                    <?= form_close() ?>                
                </div> 
            </div>
        </div>
    </div>
</div>


