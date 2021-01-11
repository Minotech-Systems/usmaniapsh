<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: Ijaz Sunny
 * 	date		: 27 september, 2016
 * 	iTkoor School Management System Pro
 * 	http://itkoor.com
 * 	imsunny37@gmail.com
 */

class Questions extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('question_model');
        $this->load->model('crud_model');
        $this->load->library('encrypt');



        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function ifta_questions() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['questions'] = $this->question_model->get_unsolved_question_data();
        $page_data['page_name'] = 'question/ifta_questions';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function mujeeb_unsolved_question() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['questions'] = $this->question_model->get_unsolved_question_data();
        $page_data['page_name'] = 'question/mujeeb_unsolved_question';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function entering_question() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['ifta_users'] = $this->admin_model->get_ifta_users();
        $page_data['ifta_books'] = $this->admin_model->get_ifta_books();
        $page_data['page_name'] = 'question/entering_question';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function create_question() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $result = $this->question_model->create_question();
        if ($result == TRUE) {
            $this->session->set_flashdata('flash_message', 'افتا سوال کو کامیابی سے داخل کردیا گیا۔۔۔');
            redirect(base_url() . 'questions/entering_question/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'کوئی غلطی سرزد ہوئی ہے۔ دوبارہ کوشش کریں۔۔۔');
            redirect(base_url() . 'questions/entering_question/', 'refresh');
        }
    }

    function get_mujeeb_question($mujeeb_id) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        echo $this->question_model->get_mujeeb_question($mujeeb_id);
    }

    function update_question($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'update') {
            $result = $this->question_model->update_question($param2);
            if ($result == TRUE) {

                $this->session->set_flashdata('flash_message', 'افتاء سوال کی کمیابی سے تصیحح کر دی گئی۔۔۔');
                redirect(base_url() . 'questions/update_question/' . $param2, 'refresh');
            }
        }

        $page_data['ifta_users'] = $this->admin_model->get_ifta_users();
        $page_data['ifta_books'] = $this->admin_model->get_ifta_books();
        $page_data['question_data'] = $this->question_model->get_question_data($param1);
        $page_data['page_name'] = 'question/update_question';
        $page_data['question_id'] = $param1;
        $page_data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $page_data);
    }

    function upload_question_file($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');
        $this->question_model->check_unlink_file($param1);
        if (!empty($_FILES["question_file"]["name"])) {

            $file_data = $this->crud_model->upload_file('question_file', 'question_file');
            $where = $this->db->where('question_id', $param1);
            $this->crud_model->update('ifta_question', $file_data, $where);
        }
        $this->session->set_flashdata('flash_message', 'فائل کو کامیابی سے داخل کر دیا گیا۔۔۔');
        redirect(base_url() . 'questions/ifta_questions/', 'refresh');
    }

    function download_question_file($file) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        $this->load->helper('file');
        $this->load->helper('download');
        $data = file_get_contents('./uploads/question_file/' . $file);
        if (!empty($data)) {
            force_download($file, $data);
        }
    }

    function answering_to_question($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['question_id'] = $param1;
        $data['question_data'] = $this->question_model->get_question_data($param1);
        $data['page_name'] = 'question/answering_to_question';
        $data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $data);
    }

    function add_question_answer() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $result = $this->question_model->add_question_answer();
        if ($result == TRUE) {
            $this->session->set_flashdata('flash_message', 'فتویٰ کو مامیابی سے داخل کر دیا گیا');
            redirect(base_url() . 'fatwa/answers/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'اس سوال کا جواب پہلے سے موجود ہے۔ لہذٰ اسکی تصحیح کریں۔۔۔۔');
            redirect(base_url() . 'fatwa/answers/', 'refresh');
        }
    }

    function delete_question($question_id) {
        $this->db->where('question_id', $question_id);
        $this->db->delete('ifta_question');

        $this->session->set_flashdata('flash_message', 'سوال کو کامیابی سے حذف کر دیا گیا۔۔۔');
        redirect(base_url() . 'questions/ifta_questions', 'refresh');
    }

    function reject_question($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'reject') {
            $this->db->where('question_id', $param2);
            $this->db->update('ifta_question', array('reject' => 1));
            $this->session->set_flashdata('flash_message', 'سوال کو کامیابی سےمنسوخ کر دیا گیا۔۔۔');
            redirect(base_url() . 'questions/ifta_questions/', 'refresh');
        }
        if ($param1 == 'un_reject') {
            $this->db->where('question_id', $param2);
            $this->db->update('ifta_question', array('reject' => 0));
            $this->session->set_flashdata('flash_message', 'سوال کو کامیابی سےمنسوخ کر دیا گیا۔۔۔');
            redirect(base_url() . 'questions/reject_question/', 'refresh');
        }
        $where = array();
        $where['reject'] = 1;
        $data['question_id'] = $param1;
        $data['page_name'] = 'question/reject_question';
        $data['questions'] = $this->question_model->get_questions($where);
        $data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $data);
    }

    function send_reject_email() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $question_id = $this->input->post('question_id');
        $message = $this->input->post('email');

        $this->question_model->send_reject_email($question_id, $message);

        $this->session->set_flashdata('flash_message', 'ای میل کو کامیابی سے بھیج دیا گیا۔۔۔');
        redirect(base_url() . 'questions/reject_question', 'refresh');
    }

//======================================================================
// Print Reports
//======================================================================

    function mostafti_question_print($question_id) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['question_data'] = $this->question_model->get_question_data($question_id);
        $this->load->view('backend/admin/prints/mostafti_question_print', $data);
    }

}
