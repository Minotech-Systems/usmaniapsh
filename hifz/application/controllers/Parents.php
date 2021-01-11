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

class Parents extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('exam_model');
        $this->load->model('parents_model');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?parents/login', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');


        $page_data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['parent_id'] = $this->session->userdata('parent_id');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('parent_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //======================================================================
    // Child Exam Marks View
    //======================================================================

    function exam_marks() {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $student_id = $this->session->userdata('parent_id');
        $page_data['student_id'] = $student_id;
        $page_data['teacher_id'] = $this->parents_model->get_student_id('teacher_id', $student_id);
        $page_data['exams'] = $this->parents_model->get_student_exams();
        foreach ($page_data['exams'] as $data) {
            $this->parents_model->create_exam_positions($page_data['teacher_id'], $data['exam_id'], $year);
        }$page_data['student'] = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $page_data['page_name'] = 'exam_marks';
        $image = $this->db->get_where('student', array('student_id' => $student_id))->row()->image;
        $image_url = $this->crud_model->get_image_url('student', $image);
        $page_data['parent_page_title'] = "<img src='$image_url'" . 'class="img-circle"' . 'width="40"' . "/>" . $page_data['student'];
        $page_data['page_title'] = $page_data['student'];
        $page_data['year'] = $year;
        $this->load->view('backend/index', $page_data);
    }

    //======================================================================
    // Child Exam Marks View End
    //======================================================================


    function attendance_report() {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $student_id = $student_id = $this->session->userdata('parent_id');
        if ($this->input->post('month') != '' && $this->input->post('year') != '') {
            $page_data['month'] = $this->input->post('month');
            $page_data['year'] = $this->input->post('year');
        } else {
            $page_data['month'] = '';
            $page_data['year'] = '';
        }
        $page_data['student'] = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $page_data['student_id'] = $student_id;
        $page_data['page_name'] = 'attendance_report';
        $image = $this->db->get_where('student', array('student_id' => $student_id))->row()->image;
        $image_url = $this->crud_model->get_image_url('student', $image);
        $page_data['parent_page_title'] = "<img src='$image_url'" . 'class="img-circle"' . 'width="40"' . "/>" . $page_data['student'];
        $page_data['page_title'] = $page_data['student'];
        $this->load->view('backend/index', $page_data);
    }

    function daily_student_report($student_id) {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['student_id'] = $student_id;
        $page_data['page_name'] = 'daily_student_report';
        $page_data['page_title'] = get_phrase('daily_student_report');
        $this->load->view('backend/index', $page_data);
    }

    function load_daily_report_view($param1, $param3) {
        $data['student_id'] = $param1;
        $data['month'] = $param3;
        $this->load->view('backend/parent/_daily_report', $data);
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

}
