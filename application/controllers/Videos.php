<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  @author   : Creativeitem
 *  date      : November, 2019
 *  Ekattor School Management System With Addons
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Videos extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (empty($this->session->userdata('system_lang')) || $this->session->userdata('system_lang') == 'urdu') {
            $this->session->set_userdata('system_lang', 'urdu');
        }
        /* LOADING ALL THE MODELS HERE */
//    $this->load->model('Crud_model',     'crud_model');
//    $this->load->model('User_model',     'user_model');
//    $this->load->model('Settings_model', 'settings_model');
//    $this->load->model('Payment_model',  'payment_model');
//    $this->load->model('Email_model',    'email_model');
//    $this->load->model('Addon_model',    'addon_model');
//    $this->load->model('Frontend_model', 'frontend_model');
        $this->load->model('lms_model');
//    $this->load->model('addons/Video_model','video_model');
    }

    //dashboard
    public function index($param1 = '', $param2 = '') {
        if ($param1 == 'create') {
            $this->student_access_denied();
            $this->lms_model->add_video();
            $this->session->set_flashdata('flash_message', get_phrase('course_added_successfully'));
            redirect(site_url('videos'));
        }

        if ($param1 == 'update') {
            $this->student_access_denied();
            $this->lms_model->video_edit($this->input->post('video_id'));
            $this->session->set_flashdata('flash_message', get_phrase('video Updated successfully...'));
            redirect(site_url('videos'));
        }


        if ($param1 == 'delete') {
            $this->student_access_denied();
            $this->lms_model->delete_video($param2);
            $this->session->set_flashdata('flash_message', get_phrase('video Deleted successfully...'));
            redirect(site_url('videos'));
        }

        if (empty($param1)) {

            $page_data['video_section'] = $this->db->get('video_section');
            $page_data['page_title'] = get_phrase('videos');


            if ($this->session->userdata('ifta_admin_login') != 1) {
                $page_data['page_name'] = 'video/grid_view_for_user';
                $this->load->view('front_end/index', $page_data);
            } else {
                $page_data['page_name'] = 'list';
                $this->load->view('backend/video', $page_data);
            }
        }
    }

    public function play($slug = "", $section_id = "", $video_id = "") {
        $page_data['video_sections'] = $this->db->get_where('video_section', array('id' => $section_id))->result();
        $page_data['section_id'] = $section_id;
        $page_data['video_id'] = $video_id;
        $page_data['page_name'] = 'play_videos';
        $page_data['page_title'] = get_phrase('videos');
        $this->load->view('videos/index', $page_data);
    }

    public function student_access_denied() {
        if ($this->session->userdata('ifta_admin_login') != 1) {
            $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_access_to_this_course'));
            redirect(site_url(''), 'refresh');
        }
    }

    function edit_video($param1) {
        $this->student_access_denied();
        $page_data['video_id'] = $param1;
        $page_data['page_name'] = 'edit_video';
        $this->load->view('backend/video', $page_data);
    }

    function edit_video_sectiion($param1) {
        $this->student_access_denied();
        $page_data['section_id'] = $param1;
        $page_data['page_name'] = 'edit_video_sectiion';
        $this->load->view('backend/video', $page_data);
    }

    function add_section() {
        $data['title'] = $this->input->post('section_title');
        $data['description'] = $this->input->post('section_description');
        $data['date'] = date('Y-m-d');
        $data['thumbnail'] = rand() . '.jpg';

        $this->db->insert('video_section', $data);

        move_uploaded_file($_FILES['section_thumbnail']['tmp_name'], 'uploads/section_thumbnail/' . $data['thumbnail']);
        $this->session->set_flashdata('flash_message', 'section Added Successfully...');
        redirect(site_url('videos'), 'refresh');
    }

    function update_section() {
        $this->student_access_denied();
        $this->lms_model->update_section($this->input->post('section_id'));
        $this->session->set_flashdata('flash_message', get_phrase('video Deleted successfully...'));
        redirect(site_url('videos'));
    }

}
