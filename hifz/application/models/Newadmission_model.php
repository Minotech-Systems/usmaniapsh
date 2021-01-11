<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newadmission_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_student_info($year, $branch_id) {
        $this->db->select('student.*, enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.year', $year);
        $this->db->where('enroll.branch_id', $branch_id);
        $this->db->where('enroll.status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_student_teacher_info($year, $branch_id, $teacher_id) {
        $this->db->select('student.*, enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.year', $year);
        $this->db->where('enroll.branch_id', $branch_id);
        $this->db->where('enroll.teacher_id', $teacher_id);
        $this->db->where('enroll.status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function getbranch_student_info($year, $branch_id) {
        $this->db->select('new_student.*, new_enroll.*');
        $this->db->from('new_student');
        $this->db->join('new_enroll', 'new_enroll.student_id = new_student.student_id', 'inner')->distinct();
        $this->db->where('new_enroll.year', $year);
        $this->db->where('new_enroll.branch_id', $branch_id);
        $this->db->where('new_enroll.status', 1);
        $this->db->order_by('test_marks', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_student_data($student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('new_student.*, new_enroll.*');
        $this->db->from('new_student');
        $this->db->join('new_enroll', 'new_enroll.student_id = new_student.student_id', 'inner')->distinct();
        $this->db->where('new_student.student_id', $student_id);
        $this->db->where('new_enroll.student_id', $student_id);
        $this->db->where('new_enroll.year', $year);
        $this->db->where('new_enroll.status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_student_transaction_sum($student_id, $year) {
        $this->db->select("sum(amount) AS amount");
        $this->db->from("new_student_transaction");
        $this->db->where('year', $year);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        return $query->row()->amount;
    }

    function get_enrolledstudent_info($year, $branch_id) {
        $this->db->select('new_student.*, new_enroll.*');
        $this->db->from('new_student');
        $this->db->join('new_enroll', 'new_enroll.student_id = new_student.student_id', 'inner')->distinct();
        $this->db->where('new_enroll.year', $year);
        $this->db->where('new_enroll.branch_id', $branch_id);
//        $this->db->where('new_enroll.enroll_status', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_select_std_info($year, $branch_id) {
        $this->db->select('new_student.*, new_enroll.*');
        $this->db->from('new_student');
        $this->db->join('new_enroll', 'new_enroll.student_id = new_student.student_id', 'inner')->distinct();
        $this->db->where('new_enroll.year', $year);
        $this->db->where('new_enroll.branch_id', $branch_id);
        $this->db->where('new_enroll.enroll_status', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_monthly_fee_sum($year, $branch_id) {
        $this->db->select("sum(amount) AS amount");
        $this->db->from("new_student_transaction");
        $this->db->where('year', $year);
        $this->db->where('branch_id', $branch_id);
        $query = $this->db->get();
        return $query->row()->amount;
    }

    function get_other_fee_sum($year, $branch_id) {
        $this->db->select("sum(amount) AS amount");
        $this->db->from("new_other_fee_transaction");
        $this->db->where('year', $year);
        $this->db->where('branch_id', $branch_id);
        $query = $this->db->get();
        return $query->row()->amount;
    }

    function dummy() {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select('new_student.*, new_enroll.*');
        $this->db->from('new_student');
        $this->db->join('new_enroll', 'new_enroll.student_id = new_student.student_id', 'inner')->distinct();
        $this->db->where('new_enroll.year', $year);
        $this->db->where('new_enroll.enroll_student_id >', 0);
        $query = $this->db->get()->result();

        foreach ($query as $data) {
            $image = $data->image;
            $imagePath = $this->crud_model->get_image_url('new_admission', $image);
            $newPath = "uploads/dummy/";
//            echo $newName = $newPath . $image;
//                copy($imagePath, $newName);
            $this->db->where('student_id', $data->enroll_student_id);
            $this->db->update('student', array('image' => $image));
        }

        echo 'done';
    }

}

?>