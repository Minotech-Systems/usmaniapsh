<hr />
<?php echo form_open(base_url() . 'index.php?exam/marks_selector'); ?>
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

                    <option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['name'] ?></option>

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


<hr />
<style>
    #absent{
        margin-right: 20px;
    }
</style>
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">	
        <div class="tile-stats tile-cyan">		
            <div class="icon"><i class="entypo-chart-bar" style="color:white !important"></i></div>	
            <h3 style="color: #fff;">
                <?php echo get_phrase('امتحانی نمبرات') . " : "; ?> <?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?></h3>
            <h4 style="color: #fff;">		
                <?php echo get_phrase('class') . " : "; ?> 
                <?php echo $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name; ?>  
            </h4>			
            <h3>
                <?= $this->crud_model->get_type_name_by_id('teacher', $teacher_id) ?>
            </h3>	
        </div>	
    </div>

    <div class="col-sm-4">

    </div>

</div>
<div class="row">	
    <div class="col-md-2">

    </div>	
    <div class="col-md-8">		
        <?php echo form_open(base_url() . 'index.php?exam/marks_update/' . $exam_id . '/' . $teacher_id); ?>			
        <table class="table table-bordered" align="center">			
            <thead>					

                <tr>				
                    <th>#</th>					
                    <th><?php echo get_phrase('exam_roll'); ?></th>	
                    <th colspan="2"><?php echo get_phrase('name'); ?></th>	
                    <th ><?php echo get_phrase('parent'); ?></th>	
                    <th width="25%"><?php echo get_phrase('marks_obtained'); ?></th>
                </tr>				
            </thead>	


            <tbody>		
                <?php
                $count = 1;
                $marks_of_students = $this->exam_model->get_student_exam_mark($teacher_id, $exam_id, $running_year);

                //$marks_of_students = $this->db->get_where('mark', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $running_year, 'subject_id' => $subject_id, 'exam_id' => $exam_id))->result_array();
                foreach ($marks_of_students as $row):
                    ?>					
                    <tr>
                        <td><?php echo $count++; ?></td>

                        <td>						
                            <?php echo $row['roll_no'] ?>	
                        </td>	
                        <td colspan="2">	
                            <?php echo $row['name'] ?>						
                        </td>
                        <td >	
                            <?php
                            echo $row['father_name'];
                            if ($row['exam_status'] == 0) {
                                echo '<span id="absent">' .'('. get_phrase('absent').')' . '</spna>';
                            }
                            ?>						
                        </td>						
                        <td>			
                            <input style="text-align: right;" type="text" class="form-control" name="marks_obtained_<?php echo $row['mark_id']; ?>"	
                                   value="<?php echo $row['mark_obtained']; ?>" dir="ltr">	
                        </td>
                    </tr>	
                    <?php
                    $totalmarks = $row['mark_total'];
                endforeach;
                ?>	
                <tr style="background-color:  antiquewhite">
                    <td colspan="4" class="text-center" > <b> کل نمبرات </b> </td>
                    <td colspan="3"> <input type="text" class="form-control" name="mark_total"value="<?php echo $totalmarks; ?>"> </td>
                </tr>
            </tbody>		
        </table>		
        <center>	
            <button type="submit" class="btn btn-success" id="submit_button">	
                <i class="entypo-check"></i> <?php echo get_phrase('save_changes'); ?>
            </button>		
        </center>	
        <?php echo form_close(); ?>	
    </div>
    <div class="col-md-2"></div>

</div>