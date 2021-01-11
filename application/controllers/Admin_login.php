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

class Admin_login extends CI_Controller {

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

        if ($this->session->userdata('ifta_admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');

        if ($this->session->userdata('ifta_user_login') == 1)
            redirect(base_url() . 'index.php?user/dashboard', 'refresh');

//        if ($this->session->userdata('ifta_pupil_login') == 1)
//            redirect(base_url() . 'index.php?pupil/dashboard', 'refresh');

        $this->load->view('backend/admin_login');
    }

    //Validating login from ajax request
    function validate_login() {
        $username = $this->crud_model->Encrypt($this->input->post('username'));
        $enc_password = $this->crud_model->hash($this->input->post('password'));



        $credential_a = array('user_name' => $username, 'password' => $enc_password, 'level' => 1);
        $query = $this->db->get_where('ifta_admin', $credential_a);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('ifta_admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('user_level', $row->level);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            $this->session->set_userdata('system_lang', 'urdu');
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }
        $credential_a = array('user_name' => $username, 'password' => $enc_password, 'level' => 1,'status' => 1);
        $query = $this->db->get_where('ifta_users', $credential_a);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('ifta_admin_login', '1');
            $this->session->set_userdata('mujeeb_id', $row->user_id);
            $this->session->set_userdata('user_level', $row->level);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'mujeeb');
            $this->session->set_userdata('system_lang', 'urdu');
            redirect(base_url() . 'mujeeb/dashboard', 'refresh');
        }





        $this->session->set_flashdata('flash_message', 'Fail Login');
        $this->session->set_flashdata('login_error', get_phrase('invalid_login'));
        redirect(base_url() . 'admin_login', 'refresh');
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password() {
        $this->load->view('backend/forgot_password');
    }

    function reset_password() {
        $email = $this->input->post('email');
        $reset_account_type = '';
        //resetting user password here
        $new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);

        // Checking credential for admin
        $query = $this->db->get_where('admin', array('email' => $email));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'admin';
            $this->db->where('email', $email);
            $this->db->update('admin', array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $reset_account_type, $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
        }
        // Checking credential for student
        $query = $this->db->get_where('student', array('email' => $email));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'student';
            $this->db->where('email', $email);
            $this->db->update('student', array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $reset_account_type, $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
        }
        // Checking credential for teacher
        $query = $this->db->get_where('teacher', array('email' => $email));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'teacher';
            $this->db->where('email', $email);
            $this->db->update('teacher', array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $reset_account_type, $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
        }
        // Checking credential for parent
        $query = $this->db->get_where('parent', array('email' => $email));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'parent';
            $this->db->where('email', $email);
            $this->db->update('parent', array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $reset_account_type, $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
        }
        $this->session->set_flashdata('reset_error', get_phrase('password_reset_was_failed'));
        redirect(base_url() . 'index.php?login/forgot_password', 'refresh');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'admin_login', 'refresh');
    }

}
