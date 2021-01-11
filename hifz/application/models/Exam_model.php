<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function get_exam_name_by_id($exam_id) {
        return $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
    }

    //Get students for exam roll
    function get_student_exam_roll() {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $check = $this->db->get_where('exam_roll_no', array('year' => $year))->result();
        if (!empty($check)) {
            return FALSE;
        } else {
            $this->db->select('*');
            $this->db->from('enroll');
            $this->db->where('year', $year);
            $this->db->where('status', 1);
            $this->db->order_by('branch_id', 'ASC');
            $this->db->order_by('teacher_id', 'ASC');
            $query = $this->db->get();
            $students = $query->result();

            $roll = $this->input->post('starting_num');
            foreach ($students as $data) {
                $roll_data['student_id'] = $data->student_id;
                $roll_data['roll_no'] = $roll;
                $roll_data['year'] = $year;
                $roll_data['talimi_saal'] = $talimi_saal;
                $this->db->insert('exam_roll_no', $roll_data);
                $roll++;
            }
            return TRUE;
        }
    }

    function get_branch_year_exam_roll($branch_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
//        $this->db->select('*');
//        $this->db->from('exam_roll_no');
//        $this->db->order_by('roll_no', 'ASC');
//        $this->db->where('');

        $this->db->select('student.* ,enroll.*,exam_roll_no.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('exam_roll_no', 'exam_roll_no.student_id = student.student_id', 'inner')->distinct();
        $this->db->order_by('exam_roll_no.roll_no', 'ASC');
        $this->db->where('enroll.branch_id', $branch_id);
        $this->db->where('enroll.year', $year);
        $this->db->where('enroll.status', 1);
        $this->db->where('exam_roll_no.year', $year);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_student_exam_mark($teacher_id, $exam_id, $year) {
        $this->db->select('mark.* ,mark.status as exam_status, student.*  ,exam_roll_no.roll_no');
        $this->db->from('mark');
        $this->db->join('student', 'student.student_id = mark.student_id', 'inner')->distinct();
        $this->db->join('exam_roll_no', 'exam_roll_no.student_id = mark.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = mark.student_id', 'inner')->distinct();
        $this->db->where(array(
            'mark.teacher_id' => $teacher_id,
            'mark.exam_id' => $exam_id,
            'mark.year' => $year,
            'enroll.status' => 1,
            'enroll.year'=>$year));
        $this->db->where('exam_roll_no.year', $year);
        $this->db->order_by("exam_roll_no.roll_no", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    function get_marks_student($exam_id, $teacher_id, $running_year) {
        $query = $this->db->get_where('mark', array(
                    'exam_id' => $exam_id,
                    'teacher_id' => $teacher_id,
                    'year' => $running_year
                ))->result_array();
        return $query;
    }

    /*     * * MAKING EXAM RESULT FOR SINGLE ONE * */

    function validate_exam_marks($teacher_id, $exam_id, $year) {
        $query = $this->db->get_where('mark', array('teacher_id' => $teacher_id, 'exam_id' => $exam_id, 'year' => $year));
        if ($query->num_rows() > 0) {
            $this->db->where('teacher_id', $teacher_id);
            $this->db->where('year', $year);
            $this->db->where('exam_id', $exam_id);
            $this->db->delete('mark_summery');
        }
        $SQL = "insert into mark_summery(student_id, teacher_id, exam_id, year,obt_marks,total_marks,class_position,status,grade)
                select student_id, teacher_id, exam_id, year , total,t_total, 
             CASE WHEN @l=total THEN @r ELSE @r:=@r + 1 END as rank, @l:=total, @row:=@row +1  
              FROM ( select student_id, teacher_id, exam_id, year,  sum(mark_obtained) as total, sum(mark_total) as t_total
              from mark where teacher_id=$teacher_id  and exam_tag = 1 and year='$year'  and exam_id=$exam_id  
             group by student_id order by total desc ) totals, (SELECT @r:=0, @row:=0, @l:=NULL) rank";

        $this->db->query($SQL);

        $percent = $this->db->get_where('mark_summery', array('exam_id' => $exam_id, 'teacher_id' => $teacher_id, 'year' => $year))->result_array();
        $percentag = 0;
        foreach ($percent as $perc) {
            $id = $perc['id'];
            $percentag = $perc['obt_marks'] / $perc['total_marks'] * 100;
            $percentag1 = round($percentag, 1);
            $this->db->where('id', $id);
            $this->db->update('mark_summery', array('percent' => $percentag1));
        }
    }

    function validate_combine_exam_marks($exam_id1, $exam_id2, $exam_id3, $exam_id4, $teacher_id, $year) {
        $this->db->delete('mark_summery_total', array(
            'exam_id_1' => $exam_id1,
            'exam_id_2' => $exam_id2,
            'exam_id_3' => $exam_id3,
            'teacher_id' => $teacher_id,
            'year' => $year
        ));

        $sql = "insert into mark_summery_total(student_id, teacher_id,exam_id_1,year,obt_marks,total_marks,position,status,grade)
                select student_id, teacher_id,exam_id,year , total,t_total, 
             CASE WHEN @l=total THEN @r ELSE @r:=@r + 1 END as rank, @l:=total, @row:=@row +1  
              FROM ( select student_id,teacher_id,exam_id,year,  sum(obt_marks) as total, sum(total_marks) as t_total
              from mark_summery where teacher_id=$teacher_id and year='$year'  and (exam_id = $exam_id1 or exam_id=$exam_id2 or exam_id=$exam_id3 or exam_id= $exam_id4)  
             group by student_id order by total desc ) totals, (SELECT @r:=0, @row:=0, @l:=NULL) rank";

        $this->db->query($sql);

        $que = "select * from mark_summery_total where exam_id_1= $exam_id1 or exam_id_1= $exam_id2 or exam_id_1=$exam_id3 or exam_id_1=$exam_id4 and teacher_id=$teacher_id and year=$year";
        $percent = $this->db->query($que)->result_array();


        $percentag = 0;
        foreach ($percent as $perc) {
            $id = $perc['mark_total_id'];
            $t_obt = $perc['obt_marks'];
            $t_total = $perc['total_marks'];
            $percentag = ($t_obt / $t_total * 100);

            $this->db->where('mark_total_id', $id);
            $this->db->update('mark_summery_total', array('percent' => $percentag, 'exam_id_1' => $exam_id1, 'exam_id_2' => $exam_id2, 'exam_id_3' => $exam_id3, 'exam_id_4' => $exam_id4));
        }
    }

    function get_students_signle_tabulation_sheet($teacher_id, $year) {
        $this->db->select('enroll.*, student.*, exam_roll_no.roll_no');
        $this->db->from('enroll');
        $this->db->join('student', 'student.student_id = enroll.student_id', 'inner')->distinct();
        $this->db->join('exam_roll_no', 'exam_roll_no.student_id = enroll.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.teacher_id' => $teacher_id,
            'enroll.status' => 1,
            'enroll.year' => $year));
        $this->db->where('exam_roll_no.year', $year);
        $this->db->order_by("exam_roll_no.roll_no", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_each_exam_sum($filed, $exam_id, $student_id, $year) {

        $this->db->select("sum($filed) AS total");
        $this->db->from('mark');
        $this->db->where('exam_id', $exam_id);
        $this->db->where('student_id', $student_id);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query->row()->total;
    }

    //// GET CURRENT EXAM MARKS WITH CURRETN SESSON ////
    function get_exam_marks($teacher_id, $exam_id, $student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $query = $this->db->get_where('mark', array(
            'teacher_id' => $teacher_id,
            'exam_id' => $exam_id,
            'student_id' => $student_id,
            'year' => $year
        ));

        return $query;
    }

    function get_highest_marks($exam_id, $teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->where('exam_id', $exam_id);
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('year', $year);
        $this->db->select_max('mark_obtained');

        $highest_marks = $this->db->get('mark')->result_array();

        foreach ($highest_marks as $row) {
            if ($row['mark_obtained'] > 0) {
                echo $row['mark_obtained'];
            } else {
                echo '0';
            }
        }
    }

}
