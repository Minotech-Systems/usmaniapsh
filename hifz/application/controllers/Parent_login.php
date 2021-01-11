<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @author   : Creativeitem
 *  date    : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Parent_login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');

        $this->load->view('backend/parent_login');
    }

    //Validating login from ajax request
    function validate_login() {
        $email = $this->input->post('number');
        $charc = substr($email, 0,1);
        $string = str_replace('H', '', $email);
        $split_num = explode('-', $string);
         $id = $split_num[0];
       $reg_no = $split_num[1];

        // Checking login credential for admin
        if ($charc == 'H') {
            $credential = array('reg_no' => $reg_no, 'student_id' => $id);
            $query = $this->db->get_where('student', $credential);

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $this->session->set_userdata('parent_login', '1');
                $this->session->set_userdata('parent_id', $row->student_id);
                $this->session->set_userdata('name', $row->father_name);
                $this->session->set_userdata('login_type', 'parent');
                redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
            }
        } else {
            $this->session->set_flashdata('flash_message', 'Fail Login');
            $this->session->set_flashdata('login_error', get_phrase('Write H in Capital Letters'));
            redirect(base_url() . 'index.php?parent_login', 'refresh');
        }


        $this->session->set_flashdata('flash_message', 'Fail Login');
        $this->session->set_flashdata('login_error', get_phrase('invalid_login'));
        redirect(base_url() . 'index.php?parent_login', 'refresh');
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        //$level = $this->session->userdata('login_user_level');
        $this->db->truncate('mark_summery');
        $this->session->sess_destroy();

        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'index.php?parent_login', 'refresh');
    }

}
