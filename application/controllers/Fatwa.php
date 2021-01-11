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

class Fatwa extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->library('session');

//        $this->load->library('Html_to_doc');

        $this->load->model('question_model');

        $this->load->model('fatwa_model');





        /* cache control */

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function answers() {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');



        $data['answer_data'] = $this->fatwa_model->get_last_ten_records('admin');
        $data['unsolved_ans'] = $this->fatwa_model->get_unsolved_fatwa();
        $data['page_name'] = 'answer/answers';

        $data['page_title'] = 'دارلا�?تاء جامع�? عثمانی�? پشاور';

        $this->load->view('backend/index', $data);
    }

    function all_answers() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['answer_data'] = $this->fatwa_model->get_fatwas();
        $data['unsolved_ans'] = $this->fatwa_model->get_unsolved_fatwa();
        $data['page_name'] = 'answer/all_answers';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    function approve_fatwa($fatwa_id) {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $this->db->where('answer_id', $fatwa_id);
        $this->db->update('ifta_answer', array('admin_approval' => 1));

        //Update Approval for Mujeeb
        $question_id = $this->db->get_where('ifta_answer', array('answer_id' => $fatwa_id))->row()->question_id;

        $this->db->where('question_id', $question_id);
        $this->db->update('ifta_user_question', array('admin_approval' => 1));

        $this->session->set_flashdata('flash_message', 'فتوی کو کامیابی سے تصدیق کر دیا گیا۔۔۔');
        redirect(base_url() . 'fatwa/all_answers/', 'refresh');
    }

    function print_fatwa($fatwa_id) {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');



        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($fatwa_id);

        $this->load->view('backend/admin/answer/fatwa_print', $data);
    }

    function edit_fatwa($param1 = '', $param2 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        //Check fatwa if it is already approved by admin then don't allow for editing
        $check_approved = $this->db->get_where('ifta_answer', array('answer_id' => $param1, 'admin_approval' => 1))->row();
        if (!empty($check_approved)) {
            $this->session->set_flashdata('error_message', 'یہ فتوی پہلے سے تصدیق ہو چکا ہے۔ لہز آپ اس کی تصحح نہیں کر سکتے۔۔۔');
            redirect(base_url() . 'fatwa/answers/', 'refresh');
        }

        if ($param1 == 'update') {

            $fatwa_id = $this->input->post('fatwa_id');
            $question_id = $this->input->post('question_id');


            $result = $this->fatwa_model->update_fatwa($fatwa_id, $question_id);

            if ($result == TRUE) {

                $this->session->set_flashdata('flash_message', '�?تویٰ کو کامیابی سے اپڈیٹ کر دیا گیا۔۔۔');

                redirect(base_url() . 'fatwa/edit_fatwa/' . $fatwa_id, 'refresh');
            } else {

                $this->session->set_flashdata('error_message', 'ریکارڈ کو اپ ڈیٹ کرتے وقت ایک خامی �?ے');

                redirect(base_url() . 'fatwa/edit_fatwa/' . $fatwa_id, 'refresh');
            }
        }

        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($param1);

        $data['page_name'] = 'answer/fatwa_edit';

        $data['page_title'] = 'دارلا�?تاء جامع�? عثمانی�? پشاور';

        $this->load->view('backend/index', $data);
    }

    function delte_fatwa($fatwa_id) {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $fatwa = $this->db->get_where('ifta_answer', array('answer_id' => $fatwa_id))->row();

        $question_id = $fatwa->question_id;

        //Delete question first

        $this->db->where('question_id', $question_id);

        $this->db->delete('ifta_question');

        //then delete answer

        $this->db->where('answer_id', $fatwa_id);

        $this->db->delete('ifta_answer');



        $this->session->set_flashdata('flash_message', 'فتوی کو کامیابی سے حذف کر دیا گیا۔۔۔');

        redirect(base_url() . 'fatwa/answers' . $fatwa_id, 'refresh');
    }

    function delete_jawab_sahi($fatwa_id, $name) {

        $delete_name = urldecode($name);

        $fatwa = $this->db->get_where('ifta_answer', array('answer_id', $fatwa_id))->row();



        $total_editors = str_replace('[', '', $fatwa->editors);

        $total_editors = str_replace(']', '', $total_editors);

        $total_editors = str_replace('"', '', $total_editors);

        $arr_editors = explode(',', $total_editors);



        $ques_editors = array();

        $no = 0;

        foreach ($arr_editors as $edit) {

            if ($edit != $delete_name) {

                $edit['name'] = $edit;

                array_push($ques_editors, $edit);
            }
        }



        $deditors = json_encode($ques_editors, JSON_UNESCAPED_UNICODE);

        $this->db->where('answer_id', $fatwa_id);

        $this->db->update('ifta_answer', array('editors' => $deditors));

        $this->session->set_flashdata('flash_message', 'الجواب التضحح کو کامیابی سے حذف کر دیا گیا۔۔۔');

        redirect(base_url() . 'fatwa/edit_fatwa/' . $fatwa_id, 'refresh');

        //["حضرت مولانا مفتی غلام الرحمن صاحب1","حضرت مولانا مفتی غلام الرحمن صاحب2","حضرت مولانا مفتی غلام الرحمن صاحب3","حضرت مولانا مفتی غلام الرحمن صاحب4"]
    }

    function send_answer_email($fatwa_id) {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');



        $this->fatwa_model->send_response_email($fatwa_id);

        $this->db->where('answer_id', $fatwa_id);

        $this->db->update('ifta_answer', array('response_email' => 1));



        $this->session->set_flashdata('flash_message', 'ای میل کو کامیابی سے ارسال کر دیا گیا۔۔۔');



        redirect(base_url() . 'fatwa/answers', 'refresh');
    }

    // this function is used to view the answer detail solved by mujeeeb

    function fatwa_detail($fatwa_id) {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');



        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($fatwa_id);

        $this->fatwa_model->update_admin_view_status($fatwa_id);

        $data['page_name'] = 'answer/fatwa_detail';

        $data['page_title'] = 'دارلا�?تاء جامع�? عثمانی�? پشاور';

        $this->load->view('backend/index', $data);
    }

    function search_fatwa() {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');



        $result = $this->fatwa_model->search_fatwa();

        $data['result'] = $result;

        $data['page_name'] = 'answer/search_fatwa';

        $data['page_title'] = 'دارلا�?تاء جامع�? عثمانی�? پشاور';

        $this->load->view('backend/index', $data);
    }

    function import_to_word($param1 = '') {

        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');



        if ($param1 == 'create') {

            $book_id = $this->input->post('book_id');

            $book_name = $this->crud_model->get_column_name_by_id('ifta_books', 'book_id', $book_id);

            $htmlContent = $this->fatwa_model->import_to_word($book_id);

//            echo $htmlContent;die;

            $htd = new Html_to_doc();

            $htd->createDoc($htmlContent, $book_name);

            $htd->createDoc($htmlContent, $book_name, true);

            echo "<script>window.location.href = 'http://usmaniapsh.com/darulifta/" . $book_name . ".doc';</script>";





//            $this->session->set_flashdata('flash_message', 'ورڈ �?ائل کامیابی سے بنا دیا گیا �?ے');
//            redirect(base_url() . 'fatwa/import_to_word/', 'refresh');
//            $htd->createDoc($htmlContent, "$book_name");
        }



        $data['page_name'] = 'answer/import_to_word';

        $data['page_title'] = 'دارلا�?تاء جامع�? عثمانی�? پشاور';

        $this->load->view('backend/index', $data);
    }

    function show_on_site($param1 = '', $param2 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($param2 == 1) {
            $this->db->where('question_id', $param1);
            $this->db->update('ifta_question', array('show_no_site' => 0));
        } else {
            $this->db->where('question_id', $param1);
            $this->db->update('ifta_question', array('show_no_site' => 1));
        }


        $this->session->set_flashdata('flash_message', 'فتویٰ کو کامیابی سےآپڈیٹ کر دیا گیا۔۔۔');
        redirect(base_url() . 'fatwa/answers' . $fatwa_id, 'refresh');
    }

    function review_mujeeb_editing($param1 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data['question_id'] = $param1;
        $data['page_name'] = 'answer/review_mujeeb_editing';
        $data['page_title'] = 'دارلافتاء جامعہ عثمانیہ پشاور';
        $this->load->view('backend/index', $data);
    }

    function add_review_mujeed_edit() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $question_id = $this->input->post('question_id');
        $data['fatwa_id'] = $this->db->get_where('ifta_answer', array('question_id' => $question_id))->row()->answer_id;
        $data['question_id'] = $question_id;
        $data['mujeeb_id'] = $this->db->get_where('ifta_user_question', array('question_id' => $question_id))->row()->user_id;
        $data['detail'] = $this->input->post('detail');
        $data['date'] = date('Y-m-d H:i:s A');

        if (empty($data['mujeeb_id'])) {
            $this->session->set_flashdata('error_message', 'اس سوال کیلئےابی تک کوئی مجیب منتخب نہیں کیا گیاہے۔۔');
            redirect(base_url() . 'fatwa/review_mujeeb_editing/' . $question_id, 'refresh');
        } else {
            $this->db->insert('ifta_fatwa_review', $data);
            $this->session->set_flashdata('flash_message', 'میجب کو دوبارہ تصحح شامل کر دیاگیا۔۔۔');
            redirect(base_url() . 'fatwa/review_mujeeb_editing/' . $question_id, 'refresh');
        }
    }

    function delete_fatwa($param1 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $this->db->where('question_id', $param1);
        $this->db->delete('ifta_question');

        $this->db->where('question_id', $param1);
        $this->db->delete('ifta_user_question');

        $this->db->where('question_id', $param1);
        $this->db->delete('ifta_answer');

        $this->session->set_flashdata('flash_message', 'فتویٰ کو کامیابی سے حذف کر دیا گیا۔۔۔');
        redirect(base_url() . 'fatwa/answers/', 'refresh');
    }

    function fatwa_list() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

//        $data['fatwa'] = $this->fatwa_model->get_fatwa_data($param1);
        $data['page_name'] = 'answer/fatwa_list';
        $data['page_title'] = 'دارلا�?تاء جامع�? عثمانی�? پشاور';
        $this->load->view('backend/index', $data);
    }

    function print_fatwa_list() {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $where = array();
        $where['status'] = 1;
        $where['admin_approval'] = 1;
        $order = "ifta_question.date_added asc";
        $data['date_from'] = date('Y-m-d', strtotime($this->input->post('date_from')));
        $data['date_to'] = date('Y-m-d', strtotime($this->input->post('date_to')));
        $data['fatwa_data'] = $this->fatwa_model->get_fatwas_detail($where, $order, $data['date_from'], $data['date_to']);

        $this->load->view('backend/admin/answer/_fatwa_list', $data);
    }

    function show_mustafti($param1 = '') {
        if ($this->session->userdata('ifta_admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        $data = $this->db->get_where('ifta_answer', array('answer_id' => $param1))->row();
        
        if ($data->show_mustafti == 0) {
            $this->db->where('answer_id', $param1);
            $this->db->update('ifta_answer', array('show_mustafti' => 1));
        } else {
            $this->db->where('answer_id', $param1);
            $this->db->update('ifta_answer', array('show_mustafti' => 0));
        }

        $this->session->set_flashdata('flash_message', 'فتویٰ کو کامیابی سے تصحح کر دیا گیا۔۔۔');
        redirect(base_url() . 'fatwa/answers/', 'refresh');
    }

}
