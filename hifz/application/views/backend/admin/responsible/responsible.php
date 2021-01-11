<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#responsible" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('responsible'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_responsible'); ?>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="responsible">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('serial_no') ?></th>
                            <th><?php echo get_phrase('name') ?></th>
                            <th><?php echo get_phrase('branch') ?></th>
                            <th><?php echo get_phrase('class') ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $data1) {
                            $where = array();
                            $where['teacher_id'] = $data1->teacher_id;
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?php
                                    $CI = & get_instance();
                                    $CI->load->model("admin_model");
                                    echo $CI->admin_model->get_any_field('teacher', $where, 'name');
                                    ?></td>
                                <td>
                                    <?php
                                    $where1 = array();
                                    $where1['branch_id'] = $data1->branch_id;
                                    echo $CI->admin_model->get_any_field('branches', $where1, 'name');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $where2 = array();
                                    $where2['class_id'] = $data1->class_id;
                                    echo $CI->admin_model->get_any_field('class', $where2, 'name');
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <li>     
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/responsible/modal_edit/<?= $data1->id ?>')">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/responsible/delete/<?= $data1->id; ?>');">   
                                                    <i class="entypo-trash"></i>     
                                                    <?php echo get_phrase('delete'); ?>        
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
            <div class="tab-pane box" id="add">
                <div class="row">
                    <form class="form-horizontal form-groups-bordered validate" action="<?= base_url('index.php?admin/responsible/create') ?>" method="post">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('teacher') ?></label>
                            <div class="col-sm-5">
                                <select name="teacher_id" class="form-control" >
                                    <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                                    <?php
                                    $teachers = $this->db->get_where('teacher', array('branch_id' => $this->session->userdata('branch_id')))->result_array();
                                    foreach ($teachers as $teach) {
                                        ?>
                                        <option value="<?php echo $teach['teacher_id']; ?>"><?php echo $teach['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('class') ?></label>
                            <div class="col-sm-5">
                                <select name="class_id" class="form-control" >
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                    <?php
                                    $classes = $this->db->get_where('class', array('branch_id' => $this->session->userdata('branch_id')))->result_array();
                                    foreach ($classes as $class) {
                                        ?>
                                        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
                                    <?php }; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-success"><?= ' مسئول شامل کریں' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>