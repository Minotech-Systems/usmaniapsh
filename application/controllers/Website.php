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

class Website extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');
//                  $this->db->select('lib_books.book_name,lib');  
//                  $this->db->join('lib_publisher','lib_publisher.pub_id=lib_books.pub_id');  
//        $result = $this->db->get_where('lib_books')->result();
//        echo '<pre>';print_r($result);die;
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (empty($this->session->userdata('system_lang')) || $this->session->userdata('system_lang') == 'urdu') {
            $this->session->set_userdata('system_lang', 'urdu');
        }
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('ifta_admin_login') == 1)
            redirect(base_url() . 'website/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard($param1 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == '' || $param1 == 'about_jamia') {
            $page_data['page_content'] = 'about_jamia';
            $page_data['about_jamia'] = $this->db->get_where('web_settings', array('type' => 'about_jamia'))->row()->description;
        }

        if ($param1 == 'books') {
            $page_data['page_content'] = 'books';
            $page_data['books'] = $this->db->get('web_books')->result();
        }
        if ($param1 == 'jamia_tasees') {
            $page_data['page_content'] = 'jamia_tasees';
            $page_data['jamia_tasees'] = $this->db->get_where('web_settings', array('type' => 'jamia_tasees'))->row()->description;
        }
        if ($param1 == 'historical_travel') {
            $page_data['page_content'] = 'historical_travel';
            $page_data['historical_travel'] = $this->db->get_where('web_settings', array('type' => 'historical_travel'))->row()->description;
        }
        if ($param1 == 'jamia_aim') {
            $page_data['page_content'] = 'jamia_aim';
            $page_data['jamia_aim'] = $this->db->get_where('web_settings', array('type' => 'jamia_aim'))->row()->description;
        }
        if ($param1 == 'news_updates') {
            $page_data['page_content'] = 'news_updates';
            $page_data['news'] = $this->db->get('frontend_news')->result();
        }
        if ($param1 == 'departments') {
            $page_data['page_content'] = 'departments';
            $page_data['departments'] = $this->db->get_where('web_settings', array('type' => 'departments'))->row()->description;
        }
        if ($param1 == 'admission_notice') {
            $page_data['page_content'] = 'admission_notice';
            $page_data['notice'] = $this->db->get('frontend_admission_notice')->row();
        }








        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/website', $page_data);
    }

//Jamia Books for frontend website
    function books($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add') {
            $data['description'] = $this->input->post('description');
            $data['name'] = $this->input->post('name');
            $data['date_added'] = date('Y-m-d H:i:s');
            $this->db->insert('web_books', $data);
            $book_id = $this->db->insert_id();
            if (!empty($_FILES['book_image']['name'])) {
                $book_file = $this->frontend_model->upload_image('book_image', 'books');
                $book_image = $book_file['file'];
                $this->db->where('book_id', $book_id);
                $this->db->update('web_books', array('image' => $book_image));
            }

            if (!empty($_FILES['book_file']['name'])) {
                $book_file1 = $this->frontend_model->upload_file('book_file', 'books');

                $book_file = $book_file1['file'];
                $this->db->where('book_id', $book_id);
                $this->db->update('web_books', array('file' => $book_file));
            }

            $this->session->set_flashdata('flash_message', 'کتاب کو کامیابی سے داخل کر دیا گیا');
            redirect(base_url() . 'website/books', 'refresh');
        }

        if ($param1 == 'update') {
            $data['description'] = $this->input->post('description1');
            $data['name'] = $this->input->post('name1');
            $data['show_on_website'] = $this->input->post('show_on_site');
            $this->db->where('book_id', $param2);
            $this->db->update('web_books', $data);
//Check image if change

            if (!empty($_FILES['book_image_e']['name'])) {
                $old_image = $this->db->get_where('web_books', array('book_id', $param2))->row()->image;
                if (!empty($old_image)) {
                    $this->crud_model->unlink('books', $old_image);
                }
//Upload new image
                $book_file2 = $this->frontend_model->upload_image('book_image_e', 'books');
                $book_image = $book_file2['file'];
                $this->db->where('book_id', $param2);
                $this->db->update('web_books', array('image' => $book_image));
            }
            $this->session->set_flashdata('flash_message', 'کتاب کی تصحیح کامیابی سے کر دی گئی ہے۔۔۔');
            redirect(base_url() . 'website/books', 'refresh');
        }

        if ($param1 == 'delete') {
            $book_data = $this->db->get_where('web_books', array('book_id' => $param2))->row();
            $this->crud_model->unlink('books', $book_data->image);
            $this->crud_model->unlink('books', $book_data->file);
            $this->db->where('book_id', $param2);
            $this->db->delete('web_books');
            $this->session->set_flashdata('flash_message', 'کتاب کو کامیابی سے ختم کر دیا گیا ہے۔۔۔');
            redirect(base_url() . 'website/books', 'refresh');
        }
        $page_data['books'] = $this->db->get('web_books')->result();
        $page_data['page_name'] = 'books';
        $page_data['page_title'] = get_phrase('books');
        $this->load->view('backend/website', $page_data);
    }

    function update_web_settings() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $type = $this->uri->segment(2);
        if ($type == 'about') {
            $data['description'] = $this->input->post('about_jamia');
            $this->db->where('type', 'about_jamia');
            $this->db->update('web_settings', $data);
        }
        if ($type == 'jamia_tasees') {
            $data['description'] = $this->input->post('jamia_tasees');
            $this->db->where('type', 'jamia_tasees');
            $this->db->update('web_settings', $data);
            $this->session->set_flashdata('flash_message', 'جامعہ سیٹنگس کو کامیابی سے اپڈیت کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/dashboard/jamia_tasees', 'refresh');
        }
        if ($type == 'historical_travel') {
            $data['description'] = $this->input->post('historical_travel');
            $this->db->where('type', 'historical_travel');
            $this->db->update('web_settings', $data);
            $this->session->set_flashdata('flash_message', 'جامعہ سیٹنگس کو کامیابی سے اپڈیت کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/dashboard/historical_travel', 'refresh');
        }
        if ($type == 'jamia_aim') {
            $data['description'] = $this->input->post('jamia_aim');
            $this->db->where('type', 'jamia_aim');
            $this->db->update('web_settings', $data);
            $this->session->set_flashdata('flash_message', 'جامعہ سیٹنگس کو کامیابی سے اپڈیت کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/dashboard/jamia_aim', 'refresh');
        }
        if ($type == 'departments') {
            $data['description'] = $this->input->post('departments');
            $this->db->where('type', 'departments');
            $this->db->update('web_settings', $data);
            $this->session->set_flashdata('flash_message', 'جامعہ سیٹنگس کو کامیابی سے اپڈیت کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/dashboard/departments', 'refresh');
        }
        if ($type == 'admission_notice') {
            $data['description'] = $this->input->post('notice');
            $data['title'] = $this->input->post('title');
            $this->db->update('frontend_admission_notice', $data);
            $this->session->set_flashdata('flash_message', 'جامعہ سیٹنگس کو کامیابی سے اپڈیت کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/dashboard/admission_notice', 'refresh');
        }


        $this->session->set_flashdata('flash_message', 'جامعہ سیٹنگس کو کامیابی سے اپڈیت کر دیا گیا۔۔۔');
        redirect(base_url() . 'website/dashboard', 'refresh');
    }

    function change_notice_status($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 1) {
            $this->db->update('frontend_admission_notice', array('status' => 1));
        } else {
            $this->db->update('frontend_admission_notice', array('status' => 0));
        }

        $this->session->set_flashdata('flash_message', 'امتحانی اعلان کو کامیابی سے آپڈیٹ کر دیا گیا۔۔۔');
        redirect(base_url() . 'website/dashboard/admission_notice', 'refresh');
    }

    function gallery() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/website', $page_data);
    }

    function gallery_image($param1 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'gallery_image';
        $page_data['page_title'] = get_phrase('gallery_image');
        $page_data['gallery_id'] = $param1;
        $this->load->view('backend/website', $page_data);
    }

    function gallery_photo_upload($param1) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $response = $this->frontend_model->upload_gallery_photo($param1);
//          echo $response;
        $this->session->set_flashdata('flash_message', 'تصویر کامیابی سے داخل کردیا گیا۔۔۔');
        redirect(base_url() . 'website/gallery_image/' . $param1, 'refresh');
    }

    function create_gallery() {
        $this->frontend_model->add_frontend_gallery();
        $this->session->set_flashdata('flash_message', 'گیلری کو کامیابی سے داخل کر دیاگیا۔۔۔');
        redirect(base_url() . 'website/gallery', 'refresh');
    }

    function gallery_photo_delete($param1, $param2) {
        $this->frontend_model->delete_gallery_photo($param1);
        $this->session->set_flashdata('flash_message', 'تصویر کو کامیابی سے حذف کر دیا گیا۔۔۔');
        redirect(base_url() . 'website/gallery_image/' . $param2, 'refresh');
    }

    //FRONTEND GALLERY
    public function frontend_gallery($param1 = "", $param2 = "", $param3 = "") {
        if ($param1 == 'create') {
            $this->frontend_model->add_frontend_gallery();
            $this->session->set_flashdata('flash_message', 'گیلری کو کامیابی سے آپڈیٹ کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/gallery/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->frontend_model->delete_frontend_gallery($param2);
            $this->session->set_flashdata('flash_message', 'گیلری کو کامیابی سے حذف کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/gallery/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->frontend_model->update_frontend_gallery($param2);
            $this->session->set_flashdata('flash_message', 'گیلری کو کامیابی سے آپڈیٹ کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/gallery/', 'refresh');
        }
    }

    function position_holders() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'position_holders';
        $page_data['page_title'] = get_phrase('position_holders');
        $this->load->view('backend/website', $page_data);
    }

    function add_position_holder($param1 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['name'] = $this->input->post('name');
        $data['father_name'] = $this->input->post('father_name');
        $data['roll_no'] = $this->input->post('roll_no');
        $data['marks'] = $this->input->post('marks');
        $data['position'] = $this->input->post('position');
        $data['session'] = $this->input->post('session');
        $data['district_id'] = $this->input->post('district_id');
        $data['class_id'] = $this->input->post('class_id');
        $data['position_type'] = $this->input->post('position_type');
        $this->db->insert('web_position_holders', $data);
        $id = $this->db->insert_id();

        if (!empty($_FILES['student_image']['name'])) {
            $student_image = $this->frontend_model->upload_image('student_image', 'images/position_holder');
            $image = $student_image['file'];
            $this->db->where('id', $id);
            $this->db->update('web_position_holders', array('image' => $image));
        }

        $this->session->set_flashdata('flash_message', 'پوزیشن کو کامیابی سے داخل کردیاگیا۔۔۔۔');
        redirect(base_url() . 'website/position_holders', 'refresh');
    }

    function update_position_holder($param1 = '') {
        $id_in = $this->input->post('pos_id');
        $data2['name'] = $this->input->post('name');
        $data2['father_name'] = $this->input->post('father_name');
        $data2['roll_no'] = $this->input->post('roll_no');
        $data2['marks'] = $this->input->post('marks');
        $data2['position'] = $this->input->post('position');
        $data2['session'] = $this->input->post('session');
        $data2['district_id'] = $this->input->post('district_id');
        $data2['class_id'] = $this->input->post('class_id');
        $data2['position_type'] = $this->input->post('position_type');
        $this->db->where('id', $id_in);
        $this->db->update('web_position_holders', $data2);

        if (!empty($_FILES['student_image']['name'])) {
            $old_image = $this->db->get_where('web_position_holders', array('id', $id_in))->row()->image;
            if (!empty($old_image)) {
                $this->crud_model->unlink('images/position_holder', $old_image);
            }
            $student_image = $this->frontend_model->upload_image('student_image', 'images/position_holder');
            $image = $student_image['file'];
            $this->db->where('id', $id_in);
            $this->db->update('web_position_holders', array('image' => $image));
        }

        $this->session->set_flashdata('flash_message', 'پوزیشن کو کامیابی سے داخل کردیاگیا۔۔۔۔');
        redirect(base_url() . 'website/position_holders', 'refresh');
    }

    function web_settings() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'web_settings';
        $page_data['page_title'] = get_phrase('settings');
        $this->load->view('backend/website', $page_data);
    }

    function web_settings_update() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['description'] = $this->input->post('name');
        $this->db->where('type', 'name');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('mobile');
        $this->db->where('type', 'mobile');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('email');
        $this->db->where('type', 'email');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('account_no');
        $this->db->where('type', 'account_no');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('ibn_no');
        $this->db->where('type', 'ibn_no');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('branch_name');
        $this->db->where('type', 'branch_name');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('branch_code');
        $this->db->where('type', 'branch_code');
        $this->db->update('web_settings', $data);

        $data['description'] = $this->input->post('cooperation_process');
        $this->db->where('type', 'cooperation_process');
        $this->db->update('web_settings', $data);

        $this->session->set_flashdata('flash_message', 'ویب سائٹ کو کامیابی سے آپڈیٹ کر دیا گیا۔۔۔۔');
        redirect(base_url() . 'website/web_settings', 'refresh');
    }

    function alasr_resala($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['year'] = $this->input->post('year');
            $data['date'] = date('Y-m-d');
            $this->db->insert('web_alasr_resala', $data);
            $id = $this->db->insert_id();
            if (!empty($_FILES['image']['name'])) {

                $resala_image = $this->frontend_model->upload_image('image', 'alasr');
                $image = $resala_image['file'];
                $this->db->where('id', $id);
                $this->db->update('web_alasr_resala', array('image' => $image));
            }
            if (!empty($_FILES['file']['name'])) {
                $resala_file = $this->frontend_model->upload_file('file', 'alasr');
                $file = $resala_file['file'];
                $this->db->where('id', $id);
                $this->db->update('web_alasr_resala', array('file' => $file));
            }

            $this->session->set_flashdata('flash_message', 'العصر رسالہ کو کامیابی سے داخل کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/alasr_resala', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['year'] = $this->input->post('year');
            $this->db->where('id', $param2);
            $this->db->update('web_alasr_resala', $data);

            if (!empty($_FILES['image']['name'])) {
                $resala_data = $this->db->get_where('web_alasr_resala', array('id', $param2))->row();
                if (!empty($resala_data->image)) {
                    $this->crud_model->unlink('alasr', $resala_data->image);
                }
                $resala_image = $this->frontend_model->upload_image('image', 'alasr');
                $image = $resala_image['file'];
                $this->db->where('id', $param2);
                $this->db->update('web_alasr_resala', array('image' => $image));
            }

            if (!empty($_FILES['file']['name'])) {
                $resala_data1 = $this->db->get_where('web_alasr_resala', array('id', $param2))->row();
                if (!empty($resala_data1->file)) {
                    $this->crud_model->unlink('alasr', $resala_data1->file);
                }
                $resala_file = $this->frontend_model->upload_file('file', 'alasr');
                $file = $resala_file['file'];
                $this->db->where('id', $param2);
                $this->db->update('web_alasr_resala', array('file' => $file));
            }
            $this->session->set_flashdata('flash_message', 'العصر رسالہ کو کامیابی سے تصحح کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/alasr_resala', 'refresh');
        }
        if ($param1 == 'delete') {
            $resala_data = $this->db->get_where('web_alasr_resala', array('id', $param2))->row();
            if (!empty($resala_data->image)) {
                $this->crud_model->unlink('alasr', $resala_data->image);
            }
            if (!empty($resala_data->file)) {
                $this->crud_model->unlink('alasr', $resala_data->file);
            }

            $this->db->where('id', $param2);
            $this->db->delete('web_alasr_resala');
            $this->session->set_flashdata('flash_message', 'العصر رسالہ کو کامیابی سے حذف کر دیا گیا۔۔۔');
            redirect(base_url() . 'website/alasr_resala', 'refresh');
        }


        $page_data['page_name'] = 'alasr_resala';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }

    function alasr_book($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add_book') {


            if ($this->input->post()):

                $book = $this->input->post('book');
                $edition = $this->input->post('edition');
               
                $publish= date('Y-m-d',strtotime($this->input->post('publish')));
               
                $expire= date('Y-m-d',strtotime($this->input->post('expiery')));
               
                $data = array('book_name' => $book, 'book_edition' => $edition, 'book_publish_date' => $publish,
                    'book_expirey_date' => $expire, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_at' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_books', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'کتاب کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_book', 'refresh');
        }
        if ($param1 == 'update_book') {
            $book = $this->input->post('book');
            $edition = $this->input->post('edition');

            $publish= date('Y-m-d',strtotime($this->input->post('publish')));
            $expire= date('Y-m-d',strtotime($this->input->post('expiery')));
            
            $update_data = array('book_name' => $book, 'book_edition' => $edition, 'book_publish_date' => $publish,
           'book_expirey_date' => $expire, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_at' => date('Y-m-d H:i:s'));

            $this->db->where('book_id', $param2);
            $this->db->update('lib_books', $update_data);


            $this->session->set_flashdata('flash_message', 'کتاب کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_book', 'refresh');
        }
        if ($param1 == 'delete_book') {

            $this->db->where('book_id', $param2);
            $this->db->delete('lib_books');
            $this->session->set_flashdata('flash_message', 'کتاب کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_book', 'refresh');
        }


        $page_data['page_name'] = 'alasr_book';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }

    function alasr_musanif($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add_musf') {


            if ($this->input->post()):

                $name = $this->input->post('name');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $data = array('name' => $name, 'phone' => $phone, 'address' => $address, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_datetime' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_authors', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'مصنف کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_resala', 'refresh');
        }
        if ($param1 == 'update_musf') {

            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $update_data = array('name' => $name, 'address' => $address, 'phone' => $phone, 'update_datetime' => date('Y-m-d H:i:s'));


            $this->db->where('autr_id', $param2);
            $this->db->update('lib_authors', $update_data);


            $this->session->set_flashdata('flash_message', 'مصنف کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_musanif', 'refresh');
        }
        if ($param1 == 'delete_musf') {

            $this->db->where('autr_id', $param2);
            $this->db->delete('lib_authors');
            $this->session->set_flashdata('flash_message', 'مصنف کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_musanif', 'refresh');
        }


        $page_data['page_name'] = 'alasr_musanif';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }

    function alasr_topic($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add_topic') {

            if ($this->input->post()):

                $topic = $this->input->post('topicname');
               // $subtopic = $this->input->post('subtopic');
                $reference = $this->input->post('reference');
                $data = array('top_name' => $topic,'top_reference' => $reference, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_at' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_topics', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'ٹاپک کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_topic', 'refresh');
        }
        if ($param1 == 'update_topic') {
            $topic = $this->input->post('topicname');
           // $subtopic = $this->input->post('subtopic');
            $reference = $this->input->post('reference');
            $update_data = array('top_name' => $topic, 'top_reference' => $reference, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_at' => date('Y-m-d H:i:s'));


            $this->db->where('top_id', $param2);
            $this->db->update('lib_topics', $update_data);

            $this->session->set_flashdata('flash_message', 'ٹاپک کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_topic', 'refresh');
        }
        if ($param1 == 'delete_topic') {

            $this->db->where('top_id', $param2);
            $this->db->delete('lib_topics');
            $this->session->set_flashdata('flash_message', 'ٹاپک کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_topic', 'refresh');
        }


        $page_data['page_name'] = 'alasr_topic';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    } 
    function alasr_subtopic($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add_subtopic') {

            if ($this->input->post()):

                $topic = $this->input->post('subtopicname');
                $reference = $this->input->post('reference');
                $data = array('sub_topic_name' => $topic, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_at' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_subtopic', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'سب ٹاپک کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_subtopic', 'refresh');
        }
        if ($param1 == 'update_subtopic') {
            $topic = $this->input->post('subtopicname');
            $update_data = array('sub_topic_name' => $topic, 'create_by' => $this->session->userdata('ifta_admin_login'), 'create_at' => date('Y-m-d H:i:s'));


            $this->db->where('sub_topic_id', $param2);
            $this->db->update('lib_subtopic', $update_data);

            $this->session->set_flashdata('flash_message', 'سب ٹاپک کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_subtopic', 'refresh');
        }
        if ($param1 == 'delete_subtopic') {

            $this->db->where('sub_topic_id', $param2);
            $this->db->delete('lib_subtopic');
            $this->session->set_flashdata('flash_message', 'سب ٹاپک کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_subtopic', 'refresh');
        }


        $page_data['page_name'] = 'alasr_subtopic';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }
    
    function alasr_reader($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');
           
        if ($param1 == 'add_reader') {
            if ($this->input->post()):

                $name = $this->input->post('name');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $data = array('read_name' => $name, 'read_phone' => $phone, 'read_address' => $address,'read_email'=>$email, 'created_by' => $this->session->userdata('ifta_admin_login'), 'created_at' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_reader', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'قاری کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_reader', 'refresh');
        }
        if ($param1 == 'update_reader') {
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $update_data = array('read_name' => $name, 'read_phone' => $phone, 'read_address' => $address,'read_email'=>$email, 'updated_by' => $this->session->userdata('ifta_admin_login'), 'updated_at' => date('Y-m-d H:i:s'));
               

            $this->db->where('read_id', $param2);
            $this->db->update('lib_reader', $update_data);


            $this->session->set_flashdata('flash_message', 'قاری کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_reader', 'refresh');
        }
        if ($param1 == 'delete_reader') {

            $this->db->where('read_id', $param2);
            $this->db->delete('lib_reader');
            $this->session->set_flashdata('flash_message', 'قاری کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_reader', 'refresh');
        }


        $page_data['page_name'] = 'alasr_reader';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }

    function alasr_readertype($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');
           
        if ($param1 == 'add_readertype') {
            if ($this->input->post()):

                $name = $this->input->post('name');
                $data = array('readtype_name' => $name, 'created_by' => $this->session->userdata('ifta_admin_login'), 'created_at' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_readertype', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'قسم کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_readertype', 'refresh');
        }
        if ($param1 == 'update_readertype') {
            $name = $this->input->post('name');
            $update_data = array('readtype_name' => $name, 'updated_by' => $this->session->userdata('ifta_admin_login'), 'updated_at' => date('Y-m-d H:i:s'));
               

            $this->db->where('readtype_id', $param2);
            $this->db->update('lib_readertype', $update_data);


            $this->session->set_flashdata('flash_message', 'قسم کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_readertype', 'refresh');
        }
        if ($param1 == 'delete_readertype') {

            $this->db->where('readtype_id', $param2);
            $this->db->delete('lib_readertype');
            $this->session->set_flashdata('flash_message', 'قسم کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_readertype', 'refresh');
        }


        $page_data['page_name'] = 'alasr_readertype';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }
    function alasr_publisher($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url(), 'refresh');
           
        if ($param1 == 'add_publisher') {
            if ($this->input->post()):

                $name = $this->input->post('name');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $email = $this->input->post('email');
                $data = array('pub_name' => $name, 'pub_phone' => $phone, 'pub_address' => $address,'pub_email'=>$email, 'created_by' => $this->session->userdata('ifta_admin_login'), 'created_at' => date('Y-m-d H:i:s'));
                $this->db->insert('lib_publisher', $data);
            endif;
            $this->session->set_flashdata('flash_message', 'ناشرکتب کو کامیابی سے داخل کر دیا گیا ہے۔');
            redirect(base_url() . 'website/alasr_publisher', 'refresh');
        }
        if ($param1 == 'update_publisher') {
           
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $update_data = array('pub_name' => $name, 'pub_phone' => $phone, 'pub_address' => $address,'pub_email'=>$email, 'updated_by' => $this->session->userdata('ifta_admin_login'), 'updated_at' => date('Y-m-d H:i:s'));
                       
            $this->db->where('pub_id', $param2);
            $this->db->update('lib_publisher', $update_data);


            $this->session->set_flashdata('flash_message', 'ناشرکتب کی کامیابی سے تصیح کردیگی ہے۔');
            redirect(base_url() . 'website/alasr_publisher', 'refresh');
        }
        if ($param1 == 'delete_publisher') {

            $this->db->where('pub_id', $param2);
            $this->db->delete('lib_publisher');
            $this->session->set_flashdata('flash_message', 'ناشرکتب کو کامیابی سے حذف کر دیا گیاہے۔');
            redirect(base_url() . 'website/alasr_publisher', 'refresh');
        }


        $page_data['page_name'] = 'alasr_publisher';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }
     function alasr_create_book()
    {
        //redirect(base_url() . 'website/alasr_create_book', 'refresh');
        $page_data['page_name'] = 'alasr_create_book';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('backend/website', $page_data);
    }
}   
