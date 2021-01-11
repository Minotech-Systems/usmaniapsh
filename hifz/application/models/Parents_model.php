<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parents_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function create_exam_positions($teacher_id, $exam_id, $year) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $query = $this->db->get_where('mark', array('teacher_id' => $teacher_id, 'exam_id' => $exam_id, 'year' => $year));
        if ($query->num_rows() > 0) {
            $this->db->where('teacher_id', $teacher_id);
            $this->db->where('year', $year);
            $this->db->where('exam_id', $exam_id);
            $this->db->delete('parent_mark_summery');
        }
        $SQL = "insert into parent_mark_summery(student_id, teacher_id,exam_id,year,obt_marks,total_marks,class_position,status,grade)
                select student_id, teacher_id,exam_id,year , total,t_total, 
             CASE WHEN @l=total THEN @r ELSE @r:=@r + 1 END as rank, @l:=total, @row:=@row +1  
              FROM ( select student_id,teacher_id,exam_id,year,  sum(mark_obtained) as total, sum(mark_total) as t_total
              from mark where teacher_id=$teacher_id  and year='$year' and exam_tag = 1  and exam_id=$exam_id  
             group by student_id order by total desc ) totals, (SELECT @r:=0, @row:=0, @l:=NULL) rank";

        $this->db->query($SQL);

        $percent = $this->db->get_where('parent_mark_summery', array('exam_id' => $exam_id, 'teacher_id' => $teacher_id, 'year' => $year))->result_array();
        $percentag = 0;
        foreach ($percent as $perc) {
            $id = $perc['id'];
            $percentag = $perc['obt_marks'] / $perc['total_marks'] * 100;
            $this->db->where('id', $id);
            $this->db->update('parent_mark_summery', array('percent' => $percentag));
        }
    }

    function get_student_id($param1, $param2) {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        return $this->db->get_where('enroll', array('student_id' => $param2, 'year' => $running_year))->row()->$param1;
    }
    function get_student_exams() {
        return $exams = $this->db->get_where('exam', array('status'=>1))->result_array();
    }

}
