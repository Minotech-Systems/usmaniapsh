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

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('question_model');
        $this->load->model('frontend_model');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('ifta_admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');

        $where = array();
        $where['questioner_id'] = $this->session->userdata('user_id');
        $page_data['page_name'] = 'dashboard';
        $page_data['user_questions'] = $this->question_model->get_questions($where);
//        echo '<pre>';print_r($page_data['user_questions']);die;
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('front_end/index', $page_data);
    }

}
