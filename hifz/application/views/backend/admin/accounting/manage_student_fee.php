<hr />
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('fee_list'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_fee'); ?>
                </a>
            </li>
            <li>
                <a href="#abbsent" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'غیر حل شدہ طلباء'; ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" >
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('branch'); ?></div></th> 
                            <th><div><?php echo get_phrase('montly_fee'); ?></div></th>
                            <th><?php echo get_phrase('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($monthly_fee as $fee) { ?>
                            <tr>
                                <td><?php echo $this->db->get_where('branches', array('branch_id' => $fee['branch_id']))->row()->name; ?></td>
                                <td><?php echo $fee['amount'] ?></td>
                                <td>
                                    <div class="btn-group">      
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                            <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                        </button>     
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                            <?php if ($login_user_branch == $fee['branch_id'] || $login_user_branch == 0) { ?>   
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_monthly_fee_edit/<?php echo $fee['monthly_fee_id']; ?>');">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit'); ?>   
                                                    </a>  
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content" style="border: 1px #cccccc double">
                    <br/>
                    <?php echo form_open(base_url() . 'index.php?student_fee/manage_student_fee/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('fee'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-5">
                                <select name="branch_id" class="form-control "  >
                                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                                    <?php
                                    $branches = $this->db->get_where('branches', array('branch_id' => $branch_id))->result_array();

                                    foreach ($branches as $row):
                                        ?>
                                        <option value="<?php echo $row['branch_id']; ?>"
                                                <?php if ($branch_id == $row['branch_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_fee'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?> 
                    <br/>
                </div>                
            </div>
            <!----CREATION FORM ENDS-->

            <div class="tab-pane box" id="abbsent" style="padding: 5px">
                <?php
                $students = $this->crud_model->get_student_data($this->session->userdata('branch_id'));
                ?>
                <form class="form-horizontal" method="post" action="<?= base_url('index.php?student_fee/individual_student_fee_add')?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('student'); ?></label>
                        <div class="col-sm-5">
                            <select name="student_id" class="form-control "  >
                                <option value=""><?php echo get_phrase('select_student'); ?></option>
                                <?php
                                foreach ($students as $row) {
                                    $fee_data = $this->db->get_where('student_fee', array('student_id' => $row->student_id, 'year' => $running_year))->row();
                                    if (empty($fee_data)) {
                                        ?>
                                        <option value="<?php echo $row->student_id; ?>"><?php echo $row->name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('amount'); ?></label>
                        <div class="col-sm-5">
                            <input type="number" name="amount" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-5 col-md-offset-3">
                            <button type="submit" class="btn btn-info"><?= 'فیس داخل کریں'?></button>
                        </div>
                        
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

