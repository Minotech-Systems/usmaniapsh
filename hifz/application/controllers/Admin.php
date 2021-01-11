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

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        $page_data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //======================================================================
    // Student Area 
    //======================================================================
    function students() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['students'] = $this->crud_model->get_student_data($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'student/students';
        $page_data['page_title'] = get_phrase('students');
        $this->load->view('backend/index', $page_data);
    }

    //Edit Student Registration number
    function edit_student_reg_no() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['students'] = $this->crud_model->get_student_data($this->session->userdata('branch_id'));
        $page_data['page_name'] = 'admission/edit_student_reg_no';
        $page_data['page_title'] = get_phrase('students');
        $this->load->view('backend/index', $page_data);
    }

    function change_student_reg_no($student_id, $reg_no) {
        $check_regno = $this->db->get_where('student', array('reg_no' => $reg_no))->result();
        if (!empty($check_regno)) {
            echo 'no';
        } else {
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('reg_no' => $reg_no));
        }
    }

    // Student Card 
    function student_card() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['page_name'] = 'student/student_card';
        $page_data['page_title'] = get_phrase('student_card');
        $this->load->view('backend/index', $page_data);
    }

    // Student Card Print view
    function student_card_view() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $system_year = explode('-', $page_data['running_year']);
        $date_year = date('Y') + 1;

        $select_type = $this->input->post('select_type');
        if ($select_type == 'all') {
            $data['ex_year'] = $date_year;
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['students'] = $this->crud_model->get_student_data($this->session->userdata('branch_id'));
        } else {
            $data['ex_year'] = $date_year;
            $data['teacher_id'] = $this->input->post('select_type');
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['students'] = $this->crud_model->get_student_teacher_data($data['teacher_id']);
        }

        $data['page_title'] = get_phrase('student_card');
        $this->load->view('backend/admin/student/student_card_view', $data);
    }

    function get_students($param1, $param2) {
        $page_data['branch_id'] = $param1;
        $page_data['teacher_id'] = $param2;

        $this->load->view('backend/admin/student/get_students', $page_data);
    }

    function selected_student_card() {
        $data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $date_year = date('Y') + 1;
        $data['ex_year'] = $date_year;
        $data['students'] = $this->input->post('student_id');
        $data['branch_id'] = $this->session->userdata('branch_id');
        $this->load->view('backend/admin/student/selected_student_card', $data);
    }

    function student_pics_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        $page_data['page_name'] = 'student/student_pics_report';
        $page_data['page_title'] = get_phrase('student_pics_report');
        $this->load->view('backend/index', $page_data);
    }

    function student_pics_report_print() {
        $data['teacher_id'] = $this->input->post('teacher');
        $data['students'] = $this->input->post('student_id');
        $this->load->view('backend/admin/student/student_pics_report_print', $data);
    }

    //======================================================================
    // End Student Area 
    //======================================================================


    function teacher($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $branch_id = $this->session->userdata('branch_id');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['nic'] = $this->input->post('nic');
            $data['c_address'] = $this->input->post('c_address');
            $data['p_address'] = $this->input->post('p_address');
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['phone'] = $this->input->post('phone');
            $data['country_id'] = $this->input->post('country_id');
            $data['prov_id'] = $this->input->post('province_id');
            $data['dist_id'] = $this->input->post('district_id');
            $data['joining_date'] = date('Y-m-d', strtotime($this->input->post('joining_date')));
            $data['status'] = 1;

            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            if (!empty(($_FILES["teacher_image"]["name"]))) {
                $image_data = $this->crud_model->upload_image('teacher_image', 'teacher_image');
                $where = $this->db->where('teacher_id', $teacher_id);
                $this->crud_model->update('teacher', $image_data, $where);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['nic'] = $this->input->post('nic');
            $data['c_address'] = $this->input->post('c_address');
            $data['p_address'] = $this->input->post('p_address');
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['phone'] = $this->input->post('phone');
            $data['country_id'] = $this->input->post('country_id');
            $data['prov_id'] = $this->input->post('province_id');
            $data['dist_id'] = $this->input->post('district_id');
            $data['joining_date'] = date('Y-m-d', strtotime($this->input->post('joining_date')));

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);

            if (!empty(($_FILES["teacher_image"]["name"]))) {
                $image_data = $this->crud_model->upload_image('teacher_image', 'teacher_image');
                $where = $this->db->where('teacher_id', $teacher_id);
                $this->crud_model->update('teacher', $image_data, $where);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        $page_data['teachers'] = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
        $page_data['page_name'] = 'teacher/teacher';
        $page_data['page_title'] = get_phrase('teacher');
        $this->load->view('backend/index', $page_data);
    }

    function manage_students($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');



        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if ($param1 == 'manage') {
            $students = $this->input->post('student_id');
            $teacher_id = $this->input->post('teacher_id');
            foreach ($students as $data) {
                $this->db->where('student_id', $data);
                $this->db->where('year', $year);
                $this->db->update('enroll', array('teacher_id' => $teacher_id));

                $this->db->where('student_id', $data);
                $this->db->where('year', $year);
                $this->db->update('student_fee', array('teacher_id' => $teacher_id));
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/manage_students/', 'refresh');
        }


        $page_data['teachers'] = $this->db->get_where('teacher', array('status' => 1, 'branch_id' => $this->session->userdata('branch_id')))->result();

        $page_data['page_name'] = 'student/mange_students';
        $page_data['page_title'] = get_phrase('manage_students');
        $this->load->view('backend/index', $page_data);
    }

    function remove_student_teacher($param = '') {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->where('student_id', $param);
        $this->db->where('year', $year);
        $this->db->update('enroll', array('teacher_id' => 0));
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'index.php?admin/manage_students/', 'refresh');
    }

    function edit_student($student_id) {
        $student_name = $this->crud_model->get_type_name_by_id('student', $student_id);
        $page_data['student_id'] = $student_id;
        $page_data['page_name'] = 'student/edit_student';
        $page_data['page_title'] = $student_name;
        $this->load->view('backend/index', $page_data);
    }

    function student_detail_view($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $page_data['login_branch'] = $this->session->userdata('branch_id');
        if ($param1 == 'create') {
            $data = $this->input->post();

            $teacher = $this->input->post('teacher_id');
            if ($teacher == 'all') {
                $page_data['students'] = $this->crud_model->get_student_data($page_data['login_branch']);
                $page_data['total_students'] = $this->crud_model->count_branch_students();
            } else {
                $page_data['students'] = $this->crud_model->get_student_teacher_data($teacher);
                $page_data['total_students'] = $this->crud_model->count_teacher_students($teacher);
            }
            $page_data['teacher_id'] = $teacher;
            $page_data['data'] = $data;
            $page_data['page_title'] = get_phrase('student_report');
            $this->load->view('backend/admin/student/student_detail_view_print', $page_data);
        } else {

            $page_data['page_name'] = 'student/student_detail_view';
            $page_data['page_title'] = get_phrase('student_report');
            $this->load->view('backend/index', $page_data);
        }
    }

    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type', 'system_name');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type', 'system_title');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type', 'address');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type', 'phone');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type', 'paypal_email');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type', 'currency');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type', 'system_email');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type', 'system_name');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type', 'language');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type', 'text_align');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('running_year');
            $this->db->where('type', 'running_year');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('talimi_saal');
            $this->db->where('type', 'talimi_saal');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('sms_app');
            $this->db->where('type', 'sms_app');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type', 'skin_colour');
            $this->db->update('settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('theme_selected'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*     * ******MANAGE PLACES FOR SYSTEM****** */

    function countries($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'create') {
            $data['name'] = $this->input->post('country');
            $this->db->insert('country', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/countries/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('country');
            $this->db->where('country_id', $param2);
            $this->db->update('country', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/countries/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('country_id', $param2);
            $this->db->delete('country');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/countries/', 'refresh');
        }

        $page_data['page_name'] = 'countries';
        $page_data['page_title'] = get_phrase('manage_countries');
        $this->load->view('backend/index', $page_data);
    }

    function provinces($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');


        if ($param1 == 'create') {
            $data['name'] = $this->input->post('province');
            $data['country_id'] = $this->input->post('country_id');

            $this->db->insert('province', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/countries/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('province');
            $data['country_id'] = $this->input->post('country_id');

            $this->db->where('prov_id', $param2);
            $this->db->update('province', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/countries/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('prov_id', $param2);
            $this->db->delete('province');

            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/countries/', 'refresh');
        }
    }

    function districts($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');


        if ($param1 == 'create') {
            $data['name'] = $this->input->post('district');
            $data['prov_id'] = $this->input->post('province_id');

            $this->db->insert('district', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/districts/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('district');
            $data['prov_id'] = $this->input->post('prov_id');

            $this->db->where('dist_id', $param2);
            $this->db->update('district', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/districts/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('dist_id', $param2);
            $this->db->delete('district');

            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/districts/', 'refresh');
        }

        $page_data['page_name'] = 'districts';
        $page_data['page_title'] = get_phrase('manage_districts');

        $this->load->view('backend/index', $page_data);
    }

    //Get District from Backend
    function get_districts($prov_id) {
        $districts = $this->db->get_where('district', array('prov_id' => $prov_id))->result_array();
        echo '<option value=""> ضلع منتخب کریں</option>';
        foreach ($districts as $row) {
            echo '<option value="' . $row['dist_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_province($country_id) {
        $prov = $this->db->get_where('province', array(
                    'country_id' => $country_id
                ))->result_array();
        echo '<option value=""> صوبہ منتخب کریں</option>';
        foreach ($prov as $row) {
            echo '<option value="' . $row['prov_id'] . '">' . $row['name'] . '</option>';
        }
    }

    /*     * ***LANGUAGE SETTINGS******** */

    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]	=	$this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function get_session_changer() {
        $this->load->view('backend/admin/change_session');
    }

    function change_session() {
        $data['description'] = $this->input->post('running_year');
        $this->db->where('type', 'running_year');
        $this->db->update('settings', $data);
        $this->session->set_flashdata('flash_message', get_phrase('session_changed'));
        redirect(base_url() . 'index.php?admin/dashboard/', 'refresh');
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = sha1($this->input->post('password'));
            $data['new_password'] = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('admin', array(
                        'admin_id' => $this->session->userdata('admin_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function database_backup() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        $this->load->helper('file');
        $page_data['backups'] = get_filenames('./uploads/backup/');
        $page_data['page_name'] = 'database_backup';
        $page_data['page_title'] = get_phrase('database_backup');
        $this->load->view('backend/index', $page_data);
    }

    public function do_database_backup() {
        $this->load->helper('file');
        $this->load->dbutil();
        $prefs = array('format' => 'zip', 'filename' => 'BD-backup_' . date('Y-m-d_H-i-sa'));

        $backup = $this->dbutil->backup($prefs);
        if (!write_file('./uploads/backup/BD-backup_' . date('Y-m-d_H-i-sa') . '.zip', $backup)) {
            $this->session->set_flashdata('error_message', get_phrase('database_not_backuped'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('database_backup_completed'));
        }

        redirect(base_url() . 'index.php?admin/database_backup/', 'refresh');
    }

    function download_backup($file) {
        $this->load->helper('file');
        $this->load->helper('download');
        $data = file_get_contents('./uploads/backup/' . $file);
        force_download($file, $data);
        redirect(base_url() . 'index.php?admin/database_backup/', 'refresh');
    }

    public function delete_backup($file) {
        if (unlink('./uploads/backup/' . $file)) {
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('error_occured'));
        }

        redirect(base_url() . 'index.php?admin/database_backup/', 'refresh');
    }

    /*     * ******* CLASSES MANAGMENT ************* */

    function manage_classes($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['branch_id'] = $this->session->userdata('branch_id');

        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['branch_id'] = $page_data['branch_id'];
            //$this->input->post('main_branch_id');

            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            //create a section by default
            $data2['class_id'] = $class_id;
            $data2['name'] = 'الف';
            $data2['nick_name'] = 'الف';
            $this->db->insert('section', $data2);

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/manage_classes/', 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');

            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/manage_classes', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');

            $this->db->where('class_id', $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/manage_classes', 'refresh');
        }


        $page_data['page_name'] = 'classes/manage_class';
        $page_data['classes'] = $this->db->get_where('class', array('branch_id' => $page_data['branch_id']))->result();
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }

    function manage_section($class_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['page_name'] = 'classes/manage_section';
        $page_data['page_title'] = get_phrase('section');

        // detect the first class
        if ($class_id == '')
            $class_id = $this->db->get_where('class', array('branch_id' => $page_data['branch_id']))->first_row()->class_id;
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function sections($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['nick_name'] = $this->input->post('nick_name');
            $data['class_id'] = $this->input->post('class_id');
            $this->db->insert('section', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/manage_section/' . $data['class_id'], 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['nick_name'] = $this->input->post('nick_name');
            $data['class_id'] = $this->input->post('class_id');
            $this->db->where('section_id', $param2);
            $this->db->update('section', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/manage_section/' . $data['class_id'], 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id', $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/manage_section', 'refresh');
        }
    }

    //======================================================================
    // System Reports Start 
    //======================================================================

    function monthly_syllabus($param1) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $page_data['value'] = $this->input->post('select_type');
            $page_data['exams_s'] = $this->input->post('exam_id');
            $this->session->set_userdata('monthly_syllabus_exams', $this->input->post('exam_id'));
            $this->session->set_userdata('monthly_syllabus_value', $this->input->post('select_type'));
        }
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'reports/monthly_syllabus';
        $page_data['page_title'] = get_phrase('monthly_syllabus');
        $this->load->view('backend/index', $page_data);
    }

    function monthly_syllabus_print() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['value'] = $this->session->userdata('monthly_syllabus_value');
        $page_data['exams_s'] = $this->session->userdata('monthly_syllabus_exams');
        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $this->load->view('backend/admin/reports/monthly_syllabus_print', $page_data);
    }

    //======================================================================
    // System Reports End
    //======================================================================


    /*
      |--------------------------------------------------------------------------
      | Resposible (Masoleen) managment
      |--------------------------------------------------------------------------
     */

    function responsible($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');


        if ($param1 == 'create') {
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['class_id'] = $this->input->post('class_id');



            $this->db->insert('responsible', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/responsible/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['branch_id'] = $this->session->userdata('branch_id');
            $data['class_id'] = $this->input->post('class_id');
            $id = $this->input->post('id');

            $this->db->where('id', $id);
            $this->db->update('responsible', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/responsible/', 'refresh');
        }

        if ($param1 == 'delete') {

            $this->db->where('id', $param2);
            $this->db->delete('responsible');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/responsible/', 'refresh');
        }
        $where = array();
        $where['branch_id'] = $this->session->userdata('branch_id');
        $page_data['data'] = $this->admin_model->get_result($where, 'responsible');
        $page_data['page_name'] = 'responsible/responsible';
        $page_data['page_title'] = get_phrase('responsible');
        $this->load->view('backend/index', $page_data);
    }

    /*
      |--------------------------------------------------------------------------
      | Resposible (Masoleen) managment
      |--------------------------------------------------------------------------
     */
}
