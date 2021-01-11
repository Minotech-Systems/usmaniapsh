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

class Mujeeb extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('mujeeb_model');
        $this->load->model('question_model');
        $this->load->model('fatwa_model');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('ifta_admin_login') == 1)
            redirect(base_url() . 'mujeeb/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');
        $where = array();
        $where['solved_status'] = 0;
        $page_data['page_name'] = 'dashboard';
        $page_data['un_solved_question'] = $this->mujeeb_model->get_mujeeb_data($where);
        $page_data['page_title'] = 'جامعہ عثمانیہ پشاور' . ' | ' . $this->mujeeb_model->get_mujeeb_profile()->name;
        $this->load->view('backend/index', $page_data);
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['user_name'] = $this->crud_model->Encrypt($this->input->post('user_name'));

            if (!empty($_FILES["user_image"]["name"])) {
                $where = array();
                $where['user_id'] = $this->session->userdata('mujeeb_id');
                $this->crud_model->delete_image('ifta_users', $where, 'user_image');
                $image_data = $this->crud_model->upload_image('user_image', 'user_image');
                $this->crud_model->update('ifta_users', $image_data, $where);
            }

            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('ifta_users', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'mujeeb/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = $this->crud_model->hash($this->input->post('password'));
            $data['new_password'] = $this->crud_model->hash($this->input->post('new_password'));
            $data['confirm_new_password'] = $this->crud_model->hash($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('ifta_users', array(
                        'user_id' => $this->session->userdata('mujeeb_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('user_id', $this->session->userdata('mujeeb_id'));
                $this->db->update('ifta_users', array(
                    'password' => $data['new_password']
                ));

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'mujeeb/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('ifta_users', array(
                    'user_id' => $this->session->userdata('mujeeb_id')
                ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function answering($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['question_id'] = $param1;
        $data['question_data'] = $this->question_model->get_question_data($param1);
        $data['page_name'] = 'question/answering_to_question';
        $data['page_title'] = 'جامعہ عثمانیہ پشاور' . ' | ' . $this->mujeeb_model->get_mujeeb_profile()->name;
        $this->load->view('backend/index', $data);
    }

    function add_question_answer() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $result = $this->question_model->add_question_answer();
        if ($result == TRUE) {
            $this->session->set_flashdata('flash_message', 'فتویٰ کو مامیابی سے داخل کر دیا گیا');
            redirect(base_url() . 'mujeeb/answers/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'اس سوال کا جواب پہلے سے موجود ہے۔ لہذٰ اسکی تصحیح کریں۔۔۔۔');
            redirect(base_url() . 'mujeeb/answers/', 'refresh');
        }
    }

    function answers() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['answer_data'] = $this->mujeeb_model->get_fatawas();
        $data['page_name'] = 'answer/answers';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    function edit_fatwa($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'update') {
            $fatwa_id = $this->input->post('fatwa_id');
            $result = $this->fatwa_model->update_fatwa($fatwa_id);
            if ($result == TRUE) {
                $this->session->set_flashdata('flash_message', 'فتویٰ کو کامیابی سے اپڈیٹ کر دیا گیا۔۔۔');
                redirect(base_url() . 'mujeeb/edit_fatwa/' . $fatwa_id, 'refresh');
            } else {
                $this->session->set_flashdata('error_message', 'ریکارڈ کو اپ ڈیٹ کرتے وقت ایک خامی ہے');
                redirect(base_url() . 'mujeeb/edit_fatwa/' . $fatwa_id, 'refresh');
            }
        }
        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($param1);
        $data['page_name'] = 'answer/fatwa_edit';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    // this function is used to view the answer detail solved by mujeeeb
    function fatwa_detail($fatwa_id) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($fatwa_id);
        $data['page_name'] = 'answer/fatwa_detail';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    function load_notifications($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'edit_review') {
            $this->load->view('backend/mujeeb/answer_review.php');
        }
    }

    function count_review_questions() {
        echo $this->db->where(array('view_status' => 0, 'mujeeb_id' => $this->session->userdata('mujeeb_id')))->from("ifta_fatwa_review")->count_all_results();
    }

    function view_review_question($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        //First Update notification view status
        $this->db->where('id', $param2);
        $this->db->update('ifta_fatwa_review', array('view_status' => 1));

        $fatwa_id = $this->db->get_where('ifta_answer', array('question_id' => $param1))->row()->answer_id;
        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($fatwa_id);
        $data['question_id'] = $param1;
        $data['fatwa_id'] = $fatwa_id;
        $data['page_name'] = 'answer/view_review_question';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    function view_all_review() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['all_review'] = $this->mujeeb_model->get_all_review();
        $data['page_name'] = 'answer/view_all_review';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    function print_question($question_id = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['question_data'] = $this->db->get_where('ifta_question', array('question_id' => $question_id))->row();
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/mujeeb/question/print_question', $data);
    }

}
