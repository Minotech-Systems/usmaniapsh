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

class Full_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');


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

    function users() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'users';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function add_user() {
        if ($this->input->post('password') == $this->input->post('c_password')) {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('user_name');
            $data['password'] = sha1($this->input->post('password'));
            $data['branch_id'] = $this->input->post('branch_id');
            $data['level'] = 1;

            $this->db->insert('admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?full_admin/users/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'پاسورڈ ایک جیسا نہیں ہے۔۔۔');
            redirect(base_url() . 'index.php?full_admin/users/', 'refresh');
        }
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

    function students($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if (is_numeric($param1) && !empty($param1)) {
            $page_data['branch_id'] = $param1;
        }
        

        $page_data['branch_name'] = $this->db->get_where('branches', array('branch_id' => $param1))->row()->name;
        $page_data['page_name'] = 'student/students';
        $page_data['page_title'] = get_phrase('students');
        $this->load->view('backend/index', $page_data);
    }

    function manage_students($branch_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
// detect the first branch
        if ($branch_id == '')
            $branch_id = $this->db->get('branches')->first_row()->branch_id;

        if ($branch_id == 'manage') {
            $students = $this->input->post('student_id');
            $teacher_id = $this->input->post('teacher_id');
            foreach ($students as $data) {
                $this->db->where('student_id', $data);
                $this->db->where('year', $year);
                $this->db->update('enroll', array('teacher_id' => $teacher_id));
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?full_admin/manage_students/', 'refresh');
        }

        $page_data['branch_id'] = $branch_id;
        $page_data['teachers'] = $this->db->get_where('teacher', array('status' => 1, 'branch_id' => $branch_id))->result();
        $page_data['branches'] = $this->db->get_where('branches')->result();
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
        redirect(base_url() . 'index.php?full_admin/manage_students/', 'refresh');
    }

//Get Classes from branch
    function get_classes($branch_id) {
        $classes = $this->db->get_where('class', array('branch_id' => $branch_id))->result_array();
        echo '<option value=""> کلاس منتخب کریں</option>';
        foreach ($classes as $row) {
            echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
        }
    }

//Get Section from class
    function get_sections($class_id) {
        $sections = $this->db->get_where('section', array('section_id' => $class_id))->result_array();
        echo '<option value=""> سیکشن منتخب کریں</option>';
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    /*     * ****** CLASSES AND SECTION MANAGMENT******* */

    function manage_classes($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        if (is_numeric($param1)) {
            $branch_id = $param1;
        } else {
            $branch_id = '';
        }
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['branch_id'] = $this->input->post('branch_id');
            //$this->input->post('main_branch_id');

            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            //create a section by default
            $data2['class_id'] = $class_id;
            $data2['name'] = 'الف';
            $data2['nick_name'] = 'الف';
            $this->db->insert('section', $data2);

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?full_admin/manage_classes/' . $data['branch_id'], 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');

            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?full_admin/manage_classes', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');

            $this->db->where('class_id', $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?full_admin/manage_classes', 'refresh');
        }


        $page_data['branch_id'] = $branch_id;
        $page_data['page_name'] = 'classes/manage_class';
        $page_data['branch_name'] = $this->crud_model->get_column_name_by_id('branches', 'branch_id', $branch_id);
        $page_data['classes'] = $this->db->get_where('class', array('branch_id' => $branch_id))->result();
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }

    function manage_section($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'classes/manage_section';
        $page_data['page_title'] = get_phrase('section');

        if (!empty($param1) && is_numeric($param1)) {
            $class_id = $this->db->get_where('class', array('branch_id' => $param1))->first_row()->class_id;
            $page_data['class_id'] = $class_id;
            $page_data['branch_id'] = $param1;
        }
        if ($param1 == 'sections') {
            $page_data['class_id'] = $param2;
            $page_data['branch_id'] = $param3;
        }
        $page_data['branches'] = $this->db->get('branches')->result();
        $this->load->view('backend/index', $page_data);
    }

    function sections($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['nick_name'] = $this->input->post('nick_name');
            $data['class_id'] = $this->input->post('class_id');
            $this->db->insert('section', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?full_admin/manage_section/sections/' . $data['class_id'] . '/' . $param2, 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['nick_name'] = $this->input->post('nick_name');
            $data['class_id'] = $this->input->post('class_id');
            $this->db->where('section_id', $param2);
            $this->db->update('section', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?full_admin/manage_section/sections/' . $data['class_id'] . '/' . $param3, 'refresh');
        }

        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('section', array('section_id' => $param2))->row()->class_id;
            $this->db->where('section_id', $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?full_admin/manage_section/sections/' . $class_id . '/' . $param3, 'refresh');
        }
    }

    /*     * ******Teacher Managment ****** */

    function teacher($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if (is_numeric($param1)) {
            $page_data['branch_id'] = $param1;
        }

        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['nic'] = $this->input->post('nic');
            $data['c_address'] = $this->input->post('c_address');
            $data['p_address'] = $this->input->post('p_address');
            $data['branch_id'] = $this->input->post('branch_id');
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
            $ids = explode('-', $param2);
            $teacher_id = $ids[0];
            $branch_id = $ids[1];
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

            $this->db->where('teacher_id', $teacher_id);
            $this->db->update('teacher', $data);

            if (!empty(($_FILES["teacher_image"]["name"]))) {
                $image_data = $this->crud_model->upload_image('teacher_image', 'teacher_image');
                $where = $this->db->where('teacher_id', $teacher_id);
                $this->crud_model->update('teacher', $image_data, $where);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?full_admin/teacher/' . $branch_id, 'refresh');
        }

        if ($param1 == 'delete') {
            $ids = explode('-', $param2);
            $teacher_id = $ids[0];
            $branch_id = $ids[1];
            $this->db->where('teacher_id', $teacher_id);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?full_admin/teacher/' . $branch_id, 'refresh');
        }

        $page_data['teachers'] = $this->db->get_where('teacher', array('branch_id' => $page_data['branch_id']))->result();
        $page_data['page_name'] = 'teacher/teacher';
        $page_data['page_title'] = get_phrase('teacher');
        $this->load->view('backend/index', $page_data);
    }

}
