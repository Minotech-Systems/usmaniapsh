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

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

//Default function, redirects to logged in user area
    public function index() {
        if (empty($this->session->userdata('system_lang')) || $this->session->userdata('system_lang') == 'urdu') {
            $this->session->set_userdata('system_lang', 'urdu');
        }
        if ($this->session->userdata('user_login') == 1) {
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $page_data['page_name'] = 'login';
            $page_data['page_title'] = 'لاگ ان';
            $this->load->view('front_end/index', $page_data);
        }
    }

    public function register() {
        if ($this->session->userdata('user_login') == 1) {
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $page_data['page_name'] = 'register';
            $page_data['page_title'] = 'نیاء اکانٹ بنائے' . '|' . 'جامعہ عثمانیہ پشاور';
            $this->load->view('front_end/index', $page_data);
        }
    }

    public function register_user() {
        $this->form_validation->set_rules('name', 'نام ضروری ہے', 'required');
        $this->form_validation->set_rules('email', 'ای میل ضروری ہے', 'required');
        $this->form_validation->set_rules('phone', 'موبائل نمبر ضروری ہے', 'required');
        $this->form_validation->set_rules('password', 'پاسورڈ ضروری ہے', 'required');

        if ($this->form_validation->run() == FALSE) {
            $page_data['page_name'] = 'register';
            $this->load->view('front_end/index', $page_data);
        } else {
            $check_email = $this->db->get_where('ifta_questioner', array('email' => $this->input->post('email')))->row();
            if (!empty($check_email)) {
                $this->session->set_userdata('email_already_exist', 'email_exist');
                redirect(base_url() . 'register', 'refresh');
            } else {
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['phone'] = $this->input->post('phone');
                $data['address'] = '';
                $data['password'] = $this->crud_model->hash($this->input->post('password'));
                $this->db->insert('ifta_questioner', $data);
            }
            $this->registration_email('registration', $data['email'], $data);
            $this->session->set_userdata('account_created', 'account Created Successfully...');
            redirect(base_url() . 'register', 'refresh');
        }
    }

    function forgot_password() {
        if ($this->session->userdata('user_login') == 1) {
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $page_data['page_name'] = 'forgot_password';
            $page_data['page_title'] = 'پاسورڈ یاد نہیں ہے';
            $this->load->view('front_end/index', $page_data);
        }
    }

    function forgot_user_password() {
        $email = $this->input->post('email');
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $random_pass = implode($pass);
        $user_data = $this->db->get_where('ifta_questioner', array('email' => $email))->row();
        if (!empty($user_data)) {
            $data['password'] = $this->crud_model->hash($random_pass);
            $this->db->where('email', $email);
            $this->db->update('ifta_questioner', array('password' => $data['password']));
            $this->registration_email('forgot_password', $email, $random_pass);
            $this->session->set_userdata('password_changed', 'Password Change Successfully...');
            redirect(base_url() . 'forgot-password', 'refresh');
        } else {
            $this->session->set_userdata('email_not_exist', 'Email Not Found');
            redirect(base_url() . 'forgot-password', 'refresh');
        }
    }

    function registration_email($type, $email, $data) {
        switch ($type) {
            case 'registration':
                return $this->send_registration_email($email, $data);
                break;
            case 'forgot_password':
                return $this->forgot_password_email($email, $data);
                break;
        }
    }

    function send_registration_email($email, $data) {
        $email_template = $this->check_by(array('email_group' => 'registration'), 'tbl_email_templates');
        $email_body = str_replace("{name}", $data['name'], $email_template->template_body);
        $user_email = str_replace("{email}", $data['email'], $email_body);
        $message = str_replace("{phone}", $data['phone'], $user_email);
        $params['recipient'] = $email;
        $params['subject'] = 'آپ کا اکاونٹ بن گیاہے';
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        return $result = $this->email_model->send_email($params);
    }

    function forgot_password_email($email, $data) {
        $email_template = $this->check_by(array('email_group' => 'forgot_password'), 'tbl_email_templates');
        $message = str_replace("{PASSWORD}", $data, $email_template->template_body);

        $params['recipient'] = $email;
        $params['subject'] = 'آپ کا اکاونٹ بن گیاہے';
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        return $result = $this->email_model->send_email($params);
    }

    public function validate_login() {
        $email = $this->input->post('email');
        
        $enc_password = $this->crud_model->hash($this->input->post('password'));
//        echo '<Pre>';print_r($enc_password);die;
        $credential_a = array('email' => $email, 'password' => $enc_password);
        $query = $this->db->get_where('ifta_questioner', $credential_a);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('user_id', $row->questioner_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('phone', $row->phone);
            $this->session->set_userdata('address', $row->address);
            $this->session->set_userdata('login_type', 'user');
            $this->session->set_userdata('system_lang', 'urdu');
            redirect(base_url() . 'dashboard', 'refresh');
        }


        $this->session->set_userdata('login_error', 'invalid_login');
        redirect(base_url() . 'login', 'refresh');
    }

    public function check_by($where, $tbl_name) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'login', 'refresh');
    }

}
