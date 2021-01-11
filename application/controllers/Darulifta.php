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

class Darulifta extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('question_model');
        $this->load->model('fatwa_model');
        $this->load->model('email_model');
        $this->load->library("pagination");


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (empty($this->session->userdata('system_lang')) || $this->session->userdata('system_lang') == 'urdu') {
            $this->session->set_userdata('system_lang', 'urdu');
        }
    }

    public function index() {

        $limit['param1'] = 6;
        $limit['param2'] = 0;
        $page_data['page_name'] = 'darulifta';
        $page_data['ifta_books'] = $this->db->get('ifta_books')->result();
        $page_data['limit_books'] = $this->frontend_model->get_table_data('ifta_books', '', '', '', $limit, 'other');

        $page_data['page_title'] = 'دارالافتاء جامعہ عثمانہ پشاور';
        $this->load->view('front_end/index', $page_data);
    }

    public function new_questions() {
        $where = array();
        $where['status'] = 1;
        $where['show_no_site'] = 1;

        $total_rows = $this->frontend_model->count_question($where);
        $config = pagination('darulifta/new_questions', $total_rows, 30, 3);

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $limit['param1'] = 30;
        $limit['param2'] = $page;
        $order = "question_id desc";
        $page_data["links"] = $this->pagination->create_links();
        $page_data["questions"] = $this->frontend_model->search_question($where, $like, $limit, $order);
        $page_data['page_name'] = 'new_questions';
        $page_data['page_title'] = 'دارالافتاء جامعہ عثمانہ پشاور';
        $this->load->view('front_end/index', $page_data);
    }

    public function ask_questions() {
        $page_data['page_name'] = 'ask_questions';
        $page_data['page_title'] = 'دارالافتاء جامعہ عثمانہ پشاور';
        $this->load->view('front_end/index', $page_data);
    }

    public function user_questions() {
        $islamic_date = Greg2Hijri(date('d'), date('m'), date('Y'));
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        $data1['question'] = $this->input->post('question');
        $data1['title'] = $this->input->post('title');


        //check if important field is filled
        if (!empty($data['name']) & !empty($data['email']) && !empty($data1['question'])) {
            //inserting questioner data first
            $check_email = $this->db->get_where('ifta_questioner', array('email' => $this->input->post('email')))->row();
            if (empty($check_email)) {
                $this->db->insert('ifta_questioner', $data);
                $questioner_id = $this->db->insert_id();
                $pass = explode('@', $this->input->post('email'));
                $password = $pass[0] . $questioner_id;
                $encr_pass = $this->crud_model->hash($password);
                $this->db->where('questioner_id', $questioner_id);
                $this->db->update('ifta_questioner', array('password' => $encr_pass));
            } else {
                $questioner_id = $check_email->questioner_id;
            }


            $data1['questioner_id'] = $questioner_id;
            $data1['date_added'] = date('Y-m-d');
            $data['islamic_date'] = $islamic_date['year'] . '-' . $islamic_date['month'] . '-' . $islamic_date['day'];
            $this->db->insert('ifta_question', $data1);
            // Gettting question id
            $question_id = $this->db->insert_id();
            $question_no = $islamic_date['year'] . $question_id;
            // Update question for inserting question number 
            $this->db->where('question_id', $question_id);
            $this->db->update('ifta_question', array('question_no' => $question_no));
            $data['question_no'] = $question_no;
            $data['question'] = $data1['question'];
            //Email
            $this->send_client_email('ask_question', $data['email'], $data);
            $this->session->set_flashdata('flash_message', 'success');
            redirect(base_url() . 'ask_question', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'برائے مہربانی قواعد وضوابط کے ساتھ تمام معلومات کا اندراج کریں');
            redirect(base_url() . 'ask_question', 'refresh');
        }
    }

    function send_client_email($type, $email, $data) {
        switch ($type) {
            case 'ask_question':
                return $this->send_askquestion_email($email, $data);
                break;
            case 'forgot_password':
                return $this->send_email_forgot_password($email, $data);
                break;
            case 'reset_password':
                return $this->send_email_reset_password($email, $data);
                break;
        }
    }

    function send_askquestion_email($email, $data) {

        $email_template = $this->check_by(array('email_group' => 'ask_question'), 'tbl_email_templates');

        $email_body = str_replace("{name}", $data['name'], $email_template->template_body);
        $user_email = str_replace("{email}", $data['email'], $email_body);
        $message = str_replace("{question}", $data['question'], $user_email);

        $params['recipient'] = $email;
        $params['subject'] = ' فتویٰ نمبر' . ' : ' . $data['question_no'];
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        return $result = $this->email_model->send_email($params);
    }

    public function check_by($where, $tbl_name) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function search_individual_question() {
        $type = $this->uri->segment(2);

        if ($type == 'kitab') {
            $book_data = $this->db->get_where('ifta_books', array('eng_name' => $this->uri->segment(3)))->row();
            if (!empty($book_data)) {
                $this->session->set_userdata('search_book', $book_data->book_id);
            }
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['status'] = 1;
            $where['show_no_site'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_chapter_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif ($type == 'baab') {
            $cahpter_data = $this->db->get_where('ifta_books_chapters', array('eng_name' => $this->uri->segment(3)))->row();
            if (!empty($cahpter_data)) {
                $this->session->set_userdata('search_book', $cahpter_data->book_id);
                $this->session->set_userdata('search_chapter', $cahpter_data->chapter_id);
            }
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['chapter_id'] = $this->session->userdata('search_chapter');
            $where['status'] = 1;
            $where['show_no_site'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_chapter_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif ($type == 'fasal') {
            $lesson_data = $this->db->get_where('ifta_chapter_lessons', array('eng_name' => $this->uri->segment(3)))->row();
            if (!empty($lesson_data)) {
                $this->session->set_userdata('search_book', $lesson_data->book_id);
                $this->session->set_userdata('search_chapter', $lesson_data->chapter_id);
                $this->session->set_userdata('search_lesson', $lesson_data->lesson_id);
            }
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['chapter_id'] = $this->session->userdata('search_chapter');
            $where['lesson_id'] = $this->session->userdata('search_lesson');
            $where['status'] = 1;
            $where['show_no_site'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_chapter_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        }
    }

    //Read Question 
    function read_question() {
        $question_data = $this->db->get_where('ifta_question', array('question_no' => $this->uri->segment(2)))->row();
        $page_data['page_name'] = 'read_question';
        $page_data['question_data'] = $this->frontend_model->get_fatwa_data($question_data->question_id);
        $page_data['page_title'] = $this->uri->segment(2);
        $this->load->view('front_end/index', $page_data);
    }

    function search_question() {
        $word = $this->input->get('word');
        $book_id = $this->input->get('book_id');
        $chapter_id = $this->input->get('chapter_id');
        $lesson_id = $this->input->get('lesson_id');

        if (!empty($word) && empty($book_id) && empty($chapter_id) && empty($lesson_id)) {
            $this->session->set_userdata('word', $this->input->get('word'));
            $this->session->unset_userdata('search_book');
            $this->session->unset_userdata('search_chapter');
            $this->session->unset_userdata('search_lesson');
        } elseif (!empty($word) && !empty($book_id) && empty($chapter_id) && empty($lesson_id)) {
            $this->session->set_userdata('word', $word);
            $this->session->set_userdata('search_book', $book_id);
            $this->session->unset_userdata('search_chapter');
            $this->session->unset_userdata('search_lesson');
        } elseif (empty($word) && !empty($book_id) && empty($chapter_id) && empty($lesson_id)) {
            $this->session->unset_userdata('word');
            $this->session->unset_userdata('search_chapter');
            $this->session->unset_userdata('search_lesson');
            $this->session->set_userdata('search_book', $book_id);
        } elseif (!empty($word) && !empty($book_id) && !empty($chapter_id) && empty($lesson_id)) {
            $this->session->set_userdata('word', $this->input->get('word'));
            $this->session->set_userdata('search_book', $book_id);
            $this->session->set_userdata('search_chapter', $chapter_id);
            $this->session->unset_userdata('search_lesson');
        } elseif (!empty($word) && !empty($book_id) && !empty($chapter_id) && !empty($lesson_id)) {
            $this->session->set_userdata('word', $this->input->get('word'));
            $this->session->set_userdata('search_book', $book_id);
            $this->session->set_userdata('search_chapter', $chapter_id);
            $this->session->set_userdata('search_lesson', $lesson_id);
        } elseif (empty($word) && !empty($chapter_id) && empty($lesson_id)) {
            $this->session->unset_userdata('word');
            $this->session->unset_userdata('search_lesson');
            $this->session->set_userdata('search_book', $book_id);
            $this->session->set_userdata('search_chapter', $chapter_id);
        } elseif (empty($word) && !empty($chapter_id) && !empty($lesson_id)) {
            $this->session->unset_userdata('word');
            $this->session->set_userdata('search_book', $book_id);
            $this->session->set_userdata('search_chapter', $chapter_id);
            $this->session->set_userdata('search_lesson', $lesson_id);
        }

//        $this->session->unset_userdata('word');


        if (!empty($this->session->userdata('word')) && empty($this->session->userdata('search_book'))) {
            $where = array();
            $like = array();
            $like['question'] = $this->session->userdata('word');
            $where['status'] = 1;
            $where['show_no_site'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);
            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->session->userdata('word');
            $this->load->view('front_end/index', $data);
        } elseif (!empty($this->session->userdata('word')) && !empty($this->session->userdata('search_book')) && empty($this->session->userdata('search_chapter')) && empty($this->session->userdata('search_lesson'))) {
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['status'] = 1;
            $where['show_no_site'] = 1;
            $like['question'] = $this->session->userdata('word');

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";

            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);
            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif (empty($this->session->userdata('word')) && !empty($this->session->userdata('search_book')) && empty($this->session->userdata('search_chapter')) && empty($this->session->userdata('search_lesson'))) {
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['status'] = 1;
            $where['show_no_site'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif (!empty($this->session->userdata('word')) && !empty($this->session->userdata('search_book')) && !empty($this->session->userdata('search_chapter')) && empty($this->session->userdata('search_lesson'))) {
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['chapter_id'] = $this->session->userdata('search_chapter');
            $where['status'] = 1;
            $where['show_no_site'] = 1;
            $like['question'] = $this->session->userdata('word');

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif (!empty($this->session->userdata('word')) && !empty($this->session->userdata('search_book')) && !empty($this->session->userdata('search_chapter')) && !empty($this->session->userdata('search_lesson'))) {
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['chapter_id'] = $this->session->userdata('search_chapter');
            $where['lesson_id'] = $this->session->userdata('search_lesson');
            $where['status'] = 1;
            $where['show_no_site'] = 1;
            $like['question'] = $this->session->userdata('word');

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif (empty($this->session->userdata('word')) && !empty($this->session->userdata('search_book')) && !empty($this->session->userdata('search_chapter')) && empty($this->session->userdata('search_lesson'))) {
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['chapter_id'] = $this->session->userdata('search_chapter');
            $where['show_no_site'] = 1;
            $where['status'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } elseif (empty($this->session->userdata('word')) && !empty($this->session->userdata('search_book')) && !empty($this->session->userdata('search_chapter')) && !empty($this->session->userdata('search_lesson'))) {
            $where = array();
            $like = array();
            $where['book_id'] = $this->session->userdata('search_book');
            $where['chapter_id'] = $this->session->userdata('search_chapter');
            $where['lesson_id'] = $this->session->userdata('search_lesson');
            $where['status'] = 1;
            $where['show_no_site'] = 1;

            $config = array();
            $config["base_url"] = base_url() . "darulifta/search_question";
            $config["total_rows"] = $this->frontend_model->count_question($where, $like);
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $limit['param1'] = $config["per_page"];
            $limit['param2'] = $page;
            $data["questions"] = $this->frontend_model->search_question($where, $like, $limit);

            $data["links"] = $this->pagination->create_links();
            $data['page_name'] = 'search_question';
            $data['page_title'] = 'سوالات برائے ' . $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $this->session->userdata('search_book'));
            $this->load->view('front_end/index', $data);
        } else {
            redirect('darulifta');
        }
    }

    function all_questions() {
        
    }

}
