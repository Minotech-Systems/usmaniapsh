<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: Ejaz Sunny
 * 	date		: 1st jan, 2019
 * 	iTkoor School managment system
 * 	http://itkoor.com
 * 	imsunny37@gmail.com
 */

class Exam extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('exam_model');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    function exams($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?exam/exams/', 'refresh');
        }

        if ($param1 == 'do_update') {
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
            $this->db->where('exam_id', $param2);
            $this->db->update('exam', array('name' => $this->input->post('name')));
            $check_date = $this->db->get_where('exam_date', array('exam_id' => $param2, 'year' => $year))->result();
            if (!empty($check_date)) {
                $date = date('Y-m-d', strtotime($this->input->post('date')));
                $this->db->where('exam_id', $param2);
                $this->db->where('year', $year);
                $this->db->update('exam_date', array('date' => $date, 'signature' => $this->input->post('sign')));
            } else {
                $date_data['exam_id'] = $param2;
                $date_data['year'] = $year;
                $date_data['signature'] = $this->input->post('sign');
                $date_data['talimi_saal'] = $talimi_saal;
                $date_data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
                $this->db->insert('exam_date', $date_data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?exam/exams/', 'refresh');
        }
        $page_data['exams'] = $this->crud_model->get_table_data1('exam');
        $page_data['page_name'] = 'exam/exams';
        $page_data['page_title'] = get_phrase('exams');
        $this->load->view('backend/index', $page_data);
    }

    //Student Exam Roll Numbers

    function exam_roll($param1, $param2) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $result = $this->exam_model->get_student_exam_roll();
            if ($result == TRUE) {
                $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
                redirect(base_url() . 'index.php?exam/exam_roll/', 'refresh');
            } else {
                $this->session->set_flashdata('error_message', 'اسی سال کلئے امتحانی رولنمبر پہلے سے موجود ہیں۔۔۔');
                redirect(base_url() . 'index.php?exam/exam_roll/', 'refresh');
            }
        }
        if ($param1 == 'edit_exam_roll') {
            $class_id = $this->input->post('class_id');
            $student_id = $this->input->post('student_id');
            $roll_no = $this->input->post('roll_no');
            echo $class_id . ' - ' . $student_id . ' - ' . $roll_no;
            die;
        }
        if ($param1 == 'delete') {
            $this->db->where('year', $param2);
            $this->db->delete('exam_roll_no');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?exam/exam_roll/', 'refresh');
        }
        $page_data['page_name'] = 'exam/exam_roll';
        $page_data['page_title'] = get_phrase('exam_roll');
        $this->load->view('backend/index', $page_data);
    }

    function exam_roll_report($param1) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['branch_id'] = $param1;
        $page_data['page_name'] = 'exam/exam_roll_report';
        $page_data['page_title'] = get_phrase('exam_roll_report');
        $this->load->view('backend/index', $page_data);
    }

    function exam_roll_report_print($param1) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['branch_id'] = $param1;
        $this->load->view('backend/full_admin/exam/exam_roll_report_print', $page_data);
    }

    //Get Students data for selection with parent name

    function get_class_students_parents($class_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $students = $this->db->get_where('enroll', array(
                    'class_id' => $class_id, 'year' => $year, 'status' => 1
                ))->result_array();
        echo '<option value="' . '' . '">' . get_phrase('-select-') . '</option>';
        foreach ($students as $row) {
            $name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
            $f_name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->father_name;

            echo '<option value="' . $row['student_id'] . '">' . $name . ' / ' . $f_name . '</option>';
        }
    }

    //Check student exam roll no if present or not

    function check_student_exam_roll($student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $exam_roll = $this->db->get_where('exam_roll_no', array('student_id' => $student_id, 'year' => $year))->result();
        if (!empty($exam_roll)) {
            $roll = $this->db->get_where('exam_roll_no', array('student_id' => $student_id, 'year' => $year))->row()->roll_no;
            echo 'اس طالب علم کیلئے امتحانی رولنمر' . ' : ' . $roll . '  ' . 'پہلئے سے موجود ہے۔۔۔';
        }
    }

    function check_exam_roll($roll_no) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $exam_roll = $this->db->get_where('exam_roll_no', array('roll_no' => $roll_no, 'year' => $year))->result();
        if (!empty($exam_roll)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    /*     * ****Maage Exam Marks**** */

    function exam_marks() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['user_level'] = $this->session->userdata('user_level');
        $page_data['page_name'] = 'exam/exam_marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['exam_id'] = $this->input->post('exam_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $query = $this->db->get_where('mark', array(
            'exam_id' => $data['exam_id'],
            'teacher_id' => $data['teacher_id'],
            'year' => $data['year']
        ));
        if ($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll', array(
                        'teacher_id' => $data['teacher_id'], 'year' => $data['year'], "status" => 1
                    ))->result_array();
            foreach ($students as $row) {
                $data['student_id'] = $row['student_id'];
                $data['branch_id'] = $row['branch_id'];
                $this->db->insert('mark', $data);
            }
        } else {
            $students = $this->db->get_where('enroll', array(
                        'teacher_id' => $data['teacher_id'], 'year' => $data['year'], "status" => 1
                    ))->result_array();
            foreach ($students as $row) {
                $NewStdquery = $this->db->get_where('mark', array(
                    'exam_id' => $data['exam_id'],
                    'teacher_id' => $data['teacher_id'],
                    'year' => $data['year'],
                    'student_id' => $row['student_id']
                ));
                if ($NewStdquery->num_rows() < 1) {
                    $data['student_id'] = $row['student_id'];
                    $data['branch_id'] = $row['branch_id'];
                    $this->db->insert('mark', $data);
                }
            }
        }
        $exam_data = array($data['teacher_id'], $data['exam_id']);
        $this->session->set_userdata('exam_data', $exam_data);

        redirect(base_url() . 'index.php?exam/marks_manage_view/', 'refresh');
    }

    function marks_manage_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $exam_data = $this->session->userdata('exam_data');

        $page_data['user_level'] = $this->session->userdata('user_level');
        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['teacher_id'] = $exam_data[0];
        $page_data['exam_id'] = $exam_data[1];
        $page_data['page_name'] = 'exam/marks_manage_view';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_update($exam_id = '', $teacher_id = '') {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->exam_model->get_marks_student($exam_id, $teacher_id, $running_year);
        foreach ($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_' . $row['mark_id']);
            $this->db->where('mark_id', $row['mark_id']);
            $mark_total = $this->input->post('mark_total');
            $this->db->update('mark', array('mark_obtained' => $obtained_marks, 'mark_total' => $mark_total));

            if ($obtained_marks == -1) {
                $attendance_data = $this->db->get_where('mark', array('mark_id' => $row['mark_id']))->row();
                $student_id = $attendance_data->student_id;

                $this->db->where('student_id', $student_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('year', $running_year);
                $this->db->update('mark', array('status' => 0, 'mark_obtained' => 0));
            } else if ($obtained_marks == -2) {
                $attendance_data = $this->db->get_where('mark', array('mark_id' => $row['mark_id']))->row();
                $student_id = $attendance_data->student_id;

                $this->db->where('student_id', $student_id);
                $this->db->where('exam_id', $exam_id);
                $this->db->where('year', $running_year);
                $this->db->update('mark', array('status' => 1, 'mark_obtained' => 0));
            }
        }
        $this->session->set_flashdata('flash_message', get_phrase('marks_updated'));
        redirect(base_url() . 'index.php?exam/marks_manage_view/', 'refresh');
    }

    //======================================================================
    // Exams Tabulation Sheets Start
    //======================================================================

    function single_tabulation_sheet($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['year'] = $this->input->post('session');

            $teacher_id = $this->input->post('teacher_id');
            $exam_id = $this->input->post('exam_id');
            $year = $this->input->post('session');
            // Making Positions and result for exam
            $this->exam_model->validate_exam_marks($teacher_id, $exam_id, $year);
            //Save vraiables in session data for print
            $single_tab_data = array($teacher_id, $exam_id, $year);
            $this->session->set_userdata('single_tabulation_data', $single_tab_data);
        } else {
            $page_data['teacher_id'] = '';
            $page_data['exam_id'] = '';
            $page_data['year'] = '';
        }

        $page_data['page_name'] = 'exam/single_tabulation_sheet';
        $page_data['page_title'] = get_phrase('single_tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    }

    function tabulation_sheet_print_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $single_tabulation_data = $this->session->userdata('single_tabulation_data');
        $page_data['teacher_id'] = $single_tabulation_data[0];
        $page_data['exam_id'] = $single_tabulation_data[1];
        $page_data['year'] = $single_tabulation_data[2];
        $this->load->view('backend/admin/exam/tabulation_sheet_print_view', $page_data);
    }

    function combine_tabulation_sheet($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $exams = $this->input->post('exam_id');
            $teacher_id = $this->input->post('teacher_id');
            $year = $this->input->post('year');
            $exam_id1 = $exams[0];
            $exam_id2 = $exams[1];
            $exam_id3 = $exams[2];
            $exam_id4 = $exams[3];

            $page_data['teacher_id'] = $teacher_id;
            $page_data['exams'] = $exams;
            $page_data['year'] = $year;
            $page_data['exam_id1'] = $exam_id1;
            $page_data['exam_id2'] = $exam_id2;
            $page_data['exam_id3'] = $exam_id3;
            $page_data['exam_id4'] = $exam_id4;

            $array_size = sizeof($exams);
            if ($array_size < 4 || $array_size > 4) {
                $this->session->set_flashdata('error_message', get_phrase('آپ صرف چار امتحانات کلیے نتیجہ فارم بنا سکتے ہیں۔۔۔'));
                redirect(base_url() . 'index.php?exam/combine_tabulation_sheet/', 'refresh');
            } else {

                foreach ($exams as $exam) {
                    $this->exam_model->validate_exam_marks($teacher_id, $exam, $year);
                }
                $this->exam_model->validate_combine_exam_marks($exam_id1, $exam_id2, $exam_id3, $exam_id4, $teacher_id, $year);
            }

            $combine_tab_data = array($exam_id1, $exam_id2, $exam_id3, $exam_id4, $teacher_id, $year);
            $this->session->set_userdata('combine_tabulation_data', $combine_tab_data);
        }

        $page_data['page_name'] = 'exam/combine_tabulation_sheet';
        $page_data['page_title'] = get_phrase('combine_tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    }

    function combine_tabulation_sheet_print() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $combine_tab_data = $this->session->userdata('combine_tabulation_data');
        $page_data['exam_id1'] = $combine_tab_data[0];
        $page_data['exam_id2'] = $combine_tab_data[1];
        $page_data['exam_id3'] = $combine_tab_data[2];
        $page_data['exam_id4'] = $combine_tab_data[3];
        $page_data['teacher_id'] = $combine_tab_data[4];
        $page_data['year'] = $combine_tab_data[5];

        $page_data['login_user_branch'] = $this->session->userdata('login_user_branch');
        $this->load->view('backend/admin/exam/combine_tabulation_sheet_print', $page_data);
    }

    function get_result_grade($param1) {
        if ($param1 < 50) {
            $remarks = 'راسب';
        } else {

            switch ($param1) {
                case $param1 >= 80:
                    $remarks = 'ممتاز';
                    break;
                case $param1 >= 70 && $param1 <= 79.99:
                    $remarks = 'جید جدا';
                    break;
                case $param1 >= 60 && $param1 <= 69.99:
                    $remarks = 'جید';
                    break;

                case $param1 >= 50 && $param1 <= 59.99:
                    $remarks = 'مقبول';
                    break;
            }
        }

        return $remarks;
    }

    function get_position($position) {
        if ($position > 3) {

            $post_posi = 'th';
        } else {
            switch ($position) {
                case $position == 1:

                    $post_posi = 'st';
                    break;

                case $position == 2:
                    $post_posi = 'nd';
                    break;

                case $position == 3:
                    $post_posi = 'rd';
                    break;
            }
        }
        return $post_posi;
    }

    function get_students($teacher_id) {
        $students = $this->crud_model->get_student_teacher_data($teacher_id);
        echo '<option value=""> طالب علم منتخب کریں</option>';
        foreach ($students as $row) {
            echo '<option value="' . $row->student_id . '">' . $row->name . ' / ' . $row->father_name . '</option>';
        }
    }

    function get_student_daily_report($student_id, $date) {
        $data['student_id'] = $student_id;
        $data['date'] = $date;
        $this->load->view('backend/admin/reports/get_student_daily_report', $data);
    }

    function student_daily_report_update() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $data['student_id'] = $this->input->post('student_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['lesson_a'] = $this->input->post('lession_a');
        $data['lesson_a_quantity'] = $this->input->post('lession_a_quantity');
        $data['lesson_a_state'] = $this->input->post('lession_a_state');
        $data['lesson_b'] = $this->input->post('lession_b');
        $data['lesson_b_quantity'] = $this->input->post('lession_b_quantity');
        $data['lesson_b_state'] = $this->input->post('lession_b_state');
        $data['lesson_c'] = $this->input->post('lession_c');
        $data['lesson_c_quantity'] = $this->input->post('lession_c_quantity');
        $data['lesson_c_state'] = $this->input->post('lession_c_state');
        $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
        $data['year'] = $running_year;
        $data['talimi_saal'] = $talimi_saal;
        $data['branch_id'] = $this->session->userdata('branch_id');
//        print_r($data);
        $query = $this->db->get_where('daily_student_report', array('student_id' => $data['student_id'], 'date' => $data['date']))->result();
        if (!empty($query)) {
            $this->db->where('student_id', $data['student_id']);
            $this->db->where('date', $data['date']);
            $this->db->update('daily_student_report', $data);
            echo 'done';
        } else {
            $this->db->insert('daily_student_report', $data);
            echo 'done';
        }
    }

    //======================================================================
    // Exams Tabulation Sheets End
    //======================================================================

    function exam_subject_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('teacher_id') != '' && $this->input->post('year') != '') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['year'] = $this->input->post('year');
            $page_data['exams'] = $this->db->get('exam')->result();
        }
        $page_data['page_name'] = 'reports/exam_subject_report';
        $page_data['page_title'] = get_phrase('exam_subject_report');
        $this->load->view('backend/index', $page_data);
    }

    function daily_student_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

//        $otherdb = $this->load->database('otherdb', TRUE);
//        $page_data['other_teacher'] = $otherdb->get('staff')->result();
//        
        $page_data['page_name'] = 'reports/daily_student_report';
        $page_data['page_title'] = get_phrase('daily_student_report');
        $this->load->view('backend/index', $page_data);
    }

    function load_daily_report_view($param1, $param2, $param3) {
        $data['student_id'] = $param1;
        $data['teacher_id'] = $param2;
        $data['month'] = $param3;
        $this->load->view('backend/admin/reports/_daily_report', $data);
    }
    function load_daily_report_class_view($param1, $param2) {
        $data['teacher_id'] = $param1;
        $data['month'] = $param2;
        $this->load->view('backend/admin/reports/_daily_report_class', $data);
    }

    function print_daily_report($param1, $param2, $param3) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['teacher_id'] = $param1;
        $data['student_id'] = $param2;
        $data['month'] = $param3;
        $this->load->view('backend/admin/reports/print_daily_report', $data);
    }
    function print_daily_class_report($param1, $param2) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['teacher_id'] = $param1;
        $data['month'] = $param2;
        $this->load->view('backend/admin/reports/print_daily_class_report', $data);
    }

}
