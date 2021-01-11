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

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('question_model');


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

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'dashboard';
        $page_data['mujeeb_solved_questions'] = $this->admin_model->get_solved_questions();
        $page_data['questions'] = $this->question_model->get_unsolved_question_data();
        $page_data['page_title'] = get_phrase('admin_dashboard');
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

            if (!empty($_FILES["admin_image"]["name"])) {

                $image_data = $this->crud_model->upload_image('admin_image', 'admin_image');
                $where = $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->crud_model->update('ifta_admin', $image_data, $where);
            }

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('ifta_admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = $this->crud_model->hash($this->input->post('password'));
            $data['new_password'] = $this->crud_model->hash($this->input->post('new_password'));
            $data['confirm_new_password'] = $this->crud_model->hash($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('ifta_admin', array(
                        'admin_id' => $this->session->userdata('admin_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('ifta_admin', array(
                    'password' => $data['new_password']
                ));

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('ifta_admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function users($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $data['name'] = $this->input->post('name');
            $data['user_name'] = $this->crud_model->Encrypt($this->input->post('user_name'));
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['password'] = $this->crud_model->hash($this->input->post('password'));
            $confirm_password = $this->input->post('confirm_password');

            // Check user_name if already exist
            $where1 = $this->db->where('user_name', $data['user_name']);
            $check = $this->admin_model->check('ifta_users', $where1);
            if ($check == FALSE) {
                $this->session->set_flashdata('error_message', get_phrase('user_name_already_exist'));
                redirect(base_url() . 'admin/users/', 'refresh');
            } else {
                if ($confirm_password == $this->input->post('password')) {
                    $this->db->insert('ifta_users', $data);
                    $user_id = $this->db->insert_id();
                    // if the image is set to upload for the user
                    if (!empty($_FILES["user_image"]["name"])) {
                        $image_data = $this->crud_model->upload_image('user_image', 'user_image');
                        $where = $this->db->where('user_id', $user_id);
                        $this->crud_model->update('ifta_users', $image_data, $where);
                    }

                    $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
                    redirect(base_url() . 'admin/users/', 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('password_not_matching'));
                    redirect(base_url() . 'admin/users/', 'refresh');
                }
            }
        }
        if ($param1 == 'update') {

            $data['name'] = $this->input->post('name');
            $data['user_name'] = $this->crud_model->Encrypt($this->input->post('user_name'));
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');

            $where1 = $this->db->where('user_name', $data['user_name']);
            $check = $this->admin_model->check('ifta_users', $where1);
            $user_name = $this->db->get_where('ifta_users', array('user_id' => $param2))->row()->user_name;
            if ($user_name == $data['user_name']) {
                if (!empty($_FILES["user_image"]["name"])) {
                    $old_file = $this->db->get_where('ifta_users', array('user_id' => $param2))->row()->image;
                    if (!empty($old_file)) {
                        $this->crud_model->unlink('user_image', $old_file);
                    }
                    $image_data = $this->crud_model->upload_image('user_image', 'user_image');
                    $where = $this->db->where('user_id', $param2);
                    $this->crud_model->update('ifta_users', $image_data, $where);
                }

                $this->db->where('user_id', $param2);
                $this->db->update('ifta_users', $data);
            } else {
                if ($check == FALSE) {
                    $this->session->set_flashdata('error_message', get_phrase('user_name_already_exist'));
                    redirect(base_url() . 'admin/users/', 'refresh');
                } else {
                    if (!empty($_FILES["user_image"]["name"])) {
                        $old_file = $this->db->get_where('ifta_users', array('user_id' => $param2))->row()->image;
                        if (!empty($old_file)) {
                            $this->crud_model->unlink('user_image', $old_file);
                        }
                        $image_data = $this->crud_model->upload_image('user_image', 'user_image');
                        $where = $this->db->where('user_id', $param2);
                        $this->crud_model->update('ifta_users', $image_data, $where);
                    }

                    $this->db->where('user_id', $param2);
                    $this->db->update('ifta_users', $data);
                }
            }


            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'admin/users/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('user_id', $param2);
            $this->db->delete('ifta_users');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'admin/users/', 'refresh');
        }
        $page_data['users'] = $this->db->get('ifta_users')->result();
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'users/users';
        $page_data['page_title'] = get_phrase('system_users');
        $this->load->view('backend/index', $page_data);
    }

    function update_user($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['user_data'] = $this->db->get_where('ifta_users', array('user_id' => $param1))->result();
        $page_data['page_name'] = 'users/update_user';
        $page_data['page_title'] = get_phrase('system_users');
        $this->load->view('backend/index', $page_data);
    }

    function lock_user($user_id) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $this->db->where('user_id', $user_id);
        $this->db->update('ifta_users', array('status' => 0));
        $this->session->set_flashdata('flash_message', 'مجیب کو کامیابی سے لاک کر دیا گیا۔۔۔');
        redirect(base_url() . 'admin/users/', 'refresh');
    }

    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $page_data['ifta_books'] = $this->admin_model->get_ifta_books();
        $page_data['ifta_books_lessons'] = $this->admin_model->get_book_lessons();
        $page_data['ifta_book_chapters'] = $this->admin_model->get_table_data('ifta_books_chapters');
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*     * ******** Ifta Books Managment ****** */

    function add_book() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['name'] = $this->input->post('book');
        $this->db->insert('ifta_books', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function update_book($param) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['name'] = $this->input->post('name');
        $data['comment'] = $this->input->post('comment');
        $this->db->where('book_id', $param);
        $this->db->update('ifta_books', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function delete_book($param) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $this->db->where('book_id', $param);
        $this->db->delete('ifta_books');

        $this->db->where('book_id', $param);
        $this->db->delete('ifta_books_chapters');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function get_book_chapters($book_id) {

        $chapters = $this->db->get_where('ifta_books_chapters', array('book_id' => $book_id))->result();
        echo '<option value="">باب منتخب کریں</option>';
        foreach ($chapters as $row) {
            echo '<option value="' . $row->chapter_id . '">' . $row->name . '</option>';
        }
    }

    function get_chapter_lesson($chapter_id) {

        $lessons = $this->db->get_where('ifta_chapter_lessons', array('chapter_id' => $chapter_id))->result();
        echo '<option value="">فصل منتخب کریں</option>';
        foreach ($lessons as $row) {
            echo '<option value="' . $row->lesson_id . '">' . $row->name . '</option>';
        }
    }

    function add_book_chapter() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['book_id'] = $this->input->post('book_id');
        $data['name'] = $this->input->post('chapter');
        $this->db->insert('ifta_books_chapters', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function update_book_chapter($param) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['book_id'] = $this->input->post('book_id');
        $data['name'] = $this->input->post('name');
        $this->db->where('chapter_id', $param);
        $this->db->update('ifta_books_chapters', $data);

        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function delete_book_chapter($param) {
        $this->db->where('chapter_id', $param);
        $this->db->delete('ifta_books_chapters');

        $this->db->where('chapter_id', $param);
        $this->db->delete('ifta_chapter_lessons');

        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function add_book_lessons() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['book_id'] = $this->input->post('lesson_book_id');
        $data['chapter_id'] = $this->input->post('chapters');
        $data['name'] = $this->input->post('lesson');

        $this->db->insert('ifta_chapter_lessons', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function update_book_lesson($param) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['book_id'] = $this->input->post('book_id');
        $data['chapter_id'] = $this->input->post('chapter_id');
        $data['name'] = $this->input->post('name');

        $this->db->where('lesson_id', $param);
        $this->db->update('ifta_chapter_lessons', $data);
        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function delete_lesson($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $this->db->where('lesson_id', $param1);
        $this->db->delete('ifta_chapter_lessons');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(base_url() . 'admin/system_settings/', 'refresh');
    }

    function count_new_questions() {
        echo $this->db->where(array('status' => 0, 'admin_view_status' => 0))->from("ifta_question")->count_all_results();
    }

    function count_solved_questions() {
        echo $this->db->where(array('solved_status' => 1, 'admin_view_status' => 0))->from("ifta_user_question")->count_all_results();
    }

    function load_notifications($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'new_question') {
            $this->load->view('backend/admin/new_question_notif.php');
        } elseif ($param1 == 'solved_question') {
            $this->load->view('backend/admin/solved_question_notif.php');
        }
    }

    function viewed_question() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $question_id = $this->input->get('question_id');
        $this->db->where('question_id', $question_id);
        $this->db->update('ifta_question', array('admin_view_status' => 1));
    }

    function viewed_answer() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $question_id = $this->input->get('question_id');
        $this->db->where('question_id', $question_id);
        $this->db->update('ifta_user_question', array('admin_view_status' => 1));
    }

    function load_solved_question() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $this->load->view('backend/admin/mujeeb_solved_question.php');
    }

    /*
      |--------------------------------------------------------------------------
      | Mujeeb Data about fatawas
      |--------------------------------------------------------------------------
     */

    function mujeeb_fatwa_info($param1 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'search') {
            $page_data['user_id'] = $this->input->post('user_id');
            $page_data['book_id'] = $this->input->post('book_id');
            $page_data['chapter_id'] = $this->input->post('chapter_id');
            $page_data['lesson_id'] = $this->input->post('lesson_id');
        } else {
            $page_data['user_id'] = '';
            $page_data['book_id'] = '';
            $page_data['chapter_id'] = '';
            $page_data['lesson_id'] = '';
        }
        $page_data['page_name'] = 'users/mujeeb_fatwa_info';
        $page_data['ifta_users'] = $this->admin_model->get_ifta_users();
        $page_data['ifta_books'] = $this->admin_model->get_ifta_books();
        $page_data['page_title'] = get_phrase('system_settings');
        $this->load->view('backend/index', $page_data);
    }

    function add_news() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['news_title'] = $this->input->post('news_title');
        $data['news_description'] = $this->input->post('news_description');
        $data['create_date'] = date('Y-m-d', strtotime($this->input->post('create_date')));
        $data['show_on_website'] = 1;
        $file_name = $this->input->post('file_name');
        $this->db->insert('frontend_news', $data);
        $news_id = $this->db->insert_id();
        if (!empty($_FILES['news_file']['name'])) {
            $user_file = $this->crud_model->upload_file('news', 'news_file');

            $data_f['news_id'] = $news_id;
            $data_f['file'] = $user_file['file'];
            $data_f['file_name'] = $file_name;
            $this->db->insert('news_files', $data_f);
        }

        $this->session->set_flashdata('flash_message', 'News Added Successfully...');
        redirect(site_url('website/dashboard/news_updates'), 'refresh');
    }

    function upload_news_file() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $news_id = $this->input->post('news_id');
        $file_name = $this->input->post('file_name');
        if (!empty($_FILES['file']['name'])) {
            $user_file = $this->crud_model->upload_file('news', 'file');

            $data_f['news_id'] = $news_id;
            $data_f['file'] = $user_file['file'];
            $data_f['file_name'] = $file_name;
            $this->db->insert('news_files', $data_f);
        }
        $this->session->set_flashdata('flash_message', 'News File Added Successfully...');
        redirect(site_url('website/dashboard/news_updates'), 'refresh');
    }

    function update_news() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $news_id = $this->input->post('news_id');
        $data['news_title'] = $this->input->post('news_title');
        $data['news_description'] = $this->input->post('news_description');
        $data['create_date'] = date('Y-m-d', strtotime($this->input->post('create_date')));

        $this->db->where('news_id', $news_id);
        $this->db->update('frontend_news', $data);
        $this->session->set_flashdata('flash_message', 'News Updated Successfully...');
        redirect(site_url('website/dashboard/news_updates'), 'refresh');
    }

}
