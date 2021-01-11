<div class="row">    
    <div class="col-md-12">                        
        <ul class="nav nav-tabs bordered">             
            <li class="active">                        
                <a href="#home" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo get_phrase('student_cards') ?></span> 
                </a>                       
            </li> 
            <li class="">                        
                <a href="#select" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo get_phrase('selected_student_cards') ?></span> 
                </a>                       
            </li> 
        </ul>
        <div class="tab-content">      
            <div class="tab-pane active" id="home">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/student_card_view/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_blank')); ?>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2" style="padding: 30px;">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('select'); ?></label>
                                <div class="col-sm-6">
                                    <select name="select_type" class="form-control "  >
                                        <option value="all" selected=""><?php echo get_phrase('select_all'); ?></option>
                                        <?php
                                        $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();

                                        foreach ($teachers as $row):
                                            ?>

                                            <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('submit'); ?></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="tab-pane" id="select">
                <div class="row">
                    <div class="col-md-4 col-sm-4" style="padding: 30px;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('select'); ?></label>
                            <div class="col-sm-8">
                                <select name="select_type_s" class="form-control "  onchange="get_students(this.value)">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <option value="all_students"><?php echo get_phrase('all_students'); ?></option>
                                    <?php
                                    $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();

                                    foreach ($teachers as $row):
                                        ?>

                                        <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" name="branch_id" id="branch_id" value="<?= $branch_id?>"> 
                                
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <form action="<?= base_url('index.php?admin/selected_student_card')?>" method="post" target="blank">
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div id="student_card_list"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-md-offset-3">
                                <input type="submit" value="<?= get_phrase('submit')?>" class="btn btn-success" style="margin-top: 20px; padding: 5px 30px;">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     function get_students(value) {
         var branch_id = document.getElementById("branch_id").value;
            $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_students/' + branch_id+'/'+value,
            success: function (response)
            {
                jQuery('#student_card_list').html(response);
            }
        });
      
    }
</script>
