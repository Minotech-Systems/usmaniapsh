<style>

    li{text-align: right;}
</style>
<hr /><?php echo form_open(base_url() . 'index.php?exam/marks_selector'); ?>
<div class="row">	
    <div class="col-md-3 col-md-offset-2">		
        <div class="form-group">		
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('exam'); ?></label>			
            <select name="exam_id" class="form-control ">
                <option value=""><?php echo get_phrase('select_exam'); ?></option>
                <?php
                $exams = $this->db->get('exam')->result_array();
                foreach ($exams as $row):
                    ?>				
                    <option value="<?php echo $row['exam_id']; ?>"><?php echo $row['name']; ?></option>				
                <?php endforeach; ?>
            </select>		
        </div>	
    </div>	
    <div class="col-md-3">		
        <div class="form-group">		
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('teacher'); ?></label>			
            <select name="teacher_id" class="form-control " >
                <option value=""><?php echo get_phrase('select_teacher'); ?></option>
                <?php
                $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result_array();
                foreach ($teachers as $row):
                    ?>

                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name']  ?></option>

                <?php endforeach; ?>
            </select>		
        </div>	
    </div>		
    <div class="col-md-2" style="margin-top: 20px;">			
        <center>				
            <button type="submit" class="btn btn-info" ><?php echo get_phrase('manage_marks'); ?></button>			
        </center>		
    </div>	
</div>
<?php echo form_close(); ?>
