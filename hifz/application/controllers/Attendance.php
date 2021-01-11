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

class Attendance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    //======================================================================
    // Students daily attendance  
    //======================================================================
    function manage_attendance() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/manage_attendance';
        $page_data['page_title'] = get_phrase('manage_attendance');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_selector() {
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['year'] = $this->input->post('year');
        $data['timestamp'] = date('Y-m-d', strtotime($this->input->post('timestamp')));
        $data['branch_id'] = $this->session->userdata('branch_id');
        $query = $this->db->get_where('attendance', array(
            'teacher_id' => $data['teacher_id'],
            'branch_id' => $data['branch_id'],
            'year' => $data['year'],
            'timestamp' => $data['timestamp']
        ));
        if ($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll', array(
                        'teacher_id' => $data['teacher_id'], 'year' => $data['year'], 'status' => 1))->result_array();

            foreach ($students as $row) {
                $attn_data['teacher_id'] = $data['teacher_id'];
                $attn_data['year'] = $data['year'];
                $attn_data['timestamp'] = $data['timestamp'];
                $attn_data['branch_id'] = $data['branch_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance', $attn_data);
            }
        }
        $atten_data = array($data['teacher_id'], $data['branch_id'], $data['timestamp']);
        $this->session->set_userdata('atten_data', $atten_data);
        redirect(base_url() . 'index.php?attendance/attendance_view/', 'refresh');
    }

    function attendance_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $atten_data = $this->session->userdata('atten_data');
        $teacher_id = $atten_data[0];
        $branch_id = $atten_data[1];
        $timestamp = $atten_data[2];

        $teacher_name = $this->db->get_where('teacher', array(
                    'teacher_id' => $teacher_id
                ))->row()->name;
        $page_data['teacher_id'] = $teacher_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['teacher_name'] = $teacher_name;
        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/attendance_view';
        $page_data['page_title'] = get_phrase('attendance') . ' ' . $teacher_name;
        $this->load->view('backend/index', $page_data);
    }

    function attendance_update() {
        $atten_data = $this->session->userdata('atten_data');
        $teacher_id = $atten_data[0];
        $branch_id = $atten_data[1];
        $timestamp = $atten_data[2];

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance', array(
                    'teacher_id' => $teacher_id, 'year' => $running_year, 'timestamp' => $timestamp
                ))->result_array();
        $month = date("m", strtotime($timestamp));

        foreach ($attendance_of_students as $row) {
            $student_id = $row['student_id'];
            $attendance_status = $this->input->post('status_' . $row['attendance_id']);
            $this->db->where('attendance_id', $row['attendance_id']);
            $this->db->update('attendance', array('status' => $attendance_status));

            $present = $this->getattendancevalue("status ", 1, $student_id, $running_year, $month, $teacher_id);
            $absent = $this->getattendancevalue("status ", 2, $student_id, $running_year, $month, $teacher_id);
            $leave = $this->getattendancevalue("status ", 3, $student_id, $running_year, $month, $teacher_id);

            // send absent student message 
            if ($attendance_status == 2) {
                //absend message heree
            }
            // count month absents , leave and presence of student
            $query = $this->db->get_where('attendance_count', array(
                'teacher_id' => $teacher_id,
                'student_id' => $student_id,
                'branch_id' => $branch_id,
                'year' => $running_year,
                'month' => $month,
            ));
            if ($query->num_rows() < 1) {
                $this->db->insert('attendance_count', array(
                    'teacher_id' => $teacher_id,
                    'student_id' => $student_id,
                    'branch_id' => $branch_id,
                    'year' => $running_year,
                    'month' => $month,
                    'total_atd' => (int) $present,
                    'total_absent' => (int) $absent,
                    'total_leave' => (int) $leave
                ));
            } else {
                $this->db->where('attendance_count_id', $query->row()->attendance_count_id);
                $this->db->update('attendance_count', array(
                    'total_atd' => (int) $present,
                    'total_absent' => (int) $absent,
                    'total_leave' => (int) $leave
                ));
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('attendance_updated'));
        redirect(base_url() . 'index.php?attendance/attendance_view/', 'refresh');
    }

    function getattendancevalue($status, $status_value, $student_id, $year, $month, $teacher_id) {
        $query = $this->db->query("SELECT   COUNT( $status ) AS totalCounnt 
                FROM attendance  WHERE student_id =$student_id  AND teacher_id=$teacher_id 
                AND $status =$status_value AND year='$year' AND  MONTH(timestamp)=$month ");

        return ($query->num_rows() > 0) ? $query->row()->totalCounnt : 0;
    }

    //Attendance Report monthly
    function attendance_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['month'] = date('m');
        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/attendance_report';
        $page_data['page_title'] = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report_selector() {
        if ($this->input->post('teacher_id') == '' || $this->input->post('month') == '') {
            $this->session->set_flashdata('error_message', get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(base_url() . 'index.php?attendance/attendance_report', 'refresh');
        }
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['month'] = $this->input->post('month');
        $data['year'] = $this->input->post('year');
        $att_report_data = array($data['teacher_id'], $data['month'], $data['year']);
        $this->session->set_userdata('att_report_data', $att_report_data);


        redirect(base_url() . 'index.php?attendance/attendance_report_view/', 'refresh');
    }

    function attendance_report_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $att_report_data = $this->session->userdata('att_report_data');
        $teacher_id = $att_report_data[0];
        $month = $att_report_data[1];
        $year = $att_report_data[2];

        $teacher_name = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
        $page_data['teacher_id'] = $teacher_id;
        $page_data['month'] = $month;
        $page_data['s_year'] = $year;
        $page_data['teacher_name'] = $teacher_name;
        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/attendance_report_view';
        $page_data['page_title'] = get_phrase('attendance_report') . ' / ' . $teacher_name;
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report_print_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $att_report_data = $this->session->userdata('att_report_data');
        $page_data['teacher_id'] = $att_report_data[0];
        $page_data['month'] = $att_report_data[1];
        $page_data['s_year'] = $att_report_data[2];

        $this->load->view('backend/admin/attendance/attendance_report_print_view', $page_data);
    }

    //--------------------------------------------------------
    // Students Friday Attendance     <----START---->
    //----------------------------------------------------------

    function friday_attendance() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/friday_attendance';
        $page_data['page_title'] = get_phrase('friday_attendance');
        $this->load->view('backend/index', $page_data);
    }

    function friday_attendance_selector() {
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['year'] = $this->input->post('year');
        $data['timestamp'] = date('Y-m-d', strtotime($this->input->post('timestamp')));
        $get_name = date('l', strtotime($data['timestamp'])); //get week day
        $day_name = substr($get_name, 0, 3);  // Trim day name to 3 chars

        if ($day_name == 'Fri') {
            $query = $this->db->get_where('friday_attendance', array(
                'teacher_id' => $data['teacher_id'],
                'year' => $data['year'],
                'timestamp' => $data['timestamp']));

            if ($query->num_rows() < 1) {
                $students = $this->db->get_where('enroll', array(
                            'teacher_id' => $data['teacher_id'], 'year' => $data['year'], 'status' => 1))->result_array();

                foreach ($students as $row) {
                    $attn_data['teacher_id'] = $data['teacher_id'];
                    $attn_data['year'] = $data['year'];
                    $attn_data['timestamp'] = $data['timestamp'];
                    $attn_data['branch_id'] = $row['branch_id'];
                    $attn_data['student_id'] = $row['student_id'];
                    $this->db->insert('friday_attendance', $attn_data);
                }
            }

            $friday_atten_data = array($data['teacher_id'], $data['timestamp']);
            $this->session->set_userdata('friday_atten_data', $friday_atten_data);
            redirect(base_url() . 'index.php?attendance/friday_attendance_view/', 'refresh');
        } else {

            $this->session->set_flashdata('error_message', 'منتخب کیا ہوا دن جمعہ نہیں ہے۔۔۔');
            redirect(base_url() . 'index.php?attendance/friday_attendance/', 'refresh');
        }
    }

    function friday_attendance_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        $friday_atten_data = $this->session->userdata('friday_atten_data');
        $teacher_id = $friday_atten_data[0];
        $timestamp = $friday_atten_data[1];

        $teacher_name = $this->crud_model->get_branch_teachers($teacher_id);
        $page_data['teacher_id'] = $teacher_id;
        $page_data['teacher_name'] = $teacher_name;
        $page_data['timestamp'] = $timestamp;
        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/friday_attendance_view';
        $page_data['page_title'] = get_phrase('friday_attendance') . ' ' . $teacher_name;
        $this->load->view('backend/index', $page_data);
    }

    function friday_attendance_update() {
        $friday_atten_data = $this->session->userdata('friday_atten_data');
        $teacher_id = $friday_atten_data[0];
        $timestamp = $friday_atten_data[1];

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $attendance_of_students = $this->db->get_where('friday_attendance', array(
                    'teacher_id' => $teacher_id, 'year' => $running_year, 'timestamp' => $timestamp
                ))->result_array();
        $month = date("m", strtotime($timestamp));

        foreach ($attendance_of_students as $row) {
            $student_id = $row['student_id'];
            $attendance_status = $this->input->post('status_' . $row['friday_attendance_id']);
            $this->db->where('friday_attendance_id', $row['friday_attendance_id']);
            $this->db->update('friday_attendance', array('status' => $attendance_status));

            $present = $this->get_friday_attendance("status ", 1, $student_id, $running_year, $month, $teacher_id);
            $absent = $this->get_friday_attendance("status ", 2, $student_id, $running_year, $month, $teacher_id);
            $leave = $this->get_friday_attendance("status ", 3, $student_id, $running_year, $month, $teacher_id);

            // send absent student message 
            if ($attendance_status == 2) {
                //absend message heree
            }
            // count month absents , leave and presence of student
            $query = $this->db->get_where('friday_attendance_count', array(
                'teacher_id' => $teacher_id,
                'student_id' => $student_id,
                'year' => $running_year,
                'month' => $month,
            ));
            if ($query->num_rows() < 1) {
                $this->db->insert('friday_attendance_count', array(
                    'teacher_id' => $teacher_id,
                    'student_id' => $student_id,
                    'year' => $running_year,
                    'branch_id' => $row['branch_id'],
                    'month' => $month,
                    'total_atd' => (int) $present,
                    'total_absent' => (int) $absent,
                    'total_leave' => (int) $leave
                ));
            } else {
                $this->db->where('friday_attendance_count_id', $query->row()->friday_attendance_count_id);
                $this->db->update('friday_attendance_count', array(
                    'total_atd' => (int) $present,
                    'total_absent' => (int) $absent,
                    'total_leave' => (int) $leave
                ));
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('attendance_updated'));
        redirect(base_url() . 'index.php?attendance/friday_attendance_view/', 'refresh');
    }

    /*     * ***Friday Attendance Reports***** */

    function friday_attendance_report() {
        $page_data['month'] = date('m');
        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'attendance/friday_attendance_report';
        $page_data['page_title'] = get_phrase('friday_attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function friday_attendance_report_selector() {
        if ($this->input->post('teacher_id') == '' || $this->input->post('month') == '') {
            $this->session->set_flashdata('error_message', get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(base_url() . 'index.php?attendance/friday_attendance_report', 'refresh');
        }
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['month'] = $this->input->post('month');
        $data['s_year'] = $this->input->post('year');

        $friday_att_report_data = array($data['teacher_id'], $data['month'], $data['s_year']);
        $this->session->set_userdata('friday_att_report_data', $friday_att_report_data);


        redirect(base_url() . 'index.php?attendance/friday_attendance_report_view/', 'refresh');
    }

    function friday_attendance_report_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $friday_att_report_data = $this->session->userdata('friday_att_report_data');
        $teacher_id = $friday_att_report_data[0];
        $month = $friday_att_report_data[1];
        $s_year = $friday_att_report_data[2];

        $page_data['teachers'] = $this->crud_model->get_branch_teachers($this->session->userdata('branch_id'));
        $teacher_name = $this->crud_model->get_branch_teachers($teacher_id);
        $page_data['teacher_id'] = $teacher_id;
        $page_data['month'] = $month;
        $page_data['s_year'] = $s_year;
        $page_data['page_name'] = 'attendance/friday_attendance_report_view';
        $page_data['page_title'] = get_phrase('friday_attendance_report') . ' / ' . $teacher_name;
        $this->load->view('backend/index', $page_data);
    }

    function friday_attendance_report_print_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $friday_att_report_data = $this->session->userdata('friday_att_report_data');
        $page_data['teacher_id'] = $friday_att_report_data[0];
        $page_data['month'] = $friday_att_report_data[1];
        $page_data['s_year'] = $friday_att_report_data[2];

        $this->load->view('backend/admin/attendance/friday_attendance_report_print_view', $page_data);
    }

    function get_friday_attendance($status, $status_value, $student_id, $year, $month, $teacher_id) {
        $query = $this->db->query("SELECT   COUNT( $status ) AS totalCounnt 
                FROM friday_attendance  WHERE student_id =$student_id  AND teacher_id=$teacher_id 
                AND $status =$status_value AND year='$year' AND  MONTH(timestamp)=$month ");

        return ($query->num_rows() > 0) ? $query->row()->totalCounnt : 0;
    }

    //--------------------------------------------------------
    // Students Friday Attendance     <----END---->
//
}
