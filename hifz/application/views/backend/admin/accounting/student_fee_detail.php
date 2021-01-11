<style>
    li{text-align:right;}
</style>
<?php echo form_open(base_url() . 'index.php?student_fee/student_fee_detail/'); ?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>
            <select name="teacher_id" class="form-control "  onchange="select_section(this.value)" id = "class_selection">
                <option value=""><?php echo get_phrase('select'); ?></option>
                <option value="all"><?php echo 'تمام' ?></option>
                <?php
                $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result_array();

                foreach ($teachers as $row):
                    ?>

                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name'] ?></option>

                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('session'); ?></label>
            <select name="year" class="form-control" >		  	
                <?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>		  	
                <option value=""><?php echo get_phrase('select_running_session'); ?></option>		  	
                <?php for ($i = 0; $i < 30; $i++): ?>		      	
                    <option value="<?php echo (1437 + $i); ?>-<?php echo (1437 + $i + 1); ?>"		        
                            <?php if ($running_year == (1437 + $i) . '-' . (1437 + $i + 1)) echo 'selected'; ?>>		          	
                        <?php echo (1437 + $i); ?>-<?php echo (1437 + $i + 1); ?>		      	
                    </option>		  
                <?php endfor; ?>		
            </select>
        </div>
    </div>

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>
<?php
if ( is_numeric($teacher_id) != '' && $year !='') {
    $branch = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
    $teacher_name = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
    $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
    ?>
    <div class="row">    
        <div class="col-md-12">                        
            <ul class="nav nav-tabs bordered">             
                <li class="active">                        
                    <a href="#home" data-toggle="tab">     
                        <span class="visible-xs"><i class="entypo-users"></i></span> 
                        <span class="hidden-xs"><?php echo $branch . ' / ' . $class_name; ?></span> 
                    </a>                       
                </li>  

            </ul>  

            <div class="tab-content">      
                <div class="tab-pane active" id="home">   
                    <table class="table table-bordered datatable" id="table_export"> 
                        <thead>       
                            <tr> 
                                <th width="80"><?php echo get_phrase('serial_no'); ?></th>
                                <th><?php echo get_phrase('name'); ?></th>
                                <th><?php echo get_phrase('parent'); ?></th>
                                <th><?php echo get_phrase('monthly_fee'); ?></th>
                                <th><?php echo get_phrase('scholorship/sponsorship') ?></th>
                                <th><?php echo get_phrase('action'); ?></th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $fee_data = $this->studentfee_model->get_students_fee($teacher_id, $year);
                            foreach ($fee_data as $data) {
                                $monthly_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id))->row()->amount;
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['father_name']; ?></td>
                                    <td><?php echo $data['amount'] ?></td>
                                    <td>
                                        <?php
                                        if ($data['sponsor_id'] != 0) {
                                            $sponsor_hlp = $this->db->get_where('sponsor_help', array('student_id' => $data['student_id'], 'year' => $running_year))->result_array();
                                            foreach ($sponsor_hlp as $help) {
                                                $sponsor = $this->db->get_where('students_sponsor', array('sponsor_id' => $help['sponsor_id']))->row()->name;
                                                echo $help['amount'] . ' / ' . $sponsor . ' ' . 'کفالت';
                                            }
                                        } else {
                                            echo ($monthly_fee - $data['amount']) . ' ' . ' وظیفہ';
                                        }
                                        ?>
                                    </td>
                                    <td>    
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <!-- STUDENT PROFILE LINK -->    
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_edit_studentfee/<?php echo $data['student_id']; ?>/<?= $year?>');">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_add_student_sponsor/<?php echo $data['student_id']; ?>');">       
                                                        <i class="entypo-user"></i>     
                                                        <?php echo get_phrase('add_sponsor'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_edit_student_sponsor/<?php echo $data['student_id']; ?>/<?php echo $data['sponsor_id'] ?>');">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit_sponsor'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?student_fee/delete_student_sponsor/<?php echo $data['student_id']; ?>');">   
                                                        <i class="entypo-trash"></i>     
                                                        <?php echo get_phrase('delete'); ?>        
                                                    </a>  
                                                </li>
                                            </ul>
                                        </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }else {
    $branch = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
    $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
    ?>
<div class="row">    
        <div class="col-md-12">                        
            <ul class="nav nav-tabs bordered">             
                <li class="active">                        
                    <a href="#home" data-toggle="tab">     
                        <span class="visible-xs"><i class="entypo-users"></i></span> 
                        <span class="hidden-xs" dir="ltr"><?php echo $branch ; ?></span> 
                    </a>                       
                </li>  

            </ul>  

            <div class="tab-content">      
                <div class="tab-pane active" id="home">   
                    <table class="table table-bordered datatable" id="table_export"> 
                        <thead>       
                            <tr> 
                                <th width="80"><?php echo get_phrase('serial_no'); ?></th>
                                <th><?php echo get_phrase('name'); ?></th>
                                <th><?php echo get_phrase('parent'); ?></th>
                                <th><?php echo get_phrase('monthly_fee'); ?></th>
                                <th><?php echo get_phrase('scholorship/sponsorship') ?></th>
                                <th><?php echo get_phrase('action'); ?></th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $fee_data = $this->studentfee_model->get_students_fee_b( $year);
                            foreach ($fee_data as $data) {
                                $monthly_fee = $this->db->get_where('monthly_fee', array('branch_id' => $branch_id))->row()->amount;
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['father_name']; ?></td>
                                    <td><?php echo $data['amount'] ?></td>
                                    <td>
                                        <?php
                                        if ($data['sponsor_id'] != 0) {
                                            $sponsor_hlp = $this->db->get_where('sponsor_help', array('student_id' => $data['student_id'], 'year' => $running_year))->result_array();
                                            foreach ($sponsor_hlp as $help) {
                                                $sponsor = $this->db->get_where('students_sponsor', array('sponsor_id' => $help['sponsor_id']))->row()->name;
                                                echo $help['amount'] . ' / ' . $sponsor . ' ' . 'کفالت';
                                            }
                                        } else {
                                            echo ($monthly_fee - $data['amount']) . ' ' . ' وظیفہ';
                                        }
                                        ?>
                                    </td>
                                    <td>    
                                        <div class="btn-group">      
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <?php echo get_phrase('action') ?> <span class="caret"></span>    
                                            </button>     
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <!-- STUDENT PROFILE LINK -->    
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_edit_studentfee/<?php echo $data['student_id']; ?>/<?= $year?>');">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_add_student_sponsor/<?php echo $data['student_id']; ?>');">       
                                                        <i class="entypo-user"></i>     
                                                        <?php echo get_phrase('add_sponsor'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/accounting/modal_edit_student_sponsor/<?php echo $data['student_id']; ?>/<?php echo $data['sponsor_id'] ?>');">       
                                                        <i class="entypo-pencil"></i>     
                                                        <?php echo get_phrase('edit_sponsor'); ?>   
                                                    </a>  
                                                </li>
                                                <li>  
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?student_fee/delete_student_sponsor/<?php echo $data['student_id']; ?>');">   
                                                        <i class="entypo-trash"></i>     
                                                        <?php echo get_phrase('delete'); ?>        
                                                    </a>  
                                                </li>
                                            </ul>
                                        </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<script type="text/javascript">

    function select_section(class_id) {

        if (class_id !== '') {
            $.ajax({
                url: '<?php echo base_url(); ?>index.php?admission/get_sections/' + class_id,
                success: function (response)
                {

                    jQuery('#section_holder').html(response);
                }
            });
        }
    }
</script>