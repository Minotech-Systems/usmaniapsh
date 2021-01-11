<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class StudentFee_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    //Get Student Monthly Fee Record for all students
    function get_students_fee($teacher_id, $year) {
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.teacher_id' => $teacher_id,
            'enroll.year' => $year,
            'enroll.status' => 1,
            'student_fee.teacher_id' => $teacher_id,
            'student_fee.year' => $year
        ));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    //Get Student Monthly Fee Record for all students
    function get_students_fee_b($year) {
        $branch_id = $this->session->userdata('branch_id');
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.branch_id' => $branch_id,
            'enroll.year' => $year,
            'enroll.status' => 1,
            'student_fee.year' => $year
        ));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    //Get Student Transaction Fee Record for each Branch
    function branch_students_transaction($year, $branch_id) {
        $this->db->select('student.*,enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.year' => $year,
            'enroll.status' => 1,
            'enroll.branch_id' => $branch_id,
        ));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    function get_student_transaction_sum($student_id, $class_id, $year) {
        $this->db->select("sum(amount) AS amount");
        $this->db->from("student_transaction");
        $this->db->where('year', $year);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        return $query->row()->amount;
    }

    function sum_additional_transaction($month, $student_id, $teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select('amount , sum(amount) AS payment');
        $this->db->from('additional_student_fee');
        $this->db->where("month BETWEEN 1 AND $month");
        $this->db->where(array('student_id' => $student_id, 'teacher_id' => $teacher_id, 'year' => "$year"));

        $query = $this->db->get();

        return $query->row()->payment;
    }

    function sum_student_transaction($month, $student_id, $teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select('amount , sum(amount) AS payment');
        $this->db->from('student_transaction');
        $this->db->where("month BETWEEN 1 AND $month");
        $this->db->where(array('student_id' => $student_id, 'teacher_id' => $teacher_id, 'year' => "$year"));

        $query = $this->db->get();

        return $query->row()->payment;
    }

    function get_student_monthly_fee($student_id, $year) {
        return $this->db->get_where('student_fee', array('student_id' => $student_id, 'year' => $year))->row()->amount;
    }

    function get_student_feetobe_paid($student_id, $year) {
        return $this->db->get_where('student_fee', array('student_id' => $student_id, 'year' => $year))->row()->amount;
    }

    function get_month_name($month) {
        if ($month == 1)
            $m = 'شوال';
        else if ($month == 2)
            $m = 'ذوالقعدۃ';
        else if ($month == 3)
            $m = 'ذوالحجۃ';
        else if ($month == 4)
            $m = 'محرم';
        else if ($month == 5)
            $m = 'صفر';
        else if ($month == 6)
            $m = 'ر بیع الاول';
        else if ($month == 7)
            $m = 'ر بیع الثانی';
        else if ($month == 8)
            $m = 'جمادی الاول';
        else if ($month == 9)
            $m = 'جمادی الثانی';
        else if ($month == 10)
            $m = 'رجب';
        else if ($month == 11)
            $m = 'شعبان';
        else if ($month == 12)
            $m = 'رمضان';
        return $m;
    }

    function get_fee_record_all($teacher_id, $year) {
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.teacher_id' => $teacher_id,
            'enroll.year' => $year,
            'enroll.status' => 1,
            'student_fee.teacher_id' => $teacher_id,
            'student_fee.year' => $year));
        $this->db->where('student_fee.sponsor_id <', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    function get_fee_record_all_branch($year) {
        $branch_id = $this->session->userdata('branch_id');
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.branch_id' => $branch_id,
            'enroll.year' => $year,
            'enroll.status' => 1,
            'student_fee.branch_id' => $branch_id,
            'student_fee.year' => $year));
        $this->db->where('student_fee.sponsor_id <', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    //Get Student Monthly Fee Record for non kafalat students
    function get_fee_record($teacher_id, $year) {
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.teacher_id' => $teacher_id,
            'enroll.year' => $year,
            'enroll.status' => 1,
            'student_fee.teacher_id' => $teacher_id,
            'student_fee.year' => $year));
        $this->db->where('student_fee.sponsor_id <', 1);
        $this->db->where('student_fee.amount >', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    //Get Student Monthly Fee Record for non kafalat students
    function get_fee_record_branch($year) {
        $branch_id = $this->session->userdata('branch_id');
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.branch_id' => $branch_id,
            'enroll.year' => $year,
            'enroll.status' => 1,
            'student_fee.branch_id' => $branch_id,
            'student_fee.year' => $year));
        $this->db->where('student_fee.sponsor_id <', 1);
        $this->db->where('student_fee.amount >', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    //Get Student Rcord For Kafalat list of individual branch
    function branch_kafalat_list($branch_id, $year) {
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.year' => $year,
            'enroll.status' => 1,
            'enroll.branch_id' => $branch_id,
            'student_fee.year' => $year));
        $this->db->where('student_fee.sponsor_id >', 0);
        $this->db->order_by('enroll.teacher_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    //Get Student Rcord For Kafalat list of individual branch
    function branch_kafalat_list_t($teacher_id, $year) {
        $this->db->select('student.*, student_fee.*,enroll.*');
        $this->db->from('student');
        $this->db->join('student_fee', 'student_fee.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.year' => $year,
            'enroll.status' => 1,
            'enroll.teacher_id' => $teacher_id,
            'student_fee.year' => $year));
        $this->db->where('student_fee.sponsor_id >', 0);
        $this->db->order_by('enroll.teacher_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        }
    }

    function check_student_fee_month($student_id, $month, $year) {
        return $this->db->get_where('student_transaction', array('student_id' => $student_id, 'month' => $month, 'year' => $year))->row()->amount;
    }

    function get_student_transactions_sum($start_m, $end_m, $student_id, $teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select('sum(amount) AS amount');
        $this->db->from('student_transaction');
        $this->db->where('year', $year);
        $this->db->where('student_id', $student_id);
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where("month BETWEEN $start_m AND $end_m");

        $query = $this->db->get();

        return $query->row()->amount;
    }

    function get_student_transactions_sum_b($start_m, $end_m, $student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $branch_id = $this->session->userdata('branch_id');

        $this->db->select('sum(amount) AS amount');
        $this->db->from('student_transaction');
        $this->db->where('year', $year);
        $this->db->where('student_id', $student_id);
        $this->db->where('branch_id', $branch_id);
        $this->db->where("month BETWEEN $start_m AND $end_m");

        $query = $this->db->get();

        return $query->row()->amount;
    }

    function get_additional_transactions_sum($start_m, $end_m, $student_id, $teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select('sum(amount) AS amount');
        $this->db->from('additional_student_fee');
        $this->db->where('year', $year);
        $this->db->where('student_id', $student_id);
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where("month BETWEEN $start_m AND $end_m");

        $query = $this->db->get();

        return $query->row()->amount;
    }

    function get_additional_transactions_sum_b($start_m, $end_m, $student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $branch_id = $this->session->userdata('branch_id');

        $this->db->select('sum(amount) AS amount');
        $this->db->from('additional_student_fee');
        $this->db->where('year', $year);
        $this->db->where('student_id', $student_id);
        $this->db->where('branch_id', $branch_id);
        $this->db->where("month BETWEEN $start_m AND $end_m");

        $query = $this->db->get();

        return $query->row()->amount;
    }

    function get_transactions_sum($table, $where, $field = NULL, $months = NULL) {
        $this->db->select("sum($field) AS amount");
        $this->db->from("$table");
        if ($where) {
            $this->db->where($where);
        }
        if ($months) {
            $where_month = explode('-', $months);
            $this->db->where("month BETWEEN $where_month[0] AND $where_month[1]");
        }


        $query = $this->db->get();

        return $query->row()->amount;
    }

    function student_fee_according_intstiute($teacher_id, $year) {
        $branch_id = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->branch_id;
        $branch_monthly_fee = $this->db->get_where('monthly_fee', array('year' => $year, 'branch_id' => $branch_id))->row()->amount;

        $students = $this->studentfee_model->get_students_fee($teacher_id, $year);
        foreach ($students as $data) {
            if ($data['amount'] > $branch_monthly_fee) {
                $additional_fee = $data['amount'] - $branch_monthly_fee;
                $actual_fee = $data['amount'] - $additional_fee;
                $total_fee += $actual_fee;
            } else {
                $total_fee += $data['amount'];
            }
        }
        return $total_fee;
    }

    function student_fee_join($teacher_id, $year) {

        $students = $this->studentfee_model->get_students_fee($teacher_id, $year);
        foreach ($students as $data) {
            $total_fee += $data['amount'];
        }
        return $total_fee;
    }

    function get_class_student_transaction_sum($teacher_id, $year, $months) {
        $month = explode('-', $months);
        $students = $this->studentfee_model->get_students_fee($teacher_id, $year);
        foreach ($students as $data) {
            $student_fee = $this->studentfee_model->get_student_transactions_sum($month[0], end($month), $data['student_id'], $data['teacher_id']);
            $total_fee += $student_fee;
        }
        return $total_fee;
    }

    function student_aditional_transaction($teacher_id, $year, $months = NULL) {
        $this->db->select("sum(amount) AS amount");
        $this->db->from('enroll');
        $this->db->join('additional_student_fee', 'additional_student_fee.student_id = enroll.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.teacher_id' => $teacher_id,
            'enroll.status' => 1,
            'enroll.year' => $year,
            'enroll.employee_son' => 0,
            'additional_student_fee.year' => $year,
            'additional_student_fee.teacher_id' => $teacher_id
        ));
        if ($months) {
            $where_month = explode('-', $months);
            $this->db->where("additional_student_fee.month BETWEEN $where_month[0] AND $where_month[1]");
        }
        $query1 = $this->db->get();

        return $query1->row()->amount;
    }

    function check_student_tamleek($student_id, $month, $year) {
        return $this->db->get_where('scholorship_transaction', array('student_id' => $student_id, 'month' => $month, 'year' => $year))->row()->amount;
    }

}
